<?php

Route::get('/',function (){ return view('layout/app');});
Route::get('/games','PageController@games');
Route::get('/devs','PageController@devs');

Route::get('/game/add','GamesController@addGame')->name('game_add');
Route::post('/game/add','GamesController@postAddGame')->name('game_add_post');
Route::get('/game/{games_id}','GamesController@getGame')->name('game_details');

Route::get('/users','PageController@users_param');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test_user', function () {
        return 'reserved to user';
})->middleware('auth');
Route::get('/test_resp', function () { return 'reserved to resp'; })->middleware('auth');
Route::get('/test_admin', function () { return 'reserved to admin'; })->middleware('is_admin');

Route::get('/test','PageController@test');
