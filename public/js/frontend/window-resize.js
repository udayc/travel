
 var screenn = $(window)    
   if (screen.width < 990) {
	  // alert();
         $(".ctgryLstBx-1").addClass("mobile_catMenu-1");
		 $(".ctgryLstBx-2").addClass("mobile_catMenu-2");
		 $(".ctgryLstBx-3").addClass("mobile_catMenu-3");
		 $(".ctgryLstBx-1 h5").addClass("HdArrow");
		 $(".ctgryLstBx-2 h5").addClass("HdArrow");
		 $(".ctgryLstBx-3 h5").addClass("HdArrow");
		 
		 $('.ctgryLstBx-1 h5').click(function () {
			 $('.mobile_catMenu-1 .ctgryLst').toggleClass('ctgryLstblock');
			 $('.mobile_catMenu-1 .HdArrow').toggleClass("HdArrow2");
    	 });
		 
		 $('.ctgryLstBx-2 h5').click(function () {
			 $('.mobile_catMenu-2 .ctgryLst').toggleClass('ctgryLstblock');
			 $('.mobile_catMenu-2 .HdArrow').toggleClass("HdArrow2");
    	 });
		 
		 $('.ctgryLstBx-3 h5').click(function () {
			 $('.mobile_catMenu-3 .ctgryLst').toggleClass('ctgryLstblock');
			 $('.mobile_catMenu-3 .HdArrow').toggleClass("HdArrow2");
    	 });
		   
		   
		 
     } else {
         $(".ctgryLstBx-1").removeClass("mobile_catMenu-1");
		 $(".ctgryLstBx-2").removeClass("mobile_catMenu-2");
		 $(".ctgryLstBx-3").removeClass("mobile_catMenu-3");
     }

$(window).on('resize', function () {
  var screenn = $(window)    
   if (screen.width < 990) {
	  // alert();
         $(".ctgryLstBx-1").addClass("mobile_catMenu");
		 $(".ctgryLstBx-2").addClass("mobile_catMenu");
		 $(".ctgryLstBx-3").addClass("mobile_catMenu");
     } else {
         $(".ctgryLstBx-1").removeClass("mobile_catMenu");
		 $(".ctgryLstBx-2").removeClass("mobile_catMenu");
		 $(".ctgryLstBx-3").removeClass("mobile_catMenu");
     }
  });
  
