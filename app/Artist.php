<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';
    
    public function getCreator(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function getAlbums(){
        return $this->hasMany('App\Album');
    }
    
    public function getSongs(){
        return $this->hasMany('App\Song');
    }
    
    public function getLikers(){
        return $this->belongsToMany('App\User', 'artist_likes', 'artist_id', 'user_id');
    }
}
