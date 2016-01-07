<?php namespace App\Handlers\Events;

use App\Events\Activity;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class SiteActivity {

	protected $request;
	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Handle the event.
	 *
	 * @param  FileAttachment  $event
	 * @return void
	 */
	public function handle(Activity $event)
	{

			$userId 	= $event->atrributes['user_id'];
			$userType 	= $event->atrributes['user_type'];
			//$project_id = $event->atrributes['project_id'];
			$action 	= $event->atrributes['action'];
			$actionMsg 	= $event->atrributes['msg'];
			$ip 		= $this->request->getClientIp();
			
			$user = User::find($userId);
			$user->login_from_ip 	= $ip;			
			$user->last_login = new \DateTime;
			//$user->user_type = new \DateTime;
			$user->save();
			User::where("id", $userId)->increment("login_count");
			# Add User Login history
			$logActivity = new LogActivity();
			//$logActivity->project_id = $project_id ;
			$logActivity->user_id = $userId ;
			$logActivity->user_type = $userType ;
			$logActivity->message = $actionMsg ;
			$logActivity->hostname = $ip ;
			$logActivity->timestamp = new \DateTime ;
			$logActivity->action = $action ;
			$logActivity->save();
			# End of login history
	}

}
