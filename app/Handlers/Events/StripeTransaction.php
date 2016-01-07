<?php namespace App\Handlers\Events;

use App\Events\Transaction;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class StripeTransaction {

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
	public function handle(Transaction $event)
	{

			$userId 			= $event->atrributes['user_id'];
			$transaction_id 	= $event->atrributes['transaction_id'];
			$credit 			= $event->atrributes['credit'];
			$debit 				= $event->atrributes['debit'];
			$actionMsg 			= $event->atrributes['msg'];
			$status 			= $event->atrributes['status'];
			$ip 				= $this->request->getClientIp();

			# Add transaction  history
			$transaction = new \App\Models\Transaction();
			$transaction->transaction_id 	= $transaction_id ;
			$transaction->user_id 	= $userId ;
			$transaction->credit 	= $credit ;
			$transaction->debit 	= $debit ;
			$transaction->message 	= $actionMsg ;
			$transaction->status 	= $status ;
			$transaction->hostname 	= $ip ;		
		
			$transaction->save();
			# End of transaction history
	}

}
