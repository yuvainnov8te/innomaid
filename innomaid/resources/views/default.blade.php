<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Innomaid</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
	<script src="{{ asset('front/js/jquery-1.10.2.min.js') }}"></script> 
     <link rel="stylesheet" href="{{ asset('packages/rydurham/sentinel/css/jquery-ui-1.10.3.custom.min.css') }}"> 
   <script src="{{ asset('packages/rydurham/sentinel/js/jquery-ui.js') }}"></script>
<script src="{{ asset('front/js/scripts.js') }}"></script> 
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('front/js/jquery.infinitescroll.min.js') }}"></script>
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/custom-mediaqueries.css') }}" rel="stylesheet">
    <script src="{{ asset('front/js/jquery.imagebox.js') }}"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Custom Fonts -->
    <link href="{{ asset('front/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
		<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
    <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	 
    @yield('head')
  </head>

<script type="text/javascript">
  function submit(country){
    $('#'+country).submit();
  }
// Added By : Neha Pareek. Dated : 07-11-2015 (to hide left navigation menu box)  
jQuery(document).ready(function($) {
  jQuery('#btnclose').click(function(){
  jQuery(this).parents('.row-offcanvas-left').removeClass('active');
  });
});
  
  /* jQuery(document).ready(function($) {
  jQuery('#btnclose').click(function() {
    jQuery(this).parent('.row-offcanvas').hide();
  });
});

 document.getElementById('btnclose').addEventListener('click',function(e)
  {  this.parentNode.parentNode.parentNode
        .removeChild(this.parentNode.parentNode.parentNode);
        return false;}) */
  </script>

  <body>
<div class="sidebar-nav">

</div>
  <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-left">
           <div class="col-sm-3 col-md-2 sidebar-offcanvas mygred-menu-block navi-left custom-height" id="sidebar" role="navigation">
            <div class="logo clearfix"> <a href="{{ url('/') }}" ><img src="{{ asset('front/images/logo.png') }}" class="img-responsive pull-left"> 
			<!--<p style="font-size:13px;">Your most trusted Maid portal</p>--></a> 
			<button type="button" id="btnclose" class="btn btn-default pull-right" name="close" value="Close" >
			<i class="fa fa-remove"></i>
			</button></div>
			
			
           <!-- <div class="my-search">
              <form action="#" class="search-form" method="get" role="search">
                <label>
                  <input type="search" title="Search for:" name="s" value="" placeholder="Search …" class="search-field">
                </label>
                <input type="submit" value="Search" class="search-submit">
              </form>
            </div>-->
            <div class="divider "></div>
            <div class="os_menu">
            <!--<ul class="nav ">Search Maid
                <li class="active"><a style="font-size:0.8em;" href="#">> Show All Bio Data</a></li>
                <li><a style="font-size:0.8em;" href="#">> Filipino Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Indonesian Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Myanmarese Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Indian Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Bangladeshi Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Sri Lankan Maid</a></li>
                 <li><a style="font-size:0.8em;" href="#">> Fresh Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Transfer Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Ex-Singapore Maid</a></li>
                <li><a style="font-size:0.8em;" href="#">> Experienced Maid</a></li>
              </ul>-->
              <ul class="nav ">
                <li><a href="{{ url('/') }}"  @if(Request::is('/')) {{'class=active'}} @else '' @endif>Home</a></li>
                  <li>
                    <a href="{{ url('/') }}" >
                      Search Maid
                    </a>
					</li>
				<div style="" class="side-bar-text">
					<li><a style='cursor:pointer;font-weight:500;' href="{{url('search/All')}}">Show All Bio Data</a></li>
                          <li><a style='cursor:pointer;font-weight:500;' href="{{url('search/Philippines')}}">Philippines Maid</a>
                  
                      </li>
                  
                          <li><a style='cursor:pointer;font-weight:500;' href="{{url('search/Indonesian')}}">Indonesian Maid</a>
                      </li>
                     
						  <li>
                          <a style='cursor:pointer;font-weight:500;' href="{{url('search/Myanmarese')}}">Myanmarese Maid</a>
						</li>
                  
						  <li>
                          <a style='cursor:pointer;font-weight:500;' href="{{url('search/Indian')}}">Indian Maid</a>
                      </li>
                
                          <li><a style='cursor:pointer;font-weight:500; 'href="{{url('search/Bangladeshi')}}">Bangladeshi Maid</a>
                     </li>


						  <li>
                          <a style='cursor:pointer;font-weight:500;' href="{{url('search/Sri-Lankan')}}">Sri Lankan Maid</a>
                      </li>

						  <li>
                          <a style='cursor:pointer;font-weight:500;'href="{{url('search/Transfer')}}">Transfer Maid</a>
                      </li>
                

						  <li>
                          <a style='cursor:pointer;font-weight:500;' href="{{url('search/Experienced')}}">Experienced Maid</a>
                      </li>

                </div>
                <li><a href="{{url('/maid-agency')}}" @if(Request::is('maid-agency*')) {{'class=active'}} @else '' @endif>Maid Agency</a></li>
                <li><a href="{{url('/FAQ')}}"  @if(Request::is('FAQ*')) {{'class=active'}} @else '' @endif>F&Q</a></li>
                <li><a href="{{url('/usefullinks')}}"  @if(Request::is('usefullinks*')) {{'class=active'}} @else '' @endif>Useful Links</a></li>
                <li><a href="{{url('/requestmaid')}}"  @if(Request::is('requestmaid*')) {{'class=active'}} @else '' @endif>Request Maid</a></li>
                <li id="addcart"><a href="{{url('/myshortlist')}}"  @if(Request::is('myshortlist*')) {{'class=active'}} @else '' @endif>My Shortlisted @if(Cart::count(false))({{ Cart::count(false) }}) @endif</a></li>
                <li><a href="{{url('/aboutus')}}"  @if(Request::is('aboutus*')) {{'class=active'}} @else '' @endif>About Us</a></li>
              </ul>
            </div>
            <div class="divider"></div>
            <!--<div class="zilla-social size-32px "> <a class="Facebook" href="#"><img alt="Facebook" src="{{ asset('front/images/facebook.png') }}"></a> <a class="LinkedIn" href="#"><img alt="LinkedIn" src="{{ asset('front/images/LinkedIn.png') }}"></a> <a class="Pinterest" href="#"><img alt="Pinterest" src="{{ asset('front/images/Pinterest.png') }}"></a> <a class="Twitter" href="#"><img alt="Twitter" src="{{ asset('front/images/Twitter.png') }}"></a> </div>-->
          </div>
		   
           <div class="col-sm-9 col-md-10 main navi-right"><!--edited : 06-11-2015 -->
         
			 <div id='top-fix'>
          <div class="btn1" style="float: right;"><a class="btn2" data-toggle="collapse" data-target="#demo" id="btn1" href="{{url('admin')}}" style="padding-right:5px;">
            Agency Login  |</a><a class ="btn2" href="{{url('joininnomaid')}}" style="padding-left:0px !important;">Join Innomaid</a>
          </div>
        </div>
  			<div class="row "> 
            <!--toggle sidebar button-->
            <div class="row container padding-none">
              <span class="visible-xs pull-left">
                <button type="button" class="btn custom-btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-bars"></i> MENU</button>
              </span> <span class="visible-xs pull-right">
              <img src="{{ asset('front/images/logo.png') }}" class="img-responsive">
              </span>
            </div>
        </div>
       <!--<div id="demo" class="collapse">
          <div class="col-md-10 col-md-offset-1 form-box-popup">              
          </div>                    
        </div>-->
            @yield('main')
    
      </div>
  </div>

    <footer class='container-fluid margin-none'>
       <div class='footer'>Copyright &copy 2015 innomaid</div>
    </footer>

<script>
  $('#myCarousel').carousel({
    interval:   4000
  });
   
$('.navi-left').css('min-height', $('.navi-right').height()+20+'px');
  $('.main').css('height', $(window).height()+'px');
  //$('.main').css('overflow', 'scroll');
  //$('.main').css('overflow-x', 'hidden');
</script>


<script>
$(document).ready(function(){
  $("#demo").on("hide.bs.collapse", function(){
    $("#btn1").html('<span class="fa fa-chevron-down"></span> Agency Login | Join Innomaid');
  });
  $("#demo").on("show.bs.collapse", function(){
    $("#btn1").html('<span class="fa fa-chevron-up"></span> Agency Login | Join Innomaid');
  });
});
</script>
<link rel="stylesheet" href="{{ asset('front/css/msnry.css') }}"  />
<script src="{{ asset('front/js/msnory-js/modernizr-transitions.js') }}"></script>
<script src="{{ asset('front/js/msnory-js/jquery.masonry.js') }}"></script> 
  <script src="{{ asset('front/js/msnory-js/jquery.infinitescroll.min.js') }}"></script> 
  <script>
  $(function(){
    //alert($(".navi-right").height());
    $('[data-toggle="tooltip"]').tooltip();
    var $container = $('#container');
    
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: '.box',
        columnWidth: 5,
        isAnimated: !Modernizr.csstransitions
      });
    });
    
    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation 
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.box',     // selector for all items you'll retrieve
      donetext  : 'No more pages to load.',
      loadingImg : 'http://i.imgur.com/6RMhx.gif',
      debug: false,
      errorCallback: function() { 
        // fade out the error message after 2 seconds
        $('#infscr-loading').animate({opacity: .8},2000).fadeOut('normal');   
      }
      },
      // call Masonry as a callback
      function( newElements ) {
        var $newElems = $( newElements );
        // position elements at the bottom center
        $newElems.css({
          left: $container.width() / 2,
          top: $container.height(),
        })
        
        // pause so it appears new items get added from bottom 
        setTimeout( function(){
          // ensure that images load before adding to masonry layout
          $newElems.imagesLoaded(function(){
            $container.masonry( 'appended', $newElems ); 
          });
          
        }, 10 );
        
      }
    );
    
  });
</script>
  @yield('scripts')

  </body>
</html>