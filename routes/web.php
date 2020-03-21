<?php

/*
|dahulukan middleware
|
*/

Auth::routes(); 
Route::group(['middleware' => 'auth'], function () {
    Route::resource('quotes', 'QuoteController', ['except' => ['index', 'show']] );
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id?}', 'HomeController@profile')->name('profile');
Route::get('quotes/random', 'QuoteController@random');
Route::resource('quotes', 'QuoteController', ['only' => ['index', 'show']] );
