<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use DB, Config;
use App\Helpers\EncDecHelper;
use App\Helpers\Helper as Helper;
use Razorpay\Api\Api;


ini_set('max_execution_time', '3000000'); //300 seconds = 5 minutes

class PartnerController extends BaseController
{
	
	
	public function types_list(){
		$cities_list = DB::select("select * from types where status='1'");
		$cities_data=array();
		$skey=0;
		foreach($cities_list as $cities_lis)
		{
			$cities_data[$skey]['type_id'] = (string)$cities_lis->type_id;
			$cities_data[$skey]['type'] = $cities_lis->type;
			$cities_data[$skey]['color_code'] = $cities_lis->color;
			$skey++;
		}
		$res_data['types_list'] = $cities_data;
		$res_data['count'] = count($cities_data);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	
	public function sampletoken(){
		
			$notifications_data = array();
			$notifications_data['title'] = "EZGLAM Alert";
			$notifications_data['text']  = "EZGLAM SAMPLE MESSAGE";	
			$notifications_data['appointment_id']  = "1";	
										
			Helper::send_pushnotification($notifications_data,"d2Q8ZWnAQ_2EAv7b8A27fD:APA91bEs19moz-07rhMSO-rcGpZBrhXfwh6xNO9JyPsR2qAhIgYgFogLj--oEAoLB3xU5bu-sF6Kum9bFBOdwm_lkYDpaRj1V0o1oHrZbmeItKDUOujE9VFn_CJ0WpJGHZD1jtWKskSz",'vendor');
		
	}
	
	public function partner_wallet(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}
		
		$checkUserLogin3 = DB::select("select ifnull(total_paid_points,0) as total_paid_points,ifnull(total_bonus_points,0) as total_bonus_points from partners where partner_id='".$partner_id."'");
		
		if(count($checkUserLogin3)>0){
		
		$UserSessionData = array(
								  'paid_balance'=>$checkUserLogin3[0]->total_paid_points,
								  'promotional_balance'=>$checkUserLogin3[0]->total_bonus_points
                                );
								
		}else{
			
			$UserSessionData = array(
								  'paid_balance'=>0,
								  'promotional_balance'=>0
                                );
			
		}
								
		return $this->sendResponse($UserSessionData, 'Data fetched successfully.');						
		
		


	}
	

	public function verify_partnercredentials(Request $request){
		$input = $request->all();			
		$username='';
		if(isset($input['username'])){
			$username = $input['username'];
		}

		$password='';
		if(isset($input['password'])){
			$password = $input['password'];
		}
		
		$token='';
		if(isset($input['token'])){
			$token = $input['token'];
		}
		
		
      $encpassword = EncDecHelper::enc_string($password);
      $checkUserLogin = DB::select("select * from login where username='".$username."' and password='".$encpassword."' and status=1");
	  $config_data = DB::Table("config_data")->select("customer_email","customer_phone")->first();
		// $res_data['customer_email'] = $config_data->customer_email!=''?$config_data->customer_email:'--';
		// $res_data['customer_phone'] = $config_data->customer_phone!=''?$config_data->customer_phone:'--';
      if(count($checkUserLogin)>0){
		  
		  $checkUserLogin3 = DB::select("select ifnull(total_paid_points,0) as total_paid_points,ifnull(total_bonus_points,0) as total_bonus_points from partners where partner_id='".$checkUserLogin[0]->user_id."'");
		  
        $UserSessionData = array(
                                  'partner_id'=>(string)$checkUserLogin[0]->user_id,
                                  'loginid'=>(string)$checkUserLogin[0]->loginid,
                                  'username'=>$checkUserLogin[0]->username,
                                  'role_id'=>(string)$checkUserLogin[0]->role_id,
                                  'display_name'=>$checkUserLogin[0]->display_name,
								  'is_password_update'=>(string)$checkUserLogin[0]->is_password_update,
								  'paid_balance'=>(string)$checkUserLogin3[0]->total_paid_points,
								  'promotional_balance'=>(string)$checkUserLogin3[0]->total_bonus_points,
								  "key_id"=>Config::get('constants.options.api_key'),  //production id
								  "key_secret"=>Config::get('constants.options.api_secret'), //production key id
								  "customer_email"=>$config_data->customer_email!=''?$config_data->customer_email:'--',
								  "customer_phone"=>$config_data->customer_phone!=''?$config_data->customer_phone:'--'
                                );
								
			$insert_data['fcm_token_id'] = $token;				
			$insert_data2['last_login'] = date('Y-m-d H:i:s');			
			
			DB::table('partners')->where('partner_id',$checkUserLogin[0]->user_id)->update($insert_data);	

			DB::table('login')->where('loginid',$checkUserLogin[0]->loginid)->update($insert_data2);		
								
			$res_data = array('status'=>"success",'message'=>'success','data'=>$UserSessionData);				
								
	  }else{
			$UserSessionData = array(
			'partner_id'=>'',
			'loginid'=>'',
			'username'=>'',
			'role_id'=>'',
			'display_name'=>'',
			'is_password_update'=>'',
			'paid_balance'=>'',
			'promotional_balance'=>'',
			"key_id"=>Config::get('constants.options.api_key'),  //production id
			"key_secret"=>Config::get('constants.options.api_secret'), //production key id
			"customer_email"=>$config_data->customer_email!=''?$config_data->customer_email:'--',
			"customer_phone"=>$config_data->customer_phone!=''?$config_data->customer_phone:'--'
		  );
		  $res_data = array('status'=>"failed",'message'=>'Invalid Credentials','data'=>$UserSessionData);			  
	  }
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}	
	
	
	public function add_service(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		$service_id='';
		if(isset($input['service_id'])){
			$service_id = $input['service_id'];
		}	
		
		$checkserviceadded = DB::select("select user_id from partner_services where user_id='".$partner_id."' and service_id='".$service_id."'");
		if(count($checkserviceadded)==0){
		
			$insert_data['user_id'] = $partner_id;
			$insert_data['service_id'] = $service_id;
			$insert_data['status'] = "1";
			$insert_data['created_date'] = date('Y-m-d H:i:s');			
			$insert_data['updated_date'] = date('Y-m-d H:i:s');
			$checkUserLogin = DB::table('partner_services')->insertGetId($insert_data);
			
			if($checkUserLogin>0){
				$res_data = array(
					"msg"=>"Service added successfully",
					"status"=>"Success"
				);			
			}else{
				$res_data = array(
				"msg"=>"Something went wrong. Please try again","status"=>"Failed"
				);
			
			}	
		}else{
			$res_data = array(
				"msg"=>"Service already added.","status"=>"Failed"
				);
			
		}
			
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}


	public function update_password(Request $request){  

		$input = $request->all();		
			
		$old_password='';
		if(isset($input['old_password'])){
			$old_password = $input['old_password'];
		}
		
		$new_password='';
		if(isset($input['new_password'])){
			$new_password = $input['new_password'];
		}
		
		$confirm_password='';
		if(isset($input['confirm_password'])){
			$confirm_password = $input['confirm_password'];
		}
		
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}
		
		
		$encpassword = EncDecHelper::enc_string($old_password);	
		
		$check_oldpwd = DB::Table("login")->select("username")->where("user_id",$partner_id)->where('password',$encpassword)->first();	

		//echo $this->db->last_query(); die;
		if(isset($check_oldpwd->username)){
			if($new_password == $confirm_password){
				
				$new_password2 = EncDecHelper::enc_string($new_password);
				
				DB::Table("login")->where("user_id",$partner_id)->update(['password'=>$new_password2,'is_password_update'=>'1','password_update_date'=>date('Y-m-d H:i:s')]);   
				$res_data = array(
					"msg"=>"Password Successfully updated",
					"status"=>"Success"
				);
				
			}else {
				$res_data = array(
				"msg"=>"New and Confirm Passwords Mismatched","status"=>"Failed"
				);
			}
		} else {
			$res_data = array(
				"msg"=>"Current password incorrect","status"=>"Failed"
				);
		}
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}	

	
	public function delete_service(Request $request){
		$input = $request->all();			
		$partner_service_id='';
		if(isset($input['partner_service_id'])){
			$partner_service_id = $input['partner_service_id'];
		}	
			
			$insert_data['status'] = "0";		
			$insert_data['updated_date'] = date('Y-m-d H:i:s');
			$checkUserLogin = DB::table('partner_services')->where('partner_service_id',$partner_service_id)->update($insert_data);
			
			if($checkUserLogin>0){
				$res_data = array(
					"msg"=>"Service Deleted successfully",
					"status"=>"Success"
				);			
			}else{
				$res_data = array(
				"msg"=>"Something went wrong. Please try again","status"=>"Failed"
				);
			
			}			
			
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function partnerprofile(Request $request){
		
		$input = $request->all();	
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		$cities_list = DB::select("select partner_id,ifnull(first_name,'') as first_name,ifnull(last_name,'') as last_name,
		ifnull(email,'') as email,ifnull(gender,'') as gender,ifnull(address,'') as address,ifnull(mobile,'') as mobile,
		ifnull(total_paid_points,0) as total_paid_points,ifnull(total_bonus_points,0) as total_bonus_points,ifnull(profile_picture,'') as profile_picture
 from partners a where partner_id='".$partner_id."'");
		$data['partner_id'] = $cities_list[0]->partner_id;
		$data['first_name'] = $cities_list[0]->first_name;
		$data['last_name'] = $cities_list[0]->last_name;
		$data['email'] = $cities_list[0]->email;
		$data['gender'] = $cities_list[0]->gender;

		$data['address'] = $cities_list[0]->address;
		$data['mobile'] = $cities_list[0]->mobile;
		$data['total_paid_points'] = $cities_list[0]->total_paid_points;
		$data['total_bonus_points'] = $cities_list[0]->total_bonus_points;
		$data['profile_picture'] = $cities_list[0]->profile_picture!=''?url('/').'/public/images/userimages/'.$cities_list[0]->profile_picture:'';
		return $this->sendResponse($data, 'Data fetched successfully.');
	}
	
	public function payment_modes(){
		$cities_list = DB::select("select * from payment_modes where status='1'");
		$cities_data=array();
		$skey=0;
		foreach($cities_list as $cities_lis)
		{
			$cities_data[$skey]['payment_modes_id'] = (string)$cities_lis->payment_modes_id;
			$cities_data[$skey]['payment_modes'] = $cities_lis->payment_modes;
			$cities_data[$skey]['mobile_number'] = $cities_lis->number!=''?(string)$cities_lis->number:'--';
			$skey++;
		}
		$res_data['types_list'] = $cities_data;
		$res_data['disclaimer'] = "Transfer money to specified number and upload paid receipt.";
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function updateappointment(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		$status='';
		if(isset($input['status'])){
			$status = $input['status'];
		}	
		if($status == 'approve'){
			$checkUserLogin = DB::select("select asr.service_id, a.appointment_id,a.appointment_date,a.appointment_slot_id,
										s.product_id,ifnull(s.paid_points_redeem,0) as paid_points_redeem,
										ifnull(s.bonus_points_redeem,0) as bonus_points_redeem, a.status from appointment_services asr
										inner join appointments a on a.appointment_id=asr.appointment_id
										inner join services s on s.service_id=asr.service_id
										where asr.appointment_id='".$appointment_id."' and asr.status=1 and a.vendor_id is not null");

			// $checkUserLogin = DB::select("select a.service_id,au.fcm_token_id,a.appointment_id,s.product_id,ifnull(s.paid_points_redeem,0) as paid_points_redeem,
			// ifnull(s.bonus_points_redeem,0) as bonus_points_redeem,a.appointment_date,a.appointment_slot_id, a.status from appointments a 
			// inner join app_users au on a.user_id=au.user_id 
			// inner join services s on s.service_id=a.service_id 
			// where appointment_id='".$appointment_id."' and vendor_id is null");

			if(count($checkUserLogin)>0 && $checkUserLogin[0]->status=='pending'){
				$checkbonuspoints = DB::select("select ifnull(total_paid_points,0) as total_paid_points,ifnull(total_bonus_points,0) as total_bonus_points from partners where partner_id='".$partner_id."'");	
				
				$sum_service_points = DB::select("select sum(paid_points_redeem) as tot_paid_points_redeem, sum(bonus_points_redeem) as tot_bonus_points_redeem from services
												where service_id in (select service_id from appointment_services where appointment_id='".$appointment_id."' and status=1)");	
				if($sum_service_points[0]->tot_paid_points_redeem<=$checkbonuspoints[0]->total_paid_points){
					
					$total_userpoints = $checkbonuspoints[0]->total_paid_points+$checkbonuspoints[0]->total_bonus_points;
					$total_servicepoints = $sum_service_points[0]->tot_paid_points_redeem+$sum_service_points[0]->tot_bonus_points_redeem;
				
					if($total_userpoints>=$total_servicepoints){
						$checkvendor_availability = DB::select("select ifnull(appointment_id,0) as appointment_id from appointments 
							where vendor_id='".$partner_id."' and date(appointment_date)='".$checkUserLogin[0]->appointment_date."' 
							and appointment_slot_id='".$checkUserLogin[0]->appointment_slot_id."' and status in ('Approved','Started')");
						if(count($checkvendor_availability)==0){
							$return_msg = "";
							$success_count=0;
							$total_count=0;
							foreach($checkUserLogin as $checkUserLog){
								$checkserviceproductstatus = DB::select("select sp.product_id,sp.no_of_times_usable,sp.required_percentage,p.product_name from service_categories s 
								inner join service_category_products sp on s.service_category_id=sp.service_category_id 
								inner join products p on sp.product_id=p.product_id 
								where s.service_id='".$checkUserLog[0]->service_id."'");
								foreach($checkserviceproductstatus as $singlecheckserviceproductstatus){
									$checkproducts_count = DB::select("select quantity,product_percentage from partner_products where partner_id='".$partner_id."' and product_id='".$singlecheckserviceproductstatus->product_id."'");
									if(count($checkproducts_count)>0 && $checkproducts_count[0]->quantity>0 && $checkproducts_count[0]->product_percentage>=$singlecheckserviceproductstatus->required_percentage){
										$return_msg .= "<p>".$singlecheckserviceproductstatus->product_name." product is available with you</p>";
										$success_count++;
									}else{
										$checkavailabledistributors = DB::SELECT("select dh.distributor_product_id,dd.distirbutor_id,.dh.quantity,concat(first_name,' ',last_name) as firstname,phone_number,hub_location_address,dh.available_quantity from partner_hubs ph 
																		inner join distributor_hubs d on ph.hub_id=d.hub_id 
																		inner join distributor_products dh on d.distributor_id=dh.distributor_id 
																		inner join distirbutors dd on dd.distirbutor_id=dh.distributor_id 
																		where dh.product_id='".$singlecheckserviceproductstatus->product_id."' and dh.available_quantity>0");
										if(count($checkavailabledistributors)>0){
											$return_msg .= "<p> Sorry you don't have <b>".$singlecheckserviceproductstatus->product_name."</b> product to serve this service</p><p> Please contact below distributor </p><p><b> Name : '".$checkavailabledistributors[0]->firstname."' </b> </p> <p><b> Phone Number : '".$checkavailabledistributors[0]->phone_number."' </b> </p>";
										}else{
											$return_msg .= "<p>Service Product <b>".$singlecheckserviceproductstatus->product_name."</b> Not Available nearest distributors, please contact admin</p>";
										}
									}
									$total_count++;
								}
							}
							
							if($total_count>0 && ($success_count==$total_count)){
								$res_data = array(
									"is_enable_popup"=>"0",
									"msg"=>$return_msg,
									"display_msg"=>$return_msg,
									"status"=>"Success",
									"recharge_option"=>"0"
								);					
								
							}else if($total_count>0 && $success_count!=$total_count){
								$res_data = array(
									"is_enable_popup"=>"1",
									"msg"=>$return_msg,
									"display_msg"=>$return_msg,
									"status"=>"Success","recharge_option"=>"0"
								);	
							}else{
								$res_data = array(
									"is_enable_popup"=>"0",
									"msg"=>"No Products mapped to this service","status"=>"Success",
									"display_msg"=>"<p> No Products mapped to this service</p>","recharge_option"=>"0");
							}
							
							//loop completed
						}else{
							$res_data = array(
									"msg"=>"You cannot Accept this Service, you have already scheduled another service at same slot","status"=>"Success",
									"display_msg"=>"<p> You cannot Accept this Service, you have already scheduled another service at same slot</p>","recharge_option"=>"0"
							);	
							
						}
					}else{
						$res_data = array(
							"msg"=>"Please Recharge your wallet , you don't have enough points to serve this service","status"=>"Success","display_msg"=>"<p>Please Recharge your wallet , you don't have enough points to serve this service</p>","recharge_option"=>"1",
						);				
					}
				}else{
					$res_data = array(
					"msg"=>"Please Recharge your wallet , you don't have enough points to serve this service","status"=>"Success","display_msg"=>"<p>Please Recharge your wallet , you don't have enough points to serve this service</p>","recharge_option"=>"1",
					);				
				}
			}else{
				$res_data = array(
					"msg"=>"Sorry, This Service already accepted other partner or cancelled by Customer.","status"=>"Failed","recharge_option"=>"0"
				);
			}		
		} else {
			//rejected partners list
			$appoint_reject['appointment_id'] = $appointment_id;
			$appoint_reject['partner_id'] = $partner_id;
			$appoint_reject['created_date'] = date('Y-m-d H:i:s');
			DB::table('appointment_rejected_partners')->insert($appoint_reject);
			//send pushnotifications
			$getappointment_details = DB::table('appointments')->select("appointment_id","service_id","status","vendor_id","latitude","longitude","type")
									->where('appointment_id',$appointment_id)->first();
			if($getappointment_details->type=='repeat'){
				$this->sendpartnerpushnotificationsrepeat($appointment_id,$getappointment_details->latitude,$getappointment_details->longitude,$getappointment_details->type,$partner_id);
			}
			$res_data = array(
				"msg"=>"Service Rejected successfully",
				"display_msg"=>"Service Rejected successfully",
				"status"=>"Success",
				"recharge_option"=>"0"
			);	
		}
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	
	public function confirmpartnerapproval(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		$checkUserLogin = DB::select("select asr.service_id, a.appointment_id,a.appointment_date,a.appointment_slot_id,
										s.product_id,ifnull(s.paid_points_redeem,0) as paid_points_redeem,
										ifnull(s.bonus_points_redeem,0) as bonus_points_redeem, a.status from appointment_services asr
										inner join appointments a on a.appointment_id=asr.appointment_id
										inner join services s on s.service_id=asr.service_id
										where asr.appointment_id='".$appointment_id."' and asr.status=1 and a.vendor_id is not null");
		if(count($checkUserLogin)>0){
			$checkbonuspoints = DB::select("select ifnull(total_paid_points,0) as total_paid_points,ifnull(total_bonus_points,0) as total_bonus_points from partners 
											where partner_id='".$partner_id."'");	
			$sum_service_points = DB::select("select sum(paid_points_redeem) as tot_paid_points_redeem, sum(bonus_points_redeem) as tot_bonus_points_redeem from services
											where service_id in (select service_id from appointment_services where appointment_id='".$appointment_id."' and status=1)");		

			if($sum_service_points[0]->tot_paid_points_redeem<=$checkbonuspoints[0]->total_paid_points){
				$total_userpoints = $checkbonuspoints[0]->total_paid_points+$checkbonuspoints[0]->total_bonus_points;
				$total_servicepoints = $sum_service_points[0]->tot_paid_points_redeem+$sum_service_points[0]->tot_bonus_points_redeem;
				if($total_userpoints>=$total_servicepoints){
					$checkvendor_availability = DB::select("select ifnull(appointment_id,0) as appointment_id from appointments 
						where vendor_id='".$partner_id."' and date(appointment_date)='".$checkUserLogin[0]->appointment_date."' 
						and appointment_slot_id='".$checkUserLogin[0]->appointment_slot_id."' and status in ('Approved','Started')");
				
					if(count($checkvendor_availability)==0){
						$checkserviceproductstatus = DB::select("select sp.product_id,sp.no_of_times_usable,p.product_name from service_categories s 
																inner join service_category_products sp on s.service_category_id=sp.service_category_id 
																inner join products p on sp.product_id=p.product_id 
																where s.service_id='".$checkUserLogin[0]->service_id."'");
						$return_msg = "";
						$success_count=0;
						foreach($checkserviceproductstatus as $singlecheckserviceproductstatus){
							$checkproducts_count = DB::select("select quantity from partner_products 
										where partner_id='".$partner_id."' and product_id='".$singlecheckserviceproductstatus->product_id."'");
							if(count($checkproducts_count)>0 && $checkproducts_count[0]->quantity>0){

							}else{
								$checkavailabledistributors = DB::SELECT("select dh.distributor_product_id,dd.distirbutor_id,.dh.quantity,concat(first_name,' ',last_name) as firstname,phone_number,
																			hub_location_address,dh.available_quantity from partner_hubs ph 
																			inner join distributor_hubs d on ph.hub_id=d.hub_id 
																			inner join distributor_products dh on d.distributor_id=dh.distributor_id 
																			inner join distirbutors dd on dd.distirbutor_id=dh.distributor_id 
																			where dh.product_id='".$singlecheckserviceproductstatus->product_id."' and dh.available_quantity>0");
								if(count($checkavailabledistributors)>0){
									$insert_product_block_data['appointment_id'] = $appointment_id;
									$insert_product_block_data['partner_id'] = $partner_id;
									$insert_product_block_data['product_id'] = $singlecheckserviceproductstatus->product_id;
									$insert_product_block_data['quantity'] = "1";
									//$insert_product_block_data['vendor_id'] = $partner_id;
									$insert_product_block_data['created_date'] = date('Y-m-d H:i:s');
									DB::table('product_block_log')->insert($insert_product_block_data);
								}else{
									
								}
							}
							$success_count++;
						}
						if($success_count>0){
							//INSERT INto log
							$checkUserLogin = DB::select("select a.user_id,a.service_id,au.fcm_token_id,a.appointment_id,s.product_id,
														ifnull(s.paid_points_redeem,0) as paid_points_redeem,
														ifnull(s.bonus_points_redeem,0) as bonus_points_redeem,a.appointment_date,a.appointment_slot_id, a.status from appointments a 
														inner join app_users au on a.user_id=au.user_id 
														inner join services s on s.service_id=a.service_id 
														where appointment_id='".$appointment_id."' and vendor_id is null");
				
							$checkbonuspoints = DB::select("select ifnull(total_paid_points,0) as total_paid_points,ifnull(total_bonus_points,0) as total_bonus_points from partners 
															where partner_id='".$partner_id."'");	
							$sum_service_points = DB::select("select sum(paid_points_redeem) as tot_paid_points_redeem, sum(bonus_points_redeem) as tot_bonus_points_redeem from services
															where service_id in (select service_id from appointment_services where appointment_id='".$appointment_id."' and status=1)");										
							if($checkbonuspoints[0]->total_bonus_points>=$sum_service_points[0]->tot_bonus_points_redeem){
								$paid_deduct_points = $sum_service_points[0]->tot_paid_points_redeem;
								$bonus_deduct_points = $sum_service_points[0]->tot_bonus_points_redeem;
							} else {
								$deduct_points = $sum_service_points[0]->tot_bonus_points_redeem-$checkbonuspoints[0]->total_bonus_points;
								$paid_deduct_points = $sum_service_points[0]->tot_paid_points_redeem+$deduct_points;
								$bonus_deduct_points = $checkbonuspoints[0]->total_bonus_points;
							}
							$update_data['total_paid_points'] = (int)$checkbonuspoints[0]->total_paid_points-$paid_deduct_points;
							$update_data['total_bonus_points'] = (int)$checkbonuspoints[0]->total_bonus_points-$bonus_deduct_points;
							DB::table('partners')->where('partner_id',$partner_id)->update($update_data);
							$insert_deduct_log['appointment_id'] = $appointment_id;
							$insert_deduct_log['partner_id'] = $partner_id;
							$insert_deduct_log['paid_points'] = $paid_deduct_points;
							$insert_deduct_log['bonus_points'] = $bonus_deduct_points;
							$insert_deduct_log['created_date'] = date('Y-m-d H:i:s');
							DB::table('deduct_points_history')->insert($insert_deduct_log);
							//Approve appointment
							$insert_data['vendor_id'] = $partner_id;
							$insert_data['status'] = "Approved";			
							$insert_data['modified_date'] = date('Y-m-d H:i:s');
							$checkUserLogin2 = DB::table('appointments')->where('appointment_id',$appointment_id)->update($insert_data);
							
							$notifications_data = array();
							$notifications_data['title'] = "EZGLAM SERVICE REQUEST APPROVED";
							$notifications_data['text']  = "Click Here To View Appointment Details";	
							$notifications_data['appointment_id']  = $checkUserLogin[0]->appointment_id;
							$notifications_data['user_id']  = $checkUserLogin[0]->user_id;
							$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
							$notifications_data['type']  = 'details';
							Helper::send_pushnotification($notifications_data,$checkUserLogin[0]->fcm_token_id,'customer');

							if($checkbonuspoints[0]->total_bonus_points>=$sum_service_points[0]->tot_bonus_points_redeem){
								$paid_deduct_points = $sum_service_points[0]->tot_paid_points_redeem;
								$bonus_deduct_points = $sum_service_points[0]->tot_bonus_points_redeem;
							} else {
								$deduct_points = $sum_service_points[0]->tot_bonus_points_redeem-$checkbonuspoints[0]->total_bonus_points;
								$paid_deduct_points = $sum_service_points[0]->tot_paid_points_redeem+$deduct_points;
								$bonus_deduct_points = $checkbonuspoints[0]->total_bonus_points;
							}


							$update_data['total_paid_points'] = (int)$checkbonuspoints[0]->total_paid_points-$paid_deduct_points;
							$update_data['total_bonus_points'] = (int)$checkbonuspoints[0]->total_bonus_points-$bonus_deduct_points;
							DB::table('partners')->where('partner_id',$partner_id)->update($update_data);

							$insert_data_1['partner_id'] = $partner_id;
							$insert_data_1['points'] =$paid_deduct_points;
							$insert_data_1['total_points'] = $update_data['total_paid_points'];
							$insert_data_1['type'] = "paid";
							$insert_data_1['amount'] = NULL;
							$insert_data_1['credit_type'] = 'debit';
							$insert_data_1['created_date'] = date('Y-m-d H:i:s');

							DB::table('partner_points_history')->insert($insert_data_1);

							$insert_data_2['partner_id'] = $partner_id;
							$insert_data_2['points'] =$bonus_deduct_points;
							$insert_data_2['total_points'] = $update_data['total_bonus_points'];
							$insert_data_2['type'] = "bonus";
							$insert_data_2['amount'] = NULL;
							$insert_data_2['credit_type'] = 'debit';
							$insert_data_2['created_date'] = date('Y-m-d H:i:s');
							DB::table('partner_points_history')->insert($insert_data_2);
							$res_data = array(
								"msg"=>"Service Approved Successfully",
								"display_msg"=>"Service Approved Successfully",
								"status"=>"Success","recharge_option"=>"0"
							);					
							
						}else{
							$res_data = array(
								"msg"=>"No Products mapped to this service","status"=>"Success",
								"display_msg"=>"<p> No Products mapped to this service</p>","recharge_option"=>"0");
						}
						//loop completed
					}else{
						$res_data = array(
								"msg"=>"You cannot Accept this Service, you have already scheduled another service at same slot","status"=>"Success",
								"display_msg"=>"<p> You cannot Accept this Service, you have already scheduled another service at same slot</p>","recharge_option"=>"0"
						);	
					}
				}else{
					$res_data = array(
						"msg"=>"Please Recharge your wallet , you don't have enough points to serve this service","status"=>"Success","display_msg"=>"<p>Please Recharge your wallet , you don't have enough points to serve this service</p>","recharge_option"=>"1"
					);				
				}
			}else{
				$res_data = array(
				"msg"=>"Please Recharge your wallet , you don't have enough points to serve this service","status"=>"Success","display_msg"=>"<p>Please Recharge your wallet , you don't have enough points to serve this service</p>","recharge_option"=>"1"
				);				
			}
		}else{
			$res_data = array(
				"msg"=>"Sorry, This Service already accepted other partner.","status"=>"Failed","recharge_option"=>"0"
			);
		}		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}	
	
	public function sendpartnerpushnotifications($appointment_details_id){
		
		$services_list = DB::select("select fcm_token_id from partners where fcm_token_id is not null");
	
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$notifications_data = array();
			$notifications_data['title'] = "EZGLAM NEW BOOKING REQUEST";
			$notifications_data['text']  = "Click Here To View Appointment Details";	
			$notifications_data['appointment_id']  = $appointment_details_id;
			$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
										
			Helper::send_pushnotification($notifications_data,$services_lis->fcm_token_id,'vendor');		
			
		}
	}
	
	
	public function sendappointmentotptocustomer(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		$checkUserLogin = DB::select("select a.otp,m.mobile_number,a.service_id,a.vendor_id from appointments a 
										inner join app_users au on a.user_id=au.user_id 
										inner join mobile_numbers m on m.mobile_number_id=au.mobile 
										where appointment_id='".$appointment_id."'");
		$sum_service_points = DB::select("select service_id from appointment_services where appointment_id='".$appointment_id."' and status=1");	
		$return_msg = "";
		$success_count=0;
		$total_count=0;
		foreach($sum_service_points as $sum_service_point){
			$checkserviceproductstatus = DB::select("select sp.product_id,sp.no_of_times_usable,sp.required_percentage,p.product_name from service_categories s 
										inner join service_category_products sp on s.service_category_id=sp.service_category_id 
										inner join products p on sp.product_id=p.product_id 
										where s.service_id='".$sum_service_point[0]->service_id."'");
			
			$partner_id = $checkUserLogin[0]->vendor_id;
			foreach($checkserviceproductstatus as $singlecheckserviceproductstatus){
				$checkproducts_count = DB::select("select quantity,product_percentage from partner_products where partner_id='".$partner_id."' and product_id='".$singlecheckserviceproductstatus->product_id."'");
				if(count($checkproducts_count)>0 && $checkproducts_count[0]->quantity>0 && $checkproducts_count[0]->product_percentage>=$singlecheckserviceproductstatus->required_percentage){
					$return_msg .= "<p>".$singlecheckserviceproductstatus->product_name." product is available with you</p>";
					$success_count++;
				}else{
					$checkavailabledistributors = DB::SELECT("select dh.distributor_product_id,dd.distirbutor_id,.dh.quantity,concat(first_name,' ',last_name) as firstname,phone_number,hub_location_address,dh.available_quantity from partner_hubs ph inner join distributor_hubs d on ph.hub_id=d.hub_id inner join 
																distributor_products dh on d.distributor_id=dh.distributor_id inner join distirbutors dd on 
																dd.distirbutor_id=dh.distributor_id where dh.product_id='".$singlecheckserviceproductstatus->product_id."' 
																and dh.available_quantity>0");
					if(count($checkavailabledistributors)>0){
						$return_msg .= "<p> Sorry you don't have <b>".$singlecheckserviceproductstatus->product_name."</b> product to serve this service</p><p> Please contact below distributor </p><p><b> Name : '".$checkavailabledistributors[0]->firstname."' </b> </p> <p><b> Phone Number : '".$checkavailabledistributors[0]->phone_number."' </b> </p>";
					}else{
						$return_msg .= "<p>Service Product <b>".$singlecheckserviceproductstatus->product_name."</b> Not Available nearest distributors, please contact admin</p>";
					}
				}
				$total_count++;
			}
		}
		if($total_count>0 && ($success_count!=$total_count)){
			$res_data = array(
				"msg"=>$return_msg,
				"otp"=>'',
				"status"=>"Failed"
			);				
			return $this->sendResponse($res_data, 'Data fetched successfully.');			
		} else {
			$otp = $checkUserLogin[0]->otp;
			$mobile_number = $checkUserLogin[0]->mobile_number;
			$message = "Dear Customer, Your OTP verification key for starting EZGLAM service is $otp and expires in 15 min Thank You EZGLAM Team	";
			$encpassword = EncDecHelper::sendsms($mobile_number,$message);
			$res_data = array(
						"msg"=>" Otp Sent Successfully!",
						"otp"=>$otp,
						"status"=>"Success"
					);				
			return $this->sendResponse($res_data, 'Data fetched successfully.');
		}
	}
	
	
	public function resetpasswordotptopartner(Request $request){
		
		$input = $request->all();			
		$username='';
		if(isset($input['username'])){
			$username = $input['username'];
		}	
		
		$checkUserLogin = DB::select("select loginid from login where username='".$username."'");
		
		
		if(isset($checkUserLogin[0])){
			
			$otp = rand(100000,999999);
			
			$username_string = substr($username, -4);

			
			$message = "Dear Customer, Your OTP verification key to reset password is $otp and expires in 15 min Thank You EZGLAM Team	";
		
			$encpassword = EncDecHelper::sendsms($username,$message);
			
			$res_data = array(
					"user_id"=>$checkUserLogin[0]->loginid,
					"otp"=>$otp,
					"mobile_number"=>'XXXXXX'.$username_string,
					"message"=>"Otp sent to ".'XXXXXX'.$username_string,
					"status"=>"Success"
				);				
			
			return $this->sendResponse($res_data, 'Data fetched successfully.');
			
			
		}else{
			
			$res_data = array(
					"message"=>" Username not Found!",
					"user_id"=>"",
					"otp"=>"",
					"mobile_number"=>"",
					"status"=>"Failed"
				);				
			
			return $this->sendResponse($res_data, 'Data fetched successfully.');
			
		}
		
	}
	
	
	public function updatepartnerpassword(Request $request){
		
		$input = $request->all();			
		$username='';
		if(isset($input['username'])){
			$username = $input['username'];
		}	
		
		$password='';
		if(isset($input['password'])){
			$password = $input['password'];
		}	
		
		if(isset($username)){
		
		 $encpassword = EncDecHelper::enc_string($password);
		 		 
		 $insert_data['password'] = $encpassword;
		 $insert_data['password_update_date'] = date('Y-m-d H:i:s');
		 $insert_data['is_password_update'] = "1";
		 DB::table('login')->where('username',$username)->update($insert_data); 
		 
		
			$res_data = array(
					"message"=>"Password Reset Successfully!",
					"status"=>"Success"
				);				
			
			return $this->sendResponse($res_data, 'Data fetched successfully.');
			
		}else{

			$res_data = array(
					"message"=>"Invalid Input Data",
					"status"=>"Failed"
				);				
			
			return $this->sendResponse($res_data, 'Data fetched successfully.');

		}		
	}
	
	public function startappointment(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		$status='';
		if(isset($input['status'])){
			$status = $input['status'];
		}	
		
		$reason='';
		if(isset($input['reason'])){
			$reason = $input['reason'];
		}

		$otp='';
		if(isset($input['otp'])){
			$otp = $input['otp'];
		}

		$insert_data1['appointment_id'] = $appointment_id;	
		$insert_data1['partner_id'] = $partner_id;	
		$insert_data1['status'] = $status;
		$insert_data1['reason'] = $reason;
		$insert_data1['created_date'] = date('Y-m-d H:i:s');
		DB::table('appointment_logs')->insert($insert_data1);

		if($status == 'start'){
			$checkappointmentotp = DB::select("select otp from appointments where appointment_id='".$appointment_id."' and otp='".$otp."'");
			if(count($checkappointmentotp)>0 && $checkappointmentotp[0]->otp>0){
				// $checkserviceproductstatus = DB::select("select sp.product_id,sp.no_of_times_usable,sp.required_percentage,p.product_name from appointments a 
				// 									inner join services s on s.service_id=a.service_id 
				// 									inner join service_categories sc on s.service_id=sc.service_id 
				// 									inner join service_category_products sp on sc.service_category_id=sp.service_category_id 
				// 									inner join products p on sp.product_id=p.product_id 
				// 									where a.appointment_id='".$appointment_id."'");
				$checkserviceproductstatus = DB::select("select sp.product_id,sp.no_of_times_usable,sp.required_percentage,p.product_name,s.service_id from service_category_products sp
													inner join products p on sp.product_id=p.product_id
													inner join service_categories sc on sc.service_category_id=sp.service_category_id
													inner join services s on s.service_id=sc.service_id 
													where s.service_id in (select service_id from appointment_services 
													where appointment_id='".$appointment_id."')");
				//  Associated partner paid points and bonus should debit
				$productnotexistscount = 0;
				$returnmsg = "";
				$deduct_products_array=array();
				$prokey=0;
				foreach($checkserviceproductstatus as $productval){
				
					$checkproducts_count = DB::select("select quantity,product_percentage from partner_products where partner_id='".$partner_id."' 
					and product_id='".$productval->product_id."'");
					
					if(count($checkproducts_count)>0 && $checkproducts_count[0]->product_percentage>=$productval->required_percentage){
						$deduct_products_array[$prokey]['product_id'] = $productval->product_id;
						$deduct_products_array[$prokey]['quantity'] = $checkproducts_count[0]->quantity-($productval->required_percentage/100);
						$deduct_products_array[$prokey]['product_percentage'] = $checkproducts_count[0]->product_percentage-$productval->required_percentage;
					}else{
						$productnotexistscount++;
						$returnmsg .= "<p><b>".$productval->product_name."</b> Product Not Available With You</b>";
					}
					$prokey++;
				}
			
				if($productnotexistscount == 0){
					//deduct partner points
					foreach($deduct_products_array as $deduct_products_arr){
						$update_part_prod['quantity'] = $deduct_products_arr['quantity'];
						$update_part_prod['product_percentage'] = $deduct_products_arr['product_percentage'];
						DB::table('partner_products')->where('product_id',$deduct_products_arr['product_id'])
						->where('partner_id',$partner_id)->update($update_part_prod);
					}

					$insert_data['vendor_id'] = $partner_id;
					$insert_data['status'] = "Started";			
					$insert_data['modified_date'] = date('Y-m-d H:i:s');
					$insert_data['start_time'] = date('Y-m-d H:i:s');
					$checkUserLogin2 = DB::table('appointments')->where('appointment_id',$appointment_id)->update($insert_data);
					
					$res_data = array(
						"msg"=>"Service Started successfully",
						"display_msg"=>"",
						"status"=>"Success"
					);				
				}else{
					$res_data = array(
						"msg"=>" Incorrect OTP.",
						"display_msg"=>" <p>You cannot start Service Due to Below Reasons</p>.<p> ".$returnmsg."</p>",
						"status"=>"Failed"
					);
				}
			}else{
				$res_data = array(
					"msg"=>" Incorrect OTP.",
					"display_msg"=>" <p>Incurrect OTP</p>.",
					"status"=>"Failed"
				);
			}
		}else{
			// $checkUserLogin2 = DB::select("select a.user_id,a.service_id,au.fcm_token_id,a.appointment_id,s.total_points_redeemed,s.paid_points_redeem,s.bonus_points_redeem,
			// 								s.penalty_points_redeem,s.penalty_paid_points_redeem,s.penalty_bonus_points_redeem,
			// 								dph.paid_points,dph.bonus_points from appointments a 
			// 								inner join app_users au on a.user_id=au.user_id 
			// 								inner join services s on s.service_id=a.service_id
			// 								inner join deduct_points_history dph on dph.appointment_id=a.appointment_id
			// 								where a.appointment_id='".$appointment_id."'");
			$checkUserLogin2 = DB::select("select a.user_id,a.service_id,au.fcm_token_id,a.appointment_id,s.total_points_redeemed,s.paid_points_redeem,s.bonus_points_redeem,
											s.penalty_points_redeem,s.penalty_paid_points_redeem,s.penalty_bonus_points_redeem,
											dph.paid_points,dph.bonus_points from appointments a 
											inner join app_users au on a.user_id=au.user_id 
											inner join services s on s.service_id=a.service_id
											inner join deduct_points_history dph on dph.appointment_id=a.appointment_id
											where a.appointment_id='".$appointment_id."'");

			$get_partner_details = DB::select("select total_paid_points, total_bonus_points from partners where partner_id='".$partner_id."'");
			$sum_service_points = DB::select("select sum(paid_points_redeem) as tot_paid_points_redeem, sum(bonus_points_redeem) as tot_bonus_points_redeem,
											sum(penalty_paid_points_redeem) as tot_penalty_paid_points_redeem, 
											sum(penalty_bonus_points_redeem) as tot_penalty_bonus_points_redeem from services
											where service_id in (select service_id from appointment_services where appointment_id='".$appointment_id."' and status=1)");	
			//update points in user table
			$update_userdata1['total_paid_points'] = $get_partner_details[0]->total_paid_points+$sum_service_points[0]->tot_paid_points_redeem;
			DB::table('partners')->where('partner_id',$partner_id)->update($update_userdata1);
			//update points in user table
			$update_userdata2['total_bonus_points'] = $get_partner_details[0]->total_bonus_points+$sum_service_points[0]->tot_bonus_points_redeem;
			DB::table('partners')->where('partner_id',$partner_id)->update($update_userdata2);
			//insert in points history
			$insert_data_1['partner_id'] = $partner_id;
			$insert_data_1['points'] =$sum_service_points[0]->tot_paid_points_redeem;
			$insert_data_1['total_points'] = $get_partner_details[0]->total_paid_points+$sum_service_points[0]->tot_paid_points_redeem;
			$insert_data_1['type'] = "paid";
			$insert_data_1['credit_type'] = 'credit';
			$insert_data_1['created_date'] = date('Y-m-d H:i:s');
			DB::table('partner_points_history')->insert($insert_data_1);
			//insert bonus record
			$insert_data_2['partner_id'] = $partner_id;
			$insert_data_2['points'] =$sum_service_points[0]->tot_bonus_points_redeem;
			$insert_data_2['total_points'] = $get_partner_details[0]->total_bonus_points+$sum_service_points[0]->tot_bonus_points_redeem;
			$insert_data_2['type'] = "bonus";
			$insert_data_2['credit_type'] = 'credit';
			$insert_data_2['created_date'] = date('Y-m-d H:i:s');
			DB::table('partner_points_history')->insert($insert_data_2);

			//after reverting the points
			$checkbonuspoints = DB::select("select total_paid_points, total_bonus_points from partners where partner_id='".$partner_id."'");
			if($checkbonuspoints[0]->total_bonus_points>=$sum_service_points[0]->tot_penalty_bonus_points_redeem){
				$paid_deduct_points = $sum_service_points[0]->tot_penalty_paid_points_redeem;
				$bonus_deduct_points = $sum_service_points[0]->tot_penalty_bonus_points_redeem;
			} else {
				$deduct_points = $sum_service_points[0]->tot_penalty_bonus_points_redeem-$checkbonuspoints[0]->total_bonus_points;
				$paid_deduct_points = $sum_service_points[0]->tot_penalty_paid_points_redeem+$deduct_points;
				$bonus_deduct_points = $checkbonuspoints[0]->total_bonus_points;
			}
			//update points in user table
			$update_userdata3['total_paid_points'] = $checkbonuspoints[0]->total_paid_points-$paid_deduct_points;
			DB::table('partners')->where('partner_id',$partner_id)->update($update_userdata3);
			//update points in user table
			$update_userdata4['total_bonus_points'] = $checkbonuspoints[0]->total_bonus_points-$bonus_deduct_points;
			DB::table('partners')->where('partner_id',$partner_id)->update($update_userdata4);
			//insert in points history
			$insert_data_3['partner_id'] = $partner_id;
			$insert_data_3['points'] = $paid_deduct_points;
			$insert_data_3['total_points'] = $checkbonuspoints[0]->total_paid_points-$paid_deduct_points;
			$insert_data_3['type'] = "paid";
			$insert_data_3['credit_type'] = 'debit';
			$insert_data_3['created_date'] = date('Y-m-d H:i:s');
			DB::table('partner_points_history')->insert($insert_data_3);
			//insert bonus record
			$insert_data_4['partner_id'] = $partner_id;
			$insert_data_4['points'] = $bonus_deduct_points;
			$insert_data_4['total_points'] = $checkbonuspoints[0]->total_bonus_points-$bonus_deduct_points;
			$insert_data_4['type'] = "bonus";
			$insert_data_4['credit_type'] = 'debit';
			$insert_data_4['created_date'] = date('Y-m-d H:i:s');
			DB::table('partner_points_history')->insert($insert_data_4);
			
			$notifications_data = array();
			$notifications_data['title'] = "EZGLAM SERVICE CANCELLED";
			$notifications_data['text']  = "Click Here To View Appointment Details";	
			$notifications_data['appointment_id']  = $appointment_id;
			$notifications_data['user_id']  = $checkUserLogin2[0]->user_id;
			$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
			$notifications_data['type']  = 'details';
			Helper::send_pushnotification($notifications_data,$checkUserLogin2[0]->fcm_token_id,'customer');
			
			$insert_data['vendor_id'] = null;
			$insert_data['status'] = "Pending";			
			$insert_data['modified_date'] = date('Y-m-d H:i:s');
			$checkUserLogin = DB::table('appointments')->where('appointment_id',$appointment_id)->update($insert_data);
			$this->sendpartnerpushnotifications($appointment_id);
			$res_data = array(
				"msg"=>" Your Service Cancelled Successfully!",
				"display_msg"=>"",
				"status"=>"Success"
			);
		}
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	
	
	public function completeappointment(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}	
		
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		// $checkUserLogin2 = DB::select("select paid_points_redeem,bonus_points_redeem,a.user_id,s.customer_referral_points,
		//								au.fcm_token_id,a.bonus_points from appointments a 
		// 								inner join app_users au on a.user_id=au.user_id 
		// 								inner join services s on s.service_id=a.service_id 
		// 								where appointment_id='".$appointment_id."'");
		$checkUserLogin2 = DB::select("select a.user_id,au.fcm_token_id from appointments a 
										inner join app_users au on a.user_id=au.user_id 
										where appointment_id='".$appointment_id."'");
		$checkUserLogin3 = DB::select("select total_paid_points,total_bonus_points from partners where partner_id='".$partner_id."'");

		$checkUserLogin4 = DB::select("select sum(paid_points_redeem) as tot_paid_points_redeem, sum(bonus_points_redeem) as tot_bonus_points_redeem,
									sum(penalty_paid_points_redeem) as tot_penalty_paid_points_redeem, 
									sum(penalty_bonus_points_redeem) as tot_penalty_bonus_points_redeem from services
									where service_id in (select service_id from appointment_services where appointment_id='".$appointment_id."')");		
			
		
		$insert_data1['appointment_id'] = $appointment_id;	
		$insert_data1['partner_id'] = $partner_id;	
		$insert_data1['status'] = 'Completed';
		$insert_data1['reason'] = '';
		$insert_data1['created_date'] = date('Y-m-d H:i:s');
		DB::table('appointment_logs')->insert($insert_data1);
		//update points in app users
		$getuserpoints = DB::table('app_users')->select("total_points")->where('user_id',$checkUserLogin2[0]->user_id)->first();
		$insert_data6['total_points'] = $getuserpoints->total_points+$checkUserLogin4[0]->tot_bonus_points_redeem;	
		DB::table('app_users')->where('user_id',$checkUserLogin2[0]->user_id)->update($insert_data6);
		//insert in transaction
		$insert_data5['customer_user_id'] = $checkUserLogin2[0]->user_id;	
		$insert_data5['points'] = $checkUserLogin4[0]->tot_bonus_points_redeem;
		$insert_data5['available_points'] = $getuserpoints->total_points+$checkUserLogin4[0]->tot_bonus_points_redeem;
		$insert_data5['type'] = 'bonus';
		$insert_data5['credit_type'] = 'credit';
		$insert_data5['created_date'] = date('Y-m-d H:i:s');
		$insert_data5['appointment_id'] = $appointment_id;
		
		DB::table('customer_points_history')->insert($insert_data5);
		
		$insert_data['status'] = "Completed";			
		$insert_data['modified_date'] = date('Y-m-d H:i:s');
		$insert_data['end_time'] = date('Y-m-d H:i:s');
		$checkUserLogin = DB::table('appointments')->where('appointment_id',$appointment_id)->update($insert_data);
		//send notification
		$notifications_data = array();
		$notifications_data['title'] = "EZGLAM SERVICE COMPLETED";
		$notifications_data['text']  = "Please click Here to give feedback";	
		$notifications_data['appointment_id']  = $appointment_id;
		$notifications_data['user_id']  = $checkUserLogin2[0]->user_id;
		$notifications_data['type']  = 'feedback';
		$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
		Helper::send_pushnotification($notifications_data,$checkUserLogin2[0]->fcm_token_id,'customer');
		$res_data = array(
				"msg"=>"Service Completed successfully",
				"status"=>"Success"
			);
			
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function partnercartitemscount(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
				
		$services_list = DB::select("select ifnull(sum(no_of_items),0) as cartitems from partner_carts where partner_id='".$partner_id."' and status='0'");

		$res_data['cart_items'] = $services_list[0]->cartitems;

		return $this->sendResponse($res_data, 'Data fetched successfully.');
	
	}
	
	public function partner_cart_list(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
				
		$services_list = DB::select("select ps.partner_cart_id,p.product_id,p.product_name,p.product_image,p.brand_name,
		p.originalprice,ps.no_of_items,ps.actuval_product_price,ps.discount,ps.discount_product_price from products p 
		inner join partner_carts ps on p.product_id=ps.product_id 
		where partner_id='".$partner_id."' and ps.status='0' and ps.no_of_items>0 order by ps.partner_cart_id desc");
		
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['partner_cart_id'] = (string)$services_lis->partner_cart_id;
			$services_data[$skey]['product_id'] = (string)$services_lis->product_id;
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['description'] = $services_lis->product_name;
			$services_data[$skey]['image'] = url('/').'/public/images/'.$services_lis->product_image;
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['no_of_items'] = $services_lis->no_of_items;
			$services_data[$skey]['actuval_product_price'] = (string)(int)$services_lis->originalprice;			
			$services_data[$skey]['discount'] = (string)(int)$services_lis->discount;			
			$services_data[$skey]['discount_product_price'] = ceil($services_data[$skey]['actuval_product_price']-(($services_data[$skey]['actuval_product_price']*$services_data[$skey]['discount'])/100));
			$skey++;
		}
			
		$get_cart_products = DB::select("SELECT p.originalprice,p.discount, pc.product_id,pc.no_of_items FROM partner_carts pc 
		inner join products p on p.product_id=pc.product_id
		where pc.partner_id='$partner_id' and pc.status=0 and pc.no_of_items>0");
		$total_amount = 0;
		$saved_amount = 0;
		$payable_amount = 0;
		$cart_item_count = 0;
		foreach($get_cart_products as $get_cart_product){
			$total_amount = $total_amount+($get_cart_product->originalprice*$get_cart_product->no_of_items);
			$payable_amount = $payable_amount+(($get_cart_product->originalprice*$get_cart_product->no_of_items)-((($get_cart_product->originalprice*$get_cart_product->no_of_items)*$get_cart_product->discount)/100));
			$cart_item_count = $cart_item_count+$get_cart_product->no_of_items;
		}
		$res_data['partner_services'] = $services_data;
		$res_data['total_amount'] = (string)$total_amount;
		$res_data['payable_amount'] = (string)$payable_amount;
		$res_data['saved_amount'] = (string)($total_amount-$payable_amount);
		$res_data['cart_item_count'] = (string)$cart_item_count;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	
	 public function updatepartnercartdetails(Request $request){
		$input = $request->all();			
		$partner_cart_id='';
		if(isset($input['partner_cart_id'])){
			$partner_cart_id = $input['partner_cart_id'];
		}	
		
		$no_of_items='';
		if(isset($input['no_of_items'])){
			$no_of_items = $input['no_of_items'];
		}	

		$getproducts = DB::SELECT("select originalprice,p.discount from partner_carts c inner join products p on c.product_id=p.product_id where c.partner_cart_id=".$partner_cart_id);
		
		if($no_of_items == '0'){			
			DB::table('partner_carts')->where('partner_cart_id', $partner_cart_id)->delete();			
			
		}else{
		
		$insert_data1['no_of_items'] = $no_of_items;		
		$insert_data1['actuval_product_price'] = $getproducts[0]->originalprice*$no_of_items;
		$insert_data1['discount'] = $getproducts[0]->discount?$getproducts[0]->discount:'0';
		$insert_data1['discount_product_price'] = $insert_data1['actuval_product_price']-(($insert_data1['actuval_product_price']*$insert_data1['discount'])/100);		
		$insert_data1['updated_date'] = date('Y-m-d H:i:s');
		$insert_data1['status'] = "0";	
		
		$insert_user = DB::table('partner_carts')->where('partner_cart_id',$partner_cart_id)->update($insert_data1);
		
		}
		
		$res_data = array(
				"msg"=>"Product cart Updated successfully",
				"status"=>"Success"
			);			
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	
	
	public function savepartnercart(Request $request){
		$input = $request->all();			
		$cartItems='';
		if(isset($input['cartItems'])){
			$cartItems = $input['cartItems'];
		}	

		$sno=0;
		foreach($cartItems as $cartItem){
		
		$getproducts = DB::table('products')->select("originalprice","discount")->where('product_id',$cartItem['product_id'])->first();
				
		$insert_data1['partner_id'] = $cartItem['partner_id'];	
		$insert_data1['product_id'] = $cartItem['product_id'];	
		$insert_data1['no_of_items'] = $cartItem['no_of_items'];
		$insert_data1['actuval_product_price'] = $getproducts->originalprice*$insert_data1['no_of_items'];
		$insert_data1['discount'] = $getproducts->discount?$getproducts->discount:'0';
		$insert_data1['discount_product_price'] = $insert_data1['actuval_product_price']-(($insert_data1['actuval_product_price']*$insert_data1['discount'])/100);
		$insert_data1['is_coupon_applied'] = "0";
		$insert_data1['coupon_code'] = "0";
		$insert_data1['created_date'] = date('Y-m-d H:i:s');
		$insert_data1['updated_date'] = date('Y-m-d H:i:s');
		$insert_data1['status'] = "0";	
		
		$insert_user = DB::table('partner_carts')->insertGetId($insert_data1);
		$sno++;
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
	
	
	public function savepatnerorderpayment(Request $request){
		$input = $request->all();		
		//$cartItems='';
		
		//$input = json_decode($post_data['content']);
        $partner_id = $input['partner_id'];
        $total_items = $input['total_items'];
		$total_amount = $input['total_amount'];
        $discount_amount = $input['discount_amount'];
		$payable_amount = $input['payable_amount'];
        $payment_mode = $input['payment_mode'];
		$cartItems = $input['cartItems'];
		$img = $input['file_string'];
		
		$insert_data['status'] = 2;
		
		DB::table('partner_carts')->where('partner_id',$partner_id)->where('status','0')->update($insert_data);
		
		//$order_id = rand(10000000000000,99999999999999);
		$order_id = 'EZG'.date('ymdHis').'PRO'.$partner_id;

		// $file_doc_name='';
        // $file_doc_path = public_path().'/orderimages';
        // if($request->hasfile('payment_receipt')){
        //     $extension = $request->file('payment_receipt')->extension();
        //     $mime_type = $request->file('payment_receipt')->getMimeType();
        //     $file_doc_name = 'orderimages/'.$order_id.'_'.time().'.'.$extension;
        //     $dep_file_upload = $request->file('payment_receipt')->move($file_doc_path, $file_doc_name);
        // }
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$filename = 'order_receipt_'.date('YmdHis').'_'.$partner_id.'.png';
		$file = public_path().'/images/orderimages/'.$filename;
		$success = file_put_contents($file, $data);
		
		$insert_orders['partner_id'] = $partner_id;	
		$insert_orders['order_id'] = $order_id;	
		$insert_orders['total_products'] = $total_items;
		$insert_orders['total_amount'] = $total_amount;
		$insert_orders['paid_amount'] = $payable_amount;
		$insert_orders['discount_amount'] = $discount_amount;
		$insert_orders['payment_mode_id'] = $payment_mode;
		$insert_orders['payment_receipt_attachment'] = $filename;
		$insert_orders['created_date'] = date('Y-m-d H:i:s');
		$insert_orders['dispatched_status'] = "0";	
		
		$insert_user = DB::table('partner_cart_payments')->insert($insert_orders);
		

		$sno=0;
		foreach($cartItems as $cartItem){
		
			$getproducts = DB::table('products')->select("originalprice","discount")->where('product_id',$cartItem['product_id'])->first();
			
				
			//var_dump($get_user->service_id);

			$insert_data1['no_of_items'] = $cartItem['no_of_items'];
			$insert_data1['actuval_product_price'] = $getproducts->originalprice*$insert_data1['no_of_items'];
			$insert_data1['discount'] = $getproducts->discount?$getproducts->discount:'0';
			$insert_data1['discount_product_price'] = $insert_data1['actuval_product_price']-(($insert_data1['actuval_product_price']*$insert_data1['discount'])/100);
			$insert_data1['updated_date'] = date('Y-m-d H:i:s');
			$insert_data1['status'] = "1";
			$insert_data1['order_id'] = $order_id;	
			
			$insert_user = DB::table('partner_carts')->where('partner_cart_id',$cartItem['product_cart_id'])->update($insert_data1);
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
	
	

	public function partnerservices_list(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
					
		$type='';
		if(isset($input['type'])){
			$type = $input['type'];
		}			
		
			$services_list = DB::select("SELECT s.service_description,partner_service_id,user_id,ps.service_id,service_name,service_description,image,price_per_unit,discount_perent,
estimated_time,ifnull(product_name,'') as product_name,ifnull(product_image,'') as product_image,ifnull(brand_name,'') as brand_name,category_name FROM partner_services ps inner join services s on ps.service_id=s.service_id left join service_categories sc on s.service_id=sc.service_id left join service_category_products scp on scp.service_category_id=sc.service_category_id left join products p on p.product_id=scp.product_id inner join categories cat on cat.category_id=sc.category_id where ps.user_id='".$partner_id."' and ps.status='1' and cat.type_id='".$type."' order by partner_service_id desc ");
	
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['partner_service_id'] = $services_lis->partner_service_id;
			$services_data[$skey]['service_id'] = $services_lis->service_id;
			$services_data[$skey]['service_name'] = $services_lis->service_name;			
			$services_data[$skey]['service_description'] = $services_lis->service_description;
			$services_data[$skey]['image'] = url('/').'/images/'.$services_lis->image;
			$services_data[$skey]['price_per_unit'] = $services_lis->price_per_unit;
			$services_data[$skey]['discount_perent'] = $services_lis->discount_perent;
			$services_data[$skey]['estimated_time'] = $services_lis->estimated_time."min";			
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['product_image'] = url('/').'/public/images/'.$services_lis->product_image;
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['category_name'] = $services_lis->category_name;
			$skey++;
		}
		$res_data['partner_services'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function wallet_list(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
					
		$type='';
		if(isset($input['type'])){
			$type = $input['type'];
		}			
		$str="";
		if($type == 'paid'){
			$str=" and type='paid'";
		}else{
			$str=" and type='bonus'";
		}
		
			$services_list = DB::select("
			select part_history_id,amount,points,created_date as orderdate,subtype,credit_type as transactiontype,credit_type,
			total_points from partner_points_history where partner_id='".$partner_id."' $str order by orderdate desc
			");
	
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['part_history_id'] = $services_lis->part_history_id;
			$services_data[$skey]['amount'] = $services_lis->amount!=''?(int)$services_lis->amount:0;
			$services_data[$skey]['points'] = (int)$services_lis->points;	
			$services_data[$skey]['total_points'] = (int)$services_lis->total_points;	
			$services_data[$skey]['orderdate'] = date('d-m-Y H:i', strtotime($services_lis->orderdate));
			$services_data[$skey]['subtype'] = $services_lis->subtype!=''?$services_lis->subtype:'';
			$services_data[$skey]['transactiontype'] = $services_lis->transactiontype!=''?$services_lis->transactiontype:'';
			$skey++;
		}
		$res_data['partner_services'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function appointment_detailed(Request $request){
		$input = $request->all();			
		$appointment_id='';
		if(isset($input['appointment_id'])){
			$appointment_id = $input['appointment_id'];
		}						
		
		// $services_list = DB::select("SELECT a.appointment_id,a.appointment_date,a.latitude,a.longitude,a.actual_amount,a.discount_percent,
		// 								a.user_id,a.status,au.first_name,au.last_name,au.gender,s.service_id,s.service_name,
		// 								s.service_description,s.short_description,a.discount_amount,
		// 								concat('".url('/')."/public/images/'".",s.image) as image,ca.category_name,t.type,
		// 								ts.label as slotname,concat(ad.doorno,',',ad.street,',',ad.area,',',ad.city,',',ad.state,',',ad.country,',',ad.country,',',ad.pincode) as customeraddress,
		// 								ifnull(concat(v.first_name,' ',v.last_name),'') as vendorname,ifnull(v.address,'') as vendoraddress,
		// 								ifnull(v.mobile,'') as vendormobile,m.mobile_number as customermobile
		// 								FROM appointments a inner join app_users au on a.user_id=au.user_id 
		// 								inner join services s on a.service_id=s.service_id 
		// 								inner join service_categories sc on s.service_id=sc.service_id 
		// 								inner join categories ca on ca.category_id=sc.category_id 
		// 								inner join types t on t.type_id=ca.type_id 
		// 								inner join time_slots ts on ts.slot_id=a.appointment_slot_id 
		// 								inner join appointment_details ad on a.appointment_id=ad.appointment_id 
		// 								left join partners v on v.partner_id=a.vendor_id 
		// 								left join mobile_numbers m on au.mobile=m.mobile_number_id 
		// 								where a.appointment_id='".$appointment_id."'");
		$services_list = DB::select("SELECT a.appointment_id,a.appointment_date,a.latitude,a.longitude,a.actual_amount,a.discount_percent,
									a.user_id,a.status,au.first_name,au.last_name,au.gender,a.discount_amount,
									ts.label as slotname,concat(ad.doorno,',',ad.street,',',ad.area,',',ad.city,',',ad.state,',',ad.country,',',ad.country,',',ad.pincode) as customeraddress,
									ifnull(concat(v.first_name,' ',v.last_name),'') as vendorname,ifnull(v.address,'') as vendoraddress,
									ifnull(v.mobile,'') as vendormobile,m.mobile_number as customermobile
									FROM appointments a 
									inner join app_users au on a.user_id=au.user_id 
									inner join time_slots ts on ts.slot_id=a.appointment_slot_id 
									inner join appointment_details ad on a.appointment_id=ad.appointment_id 
									left join partners v on v.partner_id=a.vendor_id 
									left join mobile_numbers m on au.mobile=m.mobile_number_id 
									where a.appointment_id='".$appointment_id."'");

		
		$res_data['appointment_id'] = $services_list[0]->appointment_id;
		$res_data['appointment_date'] = $services_list[0]->appointment_date;
		$res_data['latitude'] = $services_list[0]->latitude;
		$res_data['longitude'] = $services_list[0]->longitude;
		$res_data['user_id'] = $services_list[0]->user_id;
		$res_data['first_name'] = $services_list[0]->first_name;
		$res_data['last_name'] = $services_list[0]->last_name;
		$res_data['gender'] = $services_list[0]->gender;
		$res_data['slotname'] = $services_list[0]->slotname;
		$res_data['customeraddress'] = $services_list[0]->customeraddress;
		$res_data['vendorname'] = $services_list[0]->vendorname;
		$res_data['vendoraddress'] = $services_list[0]->vendoraddress;
		$res_data['vendormobile'] = $services_list[0]->vendormobile;
		$res_data['customermobile'] = $services_list[0]->customermobile;
		$res_data['status'] = $services_list[0]->status;
		$res_data['key_id'] = Config::get('constants.options.api_key');
		$res_data['key_secret'] = Config::get('constants.options.api_secret');

		$service_details = DB::select("select appointment_id, service_name,service_image,category_name,type_name, bonus_points, actual_amount,actual_total_amount from (
										select asct.appointment_id, group_concat(asct.service_id) as service_id, group_concat(srv.service_name) as service_name, 
										MAX(ca.category_name) as category_name, MAX(t.type) as type_name, 
										MAX(srv.image) as service_image, 
										SUM(bonus_points) as bonus_points, SUM(discount_amount) as actual_amount,SUM(actual_amount) as actual_total_amount from appointment_services asct 
										inner join services srv on srv.service_id=asct.service_id
										inner join service_categories sc on sc.service_id=srv.service_id 
										inner join categories ca on ca.category_id=sc.category_id 
										inner join types t on t.type_id=ca.type_id 
										where asct.appointment_id='".$appointment_id."') as tab");
		// $service_description = strip_tags($services_list[0]->service_description);
		// $service_description = str_replace('&nbsp;','',$service_description);
		// $service_description = str_replace('&ndash;','-',$service_description);
		$res_data['actual_amount'] = $services_list[0]->actual_total_amount;
		$res_data['discount_percent'] = $services_list[0]->actual_amount;
		$res_data['category_name'] = $services_list[0]->category_name;
		$res_data['type'] = $services_list[0]->type_name;
		$res_data['service_name'] = $services_list[0]->service_name;
		$res_data['service_description'] = '--';
		$res_data['image'] = $services_list[0]->service_image;
		// $getproductslist = DB::select("SELECT scp.product_id, p.product_name FROM ezglam.service_category_products scp 
		// 								inner join service_categories sc on sc.service_category_id=scp.service_category_id 
		// 								inner join products p on p.product_id=scp.product_id 
		// 								where sc.service_id='".$services_list[0]->service_id."'");
		// $products_array = array();
		// if(count($getproductslist)>0){
		// 	foreach($getproductslist as $getproductsli){
		// 		$products_array[] = $getproductsli->product_name;
		// 	}
		// }
		$res_data['products_required'] = $services_list[0]->short_description!=''?$services_list[0]->short_description:'--';
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function partnerproducts_list(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		$services_list = DB::select("select partner_product_id,p.product_id,p.product_name,p.product_image,p.brand_name,p.originalprice,
		ps.quantity,p.discount from products p 
		inner join partner_products ps on p.product_id=ps.product_id 
		where partner_id='".$partner_id."' and p.product_type='partner' 
		and p.status='1' order by p.product_id desc");
		
		$pendingpoints = DB::select("select sum(no_of_items) as cartitems from partner_carts where partner_id='".$partner_id."' and status=0");
		
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['product_id'] = (string)$services_lis->product_id;
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['description'] = $services_lis->product_name;
			$services_data[$skey]['image'] = url('/').'/public/images/'.$services_lis->product_image;
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['quantity'] = $services_lis->quantity;
			$services_data[$skey]['discount'] = ceil($services_lis->discount);
			
			$partner_product_services = DB::select("select service_name,no_of_times_usable,'0' as alreadyused from services s inner join partner_services ps on s.service_id=ps.service_id where ps.user_id='".$partner_id."' and s.product_id='".$services_lis->product_id."'");
			
			$product_services = array();
			$skey1 = 0;
			foreach($partner_product_services as $partner_services)
			{
					$product_services[$skey1]['service_name'] = $partner_services->service_name;
					$product_services[$skey1]['no_of_times_usable'] = $partner_services->no_of_times_usable;
					$product_services[$skey1]['alreadyused'] = $partner_services->alreadyused;
					$skey1++;
			}
			$services_data[$skey]['product_services'] = $product_services;
			$services_data[$skey]['originalprice'] = (string)(int)$services_lis->originalprice;
			$services_data[$skey]['discount_product_price'] = $services_data[$skey]['originalprice']-(($services_data[$skey]['originalprice']*$services_data[$skey]['discount'])/100);
			$skey++;
		}
		$res_data['cartitems'] = ($pendingpoints[0]->cartitems!='')?$pendingpoints[0]->cartitems:0;
		$res_data['partner_products'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function totalproducts_list(Request $request){
		$input = $request->all();			
			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}		
		
		$services_list = DB::select("select p.product_id,p.product_name,p.product_image,p.brand_name,p.originalprice,
		p.no_of_items,p.discount,pc.no_of_items as prod_cart_count from products p  
		left join (select product_id,no_of_items from partner_carts where partner_id='$partner_id' and status=0) as pc on pc.product_id=p.product_id
		where p.status='1' and p.no_of_items>0 and p.product_type='partner' order by p.product_id desc");
		
		$products_in_cart = DB::select("select ifnull(sum(no_of_items),0)  as totalitems from partner_carts where partner_id='".$partner_id."' and status=0");
				
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['product_id'] = (string)$services_lis->product_id;
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['description'] = $services_lis->product_name;
			$services_data[$skey]['image'] = url('/').'/public/images/'.$services_lis->product_image;
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['quantity'] = $services_lis->no_of_items;
			$services_data[$skey]['product_cart_count'] = $services_lis->prod_cart_count!=''?(string)$services_lis->prod_cart_count:'0';
			$services_data[$skey]['discount'] = $services_lis->discount;
			$services_data[$skey]['originalprice'] = (string)(int)$services_lis->originalprice;
			$services_data[$skey]['discount_product_price'] = ceil($services_data[$skey]['originalprice']-(($services_data[$skey]['originalprice']*$services_data[$skey]['discount'])/100));
			$skey++;
		}
		$res_data['items_in_cart'] = $products_in_cart[0]->totalitems;
		$res_data['partner_products'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	
	public function partnerappointments_list(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		$type='';
		if(isset($input['type'])){
			$type = $input['type'];
		}
		$today_date = date('Y-m-d');
		if($type == 'present'){
			$appointments_list = DB::select("SELECT a.appointment_id,a.appointment_date,
											ascts.actual_total_amount as actual_amount,
											ascts.actual_amount as discount_amount, 
											ascts.bonus_points as discount_percent, 
											ascts.service_name, 
											ts.label, a.status,a.otp,a.latitude,a.longitude, au.first_name,au.last_name FROM appointments a
											left join (select appointment_id, service_name,service_image,bonus_points, actual_amount,actual_total_amount from (
											select asct.appointment_id, group_concat(asct.service_id) as service_id, group_concat(srv.service_name) as service_name, 
											MAX(srv.image) as service_image, 
											SUM(bonus_points) as bonus_points, SUM(discount_amount) as actual_amount,SUM(actual_amount) as actual_total_amount from appointment_services asct 
											inner join services srv on srv.service_id=asct.service_id
											group by asct.appointment_id) as tab) as ascts on ascts.appointment_id=a.appointment_id
											inner join time_slots ts on ts.slot_id=a.appointment_slot_id
											inner join app_users au on au.user_id=a.user_id
											where a.vendor_id='".$partner_id."' and DATE(a.appointment_date) >= '".$today_date."' order by a.appointment_id desc");
		}else if($type == 'past'){
			$appointments_list = DB::select("SELECT a.appointment_id,a.appointment_date,
											ascts.actual_total_amount as actual_amount,
											ascts.actual_amount as discount_amount, 
											ascts.bonus_points as discount_percent, 
											ascts.service_name, 
											ts.label, a.status,a.otp,a.latitude,a.longitude, au.first_name,au.last_name FROM appointments a
											left join (select appointment_id, service_name,service_image,bonus_points, actual_amount,actual_total_amount from (
											select asct.appointment_id, group_concat(asct.service_id) as service_id, group_concat(srv.service_name) as service_name, 
											MAX(srv.image) as service_image, 
											SUM(bonus_points) as bonus_points, SUM(discount_amount) as actual_amount,SUM(actual_amount) as actual_total_amount from appointment_services asct 
											inner join services srv on srv.service_id=asct.service_id
											group by asct.appointment_id) as tab) as ascts on ascts.appointment_id=a.appointment_id
											inner join time_slots ts on ts.slot_id=a.appointment_slot_id
											inner join app_users au on au.user_id=a.user_id
											where a.vendor_id='".$partner_id."' and DATE(a.appointment_date) < '".$today_date."' order by a.appointment_id desc");
		}else{
			$appointments_list = DB::select("SELECT a.appointment_id,a.appointment_date,
											ascts.actual_total_amount as actual_amount,
											ascts.actual_amount as discount_amount, 
											ascts.bonus_points as discount_percent, 
											ascts.service_name, 
											ts.label, a.status,a.otp,a.latitude,a.longitude, au.first_name,au.last_name FROM appointments a
											left join (select appointment_id, service_name,service_image,bonus_points, actual_amount,actual_total_amount from (
											select asct.appointment_id, group_concat(asct.service_id) as service_id, group_concat(srv.service_name) as service_name, 
											MAX(srv.image) as service_image, 
											SUM(bonus_points) as bonus_points, SUM(discount_amount) as actual_amount,SUM(actual_amount) as actual_total_amount from appointment_services asct 
											inner join services srv on srv.service_id=asct.service_id
											group by asct.appointment_id) as tab) as ascts on ascts.appointment_id=a.appointment_id
											inner join time_slots ts on ts.slot_id=a.appointment_slot_id
											inner join app_users au on au.user_id=a.user_id
											where a.vendor_id='".$partner_id."' order by a.appointment_id desc limit 5");
		}
											
		$akey=0;
		$data=array();
		foreach($appointments_list as $appointments_li){
			$appoint_status = ucwords(strtolower($appointments_li->status));
			$data[$akey]['appointment_id'] = (string)$appointments_li->appointment_id;
			$data[$akey]['appointment_date'] = date('d-M-Y', strtotime($appointments_li->appointment_date));
			// $data[$akey]['actual_amount'] = (string)$appointments_li->actual_amount;
			// $data[$akey]['discount_amount'] = $appointments_li->discount_percent!=''?(string)(($appointments_li->discount_percent / 100) * $appointments_li->actual_amount):'';

			$data[$akey]['actual_amount'] = (string)$appointments_li->discount_amount;
			$data[$akey]['discount_amount'] = (string)$appointments_li->discount_amount;
			$data[$akey]['service_name'] = $appointments_li->service_name;
			$data[$akey]['time_slot'] = $appointments_li->label;
			$data[$akey]['otp'] = $appointments_li->otp;
			$data[$akey]['status'] = $appoint_status;
			$data[$akey]['latitude'] = $appointments_li->latitude!=''?(string)$appointments_li->latitude:'';
			$data[$akey]['longitude'] = $appointments_li->longitude!=''?(string)$appointments_li->longitude:'';
			if($appoint_status=='Approved' || $appoint_status=='Started'){
				$data[$akey]['enable_direction'] = '1';
			} else {
				$data[$akey]['enable_direction'] = '0';
			}
			$data[$akey]['customer_name'] = ucwords(strtolower($appointments_li->first_name.' '.$appointments_li->last_name));
			if(strtolower($appoint_status)=='approved' || strtolower($appoint_status)=='started'){
				$data[$akey]['call_option'] = '1';
			} else {
				$data[$akey]['call_option'] = '0';
			}
			$akey++;
		}
		$res_data['appointments_list'] = $data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function savepartnercartitem(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	

		$product_id='';
		if(isset($input['product_id'])){
			$product_id = $input['product_id'];
		}	

		$no_of_items='0';
		if(isset($input['no_of_items'])){
			$no_of_items = $input['no_of_items'];
		}	

		$checkproductstatusinusercart = DB::SELECT("select partner_cart_id from partner_carts where partner_id='".$partner_id."' and product_id='".$product_id."' and status=0");

		$getproducts = DB::table('products')->select("originalprice","discount")->where('product_id',$product_id)->first();

		if(isset($checkproductstatusinusercart[0])){

			$insert_data1['no_of_items'] = $no_of_items;
			$insert_data1['actuval_product_price'] = (int)$getproducts->originalprice*$no_of_items;
			$insert_data1['discount'] = $getproducts->discount?$getproducts->discount:'0';
			$insert_data1['discount_product_price'] = $insert_data1['actuval_product_price']-(($insert_data1['actuval_product_price']*$insert_data1['discount'])/100);
			$insert_data1['updated_date'] = date('Y-m-d H:i:s');
			$insert_data1['status'] = "0";	
			
			DB::table('partner_carts')->where('partner_cart_id',$checkproductstatusinusercart[0]->partner_cart_id)->update($insert_data1);
			$insert_user = $checkproductstatusinusercart[0]->partner_cart_id;
		}else{
				
			$insert_data1['partner_id'] = $partner_id;	
			$insert_data1['product_id'] = $product_id;	
			$insert_data1['no_of_items'] = $no_of_items;
			$insert_data1['actuval_product_price'] = (int)$getproducts->originalprice*$no_of_items;  
			$insert_data1['discount'] = $getproducts->discount?$getproducts->discount:'0';
			$insert_data1['discount_product_price'] = $insert_data1['actuval_product_price']-(($insert_data1['actuval_product_price']*$insert_data1['discount'])/100);
			$insert_data1['is_coupon_applied'] = "0";
			$insert_data1['coupon_code'] = "0";
			$insert_data1['created_date'] = date('Y-m-d H:i:s');
			$insert_data1['updated_date'] = date('Y-m-d H:i:s');
			$insert_data1['status'] = "0";	
			
			$insert_user = DB::table('partner_carts')->insertGetId($insert_data1);


		}
		$get_cart_products = DB::select("SELECT p.originalprice,p.discount, pc.product_id,pc.no_of_items FROM partner_carts pc 
											inner join products p on p.product_id=pc.product_id
											where pc.partner_id='$partner_id' and pc.status=0 and pc.no_of_items>0");
		$total_amount = 0;
		$saved_amount = 0;
		$payable_amount = 0;
		$cart_item_count = 0;
		foreach($get_cart_products as $get_cart_product){
			$total_amount = $total_amount+($get_cart_product->originalprice*$get_cart_product->no_of_items);
			$payable_amount = $payable_amount+(($get_cart_product->originalprice*$get_cart_product->no_of_items)-((($get_cart_product->originalprice*$get_cart_product->no_of_items)*$get_cart_product->discount)/100));
			$cart_item_count = $cart_item_count+$get_cart_product->no_of_items;
		}
		

		if($insert_user>0){
			$res_data = array(
				"msg"=>"Product added to cart successfully",
				"status"=>"Success",
				"total_amount"=>(string)$total_amount,
				"payable_amount"=>(string)$payable_amount,
				"saved_amount"=>(string)($total_amount-$payable_amount),
				"cart_item_count"=>(string)$cart_item_count
			);
		}else{
			$res_data = array(
				"msg"=>"Something went wrong. Please try again",
				"status"=>"Failed",
				"total_amount"=>"",
				"payable_amount"=>"",
				"saved_amount"=>"",
				"cart_item_count"=>""
			);
		}	
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function cancellation_policy(){
		$policy_message = "<p> Cancellation Policies</p><p> If you cancel this service your paid and bonus points will be deducted as mentioned per service </p>";
		$res_data['policies'] = $policy_message;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function updatepartnerprofile(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$first_name='';
		if(isset($input['first_name'])){
			$first_name = $input['first_name'];
		}
		$last_name='';
		if(isset($input['last_name'])){
			$last_name = $input['last_name'];
		}
		$email='';
		if(isset($input['email'])){
			$email = $input['email'];
		}
		$gender='';
		if(isset($input['gender'])){
			$gender = $input['gender'];
		}
		$address='';
		if(isset($input['address'])){
			$address = $input['address'];
		}
		$profile_picture='';
		if(isset($input['profile_picture'])){
			$profile_picture = $input['profile_picture'];
		}
		
		$update_data['first_name'] = $first_name;
		$update_data['last_name'] = $last_name;
		$update_data['email'] = $email;
		$update_data['gender'] = $gender;
		//$update_data['mobile'] = $mobile_number;
		$update_data['address'] = $address;

		// $data = $profile_picture;
		// $data = str_replace('data:image/gif;base64,', '', $data);
		// $data = str_replace(' ', '+', $data);
		// $data = base64_decode($data);

		// $file = 'profiles/'.$user_id.'_'.time() . '.png';

		// $success = file_put_contents($file, $data);

		// $data = base64_decode($data); 

		// $source_img = imagecreatefromstring($data);

		// $rotated_img = imagerotate($source_img, 90, 0); 

		// $file = 'profiles/'.$user_id.'_'.time() . '.png';

		// $imageSave = imagejpeg($rotated_img, $file, 10);

		// imagedestroy($source_img);
		$filename=NULL;
		if($profile_picture!=''){
			$img = str_replace(' ', '+', $profile_picture);
			$data = base64_decode($img);
			$filename = 'partnerpro_'.date('YmdHis').'_'.$user_id.'.png';
			$file = public_path().'/images/userimages/'.$filename;
			$success = file_put_contents($file, $data);
			$update_data['profile_picture']=$filename;
		}
		// $file_doc_name='';
        // $file_doc_path = public_path().'/images/profiles';
        // if($request->hasfile('user_image')){
        //     $extension = $request->file('user_image')->extension();
        //     $mime_type = $request->file('user_image')->getMimeType();
        //     $file_doc_name = 'profiles/'.$input->user_id.'_'.time().'.'.$extension;
        //     $dep_file_upload = $request->file('user_image')->move($file_doc_path, $file_doc_name);
        //     $update_data['profile_picture']=$file_doc_name;
        // }
		
		$update_user = DB::table('partners')->where('partner_id',$user_id)->update($update_data);
		$res_data = array(
				"msg"=>"Profile Updated successfully",
				"status"=>"Success"
			);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function paymentmodes(){
		$services_list = DB::select("SELECT * FROM payment_modes");
		$payment_data=array();
		$key=0;
		foreach($services_list as $services_li){
			$payment_data[$key]['payment_modes_id'] = (string)$services_li->payment_modes_id;
			$payment_data[$key]['payment_modes'] = (string)$services_li->payment_modes;
			$payment_data[$key]['number'] = (string)$services_li->number;
			$payment_data[$key]['status'] = (string)$services_li->status;
			$key++;
		}
		$res_data['payment_modes'] = $payment_data;
		
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
	public function getpaymentmodedetails(Request $request){
		$input = $request->all();			
		$payment_modes_id='';
		if(isset($input['payment_modes_id'])){
			$payment_modes_id = $input['payment_modes_id'];
		}
		$services_list = DB::select("SELECT * FROM payment_modes where payment_modes_id='$payment_modes_id'");
		$payment_data['payment_modes_id'] = (string)$services_list[0]->payment_modes_id;
		$payment_data['payment_modes'] = (string)$services_list[0]->payment_modes;
		$payment_data['number'] = (string)$services_list[0]->number;
		$payment_data['status'] = (string)$services_list[0]->status;
		$res_data['payment_mode_details'] = $payment_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function getpaymentkeys(Request $request){
		$input = $request->all();			
		$version='';
		if(isset($input['version'])){
			$version = $input['version'];
		}
		//api key values
		$res_data['key_id'] = Config::get('constants.options.api_key');
		$res_data['key_secret'] = Config::get('constants.options.api_secret');

		$config_data = DB::Table("config_data")->select("customer_email","customer_phone")->first();
		$res_data['customer_email'] = $config_data->customer_email!=''?$config_data->customer_email:'--';
		$res_data['customer_phone'] = $config_data->customer_phone!=''?$config_data->customer_phone:'--';
		$version_status = DB::Table("app_versions")->select("status")->where('version',$version)->where('app_type','partner')->first();
		if(isset($version_status)){
			$res_data['update_status'] = $version_status->status;
		} else {
			$res_data['update_status'] = 'noupdate';
		}
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function generateorderid(Request $request){
		$input = $request->all();			
		$user_id='';
		if(isset($input['user_id'])){
			$user_id = $input['user_id'];
		}	
		$order_id = 'EZG'.date('ymdHis').'PRT'.$user_id;
		//save in transaction history
		$insert_data['user_id'] = $user_id;
		$insert_data['order_id'] = $order_id;
		$insert_data['created_date'] = date('Y-m-d H:i:s');
		$insert_user = DB::table('partner_payment_transactions')->insertGetId($insert_data);
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
			$order_id = $input['order_id'];
		}
		$transaction_id='';
		if(isset($input['transaction_id'])){
			$transaction_id = $input['transaction_id'];
		}
		$amount='';
		if(isset($input['amount'])){
			$amount = $input['amount'];
		}
		$status='';
		if(isset($input['status'])){
			$status = strtolower($input['status']);
		}
		if($status=='success'){
			//update payment transaction record
			$update_paydata['amount'] = ceil($amount);
			$update_paydata['transaction_number'] = $transaction_id;
			$update_paydata['status'] = $status;
			$update_paydata['transaction_datetime'] = date('Y-m-d H:i:s');
			DB::table('partner_payment_transactions')->where('order_id',$order_id)->update($update_paydata);
			
			

			//deduct points
			$get_customer_details = DB::select("select total_paid_points from partners where partner_id='".$user_id."'");
			if(isset($get_customer_details[0])){
				$added_points = round($amount/10);
				$current_avail_points = $get_customer_details[0]->total_paid_points!=''?$get_customer_details[0]->total_paid_points:0;
				$transactional_points = $current_avail_points+$added_points;
				//update points in user table
				$update_userdata['total_paid_points'] = $transactional_points;
				DB::table('partners')->where('partner_id',$user_id)->update($update_userdata);
				//insert in points history
				$insert_data_1['partner_id'] = $user_id;
				$insert_data_1['points'] =$added_points;
				$insert_data_1['total_points'] = $transactional_points;
				$insert_data_1['type'] = "paid";
				$insert_data_1['amount'] = ceil($amount);
				$insert_data_1['credit_type'] = 'credit';
				$insert_data_1['created_date'] = date('Y-m-d H:i:s');
				DB::table('partner_points_history')->insert($insert_data_1);
			}
			$api_key = Config::get('constants.options.api_key');
			$api_secret = Config::get('constants.options.api_secret');

			$api = new Api($api_key, $api_secret);
			$api->payment->fetch($transaction_id)->capture(array('amount'=>ceil($amount)*100,'currency' => 'INR'));
		}
		$res_data = array(
			"msg"=>"Payment status updated successfully!",
			"status"=>"Success"
		);
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function sendpartnerpushnotificationsrepeat($appointment_id,$latitude,$longitude,$type,$partner_id){
		//$services_list = DB::select("select fcm_token_id from partners where fcm_token_id is not null");
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
									order by distance) as tab) 
									and ph.partner_id not in (select partner_id from appointment_rejected_partners where appointment_id='$appointment_id')
									group by partner_id");
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

	public function dashboardbanners(){
		$banners_list = DB::select("select * from banners where status='1' order by sequence limit 5");
		$prokey=0;
		$product_banners_data=array();
		foreach($banners_list as $banners_li){
			$product_banners_data[$prokey]['banner_image'] = $banners_li->banner_image_path!=''?url('/').'/public/assets/images/banners/'.$banners_li->banner_image_path:'';
			$prokey++;
		}
		$res_data['product_banners'] = $product_banners_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
}  
