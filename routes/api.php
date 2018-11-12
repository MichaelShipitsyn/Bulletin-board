<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Api\HomeController@home');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
