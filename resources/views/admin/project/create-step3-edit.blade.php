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
 
 
<link rel="stylesheet" href="<?php echo url(); ?>/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css">
<?php
 /*
echo "<pre>";
print_r($rewardlist);
exit;
 */
$totalRecod=count($rewardlist);
$dynamiccount=($totalRecod - 1);
?> 

<div class="row">
<div class="col-sm-12">

<div class="panel panel-default">
<div class="panel-heading">
<span style="margin-left:-20px;"><?php if($func=="add") { ?>Add Project<?php } else { ?>Edit Project<?php } ?></span>
</div>

<div class="panel-body">

<form class="form-horizontal" id="bookFormnew" role="form" name="add_project" action="/admin/project/updateproject"  enctype="multipart/form-data" accept-charset="UTF-8"  method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="reward_row_count" id="reward_row_count" value="<?php echo $dynamiccount; ?>"/>
<input type="hidden" name="past_row_count" id="past_row_count" value="<?php echo $dynamiccount; ?>"/>
<!-- set For step --> 
@include('admin.project.partials._formstep_3' , ['class' => 'selected' , 'rel'=>'1' , 'isDone' => '1' ,'skey' => (Session::get('last_insert_id') != null)? Session::get('last_insert_id') : $last_insert_id  ])

<!-- set For step : End  -->

		<fieldset>
			<legend>Reward</legend>	
			<?php 
			if(is_array($rewardlist) && count($rewardlist)>0) 
			{ 
			$counter=0;
			foreach($rewardlist as $kyy=>$rewardval)
			{ 
				$counter++;
			?> 
				<div class="form-group rewardStep">			
					<div class="form-group @if ($errors->has('pledge_amount')) has-error @endif">
					<label for="website" class="col-sm-2 control-label">
					Pledge amount ($)
					<span class="symbol required"></span>
					</label>
					<div class="col-sm-9">
					<input type="text" class="form-control" id="pledge_amount" placeholder="Enter pledge amount" name="pledge_amount[]" value="<?php echo $rewardval['project_pledge_amount']; ?>">
					</div>
					
					</div>			

					<div class="form-group @if ($errors->has('short_note')) has-error @endif">
					<label for="short_note" class="col-sm-2 control-label">
					Short Description
					<span class="symbol required"></span>
					</label>
					<div class="col-sm-9">
					<textarea class="form-control" name="short_note[]" placeholder="Default Text" id="short_note" rows="8"><?php echo $rewardval['short_note']; ?></textarea>
					</div>
					</div>

					<div class="form-group @if ($errors->has('user_limit')) has-error @endif">
					<label for="user_limit" class="col-sm-2 control-label">
					Pledge max user limit
					<span class="symbol required"></span>
					</label>
					<div class="col-sm-9">
					<input type="number" class="form-control" id="user_limit" placeholder="Enter max user limit" name="user_limit[]" value="<?php echo $rewardval['user_limit']; ?>">
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
							 <option value="<?php echo $vmon; ?>" <?php if( $vmon == $rewardval['delevery_month'] ){ echo "selected";} ?> ><?php echo $vmon; ?></option>
							 <?php } ?> 
					 	 </select>		
					</div> 
					<div class="col-sm-2">
						 <select name="delevery_year[]" id="delevery_year" class="form-control">
							 <option value="" > - Year - </option>
							 <?php for($vyr=2015; $vyr<=2020; $vyr++ ) { ?>
							 <option value="<?php echo $vyr; ?>" <?php if( $vmon == $rewardval['delevery_year'] ){ echo "selected";} ?>><?php echo $vyr; ?></option>
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
		                <div class="fileupload-new thumbnail" style="width: 350px; height: 160px;"><img src="<?php echo url(); ?>/images/file-attached-to-project/resize/<?php echo $rewardval['reword_image'];  ?>" border="0"  width="350" > 
		                </div>
		                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 160px; line-height: 20px;"></div> 
		                <div>
		                    <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
		                     <input type="file" name="file_attachment[]" id="file_attachment"  >
		                    </span>
		                    <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
		                        <i class="fa fa-times"></i> Remove
		                    </a>
		                </div> 
		            	</div>




						</div>
					</div>						 

					<div class="form-group @if ($errors->has('pledge_amount')) has-error @endif">
					<label for="website" class="col-sm-2 control-label">
					Additional Information
					<span class="symbol required"></span>
					</label>
					<div class="col-sm-9">
					<input type="text" class="form-control" id="shipping_details" placeholder="Enter additional info" name="shipping_details[]" value="<?php echo $rewardval['shipping_details']; ?>">
					<span class="help-block"><i class="fa fa-info-circle"></i> Additional information related shipping or other stuffs</span>
					</div> 
					</div>	


					<div class="form-group @if ($errors->has('active')) has-error @endif">
					<label for="active" class="col-sm-2 control-label">
					Reward active status
					<span class="symbol required"></span>
					</label>
					<div class="col-sm-9">
						<div class="input-group" >
							<table class="table table-condensed table-hover" > 
							<thead>
							<tr>
								<th style="border: 0px"><div class="make-switch" data-on="info" data-off="success"  
								id="mySwitch_<?php echo $rewardval['id'];  ?>" ><input type="checkbox" <?php if($rewardval['active']=='1') { ?> checked <?php } ?>></div>
								</th> 
							</tr>
							</thead> 											
							</table>		 
						</div>	
					</div>
					</div>	 



				</div>
				<input type="hidden" name="editid[]" value="<?php echo $rewardval['id']; ?>" ?>
				<?php
				}
				}
				?>

		<div class="form-group hide rewardStep" id="bookTemplate"  > 
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
			<input type="number" class="form-control" id="user_limit" placeholder="Enter your valid address" name="user_limit[]" value="">
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
			Additional Information 
			</label>
			<div class="col-sm-9">
			<input type="text" class="form-control" id="shipping_details[]" placeholder="Enter your valid address" name="shipping_details[]" value="">
			<span class="help-block"><i class="fa fa-info-circle"></i> Additional information related shipping or other stuffs</span>
			</div>
			</div>
		</div>



		</fieldset>	

		 
		<div class="form-group">
		<div class="row">
		<div class="col-sm-11">
		<button type="button" class="btn btn-orange addButtonnew pull-right" name="submit" value="add-user-form">Add New</button>
		</div>
		</div>
		</div>	
		 
									

		<fieldset>
		<legend>&nbsp;</legend>
			<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">	
			<button type="button" class="btn btn-orange" name="submit-btn" id="back-step-22" value="2" data-token="{{ csrf_token() }}" >Back</button>			
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

@include('admin.project.partials._relatedfilesedit')
