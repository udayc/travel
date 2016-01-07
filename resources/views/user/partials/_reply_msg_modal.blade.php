<div id="responsive"  tabindex="-1" data-width="960"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
				@if($modalFor == 'reply' )
				<h4 class="modal-title">Project Details</h4>
				@endif
				@if($modalFor == 'user-login-count' )
				<h4 class="modal-title">User Login History</h4>
				@endif
				@if($modalFor == 'project_funded_count' )
				<h4 class="modal-title">List of funded projects </h4>
				@endif
            </div>
            <div class="modal-body">
					<div class="row">
					<div class="col-md-12" id="replyListsWrapper"> 

					@if($modalFor == 'reply' )
							<table class="table table-bordered table-hover" id="sample-table-1">

							<tbody>
							@if( count($myInboxLists)  > 0 )
							@foreach($myInboxLists as $val)						
							<tr>
							<td class="center">{{ $val->content }} </td>
							<td>{{ $val->created_at}}</td>
							</tr>
							@endforeach
							@else
							<tr><td colspan="4">No result found !</td></tr>
							@endif
							</tbody>
							</table>

					@endif

					</div> 
					</div>
				
			
			<div id="contsucc" style="display: none;" >
			  <div class="">
			  <div class="col-sm-12 col-xs-12 formareas sendmessage"  > 
			  <span style="color:#2bde73;">Your message has been posted ! </span> 
			  </div>
			  </div>
			  <div class="clearfix"></div> 
			</div>
			
				
			<div id="contactfromid">
			<div class="">
			<form name="form9" id="form9" class="form-horizontal" role="form" method="POST" action="#">
			<div class="col-sm-12 formareas">
			<div class="col-sm-12 col-xs-12 loginColumn">    
			<input type="hidden" name="_token" value="{{ csrf_token() }}">   
			<input type="hidden" name="msg_id" id="msg_id" value="{{ $msgId }}" />	
			<div class="userLoginBx">

			<div class="userLoginBxFldArea">
			<label>Write your reply : {{ $modalFor}}</label>
			<textarea class="form-control" rows="5" id="replyText" name="replyText" style="height:110px;"></textarea>
			</div> 
			</div>
			</div>
			</div>
			<div class="clearfix"></div>
			<div class="modal-footer"> 
			<p>
			<input name="contactsub" id="saveMyReplyMsg" type="button"  class="SmallButton updatereply" value="Submit" data-token="{{ csrf_token() }}"> 
			</p>
			</div>
			</form>
			</div>
			</div>				
				
				
				
				
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-light-grey">Close</button> 
            </div>
        </div>
 


















