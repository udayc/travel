<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Genre extends Model  {

	use DatePresenter;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_genre';


	
 	public function project()
	{
		return $this->hasMany('App\Models\Project');
	}	
	

}