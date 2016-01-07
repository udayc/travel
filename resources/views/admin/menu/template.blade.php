@extends('admin.layout')
 

@section('main')

	<div class="row">
	  <div class="col-lg-12">
	    <h1 class="page-header">
	      Book Management 
	    </h1>
	    <ol class="breadcrumb">
	      <li class="active">
	        <span class="fa fa-pencil"></span> Books
	      </li>
	    </ol>
	  </div>
	</div>

	<div class="col-sm-12">
		@yield('form')  
		 
		{!! Form::submit("Send") !!}

		{!! Form::close() !!}
	</div>

@stop
 