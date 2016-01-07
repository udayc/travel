@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.page.partials._pageheader' , ['page_title' => 'Add New Page' , 'userStat'=> null ])
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
<div class="panel-heading"><span style="margin-left:-20px;">Create New Page</span> </div>

<div class="panel-body">
	<form class="form-horizontal" role="form" name="add_user" id="add_user" action="/admin/pages/store" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<fieldset>
	<legend>General</legend>

	<div class="form-group @if ($errors->has('name')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Page Title
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">
	<input type="text" class="form-control" id="title" placeholder="Enter Page Title" name="title" required >
	</div>
	</div>

	<div class="form-group @if ($errors->has('email')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Page Content
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">		
	<textarea class="form-control" name="content" placeholder="Enter Page Content" id="content" rows="8"></textarea>			
	</div>
	</div>
	<?php /* ?>
	<div class="form-group">
	<label for="form-field-2" class="col-sm-2 control-label">
	Attached With Menu
	</label>
	<div class="col-sm-9">			
	{!! Form::select('menu_id', $_menus , null , array('class' => 'form-control'))  !!}									
	</div>
	</div>		
	<?php */ ?>
	
	
	<div class="form-group @if ($errors->has('email')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Enter Meta KeyWords
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">		
	<textarea class="form-control" name="meta_keywords" placeholder="Enter Meta KeyWords" id="meta_keywords" rows="4"></textarea>			
	</div>
	</div>

	<div class="form-group @if ($errors->has('email')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Enter Meta Descriptions
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">		
	<textarea class="form-control" name="meta_description" placeholder="Enter Meta Descriptions" id="meta_description" rows="6"></textarea>			
	</div>
	</div>	


	
	
	
	
	

	<div class="form-group">
	<label for="form-field-2" class="col-sm-2 control-label">
	Active
	</label>
	<div class="col-sm-9">			
	<select class="form-control" id="status" name="status">			
	<option value="1">Yes</option>
	<option value="0">No</option>
	</select>										
	</div>
	</div>			

	</fieldset>									

	<fieldset>
	<div class="form-group">
	<div class="col-sm-2 col-sm-offset-2">										
	<button type="submit" class="btn btn-orange" name="submit" value="add-user-form">Save & Continue</button>							
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

@include('admin.page.partials._relatedfiles')