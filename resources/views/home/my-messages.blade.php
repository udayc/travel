@extends('app')

@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">




    <div class="row">	
      <div class="col-md-12">
  
        <h3>Dashboard / Messages</h3>        
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
		<div class="panel-heading">Inbox</div>
		 
		<div class="panel-body"> 

		
		<div class="row">
			<div class="col-md-3">
				<select name="sortByMessageBox" id="sortByMessageBox" class="form-control">
				<option >Select Option</option>
				<option value="inbox" @if($boxType == 'inbox') selected @endif >Inbox</option>
				<option value="sent" @if($boxType == 'sent') selected @endif >Sent</option>
				</select>	
			</div>
		</div>		
		<br/>
		
		
		
		
		
		
			<table class="table table-striped table-bordered table-hover table-full-width" id="user_dashboard_activity_table">
			<thead>
			<tr>
			<th></th>
			<th>Details</th>
			
			<th>Date</th>
			<th>Reply</th>

			</tr>
			</thead>
			<tbody>
	@if( count($myInboxLists)  > 0 )
	
	
		@foreach($myInboxLists as $val)			
			
			
			<tr>
			<td><img src="/images/avtar-image/resize/{{ ( \App\Models\Emaillog::usersById($val->from_id ) != Null ) ? \App\Models\Emaillog::usersById($val->from_id )->user_avtar  : 'user_avtar_default' }}" width="50" width="50"/></td>
			<td>
			{{ ( \App\Models\MessageHeader::usersById($val->from_id ) != Null ) ? \App\Models\Emaillog::usersById($val->from_id )->f_name . ' ' . \App\Models\Emaillog::usersById($val->from_id )->l_name : 'Guest' }}
			<p><a href="{{ URL::to('project/'.$val->project_id . '/' . \App\Models\MessageHeader::projectById($val->project_id )->slug)}}">
			{{ ( \App\Models\MessageHeader::projectById($val->project_id ) != Null ) ? \App\Models\MessageHeader::projectById($val->project_id )->name  : 'n/a' }}	</a>		
			</p>
			<p>{!! str_limit($val->content, $limit = 130, $end = '...') !!}</p>
			</td>
			
			<td>{{ date('M d, Y' , strtotime($val->created_at) ) }} </td>
			<td><a class="replymsg" href="javascript:void(0);" data-msg-id="{{ $val->id }}"> Reply({{ ( \App\Models\MessageHeader::countReplyById($val->id )) ? \App\Models\MessageHeader::countReplyById($val->id ) : 0 }}) </a></td>


			</tr>
			
	@endforeach

	@else
	<tr><td colspan="4"> No result found !</td></tr>
	@endif				
			
			


			</tbody>
			</table>
		
		
		
		
		
		
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







<div id="ajax-modal-reply" class="modal fade" tabindex="-1" style="display: none;"></div>






@endsection




@section('styles')

	<link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/css/datepicker.css') }} ">
	<link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">

	<link href="/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
	<link href="/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>

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
		
		<script src="/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script src="/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>		

		<script src="/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="/plugins/autosize/jquery.autosize.min.js"></script>
		<script src="/plugins/select2/select2.min.js"></script>
		<script src="/js/form-elements.js"></script>
		
		<script src="/js/ui-modals.js"></script>
		<script src="/js/frontend/mfunder.ui.app.js"></script>

	 
		<script>
		jQuery(document).ready(function() {
		
		
					Main.init(); 
					UIModals.init();
					FormValidator.init();
					FormElements.init();
					myApp.ajaxCountryCityListHandler();
					//myApp.openReplyMsgModal();
					//myApp.ajaxPostReplyMsgHandler();
					myApp.sortByMessageInbox();
					
					
					
					
					
		});
		</script>

@stop