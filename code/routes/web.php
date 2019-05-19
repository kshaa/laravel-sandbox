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

Route::get('/', 'EventsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('event', 'EventsController', ['except' => ['edit', 'update', 'destroy']]);    
Route::get('admin', 'AdminController');
Route::resource('category', 'CategoryController', ['only' => ['create', 'store']]);
Route::resource('ticket', 'TicketsController', ['only' => ['create', 'store']]); 
Route::get('events/search','EventsController@getSearch');
Route::post('events/search','EventsController@postSearch');
Route::get('cart', 'CartController@index');
Route::get('cart/add/{id}', 'CartController@add');
Route::get('cart/remove/{id}', 'CartController@remove');

Route::get('orders', 'OrderController@listing');
Route::get('orders/info/{id}', 'OrderController@details');
Route::get('orders/create', 'OrderController@create');
Route::post('orders/place', 'OrderController@store', [ 'middleware' => 'web' ]);