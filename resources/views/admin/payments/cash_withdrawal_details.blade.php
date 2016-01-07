@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.user.partials._pageheader' , ['page_title' => 'Add User' , 'userStat'=> null ])
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





<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading"><span style="margin-left:-20px;">Withdraw Fund Requests</span> </div>

			<div class="panel-body">
				<form class="form-horizontal" role="form" name="add_user" id="add_user" action="/admin/payments/storenote" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" value="{{ $_id }}">
				<fieldset>
					<legend>Withdraw Fund Requests - Approved</legend>
					<div class="form-group">
						<label for="form-field-1" class="col-sm-2 control-label">
							User						
						</label>
						<div class="col-sm-9">
							{{ $_username }}
						</div>
					</div>
					<div class="form-group">						
						<label for="form-field-1" class="col-sm-2 control-label">
							Amount						
						</label>
						<div class="col-sm-9">
							{{ $_amount }}
						</div>
					</div>
					<div class="form-group">
						<label for="form-field-1" class="col-sm-2 control-label">
							Gateway
						</label>
						<div class="col-sm-9">
							<select class="form-control" id="type" name="type">			
								<option value="1">Mark as paid/manual</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="form-field-2" class="col-sm-2 control-label">
							Note						
						</label>
						<div class="col-sm-9">
							<textarea id="notes" style="width:630px; height:250px;" name="notes"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="form-field-2" class="col-sm-2 control-label">
							Money Transfer Accounts								
						</label>
						<div class="col-sm-9">
							{{ $_account }}	
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
				</form>
			</div>

		</div>
	</div>					
</div>	




<!-- end: PAGE CONTENT-->
</div>

@section('scripts')
<style>
	.form-horizontal .control-label
	{
		padding-top:0;
	}
</style>
@stop
@include('admin.user.partials._relatedfiles')