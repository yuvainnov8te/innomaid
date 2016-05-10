<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_employer_tax_declaration extends Model {
	
	protected $table = 'maid_app_employer_tax_declaration';
        protected $fillable  = ['id','employer_maid_id','combined_income','employer_assessment_no','spouse_assessment_no'];
		}