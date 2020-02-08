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

Route::group(['prefix' => 'transaction' , 'middleware' => 'auth:api'], function () {

    Route::post('/create' , 'TransactionController@create');

    Route::get('/userTransactions/{page}' , 'TransactionController@userTransactions');

    Route::any('/verify/{paymentId}' , 'TransactionController@verify');

    Route::post('/provideIntegers' , 'TransactionController@gateWaysCallBacks');

});
