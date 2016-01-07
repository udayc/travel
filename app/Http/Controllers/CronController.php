<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;  
use Auth; 
use Session ;
Use App\Models\Menu ;
Use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
Use Facebook;
Use View , DB;
use App\Models\Project;
Use App\Models\Category;
Use App\Models\Genre ;
Use App\Models\Reward; 
Use App\Models\Banner; 
Use App\Models\ProjectFund;
use App\Models\User;
use App\Profile;
Use App\Models\Country;  
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository; 
use Illuminate\Http\Request; 
use Illuminate\Http\Response; 
use App\Setting;
use App\Models\ProjectUpdates;
use App\Models\ProjectComment;
use App\Models\Unsafe;

class CronController extends Controller {

	protected $project_repo;
	protected $userrepo;
	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct( LaravelFacebookSdk $fb  , Menu $menu , UserRepository $userrepo , ProjectRepository $project_repo)
	{
		//$this->middleware('auth');
		$this->menuItems				= $menu->where('active' , '1')->orderBy('weight' , 'asc')->get();
 		$this->login_url 				= $fb->getLoginUrl(['email']);	
		$this->userrepo 				= $userrepo;	
		$this->project_repo 			= $project_repo;		
		
	}

	
	function getUnsafewords($search)
	{
		$search_text=strtolower($search);
		$settings = Setting::where('id','47')->first();	
		$settingsArr=$settings->toArray();
		$settingsArrN=strtolower($settingsArr['config_value']);		
		$settingPArr=explode(PHP_EOL, $settingsArrN);		
		//dd($settingPArr);
		$exists=NULL;
		for($i=0; $i<count($settingPArr); $i++)
		{
			if($exists==0)
			{
				if (strpos($search_text,$settingPArr[$i]) !== false) {
					$exists=1;
				}
				else
				{
					$exists=0;
				}
			}
			
		}
		return $exists;
	}
	
	// Check duplicate entry
	function getCheckduplicate($id,$table_name)
	{
		$chk_duplicate=Unsafe::where('post_id',$id)->where('type',$table_name)->get();
		if(count($chk_duplicate)>0)
		{
			return false;
		}			
		else
		{
			return true;
		}
	}
	
	// To check if any project update contain unsafe words or not
	// 
	function getCheckunsafeupdate($id='',$unsafe_id='')
	{
		$startDate=date("Y-m-d H:i:s");
		$endDate = date("Y-m-d H:i:s", strtotime('-24 hours'));		
		
		if($id=="")
		{
			$project_update = ProjectUpdates::where('updated_at','>=',$endDate)->get();		
		}
		else
		{
			$project_update = ProjectUpdates::where('id','>=',$id)->get();		
		}
		//dd("C");
		$titles=NULL;
		$description=NULL;
		$new_search=NULL;
		$getUnsafewords = 0;
		for($i=0; $i<count($project_update); $i++)
		{
			
			$titles=$project_update[$i]['title']; // change with your field	
			$description=$project_update[$i]['description']; // change with your field	
			
			$new_search=$titles." , ".$description;			
			$getUnsafewords = $this->getUnsafewords($new_search);		
			if($getUnsafewords==1)
			{	
				if($id=="")
				{
					$unsafeDetails=ProjectUpdates::findOrFail($project_update[$i]['id']);				
					$unsafe = new Unsafe;
			
					$unsafe->post_id 	= $project_update[$i]['id'];		
					$unsafe->user_id 	= $project_update[$i]['user_id'];	
					$unsafe->type 		= "updates";		// add table name		
					$unsafe->status 	= 1;					
					$unsafe->notified 	= 0;					
					
					//getCheckduplicate(unique id for update/comment,table name)
					//return true or false
					$getCheckduplicate = $this->getCheckduplicate($project_update[$i]['id'],'updates');				
					if($getCheckduplicate)
					{
						$unsafe->save();
					}		
				}
				else
				{
					$update = ProjectUpdates::where('id', '=', $id)
												->update(array(
													'status' => '2'
												));
												
					$updateUnsafe = Unsafe::where('id', '=', $unsafe_id)
												->update(array(
													'notified' => '2'
												));
				}
			}
		}		
	}
	
	// To check if any project comment contain unsafe words or not
	// 
	function getCheckunsafecomment($id='',$unsafe_id='')
	{
		//dd($id);
		$startDate=date("Y-m-d H:i:s");
		$endDate = date("Y-m-d H:i:s", strtotime('-24 hours'));		
		if($id=="")
		{
			$project_update = ProjectComment::where('updated_at','>=',$endDate)->get();	
		}
		else
		{
			$project_update = ProjectComment::where('id','>=',$id)->get();		
		}
		//dd("A");
		//dd($project_update);
		$titles=NULL;
		$description=NULL;
		$new_search=NULL;
		$getUnsafewords = 0;
		for($i=0; $i<count($project_update); $i++)
		{			
			$titles=$project_update[$i]['comment'];	 // change with your field		
			
			$new_search=$titles;			
			$getUnsafewords = $this->getUnsafewords($new_search);	
		
			if($getUnsafewords==1)
			{	
				if($id=="")
				{
					//dd("A");
					$unsafeDetails=ProjectComment::findOrFail($project_update[$i]['id']);				
					$unsafe = new Unsafe;
			
					$unsafe->post_id 	= $project_update[$i]['id'];		
					$unsafe->user_id 	= $project_update[$i]['user_id'];	
					$unsafe->type 		= "comments";		// add table name		
					$unsafe->status 	= 1;	
					$unsafe->notified 	= 0;					
					
					//getCheckduplicate(unique id for update/comment,table name)
					//return true or false
					$getCheckduplicate = $this->getCheckduplicate($project_update[$i]['id'],'comments');				
					if($getCheckduplicate)
					{
						$unsafe->save();
					}	
				}
				else
				{
					//dd("D");
					$update = ProjectComment::where('id', '=', $id)
												->update(array(
													'status' => '2'
												));
												
					$updateUnsafe = Unsafe::where('id', '=', $unsafe_id)
												->update(array(
													'notified' => '2'
												));
				}
			}
		}		
	}
	
	// To check if any project comment contain unsafe words or not
	// Run http://dev.musicfunder.com/cron/updatedata url after  getCheckunsafecomment
	// or getCheckunsafeupdate function
	function getUpdatedata()
	{
		$unsafeDetails=Unsafe::all();		
		for($i=0; $i<count($unsafeDetails); $i++)
		{			
			$userDetails=User::findOrFail($unsafeDetails[$i]['user_id']);
			
			$unsafe=new Unsafe;			
			$update = Unsafe::where('id', '=', $unsafeDetails[$i]['id'])->update(array(
																						'user_name' => $userDetails->name,
																						'user_email' => $userDetails->email,
																					  ));	
		}
	}
	
	function getSendnotify()
	{
		$unsafeDetails=Unsafe::where('notified','0')->where('status','1')->get();		
		//dd($unsafeDetails);
		for($i=0; $i<count($unsafeDetails); $i++)
		{	
			$user_name = $unsafeDetails[$i]['user_name'];
			$user_email = $unsafeDetails[$i]['user_email'];
			$admin_email = 'uu@mailinator.com';
			if($unsafeDetails[$i]['type']=="comments")
			{
				$type="comment";
			}
			if($unsafeDetails[$i]['type']=="updates")
			{
				$type="update";
			}
			
			$data = array('user_name'=>$user_name,'type'=>$type);
			\Mail::send('emails.cronNotify', $data, function($message) use ($user_name,$type,$user_email,$admin_email) {
				$subject = 'Warning!!, your post contain unapprove word!';
				$message->from($admin_email, 'MusicFunder Site Admin');
				$message->to($user_email, $user_name)->subject($subject);
			});
			
			$update = Unsafe::where('id', '=', $unsafeDetails[$i]['id'])->update(array(
																						'notified' => '1',
																					  ));
		}
	}
	
	function getCheckaction()
	{
		$unsafeDetails=Unsafe::where('notified','1')
								->where('status','1')								
								->get();	
		//dd($unsafeDetails);
		if(count($unsafeDetails)>0)
		{
			//dd("A");
			for($i=0; $i<count($unsafeDetails); $i++)
			{
				$unsafe_id = $unsafeDetails[$i]['id'];
				$type = $unsafeDetails[$i]['type'];
				$post_id = $unsafeDetails[$i]['post_id'];
				$user_id = $unsafeDetails[$i]['user_id'];
			//	dd("A");
				if($type=="comments")
				{
					$this->getCheckunsafecomment($post_id,$unsafe_id);				
				}
				if($type=="updates")
				{					
					$this->getCheckunsafeupdate($post_id,$unsafe_id);
				}
			}
		}
		else
		{
			//dd("B");
			$this->getCheckunsafecomment();
			$this->getCheckunsafeupdate();
		}
	}
	
	function getBlockpost()
	{
		$startDate=date("Y-m-d H:i:s");
		$endDate = date("Y-m-d H:i:s", strtotime('-24 hours'));			
		
		$unsafeDetails=Unsafe::where('notified','1')
								->where('status','1')
								->where('updated_at','>=',$endDate)
								->get();		
		//dd($unsafeDetails);
		for($i=0; $i<count($unsafeDetails); $i++)
		{	
			$id = $unsafeDetails[$i]['id'];
			$type = $unsafeDetails[$i]['type'];
			$post_id = $unsafeDetails[$i]['post_id'];
			$user_id = $unsafeDetails[$i]['user_id'];			
			
			if($type=="comments")
			{
				$blockComment=ProjectComment::where('id', '=', $post_id)
												->where('user_id',$user_id)
												->update(array('status' => '2'));	
			}
			if($type=="updates")
			{
				$blockUpdate=ProjectUpdates::where('id', '=', $post_id)
												->where('user_id',$user_id)
												->update(array('status' => '2'));	
			}
			
			$update = Unsafe::where('id', '=', $id)->update(array('notified' => '4'));
			
		}
	}
	
	function getBlock()
	{
		// please do not change order of calling
		//1 => getCheckaction()
		//2 => getBlockpost()
		//3 => getCheckunsafeupdate()
		//4 => getCheckunsafecomment()
		//5 => getUpdatedata()
		//6 => getSendnotify()
		// call http://domain.com/cron/block to blcok and send notify 	
		###########################################
		$this->getCheckaction(); // Check if user already warned or not
		$this->getBlockpost(); // Block all post which already notified and they do not take any action		
		$this->getCheckunsafeupdate(); // Check unsafe project update and insert that into unsafe table
		$this->getCheckunsafecomment();  // Check unsafe project comment and insert that into unsafe table
		$this->getUpdatedata();	// Update unsafe table with user name and data			
		$this->getSendnotify(); // Notify users who post any unsafe word via email
	}

}
