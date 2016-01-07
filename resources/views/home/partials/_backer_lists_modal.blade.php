<div id="responsive"  tabindex="-1" data-width="960"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
				@if($modalFor == 'backer-lists' )
				<h4 class="modal-title">Backer Lists</h4>
				@endif
				@if($modalFor == 'user-login-count' )
				<h4 class="modal-title">User Login History</h4>
				@endif
				@if($modalFor == 'project_funded_count' )
				<h4 class="modal-title">List of funded projects </h4>
				@endif
            </div>
            <div class="modal-body">
					<div class="row">
					<div class="col-md-12" id="replyListsWrapper"> 

					@if($modalFor == 'backer-lists' )
							<table class="table table-bordered table-hover" id="sample-table-1">
							
							<thead>
							<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>							
							<th>Funded Amount($)</th>		
							</tr>
							</thead>							
							
							
							
							

							<tbody>
							@if( count($backerListsByProjectId)  > 0 )
							@foreach($backerListsByProjectId as $val)						
							<tr>
							<td class="center">{{ $val->id }} </td>
							<td class="center"><a href="{{ URL::to('/user/profile/'.$val->id )}}" target="_blank">{{ $val->name }} </a></td>
							<td>{{ $val->email}}</td>
							<td>{{ \App\Models\ProjectFund::where('U_ID' , $val->id)->whereIn('status' , ['Pledged' , 'Funded'])->sum('paid_amount') }}</td>
							</tr>
							@endforeach
							@else
							<tr><td colspan="4">No result found !</td></tr>
							@endif
							</tbody>
							</table>

					@endif

					</div> 
					</div>
				

			
				
			
				
				
				
				
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-light-grey">Close</button> 
            </div>
        </div>
 


















