<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Medicaldesieses extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'medical_desieses';
        protected $fillable  = ['id','title','description'];
}