<?php namespace App\Http\Controllers;

use App\Models\Project;
Use App\Models\Category;
Use App\Models\Genre ;
Use App\Models\Reward;
Use App\Models\Menu ; 
Use App\Models\Banner ; 
Use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
Use Facebook;
Use View , DB;
Use Visitor ; 
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class WelcomeController extends Controller {

	protected $projectDetails = array();
	protected $project_repo;
	
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
	public function __construct( LaravelFacebookSdk $fb ,  ProjectRepository $project_repo  )
	{
		$this->login_url 		= 	$fb->getLoginUrl(['email']);		
		$this->project_repo 	= 	$project_repo;
		Visitor::log();
     
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{ 
		$menuItems				= Menu::where('active' , '1')->orderBy('weight' , 'asc')->get();
	
		return view('welcome' , [
		'_featuredProducts' => ( count($this->Projectlist(Null , 'popular')) > 0 ) ? (object) $this->Projectlist(Null , 'popular') :  $this->Projectlist(Null , 'popular'),  
		'_recently_added' =>  ( count($this->Projectlist(Null , 'latest')) > 0 ) ? (object) $this->Projectlist(Null , 'latest') :  $this->Projectlist(Null , 'latest'), 
		'_menus' 			=> $menuItems , 		
		'login_url' 		=> $this->login_url , 
		'_categoryLists' 	=> Category::where('active' , '1')->orderBy('id' , 'asc')->get(),
		'_genreLists' 		=> Genre::where('active' , '1')->orderBy('id' , 'asc')->get(),
		'_projectLists' 	=> ( count($this->Projectlist()) > 0 ) ? (object) $this->Projectlist() :  $this->Projectlist(),
		'_sliders' 			=> Banner::where('active' , '1')->orderBy('weight' , 'asc')->get(),
		]);
	}
	

	public function getBannerlist()
	{
		$sliderImgs	 = Banner::all();
		return $sliderImgs	;
	}
	
	
	# -------------------------------------------------
	# Get Project Lists By ID AND TYPE                |
	#-------------------------------------------------
	public function Projectlist($id = Null , $type = Null)
	{
		$projcon	=	array( "0", "3" );

		if($type == 'genres') {
			$staffPickRow = Project::where('active' , '1')->where('live' , '1')->where('project_genre_id' , $id )->where('featured' , '1' )->take(1)->get();
			if(count($staffPickRow) > 0 ) {
					$allLists = Project::where('active' , '1')->where('live' , '1')->where('project_genre_id' , $id )->where('featured' , '1' )->take(1)->get();
			} else { 
					$allLists = Project::where('active' , '1')->where('live' , '1')->where('project_genre_id' , $id )->orderBy('created_at', 'desc')->take(1)->get();
			}
		}	elseif($type == 'categories') { 
			$allLists = Project::where('active' , '1')->where('live' , '1')->where('P_CAT_ID' , $id )->whereIn('featured' , ['0' , '1'] )->take(1)->get();
			
		} elseif($type == 'popular') {
			$allLists = Project::where('active' , '1')->where('live' , '1')->orderBy('rank', 'DESC')->take(3)->get();		
		 } elseif($type == 'latest') {
			$allLists = Project::where('active' , '1')->where('live' , '1')->orderBy('created_at', 'desc')->take(3)->get();		
		} else { 
			$allLists = Project::where('active' , '1')->where('live' , '1')->get();
		}
		$result = $this->project_repo->prepareListObj($allLists);
		return $result;
	}	
	
	/*
	
	* Ajax Call By Category ID
	
	*/
	
	public function postListProjectByCat(Request $request)
	{
			if($request->ajax()) 
			{
				$catId 		= $request->get('id');
				$_listType 	= $request->get('_listType');
				
				if(isset($catId) && isset($_listType) )
				{
					$results = $this->Projectlist($catId , $_listType);
					if($results)
					{
						$html = View::make('partials.show-project-by-type',  ['_projectLists' => $results , '_listType' => $_listType] )->render();									
						return response(['msg' => 'success' , 'data' => $html  ]);
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

}
