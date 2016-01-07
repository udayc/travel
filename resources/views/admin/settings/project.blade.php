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
<form class="form-horizontal" role="form" name="project-form" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<legend>Project Configuration</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Maximum project end date(Days)
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="max_project_end_date" placeholder="Enter maximum days" name="max_project_end_date" value="{{ $max_project_end_date }}" required >
			<span class="help-block"><i class="fa fa-info-circle"></i> This date will be the maximum project end date.</span>
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Project Threshold(%)
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="project_threshold_limit" name="project_threshold_limit" placeholder="Enter threshold value in percentage" value="{{ $project_threshold_limit }}" required >
			<span class="help-block"><i class="fa fa-info-circle"></i> The project will be a 'Go' if it crosses the threshold .</span>
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_send_msg_project" value="off">
			<input type="checkbox"  class="green" name="enable_send_msg_project" id="enable_send_msg_project" @if( $enable_send_msg_project == 'on') checked @endif >
			Enable Send Message
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this feature, send message will be enabled. </span>
			</div>			
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_comment_on_project" value="off">
			<input type="checkbox"  class="green" name="enable_comment_on_project" id="enable_comment_on_project" @if( $enable_comment_on_project == 'on') checked @endif >
			Enable User Comment
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this feature, user comment will be enabled. </span>
			</div>				
			
			
			
			
			</div>
			</div>
		</fieldset>									

	

		<fieldset>
			<legend>Alternate Name Configuration </legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Project - Lower case, Singular - project
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="project_lower_case_singular"  name="project_lower_case_singular" value="{{ $project_lower_case_singular }}" required >
			
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Project - Title case, Singular - Project
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="project_title_case_singular" name="project_title_case_singular" value="{{ $project_title_case_singular }}" required >
			
			</div>
			</div>
			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Project - Lower case, Plural - projects
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="project_lower_case_plural" name="project_lower_case_plural"  value="{{ $project_lower_case_plural }}" required >
			
			</div>
			</div>			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Project - Title case, Plural - Projects
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="project_title_case_plural" name="project_title_case_plural"  value="{{ $project_title_case_plural }}" required >
		
			</div>
			</div>			
			
			<h3>Project Owner</h3>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Project Owner - Lower case, Singular - project owner
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="project_owner_lower_case_singular" name="project_owner_lower_case_singular"  value="{{ $project_owner_lower_case_singular }}" required >
			
			</div>
			</div>			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Project Owner - Title case, Singular - Project Owner
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="project_owner_title_case_singular" name="project_owner_title_case_singular"  value="{{ $project_owner_title_case_singular }}" required >
		
			</div>
			</div>
			
			
			
			<h3>Pledge</h3>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Lower case, Singular - pledge
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_lower_case_singular" name="pledge_lower_case_singular"  value="{{ $pledge_lower_case_singular }}" required >
			
			</div>
			</div>			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Title case, Singular - Pledge
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_title_case_singular" name="pledge_title_case_singular"  value="{{ $pledge_title_case_singular }}" required >		
			</div>
			</div>			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Lower case, Plural - pledges
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_lower_case_plural" name="pledge_lower_case_plural"  value="{{ $pledge_lower_case_plural }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Title case, Plural - Pledges
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_title_case_plural" name="pledge_title_case_plural"  value="{{ $pledge_title_case_plural }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Lower case, Past tense - pledged
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_lower_case_past_tense" name="pledge_lower_case_past_tense"  value="{{ $pledge_lower_case_past_tense }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Title case, Past tense - pledged
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_title_case_past_tense" name="pledge_title_case_past_tense"  value="{{ $pledge_title_case_past_tense }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Lower case, Continuous tense - pledging
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_lower_case_cont_tense" name="pledge_lower_case_cont_tense"  value="{{ $pledge_lower_case_cont_tense }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Pledge - Title case, Continuous tense - Pledging
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_title_case_cont_tense" name="pledge_title_case_cont_tense"  value="{{ $pledge_title_case_cont_tense }}" required >		
			</div>
			</div>	
			
			<h3>Backer</h3>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Backer - Lower case, Singular - backer
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="backer_lower_case_singular" name="backer_lower_case_singular"  value="{{ $backer_lower_case_singular }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Backer - Title case, Singular - Backer
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="backer_title_case_singular" name="backer_title_case_singular"  value="{{ $backer_title_case_singular }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Backer - Lower case, Plural - backers
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="backer_lower_case_plural" name="backer_lower_case_plural"  value="{{ $backer_lower_case_plural }}" required >		
			</div>
			</div>	
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Backer - Title case, Plural - Backers
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="backer_title_case_plural" name="backer_title_case_plural"  value="{{ $backer_title_case_plural }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Backer - Lower case, Past tense - backed
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="backer_lower_case_past_tense" name="backer_lower_case_past_tense"  value="{{ $backer_lower_case_past_tense }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Backer - Title case, Past tense - backed
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="backer_title_case_past_tense" name="backer_title_case_past_tense"  value="{{ $backer_title_case_past_tense }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Backer - Lower case, Continuous tense - backing
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="backer_lower_case_cont_tense" name="backer_lower_case_cont_tense"  value="{{ $backer_lower_case_cont_tense }}" required >		
			</div>
			</div>
			
			<h3>Reward</h3>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Reward - Lower case, Singular - reward
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="reward_lower_case_singular" name="reward_lower_case_singular"  value="{{ $reward_lower_case_singular }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Reward - Title case, Singular - Reward
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="reward_title_case_singular" name="reward_title_case_singular"  value="{{ $reward_title_case_singular }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Reward - Lower case, Plural - rewards
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="reward_lower_case_plural" name="reward_lower_case_plural"  value="{{ $reward_lower_case_plural }}" required >		
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Reward - Title case, Plural - Rewards
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="reward_title_case_plural" name="reward_title_case_plural"  value="{{ $reward_title_case_plural }}" required >		
			</div>
			</div>				
			
			
			
			
			
			
			
			





	
			
		</fieldset>		
	
	
	

	




		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="project-form">Update</button>							
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