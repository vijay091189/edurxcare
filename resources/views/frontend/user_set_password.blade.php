@extends('frontend/layout.app')
@section('title', 'Edurxcare - Home')
@section('content')
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
                  <div class="text-center" style="color:#00aaca;font-weight: bold;font-size: 19px;margin-bottom: 20px;">Set New Password</div>
                  <form action="#" method="post" name="check_login" id="check_login">
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">
                    <div class="row">
                      <div class="mb-4">
                        <input type="password" class="form-control" placeholder="New Password" id="new_password" name="new_password">
                      </div>
                      <div class="mb-4">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                      </div>
                      <div >
                        <a onclick="update_profile();" class="nav-link btn btn-primary" href="#" style="color:#fff;margin-top: 40px;border-radius: 10px;" width="100%" >Login</a>
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
    function update_profile(){
      var formData = new FormData();
      formData = new FormData($('#check_login')[0]);
      formData.append( "_token", '{{csrf_token()}}' ); 
      var post_url = "{{URL::to('/updateNewPassword')}}";
      var new_password = $('#new_password').val();
      var confirm_password = $('#confirm_password').val();
      if(new_password==''){
        alert("Please enter new password");
        return false;
      }
      if(confirm_password==''){
        alert("Please confirm password");
        return false;
      }
      if(new_password!=confirm_password){
        alert("New password and confirm password should be same");
        return false;
      }
      $.ajax({
          type : "POST",
          url : post_url,
          data : formData,
          contentType: false,
          processData: false,
          success : function(result){	
            alert("Password updated successfully");
            window.location.href="{{ URL::to('/loginpage') }}";
          }
      });
    }
  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
</script>
@endsection