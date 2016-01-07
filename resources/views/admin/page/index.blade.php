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
	Page Management
	</li> 
	</ol>
	<div class="page-header">
	<h1>Page Management<small> Manage core config data</small></h1>
	<div class="row">
	<!--
	<a href="/admin/category/approvedrec" class="col-sm-1 listing_stus"><br> <span class="label label-success"> Active</span></a>
	<a href="/admin/category/disapprovedrec" class="col-sm-1 listing_stus"><br> <span class="label label-danger">Inactive</span></a>
	<a  href="/admin/category/unsetsearchparameter"  class="col-sm-1 listing_stus"><br> <span class="label label-default">All</span></a>
	-->
	
	<div class="col-sm-12">
	<div class="pull-right"> 
	<a href="{{ URL::to('admin/pages/create') }}" class="btn btn-primary custom-button"><i class="fa fa-plus"></i> Add New</a>
	</div>
	</div>
	</div>



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
	<span style="margin-left:-20px;">Manage Pages
	</span>
	<div class="panel-tools">
	<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> 
	<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a> 
	</div>
	</div>
	<div class="panel-body">



 






	<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
	<thead>
	<tr>
	<th  class="center" width="10%" >
	<input type="checkbox" id="check_all_nonexx"   >
	</th>												
	<th>Title</th> 
	<th>Url Key</th> 	
	<th>Create On</th>
	<th>Status</th> 	
	<th class="center" width="10%" >Action</th>
	</tr>
	</thead>

	<tbody> 
	<?php $counter=1; ?>
	@if( count($pages) > 0 )
	@foreach ($pages as $row)
	<tr>
	<td class="center" >
	<div class="checkbox-table listChk">
	<label>
	<input type="checkbox" class="ulistcheckbox" name="ulist" value="{{ $row->id }}">
	</label>
	</div>
	</td>

	<td><a href="<?php echo url(); ?>/admin/pages/show/{{ $row->id }}" title="{{ $row->title }}" >{{ $row->title }}</a></td>		
	<td>{{ $row->slug }}</td>		
	<td> {{ date('M d, Y' , strtotime($row->updated_at) ) }} </td> 
	<td>
		@if( $row->active == 0)		
		<span class="label label-sm label-danger">Inactive</span>
		@else	
		<span class="label label-sm label-success">Active</span>
		@endif
	</td>	
	<td class="center"  > 
	<div class="btn-group">
	<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
	<i class="fa fa-cog"></i> <span class="caret"></span>
	</a>
	<ul role="menu" class="dropdown-menu pull-right">  
	<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/pages/edit/{{ $row->id }}"><i class="fa fa-edit"></i> Edit</a></li>
	<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/pages/show/{{ $row->id }}"><i class="fa fa-share"></i>View</a></li>	
	<li role="presentation">
	<a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $row->id }}"  data-token="{{ csrf_token() }}" data-url="/admin/pages"><i class="fa fa-times"></i> Remove</a>
	</li>
	</ul>
	</div> 
	</td> 

	</tr>
	<?php $counter++; ?>	
	@endforeach	

	@else
	<tr><td class="center"  colspan="6"> No Results found ! </td></tr>
	@endif	
	</tbody>
	</table>


	<div class="row">	
	<div class="col-md-2 col-sm-4 col-xs-12">
	<select id="UserMoreActionId" class="js-admin-index-autosubmit form-control customDrop" name="data[User][more_action_id]" data-token="{{ csrf_token() }}" data-url="/admin/pages">
	<option value="">-- More actions --</option>
	<option value="1">Inactive</option>
	<option value="2" >Active</option>
	<option value="3">Delete</option>
	<!--<option value="5">Export</option>-->
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

@section('scripts')
	<script src="/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
	<script src="/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
	<script src="/js/ui-modals.js"></script>
	<script src="/js/ui-customs.js"></script>
	<script>
			jQuery(document).ready(function() {
				Main.init();
				UIModals.init();
				UICustoms.init();
				
			});
	</script>
@stop
