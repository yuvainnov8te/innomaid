<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Service_placement_fee_package extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'service_placement_fee_package';
        protected $fillable  = ['package_name','package_description','created_at','updated_at','agency_id'];
}
