<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>RPH</title>
  <link rel="icon" href="{{ URL::to('public/frontendassets/images/icon.png') }}" type="image/gif" sizes="16x16">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Bolo is creative one page website template">
  <meta name="author" content="">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/bootstrap.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/animate.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/owl.carousel.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/owl.theme.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/owl.transitions.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/magnific-popup.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/jquery.countdown.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/style.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ URL::to('public/frontendassets/css/colors/red.css') }}" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="homepage">
  <div id="wrapper">
    <div class="page-overlay">
      <div class="preloader-wrap">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
      </div>
    </div>
    <!-- header begin -->
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-header">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="{{ URL::to('public/frontendassets/images/logo_new.png') }}" width="50"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item menu">
                <a class="nav-link" aria-current="page" href="#section-services">Services</a>
              </li>
              <li class="nav-item menu">
                <a class="nav-link" href="#section-about">About RPH</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-md-0">
              <li class="nav-item menu">
                <a class="nav-link" href="#section-contact">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-custom1" href="{{ URL::to('/loginpage') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-custom2" href="{{ URL::to('/signup') }}">Get Started</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
	  <!-- End header -->

	  <!-- Page Content -->
    <!-- Container-fluid starts -->
    @yield('content')
    </div>
  <!-- Javascript Files
    ================================================== -->
  <script src="{{ URL::to('public/frontendassets/js/jquery.min.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/jquery.isotope.min.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/easing.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/owl.carousel.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/jquery.countTo.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/wow.min.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/enquire.min.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/jquery.plugin.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/jquery.easeScroll.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/jarallax.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/designesia.js') }}"></script>
  <script src="{{ URL::to('public/frontendassets/js/validation.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(".nav-item").on("click", function(e){
  // Remove class active form all li.nav-tiem
  $("li.nav-item").removeClass("active");
  // Add Class to current Element. 
  $(this).addClass("active");
});
</script>
</body>

</html>