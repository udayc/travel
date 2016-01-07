@extends('app' )



@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
  
  
  
  
  
  
  
    <div class="row">
      <div class="col-md-12">
        <h3>Dashboard
	</h3>
        
        <!-- menu open -->
        <div class="Resgister_Dash_menu">
          <ul>
            <li><a href="/home/dashboard" class="actvMenu">Dashboard</a></li>
            <li><a href="/home/account">Account</a></li>
            <li><a href="/home/backer-lists">Backer Profile</a></li>
            <li><a href="#">Creator Profile</a></li>
            <li><a href="/home/payment-account">Payment Account</a></li>
            <li><a href="/home/my-projects" >My Projects</a></li>
          </ul>
        </div>
        <!-- menu closed --> 
        
        <!-- form part 1 open -->
        <div class="formBox">

		@include('home.partials._dashboard_sub_menu')
		@include('home.partials._user_project_stat' ,[ 'authUserStat' => $dashBoardDetailsByAuthUser  ] )		 

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
											<tr>
												<td>Amaya</td>
												<td class="hidden-xs">W3C,INRIA</td>
												<td>Follow This</td>
											</tr>
											<tr>
												<td>AOL Explorer</td>
												<td class="hidden-xs">America Online, Inc</td>
													<td>Follow This</td>
											</tr>

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
