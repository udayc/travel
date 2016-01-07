<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use Illuminate\Http\Response;

use Illuminate\Contracts\Auth\Guard;
use Session; 
use Excel; 
use App\Models\Menu;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\MenuRepository;


  
class MenuController extends Controller {

	/**
	 * The MenuRepository instance.
	 *
	 * @var App\Repositories\MenuRepository
	 */
	protected $menu_gestion;

	/**
	 * The MenuRepository instance.
	 *
	 * @var App\Repositories\MenuRepository
	 */
	 

	/**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;

	/**
	 * Create a new MenuController instance.
	 *
	 * @param  App\Repositories\MenuRepository $menu_gestion
	 * @param  App\Repositories\MenuRepository $menu_gestion
	 * @return void
	*/

	public function __construct(MenuRepository $menu_gestion )
	{
  
		$this->menu_gestion = $menu_gestion;
		$this->nbrPages = 2;  	
		/*$this->middleware('redac', ['except' => ['indexFront', 'show', 'tag', 'search']]); */
		 
		$this->middleware('ajax', ['only' => ['indexOrder', 'updateSeen', 'updateActive']]); 
		 
	}	
 
	public function getIndex()
	{   
		 
		$getSearch = Session::get('menusearch'); 
		$statusSearch = Session::get('statussearchm');   
		$recordlist = Session::get('recordlistm');   
		$approveornot=Session::get('approveornotm');   


		$statut = $this->menu_gestion->getStatut();

		$orderbrBY="weight";
		$orderDe="ASC"; 
 		 
 		if(!empty($approveornot))
		{   
			if(!empty($getSearch))
			{  
				$menulist = $this->menu_gestion->getsearchdata(4, $statusSearch, $getSearch, $orderbrBY, $orderDe );
			} 
			else
			{   
				$menulist = $this->menu_gestion->getsearchdata(4, $statusSearch, '', $orderbrBY, $orderDe );
			} 
			 
		} 
		else 
		{   
			if(!empty($getSearch))
			{ 
				$menulist = $this->menu_gestion->getstatsearchdata(4, '', $getSearch, $orderbrBY, $orderDe );
			}  
			else
			{  
				$menulist = $this->menu_gestion->index(4);
			} 
		}   

		$links = str_replace('/?', '?', $menulist->render());  

		 
		$actctng=$this->menu_gestion->recordcounting(1);
		$deactctng=$this->menu_gestion->recordcounting(0); 
 
		return view('admin.menu.index', compact('menulist', 'links', 'getSearch', 'recordlist', 'actctng', 'deactctng' ));
	}


	public function getCreate()
	{ 

		$url = config('medias.url'); 	
		$menus = \DB::table('menus')->orderBy('name')->lists('name', 'id');
		$pages = \DB::table('pages')->orderBy('title')->lists('title', 'id');
		return view('admin.menu.create')->with(compact('url' , 'menus' , 'pages'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\MenuRequest $request
	 * @return Response
	 */


	public function postStore(MenuRequest $request)
	{     

		$this->menu_gestion->store($request->all());  
		$request->session()->flash('alert-success', 'Menu has been created successfully');
		return redirect('admin/menu');
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


	public function getEdit(MenuRepository $menu_gestion,  $id)
	{    
		$url = config('medias.url'); 
		$menus = \DB::table('menus')->orderBy('name')->lists('name', 'id');
		$pages = \DB::table('pages')->orderBy('title')->lists('title', 'id');
		
		return view('admin.menu.edit',  array_merge($this->menu_gestion->edit($id), compact('url' , 'menus' , 'pages' )));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Http\Requests\PostUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */



	public function putUpdate(MenuRequest $request,$id)
	{   
		
		$this->menu_gestion->update($request->all(), $id); 
		$request->session()->flash('alert-success', 'Menu has been updated successfully');
		return redirect('admin/menu');
		exit;
	}



	public function getDetails(MenuRepository $menu_gestion,  $id)
	{ 
		$url = config('medias.url'); 
		$data=$this->menu_gestion->edit($id);   
		return view('admin.menu.details', compact('data', 'url'  ));
	}


	public function postSearchparameter(Request $request)
	{   
		$search = $request->input('search');
		Session::set('menusearch', $search);
		return redirect('admin/menu');
		exit;		 
	}

	public function getApprovedrec(Request $request)
	{    
		$approved=1; 
		Session::set('statussearchm', $approved);
		Session::set('approveornotm', $approved);
		Session::set('recordlistm', "Approved");
		return redirect('admin/menu');
		exit;		 
	}

	public function getDisapprovedrec(Request $request)
	{   
		$approved=0; 
		Session::set('statussearchm', $approved);
		Session::set('approveornotm', 2);
		Session::set('recordlistm', "Disapproved");
		return redirect('admin/menu');
		exit;		 
	} 


	public function getUnsetsearchparameter()
	{   
		$menusearch = ''; 
		$statussearch='';
		Session::set('statussearchm', $statussearch);
		Session::set('menusearch', $menusearch);
		Session::set('approveornotm', $statussearch);
		Session::set('recordlistm', "All");
		return redirect('admin/menu');
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
					$this->menu_gestion->destroy($id);  
				}			
				$request->session()->flash('alert-success', 'Records successfully updated.');  
			}
			
			if($actiontype == 'inactive') 
			{ 
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{ 
					$this->menu_gestion->inactiverec($id);  
				}				
				$request->session()->flash('alert-success', 'Records successfully updated.');  
			}

			if($actiontype == 'active') 
			{ 

				$countallActivemenu=$this->menu_gestion->allactivemenu(); 
				if($countallActivemenu==3)
				{
					$request->session()->flash('alert-danger', 'Sorry! Maximum 3 records you can approve.');  
				}
				else
				{
					$ids = $request->input('_checkboxes');
					foreach($ids as $id)
					{ 
						$this->menu_gestion->activerec($id);
					}				
					$request->session()->flash('alert-success', 'Records successfully updated.');  
				}
			} 

			return response(['msg' => 'Action Updated', 'status' => 'success' ]);
		}
		
	}

	public function anyDestroy($id, Request $request)
	{ 
		$this->menu_gestion->destroy($id);  
		$request->session()->flash('alert-success', 'Menu has been deleted successfully');  
		return response(['status' => 'success' ]);
		exit;	
	}


	public function getExportselected($id, Request $request)
	{   
			Session::set('exportrec', $id);
			$excelnm="menu_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
		    $excel->sheet('menus', function ($sheet) { 
		        $sheet->mergeCells('A1:W1');
		        $sheet->row(1, function ($row) {
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(30);
		        }); 
		        $sheet->row(1, array('Menu Report'));  
		        $sheet->row(2, function ($row) { 
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(15);
		            $row->setFontWeight('bold');

		        }); 
		        $sheet->row(2, array('Record Details')); 
		        /* getting data to display - in my case only one record */ 
		        $ids = Session::get('exportrec');   
		        $newdatas=explode(",",$ids);    
		        $gdatalist = $this->menu_gestion->getallrecords($newdatas);  
		        $dataArr=array();
				if(is_array($gdatalist) && count($gdatalist)>0) 
				{
					$counter=0;
					foreach($gdatalist as $kyy=>$dataval)
					{
						$dataArr[$counter]['Sl']=($counter+1);
						$dataArr[$counter]['Name']=$dataval['name'];
						$dataArr[$counter]['Slug']=$dataval['menu_slug'];
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
