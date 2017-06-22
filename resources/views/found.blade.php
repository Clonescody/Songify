@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Chansons</h2>
                <ul style="list-style-type: none">
                    @foreach($songs as $song)
                        <li><a href="{{ ('/song/'.$song->id) }}">{{ $song->title }}</a> par {{ $song->author }} -- {{ $song->duration }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Albums</h2>
                <ul style="list-style-type: none">
                    @foreach($albums as $album)
                        <li><a href="{{ ('/album/'.$album->id) }}">{{ $album->title }}</a> par {{ $album->author }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Artistes</h2>
                <ul style="list-style-type: none">
                    @foreach($artists as $artist)
                        <li><a href="{{ ('/artist/'.$artist->id) }}">{{ $artist->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection