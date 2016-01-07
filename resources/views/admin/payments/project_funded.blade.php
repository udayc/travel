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
		Project Funded
		</li> 
	</ol>
	<div class="page-header">
	<h1>Project Funded<small> Payments</small></h1>




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
	<!-- start: DYNAMIC TABLE PANEL -->
	<div class="panel panel-default">
	<div class="panel-heading"> 
	<span style="margin-left:-20px;" id="showloader" >Project Funded History</span>
	<div class="panel-tools">
	<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> 
	<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a> 
	</div>
	</div>
	<div class="panel-body">


		<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
		<thead>
		<tr>
		
		<th >Project</th>
		<th >Backer</th>
		<th >Paid Amount($)</th>
		<th >Amount to Project Owner($)</th>
		<th >Site Commission($)</th>
		<th >Pledge On</th>
		<th>Status</th>
		<th >Reward</th>
		<th >Reward Status</th>
		<th class="nosort">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
			/*echo "<pre>";
			print_r($project_funded);
			echo "</pre>";
			exit;*/
		?>
		@if( count($project_funded)  > 0 )
			@foreach($project_funded as $val)

			<tr>
			<td>
			<a href="{{ URL::to('/admin/project/show/' .$val->P_ID ) }}"  >{{ ($val->project()->first() ) ? $val->project()->first()->name : 'n/a'}} </a>
			
			@if( $val->project()->first() )
			
				@if( $val->project()->first()->status == 1) </br><span class="label label-inverse"> Suspend</span>@endif
				@if( $val->project()->first()->flag == 1) </br><span class="label label-systemflagged"> Flagged</span> @endif
				@if($val->project()->first()->live == 1 )	
					<a class="label label-sm label-success" >Live</a>
				@else
					<a class="label label-sm label-danger" >Not Live</a>
				@endif	

			@endif	


			
			</td>
			<td><a href="{{ URL::to('/admin/user/show/' .$val->user_id ) }}" >{{ $val->user()->first()->name }} </a></td>
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
					
					if(isset($reward_id) && ($reward_id>0))
					{
						$rewardRow = \App\Models\Reward::where('id' , $reward_id)->first();
						//echo $_settings_data->site_currency_symbol . $rewardRow->pledge_amount . ' + ' .$rewardRow->short_note
						echo $_settings_data->site_currency_symbol . $rewardRow->pledge_amount . ' + ' .$rewardRow->short_note  ;
					}
					else
					{
						echo "N/A";
					}
			?>
			
			
			
			@else
			n/a
			@endif
			</td>
			<td>@if($val->status == 'Pledged') n/a @else n/a @endif</td>
			<td class="center"  > 
			@if($val->status == 'Pledged')
			<div class="btn-group">
			<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
			<i class="fa fa-cog"></i> <span class="caret"></span>
			</a>
			<ul role="menu" class="dropdown-menu pull-right">  
			<li role="presentation">
			<a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $val->id}}"  data-token="{{ csrf_token() }}" data-url="/admin/activity"><i class="fa fa-times"></i> Cancel Pledge</a>
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
	
	
	
	
	
	<script src="/js/ui-modals.js"></script>
	<script src="/js/ui-customs-category.js"></script>
	<script> 
			jQuery(document).ready(function() {
				Main.init();
				UIModals.init();
				UICustoms.init();
				TableData.init();
			}); 

			function changestatus(projectid, projstatus)
			{
					$.ajax({		
					type:'GET',
					url:base_url+'/admin/category/changeactstat/'+projectid+'/'+projstatus,
					success:function(jData){
						 if(projstatus==0)
						 { 
							$("#activespn_"+projectid).hide();	 
							$("#inactivespn_"+projectid).show(); 
						 }
						 if(projstatus==1)
						 {  
							$("#inactivespn_"+projectid).hide(); 
							$("#activespn_"+projectid).show();	 
						 }						 
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
					$(".err").html("<div>Error.</div>");
					}
					});				 
			}

	</script> 

	<script> 
	    $(function() {   
	      $('a.order').click(function(e) { 
	       
	        var sens;
	        if($('span', this).hasClass('fa-unsorted')) sens = 'aucun';
	        else if ($('span', this).hasClass('fa-sort-desc')) sens = 'desc';
	        else if ($('span', this).hasClass('fa-sort-asc')) sens = 'asc';
	       
	        $('a.order span').removeClass().addClass('fa fa-fw fa-unsorted');
	        
	        $('span', this).removeClass();
	        var tri;
	        if(sens == 'aucun' || sens == 'asc') {
	          $('span', this).addClass('fa fa-fw fa-sort-desc');
	          tri = 'desc';
	        } else if(sens == 'desc') {
	          $('span', this).addClass('fa fa-fw fa-sort-asc');
	          tri = 'asc';
	        } 
	        
	        $('#showloader').append('<span id="tempo" class="fa fa-refresh fa-spin"></span>');   

	        $.ajax({ 
	          url:base_url+'/admin/category/order/',
	          type: 'GET',
	          dataType: 'json',
	          data: "name=" + $(this).attr('name') + "&sens=" + tri 
	        })
	        .success(function(data) { 
	          $('tbody').html(data.view);
	          $('.link').html(data.links);
	          /* $('.link').html(data.links); */
	          $('#tempo').remove();
	        })
	        .fail(function() {
	          $('#tempo').remove();
	          alert('Error! Please check.');
	        });
	      })     	
	    }); 
	</script>
@stop

@include('admin.category.partials._relatedfiles')