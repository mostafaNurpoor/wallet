<?php

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

Route::group(['prefix' => 'wallet' , 'middleware' => 'auth:api'] , function (){

    Route::post('/charge',  'WalletController@chargeWallet' );

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
