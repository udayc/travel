@extends('app')

@section('content')


<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">




    <div class="row">	
      <div class="col-md-12">
        <h3>{{ $post->name }}
			<br>
			<span>by {{ $post->user()->first()->name }}</span>		
		</h3> 

<p>
Payment information 

Your payment method will not be charged at this time. If the project is successfully funded, your payment method will be charged ${{ $rewardLogRowDecodedObj->backing->amount}} when the project ends. 
@if($getReceiverAccount == Null)
<br/><span style="color:red">
Note : Receiver payment account details is not yet configured. Please make sure that receiver account details is configured properly .</span>
@endif
</p>		
		</div>
    </div>
	
	
	
    <div class="row">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-12 col-md-4">
        
        
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h2 class="panel-title display-td" >Payment Details</h2>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
				
				
	<form action="/checkout/payments" method="post" id="example-form" style="display: none;">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="currency" value="{{ $_settings_data->currency }}" />
	<input type="hidden" name="_log_id_" value="{{ $rewardLogId }}" />
            <div class="form-row">
                <label for="name" class="stripeLabel">Your Name</label>
                <input type="text" name="name" class="required" />
            </div>            
    
            <div class="form-row">
                <label for="email">E-mail Address</label>
                <input type="text" name="email" class="required" />
            </div>            
    
            <div class="form-row">
                <label>Card Number</label>
                <input type="text" maxlength="20" autocomplete="off" class="card-number stripe-sensitive required" />
            </div>
            
            <div class="form-row">
                <label>CVC</label>
                <input type="text" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive required" />
            </div>
            
            <div class="form-row">
                <label>Expiration</label>
                <div class="expiry-wrapper">
                    <select class="card-expiry-month stripe-sensitive required">
                    </select>
                    <script type="text/javascript">
                        var select = $(".card-expiry-month"),
                            month = new Date().getMonth() + 1;
                        for (var i = 1; i <= 12; i++) {
                            select.append($("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))
                        }
                    </script>
                    <span> / </span>
                    <select class="card-expiry-year stripe-sensitive required"></select>
                    <script type="text/javascript">
                        var select = $(".card-expiry-year"),
                            year = new Date().getFullYear();
                        for (var i = 0; i < 12; i++) {
                            select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                        }
                    </script>
                </div>
            </div>
			<br/>
            <button type="submit" name="submit-button">Submit</button>
            <span class="payment-errors"></span>
        </form>

        <!-- 
            The easiest way to indicate that the form requires JavaScript is to show
            the form with JavaScript (otherwise it will not render). You can add a
            helpful message in a noscript to indicate that users should enable JS.
        -->
        <script>$("#example-form").show()</script>
        <noscript><p>JavaScript is required for the registration form.</p></noscript>			
        </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
            
            
        </div>            
        
        <div class="col-xs-12 col-md-8" style="font-size: 12pt; line-height: 2em;">
            <p><h1>Features:</h1>
                <ul>
                    <li>As-you-type, input formatting</li>
                    <li>Form field validation (also as you type)</li>
                    <li>Graceful error feedback for declined card, etc</li>
                    <li>AJAX form submission w/ visual feedback</li>
                    <li>Creates a Stripe credit card token</li>
                </ul>
            </p>
            <p>Be sure to replace the dummy API key with a valid Stripe API key.</p>
            
            
        </div>
        
    </div>	
	
	
	
	
	
	
	
	
	
	

</div>
</div>
<!-- inner page area closed --> 



@endsection




@section('styles')	
@endsection

@section('scripts')
		
		
		 <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		
		
		
		
		
<script type="text/javascript">
         @if($getReceiverAccount != Null) 
		 Stripe.setPublishableKey('{{ $getReceiverAccount->public_key}}');
		 @endif
            $(document).ready(function() {
                function addInputNames() {
                    // Not ideal, but jQuery's validate plugin requires fields to have names
                    // so we add them at the last possible minute, in case any javascript 
                    // exceptions have caused other parts of the script to fail.
                    $(".card-number").attr("name", "card-number")
                    $(".card-cvc").attr("name", "card-cvc")
                    $(".card-expiry-year").attr("name", "card-expiry-year")
                }
                function removeInputNames() {
                    $(".card-number").removeAttr("name")
                    $(".card-cvc").removeAttr("name")
                    $(".card-expiry-year").removeAttr("name")
                }
                function submit(form) {
                    // remove the input field names for security
                    // we do this *before* anything else which might throw an exception
                    removeInputNames(); // THIS IS IMPORTANT!
                    // given a valid form, submit the payment details to stripe
                    $(form['submit-button']).attr("disabled", "disabled")
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(), 
                        exp_year: $('.card-expiry-year').val()
                    }, function(status, response) {
                        if (response.error) {
                            // re-enable the submit button
                            $(form['submit-button']).removeAttr("disabled")
        
                            // show the error
                            $(".payment-errors").html(response.error.message);
                            // we add these names back in so we can revalidate properly
                            addInputNames();
                        } else {
                            // token contains id, last4, and card type
                            var token = response['id'];
                            // insert the stripe token
                            var input = $("<input name='stripeToken' value='" + token + "' style='display:none;' />");
                            form.appendChild(input[0])
                            // and submit
                            form.submit();
                        }
                    });
                    
                    return false;
                }
                
                // add custom rules for credit card validating
                jQuery.validator.addMethod("cardNumber", Stripe.validateCardNumber, "Please enter a valid card number");
                jQuery.validator.addMethod("cardCVC", Stripe.validateCVC, "Please enter a valid security code");
                jQuery.validator.addMethod("cardExpiry", function() {
                    return Stripe.validateExpiry($(".card-expiry-month").val(), 
                                                 $(".card-expiry-year").val())
                }, "Please enter a valid expiration");
                // We use the jQuery validate plugin to validate required params on submit
                $("#example-form").validate({
                    submitHandler: submit,
                    rules: {
                        "card-cvc" : {
                            cardCVC: true,
                            required: true
                        },
                        "card-number" : {
                            cardNumber: true,
                            required: true
                        },
                        "card-expiry-year" : "cardExpiry" // we don't validate month separately
                    }
                });
                // adding the input field names is the last step, in case an earlier step errors                
                addInputNames();
            });
        </script>
    		
		
		
		
		
		
		
		
		
		
		
		
		
		

@stop