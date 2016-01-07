<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ReciverAccount extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'receiver_account';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'receiver_email', 'secret_key', 'public_key' ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	

	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	

}
