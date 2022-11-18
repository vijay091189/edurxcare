@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
      <div class="d-flex justify-content-between">
        <h4 style="color: #232e74;padding-left:38px;"><strong>My Appointments</strong></h4>
        <button type="button" onclick="add_appointmentpopup()" href="javascript:void(0)" class="btn btn-primary rounded-pill" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;">Book Appointment</button>
      </div>
      <div class="row" style="padding:15px; margin-left: 6px;">
        <div class="col-lg-4 col-md-4">
          <select name="filter" id="filter" class="form-control" onchange="get_filter_appointments(this.value)">   
            <option <?php if($filter=='today'){ echo 'selected="selected"';} ?> value="today">Today</option>
            <option <?php if($filter=='past'){ echo 'selected="selected"';} ?> value="past">Past</option>
            <option <?php if($filter=='future'){ echo 'selected="selected"';} ?> value="future">Future</option>
          </select>
        </div>
      </div>
      <div class="row" style="padding:15px; margin-left: 6px;">
      @if(count($appointments)>0)
        @foreach($appointments as $appoint)
          <div class="col-lg-4 col-md-4">
            <div class="card m-0" style="">
              <div class="card-body cb_b">
                <h5 class="card-title d-flex justify-content-between">
                  <div><i class="fa-solid fa-calendar-check"></i> {{ date('d-m-Y', strtotime($appoint->appointment_date)) }} {{ date('h:i A', strtotime($appoint->appointment_time)) }}</div>
                </h5>
                <div class="card-text p-8">
                  <table>
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
                      <td style="padding-right: 3px;"><b>Status</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ ucwords($appoint->status) }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Accepted Pharmacist</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $appoint->accepted_by!=''?$appoint->accepted_by:'--' }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div style="text-align:center;"><h4>No medications found</h4></div>
      @endif        
      </div>
    </div>
  </div>
<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Medication</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
          </button>
      </div>
      <div class="modal-body">
          <form action="#" method="post" name="medication_form" id="medication_form">
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Title<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="condition" id="condition" class="form-control">   
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Appointment Date<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="appointment_date" id="appointment_date" class="form-control">   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Appointment Time<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="appointment_time" id="appointment_time" class="form-control">   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Priority<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <select name="priority" id="priority" class="form-control">   
                    <option value="normal">Normal</option>
                    <option selected="selected" value="medium">Medium</option>
                    <option value="high">High</option>
                  </select>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-12" style="float: left; width: 100%; text-align: center" >
                  <button type="button" class="btn btn-primary" id="saveMeds" onclick="saveAppointment();">Submit</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            
          </form>
      </div>
      
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/flatpickr.js') }}"></script>
  <script type="text/javascript">
    $("#appointment_date").flatpickr({
      altInput: true,
      altFormat: "d/m/Y",
      dateFormat: "Y-m-d",
      minDate: "today"
    });
    $("#appointment_time").flatpickr({
      noCalendar: true,
      enableTime: true,
      dateFormat: 'h:i K'
    });
  function saveAppointment(){
    var formData = new FormData();
    formData = new FormData($('#medication_form')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveAppointment')}}";
    var condition = $('#condition').val();
    var appointment_date = $('#appointment_date').val();
    var appointment_time = $('#appointment_time').val();
    var priority = $('#priority').val();
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

  function delete_medcond(medcond_id){
    var post_url = "{{URL::to('/deleteRequestMedcond')}}?medcond_id="+medcond_id;
    var message = 'Are you sure you want to delete this Medical Condition?';
    if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Medical Condition deleted successfully");
            location.reload();
         }
      });
   } else {
      return false;
   }
  }

  function get_filter_appointments(filter){
    alert(filter);
    window.location.href="{{ URL::to('/patientAppointments') }}?filter="+filter;
  }
  </script>
@endsection