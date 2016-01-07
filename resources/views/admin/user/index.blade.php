@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.user.partials._pageheader' , ['page_title' => 'User Management' , 'userStat'=> $dataStat  ])
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->
<!--
<div class="row">
	<div class="col-md-12 space20" align="right">
	<a class="btn btn-green custom-button" href="/admin/user/create">Add New <i class="fa fa-plus"></i></a>
	</div>
</div>
-->	



<div class="row">
<div class="col-md-12">
		<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-default">
			<div class="panel-heading"> 
				<span style="margin-left:-20px;">Users - <?php if(!empty($recordlist)) { echo $recordlist; } else { echo "All"; } ?></span>
				<div class="panel-tools">
					<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>					
					<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>	 
				</div>
			</div>
			
		<div class="row">


				<div class="col-sm-12 col-md-12 pull-right" style="margin-top:15px;">
				<div class="col-sm-12 col-md-12 pull-right">
					<div class="input-group  pull-right">
					<a class="btn btn-primary custom-button pull-right" href="{{ URL::to('/admin/user/exportselected') }}"><i class="fa fa-external-link-square"></i> Export All</a>
					</div>
					</div>
				</div>




				<div class="col-sm-3 col-md-3 pull-right">
	 
 <?php /* ?>
		{!! Form::open(['url' => 'admin/user/searchparameter', 'method' => 'post', 'class' => 'navbar-form']) !!} 

		<div class="input-group  pull-right">
		<input type="text" class="form-control" value="<?php echo $getSearch; ?>" placeholder="Search" name="search"
		id="search"  >
		<div class="input-group-btn">
		<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</div>
		</div>


		{!! Form::close() !!}
<?php */?>

				</div>		
		</div>
		
		
		
		
	<div class="panel-body">
	
		
	
	
	
	
	<div class="table-responsive">

	<table class="table table-bordered table-hover table-full-width" id="user_data_table">
	<thead>
	<tr>
	<th class="select dc center nosort"  rowspan="2" ><label>	<input type="checkbox" id="check_all_nonexx" ></label></th>	

	<th rowspan="2" class="center">User</th>
	<th class="dc center" colspan="2">Projects posted</th>
	<th class="dc center" colspan="2">Projects funded</th>
	<th class="dr" rowspan="2">Site<br>Revenue($)</th>
	<th class="dc center" colspan="3">Logins</th>
	<th class="dc" rowspan="2">Live</th>
	<th class="dc" rowspan="2">User Since</th>
	<th rowspan="2">Registered IP</th>	
	<th rowspan="2">Status</th>
	<th class="dc nosort" rowspan="2">Actions</th>
	</tr>
	<tr>
	<th class="dr center">Count</th>
	<th class="dc">Total Project Amount($)</th>
	<th class="dr">Count</th>
	<th class="dc">Total Funded Amount($)</th>
	<th class="dr">Count</th>
	<th class="dc center">Last Login</th>
	<th class="center">IP</th>
	</tr>
	</thead>	
	<tbody>
			@include('admin.user.table')	
	</tbody>
	</table>


<div class="row">
<div class="col-md-2 col-sm-4 col-xs-12">
	<div class="dataTables_info" id="sample_2_info">
		<select id="UserMoreActionId" class="js-admin-index-autosubmit form-control customDrop" name="data[User][more_action_id]" data-token="{{ csrf_token() }}" data-url="/admin/user">
			<option value="">-- More actions --</option>
			<option value="1">Inactive</option>
			<option value="2" >Active</option>
			<option value="3">Delete</option> 
		</select>
	</div>
</div>	
<div class="col-md-10 col-sm-8 col-xs-12 pull-right">
<div class="pull-right link pagginasn">
<?php //echo $users->render(); ?>
</div>	
</div>	
</div>
	
</div>
		
	
	
	</div>			
	
				
			
			
			

		</div>
		<!-- end: DYNAMIC TABLE PANEL -->
	</div>
</div>











<!-- end: PAGE CONTENT-->
</div>







<div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>

@stop

@section('styles')

		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		
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
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->	
	
	
	
	
	<script src="/js/ui-modals.js"></script>
	<script src="/js/ui-customs.js"></script>
	<script>
			jQuery(document).ready(function() {
				Main.init();
				UIModals.init();
				UICustoms.init();
				TableData.init();
			});

	</script>

@stop

