<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Reward extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_backer_rewards';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['pledge_amount', 'short_note', 'estimated_delivery', 'shipping_details' , 'user_limit', 'P_ID', 'active' ];

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
	

}
