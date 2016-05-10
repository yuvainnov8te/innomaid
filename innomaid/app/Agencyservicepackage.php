<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Agencyservicepackage extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'agency_service_package';
        protected $fillable  = ['id','service_id','package_id','package_price','created_at','updated_at'];
}