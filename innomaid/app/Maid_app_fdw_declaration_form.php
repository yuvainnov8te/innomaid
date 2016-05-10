<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_fdw_declaration_form extends Model {
	
	protected $table = 'maid_app_fdw_declaration_form';
        protected $fillable  = ['id','employer_maid_id','item_name','description','amount'];
}