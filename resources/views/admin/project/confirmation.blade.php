@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER -->
<?php if($func=="add") { $subtitle="Add Project"; } else { $subtitle="Edit Project"; } ?>

@include('admin.project.partials._pageheaderother' , ['settings_form' => $subtitle  ])
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
<div class="panel-heading">
<span style="margin-left:-20px;"><?php echo $subtitle; ?></span>
</div>

<div class="panel-body">

<form class="form-horizontal" id="bookForm" role="form" name="add_project" action="/admin/project" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="reward_row_count" id="reward_row_count" value="0"/>
<!-- set For step -->
@include('admin.project.partials._formstep_5' , ['class' => 'selected' , 'rel'=>'1' , 'isDone' => '1' ,'skey' => Session::get('last_insert_id') ])
<!-- set For step : End  -->

		<fieldset>
			<legend>Confirmation</legend>	

				<div class="alert alert-block alert-success fade in">				
				<h4 class="alert-heading"><i class="fa fa-check-circle"></i> Success!</h4>
				<p>
				Project creation is done successfully.
				Admin will approve, after confirmed your filled data.
				</p>
				<p>
				<a class="btn btn-green" href="/admin/project">Confirm & Exit</a>
				</p>
				</div>			
			
			



		</fieldset>									



<input type="hidden" name="user_id" value="5">
<input type="hidden" name="step" value="3">
</form>
</div>

</div>
</div>					
</div>	




<!-- end: PAGE CONTENT-->
</div>

@stop

@include('admin.project.partials._relatedfiles')
