<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Api\HomeController@home');

Route::post('/register', 'Api\Auth\RegisterController@register');

Route::middleware('auth:api')->get('/user', 'Api\User\ProfileController@show');
