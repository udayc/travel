@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => $formkey  ])
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
<form class="form-horizontal" role="form" name="backer-form" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="allowe_backer_views_others_amnt" value="off">
<input type="hidden" name="allowe_backer_cancel_fund" value="off">
		<fieldset>
			<legend>Project Fund</legend>									
			<div class="form-group">
			<label for="form-field-1" class="col-sm-2 control-label">
			
			</label>
			<div class="col-sm-9">
		
			<div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="allowe_backer_views_others_amnt" id="allowe_backer_views_others_amnt" @if( $allowe_backer_views_others_amnt == 'on' ) checked @endif>
			Allow backer to view the other funders amount
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this, funders can see the other backers amount.</span>
			</div>					
		
		
		
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			
			</label>
			<div class="col-sm-9">
		   <div class="checkbox">
			<label>
			<input type="checkbox" class="green" name="allowe_backer_cancel_fund" id="allowe_backer_cancel_fund" @if( $allowe_backer_cancel_fund == 'on' ) checked @endif>
			Enable to allow fund cancel by backer
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			On enabling this, funders can cancel their fund for project.</span>
			</div>			
			
			
			
		
			</div>
			</div>
		</fieldset>									

		





		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="backer-form">Update</button>							
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