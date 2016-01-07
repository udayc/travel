<ul class="nav navbar-right">
						<!-- start: TO-DO DROPDOWN -->

						<!-- end: TO-DO DROPDOWN-->
						<!-- start: NOTIFICATION DROPDOWN -->

						<!-- end: NOTIFICATION DROPDOWN -->
						<!-- start: MESSAGE DROPDOWN -->
		 
						<!-- end: MESSAGE DROPDOWN -->
						<!-- start: USER DROPDOWN -->
						<li class="dropdown current-user">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<img src="{{ asset('images/avatar.png') }}" class="circle-img" alt="">
								<span class="username">Admin</span>
								<i class="clip-chevron-down"></i>
							</a>
							<ul class="dropdown-menu"> 
								<li>
									<a href="/auth/logout">
										<i class="clip-exit"></i>
										&nbsp;Log Out
									</a>
								</li>
							</ul>
						</li>
					 
</ul>