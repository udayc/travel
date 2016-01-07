@section('styles')
<link rel="stylesheet" href="/plugins/select2/select2.css">
<link rel="stylesheet" href="/plugins/datepicker/css/datepicker.css">
<link rel="stylesheet" href="/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
<link rel="stylesheet" href="/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
<link rel="stylesheet" href="/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
<link rel="stylesheet" href="/plugins/summernote/build/summernote.css">
<!--
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
-->
@stop

@section('scripts')
<script src="/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="/plugins/autosize/jquery.autosize.min.js"></script>
<script src="/plugins/select2/select2.min.js"></script>
<script src="/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script src="/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>


<script src="/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>




<script src="/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script src="/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="/plugins/bootstrap-colorpicker/js/commits.js"></script>
<script src="/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
<script src="/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script src="/plugins/summernote/build/summernote.min.js"></script>
<script src="/plugins/ckeditor/ckeditor.js"></script>
<script src="/plugins/ckeditor/adapters/jquery.js"></script>
<script src="/js/ui-customs.js"></script>
<script src="/js/project-form-validation.js"></script>
<script src="/js/form-elements.js"></script>
<script type="text/javascript">   
	 	var editor =
			CKEDITOR.replace( 'details_description', {
						toolbar: 'Page' 
			}); 
</script>
<script>
jQuery(document).ready(function() {
	Main.init();
	FormElements.init();
	FormValidator.init();
	UICustoms.init();
});
</script>
<script>
jQuery(document).ready(function() {


$('.date-picker').datepicker({ format: 'yyyy-mm-dd' }) ;
 

 bookIndex = 0;
$('#bookForm')
        // Add button click handler
        .on('click', '.addButton', function() {
            bookIndex++;
            var $template = $('#bookTemplate'),
            $clone    = $template
                                .clone(true, true)
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-book-index', bookIndex)					
                                .insertBefore($template);

            document.getElementById('reward_row_count').value = bookIndex;
			// Update the name attributes
            //$clone
                //.find('[name="title"]').attr('name', 'book[' + bookIndex + '].title').end()
               // .find('[name="isbn"]').attr('name', 'book[' + bookIndex + '].isbn').end()
               // .find('[name="price"]').attr('name', 'book[' + bookIndex + '].price').end();

            // Add new fields
            // Note that we also pass the validator rules for new field as the third parameter
            //$('#bookForm')
               // .formValidation('addField', 'book[' + bookIndex + '].title', titleValidators)
                //.formValidation('addField', 'book[' + bookIndex + '].isbn', isbnValidators)
                //.formValidation('addField', 'book[' + bookIndex + '].price', priceValidators);
        })
		
		
		
        .on('click', '.removeButton', function() {
            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');

            // Remove fields
            //$('#bookForm')
               // .formValidation('removeField', $row.find('[name="book[' + index + '].title"]'))
               // .formValidation('removeField', $row.find('[name="book[' + index + '].isbn"]'))
               // .formValidation('removeField', $row.find('[name="book[' + index + '].price"]'));

            // Remove element containing the fields
            $row.remove();
			var reward_row_count =  document.getElementById('reward_row_count').value ;
			reward_row_count--;
			bookIndex--;
			document.getElementById('reward_row_count').value = bookIndex;
        })
		
		.on('added.field.fv', function(e, data) {
				
				if (data.field === 'estimated_delivery[]') {
					// The new due date field is just added
					// Create a new date picker
					data.element
						.parent()
						.datepicker({
							format: 'yyyy-mm-dd'
						})
						.on('changeDate', function(evt) {
							// Revalidate the date field
							//$('#bookForm').formValidation('revalidateField', data.element);
						});
				}
			})				
	
		;		
		
		
 		    	$("select#country_id").change(function(){  
			        var selectedCountry = $("#country_id").val(); 

			        if(selectedCountry !='' )
			        {
				        $.ajax({
				            type: "GET",  
				            url:base_url+'/admin/project/citylist/'+selectedCountry,
				            dataType: 'json'
				        }).done(function(cities){ 
				        	   $("#cities > option").remove(); 
				        	   $.each(cities,function(city_id,city)  {  
			                        var opt = $('<option />');  
			                        opt.val(city.cityID);
			                        opt.text(city.cityName);
			                        $('#cities').append(opt);  
	                    	  }); 
				            /*$("#response").html(data); */  
				        });
			    	}
			    	else
			    	{ 
			    		$("#cities > option").remove(); 
			    	} 
		    	});


	
});

</script>		
@stop
