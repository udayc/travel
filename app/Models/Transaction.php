<?php namespace App\Models;



use Illuminate\Database\Eloquent\Model;


class Transaction extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transactions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['transaction_id', 'message', 'user_id', 'credit' , 'debit', 'status'];

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
