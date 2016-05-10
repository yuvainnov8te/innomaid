<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Workarea extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'work_area';
        protected $fillable  = ['id','title','description'];
}