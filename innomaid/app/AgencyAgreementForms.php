<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class AgencyAgreementForms extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'agency_agreement_forms';
        protected $fillable  = ['id','form_id','agency_id','title','form_type','content','created_at','updated_at'];
} 