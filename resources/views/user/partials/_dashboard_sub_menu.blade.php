<div class="Resgister_Dash_submenu"><ul><li><a href="{{ URL::to('/user/activities/'.$user->id ) }}" {{ Request::is('user/activities') || Request::is('user/activities/*')  ? 'class=actvMenu' : '' }}  >Activities</a></li><li><a href="{{ URL::to('/user/project-posted/' .$user->id) }}" {{ Request::is('user/project-posted') || Request::is('user/project-posted/*')  ? 'class=actvMenu' : '' }} >Project Posted</a></li><li><a href="{{ URL::to('/user/project-backed/' .$user->id) }}" {{ Request::is('user/project-backed') || Request::is('user/project-backed/*')  ? 'class=actvMenu' : '' }} >Projects Backed</a></li><li><a href="{{ URL::to('/user/transactions/' .$user->id) }}" {{ Request::is('user/transactions') || Request::is('user/transactions/*')  ? 'class=actvMenu' : '' }} >Transactions</a></li><li><a href="{{ URL::to('/user/following-projects/' .$user->id) }}" {{ Request::is('user/following-projects') || Request::is('user/following-projects/*')  ? 'class=actvMenu' : '' }} >Following Projects</a></li></ul>		</div>