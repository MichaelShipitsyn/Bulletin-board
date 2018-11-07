<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(
    [
        'prefix' => 'cabinet',
        'as' => 'cabinet.',
        'namespace' => 'Cabinet',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/profile', 'ProfileController@index')->name('profile.home');
        Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
    }
);

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('users', 'UsersController');
        Route::post('/users/{user}/verify', 'UsersController@verify')->name('users.verify');

        Route::resource('regions', 'RegionController');
    }
);