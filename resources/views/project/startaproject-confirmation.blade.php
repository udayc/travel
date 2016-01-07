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
            <li><a href="#" >Rewards</a></li> 
            <li><a href="#" >Payout</a></li>
            <li><a href="#" class="actvMenu" >Confirmation</a></li>
          </ul>
        </div>
        <!-- menu closed -->
 
 
        <!-- form box open -->
        <div class="formBox marginBottom0">
          <h3>Confirmation</h3>
            
          <div class="row formArea">
          
    <fieldset> 

    

        <div class="alert alert-block alert-success fade in">       
        <h4 class="alert-heading"><i class="fa fa-check-circle"></i> Success!</h4>
        <p>        Project creation is done successfully.        </p>

        <?php if( $projectdet->active == 0 ) { ?>
            <p>The project is now saved as draft format.    <a href="{{ URL::to('/home/project-posted')}}" class="btn btn-warning">Continue</a>    </p>
        <?php } ?>
        
        <p>&nbsp;</p>
        <p> 
        <?php if( $projectdet->active == 0 ) { ?>
                <a href="/project/submitapprocal/<?php echo base64_encode($projectdet->id); ?>" class="btn btn-default MidgrayButton btnCustomStyle">Submit for approval</a>
        <?php } ?>
        <a href="{{ URL::to('/project/preview/?p='.$projectdet->id)}}" class="btn btn-success">Share this preview</a>
        
        </p>


        </div>    

    </fieldset> 
          
          </div> 
        </div>
 
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
       // Main.init();
        FormValidator.init();  
        bookIndex = 0;
       $('#addprojectthird') 
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
    }); 
</script> 
@endsection
