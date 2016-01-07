var myApp = myApp || {};

var myApp = (function(jQ) { 
	var id= 0; 
	var slider 		= jQ("[data-slideValue='slider']");
	var ranger 		= jQ("[data-slider='range']");
	var maxValue 	= jQ(this.ranger).find(slider).attr('max');  

	
	
	
    return {
	
		knobItemHandler : function() {
			jQ(".knob").knob({ format : function (value) { return value + '%'; }, }); 
		},	

        ajaxCatListHandler: function() {
		

				jQ("a.catList").on('click' , function(e) {
					e.preventDefault();
					
					var listType 	=  jQ(this).attr("list-type") || '';
					var catId 		=  jQ(this).attr("data-id") || '';
					var _token 		=  jQ(this).attr("data-token") || '';
					
					
					jQ.ajax({
						url: "/listProjectByCat",
						method: "POST",
						data: { "_token": _token , "id" : catId , "_listType" : listType },
						beforeSend: function() {		}					  
					})					
					.done(function( response ) {
						
						if(response.msg == 'success') {
							jQ('#setResult').html(response.data);												
						} else { alert("No Records Found !");}
	
					})
					.fail(function() {
							alert( "error" );
					})
					.always(function() {						
						myApp.knobItemHandler();	
						jQ('#loading').hide() ;
					 });					
															
	
				});			

        },
		
		
        ajaxCotactMeHandler: function() {
		

				jQ("#contactsub").on('click' , function(e) {
					e.preventDefault();
					
					var validation 		= 	jQ("#form9").valid(); 
					var pId 			= 	jQ("#p_id").val();
					var _token 			= 	jQ(this).attr("data-token") || '';					
					var msg 			= 	jQ('#contactcomment').val();					
					var protocol 		= 	window.location.protocol;
					var host 			= 	window.location.host;			
					
					
					jQ.ajax({
						url: protocol + "//" + host + "/project/contact-me",
						method: "POST",
						data: { "_token": _token , "pId" : pId , "msg" : msg },
						beforeSend: function() {		}					  
					})					
					.done(function( response ) {
						
						if(response.msg == 'success') {
							jQ("#loadingaj").hide();
						} else { alert("Data processing error");}
	
					})
					.fail(function() {
							alert( "error" );
					})
					.always(function() {						
						
							 jQ('#contactcomment').val("");
							 jQ('#contactfromid').hide(); 
							 jQ('#contsucc').show(); 						
						 
					 });					
															
	
				});			

        },		
		
		
		
		
		
		
		
        ajaxCountryCityListHandler: function() {
		
				jQ("select#country_id").on('change' , function(e) {
					e.preventDefault();
					var selectedCountry = jQ("#country_id").val(); 
					jQ.ajax({
						url: "/home/citylist/" + selectedCountry,
						method: "GET",
						beforeSend: function() {		}					  
					})					
					.done(function( response ) {
			        	   $("#cities > option").remove(); 
			        	   $.each(response,function(city_id,city)  {  
		                        var opt = $('<option />');  
		                        opt.val(city.cityID);
		                        opt.text(city.cityName);
		                        $('#cities').append(opt);  
                    	  });						

					})
					.fail(function() {
							alert( "error in process data!" );
					})
					.always(function() {						
						//myApp.knobItemHandler();	
						//jQ('#loading').hide() ;
					 });					
															
	
				});			

        },	

		openReplyMsgModal: function() {	
				jQ(".replymsg").on('click' , function(e){
						e.preventDefault();
						jQ('#myModalReply').modal('show'); 
						var msgId = 	jQ(this).attr("data-msg-id") || '';
						jQ("#msg_id").val(msgId);
						//alert(msgId);
				});	
		},


		sortByMessageInbox: function() {	
				jQ("#sortByMessageBox").on('change' , function(e){

						var boxType =  jQ(this).val()  ;
						var protocol 		= 	window.location.protocol;
						var host 			= 	window.location.host;
						window.location.href = 		protocol + "//" + host + "/home/my-messages/?box=" + boxType;
						
				});	
		},	
		



        ajaxPostReplyMsgHandler: function() {
		

				jQ("#saveMyReplyMsg").on('click' , function(e) {
					e.preventDefault();
					
					var validation 		= 	jQ("#form9").valid(); 
					var msg_id 			= 	jQ("#msg_id").val();
					var _token 			= 	jQ(this).attr("data-token") || '';					
					var replyText 		= 	jQ('#replyText').val();					
					var protocol 		= 	window.location.protocol;
					var host 			= 	window.location.host;			
					alert('giiii');
					
					jQ.ajax({
						url: protocol + "//" + host + "/home/reply-msg",
						method: "POST",
						data: { "_token": _token , "msgId" : msg_id , "replyText" : replyText },
						beforeSend: function() {		}					  
					})					
					.done(function( response ) {
						
						if(response.msg == 'success') {
							jQ("#loadingaj").hide();
						} else { alert("Data processing error");}
	
					})
					.fail(function() {
							alert( "error" );
					})
					.always(function() {						
						
							 jQ('#contactcomment').val("");
							 jQ('#contactfromid').hide(); 
							 jQ('#contsucc').show(); 						
						 
					 });					
															
	
				});			

        },	







		
	
 
        slickImageHandler: function() {
            jQ('.single-item').slick({infinite: false});     
        },
		

		menuMakerHandler: function() {
			jQ("#cssmenu").menumaker({title: "Menu",	format: "multitoggle"});
		},
		
		progressBarHandler: function() {
			jQ('.progressbar1').progressBar({ shadow : false, percentage : true, animation : false, });
		},
		
		WowEffectHandler: function() {
			new WOW().init();
		},
		
		progressFullAreaHandler: function() {
		
			var $obj = jQ(this);
			jQ(window).scroll(function() {
				var yPos = -(jQ(window).scrollTop() / $obj.data('speed')); 
				var bgpos = '50% '+ yPos + 'px';
				$obj.css('background-position', bgpos );
			}); 		
		
		
		
		},
		
		sliderHandler: function() {

				jQ("[data-slider='range']").each(function () {
					
					var currentRange = jQ(this).find("[data-slideValue='slider']").val(); 
					var maxRange = jQ(this).find("[data-slideValue='slider']").attr('max'); 
					jQ(this).find('.increser').find('span.increase-value').html(currentRange);
					jQ(this).find('.increser').css({width: currentRange + '%'});
					jQ(this).find('.decreser').find('span.decrease-value').html(this.maxValue - currentRange);
					jQ(this).find('.decreser').css({textIndent: currentRange + '%'});
					
				});
				
				jQ(this.slider).mousemove(function () {
				
					var vol = jQ(this).val(); 
					var sliderParent = jQ(this).parent("[data-slider='range']");
					var increserValue = ((this.maxValue * vol) / 100); 
					jQ(sliderParent).find(".increser").css({width: increserValue + '%'});
					jQ(sliderParent).find(".increser span.increase-value").html(vol);
					jQ(sliderParent).find(".decreser span.decrease-value").html(100 - vol);
					jQ(sliderParent).find(".decreser").css({textIndent: increserValue + '%'});
					if (increserValue >= 50) {
						jQ(sliderParent).find(".increser").css({width: increserValue - 1 + '%'});
						jQ(sliderParent).find(".decreser").css({textIndent: increserValue - 1 + '%'});
					}
				});		
		
		
		
		
		}
		
		
    };  
})(jQuery);
   




