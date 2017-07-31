<?php

use App\Ams\Core\Lib\Route;

Route::set( '', 'ActivityController@main', 'GET' );

Route::set( 'activity' , 'ActivityController@index', 'GET' );
Route::set( 'activity' , 'ActivityController@save', 'POST' );
Route::set( 'activity/:id' , 'ActivityController@show', 'GET' );
Route::set( 'activity/:id' , 'ActivityController@delete', 'DELETE' );
Route::set( 'activity/:id' , 'ActivityController@update', 'PUT' );
