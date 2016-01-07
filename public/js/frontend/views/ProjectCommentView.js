'use strict';
var app = app || {};
;(function($){
	app.ProjectCommentView = Backbone.View.extend({
		tagName: 'li',
		
		template: _.template($('#commenting-template').html()),
		
		render: function(){
			this.$el.html(this.template(this.model.toJSON()));
			this.input = this.$('.edit');
			return this;
		},
		
		initialize: function(){
			this.model.on('change', this.render, this);
			this.model.on('destroy', this.remove, this);
		},
		
		events: {
			'click .delete-comment': 'deleteComment',
			'click .edit-comment': 'edit',
			'blur .edit': 'close',
			'click .submit-edit': 'close',
		},
		
		deleteComment: function(){
			if(confirm('Are you sure?'))
				this.model.destroy();
		},
		
		edit: function(){
			this.$el.addClass('editing');
			this.input.focus();
		},
		
		close: function(){
			var value = this.input.val().trim();
			if(value)
				this.saveAfterEdit(value);
			else
				this.$el.removeClass('editing');
		},
		
		saveAfterEdit: function(value){
			//console.log(value);
			this.$el.find('.loader').removeClass('hidden');
			var _super = this;

			this.model.save({comment: value}, {
			  //wait: true,
			  success: function(result){
					_super.$el.find('.loader').addClass('hidden');
					_super.$el.removeClass('editing');
				}
			});
		}
		
	});
})(jQuery);