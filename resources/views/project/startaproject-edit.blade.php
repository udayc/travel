 @extends('app' )



@section('content')

 


<!-- inner page area start -->

<!-- rgstrtn_start_project_step -->

<div class="innrPgArea registration">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      
      <h4><img src="/images/start-project-icon.png" alt="" border="0">Start Project</h4>
      
      <!-- menu open -->
        <div class="Resgister_Dash_menu">
          <ul>
            <li><a href="#" class="actvMenu">Basic</a></li>
            <li><a href="#">Project Details</a></li>
            <li><a href="#">Rewards</a></li> 
            <li><a href="#">Payout</a></li>
            <li><a href="#">Confirmation</a></li>
          </ul>
        </div>
        <!-- menu closed -->
        
        <form enctype="multipart/form-data" accept-charset="UTF-8" class="form-horizontal" role="form" name="addproject" action="/project/updateproject" method="POST" id="vnvnvnvbn">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="step" value="1">     
        <input name="_secret_key_"  type="hidden" value="<?php echo $last_insert_id; ?>">   
        <!-- form box open -->
        <div class="formBox">
        <h3>Basic Info</h3>
            
          <div class="row formArea wow fadeInLeft">
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Name</span><span class="star">*</span></label> 
          <input type="text" class="form-control" id="name" placeholder="Enter project name" name="name"  value="{{ isset($projectdet->name) ? $projectdet->name : ''}}" <?php if($projectdet->active == 1){ ?> readonly="" <?php } ?>   >
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Select Genre</span><span class="star">*</span></label> 
          {!! Form::select('project_genre_id', $genres , (empty($projectdet) ? null : $projectdet->project_genre_id)  ,  array('class' => 'form-control')) !!}  
          </div>

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Project Category</span><span class="star">*</span></label>
          {!! Form::select('P_CAT_ID', $categories , (empty($projectdet) ? null : $projectdet->P_CAT_ID)  ,  array('class' => 'form-control')) !!}
          </div>          
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Short description</span><span class="star">*</span></label>
          <textarea class="form-control" name="short_description" placeholder="Enter Short Description" id="short_description" rows="8">{{ isset($projectdet->short_description) ? $projectdet->short_description : ''}}</textarea>
          <p>This text will be used on share and RSS feeds.</p>
          </div>

          <div class="col-lg-12 col-xs-12 formFldArea marginBottom0">
          <label><span>Upload Pitch Video</span> </label>
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
                          <input type="file" class="file-input" name="pitch_video">
                        </div>
                        <a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
                          <i class="fa fa-times"></i> Remove
                        </a>
                      </div>
                    </div> 
                    <p>
                    This video will be uploaded through YouTube channel[<a href="<?php echo url(); ?>/images/file-attached-to-project/video/<?php echo $projectdet->pitch_video;  ?>" target="_blank" >View File</a>]
                    </p>    
                  </div>  
              </div> 

          <div class="col-lg-12 col-xs-12 formFldArea marginBottom0">
          <label><span>Upload Image</span> </label>
          </div>
          <div class="col-lg-12 col-xs-12 formFldArea">
               <div class="fileupload fileupload-new" data-provides="fileupload"> 
                <div class="fileupload-new thumbnail" style="width: 350px; height: 160px;"><img src="<?php echo url(); ?>/images/file-attached-to-project/resize/<?php echo $projectdet->file_attachment;  ?>" border="0"  width="350" > 
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 160px; line-height: 20px;"></div> 
                <div>
                    <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                     <input type="file" name="file_attachment" id="file_attachment"  >
                    </span>
                    <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                        <i class="fa fa-times"></i> Remove
                    </a>
                </div> 
              </div> 
          </div>  
          </div>
          
        </div>
        <!-- form box closed -->
        
        <!-- form box open -->
        <div class="formBox">
      <h3>Funding</h3>
            
          <div class="row formArea wow fadeInRight">
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Currency Type</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="currencytype" placeholder="Currency Type" name="currencytype" 
      value="{{  $_settings_data->currency }}" readonly=""  >  
          <p>This value comming from system settings.</p>
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Goal Amount</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="funding_goal" placeholder="Enter funding goal amount" name="funding_goal" value="{{ isset($projectdet->funding_goal) ? $projectdet->funding_goal : ''}}" 
          <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?>  >
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><input  type="checkbox"  name="allow_overfunding" id="allow_overfunding" checked {{ isset($projectdet->allow_overfunding) ? 'checked' : ''}} <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?>   ><span>ALLOW OVERFUNDING</span></label>
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Project Duration (Days)</span><span class="star">*</span></label>
          <input type="number" class="form-control" id="project_duration" placeholder="Project duration" name="project_duration" value="{{ isset($projectdet->project_duration) ? $projectdet->project_duration : ''}}" min="30" max="{{ $_settings_data->max_project_end_date }}" <?php if($projectdet->active == 1){ ?>readonly=""<?php } ?>  > 
          </div>       
          
          </div>
          
        </div>


        <div class="formBox">
        <h3>Websites</h3>
            
          <div class="row formArea wow fadeInRight">
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Facebook URL</span></label>
          <input type="url" class="form-control" id="facebook_url" placeholder="Enter facebook url" name="facebook_url" value="{{ isset($projectdet->facebook_url) ? $projectdet->facebook_url : ''}}" >
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Twitter URL</span></label>
          <input type="url" class="form-control" id="twitter_url" placeholder="Enter twitter url" name="twitter_url" value="{{ isset($projectdet->twitter_url) ? $projectdet->twitter_url : ''}}" >
          </div>

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Instagram URL</span></label>
          <input type="url" class="form-control" id="instagram_url" placeholder="Enter linkedIn url" name="instagram_url" value="{{ isset($projectdet->instagram_url) ? $projectdet->instagram_url : ''}}" >
          </div>

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Youtube URL</span></label>
          <input type="url" class="form-control" id="youtube_url" placeholder="Enter Youtube url " name="youtube_url" value="{{ isset($projectdet->youtube_url) ? $projectdet->youtube_url : ''}}" >
          </div>     

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>SoundCloud URL</span></label>
          <input type="url" class="form-control" id="soundcloud_url" placeholder="Enter SoundCloud url" name="soundcloud_url" value="{{ isset($projectdet->soundcloud_url) ? $projectdet->soundcloud_url : ''}}" >
          </div>                           
          
          </div>
          
        </div>



        <!-- form box closed -->
        
        <!-- button area open -->
        <div class="step_button_area">
        <input name="submit" type="submit" class="btn btn-warning MidButton wow fadeInRight" value="CONTINUE">
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
<link rel="stylesheet" href="/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css"> 
@stop



@section('scripts')

<!-- datepicker script --> 
    <script src="/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
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
    <script src="/plugins/summernote/build/summernote.min.js"></script>
    <script src="/plugins/ckeditor/ckeditor.js"></script>
    <script src="/plugins/ckeditor/adapters/jquery.js"></script>
    <script src="/js/form-validation.js"></script>
    <!-- end: FORM VALIDATION CODE START -->

<script>
 
    $(function(){  
        Main.init();
        FormValidator.init(); 
    });
</script> 
 
@endsection
