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



	Route::resource('/admin/dashboard', 'DashboardController');	 
	



	/* Route for User START */ 
	//Route::get('/admin/user/sendmsg',  [ 'uses' => 'UserController@sendmsg'] );
	//Route::post('admin/user/sendemail',  [ 'uses' => 'UserController@sendemail'] ); 
	//Route::get('admin/user/exportselected/{id}', 'UserController@exportselected');  
	//Route::post('/admin/user/search' , ['uses' => 'UserController@search' , 'as' => 'posts.search']);
	//Route::post('/admin/user/searchparameter', 'UserController@searchparameter'); 
	//Route::any('/admin/user/unsetsearchparameter',  'UserController@unsetsearchparameter' );  
	//Route::get('/admin/user/approvedrec',  'UserController@approvedrec' );
	//Route::get('/admin/user/disapprovedrec',  'UserController@disapprovedrec' ); 
	
	//Route::resource('/admin/user', 'UserController');
	
	//Route::post('/admin/user/massaction/{actiontype}' , ['uses' => 'UserController@postMassaction' , 'as' => 'massAction']);	
	//Route::post('/admin/user/search' , ['uses' => 'UserController@search' , 'as' => 'posts.search']);
	
	Route::controller('/admin/user', 'UserController' ); 	
	Route::resource('/admin/user', 'UserController', ['only' => ['index', 'create', 'store', 'show','edit', 'update', 'destroy' ]] ); 
					
	//Route::get('admin/user/create',  [ 'uses' => 'UserController@create'] );
	//Route::post('admin/user/store',  [ 'uses' => 'UserController@store'] );  
	//Route::post('/admin/user/massaction/{actiontype}' , ['uses' => 'UserController@massaction' , 'as' => 'massAction']);
	
	//Route::get('/admin/user/{id}/edit', 'UserController@edit'); 
	//Route::put('/admin/user/update/{id}', 'UserController@update');

	
	Route::get('/admin/settings/{formkey}',  ['uses' =>'SettingsController@show', 'as'=>'settingsConfig'] );
	Route::post('/admin/settings/{formkey}',  ['uses' =>'SettingsController@postshow', 'as'=>'postsettingsConfig'] ); 
	
	//Route::delete('admin/user/destroy/{id}', 'UserController@destroy');
	
	/* Route for User END */ 


	/* Route for Project START */ 
	Route::post('/admin/project/massaction/{actiontype}' , ['uses' => 'ProjectController@massaction' , 'as' => 'massAction']);
	Route::get('admin/project/exportselected/{id}', 'ProjectController@exportselected');  
	Route::post('/admin/project/search' , ['uses' => 'ProjectController@search' , 'as' => 'posts.search']);
	Route::post('/admin/project/setsessionval/{stepval}' , ['uses' => 'ProjectController@setsessionval' , 'as' => 'set.sessionval']);
	Route::resource('/admin/project', 'ProjectController');
	/* Route for Project END */ 


	
	/* Route for Category START */ 
	Route::controller('category', 'CategoryController', [ 'getShow' => 'category.show' ]); 
	Route::get('admin/category',  [ 'uses' => 'CategoryController@index'] );
	Route::get('admin/category/create',  [ 'uses' => 'CategoryController@create'] );
	Route::post('admin/category/store',  [ 'uses' => 'CategoryController@store'] ); 
	Route::get('admin/category/{id}/details', 'CategoryController@details');   
	Route::post('admin/category/searchparameter', 'CategoryController@searchparameter');  
	Route::get('admin/category/unsetsearchparameter',  'CategoryController@unsetsearchparameter' );
	Route::get('admin/category/approvedrec',  'CategoryController@approvedrec' );
	Route::get('admin/category/disapprovedrec',  'CategoryController@disapprovedrec' ); 
	Route::get('admin/category/{id}/edit', 'CategoryController@edit'); 
	Route::post('admin/category/update/{id}', 'CategoryController@update'); 
	Route::delete('admin/category/destroy/{id}', 'CategoryController@destroy');
	Route::post('/admin/category/massaction/{actiontype}' , ['uses' => 'CategoryController@massaction' , 'as' => 'massAction']); 
	Route::get('admin/category/exportselected/{id}', 'CategoryController@exportselected'); 
	/* Route for Category END */



	/* Route for Genre START */ 
	Route::controller('genre', 'GenreController', [ 'getShow' => 'genre.show' ]); 
	Route::get('admin/genre',  [ 'uses' => 'GenreController@index'] );
	Route::get('admin/genre/create',  [ 'uses' => 'GenreController@create'] );
	Route::post('admin/genre/store',  [ 'uses' => 'GenreController@store'] ); 
	Route::get('admin/genre/{id}/details', 'GenreController@details');   
	Route::post('admin/genre/searchparameter', 'GenreController@searchparameter');  
	Route::get('admin/genre/unsetsearchparameter',  'GenreController@unsetsearchparameter' );
	Route::get('admin/genre/approvedrec',  'GenreController@approvedrec' );
	Route::get('admin/genre/disapprovedrec',  'GenreController@disapprovedrec' ); 
	Route::get('admin/genre/{id}/edit', 'GenreController@edit'); 
	Route::post('admin/genre/update/{id}', 'GenreController@update'); 
	Route::delete('admin/genre/destroy/{id}', 'GenreController@destroy');
	Route::post('/admin/genre/massaction/{actiontype}' , ['uses' => 'GenreController@massaction' , 'as' => 'massAction']); 
	Route::get('admin/genre/exportselected/{id}', 'GenreController@exportselected'); 
	/* Route for Category END */



	/* Route for Menu START */  
	Route::controller('menu', 'MenuController', [ 'getShow' => 'menu.show' ]); 
	Route::get('admin/menu',  [ 'uses' => 'MenuController@index'] );
	Route::get('admin/menu/create',  [ 'uses' => 'MenuController@create'] );
	Route::post('admin/menu/store',  [ 'uses' => 'MenuController@store'] ); 
	Route::get('admin/menu/{id}/details', 'MenuController@details');   
	Route::post('admin/menu/searchparameter', 'MenuController@searchparameter');  
	Route::get('admin/menu/unsetsearchparameter',  'MenuController@unsetsearchparameter' );
	Route::get('admin/menu/approvedrec',  'MenuController@approvedrec' );
	Route::get('admin/menu/disapprovedrec',  'MenuController@disapprovedrec' ); 
	Route::get('admin/menu/{id}/edit', 'MenuController@edit'); 
	Route::post('admin/menu/update/{id}', 'MenuController@update'); 
	Route::delete('admin/menu/destroy/{id}', 'MenuController@destroy');
	Route::post('/admin/menu/massaction/{actiontype}' , ['uses' => 'MenuController@massaction' , 'as' => 'massAction']);
	Route::get('admin/menu/exportselected/{id}', 'MenuController@exportselected'); 
	 
	/* Route for Menu END */  




	/* Route for Banner START */ 

	Route::controller('banner', 'BannerController', [ 'getShow' => 'banner.show' ]); 
	Route::get('admin/banner',  [ 'uses' => 'BannerController@index'] );
	Route::get('admin/banner/create',  [ 'uses' => 'BannerController@create'] );
	Route::post('admin/banner/store',  [ 'uses' => 'BannerController@store'] ); 
	Route::get('admin/banner/{id}/details', 'BannerController@details');   
	Route::post('admin/banner/searchparameter', 'BannerController@searchparameter');  
	Route::get('admin/banner/unsetsearchparameter',  'BannerController@unsetsearchparameter' );
	Route::get('admin/banner/approvedrec',  'BannerController@approvedrec' );
	Route::get('admin/banner/disapprovedrec',  'BannerController@disapprovedrec' ); 
	Route::get('admin/banner/{id}/edit', 'BannerController@edit'); 
	Route::post('admin/banner/update/{id}', 'BannerController@update'); 
	Route::delete('admin/banner/destroy/{id}', 'BannerController@destroy');
	Route::post('/admin/banner/massaction/{actiontype}' , ['uses' => 'BannerController@massaction' , 'as' => 'massAction']);
	Route::get('admin/banner/exportselected/{id}', 'BannerController@exportselected'); 
	/* Route for Banner END */  
	
	


});


	Route::get('auth/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
	{		
		$menuItems		= App\Models\Menu::where('active' , '1')->orderBy('weight' , 'asc')->get();
		$login_url 		= $fb->getLoginUrl(['email']);	
		return view('auth.login' , ['setClass' => 'grayBody', 'login_url' => $login_url , '_menus' => $menuItems  ] );
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
			$logoutUrl = $helper->getLogoutUrl($token, 'http://dev.musicfunder.com/auth/logout');	
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

Route::get('home', 'HomeController@index');
Route::get('project/lists/{exploreBy?}/{slug?}'	, 		array('as' => 'project.lists', 'uses' => 'ProjectController@getLists')	); 
Route::get('project/{id}/{slug?}'		, 		array('as' => 'project.show', 'uses' => 'ProjectController@getShow')	); 

Route::get('/admin' , function(){
	return redirect('/auth/login');
});


Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::post('listProjectByCat', array( 'as'=> 'welcome.listProjectByCat', 'uses'=>'WelcomeController@postListProjectByCat' ) );

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::controller('/', 'WelcomeController');
Route::controller('project', 'ProjectController');
