var UIModals = function () {
    //function to initiate bootstrap extended modals
    var initModals = function () {
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
            '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
            '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
            '</div>' +
            '</div>';


            
        var $modal = $('#ajax-modal');
        $('.specificcls').on('click', function () { 
            var presentval = $(this).data("id");  
            /* create the backdrop and wait for next modal to be triggered */
            var genurl = base_url+'/admin/banner/details/' + presentval ;
           
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(genurl, '', function () {
                    $modal.modal();
                });
            }, 1000);
        });



        $modal.on('click', '.update', function () {
            $modal.modal('loading');
            setTimeout(function () {
                $modal
                    .modal('loading')
                    .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                        'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '</div>');
            }, 1000);
        });
    };
	
	
	
	
    var initCountProjectPostedByUserModals = function () {
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
            '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
            '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
            '</div>' +
            '</div>';


            
        var $modal = $('#ajax-modal');
        $('.users_project_count').on('click', function () { 
            var presentval = $(this).data("id");  
			var modalType = $(this).attr("role");  
			//alert(modalType);
            /* create the backdrop and wait for next modal to be triggered */
            var genurl = base_url+'/admin/user/uimodal/' + modalType + '/' + presentval ;
           
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(genurl, '', function () {
                    $modal.modal();
                });
            }, 1000);
        });



        $modal.on('click', '.update', function () {
            $modal.modal('loading');
            setTimeout(function () {
                $modal
                    .modal('loading')
                    .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                        'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '</div>');
            }, 1000);
        });
    };	
	
	
    var initCountUserLoginHistoryModals = function () {
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
            '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
            '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
            '</div>' +
            '</div>';


            
        var $modal = $('#ajax-modal');
        $('.users_login_count').on('click', function () { 
            var presentval = $(this).data("id");  
			var modalType = $(this).attr("role");  
			//alert(modalType);
            /* create the backdrop and wait for next modal to be triggered */
            var genurl = base_url+'/admin/user/uimodal/' + modalType + '/' + presentval ;
           
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(genurl, '', function () {
                    $modal.modal();
                });
            }, 1000);
        });



        $modal.on('click', '.update', function () {
            $modal.modal('loading');
            setTimeout(function () {
                $modal
                    .modal('loading')
                    .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                        'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '</div>');
            }, 1000);
        });
    };		


    var initCountUserProjectFundedModals = function () {
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
            '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
            '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
            '</div>' +
            '</div>';


            
        var $modal = $('#ajax-modal');
        $('.project_funded_count').on('click', function () { 
            var presentval = $(this).data("id");  
			var modalType = $(this).attr("role");  
			//alert(modalType);
            /* create the backdrop and wait for next modal to be triggered */
            var genurl = base_url+'/admin/user/uimodal/' + modalType + '/' + presentval ;
           
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(genurl, '', function () {
                    $modal.modal();
                });
            }, 1000);
        });



        $modal.on('click', '.update', function () {
            $modal.modal('loading');
            setTimeout(function () {
                $modal
                    .modal('loading')
                    .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                        'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '</div>');
            }, 1000);
        });
    };



    var initReplyMessageModals = function () {
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
            '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
            '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
            '</div>' +
            '</div>';


            
        var $modal = $('#ajax-modal-reply');
        $('.replymsg').on('click', function () { 
						var msgId = 	$(this).attr("data-msg-id") || '';
						$("#msg_id").val(msgId);
			
			//alert(modalType);
            /* create the backdrop and wait for next modal to be triggered */
					var protocol 		= 	window.location.protocol;
					var host 			= 	window.location.host;
					var modalType 		= 'reply';	
			
					var genurl = protocol + "//" + host + '/home/uimodal/?Id=' +  msgId ;
           
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(genurl, '', function () {
                    $modal.modal();
                });
            }, 1000);
        });



        $modal.on('click', '.updatereply', function () {
		
					//$modal.modal('loading');

					var validation 		= 	$("#form9").valid(); 
					var msg_id 			= 	$("#msg_id").val();
					var _token 			= 	$(this).attr("data-token") || '';					
					var replyText 		= 	$('#replyText').val();					
					var protocol 		= 	window.location.protocol;
					var host 			= 	window.location.host;			
				
					
					$.ajax({
						url: protocol + "//" + host + "/home/reply-msg",
						method: "POST",
						data: { "_token": _token , "msgId" : msg_id , "replyText" : replyText },
						
						beforeSend: function() {		}					  
					})					
					.done(function( response ) {
						
						if(response.msg == 'success') {
							$('#replyListsWrapper').html(response.data);
							$('#replyText').val("");							
						} else { alert("No Records Found !");}						
						
						
					})
					.fail(function() {
							alert( "error" );
					})
					.always(function() {					
							 $('#contsucc').show(); 						
					 });				
			
			
        });
    };
	
	
	

    var initBackerListsModals = function () {
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
            '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
            '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
            '</div>' +
            '</div>';


            
        var $modal = $('#ajax-modal-backerLists');
        $('.backerLists').on('click', function () { 
						var projectId = 	$(this).attr("data-value") || '';
						
			
			//alert(modalType);
            /* create the backdrop and wait for next modal to be triggered */
					var protocol 		= 	window.location.protocol;
					var host 			= 	window.location.host;
					var modalType 		= 'backer-lists';	
			
					var genurl = protocol + "//" + host + '/home/uimodal/?Id=' +  projectId + '&type=' + modalType;
           
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(genurl, '', function () {
                    $modal.modal();
                });
            }, 1000);
        });



        $modal.on('click', '.updatereply', function () {
		
					//$modal.modal('loading');

					var validation 		= 	$("#form9").valid(); 
					var msg_id 			= 	$("#msg_id").val();
					var _token 			= 	$(this).attr("data-token") || '';					
					var replyText 		= 	$('#replyText').val();					
					var protocol 		= 	window.location.protocol;
					var host 			= 	window.location.host;			
				
					
					$.ajax({
						url: protocol + "//" + host + "/home/reply-msg",
						method: "POST",
						data: { "_token": _token , "msgId" : msg_id , "replyText" : replyText },
						
						beforeSend: function() {		}					  
					})					
					.done(function( response ) {
						
						if(response.msg == 'success') {
							$('#replyListsWrapper').html(response.data);
							$('#replyText').val("");							
						} else { alert("No Records Found !");}						
						
						
					})
					.fail(function() {
							alert( "error" );
					})
					.always(function() {					
							 $('#contsucc').show(); 						
					 });				
			
			
        });
    };	
	
	
	
	
	
	
	
	
	
	
    return {
        init: function () {
            initModals();
			initCountProjectPostedByUserModals();
			initCountUserLoginHistoryModals();
			initCountUserProjectFundedModals();
			initReplyMessageModals();
			initBackerListsModals();
        }
    };
}();