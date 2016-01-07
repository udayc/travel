<?php namespace App\Http\Controllers\Admin; 

use App\Http\Requests;
use App\Http\Controllers\Controller;  

Use App\Models\Page; 
Use App\Models\Menu ; 
use Image;
use Validator;  
use DB; 
use Illuminate\Contracts\Auth\Guard;
use Session;
use Excel;

use Illuminate\Support\Str;

use Illuminate\Http\Request; 
use Illuminate\Http\Response; 



class PageController extends Controller {

	protected $userrepo;
	protected $orderbrBY 		= "id";
	protected $orderDe 			= "DESC";
	protected $allRegisteredUsers	=	array();
	protected $getactiveArr			=	array();
	protected $getinactiveArr		=	array();
	 


	public function __construct(Menu $menu )
	{ 
  		
  		$this->paginationlimit = 5; 
		$this->menuItems	= [''=>'Select Options'] + $menu->lists('name' , 'id');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function getIndex()
	{
		$paginationlimit	=	$this->paginationlimit; 
		$pages 				= 	Page::all();
		return view('admin.page.index' , ['pages' => $pages  ]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return view('admin.page.create' , [ '_menus' => $this->menuItems ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore(Request $request)
	{
		$rules = array(	'title'  => 'required', 'content' => 'required'   );		                
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {				
			$messages = $validator->messages();
			// redirect our user back to the form with the errors from the validator
			return redirect()->back()->withErrors($validator);
		} else {
			// create the data for our user
			$page = new Page();
			$page->title 		= $request->input('title');
			$page->content 		= $request->input('content');
			$page->slug 		= Str::slug($request->input('title')); 
			$page->active		= 1; 
			//$page->menu_id				= $request->input('menu_id');
			$page->meta_keywords		= $request->input('meta_keywords'); 
			$page->meta_description		= $request->input('meta_description'); 			

			if( $page->save() ) {
				$request->session()->flash('alert-success', 'New page has been created successfully');			
				return redirect('admin/pages');
			} else { 
				return redirect('admin/pages/create')->withInput(Input::get());
			}
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
			$page = Page::find($id);				
			return view('admin.page.show' , compact('page') );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$page = Page::where('id', $id)->first();		
		return view('admin.page.edit' , ['page' => $page , '_menus' => $this->menuItems ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function putUpdate($id , Request $request)
	{

		$rules = array(	'title' => 'required', 'content' => 'required'  );	                      
		$validator = Validator::make($request->all(), $rules);		
		
		if ($validator->fails()) {				
			//$messages = $validator->messages();
			// redirect our user back to the form with the errors from the validator
			return redirect()->back()->withInput($request->all())->withErrors( $validator->messages() );
		} else {
				$pagedet = array();
				$pagedet['title'] 				= $request->input('title');
				$pagedet['slug'] 				= Str::slug($request->input('title')); 
				$pagedet['content'] 			= $request->input('content');
				$pagedet['active'] 				= $request->input('active');
				$pagedet['meta_keywords'] 		= $request->input('meta_keywords');
				$pagedet['meta_description'] 	= $request->input('meta_description');

				
				if(Page::where('id', $id)->update($pagedet) ) {
					$request->session()->flash('alert-success', 'Page content has been updated successfully');				
					return redirect('admin/pages');
				}	else {
					return redirect('admin/pages/edit/' .$id )->withInput(Input::get());
				}				

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
			$page = Page::find($id);
			$page->delete();
			$request->session()->flash('alert-success', 'Records successfully deleted.');  
			return response(['msg' => 'Row deleted', 'status' => 'success' ]);
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
					$page = Page::find($id);
					$page->delete();
				}			
		
			}
			
			if($actiontype == 'inactive') 
			{
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$page = Page::find($id);
					$page->active = 0;
					$page->save();
				}				
				
			}

			if($actiontype == 'active') 
			{
				
				$ids = $request->input('_checkboxes');
				foreach($ids as $id)
				{
					$page = Page::find($id);
					$page->active = 1;
					$page->save();
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
								Session::set('statussearch', $approved);
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
		return redirect('admin/user/sendmsg');
	}

	public function getExportselected($id, Request $request)
	{    
			Session::set('exportrec', $id);
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
		        $ids = Session::get('exportrec');   
		        $newdatas=explode(",",$ids);    
		        $gdatalist = $this->userrepo->getexportrecords($newdatas);  
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
		        /* setting column names for data - you can of course set it manually */
		        $sheet->appendRow(array_keys($dataArr[0])); /* column names */ 
		        /* getting last row number (the one we already filled and setting it to bold */
		        $sheet->row($sheet->getHighestRow(), function ($row) {
		            $row->setFontWeight('bold');
		        }); 
		        /* putting users data as next rows */
		        foreach ($dataArr as $user) {
		            $sheet->appendRow($user);
		        }
		    });

		})->export('xls');	 

	}

}
