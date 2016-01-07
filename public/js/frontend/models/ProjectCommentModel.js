'use strict';
var app = app || {};
;(function(){
	app.ProjectCommentModel = Backbone.Model.extend({
		defaults: {
			userName: '',
			comment: '',
			userId: 0,
			projectId: 0,
			date: new Date(),
		}
	});
})();