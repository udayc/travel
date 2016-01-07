@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
@include('admin.page.partials._pageheader' , ['page_title' => 'Edit Page Details' , 'userStat'=> null ])
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
<div class="panel-heading"><span style="margin-left:-20px;">Edit Page</span> </div>

<div class="panel-body">

{!! Form::open(array('url' =>  ['admin/pages/update', $page->id], 'files' => true , 'id'=>'cms-page' , 'class' => 'form-horizontal', 'role'=>'form', 'method' => 'put')) !!}
{!! Form::hidden('id', $page->id) !!}
<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<fieldset>
	<legend>General</legend>

	<div class="form-group @if ($errors->has('name')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Page Title
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">
	<input type="text" class="form-control" id="title" placeholder="Enter Page Title" name="title"  value="{{ $page->title}}" required>
	</div>
	</div>

	<div class="form-group @if ($errors->has('email')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Page Content
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">		
	<textarea class="form-control" name="content" placeholder="Enter Page Content" id="content" rows="8">{{ $page->content}}</textarea>			
	</div>
	</div>
	<?php /* ?>
	
	<div class="form-group">
	<label for="form-field-2" class="col-sm-2 control-label">
	Attached With Menu
	</label>
	<div class="col-sm-9">			
	{!! Form::select('menu_id', $_menus , (empty($page) ? null : $page->menu_id) , array('class' => 'form-control'))  !!}									
	</div>
	</div>
	<?php */ ?>
	
	
	<div class="form-group @if ($errors->has('email')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Enter Meta KeyWords
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">		
	<textarea class="form-control" name="meta_keywords" placeholder="Enter Meta KeyWords" id="meta_keywords" rows="4">{{ $page->meta_keywords}}</textarea>			
	</div>
	</div>

	<div class="form-group @if ($errors->has('email')) has-error @endif">
	<label for="form-field-1" class="col-sm-2 control-label">
	Enter Meta Descriptions
	<span class="symbol required"></span>
	</label>
	<div class="col-sm-9">		
	<textarea class="form-control" name="meta_description" placeholder="Enter Meta Descriptions" id="meta_description" rows="6">{{ $page->meta_description}}</textarea>			
	</div>
	</div>	




	
	

	<div class="form-group">
	<label for="form-field-2" class="col-sm-2 control-label">
	Active
	</label>
	<div class="col-sm-9">			
	<select class="form-control" id="active" name="active">			
	<option value="1" @if($page->active == 1) selected @endif >Yes</option>
	<option value="0" @if($page->active == 0) selected @endif >No</option>
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