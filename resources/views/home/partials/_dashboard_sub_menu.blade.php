<div class="Resgister_Dash_submenu"><ul><li><a href="{{ URL::to('/home/dashboard') }}" {{ Request::is('home/dashboard') || Request::is('home/dashboard/*')  ? 'class=actvMenu' : '' }}  >Activities</a></li><li><a href="{{ URL::to('/home/project-posted') }}" {{ Request::is('home/project-posted') || Request::is('home/project-posted/*')  ? 'class=actvMenu' : '' }} >Project Posted</a></li><li><a href="{{ URL::to('/home/project-backed') }}" {{ Request::is('home/project-backed') || Request::is('home/project-backed/*')  ? 'class=actvMenu' : '' }} >Projects Backed</a></li><li><a href="{{ URL::to('/home/transactions') }}" {{ Request::is('home/transactions') || Request::is('home/transactions/*')  ? 'class=actvMenu' : '' }} >Transactions</a></li>            <li><a href="{{ URL::to('/home/profile/' )}}" {{ Request::is('home/profile') || Request::is('home/profile/*')  ? 'class=actvMenu' : '' }}  >My profile</a></li><li class="dropdown" ><a href="{{ URL::to('/home/settings') }}" {{ Request::is('home/settings') || Request::is('home/settings/*')  ? 'class=actvMenu' : '' }}  class="dropdown-toggle"  data-toggle="dropdown">My Settings <span class="caret"></span></a>			<ul class="dropdown-menu">			@if( \Auth::check() )			<li><a href="{{ URL::to('/home/edit/'. \Auth::user()->id )}}">Edit Profile</a></li> 			<li><a href="{{ URL::to('/home/reset/'. Auth::user()->id )}}">Change Password</a></li>			@endif			<li><a href="{{ URL::to('/home/payment-options')}}">Payment options</a></li>			<li><a href="{{ URL::to('/home/my-messages')}}">My Messages</a></li>			<li><a href="{{ URL::to('/home/dashboard')}}">Notifications</a></li>			<li><a href="{{ URL::to('/home/invite-friends')}}">Invite Friends</a></li>			</ul></li><!--<li><a href="{{ URL::to('home/invite-friends' )}}" {{ Request::is('home/invite-friends') || Request::is('home/invite-friends/*')  ? 'class=actvMenu' : '' }}  >Invite Friends</a></li><li class="dropdown" >--><li><a href="{{ URL::to('home/bulk-emails' )}}" {{ Request::is('home/bulk-emails') || Request::is('home/bulk-emails/*')  ? 'class=actvMenu' : '' }}  >Bulk Email</a></li><li><a href="{{ URL::to('home/backer-lists' )}}" {{ Request::is('home/backer-lists') || Request::is('home/backer-lists/*')  ? 'class=actvMenu' : '' }}  >Backer Lists</a></li></ul>		</div>