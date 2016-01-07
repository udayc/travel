<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class MessageHeader extends Model  {

	use DatePresenter;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'message_headers'; 
	
	
	
	
	public static function usersById($user_id) 
	{ 
		if(!empty($user_id) && $user_id > 0 ) { 
		$query = \DB::table('profiles')->where('user_id', '=', $user_id)->first();	
		if($query) return $query ;  else return Null ; 
			
		} else { return Null ; } 
	} 

	public static function projectById($p_id) 
	{ 
		if(!empty($p_id) && $p_id > 0 ) { 
		$query = \DB::table('projects')->where('id', '=', $p_id)->first();	
		if($query) return $query ;  else return Null ; 
			
		} else { return Null ; } 
	} 

	public static function countReplyById($msgId) 
	{ 
		if(!empty($msgId) && $msgId > 0 ) { 
		$query = \DB::table('message_headers')->where('parent_id', '=', $msgId)->count();	
		if($query) return $query ;  else return Null ; 
			
		} else { return Null ; } 
	} 



	
	
 	 

}