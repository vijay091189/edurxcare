<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Starting Soon</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin"/>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&amp;display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&amp;display=swap" media="print" onload="this.media='all'"/>
    <noscript>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&amp;display=swap"/>
    </noscript>
    <link href="{{ URL::to('public/loginassets/css/bootstrap.min.css?ver=1.1.0')}}" rel="stylesheet">
    <link href="{{ URL::to('public/loginassets/css/font-awesome/css/all.min.css?ver=1.1.0')}}" rel="stylesheet">
    <link href="{{ URL::to('public/loginassets/css/main.css?ver=1.1.0')}}" rel="stylesheet">
  </head>
  <body id="top"><video id="backgroundVideo" autoplay loop playsinline muted>
  <source src="{{ URL::to('public/loginassets/videos/night-sky.mp4')}}" type="video/mp4">
</video>
<div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="masthead clearfix">
        <div class="inner">
          <h3 class="masthead-brand"><img style='width:130px' src="{{ URL::to('public/assets/images/logo.jpeg')}}"/></h3>
          <nav class="nav nav-masthead">
            <a class="nav-link nav-social" href="#" title="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
            <a class="nav-link nav-social" href="#" title="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
            <a class="nav-link nav-social" href="#" title="Youtube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
            <a class="nav-link nav-social" href="#" title="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
          </nav>
        </div>
      </div>      
      <div class="inner cover">
        <h1 class="cover-heading">Journey Begins in</h1>
        <div id="timer">
          <div id="days"></div>
          <div id="hours"></div>
          <div id="minutes"></div>
          <div id="seconds"></div>
        </div>
        <p class="lead cover-copy">Hold tight as we prepare for launching the most astonishing product ever.</p>
      </div>
      <div class="mastfoot">
        <div class="inner">
          <p style='color:#333;'>&copy; Your Company. Design: <a style='color:#333;' href="https://templateflip.com/" target="_blank">TemplateFlip</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
    <script src="{{ URL::to('public/loginassets/scripts/jquery.slim.min.js?ver=1.1.0')}}"></script>
    <script src="{{ URL::to('public/loginassets/scripts/bootstrap.bundle.min.js?ver=1.1.0')}}"></script>
    <script src="{{ URL::to('public/loginassets/scripts/main.js?ver=1.1.0')}}"></script>
  </body>
</html>