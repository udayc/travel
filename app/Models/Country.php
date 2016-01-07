<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Country extends Model {

	
	protected $table = 'IM_countries';

	/* protected $fillable = ['f_name' , 'U_ID']; */
	 
	public function profile()
	{
		return $this->hasMany('App\Profile');
	}
	public function project()
	{
		return $this->hasMany('App\Models\Project');
	}	 
 
 
}
