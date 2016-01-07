<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use Illuminate\Http\Response;
use Image;
use Illuminate\Contracts\Auth\Guard;
use Session; 
use Excel; 
use App\Http\Requests\BannerRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\BannerRepository;


  
class BannerController extends Controller {

	/**
	 * The BannerRepository instance.
	 *
	 * @var App\Repositories\BannerRepository
	 */
	protected $banner_gestion;

	/**
	 * The BannerRepository instance.
	 *
	 * @var App\Repositories\BannerRepository
	 */
	 

	/**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;

	/**
	 * Create a new BannerController instance.
	 *
	 * @param  App\Repositories\BannerRepository $banner_gestion
	 * @param  App\Repositories\BannerRepository $banner_gestion
	 * @return void
	*/

	public function __construct(BannerRepository $banner_gestion )
	{
  
		$this->banner_gestion = $banner_gestion;
		$this->nbrPages = 2;  
	
		/*$this->middleware('redac', ['except' => ['indexFront', 'show', 'tag', 'search']]); */  
		 
		$this->middleware('ajax', ['only' => ['indexOrder', 'updateSeen', 'updateActive']]); 
		 
	}	
 
	public function getIndex()
	{   
		 
		 
		$getSearch = Session::get('bannersearch'); 
		$statusSearch = Session::get('statussearchb');   
		$recordlist = Session::get('recordlistb');   
		$approveornot=Session::get('approveornotb');   


		$statut = $this->banner_gestion->getStatut();

		$orderbrBY="id";
		$orderDe="DESC"; 
 		 
 		if(!empty($approveornot))
		{   
			if(!empty($getSearch))
			{  
				$bannerlist = $this->banner_gestion->getsearchdata(4, $statusSearch, $getSearch, $orderbrBY, $orderDe );
			} 
			else
			{   
				$bannerlist = $this->banner_gestion->getsearchdata(4, $statusSearch, '', $orderbrBY, $orderDe );
			} 
			 
		} 
		else 
		{   
			if(!empty($getSearch))
			{  
				$bannerlist = $this->banner_gestion->getstatsearchdata(4, $getSearch, $orderbrBY, $orderDe );
			}  
			else
			{  
				$bannerlist = $this->banner_gestion->index(4);
			} 
		}   

		$links = str_replace('/?', '?', $bannerlist->render());  

		 
		$actctng=$this->banner_gestion->recordcounting(1);
		$deactctng=$this->banner_gestion->recordcounting(0); 
 
		return view('admin.banner.index', compact('bannerlist', 'links', 'getSearch', 'recordlist', 'actctng', 'deactctng' ));
	}


	public function getCreate()
	{ 

		$url = config('medias.url');  
		return view('admin.banner.create')->with(compact('url'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\BannerRequest $request
	 * @return Response
	 */


	public function postStore(BannerRequest $request)
	{   
		$getdata=$request->all(); 

		$userdet=array();
 		if($request->hasFile('banner_picture'))
 		{				
			$file = $request->file('banner_picture');
			$imageName = date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/homebanner/';
			$resizePath = base_path().'/public/uploaded/homebanner/thumb/' . $imageName; 
			$openMakePath = $realPath . $imageName; 
			$request->file('banner_picture')->move( $realPath, $imageName );
			Image::make($openMakePath)->resize(1400, 623)->save($resizePath); 
		}
		else
		{ 
			$imageName = '';
		}

		$userdet['_token']=$getdata['_token'];
		$userdet['banner_picture']=$imageName;
		$userdet['banner_title']=$getdata['banner_title'];
		$userdet['banner_desc']=$getdata['banner_desc'];
		$userdet['banner_link']=$getdata['banner_link'];
		$userdet['Submit']=$getdata['Submit'];  

		$this->banner_gestion->store($userdet); 
		$request->session()->flash('alert-success', 'Banner has been created successfully');
		return redirect('admin/banner');
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


	public function getEdit(BannerRepository $banner_gestion,  $id)
	{ 
		$url = config('medias.url');  
		return view('admin.banner.edit',  array_merge($this->banner_gestion->edit($id), compact('url')));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Http\Requests\PostUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */

	public function putUpdate(BannerRequest $request,$id)
	{ 
		$getdata=$request->all();  

		$userdet=array();
 		if($request->hasFile('banner_picture'))
 		{				
			$file = $request->file('banner_picture');
			$imageName = date("ymdHis").'.'.$file->getClientOriginalExtension();
			$realPath = base_path() . '/public/uploaded/homebanner/';
			$resizePath = base_path().'/public/uploaded/homebanner/thumb/' . $imageName; 
			$openMakePath = $realPath . $imageName; 
			$request->file('banner_picture')->move( $realPath, $imageName );
			Image::make($openMakePath)->resize(1400, 623)->save($resizePath); 
		}
		else
		{ 
			$imageName = $getdata['oldimage'];
		}

		$userdet['_token']=$getdata['_token'];
		$userdet['banner_picture']=$imageName;
		$userdet['banner_title']=$getdata['banner_title'];
		$userdet['banner_desc']=$getdata['banner_desc'];
		$userdet['banner_link']=$getdata['banner_link'];
		$userdet['weight']=$getdata['weight'];
		$userdet['id']=$id;
		 

		$this->banner_gestion->update($userdet, $id); 
		$request->session()->flash('alert-success', 'Banner has been updated successfully');
 
		return redirect('admin/banner');
		exit;
	}



	public function getDetails(BannerRepository $banner_gestion,  $id)
	{ 
		$url = config('medias.url'); 
		$data=$this->banner_gestion->edit($id);   
		echo view('admin.banner.details', compact('data', 'url'  ));
	}


	public function postSearchparameter(Request $request)
	{   
		$search = $request->input('search');
		Session::set('bannersearch', $search);
		return redirect('admin/banner');
		exit;		 
	}

	public function getApprovedrec(Request $request)
	{    
		$approved=1; 
		Session::set('statussearchb', $approved);
		Session::set('approveornotb', $approved);
		Session::set('recordlistb', "Approved");
		return redirect('admin/banner');
		exit;		 
	}

	public function getDisapprovedrec(Request $request)
	{   
		$approved=0; 
		Session::set('statussearchb', $approved);
		Session::set('approveornotb', 2);
		Session::set('recordlistb', "Disapproved");
		return redirect('admin/banner');
		exit;		 
	} 


	public function getUnsetsearchparameter()
	{   
		$bannersearch = ''; 
		$statussearch='';
		Session::set('statussearchb', $statussearch);
		Session::set('bannersearch', $bannersearch);
		Session::set('approveornotb', $statussearch);
		Session::set('recordlistb', "All");
		return redirect('admin/banner');
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
					$this->banner_gestion->destroy($id);  
				}			
				$request->session()->flash('alert-success', 'Records successfully updated.');  
			}
			
			if($actiontype == 'inactive') 
			{ 
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{ 
					$this->banner_gestion->inactiverec($id);  
				}				
				$request->session()->flash('alert-success', 'Records successfully updated.');  
			}

			if($actiontype == 'active') 
			{  
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{ 
					$this->banner_gestion->activerec($id);
				}				
				$request->session()->flash('alert-success', 'Records successfully updated.');  
				 
			}	 
			return response(['msg' => 'Action Updated', 'status' => 'success' ]);
		}
		
	}




	public function anyDestroy($id, Request $request)
	{ 
		$this->banner_gestion->destroy($id);  
		$request->session()->flash('alert-success', 'Banner has been deleted successfully');  
		return response(['status' => 'success' ]);
		exit;	
	}



	public function getExportselected($id, Request $request)
	{   
			Session::set('exportrec', $id);
			$excelnm="banner_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
		    $excel->sheet('banners', function ($sheet) { 
		        $sheet->mergeCells('A1:W1');
		        $sheet->row(1, function ($row) {
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(30);
		        }); 
		        $sheet->row(1, array('Banner Report'));  
		        $sheet->row(2, function ($row) { 
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(15);
		            $row->setFontWeight('bold');

		        }); 
		        $sheet->row(2, array('Banner Details')); 
		        /* getting data to display - in my case only one record */ 
		        $ids = Session::get('exportrec');   
		        $newdatas=explode(",",$ids);    
		        $gdatalist = $this->banner_gestion->getallrecords($newdatas);  
		        $dataArr=array();
				if(is_array($gdatalist) && count($gdatalist)>0) 
				{
					$counter=0;
					foreach($gdatalist as $kyy=>$dataval)
					{
						$dataArr[$counter]['Sl']=($counter+1);
						$dataArr[$counter]['Banner Title']=$dataval['banner_title'];
						$dataArr[$counter]['Banner Description']=$dataval['banner_desc'];
						$dataArr[$counter]['Banner link']=$dataval['banner_link'];
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
