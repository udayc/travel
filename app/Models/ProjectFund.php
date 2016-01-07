<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProjectFund extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_funds';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['P_ID', 'U_ID', 'paid_amount', 'amount_to_project_owner' , 'site_commission',  'status' ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function user()
	{
		return $this->belongsTo('App\User' , 'U_ID');
	}
	
	public function project()
	{
		return $this->belongsTo('App\Models\Project' , 'P_ID');
	}	
	

}
