<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use DB, Config;
use DateTime;
use DateTimeZone;
use App\Helpers\EncDecHelper;
use App\Helpers\Helper as Helper; 

class EduwebController extends Controller
{
    public function homepage(Request $request){
        return view("frontend/homepage");
    }

    public function loginpage(Request $request){
        $input = $request->all();
        if(isset($input['status'])){
            $status = $input['status'];
        } else {
            $status = '';
        }
        $data['error']=$status;
        return view("frontend/loginpage")->with($data);
    }

    public function signup(Request $request){
        return view("frontend/signup");
    }

    public function category(Request $request){
        return view("frontend/category");
    }

    public function signupForm(Request $request){
        $input = $request->all();
        $data['type'] = $input['type'];
        return view("frontend/signup_form")->with($data);
    }

    public function registerUser(Request $request){
        $input = $request->all();
        $reg_type = $input['reg_type'];
        $new_password = $input['new_password'];
        $data['name'] = $input['full_name'];
        $data['gender'] = $input['gender'];
        $data['dob'] = $input['dob'];
        $data['mobile'] = $input['mobile'];
        $data['email'] = $input['email_id'];
        $data['address'] = $input['address'];
        $data['is_deleted'] = 0;
        $data['created_date'] = date('Y-m-d H:i:s');
        if($reg_type=='patient'){
            $data['role_id'] = 2;
            $data['status'] = 'approved';
        } else {
            $data['role_id'] = 3;
            $data['status'] = 'pending';
        }
        $user_id = DB::table('app_users')->insertGetId($data);
        //insert into login  table
        $encpassword = EncDecHelper::enc_string($new_password);
        $login_data['username'] = $input['mobile'];
        $login_data['password'] = $encpassword;
        $login_data['role_id'] = ($reg_type=='patient')?2:3;
        $login_data['display_name'] = $input['full_name'];
        $login_data['user_id'] = $user_id;
        $login_data['status'] = 1;
        DB::table('login')->insert($login_data);
        echo 'inserted';
    }

    public function checkUserLogin(Request $request){
        $input = $request->all();
        $username = $input['username'];
        $userpassword = $input['userpassword'];
        $encpassword = EncDecHelper::enc_string($userpassword);
        $checkUserLogin = DB::select("select l.*, au.* from login l 
                                    inner join app_users au on au.user_id=l.user_id
                                    where l.username='".$username."' and l.password='".$encpassword."' and l.status=1");
        if(count($checkUserLogin)>0){
            $UserSessionData = array(
                                    'user_id'=>$checkUserLogin[0]->user_id,
                                    'loginid'=>$checkUserLogin[0]->loginid,
                                    'username'=>$checkUserLogin[0]->username,
                                    'role_id'=>$checkUserLogin[0]->role_id,
                                    'display_name'=>$checkUserLogin[0]->name
                                  );
            session()->put('LoginUserSession', $UserSessionData);
            echo $checkUserLogin[0]->role_id;
        } else {
            echo 'invalid';
        }
    }

    public function patientDashboard(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $patient_id = $session_details['loginid'];
            $data['patient_requests'] = DB::select("select * from patient_requests where patient_id='$patient_id'");
            return view("dashboard/patient_dashboard")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function newRequest(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            return view("dashboard/new_request");
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function saveNewRequest(Request $request){
        $session_details = session()->get('LoginUserSession');
        $input = $request->all();
        $data['patient_id'] = $session_details['user_id'];
        $data['comments'] = $input['request_comments'];
        $data['status'] = 'pending';
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['modified_date'] = date('Y-m-d H:i:s');
        $vir_request_id = DB::table('virtual_patient_requests')->insertGetId($data);
        echo $vir_request_id;
    }

    public function add_requestmedications(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $input = $request->all();
            $vir_request_id = $input['vir_request_id'];
            $data['vir_request_id'] = $vir_request_id;
            $data['request_medications'] = DB::select("select * from virtual_request_medications where request_medication_id='$vir_request_id'");
            return view("dashboard/add_requestmedications")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }
}
