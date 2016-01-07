@extends('app' )



@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
  
    <div class="row">
      <div class="col-md-12">
        <h3>Dashboard / Backer Lists</h3>
        
        <!-- menu open -->

		@include('home.partials._dashboard_top_menu')
        
        <!-- menu closed -->         
        <!-- form part 1 open -->
        
        <div class="formBox"> 
        	@include('home.partials._flashmsg')
			@include('home.partials._dashboard_sub_menu')
		 	@include('home.partials._user_project_stat' ,[ 'authUserStat' => $dashBoardDetailsByAuthUser  ] )
			<div class="row">
				<div class="col-md-12">
					<div class="input-group  pull-right">
					@if(count($listOfBackers) >0)
						<a class="btn btn-primary custom-button pull-right" href="{{ URL::to('/home/exportbackerlists') }}"><i class="fa fa-external-link-square"></i> Export All</a>
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
			<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
			<thead>
			<tr>
			
			<th>Backer Name</th>
			<th>Backed Amount($)</th>
			<th>Project Name</th>
			</tr>
			</thead>
			<tbody>
			
	@if( count($listOfBackers)  > 0 )
	
	
		@foreach($listOfBackers as $val)				

			<tr>
			<td><a href="{{URL::to('/user/profile/'.$val->U_ID) }}" target="_blank">{{ $val->user()->first()->name}}</a></td>
			<td>{{ \App\Models\ProjectFund::where('P_ID' , $val->P_ID)->where('U_ID' , $val->U_ID)->orderBy('created_at', 'desc')->sum('paid_amount')}}</td>
			<td><a href="{{URL::to('/project/'.$val->P_ID . '/' . $val->project()->first()->slug ) }}">{{ $val->project()->first()->name}}</a></td>
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
