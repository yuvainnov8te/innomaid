<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Fdw extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'maid_personal_details';
        protected $fillable  = ['id','users_agents_id','name','date_of_birth','place_of_birth','height','weight','nationality','address','port_name','contact_number','passport_number','work_permit_no','maid_reference_code','religion','education_level','other_education','availability','expected_salary','no_of_siblings','marital_status','no_of_children','children_age','image','profile_image','profile_document','video_link','allergies','allergy_description','physical_disablity','physical_disability_description','dietary_restrictions','dietary_restrictions_description','food_handling_prefrences','food_handling_preference_other','rest_days_preference','medication_remarks','interviewed_by','interview_method','overall_remarks','can_be_interviewed_via','type','created_at','updated_at','deleted','intro','note_for_maid','display_biodata','training_center','audited_by_EA'];
}
