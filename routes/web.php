<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', ['as' => 'homepage', 'uses' => 'TransactionController@index']);
Route::post('/', ['as' => 'store', 'uses' => 'TransactionController@store']);
Route::get('/transactions', ['as' => 'view', 'uses' => 'TransactionController@view']);
Route::any('/transactions/export', ['as' => 'export', 'uses' => 'TransactionController@export']);