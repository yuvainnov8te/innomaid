<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_handling_takeover extends Model {
	
	protected $table = 'maid_app_handling_takeover';
        protected $fillable  = ['id','employer_maid_id','application_of_wp','approval_of_wp','submission_of_bg','eta_of_fdw','medical_checkup','thumb_printing','collection_of_document','employment_contract_fdw','fdw_passport','work_permit','fdw_handy_guide','medical_report_fdw','service_contract','employment_contract_employer','b_guarantee','insurance','medical_report_employer'];
} 