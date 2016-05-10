<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Agencyservice extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'agency_service';
        protected $fillable  = ['id','title','price','agency_id','default_selected','type','mode','created_at','updated_at'];
}
