<?php namespace App\Services;

use App\User;
use App\Profile;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Illuminate\Http\Request;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	 public function create(array $data)
	{
		/* $user = User::create([
			'name' 				=> $data['name'],						
			'type' 				=> 'general',
			'username' 			=> $data['username'],
			'email' 			=> $data['email'],
			'password' 			=> bcrypt($data['password']),
		]);
		
		/*
		$lastInsertedId= $user->id; 
		$profile = new Profile(array(
					'f_name' => $data['name'],
				));
                
        $profile = $user->profile()->save($profile);
			$user_obj = \App\User::where('email', $data['email'])->first();	
			$profile = new App\Profile();
			$profile->user_id = $user_obj->id;			
			$profile->save();			
		
		
		*/
		
		//dd($data);
		
		//$user = new user;
		
		//$user->fill($request->only(['username', 'name', 'email']));
		//$user->password = \Hash::make($request->get('password'));
		
		return $user ;
		
	}

}
