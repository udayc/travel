@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.settings.partials._pageheader' , ['settings_form' => 'Regional, Currency & Language'  ])
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->


	
<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-external-link-square"></i>
Regional, Currency & Language
</div>

<div class="panel-body">
<form class="form-horizontal" role="form" name="regional-currency-language" action="/admin/settings/{{ $formkey }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<legend>Regional</legend>									
			<div class="form-group">
			<label for="site_default_language" class="col-sm-2 control-label">
			Site language
			</label>
			<div class="col-sm-9">			
				<select name="site_default_language" id="site_default_language" class="form-control">			
				<option value="en" selected>English</option>
				</select>			

			</div>
			</div>
		</fieldset>									

		<fieldset>
			<legend>Currency Settings</legend>								
			<div class="form-group">
			<label for="form-field-3" class="col-sm-2 control-label">Site Currency Symbol</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="site_currency_symbol" name="site_currency_symbol" placeholder="SMTP Host" value="{{ $site_currency_symbol }}">
			</div>
			</div>

			<div class="form-group">
			<label for="form-field-4" class="col-sm-2 control-label">
			Currency
			</label>
			<div class="col-sm-9">
			{!! Form::select('currency', ['USD'=>'USD', 'AED'=>'AED' , 'INR'=>'INR'], (empty($currency) ? null : $currency) , array('class' => 'form-control' , 'required' => 'required'))  !!}
			</div>
			</div>		
		</fieldset>		

		<fieldset>
			<legend>Date and Time</legend>			


			<div class="form-group">
			<label for="form-field-6" class="col-sm-2 control-label">
			Date Format
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="date_format" name="date_format" placeholder="Meta keywords" value="{{ $date_format }}">
			<span class="help-block"><i class="fa fa-info-circle"></i> This is the date format which will be displayed in site.</span>
			</div>
			</div>


			<div class="form-group">
			<label for="form-field-7" class="col-sm-2 control-label">
			Time Format
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="time_format" name="time_format" placeholder="Meta Description" value="{{ $time_format }}">
			<span class="help-block"><i class="fa fa-info-circle"></i>This is the time format which will be displayed in  site.</span>		
			</div>
			</div>
			
			<div class="form-group">
			<label for="form-field-7" class="col-sm-2 control-label">
			Date-Time Format
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="date_time_format" name="date_time_format" placeholder="Meta Description" value="{{ $date_time_format }}">
			<span class="help-block"><i class="fa fa-info-circle"></i>This is the date-time format which will be displayed in  site.</span>		
			</div>
			</div>
	
		</fieldset>



		<fieldset>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">										
			<button type="submit" class="btn btn-orange" name="submit" value="regional-currency-language-form">Update</button>							
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