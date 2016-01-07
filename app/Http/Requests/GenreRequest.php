<?php namespace App\Http\Requests;

use App\Models\Genre;

class GenreRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */



	public function authorize()
	{
		//if(!parent::authorize()) return false;

		if($this->genre)
		{
			if($this->user()->isAdmin()) return true;

			return Genre::where('id', $this->genre)
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
		$id = $this->genre ? ',' . $this->genre : '';

		$getid=$this->id;
		$presentid=",".$getid;

		return [
			'name' => 'required|max:255',
			'slug' =>  'unique:project_genre,genre_slug'.$presentid 
		];
	}

}