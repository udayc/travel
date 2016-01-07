  @if( count($_sliders) > 0 )
  <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
    <div class="slides" data-group="slides">
	
      <ul>
	  @foreach($_sliders as $k => $slider)
		@if( !empty($slider->banner_picture) )
        <li>
          <div class="slide-body" data-group="slide">
		  <img src="/uploaded/homebanner/{{ $slider->banner_picture }}" alt="{{ $slider->banner_title }}" border="0" width="1400" height="623">
            <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
              <h2>{{ $slider->banner_title }}</h2>
              <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="800" data-length="300">{!! $slider->banner_desc !!}</div>
              <div class="caption sub2" data-animate="slideAppearRightToLeft" data-delay="1300" data-length="300"><a class="request_demo_btn_sld" href="{{ $slider->banner_link }}">Explore</a> </div>
            </div>
          </div>
        </li> 
		@endif
		@endforeach
		<!--
        <li>
          <div class="slide-body" data-group="slide"> <img src="/images/frontend/banner-slider/banner-2.jpg" alt="" border="0">
            <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
              <h2>Guaranteed Returns</h2>
              <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="800" data-length="300">sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
              <div class="caption sub2" data-animate="slideAppearRightToLeft" data-delay="1300" data-length="300"> <a class="request_demo_btn_sld">Explore</a> </div>
            </div>
          </div>
        </li>
		-->
      </ul>
	  
	  
    </div>
	
    <a class="slider-control left" href="javascript:void(0);" data-jump="prev">Prev</a> <a class="slider-control right" href="javascript:void(0);" data-jump="next">Next</a> 
	
	</div>
	@endif
	
	
	
	
	
	
	
	
	
<div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
<div class="slides" data-group="slides" id="bannermsg">
</div>	
<a class="slider-control left" href="javascript:void(0);" data-jump="prev">Prev</a> <a class="slider-control right" href="javascript:void(0);" data-jump="next">Next</a> 
</div>
<script type='text/template' id='listBannerListsTemplate'>
	  
	<% if ($.isEmptyObject(bannerlist)) { %>
		No Record Found
	<% } else {
	$.each(bannerlist, function () 
	{ 
	
	%>
	<% if (this.banner_picture !="") { %>
	<li>
		<div class="slide-body" data-group="slide">
		<img src="/uploaded/homebanner/<%= this.banner_picture %>" alt="<%= this.banner_title %>" border="0" width="1400" height="623">
		<div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
		<h2><%= this.banner_title %></h2>
		<div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="800" data-length="300"><%= this.banner_desc %></div>
		<div class="caption sub2" data-animate="slideAppearRightToLeft" data-delay="1300" data-length="300"><a class="request_demo_btn_sld" href="<%= this.banner_link %>">Explore</a> </div>
		</div>
		</div>
	</li> 	
	<% } %>

	<%  
	});
	
	}
	%>		  


</script>		
	
	
	
	