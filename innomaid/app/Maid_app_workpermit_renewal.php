<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_workpermit_renewal extends Model {
	
	protected $table = 'maid_app_workpermit_renewal';
        protected $fillable  = ['id','employer_maid_id','policy_number','expiry_date'];
		}
