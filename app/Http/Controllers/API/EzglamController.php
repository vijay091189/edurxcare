<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use DB, Config;
use App\Helpers\Helper as Helper; 
use App\Helpers\EncDecHelper;
use Razorpay\Api\Api;


ini_set('max_execution_time', '3000000'); //300 seconds = 5 minutes

class EzglamController extends BaseController
{

	public function sendotp(Request $request){
		$input = $request->all();			
		$mobile='';
		if(isset($input['mobile'])){
			$mobile = $input['mobile'];
		}

		$token='';
		if(isset($input['token'])){
			$token = $input['token'];
		}
		if($mobile=='9999999999'){
			$otp = 123456;
		} else {
			$otp = rand(100000,999999);
		}
		
		$checkMobileExists = DB::select("SELECT mobile_number_id FROM mobile_numbers m inner join app_users a on a.mobile=m.mobile_number_id where mobile_number='".$mobile."'");
		$config_data = DB::Table("config_data")->select("customer_email","customer_phone")->first();
		$customer_email = $config_data->customer_email!=''?$config_data->customer_email:'--';
		$customer_phone = $config_data->customer_phone!=''?$config_data->customer_phone:'--';
		if(count($checkMobileExists)==0){
			$insert_data['mobile_number'] = $mobile;
			$insert_data['otp'] = $otp;
			$insert_data['created_date'] = date('Y-m-d H:i:s');
			$checkUserLogin = DB::table('mobile_numbers')->insertGetId($insert_data);
			
			$message = "Dear Customer, Your OTP verification key for EZGLAM Registration is $otp and expires in 15 min Thank You EZGLAM Team	";
		
			$encpassword = EncDecHelper::sendsms($mobile,$message);		
			
			$insert_data1['user_id'] = "0";
			$insert_data1['mobile_number_id'] = $checkUserLogin;
			$insert_data1['otp'] = $otp;
			$insert_data1['type'] = "register";
			$insert_data1['created_date'] = date('Y-m-d H:i:s');
			$customer_otp_id = DB::table('customer_otps')->insertGetId($insert_data1);
			
			
			$res_data = array(
				"msg"=>"OTP sent successfully",
				"otp"=>(string)$otp, 
				"customer_otp_id"=>(string)$customer_otp_id,
				"mobile_number_id"=>(string)$checkUserLogin,
				"original_number"=>$mobile,
				"status"=>"Success",
				"user_id"=>'', 
				"first_name"=>'', 
				"last_name"=>'', 
				"role_id"=>'', 
				"email"=>'', 
				"mobile"=>'', 
				"gender"=>'', 
				"address"=>'', 
				"city"=>'', 
				"profile_image"=>'',
				"latitude"=>'', 
				"longitude"=>'',
				"referral_code"=>'',
				"key_id"=>Config::get('constants.options.api_key'),
				"key_secret"=>Config::get('constants.options.api_secret'),
				"customer_email"=>$customer_email,
				"customer_phone"=>$customer_phone
			);
		} else {
			
			$message = "Dear Customer, Your OTP verification key for EZGLAM Login is $otp and expires in 15 min Thank You EZGLAM Team";
		
			$encpassword = EncDecHelper::sendsms($mobile,$message);		
			
			$getUserDetails = DB::select("SELECT * FROM app_users where mobile='".$checkMobileExists[0]->mobile_number_id."'");
			
			$getmobilenumber = DB::select("SELECT * FROM mobile_numbers where mobile_number_id='".$checkMobileExists[0]->mobile_number_id."'");
			
			$update_data['fcm_token_id'] = $token;
			$update_user = DB::table('app_users')->where('mobile',$checkMobileExists[0]->mobile_number_id)->update($update_data);
			
			$insert_data1['user_id'] = $getUserDetails[0]->user_id;
			$insert_data1['mobile_number_id'] = $checkMobileExists[0]->mobile_number_id;
			$insert_data1['otp'] = $otp;
			$insert_data1['type'] = "login";
			$insert_data1['created_date'] = date('Y-m-d H:i:s');
			$customer_otp_id = DB::table('customer_otps')->insertGetId($insert_data1);
			
			$res_data = array(
				"msg"=>"OTP sent successfully",
				"otp"=>(string)$otp, 
				"customer_otp_id"=>(string)$customer_otp_id,
				"mobile_number_id"=>(string)$checkMobileExists[0]->mobile_number_id,
				"original_number"=>$getmobilenumber[0]->mobile_number,
				"status"=>"Success",
				"user_id"=>isset($getUserDetails[0])?$getUserDetails[0]->user_id:'', 
				"first_name"=>isset($getUserDetails[0])?$getUserDetails[0]->first_name:'', 
				"last_name"=>isset($getUserDetails[0])?$getUserDetails[0]->last_name:'', 
				"role_id"=>isset($getUserDetails[0])?$getUserDetails[0]->role_id:'', 
				"email"=>isset($getUserDetails[0])?$getUserDetails[0]->email:'', 
				"mobile"=>isset($getUserDetails[0])?$getUserDetails[0]->mobile:'', 
				"gender"=>isset($getUserDetails[0])?$getUserDetails[0]->gender:'', 
				"address"=>isset($getUserDetails[0])?$getUserDetails[0]->address:'', 
				"city"=>isset($getUserDetails[0])?$getUserDetails[0]->city:'', 
				"profile_image"=>$getUserDetails[0]->user_image!=''?url('/').'/public/images/'.$getUserDetails[0]->user_image:'', 
				"latitude"=>isset($getUserDetails[0])?$getUserDetails[0]->latitude:'', 
				"longitude"=>isset($getUserDetails[0])?$getUserDetails[0]->longitude:'',
				"referral_code"=>isset($getUserDetails[0])?$getUserDetails[0]->referral_code:'',
				"key_id"=>Config::get('constants.options.api_key'),
				"key_secret"=>Config::get('constants.options.api_secret'),
				"customer_email"=>$customer_email,
				"customer_phone"=>$customer_phone
			);
		}
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}	

	public function user_registration(Request $request){
		$input = $request->all();			
		$first_name='';
		if(isset($input['first_name'])){
			$first_name = $input['first_name'];
		}	
		$last_name='';
		if(isset($input['last_name'])){
			$last_name = $input['last_name'];
		}	
		$mobile_number_id='';
		if(isset($input['mobile_number_id'])){
			$mobile_number_id = $input['mobile_number_id'];
		}	
		$email='';
		if(isset($input['email'])){
			$email = $input['email'];
		}	
		$gender='';
		if(isset($input['gender'])){
			$gender = $input['gender'];
		}	
		$dob='';
		if(isset($input['dob'])){
			$dob = $input['dob'];
		}	
		$latitude='';
		if(isset($input['latitude'])){
			$latitude = $input['latitude'];
		}
		$longitude='';
		if(isset($input['longitude'])){
			$longitude = $input['longitude'];
		}
		$address='';
		if(isset($input['address'])){
			$address = $input['address'];
		}
		$city='';
		if(isset($input['city'])){
			$city = $input['city'];
		}
		$token='';
		if(isset($input['token'])){
			$token = $input['token'];
		}
		$user_referral_code='';
		if(isset($input['referral_code'])){
			$user_referral_code = $input['referral_code'];
		}
		
		$role_id=3;
		$user_data['first_name'] = $first_name;
		$user_data['last_name'] = $last_name;
		$user_data['role_id'] = $role_id;
		$user_data['email'] = $email;
		$user_data['mobile'] = $mobile_number_id;
		$user_data['gender'] = $gender;
		$user_data['address'] = $address;
		$user_data['city'] = $city;
		$user_data['registered_date'] = date('Y-m-d H:i:s');
		$user_data['status'] = 1;
		$user_data['latitude'] = $latitude;
		$user_data['fcm_token_id'] = $token;
		$user_data['dob'] = $dob;
		$user_data['longitude'] = $longitude;
		$user_data['redeem_points'] = 0;
		$insert_user = DB::table('app_users')->insertGetId($user_data);
		$config_data = DB::select("SELECT customer_referral_bonus_points,referral_join_bonus FROM config_data");
		if($insert_user>0){
			$new_referral_code = strtoupper($this->random_strings(6)).$insert_user;
			$referred_by = NULL;
			$points_count = NULL;
			if($user_referral_code!=''){
				$getUserDetails = DB::select("SELECT user_id,redeem_points,total_points FROM app_users where referral_code='".$user_referral_code."'");
				if(isset($getUserDetails[0]) && $getUserDetails[0]->user_id!=''){
					
					if(isset($config_data[0]) && $config_data[0]->customer_referral_bonus_points!=''){
						//update user points
						$update_points_data['total_points'] = (int)$getUserDetails[0]->total_points+(int)$config_data[0]->customer_referral_bonus_points;
						$update_points = DB::table('app_users')->where('user_id',$getUserDetails[0]->user_id)->update($update_points_data);
						//insert history record
						$points_data['customer_user_id'] = $getUserDetails[0]->user_id;
						$points_data['points'] = $config_data[0]->customer_referral_bonus_points;
						$points_data['type'] = 'bonus';
						$points_data['created_date'] = date('Y-m-d H:i:s');
						$points_data['available_points'] = (int)$getUserDetails[0]->redeem_points+(int)$config_data[0]->customer_referral_bonus_points;
						$points_data['credit_type'] = 'credit';
						$insert_user_points = DB::table('customer_points_history')->insertGetId($points_data);
						$referred_by=$getUserDetails[0]->user_id;
						
						
					}
				}
			}	
			//insert history record
			$points_data_new['customer_user_id'] = $insert_user;
			$points_data_new['points'] = $config_data[0]->referral_join_bonus;
			$points_data_new['type'] = 'bonus';
			$points_data_new['created_date'] = date('Y-m-d H:i:s');
			$points_data_new['available_points'] = $config_data[0]->referral_join_bonus;
			$points_data_new['credit_type'] = 'credit';
			$insert_user_points1 = DB::table('customer_points_history')->insertGetId($points_data_new);
			$points_count = $config_data[0]->referral_join_bonus;

			$update_data['total_points'] = $points_count;
			$update_data['referred_by'] = $referred_by;
			$update_data['referral_code'] = $new_referral_code;
			$update_user = DB::table('app_users')->where('user_id',$insert_user)->update($update_data);
			$res_data = array(
				"msg"=>"You have registered successfully",
				"status"=>"Success",
				"user_id"=>(string)$insert_user,
				"first_name"=>$first_name,
				"last_name"=>$last_name,
				"role_id"=>(string)$role_id,
				"email"=>$email,
				"address"=>$address,
				"city"=>$city,
				"latitude"=>$latitude,
				"longitude"=>$longitude,
				"referral_code"=>$new_referral_code
			);
			return $this->sendResponse($res_data, 'Data fetched successfully.');
		}else{
			$res_data = array("msg"=>"Something went wrong. Please try again","status"=>"Failed");
			return $this->sendError($res_data, 'Data Failed.');	
		}					
	}	

	public function verifyotp(Request $request){
				
		$input = $request->all();			
		
		$customer_otp_id='';
		if(isset($input['customer_otp_id'])){
			$customer_otp_id = $input['customer_otp_id'];
		}	
		
		$mobile='';
		if(isset($input['mobile'])){
			$mobile = $input['mobile'];
		}
		
		$otp='';
		if(isset($input['otp'])){
			$otp = $input['otp'];
		}	
		$customer_otp_id = DB::select("select otp from customer_otps where customer_otp_id='".$customer_otp_id."' and otp='".$otp."'");
		if(count($customer_otp_id)>0){			
			$checkUserLogin = DB::select("select user_id from app_users where mobile='".$mobile."'");
			if(count($checkUserLogin)>0){	
				$update_data['status'] = 1;
				$update_user = DB::table('app_users')->where('user_id',$checkUserLogin[0]->user_id)->update($update_data);
				$res_data = array("msg"=>"OTP verified successfully","status"=>"Success","user_id"=>$checkUserLogin[0]->user_id);
			}else{
				$res_data = array("msg"=>"OTP verified successfully","status"=>"Success","user_id"=>0);
			}
			
			return $this->sendResponse($res_data, 'Data fetched successfully.');
		}else{
			$res_data = array("msg"=>"OTP Authenticate failed","status"=>"Failed","user_id"=>"0");
			return $this->sendError($res_data, 'Data Failed.');	
		}					
	}	
	
	
	public function resendotp(Request $request){
				
		$input = $request->all();			
		
		$mobile='';
		if(isset($input['mobile'])){
			$mobile = $input['mobile'];
		}
		
		$otp = rand(100000,999999);
		
		$checkUserLogin = DB::select("select user_id from app_users where mobile='".$mobile."'");
		
		
		$insert_data1['user_id'] = $checkUserLogin[0]->user_id;
		$insert_data1['mobile_number_id'] = $mobile;
		$insert_data1['otp'] = $otp;
		$insert_data1['type'] = "register";
		$insert_data1['created_date'] = date('Y-m-d H:i:s');
		$customer_otp_id = DB::table('customer_otps')->insertGetId($insert_data1);
	
		$res_data = array("msg"=>"OTP sent successfully","status"=>"Success","customer_otp_id"=>$customer_otp_id,"mobile"=>$mobile,"otp"=>$otp);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
						
	}

	public function dashboard(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$services_list = DB::select("select * from services where status='1'");
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['service_id'] = $services_lis->service_id;
			$services_data[$skey]['service_name'] = $services_lis->service_name;
			$services_data[$skey]['image'] = url('/').'/images/'.$services_lis->image;
			$services_data[$skey]['price_per_unit'] = $services_lis->price_per_unit;
			$services_data[$skey]['discount_perent'] = $services_lis->discount_perent;
			$services_data[$skey]['service_description'] = $services_lis->service_description;
			$services_data[$skey]['estimated_time'] = $services_lis->estimated_time."min";
			$services_data[$skey]['service_rating'] = '3';
			$skey++;
		}
		$res_data['services_list'] = $services_data;
		$res_data['top_pick_list'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}	

	public function services_list(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$category_id='';
		if(isset($input['category_id'])){
			$category_id = $input['category_id'];
		}	
		
		$type='';
		if(isset($input['type'])){
			$type = $input['type'];
		}	
		$type_id='';
		if(isset($input['type_id'])){
			$type_id = $input['type_id'];
		}	
		$today = date('Y-m-d');
		if($type == 'topservices'){
			$services_list = DB::select("select s.service_id,s.service_description,s.service_name,s.image,price_per_unit,discount_perent,
											estimated_time,s.customer_referral_points,asct.appointment_services_cart_id from services s 
											left join service_categories sc on s.service_id=sc.service_id 
											left join (select service_id,appointment_services_cart_id from appointment_services_cart where user_id='$user_id' and status=1 and 
											DATE(created_date)='$today' and appointment_id is null group by service_id) as asct on asct.service_id=s.service_id
											left join categories c on c.category_id=sc.category_id where s.status='1' and c.type_id='".$type_id."' 
											order by asct.appointment_services_cart_id desc limit 5");
		}else if($type == 'all'){
			$services_list = DB::select("select s.service_id,s.service_description,s.service_name,s.image,price_per_unit,discount_perent,
											estimated_time,s.customer_referral_points,asct.appointment_services_cart_id from services s 
											left join service_categories sc on s.service_id=sc.service_id
											left join (select service_id,appointment_services_cart_id from appointment_services_cart where user_id='$user_id' and status=1 and 
											DATE(created_date)='$today' and appointment_id is null group by service_id) as asct on asct.service_id=s.service_id 
											left join categories c on c.category_id=sc.category_id where s.status='1' and c.type_id='".$type_id."'
											order by asct.appointment_services_cart_id desc");
		} else {
			$services_list = DB::select("select s.service_id,s.service_description,s.service_name,s.image,price_per_unit,discount_perent,
											estimated_time,s.customer_referral_points,asct.appointment_services_cart_id from services s 
											left join service_categories sc on s.service_id=sc.service_id
											left join (select service_id,appointment_services_cart_id from appointment_services_cart where user_id='$user_id' and status=1 and 
											DATE(created_date)='$today' and appointment_id is null group by service_id) as asct on asct.service_id=s.service_id 
											left join categories c on c.category_id=sc.category_id where sc.category_id='".$category_id."' and s.status='1'
											order by asct.appointment_services_cart_id desc");
		}	
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['service_id'] = $services_lis->service_id;
			$services_data[$skey]['service_name'] = $services_lis->service_name;
			$services_data[$skey]['image'] = ($services_lis->image!='')?url('/').'/public/images/'.$services_lis->image:url('/').'/public/images/services/service_image-1629226307.jpg';
			$services_data[$skey]['price_per_unit'] = $services_lis->price_per_unit;
			$services_data[$skey]['service_description'] = $services_lis->service_description;
			$services_data[$skey]['discount_perent'] = $services_lis->discount_perent;
			$services_data[$skey]['estimated_time'] = $services_lis->estimated_time."min";
			$services_data[$skey]['product_name'] =  "";
			$services_data[$skey]['product_image'] =  "";
			$services_data[$skey]['brand_name'] =  "";
			$services_data[$skey]['customer_referral_points'] = $services_lis->customer_referral_points!=''?(string)$services_lis->customer_referral_points:'0';
			//$services_data[$skey]['product_name'] = $services_lis->product_name;
			//$services_data[$skey]['product_image'] = url('/').'/public/images/'.$services_lis->product_image;
			//$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			if($services_lis->discount_perent>0){
				$discount_amount = $services_lis->discount_perent*$services_lis->price_per_unit/100;
				$discount_price = $services_lis->price_per_unit - $discount_amount;
			} else {
				$discount_price = '0';
			}
			$services_data[$skey]['discount_price'] = (string)$discount_price;
			$services_data[$skey]['service_rating'] = '3';
			$services_data[$skey]['is_cart_service'] = $services_lis->appointment_services_cart_id!=''?'1':'0';
			$skey++;
		}
		$res_data = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}	
	

	public function customer_cart_list(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
				
		$services_list = DB::select("select ps.customer_cart_id,p.product_id,p.product_name,p.product_image,p.brand_name,
								p.originalprice,ps.no_of_items,p.discount,p.no_of_items as quantity,p.deduct_redeem_points from products p 
								inner join customer_carts ps on p.product_id=ps.product_id 
								where user_id='".$user_id."' and ps.status='0' and ps.no_of_items>0
								order by ps.customer_cart_id desc");
		//$userpoints = DB::select("select sum(points) as points from customer_points_history where customer_user_id='".$user_id."'");
		$pendingpoints = DB::select("select sum(total_points) as points,sum(no_of_items) as cartitems from customer_carts where user_id='".$user_id."' and status=0");
		$skey=0;
		$services_data=array();
		$actual_amount = 0;
		$discount_amount = 0;
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['customer_cart_id'] = (string)$services_lis->customer_cart_id;
			$services_data[$skey]['product_id'] = (string)$services_lis->product_id;
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['description'] = $services_lis->product_name;
			$services_data[$skey]['image'] = ($services_lis->product_image!='')?url('/').'/public/images/'.$services_lis->product_image:url('/').'/public/images/services/service_image-1629226307.jpg';
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['no_of_items'] = $services_lis->no_of_items;
			$services_data[$skey]['product_cart_count'] = (string)$services_lis->no_of_items;
			$services_data[$skey]['quantity'] = $services_lis->quantity;
			$services_data[$skey]['actuval_product_price'] = (string)(int)$services_lis->originalprice;			
			$services_data[$skey]['actuval_product_points'] = (string)(int)$services_lis->deduct_redeem_points;		
			$prod_dis_price = $services_data[$skey]['actuval_product_price']-(($services_data[$skey]['actuval_product_price']*$services_lis->discount)/100);
			$services_data[$skey]['discount_product_price'] = (string)ceil($prod_dis_price);
			$skey++;
		}
		
		$checkUserLogin3 = DB::select("select ifnull(total_points,0) as total_points from app_users where user_id='".$user_id."'");

		$getcartmounts = DB::select("select sum(original_price) as total_original_price, sum(total_amount) as total_discount_price from (
									SELECT (p.originalprice*cc.no_of_items) as original_price, total_amount FROM customer_carts cc 
									inner join products p on p.product_id=cc.product_id
									where cc.user_id='".$user_id."' and cc.status=0 and cc.no_of_items>0) as tab");
		$remaining_points = $checkUserLogin3[0]->total_points-$pendingpoints[0]->points;
		$res_data['total_points'] = ($remaining_points>0)?$remaining_points:0;
		$res_data['partner_services'] = $services_data;
		$res_data['total_original_price'] = ($getcartmounts[0]->total_original_price!='')?(string)$getcartmounts[0]->total_original_price:'0';
		$res_data['total_discount_price'] = ($getcartmounts[0]->total_discount_price!='')?(string)$getcartmounts[0]->total_discount_price:'0';
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	

   	public function updatecartdetails(Request $request){
		$input = $request->all();			
		$customer_cart_id='';
		if(isset($input['customer_cart_id'])){
			$customer_cart_id = $input['customer_cart_id'];
		}	
		
		$no_of_items='';
		if(isset($input['no_of_items'])){
			$no_of_items = $input['no_of_items'];
		}	

		// $getproducts = DB::SELECT("select originalprice,discount from customer_carts c inner join products p on c.product_id=p.product_id where c.customer_cart_id=".$customer_cart_id);
		
		// if($no_of_items == '0'){			
		// 	DB::table('customer_carts')->where('customer_cart_id', $customer_cart_id)->delete();			
			
		// }else{
		
		// $insert_data1['no_of_items'] = $no_of_items;
		// $insert_data1['total_amount'] = $getproducts[0]->originalprice*$no_of_items;
		// $insert_data1['total_points'] = $getproducts[0]->discount*$no_of_items;
		// $insert_data1['updated_date'] = date('Y-m-d H:i:s');
		// $insert_data1['status'] = "0";	
		
		// $insert_user = DB::table('customer_carts')->where('customer_cart_id',$customer_cart_id)->update($insert_data1);
		
		// }
		
		$res_data = array(
				"msg"=>"Product cart Updated successfully",
				"status"=>"Success"
			);			
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}	

	
	
	public function savecustomercart(Request $request){
		$input = $request->all();			
		$cartItems='';
		if(isset($input['cartItems'])){
			$cartItems = $input['cartItems'];
		}	

		$sno=0;
		$cartuser_id=0;
		$total_points = 0;
		foreach($cartItems as $cartItem){
		
		$getproducts = DB::table('products')->select("originalprice","discount")->where('product_id',$cartItem['product_id'])->first();
		
			
		//var_dump($get_user->service_id);
		
		$insert_data1['user_id'] = $cartItem['user_id'];	
		$insert_data1['product_id'] = $cartItem['product_id'];	
		$insert_data1['no_of_items'] = $cartItem['no_of_items'];
		$insert_data1['total_amount'] = $getproducts->originalprice*$insert_data1['no_of_items'];
		$insert_data1['total_points'] = $getproducts->discount*$insert_data1['no_of_items'];
		$insert_data1['is_coupon_applied'] = "0";
		$insert_data1['coupon_code'] = "0";
		$insert_data1['created_date'] = date('Y-m-d H:i:s');
		$insert_data1['updated_date'] = date('Y-m-d H:i:s');
		$insert_data1['status'] = "0";	
		
		$insert_user = DB::table('customer_carts')->insertGetId($insert_data1);
		$sno++;
		$cartuser_id=$cartItem['user_id'];
		$total_points += $insert_data1['total_points'];
		}
		if($cartuser_id){
			$getuserpoints = DB::table('app_users')->select("total_points")->where('user_id',$cartuser_id)->first();
		
			$insert_data6['total_points'] = $getuserpoints->total_points-$total_points;	
			DB::table('app_users')->where('user_id',$cartuser_id)->update($insert_data6);
			
			$insert_data5['customer_user_id'] = $cartuser_id;	
			$insert_data5['points'] = $total_points;
			$insert_data5['type'] = 'debit';
			$insert_data5['created_date'] = date('Y-m-d H:i:s');
			$insert_data5['appointment_id'] = 0;
			
			DB::table('customer_points_history')->insert($insert_data5);
		}

		if($sno>0){
			$res_data = array(
				"msg"=>"Product cart Added successfully",
				"status"=>"Success"
			);
		}else{
			$res_data = array("msg"=>"Something went wrong. Please try again","status"=>"Failed");
		}	
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	
	public function savecustomerorderpayment(Request $request){
		$post_data = $request->all();			
		//$cartItems='';
		
		$input = json_decode($post_data['content']);
        $user_id = $input->user_id;
        $total_items = $input->total_items;
		$total_amount = $input->total_amount;
        $total_points = $input->total_points;
        $payment_mode = $input->payment_mode;
		$cartItems = $input->cartItems;
		
		$insert_data['status'] = 2;
		
		DB::table('customer_carts')->where('user_id',$user_id)->where('status','0')->update($insert_data);
		
		$order_id = rand(10000000000000,99999999999999);

		$file_doc_name='';
        $file_doc_path = public_path().'/images/orderimages';
        if($request->hasfile('payment_receipt')){
            $extension = $request->file('payment_receipt')->extension();
            $mime_type = $request->file('payment_receipt')->getMimeType();
            $file_doc_name = 'orderimages/customer_'.$order_id.'_'.time().'.'.$extension;
            $dep_file_upload = $request->file('payment_receipt')->move($file_doc_path, $file_doc_name);
        }
		
		
		$insert_orders['user_id'] = $user_id;	
		$insert_orders['order_id'] = $order_id;	
		$insert_orders['total_products'] = $total_items;
		$insert_orders['total_amount'] = $total_amount;
		$insert_orders['total_points'] = $total_points;
		$insert_orders['payment_mode_id'] = $payment_mode;
		$insert_orders['payment_receipt_attachment'] = $file_doc_name;
		$insert_orders['created_date'] = date('Y-m-d H:i:s');
		$insert_orders['dispatched_status'] = "0";	
		
		$insert_user = DB::table('customer_cart_payments')->insert($insert_orders);
		

		$sno=0;
		foreach($cartItems as $cartItem){
		
			$getproducts = DB::table('products')->select("originalprice","discount")->where('product_id',$cartItem->product_id)->first();
			
				
			//var_dump($get_user->service_id);

			$insert_data1['no_of_items'] = $cartItem->no_of_items;
			$insert_data1['total_amount'] = $getproducts->originalprice*$insert_data1['no_of_items'];
			$insert_data1['total_points'] = $getproducts->discount*$insert_data1['no_of_items'];
			$insert_data1['updated_date'] = date('Y-m-d H:i:s');
			$insert_data1['status'] = "1";
			$insert_data1['order_id'] = $order_id;	
			
			$insert_user = DB::table('customer_carts')->where('customer_cart_id',$cartItem->customer_cart_id)->update($insert_data1);
			$sno++;
		}

		if($sno>0){
			$res_data = array(
				"msg"=>"Product Payment Updated successfully",
				"status"=>"Success"
			);
		}else{
			$res_data = array("msg"=>"Something went wrong. Please try again","status"=>"Failed");
		}	
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
		
	
	
	public function customerproducts_list(Request $request){
		$input = $request->all();			
			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		
		$services_list = DB::select("select p.product_id,p.product_name,p.product_image,p.brand_name,p.originalprice,
									p.no_of_items,p.discount,p.deduct_redeem_points,ifnull(pc.no_of_items,0) as cust_cart_count from products p 
									left join (select product_id,no_of_items from customer_carts where user_id='$user_id' and status=0) as pc 
									on pc.product_id=p.product_id
									where p.status='1' and p.no_of_items>0 and p.product_type='customer' 
									group by p.product_id order by p.product_id desc");
		
		//$userpoints = DB::select("select sum(points) as points from customer_points_history where customer_user_id='".$user_id."'");
		$userpoints = DB::select("select ifnull(total_points,0) as total_points from app_users where user_id='".$user_id."'");
		$pendingpoints = DB::select("select sum(total_points) as points,sum(no_of_items) as cartitems from customer_carts where user_id='".$user_id."' and status=0");
		
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			
			$services_data[$skey]['product_id'] = (string)$services_lis->product_id;
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['description'] = $services_lis->product_name;
			$services_data[$skey]['image'] = ($services_lis->product_image!='')?url('/').'/public/images/'.$services_lis->product_image:url('/').'/public/images/services/service_image-1629226307.jpg';
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['quantity'] = $services_lis->no_of_items;
			$services_data[$skey]['product_cart_count'] = $services_lis->cust_cart_count!=''?(string)$services_lis->cust_cart_count:'0';
			$services_data[$skey]['discount'] = $services_lis->discount;
			$services_data[$skey]['point'] = $services_lis->deduct_redeem_points;
			$services_data[$skey]['originalprice'] = (string)(int)$services_lis->originalprice;
			$prod_dis_price = $services_data[$skey]['originalprice']-(($services_data[$skey]['originalprice']*$services_data[$skey]['discount'])/100);
			$services_data[$skey]['discount_product_price'] = (string)ceil($prod_dis_price);
			$skey++;
		}
		$remaining_points = $userpoints[0]->total_points-$pendingpoints[0]->points;
		$res_data['total_products'] = ($remaining_points>0)?$remaining_points:0;
		$res_data['cartitems'] = ($pendingpoints[0]->cartitems)?$pendingpoints[0]->cartitems:0;
		$res_data['partner_products'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function customerwallet_list(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
					
		
		
			$services_list = DB::select("select ifnull(a.total_points,0) as total_points,c.created_date,points,service_name,
			c.credit_type,c.available_points from app_users a 
			left join customer_points_history c on a.user_id=c.customer_user_id 
			left join appointments ap on ap.appointment_id=c.appointment_id 
			left join services s on ap.service_id=ap.service_id where a.user_id='".$user_id."' 
			group by c.cust_history_id");
	
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			if(!empty($services_lis->points)){
				$services_data[$skey]['points'] = $services_lis->available_points!=''?(string)$services_lis->available_points:'';			
				$services_data[$skey]['orderdate'] = date('d-m-Y h:i A',strtotime($services_lis->created_date));
				$services_data[$skey]['service_name'] = $services_lis->service_name!=''?$services_lis->service_name:'--';
				$services_data[$skey]['credit_type'] = $services_lis->credit_type!=''?$services_lis->credit_type:'';
				$services_data[$skey]['available_points'] = (string)$services_lis->points;
				$skey++;
			}
			
		}
		$res_data['total_points'] = (string)$services_list[0]->total_points;
		$res_data['partner_services'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function service_details(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$service_id='';
		if(isset($input['service_id'])){
			$service_id = $input['service_id'];
		}
		$services_list = DB::select("select s.service_id,s.service_name,s.service_description,s.image,price_per_unit,discount_perent,
									estimated_time,ifnull(product_name,'') as product_name,ifnull(product_image,'') as product_image,
									ifnull(brand_name,'') as brand_name,ifnull(s.customer_referral_points,'') as customer_referral_points from services s 
									left join service_categories sc on s.service_id=sc.service_id 
									left join service_category_products scp on scp.service_category_id=sc.service_category_id 
									left join products p on p.product_id=scp.product_id	
									where s.status='1' and s.service_id='".$service_id."'");
		$services_lis = $services_list[0];
		$services_data['service_id'] = $services_lis->service_id;
		$services_data['service_name'] = $services_lis->service_name;
		$services_data['service_description'] = $services_lis->service_description;
		$services_data['image'] = url('/').'/public/images/'.$services_lis->image;
		$services_data['price_per_unit'] = $services_lis->price_per_unit;
		$services_data['estimated_time'] = $services_lis->estimated_time."min";
		$services_data['product_name'] = $services_lis->product_name;
		$services_data['product_image'] = url('/').'/public/images/'.$services_lis->product_image;
		$services_data['brand_name'] = $services_lis->brand_name;
		$services_data['customer_referral_points'] = $services_lis->customer_referral_points;
		$dis_amount = $services_lis->price_per_unit-($services_lis->discount_perent!=''?(($services_lis->discount_perent / 100) * $services_lis->price_per_unit):0);
		$services_data['discount_price'] = (string)$dis_amount;
		$services_data['products'] = [];
		$key = 0;
		foreach($services_list as $val){
			$services_data['products'][$key]['product_name']= $val->product_name;
			$services_data['products'][$key]['product_image']= url('/').'/public/images/'.$val->product_image;
			$services_data['products'][$key]['brand_name']= $val->brand_name;
			$key++;
		}
		
		
		$res_data = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function products_list(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$type='';
		if(isset($input['type'])){
			$type = $input['type'];
		}	
		if($type == 'topproducts'){
			$services_list = DB::select("select * from products where status='1' and product_type='customer' order by product_id desc limit 5");
		}else{
			$services_list = DB::select("select * from products where status='1' and product_type='customer' order by product_id desc");
		}
		
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['product_id'] = (string)$services_lis->product_id;
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['description'] = $services_lis->product_name;
			$services_data[$skey]['image'] = ($services_lis->product_image!='')?url('/').'/public/images/'.$services_lis->product_image:url('/').'/public/images/services/service_image-1629226307.jpg';
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['originalprice'] = (string)(int)$services_lis->originalprice;
			$skey++;
		}
		$res_data = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function cities_list(){
		$cities_list = DB::select("select * from city where status='1'");
		$cities_data=array();
		$skey=0;
		foreach($cities_list as $cities_lis)
		{
			$cities_data[$skey]['city_id'] = (string)$cities_lis->city_id;
			$cities_data[$skey]['city_name'] = $cities_lis->city_name;
			$skey++;
		}
		$res_data['cities_list'] = $cities_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function time_slots(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}
		$date='';
		if(isset($input['date'])){
			$date = date('Y-m-d', strtotime($input['date']));
		}
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = trim($input['appointment_id']);
		}	
		$timeafterhour = date("H:i:s", strtotime("+60 minutes"));
		$cities_list = array();
		if($date>=date('Y-m-d')){
			if($appointment_id==''){
				if($date==date('Y-m-d')){
					$cons_tstr = "and TIME(value)>'".$timeafterhour."'";
					//$cons_tstr = "";
				} else {
					$cons_tstr = "";
				}
				$cities_list = DB::select("select * from time_slots where status='1' and slot_id not in  
								(select appointment_slot_id from appointments where user_id='".$user_id."' 
								and appointment_date='".date('Y-m-d')."' and status!='Cancelled' group by appointment_slot_id) 
								$cons_tstr");
			} else {
				if($date==date('Y-m-d')){
					$cons_tstr = "and TIME(value)>'".$timeafterhour."'";
					//$cons_tstr = "";
				} else {
					$cons_tstr = "";
				}
				$getappointdetails = DB::select("SELECT vendor_id FROM appointments where appointment_id='".$appointment_id."'");
				$cities_list = DB::select("select * from time_slots where status='1' $cons_tstr and 
									slot_id not in (select appointment_slot_id from appointments where user_id='".$user_id."' and 
									appointment_date='".$date."' group by appointment_slot_id) and 
									slot_id not in (SELECT appointment_slot_id FROM appointments where appointment_date='".$date."' 
									and vendor_id='".$getappointdetails[0]->vendor_id."' and status!='Cancelled' $cons_tstr group by appointment_slot_id)");
			}
		}
		//$cities_list = DB::select("select * from time_slots where status='1'");
		$cities_data=array();
		if(isset($cities_list) && count($cities_list)>0){
			$skey=0;
			foreach($cities_list as $cities_lis)
			{
				$cities_data[$skey]['slot_id'] = (string)$cities_lis->slot_id;
				$cities_data[$skey]['label'] = (string)$cities_lis->label;
				$cities_data[$skey]['value'] = $cities_lis->value;
				$skey++;
			}
		}
		$res_data['time_slots'] = $cities_data;
		return $this->sendResponse($res_data, 'Data fetched successfully');
	}

	public function book_appointment(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$address_id='';
		if(isset($input['address_id'])){
			$address_id = $input['address_id'];
		}	
		$service_id='';
		if(isset($input['service_id'])){
			$service_id = $input['service_id'];
		}	
		
		$appointment_id_org='';
		if(isset($input['appointment_id'])){
			$appointment_id_org = $input['appointment_id'];
		}	
		
		$appointment_slot_id='';
		if(isset($input['appointment_slot_id'])){
			$appointment_slot_id = $input['appointment_slot_id'];
		}	
		$appointment_date='';
		if(isset($input['appointment_date'])){
			$appointment_date = $input['appointment_date'];
		}	
		$latitude='';
		if(isset($input['latitude'])){
			$latitude = $input['latitude'];
		}	
		$longitude='';
		if(isset($input['longitude'])){
			$longitude = $input['longitude'];
		}	
		$actual_amount='';
		if(isset($input['actual_amount'])){
			$actual_amount = $input['actual_amount'];
		}	
		$discount_percent='';
		if(isset($input['discount_percent'])){
			$discount_percent = $input['discount_percent'];
		}	

		$doorno='';
		if(isset($input['doorno'])){
			$doorno = $input['doorno'];
		}
		$street='';
		if(isset($input['street'])){
			$street = $input['street'];
		}
		$area='';
		if(isset($input['area'])){
			$area = $input['area'];
		}
		$city ='';
		if(isset($input['city'])){
			$city = $input['city'];
		}
		$state='';
		if(isset($input['state'])){
			$state = $input['state'];
		}
		$pincode='';
		if(isset($input['pincode'])){
			$pincode = $input['pincode'];
		}
		$otp = rand(111111,999999);
		// if($service_id!=''){
		// 	$service_id = $service_id;
		// } else if($appointment_id_org!=''){
		// 	$getappointment_details = DB::table('appointments')->select("appointment_id","service_id")->where('appointment_id',$appointment_id_org)->first();
		// 	$service_id = $getappointment_details->service_id;
		// } else {
		// 	$service_id = '';
		// }

		if($appointment_id_org!='' && $service_id!=''){
			$service_id = $service_id;
		} else if($appointment_id_org!='' && $service_id==''){
			$getappointment_details = DB::table('appointments')->select("appointment_id","service_id")->where('appointment_id',$appointment_id_org)->first();
			$service_id = $getappointment_details->service_id;
		} else if($appointment_id_org=='' && $service_id!=''){
			$service_id = $service_id;
		} else {
			$service_id = '';
		}

		$getservice_details = DB::table('services')->select("customer_referral_points","price_per_unit","discount_perent")->where('service_id',$service_id)->first();
		//insert appointment
		$insert_data['user_id'] = $user_id;
		$insert_data['service_id'] = $service_id;
		$insert_data['appointment_slot_id'] = $appointment_slot_id;
		$insert_data['appointment_date'] = date('Y-m-d', strtotime($appointment_date));
		$insert_data['latitude'] = $latitude;
		$insert_data['longitude'] = $longitude;
		//$insert_data['actual_amount'] = $actual_amount;
		//$insert_data['discount_percent'] = $discount_percent;
		$insert_data['otp'] = $otp;		
		$insert_data['created_by'] = $user_id;
		$insert_data['created_date'] = date('Y-m-d H:i:s');
		if(isset($getservice_details)){
			$insert_data['bonus_points'] = $getservice_details->customer_referral_points;
			$insert_data['actual_amount'] = $getservice_details->price_per_unit;
			$insert_data['discount_amount'] = $getservice_details->discount_perent!=''?$getservice_details->price_per_unit-(($getservice_details->discount_perent / 100) * $getservice_details->price_per_unit):'';
			$insert_data['discount_percent'] = $getservice_details->discount_perent;
		} else {
			$insert_data['bonus_points'] = '0';
			$insert_data['actual_amount'] = '0';
			$insert_data['discount_amount'] = NULL;
			$insert_data['discount_percent'] = NULL;
		}
		$checkstatus=0;
		if(!empty($appointment_id_org)){		
			$insert_data['status'] = 'pending';
			$getvendor_id = DB::table('appointments')->select("vendor_id","service_id","status")->where('appointment_id',$appointment_id_org)->first();
			// if(!empty($getvendor_id->vendor_id)){
			// 	if(empty($service_id)){
			// 		$insert_data['service_id'] = $service_id;
			// 	}
			// 	//$insert_data['vendor_id'] = $getvendor_id->vendor_id?$getvendor_id->vendor_id:"0";
			// 	$insert_data['modified_date'] = date('Y-m-d H:i:s');
			// 	//$insert_data['status'] = 'Approved';
			// 	$checkstatus=1;
			// }
			if($getvendor_id->vendor_id!='' && $getvendor_id->status=='Completed'){
				$app_type = 'repeat';
				$insert_data['type'] = $app_type;
			} else {
				$app_type = 'direct';
				$insert_data['type'] = $app_type;
			}
		}else{
			$app_type = 'direct';
			$insert_data['status'] = 'pending';
			$insert_data['type'] = $app_type;
		}
		
		$appointment_id = DB::table('appointments')->insertGetId($insert_data);
		//insert multi services
		$discount_amount_val = $getservice_details->price_per_unit-(($getservice_details->discount_perent / 100) * $getservice_details->price_per_unit);
		$insert_muldata['appointment_id'] = $appointment_id;
		$insert_muldata['service_id'] = $service_id;
		$insert_muldata['bonus_points'] = $getservice_details->customer_referral_points;
		$insert_muldata['actual_amount'] = $getservice_details->price_per_unit;
		$insert_muldata['discount_amount'] = $getservice_details->discount_perent!=''?round($discount_amount_val):'';
		$insert_muldata['discount_percent'] = $getservice_details->discount_perent;
		$insert_muldata['status'] = '1';
		$insert_muldata['created_date'] = date('Y-m-d H:i:s');
		$insert_muldata['created_by'] = '1';
		DB::table('appointment_services')->insert($insert_muldata);
		//insert details
		$insert_appointdet['appointment_id'] = $appointment_id;
		$insert_appointdet['doorno'] = $doorno;
		$insert_appointdet['street'] = $street;
		$insert_appointdet['area'] = $area;
		$insert_appointdet['city'] = $city;
		$insert_appointdet['state'] = $state;
		$insert_appointdet['country'] = 'India';
		$insert_appointdet['pincode'] = $pincode!=''?$pincode:NULL;
		$insert_appointdet['created_by'] = $user_id;
		$insert_appointdet['created_date'] = date('Y-m-d H:i:s');
		
		$appointment_details_id = DB::table('appointment_details')->insertGetId($insert_appointdet);
		
		//if($checkstatus==0){
			$this->sendpartnerpushnotifications($appointment_id,$latitude,$longitude,$app_type,$appointment_id_org);
		//}		
		
		$res_data = array("msg"=>"Your appointment booked successfully. We will contact you soon","status"=>"Success");
		
		
		/*$notifications_data = array();
										$notifications_data['title'] = "RBIS Alert";
										$notifications_data['text']  = "Dear WDS/WEA, ".$val->pendingpensioners." Pensioners not enrolled from your side. Please enroll them immediately";	
										$notifications_data['direct_contact'] =	1;
										$notifications_data['alert_message'] =	"Dear WDS/WEA, ".$val->pendingpensioners." Pensioners not enrolled from your side. Please enroll them immediately"; 
										
				
		Helper::send_pushnotification($notifications_data,$val->device_id);	*/
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function sendpartnerpushnotifications($appointment_details_id,$latitude,$longitude,$app_type,$appointment_id){
		
		//$services_list = DB::select("select fcm_token_id from partners where fcm_token_id is not null");
		if($app_type=='direct'){
			$config_data = DB::Table("config_data")->select("hub_coverage_radius")->first();
			$distance = $config_data->hub_coverage_radius;
			$services_list = DB::select("select ph.partner_id,p.fcm_token_id, p.first_name, p.last_name from partner_hubs ph
										inner join partners p on p.partner_id=ph.partner_id
										where ph.hub_id in (
										select hub_id from ( 
										SELECT hub_id , (3956 * 2 * ASIN(SQRT( POWER(SIN(( ".$latitude." - latitude) *  pi()/180 / 2), 2) 
										+COS( ".$latitude." * pi()/180) * COS(latitude * pi()/180) * POWER(SIN(( ".$longitude." - longitude) * pi()/180 / 2), 2) ))) as distance  
										from hubs  
										having  distance <= '$distance'
										order by distance) as tab) group by partner_id");
		} else {
			$services_list = DB::select("select fcm_token_id, p.partner_id from appointments a 
										inner join partners p on p.partner_id=a.vendor_id 
										where a.appointment_id='".$appointment_id."' and fcm_token_id is not null");
		}
		// Check Service Product exist or not
		
		// Check Service Product exist or not in Distributor
		
		// Check enough paid and bonus points to serve Service
		
		// Send only associated current hub partners
		
		// Find our nearest hub partners
		
		/*
		
SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( 17.420993 - latitude) *  pi()/180 / 2), 2) 
+COS( 17.420993 * pi()/180) * COS(latitude * pi()/180) * POWER(SIN(( 78.3968 - longitude) * pi()/180 / 2), 2) ))) as distance  
                                from hubs  
                                having  distance <= 40
                                order by distance		
		*/
	
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$notifications_data = array();
			$notifications_data['title'] = "EZGLAM NEW BOOKING REQUEST";
			$notifications_data['text']  = "Click Here To View Appointment Details";	
			$notifications_data['appointment_id']  = $appointment_details_id;
			$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
			$notifications_data['sound']  = 'default';
			//$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
										
			Helper::send_pushnotification($notifications_data,$services_lis->fcm_token_id,'vendor');		
		}
	}

	public function appointments_list(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$type='';
		if(isset($input['type'])){
			$type = $input['type'];
		}
		$type_id='';
		if(isset($input['type_id'])){
			$type_id = $input['type_id'];
		}
		if($type == 'all'){
			$appointments_list = DB::select("SELECT a.appointment_id,a.appointment_date,ascts.actual_amount, a.discount_percent, ascts.bonus_points, ascts.actual_total_amount,a.service_id, 
											a.otp, ts.label, a.status, p.partner_id, ascts.service_name as service_name, service_image,
											p.first_name as partner_fname,p.last_name as partner_lname,ifnull(p.profile_picture,'') as profile_picture FROM appointments a
											inner join time_slots ts on ts.slot_id=a.appointment_slot_id
											left join partners p on p.partner_id=a.vendor_id
											left join (select appointment_id, service_name,service_image,bonus_points, actual_amount,actual_total_amount from (
											select asct.appointment_id, group_concat(asct.service_id) as service_id, group_concat(srv.service_name) as service_name, 
											MAX(srv.image) as service_image, 
											SUM(bonus_points) as bonus_points, SUM(discount_amount) as actual_amount,SUM(actual_amount) as actual_total_amount from appointment_services asct 
											inner join services srv on srv.service_id=asct.service_id
											group by asct.appointment_id) as tab) as ascts on ascts.appointment_id=a.appointment_id
											where a.user_id='$user_id' order by a.appointment_id desc");
		}else{
			$appointments_list = DB::select("SELECT a.appointment_id,a.appointment_date,ascts.actual_amount, a.discount_percent, ascts.bonus_points, ascts.actual_total_amount,a.service_id, 
											a.otp, ts.label, a.status, p.partner_id, ascts.service_name as service_name, service_image,
											p.first_name as partner_fname,p.last_name as partner_lname,ifnull(p.profile_picture,'') as profile_picture FROM appointments a
											inner join time_slots ts on ts.slot_id=a.appointment_slot_id
											left join partners p on p.partner_id=a.vendor_id
											left join (select appointment_id, service_name,service_image,bonus_points, actual_amount,actual_total_amount from (
											select asct.appointment_id, group_concat(asct.service_id) as service_id, group_concat(srv.service_name) as service_name, 
											MAX(srv.image) as service_image, 
											SUM(bonus_points) as bonus_points, SUM(discount_amount) as actual_amount,SUM(actual_amount) as actual_total_amount from appointment_services asct 
											inner join services srv on srv.service_id=asct.service_id
											group by asct.appointment_id) as tab) as ascts on ascts.appointment_id=a.appointment_id
											where a.user_id='$user_id' order by a.appointment_id desc LIMIT 5");
		}
											
		$akey=0;
		$data=array();
		foreach($appointments_list as $appointments_li){
			$discount_amount = $appointments_li->discount_percent!=''?(int)(($appointments_li->discount_percent / 100) * $appointments_li->actual_amount):0;
			$app_status = ucwords(strtolower($appointments_li->status));
			$data[$akey]['appointment_id'] = (string)$appointments_li->appointment_id;
			$data[$akey]['appointment_date'] = date('d-M-Y', strtotime($appointments_li->appointment_date)).' '.$appointments_li->label;
			//$data[$akey]['actual_amount'] = $appointments_li->actual_amount-$discount_amount;
			$data[$akey]['actual_amount'] = $appointments_li->actual_total_amount;
			//$data[$akey]['discount_amount'] = $appointments_li->discount_percent!=''?(string)(($appointments_li->discount_percent / 100) * $appointments_li->actual_amount):'';
			$data[$akey]['discount_amount'] = (string)$appointments_li->actual_amount;
			$data[$akey]['service_id'] = $appointments_li->service_id!=''?(string)$appointments_li->service_id:'';
			$data[$akey]['service_name'] = $appointments_li->service_name;
			$data[$akey]['service_image'] = $appointments_li->service_image!=''?url('/').'/public/images/'.$appointments_li->service_image:url('/').'/public/images/services/service_image-1629226307.jpg';
			//$data[$akey]['service_image'] = url('/').'/public/images/services/service_image-1629226307.jpg';
			$data[$akey]['time_slot'] = $appointments_li->label;
			$data[$akey]['otp'] = $appointments_li->otp;
			if($app_status=='Approved'){
				$color_code = '#23b900';
			} else if($app_status=='Completed'){
				$color_code = '#28f341';
			} else if($app_status=='Pending'){
				$color_code = '#ff875a';
			} else if($app_status=='Started'){
				$color_code = '#f8b400';
			} else {
				$color_code = '#ff0000';
			}
			$data[$akey]['color_code'] = $color_code;
			$data[$akey]['status'] = $app_status;
			if($app_status=='Completed'){
				$data[$akey]['feedback_status'] = '1';
			} else {
				$data[$akey]['feedback_status'] = '0';
			}
			$data[$akey]['bonus_points'] = (string)$appointments_li->bonus_points;
			if($app_status=='Approved' || $app_status=='Completed' || $app_status=='Started'){
				$data[$akey]['beautician_name'] = ucwords(strtolower($appointments_li->partner_fname.' '.$appointments_li->partner_lname));
			} else {
				$data[$akey]['beautician_name'] = '--';
			}
			if($app_status=='Approved' || $app_status=='Started'){
				$data[$akey]['call_option'] = "1";
			} else {
				$data[$akey]['call_option'] = "0";
			}
			if($app_status=='Pending'){
				$data[$akey]['partner_image'] = '';
			} else {
				$data[$akey]['partner_image'] = $appointments_li->profile_picture!=''?url('/').'/public/images/userimages/'.$appointments_li->profile_picture:'';
			}
			$akey++;
		}
		$res_data['appointments_list'] = $data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function types_list(){
		$cities_list = DB::select("select * from types where status='1'");
		$icons_array = array('premium.JPG','elite.JPG');
		$sub_icons_array = array('prem_diamond.JPG','elite_sun.png');
		$sub_text_array = array('PREMIUM SERVICES','Economical');
		$description_array = array('20years experienced','12years experienced');
		$cities_data=array();
		$skey=0;
		foreach($cities_list as $cities_lis)
		{
			$cities_data[$skey]['type_id'] = (string)$cities_lis->type_id;
			$cities_data[$skey]['type'] = $cities_lis->type;
			$cities_data[$skey]['color_code'] = '';
			$cities_data[$skey]['icon'] = url('/').'/public/assets/images/'.$icons_array[$skey];
			$cities_data[$skey]['sub_text'] = $sub_text_array[$skey];
			$cities_data[$skey]['sub_icon'] = url('/').'/public/assets/images/'.$sub_icons_array[$skey];
			$cities_data[$skey]['description'] = $description_array[$skey];
			$skey++;
		}
		$res_data['types_list'] = $cities_data;
		$banners_list = DB::select("select * from banners where status='1' order by sequence");
		$serkey=0;
		$prokey=0;
		$service_banners_data=array();
		$product_banners_data=array();
		foreach($banners_list as $banners_li){
			if($banners_li->type=='service'){
				$service_banners_data[$serkey]['id'] = $banners_li->service_category_id!=''?(string)$banners_li->service_category_id:'';
				$service_banners_data[$serkey]['banner_image'] = $banners_li->banner_image_path!=''?url('/').'/public/assets/images/banners/'.$banners_li->banner_image_path:'';
				$serkey++;
			} else if($banners_li->type=='product'){
				$product_banners_data[$prokey]['id'] = $banners_li->service_category_id!=''?(string)$banners_li->service_category_id:'';
				$product_banners_data[$prokey]['banner_image'] = $banners_li->banner_image_path!=''?url('/').'/public/assets/images/banners/'.$banners_li->banner_image_path:'';
				$prokey++;
			}
		}
		$res_data['service_banners'] = $service_banners_data;
		$res_data['product_banners'] = $product_banners_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function customerprofile(Request $request){
		
		$input = $request->all();	
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		
		$cities_list = DB::select("select user_id,ifnull(first_name,'') as first_name,ifnull(last_name,'') as last_name,ifnull(email,'') as email,
									ifnull(gender,'') as gender,ifnull(address,'') as address,ifnull(mobile_number,'') as mobile,
									ifnull(total_points,0) as rewards_points,ifnull(user_image,'') as user_image from app_users a 
									inner join mobile_numbers m on a.mobile=m.mobile_number_id 
									where user_id='".$user_id."'");
		$update_data['user_id'] = $cities_list[0]->user_id;
		$update_data['first_name'] = $cities_list[0]->first_name;
		$update_data['last_name'] = $cities_list[0]->last_name;
		$update_data['email'] = $cities_list[0]->email;
		$update_data['gender'] = $cities_list[0]->gender;
		$update_data['address'] = $cities_list[0]->address;
		$update_data['mobile'] = $cities_list[0]->mobile;
		$update_data['rewards_points'] = $cities_list[0]->rewards_points;
		$update_data['profile_image'] = $cities_list[0]->user_image!=''?url('/').'/public/images/'.$cities_list[0]->user_image:url('/').'/public/assets/images/nouser.png';
		return $this->sendResponse($update_data, 'Data fetched successfully.');
	}
	
	public function updatecustomerprofile(Request $request){
		
		$post_data = $request->all();	
		
		$input = json_decode($post_data['content']);
		$user_id = $input->user_id;
        $first_name = $input->first_name;
		$last_name = $input->last_name;
        $email = $input->email;
        $gender = $input->gender;
		$mobile_number = $input->mobile_number;
		//$dob = $input->dob;
		
		$update_data['first_name'] = $first_name;
		$update_data['last_name'] = $last_name;
		$update_data['email'] = $email;
		$update_data['gender'] = $gender;
		//$update_data['mobile_number'] = $mobile_number;
		//$update_data['dob'] = $dob;
		
		$file_doc_name='';
        $file_doc_path = public_path().'/images/userimages';
        if($request->hasfile('user_image')){
			$file_size = $request->file('user_image')->getSize();
            $extension = $request->file('user_image')->extension();
            $mime_type = $request->file('user_image')->getMimeType();
            $file_doc_name = 'userimages/'.$input->user_id.'_'.time().'.'.$extension;
            $dep_file_upload = $request->file('user_image')->move($file_doc_path, $file_doc_name);
            $update_data['user_image']=$file_doc_name;
        }
		
		$update_user = DB::table('app_users')->where('user_id',$user_id)->update($update_data);
		
		$check_mobile = DB::Table("app_users")->select("mobile")->where('user_id',$user_id)->first();
		
		$update_data1['mobile_number'] = $mobile_number;
		$update_user2 = DB::table('mobile_numbers')->where('mobile_number_id',$check_mobile->mobile)->update($update_data1);
		
		$res_data = array(
				"msg"=>"Profile Updated successfully",
				"status"=>"Success"
			);
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function categories_list(Request $request){ 
		
		$input = $request->all();	
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$type_id='';
		if(isset($input['type_id'])){
			$type_id = $input['type_id'];
		}
		
		$cities_list = DB::select("select * from categories where type_id='".$type_id."' and status='1' and is_delete=0");
		$cities_data=array();
		$skey=0;
		foreach($cities_list as $cities_lis)
		{
			$cities_data[$skey]['category_id'] = (string)$cities_lis->category_id;
			$cities_data[$skey]['category_name'] = $cities_lis->category_name;
			$cities_data[$skey]['image'] = $cities_lis->image!=''?url('/').'/public/images/'.$cities_lis->image:url('/').'/public/assets/images/premium_icon.JPG';
			$skey++;
		}
		$res_data['types_list'] = $cities_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function savecustomercartitem(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$product_id='';
		if(isset($input['product_id'])){
			$product_id = $input['product_id'];
		}	
		$no_of_items='0';
		if(isset($input['no_of_items'])){
			$no_of_items = $input['no_of_items'];
		}	
		$checkproductstatusinusercart = DB::SELECT("select customer_cart_id from customer_carts where user_id='".$user_id."' 
		and product_id='".$product_id."' and status=0");
		$getproducts = DB::table('products')->select("originalprice","discount","deduct_redeem_points")->where('product_id',$product_id)->first();
		if($getproducts->discount>0){
			$final_price = ceil($getproducts->originalprice-(($getproducts->originalprice*$getproducts->discount)/100));
		} else {
			$final_price = ceil($getproducts->originalprice);
		}
		
		if(isset($checkproductstatusinusercart[0])){
			$insert_data1['no_of_items'] = $no_of_items;
			$insert_data1['total_amount'] = $final_price*$no_of_items;
			$insert_data1['total_points'] = $getproducts->deduct_redeem_points?$getproducts->deduct_redeem_points*$no_of_items:'0';
			$insert_data1['updated_date'] = date('Y-m-d H:i:s');
			$insert_data1['status'] = "0";	
			DB::table('customer_carts')->where('customer_cart_id',$checkproductstatusinusercart[0]->customer_cart_id)->update($insert_data1);
			$insert_user = $checkproductstatusinusercart[0]->customer_cart_id;
		}else{
				
			$insert_data1['user_id'] = $user_id;	
			$insert_data1['product_id'] = $product_id;	
			$insert_data1['no_of_items'] = $no_of_items;
			$insert_data1['total_amount'] = $final_price*$no_of_items;
			$insert_data1['total_points'] = $getproducts->deduct_redeem_points?$getproducts->deduct_redeem_points*$no_of_items:'0';
			$insert_data1['is_coupon_applied'] = "0";
			$insert_data1['coupon_code'] = "0";
			$insert_data1['created_date'] = date('Y-m-d H:i:s');
			$insert_data1['updated_date'] = date('Y-m-d H:i:s');
			$insert_data1['status'] = "0";	
			$insert_user = DB::table('customer_carts')->insertGetId($insert_data1);
		}

		$userpoints = DB::select("select ifnull(total_points,0) as total_points from app_users where user_id='".$user_id."'");
		$pendingpoints = DB::select("select sum(total_points) as points,sum(no_of_items) as cartitems from customer_carts 
							where user_id='".$user_id."' and status=0");
	
		$getcartmounts = DB::select("select sum(original_price) as total_original_price, sum(total_amount) as total_discount_price from (
									SELECT (p.originalprice*cc.no_of_items) as original_price, total_amount FROM customer_carts cc 
									inner join products p on p.product_id=cc.product_id
									where cc.user_id='".$user_id."' and cc.status=0 and cc.no_of_items>0) as tab");
		$remaining_points = $userpoints[0]->total_points-$pendingpoints[0]->points;
		// $res_data['total_products'] = ($remaining_points>0)?(string)$remaining_points:'0';
		// $res_data['cartitems'] = ($pendingpoints[0]->cartitems)?$pendingpoints[0]->cartitems:0;
		if($insert_user>0){
			$res_data = array(
				"points_remaining" => ($remaining_points>0)?(string)$remaining_points:'0',
				"cartitems" => ($pendingpoints[0]->cartitems)?(string)$pendingpoints[0]->cartitems:'0',
				"total_original_price" => ($getcartmounts[0]->total_original_price!='')?(string)$getcartmounts[0]->total_original_price:'0',
				"total_discount_price" => ($getcartmounts[0]->total_discount_price!='')?(string)$getcartmounts[0]->total_discount_price:'0',
				"msg"=>"Product cart updated successfully",
				"status"=>"Success"
			);
		}else{
			$res_data = array("msg"=>"Something went wrong. Please try again","status"=>"Failed");
		}	
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function savecustomerfeedback(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		$rating='';
		if(isset($input['rating'])){
			$rating = $input['rating'];
		}	
		$feedback_message='';
		if(isset($input['feedback_message'])){
			$feedback_message = $input['feedback_message'];
		}
		$insert_data['user_id'] = $user_id;
		$insert_data['appointment_id'] = $appointment_id;
		$insert_data['rating'] = $rating;
		$insert_data['feedback'] = $feedback_message;
		$insert_data['status'] = 1;
		$insert_data['created_date'] = date('Y-m-d H:i:s');
		$insert_user = DB::table('feedback')->insertGetId($insert_data);
		$res_data = array(
			"msg"=>"Thanks for your feedback!!!",
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function random_strings($length_of_string)
	{
	  
		// String of all alphanumeric character
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	  
		// Shuffle the $str_result and returns substring
		// of specified length
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}

	public function cancelappointment(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		$reason_id='';
		if(isset($input['reason_id'])){
			$reason_id = $input['reason_id'];
		}
		$other_reason='';
		if(isset($input['other_reason'])){
			$other_reason = $input['other_reason'];
		}
		$getappointment_details = DB::table('appointments')->select("appointment_id","service_id","status","vendor_id")
									->where('appointment_id',$appointment_id)->first();
		if(isset($getappointment_details) && $getappointment_details->status=='Approved' && $getappointment_details->vendor_id!=''){
			$partner_id = $getappointment_details->vendor_id;
			$get_partner_details = DB::select("select total_paid_points, total_bonus_points,fcm_token_id from partners where partner_id='".$partner_id."'");
			$checkUserLogin2 = DB::select("select paid_points,bonus_points from deduct_points_history where appointment_id='".$appointment_id."'");
			if(isset($get_partner_details[0]) && isset($checkUserLogin2[0])){
				//update points in user table
				$update_userdata1['total_paid_points'] = $get_partner_details[0]->total_paid_points+$checkUserLogin2[0]->paid_points;
				DB::table('partners')->where('partner_id',$partner_id)->update($update_userdata1);
				//update points in user table
				$update_userdata2['total_bonus_points'] = $get_partner_details[0]->total_bonus_points+$checkUserLogin2[0]->bonus_points;
				DB::table('partners')->where('partner_id',$partner_id)->update($update_userdata2);
				//insert in points history
				$insert_data_1['partner_id'] = $partner_id;
				$insert_data_1['points'] =$checkUserLogin2[0]->paid_points;
				$insert_data_1['total_points'] = $get_partner_details[0]->total_paid_points+$checkUserLogin2[0]->paid_points;
				$insert_data_1['type'] = "paid";
				$insert_data_1['credit_type'] = 'credit';
				$insert_data_1['created_date'] = date('Y-m-d H:i:s');
				DB::table('partner_points_history')->insert($insert_data_1);
				//insert bonus record
				$insert_data_2['partner_id'] = $partner_id;
				$insert_data_2['points'] =$checkUserLogin2[0]->bonus_points;
				$insert_data_2['total_points'] = $get_partner_details[0]->total_bonus_points+$checkUserLogin2[0]->bonus_points;
				$insert_data_2['type'] = "bonus";
				$insert_data_2['credit_type'] = 'credit';
				$insert_data_2['created_date'] = date('Y-m-d H:i:s');
				DB::table('partner_points_history')->insert($insert_data_2);
				//notification data
				$notifications_data = array();
				$notifications_data['title'] = "EZGLAM BOOKING REQUEST CANCELLED";
				$notifications_data['text']  = "Click Here To View Appointment Details";	
				$notifications_data['appointment_id']  = $appointment_id;
				$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
				$notifications_data['sound']  = 'default';
				//$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
											
				Helper::send_pushnotification($notifications_data,$get_partner_details[0]->fcm_token_id,'vendor');	
			}

		}
		$appoint_status=strtolower($getappointment_details->status);
		if(isset($getappointment_details) && ($appoint_status=='approved' || $appoint_status=='pending')){
			$update_data['status'] = 'Cancelled';
			$update_data['cancel_reason_id'] = $reason_id;
			$update_data['other_cancel_reason'] = $other_reason;
			$update_user = DB::table('appointments')->where('appointment_id',$appointment_id)->update($update_data);
			$res_data = array(
				"msg"=>"Appointment cancelled successfully",
				"status"=>"Success"
			);
		} else {
			$res_data = array(
				"msg"=>"Appointment cannot be cancelled as its already been ".$appoint_status,
				"status"=>"Success"
			);
		}
		
		// $notifications_data = array();
		// $notifications_data['title'] = "EZGLAM NEW BOOKING REQUEST";
		// $notifications_data['text']  = "Click Here To View Appointment Details";	
		// $notifications_data['appointment_id']  = '207';
		// $notifications_data['user_id']  = '9';
		// $notifications_data['type']  = 'details';
		// $notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
		// $notifications_data['sound']  = 'default';
		// //$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
		// Helper::send_pushnotification($notifications_data,'fLrA7BqUR3WUdifXpHK3Wm:APA91bFGCfgAaL1oWlcQuuc-d-_3sjN0UfV4yEI-ZSFQlZMvAxdSitg2fpW3tBs2pafHW4IyPG4QEA4yZ17VDJ1gr1_k9LiZ-16KAxFlaCF4bYD-ZeOFgtOizj1HGus8IcKU0qWOApjE','customer');	
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function contactcallmaskapi(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		$type='';
		if(isset($input['type'])){
			$type = $input['type'];
		}	
		
		$get_numbers = DB::SELECT("select a.appointment_id,a.user_id,m.mobile_number as customernumber,p.mobile as partnermobile from appointments a inner join app_users au on a.user_id=au.user_id inner join mobile_numbers m on au.mobile=m.mobile_number_id inner join partners p on p.partner_id=a.vendor_id where appointment_id='".$appointment_id."'");
		
		if(count($get_numbers)>0){
			
			if($type == 'customer'){
				
				$arr = EncDecHelper::getcallmasking('0'.$get_numbers[0]->customernumber,'0'.$get_numbers[0]->partnermobile);
				
			}else{
				
				$arr = EncDecHelper::getcallmasking('0'.$get_numbers[0]->partnermobile,'0'.$get_numbers[0]->customernumber);
				
			}
			
			if($arr['Call']['Sid']){		
			
				$res_data = array(
					"msg"=>"Call Initiated, You will get call very soon!",
					"status"=>"Success"
				);
			
			}else{
				
				$res_data = array(
				"msg"=>"Unable to Contact Now",
				"status"=>"Failed"
			);
				
			}
			
		}else{
			
			$res_data = array(
				"msg"=>"Unable to Contact Now",
				"status"=>"Failed"
			);
			
		}
		
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function referandearn(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$mobile_number='';
		if(isset($input['mobile_number'])){
			$mobile_number = $input['mobile_number'];
		}	
		$getrefcode = DB::table('app_users')->select("referral_code")->where('user_id',$user_id)->first();
		$config_data = DB::select("SELECT customer_referral_bonus_points,referral_join_bonus FROM config_data");
		if(isset($getrefcode)){
			$message = "Hi, use my referral code ".$getrefcode->referral_code." to register in EZGLAM app and get ".$config_data[0]->referral_join_bonus." bonus points on customer products. Click the below link to install the app https://rb.gy/vif8jr Thanks & Regards EZGLAM TEAM.";
			$encpassword = EncDecHelper::sendsms($mobile_number,$message);		
		}
		$res_data = array(
			"msg"=>"You have referred successfully!",
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function generateorderid(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$order_id = 'EZG'.date('ymdHis').'U'.$user_id;
		//update order id
		$update_data['order_id'] = $order_id;
		DB::table('customer_carts')->where('user_id',$user_id)->where('no_of_items','>',0)->where('status','0')->update($update_data);
		//save in transaction history
		$insert_data['user_id'] = $user_id;
		$insert_data['order_id'] = $order_id;
		$insert_data['created_date'] = date('Y-m-d H:i:s');
		$insert_user = DB::table('customer_payment_transactions')->insertGetId($insert_data);
		$res_data = array(
			"order_id"=>$order_id,
			"msg"=>"User Id generated successfully!",
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function updatepaymentstatus(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$order_id='';
		if(isset($input['order_id'])){
			$order_id = trim($input['order_id']);
		}
		$transaction_id='';
		if(isset($input['transaction_id'])){
			$transaction_id = $input['transaction_id'];
		}
		// $amount='';
		// if(isset($input['amount'])){
		// 	$amount = $input['amount'];
		// }
		$status='success';
		// if(isset($input['status'])){
		// 	$status = strtolower($input['status']);
		// }
		if($status=='success'){
			//update customer carts
			$update_data['order_id'] = $order_id;
			$update_data['status'] = '1';
			DB::table('customer_carts')->where('user_id',$user_id)->where('no_of_items','>',0)->where('status','0')->update($update_data);
			$get_order_details = DB::select("select sum(no_of_items) as total_products, sum(total_amount) as sum_amount, 
												sum(total_points) as sum_points from customer_carts where order_id='".$order_id."'");
			if(isset($get_order_details[0])){
				//insert into customer cart payments
				$insert_data['user_id'] = $user_id;
				$insert_data['order_id'] = $order_id;
				$insert_data['total_products'] = $get_order_details[0]->total_products;
				$insert_data['total_amount'] = ceil($get_order_details[0]->sum_amount);
				$insert_data['total_points'] = $get_order_details[0]->sum_points;
				$insert_data['dispatched_status'] = '0';
				$insert_data['created_date'] = date('Y-m-d H:i:s');
				$insert_user = DB::table('customer_cart_payments')->insertGetId($insert_data);
				//update payment transaction record
				$update_paydata['amount'] = ceil($get_order_details[0]->sum_amount);
				$update_paydata['transaction_number'] = $transaction_id;
				$update_paydata['status'] = $status;
				$update_paydata['transaction_datetime'] = date('Y-m-d H:i:s');
				DB::table('customer_payment_transactions')->where('order_id',$order_id)->update($update_paydata);
				
				//deduct points
				$get_customer_details = DB::select("select total_points from app_users where user_id='".$user_id."'");
				if(isset($get_customer_details[0]) && $get_order_details[0]->sum_points!='' && $get_order_details[0]->sum_points>0){
					$current_avail_points = $get_customer_details[0]->total_points!=''?$get_customer_details[0]->total_points:0;
					$transactional_points = $current_avail_points-$get_order_details[0]->sum_points;
					//update points in user table
					$update_userdata['total_points'] = $transactional_points;
					DB::table('app_users')->where('user_id',$user_id)->update($update_userdata);
					//insert in points history
					$points_data['customer_user_id'] = $user_id;
					$points_data['points'] = $get_order_details[0]->sum_points;
					$points_data['type'] = 'purchase';
					$points_data['created_date'] = date('Y-m-d H:i:s');
					$points_data['available_points'] = $transactional_points;
					$points_data['credit_type'] = 'debit';
					$insert_user_points = DB::table('customer_points_history')->insertGetId($points_data);
				}
				$api_key = Config::get('constants.options.api_key');
				$api_secret = Config::get('constants.options.api_secret');
				$api = new Api($api_key, $api_secret);
				$paid_amount = (int)ceil($get_order_details[0]->sum_amount);
				$api->payment->fetch($transaction_id)->capture(array('amount'=>$paid_amount*100,'currency' => 'INR'));
			}
		}
		$res_data = array(
			"msg"=>"Payment status updated successfully!",
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function customerOrders(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$orderlist = DB::select("SELECT cc.no_of_items, cc.total_amount, p.product_name,p.product_image,ccp.created_date,
								ccp.dispatched_date,ccp.order_id,ccp.dispatched_status FROM customer_carts cc
								inner join products p on p.product_id=cc.product_id
								inner join (select order_id, dispatched_status, dispatched_date, created_date from customer_cart_payments) as ccp 
								on ccp.order_id=cc.order_id
								where cc.no_of_items>0 and cc.status=1 and cc.user_id='".$user_id."' order by ccp.created_date desc");
		$orders_data=array();
		$skey=0;
		foreach($orderlist as $orderli)
		{
			$orders_data[$skey]['no_of_items'] = (string)$orderli->no_of_items;
			$orders_data[$skey]['amount'] = (string)$orderli->total_amount;
			$orders_data[$skey]['product_name'] = $orderli->product_name;
			$orders_data[$skey]['product_image'] = url('/').'/public/images/'.$orderli->product_image;
			$orders_data[$skey]['ordered_date'] = date('d-M-Y', strtotime($orderli->created_date));
			$orders_data[$skey]['dispatched_date'] = ($orderli->dispatched_date!='')?date('d-M-Y', strtotime($orderli->dispatched_date)):'--';
			$orders_data[$skey]['order_id'] = (string)$orderli->order_id;
			if($orderli->dispatched_status=='0'){
				$orders_data[$skey]['dispatch_status'] = 'Pending';
				$orders_data[$skey]['color_code'] = '#ff875a';
			} else if($orderli->dispatched_status=='1'){
				$orders_data[$skey]['dispatch_status'] = 'Dispatched';
				$orders_data[$skey]['color_code'] = '#28f341';
			} else {
				$orders_data[$skey]['dispatch_status'] = 'Cancelled';
				$orders_data[$skey]['color_code'] = '#ff0000';
			}
			$skey++;
		}
		$res_data['orders_list'] = $orders_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function getcustomerrefcode(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$orderlist = DB::select("SELECT referral_code FROM app_users where user_id='$user_id'");
		$res_data['referral_code'] = $orderlist[0]->referral_code;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function getpaymentkeys(Request $request){
		$input = $request->all();			
		$version='';
		if(isset($input['version'])){
			$version = $input['version'];
		}
		//live creds
		$res_data['key_id'] = Config::get('constants.options.api_key');
		$res_data['key_secret'] = Config::get('constants.options.api_secret');
		$config_data = DB::Table("config_data")->select("customer_email","customer_phone")->first();
		$res_data['customer_email'] = $config_data->customer_email!=''?$config_data->customer_email:'--';
		$res_data['customer_phone'] = $config_data->customer_phone!=''?$config_data->customer_phone:'--';
		$version_status = DB::Table("app_versions")->select("status")->where('version',$version)->where('app_type','customer')->first();
		if(isset($version_status)){
			$res_data['update_status'] = $version_status->status;
		} else {
			$res_data['update_status'] = 'noupdate';
		}
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function cancel_reasons(){
		$reasons_list = DB::select("SELECT * FROM appointment_cancel_reasons where status=1");
		$reasons_array=array();
		$key=0;
		foreach($reasons_list as $reasons_li){
			$reasons_array[$key]['reason_id'] = (string)$reasons_li->reason_id;
			$reasons_array[$key]['reason'] = $reasons_li->reason;
			$key++;
		}
		return $this->sendResponse($reasons_array, 'Data fetched successfully.');
	}

	public function sendnotification(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		$notifications_data = array();
		$notifications_data['title'] = "EZGLAM NEW BOOKING REQUEST";
		$notifications_data['text']  = "Click Here To View Appointment Details";	
		$notifications_data['appointment_id']  = $appointment_id;
		$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
		$notifications_data['sound']  = 'default';
		//$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
									
		Helper::send_pushnotification($notifications_data,'e1iq3z3QRVK-PAt1omVytl:APA91bGvLvr9TQVqlHToraZNY375pWzHYs2D3jEFetjnjzvDynAu6-8cMPhniV6URhRNt0oJCB7e_QpqD-XPnZJ2Bwg8-CyRlcEg3a6PWuock9w8O3ruzka42NS1x41v1Y1DVpASnnA2','vendor');
	}

	public function book_appointment_multiservice(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$address_id='';
		if(isset($input['address_id'])){
			$address_id = $input['address_id'];
		}	
		$service_id='';
		if(isset($input['service_id'])){
			$service_id = $input['service_id'];
		}	
		
		$appointment_id_org='';
		if(isset($input['appointment_id'])){
			$appointment_id_org = $input['appointment_id'];
		}	
		
		$appointment_slot_id='';
		if(isset($input['appointment_slot_id'])){
			$appointment_slot_id = $input['appointment_slot_id'];
		}	
		$appointment_date='';
		if(isset($input['appointment_date'])){
			$appointment_date = $input['appointment_date'];
		}	
		$latitude='';
		if(isset($input['latitude'])){
			$latitude = $input['latitude'];
		}	
		$longitude='';
		if(isset($input['longitude'])){
			$longitude = $input['longitude'];
		}	
		$actual_amount='';
		if(isset($input['actual_amount'])){
			$actual_amount = $input['actual_amount'];
		}	
		$discount_percent='';
		if(isset($input['discount_percent'])){
			$discount_percent = $input['discount_percent'];
		}	

		$doorno='';
		if(isset($input['doorno'])){
			$doorno = $input['doorno'];
		}
		$street='';
		if(isset($input['street'])){
			$street = $input['street'];
		}
		$area='';
		if(isset($input['area'])){
			$area = $input['area'];
		}
		$city ='';
		if(isset($input['city'])){
			$city = $input['city'];
		}
		$state='';
		if(isset($input['state'])){
			$state = $input['state'];
		}
		$pincode='';
		if(isset($input['pincode'])){
			$pincode = $input['pincode'];
		}
		$otp = rand(111111,999999);
		if($appointment_id_org!='' && $service_id!=''){
			$service_id_string = $service_id;
		} else if($appointment_id_org!='' && $service_id==''){
			$getappointment_details = DB::select("select appointment_id, group_concat(service_id) as services_string from appointment_services 
													where appointment_id='$appointment_id_org'");
			$service_id_string = $getappointment_details[0]->services_string;
		} else if($appointment_id_org=='' && $service_id!=''){
			$service_id_string = $service_id;
		} else {
			$service_id_string = '';
		}
		$get_address_details = DB::select("select doorno, street, area, city, state, country, pincode,latitude,longitude from user_address 
											where address_id='$address_id'");
		$today = date('Y-m-d');
		$services_list = DB::select("select s.service_id from services s 
							left join service_categories sc on s.service_id=sc.service_id 
							left join categories c on c.category_id=sc.category_id 
							where s.service_id in (select service_id from appointment_services_cart where user_id='$user_id' and status=1 and 
							DATE(created_date)='$today' and appointment_id is null group by service_id)");
		if(count($services_list)>0){
			//insert appointment
			$insert_data['user_id'] = $user_id;
			//$insert_data['service_id'] = $service_id;
			$insert_data['appointment_slot_id'] = $appointment_slot_id;
			$insert_data['appointment_date'] = date('Y-m-d', strtotime($appointment_date));
			$insert_data['latitude'] = $latitude;
			$insert_data['longitude'] = $longitude;
			$insert_data['otp'] = $otp;		
			$insert_data['created_by'] = $user_id;
			$insert_data['created_date'] = date('Y-m-d H:i:s');
			$checkstatus=0;
			if(!empty($appointment_id_org)){		
				$insert_data['status'] = 'pending';
				$getvendor_id = DB::table('appointments')->select("vendor_id","service_id","status")->where('appointment_id',$appointment_id_org)->first();
				if($getvendor_id->vendor_id!='' && $getvendor_id->status=='Completed'){
					$app_type = 'repeat';
					$insert_data['type'] = $app_type;
				} else {
					$app_type = 'direct';
					$insert_data['type'] = $app_type;
				}
			}else{
				$app_type = 'direct';
				$insert_data['status'] = 'pending';
				$insert_data['type'] = $app_type;
			}
			$appointment_id = DB::table('appointments')->insertGetId($insert_data);
			
			
			//insert multi services
			// if($service_id_string!=''){
			// 	$string_ids_array = explode(',',$service_id_string);
				foreach($services_list as $string_ids_arr){
					$string_ids_arr = $string_ids_arr->service_id;
					$getservice_details = DB::table('services')->select("customer_referral_points","price_per_unit","discount_perent")
																->where('service_id',$string_ids_arr)->first();
					if(isset($getservice_details)){
						$discount_amount_val = $getservice_details->price_per_unit-(($getservice_details->discount_perent / 100) * $getservice_details->price_per_unit);
						$insert_muldata['appointment_id'] = $appointment_id;
						$insert_muldata['service_id'] = $string_ids_arr;
						$insert_muldata['bonus_points'] = $getservice_details->customer_referral_points;
						$insert_muldata['actual_amount'] = $getservice_details->price_per_unit;
						$insert_muldata['discount_amount'] = $getservice_details->discount_perent!=''?round($discount_amount_val):'';
						$insert_muldata['discount_percent'] = $getservice_details->discount_perent;
						$insert_muldata['status'] = '1';
						$insert_muldata['created_date'] = date('Y-m-d H:i:s');
						$insert_muldata['created_by'] = '1';
						DB::table('appointment_services')->insert($insert_muldata);
					}
				}
			//}
			//insert details
			$insert_appointdet['appointment_id'] = $appointment_id;
			$insert_appointdet['doorno'] = $get_address_details[0]->doorno;
			$insert_appointdet['street'] = $get_address_details[0]->street;
			$insert_appointdet['area'] = $get_address_details[0]->area;
			$insert_appointdet['city'] = $get_address_details[0]->city;
			$insert_appointdet['state'] = $get_address_details[0]->state;
			$insert_appointdet['country'] = 'India';
			$insert_appointdet['pincode'] = $get_address_details[0]->pincode!=''?$get_address_details[0]->pincode:NULL;
			$insert_appointdet['created_by'] = $user_id;
			$insert_appointdet['created_date'] = date('Y-m-d H:i:s');
			$appointment_details_id = DB::table('appointment_details')->insertGetId($insert_appointdet);
			
			//update service cart 
			$today = date('Y-m-d');
			$update_service_cart['appointment_id'] = $appointment_id;
			DB::table('appointment_services_cart')->where('user_id',$user_id)
													->where(DB::raw("DATE(created_date)"),$today)
													->where('appointment_id', NULL)
													->where('status', '1')
													->update($update_service_cart);
			$latitude = $get_address_details[0]->latitude;
			$longitude = $get_address_details[0]->longitude;
			//if($checkstatus==0){
				$this->sendpartnerpushnotifications($appointment_id,$latitude,$longitude,$app_type,$appointment_id_org);
			//}		
			
			$res_data = array("msg"=>"Your appointment booked successfully. We will contact you soon","status"=>"Success");
		} else {
			$res_data = array("msg"=>"Please select atleast one service","status"=>"Failed");
		}
		
		
		/*$notifications_data = array();
										$notifications_data['title'] = "RBIS Alert";
										$notifications_data['text']  = "Dear WDS/WEA, ".$val->pendingpensioners." Pensioners not enrolled from your side. Please enroll them immediately";	
										$notifications_data['direct_contact'] =	1;
										$notifications_data['alert_message'] =	"Dear WDS/WEA, ".$val->pendingpensioners." Pensioners not enrolled from your side. Please enroll them immediately"; 
										
				
		Helper::send_pushnotification($notifications_data,$val->device_id);	*/
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function save_service_cart(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$service_id='';
		if(isset($input['service_id'])){
			$service_id = $input['service_id'];
		}
		$is_selected='1';
		if(isset($input['is_selected'])){
			$is_selected = $input['is_selected'];
		}	
		$today = date('Y-m-d');
		$check_cart_service = DB::select("select * from appointment_services_cart 
											where user_id='".$user_id."' and service_id='".$service_id."' and DATE(created_date)='".$today."' 
											and appointment_id is NULL");
		if(count($check_cart_service)==0){
			$insert_service_cart['user_id'] = $user_id;
			$insert_service_cart['service_id'] = $service_id;
			$insert_service_cart['status'] = '1';
			$insert_service_cart['created_date'] = date('Y-m-d H:i:s');
			DB::table('appointment_services_cart')->insert($insert_service_cart);
		} else {
			$update_service_data['status'] = $is_selected;
			DB::table('appointment_services_cart')->where('user_id',$user_id)
												->where('service_id',$service_id)
												->where('appointment_id', NULL)
												->where(DB::raw("DATE(created_date)"),$today)
												->update($update_service_data);
		}
		
		$res_data = array(
			"msg"=>"Service cart Updated successfully",
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function get_servicecart_list(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$today = date('Y-m-d');
		$services_list = DB::select("select s.service_id,s.service_description,s.service_name,s.image,price_per_unit,discount_perent,
										estimated_time,s.customer_referral_points from services s 
										left join service_categories sc on s.service_id=sc.service_id 
										left join categories c on c.category_id=sc.category_id 
										where s.service_id in (select service_id from appointment_services_cart where user_id='$user_id' and status=1 and 
										DATE(created_date)='$today' and appointment_id is null group by service_id)");
		$skey=0;
		$services_data=array();
		$actual_price = 0;
		$discount_price = 0;
		$discount_price_val = 0;
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['service_id'] = (string)$services_lis->service_id;
			$services_data[$skey]['service_name'] = $services_lis->service_name;
			$services_data[$skey]['image'] = url('/').'/public/images/'.$services_lis->image;
			$services_data[$skey]['price_per_unit'] = (string)$services_lis->price_per_unit;
			$services_data[$skey]['service_description'] = $services_lis->service_description;
			$services_data[$skey]['discount_perent'] = (string)$services_lis->discount_perent;
			$services_data[$skey]['estimated_time'] = $services_lis->estimated_time."min";
			$services_data[$skey]['product_name'] =  "";
			$services_data[$skey]['product_image'] =  "";
			$services_data[$skey]['brand_name'] =  "";
			$services_data[$skey]['customer_referral_points'] = $services_lis->customer_referral_points!=''?(string)$services_lis->customer_referral_points:'0';
			if($services_lis->discount_perent>0){
				$discount_amount = $services_lis->discount_perent*$services_lis->price_per_unit/100;
				$discount_price = $services_lis->price_per_unit - $discount_amount;
			} else {
				$discount_price = '0';
			}
			$services_data[$skey]['discount_price'] = (string)$discount_price;
			$services_data[$skey]['service_rating'] = '3';
			$actual_price = $actual_price + $services_lis->price_per_unit;
			$discount_price_val = $discount_price_val + $discount_price;
			$skey++;
		}
		$res_data['services_list'] = $services_data;
		$res_data['total_actual_amount'] = (string)$actual_price;
		$disc_amt = $actual_price-$discount_price_val;
		$res_data['amount_saved'] = (string)$disc_amt;
		$res_data['total_discount_amount'] = (string)$discount_price_val;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function save_user_address(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}
		$full_name='';	
		if(isset($input['full_name'])){
			$full_name = $input['full_name'];
		}
		$address_id='';
		if(isset($input['address_id'])){
			$address_id = $input['address_id'];
		}
		$latitude='';
		if(isset($input['latitude'])){
			$latitude = $input['latitude'];
		}	
		$longitude='';
		if(isset($input['longitude'])){
			$longitude = $input['longitude'];
		}	
		$doorno='';
		if(isset($input['doorno'])){
			$doorno = $input['doorno'];
		}
		$street='';
		if(isset($input['street'])){
			$street = $input['street'];
		}
		$area='';
		if(isset($input['area'])){
			$area = $input['area'];
		}
		$city ='';
		if(isset($input['city'])){
			$city = $input['city'];
		}
		$state='';
		if(isset($input['state'])){
			$state = $input['state'];
		}
		$pincode='';
		if(isset($input['pincode'])){
			$pincode = $input['pincode'];
		}
		$today = date('Y-m-d');
		$insert_service_cart['full_name'] = ucwords(strtolower($full_name));
		$insert_service_cart['user_id'] = $user_id;
		$insert_service_cart['doorno'] = $doorno;
		$insert_service_cart['street'] = $street;
		$insert_service_cart['area'] = $area;
		$insert_service_cart['city'] = $city;
		$insert_service_cart['state'] = $state;
		$insert_service_cart['country'] = 'India';
		$insert_service_cart['pincode'] = $pincode;
		$insert_service_cart['latitude'] = $latitude;
		$insert_service_cart['longitude'] = $longitude;
		$insert_service_cart['status'] = '1';
		$insert_service_cart['is_deleted'] = '0';
		if($address_id==''){
			$insert_service_cart['created_by'] = $user_id;
			$insert_service_cart['created_date'] = date('Y-m-d H:i:s');
			DB::table('user_address')->insert($insert_service_cart);
			$message = "Address details inserted successfully";
		} else {
			$insert_service_cart['modified_by'] = $user_id;
			$insert_service_cart['modified_date'] = date('Y-m-d H:i:s');
			DB::table('user_address')->where('address_id',$address_id)
										->update($insert_service_cart);
			$message = "Address details updated successfully";
		}
		$res_data = array(
			"msg"=>$message,
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function get_useraddress_list(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$today = date('Y-m-d');
		$addresss_list = DB::select("select * from user_address where user_id='$user_id' and status=1 and is_deleted=0 order by address_id desc");
		$skey=0;
		$services_data = array();
		foreach($addresss_list as $addresss_lis)
		{
			$address_details = array();
			$services_data[$skey]['address_id'] = (string)$addresss_lis->address_id;
			$services_data[$skey]['full_name'] = (string)$addresss_lis->full_name;
			if($addresss_lis->doorno!=''){
				$address_details[] = $addresss_lis->doorno;
			}
			if($addresss_lis->street!=''){
				$address_details[] = $addresss_lis->street;
			}
			if($addresss_lis->area!=''){
				$address_details[] = $addresss_lis->area;
			}
			if($addresss_lis->city!=''){
				$address_details[] = $addresss_lis->city;
			}
			if($addresss_lis->pincode!=''){
				$address_details[] = $addresss_lis->pincode;
			}
			
			$services_data[$skey]['address'] = (string)implode(',',$address_details);
			$services_data[$skey]['image'] = url('/').'/public/assets/images/location_image.JPG';
			$skey++;
		}
		$res_data['addresss_list'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function remove_address(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$address_id='';
		if(isset($input['address_id'])){
			$address_id = $input['address_id'];
		}
		$insert_service_cart['status'] = 0;
		DB::table('user_address')->where('address_id',$address_id)
									->update($insert_service_cart);
		$message = "Address details removed successfully";
		$res_data = array(
			"msg"=>$message,
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
}  
