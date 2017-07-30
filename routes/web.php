<?php

use App\Ams\Core\Lib\Route;

Route::set( 'list/activity' , 'ActivityController@index', 'GET' );
Route::set( 'save/activity' , 'ActivityController@save', 'POST' );
Route::set( 'get/activity/:id' , 'ActivityController@show', 'GET' );
Route::set( 'delete/activity/:id' , 'ActivityController@delete', 'DELETE' );
Route::set( 'update/activity/:id' , 'ActivityController@update', 'PUT' );
