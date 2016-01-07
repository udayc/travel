@extends('app')

@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">




    <div class="row">	
      <div class="col-md-12">
  
        <h3>Dashboard / Bulk Emails</h3>        
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
<div class="panel-heading">Bulk Emails To Active Users</div>
 
<div class="panel-body"> 
 @include('admin.partials._flashmsg')
 
	{!! Form::open(['url' => 'home/sendemail', 'method' => 'post', 'name' => 'form8', 'id' => 'form8'  ]) !!}  

	<div class="row">
	<div class="col-md-12">
	<div class="form-group">
	<label class="control-label">
	Bulk Mail Option <span class="symbol required"></span>
	</label>
	<div class="input select">
	<select id="bulkmailopt" class="form-control" name="bulkmailopt"  >
	<option value="3">Active Users</option>
	</select>
	</div> 
	</div>  
	</div>  

	</div>


	<div class="row"> 
	<div class="col-md-12">
	<div class="form-group">
	<label class="control-label">Send To <span class="symbol required">*</span></label> 
	<div class="input select" id="activelist" > 
	<select multiple="multiple" id="form-field-select-4" class="form-control search-select" name="selectedemails[]" placeholder="Select email" required >
	<?php
	if(is_array($activearr) && count($activearr)>0) { 	foreach($activearr as $kyy=>$aactval) { 
		?>	<option value="<?php echo $aactval['email']; ?>"><?php echo $aactval['email']; ?></option>
	<?php	} } 	?>
	</select> 
	</div> 
	</div>  
	</div>   
	</div>



	<div class="row"> 
	<div class="col-md-12">
	<div class="form-group">
	<label class="control-label">Subject <span class="symbol required">*</span></label>
	<input type="text" placeholder="Subject" class="form-control" id="emailsubject" name="emailsubject">
	</div>  
	</div>  
	</div>


	<div class="row"> 
	<div class="col-md-12">
	<div class="form-group"><label class="control-label">Message <span class="symbol required">*</span></label>
	<textarea id="usrmsg" class="form-control" name="usrmsg" rows="5"></textarea>
	</div>  
	</div>  
	</div>                                                                                
	<fieldset>
			<div class="row"> 
			<div class="col-md-12"> 
			<input type="submit" name="Submit" value="Submit" class="btn btn-warning MidButton pull-left" > 
			</div>
			</div> 
	</fieldset>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::hidden('id', $userProfile->user_id) !!}						 
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





@endsection




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













