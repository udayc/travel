<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RewardsLogDuringPayment extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rewards_log_during_payment';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['array_obj'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	/*
	protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->remote_addr = \Request::getClientIp();
        });
    }	
	*/
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	public function project()
	{
		return $this->belongsTo('App\Models\Project');
	}	
	

}
