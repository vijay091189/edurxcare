@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<style type="text/css">
  .uploaded_images{
    border: 3px solid #ccc;
    border-radius: 10px;
    height: 250px;
    width: 200px;
  }
</style>
<div class="page">
  <div class="page-content container-fluid">
    <h5 style="color: #232e74;color:#00aaca;float: right;"><button type="button" onclick="add_labreport()" class="btn btn-primary rounded-pill" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;">+Add Lab Report</button></h5>
    <h5 style="color: #232e74;padding-left:38px;"><strong>Upload Lab Reports&nbsp;<i class="fa fa-info-circle score_info" data-toggle="tooltip" title="" data-original-title="If any Lab reports or medical test documents"></i></strong></h5>
    <div class="row" style="padding:15px;margin-left: 10px;">
    @if(count($request_reports)>0)
      @foreach($request_reports as $request_report)
        <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
          <img src="{{ URL::to('public/labreports') }}/{{ $request_report->file_path }}" class="uploaded_images">
          <div style="text-align:center;">
            <button type="button" onclick="delete_labreport('{{ $request_report->request_lab_docs_id }}')" 
              class="btn btn-danger rounded-pill" style="border-radius: 10px;background-color: #ff4c52;border: 1px solid #ff4c52;padding: 0.1rem 1rem;">Delete</button>
          </div>
        </div>
      @endforeach
    @else
      <div style="text-align:center;"><h4>No lab reports found</h4></div>
    @endif
    </div>
    <div class="row" style="padding:15px;margin-left: 10px;">
      <div class="col-md-12">
          <div class="text-center">
            <a href="{{ URL::to('/add_requestmedcond') }}?vir_request_id={{ $vir_request_id }}" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #b1b8bb;border: 1px solid #b1b8bb;width: 230px;">Back</a>
            <a href="{{ URL::to('/add_prescriptions') }}?vir_request_id={{ $vir_request_id }}" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Save and Continue</a>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Lab Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
          </button>
      </div>
      <div class="modal-body">
          <form action="#" method="post" name="medication_form" id="medication_form">
            <input type="hidden" name="vir_request_id" id="vir_request_id" value="{{ $vir_request_id }}">
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Upload Report<span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-6">
                  <input type="file" name="lab_report" id="lab_report" class="form-control" accept="image/*">  
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12" style="float: left; width: 100%; text-align: center" >
                  <button type="button" class="btn btn-primary" id="saveMeds" onclick="saveLabReport();">Submit</button>
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
  function saveLabReport(){
    var formData = new FormData();
    formData = new FormData($('#medication_form')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveLabReports')}}";
    if(document.getElementById("lab_report").files.length == 0 ){
      alert("Please upload Lab Report");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Lab report added successfully");
          window.location.href="{{ URL::to('/add_labreports') }}?vir_request_id="+result;
        }
    });
  }

  function add_labreport(){ 
    $('#exampleModalSizeLg').modal();
  }

  function delete_labreport(report_id){
    var post_url = "{{URL::to('/deleteLabReport')}}?report_id="+report_id;
    var message = 'Are you sure you want to delete this Lab Report?';
    if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Lab Report deleted successfully");
            location.reload();
         }
      });
   } else {
      return false;
   }
  }
  </script>
@endsection