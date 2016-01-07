@extends('app' )



@section('content')


<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
  
  
  
  
  
  
  
    <div class="row">
	
	
      <div class="col-md-12">
	  
	  
        <h3>Profile / {{ $user->name }}</h3>
        
        <!-- menu open -->
		
        <!-- menu closed --> 
        
        <!-- form part 1 open -->
        <div class="formBox">
		
		@include('user.partials._dashboard_sub_menu')
		@include('user.partials._user_project_stat' ,[ 'authUserStat' => $dashBoardDetailsByAuthUser  ] )







		

<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading"> Profile Of {{ $user->name }}</div>
 
<div class="panel-body"> 
 @include('admin.partials._flashmsg')
 
 
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
			<a href="#">
			{{ $user->email }}
			</a></td>
			<td>&nbsp;</td>
			</tr>
			

			
			<tr>
			<td>remote_addr:</td>
			<td><code>{{ $user->remote_addr }}</code></td>
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
				
		<?php if($userProfile->user_avtar !='') { ?>
		<img src="<?php echo url(); ?>/images/avtar-image/resize/<?php echo $userProfile->user_avtar; ?>" border="0"  width="50" height="50" > 
		<?php }  ?>
		
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
			<a href="#">
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
			<td>
			@if($userProfile->education > 0 ) {{ \App\Models\Education::where('id' , $userProfile->education)->first()->title }} @endif
			
			 </td>
			<td></td>
			</tr>
			<tr>
			<td>Employment Status:</td>
			<td>@if($userProfile->employment_status > 0 ) {{ \App\Models\EmploymentStatus::where('id' , $userProfile->employment_status)->first()->title }} @endif
			
			</td>
			<td></td>
			</tr>

			<tr>
			<td>Income Range:</td>
			<td>@if($userProfile->income_range > 0 ) {{ \App\Models\IncomeRange::where('id' , $userProfile->income_range)->first()->title }} @endif
			
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>Relationship Status:</td>
			<td>@if($userProfile->relationship_status > 0 ) {{ \App\Models\RelationshipStatus::where('id' , $userProfile->relationship_status)->first()->title }} @endif
			  
			 
		
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
			{{ $userProfile->f_name  }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>Last Name:</td>
			<td><a href="#">
			{{ $userProfile->l_name  }}
			</a>
			</td>
			<td></td>
			</tr>
			<tr>
			<td>Gender:</td>
			<td>{{ $userProfile->gender  }}</td>
			<td></td>
			</tr>
			<tr>
			<td>DOB:</td>
			<td>
			{{ $userProfile->dob  }}
			
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>About Me:</td>
			<td>
			{{ $userProfile->about_me  }}
		
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
				{{ $userProfile->first_address  }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>Alternate Address:</td>
			<td>
		
				{{ $userProfile->alternate_address  }}
			</td>
			<td></td>
			</tr>

			<tr>
			<td>City:</td>
			<td>
			{{ $userProfile->cityById($userProfile->city) }}
			
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>State:</td>
			<td>{{ $userProfile->state  }}
			</td>
			<td></td>
			</tr>
			
			<tr>
			<td>Country:</td>
			<td>{{ $userProfile->country_id }}
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
				<td>@if($userProfile->website )
				<a href="{{ $userProfile->website  }}" target="_blank"> {{ $userProfile->website  }}</a>
				@else
				n/a
				@endif			
				</td>
				<td></td>
				</tr> 

				<tr>
				<td>Facebook URL:</td>
				<td>@if($userProfile->facebook_url )
				<a href="{{ $userProfile->facebook_url  }}" target="_blank"> {{ $userProfile->facebook_url  }}</a>
				@else
				n/a
				@endif					
				
				</td>
				<td></td>
				</tr> 

				<tr>
				<td>Twitter URL:</td>
				<td>@if($userProfile->twitter_url )
				<a href="{{ $userProfile->twitter_url  }}" target="_blank"> {{ $userProfile->twitter_url  }}</a>
				@else
				n/a
				@endif				
				
				</td>
				<td></td>
				</tr> 

				<tr>
				<td>LinkedIn URL:</td>
				<td>
				@if($userProfile->linkedIn_url )
				<a href="{{ $userProfile->linkedIn_url  }}" target="_blank"> {{ $userProfile->linkedIn_url  }}</a>
				@else
				n/a
				@endif
				</td>
				<td></td>
				</tr> 				

				<tr>
				<td>GooglePlus URL:</td>
				<td>
				@if($userProfile->googleplus_url)
				<a href="{{ $userProfile->googleplus_url  }}" target="_blank"> {{ $userProfile->googleplus_url  }}</a>
				@else
				n/a
				@endif
				</td>
				<td></td>
				</tr> 

			</tbody>
			</table>


			
			
			


<div>



</div>

</div>
</div>	
 <fieldset><legend>Backed Project History Of {{ $user->name }}</legend>
<div class="row"> <div class="col-sm-12 col-md-12">

			
			@if( count($my_funded_projects)  > 0 )
			<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
			<thead>
			<tr>
			<th>ID</th>
			<th>Project</th>
			<th>Goal Amount($)</th>
			<th>Funded Amount($)</th>
			<th>Paid Amount($)</th>
			<th>Duration(Days)</th>
			<th>End Date</th>
			<th>Reward</th>
			<th>Reward Status</th>
			<th>Live</th>
			</tr>
			</thead>
			<tbody>
	
	
	
		@foreach($my_funded_projects as $val)			
			
			
			<tr>
			<td>{{ $val->id}}</td>
			<td>{{ $val->name }}
				@if( $val->status == 1) </br><span class="label label-inverse"> Suspend</span>@endif
				@if( $val->flag == 1) </br><span class="label label-systemflagged"> Flagged</span> @endif	
			</td>
			<td>{{ $val->funding_goal }}</td>
			<td>{{ $val->_total_pledge_amount}}</td>
			<td>{{ $val->_total_pledge_amount_of_user }}</td>
			<td>{{ $val->project_duration}}</td>
			<td>{{ date( "M d, Y" , $val->project_end_date ) }}</td>
			<td>n/a</td>
			<td>n/a</td>
			<td>
			
					@if($val->live == 1 )
					<a class="label label-sm label-success" >Yes</a>
					@else
					<a class="label label-sm label-danger" >No</a>
					@endif			
			
			</td>
			</tr>
			
	@endforeach			
			
			
			</tbody>
			</table>
			
@endif



</div></div>
 
 </fieldset>
 
 
 
 
  
</div>

</div>
</div>					
</div>				

 </div>

		
</div>
</div>

  </div>
</div>
<!-- inner page area closed --> 



@stop

@section('styles')

	<link rel="stylesheet" href="/plugins/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">



	<link rel="stylesheet" type="text/css" href="/plugins/select2/select2.css" />
	<link rel="stylesheet" href="/plugins/DataTables/media/css/DT_bootstrap.css" />

	<link rel="stylesheet" href="/plugins/ladda-bootstrap/dist/ladda-themeless.min.css">
	<link rel="stylesheet" href="/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css">
	<link rel="stylesheet" href="/plugins/bootstrap-social-buttons/social-buttons-3.css">




		
@endsection




@section('scripts')


		<script src="/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="/plugins/less/less-1.5.0.min.js"></script>
		<script src="/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="/js/main.js"></script>



		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->


		<script src="/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
		<script src="/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
		<script src="/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
		<script src="/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>		

		<script src="/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>	
		<script src="/plugins/bootstrap-daterangepicker/moment.min.js"></script>  
		<script src="/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>	
		<script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="/plugins/bootstrap-colorpicker/js/commits.js"></script>
		<script src="/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>		
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

		<!-- start: FORM VALIDATION CODE START -->
		<script src="/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="/plugins/summernote/build/summernote.min.js"></script>
		<script src="/plugins/ckeditor/ckeditor.js"></script>
		<script src="/plugins/ckeditor/adapters/jquery.js"></script>
		<script src="/js/form-validation.js"></script>
		<!-- end: FORM VALIDATION CODE START -->

		<script src="/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="/plugins/autosize/jquery.autosize.min.js"></script>
		<script src="/plugins/select2/select2.min.js"></script>
		<script src="/js/form-elements.js"></script>

		<script src="/js/frontend/mfunder.ui.app.js"></script>

	 
		<script>
		jQuery(document).ready(function() {
					Main.init(); 
					FormValidator.init();
					FormElements.init();
					myApp.ajaxCountryCityListHandler();
		});
		</script>

@stop
