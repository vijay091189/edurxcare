<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, URL, Session, Redirect, Config;
use DateTime;
use DateTimeZone;
use App\Helpers\EncDecHelper;
use App\Helpers\Helper as Helper;
use App\EcareDetails;

class AnalyticsController extends Controller
{
    public function __construct(){
      $this->ecareDetails = new EcareDetails();
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
        $data['requests_count'] = DB::select("select count(*) as requests_count from patient_requests");
        $data['appointments_count'] = DB::select("select count(*) as appointments_count from appointments");
        return view("reports/admindashboard")->with($data);
      } else {
        return Redirect::to('edurxcare_admin');
      }
    }

    

    public function logout()
    {
        Session::flush();
        return redirect('/edurxcare_admin');
    }
    
    public function changePassword(){
      $session_details = session()->get('LoginUserSession');
      if(isset($session_details['loginid']) && $session_details['loginid']!=''){
        $data['role_id'] = $session_details['role_id'];
        return view("reports/changePassword")->with($data);
      } else {
        return Redirect::to('edurxcare_admin');
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
      return Redirect::to('edurxcare_admin');
    }
  }

  public function pharmacistslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['users_count']=DB::select("select * from app_users where role_id='3'");
      return view("reports/pharmacistslist")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function requestslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['patient_requests'] = DB::select("select pr.*, au.name, au.mobile, ap.name as pharmacist from patient_requests pr
                                              inner join app_users au on au.user_id=pr.patient_id
                                              left join app_users ap on ap.user_id=pr.accepted_by
                                              order by created_date desc");
      return view("reports/requestslist")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function appointmentslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['patient_appointments']=DB::select("select pr.*, au.name, au.mobile, ap.name as pharmacist from appointments pr
                                      inner join app_users au on au.user_id=pr.patient_id
                                      left join app_users ap on ap.user_id=pr.accepted_by
                                      order by created_date desc");
      return view("reports/appointmentslist")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function medicationslist(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from medicines_master");
      return view("reports/medicationslist")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function allergies(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from allergies");
      return view("reports/allergies")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function medicalconditions(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from medical_conditions");
      return view("reports/medicalconditions")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function saveMedication(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $category_id = $input['category_id'];
      $category_name = $input['category_name'];
      if($category_id==''){
        $check_exists = DB::select("select medicine_id from medicines_master where medicine='$category_name'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $insert_data['medicine'] = $category_name;
          DB::table('medicines_master')->insert($insert_data);
        }
      } else {
        $check_exists = DB::select("select medicine_id from medicines_master where medicine='$category_name' and medicine_id!='$category_id'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $update_data['medicine'] = $category_name;
          DB::table('medicines_master')->where(array('medicine_id'=>$category_id))->update($update_data);
        }
      }
      echo 'Inserted';
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function saveAllergies(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $category_id = $input['category_id'];
      $category_name = $input['category_name'];
      if($category_id==''){
        $check_exists = DB::select("select id from allergies where allergy_name='$category_name'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $insert_data['allergy_name'] = $category_name;
          DB::table('allergies')->insert($insert_data);
        }
      } else {
        $check_exists = DB::select("select id from allergies where allergy_name='$category_name' and id!='$category_id'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $update_data['allergy_name'] = $category_name;
          DB::table('allergies')->where(array('id'=>$category_id))->update($update_data);
        }
      }
      echo 'Inserted';
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function saveMedConditions(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $category_id = $input['category_id'];
      $category_name = $input['category_name'];
      
      if($category_id==''){
        $check_exists = DB::select("select id from medical_conditions where medical_condition='$category_name'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $insert_data['medical_condition'] = $category_name;
          DB::table('medical_conditions')->insert($insert_data);
        }
      } else {
        $check_exists = DB::select("select id from medical_conditions where medical_condition='$category_name' and id!='$category_id'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $update_data['medical_condition'] = $category_name;
          DB::table('medical_conditions')->where(array('id'=>$category_id))->update($update_data);
        }
      }
      echo 'Inserted';
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function deleteMedicines(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('medicines_master')->where(array('medicine_id'=>$category_id))->update($data);
    echo 'updated';
  }

  public function deleteAllergies(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('allergies')->where(array('id'=>$category_id))->update($data);
    echo 'updated';
  }

  public function deleteMedConditions(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('medical_conditions')->where(array('id'=>$category_id))->update($data);
    echo 'updated';
  }

  public function updateUserStatus(Request $request){
    $input = $request->all();
    $user_id = $input['user_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('app_users')->where(array('user_id'=>$user_id))->update($data);
    echo 'updated';
  }

  public function faqsList(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from faqs");
      return view("reports/faqsList")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function patientQuestions(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from patient_lifestyle_questions");
      return view("reports/patientQuestions")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function pharmacistQuestions(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from pharmacist_questions");
      return view("reports/pharmacistQuestions")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function saveFaq(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $faq_id = $input['faq_id'];
      $question = $input['question'];
      $answer = $input['answer'];
      if($faq_id==''){
        $check_exists = DB::select("select faq_id from faqs where question='$question'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $insert_data['question'] = $question;
          $insert_data['answer'] = $answer;
          $insert_data['status'] = '1';
          DB::table('faqs')->insert($insert_data);
        }
      } else {
        $check_exists = DB::select("select faq_id from faqs where question='$question' and faq_id!='$faq_id'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $update_data['question'] = $question;
          $update_data['answer'] = $answer;
          DB::table('faqs')->where(array('faq_id'=>$faq_id))->update($update_data);
        }
      }
      echo 'Inserted';
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function savePatientQuestion(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $question_id = $input['question_id'];
      $question = $input['question'];
      if($question_id==''){
        $check_exists = DB::select("select question_id from patient_lifestyle_questions where question='$question'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $insert_data['question'] = $question;
          DB::table('patient_lifestyle_questions')->insert($insert_data);
        }
      } else {
        $check_exists = DB::select("select question_id from patient_lifestyle_questions where question='$question' and question_id!='$question_id'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $update_data['question'] = $question;
          DB::table('patient_lifestyle_questions')->where(array('question_id'=>$question_id))->update($update_data);
        }
      }
      echo 'Inserted';
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function savePharmacistQuestion(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $category_id = $input['id'];
      $question = $input['question'];
      $option_1 = $input['option_1'];
      $option_2 = $input['option_2'];
      $option_3 = $input['option_3'];
      $option_4 = $input['option_4'];
      $correct_answer = $input['correct_answer'];
      if($category_id==''){
        $check_exists = DB::select("select id from pharmacist_questions where question='$question'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $insert_data['question'] = $question;
          $insert_data['option_1'] = $option_1;
          $insert_data['option_2'] = $option_2;
          $insert_data['option_3'] = $option_3;
          $insert_data['option_4'] = $option_4;
          $correct_option_value = 'option_'.$correct_answer;
          $insert_data['correct_answer'] = $input[$correct_option_value];
          $insert_data['correct_answer_option'] = $correct_answer;
          DB::table('pharmacist_questions')->insert($insert_data);
        }
      } else {
        $check_exists = DB::select("select id from pharmacist_questions where question='$question' and id!='$category_id'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $update_data['question'] = $question;
          $update_data['option_1'] = $option_1;
          $update_data['option_2'] = $option_2;
          $update_data['option_3'] = $option_3;
          $update_data['option_4'] = $option_4;
          DB::table('pharmacist_questions')->where(array('id'=>$category_id))->update($update_data);
        }
      }
      echo 'Inserted';
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function deleteFaq(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('faqs')->where(array('faq_id'=>$category_id))->update($data);
    echo 'updated';
  }

  public function deletePatientQuestion(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('patient_lifestyle_questions')->where(array('question_id'=>$category_id))->update($data);
    echo 'updated';
  }

  public function deletePharmacistQuestion(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('pharmacist_questions')->where(array('id'=>$category_id))->update($data);
    echo 'updated';
  }

  public function locationsList(){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $data['categories']=DB::select("select * from locations where status=1");
      return view("reports/locationsList")->with($data);
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function saveLocation(Request $request){
    $session_details = session()->get('LoginUserSession');
    if(isset($session_details['loginid']) && $session_details['loginid']!=''){
      $input = $request->all();
      $location_id = $input['location_id'];
      $location_name = $input['location_name'];
      if($location_id==''){
        $check_exists = DB::select("select location_id from locations where location_name='$location_name'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $insert_data['location_name'] = ucwords(strtolower($location_name));
          $insert_data['status'] = 1;
          DB::table('locations')->insert($insert_data);
        }
      } else {
        $check_exists = DB::select("select location_id from locations where location_name='$location_name' and location_id!='$location_id'");
        if(count($check_exists)>0){
          echo 'exist'; die;
        } else {
          $update_data['location_name'] = ucwords(strtolower($location_name));
          DB::table('locations')->where(array('location_id'=>$location_id))->update($update_data);
        }
      }
      echo 'Inserted';
    } else {
      return Redirect::to('edurxcare_admin');
    }
  }

  public function deleteLocation(Request $request){
    $input = $request->all();
    $category_id = $input['category_id'];
    $status = $input['status'];
    $data=array(
      "status"=>$status
    );
    DB::table('locations')->where(array('location_id'=>$category_id))->update($data);
    echo 'updated';
  }
}
