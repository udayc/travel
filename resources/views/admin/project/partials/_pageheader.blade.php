<!-- start: PAGE HEADER -->
<div class="row">
<div class="col-sm-12">

<ol class="breadcrumb">
	<li>
	<i class="clip-home-3"></i>
	<a href="<?php echo url(); ?>/admin/dashboard">Home</a></li>
	<li class="active">Projects</li>
	<li class="active">{{ $settings_form }}</li>
	

</ol>					

<div class="page-header">
	<h1>{{ $settings_form }}<small> Manage core config data</small></h1>
	
	<div class="row">
<div class="col-sm-10 stat-label">	
	<a href="{{ URL::to('admin/project/index/active') }}" class="col-sm-1 listing_stus">{{$projectStat['active']}}<br><span class="label label-success">Active</span></a>
	<a href="{{ URL::to('admin/project/index/inactive') }}" class="col-sm-1 listing_stus">{{$projectStat['inactive']}}<br><span class="label label-danger">Inactive</span></a>
	<a href="{{ URL::to('admin/project/index/featured') }}" class="col-sm-1 listing_stus">{{$projectStat['featured']}}<br><span class="label label-featured">Staff Pick</span></a>
	<a href="{{ URL::to('admin/project/index/suspended') }}" class="col-sm-2 listing_stus">{{$projectStat['suspend']}}<br><span class="label label-inverse">Suspended</span></a>
	<a href="{{ URL::to('admin/project/index/flaged') }}" class="col-sm-2 listing_stus">{{$projectStat['flag']}}<br><span class="label label-systemflagged">System Flagged</span></a>
	<a href="{{ URL::to('admin/project/index/uflaged') }}" class="col-sm-2 listing_stus">{{$projectStat['userflag']}}<br><span class="label label-userflagged">User Flagged</span></a>
	<a href="/admin/project"  class="col-sm-1 listing_stus">{{$projectStat['all']}}<br><span class="label label-default">All</span></a>
	
</div>

	<!--<div class="col-sm-2 pull-right">	
		<a class="btn btn-green custom-button" href="/admin/project/create">Add Project <i class="fa fa-plus"></i></a>
	</div>	-->

							<div class="col-sm-2">
								 <div class="pull-right"> 
                            		<a href="/admin/project/create" class="btn btn-primary custom-button pull-right"><i class="fa fa-plus"></i> Add New</a>
                            	</div>
						</div>
 
	</div>	
	
	

	
	
	
	
	
	
	
	
	
	
	
</div>

</div>
</div>	