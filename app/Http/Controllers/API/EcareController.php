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
use App\EcareDetails;

class EcareController extends BaseController
{
    public function __construct(){
        $this->ecareDetails = new EcareDetails();
    }

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
            $res_data['status'] = "500";
            $res_data['status_message'] = "Mobile number already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //check email
        $check_email = DB::select("select user_id from app_users where email='$email_id'");
        if(isset($check_email[0])){
            $res_data['status'] = "500";
            $res_data['status_message'] = "Email ID already exists";
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
        //$res_data['status_code'] = "200";
        $res_data['status'] = "200";
        $res_data['status_message'] = "You have registered successfully";
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
            $response_data['status'] = "200";
            $response_data['message'] = "Login Successful";
            $response_data['status_message'] = $res_data;
            //$res_data['status_code'] = '200';
        } else {
            $res_data['user_id'] = '';
            $res_data['role_id'] = '';
            $res_data['name'] = '';
            $res_data['gender'] = '';
            $res_data['dob'] = '';
            $res_data['mobile'] = '';
            $res_data['email'] = '';
            $res_data['address'] = '';
            $response_data['status'] = '500';
            $response_data['message'] = "Invalid Username or Password";
            $response_data['status_message'] = $res_data;
            //$res_data['status_code'] = '500';
        }
        return $this->sendResponse($response_data, 'Data fetched successfully.');
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
        //$res_data['status_code'] = '200';
        $response_data['status'] = "200";
        $response_data['status_message'] = $res_data;
        return $this->sendResponse($response_data, 'Data fetched successfully.');
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
            //$res_data['status_code'] = '500';
            $res_data['status'] = "500";
            $res_data['status_message'] = "Mobile number already exists";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
        //check email
        $check_email = DB::select("select user_id from app_users where email='$email' and user_id!='$user_id'");
        if(isset($check_email[0])){
            //$res_data['status_code'] = '500';
            $res_data['status'] = "500";
            $res_data['status_message'] = "Email ID already exists";
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
        //$res_data['status_code'] = '200';
        $res_data['status'] = "200";
        $res_data['status_message'] = "Profile updated successfully";
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
            //$res_data['status_code'] = "200";
            $res_data['status'] = "200";
            $res_data['status_message'] = "Password changed successfully";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        } else {
            //$res_data['status_code'] = "500";
            $res_data['status'] = "500";
            $res_data['status_message'] = "Incorrect old password. Please try again";
            return $this->sendResponse($res_data, 'Data fetched successfully.');
        }
    }

    public function forgot_password(Request $request){
        $input = $request->all();
        $email = $input['email'];
        $mobile = $input['mobile'];
        $data['user_id'] = '';
        $data['security_code'] = '';
        //$res_data['status_code'] = "500";
        $res_data['status'] = "500";
        $res_data['status_message'] = "Invalid Mobile Number or Email ID. Please try again";
        if($email!='' || $mobile!=''){
            $get_user_details = DB::select("SELECT user_id FROM app_users where mobile='$mobile' or email='$email'");
            if(isset($get_user_details[0])){
                $gen_code = rand(1111,9999);
                $update_code['forgot_password_code'] = $gen_code;
                DB::table('app_users')->where(array('user_id'=>$get_user_details[0]->user_id))->update($update_code);
                $data['user_id'] = (string)$get_user_details[0]->user_id;
                $data['security_code'] = (string)$gen_code;
                $data['mesage'] = "Security code sent successfully";
                //$res_data['status_code'] = "200";
                $res_data['status'] = "200";
                $res_data['status_message'] = $data;
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
        //$res_data['status_code'] = "200";
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function save_patient_lifestyle(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $question_data = $input['question_data'];
        foreach($question_data as $question_dat){
            $question_id = $question_dat['question_id'];
            $answer = $question_dat['answer'];
            $get_question = DB::table('patient_lifestyle_questions')->select("question")
                                            ->where('question_id',$question_id)->first();
            $insert_data['user_id'] = $user_id;
            $insert_data['question'] = $get_question->question;
            $insert_data['answer'] = $answer;
            DB::table('patient_lifestyle_answers')->insert($insert_data);
        }
        //$res_data['status_code'] = "200";
        $res_data['status'] = "200";
        $res_data['status_message'] = "Life style details saved successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function save_forgot_password(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $new_password = $input['new_password'];
        //check old password
        $new_encpassword = EncDecHelper::enc_string($new_password);
        $update_password['password'] = $new_encpassword;
        DB::table('login')->where(array('user_id'=>$user_id))->update($update_password);
        //$res_data['status_code'] = "200";
        $res_data['status'] = "200";
        $res_data['status_message'] = "Password changed successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function search_medicines(Request $request){
        $input = $request->all();
        $query = $input['query'];
        $search_data = DB::select("select medicine as name from medicines_master where medicine like '%$query%'");
        $data = array();
        $key = 0;
        foreach($search_data as $search_d){
            $data[$key]['name'] = (string)$search_d->name;
            $key++;
        }
        //$res_data['status_code'] = "200";
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function search_medicalconditions(Request $request){
        $input = $request->all();
        $query = $input['query'];
        $search_data = DB::select("select medical_condition as name from medical_conditions where medical_condition like '%$query%'");
        $data = array();
        $key = 0;
        foreach($search_data as $search_d){
            $data[$key]['name'] = (string)$search_d->name;
            $key++;
        }
        //$res_data['status_code'] = "200";
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function seacrh_allergies(Request $request){
        $input = $request->all();
        $query = $input['query'];
        $search_data = DB::select("select allergy_name as name from allergies where allergy_name like '%$query%'");
        $data = array();
        $key = 0;
        foreach($search_data as $search_d){
            $data[$key]['name'] = (string)$search_d->name;
            $key++;
        }
        //$res_data['status_code'] = "200";
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function save_request(Request $request){
        print_r($_REQUEST);
        print_r($_FILES);
    }

    public function patient_requests(Request $request){
        $input = $request->all();
        $patient_id = $input['user_id'];
        $patient_requests = $this->ecareDetails->patient_requests($patient_id);
        $key=0;
        $data = array();
        foreach($patient_requests as $patient_req){
            $data[$key]['request_id'] = (string)$patient_req->request_id;
            $data[$key]['requested_date'] = date('d-m-Y', strtotime($patient_req->created_date));
            $data[$key]['comments'] = $patient_req->comments;
            $data[$key]['status'] = $patient_req->status;
            $data[$key]['last_updated'] = date('d-m-Y h:i A', strtotime($patient_req->modified_date));
            $data[$key]['pharmacist_name'] = '--';
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function patientRecommendations(Request $request){
        $input = $request->all();
        $patientRecommendations = $this->ecareDetails->patientRecommendations();
        $key=0;
        $data = array();
        foreach($patientRecommendations as $patient_req){
            $data[$key]['recommendation'] = $patient_req->recommendation;
            $data[$key]['date'] = date('d/m/Y h:i A', strtotime($patient_req->created_date));
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function patientFaqs(Request $request){
        $input = $request->all();
        $patientFaqs = $this->ecareDetails->patientFaqs();
        $key=0;
        $data = array();
        foreach($patientFaqs as $patient_req){
            $data[$key]['question'] = $patient_req->question;
            $data[$key]['answer'] = $patient_req->answer;
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function patientNotifications(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $details = $this->ecareDetails->patientNotifications($user_id);
        $key=0;
        $data = array();
        foreach($details as $patient_req){
            $data[$key]['notification'] = $patient_req->notification;
            $data[$key]['created_date'] = date('d/m/Y h:i A', strtotime($patient_req->created_date));
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function pillReminders(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $details = $this->ecareDetails->pillReminders($user_id);
        $key=0;
        $data = array();
        foreach($details as $request_med){
            $data[$key]['medication_name'] = $request_med->medication_name;
            $data[$key]['diagnosis'] = $request_med->diagnosis;
            $data[$key]['frequency'] = ucwords(str_replace(',',', ',$request_med->frequency));
            $data[$key]['created_date'] = date('d/m/Y', strtotime($request_med->start_date));
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function viewRequestResponse(Request $request){
        $input = $request->all();
        $request_id = $input['request_id'];
        $request_med = $this->ecareDetails->viewRequestResponse($request_id);
        $data['use'] = $request_med->usage!=''?$request_med->usage:'';
        $data['directions'] = $request_med->directions?$request_med->directions:'';
        $data['side_effects'] = $request_med->side_effects?$request_med->side_effects:'';
        $data['managing_side_effects'] = $request_med->manage_side_effects?$request_med->manage_side_effects:'';
        $data['self_care_measures'] = $request_med->self_care_measure?$request_med->self_care_measure:'';
        $data['drug_interactions'] = $request_med->drug_interactions?$request_med->drug_interactions:'';
        $data['follow_up'] = $request_med->follow_up_comments?$request_med->follow_up_comments:'';
        $data['additional_comments'] = $request_med->response_comments?$request_med->response_comments:'';
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function patientAppointments(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $filter = isset($input['filter'])?$input['filter']:'today';
        $cur_date = date('Y-m-d');
        $details = $this->ecareDetails->patientAppointments($user_id,$filter,$cur_date);
        $key=0;
        $data = array();
        foreach($details as $appoint){
            $data[$key]['appointment_date'] = date('d-m-Y', strtotime($appoint->appointment_date)).' '.date('h:i A', strtotime($appoint->appointment_time));
            $data[$key]['priority'] = ucwords($appoint->priority);
            $data[$key]['status'] = ucwords($appoint->status);
            $data[$key]['condition'] = $appoint->description;
            $data[$key]['appointment_type'] = $appoint->appointment_type;
            $data[$key]['accepted_pharmacist'] = $appoint->accepted_by!=''?$appoint->accepted_by:'--';
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function saveAppointment(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $data['patient_id'] = $user_id;
        $data['appointment_type'] = $input['appointment_type'];
        $data['appointment_date'] = $input['appointment_date'];
        $data['appointment_time'] = date('H:i:s',strtotime($input['appointment_time']));
        $data['description'] = $input['condition'];
        $data['priority'] = $input['priority'];
        $data['created_by'] = $user_id;
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 'pending';
        $appointment_id = DB::table('appointments')->insertGetId($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Appointment saved successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function saveReviewRating(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $data['rating'] = $input['rating'];
        $data['review'] = $input['sugestions'];
        $data['description'] = $input['feedback'];
        $data['user_id'] = $user_id;
        $data['status'] = 1;
        $data['created_date'] = date('Y-m-d H:i:s');
        DB::table('review_rating')->insert($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Review and Rating saved successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function saveReferFriend(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $email_id = $input['email_id'];
        $res_data['status'] = "200";
        $res_data['status_message'] = "Referred your friend successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function newRequest(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $data['comments'] = $input['request_comments'];
        $data['status'] = 'pending';
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['modified_date'] = date('Y-m-d H:i:s');
        $vir_request_id = DB::table('virtual_patient_requests')->insertGetId($data);
        $vir_data['vir_request_id'] = (string)$vir_request_id;
        $res_data['status'] = "200";
        $res_data['status_message'] = $vir_data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function addMedications(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $data['medication_name'] = $input['medication_name'];
        $data['diagnosis'] = $input['diagnosis'];
        $data['frequency'] = $input['frequency'];
        $data['start_date'] = $input['start_date'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_medications')->insertGetId($data);
        $vir_data['vir_request_id'] = (string)$input['vir_request_id'];
        $res_data['status'] = "200";
        $res_data['status_message'] = $vir_data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function addAllergy(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $data['allergy_name'] = $input['allergy_name'];
        $data['allergy_description'] = $input['allergy_description'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_allergies')->insertGetId($data);
        $vir_data['vir_request_id'] = (string)$input['vir_request_id'];
        $res_data['status'] = "200";
        $res_data['status_message'] = $vir_data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function addMedConditions(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $data['request_medical_condition'] = $input['request_medical_condition'];
        $data['request_med_decription'] = $input['request_med_decription'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_medical_conditions')->insertGetId($data);
        $vir_data['vir_request_id'] = (string)$input['vir_request_id'];
        $res_data['status'] = "200";
        $res_data['status_message'] = $vir_data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function uploadLabReports(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $file_doc_name='';
        $mime_type = '';
        $file_doc_path = public_path().'/labreports';
        if($request->hasfile('lab_report')){
            $extension = $request->file('lab_report')->extension();
            $mime_type = $request->file('lab_report')->getMimeType();
            $file_doc_name = $patient_id.'_labreport_'.time().'.'.$extension;
            $dep_file_upload = $request->lab_report->move($file_doc_path, $file_doc_name);
        }
        $data['file_path'] = $file_doc_name;
        $data['mime_type'] = $mime_type;
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_lab_documents')->insertGetId($data);
        $vir_data['vir_request_id'] = (string)$input['vir_request_id'];
        $res_data['status'] = "200";
        $res_data['status_message'] = $vir_data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function uploadPrescriptions(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $file_doc_name='';
        $mime_type = '';
        $file_doc_path = public_path().'/prescriptions';
        if($request->hasfile('lab_report')){
            $extension = $request->file('lab_report')->extension();
            $mime_type = $request->file('lab_report')->getMimeType();
            $file_doc_name = $patient_id.'_labreport_'.time().'.'.$extension;
            $dep_file_upload = $request->lab_report->move($file_doc_path, $file_doc_name);
        }
        $data['file_path'] = $file_doc_name;
        $data['mime_type'] = $mime_type;
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_prescriptions')->insertGetId($data);
        $vir_data['vir_request_id'] = (string)$input['vir_request_id'];
        $res_data['status'] = "200";
        $res_data['status_message'] = $vir_data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function newRequestDetails(Request $request){
        $input = $request->all();
        $vir_request_id = isset($input['vir_request_id'])?$input['vir_request_id']:'';
        if($vir_request_id!=''){
            $patient_requests = DB::select("select * from virtual_patient_requests where request_id='$vir_request_id'");
            $patient_request = isset($patient_requests[0])?$patient_requests[0]->comments:'';
        } else {
            $patient_request = '';
        }
        $data['vir_request_id'] = (string)$vir_request_id;
        $data['comments'] = $patient_request;
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function reqMedicationsList(Request $request){
        $input = $request->all();
        $vir_request_id = $input['vir_request_id'];
        $data['vir_request_id'] = $vir_request_id;
        $request_medications = DB::select("select * from virtual_request_medications where request_id='$vir_request_id' and status=1");
        $key=0;
        $data = array();
        foreach($request_medications as $request_med){
            $data[$key]['medication_name'] = $request_med->medication_name;
            $data[$key]['diagnosis'] = $request_med->diagnosis;
            $data[$key]['frequency'] = ucwords(str_replace(',',', ',$request_med->frequency));
            $data[$key]['start_date'] = date('d/m/Y', strtotime($request_med->start_date));
            $data[$key]['request_medication_id'] = (string)$request_med->request_medication_id;
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function reqAllergyList(Request $request){
        $input = $request->all();
        $vir_request_id = $input['vir_request_id'];
        $data['vir_request_id'] = $vir_request_id;
        $request_medications = DB::select("select * from virtual_request_allergies where request_id='$vir_request_id' and status=1");;
        $key=0;
        $data = array();
        foreach($request_medications as $request_med){
            $data[$key]['allergy_name'] = $request_med->allergy_name;
            $data[$key]['allergy_description'] = $request_med->allergy_description;
            $data[$key]['created_date'] = date('d/m/Y h:i A', strtotime($request_med->created_date));
            $data[$key]['request_allergy_id'] = (string)$request_med->request_allergy_id;
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function reqMedConditions(Request $request){
        $input = $request->all();
        $vir_request_id = $input['vir_request_id'];
        $data['vir_request_id'] = $vir_request_id;
        $request_medications = DB::select("select * from virtual_request_medical_conditions where request_id='$vir_request_id' and status=1");
        $key=0;
        $data = array();
        foreach($request_medications as $request_med){
            $data[$key]['request_medical_condition'] = $request_med->request_medical_condition;
            $data[$key]['request_med_decription'] = $request_med->request_med_decription;
            $data[$key]['created_date'] = date('d/m/Y h:i A', strtotime($request_med->created_date));
            $data[$key]['request_medical_cond_id'] = (string)$request_med->request_medical_cond_id;
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function reqLabReports(Request $request){
        $input = $request->all();
        $vir_request_id = $input['vir_request_id'];
        $data['vir_request_id'] = $vir_request_id;
        $request_medications = DB::select("select * from virtual_request_lab_documents where request_id='$vir_request_id' and status=1");
        $key=0;
        $data = array();
        foreach($request_medications as $request_report){
            $data[$key]['file_path'] = url('/').'/public/labreports/'.$request_report->file_path;
            $data[$key]['request_lab_docs_id'] = (string)$request_report->request_lab_docs_id;
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function reqPrescriptions(Request $request){
        $input = $request->all();
        $vir_request_id = $input['vir_request_id'];
        $data['vir_request_id'] = $vir_request_id;
        $request_medications = DB::select("select * from virtual_request_prescriptions where request_id='$vir_request_id' and status=1");
        $key=0;
        $data = array();
        foreach($request_medications as $request_report){
            $data[$key]['file_path'] = url('/').'/public/prescriptions/'.$request_report->file_path;
            $data[$key]['request_presc_id'] = (string)$request_report->request_presc_id;
            $key++;
        }
        $res_data['status'] = "200";
        $res_data['status_message']['data'] = $data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function deleteRequestMedication(Request $request){
        $input = $request->all();
        $med_id = $input['med_id'];
        $data['status'] = 0;
        DB::table('virtual_request_medications')->where(array('request_medication_id'=>$med_id))->update($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Medication Deleted successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function deleteRequestAllergy(Request $request){
        $input = $request->all();
        $allergy_id = $input['allergy_id'];
        $data['status'] = 0;
        DB::table('virtual_request_allergies')->where(array('request_allergy_id'=>$allergy_id))->update($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Allergy Deleted successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function deleteRequestMedcond(Request $request){
        $input = $request->all();
        $medcond_id = $input['medcond_id'];
        $data['status'] = 0;
        DB::table('virtual_request_medical_conditions')->where(array('request_medical_cond_id'=>$medcond_id))->update($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Medical Condition Deleted successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function deleteLabReport(Request $request){
        $input = $request->all();
        $report_id = $input['report_id'];
        $data['status'] = 0;
        DB::table('virtual_request_lab_documents')->where(array('request_lab_docs_id'=>$report_id))->update($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Lab Report Deleted successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function deletePrescription(Request $request){
        $input = $request->all();
        $report_id = $input['report_id'];
        $data['status'] = 0;
        DB::table('virtual_request_prescriptions')->where(array('request_presc_id'=>$report_id))->update($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Prescription Deleted successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function submitRequest(Request $request){
        $input = $request->all();
        $vir_request_id = $input['vir_request_id'];
        $patient_id = $input['user_id'];
        $request_data = DB::select("select * from virtual_patient_requests where request_id='$vir_request_id'");
        $medications_data = DB::select("select * from virtual_request_medications where request_id='$vir_request_id'");
        $allergies_data = DB::select("select * from virtual_request_allergies where request_id='$vir_request_id'");
        $medcond_data = DB::select("select * from virtual_request_medical_conditions where request_id='$vir_request_id'");
        $labreports_data = DB::select("select * from virtual_request_lab_documents where request_id='$vir_request_id'");
        $prescriptions_data = DB::select("select * from virtual_request_prescriptions where request_id='$vir_request_id'");
        //insert requests
        $reqdata['patient_id'] = $patient_id;
        $reqdata['comments'] = isset($request_data[0])?$request_data[0]->comments:'';
        $reqdata['status'] = 'pending';
        $reqdata['created_date'] = date('Y-m-d H:i:s');
        $reqdata['modified_date'] = date('Y-m-d H:i:s');
        $request_id = DB::table('patient_requests')->insertGetId($reqdata);
        //update code
        $updatedata['unique_id'] = 'REQ'.date('ymdHis').'-'.$request_id;
        DB::table('patient_requests')->where(array('request_id'=>$request_id))->update($updatedata);
        //insert medications
        foreach($medications_data as $medications_dat){
            $meddata['request_id'] = $request_id;
            $meddata['medication_name'] = $medications_dat->medication_name;
            $meddata['diagnosis'] = $medications_dat->diagnosis;
            $meddata['frequency'] = $medications_dat->frequency;
            $meddata['start_date'] = $medications_dat->start_date;
            $meddata['created_date'] = date('Y-m-d H:i:s');
            $meddata['status'] = 1;
            DB::table('request_medications')->insertGetId($meddata);
        }
        //insert allergies
        foreach($allergies_data as $allergies_dat){
            $alldata['request_id'] = $request_id;
            $alldata['allergy_name'] = $allergies_dat->allergy_name;
            $alldata['allergy_description'] = $allergies_dat->allergy_description;
            $alldata['created_date'] = date('Y-m-d H:i:s');
            $alldata['status'] = 1;
            DB::table('request_allergies')->insertGetId($alldata);
        }
        //insert medical conditions
        foreach($medcond_data as $medcond_dat){
            $medconddata['request_id'] = $request_id;
            $medconddata['request_medical_condition'] = $medcond_dat->request_medical_condition;
            $medconddata['request_med_decription'] = $medcond_dat->request_med_decription;
            $medconddata['created_date'] = date('Y-m-d H:i:s');
            $medconddata['status'] = 1;
            DB::table('request_medical_conditions')->insertGetId($medconddata);
        }
        //insert lab reports
        foreach($labreports_data as $labreports_dat){
            $labdata['request_id'] = $request_id;
            $labdata['file_path'] = $labreports_dat->file_path;
            $labdata['mime_type'] = $labreports_dat->mime_type;
            $labdata['created_date'] = date('Y-m-d H:i:s');
            $labdata['status'] = 1;
            DB::table('request_lab_documents')->insertGetId($labdata);
        }
        //insert prescriptions
        foreach($prescriptions_data as $prescriptions_dat){
            $presdata['request_id'] = $request_id;
            $presdata['file_path'] = $prescriptions_dat->file_path;
            $presdata['mime_type'] = $prescriptions_dat->mime_type;
            $presdata['created_date'] = date('Y-m-d H:i:s');
            $presdata['status'] = 1;
            DB::table('request_prescriptions')->insertGetId($presdata);
        }
        $vir_data['request_id'] = (string)$request_id;
        $res_data['status'] = "200";
        $res_data['status_message'] = $vir_data;
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }

    public function savePatientMedication(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $data['patient_id'] = $user_id;
        $data['medication_name'] = $input['medication_name'];
        $data['diagnosis'] = $input['diagnosis'];
        $data['frequency'] = $input['frequency'];
        $data['start_date'] = $input['start_date'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        $medication_id = DB::table('patient_medications')->insertGetId($data);
        $res_data['status'] = "200";
        $res_data['status_message'] = "Medication saved successfully";
        return $this->sendResponse($res_data, 'Data fetched successfully.');
    }
}
