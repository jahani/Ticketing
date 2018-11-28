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


Route::get('events/mine', 'EventController@mine')
    ->name('events.mine')->middleware('auth');

Route::resources([
    'events' => 'EventController',
]);

Route::resource('events.shows', 'ShowController')
    ->only(['index', 'create', 'store']);

Route::resource('shows', 'ShowController')
    ->only(['show', 'edit', 'update', 'destroy']);

Route::group(['prefix' => 'reserves'], function() {
    Route::get('show/{show}/section/{section}', 'ReserveController@show')
        ->name('reserves.show');
    Route::get('show/{show}/seat/{seat}/store', 'ReserveController@store')
        ->name('reserves.store');
    Route::get('show/{show}/seat/{seat}/destroy', 'ReserveController@destroy')
        ->name('reserves.destroy');
});

Route::group(['prefix' => 'sectionshows'], function() {
    Route::post('show/{show}', 'SectionShowController@store')
        ->name('sectionshows.shows.store');
});