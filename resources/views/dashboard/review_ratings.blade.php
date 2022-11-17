@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Raview and Rating')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<style type="text/css">
body {
  background: url({{ URL::to('public/dashboardassets/assets/images/bg_rating.png') }});
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
    <div class="container-fluid">
      <h4 style="color: #232e74;padding-left:38px; margin-top: 30px;"><strong>Rating & Feedback</strong></h4>
      <h6 style="color: #232e74;padding-left:38px;"><strong>Please shareyour rating and feedback</strong></h6>
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-lg-7 col-md-6 col-sm-12 mt-2">
          <h6 style="color: #232e74;">Please select stars to share your rating to us</h6>
          <form name="review_rating" id="review_rating" method="post">
            <ul class="rate-area p-0">
              <input type="radio" id="5-star" name="rating" value="5" /><label for="5-star" title="Amazing">5 stars</label>
              <input type="radio" id="4-star" name="rating" value="4" /><label for="4-star" title="Good">4 stars</label>
              <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average">3 stars</label>
              <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good">2 stars</label>
              <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad">1 star</label>
            </ul>
            <div class="form-group">
              <input type="text" class="form-control" id="sugestions" name="sugestions" placeholder="Improvement, suggestions,bugs,etc...">
            </div>
            <div class="form-group">
              <textarea class="form-control" id="feedback" name="feedback" rows="3" placeholder="Please write feedback description here"></textarea>
            </div>
             <div class="text-center dh-none"><button type="button" onclick="submit_review();" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Submit</button></div>
          </form>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <img src="{{ URL::to('public/dashboardassets/assets/images/rating.png') }}" width="100%">
        </div>
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
  function submit_review(){
    var formData = new FormData();
    formData = new FormData($('#review_rating')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveReviewRating')}}";
    //var rating = $('#rating').val();
    var sugestions = $('#sugestions').val();
    var feedback = $('#feedback').val();
    if ($('input[name="rating"]:checked').length == 0) {
      alert("Please select rating");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Review submitted successfully");
          location.reload(true);
        }
    });
  }

  function add_medcond(){ 
    $('#exampleModalSizeLg').modal();
  }

  function delete_medcond(medcond_id){
    var post_url = "{{URL::to('/deleteRequestMedcond')}}?medcond_id="+medcond_id;
    var message = 'Are you sure you want to delete this Medical Condition?';
    if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Medical Condition deleted successfully");
            location.reload();
         }
      });
   } else {
      return false;
   }
  }
  </script>
@endsection