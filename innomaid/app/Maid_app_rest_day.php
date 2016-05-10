<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_rest_day extends Model {
	
	protected $table = 'maid_app_rest_day';
        protected $fillable  = ['id','employer_maid_id','rest_days','rest_of_week','no_of_restday','rest_of_month','compensation'];
} 