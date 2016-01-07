@extends('agent.layout')
@section('page_title')
	Agent Dashboard
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
							Home
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
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				Profile
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
				<h2><i class="fa fa-pencil-square teal"></i> REGISTER</h2>
				<p>
					Create one account to manage everything you do with ClipOne, from your shopping preferences to your ClipOne activity.
				</p>
				<hr>
				<form action="/agent/profile" role="form" id="form2" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">		
					<div class="row">
						<div class="col-md-12">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> Your form validation is successful!
							</div>
						</div>
						<div class="col-md-6">							
							<div class="form-group">
								<label class="control-label">
									Company Name <span class="symbol required"></span>
								</label>
								<input type="text" placeholder="Insert your Company Name" class="form-control" id="company_name" name="company_name">
							</div>
							<div class="form-group">
								<label class="control-label">
									Contact Name <span class="symbol required"></span>
								</label>
								<input type="text" placeholder="Insert your Contact Name" class="form-control" id="contact_name" name="contact_name">
							</div>
							<div class="form-group">
								<label class="control-label">
									Email Address <span class="symbol required"></span>
								</label>
								<input type="email" placeholder="Text Field" class="form-control" id="email" name="email">
							</div>
							<div class="form-group">
								<label class="control-label">
									Phone Number <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="phone" id="phone">
							</div>
							<div class="form-group">
								<label class="control-label">
									Postal Code <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="postal_code" id="postal_code">
							</div>
						</div>
						<div class="col-md-6">							
							<div class="form-group">
								<label class="control-label">
									Address Line 1 <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="address_one" id="address_one">
							</div>
							<div class="form-group">
								<label class="control-label">
									Address Line 2 <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="address_two" id="address_two">
							</div>							
							<div class="form-group">
								<label class="control-label">
									City <span class="symbol required"></span>
								</label>
								<input class="form-control tooltips" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="city" id="city">
							</div>
							
							<div class="form-group">
								<label class="control-label">
									State <span class="symbol required"></span>
								</label>
								<select class="form-control" id="state" name="state">
									<option value="">Select...</option>
									<option value="Category 1">Category 1</option>
									<option value="Category 2">Category 2</option>
									<option value="Category 3">Category 5</option>
									<option value="Category 4">Category 4</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">
									Country <span class="symbol required"></span>
								</label>
								<select class="form-control" id="country_id" name="country_id">
									<option value="">Select...</option>
									<option value="1">Category 1</option>
									<option value="2">Category 2</option>
									<option value="3">Category 5</option>
									<option value="4">Category 4</option>
								</select>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">
									About <span class="symbol required"></span>
								</label>
								<textarea class="ckeditor form-control" id="about" name="about" cols="10" rows="10"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div>
								<span class="symbol required"></span>Required Fields
								<hr>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<p>
								By clicking REGISTER, you are agreeing to the Policy and Terms &amp; Conditions.
							</p>
						</div>
						<div class="col-md-4">
							<button class="btn btn-yellow btn-block" type="submit">
								Register <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<!-- end: PAGE CONTENT-->
	</div>
</div>
@stop

@section('styles')
	
@stop

@section('scripts')				
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="/agent/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/agent/assets/plugins/summernote/build/summernote.min.js"></script>
<script src="/agent/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="/agent/assets/plugins/ckeditor/adapters/jquery.js"></script>
<script src="/agent/assets/js/form-validation.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->		
<script>
	jQuery(document).ready(function() {		
		FormValidator.init();
	});
</script>
@stop