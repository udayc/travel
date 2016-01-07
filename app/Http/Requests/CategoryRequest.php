<?php namespace App\Http\Requests;

use App\Models\Category;

class CategoryRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */



	public function authorize()
	{
		//if(!parent::authorize()) return false;

		if($this->category)
		{
			if($this->user()->isAdmin()) return true;

			return Category::where('id', $this->category)
					   ->where('user_id', $this->user()->id)->exists();
		}

		return true;
	}



	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */

	public function rules()
	{
		$id = $this->category ? ',' . $this->category : '';
		
		$getid=$this->id;
		$presentid=",".$getid;


		return [
			'name' => 'required|max:255',
			'slug' =>  'unique:project_categories,category_slug'.$presentid 
		];
	}

}