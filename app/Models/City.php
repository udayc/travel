<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class City extends Model { 
	
	protected $table = 'IM_cities'; 
 
 	public function profile()
	{
		return $this->hasMany('App\Profile' , 'city');
	}
 
 	public function project()
	{
		return $this->hasMany('App\Models\Project');
	}	
 
}
