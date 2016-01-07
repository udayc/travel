<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Profile extends Model {

	//
	protected $table = 'profiles';
	protected $fillable = ['f_name' , 'U_ID'];
	 
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	 
 	public function country()
	{
		return $this->belongsTo('App\Models\Country');
	}
 
 
  	public function city()
	{
		return $this->belongsTo('App\Models\City' , 'cityID');
	}
 
	public function cityById($cityId)
	{
		if(!empty($cityId) && $cityId > 0 ) {
		$query = DB::table('im_cities')->where('cityID', '=', $cityId)->first();		
		return $query->cityName;
		} else { return Null ; }
	}
	
  	public function education()
	{
		return $this->belongsTo('App\Models\Education' , 'education');
	}	
	
  	public function incomeRange()
	{
		return $this->belongsTo('App\Models\IncomeRange' , 'income_range');
	}	

  	public function employmentStatus()
	{
		return $this->belongsTo('App\Models\EmploymentStatus' , 'employment_status');
	}	
	
  	public function relationshipStatus()
	{
		return $this->belongsTo('App\Models\RelationshipStatus' , 'relationship_status');
	}		
 
}
