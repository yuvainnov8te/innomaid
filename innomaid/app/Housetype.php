<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Housetype extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'house_type';
        protected $fillable  = ['id','title','description','created_at','updated_at','deleted'];
}