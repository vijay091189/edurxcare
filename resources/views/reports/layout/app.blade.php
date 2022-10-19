<?php $session_details = session()->get('LoginUserSession'); 
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$split_url = explode('/',$actual_link);
$last_element = end($split_url);
            ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title> Ezglam </title>
       
      <!-- <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">-->      
      <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
   <!-- Favicon icon -->
   <!-- <link rel="shortcut icon" href="{{ URL::to('public/assets/images/favicon.png') }}" type="image/x-icon"> -->
   <link rel="shortcut icon" href="{{ url('/') }}/public/frontendassets/images/favicon.ico" type="image/x-icon" />
   <link rel="icon" href="{{ URL::to('public/assets/images/favicon.ico') }}" type="image/x-icon">

   <!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

   <!-- themify -->
   <link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/icon/themify-icons/themify-icons.css') }}">

   <!-- iconfont -->
   <link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/icon/icofont/css/icofont.css') }}">

   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/icon/simple-line-icons/css/simple-line-icons.css') }}">

   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}">

   <!-- Chartlist chart css -->
   <link rel="stylesheet" href="{{ URL::to('public/assets/plugins/chartist/dist/chartist.css') }}" type="text/css" media="all">

   <!-- Weather css -->
   <link href="{{ URL::to('public/assets/css/svg-weather.css') }}" rel="stylesheet">


   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/main.css') }}">

   <!-- Responsive.css-->
   <link rel="stylesheet" type="text/css" href="{{ URL::to('public/assets/css/responsive.css') }}">
      
   <style type="text/css">
      @media (min-width: 1200px){
         .container, .container-sm, .container-md, .container-lg, .container-xl {
               max-width: 1260px;
         }
      }
   </style>
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">		  
   </head>
   <body>
   <div class="wrapper">
      <header class="main-header-top hidden-print" style="background-color:#ec216d;">
         @if($session_details['role_id']==1)
            <a href="{{ URl::to('/admindashboard') }}" class="logo"><img style='width:130px' src="{{ URL::to('public/assets/images/logo.jpeg')}}"/></a>
         @else 
            <a href="{{ URl::to('/distributordashboard') }}" class="logo"><img style='width:130px' src="{{ URL::to('public/assets/images/logo.jpeg')}}"/></a>
         @endif
         <nav class="navbar navbar-static-top" style="background-color:#ec216d;">
            <!-- Sidebar toggle button-->
            <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
            <!-- <ul class="top-nav lft-nav">
               <li>
                  <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                     <i class="ti-files"> </i><span> Files</span>
                  </a>
               </li>
               <li class="dropdown">
                  <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                     <span>Dropdown </span><i class=" icofont icofont-simple-down"></i>
                  </a>
                  <ul class="dropdown-menu settings-menu">
                     <li><a href="#">List item 1</a></li>
                     <li><a href="#">List item 2</a></li>
                     <li><a href="#">List item 3</a></li>
                     <li><a href="#">List item 4</a></li>
                     <li><a href="#">List item 5</a></li>
                  </ul>
               </li>
               <li class="dropdown pc-rheader-submenu message-notification search-toggle">
                  <a href="#!" id="morphsearch-search" class="drop icon-circle txt-white">
                     <i class="ti-search"></i>
                  </a>
               </li>
            </ul> -->
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu">
               <ul class="top-nav">
                  <!--Notification Menu-->
                  <li class="dropdown notification-menu">
                     <!-- <a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                        <i class="icon-bell"></i>
                        <span class="badge badge-danger header-badge">9</span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="not-head"></li>
                        <li class="bell-notification">
                        </li>
                        <li class="bell-notification">
                        </li>
                        <li class="bell-notification">
                           
                        </li>
                        <li class="not-footer">
                        </li>
                     </ul> -->
                  </li>
                  <!-- chat dropdown -->
                  <li class="pc-rheader-submenu ">
                     <!-- <a href="#!" class="drop icon-circle displayChatbox">
                        <i class="icon-bubbles"></i>
                        <span class="badge badge-danger header-badge">5</span>
                     </a> -->

                  </li>
                  <!-- window screen -->
                  <li class="pc-rheader-submenu">
                     <!-- <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                        <i class="icon-size-fullscreen"></i>
                     </a> -->

                  </li>
                  <!-- User Menu-->
                  <li class="dropdown">
                     <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                        @if($session_details['profile_picture']!='')
                           <span><img class="img-circle " src="{{ url('/') }}/public/images/{{$session_details['profile_picture']}}" style="width:40px;" alt="User Image"></span>
                        @else
                           <span><img class="img-circle " src="{{ url('/') }}/public/assets/images/nouser.png" style="width:40px;" alt="User Image"></span>
                        @endif
                        <span>{{ $session_details['display_name'] }} <i class=" icofont icofont-simple-down"></i></span>
                     </a>
                     <ul class="dropdown-menu settings-menu">
                        <!-- <li><a href="#!"><i class="icon-settings"></i> Settings</a></li>
                        <li><a href="#"><i class="icon-user"></i> Profile</a></li>
                        <li><a href="#"><i class="icon-envelope-open"></i> My Messages</a></li>
                        <li class="p-0">
                           <div class="dropdown-divider m-0"></div>
                        </li> -->
                        <!-- @if($session_details['role_id']==1)
                           <li><a href="{{ URl::to('/adminEditProfile') }}"><i class="icon-lock"></i> Edit Profile</a></li> 
                        @endif -->
                        <li><a href="{{ URl::to('/adminEditProfile') }}"><i class="icon-lock"></i> Edit Profile</a></li> 
                        <li><a href="{{ URl::to('/changePassword') }}"><i class="icon-lock"></i> Change Password</a></li> 
                        <li><a href="{{ URl::to('/logout') }}"><i class="icon-logout"></i> Logout</a></li>

                     </ul>
                  </li>
               </ul>

               <!-- search -->
               <div id="morphsearch" class="morphsearch">
                  <form class="morphsearch-form">

                     <input class="morphsearch-input" type="search" placeholder="Search..." />

                     <button class="morphsearch-submit" type="submit">Search</button>

                  </form>
                  <div class="morphsearch-content">
                     <div class="dummy-column">
                        <h2>People</h2>
                        <a class="dummy-media-object" href="#!">
                           <img class="round" src="http://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&d=identicon&r=G" alt="Sara Soueidan" />
                           <h3>Sara Soueidan</h3>
                        </a>

                        <a class="dummy-media-object" href="#!">
                           <img class="round" src="http://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&d=identicon&r=G" alt="Shaun Dona" />
                           <h3>Shaun Dona</h3>
                        </a>
                     </div>
                     <div class="dummy-column">
                        <h2>Popular</h2>
                        <a class="dummy-media-object" href="#!">
                           <img src="public/assets/images/avatar-1.png" alt="PagePreloadingEffect" />
                           <h3>Page Preloading Effect</h3>
                        </a>

                        <a class="dummy-media-object" href="#!">
                           <img src="public/assets/images/avatar-1.png" alt="DraggableDualViewSlideshow" />
                           <h3>Draggable Dual-View Slideshow</h3>
                        </a>
                     </div>
                     <div class="dummy-column">
                        <h2>Recent</h2>
                        <a class="dummy-media-object" href="#!">
                           <img src="public/assets/images/avatar-1.png" alt="TooltipStylesInspiration" />
                           <h3>Tooltip Styles Inspiration</h3>
                        </a>
                        <a class="dummy-media-object" href="#!">
                           <img src="public/assets/images/avatar-1.png" alt="NotificationStyles" />
                           <h3>Notification Styles Inspiration</h3>
                        </a>
                     </div>
                  </div>
                  <!-- /morphsearch-content -->
                  <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
               </div>
               <!-- search end -->
            </div>
         </nav>
      </header>
      <aside class="main-sidebar hidden-print ">
         <section class="sidebar" id="sidebar-scroll">
            
            <!-- Sidebar Menu-->
            @if($session_details['role_id']==1)
               <ul class="sidebar-menu">

                  <!-- <li class="nav-level" style="color: #ec216d">--- Navigation</li> -->
                  <li class="treeview">
                     <a class="waves-effect waves-dark" href="{{ URl::to('/admindashboard') }}">
                           <i class="icon-speedometer"></i><span> Dashboard</span>
                     </a>                
                  </li>

                  <li class="treeview <?php if(in_array('typeslist',$split_url) || in_array('categoriesList',$split_url) 
                  || in_array('categoriesList',$split_url) || in_array('productsList',$split_url) || in_array('hubsList',$split_url) 
                  || in_array('servicesList',$split_url) || in_array('configurations',$split_url) 
                  || in_array('servicesFeedback',$split_url) || in_array('paymentTransactions',$split_url)
                  || in_array('manageBanners',$split_url)){ echo 'active';} ?>">
                     <a class="waves-effect waves-dark" href="#">
                           <i class="icon-speedometer"></i><span> Administration	</span><i class="icon-arrow-down"></i>
                     </a> 
                     <ul class="treeview-menu">
                        <li <?php if(in_array('typeslist',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/typeslist') }}">
                           <i class="icon-arrow-right"></i><span> Types</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('categoriesList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/categoriesList') }}">
                           <i class="icon-arrow-right"></i><span> Categories</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('productsList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/productsList') }}">
                           <i class="icon-arrow-right"></i><span> Products</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('servicesList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/servicesList') }}">
                           <i class="icon-arrow-right"></i><span> Services</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('hubsList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/hubsList') }}">
                           <i class="icon-arrow-right"></i><span> Hub Management</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('configurations',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/configurations') }}">
                           <i class="icon-arrow-right"></i><span> Configuration Settings</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('servicesFeedback',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/servicesFeedback') }}">
                           <i class="icon-arrow-right"></i><span> Services Feedback</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('paymentTransactions',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/paymentTransactions') }}">
                           <i class="icon-arrow-right"></i><span> Payment Transactions</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('manageBanners',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/manageBanners') }}">
                           <i class="icon-arrow-right"></i><span> Banners</span>
                           </a>                
                        </li>
                        
                     </ul>               
                  </li>

                  <li class="treeview <?php if(in_array('appointmentsList',$split_url) || in_array('appUsersList',$split_url) 
                  || in_array('patnerOrders',$split_url) || in_array('customerOrders',$split_url)){ echo 'active';} ?>">
                     <a class="waves-effect waves-dark" href="#">
                           <i class="icon-speedometer"></i><span> Manage Orders	</span><i class="icon-arrow-down"></i>
                     </a> 
                     <ul class="treeview-menu">
                        <!-- <li <?php //if(in_array('appointmentsList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/appointmentsList') }}">
                           <i class="icon-arrow-right"></i><span> Appointments</span>
                           </a>                
                        </li>
                        <li <?php //if(in_array('appUsersList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/appUsersList') }}">
                           <i class="icon-arrow-right"></i><span> Registered Users</span>
                           </a>                
                        </li> -->
						      <li <?php if(in_array('patnerOrders',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/patnerOrders') }}">
                           <i class="icon-arrow-right"></i><span> Partner Orders</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('customerOrders',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/customerOrders') }}">
                           <i class="icon-arrow-right"></i><span> Customer Orders</span>
                           </a>                
                        </li>
                     </ul>               
                  </li>

                  <li class="treeview <?php if(in_array('partnersList',$split_url) || in_array('adminsList',$split_url) 
                  || in_array('distributorsList',$split_url)){ echo 'active';} ?>">
                     <a class="waves-effect waves-dark" href="#">
                           <i class="icon-speedometer"></i><span> Registration</span><i class="icon-arrow-down"></i>
                     </a> 
                     <ul class="treeview-menu">
                        <li <?php if(in_array('adminsList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/adminsList') }}">
                           <i class="icon-arrow-right"></i><span> Manage Admins</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('partnersList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/partnersList') }}">
                           <i class="icon-arrow-right"></i><span> Partners </span>
                           </a>                
                        </li>
                        <li <?php if(in_array('distributorsList',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/distributorsList') }}">
                           <i class="icon-arrow-right"></i><span> Distirbutors</span>
                           </a>                
                        </li>
                        
                     </ul>               
                  </li>
				  
				   <li class="treeview <?php if(strpos($last_element, 'appointmentReports') !== false || 
                                             strpos($last_element, 'userReports') !== false || 
                                             strpos($last_element, 'partnerReports') !== false || 
                                             strpos($last_element, 'distributorReports') !== false 
                                             || in_array('distributorProductsLog',$split_url) 
                                             || in_array('partnerProductsLog',$split_url)){ echo 'active';} ?>">
                     <a class="waves-effect waves-dark" href="#">
                           <i class="icon-speedometer"></i><span> Reports</span><i class="icon-arrow-down"></i>
                     </a> 
                     <ul class="treeview-menu">
                        <li <?php if(strpos($last_element, 'appointmentReports') !== false){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/appointmentReports') }}">
                           <i class="icon-arrow-right"></i><span> Appointments</span>
                           </a>                
                        </li>
                        <li <?php if(strpos($last_element, 'userReports') !== false){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/userReports') }}">
                           <i class="icon-arrow-right"></i><span> Registered Users</span>
                           </a>                
                        </li>
                        <li <?php if(strpos($last_element, 'partnerReports') !== false){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/partnerReports') }}">
                           <i class="icon-arrow-right"></i><span> Partners</span>
                           </a>                
                        </li>
                        <li <?php if(strpos($last_element, 'distributorReports') !== false){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/distributorReports') }}">
                           <i class="icon-arrow-right"></i><span> Distributors</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('distributorProductsLog',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/distributorProductsLog') }}">
                           <i class="icon-arrow-right"></i><span> Distributors Products Log</span>
                           </a>                
                        </li>
                        <li <?php if(in_array('partnerProductsLog',$split_url)){ echo 'class="active"';} ?>>
                           <a class="waves-effect waves-dark" href="{{ URl::to('/partnerProductsLog') }}">
                           <i class="icon-arrow-right"></i><span> Partners Products Log</span>
                           </a>                
                        </li>
                     </ul>               
                  </li>
                  
               </ul>
            @elseif($session_details['role_id']==4)
               <ul class="sidebar-menu">
                  <!-- <li class="nav-level" style="color: #ec216d">--- Navigation</li> -->
                  <li class="treeview">
                     <a class="waves-effect waves-dark" href="{{ URl::to('/distributordashboard') }}">
                           <i class="icon-speedometer"></i><span> Dashboard</span>
                     </a>                
                  </li>
                  <li class="treeview">
                     <a class="waves-effect waves-dark" href="{{ URl::to('/distributorPartnersList') }}">
                           <i class="icon-speedometer"></i><span> Assign Products</span>
                     </a>                
                  </li>
                  <li class="treeview">
                     <a class="waves-effect waves-dark" href="{{ URl::to('/dispatchedProductsList') }}">
                           <i class="icon-speedometer"></i><span> Dispatched Products</span>
                     </a>                
                  </li>
               </ul>
            @endif
         </section>
      </aside>
      <div class="content-wrapper">
         <!-- Container-fluid starts -->
         @yield('content')
     </div>
   </body>
   <script src="{{ URL::to('public/assets/plugins/jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ URL::to('public/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
   <script src="{{ URL::to('public/assets/plugins/tether/dist/js/tether.min.js') }}"></script>

   <!-- Required Fremwork -->
   <script src="{{ URL::to('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

   <!-- waves effects.js -->
   <script src="{{ URL::to('public/assets/plugins/Waves/waves.min.js') }}"></script>

   <!-- Scrollbar JS-->
   <script src="{{ URL::to('public/assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
   <script src="{{ URL::to('public/assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>

   <!--classic JS-->
   <script src="{{ URL::to('public/assets/plugins/classie/classie.js') }}"></script>

   <!-- notification -->
   <script src="{{ URL::to('public/assets/plugins/notification/js/bootstrap-growl.min.js') }}"></script>

   <!-- custom js -->
   <script type="text/javascript" src="{{ URL::to('public/assets/js/main.min.js') }}"></script>
   <script type="text/javascript" src="{{ URL::to('public/assets/pages/elements.js') }}"></script>
   <script src="{{ URL::to('public/assets/js/menu.min.js') }}"></script>
</body>

</html>