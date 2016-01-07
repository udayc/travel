<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="keywords" content="matrix media , crowdfund, crowdfunding, kickstarter clone, fundbreak clone, thepoint clone, Sponsume clone, RocketHub clone" />
<meta name="description" content="Crowdfunding helps you develop different clone in a crowdfunding fashion">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">
<title>Music Funder Updated  </title>

<link href="/css/frontend/bootstrap.min.css" rel="stylesheet">
<link href="/css/frontend/bootstrap-theme.min.css" rel="stylesheet">
<link href="/css/frontend/responsive-layer-slider.css" rel="stylesheet">
<link href="/css/frontend/menumaker.css" rel="stylesheet">
<link href="/css/frontend/slick.css" rel="stylesheet">
<link href="/css/frontend/progressbar.css" rel="stylesheet">
<link href="/css/frontend/custom_style.css" rel="stylesheet">
<link href="/css/frontend/custom_responsive.css" rel="stylesheet">
<link href="/css/frontend/animate.css" rel="stylesheet">


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

<div class="whiteBx_area mostpopular">
	<div class="container">
    <div class="row">     
      <!-- box area open -->
      <div class="mstPoprlBxArea">		
	@if ( count($_featuredProducts) > 0 ) 		
        @foreach($_featuredProducts as $i => $project)
        <!-- box open -->
        <div class="mstPoprlBx wow @if($i == 0 ) fadeInLeft @elseif ($i == 1) fadeInUp @elseif ($i == 2) fadeInRight @endif ">

          <div class="mstPoprlImgBx"><a href="{{ URL::to('project/'.$project->id . '/' . $project->slug)}}"  title="{{ $project->name }}" >
		  <img src="/images/file-attached-to-project/resize/{{ $project->file_attachment }}" alt="{{ $project->file_attachment }}" border="0" width="328" height="168"></a>
		 @if($project->status == 3) <span class="mTagBx"><img src="/images/frontend/tag-icon.png" alt="" border="0"></span> @endif
		  <span class="imgBlkStrip">{{ $project->category()->first()->name }}</span></div>
          <h6><a href="{{ URL::to('project/'.$project->id . '/' . $project->slug)}}"  title="{{ $project->name }}" >{!! str_limit($project->name, $limit = 30, $end = '...') !!}</a><span>by {{ $project->user()->first()->name }}</span></h6>

          <p> {!! str_limit($project->short_description, $limit = 130, $end = '...') !!}</p>
          <div class="ratebox">
            <div class="price">{{ $_settings_data->site_currency_symbol }}{{ number_format($project->funding_goal, 0, '.', ',')  }} <span>{{ $_settings_data->currency }}</span></div>
            <div class="dayss">@if( $project->days_to_go > 0) {{ $project->days_to_go }}  days to go @endif</div>
          </div>
          <div class="mstPoprlBxKnob">
            <input class="knob" data-width="100%" value="{{ $_funded }} " data-fgColor="#e4be22" data-thickness=".2" readonly>
          </div>
          <div class="KnbtxtArea">
            <div class="KnbtxtAreaUl">
              <ul>
                <li><span>{{ $_funded}}</span> funded</li>
                <li><span>{{ $_totalBackers }}</span> backers</li>
                <li><span>{{ $_settings_data->site_currency_symbol }} {{ $_totalFunds}}</span> pledged</li>
                <li><span></span>@if( $project->days_to_go > 0) {{ $project->days_to_go }}  days to go @endif</li>
              </ul>
            </div>
            <a href="{{ Url::to('project/'.$project->id . '/' . $project->slug)}}" class="viewAll knbBtn">Explore Project</a> </div>
        </div>
        <!-- box closed --> 
        @endforeach		
	@endif        
      </div> 
    </div>
  </div></div>

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
//
});


</script> 






<script src="/js/frontend/underscore-min.js"></script>
<script src="/js/frontend/backbone-min.js"></script>  
<!--  <script src="/js/frontend/listData.js"></script> -->
<script src="/js/frontend/customjs.js"></script> 


</body>
</html>
