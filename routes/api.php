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
	Route::post('sendotp', 'App\Http\Controllers\API\EzglamController@sendotp');
	Route::post('user_registration', 'App\Http\Controllers\API\EzglamController@user_registration');
	Route::post('resendotp', 'App\Http\Controllers\API\EzglamController@resendotp');
	Route::post('verifyotp', 'App\Http\Controllers\API\EzglamController@verifyotp');
	Route::post('dashboard', 'App\Http\Controllers\API\EzglamController@dashboard');
	Route::post('services_list', 'App\Http\Controllers\API\EzglamController@services_list');
	Route::get('service_details', 'App\Http\Controllers\API\EzglamController@service_details');
	Route::post('products_list', 'App\Http\Controllers\API\EzglamController@products_list');
	Route::get('cities_list', 'App\Http\Controllers\API\EzglamController@cities_list');
	Route::get('time_slots', 'App\Http\Controllers\API\EzglamController@time_slots');
	Route::post('book_appointment', 'App\Http\Controllers\API\EzglamController@book_appointment');
	Route::post('appointments_list', 'App\Http\Controllers\API\EzglamController@appointments_list');
	Route::get('types_list', 'App\Http\Controllers\API\EzglamController@types_list');
	Route::get('categories_list', 'App\Http\Controllers\API\EzglamController@categories_list');	 
	Route::get('customerwallet_list', 'App\Http\Controllers\API\EzglamController@customerwallet_list');	
	Route::get('customerproducts_list', 'App\Http\Controllers\API\EzglamController@customerproducts_list');	
	Route::get('customerprofile', 'App\Http\Controllers\API\EzglamController@customerprofile');	
	Route::get('updatecartdetails', 'App\Http\Controllers\API\EzglamController@updatecartdetails');	
	Route::post('savecustomercart', 'App\Http\Controllers\API\EzglamController@savecustomercart');	
	Route::get('savecustomercartitem', 'App\Http\Controllers\API\EzglamController@savecustomercartitem');
	Route::get('customer_cart_list', 'App\Http\Controllers\API\EzglamController@customer_cart_list');	
	Route::post('savecustomerorderpayment', 'App\Http\Controllers\API\EzglamController@savecustomerorderpayment');
	Route::post('updatecustomerprofile', 'App\Http\Controllers\API\EzglamController@updatecustomerprofile');
	Route::post('savecustomerfeedback', 'App\Http\Controllers\API\EzglamController@savecustomerfeedback');
	Route::post('cancelappointment', 'App\Http\Controllers\API\EzglamController@cancelappointment');	
	Route::get('referandearn', 'App\Http\Controllers\API\EzglamController@referandearn');	
	Route::get('generateorderid', 'App\Http\Controllers\API\EzglamController@generateorderid');
	Route::post('updatepaymentstatus', 'App\Http\Controllers\API\EzglamController@updatepaymentstatus');	
	Route::get('customerOrders', 'App\Http\Controllers\API\EzglamController@customerOrders');
	Route::get('getcustomerrefcode', 'App\Http\Controllers\API\EzglamController@getcustomerrefcode');
	Route::get('getpaymentkeys', 'App\Http\Controllers\API\EzglamController@getpaymentkeys');
	Route::get('contactcallmaskapi', 'App\Http\Controllers\API\EzglamController@contactcallmaskapi');
	Route::get('sendnotification', 'App\Http\Controllers\API\EzglamController@sendnotification');
	Route::get('cancel_reasons', 'App\Http\Controllers\API\EzglamController@cancel_reasons');
	Route::post('book_appointment_multiservice', 'App\Http\Controllers\API\EzglamController@book_appointment_multiservice');
	Route::post('save_service_cart', 'App\Http\Controllers\API\EzglamController@save_service_cart');
	Route::get('get_servicecart_list', 'App\Http\Controllers\API\EzglamController@get_servicecart_list');
	Route::get('get_useraddress_list', 'App\Http\Controllers\API\EzglamController@get_useraddress_list');
	Route::post('save_user_address', 'App\Http\Controllers\API\EzglamController@save_user_address');
	Route::get('remove_address', 'App\Http\Controllers\API\EzglamController@remove_address');
	
	//PARTNER APIS
	Route::get('partner/payment_modes', 'App\Http\Controllers\API\PartnerController@payment_modes');	
	Route::post('partner/verify_partnercredentials', 'App\Http\Controllers\API\PartnerController@verify_partnercredentials');
	Route::get('partner/partnerservices_list', 'App\Http\Controllers\API\PartnerController@partnerservices_list');
	Route::get('partner/partnerproducts_list', 'App\Http\Controllers\API\PartnerController@partnerproducts_list');
	Route::get('partner/partnerappointments_list', 'App\Http\Controllers\API\PartnerController@partnerappointments_list');
	Route::get('partner/types_list', 'App\Http\Controllers\API\PartnerController@types_list');	
	Route::get('partner/sampletoken', 'App\Http\Controllers\API\PartnerController@sampletoken');
	Route::post('partner/add_service', 'App\Http\Controllers\API\PartnerController@add_service');
	Route::get('partner/delete_service', 'App\Http\Controllers\API\PartnerController@delete_service');
	Route::get('partner/appointment_detailed', 'App\Http\Controllers\API\PartnerController@appointment_detailed');
	Route::get('partner/wallet_list', 'App\Http\Controllers\API\PartnerController@wallet_list');
	Route::get('partner/partner_wallet', 'App\Http\Controllers\API\PartnerController@partner_wallet');
	Route::get('partner/partnerprofile', 'App\Http\Controllers\API\PartnerController@partnerprofile');
	Route::get('partner/updatepartnercartdetails', 'App\Http\Controllers\API\PartnerController@updatepartnercartdetails');
	Route::get('partner/sendappointmentotptocustomer', 'App\Http\Controllers\API\PartnerController@sendappointmentotptocustomer');
	Route::get('partner/resetpasswordotptopartner', 'App\Http\Controllers\API\PartnerController@resetpasswordotptopartner');
	Route::post('partner/updatepartnerpassword', 'App\Http\Controllers\API\PartnerController@updatepartnerpassword');
	Route::post('partner/savepartnercart', 'App\Http\Controllers\API\PartnerController@savepartnercart');
	Route::post('partner/savepatnerorderpayment', 'App\Http\Controllers\API\PartnerController@savepatnerorderpayment');
	Route::post('partner/update_password', 'App\Http\Controllers\API\PartnerController@update_password');
	Route::get('partner/partner_cart_list', 'App\Http\Controllers\API\PartnerController@partner_cart_list');
	Route::get('partner/appointment_detailed', 'App\Http\Controllers\API\PartnerController@appointment_detailed');
	Route::get('partner/updateappointment', 'App\Http\Controllers\API\PartnerController@updateappointment');
	Route::get('partner/confirmpartnerapproval', 'App\Http\Controllers\API\PartnerController@confirmpartnerapproval');
	Route::get('partner/savepartnercartitem', 'App\Http\Controllers\API\PartnerController@savepartnercartitem');
	Route::get('partner/partnercartitemscount', 'App\Http\Controllers\API\PartnerController@partnercartitemscount');
	Route::get('partner/startappointment', 'App\Http\Controllers\API\PartnerController@startappointment');
	Route::get('partner/completeappointment', 'App\Http\Controllers\API\PartnerController@completeappointment');
	Route::get('partner/totalproducts_list', 'App\Http\Controllers\API\PartnerController@totalproducts_list');
	Route::get('partner/cancellation_policy', 'App\Http\Controllers\API\PartnerController@cancellation_policy');
	Route::post('partner/updatepartnerprofile', 'App\Http\Controllers\API\PartnerController@updatepartnerprofile');
	Route::get('partner/paymentmodes', 'App\Http\Controllers\API\PartnerController@paymentmodes');
	Route::get('partner/getpaymentmodedetails', 'App\Http\Controllers\API\PartnerController@getpaymentmodedetails');
	Route::get('partner/getpaymentkeys', 'App\Http\Controllers\API\PartnerController@getpaymentkeys');
	Route::get('partner/generateorderid', 'App\Http\Controllers\API\PartnerController@generateorderid');
	Route::post('partner/updatepaymentstatus', 'App\Http\Controllers\API\PartnerController@updatepaymentstatus');
	Route::get('partner/dashboardbanners', 'App\Http\Controllers\API\PartnerController@dashboardbanners');
});
