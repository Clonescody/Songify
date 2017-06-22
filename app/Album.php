<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    
    public function getCreator(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function getArtist(){
        return $this->belongsTo('App\Artist', 'artist_id');
    }

    public function getSongs(){
        return $this->hasMany('App\Song');
    }

    public function getLikers(){
        return $this->belongsToMany('App\User', 'album_likes', 'album_id', 'user_id');
    }
}
