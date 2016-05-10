<?php
 /***********************************************
	 Developed by :- Harendar singh tomar
	 Module       :- Page
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Agencyservice as Agencyservice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller {

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
	public function index(Request $request) {
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		
		if(Auth::user()->hasRole(['admin'])){
			$serviceList = DB::table('agency_service as as')
                ->select("as.*","u.email","u.company_name as username")
                ->leftJoin('users as u', 'u.id', '=', 'as.agency_id')
                ->where('mode','=',$_REQUEST['mode'])
               	->orderBy("as.updated_at", "DESC")
               	->paginate(10);
		}else{
			$serviceList = DB::table('agency_service as as')
                ->select("as.*","u.email","u.company_name as username")
                ->leftJoin('users as u', 'u.id', '=', 'as.agency_id')
                ->where('mode','=',$_REQUEST['mode'])
                ->where('as.agency_id','=',$user_id)
               	->orderBy("as.updated_at", "DESC")
               	->paginate(10);
		}
		if($request->ajax()){
			return $serviceList;
		}else{
			return view('sentinel.service.index')->with('serviceList', $serviceList);
		}
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
		return view('sentinel.service.create');
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
		Validator::extend('float_integer', function($attribute, $value)
			{
			    return preg_match('/^(\d+(.\d+)?$)/', $value);
			});
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'price.required' => 'Please enter service fee.',
    		'type.required' => 'Please select service type.',
    		'float_integer' => 'Please enter fee in numeric.',
		);
		$validator = Validator::make($request->all(), [
           		'title' => 'required|min:3|max:100|unique:agency_service,title,null,id,agency_id,'.$user_id.',mode,'.$data['mode'],
				'price' => 'required|float_integer|max:20',
				'type' => 'required',
        	],$messages);

        if ($validator->fails()) {
            return redirect("service/create?mode=".$data['mode'])
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['agency_id'] = $user_id;
        // validation rule complete
        $service = Agencyservice::create($data);
		$insertedId = $service->id;

		\Session::flash('success', 'Service is saved.');
		
		return redirect("service/?mode=".$data['mode']);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$service = Agencyservice::findOrFail($id);		
		return view('sentinel.service.edit')->with('service',$service);
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
		// validation rules
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		Validator::extend('float_integer', function($attribute, $value)
			{
			    return preg_match('/^(\d+(.\d+)?$)/', $value);
			});
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'price.required' => 'Please enter service fee.',
    		'type.required' => 'Please select service type.',
    		'float_integer' => 'Please enter valid fee.',
		);
		$validator = Validator::make($request->all(), [
           		'title' => 'required|min:3|max:100|unique:agency_service,title,'.$id.',id,agency_id,'.$user_id.',mode,'.$data['mode'],
				'price' => 'required|float_integer|max:20',
				'type' => 'required',
        	],$messages);

        if ($validator->fails()) {
            return redirect("service/".$id."/edit?mode=".$data['mode'])
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
        $pages = Agencyservice::findOrFail($id);
		$pages->update($data);

		\Session::flash('success', 'Service has been Updated.');
		
		return redirect("service/?mode=".$data['mode']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function delete($id) {
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