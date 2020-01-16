<?php

Route::get('/','PageController@hello');
Route::get('/games','PageController@games');
Route::get('/devs','PageController@devs');

Route::get('/games/{games_id}','GamesController@getGame');
