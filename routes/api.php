<?php

use Illuminate\Http\Request;

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
/**
 * Authentication Routes
 */

Route::post('/signup', 'AuthController@registerUser');
Route::post('/login', 'AuthController@loginUser');

Route::group(['prefix' => '/wallet', 'middleware' => 'jwt-auth'], function () {
    Route::post('fund-wallet', 'WalletController@fundWallet');
    Route::post('wallet-balance', 'WalletController@fetchMyBalance');
});

Route::group(
    ['prefix' => '/transfer', 'middleware' => 'jwt-auth'],
    function () {
        Route::post('transfer-to-peer', 'ServicesController@transferToPeer');
    }
);
