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
	Route::post('change_password', 'App\Http\Controllers\API\EcareController@change_password');
	Route::post('forgot_password', 'App\Http\Controllers\API\EcareController@forgot_password');
	Route::post('save_forgot_password', 'App\Http\Controllers\API\EcareController@save_forgot_password');
	Route::post('patient_lifestyle_questions', 'App\Http\Controllers\API\EcareController@patient_lifestyle_questions');
	Route::post('save_patient_lifestyle', 'App\Http\Controllers\API\EcareController@save_patient_lifestyle');
	Route::post('search_medicines', 'App\Http\Controllers\API\EcareController@search_medicines');
	Route::post('seacrh_allergies', 'App\Http\Controllers\API\EcareController@seacrh_allergies');
	Route::post('search_medicalconditions', 'App\Http\Controllers\API\EcareController@search_medicalconditions');
	Route::post('save_request', 'App\Http\Controllers\API\EcareController@save_request');

	Route::post('patient_requests', 'App\Http\Controllers\API\EcareController@patient_requests');
	Route::post('/patientRecommendations','App\Http\Controllers\API\EcareController@patientRecommendations');
	Route::post('/patientFaqs','App\Http\Controllers\API\EcareController@patientFaqs');
	Route::post('/patientNotifications','App\Http\Controllers\API\EcareController@patientNotifications');
	Route::post('/pillReminders','App\Http\Controllers\API\EcareController@pillReminders');
	Route::post('/viewRequestResponse','App\Http\Controllers\API\EcareController@viewRequestResponse');
	Route::post('/patientAppointments','App\Http\Controllers\API\EcareController@patientAppointments');
	Route::post('/saveAppointment','App\Http\Controllers\API\EcareController@saveAppointment');
	Route::post('/saveReviewRating','App\Http\Controllers\API\EcareController@saveReviewRating');
	Route::post('/saveReferFriend','App\Http\Controllers\API\EcareController@saveReferFriend');
});
