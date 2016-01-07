<?php namespace App\Repositories;

use DateTime;

class DashboardRepository extends Repository{

	protected $model_name = 'App\Models\Project'  ; 

	public function __construct(  )
	{ 
		$this->model_name 		= $this->model();
	}	
	
	public function model()
	{
		return 'App\Models\Project';
	}	

	/*
		* List all Data By Type
	*/
	public function all($type = Null , $criteria = Null)
	{
		switch($type)
		{
			case "project":					
					if($criteria != Null){
						$lists = \App\Models\Project :: where('status' , $criteria)->count();
					} else {
						$lists = \App\Models\Project :: all()->count();
					}
					break;
			case "user" :
					$lists = \App\User :: all()->count();
					break;
			case "category" :
					$lists = \App\Models\Category :: all()->count();
					break;
			case "genre" :
					$lists = \App\Models\Genre :: all()->count();
					break;					
					
			default :
					$lists = 0;
		}
		
		return $lists;
	}
	

}
