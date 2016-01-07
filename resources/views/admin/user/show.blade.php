@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER --> 
@include('admin.project.partials._pageheaderother' , ['settings_form' => 'User Details'  ]) 
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->




<div class="row">
<div class="col-sm-6 col-md-6">

<div class="user-left">
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Basic Details</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>Name:</td>
			<td>
			<a href="#">
			{{ $user->name }}
			</a></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Email-Id:</td>
			<td>
			<a href="">
			{{ $user->email }}
			</a></td>
			<td>&nbsp;</td>
			</tr>
			
			<tr>
			<td>UserName:</td>
			<td>{{ $user->username }}</td>
			<td>&nbsp;</td>
			</tr>
			
			<tr>
			<td>remote_addr:</td>
			<td>{{ $user->remote_addr }}</td>
			<td>&nbsp;</td>
			</tr>			
			
			
			<tr>
			<td>Status:</td>
			<td>
				@if( $user->status == 0)		
				<span class="label label-sm label-danger">Inactive</span>
				@else
				<span class="label label-sm label-success">Active</span>
				@endif	
			</td>
			<td>&nbsp;</td>
			</tr>			
			
			
			
			<tr>
			<td valign="top">Type</td>
			<td>
			<p>
			{{ $user->type }}
			</p></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Attached Image</td>
			<td>
		
			<img src="/images/avtar-image/resize/{{ $profile->user_avtar}} " width="50" height="50"/>
			</td>
			<td>&nbsp;</td>
			</tr>			
			</tbody>
			</table>
			
			
			
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Additional Related Information</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>Total Project Amount($):</td>
			<td>
			<a href="#">
			${{ $user->project->sum('funding_goal') }}
			</a></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Total Funded Amount($):</td>
			<td>
			<a href="">
			${{ $user->projectfund->where('status' , 'Pledged')->sum('paid_amount') }}
			</a></td>
			<td>&nbsp;</td>
			</tr>
			
			<tr>
			<td>Total Login Count:</td>
			<td>{{ $user->login_count}}</td>
			<td>&nbsp;</td>
			</tr>
			
			<tr>
			<td>Last Login IP:</td>
			<td>{{ $user->login_from_ip}}</td>
			<td>&nbsp;</td>
			</tr>			
			
			
			<tr>
			<td>User Created On:</td>
			<td>{{ $user->created_at->format('M d, Y')}}</td>
			<td>&nbsp;</td>
			</tr>			
		
			</tbody>
			</table>	



			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Demographics</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>Education:</td>
			<td> <?php echo geteducation($profile->education); ?> 
			 </td>
			<td></td>
			</tr>
			<tr>
			<td>Employment Status:</td>
			<td><?php echo getemp($profile->employment_status); ?>  
			</td>
			<td></td>
			</tr>

			<tr>
			<td>Income Range:</td>
			<td><?php echo getincome($profile->income_range); ?>   
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>Relationship Status:</td>
			<td>
			<?php echo getrelation($profile->relationship_status); ?>   
			 
		
			</td>
			<td></td>
			</tr>			
			</tbody>
			</table>		
	

</div>


</div>

<div class="col-sm-6 col-md-6">


				
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Profile Details</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>First Name:</td>
			<td>
			<a href="#">
			{{ $profile->f_name  }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>Last Name:</td>
			<td>
			{{ $profile->l_name  }}
			
			</td>
			<td></td>
			</tr>
			<tr>
			<td>Gender:</td>
			<td>{{ $profile->gender  }}</td>
			<td></td>
			</tr>
			<tr>
			<td>DOB:</td>
			<td>
			{{ $profile->dob  }}
			
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>About Me:</td>
			<td>
			{{ $profile->about_me  }}
		
			</td>
			<td></td>
			</tr>			
			</tbody>
			</table>		

			
				
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Address Details</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>Primary Address:</td>
			<td>
			<a href="#">
			{{ $profile->first_address  }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>Alternate Address:</td>
			<td>
			{{ $profile->alternate_address  }}
			
			</td>
			<td></td>
			</tr>
			<tr>
			<td>Contact_no:</td>
			<td>{{ $profile->contact_no  }}</td>
			<td></td>
			</tr>
			<tr>
			<td>City:</td>
			<td>
			{{ $profile->cityById($profile->city) }}
			
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>State:</td>
			<td>{{ $profile->state  }}
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>Country:</td>
			<td>{{ $profile->country_id }}
			</td>
			<td></td>
			</tr>
			
			</tbody>
			</table>			
			
			 

		 
			
			<table class="table table-condensed table-hover">
				<thead>
				<tr>
					<th colspan="3">Website</th>
				</tr>
				</thead>
			<tbody>
				<tr>
				<td>Website:</td>
				<td><a href="{{ $profile->website  }}" target="_blank"> {{ $profile->website  }}</a></td>
				<td></td>
				</tr> 

				<tr>
				<td>Facebook URL:</td>
				<td><a href="{{ $profile->facebook_url  }}" target="_blank"> {{ $profile->facebook_url  }}</a></td>
				<td></td>
				</tr> 

				<tr>
				<td>Twitter URL:</td>
				<td><a href="{{ $profile->twitter_url  }}" target="_blank"> {{ $profile->twitter_url  }}</a></td>
				<td></td>
				</tr> 

				<tr>
				<td>LinkedIn URL:</td>
				<td><a href="{{ $profile->linkedIn_url  }}" target="_blank"> {{ $profile->linkedIn_url  }}</a></td>
				<td></td>
				</tr> 				

				<tr>
				<td>GooglePlus URL:</td>
				<td><a href="{{ $profile->googleplus_url  }}" target="_blank"> {{ $profile->googleplus_url  }}</a></td>
				<td></td>
				</tr> 

			</tbody>
			</table>




<div>



</div>

</div>
</div>	


	<fieldset>
	<legend>&nbsp;</legend>
	<div class="row">
		<div class="col-sm-12">										
		<a href="/admin/user" class="btn btn-orange" name="submit" value="add-user-form">Back</a>							
		</div>
	</div>
	<div class="row"><div class="col-sm-2 col-sm-offset-2">&nbsp;</div>	</div>
		
	</fieldset> 
<!-- end: PAGE CONTENT-->
</div>
<?php
function geteducation($id)
{
$output = '';
	if($id==2)
	{
		$output="High school graduate or equivalent";
	}
	elseif($id==3)
	{
		$output="Trade or vocational degree";
	} 
	elseif($id==5)
	{
		$output="Associate degree";
	}	
	elseif($id==6)
	{
		$output="Bachelor's degree";
	}
	elseif($id==7)
	{
		$output="Graduate or professional degree";
	}
	elseif($id==8)
	{
		$output="Prefer not to share";
	}
	elseif($id==9)
	{
		$output="Class 12";
	}
	elseif($id==10)
	{
		$output="Class 10";
	}			
	return $output;
}

function getemp($id)
{
$output = '';
	if($id==1)
	{
		$output="Employed full time";
	}
	elseif($id==2)
	{
		$output="Not employed but looking for work";
	} 
	elseif($id==3)
	{
		$output="Not employed and not looking for work";
	}	
	elseif($id==4)
	{
		$output="Retired";
	}
	elseif($id==5)
	{
		$output="Student";
	}
	elseif($id==6)
	{
		$output="Homemaker";
	}
	elseif($id==7)
	{
		$output="Prefer not to share";
	} 		
	return $output;
}


function getincome($id)
{
	$output = '';
	if($id==1)
	{
		$output="Under 20,000";
	}
	elseif($id==2)
	{
		$output="20,000 - 29,000";
	} 
	elseif($id==3)
	{
		$output="30,000 - 39,999";
	}	
	elseif($id==4)
	{
		$output="40,000 - 49,999";
	}
	elseif($id==5)
	{
		$output="50,000 - 69,999";
	}
	elseif($id==6)
	{
		$output="70,000 - 99,999";
	}
	elseif($id==7)
	{
		$output="100,000 - 149,000";
	} 	
	elseif($id==8)
	{
		$output="150,000 or more";
	} 
	elseif($id==9)
	{
		$output="Prefer not to share";
	} 			
	return $output;
}

function getrelation($id)
{
$output = '';
	if($id==1)
	{
		$output="Single, not married";
	}
	elseif($id==2)
	{
		$output="Married";
	} 
	elseif($id==3)
	{
		$output="Living with partner";
	}	
	elseif($id==4)
	{
		$output="Separated";
	}
	elseif($id==5)
	{
		$output="Divorced";
	}
	elseif($id==6)
	{
		$output="Widowed";
	}
	elseif($id==7)
	{
		$output="Prefer not to share";
	} 		
	return $output;
}
?>
@stop

@include('admin.project.partials._relatedfiles')