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
	Route::post('/locationsList','App\Http\Controllers\API\EcareController@locationsList');
	Route::post('/bloodGroups','App\Http\Controllers\API\EcareController@bloodGroups');
	//save request methods
	Route::post('/newRequest','App\Http\Controllers\API\EcareController@newRequest');
	Route::post('/addMedications','App\Http\Controllers\API\EcareController@addMedications');
	Route::post('/addAllergy','App\Http\Controllers\API\EcareController@addAllergy');
	Route::post('/addMedConditions','App\Http\Controllers\API\EcareController@addMedConditions');
	Route::post('/uploadLabReports','App\Http\Controllers\API\EcareController@uploadLabReports');
	Route::post('/uploadPrescriptions','App\Http\Controllers\API\EcareController@uploadPrescriptions');
	//request list methods
	Route::post('/newRequestDetails','App\Http\Controllers\API\EcareController@newRequestDetails');
	Route::post('/reqMedicationsList','App\Http\Controllers\API\EcareController@reqMedicationsList');
	Route::post('/reqAllergyList','App\Http\Controllers\API\EcareController@reqAllergyList');
	Route::post('/reqMedConditions','App\Http\Controllers\API\EcareController@reqMedConditions');
	Route::post('/reqLabReports','App\Http\Controllers\API\EcareController@reqLabReports');
	Route::post('/reqPrescriptions','App\Http\Controllers\API\EcareController@reqPrescriptions');
	//delete methods
	Route::post('/deleteRequestMedication','App\Http\Controllers\API\EcareController@deleteRequestMedication');
	Route::post('/deleteRequestAllergy','App\Http\Controllers\API\EcareController@deleteRequestAllergy');
	Route::post('/deleteRequestMedcond','App\Http\Controllers\API\EcareController@deleteRequestMedcond');
	Route::post('/deleteLabReport','App\Http\Controllers\API\EcareController@deleteLabReport');
	Route::post('/deletePrescription','App\Http\Controllers\API\EcareController@deletePrescription');
	//Sumbit request
	Route::post('/submitRequest','App\Http\Controllers\API\EcareController@submitRequest');
	Route::post('/savePatientMedication','App\Http\Controllers\API\EcareController@savePatientMedication');

	//Pharmacist APIs
	Route::post('/allNewRequests','App\Http\Controllers\API\EcareController@allNewRequests');

	Route::post('/viewRequestDetails','App\Http\Controllers\API\EcareController@viewRequestDetails');
	Route::post('/updateRequest','App\Http\Controllers\API\EcareController@updateRequest');
	Route::post('/pharmacistRequests','App\Http\Controllers\API\EcareController@pharmacistRequests');
	Route::post('/responseRequest','App\Http\Controllers\API\EcareController@responseRequest');
	Route::post('/saveResponse','App\Http\Controllers\API\EcareController@saveResponse');
	Route::post('/pharmacistAppointments','App\Http\Controllers\API\EcareController@pharmacistAppointments');
	Route::post('/updateAppointmentStatus','App\Http\Controllers\API\EcareController@updateAppointmentStatus');
	Route::post('/newPatientAppointments','App\Http\Controllers\API\EcareController@newPatientAppointments');
	Route::post('/updateNewAppointment','App\Http\Controllers\API\EcareController@updateNewAppointment');
	Route::post('/pharmacistQuestionsList','App\Http\Controllers\API\EcareController@pharmacistQuestionsList');
	Route::post('/savePharmacistQuestion','App\Http\Controllers\API\EcareController@savePharmacistQuestion');
});
