<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'employer_personal_details';
        protected $fillable  = ['id','marital_status','employer_name','name_title','spouse_name','employer_date_of_birth','spouse_date_of_birth','employer_nric_no','spouse_nric_no','employer_passport','spouse_passport','employer_residential_status','spouse_residential_status','employer_profession','spouse_profession','employer_company','spouse_company','employer_office_phone','spouse_office_phone','employer_mobile_phone','spouse_mobile_phone','address','home_phone','purpose_to_hire','purpose_to_hire_work_permit_no','is_income_tax_libal','job_title','start_date','monthly_income','is_employer_permanent_resident','is_house_hold_income','annual_house_hold_income','is_iras_notice','users_agents_id','created_at','updated_at','deleted','employer_passport_expiry_date','spouse_passport_expiry_date'];
}
