@extends('frontend/layout.app')
@section('title', 'Edurxcare - Signup')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div id="content" class="no-bottom no-top">
      <div id="top"></div>
      <!-- section begin -->
      <section id="section-intro-login" class="full-height jarallax relative owl-slide-wrapper text-light no-top no-bottom">
        <img src="{{ URL::to('public/frontendassets/images/white_pill.png') }}" class="jarallax-img" alt="">
        <div class="overlay-bg t50">
          <div class="center-y relative">
            <div class="container">
              <div class="row">
                <div class="col-md-1 col-sm-12"></div>
                <div class="col-md-10 col-sm-12">
                  <div class="text-center mt-5" style="color:#00aaca;font-weight: bold;font-size: 19px;margin-bottom: 20px;">Sign Up</div>
                  <form action="#" id="signup_form" name="signup_form" method="post">
                    <input type="hidden" value="{{ $type }}" name="reg_type" id="reg_type">
                    <div class="row">
                      <div class="form-group col-md-6 mb-4">
                        <input type="text" class="form-control" placeholder="Name" id="full_name" name="full_name">
                      </div>
                      <div class="form-group col-md-6 mb-4">
                        <select class="form-control" id="gender" name="gender">
                          <option value="">-Select Gender-</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 mb-4">
                        <input type="text" class="form-control" placeholder="DOB" id="dob" name="dob">
                      </div>
                      <div class="form-group col-md-6 mb-4">
                        <input type="number" class="form-control" placeholder="Mobile Number" id="mobile" name="mobile">
                      </div>
                      <div class="form-group col-md-6 mb-4">
                        <input type="text" class="form-control" placeholder="Email-id" id="email_id" name="email_id">
                      </div>
                      <div class="form-group col-md-6 mb-4">
                        <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                      </div>
                      <div class="col-md-6 form-group mb-4">
                        <div class="input-group" id="show_hide_password">
                          <input class="form-control" type="password" placeholder="Password" id="new_password" name="new_password">
                          <div class="input-group-addon" style="background:#ced4da;">
                            <a href="javascript:void(0)"><i class="fa fa-eye-slash p-2" style="background:#ced4da;" id="text" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 form-group mb-4">
                        <div class="input-group" id="show_hide_password">
                          <input class="form-control" type="password" placeholder="Confirm Password"  id="confirm_password" name="confirm_password">
                          <div class="input-group-addon" style="background:#ced4da;">
                            <a href="javascript:void(0)"><i class="fa fa-eye-slash p-2" style="background:#ced4da;" id="text" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-center" style="margin-top: 10px;">
                        <div class="form-check">
                          <input type="radio" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1" style="color:#000" id="gender" name="gender">I accept the Terms and Conditions</label>
                        </div>
                      </div>
                      <div class="text-center">
                        <a onclick="save_signup();" class="btn btn-primary pl-2 pr-2" style="color:#fff;margin-top: 10px;border-radius: 10px;width: 220px;">Sign Up</a>
                      </div>
                    </div>
                  </form>
                  <p class="text-center" style="color: #000;">Already have an account? <a href="{{ URL::to('/loginpage') }}" style="color: #00aaca;">Login</a></p>
                </div>
                <div class="col-md-1 col-sm-12"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- section close -->
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/flatpickr.js') }}"></script>

<script type="text/javascript">
    $("#dob").flatpickr({
      altInput: true,
      altFormat: "d/m/Y",
      dateFormat: "Y-m-d"
    });
  function save_signup(){
    var formData = new FormData();
    formData = new FormData($('#signup_form')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/registerUser')}}";
    var full_name = $('#full_name').val();
    var gender = $('#gender').val();
    var dob = $('#dob').val();
    var mobile = $('#mobile').val();
    var email = $('#email_id').val();
    var address = $('#address').val();
    var new_password = $('#new_password').val();
    var confirm_password = $('#confirm_password').val();
    if(full_name==''){
      alert("Please enter first name");
      return false;
    }
    if(gender==''){
      alert("Please select gender");
      return false;
    }
    if(dob==''){
      alert("Please select date of birth");
      return false;
    }
    if(mobile==''){
      alert("Please enter mobile number");
      return false;
    }
    if(isNaN(mobile) || mobile.length!=10){
      alert("Please enter valid mobile number");
      return false;
    }
    if(email==''){
      alert("Please enter Email ID");
      return false;
    }
    if(!validateEmail(email)) { 
      alert("Please enter valid Email ID");
      return false;
    }
    if(address==''){
      alert("Please enter address");
      return false;
    }
    if(new_password==''){
      alert("Please enter new password");
      return false;
    }
    if(confirm_password==''){
      alert("Please confirm password");
      return false;
    }
    if(new_password!=confirm_password){
      alert("Password and confirm password should be same");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
            alert("You have registered successfully");
            window.location.href="{{URL::to('/loginpage')}}";
        }
    });
  }
  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
</script>
@endsection