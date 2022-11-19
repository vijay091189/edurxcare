@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Edit profile')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
    <h4 style="color: #232e74;padding-left:38px;"><strong>Edit Profile</strong></h4>
      <div class="row" style="padding:15px;">
          <form action="#" id="signup_form" name="signup_form" method="post">
            <div class="row">
              <div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control" placeholder="Name" id="full_name" name="full_name" value="{{ $user_details[0]->name }}">
              </div>
              <div class="form-group col-md-6 mb-4">
                <select class="form-control" id="gender" name="gender">
                  <option value="">-Select Gender-</option>
                  <option <?php if($user_details[0]->gender=='male'){echo 'selected="selected"';} ?> value="male">Male</option>
                  <option <?php if($user_details[0]->gender=='female'){echo 'selected="selected"';} ?> value="female">Female</option>
                </select>
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control" placeholder="DOB" id="dob" name="dob" value="{{ $user_details[0]->dob }}">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="number" class="form-control" placeholder="Mobile Number" id="mobile" name="mobile" value="{{ $user_details[0]->mobile }}">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control" placeholder="Email-id" id="email_id" name="email_id" value="{{ $user_details[0]->email }}">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control" placeholder="Address" id="address" name="address" value="{{ $user_details[0]->address }}">
              </div>
              
              <div class="row" style="padding:15px;margin-left: 10px; width: 100%;text-align: center;">
                <div class="col-md-12">
                    <div class="text-center">
                      <a onclick="update_profile();" class="btn btn-primary text-center ml-auto mr-auto" style="color:#fff; border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Update</a>
                    </div>
                </div>
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
    $("#dob").flatpickr({
      altInput: true,
      altFormat: "d/m/Y",
      dateFormat: "Y-m-d"
    });
    function update_profile(){
      var formData = new FormData();
      formData = new FormData($('#signup_form')[0]);
      formData.append( "_token", '{{csrf_token()}}' ); 
      var post_url = "{{URL::to('/updatePatientProfile')}}";
      var full_name = $('#full_name').val();
      var gender = $('#gender').val();
      var dob = $('#dob').val();
      var mobile = $('#mobile').val();
      var email = $('#email_id').val();
      var address = $('#address').val();
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
      $.ajax({
          type : "POST",
          url : post_url,
          data : formData,
          contentType: false,
          processData: false,
          success : function(result){	
              alert("Profile updated successfully");
              window.location.href="{{URL::to('/patientDashboard')}}";
          }
      });
  }
  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
</script>
@endsection