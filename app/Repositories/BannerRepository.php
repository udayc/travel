<?php namespace App\Repositories;

use App\Models\Banner;

class BannerRepository extends BaseRepository{
  
	protected $banner;
 
	public function __construct( Banner $banner  )
	{ 
		$this->model = $banner; 
	}

 	public function getStatut()
	{
		return session('banner');
	}


	public function index($n, $banner_id = null, $orderby = 'weight', $direction = 'asc')
	{  
		$query = $this->model
		->select('id', 'banner_picture', 'banner_title', 'banner_desc', 'banner_link', 'active', 'weight', 'created_at', 'updated_at') 
		->orderBy($orderby, $direction); 
		return $query->paginate($n);
	} 

	public function getordersearch($n, $getSearch, $banner_id = null, $orderby = 'id', $direction = 'desc')
	{ 

		$query = $this->model
		->select('id', 'banner_picture', 'banner_title', 'banner_desc', 'banner_link', 'active', 'weight', 'created_at', 'updated_at') 
		->where('banner_title', 'like', "%$getSearch%")
		->orderBy($orderby, $direction); 
		return $query->paginate($n);
	}

	
	public function getsearchdata($n, $statusSearch, $getSearch, $orderby = 'weight', $direction = 'asc')
	{ 

		$query = $this->model
		->select('id', 'banner_picture', 'banner_title', 'banner_desc', 'banner_link', 'active', 'weight', 'created_at', 'updated_at') 
		->where('active', $statusSearch) 
		->where('banner_title', 'like', "%$getSearch%")
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}

	public function getstatsearchdata($n, $getSearch, $orderby = 'weight', $direction = 'asc')
	{ 
		
		$query = $this->model
		->select('id', 'banner_picture', 'banner_title', 'banner_desc', 'banner_link', 'active', 'weight', 'created_at', 'updated_at')  
		->where('banner_title', 'like', "%$getSearch%")
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}

	public function updateSeen($inputs, $id)
	{ 
		$banner = $this->getById($id); 
		$banner->status = $inputs['status'] == 'true';
		$banner->save();			
	}


	public function store($inputs)
	{
		$banner = new $this->model;	
		$banner = $this->saveBanner($banner, $inputs); 
	}


	private function saveBanner($banner, $inputs)
	{	 
		$pgetTotal=$this->allreccount();  
		$getTotal=($pgetTotal+1); 

		$banner->banner_picture =$inputs['banner_picture'];
		$banner->banner_title = $inputs['banner_title'];
		$banner->banner_desc = $inputs['banner_desc'];
		$banner->banner_link = $inputs['banner_link'];
		$banner->weight 	= $getTotal; 
		$banner->created_at = date("Y-m-d h:i:s"); 
		$banner->updated_at = date("Y-m-d h:i:s"); 
		$banner->save(); 
		return $banner;
	}
 

	public function edit($id)
	{
		$banner = $this->model->findOrFail($id);
		return compact('banner');
	}

	
	public function update($inputs, $id)
	{
		$banner = $this->getById($id);
		$banner = $this->Updatebanner($banner, $inputs); 
	}


  	private function Updatebanner($banner, $inputs, $id = null)
	{ 
		$banner->banner_picture =$inputs['banner_picture'];
		$banner->banner_title = $inputs['banner_title'];
		$banner->banner_desc = $inputs['banner_desc'];
		$banner->banner_link = $inputs['banner_link']; 
		$banner->weight 	 = $inputs['weight']; 
		$banner->updated_at = date("Y-m-d h:i:s");   
		$banner->save(); 
		return $banner;
	}



	public function inactiverec($id)
	{
		$banner = $this->getById($id); 
		$banner->active=0;
		$banner->save();	
	}

	public function activerec($id)
	{   
		$banner = $this->getById($id); 
		$banner->active=1; 
		$banner->save();	
	}


	public function indexFront()
	{
		$n=90;
		$query = $this->model->select('id', 'name', 'price', 'description', 'status', 'created_at'); 
		return $query->get();
	}


	public function recordcounting($cstat)
	{    
		$query = $this->model->where('active',$cstat)->count();	
		return $query;   
	} 
 
	public function allactivebanner()
	{    
		$cstat=1;
		$query = $this->model->where('active',$cstat)->count();	
		return $query; 
	} 


	public function getallrecords($finaldt)
	{     
		$query = $this->model->select('id', 'banner_title', 'banner_desc', 'banner_link', 'updated_at')
							 ->whereIn('id', $finaldt );   
		return $query->get()->toArray();
	}

	public function allreccount()
	{     
		$query = $this->model->count();	
		return $query; 
	}

}