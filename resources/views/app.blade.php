<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" href="favicon.ico">
<title>Music Funders</title>
<!-- Bootstrap core CSS -->
<link href="/css/frontend/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="/css/frontend/bootstrap-theme.min.css" rel="stylesheet">

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- layer slider css -->
<link href="/css/frontend/responsive-layer-slider.css" rel="stylesheet">
<!-- responsive header menu css -->
<link href="/css/frontend/menumaker.css" rel="stylesheet">
<!-- slider css -->
<link href="/css/frontend/slick.css" rel="stylesheet">
<!-- progress css -->
<link href="/css/frontend/progressbar.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="/css/frontend/custom_style.css" rel="stylesheet">
<!-- Custom resposive for this template -->
<link href="/css/frontend/custom_responsive.css" rel="stylesheet">
<!-- Animation for this template -->
<link href="/css/frontend/animate.css" rel="stylesheet">

@yield('styles')

<script type="text/javascript" >
	var base_url='<?php echo url();?>';
</script>	
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script>
<script src="/js/frontend/ie-emulation-modes-warning.js"></script>
<![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Bootstrap core JavaScript  -->
<!-- <script src="/js/frontend/jquery.min.js"></script> -->
<script src="/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
<script src="{!! asset('js/csrf.js') !!}"></script>
<script src="/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
<script src="/js/frontend/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!-- <script src="/js/frontend/ie10-viewport-bug-workaround.js"></script> -->

</head>

<body class = "grayBody" >


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


@yield('content')



<div class="newsLtrBxArea">
	@include('partials._newsletter')
</div>



<div class="footer_area">
@include('partials.footer')
</div>



<script src="/js/frontend/menumaker.js"></script> 
<script src="/js/frontend/wow.js"></script> 
<script src="/js/frontend/jquery.knob.js"></script> 
<script src="/js/frontend/mfunder.ui.app.js"></script>
<script src="/js/frontend/customjs.js"></script> 
<script type="text/javascript">

$(document).ready(function() { 

	myApp.WowEffectHandler();
	myApp.menuMakerHandler();
});


</script> 
@yield('scripts')
</body>
</html>
