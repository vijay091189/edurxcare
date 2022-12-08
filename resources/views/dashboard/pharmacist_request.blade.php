@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<div class="page">
    <div class="page-content container-fluid">
    <h4 style="color: #232e74;padding-left:38px;"><strong>My Requests</strong></h4>
      <div class="row" style="padding:15px; margin-left: 6px;">
        <div class="col-lg-4 col-md-4">
          <select name="filter" id="filter" class="form-control" onchange="get_filter_appointments(this.value)">   
            <option <?php if($filter=='accepted'){ echo 'selected="selected"';} ?> value="accepted">Pending</option>
            <option <?php if($filter=='completed'){ echo 'selected="selected"';} ?> value="completed">Completed</option>
          </select>
        </div>
      </div>
      <div class="row" style="padding:15px;">
      @if(count($patient_requests)>0)
        @foreach($patient_requests as $patient_req)
          <div class="col-lg-6 col-md-6">
            <div class="card" style="">
              <div class="card-body">
                <h5 class="card-title">Date : {{ date('d-m-Y', strtotime($patient_req->created_date)) }}</h5>
                <div class="card-text">
                  <table>
                    <tr>
                      <td style="padding-right: 3px;"><b>Patient Name</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $patient_req->patient_name }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Patient ID</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $patient_req->unique_id }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Comments</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $patient_req->comments }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Status</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>Pending</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Last Update</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ date('d-m-Y h:i A', strtotime($patient_req->modified_date)) }}</td>
                    </tr>
                    
                  </table>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-2">
                      <button type="button" class="btn btn-default" onclick="update_request('Response','{{ $patient_req->request_id }}');">Add Response</button>
                    </div>
                    <div class="col-sm-6"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach 
      @else
        <div class="col-lg-12 col-md-12"><h4>No requests found</h4></div>
      @endif
      </div>
    </div>
  </div>
  <script type="text/javascript">
  function get_filter_appointments(filter){
    window.location.href="{{ URL::to('/pharmacistRequests') }}?filter="+filter;
  }

  function update_request(action, request_id){
    if(action=='Response'){
      window.location.href="{{ URL::to('/responseRequest') }}?request_id="+request_id;
    } else {
      window.location.href="{{ URL::to('/pharmacistRequests') }}?filter="+filter;
    }
  }
  </script>
@endsection