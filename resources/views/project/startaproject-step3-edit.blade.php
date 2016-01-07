@extends('app' )



@section('content')
 
<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      
      <h4><img src="/images/start-project-icon.png" alt="" border="0">Start Project</h4>
      
      <!-- menu open -->
        <div class="Resgister_Dash_menu">
          <ul>
            <li><a href="#" >Basic</a></li>
            <li><a href="#" >Project Details</a></li>
            <li><a href="#" class="actvMenu">Rewards</a></li> 
            <li><a href="#">Payout</a></li>
            <li><a href="#">Confirmation</a></li>
          </ul>
        </div>
        <!-- menu closed -->
<?php
$totalRecod=count($rewardlist);
$dynamiccount=($totalRecod - 1);
?> 		
		
	
        
<form class="form-horizontal" role="form" name="addprojectthirde" id="addprojectthirde"  action="/project/updateproject"  enctype="multipart/form-data" accept-charset="UTF-8" method="POST"  >
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="reward_row_count" id="reward_row_count" value="<?php echo  $dynamiccount ; ?>"/>
<input type="hidden" name="past_row_count" id="past_row_count" value="<?php echo $dynamiccount?>"/>
<input type="hidden" name="step" value="3">       
<input name="_secret_key_"   id="projectid"  type="hidden" value="<?php echo $last_insert_id;  ?>">
 
		<!-- form box open -->
		<div class="formBox marginBottom0">
		<h3>Reward</h3>
		<?php 
		if(is_array($rewardlist) && count($rewardlist)>0) { 
		$counter=0;
		foreach($rewardlist as $kyy=>$rewardval){ 
		$counter++;
		?>           
            
          <div class="row formArea">          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Pledge amount ({{  $_settings_data->currency }})</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="pledge_amount" placeholder="Enter pledge amount" name="pledge_amount[]" value="<?php echo $rewardval['project_pledge_amount']; ?>" <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?> >
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Short Description</span><span class="star">*</span></label>
          <textarea class="form-control" name="short_note[]" placeholder="Default Text" id="short_note" rows="8" <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?>><?php echo $rewardval['short_note']; ?></textarea>
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Pledge max user limit</span><span class="star">*</span></label>
          <input type="number" class="form-control" id="user_limit" placeholder="Enter max user limit" name="user_limit[]" value="<?php echo $rewardval['user_limit']; ?>" <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?> >
          </div>

                  
 
          <div class="col-lg-12 col-xs-12 formFldArea formTextAlignLeft">
          <label><span>Estimated delivery date</span><span class="star">*</span></label>
          <div class="qutrFld">
               <select name="delevery_month[]" id="delevery_month" class="form-control" <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?>>
                 <option value="" > - Month - </option>
                 <?php for($vmon=1; $vmon<=12; $vmon++ ) { ?>
                 <option value="<?php echo $vmon; ?>" <?php if( $vmon == $rewardval['delevery_month'] ){ echo "selected";} ?> ><?php echo $vmon; ?></option>
                 <?php } ?> 
               </select>  
          </div>
          <div class="qutrFld">  
			{!! Form::select('delevery_year[]', ['2015'=>'2015', '2016'=>'2016' , '2017'=>'2017' , '2018'=>'2018' , '2019'=>'2019'], (empty($rewardval['delevery_year']) ? null : $rewardval['delevery_year']) , array('class' => 'form-control' , 'id'=> 'delevery_year' , 'required' => 'required'))  !!}	 
          </div>
          
          </div>

          <div class="col-lg-12 col-xs-12 formFldArea marginBottom0">
          <label><span>Upload Image</span><span class="star">*</span></label>
          </div>   

          <div class="col-lg-12 col-xs-12 formFldArea">

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
          

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Shipping and Delivery details</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="shipping_details" placeholder="Shipping and Delivery details" name="shipping_details[]" value="<?php echo $rewardval['shipping_details']; ?>" <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?> >
          <p>Additional information related shipping or other stuffs</p>
          </div>   

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label class="checkbox-inline"><span>Reward active status</span><span class="star">*</span></label>
          <table class="table table-condensed table-hover" > 
              <thead>
              <tr>
                <th style="border: 0px;">
				<div class="make-switch" data-on="info" data-off="success"  id="mySwitch_<?php echo $rewardval['id'];  ?>" >
				<input class="grey" type="checkbox" <?php if($rewardval['active']=='1') { ?> checked <?php } ?>  />
				</div>
                </th> 
              </tr>
              </thead>                      
          </table>
          </div>  

          </div> 
          <input type="hidden" name="editid[]" value="<?php echo $rewardval['id']; ?>" />
        <?php
        }
        }
        ?>


        </div>


          <!--<div  class="form-group hide" id="bookTemplate" >-->
          <div class="formBox marginBottom0 bottomseparation hide" id="bookTemplate">
          
            
          <div class="row formArea">
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Pledge amount ({{  $_settings_data->currency }})</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="pledge_amount" placeholder="Enter pledge amount" name="pledge_amount[]" value="">
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Short Description</span><span class="star">*</span></label>
          <textarea class="form-control" name="short_note[]" placeholder="Default Text" id="short_note" rows="8"></textarea>
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Pledge max user limit</span><span class="star">*</span></label>
          <input type="number" class="form-control" id="user_limit" placeholder="Enter max user limit" name="user_limit[]" value="">
          </div>

                  
 
          <div class="col-lg-12 col-xs-12 formFldArea formTextAlignLeft">
          <label><span>Estimated delivery date</span><span class="star">*</span></label>
          <div class="qutrFld">
               <select name="delevery_month[]" id="delevery_month" class="form-control">
                 <option value="" > - Month - </option>
                 <?php for($vmon=1; $vmon<=12; $vmon++ ) { ?>
                 <option value="<?php echo $vmon; ?>" ><?php echo $vmon; ?></option>
                 <?php } ?> 
               </select>  
          </div>
          <div class="qutrFld">
               <select name="delevery_year[]" id="delevery_year" class="form-control">
                 <option value="" > - Year - </option>
                 <?php for($vyr=2015; $vyr<=2020; $vyr++ ) { ?>
                 <option value="<?php echo $vyr; ?>" ><?php echo $vyr; ?></option>
                 <?php } ?>            
               </select>  
          </div>
          
          </div>

          <div class="col-lg-12 col-xs-12 formFldArea marginBottom0">
          <label><span>Upload Image</span><span class="star">*</span></label>
          </div>   

          <div class="col-lg-12 col-xs-12 formFldArea">
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
                <p>
                Only jpg , png , gif support
                </p>      
              </div>  
          </div>      

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Shipping and Delivery details</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="shipping_details" placeholder="Shipping and Delivery details" name="shipping_details[]" value="">
          <p>Additional information related shipping or other stuffs</p>
          </div>  
          </div>
      </div>
    <!--</div>-->



        <div class="formBox paddindtopNONE">
        <div class="row formArea wow fadeInRight">
        <input name="" type="button" class="btn addButton btn-orange pull-right" value="ADD NEW">
        </div>
        </div>


 
        
        <!-- button area open -->

        <div class="step_button_area"> 
          <button type="button" class="btn btn-default MidgrayButton wow fadeInLeft" name="submit-btn" id="back-step-26" value="2" data-token="{{ csrf_token() }}" >BACK</button>      
          <input name="" type="submit" class="btn btn-warning MidButton wow fadeInRight" value="NEXT">
        </div>

        <!-- button area closeed-->
        
        
        </form> 
 
        
         </div>
    </div>
  </div>
</div>
<!-- inner page area closed --> 
@endsection

@section('styles') 
<link rel="stylesheet" href="/plugins/select2/select2.css">
<link rel="stylesheet" href="/plugins/datepicker/css/datepicker.css">
<link rel="stylesheet" href="/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
<link rel="stylesheet" href="/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
<link rel="stylesheet" href="/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
<link rel="stylesheet" href="/plugins/summernote/build/summernote.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  
@stop

@section('scripts')
<!-- datepicker script --> 
    <script src="/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script> 
    <script src="/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
    <script src="/plugins/blockUI/jquery.blockUI.js"></script>
    <script src="/plugins/iCheck/jquery.icheck.min.js"></script>
    <script src="/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
    <script src="/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
    <script src="/plugins/less/less-1.5.0.min.js"></script>
    <script src="/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
    <script src="/js/main.js"></script>
 

    <!-- start: FORM VALIDATION CODE START -->
    <script src="/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script src="/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
    <script src="/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
    <script src="/js/ui-customs.js"></script>
    <script src="/js/step3-edit-validation.js"></script>
        
    <!-- end: FORM VALIDATION CODE START -->
<script> 
    $(function(){  
       // Main.init();
        RewordValidator.init();  
        UICustoms.init();
        
        bookIndex = <?php echo  count($rewardlist) ; ?> ; 
       $('#addprojectthirde') 
        .on('click', '.addButton', function() {
            bookIndex++;
            var $template = $('#bookTemplate'),
            $clone    = $template
                                .clone(true, true)
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-book-index', bookIndex)         
                                .insertBefore($template);

            document.getElementById('reward_row_count').value = bookIndex; 
        })  

    <?php 
      if(is_array($rewardlist) && count($rewardlist)>0) 
      {  
        foreach($rewardlist as $kyy=>$rewardnval)
        { 
          $cpid=$rewardnval['id'];
    ?>    
            jQuery('#mySwitch_<?php echo $cpid  ?>').click( function (e, data) {
             
                $.ajax({    
                type:'GET',
                url:base_url+'/project/changepresentstatus/'+<?php echo $cpid; ?>,
                success:function(jData){
                   
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                $(".err").html("<div>Error.</div>");
                }
                });

            });   
      <?php
        }
      }
      ?>


    }); 
</script> 
@endsection
