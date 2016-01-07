<?php namespace App\Http\Requests;

use App\Models\Banner;

class BannerRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */



	public function authorize()
	{
		//if(!parent::authorize()) return false;

		if($this->banner)
		{
			if($this->user()->isAdmin()) return true;

			return Banner::where('id', $this->banner)
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
		$id = $this->banner ? ',' . $this->banner : '';
		return [
			'banner_title' => 'required|max:255' 
		];
	}

}