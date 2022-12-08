@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<style type="text/css">
  .fileimage_class{
    width: 100px;
    border: 2px solid #a8a5a5;
    margin-right: 10px;
    height: 200px;
    border-radius: 5px;
  }
  .modal-content{
    background-color: none !important;
  }
  .td_class{
    padding: 8px;
  }
</style>
<div class="page">
    <div class="page-content container-fluid">
      <div class="example-wrap">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-block pt-4 pl-4 pb-0">
                <h4 class="" style="color:#232e74;font-weight: 500;padding-left: 13px;">Request Details</h4>
              </div>
              <div class="example-wrap">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Basic Details</b></div>
                        </div>
                        <div class="card-text">
                          <table>
                            <tr>
                              <td style="padding-right: 3px;"><b>Patient Name</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ ucwords($request_details->patient_name) }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Patient UId</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ ucwords($request_details->unique_id) }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Condition</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->comments }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Email</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->email }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Age</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->patient_age }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Address</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->address }}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Medical History</b></div>
                        </div>
                        <div class="card-text">
                          <table border="1" cellpadding="0" cellspacing="0">
                            <tr>
                              <th class="td_class"><strong>Medication</strong></th>
                              <th class="td_class"><strong>Diagnosis</strong></th>
                              <th class="td_class"><strong>Timings</strong></th>
                              <th class="td_class"><strong>Start Date</strong></th>
                            </tr>
                            @if(count($request_medications)>0)
                              @foreach($request_medications as $request_med)
                                <tr>
                                  <td class="td_class">{{ $request_med->medication_name }}</td>
                                  <td class="td_class">{{ $request_med->diagnosis }}</td>
                                  <td class="td_class">{{ ucwords(str_replace(',',', ',$request_med->frequency)) }}</td>
                                  <td class="td_class">{{ date('d/m/Y', strtotime($request_med->start_date)) }}</td>
                                </tr>
                              @endforeach
                            @else
                              <tr><td colspan="4"><strong>No Medication found</strong></td></tr>
                            @endif
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- End Example Card Image overlays -->
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Prescriptions</b></div>
                        </div>
                        <div class="card-text mt-2">
                          @if(count($request_prescriptions)>0)
                            @foreach($request_prescriptions as $request_report)
                            <a href="javascript:void(0)" onclick="image_modal_popup('{{ URL::to("public/prescriptions") }}/{{ $request_report->file_path }}')"><img src="{{ URL::to('public/prescriptions') }}/{{ $request_report->file_path }}" class="fileimage_class"></a>
                            @endforeach
                          @else
                            <div style="text-align:center;"><h4>No prescriptions found</h4></div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Lab Reports</b></div>
                        </div>
                        <div class="card-text mt-2">
                          @if(count($request_lab_documents)>0)
                            @foreach($request_lab_documents as $request_report)
                              <a href="javascript:void(0)" onclick="image_modal_popup('{{ URL::to("public/labreports") }}/{{ $request_report->file_path }}')"><img src="{{ URL::to('public/labreports') }}/{{ $request_report->file_path }}" class="fileimage_class"></a>
                            @endforeach
                          @else
                            <div style="text-align:center;"><h4>No prescriptions found</h4></div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Example Card Image overlays -->
                </div>
                <div class="row mt-4">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Allergies</b></div>
                        </div>
                        <div class="card-text mt-2">
                          @if(count($request_allergies)>0)
                            @foreach($request_allergies as $request_allergy)
                            <h5 class="mb-1 text-left mt-0"><b>{{ $request_allergy->allergy_name }}</b></h5>
                            <p>{{ $request_allergy->allergy_description }}</p>
                            @endforeach
                          @else
                            <div style="text-align:center;"><h4>No allergies found</h4></div>
                          @endif                        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Medical Conditions</b></div>
                        </div>
                        <div class="card-text mt-2">
                          @if(count($request_medical_conditions)>0)
                            @foreach($request_medical_conditions as $request_medical_cond)
                            <h5 class="mb-1 text-left mt-0"><b>{{ $request_medical_cond->request_medical_condition }}</b></h5>
                            <p>{{ $request_medical_cond->request_med_decription }}</p>
                            @endforeach
                          @else
                            <div style="text-align:center;"><h4>No allergies found</h4></div>
                          @endif    
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Example Card Image overlays -->
                </div>
                <div class="form-group row mt-4">
                  <div class="col-sm-5"></div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" onclick="update_request('Accept','{{ $request_id }}');">Accept</button>
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-danger" onclick="update_request('Reject','{{ $request_id }}');">Reject</button>
                  </div>
                  <div class="col-sm-5"></div>
                </div>
              </div>
            </div>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="background: none !important;">
        <div id="popup_image"></div>
        <div class="modal-footer" style="-webkit-justify-content:flex-start;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
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

  function update_request(action, request_id){
    var post_url = "{{URL::to('/updateRequest')}}?request_id="+request_id+"&action="+action;
    var message = 'Are you sure you want to '+action+' this Request?';
    if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
          if(action=='Accept'){
            alert("Congratulations you have successfully accepted this request and is allocated to you");
          } else {
            alert("Request rejected successfully");
          }
          if(action=='Reject'){
            window.location.href="{{ URL::to('/phamacistDashboard') }}";
          } else {
            window.location.href="{{ URL::to('/pharmacistRequests') }}";
          }
         }
      });
   } else {
      return false;
   }
  }

  function image_modal_popup(image_path){
    $('#popup_image').html('<img src="'+image_path+'" style="height:350px;">');
    $('#exampleModalCenter').modal('show');
  }


  </script>
@endsection