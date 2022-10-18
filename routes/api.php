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
Route::post('register', 'App\Http\Controllers\API\RegisterController@register');
Route::post('login', 'App\Http\Controllers\API\RegisterController@login');

Route::middleware('auth:api')->get('api/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group( function () {
	Route::post('user_registration', 'App\Http\Controllers\API\EcareController@user_registration');
	Route::post('check_user_login', 'App\Http\Controllers\API\EcareController@check_user_login');
	Route::post('edit_profile', 'App\Http\Controllers\API\EcareController@edit_profile');
	Route::post('update_profile', 'App\Http\Controllers\API\EcareController@update_profile');
});
