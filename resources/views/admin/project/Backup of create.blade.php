@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => 'Add User'  ])
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->
@if ($errors->has())
<div class="alert alert-danger">
@foreach ($errors->all() as $error)
	{{ $error }}<br>        
@endforeach
</div>
@endif





<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-external-link-square"></i> Add Project
</div>

<div class="panel-body">
<form class="form-horizontal" role="form" name="add_user" action="/admin/project" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<legend>Project Info</legend>	
			
			<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Name
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="name" placeholder="Enter project name" name="name"  >
			</div>
			</div>
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			 Project Category
			</label>
			<div class="col-sm-9">			
			<select class="form-control" id="P_CAT_ID" name="P_CAT_ID">			
			<option value="general">User</option>
			</select>										
			</div>
			</div>				
			
			
			
			
			
			<div class="form-group @if ($errors->has('short_description')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Short Description
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="short_description" placeholder="Default Text" id="short_description" rows="8"></textarea>
			</div>
			</div>

			<div class="form-group @if ($errors->has('username')) has-error @endif">
			<label for="form-field-2" class="col-sm-2 control-label">
			Upload Image
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="input-group">
					<div class="form-control uneditable-input">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview"></span>
					</div>
					<div class="input-group-btn">
						<div class="btn btn-light-grey btn-file">
							<span class="fileupload-new"><i class="fa fa-folder-open-o"></i> Select file</span>
							<span class="fileupload-exists"><i class="fa fa-folder-open-o"></i> Change</span>
							<input type="file" class="file-input" name="file_attachment">
						</div>
						<a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
							<i class="fa fa-times"></i> Remove
						</a>
					</div>
				</div>
				<p class="help-block">
				Only jpg , png , gif support
				</p>			
				
				
			</div>	





			
			</div>
			</div>
			
			



		
	
		</fieldset>									

	
		<fieldset>
			<legend>Funding</legend>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Payment Method
			</label>
			<div class="col-sm-9">			
			<select class="form-control" id="type" name="type">			
			<option value="general">Fixed Funding</option>
			</select>										
			</div>
			</div>	



			
			
			<div class="form-group @if ($errors->has('funding_goal')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Needed Amount
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="funding_goal" placeholder="Enter your website url" name="funding_goal" value="">
			
			<div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="allow_overfunding" id="allow_overfunding" >
			Allow overfunding
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, users can authenticate their account using Facebook.</span>
			</div>			
			
			
			
			</div>
			</div>
			
			
			<div class="form-group @if ($errors->has('funding_end_date')) has-error @endif">
			<label for="dob" class="col-sm-2 control-label">
			Project funding end date
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9"><div class="input-group">
			<input type="text" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" name="funding_end_date" id="funding_end_date" value="">
			<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>	</div>	
			</div>
			</div>			
			
			
			
			
			
			

		</fieldset>		


		<fieldset>
			<legend>Websites</legend>	
			
			<div class="form-group @if ($errors->has('linkedIn_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			LinkedIn URL
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="linkedIn_url" placeholder="Enter full name" name="linkedIn_url"  >
			</div>
			</div>
			
			<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Twitter URL
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="twitter_url" placeholder="Enter full name" name="twitter_url"  >
			</div>
			</div>			
			
			<div class="form-group @if ($errors->has('myspace_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			MySpace URL
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="myspace_url" placeholder="Enter full name" name="myspace_url" >
			</div>
			</div>			
			
			<div class="form-group @if ($errors->has('homepage_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Home page URL
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="homepage_url" placeholder="Enter full name" name="homepage_url" >
			</div>
			</div>			
			

			<div class="form-group @if ($errors->has('facebook_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Facebook URL
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="facebook_url" placeholder="Enter full name" name="facebook_url" >
			</div>
			</div>			
			
			<div class="form-group @if ($errors->has('imdb_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			IMDb URL
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="url" class="form-control" id="imdb_url" placeholder="Enter imdb url" name="imdb_url" >
			</div>
			</div>		


		
	
		</fieldset>			
		
		
		
		
		
		
		
		
		


		<fieldset>
		<legend>&nbsp;</legend>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="add-user-form">Continue</button>							
			</div>
			</div>										
		</fieldset>


</form>
</div>

</div>
</div>					
</div>	




<!-- end: PAGE CONTENT-->
</div>

@stop

@include('admin.settings.partials._relatedfiles')