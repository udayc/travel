<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use Illuminate\Http\Response;
use App\Models\Genre;
use Image;
use Illuminate\Contracts\Auth\Guard;
use Session; 
use Excel; 
use App\Http\Requests\GenreRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\GenreRepository;


  
class GenreController extends Controller {

	/**
	 * The GenreRepository instance.
	 *
	 * @var App\Repositories\GenreRepository
	 */
	protected $genre_gestion;

	/**
	 * The GenreRepository instance.
	 *
	 * @var App\Repositories\GenreRepository
	 */
	 

	/**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;

	/**
	 * Create a new GenreController instance.
	 *
	 * @param  App\Repositories\GenreRepository $genre_gestion
	 * @param  App\Repositories\GenreRepository $genre_gestion
	 * @return void
	*/
	protected $paginationlimit	=	1000; 

	public function __construct(GenreRepository $genre_gestion )
	{
  
		$this->genre_gestion = $genre_gestion;
		$this->nbrPages = 2;  
	
		/*$this->middleware('redac', ['except' => ['indexFront', 'show', 'tag', 'search']]); */  
		 
		$this->middleware('ajax', ['only' => ['indexOrder', 'updateSeen', 'updateActive']]); 
		 
	}	
 
	public function getIndex()
	{   
		 
		$getSearch = Session::get('genresearchg'); 
		$statusSearch = Session::get('statussearchg');   
		$recordlist = Session::get('recordlistg');   
		$approveornot=Session::get('approveornotg');   


		$statut = $this->genre_gestion->getStatut();

		$orderbrBY="id";
		$orderDe="DESC"; 
		$paginationlimit	=	$this->paginationlimit; 
 		 
 		if(!empty($approveornot))
		{   
			if(!empty($getSearch)){  
				$genrelist = $this->genre_gestion->getsearchdata($paginationlimit, $statusSearch, $getSearch, $orderbrBY, $orderDe );
			} 	else {   
				$genrelist = $this->genre_gestion->getsearchdata($paginationlimit, $statusSearch, '', $orderbrBY, $orderDe );
			} 
			 
		} 
		else 
		{   
			if(!empty($getSearch)){ 
				$genrelist = $this->genre_gestion->getstatsearchdata($paginationlimit, '', $getSearch, $orderbrBY, $orderDe );
			}  else {  
				$genrelist = $this->genre_gestion->index($paginationlimit);
			} 
		}   

		$links = str_replace('/?', '?', $genrelist->render());  

		 
		$actctng=$this->genre_gestion->recordcounting(1);
		$deactctng=$this->genre_gestion->recordcounting(0); 
 
		return view('admin.genre.index', compact('genrelist', 'links', 'getSearch', 'recordlist', 'actctng', 'deactctng' ));
	}


	public function getCreate()
	{ 

		$url = config('medias.url');  
		return view('admin.genre.create')->with(compact('url'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\GenreRequest $request
	 * @return Response
	 */


	public function postStore(GenreRequest $request)
	{ 
		$getdata=$request->all();  
		$userdet=array();
 		if($request->hasFile('banner_img'))
 		{				
			$file = $request->file('banner_img');
			$bannerimgNm = "banner_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/genre/';
			$resizePath = base_path().'/public/uploaded/genre/thumb/' . $bannerimgNm; 
			$openMakePath = $realPath . $bannerimgNm; 
			$request->file('banner_img')->move( $realPath, $bannerimgNm );
			Image::make($openMakePath)->resize(400, 500)->save($resizePath); 
		}
		else
		{ 
			$bannerimgNm = '';
		}

 		if($request->hasFile('background_img'))
 		{				
			$file = $request->file('background_img');
			$bckgndimgNm = "backgnd_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/genre/';
			$resizePath = base_path().'/public/uploaded/genre/thumb/' . $bckgndimgNm; 
			$openMakePath = $realPath . $bckgndimgNm; 
			$request->file('background_img')->move( $realPath, $bckgndimgNm );
			Image::make($openMakePath)->resize(200, 300)->save($resizePath); 
		}
		else
		{ 
			$bckgndimgNm = '';
		}

 		if($request->hasFile('icon_img'))
 		{				
			$file = $request->file('icon_img');
			$iconimgNm = "icon_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/genre/';
			$resizePath = base_path().'/public/uploaded/genre/thumb/' . $iconimgNm; 
			$openMakePath = $realPath . $iconimgNm; 
			$request->file('icon_img')->move( $realPath, $iconimgNm );
			Image::make($openMakePath)->resize(50, 50)->save($resizePath); 
		}
		else
		{ 
			$iconimgNm = '';
		}

		$active = isset( $getdata['active'] ) ? $getdata['active'] : '0';
		$hidden  =  isset( $getdata['is_hidden'] ) ? $getdata['is_hidden'] : '0';

		$userdet['_token']=$getdata['_token'];
		$userdet['name']=$getdata['name'];
		$userdet['genre_slug']=$getdata['slug'];
		$userdet['background_img']=$bckgndimgNm;
		$userdet['banner_img']=$bannerimgNm; 
		$userdet['icon_img']=$iconimgNm;
		$userdet['active']=$active;
		$userdet['is_hidden']=$hidden; 
		$userdet['Submit']=$getdata['Submit'];  
		$this->genre_gestion->store($userdet); 

		$request->session()->flash('alert-success', 'Genre has been created successfully');
		return redirect('admin/genre');
	}


 
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */ 
 
	public function getShow( Guard $auth, $slug)
	{
		 		
	}


	public function getEdit(GenreRepository $genre_gestion,  $id)
	{ 
		$url = config('medias.url');  
		return view('admin.genre.edit',  array_merge($this->genre_gestion->edit($id), compact('url')));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Http\Requests\PostUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */

	public function putUpdate(GenreRequest $request,$id)
	{  
		$getdata=$request->all();  
		$userdet=array();
 		if($request->hasFile('banner_img'))
 		{				
			$file = $request->file('banner_img');
			$bannerimgNm = "banner_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/genre/';
			$resizePath = base_path().'/public/uploaded/genre/thumb/' . $bannerimgNm; 
			$openMakePath = $realPath . $bannerimgNm; 
			$request->file('banner_img')->move( $realPath, $bannerimgNm );
			Image::make($openMakePath)->resize(400, 500)->save($resizePath); 
		}
		else
		{ 
			$bannerimgNm = $getdata['oldbannerimage'];
		}

 		if($request->hasFile('background_img'))
 		{				
			$file = $request->file('background_img');
			$bckgndimgNm = "backgnd_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/genre/';
			$resizePath = base_path().'/public/uploaded/genre/thumb/' . $bckgndimgNm; 
			$openMakePath = $realPath . $bckgndimgNm; 
			$request->file('background_img')->move( $realPath, $bckgndimgNm );
			Image::make($openMakePath)->resize(200, 300)->save($resizePath); 
		}
		else
		{ 
			$bckgndimgNm = $getdata['oldbackgndimg'];
		}

 		if($request->hasFile('icon_img'))
 		{				
			$file = $request->file('icon_img');
			$iconimgNm = "icon_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/genre/';
			$resizePath = base_path().'/public/uploaded/genre/thumb/' . $iconimgNm; 
			$openMakePath = $realPath . $iconimgNm; 
			$request->file('icon_img')->move( $realPath, $iconimgNm );
			Image::make($openMakePath)->resize(50, 50)->save($resizePath); 
		}
		else
		{ 
			$iconimgNm = $getdata['oldiconimage'];
		}

		$active = isset( $getdata['active'] ) ? $getdata['active'] : '0';
		$hidden  =  isset( $getdata['is_hidden'] ) ? $getdata['is_hidden'] : '0';

		$userdet['_token']=$getdata['_token'];
		$userdet['name']=$getdata['name'];
		$userdet['category_slug']=$getdata['slug'];
		$userdet['background_img']=$bckgndimgNm;
		$userdet['banner_img']=$bannerimgNm; 
		$userdet['icon_img']=$iconimgNm;
		$userdet['active']=$active;
		$userdet['is_hidden']=$hidden;  

		$this->genre_gestion->update($userdet, $id); 

		/* $this->genre_gestion->update($request->all(), $id); */

		$request->session()->flash('alert-success', 'Genre has been updated successfully');
		return redirect('admin/genre');
		exit;
	}



	public function getDetails(GenreRepository $genre_gestion,  $id)
	{ 
		$url = config('medias.url'); 
		$data=$this->genre_gestion->edit($id);   
		return view('admin.genre.details', compact('data', 'url'  ));
	}


	public function postSearchparameter(Request $request)
	{   
		$search = $request->input('search');
		Session::set('genresearchg', $search);
		return redirect('admin/genre');
		exit;		 
	}

	public function getApprovedrec(Request $request)
	{   
		$approved=1; 
		Session::set('statussearchg', $approved);
		Session::set('approveornotg', $approved);
		Session::set('recordlistg', "Active");
		return redirect('admin/genre');
		exit;		 
	}

	public function getDisapprovedrec(Request $request)
	{   
		$approved=0; 
		Session::set('statussearchg', $approved);
		Session::set('approveornotg', 2);
		Session::set('recordlistg', "Inactive");
		return redirect('admin/genre');
		exit;		 
	} 


	public function getUnsetsearchparameter()
	{   
		$genresearch = ''; 
		$statussearch='';
		Session::set('statussearchg', $statussearch);
		Session::set('genresearchg', $genresearch);
		Session::set('approveornotg', $statussearch);
		Session::set('recordlistg', "All");
		return redirect('admin/genre');
		exit;		 
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
					$this->genre_gestion->destroy($id);  
				}			
		
			}
			
			if($actiontype == 'inactive') 
			{ 
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{ 
					$this->genre_gestion->inactiverec($id);  
				}				
				
			}

			if($actiontype == 'active') 
			{ 
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{ 
					$this->genre_gestion->activerec($id);
				}				
				
			}			
			$request->session()->flash('alert-success', 'Records successfully updated.');  
			return response(['msg' => 'Action Updated', 'status' => 'success' ]);
		}
		
	}

	public function anyDestroy($id, Request $request)
	{ 
		$this->genre_gestion->destroy($id);  
		$request->session()->flash('alert-success', 'Genre has been deleted successfully');  
		return response(['status' => 'success' ]);
		exit;	
	}


	public function getChangepresentstatus($projectid, $projectstatus)
	{    
		$category = Genre::find($projectid); 
		$category->active = $projectstatus;
		$category->save(); 
	}	


	public function getExportselected($id, Request $request)
	{   
			Session::set('exportrec', $id);
			$excelnm="genre_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
		    $excel->sheet('genre', function ($sheet) { 
		        $sheet->mergeCells('A1:W1');
		        $sheet->row(1, function ($row) {
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(30);
		        }); 
		        $sheet->row(1, array('Genre Report'));  
		        $sheet->row(2, function ($row) { 
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(15);
		            $row->setFontWeight('bold');

		        }); 
		        $sheet->row(2, array('Record Details')); 
		        /* getting data to display - in my case only one record */ 
		        $ids = Session::get('exportrec');   
		        $newdatas=explode(",",$ids);    
		        $gdatalist = $this->genre_gestion->getallrecords($newdatas);  
		        $dataArr=array();
				if(is_array($gdatalist) && count($gdatalist)>0) 
				{
					$counter=0;
					foreach($gdatalist as $kyy=>$dataval)
					{
						$dataArr[$counter]['Sl']=($counter+1);
						$dataArr[$counter]['Name']=$dataval['name'];
						$dataArr[$counter]['Slug']=$dataval['genre_slug'];
						$dataArr[$counter]['Date']=$dataval['updated_at'];
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



}
