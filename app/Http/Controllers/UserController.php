<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;  
use Auth; 
use Session ;
Use App\Models\Menu ;
Use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
Use Facebook;
Use View , DB;
use App\Models\Project;
Use App\Models\Category;
Use App\Models\Genre ;
Use App\Models\Reward; 
Use App\Models\Banner; 
Use App\Models\ProjectFund;
use App\Models\User;
use App\Profile;
Use App\Models\Country;  
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository; 
use Illuminate\Http\Request; 
use Illuminate\Http\Response; 

class UserController extends Controller {

	protected $project_repo;
	protected $userrepo;
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
	public function __construct( LaravelFacebookSdk $fb  , Menu $menu , UserRepository $userrepo , ProjectRepository $project_repo)
	{
		//$this->middleware('auth');
		$this->menuItems				= $menu->where('active' , '1')->orderBy('weight' , 'asc')->get();
 		$this->login_url 				= $fb->getLoginUrl(['email']);	
		$this->userrepo 				= $userrepo;	
		$this->project_repo 			= $project_repo;		
		
	}

	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	*/


	public function getIndex($id = Null)
	{
		if( $id == Null ) 	
			\App::abort(404, 'Invalid User Id');
		else 	$user_id = $id ;
			
		$user 				= \App\User::where('id' , $user_id)->first();
		$userProfile 		= Profile::where('user_id', $user_id )->first();
		
		return view('user.user-profile' , [ 
				'_menus' 		=> $this->menuItems,
				'login_url' 	=> $this->login_url ,		
				'user'			=> $user , 	
				'userProfile' 	=> $userProfile , 
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($user_id),	
		
		]);
	}
	

	public function getProfile($id = Null)
	{
		if( $id == Null ) 	
		\App::abort(404, 'Invalid User Id');
		else 
		$user_id = $id ;
			
		$user 				= \App\User::where('id' , $user_id)->first();
		$userProfile 		= Profile::where('user_id', $user_id )->first();
		
		
		$lists 	= ProjectFund::where('U_ID' , $user_id )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
					$fundedProjectLists[] = $val->P_ID ; 
				}
		}	
			
		$result = array_unique($fundedProjectLists );
	
		$myFundedProjectLists 	= Project::where('active' , '1')->whereIn('id' ,  $result)->orderBy('created_at', 'desc')->get();	
		$getResults = $this->project_repo->prepareListObj($myFundedProjectLists);		
		
		
		
		
		
		
		return view('user.user-profile' , [ 
				'_menus' 		=> $this->menuItems,
				'login_url' 	=> $this->login_url ,		
				'user'			=> $user , 	
				'userProfile' 	=> $userProfile , 
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($user_id),
				'my_funded_projects' 			=> $getResults 				
		
		]);
	}
	
	/*
	* User Activity Lists will be shown based on following criteria
	* The projects the user created
	* The projects on which user funded/backed
	* The Projects that are followed by user
	*/
	
	public function getActivities($id = Null)
	{

		if( $id == Null ) 	
		\App::abort(404, 'Invalid User Id');
		else $user_id = $id ;	
			
		## User
		$activityProjects = array();
		$myCreatedProjects 	= Project::where('user_id' , $user_id )->where('active' , '1')->where('live' , '1')->orderBy('created_at', 'desc')->get();
		foreach($myCreatedProjects as $val){
			$activityProjects[] = $val->id ; 
		}
		$followingProjectLists = array();
		$lists 	= \App\Models\ProjectFollowers::where('user_id' , $user_id )->orderBy('created_at', 'desc')->get();
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
				$activityProjects[] = $val->project_id ; 
				}
		}
		
		
		$lists 	= ProjectFund::where('U_ID' , $user_id )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
					$activityProjects[] = $val->P_ID ; 
				}
		}	
		$activityUniqueProjectLists = array_unique($activityProjects );		
	
	
		$activityLogs	= \App\Models\LogActivity::whereIn('project_id' , $activityUniqueProjectLists )->orderBy('created_at', 'desc')->get();
		
		return view('user.activities' , [ 
			'_menus' 						=> $this->menuItems,
			'login_url' 					=> $this->login_url ,
			'user'							=> \App\User::where('id' , $user_id)->first(), 	
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($user_id),
			'activityLogs'					=>	$activityLogs
		
		]);
	}	
	
	
	
	
	
	
	public function getTransactions($id = Null)
	{

		if( $id == Null ) 	
		\App::abort(404, 'Invalid User Id');
		else $user_id = $id ;	
		
		$user 				= \App\User::where('id' , $user_id)->first();
		$myTransactions 	= \App\Models\Transaction::where('user_id' , $user_id )->orderBy('created_at', 'desc')->get();
		//dd($myTransactions);
	
		return view('user.transactions' , [ 
			'_menus' 		=> $this->menuItems,
			'login_url' 	=> $this->login_url ,
			'transactions'  => $myTransactions ,
			'user'			=> $user , 	
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($user_id),
		
		]);
	}	
	
	
	
	
	public function getProjectBacked($id = Null)
	{
		$fundedProjectLists = array();
		if( $id == Null ) 	
		\App::abort(404, 'Invalid User Id');
		else 
		$user_id = $id ;
		
		$user 	= \App\User::where('id' , $user_id)->first();
		$lists 	= ProjectFund::where('U_ID' , $user_id )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
					$fundedProjectLists[] = $val->P_ID ; 
				}
		}	
			
		$result = array_unique($fundedProjectLists );
	
		$myFundedProjectLists 	= Project::where('active' , '1')->whereIn('id' ,  $result)->orderBy('created_at', 'desc')->get();
		
		
		$getResults = $this->project_repo->prepareListObj($myFundedProjectLists);	
	

		return view('user.project-backed' , [ 
			'_menus' 						=> $this->menuItems,
			'login_url' 					=> $this->login_url ,
			'user'							=> $user , 	
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($user_id),
			'my_funded_projects' 			=> $getResults
		
		]);
	}	
	
	
	public function getProjectPosted($id = Null)
	{
		if( $id == Null ) 	
		\App::abort(404, 'Invalid User Id');
		else 
		$user_id = $id ;

		/* $lists 	= Project::where('active' , '1')->where('user_id' , $authId )->orderBy('created_at', 'desc')->get(); */
		
		$lists 	= Project::where('user_id' , $user_id )->orderBy('created_at', 'desc')->get();
		$results = $this->project_repo->prepareListObj($lists);
	
		return view('user.project-posted' , [ 
			'_menus' 						=> $this->menuItems,
			'login_url' 					=> $this->login_url ,
			'user'							=> \App\User::where('id' , $user_id)->first(), 	
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($user_id),
			'my_posted_projects' 			=> $results
		
		]);
	}	
	
	
	
	public function getFollowingProjects($id = Null)
	{
		if( $id == Null ) 	
		\App::abort(404, 'Invalid User Id');
		else 
		$user_id = $id ;

		$followingProjectLists = array();
		$lists 	= \App\Models\ProjectFollowers::where('user_id' , $user_id )->orderBy('created_at', 'desc')->get();
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
					$followingProjectLists[] = $val->project_id ; 
				}
		}	
			
		$result = array_unique($followingProjectLists );
		$myFollowingProjectLists 	= Project::where('active' , '1')->whereIn('id' ,  $result)->orderBy('created_at', 'desc')->get();		

	
		return view('user.following-projects' , [ 
			'_menus' 						=> $this->menuItems,
			'login_url' 					=> $this->login_url ,
			'user'							=> \App\User::where('id' , $user_id)->first(), 	
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($user_id),
			'my_following_projects' 			=> $this->project_repo->prepareListObj($myFollowingProjectLists)
		
		]);
	}	
	
	
	
	
	
	
	
	
	
	


}
