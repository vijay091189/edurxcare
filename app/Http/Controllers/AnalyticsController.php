<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, URL, Session, Redirect, Config;
use DateTime;
use DateTimeZone;
use App\Helpers\EncDecHelper;
use App\Helpers\Helper as Helper;

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

    

    public function logout()
    {
        Session::flush();
        return redirect('/admin');
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
}
