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
	
		<li id="facebook_id_old">
			<a href="javascript:void(0)" onclick="share_facebook('<?php echo $post->id;?>','{{{ $post->name }}}','<?php echo Request::url();?>')" >
				<img src="/images/frontend/fb-small-icon.png" alt="" border="0">
			</a>
		</li>
		<li id="facebook_id_new" style="display:none;"><img src="/images/circle_load.gif" align="absmiddle"></li>
		<li id="twitter_id_old">
			<a onclick="share_twitter('<?php echo $post->id;?>','{{{ $post->name }}}','<?php echo urlencode(Request::url());?>')" href="javascript:void(0);" >
				<img src="/images/frontend/twitter-small-icon.png" alt="" border="0">
			</a>		
		</li>
		<li id="twitter_id_new" style="display:none;"><img src="/images/circle_load.gif" align="absmiddle"></li>
		<li id="pin_id_old"><a onclick="share_pin('<?php echo $post->id;?>','<?php echo $post->file_attachment;?>','<?php echo urlencode(Request::url());?>')" href="javascript:void(0);" ><img src="/images/frontend/pinterest-small-icon.png" alt="" border="0"></a></li>
		<li id="pin_id_new" style="display:none;"><img src="/images/circle_load.gif" align="absmiddle"></li>
		<li>
			<!--<a onclick="embed('<?php echo $post->id;?>','{{{ $post->name }}}','<?php echo urlencode(Request::url());?>')" href="javascript:void(0);" >Embed</a>-->
			<a href="#embededmodel"  class="" data-toggle="modal" data-value="" data-target="#embededmodel" >
				<img src="/images/frontend/embed_code.png" alt="" border="0"> 
			</a>
		</li>
		
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
		<a href="{{ URL::to('/project/pledge/?key='.$post->id)}}" class="btn btn-warning MidButton clear pull-left contact"  >Contribute Now</a>		
		@else
		<a href="{{ URL::to('/project/pledge/?key='.$post->id)}}" class="btn btn-warning MidButton clear pull-left">Contribute Now</a>
		@endif 	
        @if (Auth::guest())
		    <a href="#myModal"  class="reminder_button" data-toggle="modal" data-target="#myModal"><img src="{{ asset('images/frontend/bell.png') }}" alt="Reminder icon" border="0">Remind Me</a>
       @else
		<div class="reminder_button" id="reminder_loader_area">
			<img src="{{ asset('images/ajax-loader.gif') }}" alt="One Moment Please..." border="0" width="32" height="32">
		</div>
		<a href="javascript:;" class="reminder_button hidden" id="reminder_info_area">
			<img src="{{ asset('images/frontend/bell.png') }}" alt="Reminder icon" border="0" class="reminder">
			<span class="remind-text-info">Remind Me</span>
		</a>
	   @endif
       

	<div class="detailNote">
	This project will only be funded if at least £{{ number_format($post->funding_goal, 0, '.', ',')  }} is pledged by {{  date("D, M j Y " , strtotime($post->approval_live) + ($post->project_duration ) * 3600 * 24 ) }}.
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
              <li><a href="#Updates">Updates (<?php echo count($getupdatedetails); ?>)</a></li>
              <li><a href="#Comments" id="comment-count-region">Comments</a></li>
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
      <p>Estimated delivery:  {{ date("M d, Y" , strtotime($reward->estimated_delivery)) }}</p>
      </div>
        @endforeach
      @endif
      

      
      </div>
      </div>

      </div>

      </div>
		<input type="hidden" name="update_flag" id="update_flag" value="0" />
			<div id="Updates" >	
            <?php			
				if($checkprojectuser >0)
				{
			?>
            <div id="Updates_comments">				
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group">
								<label for="create-title">Title</label>
							
								<input type="text" name="create-title" id="create-title" required value=""class=" form-control" />
							</div>
							<div class="form-group">
								<label for="create-update">Message</label>
								<textarea id="create-update" class="form-control"></textarea>
							</div>
							<div class="form-group" id="sub_but">
								<label >&nbsp;</label>								
								<button id="submit-update" class="btn btn-default" onclick="post_update();">Submit</button>
							</div>
							<div class="form-group" id="update_but" style="display:none;">
								<label >&nbsp;</label>								
								<button id="save-update" class="btn btn-default" onclick="save_update();">Update</button>
								<button id="save-cancel" class="btn btn-default" onclick="cancel_update();">Cancel</button>
							</div>
							
						</div>
					</div>					
            </div>
			<?php 
				}
			?>
			<div>
			<div id="flash"></div>
			<div id="display"></div>
			
			<?php 
				$time ='';			
				if(count($getupdatedetails)>0)
				{
					foreach($getupdatedetails as $getupdatedetails)
					{					
						$time = strtotime($getupdatedetails['updated_at']);

			?>				
						<div class="update_listing" id="update_listing_<?php echo $getupdatedetails['id']; ?>">
							<div class="update_image"><img src="<?php echo url().'/images/avtar-image/'.$userdetails['user_avtar']; ?>" alt="Reminder icon" width="50" border="0" ></div>
							<div class="update_text" id="update_text_<?php echo $getupdatedetails['id']; ?>">
								<p><span><?php echo $getupdatedetails['title']; ?></span> - <?php echo \App\Http\Controllers\ProjectController::humanTiming($time);?> ago</p>
								<?php echo $getupdatedetails['description'];?>
							</div>
						</div>
						<?php			
							if($checkprojectuser >0)
							{
						?>
						<div class="action_but" id="action_but_<?php echo $getupdatedetails['id']; ?>">
							<a href="javascript:void(0);" class="edit-comment btn btn-primary" onclick="edit_update('<?php echo $getupdatedetails['title'];?>','<?php echo $getupdatedetails['description'];?>','<?php echo $getupdatedetails['id']; ?>');">Edit</a>
							<a href="javascript:void(0);" class="delete-comment btn btn-danger" onclick="delete_update(<?php echo $getupdatedetails['id'];?>);">Delete</a>
						</div>
							<?php } ?>
						<div class="clear" id="clear_<?php echo $getupdatedetails['id']; ?>"></div>
			<?php
					}
				}
			?>
			
			</div>
			</div>
            <div id="Comments">
				@if(!Auth::guest())
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group">
								<label for="create-comment">Write Your Comment</label>
								<textarea id="create-comment" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label >&nbsp;</label>
								<button id="submit-comment" class="btn btn-default">Submit</button>
							</div>
						</div>
					</div>
				@endif
				<div class="row">
					<div class="col-sm-8">
						<p class="loader"><i class="fa fa-spinner fa-spin"></i> One Moment Please...</p>
						<ul class="comments-container mCustomScrollbar" data-mcs-theme="inset-2-dark"></ul>
					</div>
				</div>
          </div>
            
            
          </div>
          
       
           
          <div class="faq_Area wow fadeInLeft">
          <h4>FAQ</h4>
          <p>Have a question? If the info above doesn't help, you can ask the project creator directly.</p>
		   @if (Auth::guest())
				<a href="#myModal"  class="btn btn-warning MidButton pull-left" data-toggle="modal" data-target="#myModal">Ask a Question</a>
			@else
				<a href="{{ url('project/ask-a-question/'. $id) }}" data-toggle="modal" data-target="#ask-a-question-modal" class="btn btn-warning MidButton pull-left">Ask a Question</a>
			@endif
			@if (Auth::guest())
				<a href="#myModal"  class="btn btn-default midGrayButton pull-left grayBtnGap" data-toggle="modal" data-target="#myModal">Report this project</a>
			@else
				<a href="{{ url('project/report-violation/'. $id) }}" class="btn btn-default midGrayButton pull-left grayBtnGap" data-toggle="modal" data-target="#report-project-violation">Report this project</a>
			@endif
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
    <img src="/images/avtar-image/resize/{{ ($userdetails ) ? $userdetails['user_avtar'] : '55.jpg'}}"/>
    </div>

    <div class="col-sm-9 title-part">
      
    <h2>{{ ($userdetails ) ? $userdetails['f_name'] : 'n/a'}}&nbsp;{{ ($userdetails ) ? $userdetails['l_name'] : 'n/a'}}
        <span>{{ ($userdetails ) ? $userdetails['city'] : 'n/a'}}, {{ ($userdetails ) ? $userdetails['project_country'] : 'n/a'}}</span></h2>
  
    </div>
      
  </div>


  <div class="col-sm-12">

    <div class="col-sm-7 bio-txt">
    <p>{{ ($userdetails ) ? $userdetails['about_me'] : 'n/a'}}</p>
        <a href="#" class="btn btn-primary">See full profile</a>

        <h5>Websites</h5>
 
        <a href="{{ ($userdetails ) ? $userdetails['website'] : 'n/a'}}" target="_blank" >{{ ($userdetails ) ? $userdetails['website'] : 'n/a'}}</a> 
        

    </div>
    <?php if($userdetails)$getdate = strtotime($userdetails['last_login']);  ?>
    <div class="col-sm-4 bio-rgt">
      
    <ul>
      <li>{{ ($userdetails ) ? $userdetails['f_name'] : 'n/a'}}&nbsp;{{ ($userdetails ) ? $userdetails['l_name'] : 'n/a'}}</li>
      <li> Last login <?php if($userdetails)echo date("F j, Y", $getdate ); ?></li> 
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
    <h4>Send a message to {{ ($userdetails ) ? $userdetails['f_name'] : 'n/a'}}&nbsp;{{ ($userdetails ) ? $userdetails['l_name'] : 'n/a'}}</h4>
  </div>
<!-- <<<<<<<<<<<<<<<<<<<<<<<< contactfrom start>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div id="contactfromid">
  <div class="">
    <form name="form9" id="form9" class="form-horizontal" role="form" method="POST" action="#">
    <div class="col-sm-12 formareas">
    <div class="col-sm-12 col-xs-12 loginColumn">
    
    <input type="hidden" name="_token" value="{{ csrf_token() }}">    
    <div class="userLoginBx">
    
    <div class="userLoginBxFldArea">
    <label>To : {{ ($userdetails ) ? $userdetails['f_name'] : 'n/a'}}&nbsp;{{ ($userdetails ) ? $userdetails['l_name'] : 'n/a'}} </label><textarea class="form-control" rows="5" id="contactcomment" name="contactcomment" style="height:110px;"></textarea>
    </div>
    
    
    </div>
        
    
    </div>
      
    
  </div>
      

      <div class="clearfix"></div>
      <div class="modal-footer"> 
      <p><input name="contactsub" id="contactsub" type="button"  class="SmallButton" value="Send Message">  <a   class="close bbclose" data-dismiss="modal">Cancel</a></p>
      </div>
      </form>
    </div>

</div>



<div id="contsucc" style="display: none;" >
  <div class="">
  <div class="col-sm-12 col-xs-12 formareas sendmessage" style="padding:40px; text-align:center;"> 
  <span style="color:#2bde73;">Your message has been sent to {{ ($userdetails ) ? $userdetails['f_name'] : 'n/a'}}&nbsp;{{ ($userdetails ) ? $userdetails['l_name'] : 'n/a'}}! </span> 
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

 <!-- ask a question modal -->

<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT SEE FULL BIO MODAL OPEN >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div id="ask-a-question-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content"></div>
  </div>
</div> 


<div id="report-project-violation" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content"></div>
  </div>
</div> 


<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT CONTACT MODAL CLOSE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->


<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT EMBEDED CODE  MODAL CLOSE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

<div id="embededmodel" class="modal fade bs-example-modal-lg con-new biomod" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg forms" id="embed_model">
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4>Embeded Code</h4>
  </div>
  <div class="">
    <div class="col-sm-12" style="margin:20px 0;">
		<div class="input textarea">
			<textarea rows="6" cols="30" style="width:560px;" readonly="readonly" id="embed_url" onclick="select_all('embed_url')" class="span14 clipboard"">&lt;iframe src="<?php echo url() ?>/project/widget/<?php echo $post->id; ?>/<?php echo $slug; ?>" width="536" height="650" frameborder = "0" scrolling="no"&gt;&lt;/iframe&gt;</textarea>
		</div>
    </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer"> 
      </div>
    </div>

  </div>
</div>    

<!-- <<<<<<<<<<<<<<<<<<<<<<<< PROJECT  EMBEDED CODE MODAL CLOSE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->


@endsection

@section('styles')
<link rel="stylesheet" href="/css/frontend/responsive-tabs.css" />
<link rel="stylesheet" href="{{ asset('plugins/scrollbar/jquery.mCustomScrollbar.min.css') }}">
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
      
      $('#dp1').datepicker({
        format: 'dd-mm-yyyy'
      });
      $('#dp2').datepicker({
        format: 'dd-mm-yyyy'
      });


      $("#form9").validate({
            rules: {
                "contactcomment": "required"
            },
            messages: {
                "contactcomment": "Please specify your name" 
            }  
        });   

      $("#contactsub").click(function() { 
        var validation = $("#form9").valid(); 
        var msg = $('#contactcomment').val();

        if(validation)
        {
            $("#contactfromid").hide();  
            $("#loadingaj").show();  
            $.ajax({    
              type:'GET',
              url:base_url+'/project/sendmsgtoowner/'+<?php echo $post->id; ?>+'/'+msg,
              success:function(jData){ 
                 $("#loadingaj").hide();
                 $('#contactcomment').val("");
                 $('#contactfromid').hide(); 
                 $('#contsucc').show(); 
              },
              error: function(XMLHttpRequest, textStatus, errorThrown){
                $(".err").html("<div>Error.</div>");
              }
            });
        } 
      });

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
function share_facebook(id,post_name,url)
{	
	$("#facebook_id_old").hide();	
	$("#facebook_id_new").show();
	$.ajax({    
	type:'GET',
	url:base_url+'/project/updaterank/'+id,
	success:function(jData){		 
	   u='https://youtu.be/wPT-YdNLxCs';			
	   t='';			
	   window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
	   $("#facebook_id_old").show();	
	   $("#facebook_id_new").hide();
	   return false;
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $(".err").html("<div>Error.</div>");
	}
	});
}

function share_twitter(id,post_name,url)
{	
	$("#twitter_id_old").hide();	
	$("#twitter_id_new").show();
	
	$.ajax({    
	type:'GET',
	url:base_url+'/project/updaterank/'+id,
	success:function(jData){ 
	   var share_url = 'http://twitter.com/share?text='+post_name+' is popular on @musicfunders!&url='+url;		  
	   window.open(share_url, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
	   $("#twitter_id_old").show();	
	   $("#twitter_id_new").hide();
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $(".err").html("<div>Error.</div>");
	}
	});
}

function share_pin(id,post_name,url)
{	
	$("#pin_id_old").hide();	
	$("#pin_id_new").show();
	
	$.ajax({    
	type:'GET',
	url:base_url+'/project/updaterank/'+id,
	success:function(jData){ 
	   var share_url = 'http://pinterest.com/pin/create/button/?url='+url+'&media=http://dev.musicfunder.com/images/file-attached-to-project/resize/'+post_name;
	   //window.open(share_url);
	   window.open(share_url, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
	   $("#pin_id_old").show();	
	   $("#pin_id_new").hide();
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $(".err").html("<div>Error.</div>");
	}
	});
}

function embed(id,post_name,url)
{	
	$.ajax({    
	type:'GET',
	url:base_url+'/project/updaterank/'+id,
	success:function(jData){	  
	   share_url=base_url+'/project/openembed/'+id;
	   window.open(share_url, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=500, width=400, height=400");
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $(".err").html("<div>Error.</div>");
	}
	});
}

function post_update()
{	
	var update_text=document.getElementById("create-update").value;
	var create_title=document.getElementById("create-title").value;	
	var project_id={{ $post->id }};
	
	$("#flash").show();
	$("#display").html('');
	$("#flash").fadeIn(400).html('<img src="'+base_url+'/images/ajax-loader-bar.gif" align="absmiddle"> <span class="loading">One Moment Please...</span>');
	
	$.ajax({    
	type:'POST',
	url:base_url+'/project/pupdate/'+project_id+'/'+update_text+'/'+create_title,	
	success:function(data){	
		$("#create-title").val('');
		$("#create-update").val('');		
		
		$("#display").after(data);
		$("#flash").hide();		
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){	
		$("#display").html('An error occurred. Please try again later.');		
		$("#flash").hide();
	}
	});
}

function delete_update(update_id)
{	
	if(confirm("Are you sure?"))
	{
		$("#flash").show();	
		$("#display").html('');		
		$("#update_text_"+update_id).fadeIn(400).html('<img src="'+base_url+'/images/ajax-loader-bar.gif" alt="One Moment Please..." align="absmiddle"> ');
		$.ajax({    
		type:'POST',
		url:base_url+'/project/pdelete/'+update_id,	
		success:function(data){	
			var div_id=parseInt(data);			
			$("#update_listing_"+div_id).hide(400);	
			$("#action_but_"+div_id).hide(400);			
			$("#flash").hide();			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){	 
			$("#display").html('An error occurred. Please try again later.');
			$("#flash").hide();
		}
		});
	}
}

function edit_update(up_title,up_desc,update_id)
{
	document.getElementById("create-update").value = up_desc;
	document.getElementById("create-title").value = up_title;
	document.getElementById("update_flag").value = update_id;	
	$("#sub_but").hide();
	$("#update_but").show();
		
}
function cancel_update()
{
	$("#sub_but").show();
	$("#update_but").hide();
	document.getElementById("update_flag").value = 0;
	update_text=document.getElementById("create-update").value = '';
	create_title=document.getElementById("create-title").value = '';
}
function save_update()
{	
	var update_id=document.getElementById("update_flag").value;
	var update_text=document.getElementById("create-update").value;
	var create_title=document.getElementById("create-title").value;
	
	$("#flash").show();	
	$("#display").html('');	
	$("#update_text_"+update_id).fadeIn(400).html('<img src="'+base_url+'/images/ajax-loader-bar.gif" alt="One Moment Please..." align="absmiddle"> ');
	$.ajax({    
	type:'POST',
	url:base_url+'/project/pedit/'+update_id+'/'+create_title+'/'+update_text,	
	success:function(data){			
		var div_id=parseInt(data);			
		$("#flash").hide();		
		$("#update_text_"+div_id).hide();
		$("#update_text_"+div_id).after('<div class="update_text" id="update_text_'+div_id+'"><p><span>'+create_title+'</span> - <?php echo \App\Http\Controllers\ProjectController::humanTiming($time);?> ago</p>'+update_text+'</div>');
		$("#action_but_"+div_id).hide(400);	
		$("#create-title").val('');
		$("#create-update").val('');			
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){	 
		$("#display").html('An error occurred. Please try again later.');
		$("#flash").hide();
	}
	});	
}
function select_all(id)
{
	$("#"+id).select();
}
</script>
<script id="commenting-template" type="text/template">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12">
					<div>
						<blockquote><%-comment%></blockquote>
					</div>
					<div class="col-sm-12">
						<div class="editing-box">
							<div class="form-group">
								<label for="create-comment">Write Your Comment</label>
								<textarea class="form-control edit"><%-comment%></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-default submit-edit">Submit</button>
								<label>
									<p class="loader"><i class="fa fa-spinner fa-spin"></i> Saving...</p>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="">
				<div class="col-sm-12">
					<p><span class="credits">By: <%=userName%></span></p>
				</div>
			</div>
			<% if(userId == "{!! Auth::id() !!}"){ %>
				<div class="comment-actions pull-right">
					<a href="javascript:;" title="Edit this comment" class="edit-comment btn btn-primary">Edit</a>
					<a href="javascript:;" title="Delete this comment" class="delete-comment btn btn-danger">Delete</a>
				</div>
				<div class="clearfix"></div>
			<% } %>
		</div>
	</div>
	
</script>

<!-- Section added by dc on 12.11.15 -->
<!-- js file to handle reminder -->
<script src="{{ asset('plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<script src="{{ asset('js/frontend/underscore-min.js') }}"></script>
<script src="{{ asset('js/frontend/backbone-min.js') }}"></script>
<script src="{{ asset('js/frontend/Config.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/frontend/ExceptionManager.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/frontend/ProjectDetails.js')}}" type="text/javascript"></script>
<script>
app.projectId = '{{ $id }}';
@if(!Auth::guest())
	app.userName = '{{ Auth::user()->name }}';
	app.userId = '{{ Auth::id() }}';
@endif
</script>
<!-- backbone resources -->
<script src="{{ asset('js/frontend/models/ProjectCommentModel.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/frontend/collections/ProjectCommentList.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/frontend/views/ProjectCommentView.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/frontend/views/ProjectCommentAppView.js')}}" type="text/javascript"></script>

@if(!Auth::guest() && Auth::id())
	<script>
		var projectDetails = new app.ProjectDetails(jQuery, '{{Auth::id()}}', '{{$id}}', '{{ csrf_token() }}');
		projectDetails.getReminderStatus();
	</script>
@endif
<style>
	input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
		background-color: #eee;
		cursor: not-allowed;
	}
	#embed_model{
		width:590px;
	}
</style>
@endsection