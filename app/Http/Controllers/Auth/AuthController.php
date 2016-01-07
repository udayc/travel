<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use App\Profile;
Use App\Models\Menu ;
use Event; 
use App\Events\Activity ; 
use Validator ; 
use Mail;
Use Debugbar;
use App\Http\Controllers\Auth;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
	protected $redirectAfterLogout = '/auth/login';
	protected $redirectPath = '/home/dashboard';
	
	
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar ,  Menu $menu)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		$this->menuItems = $menu->where('active' , '1')->orderBy('weight' , 'asc')->get();
		$this->middleware('guest', ['except' => 'getLogout']);
	}
	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('auth.login');
	}

	
	

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'status' => 1], $request->has('remember')))
		{
			if($this->auth->user()->type == '1')
			{
				$logMsg = 'admin login  at ' . date("Y-m-d H:i:s");
				Event::fire( 'activity.log' , new Activity($request , [ 'user_id' => $this->auth->user()->id , 'user_type' => $this->auth->user()->type, 'action' => 'agent-login' , 'msg'=> $logMsg] ));
				
				return redirect()->intended( '/admin/dashboard' );
			}
			if($this->auth->user()->type == '2')
			{	
				$logMsg = 'agent#'.$this->auth->user()->name . ' login  at ' . date("Y-m-d H:i:s");
				Event::fire( 'activity.log' , new Activity($request , [ 'user_id' => $this->auth->user()->id , 'user_type' => $this->auth->user()->type, 'action' => 'agent-login' , 'msg'=> $logMsg] ));
				
				return redirect()->intended( '/agent/dashboard' );
			}
			else
			{

					if($this->auth->user()->status == 1)
					{
						
						$logMsg = 'user#'.$this->auth->user()->name . ' login  at ' . date("Y-m-d H:i:s");
						
				        Event::fire( 'activity.log' , new Activity($request , [ 'user_id' => $this->auth->user()->id , 'user_type' => $this->auth->user()->type, 'action' => 'agent-login' , 'msg'=> $logMsg] ));
						return redirect()->intended($this->redirectPath());
					}
			}			
			
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}	
	
	
	
	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();
		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}


}
