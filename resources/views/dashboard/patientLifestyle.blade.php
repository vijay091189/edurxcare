@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Life Style')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<style type="text/css">
body {
  background: url({{ URL::to('public/frontendassets/images/life.png') }});
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
      <h4 style="color: #232e74;padding-left:38px; margin-top: 30px;"><strong>My Life Style</strong></h4>
      <div class="row" style="padding:15px;margin-left: 10px;">
        <div class="col-lg-7 col-md-6 col-sm-12 mt-2">
          <form name="lifestyle_questions" id="lifestyle_questions" method="post">
            @foreach($questions as $quest)
              <div class="form-group">
                <h5>{{ $quest->question }}</h5>
                <label><input type="radio" id="question_{{ $quest->question_id }}_a" name="question_{{ $quest->question_id }}" value="Yes"> <strong>Yes</strong></label>
                <label><input type="radio" id="question_{{ $quest->question_id }}_b" name="question_{{ $quest->question_id }}" value="No"> <strong>No</strong></label>
              </div>
            @endforeach
             <div class="text-center dh-none">
                <button type="button" onclick="submit_answers();" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Submit</button>
                <!-- <button type="button" onclick="skip_dashboard();" class="btn btn-primary text-center ml-auto mr-auto" style="border-radius: 10px;background-color: #00aaca;border: 1px solid #00aaca;width: 230px;">Skip for now</button> -->
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/flatpickr.js') }}"></script>
  <script type="text/javascript">
  function submit_answers(){
    var formData = new FormData();
    formData = new FormData($('#lifestyle_questions')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveLifestyleAnswers')}}";
    var message = 'Are you sure you want to submit your answers?';
    if (confirm(message)) {    
      $.ajax({
          type : "POST",
          url : post_url,
          data : formData,
          contentType: false,
          processData: false,
          success : function(result){	
            alert("Life style answers submitted successfully");
            window.location.href="{{URL::to('/patientDashboard')}}";
          }
      });
    }
  }
  </script>
@endsection