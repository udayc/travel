<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CashWithdrawalsRequest extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_cash_winthdrawals_request';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'status', 'project_fund_id' ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function user()
	{
		return $this->belongsTo('App\User' , 'user_id');
	}
	
	public function projectfund()
	{
		return $this->belongsTo('App\Models\ProjectFund' , 'project_fund_id');
	}	
	

}
