<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Employerinvoice extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'maid_app_service_emp_invoice';
        protected $fillable  = ['id','employer_maid_id','invoice_number','invoice_date','due_date','created_at','updated_at'];
}