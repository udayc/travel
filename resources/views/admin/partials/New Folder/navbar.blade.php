<ul class="nav navbar-nav">
		<li {{ Request::is('admin/dashboard') ? 'class=active' : '' }}>
			<a href="/admin/dashboard">
				<i class="clip-home-3"></i> Dashboard
			</a>
		</li>


		<li  {{ Request::is('admin/user') || Request::is('admin/user/*')  ? 'class=active' : '' }}  >
			<a href="javascript:void(0)" class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">
				<i class="fa fa-user"></i>Users <i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="/admin/user">Users</a></li>
				<li><a href="/admin/user/send-msg">Send Email to Users</a>
				</li>
			</ul>								
		</li>

		
		<li {{ Request::is('admin/project') || Request::is('admin/project/*')  ? 'class=active' : '' }} ><a href="/admin/project">	<i class="fa fa-file-o"></i> Projects</a></li>


		<li><a href="" class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" ><i class="fa fa-dollar"></i>	Payments <i class="fa fa-angle-down"></i></a>
				<ul class="dropdown-menu">
				<li><a href="{{ URL::to('admin/payments/transactions')}}">Transactions</a></li>
				<li><a href="{{ URL::to('admin/payments/project-funded')}}">Project Funded</a></li>	
				<li><a href="{{ URL::to('admin/payments/cash-withdrawal')}}">User Cash Withdrawals</a></li>					
				</ul>			
		
		</li>
		<li><a href="" class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" >
		Activities	<i class="fa fa-angle-down"></i>
		</a>
			<ul class="dropdown-menu">
				<li><a href="{{ URL::to('admin/activity/project-views')}}">Project Views</a></li>
				<li><a href="{{ URL::to('admin/activity/project-flags')}}">Project Flags</a></li>												
				<li><a href="{{ URL::to('admin/activity/project-followers')}}">Project Followers</a></li>
				<li><a href="#">Project Updates</a></li>
				<li><a href="{{ URL::to('admin/activity/project-comments')}}">Project Comments</a></li>				
				<li><a href="{{ URL::to('admin/activity/user-logins')}}">Users login</a></li>
				<li><a href="#">User enquiries</a></li>			
				<li><a href="{{ URL::to('admin/activity/site-activities')}}">Site Activities</a></li>
			</ul>		
		
		
		
		
		
		
		
		</li>
		<li  {{ Request::is('admin/settings/*') ? 'class=active' : '' }} >
			<a href="{{URL::to('/admin/settings/systems') }}" class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">
				<i class="clip-settings"></i> Settings <i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="/admin/settings/systems">Systems</a></li>												
				<li><a href="/admin/settings/regional-currency-language">Regional , Currency & Language</a></li>
				<li><a href="/admin/settings/account">Account</a></li>
				<li><a href="/admin/settings/project">Project</a></li>
				<li><a href="/admin/settings/project-owner">Project Owner</a></li>
				<li><a href="/admin/settings/backer">Backer</a></li>
				<li><a href="/admin/settings/revenue">Revenue</a></li>
				<li><a href="/admin/settings/suspicious-words-detector">Suspicious Words Detector </a></li>
				<li><a href="/admin/settings/withdrawals">Withdrawals</a></li>
				<li><a href="/admin/settings/third-party-api">ThirdParty API</a></li>
			</ul>
		</li>
		
		
		<li  {{ Request::is('admin/category') || Request::is('admin/category/*') || Request::is('admin/genre') || Request::is('admin/genre/*')   ? 'class=active' : '' }}  >
			<a href="" class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">
				Masters <i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="javascript:void(0)">
						User Profile
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						<span class="title">Invoice</span>
						<span class="badge badge-new">new</span>
					</a>
				</li>								
				<li>
					<a href="javascript:void(0)">
						Gallery
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						Timeline
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						FAQs
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						Messages
					</a>
				</li>

				<li>
					<a href="{!! url('admin/category') !!}">
						Music Category
					</a>
				</li>

				<li>
					<a href="{!! url('admin/genre') !!}">
						Music Genre
					</a>
				</li>				

			</ul>
		</li>	


		<li  {{ Request::is('admin/menu') || Request::is('admin/menu/*') || Request::is('admin/banner') || Request::is('admin/banner/*')   ? 'class=active' : '' }}  >
		<a href="" class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown">
			Site Management <i class="fa fa-angle-down"></i>
		</a>
		<ul class="dropdown-menu"> 
			<li><a href="{!! url('admin/menu') !!}"> Menu </a></li>
			<li><a href="{!! url('admin/banner') !!}">Banner</a></li>	
			<li><a href="{!! url('admin/pages') !!}">Pages</a></li>				

		</ul>
		</li>		
		
</ul>
