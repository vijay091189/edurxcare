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
                  <div class="text-center" style="color:#00aaca;font-weight: bold;font-size: 19px;margin-bottom: 20px;">Welcome Back</div>
                  <form action="#" method="post" name="check_login" id="check_login">
                    <div class="row">
                      <div class="mb-4">
                        <input type="text" class="form-control" placeholder="Email ID or Mobile Number" id="username" name="username">
                      </div>
                      <div class="form-group">
                        <div class="input-group" id="show_hide_password">
                          <input class="form-control" id="userpassword" type="password" placeholder="Password" name="userpassword">
                          <div class="input-group-addon" style="background:#ced4da;">
                            <a href=""><i class="fa fa-eye-slash p-2" style="background:#ced4da;" id="text" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mt-1">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1" style="color:#000">Remember me</label>
                        </div>
                        <a href="#">Forgot Password?</a>
                      </div>
                      <div >
                        <a onclick="checkuserlogin();" class="nav-link btn btn-primary" href="#" style="color:#fff;margin-top: 40px;border-radius: 10px;" width="100%" >Login</a>
                      </div>
                    </div>
                  </form>
                  <p class="text-center" style="color: #000;margin-top: 30px;">Don't have an account? <a href="signup.php" style="color: #00aaca;">Sign Up</a></p>
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
    function checkuserlogin(){
      var formData = new FormData();
      formData = new FormData($('#check_login')[0]);
      formData.append( "_token", '{{csrf_token()}}' ); 
      var post_url = "{{URL::to('/checkUserLogin')}}";
      var username = $('#username').val();
      var userpassword = $('#userpassword').val();
      if(username==''){
        alert("Please enter username");
        return false;
      }
      if(userpassword==''){
        alert("Please enter password");
        return false;
      }
      $.ajax({
          type : "POST",
          url : post_url,
          data : formData,
          contentType: false,
          processData: false,
          success : function(result){	
              if(result=='invalid'){
                alert("Invalid username or password");
              } else {
                if(result==2){
                  window.location.href="{{URL::to('/patientDashboard')}}";
                } else {
                  window.location.href="{{URL::to('/phamacistDashboard')}}";
                }
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