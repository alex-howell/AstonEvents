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
    return view('index');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('events', 'EventController@events');
Route::post('events','EventController@filter');

Route::get('event/{id}', 'EventController@show');
Route::post('event/{id}','EventController@like');

Route::get('/myevents','EventController@index')->name('display_events');

Route::get('/myevents/create','EventController@create');
Route::post('myevents/create', 'EventController@store');

Route::get('myevents/edit/{id}', 'EventController@edit');
Route::post('myevents/edit/{id}','EventController@update');
Route::get('myevents/delete/{id}','EventController@destroy');

//Authentication Routes
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
