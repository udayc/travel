<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use Crypt;
use App\Http\Requests\ProjectFormRequest;
use App\User;
use App\Models\Project;
Use App\Models\Country;
Use App\Models\Category;
Use App\Models\Reward;
Use App\Models\Genre; 
use Image;
use Validator; 
use DB;
use Session;
use Excel;
use Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Events\FileAttachment ; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PaymentsController extends Controller {

	protected $project_repo;

	
	
	public function __construct(ProjectRepository $project_repo)
	{
		$this->project_repo = $project_repo;
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function getIndex( $criteria = Null )
	{ 
		Session::put('step', '1');
		Session::put('last_insert_id' , '');
		
		
		$searchKey =   ( \Input::get('srch-term') ) ? \Input::get('srch-term') : Null ; 
		 
		
		$projects = Project::whereIn('active' , [0, 1]);
		
		if($criteria != Null){
			
			switch($criteria)
			{
				case "active" :
				$projects = Project::where('active' , 1 );
				break;
				case "inactive" :
				$projects = Project::where('active' , 0 );
				break;
				case "featured" :
				$projects = Project::where('featured' , 1);
				break;
				case "suspended" :
				$projects = Project::where('status' , 1 );
				break;
				case "flaged" :
				$projects = Project::where('flag' , 1 );
				break;
				case "uflaged" :
				$projects = Project::where('user_flagged' , 1 );				
				break;

			}
			
		}
		
		if( $searchKey != Null )
		{
		
		 $projects->Where(function($query) use($searchKey)
						{
						//echo $searchKey; exit;
							$query->where('name', 'LIKE', '%'. $searchKey .'%');			
						})
						;	
			
		}
		
		$results =  $projects->orderBy('id', 'desc')->paginate($this->show_per_page);	
		
		
		return view('admin.project.index' , ['projects' => $results , 'searchKey'=> $searchKey , 'dataStat'=> $this->project_repo->projectDataStat() ]);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 
	public function getTransactions()
	{
		
		$myTransactions 	= \App\Models\Transaction::orderBy('created_at', 'desc')->get();

		return view('admin.payments.transactions' , [ 
			'transactions'  => $myTransactions ,
		]);
	}	 
	 
	 
	 
	 
	public function getProjectFunded()
	{
		
		$project_funded 	= \App\Models\ProjectFund::orderBy('created_at', 'desc')->get();
		return view('admin.payments.project_funded' , [ 
			'project_funded'  => $project_funded ,
		]);
	}	 
	 	 

	public function getCashWithdrawal()
	{		
		$cash_withdrawal 	= \App\Models\CashWithdrawalsRequest::orderBy('id', 'desc')->get();		
		return view('admin.payments.cash_withdrawal' , [ 
			'cash_withdrawal'  => $cash_withdrawal ,
		]);
	}	
	
	/*public function getChangestatus($id)
	{		
		if(\App\Models\CashWithdrawalsRequest::where('id', '=', $id)->update(array('status' => 'accepted')))
		{
			echo $id;
		}
		else
		{
			echo "error";
		}		
	}*/
	public function getCashwithdrawaldetails($id)
	{		
		$withdraw_details = \App\Models\CashWithdrawalsRequest::findOrFail($id);
		
		return view('admin.payments.cash_withdrawal_details' , [ 
			'_username'  => $withdraw_details->user()->first()->name ,
			'_account'  => $withdraw_details->user()->first()->email ,
			'_amount'  => $withdraw_details->projectfund()->first()->paid_amount ,
			'_id'  => $id
		]);
	}

	public function postStorenote(Request $request)
	{		
		$updated = \App\Models\CashWithdrawalsRequest::where('id', '=', $request->id)
											->update(array(
														'notes' => $request->notes,
														'status' => 'accept',
														'payment_date' => date("Y-m-d H:i:s")
													)
											);
		if($updated)
		{
			$msg = 'Request process successfully.';
			Session::flash('message', $msg);
			return Redirect('/admin/payments/cash-withdrawal');
		}
		else
		{
			return Redirect::back()->withInput();
		}		
	}

	public function getRejectwithdraw($id)
	{		
		$updated = \App\Models\CashWithdrawalsRequest::where('id', '=', $id)
											->update(array(														
														'status' => 'reject',
														'payment_date' => date("Y-m-d H:i:s")
													)
											);
		if($updated)
		{
			$msg = 'Request process successfully.';
			Session::flash('message', $msg);
			return Redirect('/admin/payments/cash-withdrawal');
		}
		else
		{
			return Redirect::back()->withInput();
		}		
	}
	
	

}
