<?php namespace App\Repositories;


use App\User;
use App\Models\City;
 

class UserRepository extends Repository{
  
	protected $user;
	protected $city;
	protected $filterBySocialNet = array('facebook' , 'twitter' , 'gplus');
	protected $sadmin	=	"admin";
 
	public function __construct( User $user, City $city  )
	{ 
		$this->model = $user; 
		$this->citymodel  = $city;
	}
	
	public function model()
	{
		return 'App\User';
	}	

	public function index($n, $user_id = null, $orderby = 'id', $direction = 'desc')
	{   
		
		$query = $this->model
		->select('id', 'name', 'type', 'username', 'remote_addr', 'register_type', 'login_from_ip' , 'login_count' , 'last_login','status', 'email', 'password', 'remember_token', 'created_at', 'updated_at' ) 
		->where('type', '!=', $this->sadmin)
		->orderBy($orderby, $direction); 
		return $query->paginate($n);
	} 



	public function getsearchdata($n, $statusSearch, $getSearch, $orderby = 'id', $direction = 'desc')
	{  
		$query = $this->model
		->select('id', 'name', 'type', 'username', 'remote_addr', 'register_type', 'login_from_ip' , 'login_count' , 'last_login', 'status', 'email', 'password', 'remember_token', 'created_at', 'updated_at' )
		->where('type', '!=', $this->sadmin); 

		if(in_array($statusSearch , $this->filterBySocialNet))
		{  
			$query->where('register_type', $statusSearch) ;
		}
		else
		{
			if($statusSearch==1) { $finalstat=1; } else { $finalstat=0; }  		
			 $query->where('status', $finalstat) ;
		}	 

		$query->where('name', 'like', "%$getSearch%")->orderBy($orderby, $direction);
		
		return $query->paginate($n);
	}

	public function getstatsearchdata($n, $getSearch, $orderby = 'id', $direction = 'desc')
	{ 
	
		$query = $this->model
		->select('id', 'name', 'type', 'username', 'remote_addr', 'register_type', 'login_from_ip' , 'login_count' , 'last_login', 'status', 'email', 'password', 'remember_token', 'created_at', 'updated_at' ) 
		->where('type', '!=', $this->sadmin)
		->where('name', 'like', "%$getSearch%")
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}	

	public  function sortByCriteria( $criteria = null , $authId = Null)
	{
		switch($criteria)
		{
			case 'active' :
					$users = $this->model->where('type','general')->where('status' , '1')->count();	
					return $users;
			break;
			
			case 'inactive' :
					$users = $this->model->where('type','general')->where('status' , '0')->count();	
					return $users;
			break;	

			case 'facebook' :
					$users = $this->model->where('type','general')->where('register_type' , 'facebook')->count();	
					return $users;
			break;	
			case 'googleplus' :
					$users = $this->model->where('type','general')->where('register_type' , 'googleplus')->count();	
					return $users;
			break;	

			case 'twitter' :
					$users = $this->model->where('type','general')->where('register_type' , 'twitter')->count();	
					return $users;
			break;

			case 'all' :
					$users = $this->model->where('type','general')->count();	
					return $users;
				
			break;
			
			case 'my_posted_projects':
				$myPostedProjectLists 	= \App\Models\Project::where('active' , '1')->where('user_id' , $authId )->count();
				return $myPostedProjectLists;
			break;
			
			case 'my_posted_projects':
				$myPostedProjectLists 	= \App\Models\ProjectUpdates::where('active' , '1')->where('user_id' , $authId )->count();
				return $myPostedProjectLists;
			break;
			
			case 'my_backed_projects':
					$MyFundedProjectLists = array();
					$lists 	= \App\Models\ProjectFund::where('U_ID' , $authId )->whereIn('status' , ['Pledged','Funded'])->orderBy('created_at', 'desc')->get();
					if(count($lists) > 0 ) {
						foreach($lists as $val ){
							$MyFundedProjectLists[] = $val->P_ID ; 
						}
					}	

					$result = array_unique($MyFundedProjectLists );			
			
			return count($result);
			
			
			break;
			
			case 'my_likes_projects':
				$myLikeProjects 	= \App\Models\ProjectFollowers::where('user_id' , $authId )->count();
				return $myLikeProjects;				
			
			
			
			break;
			
			case 'my_following_projects':
				$myFllowingProjects 	= \App\Models\ProjectFollowers::where('user_id' , $authId )->count();
				return $myFllowingProjects;			
			break;			
			
			
			
			
		}
	}


	/* Get User Count By Their Criteria */
	public function userDataStat()
	{
		return array( 
					'active' 		=> $this->sortByCriteria('active'),
					'inactive' 		=> $this->sortByCriteria('inactive'), 
					'facebook' 		=> $this->sortByCriteria('facebook'), 
					'twitter' 		=> $this->sortByCriteria('twitter'), 		
					'googleplus' 	=> $this->sortByCriteria('googleplus'), 
					'all' 			=> $this->sortByCriteria('all')				
		
					);
	}	

 

	public function getallrecords()
	{ 
		
		$orderby="name";
		$direction="ASC";
		$query = $this->model->select('id', 'name', 'status', 'email') 
							 ->where('type', '!=', $this->sadmin)
							 ->orderBy($orderby, $direction);  
		return $query->get()->toArray();		
	}

	public function getexportrecords()
	{   
		
		$orderby="users.id";
		$direction="ASC";
		$query = $this->model->join('profiles', 'users.id', '=', 'profiles.user_id')
							 ->select()
							 ->where('type', '!=', $this->sadmin)  
							 ->orderBy($orderby, $direction);  
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

	
	
	
	/* General Statistics Of a Auth User */
	public function generalOverViewByAuthUser( $userId = Null )
	{
		return array( 
					'my_posted_projects' 		=> $this->sortByCriteria('my_posted_projects' , $userId),
					'my_backed_projects' 		=> $this->sortByCriteria('my_backed_projects' ,$userId), 
					'my_likes_projects' 		=> $this->sortByCriteria('my_likes_projects' , $userId), 
					'my_following_projects' 	=> $this->sortByCriteria('my_following_projects' , $userId)			
					);
	}	
		
	
	
	
	
	
	

}
