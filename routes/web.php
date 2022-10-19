<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','App\Http\Controllers\EduwebController@homepage');

Route::get('/edurxcare_admin','App\Http\Controllers\AnalyticsController@adminLogin');
Route::get('/admindashboard','App\Http\Controllers\AnalyticsController@admindashboard');
Route::get('/changePassword','App\Http\Controllers\AnalyticsController@changePassword');
Route::post('/saveChangePassword','App\Http\Controllers\AnalyticsController@saveChangePassword');



























