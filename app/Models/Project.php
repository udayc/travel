<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Project extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	//public $timestamps = false;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
 
	protected $fillable = ['name', 'P_CAT_ID', 'project_genre_id' , 'short_description' , 'payment_method','funding_goal' , 'allow_overfunding' , 'project_duration' ,'twitter_url', 'facebook_url', 'instagram_url' , 'youtube_url' ,'soundcloud_url'  ];
 

	
	public function setCreatedAt($value)
	{
		return null;
	}

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
	
	public function category()
	{
		return $this->belongsTo('App\Models\Category', 'P_CAT_ID');
	}
	
	public function country()
	{
		return $this->belongsTo('App\Models\Country' ,'country_id');
	}

	public function genre()
	{
		return $this->belongsTo('App\Models\Genre', 'project_genre_id');
	}
	
	public function projectfund()
	{
		return $this->hasMany('App\Models\ProjectFund' , 'P_ID');
	}	
	public function projectshare()
	{
		return $this->hasMany('App\Models\ProjectShare' , 'project_id');
	}	

	public function cityById($cityId) 
	{ 
		if(!empty($cityId) && $cityId > 0 ) { $query = DB::table('IM_cities')->where('cityID', '=', $cityId)->first(); return $query->cityName; } else { return Null ; } 
	} 

	public function siteactivity()
	{
		return $this->hasMany('App\Models\SiteActivity' , 'project_id');
	}
	
	
}
