@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Liste des artistes enregistrés sur le site</h2>
        <div class="row">
            <div class="col-lg-12">
                <ul style="list-style-type: none">
                    @foreach($artists as $artist)
                        <li><a href="{{ ('/artist/'.$artist->id) }}">{{ $artist->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection