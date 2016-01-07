var app = app || {};
(function(){
	'use strict';
	app.ExceptionManager = {
		handleAjaxErrors: function(jqXHR, textStatus, errorThrown){
			if(301 == jqXHR.status || 302 == jqXHR.status)
				window.location.href = app.Config.getScriptBaseUrl();
			else
				alert("Error: " + jqXHR.status + "--" + errorThrown + ' ' + textStatus);
		},
		
		handleResponseError: function(errorObj){
			if(errorObj && errorObj.error)
				alert('Error in response: ' + errorObj.error);
			else
				alert('Error in response: ');
		},
	};
	
})();