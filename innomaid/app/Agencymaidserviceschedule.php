<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Agencymaidserviceschedule extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'agency_maid_service_schedule';
        protected $fillable  = ['service_schedule_id','employer_maid_id','agency_id','form_type','month','date','deposite','final_payment','payment_placement_fee','placement_fee_service_charge','placement_fee_personal_loan','upfront_month','upfront_fee','placement_full_sum','placement_other','created_at','updated_at','service_fee'];
}
