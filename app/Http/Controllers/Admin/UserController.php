<?php namespace App\Http\Controllers\Admin; 

use App\Http\Requests;
use App\Http\Controllers\Controller;  
use App\User;
use App\Profile;
Use App\Models\Country; 
use Image;
use Validator;  
use DB; 
use Illuminate\Contracts\Auth\Guard;
use Session;
use Excel;
use Mail;
use Illuminate\Http\Request; 
use Illuminate\Http\Response; 

use App\Http\Requests\UserRequest; 
use App\Http\Requests\SearchRequest;  
use App\Repositories\UserRepository;

class UserController extends Controller {

	protected $userrepo;
	protected $orderbrBY 			= "id";
	protected $orderDe 				= "DESC";
	protected $allRegisteredUsers	=	array();
	protected $getactiveArr			=	array();
	protected $getinactiveArr		=	array();
	 


	public function __construct(UserRepository $userrepo )
	{ 
  		$this->userrepo = $userrepo;
  		$this->paginationlimit = 1000; 
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function getIndex()
	{
		 
		$getSearch 			= 	Session::get('usersearch'); 
		$statusSearch 		= 	Session::get('statussearch');    
		$approveornot		=	Session::get('approveornot'); 
		$searchBySocialNet	= 	Session::get('searchBySocialNet'); 
		$recordlist 		= 	Session::get('recordlist');   
		$paginationlimit	=	$this->paginationlimit; 

 		if(!empty($approveornot))
		{  
			if(!empty($getSearch))	{  
				$userlist = $this->userrepo->getsearchdata($paginationlimit, $statusSearch, $getSearch, $this->orderbrBY, $this->orderDe );
			} else {  
				$userlist = $this->userrepo->getsearchdata($paginationlimit, $statusSearch, '', $this->orderbrBY, $this->orderDe );
			} 
			 
		} 
		else 
		{    
			if(!empty($getSearch))	{  
				$userlist = $this->userrepo->getstatsearchdata($paginationlimit, $getSearch, $this->orderbrBY, $this->orderDe );
			}  else {  
				$userlist = $this->userrepo->index($paginationlimit);
			} 
		}  

		return view('admin.user.index' , ['users' => $userlist ,  'result_count' => count($userlist) , 'dataStat'=> $this->userrepo->userDataStat(), 'getSearch' => $getSearch, 'recordlist' => $recordlist   ]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return view('admin.user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore(Request $request)
	{ 
		$rules = array(
				'name'             => 'required',  
				'email'            => 'required|email|unique:users',   
				'password'         => 'required'

			);		
		// 	'password_confirm' => 'required|same:password'          
		
		//$input = $request->all();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {				
			$messages = $validator->messages();
			// redirect our user back to the form with the errors from the validator
			/* return redirect()->back()->withErrors($validator); */
			return redirect()->back()
							 ->withInput($request->only('email', 'name', 'last_name'))
							 ->withErrors($validator);
		} else {
			// create the data for our user
			$user = new User();
			$user->name 		= $request->input('name');
			$user->last_name 		= $request->input('last_name');
			$user->type 		= $request->input('type');
			$user->username 	= $request->input('email');	
			$user->email 		= $request->input('email');
			$user->password = bcrypt($request->input('password'));
			$user->save();
			
			$lastInsertedId= $user->id; 

			 
			$profile = new Profile();    
			$profile->f_name = $request->input('name');
			$profile->l_name = $request->input('last_name');
			$profile = $user->profile()->save($profile);
 

			
			/*
			echo "First Name >> ".$request->get('name');
			echo "<br>Las Name >> ".$request->get('last_name');
			exit;
			$profile = new Profile( ['f_name' => $request->get('name'), 'l_name' => $request->get('last_name') ] ); 
			echo "<pre>";
			print_r($profile);
			exit;
			*/

			$profile = $user->profile()->save($profile);			
			
			$request->session()->flash('alert-success', 'User has been created successfully');
			/* return redirect()->back()->withInput();		*/
			return redirect('admin/user');
			exit;	
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$user 		= 	User::find($id);
		$profile 	= 	Profile::where('user_id' , $id)->first();		
		return view('admin.user.show' , ['user' => $user , 'profile' => $profile]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{ 
		$userProfile = Profile::where('user_id', $id)->first();
		$countries = Country::all();
		foreach($countries  as $countryval){
			$data[$countryval->countryID] = $countryval->countryName; 
		}	

		$statArr=array( '' => 'Select Country' );
	 	$result = array_merge($statArr, $data);

	 	$countryId=$userProfile['country_id'];
	  	$citylist = $this->userrepo->getcitylist($countryId);

	   
	  	$datan=array();
	  	foreach($citylist  as $cityval){
	  		$id=$cityval['cityID'];
			$name=$cityval['cityName'];
			$datan[$id] = $name; 
		}	


	  	 /*
	  	$statnArr = array( ' ' => 'Select City' );

		$cresult=array_merge($statnArr, $datan); 
 
		echo "<pre>";
		print_r($datan);
		echo "<br>============================<br>";
		echo "<pre>";
		print_r($cresult);

		exit;

		//dd($userProfile);
		*/
		return view('admin.user.edit' , ['userProfile' => $userProfile , 'countries' => $result, 'cityl' => $datan]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function putUpdate($id , Request $request)
	{

		$rules = array(
				'f_name'         	=> 'required',                        
				'l_name'         	=> 'required',                       		
				'about_me'       	=> 'required|min:20',   
				'dob'         		=> 'required',
				'first_address' 	=> 'required',
				'alternate_address' => 'required',
				'city' 				=> 'required',
				'state' 			=> 'required',
				'country_id' 		=> 'required',
				'zipcode' 			=> 'required',	 
			);			
		
		$validator = Validator::make($request->all(), $rules);		
		
		if ($validator->fails()) {				
			//$messages = $validator->messages();
			// redirect our user back to the form with the errors from the validator
			return redirect()->back()->withInput($request->all())->withErrors( $validator->messages() );
		} else {
				$userdet = array();
				$userdet['f_name'] 							= $request->input('f_name');
				$userdet['l_name'] 							= $request->input('l_name');
				$userdet['gender'] 							= $request->input('gender');
				$userdet['dob'] 							= $request->input('dob');
				$userdet['about_me'] 						= $request->input('about_me');
				$userdet['first_address'] 					= $request->input('first_address');
				$userdet['alternate_address'] 				= $request->input('alternate_address');
				$userdet['city'] 							= $request->input('city');
				$userdet['state'] 							= $request->input('state');
				$userdet['country_id'] 						= $request->input('country_id');
				$userdet['zipcode'] 						= $request->input('zipcode');
				
				$userdet['education'] 					= $request->input('education');
				$userdet['employment_status'] 			= $request->input('employment_status');
				$userdet['income_range'] 				= $request->input('income_range');
				$userdet['relationship_status'] 		= $request->input('relationship_status');	
				$userdet['website']						= $request->input('website');

				$userdet['facebook_url']				= $request->input('facebook_url');
				$userdet['twitter_url']					= $request->input('twitter_url');
				$userdet['linkedIn_url']				= $request->input('linkedIn_url');
				$userdet['googleplus_url']				= $request->input('googleplus_url');
				
				if($request->hasFile('user_avtar')):
				
					$file = $request->file('user_avtar');
					$imageName = $id . '.' .  $file->getClientOriginalExtension();
					$realPath = base_path() . '/public/images/avtar-image/';
					$resizePath = base_path().'/public/images/avtar-image/resize/' . $imageName;
					
					$openMakePath = $realPath . $imageName;
					 
					$request->file('user_avtar')->move( $realPath, $imageName );
					Image::make($openMakePath)->resize(200, 200)->save($resizePath);
					$userdet['user_avtar'] 	= $imageName;
							
				endif;
				
				Profile::where('user_id', $id)->update($userdet);
				$user = User::find($id);
				$user->name 	= $request->input('f_name') . ' ' . $request->input('l_name');	
				$user->save();
		
				$request->session()->flash('alert-success', 'User has been updated successfully');
				/*return redirect()->back()->withInput($request->all());	*/
				return redirect('admin/user');
				exit;					

		}		
		
		
		
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function anyDestroy($id , Request $request)
	{
		if($request->ajax()) 
		{
			$user = User::find($id);
			$user->delete();
			$request->session()->flash('alert-success', 'Records successfully deleted.');  
			return response(['msg' => 'Product deleted', 'status' => 'success' ]);
		}
		
	}
	
	public function postMassaction($actiontype , Request $request)
	{
		if($request->ajax()) 
		{
			if($actiontype == 'delete') 
			{
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$user = User::find($id);
					$user->delete();
				}			
		
			}
			
			if($actiontype == 'inactive') 
			{
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$user = User::find($id);
					$user->status = 0;
					$user->save();
				}				
				
			}

			if($actiontype == 'active') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$user = User::find($id);
					$user->status = 1;
					$user->save();
				}				
				
			}			
			
			$request->session()->flash('alert-success', 'Records successfully updated.');  
			return response(['msg' => 'Action Updated', 'status' => 'success' ]);
		}
		
	}
	
	
	public function getSearch(Request $request)
	{
		$searchKey	= $request->get('srch-term');
		//DB::connection()->enableQueryLog();		
		$results = User::where('type' , '=' , 'general')		
					->Where(function($query) use($searchKey)
						{
							$query->where('name', 'LIKE', '%'. $searchKey .'%')
								->orWhere('username', 'LIKE', '%'. $searchKey .'%');			
						})
					->paginate(2);
					
			
		//$queries = DB::getQueryLog();	
		if($results)
		{ 				
			return view('admin.user.index' ,['users' =>$results , 'result_count' => count($results) , 'dataStat'=> $this->userrepo->userDataStat() ,'searchKey'=> $searchKey ]);
		}
		else
			return Redirect::back()->with('message','No results found');
	}
	
	public function postSearchparameter(Request $request)
	{    
		$search = $request->input('search');
		Session::set('usersearch', $search); 
		$getSearch = Session::get('usersearch');  
		return redirect('admin/user');
		exit;		 
	}

	public function getFilterBy($criteria = Null )
	{
		if($criteria != Null)
		{
				Switch($criteria)
				{
					case "active" :
								$approved=1; 
								Session::set('statussearch', $approved);
								Session::set('approveornot', $approved);
								Session::set('recordlist', "Approved");									
								break;									

					case "in-active" :
								$approved=0; 
								Session::set('statussearch', 2);
								Session::set('approveornot', 2);
								Session::set('recordlist', "Disapproved");
								break;						

					case "fb" :
							
								Session::set('statussearch', 'facebook');							
								Session::set('approveornot', 'facebook');
								Session::set('recordlist', "FaceBook");					
								break;
					
					
					case "twitter" :								
								Session::set('statussearch', 'twitter');								
								Session::set('approveornot', 'twitter');
								Session::set('recordlist', "Twitter");					
								break;					
					
					case "gplus" :

								Session::set('statussearch', 'gplus');								
								Session::set('approveornot', 'gplus');
								Session::set('recordlist', "GooglePlus");					
								break;					

					case "all" :
								$usersearch = ''; 
								$statussearch='';
								Session::set('statussearch', $statussearch);
								Session::set('usersearch', $usersearch);
								Session::set('approveornot', $statussearch);
								Session::set('recordlist', "All");
								
								Session::set('userorderby' , '')	;
								Session::set('userorderde' , '')	;								
								
								
								break;					
				}
					return redirect('admin/user');
		
		} else {
		
		}
	}

	# Send Email To Users	
	public function getSendMsg()
	{     
		$userlist	=	$this->userrepo->getallrecords();

		if(is_array($userlist) && count($userlist)>0) 
		{
			$counter=0;
			foreach($userlist as $kyy=>$dataval)
			{ 
				$this->allRegisteredUsers[$counter]['email']	=	$dataval['email']; 
				if($dataval['status']==1){
					$this->getactiveArr[$counter]['email']	=	$dataval['email'];  
				}
				if($dataval['status']==0){
					$this->getinactiveArr[$counter]['email']	=	$dataval['email'];  
				}				
				$counter++; 
			} 
		}  

		$activearr		=	array_values($this->getactiveArr);		
		$inactivearr	=	array_values($this->getinactiveArr);  
		$allarr 		= 	$this->allRegisteredUsers;

		Session::set('alluser', $this->allRegisteredUsers);
		Session::set('activeuser', $activearr);
		Session::set('inactiveuser', $inactivearr);

		return view('admin.user.sendmsg', compact('allarr', 'activearr', 'inactivearr' ));		 
	}



	public function postSendemail(Request $request)
	{   


		/* Data calculation in different situation START*/
		$dynamicArr=array(); 
		if($request->selectedemails)
		{
			$sendemail	=	$request->selectedemails;
		}
		else
		{
			$bulkmailopt=$request->bulkmailopt;
			if($bulkmailopt==1)
			{
				$alluser = Session::get('alluser');   
				if(is_array($alluser) && count($alluser)>0) 
				{ 
					foreach($alluser as $allemails)
					{ 
						 $dynamicArr[]= $allemails['email'];
					}
				} 
			}
			elseif($bulkmailopt==2)
			{
				$inactiveuser = Session::get('inactiveuser');   
				if(is_array($inactiveuser) && count($inactiveuser)>0) 
				{ 
					foreach($inactiveuser as $inactemails)
					{ 
						 $dynamicArr[]= $inactemails['email'];
					}
				} 				

			}
			elseif($bulkmailopt==3){
				$activeuser = Session::get('activeuser');
				if(is_array($activeuser) && count($activeuser)>0) 
				{ 
					foreach($activeuser as $actemails)
					{ 
						 $dynamicArr[]= $actemails['email'];
					}
				} 
			}
			$sendemail=$dynamicArr;
		}
		/* Data calculation in different situation END*/


		$emailMsg=$request->usrmsg; 		
		$emailsubject=$request->emailsubject;	

		Session::set('sendemail', $sendemail);
		Session::set('emailsubject', $emailsubject);

		/* Email sending code using LARAVEL Mail::queue START*/
		Mail::queue('admin.user.msghere', ['msg' => $emailMsg] , function($message)
		{ 
			$sendemails = Session::get('sendemail');   
			$emailsubject = Session::get('emailsubject');   
			$message->from('us@example.com', 'Musicfunder'); 

			if(is_array($sendemails) && count($sendemails)>0) 
			{ 
				foreach($sendemails as $emailid)
				{ 
					$message->to($emailid)->subject($emailsubject);
				}
			} 
		});  
		/* Email sending code using LARAVEL Mail::queue END*/

		$request->session()->flash('alert-success', 'Mail Sent successfully');
		return redirect('admin/user/send-msg');
	}



	public function getExportselected(Request $request)
	{      
			$excelnm="user_".date("d-m-Y"); 
			Excel::create($excelnm, function ($excel) { 
		    $excel->sheet('User', function ($sheet) { 
		        $sheet->mergeCells('A1:W1');
		        $sheet->row(1, function ($row) {
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(30);
		        }); 
		        $sheet->row(1, array('User Report'));  
		        $sheet->row(2, function ($row) { 
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(15);
		            $row->setFontWeight('bold');

		        }); 
		        $sheet->row(2, array('User Details')); 
		        /* getting data to display - in my case only one record */ 
		    
		        $gdatalist = $this->userrepo->getexportrecords();  

		     
		        $dataArr=array();

 
				if(is_array($gdatalist) && count($gdatalist)>0) 
				{
					$counter=0;
					foreach($gdatalist as $kyy=>$dataval)
					{
						$dataArr[$counter]['Sl']=($counter+1);
						$dataArr[$counter]['Name']=$dataval['name'];
						$dataArr[$counter]['Type']=$dataval['type'];
						$dataArr[$counter]['Email']=$dataval['email']; 
						$dataArr[$counter]['First Name']=$dataval['f_name'];
						$dataArr[$counter]['Last Name']=$dataval['l_name'];
						$dataArr[$counter]['Gender']=$dataval['gender'];
						$dataArr[$counter]['Birth Date']=$dataval['dob'];
						$dataArr[$counter]['Address']=$dataval['first_address']; 
						$dataArr[$counter]['Contact No']=$dataval['contact_no']; 
						$dataArr[$counter]['Zip']=$dataval['zipcode']; 
						$counter++; 
					} 
				} 
				 

			 


		        /* setting column names for data - you can of course set it manually   */
		        $sheet->appendRow(array_keys($dataArr[0])); /* column names */ 
		        /* getting last row number (the one we already filled and setting it to bold */
		        $sheet->row($sheet->getHighestRow(), function ($row) {
		            $row->setFontWeight('bold');
		        }); 


		        /* putting users data as next rows */

		        foreach ($dataArr as $user) 
		        {
		            $sheet->appendRow($user);
		        }

		        /* $sheet->array( 'encoding' -> array('input' => 'iso-8859-1', 'output' => 'iso-8859-1' ) ); */
		    });

		})->export('xls');	 

	}
 

	public function getChangepresentstatus($userid, $userstatus)
	{   
		$user = User::find($userid);
		$user->status = $userstatus;
		$user->save();  
	}


	public function getUimodal($modalFor , $user_id)
	{
		if(isset($modalFor) && $modalFor == 'project-count')
		{		
			$projectLists = \App\Models\Project ::where('user_id' , $user_id)->get();		
			echo view('admin.user.uimodal',  ['modalFor' => $modalFor , 'user_id' => $user_id , 'projectLists' => $projectLists ]);
		}
		elseif(isset($modalFor) && $modalFor == 'user-login-count'){
		
			$logHistory = \App\Models\LogActivity ::where('user_id' , $user_id)->where('action' , 'user-login')->orderBy('timestamp')->get();		
			echo view('admin.user.uimodal',  ['modalFor' => $modalFor , 'user_id' => $user_id , 'logHistory' => $logHistory ]);		
		
		}
		elseif(isset($modalFor) && $modalFor == 'project_funded_count'){
		
			$fundedDetails = \App\Models\ProjectFund ::where('U_ID' , $user_id)->where('status' , 'Pledged')->orderBy('created_at')->get();		
			echo view('admin.user.uimodal',  ['modalFor' => $modalFor , 'user_id' => $user_id , 'fundedDetails' => $fundedDetails ]);		
		
		} 
		
	}

 
	public function getCitylist($countryid)
	{  
		$citylist = $this->userrepo->getcitylist($countryid);  
		$statArr = array(
						    0 => array(
						        'cityID' => '',
						        'cityName' => 'Select City'
						    ) 
					   );
		$result = array_merge($statArr, $citylist); 
		return $result;
		exit;
	}



}
