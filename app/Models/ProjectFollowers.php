<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjectFollowers extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_followers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'project_id', 'ip' ];

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
