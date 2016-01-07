<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Category extends Model  {

	use DatePresenter;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_categories';

 	public function project()
	{
		return $this->hasMany('App\Models\Project');
	}

}