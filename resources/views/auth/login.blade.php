@extends('app')

@section('content')

<!-- inner page area start -->
<div class="innrPgArea login">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        
        <!-- form box open -->
        <div class="formBox">
          <h3>Login</h3>
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
		  
		  
		  
		  
          <div class="row">
          <!-- left part open-->
            <div class="col-md-8 col-sm-6 col-xs-12 loginColumn">
              <div class="social_login_area">
              	<ul>
				<!--
                	<li><a href="{{ $login_url}}"><img src="/images/frontend/sign-in-with-fb.png"></a></li>
                    <li><span>or</span></li>
                    <li><a href="#"><img src="/images/frontend/sign-in-with-twitter.png"></a></li>
                    <li class="bigOR"><span>or</span></li>
                    <li><a href="#"><img src="/images/frontend/sign-in-with-google.png"></a></li>
				-->	
		@if( $_settings_data->using_facebook_login == 'on' )<li><a href="{{ $login_url}}"><img src="/images/frontend/sign-in-with-fb.png"></a></li> @endif
		@if( $_settings_data->using_twitter_login == 'on' )<li><a href="{!!URL::to('twitter')!!}"><img src="/images/frontend/sign-in-with-twitter.png"></a></li>@endif
		@if( $_settings_data->using_googleplus_login == 'on' )<li><a href="{!!URL::to('google')!!}"><img src="/images/frontend/sign-in-with-google.png"></a></li>@endif				
					
					
					
					
					
					
					
                </ul>
              </div>
            </div>
            <!-- left part closed -->
            
            <!-- right part open -->
		<form class="form-horizontal" role="form" method="POST" action="/auth/login">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">			
			
            <div class="col-md-4 col-sm-6 col-xs-12 loginColumn">
               <div class="userLoginBx">
               	<h4>user login</h4>

                <div class="userLoginBxFldArea">
                <label>E-Mail Address</label><input type="email" class="form-control" name="email" value="{{ old('email') }}" required >
                </div>
                <div class="userLoginBxFldArea">
                <label>Password</label><input type="password" class="form-control" name="password" required>
                </div>
                <p class="logRemmbr"><input type="checkbox" name="remember"><span>Remember me on this computer.</span></p>
                <p> <a href="/user/forgotpassword">Forgot your password?</a> | <a href="/auth/register">Sign Up</a> </p>
                <input name="" type="submit" class="SmallButton pull-right" value="login">
                
               </div>
            </div>
            <!-- right closed -->
            </form>
          </div>
          
          
        </div>
        <!-- form box closed --> 
 
        
         </div>
    </div>
  </div>
</div>
<!-- inner page area closed -->










@endsection
