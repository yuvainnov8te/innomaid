<?php  
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_giro_form extends Model {
	
	protected $table = 'maid_app_giro_form';
        protected $fillable  = ['id','employer_maid_id','bank_name','name_in_bank_acc','account_no','rejected_by','created_at','updated_at','other_rejected_by'];
		}