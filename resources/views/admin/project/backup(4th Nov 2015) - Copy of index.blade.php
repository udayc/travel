@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.project.partials._pageheader' , ['settings_form' => 'Project Management', 'projectStat'=> $dataStat  ])
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->

<div class="row">
<div class="col-md-12">
		<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-default">
			<div class="panel-heading">  
				<span style="margin-left:-20px;">Projects</span>
				<div class="panel-tools">
					<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>					
					<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>					
					<a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
				</div>
			</div>
			
	<?php /* ?>		
		<div class="row">
				<div class="col-sm-3 col-md-3 pull-right">
				
					{!! Form::open(['url' => Request::url(), 'role' => 'search' , 'method' => 'get', 'class' => 'navbar-form']) !!} 
					<div class="input-group pull-right">
						<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" required value=" {{ isset($searchKey) ? $searchKey : '' }} ">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				{!! Form::close() !!}
				</div>		
		</div>
		
		<?php */ ?>
		
		
	<div class="panel-body">
	
		
	
	
	
	
	<div class="table-responsive">
	

	
	
	
	
	<table class="table table-bordered table-hover table-full-width" id="project_data_table" >
	<thead>
	<tr>
	<th class="select dc center nosort" rowspan="2" > 
	<label><input type="checkbox" id="check_all_nonexx" ></label>
	</th>	
	<th rowspan="2" class="center">Name</th>
	<th rowspan="2" class="center">Posted By</th>
	
	<th rowspan="2" class="center">Genre</th>
	<th rowspan="2" class="center">Category</th>
	
	<th class="dc center" colspan="2">Amount</th>
	<th class="dc center" rowspan="2">Site <br>Commission</th>
	<th class="dr" rowspan="2">Project<br>Duration(Days)</th>
	
	<th class="dc center" rowspan="2" >Number Of Shares</th>
	<th class="dc center" rowspan="2" >Remind Me</th>
	<th class="dc center" rowspan="2" >Page Views</th>
	<th class="dc center" rowspan="2" >Likes</th>
	<th class="dc" rowspan="2">Live</th>
	<th class="dc" rowspan="2">Backers</th>
	<th rowspan="2">Staff Pick</th>
	<th rowspan="2">Status</th>
	<th class="dc nosort" rowspan="2">Actions</th>
	</tr>
	<tr>
	<th class="dr center">Goal</th>
	<th class="dc">Funded($)</th>
	<!--
	<th class="dr">Total Voting</th>
	<th class="dc">Count</th>
	<th class="center">Average</th>
	-->
	</tr>
	</thead>																	
	<tbody>
	@if( count($projects)  > 0 )
	
	
		@foreach($projects as $val)						
		<tr>
		<td class="center"><input type="checkbox" class="ulistcheckbox" name="ulist" value="{{ $val->id }}"></td>
		<td class="span4 dl">{{ $val->name }}
		@if( $val->status == 1) </br><span class="label label-inverse"> Suspend</span>@endif
		@if( $val->flag == 1) </br><span class="label label-systemflagged"> Flagged</span> @endif
		
		</td>
		<td class="dc"><a href="<?php echo url(); ?>/admin/user/show/{{ $val->user()->first()->id }}">{{ $val->user()->first()->name }}</a></td>
		
		<td class="dc">{{ $val->genre()->first()->name }}</td>
		<td class="dc">{{ $val->category()->first()->name }}</td>
		
		<td class="dr">{{ $val->funding_goal }}</td>
		<td class="dc">0.00</td>
		
		<td class="dr"><span class="label label-commission"><span title="Zero Dollars" class="c cr">0.00</span></span></td>
		<td class="dr">{{ $val->project_duration}}</td>		
		<td class="dc">{{ $val->projectshare->sum('number_of_share') }}</td>
		<td class="dc">{{ $val->projectshare->sum('remind_me_count') }}</td>
		<td class="dl">{{ $val->projectshare->sum('view_count') }}</td>
		<td class="dl">{{ $val->projectshare->sum('like_count') }}</td>
 
		<td class="dc">@if($val->live == 1)<span class="label label-live"> Yes</span> @else No @endif </td>
		<td class="dc">{{ $val->projectfund->where('status' , 'Pledged')->count() }} </td>



 
		<td class="dl">
			<?php if( $val->featured == 1 ) { ?><a class="label label-sm label-featured" href="javascript:changefeature( <?php echo $val->id; ?>, '0' )" id="activefspn_<?php echo $val->id; ?>"  >Featured</a><a class="label label-sm label-unfeatured"   href="javascript:changefeature( <?php echo $val->id; ?>, '1' )"  id="inactivefspn_<?php echo $val->id; ?>" style="display:none;"  >No</a><?php } else { ?><a class="label label-sm label-unfeatured"   href="javascript:changefeature( <?php echo $val->id; ?>, '1' )"  id="inactivefspn_<?php echo $val->id; ?>"   >No</a><a class="label label-sm label-featured" href="javascript:changefeature( <?php echo $val->id; ?>, '0' )" id="activefspn_<?php echo $val->id; ?>"  style="display:none;"  >Featured</a><?php } ?> 
		</td>




		<td class="dl">

 		<?php if( $val->active == 1 ) { ?><a class="label label-sm label-success" href="javascript:changestatus( <?php echo $val->id; ?>, '0' )" id="activespn_<?php echo $val->id; ?>"  >Active</a><a class="label label-sm label-danger"   href="javascript:changestatus( <?php echo $val->id; ?>, '1' )"  id="inactivespn_<?php echo $val->id; ?>" style="display:none;"  >Pending</a><?php } else { ?><a class="label label-sm label-danger"   href="javascript:changestatus( <?php echo $val->id; ?>, '1' )"  id="inactivespn_<?php echo $val->id; ?>"   >Pending</a><a class="label label-sm label-success" href="javascript:changestatus( <?php echo $val->id; ?>, '0' )" id="activespn_<?php echo $val->id; ?>"  style="display:none;"  >Active</a><?php } ?>  

		</td>





		<td class="span1 dc">
			

		<div class="btn-group">
		<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
		<i class="fa fa-cog"></i> <span class="caret"></span>
		</a>
		<ul role="menu" class="dropdown-menu pull-right">

		<li role="presentation">
		<a role="menuitem" tabindex="-1" href="/admin/project/show/{{ $val->id }}">
		<i class="fa fa-share"></i> View
		</a>
		</li>
		<li role="presentation">
		<a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/project/edtsdata/<?php echo base64_encode($val->id); ?>/<?php echo base64_encode(1); ?>">
		<i class="fa fa-edit"></i> Edit
		</a>
		</li>															
		<li role="presentation"><a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $val->id }}"  data-token="{{ csrf_token() }}" data-url="/admin/project"><i class="fa fa-times"></i> Remove</a>
		</li>
		</ul>
		</div>
		</td>		
	</tr>
	@endforeach

	@else
	<tr><td colspan="14">No result found !</td></tr>
	@endif
	</tbody>
	
	</table>
	
<div class="row">
<div class="col-md-2 col-sm-4 col-xs-12">
	<div class="dataTables_info" id="sample_2_info">
		
<select id="UserMoreActionId" class="js-admin-index-autosubmit form-control customDrop" name="data[User][more_action_id]" data-token="{{ csrf_token() }}" data-url="/admin/project">
<option value="">-- More actions --</option>			
<option value="2">Active</option>
<option value="1">Inactive</option>			
<option value="11">Suspend</option>
<option value="111">Unsuspend</option>
<!--
<option value="12">Featured</option>
<option value="122">No Featured</option>
-->
<option value="13">System Flag</option>
<option value="133">Clear System Flag</option>
<option value="3">Delete</option>
<!--<option value="5">Export</option>-->

</select>

	</div>
</div>	
<div class="col-md-10 col-sm-8 col-xs-12 pull-right">
<div class="pull-right link pagginasn">
<?php echo $projects->render(); ?>	
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









@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="/plugins/select2/select2.css" />
<link rel="stylesheet" href="/plugins/DataTables/media/css/DT_bootstrap.css" />	
<style>
.stat-label .label { display:block; }
.stat-label  {margin-top:-10px; }
</style>	
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

			function changestatus(projectid, projstatus)
			{
					$.ajax({		
					type:'GET',
					url:base_url+'/admin/project/changeactstat/'+projectid+'/'+projstatus,
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

			function changefeature(gprojectid, gprojstatus)
			{
					$.ajax({		
					type:'GET',
					url: base_url+'/admin/project/check-staf-pick-by-genre/'+gprojectid+'/'+gprojstatus,
					success:function(jData){
					if(jData.status == 1 )	{
					
					if ( confirm("Already have staff pick project under this genre . Do you want to replace by new one ?") ) {
					
					
							$.ajax({
							url: base_url+'/admin/project/changefeastat/'+gprojectid+'/'+gprojstatus,
							type: 'GET',
							success: function(result) {	
							
							if(result.status == 'OK') { 

								if(gprojstatus==0)	{ 
										$("#activefspn_"+gprojectid).hide();	 
										$("#inactivefspn_"+gprojectid).show(); 
								}
								
								if(gprojstatus==1)	{  
								$("#inactivefspn_"+gprojectid).hide(); 
								$("#activefspn_"+gprojectid).show();	 
								}	
								
								location.href = '/admin/project' ;
								
							}				

							}
							
							});					
					
					
					
					
					}
					
					
					} 
					
					
						 
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
					$(".err").html("<div>Error.</div>");
					}
					});				 
			}




		</script>

@stop