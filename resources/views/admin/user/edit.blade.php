@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => 'Edit User Profile'  ])
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->
@if ($errors->has())
<div class="alert alert-danger">
@foreach ($errors->all() as $error)
	{{ $error }}<br>        
@endforeach
</div>
@endif

 
<link rel="stylesheet" href="<?php echo url(); ?>/plugins/datepicker/css/datepicker.css">
<link rel="stylesheet" href="<?php echo url(); ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">

<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading"><span style="margin-left:-20px;">Update User Info</span> </div>
 
<div class="panel-body"> 
 


{!! Form::open(array('url' =>  ['admin/user/update', $userProfile->user_id], 'files' => true , 'id'=>'profile-form' , 'class' => 'form-horizontal', 'role'=>'form', 'method' => 'put')) !!}
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
					<select class="form-control" name="education" id="education">
					<option value="">Please Select</option>					
					<option value="2" <?php if($userProfile->education == '2'){ echo "selected"; } ?> >High school graduate or equivalent</option>
					<option value="3" <?php if($userProfile->education == '3'){ echo "selected"; } ?> >Trade or vocational degree</option>					
					<option value="5" <?php if($userProfile->education == '5'){ echo "selected"; } ?> >Associate degree</option>
					<option value="6" <?php if($userProfile->education == '6'){ echo "selected"; } ?> >Bachelor's degree</option>
					<option value="7" <?php if($userProfile->education == '7'){ echo "selected"; } ?> >Graduate or professional degree</option>
					<option value="8" <?php if($userProfile->education == '8'){ echo "selected"; } ?> >Prefer not to share</option>
					<option value="9" <?php if($userProfile->education == '9'){ echo "selected"; } ?> >Class 12</option>
					<option value="10" <?php if($userProfile->education == '10'){ echo "selected"; } ?> >Class 10</option>
					</select>			
			
			
			</div>
			</div>
			
			<div class="form-group @if ($errors->has('employment_status')) has-error @endif">
			<label for="employment_status" class="col-sm-2 control-label">
			Employment Status
			
			</label>
			<div class="col-sm-9">
					<select class="form-control" name="employment_status" id="employment_status">
					<option value="">Please Select</option>
					<option value="1" <?php if($userProfile->employment_status == '1'){ echo "selected"; } ?> >Employed full time</option>
					<option value="2" <?php if($userProfile->employment_status == '2'){ echo "selected"; } ?>>Not employed but looking for work</option>
					<option value="3" <?php if($userProfile->employment_status == '3'){ echo "selected"; } ?>>Not employed and not looking for work</option>
					<option value="4" <?php if($userProfile->employment_status == '4'){ echo "selected"; } ?> >Retired</option>
					<option value="5" <?php if($userProfile->employment_status == '5'){ echo "selected"; } ?> >Student</option>
					<option value="6" <?php if($userProfile->employment_status == '6'){ echo "selected"; } ?>  >Homemaker</option>
					<option value="7" <?php if($userProfile->employment_status == '7'){ echo "selected"; } ?> >Prefer not to share</option>
					</select>
			</div>
			</div>

			<div class="form-group @if ($errors->has('income_range')) has-error @endif">
			<label for="income_range" class="col-sm-2 control-label">
			Income range ($)
			
			</label>
			<div class="col-sm-9">
					<select class="form-control" name="income_range" id="income_range">
					<option value="">Please Select</option>
					<option value="1" <?php if($userProfile->income_range == '1'){ echo "selected"; } ?> >Under 20,000</option>
					<option value="2" <?php if($userProfile->income_range == '2'){ echo "selected"; } ?> >20,000 - 29,000</option>
					<option value="3" <?php if($userProfile->income_range == '3'){ echo "selected"; } ?> >30,000 - 39,999</option>
					<option value="4" <?php if($userProfile->income_range == '4'){ echo "selected"; } ?> >40,000 - 49,999</option>
					<option value="5" <?php if($userProfile->income_range == '5'){ echo "selected"; } ?> >50,000 - 69,999</option>
					<option value="6" <?php if($userProfile->income_range == '6'){ echo "selected"; } ?> >70,000 - 99,999</option>
					<option value="7" <?php if($userProfile->income_range == '7'){ echo "selected"; } ?> >100,000 - 149,000</option>
					<option value="8" <?php if($userProfile->income_range == '8'){ echo "selected"; } ?> >150,000 or more</option>
					<option value="9" <?php if($userProfile->income_range == '9'){ echo "selected"; } ?> >Prefer not to share</option>
					</select>			
			</div>
			</div>
			
			
			<div class="form-group @if ($errors->has('relationship_status')) has-error @endif">
			<label for="relationship_status" class="col-sm-2 control-label">
			Relationship status
			
			</label>
			<div class="col-sm-9">
			
					<select class="form-control" name="relationship_status">
					<option value="">Please Select</option>
					<option value="1" <?php if($userProfile->relationship_status == '1'){ echo "selected"; } ?> >Single, not married</option>
					<option value="2" <?php if($userProfile->relationship_status == '2'){ echo "selected"; } ?> >Married</option>
					<option value="3" <?php if($userProfile->relationship_status == '3'){ echo "selected"; } ?> >Living with partner</option>
					<option value="4" <?php if($userProfile->relationship_status == '4'){ echo "selected"; } ?> >Separated</option>
					<option value="5" <?php if($userProfile->relationship_status == '5'){ echo "selected"; } ?> >Divorced</option>
					<option value="6"  <?php if($userProfile->relationship_status == '6'){ echo "selected"; } ?> >Widowed</option>
					<option value="7" <?php if($userProfile->relationship_status == '7'){ echo "selected"; } ?> >Prefer not to share</option>
					</select>			
			
			
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
			<button type="submit" class="btn btn-orange" name="submit" value="add-user-form">Save</button>							
			</div>
			</div>										
		</fieldset>


  {!! Form::close() !!}
  
</div>

</div>
</div>					
</div>	




<!-- end: PAGE CONTENT-->
</div>

@stop


@section('scripts')

		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="/js/jquery.slug.js"></script>

		<script src="/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
		<script src="/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
		<script src="/js/index.js"></script>
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



	 
		<script>

			jQuery(document).ready(function() {
					Main.init(); 
					FormValidator.init();
					FormElements.init();
					Index.init();
	
		    	$("select#country_id").change(function(){ 
			        var selectedCountry = $("#country_id").val(); 
			        $.ajax({
			            type: "GET",  
			            url:base_url+'/admin/user/citylist/'+selectedCountry,
			            dataType: 'json'
			        }).done(function(cities){ 
			        	   $("#cities > option").remove(); 
			        	   $.each(cities,function(city_id,city)  {  
		                        var opt = $('<option />');  
		                        opt.val(city.cityID);
		                        opt.text(city.cityName);
		                        $('#cities').append(opt);  
                    	  });
			        	   
			            /*$("#response").html(data); */


			        });
		    	});
 
				
			});



		</script>

@stop
