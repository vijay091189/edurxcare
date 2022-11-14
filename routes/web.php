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
//frontend routes
Route::get('/','App\Http\Controllers\EduwebController@homepage');
Route::get('/loginpage','App\Http\Controllers\EduwebController@loginpage');
Route::get('/signup','App\Http\Controllers\EduwebController@signup');
Route::get('/category','App\Http\Controllers\EduwebController@category');
Route::get('/signupForm','App\Http\Controllers\EduwebController@signupForm');
Route::post('/registerUser','App\Http\Controllers\EduwebController@registerUser');
Route::post('/checkUserLogin','App\Http\Controllers\EduwebController@checkUserLogin');

//dashboard apis after login
Route::get('/patientDashboard','App\Http\Controllers\EduwebController@patientDashboard');
Route::get('/phamacistDashboard','App\Http\Controllers\EduwebController@signphamacistDashboardupForm');
Route::get('/newRequest','App\Http\Controllers\EduwebController@newRequest');
Route::post('/saveNewRequest','App\Http\Controllers\EduwebController@saveNewRequest');
Route::get('/add_requestmedications','App\Http\Controllers\EduwebController@add_requestmedications');

//Admin routes
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
Route::post('/saveMedication','App\Http\Controllers\AnalyticsController@saveMedication');
Route::post('/saveAllergies','App\Http\Controllers\AnalyticsController@saveAllergies');
Route::post('/saveMedConditions','App\Http\Controllers\AnalyticsController@saveMedConditions');
Route::get('/updateUserStatus','App\Http\Controllers\AnalyticsController@updateUserStatus');
Route::get('/deleteMedicines','App\Http\Controllers\AnalyticsController@deleteMedicines');
Route::get('/deleteAllergies','App\Http\Controllers\AnalyticsController@deleteAllergies');
Route::get('/deleteMedConditions','App\Http\Controllers\AnalyticsController@deleteMedConditions');
Route::get('/faqsList','App\Http\Controllers\AnalyticsController@faqsList');
Route::get('/patientQuestions','App\Http\Controllers\AnalyticsController@patientQuestions');
Route::get('/pharmacistQuestions','App\Http\Controllers\AnalyticsController@pharmacistQuestions');
Route::post('/saveFaq','App\Http\Controllers\AnalyticsController@saveFaq');
Route::post('/savePatientQuestion','App\Http\Controllers\AnalyticsController@savePatientQuestion');
Route::post('/savePharmacistQuestion','App\Http\Controllers\AnalyticsController@savePharmacistQuestion');
Route::get('/deleteFaq','App\Http\Controllers\AnalyticsController@deleteFaq');
Route::get('/deletePatientQuestion','App\Http\Controllers\AnalyticsController@deletePatientQuestion');
Route::get('/deletePharmacistQuestion','App\Http\Controllers\AnalyticsController@deletePharmacistQuestion');
Route::get('/appUsersList','App\Http\Controllers\AnalyticsController@appUsersList');
Route::get('/logout','App\Http\Controllers\AnalyticsController@logout');


























