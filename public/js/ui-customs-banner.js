var UICustoms = function () {
    //function to initiate bootstrap extended modals
    var initModals = function () {
	
 
	
	
        $('a.deleteRecord').on('click', function (e) {		
			e.preventDefault();
			// $('body').modalmanager('loading');
			  
					if ( confirm("Are you sure you want to delete this banner ?") ) {
					
					
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || '';
						
						$.ajax({
						url: '/admin/banner/destroy/'+uID,			
						data: {_method: 'delete', _token: token, },
						type: 'POST',
						success: function(result) {				
							window.location = '/admin/banner';
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
						window.location = '/admin/banner';
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
					ajaxAction('/admin/banner/massaction/delete' , token ,  allVals);
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
				if( confirm("Are you sure you want to inactive this banners?") ) {					
					ajaxAction('/admin/banner/massaction/inactive' , token ,  allVals);
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
				if( confirm("Are you sure you want to active this banners?") ) {					
					ajaxAction('/admin/banner/massaction/active' , token ,  allVals);
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
				 
				if( confirm("Are you sure you want to export this bammers?") ) {	 
					window.location.href = '/admin/banner/exportselected/'+allVals;
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