<?php namespace App\Http\Requests;

use App\Models\User;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;

	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		
		return [
			'name' 			=> 'required|max:255',
			'username' 		=> 'required|max:255',
			'email' 		=> 'required|unique:users|max:255',			
			'password' 		=> 'required|max:10'
		];
	}

}