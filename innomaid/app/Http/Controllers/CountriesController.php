<?php
 /***********************************************
	 Developed by :- Poonam Chandak
	 Module       :- Agreement Form
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Countries as Countries;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller {

	public function __construct()
	{	
		$this->middleware('auth');
	}

	 public function show($id,$ispdf = false) {

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
			$countries=DB::table('countries as c')
				->select("c.*")
               	->orderBy("c.name", "ASC")
               	->paginate(10);
			
				
		//echo "<pre>";	print_r($standardformList); exit;
		return view('sentinel.countries.index')->with('countries', $countries);


}
}
