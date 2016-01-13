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


class AgentController extends Controller {

	protected $project_repo;
	protected $show_per_page = 1;
	
	
	public function __construct(ProjectRepository $project_repo)
	{
		$this->project_repo = $project_repo;
		
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getList( $criteria = Null )
	{		
		//$user_list = User::where('type',2)->where('status',1)->orderBy('created_at','asc')->paginate(2)->get();
		$user_list = User::where('type',2)->where('status',1)->orderBy('created_at','asc')->paginate($this->show_per_page);
		//echo "<pre>";
	//	print_r($user_list->toArray());
		//exit;
		//echo "</pre>";
		return view('admin.agent.list',['user_list' => $user_list]);
	}
	public function getIndex( $criteria = Null )
	{ 
		Session::put('step', '1');
		Session::put('last_insert_id' , '');
		
		
		$searchKey =   ( \Input::get('srch-term') ) ? \Input::get('srch-term') : Null ; 
		 
		
		$projects = Project::whereIn('active' , [0, 1]);
		
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
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getProjectViews()
	{
		$project_views = \App\Models\ProjectShare::all();		
		return view('admin.activities.project-views' , [ 'project_views' => $project_views ]);
	}

	public function getProjectFollowers()
	{
		$project_views = \App\Models\ProjectFollowers::all();		
		return view('admin.activities.project-followers' , [ 'project_views' => $project_views ]);
	}

	public function getProjectFlags()
	{
		$project_flags = \App\Models\LogActivity::where('action' , 'project-flag')->get();		
		return view('admin.activities.project-flags' , [ 'project_flags' => $project_flags ]);
	}	

	public function getUserLogins()
	{
		$user_logins = \App\Models\LogActivity::where('action' , 'user-login')->orderBy('created_at')->get();		
		return view('admin.activities.user-logins' , [ 'user_logins' => $user_logins ]);
	}


	public function getSiteActivities()
	{
		$site_activities = \App\Models\LogActivity::all();		
		return view('admin.activities.site-activities' , [ 'site_activities' => $site_activities ]);
	}



	public function getProjectComments()
	{
		$project_comments = \App\Models\MessageHeader::orderBy('created_at')->get();	
		//dd($project_comments);
		return view('admin.activities.project-comments' , [ 'project_comments' => $project_comments ]);
	}



	
	

}
