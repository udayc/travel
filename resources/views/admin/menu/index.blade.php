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
	Site Management / Header Menu
	</li> 
	</ol>
	<div class="page-header">
	<h1>Menu Management<small> Manage core config data</small></h1>

	<div class="row">
	<a href="<?php echo url(); ?>/admin/menu/approvedrec" class="col-sm-1 listing_stus"><?php echo $actctng; ?> <br> <span class="label label-success"> Approved</span></a>
	<a href="<?php echo url(); ?>/admin/menu/disapprovedrec" class="col-sm-1 listing_stus"><?php echo $deactctng; ?> <br> <span class="label label-danger"> Disapproved</span></a>
	<a  href="<?php echo url(); ?>/admin/menu/unsetsearchparameter"  class="col-sm-1 listing_stus"><?php echo ( $actctng + $deactctng); ?> <br> <span class="label label-default">All</span></a>
	<div class="col-sm-9">
	<div class="pull-right"> 
	<a href="<?php echo url(); ?>/admin/menu/create" class="btn btn-primary custom-button"><i class="fa fa-plus"></i> Add New</a>
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
	<span style="margin-left:-20px;">Menu Management - 
	<?php if(!empty($recordlist)) { echo $recordlist; } else { echo "All"; } ?></span>
	<div class="panel-tools">
	<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> 
	<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a> 
	</div>
	</div>
	<div class="panel-body">




	<div class="row">
	<div class="col-sm-3 col-md-3 pull-right">

	{!! Form::open(['url' => 'admin/menu/searchparameter', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}  
	<div class="input-group"> 
	<input type="text"  class="form-control" name="search" value="<?php echo $getSearch; ?>" placeholder="Search" >
	<div class="input-group-btn">
	<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
	</div>
	</div>
	{!! Form::close() !!}
	</div>		
	</div>





	<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
	<thead>
	<tr>
	<th  class="center" width="5%" >
	<input type="checkbox" id="check_all_nonexx"   >
	</th>

	<th>Title</th> 	
	<th>Slag</th> 
	<th>Parent</th> 	
	<th>URL</th> 				
	<th>Weight</th>
	<th>Show On Header </th> <th>Show On Footer </th> 	
	<th>Created On</th>
	<th class="center">Status</th>
	<th class="center" width="10%" >Action</th> 												
	</tr>
	</thead>

	<tbody> 
	@if( count($menulist) > 0 )
	<?php $counter=1; ?>
	@foreach ($menulist as $menu)
	

	<tr>
	<td class="center" >
	<div class="checkbox-table listChk">
	<label>
	<input type="checkbox" class="ulistcheckbox" name="ulist" value="{{ $menu->id }}">
	</label>
	</div>
	</td>


	<td>{{ $menu->name }}</td>
	<td>{{ $menu->menu_slug }} </td>
	<td><?php  if($menu->parent_id > 0 ) echo \App\Models\Menu::menuNameById($menu->parent_id)->name ; else print 'Null' ?></td>
	<td><?php echo url(); ?>/<?php echo $menu->menu_slug; ?></td>
	<td><?php echo $menu->weight; ?></td>
	<td><code><?php echo $menu->add_to_header_menu; ?></code></td>
	<td><code><?php echo $menu->add_to_footer_menu; ?></code></td>
	<td> {{ date('M d, Y' , strtotime($menu->updated_at) ) }} </td> 
	<td  class="center" >
	<?php if($menu->active!=0) { ?>
	<span class="label label-sm label-success">Active</span>
	<?php } else { ?>
	<span class="label label-sm label-danger">Pending</span>
	<?php } ?>
	</td>
	<td class="center"  > 
	<div class="btn-group">
	<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
	<i class="fa fa-cog"></i> <span class="caret"></span>
	</a>
	<ul role="menu" class="dropdown-menu pull-right">  
	<li role="presentation">
	<a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/menu/edit/{{ $menu->id }}">
	<i class="fa fa-edit"></i> Edit
	</a>
	</li>															
	<li role="presentation">
	<a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $menu->id }}"  data-token="{{ csrf_token() }}" data-url="/admin/menu">
	<i class="fa fa-times"></i> Remove</a>
	</li>
	</ul>
	</div> 
	</td> 	






	</tr>
	<?php $counter++; ?>	
	@endforeach	
	
@else
	<tr><td colspan="8" class="center">  No Result Found</td> </tr>
@endif
	</tbody>
	</table>


	<div class="row">	
	<div class="col-md-2 col-sm-4 col-xs-12">

	<select id="UserMoreActionId" class="js-admin-index-autosubmit form-control customDrop" name="data[User][more_action_id]" data-token="{{ csrf_token() }}" data-url="/admin/menu">
	<option value="">-- More actions --</option>
	<option value="1">Disapprove</option>
	<option value="2" >Approve</option>
	<option value="3">Delete</option>
	<option value="5">Export</option>
	</select>

	</div>
	<div class="col-md-10 col-sm-8 col-xs-12">
	<div class="pull-right link pagginasn">{!! $links !!}</div>
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
	<script src="/js/ui-customs-menu.js"></script>
	<script>
			jQuery(document).ready(function() {
				Main.init();
				UIModals.init();
				UICustoms.init();
				
			});
	</script>

@stop


@include('admin.menu.partials._relatedfiles')
	