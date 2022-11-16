<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use DB, Config;
use URL, Session, Redirect;
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
            $patient_id = $session_details['user_id'];
            $data['patient_requests'] = DB::select("select * from patient_requests where patient_id='$patient_id'");
            return view("dashboard/patient_dashboard")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function newRequest(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $input = $request->all();
            $vir_request_id = isset($input['vir_request_id'])?$input['vir_request_id']:'';
            if($vir_request_id!=''){
                $data['patient_requests'] = DB::select("select * from virtual_patient_requests where request_id='$vir_request_id'");
            } else {
                $data['patient_requests'] = array();
            }
            $data['vir_request_id'] = $vir_request_id;
            return view("dashboard/new_request")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function saveNewRequest(Request $request){
        $session_details = session()->get('LoginUserSession');
        $input = $request->all();
        $data['patient_id'] = $session_details['user_id'];
        $vir_request_id = isset($input['vir_request_id'])?$input['vir_request_id']:'';
        if($vir_request_id==''){
            $data['comments'] = $input['request_comments'];
            $data['status'] = 'pending';
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['modified_date'] = date('Y-m-d H:i:s');
            $vir_request_id = DB::table('virtual_patient_requests')->insertGetId($data);
        } else {
            $updatedata['comments'] = $input['request_comments'];
            DB::table('virtual_patient_requests')->where(array('request_id'=>$vir_request_id))->update($updatedata);
        }
        echo $vir_request_id;
    }

    public function add_requestmedications(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $input = $request->all();
            $vir_request_id = $input['vir_request_id'];
            $data['vir_request_id'] = $vir_request_id;
            $data['request_medications'] = DB::select("select * from virtual_request_medications 
                                                        where request_id='$vir_request_id' and status=1");
            return view("dashboard/add_requestmedications")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function saveRequestMedication(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $data['medication_name'] = $input['medication_name'];
        $data['diagnosis'] = $input['diagnosis'];
        $data['frequency'] = implode(',',$input['frequency']);
        $data['start_date'] = $input['start_date'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_medications')->insertGetId($data);
        echo $input['vir_request_id'];
    }

    public function deleteRequestMedication(Request $request){
        $input = $request->all();
        $med_id = $input['med_id'];
        $data['status'] = 0;
        DB::table('virtual_request_medications')->where(array('request_medication_id'=>$med_id))->update($data);
        echo 'success';
    }

    public function add_requestallergies(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $input = $request->all();
            $vir_request_id = $input['vir_request_id'];
            $data['vir_request_id'] = $vir_request_id;
            $data['request_allergies'] = DB::select("select * from virtual_request_allergies 
                                                        where request_id='$vir_request_id' and status=1");
            return view("dashboard/add_requestallergies")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function saveRequestAllergy(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $data['allergy_name'] = $input['allergy_name'];
        $data['allergy_description'] = $input['allergy_description'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_allergies')->insertGetId($data);
        echo $input['vir_request_id'];
    }

    public function deleteRequestAllergy(Request $request){
        $input = $request->all();
        $allergy_id = $input['allergy_id'];
        $data['status'] = 0;
        DB::table('virtual_request_allergies')->where(array('request_allergy_id'=>$allergy_id))->update($data);
        echo 'success';
    }

    public function add_requestmedcond(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $input = $request->all();
            $vir_request_id = $input['vir_request_id'];
            $data['vir_request_id'] = $vir_request_id;
            $data['request_medconds'] = DB::select("select * from virtual_request_medical_conditions 
                                                        where request_id='$vir_request_id' and status=1");
            return view("dashboard/add_requestmedcond")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function saveRequestMedcond(Request $request){
        $input = $request->all();
        $data['request_id'] = $input['vir_request_id'];
        $data['request_medical_condition'] = $input['request_medical_condition'];
        $data['request_med_decription'] = $input['request_med_decription'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        DB::table('virtual_request_medical_conditions')->insertGetId($data);
        echo $input['vir_request_id'];
    }

    public function deleteRequestMedcond(Request $request){
        $input = $request->all();
        $medcond_id = $input['medcond_id'];
        $data['status'] = 0;
        DB::table('virtual_request_medical_conditions')->where(array('request_medical_cond_id'=>$medcond_id))->update($data);
        echo 'success';
    }

    public function add_labreports(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $input = $request->all();
            $vir_request_id = $input['vir_request_id'];
            $data['vir_request_id'] = $vir_request_id;
            $data['request_reports'] = DB::select("select * from virtual_request_lab_documents 
                                                        where request_id='$vir_request_id' and status=1");
            return view("dashboard/add_labreports")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function saveLabReports(Request $request){
        $session_details = session()->get('LoginUserSession');
        $patient_id = $session_details['user_id'];
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
        echo $input['vir_request_id'];
    }

    public function deleteLabReport(Request $request){
        $input = $request->all();
        $report_id = $input['report_id'];
        $data['status'] = 0;
        DB::table('virtual_request_lab_documents')->where(array('request_lab_docs_id'=>$report_id))->update($data);
        echo 'success';
    }

    public function add_prescriptions(Request $request){
        $session_details = session()->get('LoginUserSession');
        if(isset($session_details['loginid']) && $session_details['loginid']!=''){
            $input = $request->all();
            $vir_request_id = $input['vir_request_id'];
            $data['vir_request_id'] = $vir_request_id;
            $data['request_reports'] = DB::select("select * from virtual_request_prescriptions 
                                                        where request_id='$vir_request_id' and status=1");
            return view("dashboard/add_prescriptions")->with($data);
        } else {
            return Redirect::to('loginpage');
        }
    }

    public function savePrescription(Request $request){
        $session_details = session()->get('LoginUserSession');
        $patient_id = $session_details['user_id'];
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
        echo $input['vir_request_id'];
    }

    public function deletePrescription(Request $request){
        $input = $request->all();
        $report_id = $input['report_id'];
        $data['status'] = 0;
        DB::table('virtual_request_prescriptions')->where(array('request_presc_id'=>$report_id))->update($data);
        echo 'success';
    }

    public function submitRequest(Request $request){
        $session_details = session()->get('LoginUserSession');
        $patient_id = $session_details['user_id'];
        $input = $request->all();
        $vir_request_id = $input['vir_request_id'];
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
        echo 'success';
    }

    public function userlogout(){
        Session::flush();
        return redirect('/');
    }

    public function editPatientProfile(Request $request){
        $session_details = session()->get('LoginUserSession');
        $user_id = $session_details['user_id'];
        $input = $request->all();
        $data['user_details'] = DB::select("select * from app_users where user_id='$user_id'");
        return view("dashboard/edit_patient_profile")->with($data);
    }

    public function updatePatientProfile(Request $request){
        $session_details = session()->get('LoginUserSession');
        $user_id = $session_details['user_id'];
        $input = $request->all();
        $data['name'] = $input['full_name'];
        $data['gender'] = $input['gender'];
        $data['dob'] = $input['dob'];
        $data['mobile'] = $input['mobile'];
        $data['email'] = $input['email_id'];
        $data['address'] = $input['address'];
        $data['modified_date'] = date('Y-m-d H:i:s');
        DB::table('app_users')->where(array('user_id'=>$user_id))->update($data);
        //insert into login  table
        $login_data['username'] = $input['mobile'];
        $login_data['display_name'] = $input['full_name'];
        $login_data['user_id'] = $user_id;
        $login_data['status'] = 1;
        DB::table('login')->where(array('user_id'=>$user_id))->update($login_data);
        echo 'inserted';
    }

    public function patientRecommendations(Request $request){
        $session_details = session()->get('LoginUserSession');
        $user_id = $session_details['user_id'];
        $input = $request->all();
        $data['details'] = DB::select("select * from recommendations where status='1'");
        return view("dashboard/patient_recommendations")->with($data);
    }

    public function patientFaqs(Request $request){
        $session_details = session()->get('LoginUserSession');
        $user_id = $session_details['user_id'];
        $input = $request->all();
        $data['details'] = DB::select("select * from faqs where status='1'");
        return view("dashboard/patient_faqs")->with($data);
    }

    public function patientNotifications(Request $request){
        $session_details = session()->get('LoginUserSession');
        $user_id = $session_details['user_id'];
        $input = $request->all();
        $data['details'] = DB::select("select * from patient_notifications where patient_id='$user_id'");
        return view("dashboard/patient_notifications")->with($data);
    }

    public function userChangePassword(Request $request){
        $session_details = session()->get('LoginUserSession');
        $user_id = $session_details['user_id'];
        $input = $request->all();
        $data['details'] = DB::select("select * from patient_notifications where patient_id='$user_id'");
        return view("dashboard/user_change_password")->with($data);
    } 
    
    public function userUpdatePassword(Request $request){
        $session_details = session()->get('LoginUserSession');
        $username = $session_details['username'];
        $input = $request->all();
        $current_password = $input['old_password'];
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
