<div id="responsive"    tabindex="-1" data-width="760"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
				@if($modalFor == 'project-count' )
				<h4 class="modal-title">Project Details</h4>
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
                    <div class="col-md-12"> 

@if($modalFor == 'project-count' )
					<table class="table table-bordered table-hover" id="sample-table-1">
					<thead>
					<tr>
					<th class="center">ID</th>
					<th>Title</th>
					<th>Created On</th>
					<th>Status</th>
					</tr>
					</thead>

					<tbody>
					@if( count($projectLists)  > 0 )
@foreach($projectLists as $val)						
					<tr>
					<td class="center">{{ $val->id }} </td>
					<td>@if( $val->status == 1) <span class="label label-inverse"> Suspend</span>@endif
		@if( $val->flag == 1) <span class="label label-warning"> Flagged</span> @endif
					<a href="/admin/project/show/{{ $val->id }}" target="_blank">{{ $val->name }}</a></td>
					<td>{{ $val->created_at->format('M d, Y')}}</td>
					<td>
					<?php if( $val->active == 1 ) { ?>
					<span class="label label-sm label-success">Active</span>
					<?php } else { ?>  <span class="label label-sm label-danger">Pending</span><?php } ?>
					</td>
					</tr>
@endforeach
	@else
	<tr><td colspan="4">No result found !</td></tr>
	@endif
					</tbody>
					</table>

@endif


@if($modalFor == 'project_funded_count' )
					<table class="table table-bordered table-hover" id="sample-table-1">
					<thead>
					<tr>
					<th class="center">ID</th>
					<th>Title</th>
					<th>Amount($)</th>
					<th>Funded On</th>
					<th>Status</th>
					</tr>
					</thead>

					<tbody>
					@if( count($fundedDetails)  > 0 )
@foreach($fundedDetails as $val)						
					<tr>
					<td class="center">{{ $val->id }} </td>
					<td><a href="/admin/project/show/{{ $val->P_ID }}" target="_blank">{{ $val->project()->first()->name }}</a></td>
					<td>{{ $val->paid_amount }}</td>
					<td>{{ $val->created_at}}</td>
					<td>{{ $val->status }}				
					</td>
					</tr>
@endforeach
	@else
	<tr><td colspan="4">No result found !</td></tr>
	@endif
					</tbody>
					</table>

@endif










@if($modalFor == 'user-login-count' )
					<table class="table table-bordered table-hover" id="sample-table-1">
					<thead>
					<tr>
					<th class="center">Id</th>
					<th>Host</th>
					<th>Login At</th>
					
					</tr>
					</thead>

					<tbody>
					@if( count($logHistory)  > 0 )
					@foreach($logHistory as $val)						
					<tr>
					<td class="center">{{ $val->id }} </td>
					<td><a href="#">{{ $val->hostname }}</a></td>
					<td>{{ $val->timestamp}}</td>

					</tr>
					@endforeach
					@else
					<tr><td colspan="3">No result found !</td></tr>
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
 