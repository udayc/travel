<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model  {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_comments';
	
	protected $fillable = ['comment'];
	
	protected $hidden = ['status', 'updated_at'];
	
	public function project(){
		return $this->belongsTo('\App\Models\Project', 'project_id');
	}
	
	public function user(){
		return $this->belongsTo('\App\Models\User', 'user_id');
	}
}
