<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LogActivity extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'site_activities';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'message', 'hostname', 'timestamp' , 'action' ];

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
