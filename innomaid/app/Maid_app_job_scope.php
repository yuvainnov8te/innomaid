<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Maid_app_job_scope extends Model {
	
	protected $table = 'maid_app_job_scope';
        protected $fillable  = ['id','employer_maid_id','adult','y_adult','l_child','m_child','babies','constant_care','domestic_duties','other_duty','place_of_work','no_rooms','other_work_place','bedrooms'];
} 