@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<div class="page">
    <div class="container-fluid">
      <h4 style="color: #232e74;padding-left:38px; margin-top: 30px;"><strong>New Request</strong></h4>
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-lg-12 col-md-6 col-sm-12 mt-2">
          <form id="new_request_comments" name="new_request_comments" method="post">
            <div class="form-group">
              <textarea class="form-control" id="request_comments" rows="3" name="request_comments" placeholder="Please enter comments about reuqest"></textarea>
            </div>
            <div class="text-center dh-none">
              <button type="button" onclick="save_comments()" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Save & Continue</button>
            </div>
          </form>
        </div>
        
      </div>
     
   
    </div>
  </div>
  <script type="text/javascript">
  function save_comments(){
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
  </script>
@endsection