<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use DB, Config;

class EcareController extends BaseController
{
    public function sendotp(Request $request){
        $input = $request->all();
        $name = isset($input['name'])?$input['name']:'';
        $user_type = isset($input['user_type'])?$input['user_type']:'';
        $gender = isset($input['gender'])?$input['gender']:'';
        $dob = isset($input['dob'])?$input['dob']:'';
        $mobile_number = isset($input['mobile_number'])?$input['mobile_number']:'';
        $email_id = isset($input['email_id'])?$input['email_id']:'';
        $address = isset($input['address'])?$input['address']:'';
        $password = isset($input['password'])?$input['password']:'';
        //check duplicate mobile
        $check_mobile = DB::select("select id from app_users where mobile='$mobile_number'");
        if(isset($check_mobile[0])){
            $res_data['status'] = "Failed";
            $res_data['message'] = "Mobile number already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //check email
        $check_email = DB::select("select id from app_users where email='$email_id'");
        if(isset($check_email[0])){
            $res_data['status'] = "Failed";
            $res_data['message'] = "Email ID already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //insert into users table
        $get_role_details = DB::select("select role_id from roles where role_name='$user_type'");
        $role_id = isset($get_role_details[0])?$get_role_details[0]->role_id:'';
        $insert_data1['name'] = $name;
        $insert_data1['gender'] = $gender;
        $insert_data1['role_id'] = $role_id;
        $insert_data1['gender'] = $gender;
        $insert_data1['dob'] = $dob;
        $insert_data1['email'] = $email_id;
        $insert_data1['mobile'] = $mobile_number;
        $insert_data1['address'] = $address;
        $insert_data1['is_deleted'] = 0;
        $insert_data1['status'] = $role_id==2?'approved':'pending';
        $insert_data1['created_date'] = date('Y-m-d H:i:s');
        $user_id = DB::table('app_users')->insertGetId($insert_data1);

        //insert into login table
        $encpassword = EncDecHelper::enc_string($password);
        $login_data['username'] = $mobile_number;
        $login_data['password'] = $encpassword;
        $login_data['role_id'] = $role_id;
        $login_data['display_name'] = $name;
        $login_data['user_id'] = $user_id;
        $login_data['status'] = 1;
        DB::table('login')->insert($login_data);
        $res_data['status'] = "Success";
        $res_data['message'] = "You have registered successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function checkLogin(Request $request){
        $input = $request->all();
        $username = $input['username'];
        $userpassword = $input['password'];
        $encpassword = EncDecHelper::enc_string($userpassword);
        $checkUserLogin = DB::select("select l.*, au.name from login l 
                                    inner join app_users au on au.user_id=l.user_id
                                    where l.username='".$username."' and l.password='".$encpassword."' and u.status=1");
        if(count($checkUserLogin)>0){
            $res_data['user_id'] = (string)$checkUserLogin[0]->user_id;
            $res_data['role_id'] = (string)$checkUserLogin[0]->user_id;
            $res_data['name'] = (string)$checkUserLogin[0]->name;
            $res_data['status'] = 'Success';
            $res_data['message'] = 'Logged in successfully';
        } else {
            $res_data['user_id'] = '';
            $res_data['role_id'] = '';
            $res_data['name'] = '';
            $res_data['status'] = 'Failed';
            $res_data['message'] = 'Invalid username or password';
        }
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function edit_profile(Request $request){
        $input = $request->all();
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $role_id = isset($input['role_id'])?$input['role_id']:'';
        $get_user_details = DB::select("select u.user_id, u.name, u.gender, u.dob, u.mobile, u.email, u.address from users where user_id='$user_id'");
        $res_data['user_id'] = (string)$get_user_details[0]->user_id;
        $res_data['name'] = (string)$get_user_details[0]->user_id;
        $res_data['gender'] = (string)$get_user_details[0]->gender;
        $res_data['dob'] = (string)$get_user_details[0]->dob;
        $res_data['mobile'] = (string)$get_user_details[0]->mobile;
        $res_data['email'] = (string)$get_user_details[0]->email;
        $res_data['address'] = (string)$get_user_details[0]->address;
        $res_data['status'] = 'Success';
        $res_data['message'] = 'Logged in successfully';
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function update_profile(Request $request){
        $input = $request->all();
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $name = isset($input['name'])?$input['name']:'';
        $gender = isset($input['gender'])?$input['gender']:'';
        $dob = isset($input['dob'])?$input['dob']:'';
        $mobile = isset($input['mobile'])?$input['mobile']:'';
        $email = isset($input['email'])?$input['email']:'';
        $address = isset($input['address'])?$input['address']:'';
        //check duplicate mobile
        $check_mobile = DB::select("select id from app_users where mobile='$mobile' and id!='$user_id'");
        if(isset($check_mobile[0])){
            $res_data['status'] = "Failed";
            $res_data['message'] = "Mobile number already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //check email
        $check_email = DB::select("select id from app_users where email='$email' and id!='$user_id'");
        if(isset($check_email[0])){
            $res_data['status'] = "Failed";
            $res_data['message'] = "Email ID already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //update users
        $updatedata['name'] = $name;
        $updatedata['gender'] = $gender;
        $updatedata['dob'] = $dob;
        $updatedata['mobile'] = $mobile;
        $updatedata['email'] = $email;
        $updatedata['address'] = $address;
        DB::table('app_users')->where(array('user_id'=>$user_id))->update($updatedata);
        //update login
        $logindata['username'] = $mobile;
        $logindata['display_name'] = $name;
        DB::table('login')->where(array('user_id'=>$user_id))->update($logindata);
        $res_data['status'] = "Success";
        $res_data['message'] = "Profile updated successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }
}
