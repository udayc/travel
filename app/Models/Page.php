<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Page extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'slug', 'content', 'active' ];

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
	public function menu()
	{
		return $this->belongsTo('App\Models\Menu');
	}	
	
	
	
	
	
	public static function fetchByKey($key = Null) {    
        return Page::where('slug' , $key)->first();	;
    }	
	

}
