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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resources([
    'events' => 'EventController',
]);

Route::resource('events.shows', 'ShowController')
    ->only(['index', 'create', 'store']);

Route::resource('shows', 'ShowController')
    ->only(['show', 'edit', 'update', 'destroy']);