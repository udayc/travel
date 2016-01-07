// Create jquery plugins

	( function($){



		$.fn.addRewardsRow = function( options ) {

        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            buttonID: "add-row",
            rowId: "timesheet-row"
        }, options );

			var $suggestionbutton 		= $('#'+settings.buttonID);	
			$("#"+settings.buttonID).click(function() {	
				$('#'+ settings.rowId).clone().insertBefore( $suggestionbutton  ).find("input:text").val("");
			});
			
			return this ;

		}


	}(jQuery));