@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Refer A Friend')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<style type="text/css">
.input-group {
  margin: 20px auto;
  width: 100%;
  /*box-shadow: -1px 1px 20px 5px #e5dede;*/
  border-radius: 10px;
}
input.reffer {
  width:50%;
  /*height: 60px;*/
  border: 1px solid #dfdfdf;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  background: transparent;

}
button.btn {
  width: 30%;
  height: 40px;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}
body {
  background: url("{{ URL::to('public/dashboardassets/assets/images/bg_rating.png') }}");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  /*height: 100vh;*/
}
.page{
  background-color: transparent;
}

</style>
<div class="page">
    <div class="page-content container-fluid">
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-lg-1 col-md-3 col-sm-12"></div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-2" vailgn="middle">
          <h1 style="color: #232e74; margin-bottom: 10px;font-weight: 900;margin-top: 30px;">Refer to <br>Your Friends</h1>
          <div style="color: #232e74; margin-bottom: 10px;font-size:10px;line-height: 14px;">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>
          <form name="review_rating" id="review_rating" method="post">
             <form action="#">
              <div class="input-group">
                 <input class="reffer p-2" name="email_id" id="email_id" type="text" placeholder="Enter Your Friend email here" required>
                 <button onclick="invite_friend();" class="btn btn-info btn-lg" style="font-size: 15px;background: #f59513;color: #232e74;border:1px solid #f59513;" type="button">Invite</button>
              </div>
             </form>
          </form>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-center">
          <img src="{{ URL::to('public/dashboardassets/assets/images/reffer.png') }}" width="100%">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12"></div>
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
  function invite_friend(){
    var formData = new FormData();
    formData = new FormData($('#review_rating')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveReferFriend')}}";
    var email_id = $('#email_id').val();
    if(email_id==''){
      alert("Please enter Email ID");
      return false;
    }
    if(!validateEmail(email_id)) { 
      alert("Please enter valid Email ID");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Invitaion sent successfully");
          location.reload(true);
        }
    });
  }

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
  </script>
@endsection