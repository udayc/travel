<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use Crypt;
use App\Http\Requests\ProjectFormRequest;
use App\User;
use App\Models\Project;
Use App\Models\Country;
Use App\Models\Category;
Use App\Models\Reward;
Use App\Models\Genre; 
use Image;
use Validator; 
use DB;
use Session;
use Excel;
use Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Events\FileAttachment ; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProjectController extends Controller {

	protected $project_repo;
	protected $show_per_page = 1000;
	protected $width = 328 , $height = 168;
	protected $mWidth = 628 , $mHeight = 267;
	
	
	public function __construct(ProjectRepository $project_repo)
	{
		$this->project_repo = $project_repo;
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function getIndex( $criteria = Null )
	{ 

		Session::put('step', '1');
		Session::put('last_insert_id' , '');
		
		
		$searchKey =   ( \Input::get('srch-term') ) ? \Input::get('srch-term') : Null ; 
		 
		
		$projects = Project::whereIn('active' , [0, 1, 2, 3]);
		
		if($criteria != Null){ 
			switch($criteria)
			{
				case "active" :
				$projects = Project::where('active' , 1 );
				break;
				case "inactive" :
				$projects = Project::where('active' , 0 );
				break;
				case "featured" :
				$projects = Project::where('featured' , 1);
				break;
				case "suspended" :
				$projects = Project::where('status' , 1 );
				break;
				case "flaged" :
				$projects = Project::where('flag' , 1 );
				break;
				case "uflaged" :
				$projects = Project::where('user_flagged' , 1 );				
				break;

			}
			
		}
		
		if( $searchKey != Null )
		{ 
		 $projects->Where(function($query) use($searchKey)
						{
						//echo $searchKey; exit;
							$query->where('name', 'LIKE', '%'. $searchKey .'%');			
						})
						;	 
		} 
	 

		$results =  $projects->orderBy('id', 'desc')->paginate($this->show_per_page);	
		
		
		return view('admin.project.index' , ['projects' => $results , 'searchKey'=> $searchKey , 'dataStat'=> $this->project_repo->projectDataStat() ]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function getCreate()
	{ 

 
	$g_users 			= User::lists('name' , 'id');	
	$g_categories 	= Category::lists('name', 'id');
	$g_genres 		= Genre::lists('name', 'id'); 
 
	$step_value 	= Session::get('step'); 
	$statArr= array( '' => " -- Select -- " );
	$countries = Country::lists('countryName' , 'countryID' ); 


	$countries 		= array_merge($statArr,$countries);
	$users 			= ( $statArr + $g_users );
	$categories 	= ( $statArr + $g_categories );
	$genres 		= ( $statArr + $g_genres );


	$get_last_insert_id = ( Session::has('last_insert_id') ) ?  Session::get('last_insert_id') : '';
	if(isset($get_last_insert_id)) $projectdet = Project::where('id', $get_last_insert_id)->first(); else $projectdet = '';
	
	$func="add";
		
	if($step_value == 1) 	
	return view('admin.project.create' , ['func' => $func, 'last_insert_id' => $get_last_insert_id , 'categories' => $categories , 'genres'=> $genres , 'users'=>$users ,'projectdet' => $projectdet ] );
	elseif($step_value == 2) 
	return view('admin.project.create-step2' , [ 'func' => $func, 'last_insert_id' => $get_last_insert_id , 'countries' => $countries , 'projectdet' => $projectdet ]);
	elseif($step_value == 3) 
	return view('admin.project.create-step3', [ 'func' => $func, 'last_insert_id' => $get_last_insert_id  , 'projectdet' => $projectdet ] );
	elseif($step_value == 4) 
	return view('admin.project.create-step4', [ 'func' => $func, 'last_insert_id' => $get_last_insert_id ] );
	elseif($step_value == 5) 
	return view('admin.project.confirmation', [ 'func' => $func, 'last_insert_id' => $get_last_insert_id ] );
	else return view('admin.project.create' , ['func' => $func,  'last_insert_id' => $get_last_insert_id]);
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore(ProjectFormRequest $request)
	{
		$step 			= $request->get('step');
		$secret_key 	= $request->get('_secret_key_');
		
		if(empty($secret_key))
		{
			 
		
					$project = new Project;
					$project ->fill($request->except('_token'));
					$project->user_id 		= $request->input('user_id');
					$project->slug = Str::slug($request->input('name')); 
					$project->currencytype =  $request->input('currencytype'); 
					# Attach file with project
					if($request->hasFile('file_attachment')){
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
					}
					
					/** section to upload video file to Youtube after saving it in 
					* a local upload folder
					*/
					if($request->hasFile('video_attachment') && 
						$request->file('video_attachment')->isValid()
					){
						//dd('here');
						$uploadedVideo = $request->file('video_attachment');
						try{
							$randomFileName = FileUploadUtilities::generateRandomFileName($uploadedVideo->getClientOriginalExtension());
							$uploadedVideoFile = $uploadedVideo->move(
								FileUploadUtilities::getAbsoluteVideoUploadPath(),
								$randomFileName
							);
							
							//uploading it to YouTube using library façade
							//dd(FileUploadUtilities::getAbsoluteVideoUploadPath(). $randomFileName);
							$id = \Youtube::upload(FileUploadUtilities::getAbsoluteVideoUploadPath(). $randomFileName, [
								'title' => $request->get('name'),
								'description' => $request->get('short_description'),
								'category_id' => 10,
								'tags' => [
									$request->get('name'),
								]
							]);
							dd($id);
						}catch(\Exception $ex){
							dd($ex->getMessage());
							return redirect()
								->back()
								->withError('Video file could not be uploaded')
								->withInput();	
						}
					}
					
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
						return \Redirect::to('/admin/project/create');						
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
					$project->user_id 	= $request->input('user_id');
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
					return \Redirect::to('/admin/project/create');		
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
						return \Redirect::to('/admin/project/create');				

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
					//dd( $request->all());
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
						return \Redirect::to('/admin/project/create');
					}
				endif;
				
		}
			
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{

		/*
			$project = Project::where('id', $id)
			->with([
				'country' => function($query){
					$query->select(['id', 'name']);
				},
			])
			->get();
		*/
		$project = Project::find($id);
		$rewards = Reward::where('P_ID' , $id)->get();	
		return view('admin.project.show' , compact('project' , 'rewards'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function putUpdate($id)
	{
		//
	}

	/* 
		# PROJECT EDIT Stepwise START 

	*/

	public function getEdtsdata(ProjectRepository $project_repo,  $id, $step)
	{
		$presentId=base64_decode($id);
		$presentStep=base64_decode($step);

		Session::set('editstep', $presentStep);
		Session::set('edit_id', $presentId); 
		return redirect('admin/project/editproject');
		exit;		
	} 

	public function getEditproject(ProjectRepository $project_repo)
	{   
		$users 			= User::lists('name' , 'id');	
		$categories 	= Category::lists('name', 'id');
		$genres 		= Genre::lists('name', 'id');
		$g_countries 	= Country::lists('countryName' , 'countryID' ); 
		$step_value 	= Session::get('editstep');
		$edit_id 		= ( Session::has('edit_id') ) ?  Session::get('edit_id') : '';


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
		
		/*
		$getCitylist = $this->project_repo->getcitylist($gountryId);  
		echo "<pre>";
		print_r($getCitylist);
		exit;
		 $statArr = array(
						    0 => array(
						        'cityID' => '',
						        'cityName' => 'Select City'
						    ) 
					   );
		$result = array_merge($statArr, $citylist); 
		*/

		$citylist = $this->project_repo->getcitylist($gountryId);
	  	$datan=array();
	  	foreach($citylist  as $cityval){
	  		$id=$cityval['cityID'];
			$name=$cityval['cityName'];
			$datan[$id] = $name; 
		}	


		$rewardlist = $this->project_repo->getrewarddata($edit_id);   
		$url = config('medias.url');    
		$func="edit";



		if($step_value == 1) 	
		{
			return view('admin.project.editproject' , [ 'func' => $func,  'url' => $url , 'last_insert_id' => $edit_id , 'categories' => $categories , 'genres'=> $genres , 'users'=>$users ,'projectdet' => $projectdet ] );
		}
		elseif($step_value == 2)
		{ 
			 
			return view('admin.project.create-step2-edit' , [  'func' => $func,  'url' => $url , 'last_insert_id' => $edit_id , 'countries' => $countries , 'projectdet' => $projectdet, 'citylist' => $datan ]);
		}
		elseif($step_value == 3) 
		{  
			return view('admin.project.create-step3-edit', [ 'func' => $func,  'url' => $url , 'rewardlist' => $rewardlist ,'last_insert_id' => $edit_id  , 'projectdet' => $projectdet ] );
		}
		elseif($step_value == 4) 
		{
			return view('admin.project.create-step4', [ 'func' => $func,  'url' => $url , 'last_insert_id' => $edit_id ] );
		}
		elseif($step_value == 5)
		{ 
			return view('admin.project.confirmation', [  'func' => $func,  'url' => $url , 'last_insert_id' => $edit_id ] );
		}
		else 
		{
			return view('admin.project.editproject' , [ 'func' => $func,  'url' => $url , 'last_insert_id' => $edit_id]);
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
						Session::put('editstep', $step);
						Session::put('edit_id', $auto_id );		
						return \Redirect::to('/admin/project/editproject');						
					}
					else
					{
						 						
						Session::put('editstep', $step);
						$request->session()->flash('alert-warning', 'Error on project creation ! ');
						return redirect()->back()->withInput();			
					
					}
		
		} 
		else {

		 	
				$project_id = $secret_key;					
				if($step == 1):
					$project = Project::find($project_id);
					$project ->fill($request->except('_token'));
					$project->user_id 	= $request->input('user_id');
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
					Session::put('editstep', $step);
					return \Redirect::to('/admin/project/editproject');	

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
						Session::put('editstep', $step);								
						return \Redirect::to('/admin/project/editproject');				

					}
					else
					{
						Session::put('editstep', $step);
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
						Session::put('editstep', $step);
						return \Redirect::to('/admin/project/editproject');
					}
				endif;
				
		}
			
	}



	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function anyDestroy($id , Request $request)
	{
		if($request->ajax()) 
		{
			$project = Project::find($id);
			$project->delete();
			return response(['msg' => 'Project deleted', 'status' => 'success' ]);
		}		
	
	}
	
	
	public function postMassaction($actiontype , Request $request)
	{
		if($request->ajax()) 
		{
			if($actiontype == 'delete') 
			{
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->delete();
				}			
		
			}
			
			if($actiontype == 'inactive') 
			{
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->active = 0;
					$project->save();
				}				
				
			}

			if($actiontype == 'active') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->active = 1;
					$project->save();
				}				
				
			}	

			if($actiontype == 'suspend') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->status = 1;
					//$project->active = 0;
					$project->save();
				}				
				
			}
			
			if($actiontype == 'unsuspend') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->status = 0;
					//$project->active = 0;
					$project->save();
				}				
				
			}			
			
			 

			if($actiontype == 'featured') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->featured = 1;
					$project->save();
				}				
				
			}
			
			if($actiontype == 'notfeatured') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->featured = 0;
					$project->save();
				}				
				
			}			
			
			 

			if($actiontype == 'flag') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->flag = 1;
					$project->save();
				}				
				
			}
			
			if($actiontype == 'clearflag') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$project = Project::find($id);
					$project->flag = 0;
					$project->save();
				}				
				
			}			
			
			 

			
			$request->session()->flash('alert-success', 'Records successfully updated.');  
			return response(['msg' => 'Action Updated', 'status' => 'success' ]);
		}
		
	}
	
	
	public function postSearch(Request $request)
	{
		$searchKey	= $request->get('srch-term');
		//DB::connection()->enableQueryLog();		
		$results = Project::whereIn('active' , [0,1])		
					->Where(function($query) use($searchKey)
						{
							$query->where('name', 'LIKE', '%'. $searchKey .'%');
			
						})
					->paginate($this->show_per_page);
					
			
		//$queries = DB::getQueryLog();	
		if($results)
		{ 				
			return view('admin.project.index' ,['users' =>$results , 'result_count' => count($results) , 'dataStat'=> $this->project_repo->projectDataStat() ,'searchKey'=> $searchKey ]);
		}
		else
			return Redirect::back()->with('message','No results found');
	}
		
	
	
	public function postSetsessionval($stepval , Request $request)
	{
		if($request->ajax()) 
		{
			Session::put('step', $stepval);
			Session::put('editstep', $stepval);			
			return response(['msg' => 'Set session value', 'status' => 'success' ]);
		}
	}




	
	public function getExportselected($id, Request $request)
	{   
			Session::set('exportrec', $id);
			$excelnm="project_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
		    $excel->sheet('Project', function ($sheet) { 
		        $sheet->mergeCells('A1:W1');
		        $sheet->row(1, function ($row) {
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(30);
		        }); 
		        $sheet->row(1, array('Project Report'));  
		        $sheet->row(2, function ($row) { 
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(15);
		            $row->setFontWeight('bold');

		        }); 
		        $sheet->row(2, array('Project Details')); 
		        /* getting data to display - in my case only one record */ 
		        $ids = Session::get('exportrec');   
		        $newdatas=explode(",",$ids);    
		        $gdatalist = $this->project_repo->getexportrecords($newdatas);  


		         
		        $dataArr=array();

				if(is_array($gdatalist) && count($gdatalist)>0) 
				{
					$counter=0; 
					$pcounter=1; 
					foreach($gdatalist as $kyy=>$dataval)
					{ 
						$counter++;  
						$projId=$dataval['id'];
						$rewardlist = $this->project_repo->getexportrewardrecords($projId);   
						/* Code for reward section start*/
						if(is_array($rewardlist) && count($rewardlist)>0) 
						{    
							foreach($rewardlist as $abc=>$rewardval)
							{
								$counter++;
								if($abc==0)
								{   
									$dataArr[$counter]['SL']=$pcounter; 
									$dataArr[$counter]['Name']=$dataval['project_name'];
									$dataArr[$counter]['Date']=$dataval['prodectdate'];  
									$dataArr[$counter]['Slug']=$dataval['project_slug'];
									$dataArr[$counter]['Category']=$dataval['project_category']; 
									$dataArr[$counter]['Genre']=$dataval['project_genre'];
									$dataArr[$counter]['Description']=$dataval['project_description'];
									$dataArr[$counter]['Payment Method']=$dataval['project_payment_method'];
									$dataArr[$counter]['Funding Goal']=$dataval['project_funding_goal'];
									$dataArr[$counter]['Overfunding']=$dataval['project_allow_overfunding'];  
									$dataArr[$counter]['Funding end date']=$dataval['project_funding_end_date'];
									$dataArr[$counter]['Address']=$dataval['project_address']; 
									$dataArr[$counter]['City']=$dataval['project_city']; 
									$dataArr[$counter]['State']=$dataval['project_state']; 
									$dataArr[$counter]['Country']=$dataval['project_country']; 
									$dataArr[$counter]['Pin Code']=$dataval['project_pincode']; 
									$dataArr[$counter]['Reward Pledge Amount']=$rewardval['project_pledge_amount'];   
									$dataArr[$counter]['Reward short note']=$rewardval['short_note']; 
									$dataArr[$counter]['Reward estimated delivery']=$rewardval['estimated_delivery']; 
									$dataArr[$counter]['Reward shipping details']=$rewardval['shipping_details']; 
									$dataArr[$counter]['Reward user limit']=$rewardval['user_limit'];	
								}
								else
								{ 
									$dataArr[$counter]['SL']=""; 
									$dataArr[$counter]['Name']=""; 
									$dataArr[$counter]['Date']=""; 
									$dataArr[$counter]['Slug']=""; 
									$dataArr[$counter]['Category']=""; 
									$dataArr[$counter]['Genre']=""; 
									$dataArr[$counter]['Description']=""; 
									$dataArr[$counter]['Payment Method']=""; 
									$dataArr[$counter]['Funding Goal']=""; 
									$dataArr[$counter]['Overfunding']=""; 
									$dataArr[$counter]['Funding end date']=""; 
									$dataArr[$counter]['Address']=""; 
									$dataArr[$counter]['City']=""; 
									$dataArr[$counter]['State']=""; 
									$dataArr[$counter]['Country']=""; 
									$dataArr[$counter]['Pin Code']=""; 
									$dataArr[$counter]['Reward Pledge Amount']=$rewardval['project_pledge_amount'];   
									$dataArr[$counter]['Reward short note']=$rewardval['short_note']; 
									$dataArr[$counter]['Reward estimated delivery']=$rewardval['estimated_delivery']; 
									$dataArr[$counter]['Reward shipping details']=$rewardval['shipping_details']; 
									$dataArr[$counter]['Reward user limit']=$rewardval['user_limit'];  
								} 
							} 
						}
						else
						{ 
							$dataArr[$counter]['SL']=$pcounter; 
							$dataArr[$counter]['Name']=$dataval['project_name'];
							$dataArr[$counter]['Date']=$dataval['prodectdate'];  
							$dataArr[$counter]['Slug']=$dataval['project_slug'];
							$dataArr[$counter]['Category']=$dataval['project_category']; 
							$dataArr[$counter]['Genre']=$dataval['project_genre'];
							$dataArr[$counter]['Description']=$dataval['project_description'];
							$dataArr[$counter]['Payment Method']=$dataval['project_payment_method'];
							$dataArr[$counter]['Funding Goal']=$dataval['project_funding_goal'];
							$dataArr[$counter]['Overfunding']=$dataval['project_allow_overfunding'];  
							$dataArr[$counter]['Funding end date']=$dataval['project_funding_end_date'];
							$dataArr[$counter]['Address']=$dataval['project_address']; 
							$dataArr[$counter]['City']=$dataval['project_city']; 
							$dataArr[$counter]['State']=$dataval['project_state']; 
							$dataArr[$counter]['Country']=$dataval['project_country']; 
							$dataArr[$counter]['Pin Code']=$dataval['project_pincode']; 
							$dataArr[$counter]['Reward Pledge Amount']=""; 
							$dataArr[$counter]['Reward short note']=""; 
							$dataArr[$counter]['Reward estimated delivery']=""; 
							$dataArr[$counter]['Reward shipping details']=""; 
							$dataArr[$counter]['Reward user limit']=""; 
						} 	 
						/* Code for reward section end*/ 
						$pcounter++;
					} 
				} 
			   $dataArrn = array_combine(range(1, count($dataArr)), array_values($dataArr));
			 	 /*
				  echo "<pre>";
				  print_r($gdatalist);
				  echo "<br>-------------1ST-----------------<br>";
				  echo "<pre>";
				  print_r($dataArr);
				  echo "<br>-------------2nd-----------------<br>";
				  echo "<pre>";
				  print_r($dataArrn);
				  exit;
				  */

		        /* setting column names for data - you can of course set it manually */
		        $sheet->appendRow(array_keys($dataArrn[1])); /* column names */ 
		        /* getting last row number (the one we already filled and setting it to bold */
		        $sheet->row($sheet->getHighestRow(), function ($row) {
		            $row->setFontWeight('bold');
		        }); 
		        /* putting users data as next rows */
		        foreach ($dataArrn as $user) {
		            $sheet->appendRow($user);
		        }
		    });

		})->export('xls');	 

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
	
	
	public function getChangeactstat($projectid, $projectstatus)
	{   
		$project = Project::find($projectid);
		$project->active = $projectstatus;
		$project->save(); 
	}

	
	public function getCheckStafPickByGenre($projectid, $projectstatus)
	{
	
		$project = Project::find($projectid);
		$project_genre_id = $project->project_genre_id;		
		$staffPickCountByGenre = Project::where('project_genre_id',  $project_genre_id)->where('featured',  '1')->count();
		if($staffPickCountByGenre > 0 )
			return response(['msg' => 'Action Updated', 'status' => '1' ]);
		else
			return response(['msg' => 'Action Updated', 'status' => '0' ]);	  
	}
	 
	
	
	public function getChangefeastat($projectid, $projectstatus)
	{   

		$project 			= Project::find($projectid);
		if ( $projectstatus ==1) {
		
		$project_genre_id 	= $project->project_genre_id;			
		$affectedRows 		= Project::where('project_genre_id',  $project_genre_id)->where('featured',  '1')->update(['featured' => 0]);
		
		$project->featured = $projectstatus;
		if( $project->save() ) {
			\Request::session()->flash('alert-success', 'Staff Pick has been set successfully.');  
			return response(['msg' => 'Action Updated', 'status' => 'OK' ]);
		}
		else {
			return response(['msg' => 'Action Updated', 'status' => 'FAILED' ]);
		}
		
		
		
		
		
		} else {
				$project->featured = $projectstatus;
				
				if( $project->save() ) {
				\Request::session()->flash('alert-success', 'Staff Pick has been unset successfully.');  
				return response(['msg' => 'Action Updated', 'status' => 'OK' ]);
				}
				else {
				return response(['msg' => 'Action Updated', 'status' => 'FAILED' ]);
				}				
				
				
				
		}
		
		

		
	}	
	

	public function getCitylist($countryid)
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
	
	public function getSetaslive(ProjectFormRequest $request, $projectid)
	{    
		$project 				= Project::find($projectid);
		$project->live 			= 1;
		$project->approval_live = date("Y-m-d");
		$project->save();  
		$request->session()->flash('alert-success', 'Records successfully updated.');  
		return \Redirect::to('/admin/project'); 
		exit;
	}	
	

}
