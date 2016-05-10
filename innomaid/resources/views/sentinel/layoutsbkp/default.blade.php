<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	
	  
    <link rel="shortcut icon" href="img/favicon.png">
  	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">  

    <title>Innomaid Admin</title>
	 <link rel="stylesheet" href="{{ asset('packages/rydurham/sentinel/css/jquery-ui-1.10.3.custom.min.css') }}">
    <!-- Bootstrap core CSS -->
<script src="{{ asset('packages/rydurham/sentinel/js/jquery-2.1.3.min.js') }}"></script>
	<!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
  	<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">   
   
 	<!-- <link rel="stylesheet" href="{{ asset('packages/rydurham/sentinel/css/jquery-ui-timepicker-addon.css') }}">-->
 	
 	<link rel="stylesheet" href="{{ asset('css/my-style.css') }}">  
 	<link rel="stylesheet" href="{{ asset('css/autocomplete.css') }}"> 
	      <link href="{{ asset('css/slidebars.css') }}" rel="stylesheet"/>

    <!-- Custom styles for this template -->
	

    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
 	<!-- Scripts -->
 	<script src="{{ asset('packages/rydurham/sentinel/js/jquery.js') }}"></script>
	<script src="{{ asset('packages/rydurham/sentinel/js/modernizr.js') }}"></script>
	<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
 	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
 	<script src="{{ asset('js/autocomplete.js') }}"></script>
 	<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
	  <script src="{{ asset('js/slidebars.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}" ></script>

 	<script src="{{ asset('packages/rydurham/sentinel/js/jquery-ui.js') }}"></script>
 	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>	
	     <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>

	<link href="{{ asset('css/bootstrap-reset.css') }}" rel="stylesheet"> 			
	<link href="{{ asset('front/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <!--  <link href="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>-->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('packages/rydurham/sentinel/css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('packages/rydurham/sentinel/css/foundation.min.css') }}">
      <!--right slidebar-->




    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <!--<a href="index.html" class="logo">Flat<span>lab</span></a>-->
			<a href="{{ url('/fdws/') }}" class="logo"><img src="{{ asset('front/images/logo.png') }}" style = "height:57px;"></a>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">{{ Auth::user()->email }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
									<li {{ (Request::is('profile') ? 'class="active"' : '') }}>
                            <a href="{{ url('/users/'.Auth::user()->id.'/edit?tab=tab0')}}"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            @if (Auth::user()->hasRole('admin'))
                            <li><a href="/role/"><i class="fa fa-tags"></i> Roles</a></li>
                            @endif
                            @if (Auth::user()->hasRole('user'))
                            <li><a href="/users/" ><i class="fa fa-user"></i> Users</a></li>
                            @endif
                            <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
								<!--<li {{ (Request::is('login') ? 'class="active"' : '') }}>
									<a href="{{ url('/auth/login') }}">Login</a>
								</li>-->
                        </ul>
                    </li>
                   <!-- <li class="sb-toggle-right">
                        <i class="fa  fa-align-right"></i>
                    </li>-->
                    <!-- user login dropdown end 
                </ul>
                <!--search & user info end
            </div>-->
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                      @if (Auth::user()->hasRole('admin'))
					<li {{ (Request::is('users*') ? 'class="active"' : '') }} >
						<a href="/users/" @if(Request::is('users*')) {{'class=active'}} @else '' @endif>
						<span><i class="fa fa-user"></i>Agencies</span>
						</a>
					</li>
					@endif
					<li {{ (Request::is('fdws*') ? 'class="active"' : '') }}>
						<a href="{{ url('/fdws/') }}"   @if(Request::is('fdws*') ||Request::is('home*')) {{'class=active'}} @else '' @endif><i class="fa fa-user"></i>FDW Profile</a>
					</li>
					<li {{ (Request::is('employer*') ? 'class="active"' : '') }}>
						<a href="{{ url('/employer/') }}"  @if(Request::is('employer*')) {{'class=active'}} @else '' @endif><i class="fa fa-user"></i>Employer</a> 
					</li>
          <li {{ (Request::is('users*') ? 'class="active"' : '') }}>
            <a href="/application/"  @if(Request::is('application*')) {{'class=active'}} @else '' @endif><i class="fa fa-tags"></i> Maid Application</a>
          </li>
		  <li {{ (Request::is('users*') ? 'class="active"' : '') }}>
						<a href="{{ url('/countries/') }}"  @if(Request::is('countries*')) {{'class=active'}} @else '' @endif><i class="fa fa-tags"></i> Countries </a>
					</li>
					<li class="sub-menu">
                      <a href="javascript:;"  @if(Request::is('servicefees*') || Request::is('service*')) {{'class=active'}} @else '' @endif>
              <span>Master Database</span>
            </a>
            <ul class="sub">
                <li class="sub-menu"> <a href="/service/" href="javascript:;" <?php if(isset($_REQUEST['mode'])){echo "class='active'"; }?>>Services</a>
                  <ul class="sub">
                    <li <?php if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'newtransfer'){echo "class='active'"; }?> ><a  href="/service/?mode=newtransfer">New/Transfer Service</a></li>
                    <li <?php if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'replacement'){echo "class='active'"; }?>><a  href="/service/?mode=replacement">Replacement Service</a></li> 
                  </ul> 
                </li>      
            </ul>
          </li>
				@if (Auth::user()->hasRole('admin'))
          <!--<li {{ (Request::is('users*') ? 'class="active"' : '') }}>
            <a href="/service/"  @if(Request::is('service*')) {{'class=active'}} @else '' @endif>Services</a>
          </li>-->
					<li {{ (Request::is('users*') ? 'class="active"' : '') }}>
						<a href="/page/"  @if(Request::is('page*')) {{'class=active'}} @else '' @endif><i class="fa fa-tags"></i> Static Pages</a>
					</li>
          
				@endif
               

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
	
			<!-- ./ notifications -->
		@include('sentinel.layouts.notifications')
	<!-- Page script-->
	@yield('page-script')
	<!-- Content -->
			@yield('content')
          </section>
      </section>
      <!--main content end-->

      <!-- Right Slidebar start -->
     
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
	

    <script class="include" type="text/javascript" src="{{ asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
    <!--<script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>-->
    <script src="{{ asset('js/jquery.sparkline.js') }}" type="text/javascript"></script>
    <!--<script src="{{ asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>-->
    <script src="{{ asset('js/jquery.customSelect.min.js') }}" ></script>
    <script src="{{ asset('js/respond.min.js') }}" ></script>
	 	
    <!--right slidebar-->
    <!--common script for all pages-->
     <script src="{{ asset('js/common-scripts.js') }}"></script>
	<!--script for this page-->
     <script src="{{ asset('js/sparkline-chart.js') }}"></script>
    <!--<script src="{{ asset('js/easy-pie-chart.js') }}"></script>-->
    <script src="{{ asset('js/count.js') }}"></script>
	<script src="{{ asset('packages/rydurham/sentinel/js/foundation.min.js') }}"></script>
	<script src="{{ asset('packages/rydurham/sentinel/js/restfulizer.js') }}"></script>
	<!-- Thanks to Zizaco for the Restfulizer script.  http://zizaco.net  -->
	<script>
		$(document).foundation();
	</script>
  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
  </script>
  <script>
  $('a.tooltip').attr('title');
  </script>
  <script>
  $(function() {
   $("a").click(function() {
      // remove classes from all
      $("a").removeClass("active");
      // add class to the one we clicked
      $(this).addClass("active");
   });
});
</script>
  </body>
</html>