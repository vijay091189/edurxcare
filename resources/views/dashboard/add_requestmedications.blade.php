@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
      <div class="d-flex justify-content-between">
        <h4 style="color: #232e74;padding-left:38px;"><strong>Add Medicine</strong></h4>
        <a onclick="add_medication()" href="javascript:void(0)" class="btn btn-primary rounded-pill" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;">+Add Medicine</a>
      </div>
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-lg-4 col-md-6 col-sm-12 mt-2">
          <div class="noti_card" style="border:1px solid #00aaca">
            <div class="noti_card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div vailgn="middle" style="vertical-align: middle;margin-right: 10px;padding-top: 10%;"><img src="{{ URL::to('public/dashboardassets/assets/images/tablet.jpg') }}" width="50px"></div>
                <div>
                  <h5 class="mb-1 text-center mt-0"><b>Crosin - 5mg</b></h5>
                  <p class="mb-1">Timings: Morning, Evening, Night</p>
                  <p class="mb-1">Duration: From Since 1month</p>
                </div>
                <div class="d-flex align-items-start" style="text-align: right;margin:0px;color: #c52d2d;vertical-align: top;"><i class="fa-solid fa-trash"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-md-12">
            <div class="text-center"><button type="submit" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Save and Continue</button></div>
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
                  <label>Disagnosis <span class="text-danger">*</span></label>
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
    formData = new FormData($('#new_request_comments')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveNewRequest')}}";
    var request_comments = $('#request_comments').val();
    if(request_comments==''){
      alert("Please add comments");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          window.location.href="{{ URL::to('/add_requestmedications') }}?vir_request_id="+result;
        }
    });
  }

  function add_medication(){ 
    $('#exampleModalSizeLg').modal();
  }
  </script>
@endsection