<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_application extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'maid_application';
        protected $fillable  = ['id','employer_id','type','maid_id','maid_app_reference_number','maid_reference_code','user_agents_id','maid_json_data','employer_json_data','created_at','updated_at','status','previous_loan','carry_forward_loan','replaced_at'];
}
