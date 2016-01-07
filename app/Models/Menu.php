<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Menu extends Model  {

	use DatePresenter;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menus';

	
	public function parentName()
	{
		return $this->belongsTo('App\Models\Menu', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('App\Models\Menu', 'parent_id');
	}	
	

 	public function page()
	{
		return $this->hasOne('App\Models\Page' ,  'menu_id');
	}
	
	public static function menuNameById($id = Null)
	{
		$row =  \App\Models\Menu::findOrFail($id);
		return $row;
	}
	
}