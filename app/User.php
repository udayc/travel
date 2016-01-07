<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword ;
	/** SyncableGraphNodeTrait */
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['name', 'type', 'username', 'email', /*'password' */];
	protected $guarded = ['id'];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	
	protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->remote_addr = \Request::getClientIp();
        });
    }	
	
	
	public function profile()
	{
		return $this->hasOne('App\Profile' , 'user_id');
	}
	
	
	public function project()
	{
		return $this->hasMany('App\Models\Project' ,  'user_id');
	}
	
	public function projectfund()
	{
		return $this->hasMany('App\Models\ProjectFund' , 'U_ID');
	}	
	
	public function siteactivity()
	{
		return $this->hasMany('App\Models\SiteActivity' , 'user_id');
	}	
	

	
	
	
	public static function registrationValidation()
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}
	
	
	
	
	

}
