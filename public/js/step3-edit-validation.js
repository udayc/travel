


var RewordValidator = function () {
    // function to initiate Validation Sample 1


        var runValidator90 = function () {  
            
        var form90 = $('#addprojectthirde'); 
        var errorHandler90 = $('.errorHandler', form90);
        var successHandler90 = $('.successHandler', form90);
        
        form90.validate({
            errorElement: "span",  
            errorClass: 'help-block', 
            ignore: "", 
            invalidHandler: function (event, validator) { /* display error alert on form submit */
                successHandler90.hide();
                errorHandler90.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                /* display OK icon */
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                /* add the Bootstrap error class to the control group */
            },
            unhighlight: function (element) { /* revert the change done by hightlight */
                $(element).closest('.form-group').removeClass('has-error');
                /* set error class to the control group */
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                /* mark the current input as valid and display OK icon */
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
               form.submit();
            }
        }); 

		
         $('[name^=pledge_amount], textarea, select, [name^=shipping_details]').each(function () {
                $(this).rules('add', {
                    required: true
                }); 
        }); 

 

    };




	

	
	 	
	
	
    return {
        //main function to initiate template pages
        init: function () {
            runValidator90(); 
        }
    };
}();