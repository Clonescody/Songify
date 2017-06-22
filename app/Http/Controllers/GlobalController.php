<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use Illuminate\Http\Request;
use App\Song;
use App\User;
use App\Artist;
use Illuminate\Support\Facades\Storage;

class GlobalController extends Controller
{
    public function index(){
        return view('index');
    }

    public function songs(){
        return view('/songs', ['songs' => Song::all()]);
    }

    public function albums(){
        return view('/albums', ['albums' => Album::all()]);
    }
    
    public function artists(){
        return view('/artists', ['artists' => Artist::all()]);
    }

    public function song($id){
        return view('/song', ['song' => Song::find($id)]);
    }

    public function album($id){
        return view('/album', ['album' => Album::find($id)]);
    }
    
    public function artist($id){
        return view('/artist', ['artist' => Artist::find($id)]);
    }
    
    public function profile(){
        return view('/profile', ['user' => User::find(Auth::user()->id)]);
    }
    
    public function user($id){
        return view('/user', ['user' => User::find($id)]);
    }

    
    public function download($id){
        $file = Song::find($id);
        $tmp = explode('.', $file->url);
        $type = end($tmp);
        return response()->download(public_path().$file->url, $file->title.'.'.$type);
    }

    public function search(Request $request){
         $this->validate($request, [
            'search' => 'required|min:3'
        ]);
        
        $songs = Song::whereRaw("title LIKE CONCAT('%', ?,'%')", array($request->input('search')))
            ->orderBy('created_at', 'desc')->get();
        
        $albums = Album::whereRaw("title LIKE CONCAT('%', ?,'%')", array($request->input('search')))
            ->orderBy('created_at', 'desc')->get();
        
        $artists = Artist::whereRaw("name LIKE CONCAT('%', ?,'%')", array($request->input('search')))
            ->orderBy('created_at', 'desc')->get();
        
        return view('/found', ['songs' => $songs, 'albums' => $albums, 'artists' => $artists]);
    }

    public function formAddAlbum() { 
        return view('forms.add_album', ['artists' => Artist::all()]); 
    }
    public function add_album(Request $request, $user_id){

        $this->validate($request, [
            'title' => 'required|min:2',
            'nb_songs' => 'required|min:1|max:20',
            'file' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);
        $file = $request->file('file')->store('albums', 'public');

        $album = new Album();
        if(isset($request->author)){
            if (Artist::where('name', '=', $request->author)->count() > 0){
                $artist = Artist::where('name', '=', $request->author)->first();
            }else{
                $artist = new Artist();
                $artist->name = $request->author;
                $artist->save();
            }
        }else{
            $artist = Artist::find($request->author_select);
        }
        
        $album->title = $request->title;
        $album->artist_id = $artist->id;
        $album->nb_songs = $request->nb_songs;
        $album->image = Storage::url($file);
        $album->user_id = $user_id;
        $album->save();

        return view('forms.add_songs', ['album' => $album]);
    }
    
    public function add_songs_to_album(Request $request, $album_id){
        
        for( $i=1; $i <= $request->nb_songs; $i++){
            
            $song_datas = [
                'title' => $request->title[$i],
                'duration' => $request->duration[$i],
                'file' => $request->file('file.'.$i)->store('musiques', 'public')
            ];
            $this->_add_song_from_album($song_datas, $album_id);
        }
        return redirect('/album/'.$album_id);
    }
    
    private function _add_song_from_album($song_datas, $album_id){
        $album = Album::find($album_id);
        
        $song = new Song();
        $song->title = $song_datas['title'];
        $song->artist_id = $album->artist_id;  
        $song->duration = $song_datas['duration'];
        $song->url = Storage::url($song_datas['file']);
        $song->user_id = Auth::user()->id;
        $song->album_id = $album->id;
        $song->save();
    }
    
    public function formAddSong(){ 
        return view('forms.add_song', ['artists' => Artist::all()]); 
    }

    public function add_song(Request $request, $album_id){

        $this->validate($request, [
            'title' => 'required|min:2',
            'duration' => 'required',
            'file' => 'required|mimes:mp3,mp4,wav'
        ]);
        $file = $request->file('file')->store('musiques', 'public');

        
        if(Artist::where('name', '=', $request->author)->count() > 0) 
            $artist = Artist::where('name', '=', $request->author)->first();
        if(Artist::find($request->author_select)->count() > 0)
            $artist = Artist::find($request->author_select);
        else
            $artist = new Artist();
        
        if($artist->name == ''){
            $artist->name = $request->author;
            $artist->save();
        }
        
        $song = new Song();
        $song->title = $request->title;
        $song->artist_id = $artist->id;
        $song->duration = $request->duration;
        $song->url = Storage::url($file);
        $song->user_id = Auth::user()->id;
        $song->album_id = null;
        $song->save();

        return redirect('/song/'.$song->id);
    }

    public function add_comment(Request $request, $id){
        $this->validate($request, [
            'text' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->text = $request->text;
        $comment->song_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return redirect('/song/'.$id);
    }

    public function like_song($id){
        $song = Song::find($id);
        $song->getLikers()->attach(Auth::id());
        return back();
    }

    public function dislike_song($id){
        $song = Song::find($id);
        $song->getLikers()->detach(Auth::id());
        return back();
    }

    public function like_album($id){
        $album = Album::find($id);
        $album->getLikers()->attach(Auth::id());
        return back();
    }

    public function dislike_album($id){
        $album = Album::find($id);
        $album->getLikers()->detach(Auth::id());
        return back();
    }
    
    public function like_artist($id){
        $artist = Artist::find($id);
        $artist->getLikers()->attach(Auth::id());
        return back();
    }

    public function dislike_artist($id){
        $artist = Artist::find($id);
        $artist->getLikers()->detach(Auth::id());
        return back();
    }
}
