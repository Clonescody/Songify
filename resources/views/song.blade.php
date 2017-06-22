@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h3>{{ $song->title }}</h3>
                @if($song->getAlbum != null)
                    <h4>De l'album <a href="/album/{{ $song->getAlbum->id }}">{{ $song->getAlbum->title }}<img style="height: 150px;" src="{{ $song->getAlbum->image }}" class="img-responsive"></a></h4>
                @endif
                
                <h4>Par <a href="/artist/{{ $song->getArtist->id }}">{{ $song->getArtist->name }}</a></h4>
                <h5>ajoutée par : <a href="/user/{{ $song->getCreator->id }}">{{ $song->getCreator->name }}</a></h5>
                <p><audio src="{{ $song->url }}" controls></audio></p>
                <p><a href='/song/download/{{$song->id}}' ><button type="button" class="btn btn-primary">Télécharger</button></a></p>
            </div>
            <div class="col-lg-4">
                <h4>Chansons de l'album </h4>
                <ul>
                    @foreach($song->getAlbum->getSongs as $other_song)
                        @if($other_song->id != $song->id)
                            <li><a href="/song/{{ $other_song->id }}">{{ $other_song->title }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div>
            <p>
                @if($song->getLikers->count() > 1)
                    {{ $song->getLikers->count() }} personnes aiment cette chanson
                @else
                    {{ $song->getLikers->count() }} personne aime cette chanson
                @endif
            </p>
            <p>
                @if(Auth::check())
                    @if($song->getLikers->contains(Auth::id()))
                        <a href="/song/dislike/{{$song->id}}">Pas aimer</a>
                    @else
                        <a href="/song/like/{{$song->id}}">Aimer</a>
                    @endif
                @endif
            </p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Commentaires </h3>
                @foreach($song->getComments as $comment)
                    <div class="row" style="border: 1px solid black; border-left:0; border-right:0;">
                        <div class="col-lg-12">
                            <p>Par : <a href="/user/{{ $comment->getUser->id }}">{{ $comment->getUser->name }}</a></p>
                            <p>{{ $comment->text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                @if(Auth::check())
                    <div class="row">
                        <form action="/comments/add/{{$song->id}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Votre commentaire : </label>
                                <textarea style="height: 40px;" name="text"></textarea>
                            </div>
                            <input type="submit" placeholder="ajouter" class="btn btn-primary">
                        </form>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection