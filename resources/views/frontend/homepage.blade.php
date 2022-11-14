@extends('frontend/layout.app')
@section('title', 'Edurxcare - Home')
@section('content')
    <!-- header close -->
    <!-- content begin -->
    <div id="content" class="no-bottom no-top">
      <div id="top"></div>
      <!-- section begin -->
      <section id="section-intro" class="full-height jarallax relative owl-slide-wrapper text-light no-top no-bottom">
        <img src="{{ URL::to('public/frontendassets/images/banner.png') }}" class="jarallax-img" alt="">
        <div class="overlay-bg t50">
          <div class="center-y relative">
            <div class="container">
              <div class="row">
                <div class="col-md-3 col-sm-12"></div>
                <div class="col-md-6 col-sm-12">
                  <div class="spacer-double d-block d-sm-none d-md-block"></div>
                  <div class="big b text-center mb-3">Lorem Ipsum is simply dummy text<br>Why do we use it? </div>
                  <div class="small text-center">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                  <div class="spacer-single"></div>
                  <div class="col-md-12 ml-12">
                    <a href="#" class="col-lg-5 col-md-6 mb-md-30 btn-custom ml-auto">Get Started</a>
                    <a href="#" class="col-lg-2 col-md-6 mb-md-30">&nbsp;</a>

                    <a href="#section-contact" class="col-lg-5 col-md-6 mb-md-30 btn-custom mr-auto">Contact us</a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- section begin -->
      <section id="section-services">
        <div class="container">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-sm-12">
              <div class="big text-center mb-3" style="color:#232e74;">Services</div>
              <div class="small text-center mb-3" style="color:#000000;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout</div>
            </div>
          </div>
          <div class="col-md-3"></div>
          <div class="row">
            <!-- featured box begin -->
            <div class="col-lg-3 col-md-6 mb-md-30">
              <div class="feature-box-style-1">
                <div class="inner">
                  <div class="front">
                    <i class="icon-lightbulb id-color"></i>
                    <h3>Idea</h3>
                    <span>First Step</span>
                  </div>
                  <div class="info">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- featured box close -->
            <!-- featured box begin -->
            <div class="col-lg-3 col-md-6 mb-md-30">
              <div class="feature-box-style-1">
                <div class="inner">
                  <div class="front">
                    <i class="icon-presentation id-color"></i>
                    <h3>Design</h3>
                    <span>Second Step</span>
                  </div>
                  <div class="info">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- featured box close -->
            <!-- featured box begin -->
            <div class="col-lg-3 col-md-6 mb-md-30">
              <div class="feature-box-style-1">
                <div class="inner">
                  <div class="front">
                    <i class="icon-circle-compass id-color"></i>
                    <h3>Develop</h3>
                    <span>Third Step</span>
                  </div>
                  <div class="info">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- featured box close -->
            <!-- featured box begin -->
            <div class="col-lg-3 col-md-6 mb-md-30">
              <div class="feature-box-style-1">
                <div class="inner">
                  <div class="front">
                    <i class="icon-flag id-color"></i>
                    <h3>Result</h3>
                    <span>Fourth Step</span>
                  </div>
                  <div class="info">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- featured box close -->
          </div>
        </div>
      </section>
      <!-- section close -->
      <!-- section service begin -->
      <section id="section-about" class="full-height jarallax relative owl-slide-wrapper text-light no-top no-bottom mb-4">
        <img src="{{ URL::to('public/frontendassets/images/white_pill.png') }}" class="jarallax-img" alt="">
        <div class="overlay-bg t50">
          <div class="center-y relative">
            <div class="container">
              <div class="row">
                <div class="col-md-3 col-sm-12"></div>
                <div class="col-md-6 col-sm-12">
                  <!-- <div class="spacer-double d-block d-sm-none d-md-block"></div> -->
                  <div class="big b text-center mb-3" style="color:#232e74;">About RPH</div>
                  <div class="big b text-center mb-3">Lorem Ipsum is simply dummy text<br>Why do we use it? </div>
                  <div class="small text-center">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                  <div class="spacer-single"></div>
                </div>
                <div class="col-md-3 col-sm-12"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="big b text-center mb-3" style="color:#232e74;">Contact Us</div>
      <section id="section-contact" data-bgcolor="#00aaca">
        <div class="container">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5 mb-md-30" style="color: #ffffff">
              <div><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;www.rph.in</div>
              <div class="mb-3"><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;+91 987654321, +91 978653423</div>
              <div><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp; Address Line1,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Address Line2, Contact Numbers,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pincode,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
              <div>
                <h6 class="mb-3" style="color: #ffffff">Follow us on social media</h6>
                <a href="#" class="social-icons-round"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="social-icons-round"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-icons-round"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#" class="social-icons-round"><i class="fa-brands fa-twitter"></i></a>
                <!-- <a href="#" class="social-icons-round"><i class="fa fa-rss fa-lg"></i></a> -->
              </div>
            </div>
            <div class="col-md-5">
              <h6 class="mb-3" style="color: #ffffff">Sign up for our newsletter for updates and other details</h6>
              <div class="input-group">
                <input type="email" class="form-control" placeholder="Enter your email">
                <span class="input-group-btn">
                  <button class="btn btn-theme" type="submit">Subscribe</button>
                </span>
              </div>
              <br>
                <div><a href="#" class="" style="color: #ffffff">Quick Links</a></div>
                <div><a href="#" class="" style="color: #ffffff">Privacy Policy</a></div>
                <div><a href="#" class="" style="color: #ffffff">Terms and Condition</a></div>
                <div><a href="#" class="" style="color: #ffffff">Quick Links</a></div>


            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
      </section>
      <!-- section close -->
    </div>
    <!-- content close -->
    <!-- footer begin -->
    <!-- footer close -->
    <a href="#" id="back-to-top"></a>
@endsection