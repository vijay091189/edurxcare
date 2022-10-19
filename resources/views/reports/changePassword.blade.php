@extends('reports/layout.app')
@section('title', 'Ezglam - Change Password')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="container-fluid">

            <!-- Header Starts -->
            <div class="row">
               <div class="col-sm-12 p-0">
                  <div class="main-header">
                     <h4>Change Password</h4>
                  </div>
               </div>
            </div>
            <!-- Header end -->

            <!-- Tables start -->
            <!-- Row start -->
            <div class="row">
               
               <div class="col-sm-12">
                  <!-- Basic Table starts -->
                  <div class="card">
                     <div class="card-block">
                        <form action="#" method="post" name="add_partner_form" id="add_partner_form">
                           <div class="form-group row">
                              <div class="col-sm-3">
                                 <label>Current Password <span class="text-danger">*</span></label>
                              </div>
                              <div class="col-sm-6">
                                 <input type="password" name="current_password" id="current_password" class="form-control">   
                              </div>
                           </div>
                           
                           <div class="form-group row">
                              <div class="col-sm-3">
                                 <label>New Password <span class="text-danger">*</span></label>
                              </div>
                              <div class="col-sm-6">
                                 <input type="password" name="new_password" id="new_password" class="form-control">     
                              </div>
                           </div>

                           <div class="form-group row">
                              <div class="col-sm-3">
                                 <label>Confirm Password <span class="text-danger">*</span></label>
                              </div>
                              <div class="col-sm-6">
                                 <input type="password" name="confirm_password" id="confirm_password" class="form-control">      
                              </div>
                           </div>
                           
                           <div class="form-group row">
                              <div class="col-sm-12" style="float: left; width: 100%; text-align: center" >
                                 <button type="button" class="btn btn-primary" id="saveMeds" onclick="checkChangePassword();">Submit</button>
                                 @if($role_id==1){
                                    <a href="{{ URL::to('/admindashboard')}}" class="btn btn-danger">Cancel</a>
                                 @else
                                    <a href="{{ URL::to('/distributordashboard')}}" class="btn btn-danger">Cancel</a>
                                 @endif
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Row end -->
            <!-- Tables end -->
         </div>

         <!-- Container-fluid ends -->
      </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/flatpickr.js') }}"></script>
<script type="text/javascript">

function checkChangePassword(){
   var post_url = "{{URL::to('/saveChangePassword')}}";
   var current_password = $('#current_password').val();
   var new_password = $('#new_password').val();
   var confirm_password = $('#confirm_password').val();
   if(current_password==''){
      alert("Please enter current password");
      return false;
   }
   if(new_password==''){
      alert("Please enter new password");
      return false;
   }
   if(confirm_password==''){
      alert("Please enter confirm password");
      return false;
   }
   if(new_password!=confirm_password){
      alert("New password and Confirm password should be same");
      return false;
   }
   $.ajax({
      type : "POST",
      url : post_url,
      data : {"current_password":current_password,"new_password":new_password,"confirm_password":confirm_password,'_token': '{{ csrf_token() }}'},
      success : function(result){	
         if(result=='success'){
            alert("Password updated successfully");
            <?php 
            if($role_id==1){ ?>
               window.location.href="{{URL::to('/admindashboard')}}";
            <?php } else { ?>
               window.location.href="{{URL::to('/distributordashboard')}}";
            <?php } ?>
           // location.reload(true);
         } else {
            alert("Invalid current password. Please try again");
            return false;
         }
      }
   });
}
</script>
@endsection