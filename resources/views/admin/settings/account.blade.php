@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => 'Account'  ])
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
<form class="form-horizontal" role="form" name="account-form" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="using_facebook_login" value="0">
<input type="hidden" name="using_twitter_login" value="0">
<input type="hidden" name="using_googleplus_login" value="0">
<input type="hidden" name="captcha_fp" value="0">
<input type="hidden" name="notify_admin_on_registration" value="0">
<input type="hidden" name="welcome_email_on_registration" value="0">
<input type="hidden" name="email_verification_after_registration" value="0">

		<fieldset>
			<legend>Logins</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Login Handle
			</label>
			<div class="col-sm-9">
			<select name="login_handler" id="login_handler" class="form-control">			
			<option value="email-id" selected>Email-ID</option>
			</select>				
			<span class="help-block"><i class="fa fa-info-circle"></i> This is default login handler</span>
			
			<div class="checkbox">
			<label>
			<input type="checkbox"  class="green" name="using_facebook_login" id="using_facebook_login" @if( $using_facebook_login == 'on') checked @endif >
			Enable Facebook
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, users can authenticate their account using Facebook.</span>
			</div>
			<div class="checkbox">
			<label>
			<input type="checkbox"   class="green" name="using_twitter_login" id="using_twitter_login" @if( $using_twitter_login == 'on') checked @endif>
			Enable Twitter
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, users can authenticate their account using Twitter.</span>			
			</div>			
			<div class="checkbox">
			<label>
			<input type="checkbox"  class="green" name="using_googleplus_login" id="using_googleplus_login" @if( $using_googleplus_login == 'on') checked @endif>
			Enable Google+
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, users can authenticate their account using Google+.</span>			
			</div>				
			
			
			</div>
			</div>


			
		</fieldset>									

		<fieldset>
			<legend>Account Settings </legend>
			
			<div class="form-group">
			<label for="form-field-3" class="col-sm-2 control-label"></label>
			<div class="col-sm-9">
			
			<div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="captcha_fp" id="captcha_fp" @if( $captcha_fp == 'on' ) checked @endif>
			Enable Captcha when Forgot Password
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			Here you can enable captcha when user request for forgot password</span>
			</div>
			<div class="checkbox">
			<label>
			<input type="checkbox"  class="green" name="notify_admin_on_registration" id="notify_admin_on_registration" @if( $notify_admin_on_registration == 'on') checked @endif>
			Enable Notify Administrator on Each Registration
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this feature, notification mail will be sent to administrator on each registration.</span>			
			</div>			
			<div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="welcome_email_on_registration" id="welcome_email_on_registration" @if( $welcome_email_on_registration == 'on') checked @endif>
			Enable Sending Welcome Mail After Registration
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this feature, users will receive a welcome mail after registration.</span>			
			</div>				
			
			<div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="email_verification_after_registration" id="email_verification_after_registration" 
			@if( $email_verification_after_registration == 'on') checked @endif />
			Enable Email Verification After Registration
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this feature, the users are required to verify their email address which will be provided by them during registration. (Users cannot login until the email address is verified)</span>			
			</div>


			<div class="checkbox">
			<label><input type="hidden" name="admin_approval_after_registration" value="0">
			<input type="checkbox" class="green" name="admin_approval_after_registration" id="admin_approval_after_registration" 
			@if( $admin_approval_after_registration == 'on') checked @endif />
			Enable Administrator Approval After Registration
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
		On enabling this feature, the user will not be able to login until the Admin (that will be you) approves their registration..</span>			
			</div>	




			
			
			
			
			</div>
			</div>



			
		
			
			
		</fieldset>		





		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="account-form">Update</button>							
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