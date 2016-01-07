@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.project.partials._pageheaderother' , ['settings_form' => 'Edit Project'  ]) 
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

<form enctype="multipart/form-data" accept-charset="UTF-8" class="form-horizontal" role="form" name="add_user" action="/admin/project/updateproject" method="POST" id="form4kkyyy">


<div class="errorHandler alert alert-danger no-display">
<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
</div>
<div class="successHandler alert alert-success no-display">
<i class="fa fa-ok"></i> Your form validation is successful!
</div>



<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="step" value="1">
@include('admin.project.partials._formstep_1' , ['class' => 'selected' , 'rel'=>'1' , 'isDone' => '1' ,'skey' => Session::get('edit_id') ])

		<fieldset>
			<legend>User</legend>
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			 Select User <span class="symbol required"></span>
			</label>
			<div class="col-sm-9">			
			{!! Form::select('user_id', $users , (empty($projectdet) ? null : $projectdet->user_id) ,  array('class' => 'form-control')) !!} 		
			</div>
			</div>	

		</fieldset>			
		
		
		<fieldset>
			<legend>Basic Info</legend>	
			
			<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Name 
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="name" placeholder="Enter project name" name="name"  value="{{ isset($projectdet->name) ? $projectdet->name : ''}}">
			</div>
			</div>
			
 			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			 Select Genre <span class="symbol required"></span>
			</label>
			<div class="col-sm-9">			
			{!! Form::select('project_genre_id', $genres , (empty($projectdet) ? null : $projectdet->project_genre_id)  ,  array('class' => 'form-control')) !!}			
			</div>
			</div>	


			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			 Project Category <span class="symbol required"></span>
			</label>
			<div class="col-sm-9">			
			{!! Form::select('P_CAT_ID', $categories , (empty($projectdet) ? null : $projectdet->P_CAT_ID)  ,  array('class' => 'form-control')) !!}			
			</div>
			</div>			
			
			 
			
			<div class="form-group @if ($errors->has('short_description')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Short Description
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="short_description" placeholder="Default Text" id="short_description" rows="8">{{ isset($projectdet->short_description) ? $projectdet->short_description : ''}}</textarea>
			</div>
			</div>

			<div class="form-group @if ($errors->has('funding_goal')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Upload Pitch Video 
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
							<input type="file" class="file-input" name="pitch_video">
						</div>
						<a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
							<i class="fa fa-times"></i> Remove
						</a>
					</div>
				</div> 
				<p class="help-block">
				This video will be uploaded through YouTube channel [<a href="<?php echo url(); ?>/images/file-attached-to-project/video/<?php echo $projectdet->pitch_video;  ?>" target="_blank" >View File</a>]
				</p>		
			</div>	
			</div>
			</div> 


			<div class="form-group @if ($errors->has('username')) has-error @endif">
			<label for="form-field-2" class="col-sm-2 control-label">
			Upload Image
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			
               <div class="fileupload fileupload-new" data-provides="fileupload"> 
                <div class="fileupload-new thumbnail" style="width: 350px; height: 160px;"><img src="<?php echo url(); ?>/images/file-attached-to-project/resize/<?php echo $projectdet->file_attachment;  ?>" border="0"  width="350" > 
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 160px; line-height: 20px;"></div> 
                <div>
                    <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                     <input type="file" name="file_attachment" id="file_attachment"  >
                    </span>
                    <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                        <i class="fa fa-times"></i> Remove
                    </a>
                </div> 
            	</div>

			</div>
			</div>
		</fieldset>									

	
		<fieldset>
			<legend>Funding</legend>

 
 			<div class="form-group @if ($errors->has('project_duration')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Currency Type
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="currencytype" placeholder="Project duration" name="currencytype" 
			 value="{{  $projectdet->currencytype }}" readonly=""  >  
			<span class="help-block"><i class="fa fa-info-circle"></i> This value comming from system settings.</span>
			</div> 
			</div>	

			
			<div class="form-group @if ($errors->has('funding_goal')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Goal Amount
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="funding_goal" placeholder="Enter funding goal amount" name="funding_goal" value="{{ isset($projectdet->funding_goal) ? $projectdet->funding_goal : ''}}">
			
			<div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="allow_overfunding" id="allow_overfunding" {{ isset($projectdet->allow_overfunding) ? 'checked' : ''}} >
			Allow overfunding
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, users can authenticate their account using Facebook.</span>
			</div>	 
			</div>
			</div> 
 
			
			
			<div class="form-group @if ($errors->has('project_duration')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Project Duration (Days)
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="number" class="form-control" id="project_duration" placeholder="Project duration" name="project_duration" value="{{ isset($projectdet->project_duration) ? $projectdet->project_duration : ''}}" min="30" max="{{ $_settings_data->max_project_end_date }}">  
			</div>
			</div>	 		 
			

		</fieldset>		


		<fieldset>
			<legend>Websites</legend>	
			
			<div class="form-group @if ($errors->has('facebook_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Facebook URL		
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="facebook_url" placeholder="Enter facebook url" name="facebook_url" value="{{ isset($projectdet->facebook_url) ? $projectdet->facebook_url : ''}}" >
			</div>
			</div>		
			
			<div class="form-group @if ($errors->has('twitter_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Twitter URL			
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="twitter_url" placeholder="Enter twitter url" name="twitter_url" value="{{ isset($projectdet->twitter_url) ? $projectdet->twitter_url : ''}}" >
			</div>
			</div>			
			
			<div class="form-group @if ($errors->has('instagram_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Instagram URL			
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="instagram_url" placeholder="Enter myspace url " name="instagram_url" value="{{ isset($projectdet->instagram_url) ? $projectdet->instagram_url : ''}}" >
			</div>
			</div>			
			
			<div class="form-group @if ($errors->has('youtube_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Youtube URL			
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="youtube_url" placeholder="Enter homepage url" name="youtube_url" value="{{ isset($projectdet->youtube_url) ? $projectdet->youtube_url : ''}}" >
			</div>
			</div>		 
			
			
			<div class="form-group @if ($errors->has('soundcloud_url')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			SoundCloud URL			
			</label>
			<div class="col-sm-9">
			<input type="url" class="form-control" id="soundcloud_url" placeholder="Enter imdb url" name="soundcloud_url" value="{{ isset($projectdet->soundcloud_url) ? $projectdet->soundcloud_url : ''}}">
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

@include('admin.project.partials._relatedfiles')