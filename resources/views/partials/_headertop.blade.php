      <!-- logo open -->
      <div class="col-md-5 col-sm-6 col-xs-12">
        <h1 class="logo"><a href="/" title=""><img src="/images/frontend/logo.png" alt="" border="0"></a></h1>
      </div>
      <!-- logo closed --> 
      
      <!-- top links open -->
      <div class="col-md-7 col-sm-6 col-xs-12"> <a class="btn btn-warning header_button" href="/project/startaproject/" >Start a Project</a>
        <div class="log_link">
          <ul>@if (Auth::guest())
            <li><a href="#myModal" data-toggle="modal" data-target="#myModal" >Login</a></li>
            <li><a href="#myModal" data-toggle="modal" data-target="#myModal">Sign up</a></li>
			@else
						@if(Session::has('logoutUrl'))
							<li> <a href="/home/dashboard">{{ Auth::user()->name }}</a> <a href="{{ Session::get('logoutUrl') }}">( Logout )</a></li>
						@else
						<li><a href="/home/dashboard">{{ Auth::user()->name }}</a> <a href="/auth/logout">( Logout ) </a></li>
						@endif
			
			@endif
          </ul>
        </div>
      </div>

	  
