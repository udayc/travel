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
<span style="margin-left:-20px;"><?php if($func=="add") { ?>Add Project<?php } else { ?>Edit Project<?php } ?></span>
</div>

<div class="panel-body">

<form class="form-horizontal" id="bookForm" role="form" name="add_project" action="/admin/project/store"  enctype="multipart/form-data" accept-charset="UTF-8" method="POST"  >
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="reward_row_count" id="reward_row_count" value="0"/>
<!-- set For step --> 
@include('admin.project.partials._formstep_3' , ['class' => 'selected' , 'rel'=>'1' , 'isDone' => '1' ,'skey' => (Session::get('last_insert_id') != null)? Session::get('last_insert_id') : $last_insert_id  ])

<!-- set For step : End  -->

		<fieldset>
			<legend>Reward</legend>	
			<div class="form-group">
			
			<div class="form-group @if ($errors->has('pledge_amount')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Pledge amount ($)
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_amount" placeholder="Enter pledge amount" name="pledge_amount[]" value="">
			</div>
			 
			</div>			

			<div class="form-group @if ($errors->has('short_note')) has-error @endif">
			<label for="short_note" class="col-sm-2 control-label">
			Short Description
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="short_note[]" placeholder="Default Text" id="short_note" rows="8"></textarea>
			</div>
			</div>

			<div class="form-group @if ($errors->has('user_limit')) has-error @endif">
			<label for="user_limit" class="col-sm-2 control-label">
			Pledge max user limit 
			</label>
			<div class="col-sm-9">
			<input type="number" class="form-control" id="user_limit" placeholder="Enter max user limit" name="user_limit[]" value="">
			</div>
			</div>			
			
			<div class="form-group @if ($errors->has('dob')) has-error @endif">
			<label for="dob" class="col-sm-2 control-label">
			Estimated delivery date
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-2">
				 <select name="delevery_month[]" id="delevery_month" class="form-control">
					 <option value="" > - Month - </option>
					 <?php for($vmon=1; $vmon<=12; $vmon++ ) { ?>
					 <option value="<?php echo $vmon; ?>" ><?php echo $vmon; ?></option>
					 <?php } ?> 
			 	 </select>		
			</div> 
			<div class="col-sm-2">
				 <select name="delevery_year[]" id="delevery_year" class="form-control">
					 <option value="" > - Year - </option>
					 <?php for($vyr=2015; $vyr<=2020; $vyr++ ) { ?>
					 <option value="<?php echo $vyr; ?>" ><?php echo $vyr; ?></option>
					 <?php } ?> 					 
			 	 </select>			 	 	
			</div>  
			</div>		
			
				

			<div class="form-group @if ($errors->has('username')) has-error @endif">
				<label for="form-field-2" class="col-sm-2 control-label">
				Upload Image
				<span class="symbol required"></span>
				</label>
				<div class="col-sm-9"> 
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="input-group">
						<div class="form-control uneditable-input">
							<i class="fa fa-file fileupload-exists"></i>
							<span class="fileupload-preview"></span>
						</div>
						<div class="input-group-btn">
							<div class="btn btn-light-grey btn-file">
								<span class="fileupload-new"><i class="fa fa-folder-open-o"></i> Select file</span>
								<span class="fileupload-exists"><i class="fa fa-folder-open-o"></i> Change</span>
								<input type="file" class="file-input" name="file_attachment[]">
							</div>
							<a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
								<i class="fa fa-times"></i> Remove
							</a>
						</div>
					</div>
					<p class="help-block">
					Only jpg , png , gif support
					</p>			
				</div>	 
				</div>
			</div>					
			
			
			

			<div class="form-group @if ($errors->has('pledge_amount')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Shipping and Delivery details
			<span class="symbol required"></span>
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="shipping_details" placeholder="Shipping and Delivery details" name="shipping_details[]" value="">
			<span class="help-block"><i class="fa fa-info-circle"></i> Additional information related shipping or other stuffs</span>
			</div>
			</div>	

		</div>


		<div class="form-group hide" id="bookTemplate">
	
			<div class="form-group @if ($errors->has('pledge_amount')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Pledge amount ($) 
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="pledge_amount" placeholder="Enter your valid address" name="pledge_amount[]" value="">
			</div>
			<div class="col-sm-1">
			<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
			</div>	
			</div>			
			
			
			
			
			
			
			
			<div class="form-group @if ($errors->has('short_note')) has-error @endif">
			<label for="short_note" class="col-sm-2 control-label">
			Short Description 
			</label>
			<div class="col-sm-9">
			<textarea class="form-control" name="short_note[]" placeholder="Default Text" id="short_note" rows="8"></textarea>
			</div>
			</div>
			
			
			<div class="form-group @if ($errors->has('user_limit')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Pledge max user limit 
			</label>
			<div class="col-sm-9">
			<input type="number" class="form-control" id="user_limit" placeholder="Pledge max user limit" name="user_limit[]" value="">
			</div>
			</div>			
			
			
			<div class="form-group @if ($errors->has('dob')) has-error @endif">
			<label for="dob" class="col-sm-2 control-label">
			Estimated delivery date
			</label>
			<div class="col-sm-2">
				 <select name="delevery_month[]" id="delevery_month" class="form-control">
					 <option value="" > - Month - </option>
					 <?php for($vmon=1; $vmon<=12; $vmon++ ) { ?>
					 <option value="<?php echo $vmon; ?>" ><?php echo $vmon; ?></option>
					 <?php } ?> 
			 	 </select>		
			</div> 
			<div class="col-sm-2">
				 <select name="delevery_year[]" id="delevery_year" class="form-control">
					 <option value="" > - Year - </option>
					 <?php for($vyr=2015; $vyr<=2020; $vyr++ ) { ?>
					 <option value="<?php echo $vyr; ?>" ><?php echo $vyr; ?></option>
					 <?php } ?> 					 
			 	 </select>			 	 	
			</div>  
			</div>		
			
				

			<div class="form-group @if ($errors->has('username')) has-error @endif">
				<label for="form-field-2" class="col-sm-2 control-label">
				Upload Image
				</label>
				<div class="col-sm-9"> 
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="input-group">
						<div class="form-control uneditable-input">
							<i class="fa fa-file fileupload-exists"></i>
							<span class="fileupload-preview"></span>
						</div>
						<div class="input-group-btn">
							<div class="btn btn-light-grey btn-file">
								<span class="fileupload-new"><i class="fa fa-folder-open-o"></i> Select file</span>
								<span class="fileupload-exists"><i class="fa fa-folder-open-o"></i> Change</span>
								<input type="file" class="file-input" name="file_attachment[]">
							</div>
							<a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
								<i class="fa fa-times"></i> Remove
							</a>
						</div>
					</div>
					<p class="help-block">
					Only jpg , png , gif support
					</p>			
				</div>	 
				</div>
			</div>	
			
		


			<div class="form-group @if ($errors->has('shipping_details')) has-error @endif">
			<label for="website" class="col-sm-2 control-label">
			Shipping and Delivery details
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="shipping_details[]" placeholder="Shipping and Delivery details" name="shipping_details[]" value="">
			<span class="help-block"><i class="fa fa-info-circle"></i> Additional information related shipping or other stuffs</span>
			</div>
			</div>	

		</div>
		</fieldset>									

		<div class="form-group">
		<div class="row">
		<div class="col-sm-11">
		<button type="button" class="btn btn-orange addButton pull-right" name="submit" value="add-user-form">Add New</button>
		</div>
		</div>
		</div>			


		<fieldset>
		<legend>&nbsp;</legend>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">	
			<button type="button" class="btn btn-orange" name="submit-btn" id="back-step-2" value="2" data-token="{{ csrf_token() }}" >Back</button>			
			<button type="submit" class="btn btn-orange" name="submit" value="add-user-form">Next</button>							
			</div>
			</div>										
		</fieldset>


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
