<?php
/**
 * File: api.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-11-26
 * Copyright (c) 2019
 */

Route::group([
    'middleware' => ['api'],
    'namespace' => '\App\Http\Controllers\Api'
], static function () {
    Route::get('/', 'WelcomeController@index');
    Route::get('/trucks', 'TruckController@index');
    Route::get('/trucks/{truck}', 'TruckController@show');
    Route::post('/trucks/add', 'TruckController@create');
    Route::patch('/trucks/{truck}', 'TruckController@update');
    Route::delete('/trucks/{truck}', 'TruckController@destroy');

    Route::get('/img/{truck}', 'TruckImgController@show');
    Route::post('/img/{truck}', 'TruckImgController@create');
    Route::patch('/img/{truck}', 'TruckImgController@update');
    Route::delete('/img/{truck}', 'TruckImgController@destroy');
});
