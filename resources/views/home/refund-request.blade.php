@extends('app' )
@section('content')
<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
    <div class="row">	
      <div class="col-md-12">	  
        <h3>Dashboard / Withdraw</h3>        
        <!-- menu open -->
		@include('home.partials._dashboard_top_menu')
        <!-- menu closed -->         
        <!-- form part 1 open -->
        <div class="formBox">		
		@include('home.partials._dashboard_sub_menu')
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">Update User Profile </div>
<div class="panel-body"> 
 @include('admin.partials._flashmsg')
{!! Form::open(array('url' =>  ['home/refund',], 'files' => true , 'id'=>'profile-form' , 'class' => 'form-horizontal', 'role'=>'form', 'method' => 'post')) !!}
		<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
		<input type="hidden" name="id" value="{{ $transaction_details->id }}"> 
		<fieldset>
			<legend>Withdraw Information</legend>	
			
			<div class="form-group ">
				<label for="f_name" class="col-sm-2 control-label" style="padding-top:0;">
					Project Name
				<span class="symbol required"></span>
				</label>
				<div class="col-sm-9">
					{{ $transaction_details->project()->first()->name }}
				</div>
			</div>
			<div class="form-group ">
				<label for="f_name" class="col-sm-2 control-label" style="padding-top:0;">
					Amount($)
				<span class="symbol required"></span>
				</label>
				<div class="col-sm-9">
					{{ $transaction_details->paid_amount }}
				</div>
			</div>
			<div class="form-group ">
				<label for="f_name" class="col-sm-2 control-label" style="padding-top:0;">
					Transaction Id
				<span class="symbol required"></span>
				</label>
				<div class="col-sm-9">
					{{ $transaction_details->transaction_id }}
				</div>
			</div>
			</fieldset>	
			<fieldset>
				<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2">		
						<input type="submit" class="btn btn-warning MidButton pull-left" name="submit" value="withdraw" />
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
