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

Route::get('/test','ChannelController@getAllChannels');

Route::get('/channels','ChannelController@getAllChannels');

Route::post('/channel/create','ChannelController@createChannel');

Route::get('checkAuth','UserController@checkAuth')->middleware('auth');

Route::get('/authenticate', function () {
    return view('authenticate');
});
Route::post('/authenticate/join','UserController@join');

Route::post('/authenticate/enter','UserController@enter');

Route::get('/room',function(){
    return view('layouts.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
