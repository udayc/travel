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
<div class="panel-heading"><span style="margin-left:-20px;">Add User</span> </div>

<div class="panel-body">
<form class="form-horizontal" role="form" name="add_user" id="add_user" action="/admin/user/store" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<legend>Basic User Details</legend>	 


			<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			First Name
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="name" placeholder="Enter First name" value="{{ old('name') }}" name="name" required >
			</div>
			</div>


			<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Last Name
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="last_name" placeholder="Enter Last name" value="{{ old('last_name') }}" name="last_name" required >
			</div>
			</div>


			
			<div class="form-group @if ($errors->has('email')) has-error @endif">
			<label for="form-field-1" class="col-sm-2 control-label">
			Email
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="email" class="form-control" id="email" placeholder="Enter email address" value="{{ old('email') }}" name="email"  required >
			</div>
			</div>
 
			
			<div class="form-group @if ($errors->has('password')) has-error @endif">
			<label for="form-field-2" class="col-sm-2 control-label">
			Password
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="password" class="form-control" id="password" name="password" placeholder="Type user password" required >			
			</div>
			</div>


			<div class="form-group @if ($errors->has('password')) has-error @endif">
			<label for="form-field-2" class="col-sm-2 control-label">
			Password
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter confirm password" required >			
			</div>
			</div>


			<div class="form-group">
			<label for="form-field-2" class="col-sm-2 control-label">
			 Role
			</label>
			<div class="col-sm-9">			
			<select class="form-control" id="type" name="type">			
			<option value="general">User</option>
			</select>										
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

@stop

@include('admin.user.partials._relatedfiles')