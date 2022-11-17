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
                  <div class="text-center" style="color:#00aaca;font-weight: bold;font-size: 19px;margin-bottom: 20px;">Enter Verification Code</div>
                  <form action="#" method="post" name="check_login" id="check_login">
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">
                    <div class="row">
                      <div class="col-2"></div>
                      <div class="col-2">
                        <input type="text" class="form-control inputs" id="pin_1" name="pin_1" maxlength="1">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control inputs" id="pin_2" name="pin_2" maxlength="1">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control inputs" id="pin_3" name="pin_3" maxlength="1">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control inputs" id="pin_4" name="pin_4" maxlength="1">
                      </div>
                      <div class="col-2"></div>
                      <div>
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
    //$(document).ready( function () {
      // $('#pin_1').on('keypress keydown keyup',function(e){
      //   $('#pin_2').focus();
      // });
      // $('#pin_2').on('keypress keydown keyup',function(e){
      //   $('#pin_3').focus();
      // });
      // $('#pin_3').on('keypress keydown keyup',function(e){
      //   $('#pin_4').focus();
      // });
      $("#pin_1").keyup(function () {
        $('#pin_2').focus();
      });
      $("#pin_2").keyup(function () {
        $('#pin_3').focus();
      });
      $("#pin_3").keyup(function () {
        $('#pin_4').focus();
      });
    //});
    function checkForgotPassword(){
      var formData = new FormData();
      formData = new FormData($('#check_login')[0]);
      formData.append( "_token", '{{csrf_token()}}' ); 
      var post_url = "{{URL::to('/saveForgotpin')}}";
      var pin_1 = $('#pin_1').val();
      var pin_2 = $('#pin_2').val();
      var pin_3 = $('#pin_3').val();
      var pin_4 = $('#pin_4').val();
      if(pin_1=='' || pin_2=='' || pin_3=='' || pin_4==''){
        alert("Please enter verification code");
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
              if(result=='invalid'){
                alert("Invalid user verification code. Please try again");
              } else {
                alert("Security Pin verified successfully");
                window.location.href="{{URL::to('/userSetPassword')}}?user_id="+result;
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