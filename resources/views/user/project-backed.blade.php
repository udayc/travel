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
			@if( count($my_funded_projects)  > 0 )
			<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
			<thead>
			<tr>
			<th>ID</th>
			<th>Project</th>
			<th>Goal Amount($)</th>
			<th>Funded Amount($)</th>
			<th>Paid Amount($)</th>
			<th>Duration(Days)</th>
			<th>End Date</th>
			<th>Reward</th>
			<th>Reward Status</th>
			<th>Live</th>
			</tr>
			</thead>
			<tbody>
	
	
	
		@foreach($my_funded_projects as $val)			
			
			
			<tr>
			<td>{{ $val->id}}</td>
			<td>{{ $val->name }}
				@if( $val->status == 1) </br><span class="label label-inverse"> Suspend</span>@endif
				@if( $val->flag == 1) </br><span class="label label-systemflagged"> Flagged</span> @endif	
			</td>
			<td>{{ $val->funding_goal }}</td>
			<td>{{ $val->_total_pledge_amount}}</td>
			<td>{{ $val->_total_pledge_amount_of_user }}</td>
			<td>{{ $val->project_duration}}</td>
			<td>{{ date( "M d, Y" , $val->project_end_date ) }}</td>
			<td>n/a</td>
			<td>n/a</td>
			<td>
			
					@if($val->live == 1 )
					<a class="label label-sm label-success" >Yes</a>
					@else
					<a class="label label-sm label-danger" >No</a>
					@endif			
			
			</td>
			</tr>
			
	@endforeach


	
					
			
			


			</tbody>
			</table>
			
@else			
<p>			
A place to keep track of all your backed projects.<span>
You haven't backed any projects! Check out our <a href="{{ URL::to('/project/lists/popular')}}"  target="_blank" >Most Popular Project of the Day </a>. </span>
We like it and think you might too.
</p>			
			
			
			
			
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
