<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_authorisation_workpass extends Model {
	
	protected $table = 'maid_app_authorisation_workpass';
        protected $fillable  = ['id','employer_maid_id','is_agency_authorise_workpass','is_emplyer_authoise_form_submit','declaration_by_ea'];
		}