<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

	Route::group(['namespace'=> 'Admin' , 'middleware' => 'auth'] , function(){	
		Route::controller('/admin/dashboard'	, 'DashboardController' 	); 	
		Route::controller('/admin/agent'		, 'AgentController' 	);
		Route::controller('/admin/message'		, 'MessageController' 	);
		Route::controller('/admin/destination'		, 'DestinationController' 	);
	});
	Route::controller('home', 			'HomeController'		);
	Route::controller('agent', 			'AgentController'		);
	
	
	Route::get('/change-captcha-image', function(){
		return captcha_src();
	});
	
	Route::resource('project-comment', 'ProjectCommentController');	
	
	
	
	
	
	Route::controller('checkout', 		'CheckoutController'	);
	Route::controller('cron', 			'CronController'	);
	Route::controller('user', 			'UserController'		);
	Route::post('home/refund', 'HomeController@postRefund');
	Route::get('auth/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
	{		
		$menuItems		= App\Models\Menu::where('active' , '1')->orderBy('weight' , 'asc')->get();
		$login_url 		= $fb->getLoginUrl(['email']);	
		return view('auth.login' , ['setClass' => 'grayBody', 'login_url' => $login_url , '_menus' => $menuItems  ] );
	});

	Route::get('auth/register', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
	{		
		$menuItems		= App\Models\Menu::where('active' , '1')->orderBy('weight' , 'asc')->get();
		$login_url 		= $fb->getLoginUrl(['email']);	
		return view('auth.register' , ['setClass' => 'grayBody', 'login_url' => $login_url , '_menus' => $menuItems  ] );
	});	
	
	
	
	


	Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb  )
	{
		
		try {
			$token = $fb->getAccessTokenFromRedirect();
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			dd($e->getMessage());
		}


		if (! $token) {
			// Get the redirect helper
			$helper = $fb->getRedirectLoginHelper();

			if (! $helper->getError()) {
				abort(403, 'Unauthorized action.');
			}
			// User denied the request
			dd(
				$helper->getError(),
				$helper->getErrorCode(),
				$helper->getErrorReason(),
				$helper->getErrorDescription()
			);
		}

		if (! $token->isLongLived()) {
			// OAuth 2.0 client handler
			$oauth_client = $fb->getOAuth2Client();

			// Extend the access token.
			try {
				$token = $oauth_client->getLongLivedAccessToken($token);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				dd($e->getMessage());
			}
		}

		$fb->setDefaultAccessToken($token);

		// Save for later
		Session::put('fb_user_access_token', (string) $token);

		// Get basic info on the user from Facebook.
		try {
			$response = $fb->get('/me?fields=id,name,email');
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			dd($e->getMessage());
		}

		// Convert the response to a `Facebook/GraphNodes/GraphUser` collection
		$facebook_user = $response->getGraphUser();
		// Create the user if it does not exist or update the existing entry.
		// This will only work if you've added the SyncableGraphNodeTrait to your User model.
	  
		

		$name 	= $facebook_user['name'];
		$email 	= $facebook_user['email'];
		$u_name = preg_replace('/@.*$/', '', $email);
		$input['email'] = $email;
		
		$rules 			= array('email' => 'unique:users,email');
		$validator 		= Validator::make($input, $rules);
		$credentials = array('email' => $email,	'password' => $u_name);
		if ($validator->fails()) {
			$user = App\User::where('email', $email)->first();		
			Auth::login($user);
			 $helper = $fb->getRedirectLoginHelper();
			$logoutUrl = $helper->getLogoutUrl($token, 'http://mfunder.testyourprojects.net/auth/logout');	
			//echo $logoutUrl; exit;		
			return redirect('/home')->with('logoutUrl', $logoutUrl);
			
		}
		else 
		{
			// Register the new user or whatever.
			$user = new App\User();
			$user->name 				= $name ;
			$user->type 				= 'general';
			$user->register_type 		= 'facebook';
			$user->username 			= $u_name;			
			$user->email 				= $email;
			$user->password 			= bcrypt($u_name);
			$user->save();	
			
			$user_obj = App\User::where('email', $email)->first();	
			$profile = new App\Profile();
			$profile->user_id = $user_obj->id;
			//$profile = $user->profile()->save($profile);	
			$profile->save();		

			if (Auth::attempt($credentials)) {				
					return redirect('/home')->with('message', 'Successfully logged in with Facebook');
			}

		}


	});
	//==============================
	//==============================
	Route::get('google', 'AccountController@google_redirect');
	Route::get('account/google', 'AccountController@google');
	
	Route::get('twitter', 'AccountController@twitter_redirect');
	Route::get('account/twitter', 'AccountController@twitter');


	//Route::any('project/json-reminder', array('uses' => 'ProjectController@postJsonReminder'));
	Route::get('project/citylist/{id}', 		'ProjectController@citylist');
	Route::get('project/changepresentstatus/{id}', 'ProjectController@getChangepresentstatus');	
	Route::get('project/preview', 				'ProjectController@getPreview');
	
	Route::group(['middleware' => 'auth'] , function(){
	
		Route::get('project/startaproject'			,	array('as' => 'project.startaproject', 			'uses' => 'ProjectController@getStartaproject') 		);
		Route::get('project/projectedit'			,	array('as' => 'project.projectedit', 			'uses' => 'ProjectController@projectedit') 				);
		Route::get('project/pledge/'				, 	array('as' => 'project.pledge', 				'uses' => 'ProjectController@getPledge')				);	
		
	});

	Route::get('project/submitapprocal/{id}', 			array('as' => 'project.submitapprocal', 'uses' => 'ProjectController@submitapprocal')				);	
	Route::get('project/setaslive/{id}', 				array('as' => 'project.setaslive', 'uses' => 'ProjectController@setaslive')				);	

	Route::post('project/widget/{id}', 		array('as' => 'project.widget', 'uses' => 'ProjectController@getWidget')		);
	Route::post('project/pupdate/{id}/{update_text}/{create_title}', 		array('as' => 'project.comments', 'uses' => 'ProjectController@postPupdate')		);
	Route::post('project/pedit/{id}/{create_title}/{create_text}', 		array('as' => 'project.comments', 'uses' => 'ProjectController@postPedit')		);
	Route::post('project/pdelete/{update_id}', 		array('as' => 'project.commentsdel', 'uses' => 'ProjectController@postPdelete')		);
	
	Route::get('project/updaterank/{id}', 		array('as' => 'project.updatedrank', 'uses' => 'ProjectController@getUpdaterank')		);
	Route::post('project/contact-me', 			array('as' => 'project.contactme', 'uses' => 'ProjectController@postContactMe') 		);
	Route::post('project/reply-msg', 			array('as' => 'project.replymsg', 'uses' => 'ProjectController@postReplyMsg') 			);
	Route::post('project/pledge-amount', 		array('as' => 'project.pledgeamount', 'uses' => 'ProjectController@postPledgeAmount')	);
	
	//Route::get('project/lists/{exploreBy?}/{slug?}'	, 		array('as' => 'project.lists', 'uses' => 'ProjectController@getLists')	); 
	//Route::get('project/{id?}/{slug?}'		, 				array('as' => 'project.show', 'uses' => 'ProjectController@getShow')	); 


	
	//Route::post('project/setsessionval', 'ProjectController@setsessionval');
	Route::post('project/setsessioneval', 'ProjectController@setsessioneval');
	Route::get('project/sendmsgtoowner/{id}/{msg}', 'ProjectController@sendmsgtoowner');

	//Route::get('home', 'HomeController@index');
	//Route::get('project/lists/{exploreBy?}/{slug?}',array('as'=>'project.lists','uses'=>'ProjectController@getLists'));  
	//Route::get('project/{id}/{slug?}' , array('as' => 'project.show', 'uses' => 'ProjectController@getShow') ); 
	

	Route::get('project/ask-a-question/{projectId}', 'ProjectController@getAjaxAskAboutProject');
	//Route::post('project/ask-a-question/{projectId}', 'ProjectController@postAjaxAskAboutProject');
	Route::get('project/report-violation/{projectId}', 'ProjectController@getAjaxReportProjectViolation');
	//Route::post('project/report-violation/{projectId}', 'ProjectController@postAjaxReportProjectViolation');
	
	
	//Route::get('home', 'HomeController@index');
	Route::get('project/lists/{exploreBy?}/{slug?}', array('as' => 'project.lists', 'uses' => 'ProjectController@getLists')	); 
	Route::get('project/json-reminder', array('uses' => 'ProjectController@getJsonReminder'));
	
	Route::get('project/{id}/{slug?}', array('as' => 'project.show', 'uses' => 'ProjectController@getShow')	); 
Route::controller('project', 'ProjectController');

	Route::get('/admin' , function(){
		return redirect('/auth/login');
	});



	Route::get('/admin' , function(){	return redirect('/auth/login');	});
	Route::post('auth/register', 'Auth\AuthController@postRegister');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	

	Route::post('listProjectByCat', array( 'as'=> 'welcome.listProjectByCat', 'uses'=>'WelcomeController@postListProjectByCat' ) );
	Route::get('pages/{slug}',  array('as' => 'page.index', 'uses' => 'PageController@getIndex'));
	

	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);


	Route::controller('/', 'WelcomeController');
	

	//Route::controller('project', 'ProjectController');
	

