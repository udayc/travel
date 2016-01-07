<?php namespace App\Http\Controllers; 

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
Use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

use Illuminate\Http\Request; 
use Illuminate\Http\Response; 



class PageController extends Controller {


	public function __construct(Menu $menu , LaravelFacebookSdk $fb )
	{ 
  		$this->menuItems	= $menu->where('active' , '1')->orderBy('weight' , 'asc')->get();
		$this->login_url 	= $fb->getLoginUrl(['email']);			
  		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function getIndex($urlKey)
	{
		$page_details 	= 	Page::fetchByKey($urlKey);		
		return view('page.index' , ['page' => $page_details , '_menus' => $this->menuItems ,'login_url' => $this->login_url  ]);

	}

	
}
