@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => $formkey  ])
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
<form class="form-horizontal" role="form" name="suspicious-words-detector" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="enable_suspicious_word_detector" value="off">



		<fieldset>
			<legend>Server</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			
			</label>
			<div class="col-sm-9">
			
			<div class="checkbox">
			<label>
			<input type="checkbox"  class="green" name="enable_suspicious_word_detector" id="enable_suspicious_word_detector" @if( $enable_suspicious_word_detector == 'on') checked @endif >
			Enable Suspicious word detector
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, suspicious word detector feature will apply for site.</span>
			</div>
			
			<p>Suspicious words</p>			
			<textarea class="form-control" name="suspicious_words" placeholder="Default Text" id="suspicious_words" rows="8">{{ $suspicious_words }}</textarea>
			
				
			
		
			</div>
			</div>


		</fieldset>	









		

		<fieldset>
			<legend>Auto Suspend Module </legend>								
			<div class="form-group">
			<label for="form-field-3" class="col-sm-2 control-label"></label>
			<div class="col-sm-9">
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="auto_suspend_for_project" value="off">
			<input type="checkbox"  class="green" name="auto_suspend_for_project" id="auto_suspend_for_project" @if( $auto_suspend_for_project == 'on') checked @endif >
			Enable Auto Suspend for Projects
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this, project posted with suspicious words in description will automatically be suspended. </span>
			</div>	
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="auto_suspend_for_project_updates" value="off">
			<input type="checkbox"  class="green" name="auto_suspend_for_project_updates" id="auto_suspend_for_project_updates" @if( $auto_suspend_for_project_updates == 'on') checked @endif >
			Enable Auto Suspend for Project's Updates
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this, updates posted with suspicious words will automatically be suspended. </span>
			</div>


			<div class="checkbox">
			<label>
			<input type="hidden" name="auto_suspend_for_project_updates_comment" value="off">
			<input type="checkbox"  class="green" name="auto_suspend_for_project_updates_comment" id="auto_suspend_for_project_updates_comment" @if( $auto_suspend_for_project_updates_comment == 'on') checked @endif >
			Enable Auto Suspend for Project Update's Comment
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this, comment posted for project update, with suspicious\r\nwords will automatically be suspended.</span>
			</div>



			<div class="checkbox">
			<label>
			<input type="hidden" name="auto_suspend_for_messages" value="off">
			<input type="checkbox"  class="green" name="auto_suspend_for_messages" id="auto_suspend_for_messages" @if( $auto_suspend_for_messages == 'on') checked @endif >
			Enable Auto suspend for Messages
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this, messages posted with suspicious words will automatically be suspended.</span>
			</div>			
			
			
			
			
			</div>
			</div>




			
			
		
			
			
		
			
			
		</fieldset>		





		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="suspicious-words-detector-form">Update</button>							
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
