@extends('frontend/layout.app')
@section('title', 'Edurxcare - Home')
@section('content')
	
<div id="content" class="no-bottom no-top">
      <div id="top"></div>
      <!-- section begin -->
      <section id="section-intro" class="full-height jarallax relative owl-slide-wrapper text-light no-top no-bottom">
        <img src="{{ URL::to('public/frontendassets/images/white_pill.png') }}" class="jarallax-img" alt="">
        <div class="overlay-bg t50">
          <div class="center-y relative">
            <div class="container">
              <div class="row">
                <div class="big text-center" style="color: #00aaca;">Category</div>
                <div class="small-xs text-center pt-1 mb-5">Please select one category before you Signup</div>
                <div class="col-md-3 col-sm-12">

                </div>
                <div class="col-md-3 col-sm-12">
                  <a href="{{ URL::to('/signupForm?type=patient') }}">
                    <div class="card mtd-10" style="width: 15rem;border: 0px;">
                      <img class="image_check" src="{{ URL::to('public/frontendassets/images/patient.png') }}" alt="Card image cap" style="">
                    </div>
                  </a>
                </div>
                

                <div class="col-md-3 col-sm-12">
                  <a href="{{ URL::to('/signupForm?type=pharmacist') }}">
                    <div class="card mtd-10" style="width: 15rem; border:0px;">
                      <img class="image_check" src="{{ URL::to('public/frontendassets/images/pharmacist.png') }}" alt="Card image cap" style="">
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-12"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- section close -->
    </div>
@endsection