<?php namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository{
  
	protected $category;
 
	public function __construct( Category $category  )
	{  
		$this->model = $category; 
	}

 	public function getStatut()
	{
		return session('category');
	}


	public function index($n, $orderby = 'id', $direction = 'desc')
	{    
		$query = $this->model
		->select('id', 'name', 'category_slug', 'background_img', 'banner_img', 'icon_img', 'is_visible', 'is_hidden', 'parent_id', 'active', 'created_at', 'updated_at' ) 
		->orderBy($orderby, $direction); 
		return $query->paginate($n); 
	} 

	public function getordersearch($n, $getSearch, $category_id = null, $orderby = 'id', $direction = 'desc')
	{ 

		$query = $this->model
		->select('id', 'name', 'category_slug', 'background_img', 'banner_img', 'icon_img', 'is_visible', 'is_hidden', 'parent_id', 'active', 'created_at', 'updated_at' )
		->where('name', 'like', "%$getSearch%")
		->orderBy($orderby, $direction); 
		return $query->paginate($n);
	}

	
	public function getsearchdata($n, $statusSearch, $getSearch, $orderby = 'id', $direction = 'desc')
	{ 
		$query = $this->model
		->select('id', 'name', 'category_slug', 'background_img', 'banner_img', 'icon_img', 'is_visible', 'is_hidden', 'parent_id', 'active', 'created_at', 'updated_at' )
		->where('active', $statusSearch) 
		->where('name', 'like', "%$getSearch%")  
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}

	public function getstatsearchdata($n, $statusSearch, $getSearch, $orderby = 'id', $direction = 'desc')
	{ 
		$query = $this->model
		->select('id', 'name', 'category_slug', 'background_img', 'banner_img', 'icon_img', 'is_visible', 'is_hidden', 'parent_id', 'active', 'created_at', 'updated_at' )
		->where('name', 'like', "%$getSearch%")  
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}

	public function updateSeen($inputs, $id)
	{ 
		$category = $this->getById($id); 
		$category->status = $inputs['status'] == 'true';
		$category->save();			
	}


	public function store($inputs)
	{
		$category = new $this->model;	
		$category = $this->saveCategory($category, $inputs); 
	}


	private function saveCategory($category, $inputs)
	{	 
		$category->name = $inputs['name']; 
		$category->category_slug = $inputs['category_slug'];  
		$category->background_img = $inputs['background_img']; 
		$category->banner_img = $inputs['banner_img'];
		$category->icon_img = $inputs['icon_img']; 
		$category->is_hidden = $inputs['is_hidden']; 
		$category->active = $inputs['active'];
		$category->created_at = date("Y-m-d h:i:s"); 
		$category->updated_at = date("Y-m-d h:i:s"); 
		$category->save(); 
		return $category;
	}
 

	public function edit($id)
	{
		$category = $this->model->findOrFail($id);
		return compact('category');
	}

	
	public function update($inputs, $id)
	{
		$category = $this->getById($id);
		$category = $this->Updatecategory($category, $inputs); 
	}


  	private function Updatecategory($category, $inputs, $id = null)
	{	 
		$category->name = $inputs['name']; 
		$category->category_slug = $inputs['category_slug'];  
		$category->background_img = $inputs['background_img']; 
		$category->banner_img = $inputs['banner_img'];
		$category->icon_img = $inputs['icon_img'];
		$category->active = $inputs['active'];
		$category->is_hidden = $inputs['is_hidden']; 
		$category->updated_at = date("Y-m-d h:i:s");  
		if($id) $category->id = $id; 
		$category->save(); 
		return $category;
	}



	public function inactiverec($id)
	{
		$category = $this->getById($id); 
		$category->active=0;
		$category->save();	
	}

	public function activerec($id)
	{
		$category = $this->getById($id); 
		$category->active=1;
		$category->save();	
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

	public function getallrecords($finaldt)
	{     
		$query = $this->model->select('id', 'name', 'category_slug', 'updated_at') 
							 ->whereIn('id', $finaldt );   
		return $query->get()->toArray();
	}

}