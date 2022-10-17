<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, URL, Session, Redirect, Config;
use DateTime;
use DateTimeZone;
use App\Helpers\EncDecHelper;
use App\Helpers\Helper as Helper; 
use Razorpay\Api\Api;


class AnalyticsController extends Controller
{
    public function __construct(){
    }
    /**
     * @method reports
     * @desc To view the type of reports
     */
    public function checkLogin(Request $request){
      $input = $request->all();
      $username = $input['username'];
      $userpassword = $input['userpassword'];
      $encpassword = EncDecHelper::enc_string($userpassword);
      $checkUserLogin = DB::select("select * from login where username='".$username."' and password='".$encpassword."' and status=1");
      if(count($checkUserLogin)>0){
        $UserSessionData = array(
                                  'user_id'=>$checkUserLogin[0]->user_id,
                                  'loginid'=>$checkUserLogin[0]->loginid,
                                  'username'=>$checkUserLogin[0]->username,
                                  'role_id'=>$checkUserLogin[0]->role_id,
                                  'profile_picture'=>$checkUserLogin[0]->profile_picture,
                                  'display_name'=>$checkUserLogin[0]->display_name
                                );
        session()->put('LoginUserSession', $UserSessionData);
        if($checkUserLogin[0]->is_password_update==1){
          if($checkUserLogin[0]->role_id==1){
            return Redirect::to('admindashboard');
          } else if($checkUserLogin[0]->role_id==4){
            return Redirect::to('distributordashboard');
          }
        } else {
          return Redirect::to('changePassword');
        }
      } else {
        return Redirect::to('admin?status=error');
      }
    }
    public function adminLogin(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        if($session_details['role_id']==1){
          return Redirect::to('admindashboard');
        } else if($session_details['role_id']==4){
          return Redirect::to('distributordashboard');
        }
      } else {
        $input = $request->all();
        if(isset($input['status'])){
          $status = $input['status'];
        } else {
          $status = '';
        }
        $data['error']=$status;
        return view("login")->with($data);
      }
    }

    public function admindashboard(){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['categories']=DB::select("select * from categories c
        inner join types t on t.type_id=c.type_id;");
        $data['types']=DB::select("select * from types where status=1");
      
        // $data['data']= DB::SELECT("select (select count(*) as types from types where status=1) as types,(select count(*) as categories from categories where status=1) as categories,
        //                         (select count(*) as app_users from app_users where status=1) as app_users,
        //                         (select count(*) as partners from partners where status=1) as partners,
        //                         (select count(*) as products from products where status=1) as products,
        //                         (select count(*) as services from products where status=1) as services,
        //                         (SELECT sum(paid_amount) FROM partner_cart_payments) as total_revenue from partners limit 1"); 


        $data['types_count'] = DB::select("select count(*) as types from types where is_delete=0");
        $data['categories_count'] = DB::select("select count(*) as categories from categories where is_delete=0");
        $data['app_users_count'] = DB::select("select count(*) as app_users from app_users where status=1");
        $data['partners_count'] = DB::select("select count(*) as partners from partners where is_delete=0");
        $data['products_count'] = DB::select("select count(*) as products from products where is_delete=0");
        $data['services_count'] = DB::select("select count(*) as service_cnt from services where is_delete=0");
        $data['total_hubs'] = DB::select("select count(*) as hubs_count from hubs where is_delete=0");
        $data['dispatch_prod_count'] = DB::select("SELECT sum(no_of_items) as dispatched_products FROM customer_carts 
                                                    where status=1 and order_id in (select order_id from customer_cart_payments 
                                                    where dispatched_status=1)");
        $partner_total_revenue = DB::select("select sum(amount) as part_paid_amount from partner_payment_transactions ppt 
                                              inner join partners au on au.partner_id=ppt.user_id
                                              where transaction_number is not null and ppt.status='success'");
        $customer_total_revenue = DB::select("select sum(amount) as cust_paid_amount from customer_payment_transactions cpt 
                                              inner join app_users au on au.user_id=cpt.user_id
                                              where transaction_number is not null and cpt.status='success'");

        $app_users = DB::select("SELECT count(*) as user_count, DATE(registered_date) as registered_date FROM app_users where status=1 
                                  group by DATE(registered_date) order by registered_date desc limit 7");
        $user_dates = array();
        $user_counts=array();
        foreach($app_users as $app_user){
          $user_dates[] = '"'.date('d-M-Y', strtotime($app_user->registered_date)).'"';
          $user_counts[] = (int)$app_user->user_count;
        }
        $appoints_count = DB::select("select count(*) as appoint_count, appointment_date from appointments 
                                      group by appointment_date order by appointment_date desc limit 7");
        $appoint_dates = array();
        $appoint_counts=array();
        foreach($appoints_count as $appoint_count){
          $appoint_dates[] = '"'.date('d-M-Y', strtotime($appoint_count->appointment_date)).'"';
          $appoint_counts[] = (int)$appoint_count->appoint_count;
        }
        $data['user_dates_str'] = implode(',',$user_dates);
        $data['user_counts_str'] = implode(',',$user_counts);
        $data['appoint_dates_str'] = implode(',',$appoint_dates);
        $data['appoint_counts_str'] = implode(',',$appoint_counts);
        $data['total_revenue'] = $partner_total_revenue[0]->part_paid_amount + $customer_total_revenue[0]->cust_paid_amount;
        return view("reports/admindashboard")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function categoriesList(Request $request){
		EncDecHelper::getcallmasking('+919963608728','+917569669657');
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['categories']=DB::select("select c.*, t.type from categories c
                                        inner join types t on t.type_id=c.type_id where c.is_delete=0 order by category_id desc");
        $data['types']=DB::select("select * from types where status=1");
        return view("reports/categories")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }
	
	public function typeslist(Request $request){
      $session_details = session()->get('LoginUserSession');
      
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['types']=DB::select("select * from types where is_delete=0 order by type_id desc");
        return view("reports/types")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function productsList(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['categories']=DB::select("select * from categories where status=1");
        $data['products']=DB::select("select * from products where is_delete=0 order by product_id desc");
        return view("reports/products")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function servicesList(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['categories']=DB::select("select * from categories where status=1");
        $data['services']=DB::select("select s.*,t.type,c.category_name from services s
                                      inner join types t on t.type_id=s.type_id
                                      inner join categories c on c.category_id=s.category_id 
                                      where s.is_delete=0 group by service_id order by s.service_id desc");
        return view("reports/services")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function saveCategory(Request $request){
      $input = $request->all();
      $category_id = $input['category_id'];
      $category_name = $input['category_name'];
      $type_id = $input['type_id'];
      if($category_id==''){
        $checkeexists = DB::select("select unique_id from categories where is_delete=0 and category_name='".$category_name."'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        $data=array('category_name'=>$category_name,"type_id"=>$type_id,"status"=>1);
        $new_id = DB::table('categories')->insertGetId($data);
        if($new_id>9){
          $unique_id='EZCAT'.$new_id;
        } else {
          $unique_id='EZCAT0'.$new_id;
        }
        DB::table('categories')->where(array('category_id'=>$new_id))->update(array('unique_id'=>$unique_id));
      } else {
        $checkeexists = DB::select("select unique_id from categories where is_delete=0 
                                    and category_name='".$category_name."' and category_id!='".$category_id."'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        $data=array('category_name'=>$category_name,"type_id"=>$type_id);
        DB::table('categories')->where(array('category_id'=>$category_id))->update($data);
      }
      echo 'Inserted';
    }
	
	 public function saveType(Request $request){
      $input = $request->all();
      $category_id = $input['category_id'];
      $category_name = $input['category_name'];
      if($category_id==''){
        $checkeexists = DB::select("select unique_id from types where is_delete=0 and type='".$category_name."'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        $data=array('type'=>$category_name,"status"=>1);
        $new_id = DB::table('types')->insertGetId($data);
        if($new_id>9){
          $unique_id='EZTYPE'.$new_id;
        } else {
          $unique_id='EZTYPE0'.$new_id;
        }
        DB::table('types')->where(array('type_id'=>$new_id))->update(array('unique_id'=>$unique_id));
      } else {
        $checkeexists = DB::select("select unique_id from types where is_delete=0 and type='".$category_name."' and type_id!='$category_id'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        $data=array('type'=>$category_name);
        DB::table('types')->where(array('type_id'=>$category_id))->update($data);
      }
      echo 'Inserted';
    }

    public function saveProduct(Request $request){
      $input = $request->all();
      $product_id = $input['product_id'];
      $product_type = $input['product_type'];
      $product_name = $input['product_name'];
      $brand_name = $input['brand_name'];
      //$category_id = $input['category_id'];
      $originalprice = $input['originalprice'];
      $no_of_items = $input['no_of_items'];
      //$service_ids = $input['service_ids'];
      //$type_id = $input['type_id'];
      $discount = isset($input['discount'])?$input['discount']:NULL;
      $deduct_redeem_points = isset($input['deduct_redeem_points'])?$input['deduct_redeem_points']:NULL;
      $product_name = str_replace("'","",$product_name);
      $brand_name = str_replace("'","",$brand_name);
      $data=array(
          'product_name'=>$product_name,
          "product_type"=>$product_type,
          "brand_name"=>$brand_name,
          "originalprice"=>$originalprice,
          "no_of_items"=>$no_of_items,
          "available_quantity"=>$no_of_items,
          "discount"=>$discount,
          "deduct_redeem_points"=>$deduct_redeem_points,
          "created_date"=>date('Y-m-d H:i:s')
        );
        $file_doc_name='';
        $file_doc_path = public_path().'/images/products';
        if($request->hasfile('product_image')){
            $extension = $request->file('product_image')->extension();
            $mime_type = $request->file('product_image')->getMimeType();
            $file_doc_name = 'products/service_image'.'-'.time().'.'.$extension;
            $dep_file_upload = $request->product_image->move($file_doc_path, $file_doc_name);
            $data["product_image"]=$file_doc_name;
        }
      if($product_id==''){
        $checkeexists = DB::select("select unique_id from products where is_delete=0 and product_name='".$product_name."' 
                                    and product_type='".$product_type."'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        $data["status"]=1;
        $new_product_id = DB::table('products')->insertGetId($data);
        if($new_product_id>9){
          $unique_id='EZPROD'.$new_product_id;
        } else {
          $unique_id='EZPROD0'.$new_product_id;
        }
        DB::table('products')->where(array('product_id'=>$new_product_id))->update(array('unique_id'=>$unique_id));
        // if(count($service_ids)>0){
        //   foreach($service_ids as $service_id){
        //     $service_product_data['service_category_id'] = $service_id;
        //     $service_product_data['product_id'] = $new_product_id;
        //     DB::table('service_category_products')->insert($service_product_data);
        //   }
        // }
      } else {
        $checkeexists = DB::select("select unique_id from products where is_delete=0 and product_name='".$product_name."' 
                                    and product_id!='".$product_id."' and product_type='".$product_type."'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        DB::table('products')->where(array('product_id'=>$product_id))->update($data);
        // if(count($service_ids)>0){
        //   DB::table('service_category_products')->where('product_id',$product_id)->delete();
        //   foreach($service_ids as $service_id){
        //     $service_product_data['service_category_id'] = $service_id;
        //     $service_product_data['product_id'] = $product_id;
        //     DB::table('service_category_products')->insert($service_product_data);
        //   }
        // }
      }
      echo 'Inserted';
    }

    public function saveService(Request $request){
      $input = $request->all();
      $service_id = $input['service_id'];
      $service_name = $input['service_name'];
      $type_id = $input['type_id'];
      $category_id = $input['category_id'];
      $service_description = $input['service_description'];
      $short_description = $input['short_description'];
      $price_per_unit = $input['price_per_unit'];
      $discount_perent = $input['discount_perent'];
      $estimated_time = $input['estimated_time'];
      
      $product_ids = $input['product_id'];
      $no_of_times_usables = $input['no_of_times_usable'];
      $total_points_redeemed = $input['total_points_redeemed'];
      $paid_points_redeem = $input['paid_points_redeem'];
      $bonus_points_redeem = $input['bonus_points_redeem'];
      $penalty_points_redeem = $input['penalty_points_redeem'];
      $penalty_paid_points_redeem = $input['penalty_paid_points_redeem'];
      $penalty_bonus_points_redeem = $input['penalty_bonus_points_redeem'];
      $customer_referral_points = $input['customer_referral_points'];
      $number_products_required = $input['number_products_required'];
      for($i=0;$i<count($product_ids);$i++){
        if($product_ids[$i]=='' || $no_of_times_usables[$i]==''){
          echo 'error'; die;
        }
      }
      $service_name = str_replace("'","",$service_name);
      $service_description = str_replace("'","",$service_description);
      $data=array(
          'service_name'=>$service_name,
          "type_id"=>$type_id,
          "category_id"=>$category_id,
          "service_description"=>$this->sanitize_output($service_description),
          "short_description"=>$short_description,
          "price_per_unit"=>$price_per_unit,
          "discount_perent"=>$discount_perent,
          "estimated_time"=>$estimated_time,
          "created_date"=>date('Y-m-d H:i:s')
        );
        //$data['product_id'] = $product_id;
        //$data['no_of_times_usable'] = $no_of_times_usable;
        $data['total_points_redeemed'] = $total_points_redeemed;
        $data['paid_points_redeem'] = $paid_points_redeem;
        $data['bonus_points_redeem'] = $bonus_points_redeem;
        $data['penalty_points_redeem'] = $penalty_points_redeem;
        $data['penalty_paid_points_redeem'] = $penalty_paid_points_redeem;
        $data['penalty_bonus_points_redeem'] = $penalty_bonus_points_redeem;
        $data['customer_referral_points'] = $customer_referral_points;
        $file_doc_name='';
        $file_doc_path = public_path().'/images/services';
        if($request->hasfile('image')){
            $extension = $request->file('image')->extension();
            $mime_type = $request->file('image')->getMimeType();
            $file_doc_name = 'services/service_image'.'-'.time().'.'.$extension;
            $dep_file_upload = $request->image->move($file_doc_path, $file_doc_name);
            $data['image']=$file_doc_name;
        }
        
      if($service_id==''){
        $checkeexists = DB::select("select unique_id from services where is_delete=0 and service_name='".$service_name."' 
                                    and type_id='".$type_id."' and category_id='".$category_id."'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        $data['status']=1;
        $new_service_id = DB::table('services')->insertGetId($data);
        if($new_service_id>9){
          $unique_id='EZSRVC'.$new_service_id;
        } else {
          $unique_id='EZSRVC0'.$new_service_id;
        }
        DB::table('services')->where(array('service_id'=>$new_service_id))->update(array('unique_id'=>$unique_id));

        $service_category_data['service_id'] = $new_service_id;
        $service_category_data['category_id'] = $category_id;
        $service_category_id = DB::table('service_categories')->insertGetId($service_category_data);
        //save service product
        for($i=0;$i<count($product_ids);$i++){
            $service_product_data['service_category_id'] = $service_category_id;
            $service_product_data['product_id'] = $product_ids[$i];
            $service_product_data['no_of_times_usable'] = $no_of_times_usables[$i];
            $service_product_data['required_percentage'] = ceil(100/$no_of_times_usables[$i]);
            DB::table('service_category_products')->insertGetId($service_product_data);
        }
      } else {
        $checkeexists = DB::select("select unique_id from services where is_delete=0 and service_name='".$service_name."' 
        and service_id!='".$service_id."' and type_id='".$type_id."' and category_id='".$category_id."'");
        if(isset($checkeexists[0])){
          echo 'exist'; die;
        }
        DB::table('services')->where(array('service_id'=>$service_id))->update($data);
        $upservice_category_data['service_id'] = $service_id;
        $upservice_category_data['category_id'] = $category_id;
        DB::table('service_categories')->where(array('service_id'=>$service_id))->update($upservice_category_data);
        $getservicecategory = DB::select("select service_category_id from service_categories where service_id='".$service_id."' and category_id='".$category_id."'");
        //save service product
        $deleteservicecategory = DB::select("delete from service_category_products where service_category_id='".$getservicecategory[0]->service_category_id."'");
        for($i=0;$i<count($product_ids);$i++){
          $service_product_data['service_category_id'] = $getservicecategory[0]->service_category_id;
          $service_product_data['product_id'] = $product_ids[$i];
          $service_product_data['no_of_times_usable'] = $no_of_times_usables[$i];
          $service_product_data['required_percentage'] = ceil(100/$no_of_times_usables[$i]);
          DB::table('service_category_products')->insertGetId($service_product_data);
        }
      }
      echo 'Inserted';
    }

    public function partnersList(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['users']=DB::select("SELECT p.*, hubnames FROM partners p
                        inner join (SELECT partner_id,group_concat(hub_title) as hubnames from partner_hubs ph 
                        left join  hubs h on h.hub_id=ph.hub_id group by partner_id) as hb on hb.partner_id=p.partner_id 
                        where p.status=1 and p.is_delete=0 order by p.partner_id desc");
        return view("reports/partnersList")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }
	
	  public function patnerOrders(Request $request){
      $input = $request->all();
      $status = isset($input['status'])?$input['status']:'';
      $data['status'] = $status;
      // $cond_str = "where p.dispatched_status='0'";
      // if($status!=''){
      //   $cond_str = "where p.dispatched_status='$status'";
      // }
      $cond_str = "where p.dispatched_status='0'";
      if($status!='' || (isset($input['status']) && $input['status']=='pending')){
        if($input['status']=='pending'){
          $status = 0;
        } else {
          $status = $input['status'];
        }
        $cond_str = "where p.dispatched_status='$status'";
      }
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['users']=DB::select("select p.partner_cart_payments_id,p.partner_id,p.order_id,p.total_products,p.total_amount,p.paid_amount,p.discount_amount,pm.payment_modes,p.payment_receipt_attachment,
            date(p.created_date) as orderdate,concat(pr.first_name,' ',pr.last_name) as partnername,pr.mobile,pr.unique_id,p.dispatched_status
            from partner_cart_payments p left join payment_modes pm on p.payment_mode_id=pm.payment_modes_id 
            inner join partners pr on pr.partner_id=p.partner_id $cond_str 
            group by p.partner_cart_payments_id order by p.partner_cart_payments_id desc");
        return view("reports/patnerOrders")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }
	
	  public function viewOrderProducts(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $input = $request->all();
        $order_id = $input['order_id'];
        $data['users']=DB::select("select product_name,pr.unique_id,product_description,pr.product_image,p.no_of_items,actuval_product_price,p.discount,discount_product_price,
        date(p.created_date) as orderdate from partner_carts p inner join products pr on p.product_id=pr.product_id where p.status=1 and p.order_id='".$order_id."'");
        return view("reports/viewOrderProducts")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function deleteProduct(Request $request){
      $input = $request->all();
      $product_id = $input['product_id'];
      // $data=array(
      //   "status"=>0
      // );
      $status = $input['status'];
      $data=array(
        "status"=>$status
      );
      DB::table('products')->where(array('product_id'=>$product_id))->update($data);
      echo 'updated';
    }

    public function deleteService(Request $request){
      $input = $request->all();
      $service_id = $input['service_id'];
      // $data=array(
      //   "status"=>0
      // );
      $status = $input['status'];
      $data=array(
        "status"=>$status
      );
      DB::table('services')->where(array('service_id'=>$service_id))->update($data);
      echo 'updated';
    }

    public function appointmentsList(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['appointmenets_list']=DB::select("SELECT a.appointment_id,a.appointment_date,a.actual_amount, a.discount_percent, s.service_name, 
                                        ts.label, a.status, au.first_name,au.last_name,au.user_id,au.email, 
											                p.first_name as partner_fname,p.last_name as partner_lname,p.unique_id FROM appointments a
                                        inner join services s on s.service_id=a.service_id
                                        inner join app_users au on au.user_id=a.user_id
                                        inner join time_slots ts on ts.slot_id=a.appointment_slot_id
                                        left join partners p on p.partner_id=a.vendor_id
                                        order by a.appointment_id desc");
        return view("reports/appointmentsList")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function appUsersList(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['users_list']=DB::select("SELECT u.user_id, u.first_name, u.last_name, u.email, mn.mobile_number, u.gender,u.address,
                                          u.registered_date, u.status, u.redeem_points FROM app_users u 
                                          inner join mobile_numbers mn on mn.mobile_number_id=u.mobile order by u.registered_date desc");
        return view("reports/users_list")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/admin');
    }

    public function deleteCategory(Request $request){
      $input = $request->all();
      $category_id = $input['category_id'];
      $status = $input['status'];
      $data=array(
        "status"=>$status
      );
      DB::table('categories')->where(array('category_id'=>$category_id))->update($data);
      echo 'updated';
    }
	
	 public function deleteType(Request $request){
      $input = $request->all();
      $type_id = $input['type_id'];
      $status = $input['status'];
      $data=array(
        "status"=>$status
      );
      DB::table('types')->where(array('type_id'=>$type_id))->update($data);
      echo 'updated';
    }

    public function addNewPartner(){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['hubsList'] = DB::select("select * from hubs where status=1 order by hub_id desc");
        $configurations = DB::select("SELECT welcome_bonus_points FROM config_data");
        $data['configurations'] = $configurations[0];
        return view("reports/add_new_partner")->with($data);
      } else {
        return Redirect::to('admin');
      }
    }

    public function savePartner(Request $request){
      $input = $request->all();
      $partner_id = $input['partner_id'];
      $first_name = $input['first_name'];
      $last_name = $input['last_name'];
      $mobile = $input['mobile'];
      $email = $input['email'];
      $gender = $input['gender'];
      $dob = $input['dob'];
      $address = $input['address'];
      $hub_ids = $input['hub_id'];
      $latitude = $input['latitude'];
      $longitude = $input['longitude'];
      if(count($hub_ids)==0){
        echo 'failed'; die;
      }
      $propic_name='';
      $propic = public_path().'/images/profiles';
      if($request->hasfile('profile_picture')){
          $extension = $request->file('profile_picture')->extension();
          $mime_type = $request->file('profile_picture')->getMimeType();
          $propic_name = 'profiles/profile'.'-'.time().'.'.$extension;
          $dep_file_upload = $request->profile_picture->move($propic, $propic_name);
          $propic_basestr = base64_encode(file_get_contents(url('/').'/public/images/'.$propic_name));
          $data['profile_picture']=$propic_basestr;
      }

      //ID Proof
      $idproof_name='';
      $idproof_doc = public_path().'/images/proofs';
      if($request->hasfile('id_proof')){
          $extension = $request->file('id_proof')->extension();
          $mime_type = $request->file('id_proof')->getMimeType();
          $idproof_name = 'proofs/proofid'.'-'.time().'.'.$extension;
          $dep_file_upload = $request->id_proof->move($idproof_doc, $idproof_name);
          $data['id_proof']=$idproof_name;
      }

      //Address proof
      $addressproof_name='';
      $addresspic = public_path().'/images/proofs';
      if($request->hasfile('address_proof')){
          $extension = $request->file('address_proof')->extension();
          $mime_type = $request->file('address_proof')->getMimeType();
          $addresproof_name = 'proofs/proofaddress'.'-'.time().'.'.$extension;
          $dep_file_upload = $request->address_proof->move($addresspic, $addresproof_name);
          $data['address_proof']=$addresproof_name;
      }
      $data['first_name']=$first_name;
      $data['last_name']=$last_name;
      $data['mobile']=$mobile;
      $data['email']=$email;
      $data['gender']=$gender;
      $data['dob']=$dob;
      $data['address']=$address;
      $data['latitude']=$latitude;
      $data['longitude']=$longitude;
      $data['created_by']=1;
      $data['created_date']=date('Y-m-d H:i:s');
      //$data['hub_id']=$hub_id;
    if($partner_id==''){
      $data['status']=1;
      $configurations = DB::select("SELECT welcome_bonus_points FROM config_data");
      $data['total_bonus_points']=$configurations[0]->welcome_bonus_points;
      $partner_id = DB::table('partners')->insertGetId($data);
      if($partner_id>9){
        $unique_id='EZPART'.$partner_id;
      } else {
        $unique_id='EZPART0'.$partner_id;
      }
      DB::table('partners')->where(array('partner_id'=>$partner_id))->update(array('unique_id'=>$unique_id));
      //save points log
      $partner_points_data['partner_id'] = $partner_id;
      $partner_points_data['points'] = $configurations[0]->welcome_bonus_points;
      $partner_points_data['type'] = 'bonus';
      $partner_points_data['total_points'] = $configurations[0]->welcome_bonus_points;
      $partner_points_data['credit_type'] = 'credit';
      $partner_points_data['created_date'] = date('Y-m-d H:i:s');
      DB::table('partner_points_history')->insert($partner_points_data);
      $encpassword = EncDecHelper::enc_string('ezglam@789');
      $login_data['username'] = $mobile;
      $login_data['password'] = $encpassword;
      $login_data['role_id'] = 2;
      $login_data['display_name'] = $first_name.' '.$last_name;
      $login_data['user_id'] = $partner_id;
      $login_data['status'] = 1;
      DB::table('login')->insert($login_data);
      if(count($hub_ids)>0){
        foreach($hub_ids as $hub_id){
          $hubmapdata['partner_id'] = $partner_id;
          $hubmapdata['hub_id'] = $hub_id;
          DB::table('partner_hubs')->insert($hubmapdata);
        } 
      }
      $getallservices = DB::select("select service_id from services where status=1");
      foreach($getallservices as $getallservice){
        $partner_servicedata['user_id'] = $partner_id;
        $partner_servicedata['service_id'] = $getallservice->service_id;
        $partner_servicedata['status'] = 1;
        DB::table('partner_services')->insert($partner_servicedata);
      }
    } else {
      DB::table('partners')->where(array('partner_id'=>$partner_id))->update($data);
      $login_data['username'] = $mobile;
      $login_data['role_id'] = 2;
      $login_data['display_name'] = $first_name.' '.$last_name;
      $login_data['user_id'] = $partner_id;
      $login_data['status'] = 1;
      DB::table('login')->where(array('user_id'=>$partner_id))->update($login_data);
      if(count($hub_ids)>0){
        DB::table('partner_hubs')->where('partner_id',$partner_id)->delete();
        foreach($hub_ids as $hub_id){
          $hubmapdata['partner_id'] = $partner_id;
          $hubmapdata['hub_id'] = $hub_id;
          DB::table('partner_hubs')->insert($hubmapdata);
        } 
      }
      $postservices = $input['postservices'];
      if(count($postservices)>0){
        DB::table('partner_services')->where('user_id',$partner_id)->update(array('status'=>'0'));
        foreach($postservices as $getallservice){
          // $partner_servicedata['user_id'] = $partner_id;
          // $partner_servicedata['service_id'] = $getallservice;
          $partner_servicedata['status'] = 1;
          DB::table('partner_services')->where('user_id',$partner_id)->where('service_id',$getallservice)->update($partner_servicedata);
        }
      }
    }
    echo 'Inserted';
  }

  public function editPartner(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $partner_id = $input['partner_id'];
      $partner_details = DB::select("select * from partners where	partner_id='".$partner_id."'");
      $data['selected_hubs'] = DB::select("select * from partner_hubs where	partner_id='".$partner_id."'");
      $data['hubsList'] = DB::select("select * from hubs where status=1");
      $data['partner_services']=DB::select("SELECT service_id FROM partner_services where user_id='".$partner_id."' and status=1");
      $data['all_services']=DB::select("SELECT s.service_id, s.service_name,t.type, c.category_name  FROM services s
                                        inner join types t on t.type_id=s.type_id
                                        inner join categories c on c.category_id=s.category_id where s.status=1");
      $data['partner_details'] = $partner_details[0];
      return view("reports/edit_partner")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function deletePartner(Request $request){
    $input = $request->all();
    $partner_id = $input['partner_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('partners')->where(array('partner_id'=>$partner_id))->update($data);
    echo 'updated';
  }

  public function addNewService(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['types']=DB::select("select * from types where status=1");
      $data['products_list']=DB::select("select product_id, product_name from products where status=1 and product_type='partner'");
      $data['categories']=DB::select("select * from categories where status=1");
      return view("reports/add_new_service")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function get_categories(Request $request){
    $input = $request->all();
    $type_id = $input['type_id'];
    $type_categories = DB::select("select * from categories where type_id='".$type_id."'");
    $categories_str = '<option value="">-Select Category-</option>';
    foreach($type_categories as $type_category){
      $categories_str .= '<option value="'.$type_category->category_id.'">'.$type_category->category_name.'</option>';
    }
    echo $categories_str; die;
  }


  public function editService(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $service_id = $input['service_id'];
      $data['types']=DB::select("select * from types where status=1");
      $data['products_list']=DB::select("select product_id, product_name, unique_id from products where status=1");
      $service_details = DB::select("select s.*,t.type,c.category_id,c.category_name from services s                       
                          inner join categories c on c.category_id=s.category_id 
                          inner join types t on t.type_id=c.type_id
                          where s.service_id='".$service_id."'");
      $data['categories']=DB::select("select * from categories where type_id='".$service_details[0]->type_id."'");
      $getservicecategory = DB::select("select service_category_id from service_categories where service_id='".$service_id."' 
                                  and category_id='".$service_details[0]->category_id."'");
      $data['service_category_products']=DB::select("select * from service_category_products 
                                                  where service_category_id='".$getservicecategory[0]->service_category_id."'");
      $data['service_details']=$service_details[0];
      return view("reports/edit_service")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function addNewProduct(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['types']=DB::select("select * from types where status=1");
      return view("reports/add_new_product")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function get_services_change(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $type_categories = DB::select("SELECT service_category_id, sc.service_id,service_name FROM service_categories sc
                                    inner join services s on s.service_id=sc.service_id where sc.category_id='".$category_id."'");
    $categories_str = '<option value="">-Select Services-</option>';
    foreach($type_categories as $type_category){
      $categories_str .= '<option value="'.$type_category->service_category_id.'">'.$type_category->service_name.'</option>';
    }
    echo $categories_str; die;
  }

  public function editProduct(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $product_id = $input['product_id'];
      $data['types']=DB::select("select * from types where status=1");
      $product_details = DB::select("SELECT * FROM products where product_id='$product_id'");
      $data['product_categories']=DB::select("select scp.*, sc.category_id from service_category_products  scp
                                inner join service_categories sc on sc.service_category_id=scp.service_category_id
                                where scp.product_id='".$product_id."'");
      $data['categories']=DB::select("select * from categories where type_id='".$product_details[0]->type_id."'");
      $data['category_services'] = DB::select("SELECT service_category_id, sc.service_id,service_name FROM service_categories sc
                              inner join services s on s.service_id=sc.service_id where sc.category_id='".$product_details[0]->category_id."'");
      $data['product_details']=$product_details[0];
      return view("reports/edit_product")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function distributorsList(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      //$data['users_list']=DB::select("SELECT * FROM distirbutors");
      $data['users_list']=DB::select("SELECT p.*, hubnames FROM distirbutors p
                          left join (SELECT distributor_id,group_concat(hub_title) as hubnames from distributor_hubs ph 
                          left join  hubs h on h.hub_id=ph.hub_id group by distributor_id) as hb on hb.distributor_id=p.distirbutor_id 
                          where p.is_delete=0 order by p.distirbutor_id desc");
      return view("reports/distributorsList")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function addNewDistributor(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['hubsList'] = DB::select("select * from hubs where status=1");
      return view("reports/add_new_distributor")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function saveDistributor(Request $request){
    $input = $request->all();
    $distirbutor_id = $input['distirbutor_id'];
    $first_name = $input['first_name'];
    $last_name = $input['last_name'];
    $phone_number = $input['phone_number'];
    $email = $input['email'];
    $hub_ids = $input['hub_id'];
    $permanant_address = $input['permanant_address'];
    //$hub_location_address = $input['hub_location_address'];
    $pincode = $input['pincode'];
    $latitude = $input['latitude'];
    $longitude = $input['longitude'];
    if(count($hub_ids)==0){
      echo 'failed'; die;
    }
    $data['first_name']=$first_name;
    $data['last_name']=$last_name;
    $data['phone_number']=$phone_number;
    $data['email']=$email;
    $data['permanant_address']=$permanant_address;
    //$data['hub_location_address']=$hub_location_address;
    $data['latitude']=$latitude;
    $data['longitude']=$longitude;
    $data['pincode']=$pincode;
    $data['created_date']=date('Y-m-d H:i:s');
    //$data['hub_id']=$hub_id;
    if($distirbutor_id==''){
      $data['status']=1;
      $new_distirbutor_id = DB::table('distirbutors')->insertGetId($data);
      if($new_distirbutor_id>9){
        $unique_id='EZDIST'.$new_distirbutor_id;
      } else {
        $unique_id='EZDIST0'.$new_distirbutor_id;
      }
      DB::table('distirbutors')->where(array('distirbutor_id'=>$new_distirbutor_id))->update(array('unique_id'=>$unique_id));
      $encpassword = EncDecHelper::enc_string('ezglam@789');
      $login_data['username'] = $phone_number;
      $login_data['password'] = $encpassword;
      $login_data['role_id'] = 4;
      $login_data['display_name'] = $first_name.' '.$last_name;
      $login_data['user_id'] = $new_distirbutor_id;
      $login_data['status'] = 1;
      DB::table('login')->insert($login_data);
      if(count($hub_ids)>0){
        foreach($hub_ids as $hub_id){
          $hubmapdata['distributor_id'] = $new_distirbutor_id;
          $hubmapdata['hub_id'] = $hub_id;
          DB::table('distributor_hubs')->insert($hubmapdata);
        } 
      }
    } else {
      DB::table('distirbutors')->where(array('distirbutor_id'=>$distirbutor_id))->update($data);
      $login_data['username'] = $phone_number;
      $login_data['role_id'] = 4;
      $login_data['display_name'] = $first_name.' '.$last_name;
      $login_data['user_id'] = $distirbutor_id;
      $login_data['status'] = 1;
      DB::table('login')->where(array('user_id'=>$distirbutor_id))->update($login_data);
      if(count($hub_ids)>0){
        DB::table('distributor_hubs')->where('distributor_id',$distirbutor_id)->delete();
        foreach($hub_ids as $hub_id){
          $hubmapdata['distributor_id'] = $distirbutor_id;
          $hubmapdata['hub_id'] = $hub_id;
          DB::table('distributor_hubs')->insert($hubmapdata);
        } 
      }
    }
    echo 'Inserted';
  }

  public function editDistributor(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $distirbutor_id = $input['distirbutor_id'];
      $partner_details = DB::select("select * from distirbutors where	distirbutor_id='".$distirbutor_id."'");
      $data['selected_hubs'] = DB::select("select * from distributor_hubs where	distributor_id='".$distirbutor_id."'");
      $data['hubsList'] = DB::select("select * from hubs where status=1");
      $data['partner_details'] = $partner_details[0];
      return view("reports/edit_distributor")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function deleteDistributor(Request $request){
    $input = $request->all();
    $distirbutor_id = $input['distirbutor_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('distirbutors')->where(array('distirbutor_id'=>$distirbutor_id))->update($data);
    echo 'updated';
  }

  public function distributorProducts(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $distirbutor_id = $input['distirbutor_id'];
      $data['distirbutor_id'] = $distirbutor_id;
      $data['distirbutor_name'] = $input['distirbutor_name'];
      $data['products']=DB::select("select * from products where status=1");
      $data['distributor_products'] = DB::select("select dp.distributor_product_id,dp.product_id,p.product_name,p.no_of_items, 
                                              dp.quantity, dp.status, dp.dispatched_date from distributor_products dp
                                              inner join products p on p.product_id=dp.product_id
                                              where dp.distributor_id='".$distirbutor_id."'");
      return view("reports/distributor_products")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function saveDistributorProduct(Request $request){
    $input = $request->all();
    $assign_type = $input['assign_type'];
    $distirbutor_id = $input['distirbutor_id'];
    $product_id = $input['product_id'];
    $quantity = $input['quantity'];
    $available_quantity = $input['ini_available_quantity'];
    $dispatched_date = $input['dispatched_date'];
    $check_dist_product = DB::select("select * from distributor_products 
                                      where distributor_id='".$distirbutor_id."' and product_id='".$product_id."'");
    $cur_date = date('Y-m-d H:i:s');
    if(count($check_dist_product)==0){
      //save distributor products
      $dis_products_data['distributor_id'] = $distirbutor_id;
      $dis_products_data['product_id'] = $product_id;
      $dis_products_data['quantity'] = $quantity;
      $dis_products_data['available_quantity'] = $quantity;
      $dis_products_data['status'] = '1';
      $dis_products_data['dispatched_date'] = $dispatched_date;
      $dis_products_data['created_date'] = $cur_date;
      DB::table('distributor_products')->insert($dis_products_data);
    } else {
      $updatedisprocount['quantity'] = $check_dist_product[0]->quantity+$quantity;
      DB::table('distributor_products')->where('distributor_product_id',$check_dist_product[0]->distributor_product_id)->update($updatedisprocount);
    }
    //insert log
    $dislogdata['distributor_id'] = $distirbutor_id;
    $dislogdata['product_id'] = $product_id;
    $dislogdata['quantity'] = $quantity;
    $dislogdata['created_date'] = $cur_date;
    DB::table('distributor_products_log')->insert($dislogdata);
    $update_item_data['no_of_items']=$available_quantity-$quantity;
    DB::table('products')->where(array('product_id'=>$product_id))->update($update_item_data);
    echo 'success'; die;
  }

  public function get_product_quantity(Request $request){
    $input = $request->all();
    $product_id = $input['product_id'];
    $products_details = DB::select("select no_of_items,available_quantity from products where product_id='$product_id'");
    $data['no_of_items'] = $products_details[0]->available_quantity;
    echo json_encode($data);
  }

  public function partnerProducts(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $partner_id = $input['partner_id'];
      $data['partner_id'] = $partner_id;
      $data['partner_name'] = $input['partner_name'];
      $data['products']=DB::select("select * from products where status=1");
      $data['partner_products'] = DB::select("select dp.partner_product_id,dp.product_id,p.product_name,p.no_of_items, 
                                              dp.quantity, dp.status, dp.dispatched_date from partner_products dp
                                              inner join products p on p.product_id=dp.product_id
                                              where dp.partner_id='".$partner_id."'");
      return view("reports/partner_products")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function savePartnerProduct(Request $request){
    $session_details = session()->get('LoginUserSession');
    $input = $request->all();
    $assign_type = $input['assign_type'];
    $partner_id = $input['partner_id'];
    $product_id = $input['product_id'];
    $quantity = $input['quantity'];
    $available_quantity = $input['ini_available_quantity'];
    $dispatched_date = $input['dispatched_date'];
    $check_partner_prod = DB::select("select * from partner_products where partner_id='".$partner_id."' and product_id='".$product_id."'");
    $products_details = DB::select("select product_usage_count from products where product_id='$product_id'");
    $cur_date = date('Y-m-d H:i:s');
    if(count($check_partner_prod)==0){
      //save partner products
      $dis_products_data['partner_id'] = $partner_id;
      $dis_products_data['product_id'] = $product_id;
      $dis_products_data['quantity'] = $quantity;
      $dis_products_data['status'] = '1';
      $dis_products_data['dispatched_date'] = $dispatched_date;
      $dis_products_data['services_count'] = $quantity*$products_details[0]->product_usage_count;
      $dis_products_data['product_percentage'] = $quantity*100;
      $dis_products_data['assigned_by'] = $session_details['loginid'];
      $dis_products_data['created_date'] = $cur_date;
      DB::table('partner_products')->insert($dis_products_data);
    } else {
      $updatedisprocount['quantity'] = $check_partner_prod[0]->quantity+$quantity;
      $updatedisprocount['product_percentage'] = $updatedisprocount['quantity']*100;
      $updatedisprocount['services_count'] = $check_partner_prod[0]->services_count+($quantity*$products_details[0]->product_usage_count);
      DB::table('partner_products')->where('partner_product_id',$check_partner_prod[0]->partner_product_id)->update($updatedisprocount);
    }
    //insert log
    $dislogdata['partner_id'] = $partner_id;
    $dislogdata['product_id'] = $product_id;
    $dislogdata['quantity'] = $quantity;
    $dislogdata['assigned_by'] = $session_details['loginid'];
    $dislogdata['created_date'] = $cur_date;
    DB::table('partner_products_log')->insert($dislogdata);
    $update_item_data['no_of_items']=$available_quantity-$quantity;
    $update_item_data['available_quantity']=$available_quantity-$quantity;
    DB::table('products')->where(array('product_id'=>$product_id))->update($update_item_data);
    echo 'success'; die;
  }

  public function distributordashboard(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $session_details = session()->get('LoginUserSession');
      $data['total_products'] = DB::select("SELECT sum(quantity) as total_products FROM distributor_products where distributor_id='".$session_details['user_id']."'");
      $data['distributor_products'] = DB::select("select dp.product_id,p.product_name,p.no_of_items, p.product_image, dp.quantity, dp.status, 
                          dp.dispatched_date from distributor_products dp 
                          inner join products p on p.product_id=dp.product_id where dp.distributor_id='".$session_details['user_id']."'");
      return view("reports/distributordashboard")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function distributorPartnersList(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['products']=DB::select("select dp.product_id,p.product_name,p.no_of_items, p.unique_id,p.product_image, dp.quantity, dp.status, 
                                    dp.dispatched_date from distributor_products dp 
                                    inner join products p on p.product_id=dp.product_id where dp.distributor_id='".$session_details['user_id']."'");
      return view("reports/distributorPartnersList")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function getPartnersList(Request $request){
    $input = $request->all();
    $keyword = $input['term'];
    $partners = DB::select("select unique_id from partners where unique_id like '%".$keyword."%'");
    $finalArray = array();
    if (count ( $partners ) > 0){ // Displaying when search list not empty
			foreach ($partners as $item){
				if($item->unique_id !=null || $item->unique_id != ""){
					$finalArray[] = array('label' => $item->unique_id);
				}
      }
    } else {
				$finalArray[] = array('label' => 'No items found');
    }
    echo json_encode($finalArray);
  }

  public function getpartnerdetails(Request $request){
    $input = $request->all();
    $partner_name = $input['partner_name'];
    $partner_details = DB::select("select partner_id,first_name, last_name, mobile, email, address from partners where unique_id='".$partner_name."'");
    if(count($partner_details)>0){
      echo '<table><tr><td><strong>Partner Name</strong></td><td><span> :'.ucwords(strtolower($partner_details[0]->first_name.' '.$partner_details[0]->last_name)).'</span></td></tr>
                  <tr><td><strong>Mobile</strong></td><td><span> :'.$partner_details[0]->mobile.'</span></td></tr>
                  <tr><td><strong>Email</strong></td><td><span> :'.$partner_details[0]->email.'</span></td></tr>
                  <tr><td><strong>Address</strong></td><td><span> :'.$partner_details[0]->address.'</span></td></tr>
                  <tr><td colspan="2"><button type="button" class="btn btn-success" onclick="send_otp_partner();">Confirm and Send OTP</button></td></tr>
                  </table>';
    } else {
      echo 'No Partner found with the entered Id';
    }
  }

  public function get_distproduct_quantity(Request $request){
    $session_details = session()->get('LoginUserSession');
    $input = $request->all();
    $product_id = $input['product_id'];
    $products_details = DB::select("SELECT quantity as product_count FROM distributor_products 
                        where distributor_id='".$session_details['user_id']."' and product_id='$product_id'");
    $data['no_of_items'] = $products_details[0]->product_count;
    echo json_encode($data);
  }

  public function send_otp_partner(Request $request){
    $input = $request->all();
    $partner_name = $input['partner_name'];
    $getpartner_details = DB::select("select first_name,last_name,partner_id, mobile from partners where unique_id='".$partner_name."'");
    $otp = rand(100000,999999);
    $data['otp'] = $otp;
    $data['otp_sent_datetime'] = date('Y-m-d H:i:s');
    DB::table('partners')->where(array('unique_id'=>$partner_name))->update($data);
    if(isset($getpartner_details[0])){
      $mobile_number = $getpartner_details[0]->mobile;
      $otp_number = $otp.' ';
      //$message = "Dear ".$getpartner_details[0]->first_name." ".$getpartner_details[0]->last_name.", Your OTP verification key for EzGlam Partner confirmation is ".$otp." and expires in 15mins Thank You EZGLAM Team";
      $message = "Dear ".$getpartner_details[0]->first_name." ".$getpartner_details[0]->last_name.", Your OTP verification key for EzGlam Partner confirmation is ".$otp_number."and expires in 15 min Thank You EZGLAM Team";
      $encpassword = EncDecHelper::sendsms($mobile_number,$message);
      //insert in partner otps
      $insertdata['partner_id'] = $getpartner_details[0]->partner_id;
      $insertdata['otp'] = $otp;
      $insertdata['type'] = 'product';
      $insertdata['created_date'] = date('Y-m-d H:i:s');
      DB::table('partner_otps')->insert($insertdata);
    }
    echo $otp; die;
  }

  public function saveDistPartnerProduct(Request $request){
    $session_details = session()->get('LoginUserSession');
    $input = $request->all();
    $partner_name = $input['partner_name'];
    $product_id = $input['product_id'];
    $quantity = $input['quantity'];
    $available_quantity = $input['ini_available_quantity'];
    $dispatched_date = $input['dispatched_date'];
    $partner_otp = $input['partner_otp'];
    $partner_details = DB::select("select partner_id, otp, otp_sent_datetime from partners where unique_id='".$partner_name."'");
    $products_details = DB::select("select product_usage_count from products where product_id='$product_id'");
    if(count($partner_details)>0){
      if($partner_details[0]->otp!=$partner_otp){
        echo 'error'; die;
      }
      $check_partner_prod = DB::select("select * from partner_products where partner_id='".$partner_details[0]->partner_id."' and product_id='".$product_id."'");
      if(count($check_partner_prod)==0){
        //save partner products
        $dis_products_data['partner_id'] = $partner_details[0]->partner_id;
        $dis_products_data['product_id'] = $product_id;
        $dis_products_data['quantity'] = $quantity;
        $dis_products_data['status'] = '1';
        $dis_products_data['dispatched_date'] = $dispatched_date;
        $dis_products_data['services_count'] = $quantity*$products_details[0]->product_usage_count;
        $dis_products_data['product_percentage'] = $quantity*100;
        $dis_products_data['assigned_by'] = $session_details['loginid'];
        $dis_products_data['created_date'] = date('Y-m-d H:i:s');
        DB::table('partner_products')->insert($dis_products_data);
      } else {
        $updatedisprocount['quantity'] = $check_partner_prod[0]->quantity+$quantity;
        $updatedisprocount['services_count'] = $check_partner_prod[0]->services_count+($quantity*$products_details[0]->product_usage_count);
        $updatedisprocount['product_percentage'] = $updatedisprocount['quantity']*100;
        DB::table('partner_products')->where('partner_product_id',$check_partner_prod[0]->partner_product_id)->update($updatedisprocount);
      }
      //insert log
      $dislogdata['partner_id'] = $partner_details[0]->partner_id;
      $dislogdata['product_id'] = $product_id;
      $dislogdata['quantity'] = $quantity;
      $dislogdata['assigned_by'] = $session_details['loginid'];
      $dislogdata['created_date'] = date('Y-m-d H:i:s');
      DB::table('partner_products_log')->insert($dislogdata);
      //update dist prod count
      $products_details = DB::select("SELECT quantity as product_count FROM distributor_products 
                        where distributor_id='".$session_details['user_id']."' and product_id='$product_id'");
      $update_item_data['quantity']=$products_details[0]->product_count-$quantity;
      $update_item_data['available_quantity']=$products_details[0]->product_count-$quantity;
      DB::table('distributor_products')->where(array('product_id'=>$product_id, 'distributor_id'=>$session_details['user_id']))->update($update_item_data);
    }
    echo 'success'; die;
  }

  public function dispatchedProductsList(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $session_details = session()->get('LoginUserSession');
      $data['distributor_products'] = DB::select("select dp.product_id,p.product_name,p.no_of_items, p.product_image, dp.quantity, 
                          dp.created_date, pt.first_name,pt.last_name from partner_products_log dp 
                          inner join products p on p.product_id=dp.product_id 
                          inner join partners pt on pt.partner_id=dp.partner_id
                          where dp.assigned_by='".$session_details['loginid']."'");
      return view("reports/dispatchedProductsList")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function hubsList(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['hubsList'] = DB::select("select * from hubs where is_delete=0 order by hub_id desc");
      return view("reports/hubsList")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function addNewHub(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      return view("reports/addNewHub");
    } else {
      return Redirect::to('admin');
    }
  }

  public function saveHub(Request $request){
    $input = $request->all();
    $hub_id = $input['hub_id'];
    $hub_title = $input['hub_title'];
    $hub_address = $input['hub_address'];
    $pincode = $input['pincode'];
    $latitude = $input['latitude'];
    $longitude = $input['longitude'];

    $data['hub_title']=$hub_title;
    $data['hub_address']=$hub_address;
    $data['pincode']=$pincode;
    $data['latitude']=$latitude;
    $data['longitude']=$longitude;
    $data['pincode']=$pincode;
    $data['created_date']=date('Y-m-d H:i:s');
    if($hub_id==''){
      $checkeexists = DB::select("select unique_id from hubs where is_delete=0 and hub_title='".$hub_title."'");
      if(isset($checkeexists[0])){
        echo 'exist'; die;
      }
      $data['status']=1;
      $new_hub_id = DB::table('hubs')->insertGetId($data);
      if($new_hub_id>9){
        $unique_id='EZHUB'.$new_hub_id;
      } else {
        $unique_id='EZHUB0'.$new_hub_id;
      }
      DB::table('hubs')->where(array('hub_id'=>$new_hub_id))->update(array('unique_id'=>$unique_id));
    } else {
      $checkeexists = DB::select("select unique_id from hubs where is_delete=0 and hub_title='".$hub_title."' and hub_id!='".$hub_id."'");
      if(isset($checkeexists[0])){
        echo 'exist'; die;
      }
      DB::table('hubs')->where(array('hub_id'=>$hub_id))->update($data);
    }
    echo 'Inserted';
  }

  public function editHub(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $hub_id = $input['hub_id'];
      $hub_details = DB::select("select * from hubs where hub_id='".$hub_id."'");
      $data['hubsList'] = $hub_details[0];
      return view("reports/editHub")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function deleteHub(Request $request){
    $input = $request->all();
    $hub_id = $input['hub_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('hubs')->where(array('hub_id'=>$hub_id))->update($data);
    echo 'updated';
  }

  public function adminsList(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $hub_details = DB::select("select loginid, first_name, last_name, phone_number, email,status from login where user_id=0 and role_id=1");
      $data['adminsList'] = $hub_details;
      return view("reports/adminsList")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function deleteAdmin(Request $request){
    $input = $request->all();
    $loginid = $input['loginid'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('login')->where(array('loginid'=>$loginid))->update($data);
    echo 'updated';
  }

  public function saveAdmin(Request $request){
    $input = $request->all();
    $loginid = $input['loginid'];
    $first_name = $input['first_name'];
    $last_name = $input['last_name'];
    $phone_number = $input['phone_number'];
    $email = $input['email'];
    //$data['username']=$phone_number;
    //$data['password']='MkNOZmpyV3ExcGxkSUhGcFlGbTRpZz09';
    $data['role_id']='1';
    $data['display_name']=$first_name.' '.$last_name;
    $data['user_id']='0';
    $data['first_name']=$first_name;
    $data['last_name']=$last_name;
    $data['phone_number']=$phone_number;
    $data['email']=$email;
    if($loginid==''){
      $data['status']='1';
      $new_id = DB::table('login')->insertGetId($data);
    } else {
      DB::table('login')->where(array('loginid'=>$loginid))->update($data);
    }
    echo 'Inserted';
  }

  public function configurations(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $hub_details = DB::select("SELECT * FROM config_data");
      $data['payment_modes'] = DB::select("SELECT * FROM payment_modes order by payment_modes_id");
      $data['configurations'] = $hub_details[0];
      return view("reports/configurations")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function saveConfigurations(Request $request){
    $input = $request->all();
    $data['welcome_bonus_points'] = $input['welcome_bonus_points'];
    $data['service_bonus_points'] = $input['service_bonus_points'];
    $data['referral_join_bonus'] = $input['referral_join_bonus'];
    $data['customer_referral_bonus_points'] = $input['customer_referral_bonus_points'];
    $data['hub_coverage_radius'] = $input['hub_coverage_radius'];
    $data['customer_email'] = $input['customer_email'];
    $data['customer_phone'] = $input['customer_phone'];   
    DB::table('config_data')->update($data);
    //update payment numbers
    $paydata1['number'] = $input['google_pay'];
    DB::table('payment_modes')->where('payment_modes_id',2)->update($paydata1);

    $paydata2['number'] = $input['phone_pe'];
    DB::table('payment_modes')->where('payment_modes_id',3)->update($paydata2);

    $paydata3['number'] = $input['paytm_number'];
    DB::table('payment_modes')->where('payment_modes_id',4)->update($paydata3);
    echo 'success';
  }

  public function partnerPoints(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $partner_id = $input['partner_id'];
      $data['partner_id'] = $partner_id;
      $data['full_name'] = $input['full_name'];
      $data['partner_points'] = DB::select("SELECT * FROM partner_points_history where partner_id='".$partner_id."' order by part_history_id desc");
      return view("reports/partnerPoints")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function savePoints(Request $request){
    $input = $request->all();
    //update partner points
    $getpartner_points = DB::select("select total_bonus_points,total_paid_points from partners where partner_id='".$input['partner_id']."'");
    if(count($getpartner_points)>0 && isset($getpartner_points[0])){
      if($input['type']=='paid'){
        $update_data['total_paid_points'] = (int)$getpartner_points[0]->total_paid_points+$input['points'];
        $total_points = $getpartner_points[0]->total_paid_points+$input['points'];
      } else {
        $update_data['total_bonus_points'] = (int)$getpartner_points[0]->total_bonus_points+$input['points'];
        $total_points = $getpartner_points[0]->total_bonus_points+$input['points'];
      }
      DB::table('partners')->where('partner_id',$input['partner_id'])->update($update_data);
    }
    //insert points history
    $insert_data['partner_id'] = $input['partner_id'];
    $insert_data['points'] = $input['points'];
    $insert_data['total_points'] = $total_points;
    $insert_data['type'] = $input['type'];
    $insert_data['amount'] = isset($input['amount'])?$input['amount']:NULL;
    $insert_data['credit_type'] = 'credit';
    $insert_data['created_date'] = date('Y-m-d H:i:s');
    DB::table('partner_points_history')->insert($insert_data);
    echo 'success';
  }

  public function customerOrders(Request $request){
    $input = $request->all();
    $status = isset($input['status'])?$input['status']:'';
    $data['status'] = $status;
    $cond_str = "where p.dispatched_status='0'";
    if($status!='' || (isset($input['status']) && $input['status']=='pending')){
      if($input['status']=='pending'){
        $status = 0;
      } else {
        $status = $input['status'];
      }
      $cond_str = "where p.dispatched_status='$status'";
    }
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['users']=DB::select("select p.customer_cart_payments_id,p.user_id,p.order_id,p.total_products,p.total_amount,pm.payment_modes,p.payment_receipt_attachment,
                                date(p.created_date) as orderdate,concat(pr.first_name,' ',pr.last_name) as customername,mn.mobile_number,p.dispatched_status
                                from customer_cart_payments p 
                                left join payment_modes pm on p.payment_mode_id=pm.payment_modes_id 
                                inner join app_users pr on pr.user_id=p.user_id 
                                left join mobile_numbers mn on mn.mobile_number_id=pr.mobile 
                                $cond_str group by p.customer_cart_payments_id order by p.customer_cart_payments_id desc");
      return view("reports/customerOrders")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function viewCustOrderProducts(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $order_id = $input['order_id'];
      $data['users']=DB::select("select product_name,pr.unique_id,product_description,pr.product_image,p.no_of_items,
      date(p.created_date) as orderdate from customer_carts p 
      inner join products pr on p.product_id=pr.product_id where p.status=1 and p.order_id='$order_id'");
      return view("reports/viewCustOrderProducts")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function changePassword(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['role_id'] = $session_details['role_id'];
      return view("reports/changePassword")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function saveChangePassword(Request $request){
    $session_details = session()->get('LoginUserSession');
    $username = $session_details['username'];
    $input = $request->all();
    $current_password = $input['current_password'];
    $new_password = $input['new_password'];
    $confirm_password = $input['confirm_password'];
    $encpassword = EncDecHelper::enc_string($current_password);
    $checkUserLogin = DB::select("select loginid from login where username='".$username."' and password='".$encpassword."' and status=1");
    if(count($checkUserLogin)>0){
      $new_endpassword = EncDecHelper::enc_string($new_password);
      $update_data['password'] = $new_endpassword;
      $update_data['is_password_update'] = 1;
      DB::table('login')->where('username',$username)->update($update_data);
      echo 'success'; die;
    } else {
      echo 'fail'; die;
    }
  }

  public function getproductcountdiv(Request $request){
    $input = $request->all();
    $number_products_required = $input['number_products_required'];
    $products_list=DB::select("select product_id, product_name, unique_id from products where status=1");
    $divstr='';
    for($i=1;$i<=$number_products_required;$i++){
      $divstr .= '<div class="form-group row">
                    <div class="col-sm-3">
                      <label>Select Details : <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-sm-3">
                      <select name="product_id[]" id="product_id-'.$i.'" class="form-control">   
                          <option value="">-Select Product-</option>';
                          foreach($products_list as $products_li){
                            $divstr .= '<option value="'.$products_li->product_id.'">'.$products_li->unique_id.' - '.$products_li->product_name.'</option>';
                          }
                  $divstr .= ' </select>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="no_of_times_usable[]" id="no_of_times_usable-'.$i.'" class="form-control" placeholder="No of times usable">   
                    </div>
                </div>';
    }
    echo $divstr; die;
  }

  public function viewService(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $service_id = $input['service_id'];
      $data['types']=DB::select("select * from types where status=1");
      $data['products_list']=DB::select("select product_id, product_name from products where status=1");
      $service_details = DB::select("select s.*,t.type,c.category_id,c.category_name from services s                       
                          inner join categories c on c.category_id=s.category_id 
                          inner join types t on t.type_id=c.type_id
                          where s.service_id='".$service_id."'");
      $data['categories']=DB::select("select * from categories where type_id='".$service_details[0]->type_id."'");
      $getservicecategory = DB::select("select service_category_id from service_categories where service_id='".$service_id."' 
                                  and category_id='".$service_details[0]->category_id."'");
      $data['service_category_products']=DB::select("select scp.*, p.product_name from service_category_products scp
                                                      inner join products p on p.product_id=scp.product_id
                                                  where scp.service_category_id='".$getservicecategory[0]->service_category_id."'");
      $data['service_details']=$service_details[0];
      return view("reports/view_service_details")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }
  
  public function privacypolicy(Request $request){
    $input = $request->all();
    $data['name'] = "";
     return view("privacypolicy")->with($data);
  }
  
  public function appointmentReports(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $interval = isset($input['interval'])?$input['interval']:'';
      $f_date = isset($input['from_date'])?$input['from_date']:'';
      $t_date = isset($input['to_date'])?$input['to_date']:'';
      $status = isset($input['status'])?$input['status']:'';
      $data['interval'] = $interval;
      $data['f_date'] = $f_date;
      $data['t_date'] = $t_date;
      $data['status'] = $status;
      $from_date = '';
      $to_date = '';
      if($interval!='' || (isset($input['interval']) && $input['interval']=='today')){
        if($input['interval']=='today'){
          $interval_val=0;
        } else {
          $interval_val=$interval;
        }
        $from_date=date('Y-m-d', strtotime('-'.$interval_val.' days'));
        $to_date=date('Y-m-d');
      } else {
        if($f_date!=''){
          $from_date = date('Y-m-d', strtotime($f_date));
        } else {
          $from_date = '';
        }
        if($t_date!=''){
          $to_date = date('Y-m-d', strtotime($t_date));
        } else {
          $to_date = '';
        }
      }
      $cond_str = '';
      if($from_date!='' && $to_date!=''){
        $cond_str = "where DATE(a.appointment_date)>='".$from_date."' and DATE(a.appointment_date)<='".$to_date."'";
        if($status!=''){
          $cond_str .= " and a.status='".$status."'";
        }
      } else if($from_date=='' && $to_date=='' && $status!=''){
        $cond_str .= "where a.status='".$status."'";
      }
      $data['appointmenets_list']=DB::select("SELECT a.appointment_id,a.appointment_date,a.actual_amount, a.discount_percent,a.discount_amount, 
                                              ts.label, a.status, au.first_name as cust_fname,au.last_name as cust_lname,au.user_id,au.email,prt.first_name,
                                              prt.last_name,prt.unique_id,a.created_date,a.bonus_points,a.otp,ad.doorno, 
                                              ad.street, ad.area,ad.city,ad.state,a.type as appoint_type,a.vendor_id,
                                              mn.mobile_number as cust_mobile,a.start_time,a.end_time FROM appointments a
                                              inner join appointment_details ad on ad.appointment_id=a.appointment_id
                                              inner join app_users au on au.user_id=a.user_id
                                              inner join mobile_numbers mn on mn.mobile_number_id=au.mobile
                                              inner join time_slots ts on ts.slot_id=a.appointment_slot_id
                                              left join (select partner_id, first_name, last_name,unique_id from partners) as prt on prt.partner_id=a.vendor_id
                                              $cond_str order by a.appointment_id desc");
      $data['partners_list'] = DB::select("select partner_id, first_name, last_name, unique_id from partners 
      where status=1 and is_delete=0 order by partner_id");
      return view("reports/appointmentReports")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function userReports(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $interval = isset($input['interval'])?$input['interval']:'';
      $f_date = isset($input['from_date'])?$input['from_date']:'';
      $t_date = isset($input['to_date'])?$input['to_date']:'';
      $data['interval'] = $interval;
      $data['f_date'] = $f_date;
      $data['t_date'] = $t_date;
      $from_date = '';
      $to_date = '';
      if($interval!='' || (isset($input['interval']) && $input['interval']=='today')){
        if($input['interval']=='today'){
          $interval_val=0;
        } else {
          $interval_val=$interval;
        }
        $from_date=date('Y-m-d', strtotime('-'.$interval_val.' days'));
        $to_date=date('Y-m-d');
      } else {
        if($f_date!=''){
          $from_date = date('Y-m-d', strtotime($f_date));
        } else {
          $from_date = '';
        }
        if($t_date!=''){
          $to_date = date('Y-m-d', strtotime($t_date));
        } else {
          $to_date = '';
        }
      }
      $cond_str = '';
      if($from_date!='' && $to_date!=''){
        $cond_str = "where DATE(u.registered_date)>='".$from_date."' and DATE(u.registered_date)<='".$to_date."'";
      }
      $data['users_list']=DB::select("SELECT u.user_id, u.first_name, u.last_name, u.email, mn.mobile_number, u.gender,u.address,
                                          u.registered_date, u.status, u.redeem_points,u.total_points FROM app_users u 
                                          inner join mobile_numbers mn on mn.mobile_number_id=u.mobile 
                                          $cond_str order by u.registered_date desc");
      return view("reports/userReports")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function partnerReports(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $interval = isset($input['interval'])?$input['interval']:'';
      $f_date = isset($input['from_date'])?$input['from_date']:'';
      $t_date = isset($input['to_date'])?$input['to_date']:'';
      $data['interval'] = $interval;
      $data['f_date'] = $f_date;
      $data['t_date'] = $t_date;
      $from_date = '';
      $to_date = '';
      if($interval!='' || (isset($input['interval']) && $input['interval']=='today')){
        if($input['interval']=='today'){
          $interval_val=0;
        } else {
          $interval_val=$interval;
        }
        $from_date=date('Y-m-d', strtotime('-'.$interval_val.' days'));
        $to_date=date('Y-m-d');
      } else {
        if($f_date!=''){
          $from_date = date('Y-m-d', strtotime($f_date));
        } else {
          $from_date = '';
        }
        if($t_date!=''){
          $to_date = date('Y-m-d', strtotime($t_date));
        } else {
          $to_date = '';
        }
      }
      $cond_str = 'where p.status=1';
      if($from_date!='' && $to_date!=''){
        $cond_str = "where p.status=1 and DATE(p.created_date)>='".$from_date."' and DATE(p.created_date)<='".$to_date."'";
      }
      $data['users']=DB::select("SELECT p.*, hubnames FROM partners p
                        inner join (SELECT partner_id,group_concat(hub_title) as hubnames from partner_hubs ph 
                        left join  hubs h on h.hub_id=ph.hub_id group by partner_id) as hb on hb.partner_id=p.partner_id 
                        $cond_str order by p.partner_id desc");
      return view("reports/partnerReports")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function distributorReports(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $interval = isset($input['interval'])?$input['interval']:'';
      $f_date = isset($input['from_date'])?$input['from_date']:'';
      $t_date = isset($input['to_date'])?$input['to_date']:'';
      $data['interval'] = $interval;
      $data['f_date'] = $f_date;
      $data['t_date'] = $t_date;
      $from_date = '';
      $to_date = '';
      if($interval!='' || (isset($input['interval']) && $input['interval']=='today')){
        if($input['interval']=='today'){
          $interval_val=0;
        } else {
          $interval_val=$interval;
        }
        $from_date=date('Y-m-d', strtotime('-'.$interval_val.' days'));
        $to_date=date('Y-m-d');
      } else {
        if($f_date!=''){
          $from_date = date('Y-m-d', strtotime($f_date));
        } else {
          $from_date = '';
        }
        if($t_date!=''){
          $to_date = date('Y-m-d', strtotime($t_date));
        } else {
          $to_date = '';
        }
      }
      $cond_str = '';
      if($from_date!='' && $to_date!=''){
        $cond_str = "where DATE(p.created_date)>='".$from_date."' and DATE(p.created_date)<='".$to_date."'";
      }
      $data['users_list']=DB::select("SELECT p.*, hubnames FROM distirbutors p
                          left join (SELECT distributor_id,group_concat(hub_title) as hubnames from distributor_hubs ph 
                          left join  hubs h on h.hub_id=ph.hub_id group by distributor_id) as hb on hb.distributor_id=p.distirbutor_id 
                          $cond_str order by p.distirbutor_id desc");
      return view("reports/distributorReports")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function changePartnerOrderStatus(Request $request){
    $session_details = session()->get('LoginUserSession');
    $input = $request->all();
    $order_id = $input['order_id'];
    $order_status = $input['order_status'];
    $partner_cart_payments_id = $input['partner_cart_payments_id'];
    $dispatched_date = $input['dispatched_date'];
    $get_order_products = DB::select("SELECT partner_id,product_id, no_of_items FROM partner_carts where order_id='$order_id'");
    if($order_status==1){
      foreach($get_order_products as $get_order_prod){
        $check_partner_prod = DB::select("select * from partner_products where partner_id='".$get_order_prod->partner_id."' and product_id='".$get_order_prod->product_id."'");
        $products_details = DB::select("select product_usage_count from products where product_id='$get_order_prod->product_id'");
        if(count($check_partner_prod)==0){
          $partner_id = $get_order_prod->partner_id;
          $product_id = $get_order_prod->product_id;
          $quantity = $get_order_prod->no_of_items;
          //save partner products
          $dis_products_data['partner_id'] = $partner_id;
          $dis_products_data['product_id'] = $product_id;
          $dis_products_data['quantity'] = $quantity;
          $dis_products_data['status'] = '1';
          $dis_products_data['dispatched_date'] = $dispatched_date;
          $dis_products_data['services_count'] = $quantity*$products_details[0]->product_usage_count;
          $dis_products_data['product_percentage'] = $quantity*100;
          $dis_products_data['assigned_by'] = $session_details['loginid'];
          $dis_products_data['created_date'] = date('Y-m-d H:i:s');
          DB::table('partner_products')->insert($dis_products_data);
        } else {
          $updatedisprocount['quantity'] = $check_partner_prod[0]->quantity+$quantity;
          $dis_products_data['product_percentage'] = ($check_partner_prod[0]->quantity+$quantity)*100;
          $updatedisprocount['services_count'] = $check_partner_prod[0]->services_count+($quantity*$products_details[0]->product_usage_count);
          DB::table('partner_products')->where('partner_product_id',$check_partner_prod[0]->partner_product_id)->update($updatedisprocount);
        }
      }
    }
    $update_data['dispatched_status'] = $order_status;
    DB::table('partner_cart_payments')->where('partner_cart_payments_id',$partner_cart_payments_id)->update($update_data);
    echo 'success';
  }

  public function changeCustomerOrderStatus(Request $request){
    $input = $request->all();
    $order_id = $input['order_id'];
    $order_status = $input['order_status'];
    $partner_cart_payments_id = $input['partner_cart_payments_id'];
    $dispatched_date = $input['dispatched_date'];
    $update_data['dispatched_status'] = $order_status;
    $update_data['dispatched_date'] = $dispatched_date;
    DB::table('customer_cart_payments')->where('order_id',$order_id)->update($update_data);
    if($order_status=='2'){
      $get_transaction_details = DB::table('customer_payment_transactions')->select("id","transaction_number","amount")
                              ->where('order_id',$order_id)->where('status','success')->first();
      if(isset($get_transaction_details) && $get_transaction_details->transaction_number!=''){
        //call razor pay refund api
        $paymentId = $get_transaction_details->transaction_number;
        $api_key = Config::get('constants.options.api_key');
        $api_secret = Config::get('constants.options.api_secret');
        $api = new Api($api_key, $api_secret);
        $api->payment->fetch($paymentId)->refund(array(
                                                        "amount"=> $get_transaction_details->amount*100, 
                                                        "speed"=>"normal", 
                                                        "notes"=>array(
                                                                  "reason"=>"Refund to customer as order has been cancelled" 
                                                                ), 
                                                        "receipt"=>"Receipt No. ".$get_transaction_details->transaction_number));
      }
      $get_order_points = DB::select("select sum(total_points) as sum_points, user_id from customer_carts where status=1 and order_id='$order_id'");
      if(isset($get_order_points[0]) && $get_order_points[0]->sum_points>0){
        $user_id = $get_order_points[0]->user_id;
        $getUserDetails = DB::select("SELECT user_id,redeem_points,total_points FROM app_users where user_id='".$user_id."'");
        //update user points
        $update_points_data['total_points'] = (int)$getUserDetails[0]->total_points+(int)$get_order_points[0]->sum_points;
        $update_points = DB::table('app_users')->where('user_id',$user_id)->update($update_points_data);
        //insert history record
        $points_data['customer_user_id'] = $user_id;
        $points_data['points'] = $get_order_points[0]->sum_points;
        $points_data['type'] = 'purchase-refund';
        $points_data['created_date'] = date('Y-m-d H:i:s');
        $points_data['available_points'] = (int)$getUserDetails[0]->total_points+(int)$get_order_points[0]->sum_points;
        $points_data['credit_type'] = 'credit';
        $insert_user_points = DB::table('customer_points_history')->insertGetId($points_data);
      }
      //update transactions table
      $transaction_data['status'] = 'refunded';
      $update_transaction_data = DB::table('customer_payment_transactions')->where('order_id',$order_id)->update($transaction_data);
    }
    echo 'success';
  }

  public function sanitize_output($buffer) {
      $search = array(
          '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
          '/[^\S ]+\</s',     // strip whitespaces before tags, except space
          '/(\s)+/s',         // shorten multiple whitespace sequences
          '/<!--(.|\s)*?-->/' // Remove HTML comments
      );
      $replace = array(
          '>',
          '<',
          '\\1',
          ''
      );
      $buffer = preg_replace($search, $replace, $buffer);
      return $buffer;
  }

  public function adminEditProfile(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['admin_details']=DB::select("SELECT loginid,first_name,last_name,role_id,phone_number,email,profile_picture FROM login 
                                        where loginid='".$session_details['loginid']."'");
      return view("reports/adminEditProfile")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function updateAdminProfile(Request $request){
    $input = $request->all();
    $loginid = $input['loginid'];
    $first_name = $input['first_name'];
    $last_name = $input['last_name'];
    $phone_number = $input['phone_number'];
    $email = $input['email'];
    $data['first_name'] = $first_name;
    $data['last_name'] = $last_name;
    $data['phone_number'] = $phone_number;
    $data['email'] = $email;
    $data['display_name'] = $first_name.' '.$last_name;
    $file_doc_name='';
    $file_doc_path = public_path().'/images/userimages';
    $session_details = session()->get('LoginUserSession');
    $UserSessionData = array(
      'user_id'=>$session_details['user_id'],
      'loginid'=>$session_details['loginid'],
      'username'=>$session_details['username'],
      'role_id'=>$session_details['role_id'],
      'profile_picture' => $session_details['profile_picture'],
      'display_name'=>$first_name.' '.$last_name
    );
    if($request->hasfile('profile_picture')){
        $extension = $request->file('profile_picture')->extension();
        $mime_type = $request->file('profile_picture')->getMimeType();
        $file_doc_name = 'userimages/admin'.'-'.time().'.'.$extension;
        $dep_file_upload = $request->profile_picture->move($file_doc_path, $file_doc_name);
        $data['profile_picture']=$file_doc_name;
        $UserSessionData = array(
          'user_id'=>$session_details['user_id'],
          'loginid'=>$session_details['loginid'],
          'username'=>$session_details['username'],
          'role_id'=>$session_details['role_id'],
          'profile_picture' => $file_doc_name,
          'display_name'=>$first_name.' '.$last_name
        );
    }
    session()->put('LoginUserSession', $UserSessionData);
    DB::table('login')->where(array('loginid'=>$loginid))->update($data);
    echo 'Inserted';
  }

  public function servicesFeedback(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['admin_details']=DB::select("SELECT f.feedback_id,f.rating,f.appointment_id, f.feedback, f.created_date, p.unique_id,
                                          p.first_name,p.last_name, f.status,p.partner_id, au.first_name as cust_fname, 
                                          au.last_name as cust_lname FROM feedback f
                                          inner join appointments a on a.appointment_id=f.appointment_id
                                          inner join partners p on p.partner_id=a.vendor_id
                                          inner join app_users au on au.user_id=a.user_id");
      return view("reports/servicesFeedback")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function deleteFeedback(Request $request){
    $input = $request->all();
    $feedback_id = $input['feedback_id'];
    // $data=array(
    //   "status"=>0
    // );
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('feedback')->where(array('feedback_id'=>$feedback_id))->update($data);
    echo 'updated';
  }

  public function paymentTransactions(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $interval = isset($input['interval'])?$input['interval']:'';
      $f_date = isset($input['from_date'])?$input['from_date']:'';
      $t_date = isset($input['to_date'])?$input['to_date']:'';
      $data['interval'] = $interval;
      $data['f_date'] = $f_date;
      $data['t_date'] = $t_date;
      $from_date = '';
      $to_date = '';
      if($interval!=''){
        $from_date=date('Y-m-d', strtotime('-'.$interval.' days'));
        $to_date=date('Y-m-d');
      } else {
        if($f_date!=''){
          $from_date = date('Y-m-d', strtotime($f_date));
        } else {
          $from_date = '';
        }
        if($t_date!=''){
          $to_date = date('Y-m-d', strtotime($t_date));
        } else {
          $to_date = '';
        }
      }
      $cond_str = '';
      if($from_date!='' && $to_date!=''){
        $cond_str = "where transaction_datetime>='".$from_date."' and transaction_datetime<='".$to_date."'";
      }
      $data['users_list']=DB::select("select * from (
                          SELECT cpt.user_id, au.first_name,au.last_name,'' as unique_id, amount, transaction_number, 
                          order_id,transaction_datetime, cpt.status FROM customer_payment_transactions cpt
                          inner join app_users au on au.user_id=cpt.user_id where cpt.transaction_number is not null and cpt.status='success'
                          UNION
                          SELECT ppt.user_id, p.first_name,p.last_name,p.unique_id as unique_id, amount, transaction_number, 
                          order_id,transaction_datetime, ppt.status FROM partner_payment_transactions ppt
                          inner join partners p on p.partner_id=ppt.user_id where ppt.transaction_number is not null and ppt.status='success') as tab $cond_str 
                          order by transaction_datetime desc");
      return view("reports/paymentTransactions")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function manageBanners(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['admin_details']=DB::select("SELECT * FROM banners order by id desc");
      return view("reports/manageBanners")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function addNewBanner(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      return view("reports/addNewBanner");
    } else {
      return Redirect::to('admin');
    }
  }

  public function saveBanner(Request $request){
    $input = $request->all();
    $data['id'] = $input['banner_id'];
    $data['type'] = $input['type'];
    $data['sequence'] = $input['sequence'];
    $data['created_date'] = date('Y-m-d H:i:s');
    $propic_name='';
    $propic = public_path().'/assets/images/banners';
    if($request->hasfile('profile_picture')){
      
        $extension = $request->file('profile_picture')->extension();
        $mime_type = $request->file('profile_picture')->getMimeType();
        $file_name = 'banner'.'-'.time().'.'.$extension;
        $propic_name = '/assets/images/banners/'.$file_name;
        $dep_file_upload = $request->profile_picture->move($propic, $propic_name);
        $data['banner_image_path']=$file_name;
    }
    //$data['hub_id']=$hub_id;
    if($input['banner_id']==''){
      $data['status']=1;
      DB::table('banners')->insertGetId($data);
    } else {
      DB::table('banners')->where(array('id'=>$input['banner_id']))->update($data);
    }
    echo 'Inserted';
  }

  public function editBanner(Request $request){
    $input = $request->all();
    $banner_id = $input['banner_id'];
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['admin_details']=DB::select("SELECT * FROM banners where id='".$banner_id."'");
      return view("reports/editBanner")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function deleteBanner(Request $request){
    $input = $request->all();
    $banner_id = $input['banner_id'];
    // $data=array(
    //   "status"=>0
    // );
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('banners')->where(array('id'=>$banner_id))->update($data);
    echo 'updated';
  }

  public function delete_item(Request $request){
    $input = $request->all();
    $id = $input['id'];
    $table = $input['table'];
    $primary_key = $input['primary_key'];
    
    $data=array(
      "is_delete"=>1,
      "status"=>0
    );
    DB::table($table)->where(array($primary_key=>$id))->update($data);
    echo 'updated';
  }

  public function saveCustomerPoints(Request $request){
    $input = $request->all();
    $type_id = $input['type_id'];
    $user_id = $input['user_id'];
    $points = $input['points'];
    $getUserDetails = DB::select("SELECT user_id,redeem_points,total_points FROM app_users where user_id='".$user_id."'");
    if($type_id=='add'){
      //update user points
      $update_points_data['total_points'] = (int)$getUserDetails[0]->total_points+(int)$points;
      $update_points = DB::table('app_users')->where('user_id',$user_id)->update($update_points_data);
      //insert history record
      $points_data['customer_user_id'] = $user_id;
      $points_data['points'] = $points;
      $points_data['type'] = 'bonus-admin';
      $points_data['created_date'] = date('Y-m-d H:i:s');
      $points_data['available_points'] = (int)$getUserDetails[0]->total_points+(int)$points;
      $points_data['credit_type'] = 'credit';
      $insert_user_points = DB::table('customer_points_history')->insertGetId($points_data);
    } else {
      //update user points
      $update_points_data['total_points'] = (int)$getUserDetails[0]->total_points-(int)$points;
      $update_points = DB::table('app_users')->where('user_id',$user_id)->update($update_points_data);
      //insert history record
      $points_data['customer_user_id'] = $user_id;
      $points_data['points'] = $points;
      $points_data['type'] = 'bonus-admin';
      $points_data['created_date'] = date('Y-m-d H:i:s');
      $points_data['available_points'] = (int)$getUserDetails[0]->total_points-(int)$points;
      $points_data['credit_type'] = 'debit';
      $insert_user_points = DB::table('customer_points_history')->insertGetId($points_data);
    }
    echo 'success';
  }

  public function deleteRegUser(Request $request){
    $input = $request->all();
    $user_id = $input['user_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('app_users')->where(array('user_id'=>$user_id))->update($data);
    echo 'updated';
  }

  public function sendpartnerpushnotifications(){
     //update config
     $update_config_data['city_name'] = date('Y-m-d H:i:s');
     DB::table('city')->where(array('city_id'=>1))->update($update_config_data);
    $currentdatetime = date('Y-m-d H:i:s');
    $pending_appointments = DB::select("select appointment_id, latitude, longitude, created_date,TIMESTAMPDIFF(MINUTE,created_date,'".$currentdatetime."') as diff_in_minutes from appointments 
    where status='pending' and TIMESTAMPDIFF(MINUTE,created_date,'".$currentdatetime."') < 75");
    foreach($pending_appointments as $pending_appointment){
      $appointment_details_id = $pending_appointment->appointment_id;
      $latitude = $pending_appointment->latitude;
      $longitude = $pending_appointment->longitude;
      $app_type = 'direct';
      //$appointment_id = '';
      //$services_list = DB::select("select fcm_token_id from partners where fcm_token_id is not null");
      //if($app_type=='direct'){
        $config_data = DB::Table("config_data")->select("hub_coverage_radius")->first();
        $distance = $config_data->hub_coverage_radius;
        $services_list = DB::select("select ph.partner_id,p.fcm_token_id, p.first_name, p.last_name from partner_hubs ph
                      inner join partners p on p.partner_id=ph.partner_id
                      where p.partner_id not in (select partner_id from appointment_rejected_partners where appointment_id='$appointment_details_id') 
                      and ph.hub_id in (
                      select hub_id from ( 
                      SELECT hub_id , (3956 * 2 * ASIN(SQRT( POWER(SIN(( ".$latitude." - latitude) *  pi()/180 / 2), 2) 
                      +COS( ".$latitude." * pi()/180) * COS(latitude * pi()/180) * POWER(SIN(( ".$longitude." - longitude) * pi()/180 / 2), 2) ))) as distance  
                      from hubs  
                      having  distance <= '$distance'
                      order by distance) as tab) group by partner_id");
      // } else {
      // 	$services_list = DB::select("select fcm_token_id, p.partner_id from appointments a 
      // 								inner join partners p on p.partner_id=a.vendor_id 
      // 								where a.appointment_id='".$appointment_id."' and fcm_token_id is not null");
      // }
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
    echo 'Notification sent to partner successfully';	
	}

  public function decrypt_text(Request $request){
    $input = $request->all();
    $enctext = $input['enctext'];
    $dectext = EncDecHelper::dec_string($enctext);
    echo $dectext;
  }

  public function distributorProductsLog(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['products']=DB::select("SELECT d.distirbutor_id,d.first_name, d.last_name, d.unique_id, dpl.quantity,dp.dispatched_date, 
                                    dpl.created_date, p.product_name, p.unique_id as pro_unique_id FROM distributor_products_log dpl
                                    inner join distirbutors d on d.distirbutor_id=dpl.distributor_id
                                    inner join products p on p.product_id=dpl.product_id
                                    inner join distributor_products dp on dp.created_date=dpl.created_date");
      return view("reports/distributorProductsLog")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function partnerProductsLog(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['products']=DB::select("SELECT d.partner_id,d.first_name, d.last_name, d.unique_id, dpl.quantity, p.product_name, p.unique_id as pro_unique_id,
                                    dpl.created_date, l.display_name as assignedby,r.role_name,pp.dispatched_date FROM partner_products_log dpl
                                    inner join partners d on d.partner_id=dpl.partner_id
                                    inner join products p on p.product_id=dpl.product_id
                                    inner join login l on l.loginid=dpl.assigned_by
                                    inner join roles r on r.role_id=l.role_id
                                    inner join partner_products pp on pp.created_date=dpl.created_date");
      return view("reports/partnerProductsLog")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function sendpaidbonusnotifications(){
    $getbonusposints = DB::select("SELECT partner_id,first_name, last_name,total_paid_points, fcm_token_id FROM partners 
                                    where total_paid_points is not null and total_paid_points<10");
    if(count($getbonusposints)>0){
      foreach($getbonusposints as $getbonusposint){
        $notifications_data = array();
        $notifications_data['title'] = "EZGLAM RECHARGE AND GET POINTS";
        $notifications_data['text']  = "Please recharge to get paid points to do the service";	
        $notifications_data['appointment_id']  = '';
        $notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
        $notifications_data['sound']  = 'default';
        //$notifications_data['logo']  = url('/').'/public/assets/images/logo1.png';
                      
        Helper::send_pushnotification($notifications_data,$getbonusposint->fcm_token_id,'vendor');
      }
    }
    echo 'Notifications sent successfully';
  }

  public function autodeductpenaltypoints(){
    $update_config_data['city_name'] = date('Y-m-d H:i:s');
     DB::table('city')->where(array('city_id'=>2))->update($update_config_data);
    $cur_date = date('Y-m-d H:i:s');
    $getdelayedappointments = DB::select("select *,TIMESTAMPDIFF(MINUTE,appointment_datetime,'$cur_date') as dt_diff from (
                                          select a.appointment_id, a.service_id, a.appointment_slot_id, a.vendor_id, a.appointment_date, ts.value,
                                          concat(a.appointment_date,' ',ts.value) as appointment_datetime,
                                          s.penalty_paid_points_redeem, s.penalty_bonus_points_redeem from appointments a
                                          inner join services s on s.service_id=a.service_id
                                          inner join time_slots ts on ts.slot_id=a.appointment_slot_id
                                          where a.status='Approved' and a.vendor_id is not null 
                                          and a.appointment_date='".date('Y-m-d')."' and a.modified_by is null) as tab
                                          where TIMESTAMPDIFF(MINUTE,appointment_datetime,'$cur_date') > 15");
    foreach($getdelayedappointments as $getdelayedappointment){
      $partner_id = $getdelayedappointment->vendor_id;
      $checkbonuspoints = DB::select("select ifnull(total_paid_points,0) as total_paid_points,ifnull(total_bonus_points,0) as total_bonus_points from partners 
															          where partner_id='".$partner_id."'");	

      $update_data['total_paid_points'] = (int)$checkbonuspoints[0]->total_paid_points-$getdelayedappointment->penalty_paid_points_redeem;
      $update_data['total_bonus_points'] = (int)$checkbonuspoints[0]->total_bonus_points-$getdelayedappointment->penalty_bonus_points_redeem;
      DB::table('partners')->where('partner_id',$partner_id)->update($update_data);

      if($getdelayedappointment->penalty_paid_points_redeem>0){
        $insert_data_1['partner_id'] = $partner_id;
        $insert_data_1['points'] = $getdelayedappointment->penalty_paid_points_redeem;
        $insert_data_1['total_points'] = $update_data['total_paid_points'];
        $insert_data_1['type'] = "paid-penalty";
        $insert_data_1['amount'] = NULL;
        $insert_data_1['credit_type'] = 'debit';
        $insert_data_1['created_date'] = date('Y-m-d H:i:s');
        DB::table('partner_points_history')->insert($insert_data_1);
      }

      if($getdelayedappointment->penalty_bonus_points_redeem>0){
        $insert_data_2['partner_id'] = $partner_id;
        $insert_data_2['points'] = $getdelayedappointment->penalty_bonus_points_redeem;
        $insert_data_2['total_points'] = $update_data['total_bonus_points'];
        $insert_data_2['type'] = "bonus-penalty";
        $insert_data_2['amount'] = NULL;
        $insert_data_2['credit_type'] = 'debit';
        $insert_data_2['created_date'] = date('Y-m-d H:i:s');
        DB::table('partner_points_history')->insert($insert_data_2);
      }
      //update appointment status
      $update_appointment['modified_by'] = 1;
      DB::table('appointments')->where('appointment_id',$getdelayedappointment->appointment_id)->update($update_appointment);
    }
    echo 'Penalty points updated successfully';
  }

  public function assignappointment(Request $request){
    $input = $request->all();
    $appointment_id = $input['appointment_id'];
    $partner_id = $input['partner_id'];
    $checkUserLogin = DB::select("select a.service_id,au.fcm_token_id,a.appointment_id,s.product_id,
                                  ifnull(s.paid_points_redeem,0) as paid_points_redeem,ifnull(s.bonus_points_redeem,0) as bonus_points_redeem,
                                  a.appointment_date,a.appointment_slot_id from appointments a 
                                  inner join app_users au on a.user_id=au.user_id 
                                  inner join services s on s.service_id=a.service_id 
                                  where appointment_id='".$appointment_id."' and vendor_id is null");
		if(count($checkUserLogin)>0){
			$checkbonuspoints = DB::select("select ifnull(total_paid_points,0) as total_paid_points,
                                      ifnull(total_bonus_points,0) as total_bonus_points from partners 
                                      where partner_id='".$partner_id."'");		
			if($checkUserLogin[0]->paid_points_redeem<=$checkbonuspoints[0]->total_paid_points){
				
				$total_userpoints = $checkbonuspoints[0]->total_paid_points+$checkbonuspoints[0]->total_bonus_points;
				$total_servicepoints = $checkUserLogin[0]->paid_points_redeem+$checkUserLogin[0]->bonus_points_redeem;
			
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
				
					$checkproducts_count = DB::select("select quantity from partner_products where partner_id='".$partner_id."' and product_id='".$singlecheckserviceproductstatus->product_id."'");
					
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
							if($checkbonuspoints[0]->total_bonus_points>=$checkUserLogin[0]->bonus_points_redeem){
								$paid_deduct_points = $checkUserLogin[0]->paid_points_redeem;
								$bonus_deduct_points = $checkUserLogin[0]->bonus_points_redeem;
							} else {
						
								$deduct_points = $checkUserLogin[0]->bonus_points_redeem-$checkbonuspoints[0]->total_bonus_points;
						
								$paid_deduct_points = $checkUserLogin[0]->paid_points_redeem+$deduct_points;
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

							if($checkbonuspoints[0]->total_bonus_points>=$checkUserLogin[0]->bonus_points_redeem){
								$paid_deduct_points = $checkUserLogin[0]->paid_points_redeem;
								$bonus_deduct_points = $checkUserLogin[0]->bonus_points_redeem;
							} else {
						
								$deduct_points = $checkUserLogin[0]->bonus_points_redeem-$checkbonuspoints[0]->total_bonus_points;
						
								$paid_deduct_points = $checkUserLogin[0]->paid_points_redeem+$deduct_points;
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
              "status"=>"success","recharge_option"=>"0"
            );					
					}else{
						$res_data = array(
							"msg"=>"No Products mapped to this service","status"=>"failed",
							"display_msg"=>"<p> No Products mapped to this service</p>","recharge_option"=>"0");
					}
					//loop completed
				}else{
					$res_data = array(
							"msg"=>"Cannot assign this Service, as partner has already scheduled another service at same slot","status"=>"failed",
							"display_msg"=>"<p> You cannot Accept this Service, you have already scheduled another service at same slot</p>","recharge_option"=>"0"
					);	
					
				}
			}else{
				
				$res_data = array(
				"msg"=>"This partner dont have enough points to serve this service","status"=>"failed","display_msg"=>"<p>Please Recharge your wallet , you don't have enough points to serve this service</p>","recharge_option"=>"1"
				);				
				
			}
			
			}else{
				
				$res_data = array(
				"msg"=>"This partner dont have enough points to serve this service","status"=>"failed","display_msg"=>"<p>Please Recharge your wallet , you don't have enough points to serve this service</p>","recharge_option"=>"1"
				);				
				
			}
			
			
		}else{
			$res_data = array(
				"msg"=>"Sorry, This Service already accepted other partner.","status"=>"failed","recharge_option"=>"0"
				);
			
		}
    echo json_encode($res_data);
  }

  public function get_appointment_details(Request $request){
    $input = $request->all();
    $appointment_id = $input['appointment_id'];
    $appointment_details=DB::select("SELECT a.appointment_id,a.appointment_date,a.actual_amount, a.discount_percent,a.discount_amount, s.service_name, 
                                            ts.label, a.status, au.first_name as cust_fname,au.last_name as cust_lname,au.user_id,au.email,prt.first_name,
                                            prt.last_name,prt.unique_id,a.created_date,a.bonus_points,s.estimated_time,a.otp,ad.doorno, 
                                            ad.street, ad.area,ad.city,ad.state,a.type as appoint_type,tp.type,cat.category_name,
                                            mn.mobile_number as cust_mobile,a.start_time,a.end_time FROM appointments a
                                            inner join appointment_details ad on ad.appointment_id=a.appointment_id
                                            inner join services s on s.service_id=a.service_id
                                            left join types tp on tp.type_id=s.type_id
                                            left join categories cat on cat.category_id=s.category_id
                                            inner join app_users au on au.user_id=a.user_id
                                            inner join mobile_numbers mn on mn.mobile_number_id=au.mobile
                                            inner join time_slots ts on ts.slot_id=a.appointment_slot_id
                                            left join (select partner_id, first_name, last_name,unique_id from partners) as prt on prt.partner_id=a.vendor_id
                                            where a.appointment_id='".$appointment_id."'");
    $full_name = ucwords(strtolower($appointment_details[0]->cust_fname.' '.$appointment_details[0]->cust_lname));
    if($appointment_details[0]->status=='Completed' && $appointment_details[0]->start_time!='' && $appointment_details[0]->end_time!=''){
      $datetime1 = new DateTime($appointment_details[0]->start_time);
      $datetime2 = new DateTime($appointment_details[0]->end_time);
      $interval = $datetime1->diff($datetime2);
      $time_duration = $interval->format('%h').'h '.$interval->format('%i').'m '.$interval->format('%s').'s';
    } else {
        $time_duration = '--';
    }
    $appointment_service_details = DB::select("select appointment_id, asr.service_id, bonus_points, actual_amount, discount_amount, 
                                                discount_percent, s.service_name from appointment_services asr 
                                                inner join services s on s.service_id=asr.service_id
                                                where asr.appointment_id='$appointment_id'");
    $service_det_string = '<table border="1">
    <tr><th>Service</th><th>Bonus Points</th><th>Actual Amount</th><th>Discount Percent</th><th>Discount Amount</th></tr>';
    foreach($appointment_service_details as $appointment_service_det){
      $service_det_string .= '<tr>
                                <td>'.$appointment_service_det->service_name.'</td>
                                <td>'.$appointment_service_det->bonus_points.'</td>
                                <td>'.$appointment_service_det->actual_amount.'</td>
                                <td>'.$appointment_service_det->discount_amount.'</td>
                                <td>'.$appointment_service_det->discount_percent.'</td>
                            </tr>';
    }
    $service_det_string .= '</table>';
    $partner_name = $appointment_details[0]->unique_id!=''?$appointment_details[0]->first_name.' '.$appointment_details[0]->last_name.'('.$appointment_details[0]->unique_id.')':'--';
    $appointment_date = date('d-M-Y', strtotime($appointment_details[0]->appointment_date)).' '.$appointment_details[0]->label;
    $appoint_address = $appointment_details[0]->doorno.','.$appointment_details[0]->street.','.$appointment_details[0]->area.','.$appointment_details[0]->city;
    $detail_str = '<div class="row"><div class="col-sm-4"><strong>Unique ID</strong></div> <div class="col-sm-8">EZAPPOINT'.$appointment_details[0]->appointment_id.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Customer Name</strong></div> <div class="col-sm-8">'.$full_name.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Customer Mobile</strong></div> <div class="col-sm-8">'.$appointment_details[0]->cust_mobile.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Partner</strong></div> <div class="col-sm-8">'.$partner_name.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Service Details</strong></div> <div class="col-sm-8">'.$service_det_string.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Appointment Date</strong></div> <div class="col-sm-8">'.$appointment_date.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Status</strong></div> <div class="col-sm-8">'.$appointment_details[0]->status.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Package Type</strong></div> <div class="col-sm-8">'.$appointment_details[0]->type.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Category</strong></div> <div class="col-sm-8">'.$appointment_details[0]->category_name.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Service Time</strong></div> <div class="col-sm-8">'.$time_duration.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>OTP</strong></div> <div class="col-sm-8">'.$appointment_details[0]->otp.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Appointment Area</strong></div> <div class="col-sm-8">'.$appoint_address.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Appointment Type</strong></div> <div class="col-sm-8">'.$appointment_details[0]->appoint_type.'</div></div>
    <div class="row"><div class="col-sm-4"><strong>Created Date</strong></div> <div class="col-sm-8">'.date('d-M-Y H:i', strtotime($appointment_details[0]->created_date)).'</div></div>
    <div class="row"><div class="col-sm-5"></div><div class="col-sm-2"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></div><div class="col-sm-5"></div></div>';
    echo $detail_str;
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
		
		$status='Started';
		// if(isset($input['status'])){
		// 	$status = $input['status'];
		// }	
		
		$reason='By Admin';
		// if(isset($input['reason'])){
		// 	$reason = $input['reason'];
		// }

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
				
    $checkappointmentotp = DB::select("select otp,status from appointments where appointment_id='".$appointment_id."' and otp='".$otp."'");
    if(isset($checkappointmentotp[0]) && $checkappointmentotp[0]->status=='Approved'){
      $checkserviceproductstatus = DB::select("select sp.product_id,sp.no_of_times_usable,sp.required_percentage,p.product_name from appointments a 
                            inner join services s on s.service_id=a.service_id 
                            inner join service_categories sc on s.service_id=sc.service_id 
                            inner join service_category_products sp on sc.service_category_id=sp.service_category_id 
                            inner join products p on sp.product_id=p.product_id 
                            where a.appointment_id='".$appointment_id."'");
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
                              "status"=>"Success"
                            );				
          
      }else{
          $res_data = array(
            "msg"=>"You cannot start Service as the required products are not available with the partner",
            "status"=>"Failed"
          );
        
      }
    } else {
      $res_data = array(
        "msg"=>"You cannot start Service as this appointment is not in Approved state",
        "status"=>"Failed"
      );
    }
		echo json_encode($res_data);
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
		$checkUserLogin2 = DB::select("select paid_points_redeem,bonus_points_redeem,a.user_id,s.customer_referral_points,
                    au.fcm_token_id,a.bonus_points, a.status from appointments a 
										inner join app_users au on a.user_id=au.user_id 
										inner join services s on s.service_id=a.service_id 
										where appointment_id='".$appointment_id."'");
		if(isset($checkUserLogin2[0]) && $checkUserLogin2[0]->status=='Started'){
      $checkUserLogin3 = DB::select("select total_paid_points,total_bonus_points from partners where partner_id='".$partner_id."'");
      //var_dump($get_user->service_id);
      $insert_data1['appointment_id'] = $appointment_id;	
      $insert_data1['partner_id'] = $partner_id;	
      $insert_data1['status'] = 'Completed';
      $insert_data1['reason'] = '';
      $insert_data1['created_date'] = date('Y-m-d H:i:s');
      DB::table('appointment_logs')->insert($insert_data1);
      //update points in app users
      $getuserpoints = DB::table('app_users')->select("total_points")->where('user_id',$checkUserLogin2[0]->user_id)->first();
      $insert_data6['total_points'] = $getuserpoints->total_points+$checkUserLogin2[0]->bonus_points;	
      DB::table('app_users')->where('user_id',$checkUserLogin2[0]->user_id)->update($insert_data6);
      //insert in transaction
      $insert_data5['customer_user_id'] = $checkUserLogin2[0]->user_id;	
      $insert_data5['points'] = $checkUserLogin2[0]->bonus_points;
      $insert_data5['available_points'] = $getuserpoints->total_points+$checkUserLogin2[0]->bonus_points;
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
    } else {
      $res_data = array(
        "msg"=>"Service cannot be completed as it is not in Started status",
        "status"=>"Failed"
      );
    }
		echo json_encode($res_data);
	}

  public function dump_appointment_details(){
    $checkUserLogin2 = DB::select("select appointment_id, service_id, bonus_points, actual_amount, discount_amount, discount_percent from appointments");
    foreach($checkUserLogin2 as $checkUserLog){
      $partner_points_data['appointment_id'] = $checkUserLog->appointment_id;
      $partner_points_data['service_id'] = $checkUserLog->service_id;
      $partner_points_data['bonus_points'] = $checkUserLog->bonus_points;
      $partner_points_data['actual_amount'] = $checkUserLog->actual_amount;
      $partner_points_data['discount_amount'] = $checkUserLog->discount_amount;
      $partner_points_data['discount_percent'] = $checkUserLog->discount_percent;
      $partner_points_data['status'] = '1';
      $partner_points_data['created_date'] = date('Y-m-d H:i:s');
      $partner_points_data['created_by'] = 1;
      //DB::table('appointment_services')->insert($partner_points_data);
    }
    echo 'Inserted';
  }
}
