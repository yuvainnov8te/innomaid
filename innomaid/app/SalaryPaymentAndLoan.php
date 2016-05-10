<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class SalaryPaymentAndLoan extends Model{
	
	protected $table = 'maid_app_payment_and_loan';
        protected $fillable  = ['id','employer_maid_id','date_of_commencement','contract_period','payment_arrangement','loan_amount','loan_repayment_start_date','loan_period','deduction_arrangement','leave_on_offday','probation_period'];
} 