var UICustoms = function () {
    //function to initiate bootstrap extended modals
    var initModals = function () {
	
 
	
	
        $('a.deleteRecord').on('click', function (e) {		
			e.preventDefault();
			// $('body').modalmanager('loading');
			  
					if ( confirm("Are you sure you want to delete this category ?") ) {
					
					
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || '';
						
						$.ajax({
						url: '/admin/category/destroy/'+uID,			
						data: {_method: 'delete', _token: token, },
						type: 'POST',
						success: function(result) {				
							window.location = '/admin/category';
						}
						});	

					}			
			
				

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
						window.location = '/admin/activity/project-comments';
					}
					});	
	
	};
	
	
	var initMoreActions = function() {
	$(".js-admin-index-autosubmit").change(function() {
		var optionValue = $(this).val();
		
		var token = $(this).attr('data-token') || '';
		var call_url = $(this).attr('data-url') || ''; 
		var success_url = '/admin/activity/project-comments' ;
		if(optionValue == 3)
		{
			
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
			//	alert(allVals);
		//return false;
				if( confirm("Are you sure you want to delete these data?") ) {
	//	alert(call_url);
	//	return false;				
					ajaxAction( call_url +'/massaction/delete' , token ,  allVals, success_url);
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
				if( confirm("Are you sure you want to inactive this categories?") ) {					
					ajaxAction('/admin/category/massaction/inactive' , token ,  allVals);
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
				if( confirm("Are you sure you want to active this categories?") ) {					
					ajaxAction('/admin/category/massaction/active' , token ,  allVals);
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
				 
				if( confirm("Are you sure you want to export this categories?") ) {	 
					window.location.href = '/admin/category/exportselected/'+allVals;
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
        }
    };
}();