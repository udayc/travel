var CategoryModel = Backbone.Model.extend({
		urlRoot: "/categorylist",		
		defaults: {	name: "Music" }

});

var GenreModel = Backbone.Model.extend({
		urlRoot: "/generelist",
		defaults: {	name: "African" }
});

var BannerModel = Backbone.Model.extend({
		urlRoot: "/bannerlist",
		defaults: {	banner_title: "banner-1.jpg" }
});

var ProjectListModel = Backbone.Model.extend({
		urlRoot: "/projectlist",
		defaults: {	name: " Help Don Giovanni Records move! " }
});



// Define Collection 

var CategoryCollection = Backbone.Collection.extend({
	model: CategoryModel,
	url : '/categorylist' 

});



// Define Category-List-View

var ListView = Backbone.View.extend({
	el: '', 
	template: _.template($('#listCategoryTemplate').html()),
	render: function() {
		var response = this.model.toJSON();
		this.$el.html(this.template( {categories: response}   ));
        return this;
    } 

});

var ProjectListView = Backbone.View.extend({
	tagName: 'div',
	className: "single-item",
	el: '<div class="single-item">',	
	template: _.template($('#filterProjectByType').html()),
	initialize: function() {
		_.bindAll(this, 'render');		
	  },	


	render: function() {
		var actionresponse = this.model.toJSON();		
		this.$el.html(this.template( {projectlist: actionresponse}   ));
		//this.myCustomeF();
		 $('.single-item').slick({infinite: false});
        return this;
    } 	
	
	 /* myCustomeF: function() {
			$('.single-item').slick({infinite: false});
	  }
		*/
	
	
	

});







// Define Genre-List-View
var GenreListView = Backbone.View.extend({
	el: '', 
	template: _.template($('#listGenreTemplate').html()),
	events: {
		 'click a' : 'genreClickHandler'
		},

	genreClickHandler: function(e){
			e.preventDefault();
			var genreId = $(e.currentTarget).data("id");
			var _token = $(e.currentTarget).data("token");
			//alert(_token);
			$.ajax({
			  url: "/listProjectByGenre",
			  method: "POST",
			  data: { "_token": _token , "id" : genreId }
			}).done(function(response ) {
			  //$( this ).addClass( "done" );
			  console.log(response.data);
			  //var projectListView = new ProjectListView({model:response.data}); 
			  //$('#filterProjectByType').html(projectListView.render().el);
			});			
			
			
		},		
		
	
	render: function() {
		var gresponse = this.model.toJSON();		
		this.$el.html(this.template( {genrelist: gresponse}   ));
        return this;
    } 

});
// Define Genre-List-View
var BannerListView = Backbone.View.extend({
	el: '', 
	template: _.template($('#listBannerListsTemplate').html()),
	render: function() {
		var bannerresponse = this.model.toJSON();
		//console.log(bannerresponse);
		this.$el.html(this.template( {bannerlist: bannerresponse}   ));
        return this;
    } 

});







var MessageRouter = Backbone.Router.extend({
	routes:{ "": "init" },

	listProject: function()	{
		var projectListModel = new ProjectListModel();	
		var projectListView = new ProjectListView({model:projectListModel}); 
		projectListModel.fetch({
				success: function () {
					$('#setResult').html(projectListView.render().el);
					//$("div.arnab-mallikc").remove();
				}
		});		

	},


	
	
	listCategory: function() {
		var categoryModel = new CategoryModel();	
		var listView = new ListView({model:categoryModel}); 
		categoryModel.fetch({
				success: function () {
					$('#msg').html(listView.render().el);
				}
		});	
	},
	
	listGenre: function()	{
		var genreModel = new GenreModel();	
		var genreListView = new GenreListView({model:genreModel}); 
		genreModel.fetch({
				success: function () {
					$('#genremsg').html(genreListView.render().el);
				}
		});		

	},
	listBannerSlider: function()	{
		var bannerModel = new BannerModel();	
		var bannerListView = new BannerListView({model:bannerModel}); 
		bannerModel.fetch({
				success: function () {
					$('#bannermsg').html(bannerListView.render().el);
				}
		});		

	},	
	

	init: function() {
				this.listBannerSlider();
				this.listCategory();
				this.listGenre();
				this.listProject();
				//var projectListView = new ProjectListView(); 
				//projectListView.render();
				//$('.single-item').slick({infinite: false});
			} 


});


var messageRouter = new MessageRouter();
Backbone.history.start();