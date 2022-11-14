@extends('frontend/layout.app')
@section('title', 'Edurxcare - Signup')
@section('content')
	
<div id="content" class="no-bottom no-top">
      <div id="top"></div>
      <!-- section begin -->
      <section id="section-blog">
        <div class="container-fluid">
          <div class="row mtp-50">
            <div class="col-md-12">
                 <a class="sign_in" href="{{ URL::to('/category') }}">Skip to Sign Up</a>
              <div id="blog-carousel" class="owl-carousel owl-theme">
                <div class="item">
                  <img src="{{ URL::to('public/frontendassets/images/sign1.png') }}" alt="images not found">
                 
                  <div class="cover">
                    <div class="container">
                      <div class="header-content">
                        <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-12"></div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="small">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                          </div>
                          <div class="col-md-3 col-sm-12"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               <div class="item">
                  <img src="{{ URL::to('public/frontendassets/images/banner2.png') }}" alt="images not found">
                 
                  <div class="cover">
                    <div class="container">
                      <div class="header-content">
                        <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-12"></div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="small">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                          </div>
                          <div class="col-md-3 col-sm-12"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <img src="{{ URL::to('public/frontendassets/images/banner3.png') }}" alt="images not found">
                 
                  <div class="cover">
                    <div class="container">
                      <div class="header-content">
                        <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-12"></div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="small">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                          </div>
                          <div class="col-md-3 col-sm-12"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- section close -->
    </div>
@endsection