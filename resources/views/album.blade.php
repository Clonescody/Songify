@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <img src="{{ $album->image }}" class="img-responsive">
            </div>
            <div class="col-lg-4">
                <h3>{{ $album->title }}</h3>
                <h4>Par <a href="/artist/{{ $album->getArtist->id }}">{{ $album->getArtist->name }}</a></h4>
                <h5>Ajouté par : <a href="/user/{{ $album->getCreator->id }}">{{ $album->getCreator->name }}</a></h5>
            </div>
            <div class="col-lg-4">
                <h3>Autres albums de l'artiste </h3>
                @foreach($album->getArtist->getAlbums as $other_album)
                    @if($other_album->id != $album->id)
                        <div class="row">
                            <div class="col-lg-12">
                                <p><a href="/album/{{ $other_album->id }}">{{ $other_album->title }}</a></p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div>
            <p>
                @if($album->getLikers->count() > 1)
                    {{ $album->getLikers->count() }} personnes aiment cet album
                @else
                    {{ $album->getLikers->count() }} personne aime cet album
                @endif
            </p>
            @if(Auth::check())
                @if($album->getLikers->contains(Auth::id()))
                    <a href="/album/dislike/{{$album->id}}">Pas aimer</a>
                @else
                    <a href="/album/like/{{$album->id}}">Aimer</a>
                @endif
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                @foreach($album->getSongs as $song)
                    <div class="row">
                        <div class="col-lg-12">
                            <h4><a href="/song/{{ $song->id }}">{{ $song->title }}</a></h4>
                            <audio src="{{ $song->url }}" controls></audio>
                            <p><a href='/song/download/{{$song->id}}' ><button type="button" class="btn btn-primary">Télécharger</button></a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection