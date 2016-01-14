<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Message extends Model  {

	use DatePresenter;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'messages'; 
	
	
	public function details(){
		return $this->belongsTo('\App\Models\Message', 'message_id');
	}
	
	
	
 	 

}