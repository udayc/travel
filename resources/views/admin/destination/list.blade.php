@extends('admin.layout')
@section('page_title')
	Administration Dashboard
@stop
@section('content')
<div class="main-content">
	<div class="container">
		<!-- start: PAGE HEADER -->
		<div class="row">
			<div class="col-sm-12">				
				<!-- start: PAGE TITLE & BREADCRUMB -->
				<ol class="breadcrumb">
					<li>
						<i class="clip-home-3"></i>
						<a href="#">
							Destination
						</a>
					</li>
					<li class="active">
						Dashboard
					</li>
					<li class="search-box">
						<form class="sidebar-search">
							<div class="form-group">
								<input type="text" placeholder="Start Searching...">
								<button class="submit">
									<i class="clip-search-3"></i>
								</button>
							</div>
						</form>
					</li>
				</ol>
				<div class="page-header">
					<h1>Dashboard <small>overview &amp; stats </small></h1>
				</div>
				<!-- end: PAGE TITLE & BREADCRUMB -->
			</div>
		</div>
		<!-- end: PAGE HEADER -->
		<!-- start: PAGE CONTENT -->		
		<div class="row">
			<div class="col-md-12">
				<!-- start: DYNAMIC TABLE PANEL -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-external-link-square"></i>
						Dynamic Table
						<div class="panel-tools">
							<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
							</a>
							<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
								<i class="fa fa-wrench"></i>
							</a>
							<a class="btn btn-xs btn-link panel-refresh" href="#">
								<i class="fa fa-refresh"></i>
							</a>
							<a class="btn btn-xs btn-link panel-expand" href="#">
								<i class="fa fa-resize-full"></i>
							</a>
							<a class="btn btn-xs btn-link panel-close" href="#">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
							<thead>
								<tr>
									<th>Name</th>
									<th class="hidden-xs">Description</th>
									<th>Status</th>									
								</tr>
							</thead>
							<tbody>
								@if(count($destinations) > 0)
								@foreach($destinations as $destination)
								<tr>
									<td>{{ $destination->name }}</td>
									<td class="hidden-xs">{{ $destination->description }}</td>
									<!-- <td>{{ $destination->visibility }}</td>	-->
									<td class="dl">
										
										<a class="label label-sm label-warning" href="javascript:changestatus( '', '0' )" id="activespn_1">Invisible</a>
										<a class="label label-sm label-success" href="javascript:changestatus( '', '0' )" id="activespn_1"  >Visible</a>
										
										
										

									</td>
								</tr>
								@endforeach
								<tr>
									<td colspan="4"><?php echo $destinations->render(); ?></td>
								</tr>
								@else
									<tr>
										<td colspan="4">No Data Found</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
				<!-- end: DYNAMIC TABLE PANEL -->
			</div>
		</div>
		<!-- end: PAGE CONTENT-->
	</div>
</div>
@stop

@section('styles')
	
@stop

@section('scripts')				
		
@stop