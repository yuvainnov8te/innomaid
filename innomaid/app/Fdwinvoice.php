<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Fdwinvoice extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'maid_app_service_fdw_invoice';
        protected $fillable  = ['id','employer_maid_id','invoice_number','created_at','updated_at'];
}