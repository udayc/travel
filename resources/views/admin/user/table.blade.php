		@if( $result_count > 0 )
	
		@foreach ($users as $user)									
		<tr >
		<td class="center"><input type="checkbox" class="ulistcheckbox" name="ulist" value="{{ $user->id }}"></td>
		<td class="span4 dl"><?php if($user->register_type == 'facebook' ) { ?><i class="fa fa-facebook-square"></i><?php } if($user->register_type == 'twitter' ) { ?><i class="fa fa-tumblr-square"></i><?php } ?> <a href="/admin/user/show/{{ $user->id }}">{{ $user->name}}</a></td>
		<td class="dc"><a  data-toggle="modal" id="modal_ajax_demo_btn" class="users_project_count" role="project-count" tabindex="-1" href="javascript:void(0)" data-value="{{ $user->id }}"  data-token="{{ csrf_token() }}" data-id="{{ $user->id }}" >{{ $user->project->count() }}</a></td>
		<td class="dr">{{ $user->project->sum('funding_goal') }}  </td>
		<td class="dc"><a  data-toggle="modal" id="modal_ajax_demo_btn" class="project_funded_count" role="project_funded_count" tabindex="-1" href="javascript:void(0)" data-value="{{ $user->id }}"  data-token="{{ csrf_token() }}" data-id="{{ $user->id }}" >{{ $user->projectfund->where('status' , 'Pledged')->count() }}</a></td>
		<td class="dr">{{ $user->projectfund->where('status' , 'Pledged')->sum('paid_amount') }} </td>
		<td class="dr">{{ $user->projectfund->where('status' , 'Pledged')->sum('site_commission') }}</td>
		<!-- <td class="dr"><span title="Zero Dollars" class="c cr">0.00</span> AA</td>	-->
		<td class="dc center"><a  data-toggle="modal" id="modal_ajax_demo_btn" class="users_login_count" role="user-login-count" tabindex="-1" href="javascript:void(0)" data-value="{{ $user->id }}"  data-token="{{ csrf_token() }}" data-id="{{ $user->id }}" >{{ $user->login_count}}</a></td>
		<td class="dc center">	{{ (  $user->last_login != '0000-00-00 00:00:00') ? $user->last_login : '-'}}</td>
		<td class="dl">{{ $user->login_from_ip}}</td>

		 <td class="dc center">
		 @if( $user->project->where('live' , 1 )->count() > 0 ) 
		 <span class="label label-live"> Yes</span> 
		 @else 
		  No 
		 @endif</td>  

		<td class="dc">{{ $user->created_at->format('M d, Y')}}</td>  
		<td class="dl">{{ $user->remote_addr}}	</td>
		<td class="dl"><?php if( $user->status == 1 ) { ?><a class="label label-sm label-success toggle-status" href="javascript:void(0);" data-user="<?php echo $user->id; ?>" data-status="0" id="activespn_<?php echo $user->id; ?>"  data-url="/admin/user/">Active</a><a class="label label-sm label-danger toggle-status" href="javascript:void(0);" data-user="<?php echo $user->id; ?>" data-status="1" id="inactivespn_<?php echo $user->id; ?>" style="display:none;"  data-url="/admin/user/" >Inactive</a><?php } else { ?><a class="label label-sm label-danger toggle-status"  href="javascript:void(0);" data-user="<?php echo $user->id; ?>" data-status="1" data-url="/admin/user/"  id="inactivespn_<?php echo $user->id; ?>"   >Inactive</a><a class="label label-sm label-success toggle-status" href="javascript:void(0);" data-user="<?php echo $user->id; ?>" data-status="0" id="activespn_<?php echo $user->id; ?>"  style="display:none;"  data-url="/admin/user/" >Active</a><?php } ?></td>
		<td class="span1 dc">


 
		<div class="btn-group"  id="showactive_<?php echo $user->id; ?>"    >
			<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
			<i class="fa fa-cog"></i> <span class="caret"></span>
			</a>
			<ul role="menu" class="dropdown-menu pull-right">

			<li role="presentation">
			<a role="menuitem" tabindex="-1" href="/admin/user/show/{{ $user->id }}">
			<i class="fa fa-share"></i> View
			</a>
			</li>
			<li role="presentation">
			<a role="menuitem" tabindex="-1" href="/admin/user/edit/{{ $user->id }}">
			<i class="fa fa-edit"></i> Edit
			</a>
			</li>															
			<li role="presentation">
			<a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $user->id }}"  data-token="{{ csrf_token() }}" data-url="/admin/user" ><i class="fa fa-times"></i> Remove</a>
			</li>
			</ul>
		</div>
 

		</td>		
		
		
		
		
		
	</tr>
	@endforeach	

		@else
		<tr><td colspan="14">No result found !</td></tr>
		@endif