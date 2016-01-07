'use strict';
var app = app || {};

;(function(){
	app.ProjectCommentList = Backbone.Collection.extend({
		model: app.ProjectCommentModel,
		
		url: app.Config.getScriptBaseUrl() + 'project-comment',
	});
	
	app.projectCommentList = new app.ProjectCommentList();
})();