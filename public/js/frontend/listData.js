
var BannerModel = Backbone.Model.extend({
		urlRoot: "/bannerlist",
		defaults: {	banner_title: "banner-1.jpg" }
});



// Define Genre-List-View
var BannerListView = Backbone.View.extend({
	tagName: 'ul',
	el: '', 
	template: _.template($('#listBannerListsTemplate').html()),
	render: function() {
		//var bannerresponse = this.model.toJSON();		
		this.$el.html(this.template( {bannerlist: this.model.toJSON() }   ));
        return this;
    } 

});


var MessageRouter = Backbone.Router.extend({
	routes: { "": "init" },
	
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
			} 


});


var messageRouter = new MessageRouter();
Backbone.history.start();