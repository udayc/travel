<?php namespace App\Http\Requests;

use App\Models\Project;

class ProjectFormRequest extends Request {

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
		/*(
		return [
			'name' 					=> 'required',
			'short_description' 	=> 'required|max:255',
			'funding_goal' 			=> 'required',			
			'funding_end_date' 		=> 'required'
		];
		*/
		return [];
	}
	
}