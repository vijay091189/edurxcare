@extends('frontend/layout.app')
@section('title', 'Edurxcare - Home')
@section('content')
<style type="text/css">
  .forgotpwd_text{
    color: #555 !important;
  }
</style>
<div id="content" class="no-bottom no-top">
      <div id="top"></div>
      <!-- section begin -->
      <section id="section-intro-login" class="full-height jarallax relative owl-slide-wrapper text-light no-top no-bottom">
        <img src="{{ URL::to('public/frontendassets/images/white_pill.png') }}" class="jarallax-img" alt="">
        <div class="overlay-bg t50">
          <div class="center-y relative">
            <div class="container">
              <div class="row">
                <div class="col-md-4 col-sm-12"></div>
                <div class="col-md-4 col-sm-12">
                  <div class="text-center" style="color:#00aaca;font-weight: bold;font-size: 19px;margin-bottom: 20px;">Forgot Password</div>
                  <form action="#" method="post" name="check_login" id="check_login">
                    <div class="row">
                      <div class="mb-4">
                        <strong class="forgotpwd_text">Enter registered Email address</strong>
                        <input type="text" class="form-control" placeholder="Email ID" id="email_id" name="email_id">
                      </div>
                      <div class="mb-4">
                        <strong class="forgotpwd_text">OR</strong>
                      </div>
                      <div class="mb-4">
                        <strong class="forgotpwd_text">Enter registered Mobile Number</strong>
                        <input type="text" class="form-control" placeholder="Mobile Number" id="mobile" name="mobile">
                      </div>
                      <div >
                        <a onclick="checkForgotPassword();" class="nav-link btn btn-primary" href="#" style="color:#fff;margin-top: 40px;border-radius: 10px;" width="100%" >Send</a>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-4 col-sm-12"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- section close -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
      $('input').on('keypress keydown keyup',function(e){
        if (e.which == 13) {
          checkuserlogin();
        }
      });
    });
    function checkForgotPassword(){
      var formData = new FormData();
      formData = new FormData($('#check_login')[0]);
      formData.append( "_token", '{{csrf_token()}}' ); 
      var post_url = "{{URL::to('/checkForgotPassword')}}";
      var email_id = $('#email_id').val();
      var mobile = $('#mobile').val();
      if(email_id=='' && mobile==''){
        alert("Please enter Email ID or Mobile Number");
        return false;
      }
      if(email_id!='' && !validateEmail(email_id)) { 
        alert("Please enter valid Email ID");
        return false;
      }
      if(mobile!='' && (isNaN(mobile) || mobile.length!=10)){
        alert("Please enter valid mobile number");
        return false;
      }
      $.ajax({
          type : "POST",
          url : post_url,
          data : formData,
          dataType : "JSON",
          contentType: false,
          processData: false,
          success : function(result){	
              if(result.user_id==''){
                alert("Invalid Email ID or Mobile Number");
              } else {
                alert("Security Pin sent to Email ID and Mobile Number");
                window.location.href="{{URL::to('/verifyForgotpin')}}?user_id="+result.user_id;
              }
          }
      });
  }
  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
</script>
@endsection