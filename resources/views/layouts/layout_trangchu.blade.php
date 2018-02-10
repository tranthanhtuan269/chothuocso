<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap E-commerce Templates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
    <!-- bootstrap -->
    <link href="{{ url('/') }}/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
    <link href="{{ url('/') }}/public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="{{ url('/') }}/public/themes/css/bootstrappage.css" rel="stylesheet"/>
    
    <!-- global styles -->
    <link href="{{ url('/') }}/public/themes/css/flexslider.css" rel="stylesheet"/>
    <link href="{{ url('/') }}/public/themes/css/main.css" rel="stylesheet"/>

    <!-- scripts -->
    <script src="{{ url('/') }}/public/themes/js/jquery-1.7.2.min.js"></script>
    <script src="{{ url('/') }}/public/bootstrap/js/bootstrap.min.js"></script>       
    <script src="{{ url('/') }}/public/themes/js/superfish.js"></script>  
    <script src="{{ url('/') }}/public/themes/js/jquery.scrolltotop.js"></script>
    <!--[if lt IE 9]>     
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ url('/') }}/public/themes/images/logo_small.png" type="image/jpg" />
  </head>
    <body>    
    <div id="top-bar" class="container">
      <div class="row">
        <div class="span4">
          <form method="POST" class="search_form">
            <input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
          </form>
        </div>
        <div class="span8">
          <div class="account pull-right">
            <ul class="user-menu">
              @if (!Auth::guest())
              <li><a href="{{ url('/') }}/">Xin chào {{ Auth::user()->name }}!</a></li>
              @endif
              <li><a href="{{ url('/') }}/cart">Your Cart</a></li>
              <li><a href="{{ url('/') }}/checkout">Checkout</a></li>
              @if (!Auth::guest())
              <li><a target="_self" href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Đăng Xuất
              </a>
              </li>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
              @else
              <li><a href="{{ url('/') }}/login">Login</a></li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="wrapper" class="container">
      <section class="navbar main-menu">
        <div class="navbar-inner main-menu">        
          <a href="index.html" class="logo pull-left"><img src="{{ url('/') }}/public/themes/images/logo.png" class="site_logo" alt=""></a>
          <nav id="menu" class="pull-right">
            <ul>
              <?php 
                  $menuListParent = \App\Category::where('status', 1)->where('parent_id',0)->select('id', 'name', 'slug')->get();
                  foreach ($menuListParent as $menuParent) {
              ?>
                  <li><a href="{{ url('/') }}/category/{{ $menuParent->id }}/{{ $menuParent->slug }}">{{ $menuParent->name }}</a>
                      <?php 
                          $menuListChild = \App\Category::where('status', 1)->where('parent_id',$menuParent->id)->select('id', 'name', 'slug')->get();
                          if(count($menuListChild) > 0){
                      ?>
                      <ul>
                          <?php 
                              foreach ($menuListChild as $menuChild) {
                          ?>                                            
                          <li><a href="{{ url('/') }}/category/{{ $menuChild->id }}/{{ $menuChild->slug }}">{{ $menuChild->name }}</a></li> 
                          <?php
                              }
                          ?>                                 
                      </ul>
                      <?php
                          }
                      ?>
                  </li> 
              <?php
                  }
              ?>
            </ul>
          </nav>
        </div>
      </section>
      <section  class="homepage-slider" id="home-slider">
        <div class="flexslider">
          <ul class="slides">
            <li>
              <img src="{{ url('/') }}/public/themes/images/carousel/banner-1.jpg" alt="" />
            </li>
            <li>
              <img src="{{ url('/') }}/public/themes/images/carousel/banner-2.jpg" alt="" />
              <div class="intro">
                <h1>Mid season sale</h1>
                <p><span>Up to 50% Off</span></p>
                <p><span>On selected items online and in stores</span></p>
              </div>
            </li>
          </ul>
        </div>      
      </section>
      @yield('content')
      <section class="our_client">
        <h4 class="title"><span class="text">Manufactures</span></h4>
        <div class="row">         
          <div class="span2">
            <a href="#"><img alt="" src="{{ url('/') }}/public/themes/images/clients/14.png"></a>
          </div>
          <div class="span2">
            <a href="#"><img alt="" src="{{ url('/') }}/public/themes/images/clients/35.png"></a>
          </div>
          <div class="span2">
            <a href="#"><img alt="" src="{{ url('/') }}/public/themes/images/clients/1.png"></a>
          </div>
          <div class="span2">
            <a href="#"><img alt="" src="{{ url('/') }}/public/themes/images/clients/2.png"></a>
          </div>
          <div class="span2">
            <a href="#"><img alt="" src="{{ url('/') }}/public/themes/images/clients/3.png"></a>
          </div>
          <div class="span2">
            <a href="#"><img alt="" src="{{ url('/') }}/public/themes/images/clients/4.png"></a>
          </div>
        </div>
      </section>
      <section id="footer-bar">
        <div class="row">
          <div class="span3">
            <h4>Navigation</h4>
            <ul class="nav">
              <li><a href="./index.html">Homepage</a></li>  
              <li><a href="./about.html">About Us</a></li>
              <li><a href="./contact.html">Contac Us</a></li>
              <li><a href="./cart.html">Your Cart</a></li>
              <li><a href="./register.html">Login</a></li>              
            </ul>         
          </div>
          <div class="span4">
            <h4>My Account</h4>
            <ul class="nav">
              <li><a href="#">My Account</a></li>
              <li><a href="#">Order History</a></li>
              <li><a href="#">Wish List</a></li>
              <li><a href="#">Newsletter</a></li>
            </ul>
          </div>
          <div class="span5">
            <p class="logo"><img src="{{ url('/') }}/public/themes/images/logo.png" class="site_logo" alt=""></p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the  Lorem Ipsum has been the industry's standard dummy text ever since the you.</p>
            <br/>
            <span class="social_icons">
              <a class="facebook" href="#">Facebook</a>
              <a class="twitter" href="#">Twitter</a>
              <a class="skype" href="#">Skype</a>
              <a class="vimeo" href="#">Vimeo</a>
            </span>
          </div>          
        </div>  
      </section>
      <section id="copyright">
        <span>Copyright 2018 tranthanhtuan's template - All right reserved.</span>
      </section>
    </div>
    <script src="{{ url('/') }}/public/themes/js/common.js"></script>
    <script src="{{ url('/') }}/public/themes/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
      $(function() {
        $(document).ready(function() {
          $('.flexslider').flexslider({
            animation: "fade",
            slideshowSpeed: 4000,
            animationSpeed: 600,
            controlNav: false,
            directionNav: true,
            controlsContainer: ".flex-container" // the container that holds the flexslider
          });
        });
      });
    </script>
    </body>
</html>