<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Agencies extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'agencies';
        protected $fillable  = ['id','email','company_name','license_no','address','area','telephone','fax','website','insurance_company','operating_days','operating_hrs_from','operating_hrs_to','operating_hrs','other_information','activated','remember_token','created_at','updated_at','image'];
}