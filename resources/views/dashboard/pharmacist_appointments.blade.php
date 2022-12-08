@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
      <div class="d-flex justify-content-between">
        <h4 style="color: #232e74;padding-left:38px;"><strong>My Appointments</strong></h4>
      </div>
      <div class="row" style="padding:15px; margin-left: 6px;">
        <div class="col-lg-4 col-md-4">
          <select name="filter" id="filter" class="form-control" onchange="get_filter_appointments(this.value)">   
            <option <?php if($filter=='pending'){ echo 'selected="selected"';} ?> value="pending">Pending</option>
            <option <?php if($filter=='completed'){ echo 'selected="selected"';} ?> value="completed">Completed</option>
            <option <?php if($filter=='cancelled'){ echo 'selected="selected"';} ?> value="cancelled">Cancelled</option>
          </select>
        </div>
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
                @if($appoint->status=='pending')
                  <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                      <button type="button" class="btn btn-primary" onclick="update_appointment('Complete','{{ $appoint->appointment_id }}');">Complete</button>
                    </div>
                    <div class="col-sm-4">
                      <button type="button" class="btn btn-danger" onclick="update_appointment('Cancel','{{ $appoint->appointment_id }}');">Cancel</button>
                    </div>
                    <div class="col-sm-2"></div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div style="text-align:center;"><h4>No Appointments found</h4></div>
      @endif        
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/flatpickr.js') }}"></script>
  <script type="text/javascript">
  function add_appointmentpopup(){ 
    $('#condition').val('');
    $('#appointment_date').val('');
    $('#appointment_time').val('');
    $('#exampleModalSizeLg').modal();
  }

  function update_appointment(action, appointment_id){
    var post_url = "{{URL::to('/updateAppointmentStatus')}}?appointment_id="+appointment_id+"&action="+action;
    var message = 'Are you sure you want to '+action+' this Appointment?';
    if (confirm(message)) {
      $.ajax({
        url : post_url,
        success : function(result){
          if(action=='Complete'){
            alert("Appointment completed successfully");
          } else {
            alert("Appointment cancelled successfully");
          }
          location.reload(true);
         }
      });
   } else {
      return false;
   }
  }

  function get_filter_appointments(filter){
    window.location.href="{{ URL::to('/pharmacistAppointments') }}?filter="+filter;
  }
  </script>
@endsection