<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'pages';
        protected $fillable  = ['id','title','content','created_at','updated_at','is_published'];
}