<?php 
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Maidmedicaldesieses extends Model {
	 protected $primaryKey = 'maid_id';
	protected $table = 'maid_medical_desieses';
        protected $fillable  = ['maid_id','medical_desieses_id','description'];

	public function datainsert($maid_id,$data){
		print_r($data); exit;
	}
}