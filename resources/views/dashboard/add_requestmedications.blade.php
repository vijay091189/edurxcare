@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
      <div class="d-flex justify-content-between">
        <h4 style="color: #232e74;padding-left:38px;"><strong>Add Medicine</strong></h4>
        <button type="button" onclick="add_medication()" href="javascript:void(0)" class="btn btn-primary rounded-pill" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;">+Add Medicine</button>
      </div>
      <div class="row" style="padding:15px;margin-left: 10px;">
        @if(count($request_medications)>0)
          @foreach($request_medications as $request_med)
            <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
              <div class="noti_card" style="border:1px solid #00aaca">
                <div class="noti_card-body">
                  <div class="d-flex align-items-start justify-content-between">
                    <div vailgn="middle"><img src="{{ URL::to('public/dashboardassets/assets/images/tablet.jpg') }}" style="width:100px;"></div>
                    <div>
                      <h5 class="mb-1 mt-0"><b>{{ $request_med->medication_name }}</b></h5>
                      <p class="mb-1"><strong>Diagnosis:</strong> {{ $request_med->medication_name }}</p>
                      <p class="mb-1"><strong>Timings:</strong> {{ ucwords(str_replace(',',', ',$request_med->frequency)) }}</p>
                      <p class="mb-1"><strong>Start Date:</strong> {{ date('d/m/Y', strtotime($request_med->start_date)) }}</p>
                    </div>
                    <div class="d-flex align-items-start" style="text-align: right;margin:0px;color: #c52d2d;vertical-align: top;">
                        <a href="javascript:void(0)" onclick="delete_medication('{{ $request_med->request_medication_id }}');"><i class="fa-solid fa-trash"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align:center;"><h4>No medications found</h4></div>
        @endif
      </div>
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-md-12">
            <div class="text-center">
              <a href="{{ URL::to('/newRequest') }}?vir_request_id={{ $vir_request_id }}" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #b1b8bb;border: 1px solid #b1b8bb;width: 230px;">Back</a>
              <a href="{{ URL::to('/add_requestallergies') }}?vir_request_id={{ $vir_request_id }}" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Save and Continue</a>
            </div>
        </div>
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
            <input type="hidden" name="vir_request_id" id="vir_request_id" value="{{ $vir_request_id }}">
            <div class="form-group row">
                <div class="col-sm-3">
                  <label>Medication Name <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="medication_name" id="medication_name" class="form-control">   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                  <label>Diagnosis <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="diagnosis" id="diagnosis" class="form-control">   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                  <label>Times of Day <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-2">
                  <label><input type="checkbox" class="frequencies" name="frequency[]" id="frequency_m" value="morning"> Morning</label>
                </div>
                <div class="col-sm-2">
                  <label><input type="checkbox" class="frequencies" name="frequency[]" id="frequency_a" value="noon"> Noon</label>
                </div>
                <div class="col-sm-2">
                  <label><input type="checkbox" class="frequencies" name="frequency[]" id="frequency_e" value="evening"> Evening</label>
                </div>
                <div class="col-sm-2">
                  <label><input type="checkbox" class="frequencies" name="frequency[]" id="frequency_b" value="bedtime"> Bedtime</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                  <label>Start Date <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="start_date" name="start_date">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12" style="float: left; width: 100%; text-align: center" >
                  <button type="button" class="btn btn-primary" id="saveMeds" onclick="savemedication();">Submit</button>
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
    $("#start_date").flatpickr({
      altInput: true,
      altFormat: "d/m/Y",
      dateFormat: "Y-m-d"
    });
  function savemedication(){
    var formData = new FormData();
    formData = new FormData($('#medication_form')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveRequestMedication')}}";
    var medication_name = $('#medication_name').val();
    var diagnosis = $('#diagnosis').val();
    var start_date = $('#start_date').val();
    var frequency_times = $('input[class=frequencies]:checked').length;
    if(medication_name==''){
      alert("Please enter medication name");
      return false;
    }
    if(diagnosis==''){
      alert("Please enter diagnosis");
      return false;
    }
    if(frequency_times==0){
      alert("Please select times of day");
      return false;
    }
    if(start_date==''){
      alert("Please select medication start date");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Medication added successfully");
          window.location.href="{{ URL::to('/add_requestmedications') }}?vir_request_id="+result;
        }
    });
  }

  function add_medication(){ 
    $('#exampleModalSizeLg').modal();
  }

  function delete_medication(med_id){
    var post_url = "{{URL::to('/deleteRequestMedication')}}?med_id="+med_id;
    var message = 'Are you sure you want to delete this medication?';
    if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Medication deleted successfully");
            location.reload();
         }
      });
   } else {
      return false;
   }
  }
  </script>
@endsection