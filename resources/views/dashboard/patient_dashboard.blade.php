@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<div class="page">
    <div class="page-content container-fluid">
    <h4 style="color: #232e74;padding-left:38px;"><strong>My Requests</strong></h4>
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
                      <td colspan="2"></td>
                      <td>{{ $patient_req->comments }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Status</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ $patient_req->status }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Last Update</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>{{ date('d-m-Y h:i A', strtotime($patient_req->modified_date)) }}</td>
                    </tr>
                    <tr>
                      <td style="padding-right: 3px;"><b>Pharmacist Name</b></td>
                      <td style="padding-right: 3px;">:</td>
                      <td>--</td>
                    </tr>
                  </table>
                </div>
                <div class="card-footer">
                  <a href="{{ URL::to('/viewRequestResponse') }}?request_id={{ $patient_req->request_id }}" style="cursor: pointer; color: #000;">
                    View Response
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
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <img src="assets/images/pres.png" width="350px">
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection