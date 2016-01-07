<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdates extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_updates';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'title' , 'description' , 'tags' , 'user_id', 'project_id', 'status' ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	public function project()
	{
		return $this->belongsTo('App\Models\Project' , 'project_id');
	}	
	

}
