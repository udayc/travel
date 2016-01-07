<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Emaillog extends Model  {

	use DatePresenter;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'emaillog'; 
	
	
	
	
	public static function usersById($user_id) 
	{ 
		if(!empty($user_id) && $user_id > 0 ) { 
		$query = \DB::table('profiles')->where('user_id', '=', $user_id)->first();	
		if($query) return $query ;  else return Null ; 
			
		} else { return Null ; } 
	} 	
	
 	 

}