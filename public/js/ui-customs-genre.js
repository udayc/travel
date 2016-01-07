var UICustoms = function () {
    //function to initiate bootstrap extended modals
    var initModals = function () {
	
 
	
	
        $('a.deleteRecord').on('click', function (e) {		
			e.preventDefault();
			// $('body').modalmanager('loading');
			  
					if ( confirm("Are you sure you want to delete this genre ?") ) {
					
					
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || '';
						
						$.ajax({
						url: '/admin/genre/destroy/'+uID,			
						data: {_method: 'delete', _token: token, },
						type: 'POST',
						success: function(result) {				
							window.location = '/admin/genre';
						}
						});	

					}			
			
				

        });

    };
	
	
	
	
	
// Change User Status By Ajax call	
 var changeRowStatus = function () {
  $('.toggle-status').on('click', function (e) {
		e.preventDefault();
		var userid 		= $(this).attr('data-user') || 0;
		var userstatus 	= $(this).attr('data-status') || 0;
		var callUrl 	= $(this).attr('data-url') || 0;
		//if(callUrl != 0 )
		
 		$.ajax({		
					type:'GET',
					url:base_url+ callUrl + 'changepresentstatus/'+userid+'/'+userstatus,
					success:function(jData){
						 if(userstatus==0) { 
							$("#activespn_"+userid).hide();	 
							$("#inactivespn_"+userid).show(); 
						 }
						 if(userstatus==1) {  
							$("#inactivespn_"+userid).hide(); 
							$("#activespn_"+userid).show();		 
						 }						 
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
							$(".err").html("<div>Error.</div>");
					}
		});
 
 
 });

}; 	
	
	
	
	
	
	
	
	
	
	
	
	var checkAllNone = function () {
		$('#check_all_nonexx').click(function () {
			if ( $(this).is(':checked') ){
				$('.ulistcheckbox').prop("checked", true);				
			}
			else{
				$('.ulistcheckbox').removeAttr("checked"); 			  
			}			
		});	

	};
	
	var ajaxAction = function( actionUrl , token ,  allVals){

					$.ajax({
					url: actionUrl,			
					data: {_method: 'post', _token: token, _checkboxes: allVals},
					type: 'POST',
					success: function(result) {
					if(result.status == 'success')
						window.location = '/admin/genre';
					}
					});	
	
	};
	
	
	var initMoreActions = function() {
	$(".js-admin-index-autosubmit").change(function() {
		var optionValue = $(this).val();
		var token = $(this).attr('data-token') || '';
		if(optionValue == 3)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to delete these data?") ) {					
					ajaxAction('/admin/genre/massaction/delete' , token ,  allVals);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}
		
		
		if(optionValue == 1)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to inactive this genres?") ) {					
					ajaxAction('/admin/genre/massaction/inactive' , token ,  allVals);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}		
		
		if(optionValue == 2)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to active this genres?") ) {					
					ajaxAction('/admin/genre/massaction/active' , token ,  allVals);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}			
		
		if(optionValue == 5)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				 
				if( confirm("Are you sure you want to export this records?") ) {	 
					window.location.href = '/admin/genre/exportselected/'+allVals;
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}		
		
		
		
	
	});

	}; 
	
    return {
        init: function () {
            initModals();
			checkAllNone();
			initMoreActions();
			changeRowStatus();
        }
    };
}();