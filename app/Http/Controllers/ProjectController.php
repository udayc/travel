<?php namespace App\Http\Controllers;

Use App\Models\Category;
Use App\Models\Genre;
Use App\Models\Reward;
Use App\Models\Menu; 
Use App\Models\Banner; 
Use App\Models\ProjectFund;

use App\Models\User;
use App\Models\MessageHeader;
use App\Models\Message;

use App\Models\Emaillog;
use App\Models\Country; 
use Image;

Use App\Setting;
Use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
Use Facebook; 
use App\Models\Project; 
use App\Repositories\ProjectRepository;
use App\Events\FileAttachment; 
use Auth;
use Mail;
use Session; 
use Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ProjectFormRequest;
use App\Models\ProjectUpdates;
use App\Profile;


class ProjectController extends Controller {

	protected $project_repo;
	protected $project;	

	protected $width = 328 , $height = 168;
	protected $mWidth = 628 , $mHeight = 267;
		
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
	public function __construct(LaravelFacebookSdk $fb ,  Menu $menu , ProjectFund $projectfund , ProjectRepository $project_repo )
	{
		//$this->middleware('guest');
		//$this->project 		= $project;
		$this->projectfund 	= $projectfund;
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
		$featuredProjects 		= Project::where('active' , '1')->where('live' , '1')->where('status' , '3')->orderBy('id', 'desc')->take(3)->get();
		$recentlyAddedProjects 	= Project::where('active' , '1')->where('live' , '1')->orderBy('created_at', 'desc')->take(3)->get();		
		$sliderImgs				= Banner::where('active' , '1')->orderBy('created_at' , 'desc')->get();
		
		return view('welcome' , [
		'_featuredProducts' 		=> 		$featuredProjects , 
		'_recently_added' 			=>  	$recentlyAddedProjects,
		'_menus' 					=> 		$this->menuItems , 
		'_sliders'					=>		$sliderImgs ,
		'login_url' 				=> 		$this->login_url 
			
		]);
	}
	

	
	
	
	
	public function getLists($exploreBy = Null , $slug = Null )
	{
		$projcon		=	array( "0", "3" );
		$leftCatList 	= 	Genre::all();
		$sortBy =   ( \Input::get('t') ) ? \Input::get('t') : Null ; 
		switch($exploreBy)
		{
			case "popular" :
						$lists 	= Project::where('active' , '1')->where('live' , '1')->orderBy('rank', 'DESC')->get();					
						break;
			case "recent" :
						$lists 	= Project::where('active' , '1')->where('live' , '1')->orderBy('created_at', 'desc')->get();
						break;
						
			case "genres" :
						$genre_slug = $slug;
						$catObj = Genre::where('genre_slug' , $genre_slug)->first();
						$catName = $catObj->name;
						$lists 	= Project::where('active' , '1')->where('live' , '1')->where('project_genre_id' , $catObj->id )->orderBy('created_at', 'desc')->get();
						break;


			case "categories" :
						$genre_slug = $slug;
						$catObj = Genre::where('genre_slug' , $genre_slug)->first();
						$catName = '';
						$lists 	= Project::where('active' , '1')->where('live' , '1')->where('project_genre_id' , $catObj->id )->orderBy('created_at', 'desc')->get();
						$leftCatList = Category::all();
						break;
		
			default:
						$lists = Project::where('active' , '1')->where('live' , '1')->orderBy('id', 'desc')->get();
			
		}
				
		$results = $this->project_repo->prepareListObj($lists);
		if( $sortBy != Null ) {	$results = $this->project_repo->sortByPrepareListObj($results , $sortBy);	}
		
		return view('project.lists' , [
					'_projectLists' =>  (count($results) > 0 ) ? (object) $results :  $results ,
					'_menus' 		=> 	$this->menuItems ,
					'login_url' 	=> 	$this->login_url,
					'_catObj'		=> 	isset($catObj) ? $catObj : '',								
					'_leftCatLists' => 	$leftCatList,
					'_exploreBy'	=>	$exploreBy
					
				]);	
	}
	
	/*
	* Project details page ny ID/SLUG
	*/
	public function getShow($id , $slug = null )
	{ 
		$id=$id;
		$updateRank = $this->project_repo->updateprojectrank($id);
		# Insert Project view log history
		$this->project_repo->projectHistoryShareLogs('project-views' , $id);

 
		$login_url 		= $this->login_url ;
		$post 			= Project::findOrFail($id); 
 
		 
		$getuserId		=	isset($post->user_id) ? $post->user_id : 0;
		$useraddedproj	=	$this->project_repo->projectbyuser($getuserId);
		$guserdetails	=	$this->project_repo->getuserrecords($getuserId);
		//dd($guserdetails[0])."A1<br>";
		//exit;		
		$checkprojectuser	=	$this->project_repo->checkprojectuser($id,Auth::id());		
		$getupdatedetails	=	$this->project_repo->getupdatedetails($id);	
		
		if(count($getupdatedetails)<=0)
		{
			
			$getupdatedetails	= array();
		}
		//dd(count($getupdatedetails));
		if(count($guserdetails)>0)
		{
			$userdetails	=	$guserdetails[0];
 		}
		else
		{
			$userdetails	=	array();
		}
		if ( $post->slug !== $slug ) {
			return Redirect::route('project.show', array('id' => $post->id, 'slug' => $post->slug), 301); 
		}
		$_menus = $this->menuItems ;
		$rewards = Reward::where('P_ID' , $id)->get();	
		$_total_pledge_amount = 	$this->projectfund->where('P_ID' , $id)->where('status' , 'Pledged')->sum('paid_amount');
		$_total_backers_on_project = 	$this->projectfund->where('P_ID' , $id)->where('status' , 'Pledged')->count();
		$_pof_value = (( $_total_pledge_amount / $post->funding_goal)	* 100 );		
		$_pof = ( $_pof_value > 1 ) ? $_pof = sprintf("%d%%", $_pof_value ) : ( ($_pof_value == 0 ) ? sprintf("%d%%", $_pof_value ) : sprintf("%.2f%%", $_pof_value ) ); 
		
		return view('project.show', compact('post' , '_menus' ,'rewards' , '_total_pledge_amount' ,'_total_backers_on_project' , '_pof' , 'login_url', 'userdetails', 'useraddedproj','id','checkprojectuser','getupdatedetails','slug' ));
	}
	
	public function getUpdaterank($id)
	{ 
		$updateRank = $this->project_repo->updateprojectrank($id);
	}
	
	public function postPupdate($id,$update_text,$create_title)
	{ 
		$project_update = new ProjectUpdates;
		
		$project_update->user_id 			= Auth::id();		
		$project_update->title 				= $create_title;
		$project_update->description 		= $update_text;
		$project_update->project_id 		= $id;
		$project_update->status 			= 1;	
		$userProfile 		= Profile::where('user_id', Auth::id() )->first();		
		
		if($id=='' || $update_text=='' || $create_title=='')
		{
			echo "An error occurred. Please try again later";			
			die();
		}
		if($project_update->save())
		{		
			echo '<div class="update_listing">
				<div class="update_image"><img src="'.url().'/images/avtar-image/'.$userProfile['user_avtar'].'" alt="Reminder icon" width="50" border="0" ></div>
				<div class="update_text">
					<p><span>'.$create_title.'</span> - just now</p>
					'.$update_text.'
				</div>
			</div><div class="clear"></div>';
		}		
	}
	
	public function postPedit($id,$update_title,$update_text)
	{ 		
		$project_update = ProjectUpdates::findOrFail($id);
		
		$project_update->title 				= $update_title;
		$project_update->description 		= $update_text;
		$project_update->status 			= 1;	
		$userProfile 		= Profile::where('user_id', Auth::id() )->first();		

		if($id=='' || $update_text=='' || $update_title=='')
		{
			echo "An error occurred. Please try again later";			
			die();
		}
		if($project_update->save())
		{
			echo $id;
			/*echo '<div class="update_listing">
				<div class="update_image"><img src="'.url().'/images/avtar-image/'.$userProfile['user_avtar'].'" alt="Reminder icon" width="50" border="0" ></div>
				<div class="update_text">
					<p><span>'.$update_title.'</span> - just now</p>
					'.$update_text.'
				</div>
			</div><div class="clear"></div>';*/
		}
		
	}
	
	public function postPdelete($id)
	{ 		
		$project_update = ProjectUpdates::find($id);    
		if($project_update->forceDelete())
		{
			echo $id;
		}		
	}


	public function postContactMe(Request $request)
	{ 
	
			if($request->ajax()) 
			{
				$pId 		= $request->get('pId');
				$msg 		= $request->get('msg');
				
				if(isset($pId) && isset($msg) )
				{
					$getProjectOwnerDetails			=			$this->project_repo->projectownerdetail($pId);
					$projectowner					=			$getProjectOwnerDetails[0];	

					$to_usernm			=	$projectowner['name'];
					$to_useremailid		=	$projectowner['email'];
					$to_userid			=	$projectowner['id'];

					$from_usernm 		=	Auth::user()->name;
					$from_userid 		=	Auth::user()->id;
					
					Session::set('sendemail', $to_useremailid);					

					if($projectowner)
					{

						Mail::queue('project.msghere', ['msg' => $msg] , function($message)
						{ 			
							$from_useremail 	=	Auth::user()->email;
							$to_useremail 		= Session::get('sendemail');

							$emailsubject = "Musicfunder - contact email";   
							$message->from($from_useremail, 'Musicfunder'); 
							$message->to($to_useremail)->subject($emailsubject);
						});  


						$message_header = new MessageHeader() ; 
						
						$message_header->from_id 			= $from_userid;
						$message_header->to_id 				= $to_userid;
						$message_header->content 			= $msg;
						$message_header->project_id 		= $pId;
						$message_header->status 			= 'inbox';	
						$message_header->sender_read 		= 'unread';
						$message_header->recipient_read 	= 'unread';						

						if ( $message_header->save() ) return response(['msg' => 'success' , 'data' => '' ]);
						else return response(['msg' => 'Data save failure' , 'data' => '' ]);						

						
					} else {		
					
						return response(['msg' => 'failure'  ]);
					}
						
				} else {
					return response(['msg' => 'failure'  ]);
				}				
			}	


		
	}
	
	
	public function getPledge()
	{
		$authId 		= 	Auth::user()->id ; 		
		$projectId 		=   ( \Input::get('key') ) ? \Input::get('key') : Null ; 
		$post 			= 	\App\Models\Project :: findOrFail($projectId); 

		return view('project.pledge' , [
					'_menus' 		=> $this->menuItems ,		
					'login_url' 	=> $this->login_url ,
					'post'			=> $post , 
					'rewards' 		=> \App\Models\Reward::where('P_ID' , $projectId)->get()	

		]);			

			
			
			
	}


	
	
	public function postPledgeAmount(Request $request)
	{
		
		$rewardsLog = new \App\Models\RewardsLogDuringPayment();
		$rewardsLog->array_obj = json_encode($request->all()) ; 
		$rewardsLog->save();		
		$lastInsertedId= $rewardsLog->id; 
		if($lastInsertedId > 0 ) return redirect('checkout/index?r=' . $lastInsertedId);
		else return redirect('project/pledge?key=' . $request->input('project_id'));

		

		//return view('project.show', compact('post' , '_menus' ,'rewards' , '_total_pledge_amount' ,'_total_backers_on_project' , '_pof' , 'login_url', 'userdetails', 'useraddedproj', 'id'));

	}
	

	public function getStartaproject()
	{  

		$g_categories 	= Category::lists('name', 'id');
		$g_genres 		= Genre::lists('name', 'id'); 
		$countries 		= Country::lists('countryName' , 'countryID' ); 
		$step_value 	= Session::get('step'); 
		$statArr		= array( '' => "Select Options" );
		$countries 		= array_merge($statArr,$countries);
		$categories 	= ( $statArr + $g_categories );
		$genres 		= ( $statArr + $g_genres );

		$get_last_insert_id = ( Session::has('last_insert_id') ) ?  Session::get('last_insert_id') : '';
		if(isset($get_last_insert_id)) $projectdet = Project::where('id', $get_last_insert_id)->first(); else $projectdet = '';

			if($step_value == 1) 
			{	
					return view('project.startaproject' , [ 
													'last_insert_id' => $get_last_insert_id , 
													'categories' => $categories , 
													'genres'=> $genres ,  
													'projectdet' => $projectdet,
													'_menus' => $this->menuItems,
													'login_url' => $this->login_url
												] );
			}
			elseif($step_value == 2)
			{ 
					return view('project.startaproject-step2' , [  
																	'last_insert_id' => $get_last_insert_id , 
																	'countries' => $countries , 
																	'projectdet' => $projectdet,
																	'_menus' => $this->menuItems,
																	'login_url' => $this->login_url		 	 
																]);
			}
			elseif($step_value == 3)
			{  
				$prewordstat=$this->project_repo->projectrewordd($get_last_insert_id);
				if($prewordstat > 0){ $rview='project.startaproject-step3-edit'; }else{ $rview='project.startaproject-step3'; }
					return view($rview, [  
																	'last_insert_id' => $get_last_insert_id  , 
																	'projectdet' => $projectdet,
																	'_menus' => $this->menuItems,
																	'login_url' => $this->login_url	 		
																]);
			} 
			elseif($step_value == 4)
			{ 

				return view('project.startaproject-step4', [ 
																'last_insert_id' => $get_last_insert_id,
																'_menus' => $this->menuItems,
																'login_url' => $this->login_url		  
														  ]);
			}
			elseif($step_value == 5) 
			{  
				return view('project.startaproject-confirmation', [ 
																'last_insert_id' => $get_last_insert_id,
																'projectdet' => $projectdet,
																'_menus' => $this->menuItems,
																'login_url' => $this->login_url			 
													]);
			}
			else 
			{
					return view('project.startaproject' , [
														'last_insert_id' => $get_last_insert_id , 
														'categories' => $categories , 
														'genres'=> $genres ,  
														'projectdet' => $projectdet,
														'_menus' => $this->menuItems,
														'login_url' => $this->login_url		 
													  ]);
			}


	}

	
	public function postStore(ProjectFormRequest $request)
	{

		$step 			= $request->get('step');
		$secret_key 	= $request->get('_secret_key_');
		
		if(empty($secret_key))
		{ 
					$project = new Project;
					$project ->fill($request->except('_token'));
					$project->user_id 		= Auth::user()->id;
					$project->slug 			= Str::slug($request->input('name')); 
					$project->currencytype	=  $request->input('currencytype'); 
					# Attach file with project
					if($request->hasFile('file_attachment')):
						$response = Event::fire(new FileAttachment($request ,	[
																					'input_file_tag' 	=> 'file_attachment' ,
																					'width' 			=> $this->width, 
																					'height' 			=> $this->height,
																					'mHeight' 			=> $this->mHeight,
																					'mWidth' 			=> $this->mWidth						
																				] 
						));
						
						if( count($response) > 0 ){					
							$project->file_attachment =  $response[0];
						} 						
					endif;	

					if($request->hasFile('pitch_video'))
			 		{				
						$file = $request->file('pitch_video');
						$imageName = date("ymdHis").'.'.$file->getClientOriginalExtension();
						$realPath = base_path() . '/public/images/file-attached-to-project/video/'; 
						$openMakePath = $realPath . $imageName; 
						$request->file('pitch_video')->move( $realPath, $imageName ); 
						$project->pitch_video = $imageName;
					}
					else
					{ 
						$project->pitch_video = '';
					}
	
					# Attach file with project : End 		
					
					if($project->save()){
						$auto_id= $project->id;
						//$secret_id = Crypt::encrypt($auto_id);
						$request->session()->flash('alert-success', 'Project has been created successfully');
						$step = $step + 1;
						Session::put('step', $step);
						Session::put('last_insert_id', $auto_id );		
						return \Redirect::to('/project/startaproject');						
					}else{
						Session::put('step', $step);
						$request->session()->flash('alert-warning', 'Error on project creation ! ');
						return redirect()->back()->withInput();			
					
					}
		
		} else {
		 
				$project_id = $secret_key;					
				if($step == 1):
					$project = Project::find($project_id);
					$project ->fill($request->except('_token'));
					$project->user_id 	= Auth::user()->id;
					$project->slug = Str::slug($request->input('name')); 
					
				if($request->hasFile('file_attachment')):
					$response = Event::fire(new FileAttachment($request , [
																			'input_file_tag' 	=> 'media_file_attachment' ,
																			'width' 			=> $this->width, 
																			'height' 			=> $this->height,
																			'mHeight' 			=> $this->mHeight,
																			'mWidth' 			=> $this->mWidth					
					] ));
					if( count($response) > 0 )	{					
						$project->file_attachment =  $response[0];						
					} 
					
				endif;					

				if($project->save()){
					$request->session()->flash('alert-success', 'Project has been created successfully');
					$step = $step + 1;
					Session::put('step', $step);
					return \Redirect::to('/project/startaproject');		
				}
				endif;		
					
					
					
				if($step ==  2) :  
					$projectData = array();					
					$projectData['details_description'] = $request->get('details_description');
					$projectData['address'] = $request->get('address');
					$projectData['address_alternate'] = $request->get('address_alternate');
					$projectData['city'] = $request->get('city');
					$projectData['state'] = $request->get('state');
					$projectData['country_id'] = $request->get('country_id');
					$projectData['feed_url'] = $request->get('feed_url');
					$projectData['pincode'] = $request->get('pincode');
					$projectData['external_video_url'] = $request->get('external_video_url');
					//$projectData['media_file_attachment'] = $request->get('media_file_attachment');
					$projectData['media_file_short_note'] = $request->get('media_file_short_note');
					
					if($request->hasFile('media_file_attachment'))
					{  
							$response = Event::fire(new FileAttachment($request , [
																					'input_file_tag' 	=> 'media_file_attachment' ,
																					'width' 			=> $this->width, 
																					'height' 			=> $this->height,
																					'mHeight' 			=> $this->mHeight,
																					'mWidth' 			=> $this->mWidth								
							
							] ));
							
							if( count($response) > 0 ){					
								$projectData['media_file_attachment']  =  $response[0];
							} 	 
					}						
					
									
					
					if ( Project::where('id', $project_id)->update($projectData))
					{
						$step = $step + 1;
						Session::put('step', $step);								
						return \Redirect::to('/project/startaproject');				

					}
					else
					{
						Session::put('step', $step);
						$request->session()->flash('alert-warning', 'Error on project creation ! ');
						return redirect()->back()->withInput();							

					}
					
				endif;
				
				if($step ==  3) :
					
					$projectData = array();	
					
					$reward_row_count 		= $request->get('reward_row_count');
					$pledge_amount 			= $request->get('pledge_amount');
					$short_note 			= $request->get('short_note');
					$user_limit 			= $request->get('user_limit'); 
					$delevery_year 			= $request->get('delevery_year');
					$delevery_month 		= $request->get('delevery_month'); 
					$shipping_details 		= $request->get('shipping_details');
					$file 					= $request->file('file_attachment');

 
					if( count($pledge_amount) > 0 )
					{ 
						$rewardsData = array();
						for($k=0 ; $k <= $reward_row_count ; $k++ )
						{
							$reward = new Reward(); 

							if($file[$k]!='')
							{
								$imageName = uniqid('project-reward-', true).'.'.$file[$k]->getClientOriginalExtension();
								$realPath = base_path() . '/public/images/file-attached-to-project/';
								$resizePath = base_path().'/public/images/file-attached-to-project/resize/' . $imageName; 
								$openMakePath = $realPath . $imageName; 
								$file[$k]->move( $realPath, $imageName );
								Image::make($openMakePath)->resize(1400, 623)->save($resizePath); 
								$reward->reword_image	 			= $imageName; 
							}
							else{
								$reward->reword_image	 			= "null";
							}

							if($k==0){ $reward->active = 1; } else { $reward->active = 0; }

							$reward->pledge_amount 			= $pledge_amount[$k];
							$reward->short_note 			= $short_note[$k];						
							$reward->user_limit 			= $user_limit[$k];
							$reward->delevery_year 			= $delevery_year[$k]; 
							$reward->delevery_month 		= $delevery_month[$k]; 
							$reward->shipping_details 		= $shipping_details[$k];
							$reward->P_ID = $project_id; 
							$reward->save();
						}

						$step = $step + 2;
						Session::put('step', $step);
						Session::put('last_insert_id', $project_id);
						return \Redirect::to('/project/startaproject');
					}
				endif;
				
		}
	}

	public function postSetsessionval($stepval, $presentId, Request $request)
	{ 
		if($request->ajax()) 
		{
			Session::put('step', $stepval);
			Session::put('editfstep', $stepval);	 
			Session::set('editfs_id', $presentId); 		
			return response(['msg' => 'Set session value', 'status' => 'success' ]);
		}
	}



	public function postSetsessioneval($stepval,  Request $request)
	{ 
		if($request->ajax()) 
		{
			Session::put('step', $stepval);
			Session::put('editfstep', $stepval);	 	
			return response(['msg' => 'Set session value', 'status' => 'success' ]);
		}
	}


	public function citylist($countryid)
	{   
		$citylist = $this->project_repo->getcitylist($countryid);  
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


	public function getEdtspdata(ProjectRepository $project_repo,  $id, $step)
	{
		$presentId=base64_decode($id);
		$presentStep=base64_decode($step); 
		Session::set('editfstep', $presentStep);
		Session::set('editfs_id', $presentId); 
		return redirect('project/projectedit');
		exit;		
	} 



	public function projectedit(ProjectRepository $project_repo)
	{  
		$categories 	= Category::lists('name', 'id');
		$genres 		= Genre::lists('name', 'id');
		$g_countries 	= Country::lists('countryName' , 'countryID' ); 
		$step_value 	= Session::get('editfstep');
		$edit_id 		= ( Session::has('editfs_id') ) ?  Session::get('editfs_id') : '';


		$statArr   = array( '' => " -- Select -- " );
		$countries = array_merge($statArr,$g_countries);
	
		if(isset($edit_id)) 
		{ 
			$projectdet = Project::where('id', $edit_id)->first(); 
		} 
		else 
		{
		 	$projectdet = array(); 
		}

		$gountryId   = $projectdet['country_id'];
		


		$citylist = $this->project_repo->getcitylist($gountryId);
	  	$datan=array();
	  	foreach($citylist  as $cityval){
	  		$id=$cityval['cityID'];
			$name=$cityval['cityName'];
			$datan[$id] = $name; 
		}	


		$rewardlist = $this->project_repo->getrewarddata($edit_id);   
		  
	  
		if($step_value == 1) 	
		{ 
			return view('project.startaproject-edit' , [ 
															'last_insert_id' => $edit_id, 
															'categories' => $categories, 
															'genres'=> $genres,  
															'projectdet' => $projectdet,
															'_menus' => $this->menuItems,
															'login_url' => $this->login_url	 
														]);
		}
		elseif($step_value == 2)
		{ 
			 
			return view('project.startaproject-step2-edit' , [    
															'last_insert_id' => $edit_id, 
															'countries' => $countries, 
															'projectdet' => $projectdet, 
															'citylist' => $datan,
															'_menus' => $this->menuItems,
															'login_url' => $this->login_url	  
															]);
		}
		elseif($step_value == 3) 
		{  
			$prewordstat=$this->project_repo->projectrewordd($edit_id);
			if($prewordstat > 0){ $rview='project.startaproject-step3-edit'; }else{ $rview='project.startaproject-step3'; }
			return view($rview, [   
															'rewardlist' => $rewardlist,
															'last_insert_id' => $edit_id, 
															'projectdet' => $projectdet,
															'_menus' => $this->menuItems,
															'login_url' => $this->login_url	 
														   ] );
		}
		elseif($step_value == 4) 
		{
			return view('project.project.create-step4', 		[  
															'last_insert_id' => $edit_id,
															'_menus' => $this->menuItems,
															'login_url' => $this->login_url	 
															]);
		}
		elseif($step_value == 5)
		{ 
			return view('project.startaproject-confirmation', [    
															'last_insert_id' => $edit_id,
															'projectdet' => $projectdet,
															'_menus' => $this->menuItems,
															'login_url' => $this->login_url		 
													  ] );
		}
		else 
		{
			return view('project.project.editproject' , [  
															'last_insert_id' => $edit_id,
															'_menus' => $this->menuItems,
															'login_url' => $this->login_url	 
													  ]);
		}
	}


	public function postUpdateproject(ProjectFormRequest $request)
	{   
		$step 			= $request->get('step');
		$secret_key 	= $request->get('_secret_key_');
 
		 		
		if(empty($secret_key))
		{  
					$project = new Project;
					$project ->fill($request->except('_token'));
					$project->user_id 		= $request->input('user_id');
					$project->slug = Str::slug($request->input('name')); 
					# Attach file with project
					if($request->hasFile('file_attachment')):
						 						
						$response = Event::fire(new FileAttachment($request , [
												'input_file_tag' 	=> 'file_attachment' ,
												'width' 			=> $this->width, 
												'height' 			=> $this->height ,
												'mHeight' 			=> $this->mHeight,
												'mWidth' 			=> $this->mWidth						
						] ));
						if( count($response) > 0 ){					
							$project->file_attachment =  $response[0];
						} 						
					endif;					
							
					# Attach file with project : End 		
					
					
					 
					
					if($project->save())
					{
						 
						$auto_id= $project->id;
						//$secret_id = Crypt::encrypt($auto_id);
						$request->session()->flash('alert-success', 'Project has been updated successfully');
						$step = $step + 1;
						Session::put('editfstep', $step);
						Session::put('editfs_id', $auto_id );		
						return \Redirect::to('/project/projectedit');						
					}
					else
					{
						 						
						Session::put('editfstep', $step);
						$request->session()->flash('alert-warning', 'Error on project creation ! ');
						return redirect()->back()->withInput();			
					
					}
		
		} 
		else { 
		 	
				$project_id = $secret_key;					
				if($step == 1): 
					$project = Project::find($project_id);
					$project ->fill($request->except('_token')); 
					$project->slug = Str::slug($request->input('name')); 
					
				if($request->hasFile('file_attachment')):
					$response = Event::fire(new FileAttachment($request , [
												'input_file_tag' 	=> 'file_attachment' ,
												'width' 			=> $this->width, 
												'height' 			=> $this->height,
												'mHeight' 			=> $this->mHeight,
												'mWidth' 			=> $this->mWidth						
					
					
					] ));
					if( count($response) > 0 )
					{					
						$project->file_attachment =  $response[0];
						
					} 						
				endif;					



				if($project->save()){   
					$request->session()->flash('alert-success', 'Project has been updated successfully');
					$step = $step + 1;  
					Session::put('editfstep', $step);
					return \Redirect::to('/project/projectedit');	

				}
				endif;		
					
					
					
				if($step ==  2) : 
					$projectData = array();					
					$projectData['details_description'] = $request->get('details_description');
					$projectData['address'] = $request->get('address');
					$projectData['address_alternate'] = $request->get('address_alternate');
					$projectData['city'] = $request->get('city');
					$projectData['state'] = $request->get('state');
					$projectData['country_id'] = $request->get('country_id');
					$projectData['feed_url'] = $request->get('feed_url');
					$projectData['pincode'] = $request->get('pincode');
					$projectData['external_video_url'] = $request->get('external_video_url');
					//$projectData['media_file_attachment'] = $request->get('media_file_attachment');
					$projectData['media_file_short_note'] = $request->get('media_file_short_note');
					
					if($request->hasFile('media_file_attachment')):
						$response = Event::fire(new FileAttachment($request , [
														'input_file_tag' 	=> 'media_file_attachment' ,
														'width' 			=> $this->width, 
														'height' 			=> $this->height,
														'mHeight' 			=> $this->mHeight,
														'mWidth' 			=> $this->mWidth							
						
						
						] ));
						if( count($response) > 0 ){					
							$projectData['media_file_attachment']  =  $response[0];
						} 						
					endif;						
					
					
					
					
					
					
					
					if ( Project::where('id', $project_id)->update($projectData))
					{
						$request->session()->flash('alert-success', 'Project has been updated successfully');
						$step = $step + 1;
						Session::put('editfstep', $step);								
						return \Redirect::to('/project/projectedit');				

					}
					else
					{
						Session::put('editfstep', $step);
						$request->session()->flash('alert-warning', 'Error on project creation ! ');
						return redirect()->back()->withInput();							

					}
					
				endif;
				
				if($step ==  3) :
  					
			 


					$projectData = array();	
					//dd( $request->all());
					$reward_row_count 		= $request->get('reward_row_count');
					$past_row_count 		= $request->get('past_row_count'); 
					$pledge_amount 			= $request->get('pledge_amount');
					$short_note 			= $request->get('short_note');
					$user_limit 			= $request->get('user_limit');
					$delevery_year 			= $request->get('delevery_year');
					$delevery_month 		= $request->get('delevery_month'); 
					$shipping_details 		= $request->get('shipping_details');
					$present_id		 		= $request->get('editid');
					$file 					= $request->file('file_attachment');

					$startcounter			= ( $past_row_count + 1 );
					$endcounter				= ( $reward_row_count - 1 );


					if( count($pledge_amount) > 0 )
					{ 
						$rewardsData = array();
						for($k=0 ; $k <= $past_row_count ; $k++ )
						{							
							/* $reward = new Reward(); */
							$rewaedid=$present_id[$k];
							$reward = Reward::find($rewaedid); 
							if(Reward::find($rewaedid))
							{

								if($file[$k]!='')
								{
									$imageName = uniqid('project-reward-', true).'.'.$file[$k]->getClientOriginalExtension();
									$realPath = base_path() . '/public/images/file-attached-to-project/';
									$resizePath = base_path().'/public/images/file-attached-to-project/resize/' . $imageName; 
									$openMakePath = $realPath . $imageName; 
									$file[$k]->move( $realPath, $imageName );
									Image::make($openMakePath)->resize(1400, 623)->save($resizePath); 
									$reward->reword_image	 			= $imageName; 
								}
								 


								$reward->pledge_amount 			= $pledge_amount[$k];
								$reward->short_note 			= $short_note[$k];						
								$reward->user_limit 			= $user_limit[$k];  
								$reward->delevery_year 			= $delevery_year[$k];
								$reward->delevery_month 		= $delevery_month[$k]; 
								$reward->shipping_details 		= $shipping_details[$k];
								$reward->P_ID 					= $project_id;
								$reward->active 				= 1;
								$reward->save(); 
							} 

						}

						for($m=$startcounter; $m <= $endcounter ; $m++ )
						{							
							$addreward = new Reward();

							if($file[$k]!='')
							{
								$imageName = uniqid('project-reward-', true).'.'.$file[$k]->getClientOriginalExtension();
								$realPath = base_path() . '/public/images/file-attached-to-project/';
								$resizePath = base_path().'/public/images/file-attached-to-project/resize/' . $imageName; 
								$openMakePath = $realPath . $imageName; 
								$file[$k]->move( $realPath, $imageName );
								Image::make($openMakePath)->resize(1400, 623)->save($resizePath); 
								$addreward->reword_image	 			= $imageName; 
							}
							 

							$addreward->pledge_amount 		= $pledge_amount[$m];
							$addreward->short_note 			= $short_note[$m];						
							$addreward->user_limit 			= $user_limit[$m]; 
							$addreward->delevery_year 		= $delevery_year[$m];
							$addreward->delevery_month 		= $delevery_month[$m];  
							$addreward->shipping_details 	= $shipping_details[$m];
							$addreward->P_ID 				= $project_id;
							$addreward->active 				= 1;
							$addreward->save(); 
						}

						$step = $step + 2;
						Session::put('editfstep', $step);
						return \Redirect::to('/project/projectedit');
					}
				endif;
				
		}		 
	}



	public function getChangepresentstatus($id)
	{   
		$reward = Reward::find($id); 
		$getrewardVal=$reward->active;
		if($getrewardVal=='1'){ 
			$outputvar=0;
		} else { 
			$outputvar=1;
		}
		$reward->active=$outputvar;
		$reward->save();
	}


	public function setaslive(ProjectFormRequest $request, $projectgid)
	{     

		$projectid              = base64_decode($projectgid);
		
		if(\Auth::check())
		{
			$authId 			= 	\Auth::user()->id ; 	
			$liveProjectLists 	= Project::where('user_id' , $authId)->where('active' , '1')->where('live' , '1')->first();
			
			if(count($liveProjectLists) > 0 )
			{
				
				$project_end_time = strtotime($liveProjectLists->approval_live) + ($liveProjectLists->project_duration *24*60*60) ;				
				$now = time();
				if( ($now < $project_end_time) &&  ($now > strtotime($liveProjectLists->approval_live)))
				{
						
						$request->session()->flash('alert-warning', 'Already you have running live project. You can not add another live project.');  
						return \Redirect::to('/home/project-posted'); 
						exit;
				}
				
			} else {
			
							$project 				= Project::find($projectid);
							$project->live 			= 1;
							$project->approval_live = date("Y-m-d");
							$project->save();  
							$request->session()->flash('alert-success', 'Project has been published and live . ');  
							return \Redirect::to('/home/project-posted'); 
							exit;
			
			}
		
		}
		

	}


	public function submitapprocal(ProjectFormRequest $request, $projectgid)
	{    
		$projectid              = base64_decode($projectgid);
		$project 				= Project::find($projectid);
		$project->active 		= 2; 
		$project->save();  
		$request->session()->flash('alert-success', 'Records successfully updated.');  
		return \Redirect::to('/home/project-posted'); 
		exit;
	}
	
	
	public function getPreview()
	{
		$id		=   ( \Input::get('p') ) ? \Input::get('p') : Null ;
		
		if(empty($id)) 	App::abort(404, 'Invalid Project Id');
			


 
		$login_url 		= $this->login_url ;
		$post 			= Project::findOrFail($id); 

		$guserdetails	=	$this->project_repo->getuserrecords($post->user_id);		
		$userdetails	=	$guserdetails[0];

		
		
		$_total_pledge_amount 		= 	$this->projectfund->where('P_ID' , $id)->where('status' , 'Pledged')->sum('paid_amount');		
		$_total_backers_on_project 	= 	$this->projectfund->where('P_ID' , $id)->where('status' , 'Pledged')->count();		
		$_pof_value 				= (( $_total_pledge_amount / $post->funding_goal)	* 100 );
		
		$_pof = ( $_pof_value > 1 ) ? $_pof = sprintf("%d%%", $_pof_value ) : ( ($_pof_value == 0 ) ? sprintf("%d%%", $_pof_value ) : sprintf("%.2f%%", $_pof_value ) ); 
		
		
	
					
		
		return view('project.share-preview', [
					'post' 							=> $post, 
					'_menus' 						=> $this->menuItems,
					'rewards' 						=> Reward::where('P_ID' , $id)->get(), 
					'_total_pledge_amount' 			=> $_total_pledge_amount ,
					'_total_backers_on_project' 	=> $_total_backers_on_project,
					'_pof' 							=> $_pof , 
					'login_url' 					=> $login_url,
					'userdetails' 					=> $userdetails, 
					'useraddedproj' 				=> 0
		
		]
		
		
		);

		
		
	}

	/**
	* Section written by DC on 12.11.15
	* Get or set reminder for a user on a project
	*/
	
	public function getJsonReminder(Request $request){
		try{
			$projectId = $request->get('projectId', 0);
			$userId = $request->get('userId', 0);
			
			$resultCount = \App\Models\ProjectReminder::where('project_id', $projectId)
				->where('user_id', $userId)
				->count();
			return response()->json(['success' => 'Information loaded successfully', 'count' => $resultCount, ]);	
		}catch(\Exception $e){
			return response()->json(['error' => $e->getMessage(), ]);	
		}
	}
	
	public function postJsonReminder(Request $request){
		try{
			$projectId = $request->get('projectId', 0);
			$userId = $request->get('userId', 0);
			$resultCount = \App\Models\ProjectReminder::where('project_id', $projectId)
				->where('user_id', $userId)
				->count();
			if(!$resultCount){
				$record = new \App\Models\ProjectReminder;
				$record->project_id = $projectId;
				$record->user_id = $userId;
				if($record->save())
					return response()->json(['success' => 'Record Saved Successfully', 'recrodId' => $record->id, ]);
				else
					return response()->json(['error' => 'Record Not Saved Successfully', ]);
			}else
				return response()->json(['error' => 'Record already existed', ]);
		}catch(\Exception $e){
			return response()->json(['error' => $e->getMessage(), ]);	
		}
	}
	
	public function getAjaxAskAboutProject($projectId){
		if(!\Request::ajax())
			abort('Requested method is not supported', 405);
		
		return view('project.ask_a_question')
			->withId($projectId);
	}
	public function postAjaxAskAboutProject(Request $request){
		if(!\Request::ajax())
			abort('Requested method is not supported', 405);
		//var_dump($request->all());
		
		$v = \Validator::make($request->except(['_token']), [
			'question' => 'required',
			'captcha' => 'required|captcha',
		], [
			'captcha' => 'The :attribute is invalid',
		]);
		
		if($v->fails())
			return response()->json(['error' => $v->errors()->all()]);
		
		$question = new \App\Models\ProjectQuestion;
		$question->project_id = $request->get('projectId', 0);
		$question->user_id = $request->get('userId', 0);
		$question->question = $request->get('question');
		
		if($question->save())
			return response()->json(['success' => 'Question Sent Successfully', 'recrodId' => $question->id, ]);
		else
			return response()->json(['error' => 'Question Not Sent Successfully', ]);
	}
	
	public function getAjaxReportProjectViolation($projectId){
		if(!\Request::ajax())
			abort('Requested method is not supported', 405);
		
		return view('project.report_violation')
			->withId($projectId);
	}
	
	public function postAjaxReportProjectViolation(Request $request){
		if(!\Request::ajax())
			abort('Requested method is not supported', 405);		
		
		$v = \Validator::make($request->except(['_token']), [
			'message' => 'required',
			'captcha' => 'required|captcha',
		], [
			'captcha' => 'The :attribute is invalid',
		]);
		
		if($v->fails())
			return response()->json(['error' => $v->errors()->all()]);
		
		$message = new \App\Models\ProjectViolation;
		$message->project_id = $request->get('projectId', 0);
		$message->user_id = $request->get('userId', 0);
		$message->message = $request->get('message');
		
		if($message->save())
			return response()->json(['success' => 'Message Sent Successfully', 'recrodId' => $message->id, ]);
		else
			return response()->json(['error' => 'Message Not Sent Successfully', ]);
	}

	
    public function getWidget($id)
	{	
		$updateRank = $this->project_repo->updateprojectrank($id);
		
		$featuredProjects 		= Project::where('id', $id)->get();		
		$total_backers			= ProjectFund::where('P_ID', $id)->count();
		$total_fund				= ProjectFund::where('P_ID', $id)->sum('paid_amount');		
		$funded=number_format((($total_fund/$featuredProjects[0]['funding_goal'])*100))."%";
		
		return view('project.embed' , [
		'_featuredProducts' 		=> 		$featuredProjects,			
		'_totalBackers' 			=> 		$total_backers,		
		'_totalFunds' 				=> 		$total_fund,		
		'_funded' 					=> 		$funded			
		]);		 
	}
	
	public function getOpenembed($id)
	{
			//$updateRank = $this->project_repo->updateprojectrank($id);
			//dd($updateRank);
		
	}
	
	static function humanTiming ($time)
	{

		$time = time() - $time; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}

	}
}
