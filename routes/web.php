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
//Users
Route::get('getAuthUser','UserController@getAuthUser');

Route::get('users', 'UserController@getAllUsers');
//Route::get('/test','ChannelController@getAllChannels');

Route::get('checkAuth','UserController@checkAuth')->middleware('auth');

Route::get('/authenticate', function () {
    return view('authenticate');
});
Route::post('/authenticate/join','UserController@join');

Route::post('/authenticate/enter','UserController@enter');


//Channels
Route::get('/channels','ChannelController@getAllChannels');

Route::post('/channels/users-mask/check','ChannelController@checkUsersMask');

Route::get('channel-join/{channelId}', 'ChannelController@joinChannel');

Route::post('/channels/create','ChannelController@createChannel');

//Messages
Route::get('channel-messages/{id}','ChannelController@channelMessages');

//Route::get('checkJoined/{channelId}', 'ChannelController@checkJoined');

Route::post('/messages/create','MessageController@createMessage');


Route::get('/room',function(){
    return view('layouts.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
