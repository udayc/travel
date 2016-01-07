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
            <li><a href="#" class="actvMenu" >Project Details</a></li>
            <li><a href="#">Rewards</a></li> 
            <li><a href="#">Payout</a></li>
            <li><a href="#">Confirmation</a></li>
          </ul>
        </div>
        <!-- menu closed -->
        
        <form enctype="multipart/form-data" accept-charset="UTF-8" class="form-horizontal" role="form" name="addprojectsec" action="/project/store" method="POST" id="addprojectsec">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <input type="hidden" name="step" value="2">
         <input type="hidden" name="_secret_key_"  id="projectid" value="<?php echo $last_insert_id;  ?>">

 

        <!-- form box open -->
        <div class="formBox">
        <h3>Project Details</h3>
            
          <div class="row formArea wow fadeInLeft">  
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label class="Floatnone"><span>Project Details</span><span class="star">*</span></label>
          <div class="textareapart">
          <textarea class="form-control" name="details_description" placeholder="Default Text" id="details_description" rows="8">{{ isset($projectdet->details_description) ? $projectdet->details_description : ''}}</textarea>
          </div>
          </div>  
          </div> 
        </div>
        <!-- form box closed -->
        
        <!-- form box open -->
        <div class="formBox">
      <h3>Location</h3>
            
          <div class="row formArea wow fadeInRight">
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Country</span><span class="star">*</span></label>
          {!! Form::select('country_id', $countries , (empty($projectdet) ? null : $projectdet->country_id) , array('class' => 'form-control', 'id' => 'country_id'    ))  !!}
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>City</span><span class="star">*</span></label>
                <select name="city" id="cities" class="form-control"  required="required" >
                </select>
          </div>
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>State</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="state" placeholder="Enter state" name="state" value="{{ isset($projectdet->state) ? $projectdet->state : ''}}">
          </div>

          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Address</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="address" placeholder="Enter your valid address" name="address" value="{{ isset($projectdet->address) ? $projectdet->address : ''}}">
          </div>                   
 
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Address(Optional)</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="address_alternate" placeholder="Enter your alternate address" name="address_alternate" value="{{ isset($projectdet->address_alternate) ? $projectdet->address_alternate : ''}}">
          </div>   

         <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Pincode</span><span class="star">*</span></label>
          <input type="text" class="form-control" id="pincode" placeholder="Enter pin code" name="pincode" 
        value="{{ isset($projectdet->pincode) ? $projectdet->pincode : ''}}">
          </div>  
          </div>
          
        </div>


        <div class="formBox">
        <h3>Project Updates</h3>
            
          <div class="row formArea wow fadeInRight">
          
          <div class="col-lg-12 col-xs-12 formFldArea">
          <label><span>Feed URL</span></label>
          <input type="text" class="form-control" id="feed_url" placeholder="Enter feed_url" name="feed_url"  value="{{ isset($projectdet->feed_url) ? $projectdet->feed_url : ''}} ">
          <p>Automatically fetch update from the given feed url.</p>
          </div>         
          
          </div>
          
        </div>
 
        <!-- form box closed -->
        
        <!-- button area open -->
        <div class="step_button_area"> 
        <button type="button" class="btn btn-default MidgrayButton wow fadeInLeft" name="submit-btn" id="back-step-24" value="1" data-token="{{ csrf_token() }}" >BACK</button>
        <input name="" type="submit" class="btn btn-warning MidButton wow fadeInRight" value="CONTINUE">
        </div>
        <!-- button area closeed-->
        
        
        </form> 
 
        
         </div>
    </div>
  </div>
</div>
<!-- inner page area closed --> 
@endsection

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
    <script src="/js/ui-customs.js"></script>
    <script src="/js/form-validation.js"></script>
    <!-- end: FORM VALIDATION CODE START -->
<script type="text/javascript">   
    var editor =
      CKEDITOR.replace( 'details_description', {
            toolbar: 'Page' 
      }); 
</script>
<script>
 
    $(function(){  
        Main.init();
        FormValidator.init(); 
        UICustoms.init();

        $("select#country_id").change(function(){  
              var selectedCountry = $("#country_id").val(); 

              if(selectedCountry !='' )
              {
                $.ajax({
                    type: "GET",  
                    url:base_url+'/project/citylist/'+selectedCountry,
                    dataType: 'json'
                }).done(function(cities){ 
                     $("#cities > option").remove(); 
                     $.each(cities,function(city_id,city)  {  
                              var opt = $('<option />');  
                              opt.val(city.cityID);
                              opt.text(city.cityName);
                              $('#cities').append(opt);  
                          }); 
                    /*$("#response").html(data); */  
                });
            }
            else
            { 
              $("#cities > option").remove(); 
            } 
          });

    });
</script> 

@endsection
