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
                                  'profile_picture'=>'',
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
        return Redirect::to('edurxcare_admin?status=error');
      }
    }
    public function adminLogin(Request $request){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        return Redirect::to('admindashboard');
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
        $data['users_count']=DB::select("select count(case when role_id=2 then 1 end) as patient_count,
                                          count(case when role_id=3 then 1 end) as pharmacist_count from app_users");
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

  public function patientslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['users_count']=DB::select("select * from app_users where role_id='2'");
      return view("reports/patientslist")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function pharmacistslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['users_count']=DB::select("select * from app_users where role_id='3'");
      return view("reports/pharmacistslist")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function requestslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['users_count']=DB::select("select * from app_users where role_id='3'");
      return view("reports/pharmacistslist")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function appointmentslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['users_count']=DB::select("select * from app_users where role_id='3'");
      return view("reports/pharmacistslist")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function medicationslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from medicines_master");
      return view("reports/medicationslist")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function allergies(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from allergies");
      return view("reports/allergies")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }

  public function medicalconditions(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from medical_conditions");
      return view("reports/medicalconditions")->with($data);
    } else {
      return Redirect::to('admin');
    }
  }
}
