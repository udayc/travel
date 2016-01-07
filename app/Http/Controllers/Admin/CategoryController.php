<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\MessageHeader;
use Image;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Excel; 
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\CategoryRepository;


  
class CategoryController extends Controller {

	/**
	 * The CategoryRepository instance.
	 *
	 * @var App\Repositories\CategoryRepository
	 */
	protected $category_gestion;

	/**
	 * The CategoryRepository instance.
	 *
	 * @var App\Repositories\CategoryRepository
	 */
	 

	/**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;
	protected $paginationlimit	=	1000; 

	/**
	 * Create a new CategoryController instance.
	 *
	 * @param  App\Repositories\CategoryRepository $category_gestion
	 * @param  App\Repositories\CategoryRepository $category_gestion
	 * @return void
	*/

	public function __construct(CategoryRepository $category_gestion )
	{  
		$this->category_gestion = $category_gestion;
		$this->nbrPages = 2; 
	}	
 
	public function getIndex()
	{   		 
		$getSearch 			= 	Session::get('catgorysearch'); 
		$statusSearch 		= 	Session::get('statussearchc');   
		$recordlist 		= 	Session::get('recordlistc');   
		$approveornot		=	Session::get('approveornotc');   


		$statut 			= 	$this->category_gestion->getStatut();
		$orderbrBY			=	"id";
		$orderDe			=	"DESC"; 
 		
		$orderbrBY	= Session::get('catorderby')?Session::get('catorderby'):'id';
		$orderDe	= Session::get('catorderde')?Session::get('catorderde'):'DESC';



 		if(!empty($approveornot))
		{   
			if(!empty($getSearch))
			{  
				$categorylist = $this->category_gestion->getsearchdata($this->paginationlimit, $statusSearch, $getSearch, $orderbrBY, $orderDe );
			} 
			else
			{   
				$categorylist = $this->category_gestion->getsearchdata($this->paginationlimit, $statusSearch, '', $orderbrBY, $orderDe );
			} 
			 
		} 
		else 
		{   
			if(!empty($getSearch))
			{  
				$categorylist = $this->category_gestion->getstatsearchdata($this->paginationlimit, '', $getSearch, $orderbrBY, $orderDe );
			}  
			else
			{   
				$categorylist = $this->category_gestion->index($this->paginationlimit, $orderbrBY, $orderDe );
			} 
		}   

		$links = str_replace('/?', '?', $categorylist->render());  

		 
		$actctng=$this->category_gestion->recordcounting(1);
		$deactctng=$this->category_gestion->recordcounting(0); 

		if($orderbrBY=="name"){ $o_name="sort-".$orderDe; $o_slug="unsorted"; $o_date="unsorted";  } 
		elseif($orderbrBY=="category_slug") { $o_name="unsorted"; $o_slug="sort-".$orderDe; $o_date="unsorted";  }
		elseif($orderbrBY=="updated_at") {  $o_name="unsorted"; $o_slug="unsorted"; $o_date="sort-".$orderDe;  }
		else{ $o_name="unsorted"; $o_slug="unsorted"; $o_date="unsorted";  }
 
		return view('admin.category.index', compact('categorylist', 'links', 'getSearch', 'recordlist', 'actctng', 
					'deactctng','o_name','o_slug','o_date'));
	}



	public function getOrder(Request $request)
	{   
		 
 		$getSearch 			= 	Session::get('catgorysearch'); 
		$statusSearch 		= 	Session::get('statussearchc');   
		$approveornot		=	Session::get('approveornotc');   

		$orderbrBY	=	$request->input('name');
		$orderDe	=	$request->input('sens'); 

		Session::set('catorderby', $orderbrBY);
		Session::set('catorderde', $orderDe);
 		 
 		if(!empty($approveornot))
		{   
			if(!empty($getSearch))
			{  
				$categorylist = $this->category_gestion->getsearchdata(5, $statusSearch, $getSearch, $orderbrBY, $orderDe );
			} 
			else
			{   
				$categorylist = $this->category_gestion->getsearchdata(5, $statusSearch, '', $orderbrBY, $orderDe );
			} 
			 
		} 
		else 
		{   
			if(!empty($getSearch))
			{ 
				$categorylist = $this->category_gestion->getstatsearchdata(5, '', $getSearch, $orderbrBY, $orderDe );
			}  
			else
			{  
				$categorylist = $this->category_gestion->index(5, $orderbrBY, $orderDe );
			} 
		}

		$links = str_replace('/order/', '', $categorylist->render());

		return response()->json([
			'view' => view('admin.category.table', compact('categorylist'))->render(), 
			'links' => $links
		]);		
	}




	public function getCreate()
	{ 

		$url = config('medias.url');  
		return view('admin.category.create')->with(compact('url'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\CategoryRequest $request
	 * @return Response
	 */


	public function postStore(CategoryRequest $request)
	{     
		$getdata=$request->all();  
		$userdet=array();
 		if($request->hasFile('banner_img'))
 		{				
			$file = $request->file('banner_img');
			$bannerimgNm = "banner_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/category/';
			$resizePath = base_path().'/public/uploaded/category/thumb/' . $bannerimgNm; 
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
			$realPath = base_path() . '/public/uploaded/category/';
			$resizePath = base_path().'/public/uploaded/category/thumb/' . $bckgndimgNm; 
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
			$realPath = base_path() . '/public/uploaded/category/';
			$resizePath = base_path().'/public/uploaded/category/thumb/' . $iconimgNm; 
			$openMakePath = $realPath . $iconimgNm; 
			$request->file('icon_img')->move( $realPath, $iconimgNm );
			Image::make($openMakePath)->resize(50, 50)->save($resizePath); 
		}
		else
		{ 
			$iconimgNm = '';
		}

		$is_hidden = isset( $getdata['is_hidden'] ) ? $getdata['is_hidden'] : '0';
		$active  =  isset( $getdata['active'] ) ? $getdata['active'] : '0';

		$userdet['_token']=$getdata['_token'];
		$userdet['name']=$getdata['name'];
		$userdet['category_slug']=$getdata['slug'];
		$userdet['background_img']=$bckgndimgNm;
		$userdet['banner_img']=$bannerimgNm; 
		$userdet['icon_img']=$iconimgNm;
		$userdet['is_hidden']=$is_hidden;
		$userdet['active']=$active; 
		$userdet['Submit']=$getdata['Submit'];   
  
		$this->category_gestion->store($userdet); 

		$request->session()->flash('alert-success', 'Category has been created successfully');
		return redirect('admin/category');  
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


	public function getEdit(CategoryRepository $category_gestion,  $id)
	{ 
		$url = config('medias.url');  
		return view('admin.category.edit',  array_merge($this->category_gestion->edit($id), compact('url')));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Http\Requests\PostUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */

	public function putUpdate(CategoryRequest $request,$id)
	{  

		$getdata=$request->all();  
		$userdet=array();
 		if($request->hasFile('banner_img'))
 		{				
			$file = $request->file('banner_img');
			$bannerimgNm = "banner_".date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/category/';
			$resizePath = base_path().'/public/uploaded/category/thumb/' . $bannerimgNm; 
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
			$realPath = base_path() . '/public/uploaded/category/';
			$resizePath = base_path().'/public/uploaded/category/thumb/' . $bckgndimgNm; 
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
			$realPath = base_path() . '/public/uploaded/category/';
			$resizePath = base_path().'/public/uploaded/category/thumb/' . $iconimgNm; 
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

		$this->category_gestion->update($userdet, $id); 
		$request->session()->flash('alert-success', 'Category has been updated successfully');
		return redirect('admin/category');
		exit;
	}



	public function getDetails(CategoryRepository $category_gestion,  $id)
	{ 
		$url = config('medias.url'); 
		$data=$this->category_gestion->edit($id);   
		return view('admin.category.details', compact('data', 'url'  ));
	}


	public function postSearchparameter(Request $request)
	{   
		$search = $request->input('search');
		Session::set('catgorysearch', $search);
		return redirect('admin/category');
		exit;		 
	}

	public function getApprovedrec(Request $request)
	{   
		$approved=1; 
		Session::set('statussearchc', $approved);
		Session::set('approveornotc', $approved);
		Session::set('recordlistc', "Active");
		return redirect('admin/category');
		exit;		 
	}

	public function getDisapprovedrec(Request $request)
	{   
		$approved=0; 
		Session::set('statussearchc', $approved);
		Session::set('approveornotc', 2);
		Session::set('recordlistc', "Inactive");
		return redirect('admin/category');
		exit;		 
	} 


	public function getUnsetsearchparameter()
	{   
		$catgorysearch = ''; 
		$statussearch='';
		Session::set('statussearchc', $statussearch);
		Session::set('catgorysearch', $catgorysearch);
		Session::set('approveornotc', $statussearch); 
		Session::set('catorderde', $statussearch);
		Session::set('catorderby', $statussearch); 
		Session::set('recordlistc', "All");
		return redirect('admin/category');
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
					MessageHeader::where('id', '=', $id)->delete();					
				}			
		
			}
			//exit;
			if($actiontype == 'inactive') 
			{ 
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{ 
					$this->category_gestion->inactiverec($id);  
				}				
				
			}

			if($actiontype == 'active') 
			{ 
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{ 
					$this->category_gestion->activerec($id);
				}				
				
			}			
			$request->session()->flash('alert-success', 'Records successfully updated.');  
			return response(['msg' => 'Action Updated', 'status' => 'success' ]);
		}
		
	}

	public function anyDestroy($id, Request $request)
	{ 
		$this->category_gestion->destroy($id);  
		$request->session()->flash('alert-success', 'Category has been deleted successfully');  
		return response(['status' => 'success' ]);
		exit;	
	}

	public function getChangeactstat($projectid, $projectstatus)
	{    
		$category = Category::find($projectid); 
		$category->active = $projectstatus;
		$category->save(); 
	}

	public function getExportselected($id, Request $request)
	{   
			Session::set('exportrec', $id);
			$excelnm="category_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
		    $excel->sheet('Category', function ($sheet) { 
		        $sheet->mergeCells('A1:W1');
		        $sheet->row(1, function ($row) {
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(30);
		        }); 
		        $sheet->row(1, array('Category Report'));  
		        $sheet->row(2, function ($row) { 
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(15);
		            $row->setFontWeight('bold');

		        }); 
		        $sheet->row(2, array('Category Details')); 
		        /* getting data to display - in my case only one record */ 
		        $ids = Session::get('exportrec');   
		        $newdatas=explode(",",$ids);    
		        $gdatalist = $this->category_gestion->getallrecords($newdatas);  
		        $dataArr=array();
				if(is_array($gdatalist) && count($gdatalist)>0) 
				{
					$counter=0;
					foreach($gdatalist as $kyy=>$dataval)
					{
						$dataArr[$counter]['Sl']=($counter+1);
						$dataArr[$counter]['Category']=$dataval['name'];
						$dataArr[$counter]['Slug']=$dataval['category_slug'];
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
