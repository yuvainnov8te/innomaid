<?php  
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_safety_agreement extends Model {
	
	protected $table = 'maid_app_safety_agreement';
        protected $fillable  = ['id','employer_maid_id','dwelling_type','clean_exterior_window','location_of_window','cleaning_grilles','adult_supervision','follow_advisory_checklist','employer_conditions','follow_employer_condition','fdw_conditions','native_language'];
		}