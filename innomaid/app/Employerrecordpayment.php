<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Employerrecordpayment extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'emp_invoice_record_payment';
        protected $fillable  = ['id','invoice_id','amount_received','payment_date','payment_mode','	reference','note','created_at','updated_at'];
}