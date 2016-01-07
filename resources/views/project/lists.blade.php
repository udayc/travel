@extends('app')

@section('content')



<div class="innrPgArea"> 
  

  <div class="whiteBx_area Project-listing">
    <div class="container">
      <div class="row"> 
        

        <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12 wow fadeInLeft">
          <div class="ctgryLstBx catBxRgtPad">
            <h5>Genre</h5>
            <div class="ctgryLst mobile_catMenu-1">
              <ul>
			@if(isset($_exploreBy) && $_exploreBy == 'categories')
			
					@foreach($_leftCatLists as $cat)
					<li><a href="/project/lists/categories/{{  $cat->category_slug }}">{{ $cat->name}}</a></li>
					@endforeach
			@else
			
					@foreach($_leftCatLists as $cat)
					<li @if( isset($_catObj->id) && $_catObj->id == $cat->id ) class="catActive" @endif ><a href="/project/lists/genres/{{  $cat->genre_slug }}">{{ $cat->name}}</a></li>
					@endforeach		
			
			@endif	

              </ul>
            </div>
          </div>
        </div>

          <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12 wow fadeInUp"> 
          

          <div class="innrPgBnrArea"> <img src="/images/frontend/project-listing-banner.jpg" alt="" border="0">
            <div class="bannerTxt">{{ $_catObj->name or null}}</div>
          </div>

  @if( count($_projectLists) > 0 )
  
	<div class="listing_Head_name">
	<h3><samp>{{ $_catObj->name or null}}</samp>
	<div class="listing_ul"> <span>Sort by:</span>
	<ul>
	<li><a href="{{ Request::url().'?t=closing-soon' }}" @if(  Input::get('t') == 'closing-soon' )) class="listActv" @endif >Closing Soon</a></li>
	<li><a href="{{ Request::url().'?t=most-recent' }}" @if(  Input::get('t') == 'most-recent' )) class="listActv" @endif >Most Recent</a></li>
	<li><a href="{{ Request::url().'?t=most-funded' }}" @if( Input::get('t') == 'most-funded' )) class="listActv" @endif>Most Funded</a></li>
	</ul>
	</div>
	</h3>
	</div>

        
          <!-- box area open -->
          <div class="mstPoprlBxArea"> 
            <?php $index=0;?>
            @foreach( $_projectLists as  $project)
		   <!-- box open -->
		   <?php $index++ ;?>
            <div class="mstPoprlBx wow @if($index == 1 ) fadeInLeft @elseif ($index == 2) fadeInUp @elseif ($index == 3) fadeInRight @endif">
              <div class="mstPoprlImgBx"><a href="{{ URL::to('project/'.$project->id . '/' . $project->slug)}}" title="{{ $project->name }}" >  
			   <img src="/images/file-attached-to-project/resize/{{ $project->file_attachment }}" alt="{{ $project->name }}" border="0" width="328" height="168"></a>
			@if($project->status == 3) <span class="mTagBx"><img src="/images/frontend/tag-icon.png" alt="" border="0"></span> @endif
			  </div>
              <h6>
			  <a href="{{ URL::to('project/'.$project->id . '/' . $project->slug)}}" title="{{ $project->name }}" >{!! str_limit($project->name, $limit = 30, $end = '...') !!}</a>
			  <span> by {{ $project->posted_by }}</span>
			  </h6>
              <p> {!! str_limit($project->short_description, $limit = 130, $end = '...') !!}</p>
              <div class="ratebox">
                <div class="price">
				{{ $_settings_data->site_currency_symbol }}{{ number_format($project->funding_goal, 0, '.', ',')  }}  <span>{{ $_settings_data->currency }}</span>
				</div>
                <div class="dayss"> @if( $project->days_to_go > 0) <span>{{ $project->days_to_go }}</span> @endif day to go</div>
              </div>
              <div class="mstPoprlBxKnob">
                <input class="knob" data-width="100%" value="{{ $project->_pof}}" data-fgColor="#5a62ab" data-thickness=".2" readonly>
              </div>
              <div class="KnbtxtArea">
                <div class="KnbtxtAreaUl">
                  <ul>
                    <li><span>{{ $project->_pof}}</span> funded</li>
                    <li><span>{{ $project->_total_backers_on_project}}</span> backers</li>
                    <li><span>{{ $_settings_data->site_currency_symbol }} {{ $project->_total_pledge_amount}}</span> pledged</li>
                    <li>
					@if($project->funding_end_date > date("Y-m-d"))
						@if( $project->days_to_go > 0) <span>{{ $project->days_to_go }}</span> @endif days to go
					@else
						<a class="listActv">Expired</a>
					@endif	
					</li>
                  </ul>
                </div>
                <a href="{{ url('project/'.$project->id . '/' . $project->slug)}}" class="viewAll knbBtn">Explore Project</a> </div>
            </div>
			@if($index == 3 )
			 <div class="list_devdr">&nbsp;</div>
			 <?php $index = 0; ?>
			@endif	
			
             @endforeach
			 
            <!-- box open -->

            <!-- box closed --> 
            
            <!-- box open -->

            <!-- box closed -->
            
           
            
            <!-- box open -->

            <!-- box closed --> 
            
            <!-- box open -->

            <!-- box closed --> 
            
            <!-- box open -->


            
          </div>
		  
			@if( count($_projectLists) > 12 ) 
			<a href="#" class="loadMore"><span>Load more projects</span></a> 
			@endif
			
	
	@else
	No Records Found !	
		
	@endif
       

  </div>


   
        
      </div>
    </div>
  </div>

  
</div>


@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() { 
	myApp.knobItemHandler();
});
</script> 
@endsection