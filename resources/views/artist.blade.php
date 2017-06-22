@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>{{ $artist->name }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    @if($artist->getLikers->count() > 1)
                        {{ $artist->getLikers->count() }} personnes aiment cet artiste
                    @else
                        {{ $artist->getLikers->count() }} personne aime cet artiste
                    @endif
                </p>
                    @if(Auth::check())
                        @if($artist->getLikers->contains(Auth::id()))
                            <a href="/artist/dislike/{{$artist->id}}">Pas aimer</a>
                        @else
                            <a href="/artist/like/{{$artist->id}}">Aimer</a>
                        @endif
                    @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Ses albums</h3>
                @foreach($artist->getAlbums as $album)
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="/album/{{ $album->id }}">
                                <p>{{ $album->title }}</p>
                                <img src="{{ $album->image }}" style="height: 150px;" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-lg-8">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Les chansons</h3>
                @foreach($artist->getSongs as $song)
                    <div class="row">
                        <div class="col-lg-12">
                            <p>
                                <a href="/song/{{ $song->id }}">{{ $song->title }}</a> 
                                de l'album <a href="/album/{{ $song->getAlbum->id }}">{{  $song->getAlbum->title }}</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection