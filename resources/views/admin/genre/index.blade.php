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
	Masters - Music Genre
	</li> 
	</ol>
	<div class="page-header">
	<h1>Music Genre Management<small> Manage core config data</small></h1>

	<div class="row">
	<a href="<?php echo url(); ?>/admin/genre/approvedrec" class="col-sm-1 listing_stus"><?php echo $actctng; ?> <br> <span class="label label-success"> Active</span></a>
	<a href="<?php echo url(); ?>/admin/genre/disapprovedrec" class="col-sm-1 listing_stus"><?php echo $deactctng; ?> <br> <span class="label label-danger"> Inactive</span></a>
	<a  href="<?php echo url(); ?>/admin/genre/unsetsearchparameter"  class="col-sm-1 listing_stus"><?php echo ( $actctng + $deactctng); ?> <br> <span class="label label-default">All</span></a>
	<div class="col-sm-9">
	<div class="pull-right"> 
	<a href="<?php echo url(); ?>/admin/genre/create" class="btn btn-primary custom-button"><i class="fa fa-plus"></i> Add New</a>
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
	<span style="margin-left:-20px;">Music Genre - 
	<?php if(!empty($recordlist)) { echo $recordlist; } else { echo "All"; } ?></span>
	<div class="panel-tools">
	<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> 
	<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a> 
	</div>
	</div>
	<div class="panel-body">



<?php /* ?>
	<div class="row">
	<div class="col-sm-3 col-md-3 pull-right">

	{!! Form::open(['url' => 'admin/genre/searchparameter', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}  
	<div class="input-group"> 
	<input type="text"  class="form-control" name="search" value="<?php echo $getSearch; ?>" placeholder="Search" >
	<div class="input-group-btn">
	<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
	</div>
	</div>
	{!! Form::close() !!}
	</div>		
	</div>

<?php */ ?>



	<table class="table table-bordered table-hover table-full-width" id="genre_data_table">
	<thead>
	<tr>
	<th  class="center nosort" width="10%" ><input type="checkbox" id="check_all_nonexx"   ></th>
	<th>Genre Name</th> 
	<th>Slag</th> 
	 
	<th>Hidden</th> 
	<th>Create On</th>
	<th>Status</th>
	<th class="center nosort" width="10%" >Action</th>												
	</tr>
	</thead>
	<tbody> 
	<?php $counter=1; ?>
	@foreach ($genrelist as $genre)
	<tr>
	<td class="center" >
	<div class="checkbox-table listChk">
	<label>
	<input type="checkbox" class="ulistcheckbox" name="ulist" value="{{ $genre->id }}">
	</label>
	</div>
	</td>
	<td>{{ $genre->name }}</td>				
	<td>{{ $genre->genre_slug }}</td>		

   
  	<td><?php if($genre->is_hidden == 0 ) { ?><span class="badge badge-danger">No</span><?php } else { ?><span class="badge badge-success">Yes</span><?php } ?></td>  

	<td> {{ date('M d, Y' , strtotime($genre->updated_at) ) }} </td> 
  <td>

<?php if( $genre->active == 1 ) { ?><a class="label label-sm label-success toggle-status" href="javascript:void(0);" data-user="<?php echo $genre->id; ?>" data-status="0" id="activespn_<?php echo $genre->id; ?>" data-url="/admin/genre/" >Active</a><a class="label label-sm label-danger toggle-status" href="javascript:void(0);" data-user="<?php echo $genre->id; ?>" data-status="1" id="inactivespn_<?php echo $genre->id; ?>" style="display:none;" data-url="/admin/genre/" >Inactive</a><?php } else { ?><a class="label label-sm label-danger toggle-status"  href="javascript:void(0);" data-user="<?php echo $genre->id; ?>" data-status="1"   id="inactivespn_<?php echo $genre->id; ?>"  data-url="/admin/genre/" >Inactive</a><a class="label label-sm label-success toggle-status" href="javascript:void(0);" data-user="<?php echo $genre->id; ?>" data-status="0" id="activespn_<?php echo $genre->id; ?>"  style="display:none;"  data-url="/admin/genre/" >Active</a><?php } ?>



	

  </td> 



	<td class="center"  > 
	<div class="btn-group">
	<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
	<i class="fa fa-cog"></i> <span class="caret"></span>
	</a>
	<ul role="menu" class="dropdown-menu pull-right">  	
	<li role="presentation">
	<a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/genre/edit/{{ $genre->id }}">
	<i class="fa fa-edit"></i> Edit
	</a>
	</li>

    <li role="presentation">
    <a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/genre/details/{{ $genre->id }}">
    <i class="fa fa-share"></i> View
    </a>
    </li> 

																
	<li role="presentation">
	<a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $genre->id }}"  data-token="{{ csrf_token() }}" data-url="/admin/genre" >
	<i class="fa fa-times"></i> Remove</a>
	</li>
	</ul>
	</div> 
	</td> 

	</tr>
	<?php $counter++; ?>	
	@endforeach											 
	</tbody>
	</table>


	<div class="row">	
	<div class="col-md-2 col-sm-4 col-xs-12">

	<select id="UserMoreActionId" class="js-admin-index-autosubmit form-control customDrop" name="data[User][more_action_id]" data-token="{{ csrf_token() }}" data-url="/admin/genre">
	<option value="">-- More actions --</option>
	<option value="1">Inactive</option>
	<option value="2" >Active</option>
	<option value="3">Delete</option>
	<option value="5">Export</option>
	</select>

	</div>
	<div class="col-md-10 col-sm-8 col-xs-12">
	<div class="pull-right link pagginasn"><?php //{!! $links !!} ?> </div>
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
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->		
	<script src="/js/ui-modals.js"></script>
	<script src="/js/ui-customs-genre.js"></script>
	<script>
			jQuery(document).ready(function() {
				Main.init();
				UIModals.init();
				UICustoms.init();
				TableData.init();
			});
	</script>

@stop

@include('admin.genre.partials._relatedfiles')
	