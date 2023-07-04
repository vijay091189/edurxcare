@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<div class="page">
    <div class="page-content container-fluid">
    <h4 style="color: #232e74;padding-left:38px;"><strong>New Requests</strong></h4>
      <div class="row" style="padding:15px;">
      @if(count($patient_requests)>0)
        @foreach($patient_requests as $patient_req)
          <div class="col-lg-6 col-md-6">
            <div class="card" style="">
              <div class="card-body">
                <h5 class="card-title">Date : {{ date('d-m-Y', strtotime($patient_req->created_date)) }}</h5>
                <div class="card-text">
                  <table>
                    <!-- <tr>
                      <td style="padding-right: 3px;"><b>Patient Name</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $patient_req->patient_name }}</td>
                    </tr> -->
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
                  <a href="{{ URL::to('/viewRequestDetails') }}?request_id={{ $patient_req->request_id }}" style="cursor: pointer; color: #000;">
                    View Details
                  </a>
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
@endsection