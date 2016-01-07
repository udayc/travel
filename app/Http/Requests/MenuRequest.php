<?php namespace App\Http\Requests;

use App\Models\Menu;

class MenuRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */

 


	public function authorize()
	{
		//if(!parent::authorize()) return false;

		if($this->menu)
		{
			if($this->user()->isAdmin()) return true;

			return Menu::where('id', $this->menu)
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
		$id = $this->menu ? ',' . $this->id : '';

		$getid=$this->id;
		$presentid=",".$getid;

		return [
			'name' => 'required|max:255', 
			'slug' =>  'unique:menus,menu_slug'.$presentid
		];
	}

}

