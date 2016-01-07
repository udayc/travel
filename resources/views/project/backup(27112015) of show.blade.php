@extends('app')

@section('content')
<?php 
$endData = $post->funding_end_date;
$now = date("Y-m-d");
$date1 = new DateTime($endData );
$date2 = new DateTime($now);
$diff = $date2->diff($date1)->format("%a");  
?>  





<div class="innrPgArea project-Detail wow fadeInUp">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>{!! $post->name !!}<br>
          <span>by {{ $post->user()->first()->name }}</span></h3>
      </div>
    </div>
  </div>

  

  <div class="detailBox">
  
  <div class="container">
    <div class="row">

      <div class="col-md-7 col-sm-7 paddindLftNONE wow fadeInLeft">
        <div class="project-detail-big-pic">    
    <iframe width="670" height="516" src="https://www.youtube.com/embed/wPT-YdNLxCs" frameborder="0" allowfullscreen></iframe>
    
    </div> 
	<div class="project-detail-subTxt">{!! $post->short_description !!}</div>

	<span class="ProDtl-location-btn">{!! $post->city !!}</span>
	<span class="ProDtl-location-btn">{{ $post->category->name or null}}</span>
	<div class="detail-social-area">
	<span>Share this project</span>
	<ul>
	<li><a href="javascript:void(0)" onclick="recmedia('{{ $post->id }}', '{{ $post->facebook_url }}')" ><img src="/images/frontend/fb-small-icon.png" alt="" border="0"></a></li>
	<li><a  href="javascript:void(0)" onclick="recmedia('{{ $post->id }}', '{{ $post->twitter_url }}')" ><img src="/images/frontend/twitter-small-icon.png" alt="" border="0"></a></li>
	<li><a href="javascript:void(0)" onclick="recmedia('{{ $post->id }}', '{{ $post->facebook_url }}')" ><img src="/images/frontend/pinterest-small-icon.png" alt="" border="0"></a></li>
	</ul>
	</div>

	</div>
   
    
   
	<div class="col-md-5 col-sm-5 paddindrgtNONE wow fadeInRight PrjDtlArea">
	<div class="detailBoxKnobArea">
	<input class="knob2" data-width="100%" value="{{ $_pof }}" data-fgColor="#01a9b0" data-thickness=".2" readonly>
	<span class="rngTxt">Project Started</span></div>

	<div class="KnbtxtAreaUl">
	<ul>
	<li><span>{{$_pof }}</span> funded</li>
	<li><span>{{ $_total_backers_on_project or 0}}</span> backers</li>
	<li><span>${{ number_format($_total_pledge_amount, 0, '.', ',')  }}</span> pledged of ${{ number_format($post->funding_goal, 0, '.', ',')  }} goal</li>
	<li>@if( $diff > 0) <span>{{ $diff }}</span>  days to go @endif</li>
	</ul>
	</div>
       
       
	   
	@if (Auth::guest())
	<a href="#myModal" class="btn btn-warning MidButton clear pull-left contact" data-toggle="modal" data-target="#myModal" >Contribute Now</a>		
	@else
	<a href="{{ URL::to('/project/pledge/?key='.$post->id)}}" class="btn btn-warning MidButton clear pull-left">Contribute Now</a>
	@endif 	   

    <a href="#" class="reminder_button"><img src="/images/frontend/bell.png" alt="" border="0">Remind Me</a>
       
	<div class="detailNote">
	This project will only be funded if at least £{{ number_format($post->funding_goal, 0, '.', ',')  }} is pledged by {{  date("D, M j Y, g:i A" , strtotime($post->funding_end_date)) }}.
	</div> 
       
	<a href="#myModalseefullbio"  class="customButton bio" data-toggle="modal" data-target="#myModalseefullbio" >See full bio</a>
	@if (Auth::guest())
	<a href="#myModal"  class="customButton contact" data-toggle="modal" data-target="#myModal" >Contact me</a>
	@else
	<a href="#myModalcontact"  class="customButton contact" data-toggle="modal" data-target="#myModalcontact" >Contact me</a>
	@endif      
	</div>
   
    </div>
  </div>
  
  </div>
  
  
  
 
  <div class="project-Detail_tabArea">
    <div class="container">
      <div class="row">
        <div class="col-md-12 paddingTab0">
          <div id="horizontalTab" class=" wow fadeInLeft">
            <ul>
              <li><a href="#Story">Story</a></li>
              <li><a href="#Updates">Updates (2)</a></li>
              <li><a href="#Comments">Comments (5)</a></li>
            </ul>
      <div id="Story">
      <div class="row">
      <div class="col-md-9 col-sm-8 col-xs-12 project-detail-tab-cnt-area wow fadeInLeft">
      <h4>About this project</h4>
      {!! nl2br($post->details_description) !!}
      </div>
      
      <div class="col-md-3 col-sm-4 col-xs-12 wow fadeInRight">
      <div class="project-detail-rgt-reward">
      <h4>Rewards</h4>
      @if(count($rewards) > 0 )
        @foreach($rewards as $reward)
      <div class="rewardBx">
      <h5>Pledge ${{ $reward->pledge_amount}} or more</h5>
      <p>{{ $reward->user_limit}} backers</p>
      <p>{{ $reward->short_note}}</p>
      <p>Estimated delivery:  {{ $reward->delevery_month }} / {{ $reward->delevery_year}}</p>
      </div>
        @endforeach
      @endif
      

      
      </div>
      </div>

      </div>

      </div>
            
            <div id="Updates">
              <p>Quisque sodales sodales lacus pharetra bibendum. Etiam commodo non velit ac rhoncus. Mauris euismod purus sem, ac adipiscing quam laoreet et. Praesent vulputate ornare sem vel scelerisque. Ut dictum augue non erat lacinia, sed lobortis elit gravida. Proin ante massa, ornare accumsan ultricies et, posuere sit amet magna. Praesent dignissim, enim sed malesuada luctus, arcu sapien sodales sapien, ut placerat eros nunc vel est. Donec tristique mi turpis, et sodales nibh gravida eu. Etiam odio risus, porttitor non lacus id, rhoncus tempus tortor. Curabitur tincidunt molestie turpis, ut luctus nibh sollicitudin vel. Sed vel luctus nisi, at mattis metus. Aenean ultricies dolor est, a congue ante dapibus varius. Nulla at auctor nunc. Curabitur accumsan feugiat felis ut pretium. Praesent semper semper nisi, eu cursus augue.</p>
            </div>
            
            <div id="Comments">
              <p>Mauris facilisis elit ut sem eleifend accumsan molestie sit amet dolor. Pellentesque dapibus arcu eu lorem laoreet, vitae cursus metus mattis. Nullam eget porta enim, eu rutrum magna. Duis quis tincidunt sem, sit amet faucibus magna. Integer commodo, turpis consequat fermentum egestas, leo odio posuere dui, elementum placerat eros erat id augue. Nullam at eros eget urna vestibulum malesuada vitae eu mauris. Aliquam interdum rhoncus velit, quis scelerisque leo viverra non. Suspendisse id feugiat dui. Nulla in aliquet leo. Proin vel magna sed est gravida rhoncus. Mauris lobortis condimentum nibh, vitae bibendum tortor vehicula ac. Curabitur posuere arcu eros.</p>
            </div>
            
            
          </div>
          
       
           
          <div class="faq_Area wow fadeInLeft">
          <h4>FAQ</h4>
          <p>Have a question? If the info above doesn't help, you can ask the project creator directly.</p>
          <a href="#" class="btn btn-warning MidButton pull-left">Ask a Question</a>
          <a href="#" class="btn btn-default midGrayButton pull-left grayBtnGap">Report this project</a> 
          </div>
  
          
          
        </div>
      </div>
    </div>
  </div>
   

  
</div>


<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT SEE FULL BIO MODAL OPEN >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div id="myModalseefullbio" class="modal fade bs-example-modal-lg con-new biomod" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg forms">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4>About the creator</h4>
  </div>
  <div class="">
    <div class="col-sm-12" style="margin:20px 0;">

    <div class="col-sm-3 image-part">
    <img src="/images/avtar-image/resize/<?php echo $userdetails['user_avtar']; ?>"/>
    </div>

    <div class="col-sm-9 title-part">
      
    <h2><?php echo $userdetails['f_name']; ?>&nbsp;<?php echo $userdetails['l_name']; ?>
        <span><?php echo $userdetails['city']; ?>, <?php echo $userdetails['project_country']; ?></span></h2>
  
    </div>
      
  </div>


  <div class="col-sm-12">

    <div class="col-sm-7 bio-txt">
    <p><?php echo $userdetails['about_me']; ?></p>
        <a href="#" class="btn btn-primary">See full profile</a>

        <h5>Websites</h5>
 
        <a href="<?php echo $userdetails['website']; ?>" target="_blank" ><?php echo $userdetails['website']; ?></a> 
        

    </div>
<?php $getdate = strtotime($userdetails['last_login']);  ?>
    <div class="col-sm-4 bio-rgt">
      
    <ul>
      <li><?php echo $userdetails['f_name']; ?>&nbsp;<?php echo $userdetails['l_name']; ?></li>
      <li> Last login <?php echo date("F j, Y", $getdate ); ?></li> 
      <li> <a href=""><?php echo $useraddedproj; ?> created · 0 backed </a></li> 
    </ul>
    <div class="clearfix"></div>
    <a  id="detailconme" href="javascript:void(0);" class="SmallButton" style="margin-top:20px;">Contact Me</a>
  
    </div>
      
  </div>

      </div>
      <div class="clearfix"></div>
      <div class="modal-footer"> 
      </div>
    </div>

  </div>
</div>    

<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT SEE FULL BIO MODAL CLOSE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT CONTACT MODAL OPEN >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
<div id="myModalcontact" class="modal fade bs-example con-new" tabindex="-1" role="dialog">
  <div class="modal-dialog forms">
  <div class="modal-content">

  

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4>Send a message to <?php echo $userdetails['f_name']; ?>&nbsp;<?php echo $userdetails['l_name']; ?></h4>
  </div>
<!-- <<<<<<<<<<<<<<<<<<<<<<<< contactfrom start>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div id="contactfromid">
  <div class="">
    <form name="form9" id="form9" class="form-horizontal" role="form" method="POST" action="#">
    <div class="col-sm-12 formareas">
    <div class="col-sm-12 col-xs-12 loginColumn">    
    <input type="hidden" name="_token" value="{{ csrf_token() }}">   
	<input type="hidden" name="p_id" id="p_id" value="{{ $post->id }} " />	
    <div class="userLoginBx">
    
    <div class="userLoginBxFldArea">
    <label>To : <?php echo $userdetails['f_name']; ?>&nbsp;<?php echo $userdetails['l_name']; ?> </label><textarea class="form-control" rows="5" id="contactcomment" name="contactcomment" style="height:110px;"></textarea>
    </div>
    
    
    </div>
        
    
    </div>
      
    
  </div>
      

      <div class="clearfix"></div>
      <div class="modal-footer"> 
      <p><input name="contactsub" id="contactsub" type="button"  class="SmallButton" value="Send Message" data-token="{{ csrf_token() }}"> <a   class="close bbclose" data-dismiss="modal">Cancel</a></p>
      </div>
      </form>
    </div>

</div>



<div id="contsucc" style="display: none;" >
  <div class="">
  <div class="col-sm-12 col-xs-12 formareas sendmessage" style="padding:40px; text-align:center;"> 
  <span style="color:#2bde73;">Your message has been sent to <?php echo $userdetails['f_name']; ?>&nbsp;<?php echo $userdetails['l_name']; ?>! </span> 
  </div>
  </div>
  <div class="clearfix"></div> 
</div>


<div id="loadingaj" style="display: none;" >
  <div class="">
  <div class="col-sm-12 col-xs-12 formareas sendmessage" style="padding:40px; text-align:center;"> 
  <img src="/images/ajax-loader.gif"/>
  </div>
  </div>
  <div class="clearfix"></div> 
</div>

</div>
</div>
</div>

<!-- <<<<<<<<<<<<<<<<<<<<<<<< contactfrom end>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

  </div>
</div>  

 


<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT CONTACT MODAL CLOSE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->


@endsection

@section('styles')
<link rel="stylesheet" href="/css/frontend/responsive-tabs.css" />
@endsection



@section('scripts')
<script src="/js/frontend/bootstrap-datepicker.js"></script> 
    <!-- start: FORM VALIDATION CODE START -->
    <script src="/plugins/jquery-validation/dist/jquery.validate.min.js"></script> 
    <script src="/js/form-validation.js"></script>
    <!-- end: FORM VALIDATION CODE START -->
<script>
if (top.location != location) {
      top.location.href = document.location.href ;
  }
$(function(){ 

      window.prettyPrint && prettyPrint();
      
      $('#dp1').datepicker({        format: 'dd-mm-yyyy'      });
      $('#dp2').datepicker({        format: 'dd-mm-yyyy'      });


      $("#form9").validate({
            rules: {
                "contactcomment": "required"
            },
            messages: {
                "contactcomment": "Please specify your name" 
            }  
        });   

	myApp.ajaxCotactMeHandler();

    $("#detailconme").click(function(){
       $('#myModalseefullbio').modal('hide');
	   <?php if(Auth::guest()) { ?>
			$('#myModal').modal('show'); 
	    <?php } else { ?>
			$('#myModalcontact').modal('show'); 
		<?php } ?>
    });

     


});
</script> 

<script src="/js/frontend/custom-upload-script.js"></script> 
<script src="/js/frontend/jquery.knob.js"></script> 
<script>
$(function($) { $(".knob2").knob({ format : function (value) { return value + '%'; }, }); });
</script>
<script src="/js/frontend/jquery.responsiveTabs.js" type="text/javascript"></script> 
<script type="text/javascript">
	 $(function($) {
				var $tabs = $('#horizontalTab');
				$tabs.responsiveTabs({
					rotate: false,
					startCollapsed: 'accordion',
					collapsible: 'accordion',
					setHash: true,
					//disabled: [3,4],
					activate: function(e, tab) {
						$('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
					},
					activateState: function(e, state) {
						//console.log(state);
						$('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
					}
				});
		  
	});


	function recmedia(id, url)
	{ 
		$.ajax({    
		type:'GET',
		url:base_url+'/project/updaterank/'+id,
		success:function(jData){ 
		   window.open(url, '_blank');
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
		  $(".err").html("<div>Error.</div>");
		}
		});
	}

</script>
@endsection


 
