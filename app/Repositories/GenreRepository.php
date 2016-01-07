<?php namespace App\Repositories;

use App\Models\Genre;

class GenreRepository extends BaseRepository{
  
	protected $genre;
 
	public function __construct( Genre $genre  )
	{ 
		$this->model = $genre; 
	}

 	public function getStatut()
	{
		return session('genre');
	}


	public function index($n, $genre_id = null, $orderby = 'id', $direction = 'desc')
	{  
		$query = $this->model
		->select('id', 'name', 'genre_slug', 'background_img', 'banner_img', 'icon_img', 'is_visible', 'is_hidden', 'parent_id', 'active', 'created_at', 'updated_at') 
		->orderBy($orderby, $direction); 
		return $query->paginate($n);
	} 

	public function getordersearch($n, $getSearch, $genre_id = null, $orderby = 'id', $direction = 'desc')
	{ 

		$query = $this->model
		->select('id', 'name', 'price', 'description', 'status', 'created_at') 
		->where('name', 'like', "%$getSearch%")
		->orderBy($orderby, $direction); 
		return $query->paginate($n);
	}

	
	public function getsearchdata($n, $statusSearch, $getSearch, $orderby = 'id', $direction = 'desc')
	{ 
		$query = $this->model
		->select('id', 'name', 'genre_slug', 'background_img', 'banner_img', 'icon_img', 'is_visible', 'is_hidden', 'parent_id', 'active', 'created_at', 'updated_at')
		->where('active', $statusSearch) 
		->where('name', 'like', "%$getSearch%")  
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}

	public function getstatsearchdata($n, $statusSearch, $getSearch, $orderby = 'id', $direction = 'desc')
	{ 
		$query = $this->model
		->select('id', 'name', 'genre_slug', 'background_img', 'banner_img', 'icon_img', 'is_visible', 'is_hidden', 'parent_id', 'active', 'created_at', 'updated_at')
		->where('name', 'like', "%$getSearch%")  
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}

	public function updateSeen($inputs, $id)
	{ 
		$genre = $this->getById($id); 
		$genre->status = $inputs['status'] == 'true';
		$genre->save();			
	}


	public function store($inputs)
	{
		$genre = new $this->model;	
		$genre = $this->saveGenre($genre, $inputs); 
	}


	private function saveGenre($genre, $inputs)
	{	 
		$genre->name 			= $inputs['name']; 
		$genre->genre_slug 		= $inputs['genre_slug'];  
		$genre->background_img  = $inputs['background_img']; 
		$genre->banner_img 		= $inputs['banner_img'];
		$genre->icon_img 		= $inputs['icon_img']; 
		$genre->is_hidden 		= $inputs['is_hidden'];  
		$genre->active 			= $inputs['active'];  
		$genre->created_at 		= date("Y-m-d h:i:s"); 
		$genre->updated_at 		= date("Y-m-d h:i:s"); 
		$genre->save(); 
		return $genre;
	}
 

	public function edit($id)
	{
		$genre = $this->model->findOrFail($id);
		return compact('genre');
	}

	
	public function update($inputs, $id)
	{
		$genre = $this->getById($id);
		$genre = $this->Updategenre($genre, $inputs); 
	}


  	private function Updategenre($genre, $inputs, $id = null)
	{	
		$genre->name = $inputs['name'];
		$genre->genre_slug = $inputs['category_slug']; 
		$genre->background_img = $inputs['background_img']; 
		$genre->banner_img = $inputs['banner_img'];
		$genre->icon_img = $inputs['icon_img'];
		$genre->active = $inputs['active'];
		$genre->is_hidden = $inputs['is_hidden']; 
		$genre->updated_at = date("Y-m-d h:i:s");
		if($id) $genre->id = $id; 
		$genre->save(); 
		return $genre;
	}



	public function inactiverec($id)
	{
		$genre = $this->getById($id); 
		$genre->active=0;
		$genre->save();	
	}

	public function activerec($id)
	{
		$genre = $this->getById($id); 
		$genre->active=1;
		$genre->save();	
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
		$query = $this->model->select('id', 'name', 'genre_slug', 'updated_at') 
							 ->whereIn('id', $finaldt );   
		return $query->get()->toArray();
	}

}