<?php namespace App\Http\Controllers;

use App\Http\Requests;
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
use Illuminate\Http\Request; 
use Illuminate\Http\Response; 

class HomeController extends Controller {

	protected $project_repo;
	protected $userrepo;
	protected $getactiveArr			=	array();
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
		$this->middleware('auth');
		$this->menuItems				= $menu->where('active' , '1')->orderBy('weight' , 'asc')->get();
 		$this->login_url 				= $fb->getLoginUrl(['email']);	
		$this->userrepo 				= $userrepo;	
		$this->project_repo 			= $project_repo;	

		$id 			= Auth::user()->id ; 
		$userProfile = Profile::where('user_id', $id)->first();		
		$errorNotification='0';
		if(($userProfile->f_name=='') || ($userProfile->l_name=='') || ($userProfile->dob=='0000-00-00') || ($userProfile->about_me=='') || ($userProfile->first_address=='') || ($userProfile->alternate_address=='') || ($userProfile->state=='') || ($userProfile->zipcode=='') || ($userProfile->user_avtar==''))
		{
			$errorNotification='1';
		}
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

		$sessval='';
		Session::put('step', $sessval);
		Session::put('editfstep', $sessval);	 
		Session::set('editfs_id', $sessval); 	
		Session::set('last_insert_id', $sessval); 
			
		$authId = Auth::user()->id ; 
		
		$activityProjects = array();
		$myCreatedProjects 	= Project::where('user_id' , $authId )->where('active' , '1')->where('live' , '1')->orderBy('created_at', 'desc')->get();
		foreach($myCreatedProjects as $val){
			$activityProjects[] = $val->id ; 
		}
		$followingProjectLists = array();
		$lists 	= \App\Models\ProjectFollowers::where('user_id' , $authId )->orderBy('created_at', 'desc')->get();
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
				$activityProjects[] = $val->project_id ; 
				}
		}
		
		
		$lists 	= ProjectFund::where('U_ID' , $authId )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();
		
		
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
					$activityProjects[] = $val->P_ID ; 
				}
		}	
		$activityUniqueProjectLists = array_unique($activityProjects );		
		
		
		$activityLogs	= \App\Models\LogActivity::whereIn('project_id' , $activityUniqueProjectLists )->orderBy('created_at', 'desc')->get();
		
		
		
		//$activityLogs	= \App\Models\LogActivity::where('project_id' , '!=' , 0 )->orderBy('created_at', 'desc')->get();
		
		return view('home.dashboard' , [ 
			'_menus' 						=> $this->menuItems,
			'_errorNotification' => $this->errorNotification,
			'login_url' 					=> $this->login_url ,
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),
			'activityLogs'					=>	$activityLogs
		
		]);
	}
	
	public function getProjectPosted()
	{
		$authId = Auth::user()->id;

		/* $lists 	= Project::where('active' , '1')->where('user_id' , $authId )->orderBy('created_at', 'desc')->get(); */
		
		$lists 	= Project::where('user_id' , $authId )->orderBy('created_at', 'desc')->get();
		$results = $this->project_repo->prepareListObj($lists);
	
		return view('home.project-posted' , [ 
			'_menus' 						=> $this->menuItems,
			'_errorNotification' => $this->errorNotification,
			'login_url' 					=> $this->login_url ,
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),
			'my_posted_projects' 			=> $results
		
		]);
	}
	
	public function getExportproject(Request $request)
	{	
			$excelnm="posted_project_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
		    $excel->sheet('Project', function ($sheet) {		       
				$authId = Auth::user()->id;
				$lists 	= Project::where('user_id' , $authId )->orderBy('created_at', 'desc')->get();
				$result = $this->project_repo->prepareListArr($lists);
					
		        $dataArr=array();
				if(is_array($result) && count($result)>0) 
				{
					$counter=0;
					foreach($result as $kyy=>$dataval)
					{
						$dataArr[$counter]['Sl']=($counter+1);
						$dataArr[$counter]['Name']=$dataval['name'];
						$dataArr[$counter]['Goal Amount']=$dataval['funding_goal'];
						$dataArr[$counter]['Funded Amount']=$dataval['_total_pledge_amount']; 
						$dataArr[$counter]['Backers']=$dataval['_total_backers_on_project'];
						$dataArr[$counter]['Project Duration(Days)']=$dataval['project_duration'];
						$counter++; 
					} 
				}  
		        /* setting column names for data - you can of course set it manually */
		        $sheet->appendRow(array_keys($dataArr[0])); /* column names */ 
		        /* getting last row number (the one we already filled and setting it to bold */
		        $sheet->row($sheet->getHighestRow(), function ($row) {
		            $row->setFontWeight('bold');
		        }); 
		        /* putting users data as next rows */
		        foreach ($dataArr as $user) {
		            $sheet->appendRow($user);
		        }
		    });

		})->export('xls');	 

	}


	# Backer lists for projects created
	# List of backers on a projects that a registered user create
	public function getBackerLists()
	{
		
		$liveProjects = array();
		$authId = Auth::user()->id;	
		
		$my_live_projects	= Project::where('user_id' , $authId )->where('active' , '1')->where('live' , '1')->orderBy('created_at', 'desc')->get();
		foreach($my_live_projects as $val) { $liveProjects[] = $val->id ; }
		
		$listOfBackers = \App\Models\ProjectFund::whereIn('P_ID' , $liveProjects)->orderBy('created_at', 'desc')->groupBy('U_ID')->get();
	
	
		return view('home.backer-lists' , [ 
			'_menus' 						=> $this->menuItems,
			'_errorNotification' => $this->errorNotification,
			'login_url' 					=> $this->login_url ,
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),
			//'my_posted_projects' 			=> $results,
			'listOfBackers'					=> $listOfBackers,
		
		]);
	}


	public function getExportbackerlists()
	{		
				$excelnm="backers_list_".date("d-m-Y"); 
				Excel::create($excelnm, function ($excel) { 
				$excel->sheet('Project', function ($sheet) {
				
					$liveProjects = array();					
					$authId = Auth::user()->id;
					$my_live_projects	= Project::where('user_id' , $authId )->where('active' , '1')->where('live' , '1')->orderBy('created_at', 'desc')->get();
					foreach($my_live_projects as $val) { $liveProjects[] = $val->id ; }
			
					$listOfBackers = \App\Models\ProjectFund::whereIn('P_ID' , $liveProjects)->orderBy('created_at', 'desc')->groupBy('U_ID')->get();
					
					if( count($listOfBackers)  > 0 )
					{
						$cnt=0;
						foreach($listOfBackers as $val)	
						{
							$arr[$cnt]['backed_amount'] = \App\Models\ProjectFund::where('P_ID' , $val->P_ID)->where('U_ID' , $val->U_ID)->orderBy('created_at', 'desc')->sum('paid_amount');
							$arr[$cnt]['backer_name'] = $val->user()->first()->name;
							$arr[$cnt]['project_name'] = $val->project()->first()->name;
							
							$cnt++; 
						}
					}
					
					$dataArr=array();
					if(is_array($arr) && count($arr)>0) 
					{
						$counter=0;
						foreach($arr as $kyy=>$dataval)
						{
							$dataArr[$counter]['Sl']=($counter+1);
							$dataArr[$counter]['Backer Name']=$dataval['backer_name'];
							$dataArr[$counter]['Backed Amount($)']=$dataval['backed_amount'];
							$dataArr[$counter]['Project Name']=$dataval['project_name']; 
							
							$counter++; 
						} 
					}  
					/* setting column names for data - you can of course set it manually */
					$sheet->appendRow(array_keys($dataArr[0])); /* column names */ 
					/* getting last row number (the one we already filled and setting it to bold */
					$sheet->row($sheet->getHighestRow(), function ($row) {
						$row->setFontWeight('bold');
					}); 
					/* putting users data as next rows */
					foreach ($dataArr as $user) {
						$sheet->appendRow($user);
					}
				});

			})->export('xls');	
	}






	
	

	public function getProjectBacked()
	{
		$fundedProjectLists = array();
		$authId = Auth::user()->id ; 
		/*
		$lists 	= ProjectFund::where('U_ID' , $authId )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();
		if(count($lists) > 0 ) {
				foreach($lists as $val ){
					$fundedProjectLists[] = $val->P_ID ; 
				}
		}	
			
		$result = array_unique($fundedProjectLists );
	
		$myFundedProjectLists 	= Project::where('active' , '1')->whereIn('id' ,  $result)->orderBy('created_at', 'desc')->get();
		
		
		$getResults = $this->project_repo->prepareListObj($myFundedProjectLists);	
		*/
		$getResults 	= ProjectFund::where('U_ID' , $authId )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();	
		//dd($getResults );

		return view('home.project-backed' , [ 
			'_menus' 						=> $this->menuItems,
			'_errorNotification' => $this->errorNotification,
			'login_url' 					=> $this->login_url ,
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),
			'my_funded_projects' 			=> $getResults
		
		]);
	}
	
	public function getExportbackedproject(Request $request)
	{	
			//dd("VV");
			$excelnm="project_backed_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
				$excel->sheet('Project', function ($sheet) {		       
				$fundedProjectLists = array();
				$authId = Auth::user()->id ; 
				$lists 	= ProjectFund::where('U_ID' , $authId )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();
				if(count($lists) > 0 ) {
						foreach($lists as $val ){
							$fundedProjectLists[] = $val->P_ID ; 
						}
				}	
					
				$result = array_unique($fundedProjectLists );
				
				$myFundedProjectLists 	= Project::where('active' , '1')->whereIn('id' ,  $result)->orderBy('created_at', 'desc')->get();
				$getResults = $this->project_repo->prepareListArr($myFundedProjectLists);
				
				//echo "<pre>"; 				
				//print_r($getResults);
				//echo "</pre>"; 		
				//dd("B");
				$dataArr=array();
				if(is_array($getResults) && count($getResults)>0) 
				{
					$counter=0;
					foreach($getResults as $kyy=>$dataval)
					{
						$dataArr[$counter]['Sl']=($counter+1);
						$dataArr[$counter]['Name']=$dataval['name'];
						$dataArr[$counter]['Goal Amount']=$dataval['funding_goal'];
						$dataArr[$counter]['Funded Amount']=$dataval['_total_pledge_amount']; 
						$dataArr[$counter]['Paid Amount']=$dataval['_total_pledge_amount_of_auth_user'];
						$dataArr[$counter]['Duration(Days)']=$dataval['project_duration'];
						$dataArr[$counter]['End date']=gmdate("Y-m-d", $dataval['project_end_date']);
						$counter++; 
					} 
				}  
				/* setting column names for data - you can of course set it manually */
				$sheet->appendRow(array_keys($dataArr[0])); /* column names */ 
				/* getting last row number (the one we already filled and setting it to bold */
				$sheet->row($sheet->getHighestRow(), function ($row) {
					$row->setFontWeight('bold');
				}); 
				/* putting users data as next rows */
				foreach ($dataArr as $user) {
					$sheet->appendRow($user);
				}
			});

	})->export('xls');	 

	}

	public function getTransactions()
	{
		$authId 			= Auth::user()->id ; 
		$myTransactions 	= \App\Models\Transaction::where('user_id' , $authId )->orderBy('created_at', 'desc')->get();
		//dd($myTransactions);
	
		return view('home.transactions' , [ 
			'_menus' 		=> $this->menuItems,
			'_errorNotification' => $this->errorNotification,
			'login_url' 	=> $this->login_url ,
			'transactions'  => $myTransactions ,
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),
		
		]);
	}
	
	
	
	public function getInviteFriends()
	{
		$authId 			= Auth::user()->id ; 
		$myTransactions 	= \App\Models\Transaction::where('user_id' , $authId )->orderBy('created_at', 'desc')->get();
		//dd($myTransactions);
	
		return view('home.invite-friends' , [ 
			'_menus' 		=> $this->menuItems,
			'_errorNotification' => $this->errorNotification,
			'login_url' 	=> $this->login_url ,
			'transactions'  => $myTransactions ,
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),
		
		]);
	}	
	
	
	
	
	
	
	
	

	public function getProfile()
	{
		
		$authId 			= Auth::user()->id ; 		
		$user 				= \App\User::where('id' , $authId)->first();
		$userProfile 		= Profile::where('user_id', $authId )->first();
		
		return view('home.my-profile' , [ 
				'_menus' 		=> $this->menuItems,
				'_errorNotification' => $this->errorNotification,
				'login_url' 	=> $this->login_url ,		
				'user'			=> $user , 	
				'userProfile' 	=> $userProfile , 
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),	
		
		]);
	}
	
	
	
	public function getSettings()
	{
		$authId 			= Auth::user()->id ; 
		return view('home.dashboard' , [ 
			'_menus' 		=> $this->menuItems,
			'login_url' 	=> $this->login_url,
			'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),			
		
		]);
	}
		
	
	
	public function getEdit($id)
	{ 
		$authId 			= Auth::user()->id ; 
		$userProfile = Profile::where('user_id', $id)->first();
		$countries = Country::all();
		foreach($countries  as $countryval){
			$data[$countryval->countryID] = $countryval->countryName; 
		}	

		$statArr	=	array( '' => 'Select Country' );
	 	$result 	= 	array_merge($statArr, $data);

	 	$countryId	=	$userProfile['country_id'];
	  	$citylist 	= 	$this->userrepo->getcitylist($countryId);

	   
	  	$datan=array();
	  	foreach($citylist  as $cityval){
	  		$id=$cityval['cityID'];
			$name=$cityval['cityName'];
			$datan[$id] = $name; 
		}	


		return view('home.edit' , [
		
				'_menus' 		=> $this->menuItems,
				'_errorNotification' => $this->errorNotification,
				'login_url' 	=> $this->login_url ,		

				'userProfile' 	=> $userProfile , 
				'countries' 	=> $result, 
				'cityl' 		=> $datan,
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),		
		
		
		]);
	}

	public function putUpdate($id , Request $request)
	{

		$rules = array(
				'f_name'         	=> 'required',                        
				'l_name'         	=> 'required',                       		
				'about_me'       	=> 'required|min:20',   
				'dob'         		=> 'required',
				'first_address' 	=> 'required',
				'alternate_address' => 'required',
				'city' 				=> 'required',
				'state' 			=> 'required',
				'country_id' 		=> 'required',
				'zipcode' 			=> 'required',	 
			);			
		
		$validator = \Validator::make($request->all(), $rules);		
		
		if ($validator->fails()) {				
			//$messages = $validator->messages();
			// redirect our user back to the form with the errors from the validator
			return redirect()->back()->withInput($request->all())->withErrors( $validator->messages() );
		} else {
				$userdet = array();
				$userdet['f_name'] 							= $request->input('f_name');
				$userdet['l_name'] 							= $request->input('l_name');
				$userdet['gender'] 							= $request->input('gender');
				$userdet['dob'] 							= $request->input('dob');
				$userdet['about_me'] 						= $request->input('about_me');
				$userdet['first_address'] 					= $request->input('first_address');
				$userdet['alternate_address'] 				= $request->input('alternate_address');
				$userdet['city'] 							= $request->input('city');
				$userdet['state'] 							= $request->input('state');
				$userdet['country_id'] 						= $request->input('country_id');
				$userdet['zipcode'] 						= $request->input('zipcode');
				
				$userdet['education'] 					= $request->input('education');
				$userdet['employment_status'] 			= $request->input('employment_status');
				$userdet['income_range'] 				= $request->input('income_range');
				$userdet['relationship_status'] 		= $request->input('relationship_status');	
				$userdet['website']						= $request->input('website');

				$userdet['facebook_url']				= $request->input('facebook_url');
				$userdet['twitter_url']					= $request->input('twitter_url');
				$userdet['linkedIn_url']				= $request->input('linkedIn_url');
				$userdet['googleplus_url']				= $request->input('googleplus_url');
				
				if($request->hasFile('user_avtar')):
				
					$file = $request->file('user_avtar');
					$imageName = $id . '.' .  $file->getClientOriginalExtension();
					$realPath = base_path() . '/public/images/avtar-image/';
					$resizePath = base_path().'/public/images/avtar-image/resize/' . $imageName;
					
					$openMakePath = $realPath . $imageName;
					 
					$request->file('user_avtar')->move( $realPath, $imageName );
					\Image::make($openMakePath)->resize(200, 200)->save($resizePath);
					$userdet['user_avtar'] 	= $imageName;
							
				endif;
				
				Profile::where('user_id', $id)->update($userdet);
				$user = User::find($id);
				$user->name 	= $request->input('f_name') . ' ' . $request->input('l_name');	
				$user->save();
		
				$request->session()->flash('alert-success', 'User has been updated successfully');
				/*return redirect()->back()->withInput($request->all());	*/
				return redirect('home/edit/'.$id);
				exit;					

		}		
		
		
		
		
	}



	
	public function getReset($id)
	{ 
		$authId 			= Auth::user()->id ; 
		$userProfile = Profile::where('user_id', $id)->first();

		return view('home.reset' , [
		
				'_menus' 		=> $this->menuItems,
				'_errorNotification' => $this->errorNotification,
				'login_url' 	=> $this->login_url ,		
				'userProfile' 	=> $userProfile , 
				'token'			=> '',
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),		
		
		
		]);
	}	
	
	# Save Password Reset data
	public function postReset(Request $request)
	{   
				$this->validate($request, [
						'password' => 'required|confirmed',
						 'email' => 'required|email',
				]);
				$credentials = $request->only(
						'email', 'password', 'password_confirmation'
				);
				$user = \Auth::user();
				$user->password = bcrypt($credentials['password']);
				if( $user->save() )
				{
					return redirect('auth/logout/');
				} else { 
						$request->session()->flash('alert-danger', 'There were some problems with your input.');			
						return redirect('home/reset/'.$user->id);			
				
				}
	}	
	


	public function getPaymentOptions()
	{
	
		$authId = Auth::user()->id ; 
		$getReceiverAccount = \App\Models\ReciverAccount::where('user_id' , $authId)->first();
		//dd($getReceiverAccount );

		return view('home.payment-options' , [
		
				'_menus' 		=> $this->menuItems,
				'_errorNotification' => $this->errorNotification,
				'login_url' 	=> $this->login_url ,
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),	
				'getReceiverAccount' => $getReceiverAccount	
		
		
		]);	
	
		
	}
	
	
	# Save Password Reset data
	public function postPaymentOptions(Request $request)
	{   
			$authId = Auth::user()->id ; 
			$flag = 0 ; 
			$this->validate($request, [
						'receiver_email' 		=> 'required',
						 'secret_key' 			=> 'required',
						 'public_key' 			=> 'required',
				]);
				$credentials = $request->only(
						'receiver_email', 'secret_key', 'public_key'
				);
				
				$checkRow = \App\Models\ReciverAccount::where('user_id' , $authId)->count();
				if( $checkRow > 0 ) {
				
					$payment_settings_val['receiver_email'] 	= $request->input('receiver_email');
					$payment_settings_val['secret_key'] 		= $request->input('secret_key');
					$payment_settings_val['public_key'] 		= $request->input('public_key');
					
					\App\Models\ReciverAccount::where('user_id', $authId)->update($payment_settings_val);
					$flag = 1; 
				
				} else { 
				
					$reciverAccount = new  \App\Models\ReciverAccount();
					$reciverAccount->user_id				= Auth::user()->id ;
					$reciverAccount->receiver_email 		= $request->input('receiver_email');
					$reciverAccount->secret_key 			= $request->input('secret_key');
					$reciverAccount->public_key 			= $request->input('public_key');
					$reciverAccount->save() ;
					$flag = 1; 
					}
				if( $flag == 1 )
				{
					$request->session()->flash('alert-success', 'Payment settings has been saved!');
					return redirect('home/payment-options');
				} else { 
						$request->session()->flash('alert-danger', 'There were some problems with your input.');			
						return redirect('home/payment-options');			
				
				}
				
				
	}		
	
	
	
	
	
	
	
	
	


	public function getMyMessages()
	{
	
		$authId = Auth::user()->id ; 
		
		$boxType =   ( \Input::get('box') ) ? \Input::get('box') : Null ; 
		//echo $boxType ; exit;
		if($boxType == 'inbox') {
		$myInboxLists = \App\Models\MessageHeader :: where('to_id', $authId)->where('parent_id', 0)->orderBy('created_at', 'desc')->get();
		} elseif($boxType == 'sent') {
		$myInboxLists = \App\Models\MessageHeader :: where('from_id', $authId)->where('parent_id', 0)->orderBy('created_at', 'desc')->get();
		} else {
		$myInboxLists = \App\Models\MessageHeader :: where('to_id', $authId)->where('parent_id', 0)->orderBy('created_at', 'desc')->get();
		}
		
		//$myInboxLists = \App\Models\MessageHeader :: where('to_id', $authId)->where('parent_id', 0)->orderBy('created_at', 'desc')->get();
		
		/*		
		$myInboxLists   =   \DB::table('message_headers')
				->join('messages', function($join)
				{
					$join->on('message_headers.id', '=', 'messages.message_header_id');
						 
				})
				->where('message_headers.to_id', '=', $authId)
				->orderBy('message_headers.created_at', 'desc')
				->get();		
				
		*/		
			//dd($myInboxLists);	
		
		
		

		return view('home.my-messages' , [
		
				'_menus' 		=> $this->menuItems,
				'_errorNotification' => $this->errorNotification,
				'login_url' 	=> $this->login_url ,
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),	
				'myInboxLists'					=> $myInboxLists , 
				'boxType'						=> $boxType	
		
		
		]);	
	
		
	}	
	
	
	
	
	
	
	
	public function getCitylist($countryid)
	{  
		$citylist = $this->userrepo->getcitylist($countryid);  
		$statArr = array(
						    0 => array(
						        'cityID' => '',
						        'cityName' => 'Select City'
						    ) 
					   );
		$result = array_merge($statArr, $citylist); 
		return $result;
		exit;
	}


	public function getUimodal()
	{
		$Id 			=   ( \Input::get('Id') ) ? \Input::get('Id') : Null ; 
		$modalType 		=   ( \Input::get('type') ) ? \Input::get('type') : Null ; 
		
		if( $modalType != Null && $modalType == 'backer-lists' ){
			$results = \DB::select( \DB::raw("SELECT DISTINCT(`U_ID`) as user_id FROM project_funds WHERE P_ID = '$Id'") );
			if(	count($results) > 0	)
			{
				for($k=0 ; $k< count($results) ; $k++){
					$backerIDS[] = $results[$k]->user_id ;
				}
			}
			if( count($backerIDS) > 0 )
			{
				$backerListsByProjectId = 	User::whereIn('id' , $backerIDS)->where('status' , '1')->orderBy('id', 'desc')->get();
			} else $backerListsByProjectId = Null ; 
				
		
		
		return view('home.partials._backer_lists_modal',  ['modalFor' => $modalType , 'project_id' => $Id , 'backerListsByProjectId' => $backerListsByProjectId ]);
		
		} else { 
		$myInboxLists = \App\Models\MessageHeader :: where('parent_id', $Id)->orderBy('created_at', 'desc')->get();
		return view('home.partials._reply_msg_modal',  ['modalFor' => 'reply' , 'msgId' => $Id , 'myInboxLists' => $myInboxLists ]);
		}
	}
	

	public function postReplyMsg(Request $request)
	{ 
	
			if($request->ajax()) 
			{
				$msgId 			= $request->get('msgId');
				$replyText 		= $request->get('replyText');
				
				if(isset($msgId) && isset($replyText) )
				{
				
					$authId 		= 	Auth::user()->id ; 
					$myInboxList 	= 	\App\Models\MessageHeader :: where('id', $msgId)->first();
					if($myInboxList)
					{
						$message_header = new \App\Models\MessageHeader() ;
						$message_header->parent_id 			= $msgId  ; 
						$message_header->from_id 			= $authId;
						$message_header->to_id 				= $myInboxList->from_id;
						$message_header->content 			= $replyText;
						$message_header->project_id 		= $myInboxList->project_id;
						$message_header->status 			= 'sent';	
						$message_header->sender_read 		= 'read';
						$message_header->recipient_read 	= 'unread';						
						$message_header->save();
						

						
					if ( $message_header->save() ) {

					$myInboxLists = \App\Models\MessageHeader :: where('parent_id', $msgId)->orderBy('created_at', 'desc')->get();
					$html = View::make('home.partials.reply_lists_wrapper',  ['modalFor' => 'reply' , 'msgId' => $msgId , 'myInboxLists' => $myInboxLists ])->render();				
					return response(['msg' => 'success' , 'data' => $html  ]);						

					}
					else return response(['msg' => 'Data save failure' , 'data' => '' ]);						


					}						
					else
					{
					return response(['msg' => 'failure'  ]);
					}
						
				}
				else
				{
					return response(['msg' => 'failure'  ]);
				}				
			}	
	

		

		
	}


	# Send Email To Users	
	public function getBulkEmails()
	{     
		$authId 		= 	Auth::user()->id ; 
		$userProfile 	= 	Profile::where('user_id', $authId)->first();
		$userlist		=	$this->userrepo->getallrecords();

		if(is_array($userlist) && count($userlist)>0){
			$counter=0;
			foreach($userlist as $kyy=>$dataval){ 				
				if($dataval['status']==1)	$this->getactiveArr[$counter]['email']	=	$dataval['email']; 
				$counter++; 
			} 
		}  

			
		
		return view('home.bulk-emails' , [
		
				'_menus' 						=> $this->menuItems,
				'_errorNotification' => $this->errorNotification,
				'login_url' 					=> $this->login_url ,
				'activearr'						=> array_values($this->getactiveArr),	
				'dashBoardDetailsByAuthUser'	=> $this->userrepo->generalOverViewByAuthUser($authId),	
				'userProfile'					=> $userProfile ,
		
		
		]);			
		
		
		
		
	}	
	


	public function postSendemail(Request $request)
	{   
		/* Data calculation in different situation START*/
		if($request->selectedemails){
			$sendemail	=	$request->selectedemails;
		}
		/* Data calculation in different situation END*/
		$emailMsg			=	$request->usrmsg; 		
		$emailsubject		=	$request->emailsubject;

		$data 				= array( 'recipients' => $sendemail, 'subject' => $emailsubject, 'msgBody' => $emailMsg );	

		/* Email sending code using LARAVEL Mail::queue START*/
		Mail::queue('home.msghere', $data, function($message) use ($data)
		{ 

			$sendemails 			= $data['recipients'];   
			$emailsubject 			= $data['subject'];   
			$message->from('info@mfunder.com', 'Musicfunder'); 

			if(is_array($sendemails) && count($sendemails)>0) { 
				foreach($sendemails as $emailid) $message->to($emailid)->subject($emailsubject);
			} 
			
		});  
		
		/* Email sending code using LARAVEL Mail::queue END*/
		$request->session()->flash('alert-success', 'Mail Sent successfully');
		return redirect('home/bulk-emails');
	}


	/*public function postRefundRequest(Request $request)
	{
			if($request->ajax()) 
			{
						$requestID 		= $request->get('requestID');
						$authId 		= 	Auth::user()->id ; 
						//$fundDeatils = \App\Models\ProjectFund::where('id' , $requestID)->first();
						
						$cashWithDrawaldRequest = new \App\Models\CashWithdrawalsRequest();
						$cashWithDrawaldRequest->user_id 	= $authId;
						$cashWithDrawaldRequest->status 	= 'request';
						$cashWithDrawaldRequest->project_fund_id = $requestID;
						if ($cashWithDrawaldRequest->save() ) {
							$request->session()->flash('alert-success', 'Request for charge refunding is successfully posted . ');
							return response(['msg' => 'success'   ]);
						} 	else {
							$request->session()->flash('alert-success', 'Request for charge refunding is not processed !');
							return response(['msg' => 'failure'   ]);
						}							
			}
	}*/
	
	
	
	
	
	/*public function postRefundRequest(Request $request)
	{
	
			if($request->ajax()) 
			{
						$requestID 		= $request->get('requestID');
						$authId 		= 	Auth::user()->id ; 
						
						
						$cashWithDrawaldRequest = new \App\Models\CashWithdrawalsRequest();
						$cashWithDrawaldRequest->user_id 	= $authId;
						$cashWithDrawaldRequest->status 	= 'request';
						$cashWithDrawaldRequest->project_fund_id = $requestID;
						if ($cashWithDrawaldRequest->save() ) {
							$request->session()->flash('alert-success', 'Request for charge refunding is successfully posted . ');
							return response(['msg' => 'success'   ]);
						} 	else {
							$request->session()->flash('alert-success', 'Request for charge refunding is not processed !');
							return response(['msg' => 'failure'   ]);
						}							
			}
	}*/
	
	public function getRefundrequest($id)
	{		
		$transaction_details 			= 	\App\Models\ProjectFund :: findOrFail($id); 		
		return view('home.refund-request' , [
		
				'_menus' 		=> $this->menuItems,
				'_errorNotification' => $this->errorNotification,
				'login_url' 	=> $this->login_url ,	
				'transaction_details' 	=> $transaction_details ,	
		]);
	}
	
	public function postRefund(Request $request)
	{		
	 
		$transaction_id = $request->get('id');		
		$error = '' ; 		
		$transaction_details 			= 	\App\Models\ProjectFund :: findOrFail($transaction_id); 	
		
		$getProjectReceiverAccount = \App\Models\Project::where('id' , $transaction_details->P_ID)->first();		
		
		$getReceiverAccount = ($getProjectReceiverAccount->user_id) ? ( \App\Models\ReciverAccount::where('user_id' , $getProjectReceiverAccount->user_id)->first() ) : Null;		
		//dd($getReceiverAccount->secret_key);
		if( $getReceiverAccount->secret_key ) {			
			\Stripe\Stripe::setApiKey($getReceiverAccount->secret_key);
		} 
		 
		  try {			
			$paid_amount = $transaction_details->paid_amount*100;
			$refund = \Stripe\Refund::create(array(
				'amount' => $paid_amount, 
				'charge' => $transaction_details->transaction_id
			));
			//dd($refund->toArray());
			//updatating local table
			$cashWithDrawaldRequest = new \App\Models\CashWithdrawalsRequest();
			$cashWithDrawaldRequest->user_id 	= $getProjectReceiverAccount->user_id;
			$cashWithDrawaldRequest->status 	= 'request';
			$cashWithDrawaldRequest->project_fund_id = $transaction_id;
			if ($cashWithDrawaldRequest->save() ) {
				$request->session()->flash('alert-success', 'Request for charge refunding is successfully posted . ');
				//return response(['msg' => 'success'   ]);
				return \Redirect::to('home/project-backed')->with('msg','success');
			} 	else {
				$request->session()->flash('alert-success', 'Request for charge refunding is not processed !');
				//return response(['msg' => 'failure'   ]);
				return \Redirect::to('home/project-backed')->with('stripe_errors',$error['message'])	;
			}
			///update		
		  }
		  catch (Exception $e) {
			//  dd("a");
			$e_json 		= $e->getMessage();
			$error 			= $e_json['error'];
			return response(['msg' => 'failure'   ]);
			//return \Redirect::to('home/project-backed')->with('stripe_errors',$error['message'])	;			
		  }		
		//dd($refund->_lastResponse);
		
	}


	
	
	

}
