@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<style type="text/css">
  .textarea_response{
    border: 0;
  }
</style>
  <div class="page">
    <div class="page-content container-fluid">
      <div class="d-flex justify-content-between">
        <h4 style="color: #232e74;padding-left:38px;"><strong>Add Response {{ isset($patient_requests[0])?' : '.$patient_requests[0]->unique_id:'' }}</strong></h4>
      </div>
      <form id="save_response" id="save_response" method="post">
        <input type="hidden" id="request_id" name="request_id" value="{{ $request_id }}">
        <div class="row" style="padding-top:30px; padding-left: 30px;">
          <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Use</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="usage" rows="3" name="usage" placeholder="Please enter usage">{{ isset($patient_requests[0])?$patient_requests[0]->usage:'' }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
                <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Directions</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="directions" rows="3" name="directions" placeholder="Please enter Directions">{{ isset($patient_requests[0])?$patient_requests[0]->directions:'' }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="padding-top:0px; padding-left: 30px;">
          <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Side Effects</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="side_effects" rows="3" name="side_effects" placeholder="Please enter Side Effects">{{ isset($patient_requests[0])?$patient_requests[0]->side_effects:'' }}</textarea>
                  </div>              
                </div>
              </div>
            </div>
          </div>
                <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Managing Side Effects</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="manage_side_effects" rows="3" name="manage_side_effects" placeholder="Please enter Managing Side Effects">{{ isset($patient_requests[0])?$patient_requests[0]->manage_side_effects:'' }}</textarea>
                  </div>              
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="padding-top:0px; padding-left: 30px;">
          <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Self Care Measures</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="self_care_measure" rows="3" name="self_care_measure" placeholder="Please enter Self Care Measures">{{ isset($patient_requests[0])?$patient_requests[0]->self_care_measure:'' }}</textarea>
                  </div>              
                </div>
              </div>
            </div>
          </div>
                <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Drug Interactions</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="drug_interactions" rows="3" name="drug_interactions" placeholder="Please enter Drug Interactions">{{ isset($patient_requests[0])?$patient_requests[0]->drug_interactions:'' }}</textarea>
                  </div>              
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="padding-top:0px; padding-left: 30px;">
          <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Follow up with pharmacist/physcian</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="follow_up_comments" rows="3" name="follow_up_comments" placeholder="Please enter follow up details">{{ isset($patient_requests[0])?$patient_requests[0]->follow_up_comments:'' }}</textarea>
                  </div>              
                </div>
              </div>
            </div>
          </div>
                <div class="col-lg-6 col-md-6">
            <div class="card m-0" style="">
              <div class="card-body">
                <h5 class="card-title"><strong>Additional Comments</strong></h5>
                <div class="card-text p-8">
                  <div class="form-group">
                    <textarea class="form-control textarea_response" id="response_comments" rows="3" name="response_comments" placeholder="Please enter Additional Comments">{{ isset($patient_requests[0])?$patient_requests[0]->response_comments:'' }}</textarea>
                  </div>              
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row mt-4">
          <div class="col-sm-5"></div>
          <div class="col-sm-1">
            <button type="button" class="btn btn-primary" onclick="update_response();">Save</button>
          </div>
          <div class="col-sm-1">
            <a href="{{URL::to('/pharmacistRequests')}}" class="btn btn-danger">Cancel</a>
          </div>
          <div class="col-sm-5"></div>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
   
  function update_response(){
    var formData = new FormData();
    formData = new FormData($('#save_response')[0]);
    formData.append( "_token", '{{csrf_token()}}' ); 
    var post_url = "{{URL::to('/saveResponse')}}";
    var usage = $('#usage').val();
    var directions = $('#directions').val();
    var side_effects = $('#side_effects').val();
    var manage_side_effects = $('#manage_side_effects').val();
    var self_care_measure = $('#self_care_measure').val();
    var drug_interactions = $('#drug_interactions').val();
    var follow_up_comments = $('#follow_up_comments').val();
    var response_comments = $('#response_comments').val();
    if(usage=='' && directions=='' && side_effects=='' && manage_side_effects=='' && 
       self_care_measure=='' && drug_interactions=='' && follow_up_comments=='' && response_comments==''){
      alert("Please enter some response");
      return false;
    }
    $.ajax({
        type : "POST",
        url : post_url,
        data : formData,
        contentType: false,
        processData: false,
        success : function(result){	
          alert("Response submitted successfully");
          window.location.href="{{ URL::to('/pharmacistRequests') }}";
        }
    });
  }
  </script>
@endsection