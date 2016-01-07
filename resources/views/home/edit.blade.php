@extends('app' )



@section('content')


<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
  
  
  
  
  
  
  
    <div class="row">
	
	
      <div class="col-md-12">
	  
	  
        <h3>Dashboard / Update Profile</h3>
        
        <!-- menu open -->
		@include('home.partials._dashboard_top_menu')
        <!-- menu closed --> 
        
        <!-- form part 1 open -->
        <div class="formBox">
		
		@include('home.partials._dashboard_sub_menu')
		@include('home.partials._user_project_stat' ,[ 'authUserStat' => $dashBoardDetailsByAuthUser  ] )	

<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading">Update User Profile </div>
 
<div class="panel-body"> 
 @include('admin.partials._flashmsg')


{!! Form::open(array('url' =>  ['home/update', $userProfile->user_id], 'files' => true , 'id'=>'profile-form' , 'class' => 'form-horizontal', 'role'=>'form', 'method' => 'put')) !!}
{!! Form::hidden('id', $userProfile->user_id) !!}


<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
		<fieldset>
			<legend>Personal Information</legend>	
			
			<div class="form-group @if ($errors->has('f_name')) has-error @endif">
			<label for="f_name" class="col-sm-2 control-label">
			First Name
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="f_name" placeholder="Enter first name" name="f_name" value="{{ $userProfile->f_name }}" required >
			</div>
			</div>
			
			<div class="form-group @if ($errors->has('l_name')) has-error @endif">
			<label for="l_name" class="col-sm-2 control-label">
			Last Name
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="l_name" placeholder="Enter last name" name="l_name" value="{{ $userProfile->l_name }}" required >
			</div>
			</div>

			<div class="form-group @if ($errors->has('gender')) has-error @endif">
			<label for="gender" class="col-sm-2 control-label">
			Gender
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			{!! Form::select('gender', ['male'=>'Male', 'female'=>'Female'], (empty($userProfile) ? null : $userProfile->gender) , array('class' => 'form-control' , 'required' => 'required'))  !!}
		
			</div>
			</div>
			
			
			<div class="form-group @if ($errors->has('dob')) has-error @endif">
			<label for="dob" class="col-sm-2 control-label">
			DOB
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9"><div class="input-group">
			<input type="text" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" name="dob" id="dob" value="{{ ( $userProfile->dob !='0000-00-00' )  ? $userProfile->dob : date('Y-m-d')  }}" required >
			<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>	</div>	
			</div>
			</div>


			<div class="form-group @if ($errors->has('about_me')) has-error @endif">
			<label for="form-field-2" class="col-sm-2 control-label">
			 About me
			 <span class="symbol required"></span>
			</label>
			<div class="col-sm-9">			
					<textarea class="form-control" name="about_me" placeholder="Default Text" id="about_me" required >{{ $userProfile->about_me }}</textarea>										
			</div>
			</div>			
	
		</fieldset>	

		
		<fieldset>
			<legend>Address Details</legend>	
			
			<div class="form-group @if ($errors->has('first_address')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Address
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="first_address" placeholder="Enter your address" name="first_address" value="{{ $userProfile->first_address }}" required >
			</div>
			</div>
			
			<div class="form-group @if ($errors->has('alternate_address')) has-error @endif">
			<label for="alternate_address" class="col-sm-2 control-label">
			Alternate Address
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="alternate_address" placeholder="Enter alternate address" name="alternate_address"  value="{{ $userProfile->alternate_address }}" required >
			</div>
			</div>


			
			



			<div class="form-group @if ($errors->has('country_id')) has-error @endif">
			<label for="form-field-2" class="col-sm-2 control-label">
			 Country
			 <span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			{!! Form::select('country_id', $countries , (empty($userProfile) ? null : $userProfile->country_id ) , array('class' => 'form-control', 'id' => 'country_id', 'required'  => 'required'  ))  !!}			

			</div>
			</div>	

			<div class="form-group @if ($errors->has('city')) has-error @endif">
			<label for="city" class="col-sm-2 control-label">
			City
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9"  >
				{!! Form::select('city', $cityl , (empty($userProfile) ? null : $userProfile->city ) , array('class' => 'form-control', 'id' => 'cities', 'required'  => 'required'  ))  !!}	 
			</div>
			</div>

			<div class="form-group @if ($errors->has('state')) has-error @endif">
			<label for="state" class="col-sm-2 control-label">
			State 
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="state" name="state" placeholder="Enter state name" value="{{ $userProfile->state }}"  required >			
			</div>
			</div>




			<div class="form-group @if ($errors->has('zipcode')) has-error @endif">
			<label for="zipcode" class="col-sm-2 control-label">
			Zipcode
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter Zipcode" value="{{ $userProfile->zipcode }}" required >			
			</div>
			</div>


			
	
		</fieldset>	
	
		<fieldset>
			<legend>Demographics</legend>	
			
			<div class="form-group @if ($errors->has('education')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Education
			
			</label>
			<div class="col-sm-9">
			
	{!! Form::select('education', \App\Models\Education::lists('title', 'id') , (empty($userProfile) ? null : $userProfile->education ) , array('class' => 'form-control', 'id' => 'country_id', 'required'  => 'required'  ))  !!}			

			</div>
			</div>
			
			<div class="form-group @if ($errors->has('employment_status')) has-error @endif">
			<label for="employment_status" class="col-sm-2 control-label">
			Employment Status
			
			</label>
			<div class="col-sm-9">
			
	{!! Form::select('employment_status', \App\Models\EmploymentStatus::lists('title', 'id') , (empty($userProfile) ? null : $userProfile->education ) , array('class' => 'form-control', 'id' => 'country_id', 'required'  => 'required'  ))  !!}				
			

			</div>
			</div>

			<div class="form-group @if ($errors->has('income_range')) has-error @endif">
			<label for="income_range" class="col-sm-2 control-label">
			Income range ($)
			
			</label>
			<div class="col-sm-9">
				{!! Form::select('income_range', \App\Models\IncomeRange::lists('title', 'id') , (empty($userProfile) ? null : $userProfile->income_range ) , array('class' => 'form-control', 'id' => 'country_id', 'required'  => 'required'  ))  !!}		
			
			</div>
			</div>
			
			
			<div class="form-group @if ($errors->has('relationship_status')) has-error @endif">
			<label for="relationship_status" class="col-sm-2 control-label">
			Relationship status
			
			</label>
			<div class="col-sm-9">
			{!! Form::select('relationship_status', \App\Models\RelationshipStatus::lists('title', 'id') , (empty($userProfile) ? null : $userProfile->relationship_status ) , array('class' => 'form-control', 'id' => 'country_id', 'required'  => 'required'  ))  !!}		
			
			
			
			</div>
			</div>



	
		</fieldset>	


		<fieldset>
			<legend>Website</legend>	
			
			<div class="form-group @if ($errors->has('website')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Website
			 
			</label>
			<div class="col-sm-9">
			<input type="url" class="form-control" id="website" placeholder="Enter your website url" name="website" value="{{ $userProfile->website }}"  >
			</div>
			</div>


			<div class="form-group @if ($errors->has('facebook_url')) has-error @endif">
			<label for="facebook_url" class="col-sm-2 control-label">
			Facebook URL  
			</label>
			<div class="col-sm-9">
			<input type="url" class="form-control" id="facebook_url" placeholder="Enter your facebook url" name="facebook_url" value="{{ $userProfile->facebook_url }}"  >
			</div>
			</div>

			<div class="form-group @if ($errors->has('twitter_url')) has-error @endif">
			<label for="twitter_url" class="col-sm-2 control-label">
			Twitter URL  
			</label>
			<div class="col-sm-9">
			<input type="url" class="form-control" id="twitter_url" placeholder="Enter your twitter url" name="twitter_url" value="{{ $userProfile->twitter_url }}"   >
			</div>
			</div>




			<div class="form-group @if ($errors->has('linkedIn_url')) has-error @endif">
			<label for="linkedIn_url" class="col-sm-2 control-label">
			LinkedIn URL  
			</label>
			<div class="col-sm-9">
			<input type="url" class="form-control" id="linkedIn_url" placeholder="Enter your LinkedIn url" name="linkedIn_url" value="{{ $userProfile->linkedIn_url }}"   >
			</div>
			</div>

			<div class="form-group @if ($errors->has('googleplus_url')) has-error @endif">
			<label for="googleplus_url" class="col-sm-2 control-label">
			GooglePlus URL  
			</label>
			<div class="col-sm-9">
			<input type="url" class="form-control" id="googleplus_url" placeholder="Enter your GooglePlus url" name="googleplus_url" value="{{ $userProfile->googleplus_url }}"   >
			</div>
			</div>



		</fieldset>			
		
		<fieldset>
			<legend>Add User Avtar</legend>	
			
			<div class="form-group @if ($errors->has('user_avtar')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			<label  id="bannerclassi" >Icon <span id="bannererr" class="symbol required"></span></label>
			
			</label>
			<div class="col-sm-9">

			<?php if($userProfile->user_avtar !='') { ?>
                <div id="bnruplddiv" class="form-group"> 
                    <div class="fileupload fileupload-new" data-provides="fileupload"> 
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 200px;">
						<img src="<?php echo url(); ?>/images/avtar-image/resize/<?php echo $userProfile->user_avtar; ?>" border="0"  width="200" > 
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"></div> 
                        <div>
                            <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                             <input type="file" name="user_avtar" id="user_avtar"  >
                            </span>
                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                <i class="fa fa-times"></i> Remove
                            </a>
                        </div> 
                    </div>                                  
                </div> 
			<?php } else { ?>
            <div id="bnruplddiv" class="form-group"> 
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="border: none;"> 
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div> 
                    <div>
                        <span class="btn btn-light-grey btn-file upImg"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                       <input type="file" name="user_avtar" id="user_avtar"  >
                        </span>
                        <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                            <i class="fa fa-times"></i> Remove
                        </a>
                    </div> 
                </div> 
            </div>  	
			<?php } ?>
			<input type="hidden" id="oldimage" name="oldimage" value="<?php echo $userProfile->user_avtar; ?>" >
			</div>
			</div>

		</fieldset>				
		
		
		
		
		
		

	
		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-warning MidButton pull-left" name="submit" value="add-user-form">Save Profile Data</button>							
			</div>
			</div>										
		</fieldset>


  {!! Form::close() !!}
  
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
