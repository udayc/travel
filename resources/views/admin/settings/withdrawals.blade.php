@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => ucwords($formkey)  ])
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->


	
<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-external-link-square"></i>
{{ ucwords($formkey) }}
</div>

<div class="panel-body">
<form class="form-horizontal" role="form" name="withdrawals-form" id="withdrawals-form" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<legend>Cash Withdraw</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Minimum Withdrawal Amount($)
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="min_withdrawal_amnt" placeholder="Minimum Withdrawal Amount" name="min_withdrawal_amnt" value="{{ $min_withdrawal_amnt }}" >
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Maximum Withdrawal Amount($)
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="max_withdrawal_amnt" name="max_withdrawal_amnt" placeholder="Maximum Withdrawal Amount" value="{{ $max_withdrawal_amnt }}" >
			
			</div>
			</div>
		</fieldset>									

		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="withdrawals-form">Update</button>							
			</div>
			</div>										
		</fieldset>


</form>
</div>

</div>
</div>					
</div>









<!-- end: PAGE CONTENT-->
</div>

@stop
@include('admin.settings.partials._relatedfiles')