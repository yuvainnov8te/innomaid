<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Employmenthistroryworkarea extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'maid_employment_history_work_area';
        protected $fillable  = ['maid_id','	work_area_id','employment_history_id','checkrow'];
}
