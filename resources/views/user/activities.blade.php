@extends('app' )



@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
  
  
  
  
  
  
  
    <div class="row">
      <div class="col-md-12">
        <h3>Profile / {{ $user->name }}</h3>
        
        <!-- menu open -->
        <!-- menu closed --> 
        
        <!-- form part 1 open -->
        <div class="formBox">
			@include('user.partials._dashboard_sub_menu')	
			@include('user.partials._user_project_stat' ,[ 'authUserStat' => $dashBoardDetailsByAuthUser  ] )

					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<!-- start: DYNAMIC TABLE PANEL -->
							<div class="panel panel-default">

								<div class="panel-body">
								
								
	<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
	<thead>
	<tr>
	<th >Project</th>
	<th class="hidden-xs nosort">Activity</th>
	<th class="nosort">Action</th>
	
	</tr>
	</thead>
	<tbody>
	@if( count($activityLogs)  > 0 )
	@foreach($activityLogs as $val)									


	<tr>								
	<td>
	<a href="{{ URL::to('/project/' .  $val->project_id . '/' . $val->project()->first()->slug)}}" >{{ $val->project()->first()->name}} </a>
	</td>
	<td class="hidden-xs">
	{{ $val->message}}
	<p><img src="/images/avtar-image/resize/{{ \App\Profile::where('user_id' , $val->user()->first()->id )->first()->user_avtar }}" width="50" width="50"/></p>							
	</td>
	<td>{{ $val->action}}</td>
	
	</tr>
	@endforeach
	@else
	<tr><td colspan="3"> No result found !</td></tr>
	@endif								



	</tbody>
	</table>
								
								
								</div>
							</div>
							<!-- end: DYNAMIC TABLE PANEL -->
						</div>
					</div>


        </div>
        <!-- form part 1 closed --> 
        
        <!-- form part 2 open -->

        <!-- form part 2 closed --> 
        
        <!-- form part 3 open -->

        <!-- form part 3 closed --> 
        

		
		
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
		<script type="text/javascript" src="/plugins/bootbox/bootbox.min.js"></script>
		<script type="text/javascript" src="/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script type="text/javascript" src="/plugins/select2/select2.min.js"></script>
		<script type="text/javascript" src="/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/plugins/DataTables/media/js/DT_bootstrap.js"></script>
		<script src="/js/table-data.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		


		<script>
			jQuery(document).ready(function() {
				Main.init();
				TableData.init();
			
								
			});
		</script>







@endsection
