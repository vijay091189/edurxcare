

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>RPH</title>
  <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/images/favicon.png">
  <!-- Stylesheets -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/css/bootstrap.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/css/bootstrap-extend.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/assets/css/site.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/asscrollable/asScrollable.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/switchery/switchery.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/intro-js/introjs.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/slidepanel/slidePanel.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/jquery-mmenu/jquery-mmenu.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/flag-icon-css/flag-icon.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/chartist/chartist.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/jvectormap/jquery-jvectormap.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/assets/examples/css/dashboard/v1.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/fonts/web-icons/web-icons.min599c.css?v4.0.2') }}">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/fonts/brand-icons/brand-icons.min599c.css?v4.0.2') }}">
  <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">
  <link rel="stylesheet" href="{{ URL::to('public/dashboardassets/global/fonts/weather-icons/weather-icons.min599c.css?v4.0.2') }}">
  <script src="{{ URL::to('public/dashboardassets/global/vendor/breakpoints/breakpoints.min599c.js?v4.0.2') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="{{ URL::to('public/dashboardassets/assets/js/jquery.min.js') }}?v={{ rand(11111,99999) }}"></script>
  <script src="{{ URL::to('public/dashboardassets/assets/js/bootstrap.min.js') }}?v={{ rand(11111,99999) }}"></script>
  <style type="text/css">
    .modal-dialog {
      width: 60%;
    }
    input[type="checkbox"] {
      display: inline-block !important;
    }
  </style>
  <script>
    Breakpoints();
  </script>
</head>
<?php 
$session_details = session()->get('LoginUserSession');
?>
<body class="animsition site-navbar-small dashboard">
 
  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <img class="navbar-brand-logo" src="{{ URL::to('public/dashboardassets/assets/images/logo.png') }}" title="Pharma">
        <!-- <span class="navbar-brand-text hidden-xs-down">Pharma</span> -->
      </div>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search" data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
    </div>
    <div class="navbar-container container-fluid p-0">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="nav-item hidden-float" id="toggleMenubar">
            <a class="nav-link" data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                <span class="sr-only">Toggle menubar</span>
                <span class="hamburger-bar"></span>
              </i>
            </a>
          </li>
        </ul>
        <ul class="nav navbar-toolbar top_bar">
          @if($session_details['role_id']=='2'){
            <li class="nav-item top_color active">
              <a class="nav-link b-2" href="{{ URL::to('/newRequest') }}" style="">
                <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i>New Request
              </a>
            </li>
            <li class="nav-item top_color ">
              <a class="nav-link b-2" href="{{ URL::to('/responses') }}" style="">
                <i class="fa-solid fa-reply"></i>Response from Pharmacist
              </a>
            </li>
          @else 
            <li class="nav-item top_color active">
              <a class="nav-link b-2" href="{{ URL::to('/phamacistDashboard') }}" style="">
                <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i>New Requests
              </a>
            </li>
            <li class="nav-item top_color active">
              <a class="nav-link b-2" href="{{ URL::to('/newPatientAppointments') }}" style="">
                <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i>New Appointments
              </a>
            </li>
          @endif
          <li class="nav-item top_color">
            <a class="nav-link b-2" href="{{ URL::to('/patientRecommendations') }}" style="">
              <i class="site-menu-icon wb-thumb-up" aria-hidden="true"></i>Recommendations
            </a>
          </li>
          <li class="nav-item top_color">
            <a class="nav-link" href="{{ URL::to('/patientFaqs') }}">
              <i class="fa-solid fa-question"></i>FAQ
            </a>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->
      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
  <div class="site-menubar">
    <ul class="site-menu">
      <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="Edit Profile">
        <a href="{{ URL::to('/editPatientProfile') }}">
          <i class="fa-solid fa-user"></i>
          <span class="site-menu-title">Profile</span>
        </a>
      </li>
     
      <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="Notifications">
        <a href="{{ URL::to('/patientNotifications') }}">
          <i class="site-menu-icon wb-bell" aria-hidden="true"></i>
          <span class="site-menu-title">Notifications</span>
        </a>
      </li>
      @if($session_details['role_id']=='2'){
        <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="My Requests">
          <a href="{{ URL::to('/patientDashboard') }}">
            <i class="fa-solid fa-backward"></i>
            <span class="site-menu-title">My Requests</span>
          </a>
        </li>
        <li class="site-menu-item has-sub " data-placement="right" data-toggle="tooltip" title="Pill Reminders">
          <a href="{{ URL::to('/pillReminders') }}">
            <i class="fa-solid fa-calendar-check"></i>
            <span class="site-menu-title">Pill Reminders</span>
          </a>
        </li>
        <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="Appointments">
          <a href="{{ URL::to('/patientAppointments') }}">
            <i class="fa-regular fa-calendar-days"></i>
            <span class="site-menu-title">My Appointments</span>
          </a>
        </li>
      @else
        <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="My Requests">
          <a href="{{ URL::to('/pharmacistRequests') }}">
            <i class="fa-solid fa-backward"></i>
            <span class="site-menu-title">My Requests</span>
          </a>
        </li>
        <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="Appointments">
          <a href="{{ URL::to('/pharmacistAppointments') }}">
            <i class="fa-regular fa-calendar-days"></i>
            <span class="site-menu-title">My Appointments</span>
          </a>
        </li>
      @endif
      <li class="site-menu-item has-sub " data-placement="right" data-toggle="tooltip" title="Rating and Review">
        <a href="{{ URL::to('/reviewRatings') }}">
          <i class="fa-solid fa-star"></i>
          <span class="site-menu-title">Rating and Feedback</span>
        </a>
      </li>
      <li class="site-menu-item has-sub " data-placement="right" data-toggle="tooltip" title="Refer a Friend">
        <a href="{{ URL::to('/referFriend') }}">
          <i class="fa-solid fa-user-group"></i>
          <span class="site-menu-title">Refer a Friend</span>
        </a>
      </li>
      <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="Change Password">
        <a href="{{ URL::to('/userChangePassword') }}">
          <i class="fa-solid fa-unlock"></i>
          <span class="site-menu-title">Change Password</span>
        </a>
      </li>
      
      <li class="site-menu-item has-sub" data-placement="right" data-toggle="tooltip" title="Logout">
        <a href="{{ URL::to('/userlogout') }}">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span class="site-menu-title">Logout</span>
        </a>
      </li>
    </ul>
  </div>  <!-- Page -->
    @yield('content')
    </div>
    <script src="{{ URL::to('public/dashboardassets/https://kit.fontawesome.com/610c0fe1cf.js') }}" crossorigin="anonymous"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/babel-external-helpers/babel-external-helpers599c.js?v4.0.2') }}"></script>
  <!-- <script src="{{ URL::to('public/dashboardassets/global/vendor/jquery/jquery.min599c.js?v4.0.2') }}"></script> -->
  <script src="{{ URL::to('public/dashboardassets/global/vendor/popper-js/umd/popper.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/bootstrap/bootstrap.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/animsition/animsition.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/mousewheel/jquery.mousewheel599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/asscrollbar/jquery-asScrollbar.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/asscrollable/jquery-asScrollable.min599c.js?v4.0.2') }}"></script>
  <!-- Plugins -->
  <script src="{{ URL::to('public/dashboardassets/global/vendor/jquery-mmenu/jquery.mmenu.min.all599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/switchery/switchery.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/intro-js/intro.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/screenfull/screenfull599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/slidepanel/jquery-slidePanel.min599c.js?v4.0.2') }}"></script>
  <!-- Plugins For This Page -->
  <script src="{{ URL::to('public/dashboardassets/global/vendor/skycons/skycons599c.js?v4.0.2') }}"></script>
 
  <script src="{{ URL::to('public/dashboardassets/global/vendor/aspieprogress/jquery-asPieProgress.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/jvectormap/jquery-jvectormap.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/vendor/matchheight/jquery.matchHeight-min599c.js?v4.0.2') }}"></script>
  <!-- Scripts -->
  <script src="{{ URL::to('public/dashboardassets/global/js/Component.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Plugin.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Base.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Config.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/assets/js/Section/Menubar.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/assets/js/Section/Sidebar.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/assets/js/Section/PageAside.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/assets/js/Section/GridMenu.min599c.js?v4.0.2') }}"></script>
  <!-- Config -->
  <script src="{{ URL::to('public/dashboardassets/global/js/config/colors.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/assets/js/config/tour.min599c.js?v4.0.2') }}"></script>
  <script>
  Config.set('assets', 'assets');
  </script>
  <!-- Page -->
  <script src="{{ URL::to('public/dashboardassets/assets/js/Site.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Plugin/asscrollable.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Plugin/slidepanel.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Plugin/switchery.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Plugin/matchheight.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/global/js/Plugin/jvectormap.min599c.js?v4.0.2') }}"></script>
  <script src="{{ URL::to('public/dashboardassets/assets/examples/js/dashboard/v1.min599c.js?v4.0.2') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });
</script>
  <!-- Google Analytics -->  <!-- Google Analytics -->
</body>

</html>