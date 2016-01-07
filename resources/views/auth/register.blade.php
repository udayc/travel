@extends('app')

@section('content')
<!-- inner page area start -->
<div class="innrPgArea signup">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        
        <!-- form box open -->
        <div class="formBox">
          <h3>Quick Sign Up</h3>
         
         <div class="social_button_area wow fadeInLeft">
              	<ul>
				<!--
                	<li><a href="#"><img src="/images/frontend/sign-in-with-fb.png" alt="" border="0"></a></li>
                    <li>or</li>
                    <li><a href="#"><img src="/images/frontend/sign-in-with-twitter.png" alt="" border="0"></a></li>
                    <li>or</li>
                    <li><a href="#"><img src="/images/frontend/sign-in-with-google.png" alt="" border="0"></a></li>
				-->	
		@if( $_settings_data->using_facebook_login == 'on' )<li><a href="{{ $login_url}}"><img src="/images/frontend/sign-in-with-fb.png"></a></li> @endif
		@if( $_settings_data->using_twitter_login == 'on' )<li><a href="#"><img src="/images/frontend/sign-in-with-twitter.png"></a></li>@endif
		@if( $_settings_data->using_googleplus_login == 'on' )<li><a href="#"><img src="/images/frontend/sign-in-with-google.png"></a></li>@endif					
					
					
                </ul>
              </div>
              
              <p class=" wow fadeInRight">Sign up with a social network to follow your friends By signing up you agree to the <a href="">Terms & Conditions</a> . 
			  If you don't want to sign up with a social network, please register by manual. Already have an account? <a href="/auth/login" >Login<a/></p>
          
        </div>
        <!-- form box closed --> 
	<div class="formBox">
  
@if (count($errors) > 0)
        <div class="row">
        <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.<br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        </div>  
@endif

<h3>Registration</h3>
			
		<form class="form-horizontal" role="form" method="POST" action="/auth/register">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>First Name</span><span class="star">*</span></label>
             <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter your First Name" required >
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Last Name</span><span class="star">*</span></label>
              <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your Last Name" required>
            </div>
          </div>			
			
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 formFldArea">
              <label><span>Email</span><span class="star">*</span></label>
              <input name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your Email" required>
            </div>

          </div>			
			
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Password</span><span class="star">*</span></label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Confirm Password</span><span class="star">*</span></label>
              <input type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm password" required  oninput="passwordcheck(this)" >
            </div>
          </div>			


		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
			<button type="submit" class="SmallButton">
			Register
			</button>
			</div>
		</div>
			
		</form>
		
		</div>
 
 
 
 
 
        
         </div>
    </div>
	
	
  </div>
</div>
<!-- inner page area closed --> 
@endsection
