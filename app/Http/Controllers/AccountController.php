<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use App\User;
use App\Profile;
use Facebook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Socialize;
use App\Http\Controllers\Auth;


class AccountController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
		$this->middleware('guest');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home' , ['setClass' => 'grayBody']);
	}
	
	public function facebook_redirect() {
		return Socialize::with('facebook')->redirect();
	}
	  // to get authenticate user data
	 public function facebook() {

	 
		$fb = new Facebook\Facebook([
		  'app_id' => '144053429274589',
		  'app_secret' => '4ef6916e238aff3b6726dac08b853135',
		  'default_graph_version' => 'v2.4',
		  'default_access_token' => 'CAACDBA17B90BAKI0aOXR1vF5zDtZCOKPbWSXopnvvNpBTHZARXVhUVrZBAXn4CB1ZBgsyk13ZA38uZAWoffwchukfajiIOG7cYrNEEAm0CdlHgwDRWeBuD0OZCfT6PB6U2vsE3O45jTgx0YTc24TXEqyZC1ZBIjc9GxD3aSv6WAyIWsZCpAcbnxYPNCdL389FxaRsZD', // optional
		]);	 
			 
	try {
	  $response = $fb->get('/me?fields=id,name,email');
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	
	$me = $response->getGraphUser();
	$name = $me['name'];
	$email = $me['email'];
	$u_name = preg_replace('/@.*$/', '', $me['email']);
	$user = new User();
	$user->name 				= $name ;
	$user->type 				= 'general';
	$user->register_type 		= 'facebook';
	$user->username 			= $u_name;			
	$user->email 				= $email;
	$user->password 			= bcrypt($u_name);
	$user->save();
	
	$lastInsertedId= $user->id; 
	
	$profile = new Profile();
	$profile = $user->profile()->save($profile);			
	$credentials = array(
		'email' => $email,
		'password' => $u_name
	);

	if (Auth::attempt($credentials)) {
			//return Redirect::to('home');
			return redirect()->intended('home');
	}

	

	//echo '<pre>'; print_r($new_name);
	//echo 'Logged in as ' . $me['email'];	 
	 
	 
	  }	
		
	public function google_redirect() {
		return \Socialize::with('google')->redirect();
	}
	// to get authenticate user data
	public function google() {		
		$google_user = \Socialize::with('google')->user();	
		//echo $google_user->email."CCC";
		//echo "<pre>";
		//print_r($google_user);
		//echo "</pre>";
		//exit;		
		//exit;		
		$name = $google_user->name;
		$email = $google_user->email;		
		$u_name = preg_replace('/@.*$/', '', $email);		
		$input['email'] = $email;
		
		$rules 			= array('email' => 'unique:users,email');
		$validator 		= \Validator::make($input, $rules);
		$credentials = array('email' => $email,	'password' => $u_name);
		if ($validator->fails()) {
			if (\Auth::attempt($credentials)) {				
					return redirect('/home')->with('message', 'Successfully logged in with Google');
			}
		}
		else 
		{		
			// Register the new user or whatever.
			$user = new User();
			$user->name 				= $name ;
			$user->type 				= 'general';
			$user->register_type 		= 'google';
			$user->username 			= $u_name;			
			$user->email 				= $email;
			$user->password 			= bcrypt($u_name);
			$user->save();	
			
			$user_obj = User::where('email', $email)->first();	
			$profile = new Profile();
			$profile->user_id = $user_obj->id;			
			$profile->save();		

			if (\Auth::attempt($credentials)) {				
					return redirect('/home')->with('message', 'Successfully logged in with Google');
			}
		}
	}
	
	public function twitter_redirect() {
		return \Socialize::with('twitter')->redirect();
	}
	public function twitter() {		
		$twitter_user = \Socialize::driver('twitter')->user();
		//echo $twitter_user->nickname."CCC";
		//echo "<pre>";
		//print_r($twitter_user);
		//echo "</pre>";
		//exit;
		$name = $twitter_user->name;
		$email = $twitter_user->email;		
		$u_name = preg_replace('/@.*$/', '', $email);		
		$input['email'] = $email;
		
		$rules 			= array('email' => 'unique:users,email');
		$validator 		= \Validator::make($input, $rules);
		$credentials = array('email' => $email,	'password' => $u_name);
		if ($validator->fails()) {
			if (\Auth::attempt($credentials)) {				
					return redirect('/home')->with('message', 'Successfully logged in with Twitter');
			}
		}
		else 
		{		
			// Register the new user or whatever.
			$user = new User();
			$user->name 				= $name ;
			$user->type 				= 'general';
			$user->register_type 		= 'twitter';
			$user->username 			= $u_name;			
			$user->email 				= $email;
			$user->password 			= bcrypt($u_name);
			$user->save();	
			
			$user_obj = User::where('email', $email)->first();	
			$profile = new Profile();
			$profile->user_id = $user_obj->id;			
			$profile->save();		

			if (\Auth::attempt($credentials)) {				
					return redirect('/home')->with('message', 'Successfully logged in with Twitter');
			}
		}
	}
	
	

}
