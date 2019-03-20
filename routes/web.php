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
Route::get('/provider','HomeController@provider');
Route::get('/provider/{id}','HomeController@show');

//service
Route::get('/service','ServiceController@index')->name('service');
Route::get('/service/my','ServiceController@provider');
Route::get('/service/create','ServiceController@create');
Route::post('/service/create','ServiceController@store');
Route::patch('/service/create','ServiceController@update');
Route::get('/service/destroy/{service}','ServiceController@destroy');
Route::get('/service/search/{service}','ServiceController@s_show');
Route::get('/service/{service}','ServiceController@show');

//request
Route::get('/request','RequestController@index');
Route::get('/request/{service}','RequestController@store');
Route::get('/request/show/{service}','RequestController@show');
Route::get('/request/destroy/{request}','RequestController@destroy');
Route::post('/request/complete','RequestController@patch');
Route::post('/request/accept','RequestController@a_patch');
Route::post('/request/cancel','RequestController@c_patch');

//preference
Route::get('/preference/{service}','PreferenceController@store');
Route::get('/preference/destroy/{service}','PreferenceController@destroy');


//profile
Route::get('/profile','ProfileController@index');
Route::post('/profile','ProfileController@store');
Route::patch('/profile','ProfileController@patch');

//search
Route::get('/search','SearchController@index');
Route::post('/search','SearchController@search');
Route::post('/search/fetch','SearchController@result');

//message
Route::get('/message','MessageController@index');
Route::get('/message/{message}','MessageController@patch');
Route::get('/message/destroy/{message}','MessageController@destroy');

//Locations
Route::post('/location/store','LocationController@store');
Route::get('/location/destroy/{location}','LocationController@delete');


Route::group(['middleware' => ['web']], function () {
    Route::get('payPremium', ['as'=>'payPremium','uses'=>'PaypalController@payPremium']);
    Route::post('getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);
    Route::get('getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
    Route::get('getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);
});

