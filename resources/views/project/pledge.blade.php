@extends('app')

@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">




    <div class="row">	
      <div class="col-md-12">
  
        <h3>{{ $post->name }}
			<br>
			<span>by {{ $post->user()->first()->name }}</span>		
		
		</h3>        
        <!-- menu open -->
        <!-- menu closed --> 
        
        <!-- form part 1 open -->
        <div class="formBox">
		


		<div class="row">
		<div class="col-sm-12">

		<div class="panel panel-default">
		<div class="panel-heading">Let's choose your reward!</div>
		 
		<div class="panel-body"> 
      <div class="project-detail-rgt-reward">
     
      <div class="rewardBx">
      <h5>No thanks, I just want to help the project.</h5>   
	  <p>
	 
	  
		<form method="post" action="/project/pledge-amount" accept-charset="UTF-8">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" value="{{ $post->id }}" name="project_id" id="project_id" class="hidden">
		<input type="hidden" value="0" name="reward_id" id="reward_id" class="hidden">
		<input type="hidden" value="false" name="clicked_reward" id="clicked_reward" class="hidden">
		<input value="1" tabindex="-1" name="backing[amount]" class="form-control" type="number" min="1">
		<button tabindex="-1" class="btn btn--green pledge__checkout-submit">Continue</button>
		</form>	  

	  
	  
	  <p>
      </div>	  
	  
	  
	  
	  
      @if(count($rewards) > 0 )
        @foreach($rewards as $reward)
      <div class="rewardBx">
      <h5>Pledge ${{ $reward->pledge_amount}} or more</h5>
      <p>{{ $reward->user_limit}} backers</p>
      <p>{{ $reward->short_note}}</p>
      <p>Estimated delivery:  {{  $reward->delevery_month . '/' .$reward->delevery_year }}</p>
	  <p><form method="post" action="/project/pledge-amount" accept-charset="UTF-8">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <input type="hidden" value="{{ $post->id }}" name="project_id" id="project_id" class="hidden">
	   <input type="hidden" value="{{ $reward->id }}" name="reward_id" id="reward_id" class="hidden">
	   <input type="hidden" value="false" name="clicked_reward" id="clicked_reward" class="hidden">
	  <input value="{{ $reward->pledge_amount}}" tabindex="-1" name="backing[amount]" class="form-control" type="number" min="{{ $reward->pledge_amount}}">
	  <button tabindex="-1" class="btn btn--green pledge__checkout-submit">Continue</button>
	  </form>
	  <p>
      </div>
        @endforeach
      @endif
      

      
      </div>
		 
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