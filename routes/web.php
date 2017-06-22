<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GlobalController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'GlobalController@profile');

Route::get('/user/{id}', 'GlobalController@user');

Route::get('/songs', 'GlobalController@songs')->name('songs');

Route::get('/albums', 'GlobalController@albums');

Route::get('/artists', 'GlobalController@artists');

Route::post('/search', 'GlobalController@search');

Route::get('/song/{id}', 'GlobalController@song');

Route::get('/song/download/{id}', 'GlobalController@download');

Route::get('/songs/new', 'GlobalController@formAddSong')->middleware('auth');

Route::post('/songs/add/{id}', 'GlobalController@add_song')->middleware('auth');


Route::get('/album/{id}', 'GlobalController@album');

Route::get('/albums/new', 'GlobalController@formAddAlbum')->middleware('auth');

Route::post('/album/fill/{id}', 'GlobalController@add_songs_to_album')->middleware('auth');

Route::post('/albums/add/{id}', 'GlobalController@add_album')->middleware('auth');

Route::get('/artist/{id}', 'GlobalController@artist');


Route::post('/comments/add/{id}', 'GlobalController@add_comment');


Route::get('/song/like/{id}', 'GlobalController@like_song')->middleware('auth');

Route::get('/song/dislike/{id}', 'GlobalController@dislike_song')->middleware('auth');

Route::get('/album/like/{id}', 'GlobalController@like_album')->middleware('auth');

Route::get('/album/dislike/{id}', 'GlobalController@dislike_album')->middleware('auth');

Route::get('/artist/like/{id}', 'GlobalController@like_artist')->middleware('auth');

Route::get('/artist/dislike/{id}', 'GlobalController@dislike_artist')->middleware('auth');
