<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use DB;
use App\Helpers\EncDecHelper;

ini_set('max_execution_time', '3000000'); //300 seconds = 5 minutes

class PartnerController extends BaseController
{

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
		
		
      $encpassword = EncDecHelper::enc_string($password);
      $checkUserLogin = DB::select("select * from login where username='".$username."' and password='".$encpassword."' and status=1");
      if(count($checkUserLogin)>0){
        $UserSessionData = array(
                                  'partner_id'=>$checkUserLogin[0]->user_id,
                                  'loginid'=>$checkUserLogin[0]->loginid,
                                  'username'=>$checkUserLogin[0]->username,
                                  'role_id'=>$checkUserLogin[0]->role_id,
                                  'display_name'=>$checkUserLogin[0]->display_name
                                );
								
			$res_data = array('status'=>"success",'data'=>$UserSessionData);				
								
	  }else{
		  $res_data = array('status'=>"failed",'data'=>[]);			  
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
		
		if($type == 'present'){
			$services_list = DB::select("SELECT partner_service_id,s.service_description,user_id,ps.service_id,service_name,service_description,image,price_per_unit,discount_perent,
estimated_time,ifnull(product_name,'') as product_name,ifnull(product_image,'') as product_image,ifnull(brand_name,'') as brand_name FROM partner_services ps inner join services s on ps.service_id=s.service_id left join service_categories sc on s.service_id=sc.service_id left join service_category_products scp on scp.service_category_id=sc.service_category_id left join products p on p.product_id=scp.product_id where ps.user_id='".$partner_id."' 
and s.status='1' order by partner_service_id desc ");
		}else{
			$services_list = DB::select("SELECT s.service_description,partner_service_id,user_id,ps.service_id,service_name,service_description,image,price_per_unit,discount_perent,
estimated_time,ifnull(product_name,'') as product_name,ifnull(product_image,'') as product_image,ifnull(brand_name,'') as brand_name FROM partner_services ps inner join services s on ps.service_id=s.service_id left join service_categories sc on s.service_id=sc.service_id left join service_category_products scp on scp.service_category_id=sc.service_category_id left join products p on p.product_id=scp.product_id where ps.user_id='".$partner_id."' 
and s.status='1' order by partner_service_id desc ");
// 			$services_list = DB::select("SELECT partner_service_id,user_id,ps.service_id,service_name,service_description,image,price_per_unit,discount_perent,
// estimated_time,ifnull(product_name,'') as product_name,ifnull(product_image,'') as product_image,ifnull(brand_name,'') as brand_name FROM partner_services ps inner join services s on ps.service_id=s.service_id left join service_categories sc on s.service_id=sc.service_id left join service_category_products scp on scp.service_category_id=sc.service_category_id left join products p on p.product_id=scp.product_id where ps.user_id='".$partner_id."' and s.status='1' and ps.created_date <= DATE_FORMAT( CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01' ) order by partner_service_id desc");
		}		
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
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
			$skey++;
		}
		$res_data['partner_services'] = $services_data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}

	public function partnerproducts_list(Request $request){
		$input = $request->all();			
		$partner_id='';
		if(isset($input['partner_id'])){
			$partner_id = $input['partner_id'];
		}	
		
		$services_list = DB::select("select partner_product_id,p.product_id,p.product_name,p.product_image,p.brand_name,p.originalprice from products p inner join partner_products ps on p.product_id=ps.product_id where partner_id='".$partner_id."' and p.status='1' order by p.product_id desc");
		
		$skey=0;
		$services_data=array();
		foreach($services_list as $services_lis)
		{
			$services_data[$skey]['product_id'] = (string)$services_lis->product_id;
			$services_data[$skey]['product_name'] = $services_lis->product_name;
			$services_data[$skey]['description'] = $services_lis->product_name;
			$services_data[$skey]['image'] = url('/').'/public/images/'.$services_lis->product_image;
			$services_data[$skey]['brand_name'] = $services_lis->brand_name;
			$services_data[$skey]['originalprice'] = (string)(int)$services_lis->originalprice;
			$skey++;
		}
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
		if($type == 'all'){
			$appointments_list = DB::select("SELECT a.appointment_id,a.appointment_date,a.actual_amount, a.discount_percent, s.service_name, ts.label, a.status FROM appointments a
											inner join services s on s.service_id=a.service_id
											inner join time_slots ts on ts.slot_id=a.appointment_slot_id
											where a.vendor_id='".$partner_id."' order by a.appointment_id desc");
		}else{
			$appointments_list = DB::select("SELECT a.appointment_id,a.appointment_date,a.actual_amount, a.discount_percent, s.service_name, ts.label, a.status FROM appointments a
											inner join services s on s.service_id=a.service_id
											inner join time_slots ts on ts.slot_id=a.appointment_slot_id
											where a.vendor_id='".$partner_id."' order by a.appointment_id desc limit 5");
		}
											
		$akey=0;
		$data=array();
		foreach($appointments_list as $appointments_li){
			$data[$akey]['appointment_id'] = (string)$appointments_li->appointment_id;
			$data[$akey]['appointment_date'] = date('d-M-Y', strtotime($appointments_li->appointment_date));
			$data[$akey]['actual_amount'] = (string)$appointments_li->actual_amount;
			$data[$akey]['discount_amount'] = $appointments_li->discount_percent!=''?(string)(($appointments_li->discount_percent / 100) * $appointments_li->actual_amount):'';
			$data[$akey]['service_name'] = $appointments_li->service_name;
			$data[$akey]['time_slot'] = $appointments_li->label;
			$data[$akey]['status'] = $appointments_li->status;
			$akey++;
		}
		$res_data['appointments_list'] = $data;
		return $this->sendResponse($res_data, 'Data fetched successfully.');
	}
	
}  
