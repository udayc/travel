<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Exceptions\Handler;
use Illuminate\Http\Request;

class SettingsController extends Controller {

	protected $redirectPath = '/admin/settings';
	protected $exceptKey = array('_token' , 'submit');
	protected $validSettingsFormKey  = array(
											'systems-form' , 'regional-currency-language-form' ,'account-form','project-form',
											'project-owner-form','backer-form','revenue-form','api-settings-form','withdrawals-form' ,'revenue-form','suspicious-words-detector-form'
											);

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( Request $request, $formKey)
	{
		$settings = Setting::all();	
		foreach($settings as $settingval){
			$data[$settingval->config_key] = $settingval->config_value; 
		}
		$data['formkey'] =  trim($formKey) ;
		switch(trim($formKey))
		{
			case "systems":			
					return view('admin.settings.systems' , $data );
					break;
			case "regional-currency-language":			
					return view('admin.settings.regional-currency-language' , $data );
					break;	
			case "account":			
					return view('admin.settings.account' , $data );
					break;	
			case "project":			
					return view('admin.settings.project' , $data );
					break;				
			case "project-owner":			
					return view('admin.settings.project-owner' , $data );
					break;						
			case "backer":			
					return view('admin.settings.backer' , $data );
					break;	
			case "reward":			
					return view('admin.settings.reward' , $data );
					break;
			case "suspicious-words-detector":			
					return view('admin.settings.suspicious-words-detector' , $data );
					break;				
					
			case "revenue":			
					return view('admin.settings.revenue' , $data );
					break;
			case "withdrawals":			
					return view('admin.settings.withdrawals' , $data );
					break;
			case "third-party-api":			
					return view('admin.settings.api-credentials' , $data );
					break;	

					
		
			default:
					return view('admin.settings.systems' , $data );
		}
		
	}
	
	/**
	*  Handle a settings request to the application.	
	*/
	
	public function postShow( Request $request, $formKey)
	{

		if( $request->input('submit') && in_array( $request->input('submit') , $this->validSettingsFormKey ) )
		{
			$input = $request->all() ;			
			foreach($input as $key=>$val)
			{
				if(in_array($key , $this->exceptKey )){
					continue;
				}
				else{
					$setting = Setting::where('config_key', '=', $key )->first(); 					
					$setting->config_value = $request->input($key);
					$setting->save();						
				}
			}
			$request->session()->flash('alert-success', 'Settings value has been saved successfully');
			return redirect()->back()->withInput();
		}
		else {
			$request->session()->flash('alert-danger', 'Invalid form name or post request !');
			return redirect()->back()->withInput();
		}

	}	
	
	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('admin.settings.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
