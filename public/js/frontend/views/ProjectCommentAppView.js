'use strict';
var app = app || {};
;(function($){
	app.ProjectCommentAppView = Backbone.View.extend({
		el: '#Comments',
		
		userName: app.userName || '',
		userId: app.userId || 0,
		projectId: app.projectId || 0,
		
		initialize: function(){
			this.input = $('#create-comment');
			
			this.$el.find('.loader').removeClass('hidden');
			
			app.projectCommentList.on('reset', this.addAll, this);
			app.projectCommentList.on('add', this.addOne, this);
			
			//fetching records from the server
			this.fetchFromServer();
			
		},
		
		events: {
			'keypress #create-comment': 'createOnEnter',
			'click #submit-comment': 'createOnSubmit',
		},
		
		addOne: function(commentModel){
			var commentView = new app.ProjectCommentView({model: commentModel});
			$('.comments-container').append(commentView.render().el);
		},
		
		addAll: function(){
			$('.comments-container').html('');
			app.projectCommentList.each(this.addOne, this);
		},
		
		createOnEnter: function(e){
			if(e.which != 13 || !this.input.val().trim())
				return;
			
			this.createComment();
		},
		
		createOnSubmit: function(e){
			this.createComment();
		},
		
		createComment: function(){
			if(this.input.val().trim()){
				this.$el.find('.loader').removeClass('hidden');
				var _super = this;
				app.projectCommentList.create(this.newTuple(), {
						wait: true, 
						success: function(result){
							_super.$el.find('.loader').addClass('hidden');
							$('#comment-count-region').text('Comments (' + app.projectCommentList.length + ')');
							_super.input.val('');
						}
					}
				)
				
			}
			//this.fetchFromServer();
		},
		
		newTuple: function(){
			return {
				userName: this.userName,
				comment: this.input.val().trim(),
				projectId: this.projectId,
				userId: this.userId,
				date: new Date(),
			}
		},
		
		fetchFromServer: function(){
			var _super = this;
			var projectID = app.projectId || 0;
			
			app.projectCommentList.fetch({
				url: app.Config.getScriptBaseUrl() + 'project-comment?projectId=' + projectID
			})
			.done(function(result){
				_super.$el.find('.loader').addClass('hidden');
				$('#comment-count-region').text('Comments (' + app.projectCommentList.length + ')');
			});
		}
		
	});
	
	//initializing
	app.projectCommentAppView = new app.ProjectCommentAppView();
})(jQuery);