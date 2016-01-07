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
<form class="form-horizontal" role="form" name="revenue-form" id="revenue-form" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<legend>Project Fund</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			Commission from each fund (%)
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="commission_from_each_fund" placeholder="Minimum Withdrawal Amount" name="commission_from_each_fund" value="{{ $commission_from_each_fund }}" >
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			Who will pay the gateway fee?
			</label>
			<div class="col-sm-9">
			
			<label class="radio-inline">
			<input type="radio" value="project-owner" name="gateway_fee_payer" class="green" @if( $gateway_fee_payer == 'project-owner' ) checked @endif >
			Project Owner
			</label>
			
			<label class="radio-inline">
			<input type="radio" value="site" name="gateway_fee_payer" class="green" @if( $gateway_fee_payer == 'site' ) checked @endif >
			Site
			</label>
			
			<label class="radio-inline">
			<input type="radio" value="both" name="gateway_fee_payer" class="green" @if( $gateway_fee_payer == 'both' ) checked @endif >
			Site and Project Owner
			</label>			
			
			
			
			</div>
			</div>
		</fieldset>									

		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="revenue-form">Update</button>							
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