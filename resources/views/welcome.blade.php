<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="keywords" content="{!! $_settings_data->seo_meta_keywords !!}" />
<meta name="description" content="{!! $_settings_data->seo_meta_description !!}">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">
<title>{!! $_settings_data->site_name !!}  </title>

<link href="/css/frontend/bootstrap.min.css" rel="stylesheet">
<link href="/css/frontend/bootstrap-theme.min.css" rel="stylesheet">
<link href="/css/frontend/responsive-layer-slider.css" rel="stylesheet">
<link href="/css/frontend/menumaker.css" rel="stylesheet">
<link href="/css/frontend/slick.css" rel="stylesheet">
<link href="/css/frontend/progressbar.css" rel="stylesheet">
<link href="/css/frontend/custom_style.css" rel="stylesheet">
<link href="/css/frontend/custom_responsive.css" rel="stylesheet">
<link href="/css/frontend/animate.css" rel="stylesheet">
@yield('styles')


<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!--<script src="/js/frontend/ie-emulation-modes-warning.js"></script>-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body>
<div class="header_strip wow fadeIn">
  <div class="container">
    <div class="row"> 
	@include('partials._headertop')  
    </div>
  </div>
</div>

<div class="menu_area wow fadeInDown">
	@include('partials._topmenu')
</div>

<div class="slider_area wow fadeInUp"> 
	@include('partials._slider')
</div>

<div class="grayBx_area">
  <div class="container">
    <div class="row">      
     

      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 wow fadeInLeft">
        <div class="ctgryLstBx catBxRgtPad ctgryLstBx-1">
          <h5>Categories</h5>
          <div class="ctgryLst">
		  @if( count($_categoryLists) > 0 )
            <ul>
			@foreach($_categoryLists as $val)
              <li><a href="javascript:void(0);" class="catList" list-type="categories" data-id="{{ $val->id}}" data-token="{{ csrf_token() }}" >{{ $val->name}}</a></li>
			  @endforeach
            </ul>
			@endif
          </div>
        </div>
      </div>	 
	 

      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 wow fadeInUp">
        <div class="mid_catview" >  
		<div class="catview_Slderaera" > <div id="loading" style="display:none">Loading....</div>	  
		<div class="single-item" id="setResult">
			@include('partials.show-project-all')
		</div>
		</div>
          
        </div>
		
      </div>
      <!-- mid part closed --> 
	  
	  
      
      <!-- right part open -->
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 wow fadeInRight">
        <div class="ctgryLstBx catBxLftPad ctgryLstBx-2">
          <h5>Genre</h5>
          <div class="ctgryLst">		  
		  @if( count($_genreLists) > 0 )
            <ul>
			@foreach($_genreLists as $val)
              <li><a href="javascript:void(0);" class="catList" list-type="genres" data-id="{{ $val->id}}" data-token="{{ csrf_token() }}" >{{ $val->name}}</a></li>
			  @endforeach
            </ul>
			@endif		  
          </div>
        </div>
      </div>	  
      <!-- right part closed --> 
      
    </div>
  </div>
</div>
<!-- category area closed --> 


<div class="whiteBx_area mostpopular">
	@include('partials._mostpopular')
</div>



<div class="progress_full_area" data-speed="80">
	@include('partials._apicontent')
</div>


<div class="grayBx_area recent_project">
@include('partials._recently_added');
</div>

<div class="newsLtrBxArea">
	@include('partials._newsletter')
</div>

<div class="footer_area">
@include('partials.footer')
</div>

<script src="/js/frontend/jquery-2.0.3.min.js"></script>
<script src="/js/frontend/bootstrap.min.js"></script>
<script src="/js/frontend/jquery.event.move.js"></script> 
<script src="/js/frontend/responsive-layer-slider.js"></script>
<script src="/js/frontend/menumaker.js"></script> 
<script src="/js/frontend/wow.js"></script>
<script src="/js/frontend/slick.js"></script> 
<script src="/js/frontend/jquery.knob.js"></script>
<script src="/js/frontend/progressbar.js"></script> 
<script src="/js/frontend/window-resize.js"></script>
<script src="/js/frontend/mfunder.ui.app.js"></script>




<script type="text/javascript">

$(document).ready(function() { 

	myApp.WowEffectHandler();
	myApp.slickImageHandler();
	myApp.knobItemHandler();
	myApp.menuMakerHandler();
	myApp.progressBarHandler();
	myApp.ajaxCatListHandler();
	myApp.progressFullAreaHandler();
	myApp.sliderHandler();

});


</script> 






<script src="/js/frontend/underscore-min.js"></script>
<script src="/js/frontend/backbone-min.js"></script>  
<!--  <script src="/js/frontend/listData.js"></script> -->
<script src="/js/frontend/customjs.js"></script> 


@yield('scripts')
</body>
</html>
