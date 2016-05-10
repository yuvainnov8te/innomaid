<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_fdw_work_permit extends Model {
	
	protected $table = 'maid_app_fdw_work_permit';
        protected $fillable  = ['id','employer_maid_id','sponsor_name_1','sponsor_name_2','gender_1','gender_2','dob_1','dob_2','nationality_1','nationality_2','marital_status_1','marital_status_2','relation_with_1','relation_with_2','residential_status_1','residential_status_2','other_residential_status_1','other_residential_status_2','passport_number_1','passport_number_2','occupation_1','occupation_2','company_name_1','company_name_2','contact_number_1','contact_number_2','email_address_1','email_address_2','address_difference_1','address_difference_2','sponsor_spouse_name_1','sponsor_spouse_name_2','passport_spouse_number_1','passport_spouse_number_2'];
		}