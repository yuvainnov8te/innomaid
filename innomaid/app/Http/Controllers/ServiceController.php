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
use App\Agencyservicepackage as Agencyservicepackage;
use App\Service_placement_fee_package as Service_placement_fee_package;
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
	$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;

			$packageList = DB::table('service_placement_fee_package as p')
                ->select("p.*")
		->where('agency_id','=',$user_id)
               	->orderBy("p.updated_at", "DESC")
               	->paginate(10);
		

		return view('sentinel.service.create')->with('packageList', $packageList);
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
		if(isset($data['package_price'])){
		if(array_sum($data['package_price'])==0)
		{
		unset($data['package_price']);
		}}
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
			'empty_with' => 'You have to fill in one of the fields, but not both',
		);
		if(isset($data["according_package"])==1){
		$validator = Validator::make($data , [
           		'title' =>'required|min:3|max:100|unique:agency_service,title,null,id,agency_id,'.$user_id.',mode,'.$data['mode'],
				'price' => 'float_integer|max:20',
				'package_price' => 'required',
				'type' => 'required',
        	],$messages); 
			$data['price']="";
		}
		else{ 
		$validator = Validator::make($data , [
           		'title' =>'required|min:3|max:100|unique:agency_service,title,null,id,agency_id,'.$user_id.',mode,'.$data['mode'],
				'price' => 'required|float_integer|max:20',
				'type' => 'required',
        	],$messages); }
		
        if ($validator->fails()) {
            return redirect("service/create?mode=".$data['mode'])
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['agency_id'] = $user_id;
        // validation rule complete
		
        $service = Agencyservice::create($data);
		$insertedId = $service->id; print_r($insertedId);
		if(isset($data["according_package"])==1){
		$package_id=$data['package_id'];
		$count =count($package_id);	
		for($i=0;$i<$count;$i++)
		{//echo $count ;exit;
		
		$datas['service_id']=$insertedId;
		$datas['package_id']=$data['package_id'][$i];
		//print_r( $datas['dates']); 
		$datas['package_price']=$data['package_price'][$i];
		if($datas['package_price']!="")
		$package = Agencyservicepackage::create($datas);
		} }
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
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		$service = Agencyservice::findOrFail($id);		
		$packageList = DB::table('agency_service_package as p')
				->leftJoin("service_placement_fee_package as sp" , "sp.id",'=','p.package_id')
				->select("p.*","sp.package_name")
				->where("service_id",'=',$id)
               	->orderBy("p.updated_at", "DESC")
               	->paginate(10);
		$standardpackage= DB::table('service_placement_fee_package as sp')
				->leftJoin('agency_service_package as p' , function($join) use($id) {
					$join->on("sp.id",'=','p.package_id');
					$join->on('p.service_id', '=',DB::raw("'".$id."'"));
				})
				->where('p.package_id','=',NULL)
				->select("sp.*")
				->where('sp.agency_id','=',$user_id)
				->orderBy("sp.updated_at", "DESC")
               	->paginate(10); 
					//echo "<pre>";
					//print_r($packageList);
					//print_r($standardpackage);
					//exit;
		return view('sentinel.service.edit')->with('service',$service)->with('packageList', $packageList)->with('standardpackage', $standardpackage);
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
	
		if(!(isset($data['default_selected']))){ $data['default_selected']='N';}	
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
    		'price.required_if' => 'Please enter service fee.',
    		'type.required' => 'Please select service type.',
    		'float_integer' => 'Please enter valid fee.',
			"package_price.required_if" => " Package price is required ",
			'empty_with' => 'You have to fill in one of the fields, but not both',
		);
		if(isset($data["according_package"])==1){
		$validator = Validator::make($data , [
           		'title' => 'required|min:3|max:100|unique:agency_service,title,'.$id.',id,agency_id,'.$user_id.',mode,'.$data['mode'],
				'price' => 'float_integer|max:20',
				'package_price' => 'required',
				'type' => 'required',
        	],$messages); 
			$data['price']="";
		}
		else{ 
		$validator = Validator::make($data , [
           		'title' => 'required|min:3|max:100|unique:agency_service,title,'.$id.',id,agency_id,'.$user_id.',mode,'.$data['mode'],
				'price' => 'required|float_integer|max:20',
				'type' => 'required',
        	],$messages); }
	if ($validator->fails()) {
            return redirect("service/".$id."/edit?mode=".$data['mode'])
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
        $pages = Agencyservice::findOrFail($id);
		 $service = $pages->update($data); 
		 $insertedId = $pages->id;
		$package = Agencyservicepackage::where('service_id','=', $insertedId)->first();
		if($package){ 
		 DB::table('agency_service_package')
            ->where('service_id','=', $insertedId)->delete(); 
		
		} 
		if(isset($data["according_package"])==1){
		$package_id=$data['package_id'];
		$count =count($package_id);	
		for($i=0;$i<$count;$i++)
		{//echo $count ;exit;
		
		$datas['service_id']=$insertedId;
		$datas['package_id']=$data['package_id'][$i];
		//print_r( $datas['dates']); 
		$datas['package_price']=$data['package_price'][$i]; 
		if($datas['package_price']!=""&& $datas['package_id']!="")
		$package = Agencyservicepackage::create($datas);
		} 
		}
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
	 	$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
	 	DB::table('agency_service_package')
            ->where('service_id', $id)
            ->delete();

	 	DB::table('agency_service')
            ->where('id','=', $id)
            ->delete();
       // $del = Fdw::find($id);
        //$del->delete();
		\Session::flash('success', 'Service has been deleted.');
		return redirect("service/?mode=".$_REQUEST['mode']);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

	}
    public function serviceinfo() { 
	$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		$service_id   = Input::get('service_id');
		//echo $service_id;
		$packageList = DB::table('agency_service_package as p')
				->leftJoin("service_placement_fee_package as sp" , "sp.id",'=','p.package_id')
				->where('sp.agency_id','=',$user_id)
				->select("p.package_price","sp.package_name")
				->where("service_id",'=',$service_id)
               	->orderBy("p.updated_at", "DESC")
               	->get();
		//$json=json_encode($packageList);
		return $packageList;
	}
	public function packagedetail()
	{
	$id=Input::get('id');

	$packageList = DB::table('agency_service_package as p')
					->leftJoin("service_placement_fee_package as sp" , "sp.id",'=','p.package_id')
					->select("p.*","sp.package_name")
					->where("service_id",'=',$id)
		       	->orderBy("p.updated_at", "DESC")
		       	->paginate(10);
	return view('sentinel.service.package_detail')->with('packageList',$packageList);
	}
	
	
}
