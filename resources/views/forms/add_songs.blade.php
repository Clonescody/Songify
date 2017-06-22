@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>{{$album->title}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="/album/fill/{{ $album->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $album->nb_songs }}" name="nb_songs">
                @for($i=1; $i <= $album->nb_songs; $i++)
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label>Chanson n°{{ $i }}</label>
                            <div class="form-group">
                                <label>Titre : </label><input type="text" name="title[{{$i}}]" required>
                            </div>
                            <div class="form-group">
                                <label>Durée : </label><input type="text" name="duration[{{$i}}]">
                            </div>
                           
                            <input type="file" name="file[{{$i}}]" required>
                        </div>
                    </div>
                @endfor
                <input type="submit" class="btn btn-primary" placeholder="envoyer">
            </form>
        </div>
    </div>
    
</div>
@endsection