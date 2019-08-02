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
Route::get('/getDataForChart','packetController@getDataForChart');
//Route::get('chart-data', ['uses' => 'YourController@chartApi']);
Route::get('getChartData',['uses' => 'packetController@UpdateChart']);
Route::resource('packet','packetController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
