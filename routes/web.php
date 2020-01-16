<?php

Route::get('/','PageController@hello');
Route::get('/games','PageController@games');
Route::get('/devs','PageController@devs');

Route::get('/game/add','GamesController@addGame')->name('game_add');
Route::post('/game/add','GamesController@postAddGame')->name('game_add_post');
Route::get('/game/{games_id}','GamesController@getGame')->name('game_details');
