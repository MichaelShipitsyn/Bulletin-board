<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');
