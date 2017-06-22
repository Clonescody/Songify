<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'songs';
    
    public function getCreator(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function getArtist(){
        return $this->belongsTo('App\Artist', 'artist_id');
    }

    public function getAlbum(){
        return $this->belongsTo('App\Album', 'album_id');
    }

    public function getComments(){
        return $this->hasMany('App\Comment');
    }

    public function getLikers(){
        return $this->belongsToMany('App\User', 'song_likes', 'song_id', 'user_id');
    }
}
