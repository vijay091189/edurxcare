@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
      <div class="d-flex justify-content-between">
        <h4 style="color: #232e74;padding-left:38px;"><strong>New Appointment Requests</strong></h4>
      </div>
      <div class="row" style="padding:15px; margin-left: 6px;">
      @if(count($appointments)>0)
        @foreach($appointments as $appoint)
          <div class="col-lg-4 col-md-4" style="margin-bottom: 20px;">
            <div class="card m-0" style="">
              <div class="card-body cb_b">
                <h5 class="card-title d-flex justify-content-between">
                  <div><i class="fa-solid fa-calendar-check"></i> {{ date('d-m-Y', strtotime($appoint->appointment_date)) }} {{ date('h:i A', strtotime($appoint->appointment_time)) }}</div>
                  <div><i class="fa-solid fa-phone"></i> {{ $appoint->mobile }}</div>
                </h5>
                <div class="card-text p-8">
                  <table>
                    <tr>
                      <td style="padding-right: 3px;"><b>Patient Name</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ ucwords($appoint->patient_name) }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Patient UId</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ ucwords($appoint->unique_id) }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Priority</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ ucwords($appoint->priority) }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Condition</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $appoint->description }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Email</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $appoint->email }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Age</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $appoint->patient_age }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Address</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $appoint->address }}</td>
                    </tr>
                  </table>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-4">
                    <button type="button" class="btn btn-primary" onclick="update_appointment('Accept','{{ $appoint->appointment_id }}');">Accept</button>
                  </div>
                  <div class="col-sm-4">
                    <button type="button" class="btn btn-danger" onclick="update_appointment('Reject','{{ $appoint->appointment_id }}');">Reject</button>
                  </div>
                  <div class="col-sm-2"></div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div style="text-align:center;"><h4>No Appointments Requests found</h4></div>
      @endif        
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/flatpickr.js') }}"></script>
  <script type="text/javascript">
   
  function saveAppointment(){
    var formData = new FormData();
    formData = new FormData($('#medication_form')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveAppointment')}}";
    
    var appointment_type = $('#appointment_type').val();
    var condition = $('#condition').val();
    var appointment_date = $('#appointment_date').val();
    var appointment_time = $('#appointment_time').val();
    var priority = $('#priority').val();
    if(appointment_type==''){
      alert("Please select appointment type");
      return false;
    }
    if(condition==''){
      alert("Please enter title/description");
      return false;
    }
    if(appointment_date==''){
      alert("Please select appointment date");
      return false;
    }
    if(appointment_time==''){
      alert("Please select appointment time");
      return false;
    }
   
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Appointment scheduled successfully");
          window.location.href="{{ URL::to('/patientAppointments') }}";
        }
    });
  }

  function add_appointmentpopup(){ 
    $('#condition').val('');
    $('#appointment_date').val('');
    $('#appointment_time').val('');
    $('#exampleModalSizeLg').modal();
  }

  function update_appointment(action, appointment_id){
    var post_url = "{{URL::to('/updateAppointment')}}?appointment_id="+appointment_id+"&action="+action;
    var message = 'Are you sure you want to '+action+' this Appointment?';
    if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Appointment "+action+"ed successfully");
            if(action=='Reject'){
              location.reload(true);
            } else {
              window.location.href="{{ URL::to('/pharmacistAppointments') }}";
            }
            
         }
      });
   } else {
      return false;
   }
  }

  function get_filter_appointments(filter){
    window.location.href="{{ URL::to('/patientAppointments') }}?filter="+filter;
  }
  </script>
@endsection