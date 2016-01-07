@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => ucwords($formkey)  ])
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->


	
<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-external-link-square"></i>
{{ ucwords($formkey) }}
</div>

<div class="panel-body">
<form class="form-horizontal" role="form" name="project-owner-form" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="allowe_overfunding" value="off">
		<fieldset>
			<legend>Configuration</legend>									
			<div class="form-group">
			<label for="min_project_amnt" class="col-sm-2 control-label">
			Minimum Project Amount($)
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="min_project_amnt" placeholder="Minimum Project Amount" name="min_project_amnt" value="{{ $min_project_amnt }}" required >
			</div>
			</div>

			<div class="form-group">
			<label for="max_project_amnt" class="col-sm-2 control-label">
			Maximum Project Amount($)
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="max_project_amnt" name="max_project_amnt" placeholder="Maximum Project Amount" value="{{ $max_project_amnt }}" required>
			<span class="help-block"><i class="fa fa-info-circle"></i> Contact and other notification mails will come to this email..</span>
			</div>
			</div>
			
			<div class="form-group">
			<label for="max_project_amnt" class="col-sm-2 control-label">
			Minimum Length for Project Short Description
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="min_length_project_short_description" name="min_length_project_short_description" placeholder="Minimum Length for Project Short Description" value="{{ $min_length_project_short_description }}" required>
			<span class="help-block"><i class="fa fa-info-circle"></i>This is the minimum character length for project's short description.</span>
			</div>
			</div>			
			
			<div class="form-group">
			<label for="max_project_amnt" class="col-sm-2 control-label">
			Maximum Length for Project Short Description
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="max_length_project_short_description" name="max_length_project_short_description" placeholder="Maximum Length for Project Short Description" value="{{ $max_length_project_short_description }}" required>
			<span class="help-block"><i class="fa fa-info-circle"></i>This is the maximum character length for project's short description.</span>
			</div>
			</div>			
			
			
		</fieldset>									



		<fieldset>
			<legend>Overfunding </legend>			


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Overfunding
			</label>
			<div class="col-sm-9">

			<div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="allowe_overfunding" id="allowe_overfunding" @if( $allowe_overfunding == 'on' ) checked @endif>
			Enable to Allow Project Owner to Set Overfunding for pledge and donate Project
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this, project owner can set over funding for pledge project.</span>
			</div>			
			
			</div>
			</div>



		</fieldset>



		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="project-owner-form">Update</button>							
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