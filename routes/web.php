<?php

// spa route
Route::get('/', "AppController@index")->where('any', '.*');
Route::get('/{any}', "AppController@index")->where('any', '.*');
