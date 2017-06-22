@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Ajouter une chanson</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="/songs/add/{{ Auth::user()->id }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label>Titre : </label><input type="text" name="title" required>
                <div class="form-group">
                    <label>Ajouter un auteur : </label>
                    <input type="text" name="author">
                </div>
                <div class="form-group">
                    <label>Ou sélectionnez en un</label>
                    <select name="author_select" >
                    @foreach($artists as $artist)
                        <option value="{{$artist->id}}">{{$artist->name}}</option>
                    @endforeach
                    </select> 
                </div>
                
                <label>Durée : </label><input type="text" name="duration" placeholder="min:sec">
                <input type="file" name="file" required>
                <input type="submit" placeholder="envoyer" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
    
@endsection