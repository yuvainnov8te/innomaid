<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model {
	 //protected $primaryKey = 'fdw_id';
	protected $table = 'countries';
        protected $fillable  = ['id','name','nationality','code','display_in_fdw'];
}
