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
Route::post('/checkLogin','App\Http\Controllers\AnalyticsController@checkLogin');
Route::get('/admindashboard','App\Http\Controllers\AnalyticsController@admindashboard');
Route::get('/changePassword','App\Http\Controllers\AnalyticsController@changePassword');
Route::post('/saveChangePassword','App\Http\Controllers\AnalyticsController@saveChangePassword');

Route::get('/patientslist','App\Http\Controllers\AnalyticsController@patientslist');
Route::get('/pharmacistslist','App\Http\Controllers\AnalyticsController@pharmacistslist');
Route::get('/requestslist','App\Http\Controllers\AnalyticsController@requestslist');
Route::get('/appointmentslist','App\Http\Controllers\AnalyticsController@appointmentslist');
Route::get('/medicationslist','App\Http\Controllers\AnalyticsController@medicationslist');
Route::get('/allergies','App\Http\Controllers\AnalyticsController@allergies');
Route::get('/medicalconditions','App\Http\Controllers\AnalyticsController@medicalconditions');




























