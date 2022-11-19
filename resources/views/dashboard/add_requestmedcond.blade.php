@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
        
      <!-- <p style="color: #232e74;border-bottom: 2px solid orange; color:#00aaca;float: right;"><b>Skip To Next</b></p><br><br> -->
      <div class="d-flex justify-content-between">
        <div><h4 style="color: #232e74;padding-left:38px;"><strong>Medical Conditions</strong></h4></div>
        <div><button type="button" onclick="add_medcond()" class="btn btn-primary rounded-pill" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;">+Add Medical Condition</button></div>
      </div>
      <div class="row" style="padding:15px;margin-left: 10px;">
        @if(count($request_medconds)>0)
            @foreach($request_medconds as $request_med)
              <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
                <div class="noti_card" style="border:1px solid #00aaca">
                  <div class="noti_card-body">
                    <div class="d-flex align-items-start justify-content-between">
                      <div vailgn="middle">
                        <img src="{{ URL::to('public/dashboardassets/assets/images/head.jpg') }}" style="width:100px;">
                      </div>
                      <div>
                        <h5 class="mb-1 text-left mt-0"><b>{{ $request_med->request_medical_condition }}</b></h5>
                        <p>{{ $request_med->request_med_decription }}</p>
                        <p style="float: right;color: #dfdfdf;">{{ date('d/m/Y h:i A', strtotime($request_med->created_date)) }}</p>
                      </div>
                      <div class="d-flex align-items-start" style="text-align: right;margin:0px;color: #c52d2d;vertical-align: top;">
                        <a href="javascript:void(0)" onclick="delete_medcond('{{ $request_med->request_medical_cond_id }}');"><i class="fa-solid fa-trash"></i></a>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        @else
          <div style="text-align:center;"><h4>No medical conditions found</h4></div>
        @endif
      </div>
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-md-12">
            <div class="text-center">
              <a href="{{ URL::to('/add_requestallergies') }}?vir_request_id={{ $vir_request_id }}" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #b1b8bb;border: 1px solid #b1b8bb;width: 230px;">Back</a>
              <a href="{{ URL::to('/add_labreports') }}?vir_request_id={{ $vir_request_id }}" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Save and Continue</a>
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
                <div class="col-sm-4">
                  <label>Medical Condition<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="request_medical_condition" id="request_medical_condition" class="form-control">   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Medical Condition Description <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <textarea class="form-control" id="request_med_decription" rows="3" name="request_med_decription"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12" style="float: left; width: 100%; text-align: center" >
                  <button type="button" class="btn btn-primary" id="saveMeds" onclick="saveRequestMedcond();">Submit</button>
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
  function saveRequestMedcond(){
    var formData = new FormData();
    formData = new FormData($('#medication_form')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveRequestMedcond')}}";
    var request_medical_condition = $('#request_medical_condition').val();
    var request_med_decription = $('#request_med_decription').val();
    if(request_medical_condition==''){
      alert("Please enter medical condition");
      return false;
    }
    if(request_med_decription==''){
      alert("Please enter medical condition description");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Medical Condition added successfully");
          window.location.href="{{ URL::to('/add_requestmedcond') }}?vir_request_id="+result;
        }
    });
  }

  function add_medcond(){ 
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
  </script>
@endsection