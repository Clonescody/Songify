@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Liste des albums enregistrés sur le site</h2>
        <div class="row">
            <div class="col-lg-12">
                <ul style="list-style-type: none">
                    <li>
                        <div class="col-lg-3">
                            <p></p>
                        </div>
                        <div class="col-lg-3">
                            <p>Titre</p>
                        </div>
                        <div class="col-lg-3">
                            <p>Artiste</p>
                        </div>
                        <div class="col-lg-3">
                            <p>Nombre de chansons</p>
                        </div>
                    </li>
                    @foreach($albums as $album)
                    <div class="row">
                        <div class="col-lg-12">
                            <li>
                                <div class="col-lg-3">
                                    <p><img src="{{$album->image}}" style="height:120px; width: 120px;" class="img-responsive"></p>
                                </div>
                                <div class="col-lg-3">
                                    <p><a href="{{ ('/album/'.$album->id) }}">{{ $album->title }}</a></p>
                                </div>
                                <div class="col-lg-3">
                                    <p><a href="{{ ('/artist/'.$album->getArtist->id) }}">{{ $album->getArtist->name }}</a></p>
                                </div>
                                <div class="col-lg-3">
                                    <p>{{ $album->nb_songs }}</p>
                                </div>
                            </li>
                        </div>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection