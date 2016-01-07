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
<form class="form-horizontal" role="form" name="api-settings-form" id="api-settings-form" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<legend>Facebook Credentials</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			App Id
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="fb_app_id" placeholder="Facebook App Id" name="fb_app_id" value="{{ $fb_app_id }}" >
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			App Secret Id
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="fb_app_secret" name="fb_app_secret" placeholder="Facebook App Secret" value="{{ $fb_app_secret }}" >
			
			</div>
			</div>
		</fieldset>									

		<fieldset>
			<legend>Twitter Credentials</legend>								
			<div class="form-group">
			<label for="form-field-3" class="col-sm-2 control-label">Consumer key</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="twitter_consumer_key" name="twitter_consumer_key" placeholder="Twitter Consumer key" value="{{ $twitter_consumer_key }}">
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-4" class="col-sm-2 control-label">
			Consumer Secret
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="twitter_consumer_secret" name="twitter_consumer_secret" placeholder="Twitter Consumer Secret" value="{{ $twitter_consumer_secret }}" >
			</div>
			</div>

		
			
			
		
			
			
		</fieldset>		

		<fieldset>
			<legend>Google+ Credentials</legend>			


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Client ID
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="gplus_client_id" name="gplus_client_id" placeholder="Client ID" value="{{ $gplus_client_id }}">
			</div>
			</div>

			<div class="form-group ">
			<label for="form-field-5" class="col-sm-2 control-label">
			Client Secret
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="gplus_client_secret" name="gplus_client_secret" placeholder="Client Secret" value="{{ $gplus_client_secret }}">
			</div>
			</div>		

			
			<div class="form-group ">
			<label for="form-field-5" class="col-sm-2 control-label">
			Developer Key
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="gplus_developer_key" name="gplus_developer_key" placeholder="Developer Key" value="{{ $gplus_developer_key }}">
			</div>
			</div>				
			
			
			
			
		</fieldset>



		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="api-settings-form">Update</button>							
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