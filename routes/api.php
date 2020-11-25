<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});


Route::get('noticias', 'NoticiaController@index');

Route::get('producto/pdf/{filename}', 'ProductoController@showPDF');

Route::get('noticias', 'NoticiaController@index');
Route::get('noticias/{id}', 'NoticiaController@show');

Route::get('producto', 'ProductoController@index');
Route::get('producto/{id}', 'ProductoController@show');

Route::get('clase', 'ClaseController@index');
Route::get('clase/{id}', 'ClaseController@show');

Route::post('contact', 'MailController@sendMailContact');

Route::group(['middleware' => 'auth:api'], function () {

	Route::post('producto', 'ProductoController@store');
	Route::delete('producto/{id}', 'ProductoController@destroy');

	Route::post('clase', 'ClaseController@store');
	Route::delete('clase/{id}', 'ClaseController@destroy');
});
