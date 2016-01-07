<form id="ask-a-project-question-form">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<input type="hidden" name="projectId" value="{{ $id }}">
<input type="hidden" name="userId" value="{!! Auth::id() !!}">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4>Ask a Question</h4>
</div>
 <div class="modal-body">
	<div role="alert" class="alert alert-success alert-dismissible hidden">
		<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
      <strong>Success! </strong><span class="message">You successfully read this important alert message.</span>
    </div>
	<div role="alert" class="alert alert-danger alert-dismissible hidden">
      <strong>Error! </strong> <span class="message"> You successfully read this important alert message.</span>
    </div>
		<div class="form-group">
			<label>Write Your Question</label>
			<textarea class="form-control" required name="question"></textarea>
		</div>
		<div class="form-group">
			{!! captcha_img() !!}
			<a href="javascript:;" class="reload-captcha"><i class="glyphicon glyphicon-refresh"></i></a>
		</div>
		<div class="form-group">
			<label>Enter these letters or numbers:</label>
			<input class="form-control" name="captcha" type="text" required />
		</div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" type="submit">Submit</button>
	<button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
</div>
</form>
<script>
	try{
		/*$('#reload-captcha').on('click', function(e){
			var _that = $(this);
			$.get("{!! url('/change-captcha-image') !!}")
				.done(function(result){
					_that.prev().attr('src', result);
				}).error(function(jqXHR, textStatus, errorThrown){
					alert(jqXHR.status + " " + errorThrown)
				});
		});
		
		$('#ask-a-project-question-form').on('submit', function(e){
			e.preventDefault();
			var data = $(this).serialize();
			var _that = $(this);
			$.post(" {!! url('/project/ask-a-question/'. $id) !!}", 
				data
			).done(function(result){
				if(result.success){
					$('.alert-success').find('span.message').text(result.success);
					$('.alert-danger').addClass('hidden');
					$('.alert-success').removeClass('hidden');
					
					_that.find('input[type=text]').val('');
					_that.find('textarea').val('');
					
					$('#reload-captcha').trigger('click');
				}else if(result.error){
					if(result.error instanceof Array){
						var errorMessage = '';
						console.log(result.error);
						for(var i=0; i<result.error.length; i++){
							errorMessage += result.error[i] + '<br />';
						}
						$('.alert-danger').find('span.message').html(errorMessage);
					}else
						$('.alert-danger').find('span.message').text(result.error);
					
					$('.alert-success').addClass('hidden');
					$('.alert-danger').removeClass('hidden');
				}
			})
		});
		
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});*/
		
		var projectDetails = new app.ProjectDetails(jQuery, '{{Auth::id()}}', '{{$id}}', '{{ csrf_token() }}');
		projectDetails.handleAskQuestion();
	}catch(ex){
		alert(ex.message);
	}
</script>