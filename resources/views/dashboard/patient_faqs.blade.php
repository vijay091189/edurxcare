@extends('dashboard/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/flatpickr.min.css') }}">
<div class="page">
    <div class="page-content container-fluid">
      <h4 style="color: #232e74;padding-left:38px;"><strong>Frequently Asked Questions</strong></h4>
      <div class="row" style="padding:15px;margin-left: 10px;">
      @if(count($details)>0)
          @foreach($details as $deta)
            <div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
              <div class="noti_card">
                <div class="noti_card-body">
                  <h5>{{ $deta->question }}</h5>
                  <h6>{{ $deta->answer }}</h6>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align:center;"><h4>No FAQs found</h4></div>
        @endif
      </div>
    </div>
  </div>
@endsection