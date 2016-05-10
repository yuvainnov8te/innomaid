<?php
 /***********************************************
	 Developed by :- Poonam Chandak
	 Module       :- Package
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Service_placement_fee_package as Service_placement_fee_package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller {

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

			$packageList = DB::table('service_placement_fee_package as p')
                ->select("p.*")
		->where('agency_id','=',$user_id)
               	->orderBy("p.updated_at", "DESC")
               	->paginate(10);
		

		return view('sentinel.packages.index')->with('packageList', $packageList);
	}

	/**
	 * Function is used for image upload
	 * @return image name
	 */
	public function upload(){
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('sentinel.packages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
	
		// validation rules
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
		);
		$validator = Validator::make($request->all(), [
           		'package_name' => 'required|min:3|max:100',
				'package_description' => 'required',
        	],$messages);

        if ($validator->fails()) {
            return redirect("package/create")
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
	$data['agency_id']=$user_id;
        $package = Service_placement_fee_package::create($data);
		$insertedId = $package->id;

		\Session::flash('success', 'Package is saved.');
		
		return redirect("package/");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$package = Service_placement_fee_package::findOrFail($id);		
		return view('sentinel.packages.edit')->with('package',$package);
	}

	/**
	 * Update the tab0.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;

		if(!(Input::get('is_published')))
		{
			$data['is_published']='';
		}
		$data['agency_id']=$user_id;
		// validation rules
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
		);
		$validator = Validator::make($request->all(), [
           		'package_name' => 'required|min:3|max:100',
			'package_description' => 'max:200',
        	],$messages);

        if ($validator->fails()) {
            return redirect("package/".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
        $package = Service_placement_fee_package::findOrFail($id);
		$package->update($data);

		\Session::flash('success', 'Page has been Updated.');
		
		return redirect("package/");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function delete($id) {
	 $package = Service_placement_fee_package::findOrFail($id);		
	// $package= DB::table('service_placement_fee_package')->where('id', '=', $id)->get();
	DB::table('agency_maid_service')->where('package_name', '=', $package->package_name)->delete();
	DB::table('agency_service_package')->where('package_id', '=', $id)->delete(); 
	DB::table('service_placement_fee_package')->where('id', '=', $id)->delete(); 
        \Session::flash('success', 'Package deleted successfully.');
        return redirect("package/");
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

	}

	
}
