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
		
		<div class="Resgister_Dash_submenu">
          <ul>
            <li><a href="/home/dashboard" class="actvMenu">Activities</a></li>
            <li><a href="/home/account">Project Posted</a></li>
            <li><a href="/home/backer-lists">Projects Backed</a></li>
            <li><a href="#">Transactions</a></li>            
            <li><a href="/home/my-projects" >My profile</a></li>
            <li><a href="/home/my-projects" >Settings</a></li>
          </ul>		
		 </div>
		 
					<div class="row">
						<div class="col-sm-12">
							<!-- start: RESPONSIVE ICONS BUTTONS PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									User project statistics
								</div>
								<div class="panel-body">

									<div class="row">
										<div class="col-sm-3">
											<button class="btn btn-icon btn-block">
												<i class="fa fa-calendar"></i>
												Projects Posted <span class="badge badge-success"> 4 </span>
											</button>
										</div>
										<div class="col-sm-3">
											<button class="btn btn-icon btn-block">
												<i class="fa fa-heart-o"></i>
												Projects Backed <span class="badge badge-danger"> 4 </span>
											</button>
										</div>
										<div class="col-sm-2">
											<button class="btn btn-icon btn-block">
												<i class="fa fa-thumbs-up"></i>
												Project Likes <span class="badge badge-warning"> 4 </span>
											</button>
										</div>
										<div class="col-sm-4">
											<button class="btn btn-icon btn-block">
												<i class="fa fa-exclamation-triangle"></i>
												Following Projects <span class="badge badge-success"> 4 </span>
											</button>
										</div>
									</div>

								</div>
							</div>
							<!-- end: RESPONSIVE ICONS BUTTONS PANEL -->
						</div>
					</div>			 
		 
		 
		
		
         
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
