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
		Project Flags
		</li> 
	</ol>
	<div class="page-header">
	<h1>Project Flags<small> Activities</small></h1>




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
	<span style="margin-left:-20px;" id="showloader" >Project Flags Lists</span>
	<div class="panel-tools">
	<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> 
	<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a> 
	</div>
	</div>
	<div class="panel-body">






	<table class="table table-bordered table-hover table-full-width" id="category_data_table">
	<thead>
	<tr>
	<th  class="center nosort" width="10%" ><input type="checkbox" id="check_all_nonexx"   ></th>												
	<th>Project</th> 
	<th>User</th> 
	<th>IP</th>
	<th>Message</th>
	<th>Action</th>
	<th>Created At</th>
	</tr>
	</thead>
	<tbody> 
	@if( count($project_flags)  > 0 )	
		@foreach($project_flags as $val)	
  <tr>
  <td class="center" >
  <div class="checkbox-table listChk">
  <label>
  <input type="checkbox" class="ulistcheckbox" name="ulist" value="">
  </label>
  </div>
  </td> 
  <td><a href="{{ URL::to('/admin/project/show/' .$val->project_id ) }}" >{{ $val->project()->first()->name }}</a</td>    
  <td><a href="{{ URL::to('/admin/user/show/' .$val->user_id ) }}" >{{ ($val->user_id == 0) ? 'n/a' : $val->user()->first()->name }}</a></td>  
  <td>{{ $val->ip }}</td>  
  <td>{{ $val->message }}</td>  
  <td>{{ $val->action }}</td>   
  <td>{{ $val->created_at }}</td>    
  


  </tr>


@endforeach

@endif






		
	</tbody>
	</table>


	<div class="row">	
	<div class="col-md-2 col-sm-4 col-xs-12">
	<select id="UserMoreActionId" class="js-admin-index-autosubmit form-control customDrop" name="data[User][more_action_id]" data-token="{{ csrf_token() }}" data-url="/admin/category">
	<option value="">-- More actions --</option>
	<option value="3">Delete</option>	
	</select>

	</div>
	<div class="col-md-10 col-sm-8 col-xs-12">
	<div class="pull-right link pagginasn"></div>
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