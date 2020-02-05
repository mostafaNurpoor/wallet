<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'wallet'] , function (){
    Route::get('/test',  'WalletController@test' );
});
//
//Route::group(['prefix' => 'messages' , 'middleware' => 'auth:api'], function () {
//
//    Route::get('/threads', 'MessageController@getChatList');                           // get chat list
//
//    Route::post('/threads', 'MessageController@startNewChat');                          // create chat with user by userId
//
//    Route::get('/threads/{id}', 'MessageController@userThreadInfo');                     // chat info for that user
//
//    Route::get('/threads/{id}/messages/{pages}', 'MessageController@getThreadMessages'); // get user messages in chat by pagination
//
//    Route::post('/threads/{id}/messages', 'MessageController@sendMessage');            // send new message
//
//});
//
//Route::group([
//    'prefix' => 'auth'
//], function () {
//    Route::post('login', 'AuthController@logIn');
//    Route::post('signup', 'AuthController@signup');
//
//    Route::group([
//        'middleware' => 'auth:api'
//    ], function () {
//        Route::get('logout', 'AuthController@logout');
//        Route::get('user', 'AuthController@userData');
//    });
//});

