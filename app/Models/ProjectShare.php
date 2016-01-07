<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjectShare extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects_shares';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'project_id', 'view_count', 'like_count' , 'remind_me_count', 'number_of_share', 'share_in_media','ip' ];

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
