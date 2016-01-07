<?php namespace App\Http\Controllers;

 
use App\Models\Project;
Use App\Models\Category;
Use App\Models\Genre ;
Use App\Models\Reward;
Use App\Models\Menu ; 
Use App\Models\Banner ; 
Use App\Models\ProjectFund;
use App\Models\User;
use App\Models\MessageHeader;
use App\Models\Message;
Use App\Setting;
Use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
Use Facebook;

use App\Repositories\ProjectRepository;
use Auth;
use Mail;
use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class CheckoutController extends Controller {

	protected $project_repo;	
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(LaravelFacebookSdk $fb ,  Menu $menu , ProjectRepository $project_repo )
	{
		$this->middleware('auth');
		$this->menuItems	= $menu->where('active' , '1')->orderBy('weight' , 'asc')->get();	
		$this->login_url 	= $fb->getLoginUrl(['email']);	
		$this->project_repo = $project_repo;		

	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		$authId 			= 	Auth::user()->id ; 		
		$rewardLogId		=   ( \Input::get('r') ) ? \Input::get('r') : Null ;


		$rewardLogRow 				= \App\Models\RewardsLogDuringPayment::where('id' , $rewardLogId)->first();
		$rewardLogRowDecodedObj 	= json_decode($rewardLogRow->array_obj);
		
		$post 			= 	\App\Models\Project :: findOrFail($rewardLogRowDecodedObj->project_id); 
		//dd( $decoded_obj->backing->amount);
		$getReceiverAccount = ($post->user_id) ? ( \App\Models\ReciverAccount::where('user_id' , $post->user_id)->first() ) : Null;
		

		
		
	
	
	
		
		return view('checkout.index' , [
		'_menus' 					=>	$this->menuItems , 		
		'login_url' 				=>	$this->login_url ,
		'post'      				=>	$post,
		'rewardLogId'				=>  $rewardLogId,
		'rewardLogRowDecodedObj' 	=>	$rewardLogRowDecodedObj,
		'getReceiverAccount'		=> $getReceiverAccount
			
		]);
	}
	
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}	
		
	
	
	
	
	

	public function postPayments(Request $request)
	{
		$authId 			= 	Auth::user()->id ; 
		//dd($authId);
		//$getReceiverAccount = \App\Models\ReciverAccount::where('user_id' , $authId)->first();
		//dd($getReceiverAccount);
		
		

		
		$rewardLogId 				= $request->input('_log_id_');		
		$rewardLogRow 				= \App\Models\RewardsLogDuringPayment::where('id' , $rewardLogId)->first();
		$rewardLogRowDecodedObj 	= json_decode($rewardLogRow->array_obj);
		$project_id					= $rewardLogRowDecodedObj->project_id ; 	
		$backingAmount 				= $rewardLogRowDecodedObj->backing->amount;
		$stripeToken 				= $request->input('stripeToken');
		$currency					= $request->input('currency');
		$error = '' ; 
		
	$post 			= 	\App\Models\Project :: findOrFail($rewardLogRowDecodedObj->project_id); 	
	$getReceiverAccount = ($post->user_id) ? ( \App\Models\ReciverAccount::where('user_id' , $post->user_id)->first() ) : Null;		
	
		if( $getReceiverAccount->secret_key ) { 
			//\Stripe\Stripe::setApiKey(\Config::get('stripe.stripe.secret'));
			\Stripe\Stripe::setApiKey($getReceiverAccount->secret_key);
		} 		

		  
		  try {
			
			// throw new Exception("The Stripe Token was not generated correctly");
			$post 			= 	\App\Models\Project :: findOrFail($project_id); 
			  
			$charge =	\Stripe\Charge::create(array("amount" 			=> $backingAmount * 100,
										"currency" 			=> $currency,
										"capture"			=> false,
										"card" 				=> $stripeToken ,
										"description" 		=> 'Captured  amount #' . $backingAmount.$currency . ' for pledge project-id #' . $project_id	
										
										),
											array(
											'idempotency_key' => $this->generateRandomString(),
											)
										
										);
										
			
			//echo $charge->status;
			//dd($charge);
			
			if( $charge->status	== 'succeeded' ) { 
			$transactionId 		= 	$charge->id;
			$actionMsg_1		=	Auth::user()->name  . ' has pledged for project  # ' .  $post->name	;
			$actionMsg_2		=	Auth::user()->name  . ' has invested '.$backingAmount.$currency . ' for project  # ' .  $post->name	;
			
			$settingsRow  = \App\Setting::where('config_key' , 'commission_from_each_fund')->first() ; 
			$commissionVal = $settingsRow->config_value;
			
			$projectFunds 								= new \App\Models\ProjectFund();
			$projectFunds->P_ID 						= $project_id; 
			$projectFunds->U_ID 						= Auth::user()->id; 
			$projectFunds->paid_amount 					= $backingAmount; 
			$projectFunds->site_commission 				= ($backingAmount * $commissionVal) / 100; 
			$projectFunds->amount_to_project_owner 		= ($backingAmount) - ( ($backingAmount * $commissionVal) / 100 ); 
			$projectFunds->status 									= 'Pledged'; 
			$projectFunds->rewards_log_during_payment_id 			= $rewardLogId; 
			$projectFunds->transaction_id 							= $transactionId; 
			$projectFunds->save();
			
			// commission_from_each_fund
			
			\Event::fire('transaction.log' , new \App\Events\Transaction($request , [ 
																						'transaction_id' 	=> $transactionId ,
																						'user_id' 			=> Auth::user()->id , 		
																						'msg'				=> $actionMsg_1 ,
																						'credit' 			=> '0.00',
																						'debit'  			=> $backingAmount,				
																						'status' 			=> 'Pledged'	] ));
																										 
			 
			\Event::fire( 'activity.log' , new \App\Events\Activity($request , [ 
																					'project_id' 	=> $project_id, 
																					'user_id' 		=> Auth::user()->id , 
																					'action' 		=> 'invested' , 
																					'msg'			=> $actionMsg_2 ] ));

			}	
			
		  }
		  catch (Exception $e) {
			$e_json 		= $e->getMessage();
			$error 			= $e_json['error'];
			return \Redirect::to('checkout/payments')->withInput()->with('stripe_errors',$error['message'])	;			
		  }		
		
		return \Redirect::to('checkout/success');
		
		
	}
	
	public function getSuccess()
	{
		
		return view('checkout.pay-success' , [
					'_menus' 					=>	$this->menuItems , 		
					'login_url' 				=>	$this->login_url ,

		]);
	}		
		
		
		
	//}
	
	
	public function getAdapt()
	{
		
		return view('checkout.adapt' , [
					'_menus' 					=>	$this->menuItems , 		
					'login_url' 				=>	$this->login_url ,

		]);
	}		
		
	public function postNewpayments(Request $request)
	{
		$startDate=date("Y-m-d");
		$endDate=Date('Y-m-d', strtotime("+3 days"));
		
	
	
		// Create PayPal object.
		$PayPalConfig = array(
							  'Sandbox' => env('SET_SANDBOX'),
							  'DeveloperAccountEmail' => env('SANDBOX_LOGIN_USER'),
							  'ApplicationID' => env('APPLICATION_ID'),
							  'DeviceID' => env('DEVICE_ID'),
							  'IPAddress' => $_SERVER['REMOTE_ADDR'],
							  'APIUsername' => env('SANDBOX_API_USERNAME'),
							  'APIPassword' => env('SANDBOX_API_PASSWORD'),
							  'APISignature' => env('SANDBOX_API_SIGNATURE'),
							  'APISubject' => env('API_SUBJECT'), 
							  'PrintHeaders' => env('PRINT_HEADER'),
							  'LogResults' => env('LOG_RESULT'), 
							  'LogPath' => env('LOG_PATH'),
							);

		$PayPal = new \App\Classes\Adaptive($PayPalConfig);
		//$PayPal = \App\Classes\Adaptive;

		// Prepare request arrays
		$PreapprovalFields = array(
								   'CancelURL' => env('DOMAIN').'cancel.php',    								// Required.  URL to send the browser to after the user cancels.
								   'CurrencyCode' => 'USD', 							// Required.  Currency Code.
								   'DateOfMonth' => '', 							// The day of the month on which a monthly payment is to be made.  0 - 31.  Specifying 0 indicates that payment can be made on any day of the month.
								   'DayOfWeek' => '', 								// The day of the week that a weekly payment should be made.  Allowable values: NO_DAY_SPECIFIED, SUNDAY, MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY
								   'EndingDate' => $endDate, 									// Required.  The last date for which the preapproval is valid.  It cannot be later than one year from the starting date.
								   'IPNNotificationURL' => 'http://testyourprojects.net/matrix/project/uday/demo/notify.php', 						// The URL for IPN notifications.
								   'MaxAmountPerPayment' => '10', 					// The preapproved maximum amount per payment.  Cannot exceed the preapproved max total amount of all payments.
								   'MaxNumberOfPayments' => '', 					// The preapproved maximum number of payments.  Cannot exceed the preapproved max total number of all payments. 
								   'MaxTotalAmountOfPaymentsPerPeriod' => '', 	// The preapproved maximum number of all payments per period.
								   'MaxTotalAmountOfAllPayments' => '', 			// The preapproved maximum total amount of all payments.  Cannot exceed $2,000 USD or the equivalent in other currencies.
								   'Memo' => '', 									// A note about the preapproval.
								   'PaymentPeriod' => '', 							// The pament period.  One of the following:  NO_PERIOD_SPECIFIED, DAILY, WEEKLY, BIWEEKLY, SEMIMONTHLY, MONTHLY, ANNUALLY
								   'PinType' => '', 								// Whether a personal identification number is required.  It is one of the following:  NOT_REQUIRED, REQUIRED
								   'ReturnURL' => 'http://testyourprojects.net/matrix/project/uday/demo/notify.php', 								// URL to return the sender to after approving at PayPal.
								   'SenderEmail' => '', 							// Sender's email address.  If not specified, the email address of the sender who logs on to approve is used.
								   'StartingDate' => $startDate,  							// Required.  First date for which the preapproval is valid.  Cannot be before today's date or after the ending date.
								   'FeesPayer' => '', 								// The payer of the PayPal fees.  Values are:  SENDER, PRIMARYRECEIVER, EACHRECEIVER, SECONDARYONLY
								   'RequireInstantFundingSource' => '',             // Boolean (true/false).  Whether the PayPal user account must have an instant funding source for preapproval to be available.
								   'DisplayMaxTotalAmount' => ''					// Whether to display the max total amount of this preapproval.  Values are:  true/false
								   );

		$ClientDetailsFields = array(
									 'CustomerID' => '', 						// Your ID for the sender.
									 'CustomerType' => '', 						// Your ID of the type of customer.
									 'GeoLocation' => '', 						// Sender's geographic location.
									 'Model' => '', 							// A sub-id of the application
									 'PartnerName' => ''						// Your organization's name or ID.
									 );

		$PayPalRequestData = array(
							 'PreapprovalFields' => $PreapprovalFields, 
							 'ClientDetailsFields' => $ClientDetailsFields
							 );


		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->Preapproval($PayPalRequestData);

		//echo $PayPalResult['RedirectURL'];
		//header('Location: '.$PayPalResult['RedirectURL']);
		//echo '<pre />';
		//print_r($PayPalResult['Ack']);
		//echo "==================";
		//exit;	
		if($PayPalResult['Ack']=="Success")
		{
			$pledgeAmount = new PledgeAmount;
			echo $request->get('amount');
			$pledgeAmount->amount = $request->get('amount');
			$pledgeAmount->PreapprovalKey = $PayPalResult['PreapprovalKey'];
			$pledgeAmount->CorrelationID = $PayPalResult['CorrelationID'];
			$pledgeAmount->RedirectURL = $PayPalResult['RedirectURL'];
			$pledgeAmount->status = '0';
			
			$pledgeAmount->save();
		}
	}
	
	
	
	


}
