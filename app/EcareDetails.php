<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session,Config;
use DateTime;
use DateTimeZone, DatePeriod, DateInterval;

class EcareDetails extends Model
{
    public function patient_requests($patient_id){
        $patient_requests = DB::select("select * from patient_requests where patient_id='$patient_id' order by created_date desc");
        return $patient_requests;
    }

    public function patientRecommendations(){
        $patient_requests = DB::select("select * from recommendations where status='1'");
        return $patient_requests;
    }

    public function patientFaqs(){
        $data = DB::select("select * from faqs where status='1'");
        return $data;
    }

    public function patientNotifications($user_id){
        $data = DB::select("select * from patient_notifications where patient_id='$user_id'");
        return $data;
    }

    public function pillReminders($user_id){
        $data = DB::select("select * from patient_medications where patient_id='$user_id' and status=1");
        return $data;
    }

    public function viewRequestResponse($request_id){
        $data = DB::select("select * from patient_requests where request_id='$request_id'");
        return $data[0];
    }

    public function patientAppointments($user_id,$filter,$cur_date){
        if($filter=='today'){
            $cond = "and appointment_date='$cur_date'";
        } else if($filter=='past'){
            $cond = "and appointment_date<'$cur_date'";
        } else {
            $cond = "and appointment_date>'$cur_date'";
        }
        $data = DB::select("select au.name as accepted_by, description, appointment_date, appointment_time, priority, a.status from appointments a
                                            left join app_users au on au.user_id=a.accepted_by
                                            where patient_id='$user_id' $cond");
        return $data;
    }
}
