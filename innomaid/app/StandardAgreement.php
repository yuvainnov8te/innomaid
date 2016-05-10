<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class StandardAgreement extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'standard_agreement_forms';
        protected $fillable  = ['id','title','content','created_at','updated_at','visible','form_type'];
}