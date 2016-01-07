<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class Activity extends Event {

	use SerializesModels;
	public $request;
    public $atrributes ; 


	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($request , $atrributes)
	{
		$this->request = $request;
		$this->atrributes = $atrributes;

	}

}
