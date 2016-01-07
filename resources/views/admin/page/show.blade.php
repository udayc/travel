@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER --> 
@include('admin.project.partials._pageheaderother' , ['settings_form' => 'Page Details'  ]) 
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->




<div class="row">
<div class="col-sm-12 col-md-12">

<div class="user-left">
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Page Details</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>Page Title:</td>
			<td class="left" align="left">			
			{{ $page->title }}
			</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>URL key:</td>
			<td>{{ $page->slug }}				
			</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Status:</td>
			<td> @if($page->active == 1 ) <code>Active</code> @else <code>Inactive</code> @endif </td>
			<td>&nbsp;</td>
			</tr>
			
			<tr>
			<td>Created At:</td>
			<td> {{ $page->created_at}}</td>
			<td>&nbsp;</td>
			</tr>
			
			<tr>
			<td>Updated At:</td>
			<td> {{ $page->updated_at}}</td>
			<td>&nbsp;</td>
			</tr>

			<tr>
			<td>Meta Keywords:</td>
			<td> {{ $page->meta_keywords}}</td>
			<td>&nbsp;</td>
			</tr>	
			
			<tr>
			<td>Meta Descriptions:</td>
			<td> {{ $page->meta_description}}</td>
			<td>&nbsp;</td>
			</tr>				
			

			
			
			
			<tr>
			
			<td colspan="2" valign="top">
			<p>
			{!! $page->content !!}
			</p></td>
			<td>&nbsp;</td>
			</tr>
		
			</tbody>
			</table>
			
		
			
			
		
			
			


</div>


</div>


</div>	


	<fieldset>
	<legend>&nbsp;</legend>
	<div class="row">
		<div class="col-sm-12">										
		<a href="/admin/pages" class="btn btn-orange" name="submit" value="add-user-form">Back</a>							
		</div>
	</div>
	<div class="row"><div class="col-sm-2 col-sm-offset-2">&nbsp;</div>	</div>
		
	</fieldset>





<!-- end: PAGE CONTENT-->
</div>

@stop

@include('admin.project.partials._relatedfiles')