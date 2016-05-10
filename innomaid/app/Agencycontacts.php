<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Agencycontacts extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'agency_contacts';
        protected $fillable  = ['id','agency_id','contact_name','contact_number'];
}