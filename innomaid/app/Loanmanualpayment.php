<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Loanmanualpayment extends Model{
	
	protected $table = 'maid_app_loan_manual_payment';
        protected $fillable  = ['id','employer_maid_id','dates','loan_amount','payment'];
} 