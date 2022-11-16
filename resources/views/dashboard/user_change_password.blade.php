@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Edit profile')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid" style="text-align: center;">
    <h4 style="color: #232e74;padding-left:38px;"><strong>Change Password</strong></h4>
      <div class="row" style="padding:15px;text-align: center;">
          <form action="#" id="signup_form" name="signup_form" method="post" style="width: 100%">
            <div class="row">
              <div class="form-group col-md-3 mb-4"></div>
              <div class="form-group col-md-6 mb-4">
                <input type="password" class="form-control" placeholder="Current Password" id="old_password" name="old_password">
              </div>
              <div class="form-group col-md-3 mb-4"></div>
            </div>
            <div class="row">
              <div class="form-group col-md-3 mb-4"></div>
              <div class="form-group col-md-6 mb-4">
                <input type="password" class="form-control" placeholder="New Password" id="new_password" name="new_password">
              </div>
              <div class="form-group col-md-3 mb-4"></div>
            </div>
            <div class="row">
              <div class="form-group col-md-3 mb-4"></div>
              <div class="form-group col-md-6 mb-4">
                <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" name="confirm_password">
              </div>
              <div class="form-group col-md-3 mb-4"></div>
            </div> 
            <div class="row" style="padding:15px;margin-left: 10px; width: 100%;">
              <div class="col-md-12">
                  <div>
                    <a onclick="update_profile();" class="btn btn-primary text-center ml-auto mr-auto" style="color:#fff; border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Update</a>
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
    var post_url = "{{URL::to('/userUpdatePassword')}}";
   
    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var confirm_password = $('#confirm_password').val();
    if(old_password==''){
      alert("Please enter Current password");
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
          if(result=='success'){
            alert("Password updated successfully");
            location.reload();
          } else {
              alert("Invalid current password. Please try again");
              return false;
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