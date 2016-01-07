<div class="container">
<div class="row">
<h3 class=" wow fadeInUp">Recently added projects<br>
<span>sed do eiusmod tempor incididunt ut labore iusmod tempor incididunt</span> 
<a href="{{ URL::to('project/lists/recent') }}" class="viewAll">View all Projects</a> 
</h3>
<!-- box area open -->
<div class="mstPoprlBxArea"> 
	@if ( count($_recently_added) > 0 ) 		
        @foreach($_recently_added as $i => $project)
        <div class="mstPoprlBx wow @if($i == 0 ) fadeInLeft @elseif ($i == 1) fadeInUp @elseif ($i == 2) fadeInRight @endif ">
          <div class="mstPoprlImgBx"><a href="{{ URL::to('project/'.$project->id . '/' . $project->slug)}}" title="{!! $project->name !!}" > 
		  <img src="/images/file-attached-to-project/resize/{{ $project->file_attachment }}" alt="{{ $project->file_attachment }}" border="0" width="328" height="168"></a>
		  @if($project->status == 3) <span class="mTagBx"><img src="/images/frontend/tag-icon.png" alt="" border="0"></span> @endif
		  <span class="imgBlkStrip">{{ $project->category }}</span></div>
          <h6><a href="{{ URL::to('project/'.$project->id . '/' . $project->slug)}}" title="{!! $project->name !!}" >{!! $project->name !!}</a>
		  <span>by {{ $project->posted_by }}</span></h6>
          <p>{!! str_limit($project->short_description, $limit = 130, $end = '...') !!}</p>
          <div class="ratebox">
            <div class="price">{{ $_settings_data->site_currency_symbol }}{{ number_format($project->funding_goal, 0, '.', ',')  }} <span>{{ $_settings_data->currency }}</span></div>
            <div class="dayss">@if( $project->days_to_go > 0) {{ $project->days_to_go }}  days to go @endif</div>
          </div>
          <div class="mstPoprlBxKnob">
            <input class="knob" data-width="100%" value="{{ $project->_pof}}" data-fgColor="#e4be22" data-thickness=".2" readonly>
          </div>
          <div class="KnbtxtArea">
            <div class="KnbtxtAreaUl">
              <ul>
               <li><span>{{ $project->_pof}}</span> funded</li>
                <li><span>{{ $project->_total_backers_on_project}}</span> backers</li>
               <li><span>{{ $_settings_data->site_currency_symbol }} {{ $project->_total_pledge_amount}}</span> pledged</li>
                <li><span></span>@if( $project->days_to_go > 0) {{ $project->days_to_go }}  days to go @endif</li>
              </ul>
            </div>
            <a href="{{ Url::to('project/'.$project->id . '/' . $project->slug)}}" class="viewAll knbBtn">Explore Project</a> </div>
        </div>    
         @endforeach
	@endif
</div>
</div>
</div>