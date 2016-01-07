var UICustoms = function () {
    //function to initiate bootstrap extended modals
    var initModals = function () {

        $('a.deleteRecord').on('click', function (e) {		
			e.preventDefault();
			// $('body').modalmanager('loading');
			  
					if ( confirm("Are you sure you want to delete this row ?") ) {
					
					
						var uID 		= $(this).attr('data-value') || 0;
						var token 		= $(this).attr('data-token') || '';
						var call_url 	= $(this).attr('data-url') || '';
					
						
						$.ajax({
						url: call_url + '/destroy/' + uID,			
						data: {_method: 'delete', _token: token, },
						type: 'POST',
						success: function(result) {				
							location.href = call_url ;
						}
						});	

					}			
			
				

        });

    };
	
	
// Change User Status By Ajax call	
 var changeUserStatus = function () {
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
	
	
	
	
    var backFormState = function () {

        $('#back-step-2').on('click', function (e) {		
				e.preventDefault();
			
			  
					if ( confirm("Are you sure you want to back of previous state ?") ) {
					
						var stepval = $(this).val()  || '' ;
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || '';
						//vare token = $("").val() || '' ;
						var call_url = $(this).attr('data-url') || '/admin/project/setsessionval'; 
						
						$.ajax({
						url: call_url  + '/' + stepval,			
						data: {_method: 'post', _token: token },
						type: 'POST',
						success: function(result) {				
							window.location = '/admin/project/create';
						}
						});	
						
					} 
        });

        $('#back-step-22').on('click', function (e) {		
				e.preventDefault();
			
			  
					if ( confirm("Are you sure you want to back of previous state ?") ) {
					
						var stepval = $(this).val()  || '' ;
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || '';
						//vare token = $("").val() || '' ;
						var call_url = $(this).attr('data-url') || '/admin/project/setsessionval'; 
						
						$.ajax({
						url: call_url  + '/' + stepval,			
						data: {_method: 'post', _token: token },
						type: 'POST',
						success: function(result) {				
							window.location = '/admin/project/editproject';
						}
						});	
						
					} 
        });


                $('#back-step-24').on('click', function (e) {
                	 
				e.preventDefault();
			
			  
					if ( confirm("Are you sure you want to back of previous state ?") ) {
					
						var stepval = $(this).val()  || '' ;
						var projid = $("#projectid").val();
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || '';
						//vare token = $("").val() || '' ;
						var call_url = $(this).attr('data-url') || '/project/setsessionval'; 
						


						$.ajax({
						url: call_url  + '/' + stepval + '/' + projid,			
						data: {_method: 'post', _token: token },
						type: 'POST',
						success: function(result) {				
							window.location = '/project/projectedit';
						}
						});	
						
					} 



        }); 



                $('#back-step-25').on('click', function (e) {
                	 
					e.preventDefault();
			
			  
					if ( confirm("Are you sure you want to back of previous state www ?") ) {
					
						var stepval = $(this).val()  || '' ;
						var projid = $("#projectid").val();
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || '';
						//vare token = $("").val() || '' ;
						var call_url = $(this).attr('data-url') || '/project/setsessionval'; 
						
						$.ajax({
						url: call_url  + '/' + stepval + '/' + projid,			
						data: {_method: 'post', _token: token },
						type: 'POST',
						success: function(result) {				
							window.location = '/project/projectedit';
						}
						});	
						
					} 
        		}); 




                $('#back-step-26').on('click', function (e) { 
					e.preventDefault();  
					if ( confirm("Are you sure you want to back of previous state ?") ) {
					
						var stepval = $(this).val()  || '' ;
						var uID = $(this).attr('data-value') || 0;
						var token = $(this).attr('data-token') || ''; 
						var call_url = $(this).attr('data-url') || '/project/setsessioneval'; 
						
						$.ajax({
						url: call_url  + '/' + stepval,			
						data: {_method: 'post', _token: token },
						type: 'POST',
						success: function(result) {				
							window.location = '/project/projectedit';
						}
						});	
						
					} 
        		}); 


  
    };	
	
	var ajaxActionForStaffPick = function( gprojectid , gprojstatus  ){
							 
							$.ajax({
							method: "GET",
							url: base_url + '/admin/project/changefeastat/' + gprojectid + '/' + gprojstatus
							})
							.done(function( result ) {
								if(result.status == 'OK') { 
									location.href = '/admin/project' ;
								}								
							});	
	
	};	

	
var toggleStaffPickStatus = function() { 
        $('.staffpick-toggle-status').on('click', function (e) 
        {		
        		var check = confirm("Are you sure !");

        		if( check == true )
        		{
						e.preventDefault(); 
						var gprojectid = $(this).attr('data-user') || 0;
						var gprojstatus = $(this).attr('data-status') || 0;

						if(gprojstatus == 1 ) { 	
							
							$.ajax({		
							type:'GET',
							url: base_url+'/admin/project/check-staf-pick-by-genre/'+gprojectid+'/'+gprojstatus,
							success:function(jData){
							if(jData.status == 1 )	{
									if ( confirm("Already have staff pick project under this genre . Do you want to replace by new one ?") ) {						
											ajaxActionForStaffPick(gprojectid , gprojstatus);		
									}
							
							} 
							
							if(jData.status == 0)
							{
								ajaxActionForStaffPick(gprojectid , gprojstatus);	
							}
							
							
								 
							},
							error: function(XMLHttpRequest, textStatus, errorThrown){
							$(".err").html("<div>Error.</div>");
							}
							});	

						} else {
									ajaxActionForStaffPick(gprojectid , gprojstatus);				
							}
				}
				else{
					return false;
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
	
	var ajaxAction = function( actionUrl , token ,  allVals , success_url ){

					$.ajax({
					url: actionUrl,			
					data: {_method: 'post', _token: token, _checkboxes: allVals},
					type: 'POST',
					success: function(result) {
					if(result.status == 'success') location.href = success_url ;
						
					}
					});	
	
	};
	
	
	var initMoreActions = function() {
	$(".js-admin-index-autosubmit").change(function() {
		var optionValue = $(this).val();
		var token = $(this).attr('data-token') || '';
		var call_url = $(this).attr('data-url') || ''; 
		var success_url = call_url ;
		
		// Delete:Action - Delete selected data
		if(optionValue == 3)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to delete these row?") ) {		
					
					ajaxAction( call_url + '/massaction/delete' , token ,  allVals , success_url);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}
		
		// Inactive:action -  Inactive Data
		if(optionValue == 1)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to inactive this rows ?") ) {					
					ajaxAction( call_url +'/massaction/inactive' , token ,  allVals , success_url);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}
		
		// Active:action -  Active All Data
		if(optionValue == 2)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to active this rows ?") ) {					
					ajaxAction( call_url + '/massaction/active' , token ,  allVals , success_url);
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
					window.location.href = call_url + '/exportselected/'+allVals;
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}


		// Suspend:action -  Suspend All Data
		if(optionValue == 11)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to suspend this row ?") ) {					
					ajaxAction( call_url + '/massaction/suspend' , token ,  allVals , success_url);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}


		// Un-Suspend:action :  UN-Suspend All Data
		if(optionValue == 111)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to do this action ?") ) {					
					ajaxAction( call_url + '/massaction/unsuspend' , token ,  allVals , success_url);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}








		


		// Featured:action -  Featured All Data
		if(optionValue == 12)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to do this action ?") ) {					
					ajaxAction( call_url + '/massaction/featured' , token ,  allVals , success_url);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}


		// NOT Featured:action -  NOTFeatured All Data
		if(optionValue == 122)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to do this action ?") ) {					
					ajaxAction( call_url + '/massaction/notfeatured' , token ,  allVals , success_url);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}









		


		// System Flag:action -  System Flag All Data
		if(optionValue == 13)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to flag this users ?") ) {					
					ajaxAction( call_url + '/massaction/flag' , token ,  allVals , success_url);
				}				
			}
			else
			{
				alert("Please select check-box to perform this action !");
				return false;
			}
		}	


		// Clear Flag:action -  Clear Flag All Data
		if(optionValue == 133)
		{
			var allVals = [];
			$('input[name=ulist]:checked').each(function() {
				allVals.push($(this).val());
			});
			
			if( allVals.length > 0 )
			{
				if( confirm("Are you sure you want to do this action ?") ) {					
					ajaxAction( call_url + '/massaction/clearflag' , token ,  allVals , success_url);
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
			backFormState();
			changeUserStatus();
			toggleStaffPickStatus();
        }
    };
}();