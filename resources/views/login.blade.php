<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <title> Edurxcare - Login </title>
       
      <!-- <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">-->      
      <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
   <!-- Favicon icon -->
   <link rel="shortcut icon" href="{{ URL::to('public/assets/images/favicon.png') }}" type="image/x-icon">
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
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-12">
				<div class="login-card card-block">
					<form class="md-float-material" action="{{URL::to('/checkLogin')}}" method="post">
						@csrf
	  					@if($error=='error')
							<div class="text-center">
								<strong style="color:red;">Invalid Username or Password</strong>
							</div>
						@endif
						<h3 class="text-center txt-primary">
						<img style='width:130px' src="{{ URL::to('public/assets/images/logo-colored.png')}}"/><br>
							Sign In to your account
						</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="md-input-wrapper">
									<input type="text" name="username" id="username" class="md-form-control" required="required"/>
									<label>Username</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="md-input-wrapper">
									<input name="userpassword" type="password" class="md-form-control" required="required"/>
									<label>Password</label>
								</div>
							</div>
							<!-- <div class="col-sm-6 col-xs-12">
								<div class="rkmd-checkbox checkbox-rotate checkbox-ripple m-b-25">
									<label class="input-checkbox checkbox-primary">
										<input type="checkbox" id="checkbox">
										<span class="checkbox"></span>
									</label>
									<div class="captions">Remember Me</div>

								</div>
							</div> -->
							<!-- <div class="col-sm-6 col-xs-12 forgot-phone text-right">
								<a href="forgot-password.html" class="text-right f-w-600"> Forgot Password?</a>
							</div> -->
						</div>
						<div class="row">
							<div class="col-xs-10 offset-xs-1">
								<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
							</div>
						</div>
						<!-- <div class="card-footer"> -->
						<div class="col-sm-12 col-xs-12 text-center">
							<span class="text-muted">Don't have an account?</span>
							<a href="register2.html" class="f-w-600 p-l-5">Sign up Now</a>
						</div>

						<!-- </div> -->
					</form>
					<!-- end of form -->
				</div>
				<!-- end of login-card -->
			</div>
			<!-- end of col-sm-12 -->
		</div>
		<!-- end of row -->
	</div>
	<!-- end of container-fluid -->
</section>

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
	<h1>Warning!!</h1>
	<p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
	<div class="iew-container">
		<ul class="iew-download">
			<li>
				<a href="http://www.google.com/chrome/">
					<img src="public/assets/images/browser/chrome.png" alt="Chrome">
					<div>Chrome</div>
				</a>
			</li>
			<li>
				<a href="https://www.mozilla.org/en-US/firefox/new/">
					<img src="public/assets/images/browser/firefox.png" alt="Firefox">
					<div>Firefox</div>
				</a>
			</li>
			<li>
				<a href="http://www.opera.com">
					<img src="public/assets/images/browser/opera.png" alt="Opera">
					<div>Opera</div>
				</a>
			</li>
			<li>
				<a href="https://www.apple.com/safari/">
					<img src="public/assets/images/browser/safari.png" alt="Safari">
					<div>Safari</div>
				</a>
			</li>
			<li>
				<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
					<img src="public/assets/images/browser/ie.png" alt="">
					<div>IE (9 & above)</div>
				</a>
			</li>
		</ul>
	</div>
	<p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jqurey -->
<script src="{{ URL::to('public/assets/plugins/jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ URL::to('public/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
   <script src="{{ URL::to('public/assets/plugins/tether/dist/js/tether.min.js') }}"></script>

   <!-- Required Fremwork -->
   <script src="{{ URL::to('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

   <!-- waves effects.js -->
   <script src="{{ URL::to('public/assets/plugins/Waves/waves.min.js') }}"></script>

   <script type="text/javascript" src="{{ URL::to('public/assets/pages/elements.js') }}"></script>

</body>
</html>
