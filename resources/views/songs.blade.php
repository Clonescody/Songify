@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Liste des chansons disponibles</h2>
        <div class="row">
            <div class="col-lg-12">
                <ul style="list-style-type: none">
                    <li>
                        <div class="col-lg-3">
                            <p>Titre</p>
                        </div>
                        <div class="col-lg-3">
                            <p>Auteur</p>
                        </div>
                        <div class="col-lg-3">
                            <p>Durée</p>
                        </div>
                        <div class="col-lg-3">
                            <p>Album</p>
                        </div>
                    </li>
                    @foreach($songs as $song)
                        <li>
                            <div class="col-lg-3">
                                <p><a href="{{ ('/song/'.$song->id) }}">{{ $song->title }}</a></p>
                            </div>
                            <div class="col-lg-3">
                                <p><a href="{{ ('/artist/'.$song->getArtist->id) }}">{{ $song->getArtist->name }}</a></p>
                            </div>
                            <div class="col-lg-3">
                                <p>{{ $song->duration }}</p>
                            </div>
                            <div class="col-lg-3">
                                <p><a href="{{ ('/album/'.$song->getAlbum->id) }}">{{ $song->getAlbum->title }}</a></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection