@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $user->name }}</h2>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-4">
                <p>A envoyé les chansons suivantes</p>
            </div>
            <div class="col-lg-8">
                <ul style="list-style-type: none">
                    @foreach($user->getSongs as $song)
                        <li><a href="/song/{{ $song->id }}">{{ $song->title }}</a> de <a href="/artist/{{ $song->getArtist->id }}">{{ $song->getArtist->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <p>A aimé les chansons suivantes</p>
            </div>
            <div class="col-lg-8">
                <ul style="list-style-type: none">
                    @foreach($user->getLikedSongs as $liked_song)
                        <li><a href="/song/{{ $liked_song->id }}">{{ $liked_song->title }}</a> de <a href="/artist/{{ $liked_song->getArtist->id }}">{{ $liked_song->getArtist->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <p>A aimé les albums suivants</p>
            </div>
            <div class="col-lg-8">
                <ul style="list-style-type: none">
                    @foreach($user->getLikedAlbums as $liked_album)
                        <li><a href="/album/{{ $liked_album->id }}">{{ $liked_album->title }}</a> de <a href="/artist/{{ $liked_album->getArtist->id }}">{{ $liked_album->getArtist->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection