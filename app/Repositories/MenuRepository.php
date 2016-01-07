<?php namespace App\Repositories;

use App\Models\Menu;


class MenuRepository extends BaseRepository{
  
	protected $menu;
 
	public function __construct( Menu $menu  )
	{ 
		$this->model = $menu; 
	}

 	public function getStatut()
	{
		return session('menu');
	}


	public function index($n, $menu_id = null, $orderby = 'weight', $direction = 'ASC')
	{  
		$query = $this->model
		->select('id', 'name', 'menu_slug', 'parent_id', 'weight', 'active', 'add_to_header_menu', 'add_to_footer_menu' , 'created_at', 'updated_at') 
		->orderBy($orderby, $direction); 
		return $query->paginate($n);
	} 

	public function getordersearch($n, $getSearch, $menu_id = null, $orderby = 'id', $direction = 'desc')
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
		->select('id', 'name', 'menu_slug', 'parent_id', 'weight', 'active', 'add_to_header_menu', 'add_to_footer_menu' , 'created_at', 'updated_at') 
		->where('active', $statusSearch) 
		->where('name', 'like', "%$getSearch%")  
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}


	public function getstatsearchdata($n, $statusSearch, $getSearch, $orderby = 'id', $direction = 'desc')
	{ 
		$query = $this->model
		->select('id', 'name', 'menu_slug', 'parent_id', 'weight', 'active', 'add_to_header_menu', 'add_to_footer_menu' , 'created_at', 'updated_at') 
		->where('name', 'like', "%$getSearch%")  
		->orderBy($orderby, $direction);  
		return $query->paginate($n);
	}



	public function updateSeen($inputs, $id)
	{ 
		$menu = $this->getById($id); 
		$menu->status = $inputs['status'] == 'true';
		$menu->save();			
	}


	public function store($inputs)
	{
		$menu = new $this->model;	
		$menu = $this->saveMenu($menu, $inputs); 
	}


	private function saveMenu($menu, $inputs)
	{	 
		$pgetTotal=$this->allreccount();  
		$getTotal=($pgetTotal+1); 
		$menu->name 			= $inputs['name']; 
		$menu->menu_slug 		= $inputs['slug']; 
		$menu->weight 			= $getTotal; 		
		$menu->parent_id 			= $inputs['parent_id']; 
		$menu->add_to_header_menu 	= $inputs['add_to_header_menu']; 
		$menu->add_to_footer_menu 	= $inputs['add_to_footer_menu'];  
		$menu->page_id 				= $inputs['page_id'];  
		
		$menu->created_at = date("Y-m-d h:i:s"); 
		$menu->updated_at = date("Y-m-d h:i:s"); 
		$menu->save(); 
		return $menu;
	}
 

	public function edit($id)
	{ 
		$menu = $this->model->findOrFail($id);
		return compact('menu');
	}

	
	public function update($inputs, $id)
	{
		$menu = $this->getById($id);
		$menu = $this->Updatemenu($menu, $inputs); 
	}


  	private function Updatemenu($menu, $inputs, $id = null)
	{	 
		$menu->name 				= $inputs['name']; 
		$menu->menu_slug 			= $inputs['slug']; 
		$menu->weight 				= $inputs['weight']; 
		$menu->parent_id 			= $inputs['parent_id']; 
		$menu->add_to_header_menu 	= $inputs['add_to_header_menu']; 
		$menu->add_to_footer_menu 	= $inputs['add_to_footer_menu'];  
		$menu->page_id 				= $inputs['page_id'];  		
		
		
		
		
		$menu->updated_at = date("Y-m-d h:i:s"); 
		if($id) $menu->id = $id; 
		$menu->save(); 
		return $menu;
	}



	public function inactiverec($id)
	{
		$menu = $this->getById($id); 
		$menu->active=0;
		$menu->save();	
	}

	public function activerec($id)
	{   
		$menu = $this->getById($id); 
		$menu->active=1; 
		$menu->save();	
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
 
	public function allactivemenu()
	{    
		$cstat=1;
		$query = $this->model->where('active',$cstat)->count();	
		return $query; 
	} 

	public function allreccount()
	{     
		$query = $this->model->count();	
		return $query; 
	}

	public function getallrecords($finaldt)
	{     
		$query = $this->model->select('id',   'name', 'menu_slug','updated_at') 
							 ->whereIn('id', $finaldt );   
		return $query->get()->toArray();
	}




}