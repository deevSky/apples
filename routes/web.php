<?php

use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'AppleController@index');

Route::post('/generate', 'AppleController@generate');

Route::POST('apples/{apple}', 'AppleController@update');
