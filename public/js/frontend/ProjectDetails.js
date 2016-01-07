'use strict';
var app = app || {};
;(function(){
	app.ProjectDetails = function (jq, userId, projectId, csrfToken){
		this.userId = userId;
		this.projectId = projectId;
		this.csrfToken = csrfToken;
		this.$ = jq;
		
		this.scriptUrlCollection = {
			base: 'project/',
			reminder: 'json-reminder',
			askQuestion: 'ask-a-question/',
			reportViolation: 'report-violation/',
			captcha: 'change-captcha-image',
		};
		
		//private method to handle click event of remind me
		function _reminderClickHandler(parentObj) {
			var _super = parentObj;
			_super.$('.PrjDtlArea').on('click', 'a.remind', function(e){
				var _that = _super.$(this);
				//sending the request to the server
				_super.$.post(app.Config.getScriptBaseUrl() 
					+ _super.scriptUrlCollection.base 
					+ _super.scriptUrlCollection.reminder,
					{userId: _super.userId, projectId: _super.projectId, '_token': _super.csrfToken}
				).done(function(result){
					if(result.success){
						_that.addClass('reminded').removeClass('remind').find('span.remind-text-info').text('Success');
						
						//showing current status automatically after 2s
						setTimeout(function(){
							_that.find('span.remind-text-info').text('Already Reminded');
						}, 2000);
					}else
						app.ExceptionManager.handleResponseError(result);
				})
				.error(app.ExceptionManager.handleAjaxErrors);
			});
		}
		
		//private function to simple repetitive common tasks
		function _runCommonTasks(parentObj){
			var _super = parentObj;
			_super.$('body').on('hidden.bs.modal', '.modal', function () {
				_super.$(this).removeData('bs.modal');
			});
			
			_super.$('.reload-captcha').on('click', function(e){
				var _that = _super.$(this);
				var url = app.Config.getScriptBaseUrl() 
					+ _super.scriptUrlCollection.captcha;
				
				_super.$.get(url)
					.done(function(result){
						_that.prev().attr('src', result);
					}).error(app.ExceptionManager.handleAjaxErrors);
			});
		}
		
		//bootstrapping private handler
		_reminderClickHandler(this);
		_runCommonTasks(this);
	}
	
	//public method to handle reminder action	
	app.ProjectDetails.prototype.getReminderStatus =  function(){
			if(!this.projectId || !this.userId)
				return;
			var _super = this;
			this.$.getJSON(app.Config.getScriptBaseUrl() 
				+ this.scriptUrlCollection.base 
				+ this.scriptUrlCollection.reminder
				+ '?projectId=' + this.projectId + '&userId=' + this.userId
			).done(function(result){
				//console.log(result);
				
				if(result.success){
					if(result.count)
						_super.$('#reminder_info_area').removeClass('hidden').addClass('reminded').find('span.remind-text-info').text('Already Reminded');
					else
						_super.$('#reminder_info_area').removeClass('hidden').addClass('remind');
				}else
					app.ExceptionManager.handleResponseError(result);
				
				//hiding the loader
				_super.$('#reminder_loader_area').addClass('hidden');
			})
			.error(app.ExceptionManager.handleAjaxErrors);
	};
	
	//public method to handle ask a question dialog
	app.ProjectDetails.prototype.handleAskQuestion = function(){
		var _super = this;
		
		_super.$('#ask-a-project-question-form').on('submit', function(e){
			e.preventDefault();
			var data = _super.$(this).serialize();
			var _that = _super.$(this);
			var url = app.Config.getScriptBaseUrl() 
				+ _super.scriptUrlCollection.base 
				+ _super.scriptUrlCollection.askQuestion
				+ _super.projectId;
			//handling request submission
			_handleCommonRequestPosting(_super, _that, url, data);
		});
	}
	
	//public method to handle report a violation dialog
	app.ProjectDetails.prototype.handleViolation = function(){
		var _super = this;
		
		_super.$('#report-violation-form').on('submit', function(e){
			e.preventDefault();
			var data = _super.$(this).serialize();
			var _that =_super.$(this);
			var url = app.Config.getScriptBaseUrl() 
				+ _super.scriptUrlCollection.base 
				+ _super.scriptUrlCollection.reportViolation
				+ _super.projectId;
			//handling request submission
			_handleCommonRequestPosting(_super, _that, url, data);
		});
	}
	
	function _handleCommonRequestPosting(parentObj, contextObj, endPoint, data){
		var _super = parentObj;
		
		_super.$.post(endPoint, data)
			.done(function(result){
				if(result.success){
					_super.$('.alert-success').find('span.message').text(result.success);
					_super.$('.alert-danger').addClass('hidden');
					_super.$('.alert-success').removeClass('hidden');
					
					contextObj.find('input[type=text]').val('');
					contextObj.find('textarea').val('');
					
					//refreshing captcha
					_super.$('.reload-captcha').trigger('click');
				}else if(result.error){
					if(result.error instanceof Array){
						var errorMessage = '';
						//console.log(result.error);
						for(var i=0; i<result.error.length; i++){
							errorMessage += result.error[i] + '<br />';
						}
						_super.$('.alert-danger').find('span.message').html(errorMessage);
					}else
						_super.$('.alert-danger').find('span.message').text(result.error);
					
					_super.$('.alert-success').addClass('hidden');
					_super.$('.alert-danger').removeClass('hidden');
					
					//refreshing captcha
					_super.$('.reload-captcha').trigger('click');
				}
			})
			.error(app.ExceptionManager.handleAjaxErrors);
	}
})();