<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $table = 'users';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getSongs(){
        return $this->hasMany('App\Song');
    }

    public function getLikedSongs(){
        return $this->belongsToMany('App\Song', 'song_likes', 'user_id', 'song_id');
    }

    public function getLikedAlbums(){
        return $this->belongsToMany('App\Album', 'album_likes', 'user_id', 'album_id');
    }
    
    public function getLikedArtists(){
        return $this->belongsToMany('App\Artist', 'artist_likes', 'user_id', 'artist_id');
    }
}
