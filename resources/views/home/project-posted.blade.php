@extends('app' )



@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
  
    <div class="row">
      <div class="col-md-12">
        <h3>Dashboard / Project Posted</h3>
        
        <!-- menu open -->

		@include('home.partials._dashboard_top_menu')
        
        <!-- menu closed -->         
        <!-- form part 1 open -->
        
        <div class="formBox"> 
        	@include('home.partials._flashmsg')
			@include('home.partials._dashboard_sub_menu')
		 	@include('home.partials._user_project_stat' ,[ 'authUserStat' => $dashBoardDetailsByAuthUser  ] )
			<!-- start: PAGE CONTENT -->
			<span class="label label-info"> NOTE!</span>
			<span> The project cannot be published if there is another active project. This project can be saved as draft and preview can be shared with friends etc.</span>
			<p></p>	
			<div class="row">
				<div class="col-md-12">
					<div class="input-group  pull-right">
					@if(count($my_posted_projects) >0)
						<a class="btn btn-primary custom-button pull-right" href="{{ URL::to('/home/exportproject') }}"><i class="fa fa-external-link-square"></i> Export All</a>
					@else
						<a class="btn btn-primary custom-button pull-right disabled" href="javascript:void(0);"><i class="fa fa-external-link-square"></i> Export All</a>
					@endif
					</div>
				</div>
			</div>
			<p></p>	
			<div class="row">
			<div class="col-md-12">
			<!-- start: DYNAMIC TABLE PANEL -->
			<div class="panel panel-default">

			<div class="panel-body">

			<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
			<thead>
			<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Goal Amount($)</th>
			<th>Funded Amount($)</th>
			<th>Backers</th>
			<th>Project Duration(Days)</th>
			<th>Followers</th>
			<th>Comments</th>
			<th>Status</th>
			<th>Live</th>
			<th>Options</th>
			</tr>
			</thead>
			<tbody>
	@if( count($my_posted_projects)  > 0 )
	
	
		@foreach($my_posted_projects as $val)				
			
			
			
			<tr>
			<td>{{ $val->id}}</td>
			<td>
			@if( $val->active !=1 ) 
			<a href="{{ URL::to('project/preview/?p='.$val->id )}}" target="_blank" title="{{ $val->name }} ">{{ $val->name }} </a>
			@else
			<a href="{{ URL::to('project/'.$val->id . '/' . $val->slug)}}" target="_blank" title="{{ $val->name }} ">{{ $val->name }} </a>
			@endif
			
			
				@if( $val->status == 1) </br><span class="label label-inverse"> Suspend</span>@endif
				@if( $val->flag == 1) </br><span class="label label-systemflagged"> Flagged</span> @endif			
			
			</td>
			<td>{{ $val->funding_goal }}</td>
			<td>{{ $val->_total_pledge_amount}}</td>
			<td>
			@if( $val->_total_backers_on_project  > 0)
			<a class="backerLists" href="javascript:void(0);" data-value="{{ $val->id }}">{{ $val->_total_backers_on_project }}</a>
			@else
			{{ $val->_total_backers_on_project }}
			@endif
			
			</td>
			<td>{{ $val->project_duration}}</td>
			<td>0</td>
			<td>0</td>
			<td>
			
 		<?php if($val->active == 1 ) { ?>
				<a class="label label-sm label-success" >Active</a>
		<?php } else if( $val->active == 0 ) { ?>
				<a class="label label-sm label-warning" >Draft</a>
		<?php } else if(  $val->active == 2  ) { ?>
				<a class="label label-sm label-info" >Pending for approval</a> 
		<?php } else if(  $val->active == 3  ) { ?>
				<a class="label label-sm label-danger" >Rejected</a>
		<?php } ?>		
			
			
			</td>

			<td>
			<?php if($val->live == 1 ) { ?><span class="badge badge-info">Yes</span><?php } else { ?>NA<?php } ?>
			 
			</td>

			<!-- 
			<td>
			<a href="<?php echo url(); ?>/project/edtspdata/<?php echo base64_encode($val->id); ?>/<?php echo base64_encode(1); ?>">Edit</a>
			<?php if($val->active == 1 ) { ?>
				<br /><a  href="" >Set as Live</a>
			<?php }  ?> 
			</td>
			-->



		<td class="span1 dc"> 
				<div class="btn-group">
				<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
				<i class="fa fa-cog"></i> <span class="caret"></span>
				</a>
				<ul role="menu" class="dropdown-menu pull-right">

				<li role="presentation">
				<a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/project/edtspdata/<?php echo base64_encode($val->id); ?>/<?php echo base64_encode(1); ?>">
				<i class="fa fa-share"></i> Edit
				</a>
				</li>

				<?php if($val->active == 1 ) { ?>
					<li role="presentation">
					<a role="menuitem" tabindex="-1" href="/project/setaslive/<?php echo base64_encode($val->id); ?>">
					<i class="fa fa-location-arrow"></i> Set as Live
					</a>
					</li> 
				<?php } ?>		


				</ul>
				</div>
		</td> 


			</tr>
			
	@endforeach

	@else
	
	@endif			
			


			</tbody>
			</table>
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

<div id="ajax-modal-backerLists" class="modal fade" tabindex="-1" style="display: none;"></div>
@endsection

@section('styles')
		<link rel="stylesheet" type="text/css" href="/plugins/select2/select2.css" />
		<link rel="stylesheet" href="/plugins/DataTables/media/css/DT_bootstrap.css" />
		
	<link href="/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>		
		
		
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
		<script type="text/javascript" src="/plugins/bootbox/bootbox.min.js"></script>
		<script type="text/javascript" src="/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script type="text/javascript" src="/plugins/select2/select2.min.js"></script>
		<script type="text/javascript" src="/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/plugins/DataTables/media/js/DT_bootstrap.js"></script>
		<script src="/js/table-data.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<script src="/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script src="/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>		
		
		<script src="/js/ui-modals.js"></script>

		<script>
			jQuery(document).ready(function() {
				Main.init();
				UIModals.init();
				TableData.init();
								
			});
		</script>







@endsection
