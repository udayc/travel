@extends('app' )



@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
  
  
  
  
  
  
  
    <div class="row">
      <div class="col-md-12">
        <h3>Dashboard / My Backed Projects </h3>
        
        <!-- menu open -->
		@include('home.partials._dashboard_top_menu')
        <!-- menu closed --> 
        
        <!-- form part 1 open -->
        <div class="formBox">
		
		@include('home.partials._dashboard_sub_menu')
		@include('home.partials._user_project_stat' ,[ 'authUserStat' => $dashBoardDetailsByAuthUser  ] )
			<div class="row">
				<div class="col-md-12">
					<div class="input-group  pull-right">
					@if(count($my_funded_projects) >0)
						<a class="btn btn-primary custom-button pull-right" href="{{ URL::to('/home/exportbackedproject') }}"><i class="fa fa-external-link-square"></i> Export All</a>
					@else
						<a class="btn btn-primary custom-button pull-right disabled" href="javascript:void(0);"><i class="fa fa-external-link-square"></i> Export All</a>
					@endif
					</div>
				</div>
			</div>
			<p></p>
			<!-- start: PAGE CONTENT -->
			<div class="row">
			<div class="col-md-12">
			<!-- start: DYNAMIC TABLE PANEL -->
			<div class="panel panel-default">

			<div class="panel-body">
			 @include('admin.partials._flashmsg')
	@if( count($my_funded_projects)  > 0 )
	
		<p>
				Note : If a project is successful (has crossed {{ $_settings_data->project_threshold_limit }}% threshold), the user cannot cancel the fund 48 hours before the project deadline.
		</p>
	
		<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
		<thead>
		<tr>
		
		<th >Project</th>		
		<th >Paid Amount($)</th>
		<th >Amount to Project Owner($)</th>
		<th >Site Commission($)</th>
		<th >Pledge On</th>
		<th>Payment Status</th>
		<th >Reward</th>
		<th >Reward Status</th>
		<th class="nosort">Action</th>
		</tr>
		</thead>
		<tbody>

			@foreach($my_funded_projects as $val)

			<tr>
			<td><a href="{{ URL::to('/project/' .$val->P_ID.'/' .  $val->project()->first()->slug) }}" title="{{ $val->project()->first()->name }} " target="_blank" >{{ $val->project()->first()->name }} </a>
			@if( $val->project()->first()->status == 1) </br><span class="label label-inverse"> Suspend</span>@endif
			@if( $val->project()->first()->flag == 1) </br><span class="label label-systemflagged"> Flagged</span> @endif
			@if($val->project()->first()->live == 1 )	<a class="label label-sm label-success" >Live</a>
			@else<a class="label label-sm label-danger" >Not Live</a>
			@endif				
			
			
			</td>
			
			
			<td>{{ $val->paid_amount}}</td>
			<td> {{ $val->amount_to_project_owner  }}</td>
			<td>{{ $val->site_commission }}</td>
			<td>{{ $val->created_at }}</td>
			<td>@if($val->status == 'Pledged') <code>{{ $val->status }}</code> @else {{ $val->status }} @endif</td>
			<td>
			@if( $val->rewards_log_during_payment_id > 0 ) 
			<?php
					$rewardLogRow 				= \App\Models\RewardsLogDuringPayment::where('id' , $val->rewards_log_during_payment_id)->first();
					$rewardLogRowDecodedObj 	= json_decode($rewardLogRow->array_obj);
					$reward_id 					= $rewardLogRowDecodedObj->reward_id ; 
					if(isset($reward_id ) && $reward_id > 0 ) {
					$rewardRow = \App\Models\Reward::where('id' , $reward_id)->first();
					echo $_settings_data->site_currency_symbol . $rewardRow->pledge_amount . ' + ' .$rewardRow->short_note  ;
					} else { echo 'n/a';}
			
			?>
			
			
			
			@else
			n/a
			@endif
			</td>
			<td>@if($val->status == 'Pledged') n/a @else n/a @endif</td>
			<td class="center"  > 
		@if( \App\Models\CashWithdrawalsRequest::where('project_fund_id' , $val->id)->count() > 0 )
			<code>requested for refund</code>
			
		@else
			
			
			@if($val->status == 'Pledged')
			<div class="btn-group">
			<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
			<i class="fa fa-cog"></i> <span class="caret"></span>
			</a>
			<ul role="menu" class="dropdown-menu pull-right">  
			<li role="presentation">
			<!-- <a class="refundRequest" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $val->id}}"  data-token="{{ csrf_token() }}" data-url="/home/refund"><i class="fa fa-times"></i> Refund Request</a>-->
				<a href="javascript:void(0);" onclick="go_details('<?php echo $val->id;?>');"><i class="glyphicon glyphicon-remove"></i> Reject</a>
			</li>
			</ul>
			</div> 
			@endif
			
		@endif	
			
			</td> 			
			
			
			
			
			
			
			</tr>
		@endforeach
			

		</tbody>
		</table>
			
@else			
<p>			
A place to keep track of all your backed projects.<span><br>
You haven't backed any projects! Check out our <a href="{{ URL::to('/project/lists/popular')}}"  target="_blank" >Most Popular Project of the Day </a>. </span>
We like it and think you might too.
</p>


<div id="infoModalForBackingParoject" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Subscribe our Newsletter</h4>
            </div>
            <div class="modal-body">
				
		<p>			
		A place to keep track of all your backed projects.<span><br>
		You haven't backed any projects! Check out our <a href="{{ URL::to('/project/lists/popular')}}"  target="_blank" >Most Popular Project of the Day </a> . </span>
		We like it and think you might too.
		</p>				
	
            </div>
        </div>
    </div>
</div>

			
			
			
			
			
			@endif
			
			
			
			
			
			</div>
			</div>
			<!-- end: DYNAMIC TABLE PANEL -->
			</div>
			</div>


        </div>

        

		
		
		</div>
    </div>
	
	

	
	
	
  </div>
</div>
<!-- inner page area closed --> 
@endsection

@section('styles')
		<link rel="stylesheet" type="text/css" href="/plugins/select2/select2.css" />
		<link rel="stylesheet" href="/plugins/DataTables/media/css/DT_bootstrap.css" />
		
		<link rel="stylesheet" href="/plugins/ladda-bootstrap/dist/ladda-themeless.min.css">
		<link rel="stylesheet" href="/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css">
		<link rel="stylesheet" href="/plugins/bootstrap-social-buttons/social-buttons-3.css">		
		
@endsection

@section('scripts')
		
		<script src="/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="/plugins/less/less-1.5.0.min.js"></script>
		<script src="/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="/js/main.js"></script>
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!--<script type="text/javascript" src="/plugins/bootbox/bootbox.min.js"></script>
		<script type="text/javascript" src="/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script type="text/javascript" src="/plugins/select2/select2.min.js"></script>
		<script type="text/javascript" src="/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/plugins/DataTables/media/js/DT_bootstrap.js"></script>
		<script src="/js/table-data.js"></script>-->
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		

		<script>
			//jQuery(document).ready(function() {
			//	Main.init();
			//	TableData.init();
			//	jQuery('#infoModalForBackingParoject').modal('show');	

			//	myApp.ajaxRefundRequestChargeHandler();
			//});
		</script>
		
		<script>
			function go_details(id)
			{
				window.location.href='/home/refundrequest/'+id;
				/*if(confirm('Are you sure?'))
				{
					$.ajax({    
					type:'POST',
					url:base_url+'/home/refund/'+id,	
					success:function(data){	
						alert(data);							
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){	 
						$("#display").html('An error occurred. Please try again later.');						
					}
					});	
				}*/
			}
		</script>
@endsection
