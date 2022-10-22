<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use DB, Config;
use DateTime;
use DateTimeZone;
use App\Helpers\EncDecHelper;
use App\Helpers\Helper as Helper; 

class EcareController extends BaseController
{
    public function user_registration(Request $request){
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
        $check_mobile = DB::select("select user_id from app_users where mobile='$mobile_number'");
        if(isset($check_mobile[0])){
            $res_data['status'] = "Failed";
            $res_data['message'] = "Mobile number already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //check email
        $check_email = DB::select("select user_id from app_users where email='$email_id'");
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

    public function check_user_login(Request $request){
        $input = $request->all();
        $username = $input['username'];
        $userpassword = $input['password'];
        $encpassword = EncDecHelper::enc_string($userpassword);
        $checkUserLogin = DB::select("select l.*, au.* from login l 
                                    inner join app_users au on au.user_id=l.user_id
                                    where l.username='".$username."' and l.password='".$encpassword."' and l.status=1");
        if(isset($checkUserLogin[0])){
            $res_data['user_id'] = (string)$checkUserLogin[0]->user_id;
            $res_data['role_id'] = (string)$checkUserLogin[0]->role_id;
            $res_data['name'] = (string)$checkUserLogin[0]->name;
            $res_data['gender'] = (string)$checkUserLogin[0]->gender;
            $res_data['dob'] = (string)$checkUserLogin[0]->dob;
            $res_data['mobile'] = (string)$checkUserLogin[0]->mobile;
            $res_data['email'] = (string)$checkUserLogin[0]->email;
            $res_data['address'] = (string)$checkUserLogin[0]->address;
            $res_data['status'] = 'Success';
            $res_data['message'] = 'Logged in successfully';
        } else {
            $res_data['user_id'] = '';
            $res_data['role_id'] = '';
            $res_data['name'] = '';
            $res_data['gender'] = '';
            $res_data['dob'] = '';
            $res_data['mobile'] = '';
            $res_data['email'] = '';
            $res_data['address'] = '';
            $res_data['status'] = 'Failed';
            $res_data['message'] = 'Invalid username or password';
        }
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function edit_profile(Request $request){
        $input = $request->all();
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $role_id = isset($input['role_id'])?$input['role_id']:'';
        $get_user_details = DB::select("select user_id, name, gender, dob, mobile, email, address from app_users 
                                        where user_id='$user_id'");
        $res_data['user_id'] = (string)$get_user_details[0]->user_id;
        $res_data['name'] = (string)$get_user_details[0]->name;
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
        $check_mobile = DB::select("select user_id from app_users where mobile='$mobile' and user_id!='$user_id'");
        if(isset($check_mobile[0])){
            $res_data['status'] = "Failed";
            $res_data['message'] = "Mobile number already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //check email
        $check_email = DB::select("select user_id from app_users where email='$email' and user_id!='$user_id'");
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

    public function change_password(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $old_password = $input['old_password'];
        $new_password = $input['new_password'];
        //check old password
        $old_encpassword = EncDecHelper::enc_string($old_password);
        $check_old_password = DB::select("select username from login where user_id='$user_id' and password='$old_encpassword'");
        if(isset($check_old_password[0])){
            $new_encpassword = EncDecHelper::enc_string($new_password);
            $update_password['password'] = $new_encpassword;
            DB::table('login')->where(array('user_id'=>$user_id))->update($update_password);
            $res_data['status'] = "Success";
            $res_data['message'] = "Password changed successfully";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        } else {
            $res_data['status'] = "Failed";
            $res_data['message'] = "Incorrect old password. Please try again";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
    }

    public function forgot_password(Request $request){
        $input = $request->all();
        $email = $input['email'];
        $mobile = $input['mobile'];
        $res_data['security_code'] = '';
        $res_data['status'] = "Failed";
        $res_data['message'] = "Invalid Mobile Number or Email ID. Please try again";
        if($email!='' || $mobile!=''){
            $get_user_details = DB::select("SELECT user_id FROM app_users where mobile='$mobile' or email='$email'");
            if(isset($get_user_details[0])){
                $gen_code = rand(1111,9999);
                $update_code['forgot_password_code'] = $gen_code;
                DB::table('app_users')->where(array('user_id'=>$get_user_details[0]->user_id))->update($update_code);
                $res_data['security_code'] = (string)$gen_code;
                $res_data['status'] = "Success";
                $res_data['message'] = "Security code sent successfully";
            }
        }
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function patient_lifestyle_questions(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $life_style_questions = DB::select("select question_id, question from patient_lifestyle_questions where status=1");
        $data = array();
        $key = 0;
        foreach($life_style_questions as $life_style_q){
            $data[$key]['question_id'] = (string)$life_style_q->question_id;
            $data[$key]['question'] = $life_style_q->question;
            $key++;
        }
        $res_data['status'] = "Success";
        $res_data['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function save_patient_lifestyle(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $question_data = $input['question_data'];
        foreach($question_data as $question_dat){
            echo $question_dat['question_id'].'---'.$question_dat['answer'].'<br>';
        }
    }
}
