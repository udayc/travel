<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use Auth; 
use Session ;
Use App\Models\Menu ;
Use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
Use Facebook;
Use View , DB;
use Mail;
use Excel;
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
//use Illuminate\Http\Request; 
use Illuminate\Http\Response; 

class AgentController extends Controller {

	protected $project_repo;
	protected $userrepo;
	protected $getactiveArr			=	array();
	/*
	|--------------------------------------------------------------------------
	| Agent Controller
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
		$this->middleware('auth');
		$this->menuItems				= $menu->where('active' , '1')->orderBy('weight' , 'asc')->get();
 		$this->login_url 				= $fb->getLoginUrl(['email']);	
		$this->userrepo 				= $userrepo;	
		$this->project_repo 			= $project_repo;	

		$id 			= Auth::user()->id ; 
		$userProfile = Profile::where('user_id', $id)->first();		
		$errorNotification='0';
		//if(($userProfile->f_name=='') || ($userProfile->l_name=='') || ($userProfile->dob=='0000-00-00') || ($userProfile->about_me=='') || ($userProfile->first_address=='') || ($userProfile->alternate_address=='') || ($userProfile->state=='') || ($userProfile->zipcode=='') || ($userProfile->user_avtar==''))
		//{
			//$errorNotification='1';
		//}
		$this->errorNotification 			= $errorNotification;		
		
	}

	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	*/


	public function getIndex()
	{	
		return view('home' , [
		'_menus' => $this->menuItems,
		'_errorNotification' => $this->errorNotification,
		'login_url' => $this->login_url 
				
		]);
	}
	
	/*
	* User Activity Lists will be shown based on following criteria
	* The projects the user created
	* The projects on which user funded/backed
	* The Projects that are followed by user
	*/
	
	public function getDashboard()
	{		
		return view('agent.dashboard.index' );
	}
	
	public function getProfile()
	{	
		return view('agent.user.profile' );
	}
	public function postProfile(Request $request)
	{	
	
		$user_id = Auth::User()->id;
		$profile = new Profile;
		
		$profile ->user_id = $user_id;
		$profile ->company_name = $request->company_name;
		$profile ->contact_name = $request->contact_name;
		$profile ->email = $request->email;
		$profile ->phone = $request->phone;
		$profile ->postal_code = $request->postal_code;
		$profile ->address_one = $request->address_one;
		$profile ->address_two = $request->address_two;
		$profile ->city = $request->city;
		$profile ->state = $request->state;
		$profile ->country_id = $request->country_id;
		$profile ->about = $request->about;
		$profile ->status = 1;
		$profile ->visibility = 1;
		
		if($profile->save())
		{
			redirect::to('agent/profile');
		}
	}
}
