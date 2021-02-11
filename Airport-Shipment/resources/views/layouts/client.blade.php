<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name') }}</title>
      <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('client') }}/css/linearicons.css">
      <link rel="stylesheet" href="{{ asset('client') }}/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{ asset('client') }}/css/bootstrap.css">
      <link rel="stylesheet" href="{{ asset('client') }}/css/magnific-popup.css">
      <link rel="stylesheet" href="{{ asset('client') }}/css/nice-select.css">
      <link rel="stylesheet" href="{{ asset('client') }}/css/animate.min.css">
      <link rel="stylesheet" href="{{ asset('client') }}/css/owl.carousel.css">
      <link rel="stylesheet" href="{{ asset('client') }}/css/main.css">
      {{-- Stripe CSS --}}
      <style>
         body {
            font-size: 14px;
         }
      </style>
   </head>
   <body>
      <header id="header" id="home">
         <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
               <div id="logo">
                  <a href="/">
                     {{-- <img src="{{ asset('client') }}/img/logo.png" alt="" title="" /> --}}
                     <img src="{{ asset('client') }}/img/gp-logo.png" alt="" title="" />
                  </a>
               </div>
               <nav id="nav-menu-container">
                  <ul class="nav-menu">
                     <li class="menu-active"><a href="/">Home</a></li>
                     <li><a href="{{ route('client.dashboard') }}">Dashboard</a></li>
                     @guest
                        <li><a class="ticker-btn" href="{{ route('login') }}">Login</a></li>
                        <li><a class="ticker-btn" href="{{ route('register') }}">Register</a></li>
                     @else    
                        <li><a class="font-weight-bold" href="{{ route('client.dashboard') }}">Hi, {!! optional(auth()->user())->name !!}</a></li>
                     @endguest
                  </ul>
               </nav>
            </div>
         </div>
      </header>

      <section class="banner-area relative" id="home" style="height:230px;">
         <div class="overlay overlay-bg"></div>
         <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
               <div class="about-content col-lg-12">                  
                  <h1 class="text-white">Shipment-App</h1>
               </div>
            </div>
         </div>
      </section>

      @yield('content')      

      <footer class="footer-area section-gap0">
         <div class="container">
            <div class="row">
               <div class="col-lg-3  col-md-12">
                  <div class="single-footer-widget">
                     <h6>Our Features</h6>
                     <ul class="footer-nav">
                        <li><span class="lnr lnr-arrow-right"></span> Sell Luggage Space</li>
                        <li><span class="lnr lnr-arrow-right"></span> Buy Luggage Space</li>
                        <li><span class="lnr lnr-arrow-right"></span> Easy Pay with Stripe</li>
                     </ul>
                  </div>
               </div>
               {{-- <div class="col-lg-6  col-md-12">
                  <div class="single-footer-widget newsletter">
                     <h6>Newsletter</h6>
                     <p>You can trust us. we only send promo offers, not a single spam.</p>
                     <div id="mc_embed_signup">
                        <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                           <div class="form-group row" style="width: 100%">
                              <div class="col-lg-8 col-md-12">
                                 <input name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
                                 <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-12">
                                 <button class="nw-btn primary-btn">Subscribe<span class="lnr lnr-arrow-right"></span></button>
                              </div>
                           </div>
                           <div class="info"></div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3  col-md-12">
                  <div class="single-footer-widget mail-chimp">
                     <h6 class="mb-20">Instragram Feed</h6>
                     <ul class="instafeed d-flex flex-wrap">
                        <li><img src="img/i1.jpg" alt=""></li>
                        <li><img src="img/i2.jpg" alt=""></li>
                        <li><img src="img/i3.jpg" alt=""></li>
                        <li><img src="img/i4.jpg" alt=""></li>
                        <li><img src="img/i5.jpg" alt=""></li>
                        <li><img src="img/i6.jpg" alt=""></li>
                        <li><img src="img/i7.jpg" alt=""></li>
                        <li><img src="img/i8.jpg" alt=""></li>
                     </ul>
                  </div>
               </div> --}}
            </div>
            <div class="row footer-bottom d-flex justify-content-between">
               <p class="col-lg-8 col-sm-12 footer-text pb-3 text-white">
                  Copyright &copy; <script>document.write(new Date().getFullYear());</script>. All rights reserved.</a>
               </p>
            </div>
         </div>
      </footer>
      
      <script src="{{ asset('client') }}/js/vendor/jquery-2.2.4.min.js"></script>
      <script src="../../../cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="{{ asset('client') }}/js/vendor/bootstrap.min.js"></script>
      <script src="{{ asset('client') }}/js/easing.min.js"></script>
      <script src="{{ asset('client') }}/js/hoverIntent.js"></script>
      <script src="{{ asset('client') }}/js/superfish.min.js"></script>
      <script src="{{ asset('client') }}/js/jquery.ajaxchimp.min.js"></script>
      <script src="{{ asset('client') }}/js/jquery.magnific-popup.min.js"></script>
      <script src="{{ asset('client') }}/js/owl.carousel.min.js"></script>
      <script src="{{ asset('client') }}/js/jquery.sticky.js"></script>
      <script src="{{ asset('client') }}/js/jquery.nice-select.min.js"></script>
      <script src="{{ asset('client') }}/js/parallax.min.js"></script>
      <script src="{{ asset('client') }}/js/mail-script.js"></script>
      <script src="{{ asset('client') }}/js/main.js"></script>
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'UA-23581568-13');
      </script>
   </body>
</html>