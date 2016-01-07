<!-- start: PAGE HEADER -->
<div class="row">
<div class="col-sm-12">
<ol class="breadcrumb">
	<li><i class="clip-home-3"></i><a href="{{ URL::to('/admin/user') }}">Home</a></li>
	<li class="active">User</li>
	<li class="active">{{ $page_title }}</li>	
</ol>					

<div class="page-header"><h1>{{ $page_title }}<small> Manage core config data</small></h1>

@if( $userStat != null)	
<div class="row">
<div class="col-sm-6">
<a href="{{ URL::to('/admin/user/filter-by/active') }}" class="col-sm-1 listing_stus custmLabel">{{$userStat['active']}}<br><span class="label label-success">Active</span></a>
<a href="{{ URL::to('/admin/user/filter-by/in-active') }}" class="col-sm-1 listing_stus custmLabel">{{$userStat['inactive']}}<br><span class="label label-danger">Inactive</span></a>
<a href="{{ URL::to('/admin/user/filter-by/fb') }}" class="col-sm-1 listing_stus custmLabel">{{$userStat['facebook']}}<br><span class="label label-facebook">Facebook</span></a>
<a href="{{ URL::to('/admin/user/filter-by/twitter') }}" class="col-sm-1 listing_stus custmLabel">{{$userStat['twitter']}}<br><span class="label label-twitter">Twitter</span></a>
<a href="{{ URL::to('/admin/user/filter-by/gplus') }}" class="col-sm-1 listing_stus custmLabel">{{$userStat['googleplus']}}<br><span class="label label-googleplus">Google+</span></a>
<a href="{{ URL::to('/admin/user/filter-by/all') }}"  class="col-sm-1 listing_stus custmLabel">{{$userStat['all']}}<br><span class="label label-default">All</span></a>
</div>	

<div class="col-sm-6">	
<a class="btn btn-primary custom-button pull-right" href="{{ URL::to('/admin/user/create') }}"><i class="fa fa-plus"></i> Add New</a>
</div>	
</div>	
@endif		
</div>
</div>
</div>