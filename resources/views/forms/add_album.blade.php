@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12">
     <h2>Ajouter un album</h2>
    </div>
       
</div>
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="/albums/add/{{ Auth::user()->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label>Titre : </label><input type="text" name="title" required>
                <div class="form-group">
                    <label>Ajouter un artiste </label>
                    <input type="text" name="author">
                </div>
                <div class="form-group">
                    <label>Ou sélectionnez en un </label>
                    <select name="author_select">
                    @foreach($artists as $artist)
                        <option value="{{$artist->id}}">{{$artist->name}}</option>
                    @endforeach
                    </select> 
                </div>
                
                <div class="form-group">
                    <label>Nombre de chansons de l'album : </label><input type="number" name="nb_songs" value="1" min="1" max="20" required>
                </div>
                <div class="form-group">
                    <label>Pochette de l'album </label><input type="file" name="file" required>
                </div>
                
                <input type="submit" placeholder="envoyer" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

    
@endsection