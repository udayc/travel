@extends('app')

@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">




    <div class="row">	
      <div class="col-md-12">
  
        <h3>Payment Options / Payout Methods</h3>        
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
		<div class="panel-heading">Payment Account Settings</div>
		 
		<div class="panel-body"> 
		<p>
		When you receive a payment, we call that payment to you a "payout". Our secure payment system supports below payout methods, which can be setup here.
		Note that buyers will be provided with the payment options, based on below setup only.
		</p>
		
		<p>&nbsp;</p>
	<form class="form-horizontal" role="form" method="POST" name="password-reset-form" id="password-reset-form" action="/home/payment-options">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::hidden('u_id', Auth::user()->id ) !!}
	<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
		<fieldset>
				
			
			<div class="form-group @if ($errors->has('receiver_email')) has-error @endif">
			<label for="receiver_email" class="col-sm-2 control-label">
			Receiver Payment Email
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="email" class="form-control" name="receiver_email" id="receiver_email" value="{{ ($getReceiverAccount!=null) ? $getReceiverAccount->receiver_email : '' }}" >
			</div>
			</div>
			
			<div class="form-group @if ($errors->has('secret_key')) has-error @endif">
			<label for="secret_key" class="col-sm-2 control-label">
			Secret Key
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" name="secret_key" id="secret_key" value="{{ ( $getReceiverAccount !=null ) ? $getReceiverAccount->secret_key : '' }}" required >
			</div>
			</div>
			
			<div class="form-group @if ($errors->has('public_key')) has-error @endif">
			<label for="public_key" class="col-sm-2 control-label">
			Public Key
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" name="public_key" id="public_key" value="{{ ($getReceiverAccount !=null ) ? $getReceiverAccount->public_key : '' }}" >
			</div>
			</div>

			
			

		
	
		</fieldset>	


	
		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-warning MidButton pull-left" name="submit" value="add-user-form">Save Data</button>							
			</div>
			</div>										
		</fieldset>


  {!! Form::close() !!}		
		
		
		
		
		
		
		
		
		
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p></p>
		<p></p>
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

	<link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/css/datepicker.css') }} ">
	<link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">



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
		<script src="{{ URL::asset('js/main.js ') }}"></script>



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