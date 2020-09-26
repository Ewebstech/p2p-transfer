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

Route::get('/test', function () {
    return "done";
});



Route::get('/signup', function () {
    return view('signup');
});

/**
 * Authentication Routes
 */

Route::get('/email', 'AuthController@viewMailTemplate');

Route::post('/login', 'AuthController@loginUser')->name('login');

Route::get('/login', 'AuthController@loginPage')->name('loginPage');

Route::post('/signup', 'AuthController@registerUser')->name('signup');

Route::get('/account-activation/{param}', 'AuthController@activateAccount');

Route::group(['prefix' => '/', 'middleware' => 'redirectauth'], function(){

    Route::get('services','ServicesController@index')->name('services');

    Route::post('payment','ServicesController@payment')->name('payment');

    Route::post('takePayment','WalletController@takePayment')->name('takePayment');

    Route::get('fundmywallet','WalletController@fundWalletPage')->name('fundmywallet');

    Route::get('history','TransactionsController@getTransactionHistoryPage')->name('history');

    Route::get('profile','ProfileController@getProfileData')->name('profile');

    Route::get('change-password','ProfileController@changePassword')->name('change-password');

    Route::post('change-password','ProfileController@changePassword')->name('change-password');

    Route::post('history','TransactionsController@getTransactionHistoryPage')->name('history');

    Route::get('payment-complete','ServicesController@paymentCompleted');

    Route::post('confirm-purchase','ServicesController@confirmPurchase')->name('cp');

    Route::get('dashboard','DashboardController@index')->name('Dashboard');

    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('getPlans','ServicesController@getDataPlans')->name('getPlans');

    Route::get('getTvPlans','ServicesController@getTvPlans')->name('getTvPlans');



});

Route::get('/payment/callback', 'PaystackController@handleGatewayCallback');


