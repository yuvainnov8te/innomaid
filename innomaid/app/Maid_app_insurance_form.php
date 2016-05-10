<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_insurance_form extends Model {
	
	protected $table = 'maid_app_insurance_form';
        protected $fillable  = ['id','employer_maid_id','start_date','end_date','insurance_company_name','effective_date','period_of_insurance','embassy_bond','premium','plan','reimbursement','coverage_selection','plan_term','SB_transmission_number','plan_renewal'];
		}
