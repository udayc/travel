var app = app || {};
(function(){
	'use strict';
	app.Config = {
		scriptHost : window.location.hostname,
		scriptProtocol: window.location.protocol,
		
		//need to be changed on production or staging
		scriptHostSuffix : '/',
		
		getScriptBaseUrl: function(){
			return this.scriptProtocol + '//' + this.scriptHost + this.scriptHostSuffix;
		}
	};
	
})();