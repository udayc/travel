<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg forms">

	<div class="modal-content modalgraypart">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="">
		<div class="col-sm-12 formareas">

		<div class="col-sm-6 col-xs-12 loginColumn">
		<form class="form-horizontal" role="form" method="POST" action="/auth/login">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">		
		<div class="userLoginBx">
		<h4>user login <span>New User? Sign Up</span></h4>
		<div class="userLoginBxFldArea">
		<label>E-Mail Address</label><input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email-id" required >
		</div>
		<div class="userLoginBxFldArea">
		<label>Password</label><input type="password" class="form-control" name="password" placeholder="Enter password" required>
		</div>
		<p><input name="" type="submit" class="SmallButton" value="login">  <a href="/user/forgotpassword">Forgot your password?</a></p>
		</div>
		</form>		
		<div class="col-sm-12 marg"><img src="/images/frontend/or.png"/></div>
		<div class="social_login_area">
		<ul>
		@if( $_settings_data->using_facebook_login == 'on' )<li><a href="{{ $login_url}}"><img src="/images/frontend/sign-in-with-fb.png"></a></li> @endif
		@if( $_settings_data->using_twitter_login == 'on' )<li><a href="{!!URL::to('twitter')!!}"><img src="/images/frontend/sign-in-with-twitter.png"></a></li>@endif
		@if( $_settings_data->using_googleplus_login == 'on' )<li><a href="{!!URL::to('google')!!}"><img src="/images/frontend/sign-in-with-google.png"></a></li>@endif
		</ul>
		</div>
		</div>
			
		<div class="col-md-6">
		<form class="form-horizontal" name="auth-register-form" role="form" method="POST" action="/auth/register">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="userLoginBx">
		<h4>Sign Up <span>Already Registered? Log In</span></h4>
  
		<div class="userLoginBxFldArea">
		<label><span>First Name</span><span class="star">*</span></label>
		<input name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Enter your First Name" required>
		</div>

		<div class="userLoginBxFldArea">
		<label><span>Last Name</span><span class="star">*</span></label>
		<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" value="{{ old('last_name') }}" placeholder="Enter your Last Name" required >
		</div>




		<div class="userLoginBxFldArea">
		<label><span>Email</span><span class="star">*</span></label>
		<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email-id" required>
		</div>

		<div class="userLoginBxFldArea">
		<label>Password<span class="star">*</span></label>
		<div class="col-xs-12 col-md-6 pass">             
		<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>				
		</div>
		<div class="col-xs-12 col-md-6 pass">
		<input type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm password" required oninput="passwordcheck(this)">
		</div>
		</div>
		
		<input name="register" type="submit" class="SmallButton found" value="Sign Up With Music Founderds">
		<div class="col-sm-12 marg"><img src="/images/frontend/or.png"></div>
		<div class="social_login_area">
		<ul>
		@if( $_settings_data->using_facebook_login == 'on' )<li><a href="{{ $login_url}}"><img src="/images/frontend/sign-in-with-fb.png"></a></li> @endif
		@if( $_settings_data->using_twitter_login == 'on' )<li><a href="{!!URL::to('twitter')!!}"><img src="/images/frontend/sign-in-with-twitter.png"></a></li>@endif
		@if( $_settings_data->using_googleplus_login == 'on' )<li><a href="{!!URL::to('google')!!}"><img src="/images/frontend/sign-in-with-google.png"></a></li>@endif
		
		
		</ul>
		</div>

		</div>
		</form>

		</div>
	</div>

      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>	 


