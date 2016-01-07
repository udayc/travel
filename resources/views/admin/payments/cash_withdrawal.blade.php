@extends('admin.layout')

@section('content')
	<div class="container">
	<!-- start: PAGE HEADER -->
	<div class="row">
	<div class="col-sm-12">
	<!-- start: PAGE TITLE & BREADCRUMB -->
	<ol class="breadcrumb">
		<li>
		<i class="clip-home-3"></i>
		<a href="<?php echo url(); ?>/admin/dashboard">
		Home
		</a>
		</li>
		<li class="active">
		User Cash Withdrawal
		</li> 
	</ol>
		<div class="page-header">
			<h1>User Cash<small> Withdrawal</small></h1>
			<div class="clearfix"></div>
		</div>
	<!-- end: PAGE TITLE & BREADCRUMB -->
	</div>
	</div>
	<!-- end: PAGE HEADER -->
	<!-- start: PAGE CONTENT -->

	@include('admin.partials._flashmsg')
					 
	<div class="row">
		<div class="col-md-12">
			@if(Session::has('message'))
				<div class="flash-message">
							<p class="alert alert-success">{{ Session::pull('message') }}
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a></p>
			    </div>				
			@endif
			<!-- start: DYNAMIC TABLE PANEL -->
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<span style="margin-left:-20px;" id="showloader" >User Cash Withdrawal</span>
					<div class="panel-tools">
						<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> 
						<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a> 
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
						<thead>
							<tr>		
								<th >Project Name</th>
								<th >User</th>
								<th >Status</th>
								<th >Paid Amount($)</th>		
								<th >Transaction Id</th>				
								<th >Withdraw Requested Date</th>				
								<th  class="nosort">Action</th>				
							</tr>
						</thead>
						<tbody>								
						@if( count($cash_withdrawal)  > 0 )
							@foreach($cash_withdrawal as $val)
								<tr>
									<td>			
										<a href="{{ URL::to('/admin/project/show/' .$val->projectfund()->first()->P_ID ) }}"  >{{ \App\Models\project::where('id', $val->projectfund()->first()->P_ID)->pluck('name') }}</a>
									</td>			
									<td><a href="{{ URL::to('/admin/user/show/' .$val->user_id ) }}" >{{ ($val->user()->first() ) ? $val->user()->first()->name : 'n/a'}} </a></td>
									<td><span id="status_{{ $val->id}}">{{ studly_case($val->status) }}</span></td>
									<td>{{ $val->projectfund()->first()->paid_amount }}</td>										
									<td>{{ $val->projectfund()->first()->transaction_id }}</td>	
									<td>{{ $val->projectfund()->first()->created_at->format('M d, Y') }}</td>										
									<td class="center">		
										@if($val->status=='request')
										<div class="btn-group" id="button_{{ $val->id}}">
											<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
												<i class="fa fa-cog"></i> <span class="caret"></span>
											</a>
											<ul role="menu" class="dropdown-menu pull-right">  
												<li role="presentation">
													<!-- <a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $val->id}}"  data-token="{{ $val->status }}" data-url="/admin/payments"><i class="glyphicon glyphicon-ok"></i> Accepted</a> -->
													<a  href="#" onclick="go_details('<?php echo $val->id;?>','a');"><i class="glyphicon glyphicon-ok"></i> Approve</a>
													<a  href="#" onclick="go_details('<?php echo $val->id;?>','r');"><i class="glyphicon glyphicon-remove"></i> Reject</a>
												</li>
											</ul>
										</div>
										@endif
									</td>									
								</tr>
							@endforeach
						@else
								<tr><td colspan="4"> No result found !</td></tr>
						@endif	
						</tbody>
					</table>
				</div>
			</div>
			<!-- end: DYNAMIC TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
	</div> 
@stop


@section('styles')
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->		
		<link rel="stylesheet" type="text/css" href="/plugins/select2/select2.css" />
		<link rel="stylesheet" href="/plugins/DataTables/media/css/DT_bootstrap.css" />		
@stop


@section('scripts')
	<script src="/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
	<script src="/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
	
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script type="text/javascript" src="/plugins/bootbox/bootbox.min.js"></script>
	<script type="text/javascript" src="/plugins/jquery-mockjax/jquery.mockjax.js"></script>
	<script type="text/javascript" src="/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/plugins/DataTables/media/js/DT_bootstrap.js"></script>
	<script src="/js/table-data.js"></script>
	<script>
		function go_details(id,val)
		{
			if(confirm('Are you sure?'))
			{
				if(val=='a')
				{
					window.location.href=base_url+ '/admin/payments/cashwithdrawaldetails/' + id;
				}
				if(val=='r')
				{
					window.location.href=base_url+ '/admin/payments/rejectwithdraw/' + id;
				}
			}
		}
	</script>
	
	

	
@stop

@include('admin.category.partials._relatedfiles')