<?php namespace App\Repositories;


use App\Models\Project;
use App\Models\User;
use App\Models\Profile;
Use App\Models\ProjectFund;
Use App\Models\ProjectUpdates;
use App\Models\City;
use DateTime;

use App\Models\Reward;



class ProjectRepository extends Repository{
  
	protected $project;
	protected $user;
	protected $projectfund;
	//protected $projectDetails = array();
	protected $reward;
	protected $projectupdates;
 
	public function __construct( Project $project , User $user ,  ProjectFund $projectfund , Reward $reward, City $city, ProjectUpdates $projectupdates  )
	{ 
		$this->model 		= $project; 
		$this->usermodel 	= $user; 
		$this->projectfund 	= $projectfund;
		$this->rewardmodel 	= $reward; 
		$this->citymodel  = $city;
		$this->projectupdatesmodel  = $projectupdates;

	}
	
	public function model()
	{
		return 'App\Models\Project';
	}	

	public function rewardmodel()
	{
		return 'App\Models\Reward';
	}		

	public  function sortByCriteria($criteria=null)
	{
		switch($criteria)
		{
			case 'active' :
					$records = $this->model->where('active' , '1')->count();	
					return $records;
			break;
			
			case 'inactive' :
					$records = $this->model->where('active' , '0')->count();	
					return $records;
			break;	

			case 'featured' :
					$records = $this->model->where('featured' , '1')->count();	
					return $records;
			break;	
			case 'suspend' :
					$records = $this->model->where('status' , '1')->count();	
					return $records;
			break;	

			case 'flag' :
					$records = $this->model->where('flag' , '1')->count();	
					return $records;
			break;
			case 'userflag' :
					$records = $this->model->where('user_flagged' , '1')->count();	
					return $records;
			break;			
			
			
			

			case 'all' :
					$records = $this->model->whereIn('active',[1,0])->count();	
					return $records;
			break;				
			
			
		}
	}


	/* Get User Count By Their Criteria */
	public function projectDataStat()
	{
		return array( 
					'active' 		=> $this->sortByCriteria('active'),
					'inactive' 		=> $this->sortByCriteria('inactive'), 
					'featured' 		=> $this->sortByCriteria('featured'), 
					'flag' 			=> $this->sortByCriteria('flag'),
					'userflag' 		=> $this->sortByCriteria('userflag'), 					
					'suspend' 		=> $this->sortByCriteria('suspend'), 
					'all' 			=> $this->sortByCriteria('all')				
		
					);
	}	


	public function prepareListObj($lists = Null , $toSort = Null )
	{
		
		$projectDetails = array();
		if($toSort != Null )
		{
			foreach($lists as $key => $value)
			{ 		
				$data_arr = array();		
				$val = $this->model->find($key);
				$date1 = new \DateTime($val->funding_end_date);
				$date2 = new \DateTime();
				$_pof_value = ( ( $this->ProjectRelatedData( $val->id , $val->user_id , 'tpa') / $val->funding_goal) * 100 );
				$_pof = ( $_pof_value > 1 ) ? $_pof = sprintf("%d%%", $_pof_value ) : ( ($_pof_value == 0 ) ? sprintf("%d%%", $_pof_value ) : sprintf("%.2f%%", $_pof_value ) ); 

				$data_arr['id'] 							= $val->id ;
				$data_arr['name'] 							= $val->name ;
				$data_arr['slug'] 							= $val->slug ; 
				$data_arr['short_description'] 				= $val->short_description ; 
				$data_arr['funding_goal'] 					= $val->funding_goal ;
				$data_arr['funding_end_date'] 				= $val->funding_end_date ;
				$data_arr['posted_by'] 						= $val->user()->first()->name ;
				$data_arr['genre_slug'] 					= $val->genre->genre_slug ;
				$data_arr['project_genre_id' ]				= $val->project_genre_id ;
				$data_arr['category'] 						= $val->category->name ;
				$data_arr['days_to_go'] 					= $date2->diff($date1)->format("%a");
				$data_arr['_total_pledge_amount' ]			= $this->ProjectRelatedData( $val->id , $val->user_id ,'tpa' ) ;
				$data_arr['_total_backers_on_project'] 		= $this->ProjectRelatedData( $val->id , $val->user_id ,'tbop') ; 
				$data_arr['_total_pledge_amount_of_user' ]	= $this->ProjectRelatedData( $val->id , $val->user_id , 'tpaofauser' ) ;
				$data_arr['_pof'] 							= $_pof;
				$data_arr['created_at']						= $val->created_at ;
				$data_arr['file_attachment']				= $val->file_attachment ;				
				$data_arr['status']							= $val->status ;
				$data_arr['active']							= $val->active ;
				$data_arr['live']							= $val->live ;	
				$data_arr['P_CAT_ID']						= $val->P_CAT_ID ;	
				$data_arr['project_duration']				= $val->project_duration ;
				$data_arr['flag']							= $val->flag ;	
				if(isset(\Auth::user()->id) && \Auth::user()->id > 0 ) :
				$data_arr['_total_pledge_amount_of_auth_user' ]	= $this->ProjectRelatedData( $val->id , \Auth::user()->id , 'tpaofauser' ) ;
				endif; 				
				
				$projectDetails[$val->id] 					= (object)$data_arr;		
			}		

		} 
		else { 

					foreach($lists as $val)
					{	
						$data_arr = array();		
						$date1 = new \DateTime($val->funding_end_date);
						$date2 = new \DateTime();
						
						$_pof_value = ( ( $this->ProjectRelatedData( $val->id , $val->user_id , 'tpa') / $val->funding_goal) * 100 );
						$_pof 		= ( $_pof_value > 1 ) ? $_pof = sprintf("%d%%", $_pof_value ) : ( ($_pof_value == 0 ) ? sprintf("%d%%", $_pof_value ) : sprintf("%.2f%%", $_pof_value ) ); 						
						
						
						$data_arr['id'] 							= $val->id ;
						$data_arr['name'] 							= $val->name ;
						$data_arr['slug'] 							= $val->slug ; 
						$data_arr['short_description'] 				= $val->short_description ; 
						$data_arr['funding_goal'] 					= $val->funding_goal ;
						$data_arr['funding_end_date'] 				= $val->funding_end_date ;
						$data_arr['posted_by'] 						= $val->user()->first()->name ;
						$data_arr['genre_slug'] 					= $val->genre->genre_slug ;
						$data_arr['project_genre_id' ]				= $val->project_genre_id ;
						$data_arr['category'] 						= $val->category->name ;
						$data_arr['days_to_go'] 					= $date2->diff($date1)->format("%a");
						$data_arr['_total_pledge_amount' ]			= $this->ProjectRelatedData( $val->id , $val->user_id , 'tpa' ) ;
						$data_arr['_total_backers_on_project'] 		= $this->ProjectRelatedData( $val->id , $val->user_id ,'tbop') ; 
						$data_arr['_total_pledge_amount_of_user' ]	= $this->ProjectRelatedData( $val->id , $val->user_id , 'tpaofauser' ) ;
						$data_arr['_pof'] 							= $_pof ;
						$data_arr['created_at']						= $val->created_at ;
						$data_arr['file_attachment']				= $val->file_attachment ;
						$data_arr['active']							= $val->active ;
						$data_arr['live']							= $val->live ;	
						$data_arr['P_CAT_ID']						= $val->P_CAT_ID ;	
						$data_arr['project_duration']				= $val->project_duration ;	
						$data_arr['status']							= $val->status ;
						$data_arr['flag']							= $val->flag ;
						$data_arr['project_end_date']				= strtotime($val->approval_live) +  ($val->project_duration *24*60*60) ;	
						
						
						if(isset(\Auth::user()->id) && \Auth::user()->id > 0 ) :
						$data_arr['_total_pledge_amount_of_auth_user' ]	= $this->ProjectRelatedData( $val->id , \Auth::user()->id , 'tpaofauser' ) ;
						endif; 
						
						$projectDetails[$val->id] 					= (object)$data_arr;
				
					}	
	}

	
		return $projectDetails;
	
	}
	
	public function prepareListArr($lists = Null , $toSort = Null )
	{
		
		$projectDetails = array();
		if($toSort != Null )
		{
			foreach($lists as $key => $value)
			{ 		
				$data_arr = array();		
				$val = $this->model->find($key);
				$date1 = new \DateTime($val->funding_end_date);
				$date2 = new \DateTime();
				$_pof_value = ( ( $this->ProjectRelatedData( $val->id , $val->user_id , 'tpa') / $val->funding_goal) * 100 );
				$_pof = ( $_pof_value > 1 ) ? $_pof = sprintf("%d%%", $_pof_value ) : ( ($_pof_value == 0 ) ? sprintf("%d%%", $_pof_value ) : sprintf("%.2f%%", $_pof_value ) ); 

				$data_arr['id'] 							= $val->id ;
				$data_arr['name'] 							= $val->name ;
				$data_arr['slug'] 							= $val->slug ; 
				$data_arr['short_description'] 				= $val->short_description ; 
				$data_arr['funding_goal'] 					= $val->funding_goal ;
				$data_arr['funding_end_date'] 				= $val->funding_end_date ;
				$data_arr['posted_by'] 						= $val->user()->first()->name ;
				$data_arr['genre_slug'] 					= $val->genre->genre_slug ;
				$data_arr['project_genre_id' ]				= $val->project_genre_id ;
				$data_arr['category'] 						= $val->category->name ;
				$data_arr['days_to_go'] 					= $date2->diff($date1)->format("%a");
				$data_arr['_total_pledge_amount' ]			= $this->ProjectRelatedData( $val->id , $val->user_id ,'tpa' ) ;
				$data_arr['_total_backers_on_project'] 		= $this->ProjectRelatedData( $val->id , $val->user_id ,'tbop') ; 
				$data_arr['_total_pledge_amount_of_user' ]	= $this->ProjectRelatedData( $val->id , $val->user_id , 'tpaofauser' ) ;
				$data_arr['_pof'] 							= $_pof;
				$data_arr['created_at']						= $val->created_at ;
				$data_arr['file_attachment']				= $val->file_attachment ;				
				$data_arr['status']							= $val->status ;
				$data_arr['active']							= $val->active ;
				$data_arr['live']							= $val->live ;	
				$data_arr['P_CAT_ID']						= $val->P_CAT_ID ;	
				$data_arr['project_duration']				= $val->project_duration ;
				$data_arr['flag']							= $val->flag ;	
				if(isset(\Auth::user()->id) && \Auth::user()->id > 0 ) :
				$data_arr['_total_pledge_amount_of_auth_user' ]	= $this->ProjectRelatedData( $val->id , \Auth::user()->id , 'tpaofauser' ) ;
				endif; 				
				
				$projectDetails[$val->id] 					= $data_arr;		
			}		

		} 
		else { 

					foreach($lists as $val)
					{	
						$data_arr = array();		
						$date1 = new \DateTime($val->funding_end_date);
						$date2 = new \DateTime();
						
						$_pof_value = ( ( $this->ProjectRelatedData( $val->id , $val->user_id , 'tpa') / $val->funding_goal) * 100 );
						$_pof 		= ( $_pof_value > 1 ) ? $_pof = sprintf("%d%%", $_pof_value ) : ( ($_pof_value == 0 ) ? sprintf("%d%%", $_pof_value ) : sprintf("%.2f%%", $_pof_value ) ); 						
						
						
						$data_arr['id'] 							= $val->id ;
						$data_arr['name'] 							= $val->name ;
						$data_arr['slug'] 							= $val->slug ; 
						$data_arr['short_description'] 				= $val->short_description ; 
						$data_arr['funding_goal'] 					= $val->funding_goal ;
						$data_arr['funding_end_date'] 				= $val->funding_end_date ;
						$data_arr['posted_by'] 						= $val->user()->first()->name ;
						$data_arr['genre_slug'] 					= $val->genre->genre_slug ;
						$data_arr['project_genre_id' ]				= $val->project_genre_id ;
						$data_arr['category'] 						= $val->category->name ;
						$data_arr['days_to_go'] 					= $date2->diff($date1)->format("%a");
						$data_arr['_total_pledge_amount' ]			= $this->ProjectRelatedData( $val->id , $val->user_id , 'tpa' ) ;
						$data_arr['_total_backers_on_project'] 		= $this->ProjectRelatedData( $val->id , $val->user_id ,'tbop') ; 
						$data_arr['_total_pledge_amount_of_user' ]	= $this->ProjectRelatedData( $val->id , $val->user_id , 'tpaofauser' ) ;
						$data_arr['_pof'] 							= $_pof ;
						$data_arr['created_at']						= $val->created_at ;
						$data_arr['file_attachment']				= $val->file_attachment ;
						$data_arr['active']							= $val->active ;
						$data_arr['live']							= $val->live ;	
						$data_arr['P_CAT_ID']						= $val->P_CAT_ID ;	
						$data_arr['project_duration']				= $val->project_duration ;	
						$data_arr['status']							= $val->status ;
						$data_arr['flag']							= $val->flag ;
						$data_arr['project_end_date']				= strtotime($val->approval_live) +  ($val->project_duration *24*60*60) ;	
						
						
						if(isset(\Auth::user()->id) && \Auth::user()->id > 0 ) :
						$data_arr['_total_pledge_amount_of_auth_user' ]	= $this->ProjectRelatedData( $val->id , \Auth::user()->id , 'tpaofauser' ) ;
						endif; 
						
						$projectDetails[$val->id] 					= $data_arr;
				
					}	
	}

	
		return $projectDetails;
	
	}


	public function ProjectRelatedData($p_id , $u_id , $param)
	{
		switch($param)
		{
			case 'tpa':
						$_result = 	$this->projectfund->where('P_ID' , $p_id)->where('status' , 'Pledged')->sum('paid_amount');
						break;			
			case 'tbop':
						//$_result = 	$this->projectfund->where('P_ID' , $p_id)->where('status' , 'Pledged')->count(DISTINCT(`U_ID`));
						//SELECT COUNT(DISTINCT(`U_ID`)) FROM `project_funds` WHERE `P_ID` = 3
						$results = \DB::select( \DB::raw("SELECT COUNT(DISTINCT(`U_ID`)) as backercount FROM project_funds WHERE P_ID = '$p_id'") );
						//dd($results[0]->backercount);
						$_result = $results[0]->backercount;
						break;
			case 'tpaofauser':
						$_result = 	$this->projectfund->where('P_ID' , $p_id)->where('U_ID' , $u_id)->whereIn('status' , ['Pledged' , 'Funded'])->sum('paid_amount');
						break;	
						
		}
	
		return $_result;
	
	}

	Public function sortByPrepareListObj($data , $sortBy = Null)
	{
		$filteredData = array(); 
		if($sortBy == 'most-funded'){
			foreach ($data as $key => $value) {	$filteredData[$key] = $value->_total_pledge_amount;	}
			arsort( $filteredData );
		}
		if($sortBy == 'most-recent'){
			foreach ($data as $key => $value) {	$filteredData[$key] = $value->created_at;	}
			arsort( $filteredData );
		}		
		
		if($sortBy == 'closing-soon'){
			foreach ($data as $key => $value) {	$filteredData[$key] = $value->funding_end_date;	}
			asort( $filteredData );
		}
		
		//dd($filteredData );
		$_projectList = $this->prepareListObj($filteredData , $sortBy );
		
 
		return $_projectList ;
	}
	

	
	public function getrewarddata($projectid)
	{    
		$orderby="project_backer_rewards.id";
		$direction="ASC";
		$query = $this->rewardmodel->select('project_backer_rewards.id AS id',
									  'project_backer_rewards.pledge_amount AS project_pledge_amount',
							 		  'project_backer_rewards.short_note',
							 		  'project_backer_rewards.delevery_year',
							 		  'project_backer_rewards.delevery_month',
							 		  'project_backer_rewards.reword_image',
							 		  'project_backer_rewards.shipping_details',
							 		  'project_backer_rewards.user_limit',
							 		  'project_backer_rewards.P_ID',
							 		  'project_backer_rewards.active'
							 		 )
							 ->where('project_backer_rewards.P_ID', $projectid )   
							 ->orderBy($orderby, $direction);  
		return $query->get()->toArray();		
	}	
	
	
	
	
	

	public function getexportrecords($finaldt)
	{    
		$orderby="projects.id";
		$direction="ASC";
		$query = $this->model->join('project_categories', 'projects.P_CAT_ID', '=', 'project_categories.id')
							 ->join('project_genre', 'projects.project_genre_id', '=', 'project_genre.id')
							 ->join('countries', 'projects.country_id', '=', 'countries.id')
							 ->join('users', 'projects.user_id', '=', 'users.id') 
							 ->select('projects.id AS id', 
							 		  'projects.name AS project_name', 
							 		  'projects.slug AS project_slug',
							 		  'project_categories.name AS project_category',
							 		  'project_genre.name AS project_genre',
							 		  'projects.short_description AS project_description',
							 		  'projects.payment_method AS project_payment_method',
							 		  'projects.funding_goal AS project_funding_goal', 
							 		  'projects.allow_overfunding AS project_allow_overfunding',
							 		  'projects.funding_end_date AS project_funding_end_date', 
							 		  'projects.address AS project_address',
							 		  'projects.city AS project_city',
							 		  'projects.state AS project_state',
							 		  'countries.name AS project_country',
							 		  'projects.pincode AS project_pincode',  
							 		  'projects.updated_at AS prodectdate'
							 		 )
							 ->whereIn('projects.id', $finaldt )   
							 ->orderBy($orderby, $direction);  
		return $query->get()->toArray();		
	}


	public function getexportrewardrecords($projectid)
	{    
		$orderby="project_backer_rewards.id";
		$direction="ASC";
		$query = $this->rewardmodel->select('project_backer_rewards.pledge_amount AS project_pledge_amount',
							 		  'project_backer_rewards.short_note',
							 		  'project_backer_rewards.estimated_delivery',
							 		  'project_backer_rewards.shipping_details',
							 		  'project_backer_rewards.user_limit'
							 		 )
							 ->where('project_backer_rewards.P_ID', $projectid )   
							 ->orderBy($orderby, $direction);  
		return $query->get()->toArray();		
	}


	public function updateprojectrank($projectid)
	{    
		$projectn 	    = $this->model->findOrFail($projectid);
		$newrank 	    = ($projectn['rank'] +1);  
		$this->model->where('id', $projectid)->update(array('rank' => $newrank )); 
	}	
	
	
	public function projectHistoryShareLogs($criteria = null , $p_id = null)
	{
		switch($criteria)
		{
			case "project-views" :
			
					$project_views = new \App\Models\ProjectShare();
					$project_views->user_id = ( \Auth::check() ) ?  \Auth::user()->id : 0 ; 
					$project_views->project_id = $p_id;
					$project_views->view_count = 1;
					$project_views->ip = $_SERVER['REMOTE_ADDR'];
					$project_views->save();			
			
			
			break;
			default:
			
		}
	}
	
	
	
	



	public function getuserrecords($userid)
	{      
		$query = $this->usermodel->join('profiles', 'users.id', '=', 'profiles.user_id')  
								 ->join('IM_countries', 'profiles.country_id', '=', 'IM_countries.countryID')  
							 	 ->select(  
											'users.id AS id', 
											'users.last_login AS last_login', 
											'users.email AS email',  
											'profiles.f_name AS f_name',
											'profiles.l_name AS l_name',
											'profiles.gender AS gender',
											'profiles.dob AS dob', 
											'profiles.about_me AS about_me',
											'profiles.education AS education',
											'profiles.employment_status AS employment_status',
											'profiles.income_range AS income_range',
											'profiles.relationship_status AS relationship_status',
											'profiles.first_address AS first_address',
											'profiles.alternate_address AS alternate_address',
											'profiles.contact_no AS contact_no',
											'profiles.city AS city',
											'profiles.state AS state',
											'profiles.zipcode AS zipcode',
											'profiles.website AS website',
											'profiles.user_avtar AS user_avtar',
											'IM_countries.countryName AS project_country'
							 		 	  )
							 	 ->where('users.id', $userid );
		return $query->get()->toArray(); 
	}

	

	public function projectbyuser($userid)
	{    
		$query = $this->model->where('user_id',$userid)->count();	
		return $query;   
	} 

	public function projectownerdetail($projectid)
	{    
		$orderby="projects.id";
		$direction="ASC";
		$query = $this->model->join('users', 'projects.user_id', '=', 'users.id') 
							 ->select('users.id AS id', 
							 		  'users.name AS name', 
							 		  'users.email AS email' 
							 		 )
							 ->where('projects.id', $projectid );  
		return $query->get()->toArray();		 
	} 	


	public function getcitylist($countyid)
	{    
		$orderby="IM_cities.cityName";
		$direction="ASC"; 
		$query = $this->citymodel->select('cityID', 'cityName' ) 
							 ->where('countryID', $countyid)
							 ->orderBy($orderby, $direction);  
		return $query->get()->toArray();	
	}



	public function projectrewordd($projectid)
	{    
		$query = $this->rewardmodel->where('P_ID',$projectid)->count();	
		return $query;   
	} 

	public function checkprojectuser($id,$user_id)
	{    
		return $records = $this->model->where('id' , $id)->where('user_id' , $user_id)->count();			 
	} 
	
	public function getupdatedetails($projectid)
	{    
		//dd($projectid);
		$query = $this->projectupdatesmodel->where('project_id',$projectid)->orderBy('id','DESC');
		//dd($query->get()->toArray());
		return $query->get()->toArray();			
		//return $projectid;   
	} 
}
