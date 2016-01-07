


var RewordValidator = function () {
    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        var form1 = $('#form');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $.validator.addMethod("FullDate", function () {
            //if all values are selected
            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") {
                return true;
            } else {
                return false;
            }
        }, 'Please select a day, month, and year');
        $('#form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                firstname: {
                    minlength: 2,
                    required: true
                },
                lastname: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 6,
                    required: true
                },
                password_again: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                yyyy: "FullDate",
                gender: {
                    required: true
                },
                zipcode: {
                    required: true,
                    number: true,
                    minlength: 5,
                    minlength: 5
                },
                city: {
                    required: true
                },
                newsletter: {
                    required: true
                }
            },
            messages: {
                firstname: "Please specify your first name",
                lastname: "Please specify your last name",
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                gender: "Please check a gender!"
            },
            groups: {
                DateofBirth: "dd mm yyyy",
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler1.hide();
                errorHandler1.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler1.show();
                errorHandler1.hide();
                // submit form
                //$('#form').submit();
            }
        });
    };



     

       

        var runValidator12 = function () {  
            
        var form12 = $('#addprojectthird'); 
        var errorHandler12 = $('.errorHandler', form12);
        var successHandler12 = $('.successHandler', form12);
        
        form12.validate({
            errorElement: "span",  
            errorClass: 'help-block', 
            ignore: "", 
            invalidHandler: function (event, validator) { /* display error alert on form submit */
                successHandler12.hide();
                errorHandler12.show();
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

         $('[name^=pledge_amount], input[type="file"], textarea, select, [name^=shipping_details]').each(function () {
                $(this).rules('add', {
                    required: true
                }); 
        }); 

        /*
        $( 'input[type="text"]' ).each(function () {
                $(this).rules('add', {
                    required: true
                }); 
        }); 


        $('select,textarea,input[type="file"]').each(function () {
                $(this).rules('add', {
                    required: true
                }); 
        }); 
        */

    };

 
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



    /* function to initiate Validation Sample 2 */
    var runValidator2 = function () {
        var form2 = $('#form2');
        var errorHandler2 = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        $.validator.addMethod("getEditorValue", function () {
            $("#editor1").val($('.summernote').code());
            if ($("#editor1").val() != "" && $("#editor1").val() != "<br>") {
                $('#editor1').val('');
                return true;
            } else {
                return false;
            }
        }, 'This field is required.');
        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                firstname2: {
                    minlength: 2,
                    required: true
                },
                lastname2: {
                    minlength: 2,
                    required: true
                },
                email2: {
                    required: true,
                    email: true
                },
                occupation: {
                    required: true
                },
                dropdown: {
                    required: true
                },
                services: {
                    required: true,
                    minlength: 2
                },
                creditcard: {
                    required: true,
                    creditcard: true
                },
                url: {
                    required: true,
                    url: true
                },
                zipcode2: {
                    required: true,
                    number: true,
                    minlength: 5,
                    minlength: 5
                },
                city2: {
                    required: true
                },
                editor1: "getEditorValue",
                editor2: {
                    required: true
                }
            },
            messages: {
                firstname: "Please specify your first name",
                lastname: "Please specify your last name",
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                services: {
                    minlength: jQuery.format("Please select  at least {0} types of Service")
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler2.show();
                errorHandler2.hide();
                // submit form
                //$('#form2').submit();
            }
        });
        $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });
        CKEDITOR.disableAutoInline = true;
        $('textarea.ckeditor').ckeditor();
    };
	
    var runValidatorProfileForm = function () { 
        

        var profileEditForm = $('#profile-form'); 
        var errorHandler3 = $('.errorHandler', profileEditForm);
        var successHandler3 = $('.successHandler', profileEditForm);
        
        profileEditForm.validate({
            errorElement: "span",  
            errorClass: 'help-block', 
            ignore: "",
            rules: {
                "f_name": 	{  required: true } ,
                "l_name": 	{  required: true } ,
                "dob": 		{  required: true } ,
                "about_me": {  required: true } ,
                "user_avtar": {  required: {
                    depends: function(element){
                        return $("#oldimage").val()==""
                        }
                    } } ,
            }, 
            invalidHandler: function (event, validator) { /* display error alert on form submit */
                successHandler3.hide();
                errorHandler3.show();
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
    }; 	
	
	 	
	
	
    return {
        //main function to initiate template pages
        init: function () {
            runValidator1();
            runValidator2(); 
            runValidator12(); 
            runValidator90(); 
        }
    };
}();