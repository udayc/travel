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
Use App\Models\Destination;
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


class DestinationController extends Controller {

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
		//dd("A");
		$destinations = Destination::whereIn('status',[0,1])
					->orderBy('name','asc')
					->paginate($this->show_per_page);
		//echo "<pre>";
		//print_r($destinations->toArray());
		//echo "</pre>";
		//exit;
		//
		return view('admin.destination.list',['destinations' => $destinations]);
	}
	

}
