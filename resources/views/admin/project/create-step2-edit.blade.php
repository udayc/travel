@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
<?php if($func=="add") { $subtitle="Add Project"; $sid="back-step-2"; } else { $subtitle="Edit Project"; $sid="back-step-22"; } ?>
@include('admin.project.partials._pageheaderother' , ['settings_form' => "Edit Project"  ])
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
<span style="margin-left:-20px;">Edit Project</span>
</div>

<div class="panel-body">


<form enctype="multipart/form-data" accept-charset="UTF-8" class="form-horizontal" role="form" name="add_project" action="/admin/project/updateproject" method="POST" id="form5" >

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="errorHandler alert alert-danger no-display">
<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
</div>
<div class="successHandler alert alert-success no-display">
<i class="fa fa-ok"></i> Your form validation is successful!
</div>




<!-- set For step -->
@include('admin.project.partials._formstep_2' , ['class' => 'selected' , 'rel'=>'1' , 'isDone' => '1' ,'skey' => (Session::get('last_insert_id') != null)? Session::get('last_insert_id') : $last_insert_id  ])
<!-- set For step : End  -->

		<fieldset>
			<legend>Project Details </legend>	
			<div class="form-group @if ($errors->has('details_description')) has-error @endif">
			<label for="details_description" class="col-sm-2 control-label">
			Project Details
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="details_description" placeholder="Default Text" id="details_description" rows="8">{{ isset($projectdet->details_description) ? $projectdet->details_description : ''}}</textarea>
			</div>
			</div>
		</fieldset>									

	
		<fieldset>
			<legend>Location</legend>

			<div class="form-group @if ($errors->has('country')) has-error @endif">
			<label for="country" class="col-sm-2 control-label">
			Country
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			{!! Form::select('country_id', $countries , (empty($projectdet) ? null : $projectdet->country_id) , array('class' => 'form-control', 'id' => 'country_id'   ))  !!}
			</div>
			</div>	

			<div class="form-group @if ($errors->has('funding_goal')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			City
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9"> 
			 {!! Form::select('city', $citylist , (empty($projectdet) ? null : $projectdet->city) , array('class' => 'form-control', 'id' => 'cities' ))  !!}
			</div>
			</div>

			<div class="form-group @if ($errors->has('state')) has-error @endif">
			<label for="state" class="col-sm-2 control-label">
			State
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="state" placeholder="Enter state" name="state" value="{{ isset($projectdet->state) ? $projectdet->state : ''}}">
			</div>
			</div>				


			<div class="form-group @if ($errors->has('address')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Address
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="address" placeholder="Enter your valid address" name="address" value="{{ isset($projectdet->address) ? $projectdet->address : ''}}">
			</div>
			</div>
			
			<div class="form-group @if ($errors->has('address_alternate')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Address(Optional)
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="address_alternate" placeholder="Enter your alternate address" name="address_alternate" value="{{ isset($projectdet->address_alternate) ? $projectdet->address_alternate : ''}}">
			</div>
			</div>			
			
				
			

			
			
			
			
			<div class="form-group @if ($errors->has('pincode')) has-error @endif">
			<label for="pincode" class="col-sm-2 control-label">
			Pincode
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pincode" placeholder="Enter pincodex" name="pincode" value="{{ isset($projectdet->pincode) ? $projectdet->pincode : ''}} ">
			</div>
			</div>				
	

		</fieldset>		


		<fieldset>
			<legend>Project Updates</legend>	
			
			<div class="form-group @if ($errors->has('feed_url')) has-error @endif">
			<label for="feed_url" class="col-sm-2 control-label">
			Feed URL
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="feed_url" placeholder="Enter feed_url" name="feed_url"  value="{{ isset($projectdet->feed_url) ? $projectdet->feed_url : ''}} ">
			<span class="help-block"><i class="fa fa-info-circle"></i> Automatically fetch update from the given feed url.</span>
			</div>
			</div>

		</fieldset>			
		
		
 			
 

		<fieldset>
		<legend>&nbsp;</legend>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">
			<button type="button" class="btn btn-orange" name="submit-btn" id="<?php echo $sid; ?>" value="1" data-token="{{ csrf_token() }}" >Back</button>			
			<button type="submit" class="btn btn-orange" name="submit" value="add-user-form">Continue</button>							
			</div>
			</div>										
		</fieldset>


<input type="hidden" name="step" value="2">
</form>
</div>

</div>
</div>					
</div>	




<!-- end: PAGE CONTENT-->
</div>

@stop

@include('admin.project.partials._relatedfiles')