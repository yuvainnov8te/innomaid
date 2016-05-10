<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Educationlevels extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'education_levels';
        protected $fillable  = ['id','title','description'];
}
