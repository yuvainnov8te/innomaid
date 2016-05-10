<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Requestmaid extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'request_maid';
        protected $fillable  = ['id','name','email','telephone','request_detail','created_at','updated_at','deleted'];
}