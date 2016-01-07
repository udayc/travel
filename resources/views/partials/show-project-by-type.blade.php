 @if( count($_projectLists) > 0 )     

              @foreach($_projectLists as $project)             
				<?php 
				$endData = $project->funding_end_date;
				$now = date("Y-m-d");
				$date1 = new DateTime($endData );
				$date2 = new DateTime($now);
				$diff = $date2->diff($date1)->format("%a");
				?>	

              <div>
                <h3>{!! str_limit($project->name, $limit = 30, $end = '...') !!} <a class="viewAll" href="project/lists/{{ $_listType}}/{{ $project->genre_slug}}">View All</a>
				</h3>
                <div class="catview_IMG">
<a href="{{ URL::to('project/'.$project->id.'/'.$project->slug)}}" title="{!! $project->name !!}" ><img src="/images/file-attached-to-project/resize/medium/{{ $project->file_attachment }}" alt="{{ $project->file_attachment }}" border="0" width="628" height="267"></a>
				@if($project->status == 3) <span class="mTagBx"><img src="/images/frontend/tag-icon.png" alt="" border="0"></span> @endif				
				</div>
                <h3 class="subH3"><a href="{{ URL::to('project/'.$project->id.'/'.$project->slug)}}" title="{!! $project->name !!}" >{!! $project->name !!}</a></h3>
                <p>by {{ $project->posted_by }}</p>                
                <!-- detail area open -->
                <div class="catviewDtetlArea"> 
                  <!-- left part open -->
                  <div class="catLftBx">
                   <p>{!! str_limit($project->short_description, $limit = 160, $end = '...') !!}</p>   
                  </div>
                  <!-- left part closed -->                   
                  <!-- right part open -->
                  <div class="catRgtBx">
                    <div class="knob_lft">
                      <input class="knob" data-width="100%" value="{{ $project->_pof}}" data-fgColor="#5a62ab" data-thickness=".3" readonly>
                    </div>
                    <div class="knob_rgt">
                      <p><span>{{ $project->_pof}}</span> funded<br>
                        <span>{{ $_settings_data->site_currency_symbol }} {{ $project->_total_pledge_amount}}</span> pledged<br>
                        <span>{{ $project->_total_backers_on_project}}</span> backers<br>
                        @if( $diff > 0) <span>{{ $diff }}</span>  days to go @endif</p>
                    </div>
                    <a href=" {{ 'project/'.$project->id.'/'.$project->slug }}" class="orenge_btn">Explore Project</a> </div>
                  <!-- right part closed --> 
                </div>
                <!-- detail area closed --> 
              </div>
              <!-- slide closed --> 
              @endforeach       
@endif	