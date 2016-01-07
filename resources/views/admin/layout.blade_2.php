<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>Admin : Music Funder</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">		
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/fonts/style.css">
		<link rel="stylesheet" href="/css/main.css">
		<link rel="stylesheet" href="/css/main-responsive.css">
		<link rel="stylesheet" href="/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="/css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->		
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		@yield('styles')	
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->		
		<link rel="shortcut icon" href="favicon.ico" />
		
	</head>
	<!-- end: HEAD -->
	
	
	<!-- start: BODY -->
	<body class="page-full-width">
	
		<!-- start: HEADER -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<!-- start: TOP NAVIGATION CONTAINER -->
			<div class="container">
			
				<div class="navbar-header">
					<!-- start: RESPONSIVE MENU TOGGLER -->
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<!-- end: RESPONSIVE MENU TOGGLER -->
					
					<!-- start: LOGO -->
					<a class="navbar-brand" href="<?php echo url(); ?>/admin/dashboard">
						<span style="font-weight:bold; font-family:	'Raleway',sans-serif;">ADMIN AREA</span>
					</a>

					<!-- end: LOGO -->
					
				</div>
				
				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					@include('admin.partials.navbar-tools')
					<!-- end: TOP NAVIGATION MENU -->
				</div>
				
				<!-- start: HORIZONTAL MENU -->
					<div class="horizontal-menu navbar-collapse collapse">
					 @include('admin.partials.navbar')
					</div>
				<!-- end: HORIZONTAL MENU -->
				
				 
			</div>
			<!-- end: TOP NAVIGATION CONTAINER -->
		</div>
		<!-- end: HEADER -->
		
		
		
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<!-- start: PAGE -->
			<div class="main-content">
				@yield('content')
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			@include('admin.partials.footer')
		</div>
		<!-- end: FOOTER -->

		<!-- start: MAIN JAVASCRIPTS -->
		<script type="text/javascript" >
			base_url='<?php echo url(); ?>';
		</script>		
		<!--[if lt IE 9]>
		<script src="/plugins/respond.min.js"></script>
		<script src="/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
		
		<!--[if gte IE 9]><!-->
		<script src="/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="/plugins/less/less-1.5.0.min.js"></script>
		<script src="/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="/js/main.js"></script>

		<!-- end: MAIN JAVASCRIPTS -->		
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		@yield('scripts')
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	</body>
	<!-- end: BODY -->
</html>