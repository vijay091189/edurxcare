@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
      <h4 style="color: #232e74;padding-left:38px;"><strong>Notifications</strong></h4>
      <h6 style="color: #232e74;padding-left:38px;"><strong>Your important notifications are shown here</strong></h6>
      <div class="row" style="padding:15px;margin-left: 10px;">
      @if(count($details)>0)
          @foreach($details as $deta)
            <div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
              <div class="noti_card">
                <div class="noti_card-body">
                  <h5>{{ $deta->notification }}</h5>
                </div>
                <div class="noti_footer">{{ date('d/m/Y h:i A', strtotime($deta->created_date)) }}</div>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align:center;"><h4>No notifications found</h4></div>
        @endif
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
  function saveRequestAllergy(){
    var formData = new FormData();
    formData = new FormData($('#medication_form')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveRequestAllergy')}}";
    var allergy_name = $('#allergy_name').val();
    var allergy_description = $('#allergy_description').val();
  
    if(allergy_name==''){
      alert("Please enter allergy name");
      return false;
    }
    if(allergy_description==''){
      alert("Please enter allergy description");
      return false;
    }
    
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Allergy added successfully");
          window.location.href="{{ URL::to('/add_requestallergies') }}?vir_request_id="+result;
        }
    });
  }

  function add_allergy(){ 
    $('#exampleModalSizeLg').modal();
  }

  function delete_allergy(allergy_id){
    var post_url = "{{URL::to('/deleteRequestAllergy')}}?allergy_id="+allergy_id;
    var message = 'Are you sure you want to delete this allergy?';
    if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Allergy deleted successfully");
            location.reload();
         }
      });
   } else {
      return false;
   }
  }
  </script>
@endsection