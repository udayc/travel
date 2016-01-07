<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>@yield('page_title')</title>
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
		<link href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="/admin/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/admin/assets/fonts/style.css">
		<link rel="stylesheet" href="/admin/assets/css/main.css">
		<link rel="stylesheet" href="/admin/assets/css/main-responsive.css">
		<link rel="stylesheet" href="/admin/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="/admin/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="/admin/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<!--<link rel="stylesheet/less" type="text/css" href="assets/css/styles.less">-->
		<link rel="stylesheet" href="/admin/assets/css/theme_light.css" type="text/css" id="skin_color">
		<!--[if IE 7]>
		<link rel="stylesheet" href="/admin/assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		@yield('styles')
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="/admin/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="favicon.ico" />
		
		<script src="/jquery.min.js"></script>
		<script src="/admin/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="/admin/assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="/admin/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="/admin/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="/admin/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="/admin/assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="/admin/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="/admin/assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
			});
		</script>
		@yield('scripts')
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
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
					<a class="navbar-brand" href="index.html">
						ADMIN AREA
					</a>
					<!-- end: LOGO -->
				</div>
				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					@include('agent.partials.topnav')
					<!-- end: TOP NAVIGATION MENU -->
				</div>
			</div>
			<!-- end: TOP NAVIGATION CONTAINER -->
		</div>
		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<!-- <div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>-->
					<!-- end: MAIN MENU TOGGLER BUTTON -->
					<!-- start: MAIN NAVIGATION MENU -->
					@include('agent.partials.leftbar')
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
						
				@yield('content')
			
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			@include('agent.partials.footer')	
		</div>
		<!-- end: FOOTER -->
		
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<![endif]-->
	</body>
	<!-- end: BODY -->
</html>