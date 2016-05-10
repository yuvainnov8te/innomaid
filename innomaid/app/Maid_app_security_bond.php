<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_security_bond extends Model {
	
	protected $table = 'maid_app_security_bond';
        protected $fillable  = ['id','employer_maid_id','date_of_bond'];
		}