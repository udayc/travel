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
<form class="form-horizontal" role="form" name="systems" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="maintenance_mode" value="off">
<input type="hidden" name="enable_ssl" value="off">
		<fieldset>
			<legend>General Settings</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Site Name
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="site_name" placeholder="Text Field" name="site_name" value="{{ $site_name }}" >
			</div>
			</div>
			
	
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			From Email Address
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="from_email_address" name="from_email_address" placeholder="Enter Site Contact Email Address" value="{{ $from_email_address }}" required>
			<span class="help-block"><i class="fa fa-info-circle"></i> You can change this email address so that 'From' email will be changed in all email communication.</span>
			</div>
			</div>

		
			

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Enquiry Email Address
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Enter Site Contact Email Address" value="{{ $contact_email }}" required>
			<span class="help-block"><i class="fa fa-info-circle"></i> Contact and other notification mails will come to this email..</span>
			</div>
			</div>
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Registration Contact Email
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="reg_contact_email" name="reg_contact_email" placeholder="Enter Registration Contact Email" value="{{ $reg_contact_email }}" required >
			<span class="help-block"><i class="fa fa-info-circle"></i> Contact and other notification mails will come to this email..</span>
			</div>
			</div>			
			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Payment Contact Email 
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="payment_contact_email" name="payment_contact_email" placeholder="Enter Payment Contact Email" value="{{ $payment_contact_email }}" required >
			<span class="help-block"><i class="fa fa-info-circle"></i> Contact and other notification mails will come to this email..</span>
			</div>
			</div>			
			
			
			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Contact Address Details
			</label>
			<div class="col-sm-9">
			
			<textarea class="form-control" name="contact_address" placeholder="Default Text" id="contact_address" rows="3">{{ $contact_address }}</textarea>
			<span class="help-block"><i class="fa fa-info-circle"></i> Contact address details will be shown on footer area</span>
			</div>
			</div>




			
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			CopyRight Text
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="copyright_text" name="copyright_text" placeholder="Enter Site Copyright Text" value="{{ $copyright_text }}" >
			<span class="help-block"><i class="fa fa-info-circle"></i> This text will be shown on footer area</span>
			</div>
			</div>						
			
			
			
		</fieldset>	

		<fieldset>
			<legend>Server</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			
			</label>
			<div class="col-sm-9">
			
			<div class="checkbox">
			<label>
			<input type="checkbox"  class="green" name="maintenance_mode" id="maintenance_mode" @if( $maintenance_mode == 'on') checked @endif >
			Maintenance mode
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, only administrator can access the site.</span>
			</div>			
			
			<div class="checkbox">
			<label>
			<input type="checkbox"  class="green" name="enable_ssl" id="enable_ssl" @if( $enable_ssl == 'on') checked @endif >
			Enable SSL
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, users can authenticate their account using Facebook.</span>
			</div>			
			
		
			</div>
			</div>


		</fieldset>	


		<fieldset>
			<legend>Social Marketing</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			
			</label>
			<div class="col-sm-9">
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_fb_share" value="off">
			<input type="checkbox"  class="green" name="enable_fb_share" id="enable_fb_share" @if( $enable_fb_share == 'on') checked @endif >
			Enable Facebook
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>			
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_twitter_share" value="off">
			<input type="checkbox"  class="green" name="enable_twitter_share" id="enable_twitter_share" @if( $enable_twitter_share == 'on') checked @endif >
			Enable Twitter
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>

			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_pinterest_share" value="off">
			<input type="checkbox"  class="green" name="enable_pinterest_share" id="enable_pinterest_share" @if( $enable_pinterest_share == 'on') checked @endif >
			Enable Pinterest
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>

			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_gplus_share" value="off">
			<input type="checkbox"  class="green" name="enable_gplus_share" id="enable_gplus_share" @if( $enable_gplus_share == 'on') checked @endif >
			Enable GooglePlus
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>	


			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_linkedin_share" value="off">
			<input type="checkbox"  class="green" name="enable_linkedin_share" id="enable_linkedin_share" @if( $enable_linkedin_share == 'on') checked @endif >
			Enable LinkedIn
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>	

			
			<div class="checkbox">
			<label>
			<input type="hidden" name="enable_email_share" value="off">
			<input type="checkbox"  class="green" name="enable_email_share" id="enable_email_share" @if( $enable_email_share == 'on') checked @endif >
			Enable Email
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>				
			
		
			</div>
			</div>
		</fieldset>




		<fieldset>
			<legend>MusicFunder Social Media - Display On Page Bottom Area</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			
			</label>
			<div class="col-sm-9">
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_fb_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_fb_share" id="mf_enable_fb_share" @if( $mf_enable_fb_share == 'on') checked @endif >
			Enable Facebook
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>			
			
			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_twitter_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_twitter_share" id="mf_enable_twitter_share" @if( $mf_enable_twitter_share == 'on') checked @endif >
			Enable Twitter
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>

			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_pinterest_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_pinterest_share" id="mf_enable_pinterest_share" @if( $mf_enable_pinterest_share == 'on') checked @endif >
			Enable Pinterest
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>

			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_gplus_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_gplus_share" id="mf_enable_gplus_share" @if( $mf_enable_gplus_share == 'on') checked @endif >
			Enable GooglePlus
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>	


			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_linkedin_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_linkedin_share" id="mf_enable_linkedin_share" @if( $mf_enable_linkedin_share == 'on') checked @endif >
			Enable LinkedIn
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>	

			
			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_email_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_email_share" id="mf_enable_email_share" @if( $mf_enable_email_share == 'on') checked @endif >
			Enable Email
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>

			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_instagram_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_instagram_share" id="mf_enable_instagram_share" @if( $mf_enable_instagram_share == 'on') checked @endif >
			Enable Instagram
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>	


			<div class="checkbox">
			<label>
			<input type="hidden" name="mf_enable_youtube_share" value="off">
			<input type="checkbox"  class="green" name="mf_enable_youtube_share" id="mf_enable_youtube_share" @if( $mf_enable_youtube_share == 'on') checked @endif >
			Enable Youtube
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, user can share their project.</span>
			</div>	

			
			
		
			</div>
			</div>


		</fieldset>	














		


		<fieldset>
			<legend>Site Stat - Friend Invitation</legend>


			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Launch Mode
			</label>
			<div class="col-sm-9">
			 {!! Form::select( 'launch_mode' , array('Pre-launch' => 'Pre-launch', 'Launch' => 'Launch' ) , (empty($launch_mode) ? null : $launch_mode) , array('class' => 'form-control') ) !!}
			
			
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			If Pre-launch mode is selected, users/visitors will only be able to subscribe to your site. Only Administrator (that will be you) can access the site (e.g., http://musicfunder.com). (Turn this on, when you want site traffic before launching the site.).
			</span>
			</div>
			
			</div>


			
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Invite Duration
			</label>
			<div class="col-sm-9">
			 {!! Form::select( 'invite_duration' , array('day' => 'Day', 'weekly' => 'Weekly' , 'monthly'=>'Monthly') , (empty($invite_duration) ? null : $invite_duration) , array('class' => 'form-control') ) !!}
			
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Friends invite limit
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="invite_limit" name="invite_limit" placeholder="Enter Invite Limit" value="{{ $invite_limit }}" >
			<span class="help-block"><i class="fa fa-info-circle"></i> users can invite friends within invite limit. Leave blank for unlimited.</span>
			</div>
			</div>
			
			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Cron invite limit
			</label>
			<div class="col-sm-9">			
			<input class="form-control" name="cron_invite_limit" placeholder="Enter Cron Invite Limit" id="cron_invite_limit" value="{{ $cron_invite_limit }}" />
			<span class="help-block"><i class="fa fa-info-circle"></i> subscribed users will be invited via cron in selected duration with above given limit. Leave blank for unlimited.</span>
			</div>
			</div>	


			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Upload Site BackGround Image
			</label>
			
			<div class="col-sm-9">
			<div data-provides="fileupload" class="fileupload fileupload-new">
			<span class="btn btn-file btn-light-grey">
			<i class="fa fa-folder-open-o"></i> <span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
			<input type="file" name="site_background_image">
			</span>
			<span class="fileupload-preview"></span>
			<a style="float: none" data-dismiss="fileupload" class="close fileupload-exists" href="#">
			&times;
			</a>
			</div>
			<p class="help-block">
			(Preferred 950x552)
			</p>
			</div>
			</div>

			
			
					
			
			
			
		</fieldset>	



		

		<fieldset>
			<legend>SMTP Mail Settings</legend>								
			<div class="form-group">
			<label for="form-field-3" class="col-sm-2 control-label">SMTP Host</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="smtp_host" name="smtp_host" placeholder="SMTP Host" value="{{ $smtp_host }}">
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-4" class="col-sm-2 control-label">
			SMTP Port
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="smtp_port" name="smtp_port" placeholder="SMTP Port" value="{{ $smtp_port }}" >
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-5" class="col-sm-2 control-label">
			User Name
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="smtp_account_username" name="smtp_account_username" placeholder="SMTP Port" value="{{ $smtp_account_username }}" >
			</div>
			</div>
			
			
			<div class="form-group">
			<label for="form-field-5" class="col-sm-2 control-label">
			Password
			</label>
			<div class="col-sm-9">
			<input type="password" class="form-control" id="smtp_account_password" name="smtp_account_password" placeholder="SMTP Password" value="{{ $smtp_account_password }}" >
			</div>
			</div>			
			
			<div class="form-group ">
			<label for="form-field-5" class="col-sm-2 control-label">
			From Email Address	
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="from_email_address" name="from_email_address" placeholder="From Email Address" value="{{ $from_email_address }}">
			</div>
			</div>				
		
			
			
		</fieldset>	

		<fieldset>
			<legend>Social Marketing  - Manage & configure settings such as invite, share content etc.</legend>			
			<h3>Invite</h3>

			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Twitter
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="invite_twitter_content" placeholder="Default Text" id="invite_twitter_content" rows="4" required >{{ $invite_twitter_content }}</textarea>
			</div>
			</div>	

			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Facebook
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="invite_fb_content" placeholder="Default Text" id="invite_fb_content" rows="4" required >{{ $invite_fb_content }}</textarea>
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			GooglePlus
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="invite_gplus_content" placeholder="Default Text" id="invite_gplus_content" rows="4" required >{{ $invite_gplus_content }}</textarea>
			</div>
			</div>


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Pinterest
			</label>
			<div class="col-sm-9">
			<textarea type="text" class="form-control" id="invite_pinterest_content" name="invite_pinterest_content" placeholder="Default Text" required >{{ $invite_pinterest_content }}</textarea>			
			</div>
			</div>


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Email
			</label>
			<div class="col-sm-9">			
			<textarea type="text" class="form-control" id="invite_email_content" name="invite_email_content" placeholder="Default Text" required >{{ $invite_email_content }}</textarea>			
			</div>
			
			</div>
			
			<h3>Share</h3>
			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Twitter
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="share_twitter_content" placeholder="Default Text" id="share_twitter_content" rows="4" required>{{ $share_twitter_content }}</textarea>
			</div>
			</div>


			
			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Facebook
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="share_fb_content" placeholder="Default Text" id="share_fb_content" rows="4" required >{{ $share_fb_content }}</textarea>
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			GooglePlus
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="share_gplus_content" placeholder="Default Text" id="share_gplus_content" rows="4" required >{{ $share_gplus_content }}</textarea>
			</div>
			</div>			
			
			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			LinkedIn
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="share_linkedin_content" placeholder="Default Text" id="share_linkedin_content" rows="4" required >{{ $share_linkedin_content }}</textarea>
			</div>
			</div>	


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Pinterest
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="share_pinterest_content" placeholder="Default Text" id="share_pinterest_content" rows="4" required >{{ $share_pinterest_content }}</textarea>
			</div>
			</div>	


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Email
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="share_email_content" placeholder="Default Text" id="share_email_content" rows="4" required >{{ $share_email_content }}</textarea>
			</div>
			</div>


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Whatsapp 
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="share_whatsapp_content" placeholder="Default Text" id="share_whatsapp_content" rows="4" required >{{ $share_whatsapp_content }}</textarea>
			</div>
			</div>	


			
			
			
			
			
		</fieldset>






		

		<fieldset>
			<legend>SEO Settings & Metadata</legend>			


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Site Tracker Code
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="site_tracker_code" placeholder="Default Text" id="site_tracker_code" rows="10">{{ $site_tracker_code }}</textarea>
			<span class="help-block"><i class="fa fa-info-circle"></i>This is the site tracker script used for tracking and analyzing the data on how the people are getting into your website. e.g., Google Analytics. http://www.google.com/analytics</span>
			</div>
			</div>			
			
			
			
			
			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Meta keywords
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="form-field-6" name="seo_meta_keywords" placeholder="Meta keywords" value="{{ $seo_meta_keywords }}">
			<span class="help-block"><i class="fa fa-info-circle"></i> These are the keywords used for improving search engine results of your site. (Comma separated texts for multiple keywords.)</span>
			</div>
			</div>


			<div class="form-group">
			<label for="form-field-7" class="col-sm-2 control-label">
			Description
			</label>
			<div class="col-sm-7">
			<input type="text" class="form-control" id="form-field-7" name="seo_meta_description" placeholder="Meta Description" value="{{ $seo_meta_description }}">
			</div>
			<span class="help-inline col-sm-2"> <i class="fa fa-info-circle"></i> Inline help text </span>
			</div>
		</fieldset>



		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="systems-form">Update</button>							
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
