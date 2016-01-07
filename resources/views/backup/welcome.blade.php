<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">
<title>Music Funders</title>
<!-- Bootstrap core CSS -->
<link href="/css/frontend/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="/css/frontend/bootstrap-theme.min.css" rel="stylesheet">
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


<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="/js/frontend/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Bootstrap core JavaScript  -->
<script src="/js/frontend/jquery.min.js"></script>
<script src="/js/frontend/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/js/frontend/ie10-viewport-bug-workaround.js"></script>

</head>

<body>

<!-- header strip open -->
<div class="header_strip wow fadeIn">
  <div class="container">
    <div class="row"> 
			<!-- Header-Top Start -->
			@include('partials._headertop')
			<!-- End Of Header-Top  -->       
    </div>
  </div>
</div>
<!-- header strip closed --> 

<!-- menu area open -->
<div class="menu_area wow fadeInDown">
	@include('partials._topmenu')
</div>
<!-- menu closed --> 

<!-- slider area open -->
<div class="slider_area wow fadeInUp"> 
  
  <!-- Responsive slider - START -->
	@include('partials._slider')
  <!-- Responsive slider - END --> 
  
</div>
<!-- slider area closed --> 

<!-- category area open -->
<div class="grayBx_area">
  <div class="container">
    <div class="row"> 
      
      <!-- left part open -->
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 wow fadeInLeft">
        <div class="ctgryLstBx catBxRgtPad ctgryLstBx-1">
          <h5>Categories</h5>
          <div class="ctgryLst">
            <ul>
              <li><a href="#">Track</a></li>
              <li class="catActive"><a href="#">Album</a></li>
              <li><a href="#">Video</a></li>
              <li><a href="#">Jingles</a></li>
              <li><a href="#">Category 1</a></li>
              <li><a href="#">Category 2</a></li>
              <li><a href="#">Category 3</a></li>
              <li><a href="#">Category 4</a></li>
              <li><a href="#">Category 5</a></li>
              <li><a href="#">Category 6</a></li>
              <li><a href="#">Category 7</a></li>
              <li><a href="#">Category 8</a></li>
              <li><a href="#">Category 9</a></li>
              <li><a href="#">Category 10</a></li>
              <li><a href="#">Category 11</a></li>
              <li><a href="#">Category 12</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- left part closed --> 
      
      <!-- mid part open -->
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 wow fadeInUp">
        <div class="mid_catview"> 
          <!-- slider area open -->
          <div class="catview_Slderaera"> 
            <!-- slider open -->
            <div class="single-item"> 
              
              <!-- slide open -->
              <div>
                <h3>Staff Pick - Rock</h3>
                <div class="catview_IMG"><img src="/images/frontend/home-category-pic-1.jpg" alt="" border="0"></div>
                <h3 class="subH3">Feelin' Groovy? Fund "Folk Legends" Michael Monroe's NEW CD!</h3>
                <p>by Michael Monroe</p>
                
                <!-- detail area open -->
                <div class="catviewDtetlArea"> 
                  <!-- left part open -->
                  <div class="catLftBx">
                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. quis nostrud exercitation ullamco laboris nisi ut aliquip. quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                  </div>
                  <!-- left part closed --> 
                  
                  <!-- right part open -->
                  <div class="catRgtBx">
                    <div class="knob_lft">
                      <input class="knob" data-width="100%" value="54" data-fgColor="#5a62ab" data-thickness=".3" readonly>
                    </div>
                    <div class="knob_rgt">
                      <p><span>54%</span> funded<br>
                        <span>$16,469</span> pledged<br>
                        <span>783</span> backers<br>
                        <span>11</span> days to go </p>
                    </div>
                    <a href="project-detail.html" class="orenge_btn">Explore Project</a> </div>
                  <!-- right part closed --> 
                  
                </div>
                <!-- detail area closed --> 
                
              </div>
              <!-- slide closed --> 
              
              <!-- slide open -->
              <div>
                <h3>Staff Pick - Rock</h3>
                <div class="catview_IMG"><img src="/images/frontend/home-category-pic-1.jpg" alt="" border="0"></div>
                <h3 class="subH3">Feelin' Groovy? Fund "Folk Legends" Michael Monroe's NEW CD!</h3>
                <p>by Michael Monroe</p>
                
                <!-- detail area open -->
                <div class="catviewDtetlArea"> 
                  <!-- left part open -->
                  <div class="catLftBx">
                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. quis nostrud exercitation ullamco laboris nisi ut aliquip. quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                  </div>
                  <!-- left part closed --> 
                  
                  <!-- right part open -->
                  <div class="catRgtBx">
                    <div class="knob_lft">
                      <input class="knob" data-width="100%" value="54" data-fgColor="#5a62ab" data-thickness=".3" readonly>
                    </div>
                    <div class="knob_rgt">
                      <p><span>54%</span> funded<br>
                        <span>$16,469</span> pledged<br>
                        <span>783</span> backers<br>
                        <span>11</span> days to go </p>
                    </div>
                    <a href="project-detail.html" class="orenge_btn">Explore Project</a> </div>
                  <!-- right part closed --> 
                  
                </div>
                <!-- detail area closed --> 
                
              </div>
              <!-- slide closed --> 
              
            </div>
            <!-- slider closed --> 
          </div>
          <!-- slider area closed --> 
        </div>
      </div>
      <!-- mid part closed --> 
      
      <!-- right part open -->
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 wow fadeInRight">
        <div class="ctgryLstBx catBxLftPad ctgryLstBx-2">
          <h5>Genre</h5>
          <div class="ctgryLst">
            <ul>
              <li><a href="#">African</a></li>
              <li class="catActive"><a href="#">Asian</a></li>
              <li><a href="#">Avant-garde</a></li>
              <li><a href="#">Blues</a></li>
              <li><a href="#">Caribbean</a></li>
              <li><a href="#">Caribbean-influenced</a></li>
              <li><a href="#">Comedy</a></li>
              <li><a href="#">Country</a></li>
              <li><a href="#">Easy listening</a></li>
              <li><a href="#">Electronic</a></li>
              <li><a href="#">Folk</a></li>
              <li><a href="#">Hip hop</a></li>
              <li><a href="#">Jazz</a></li>
              <li><a href="#">Latin</a></li>
              <li><a href="#">Brazilian</a></li>
              <li><a href="#">Pop</a></li>
              <li><a href="#">R&B and soul</a></li>
              <li><a href="#">Rock</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- right part closed --> 
      
    </div>
  </div>
</div>
<!-- category area closed --> 

<!-- most popular area open -->
<div class="whiteBx_area mostpopular">
	@include('partials._mostpopular')
</div>
<!-- most popular area closed --> 

<!-- progress area open -->
<div class="progress_full_area" data-speed="80">
	@include('partials._apicontent')
</div>
<!-- progress area closed --> 

<!-- Recent add area open -->
<div class="grayBx_area recent_project">
@include('partials._recently_added');
</div>
<!-- Recent add area closed --> 

<!-- Recent add area open -->
<!--
<div class="whiteBx_area recent_project"></div>
-->

<!-- Recent add area closed --> 

<!-- newsletter subscription area open -->
<div class="newsLtrBxArea">
	@include('partials._newsletter')
</div>
<!-- newsletter subscription area closed --> 

<!-- footer open -->
<div class="footer_area">
@include('partials.footer')
</div>
<!-- footer closed --> 

<!-- slider script open --> 
<script src="/js/frontend/jquery.event.move.js"></script> 
<script src="/js/frontend/responsive-layer-slider.js"></script> 
<!-- slider script closed --> 

<!-- responsive menu script --> 
<script src="/js/frontend/menumaker.js"></script> 
<script type="text/javascript">
	$("#cssmenu").menumaker({
		title: "Menu",
		format: "multitoggle"
	});
</script> 

<!-- page animation script open --> 
<script src="/js/frontend/wow.js"></script> 
<script> new WOW().init(); </script> 
<!-- page animation script closed --> 


@yield('scripts')
</body>
</html>
