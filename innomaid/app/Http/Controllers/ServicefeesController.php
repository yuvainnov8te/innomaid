<?php
/*
Name : Harendar singh
Module : Service & fees schedule
Date : 12 oct 2015
*/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Agencyservice as Agencyservice;
use App\Agencymaidserviceschedule as Agencymaidserviceschedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;

class ServicefeesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	 public function show($id,$ispdf = false) {
	 	$servicefees = DB::table('agency_maid_service_schedule as amss')
						->select("amss.*")	
						->where('amss.id', '=', $id)->get();

		$agencymaidservice = DB::table('agency_maid_service as ams')
						->leftJoin('agency_service as ags', 'ags.id', '=', 'ams.service_id')
						->select("ags.title","ags.type","ams.service_cost")	
						->where('ams.service_schedule_id', '=', $id)->get();

		$agencyotherservice = DB::table('agency_maid_other_service as amos')
						->select("amos.other_service_title","amos.other_service_price","amos.service_schedule_id","amos.id")	
						->where('amos.service_schedule_id', '=', $id)->get();	

		$replacementcost = DB::table('service_schedule_replacement_cost as ssrc')
						->select("ssrc.replacement_month","ssrc.replacement_number","ssrc.cost","ssrc.service_schedule_id","ssrc.id")	
						->where('ssrc.service_schedule_id', '=', $id)->get();

		$maid_details = DB::table('maid_personal_details as mpd')
						->leftJoin('countries as c', 'c.id', '=', 'mpd.nationality')
						->select("mpd.maid_reference_code","mpd.name","c.nationality")
						->where('mpd.id', '=', $servicefees[0]->maid_id)
						->get();
		$placement_fee_schedule = DB::table('service_schedule_placement_cost as sspc')
						->select("sspc.post_dated_cheque_number","sspc.post_dated_cheque_cost","sspc.id","sspc.service_schedule_id")
						->where('sspc.service_schedule_id', '=', $id)
						->get();

		$agency_detail = DB::table('users as u')
						->select("u.company_name","u.license_no")
						->where('u.id', '=', $servicefees[0]->agency_id)
						->get();										
		//echo $servicefees[0]->agency_id; exit;
		$pdf = PDF::loadView('sentinel.servicefees.pdf',array('servicefees' => $servicefees,'agencymaidservice' => $agencymaidservice,'agencyotherservice'=>$agencyotherservice,'replacementcost'=>$replacementcost,'maid_details'=>$maid_details,'placement_fee_schedule'=>$placement_fee_schedule,'agency_detail'=>$agency_detail));
		return $pdf->download($servicefees[0]->id.'_'.date('Y_m_d').'.pdf');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		
		if(Auth::user()->hasRole(['admin'])){
			$servicefees = DB::table('agency_maid_service_schedule as amss')
				->leftJoin('users as u', 'u.id', '=', 'amss.agency_id')
				->leftjoin('agency_service', 'agency_service.id', '=', 'amss.id')
				->leftjoin('agency_maid_service as ams', 'ams.service_schedule_id', '=', 'amss.id')
				->leftjoin('maid_personal_details as mpd', 'mpd.id', '=', 'amss.maid_id')
                ->select(DB::Raw("GROUP_CONCAT(DISTINCT (agency_service.title) SEPARATOR ',') as title"),'mpd.name',DB::raw('sum(ams.service_cost) AS service_cost'),'amss.*',"u.username","u.email")
                ->where('amss.deleted','=','N')
                ->groupBy('amss.id') 
               	->orderBy("amss.updated_at", "DESC")->paginate(10);
        }
        else{
        	$servicefees = DB::table('agency_maid_service_schedule as amss')
				->leftjoin('agency_service', 'agency_service.id', '=', 'amss.id')
				->leftjoin('agency_maid_service as ams', 'ams.service_schedule_id', '=', 'amss.id')
				->leftjoin('maid_personal_details as mpd', 'mpd.id', '=', 'amss.maid_id')
                ->select(DB::Raw("GROUP_CONCAT(DISTINCT (agency_service.title) SEPARATOR ',') as title"),'mpd.name',DB::raw('sum(ams.service_cost) AS service_cost'),'amss.*')
                ->where('amss.deleted','=','N')
                ->where('amss.agency_id','=',$user_id)
                ->groupBy('amss.id') 
               	->orderBy("amss.updated_at", "DESC")->paginate(10);
        }
		
		return view('sentinel.servicefees.index')->with('servicefees', $servicefees);
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
		$agencyservice = DB::table('agency_service as ags')
						->select("ags.*")
						->where('ags.agency_id','=',$user_id)
						->get();
		return view('sentinel.servicefees.create',array('agencyservice' => $agencyservice));
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
    		'float_integer' => 'Please enter valid income.',
    		'maid_id.required' => 'Please enter valid reference code.',
    		'service_id.required' => 'Please select service.',
		);

		$validator = Validator::make($request->all(), [
           		'form_type' => 'required',
				'maid_reference_code' => 'required',
				'service_id' => 'required',
        	],$messages);

		$validator->sometimes('maid_id', 'required', function($input) {
    		return $input->maid_reference_code != '';
		});

        if ($validator->fails()) {
            return redirect("servicefees/create")
                        ->withErrors($validator)
                        ->withInput();
        }
        /// validation complete
        //echo '<pre>'; print_r($data); exit;
        $data['agency_id'] = $user_id;
        $data['date']= date('Y-m-d');
        $service = Agencymaidserviceschedule::create($data);
		$insertedId = $service->id;
		// Insert servicefees data
		if(Input::get('service_id'))
			{
				$servicerowcount = count($data['service_id']);
					for ($i=0; $i < $servicerowcount; $i++) {
						if($data['service_id'][$i] !=''){
							DB::insert('insert into agency_maid_service (service_schedule_id, maid_id, service_id, service_cost) values (?, ?, ?, ?)', [$insertedId, $data['maid_id'],$data['service_id'][$i],$data['price'][$data['service_id'][$i]-1]]);
						}
				}	
					
			}
			if(Input::get('other_service_title'))
			{
				$othservicerowcount = count($data['other_service_title']);
					for ($i=0; $i < $othservicerowcount; $i++) {
						if($data['other_service_title'][$i] !=''){
							DB::insert('insert into agency_maid_other_service (service_schedule_id, other_service_title, other_service_price) values (?, ?, ?)', [$insertedId, $data['other_service_title'][$i],$data['other_service_price'][$i]]);
						}
				}	
					
			}
			if(Input::get('replacement_month'))
			{
				$monthrowcount = count($data['replacement_month']);
					for ($i=0; $i < $monthrowcount; $i++) {
						if($data['replacement_month'][$i] !='' && $data['form_type'] == 'New Transfer'){
							DB::insert('insert into service_schedule_replacement_cost (service_schedule_id,maid_id, replacement_number, replacement_month, cost) values (?, ?, ?, ?, ?)', [$insertedId, $data['maid_id'], $data['replacement_number'][$i], $data['replacement_month'][$i],$data['cost'][$i]]);
						}
				}	
					
			}
			if(Input::get('payment_placement_fee') == 'Upfront Placement Fee')
			{
				if(Input::get('post_dated_cheque_number'))
				{
					$chequerowcount = count($data['post_dated_cheque_number']);
						for ($i=0; $i < $chequerowcount; $i++) {
							if($data['post_dated_cheque_number'][$i] !=''){
								DB::insert('insert into service_schedule_placement_cost (service_schedule_id, post_dated_cheque_number, post_dated_cheque_cost) values (?, ?, ?)', [$insertedId, $data['post_dated_cheque_number'][$i],$data['post_dated_cheque_cost'][$i]]);
							}
					}
				}	
					
			}
		// Insert servicefees data complete
		\Session::flash('success', 'Service fees is saved.');
		
		return redirect("servicefees/");

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
		$servicefees = Agencymaidserviceschedule::findOrFail($id);

		$agencymaidservice = DB::table('agency_maid_service as ams')
						->select("ams.service_id","ams.service_cost")	
						->where('ams.service_schedule_id', '=', $id)->get();

		$agencyotherservice = DB::table('agency_maid_other_service as amos')
						->select("amos.other_service_title","amos.other_service_price","amos.service_schedule_id","amos.id")	
						->where('amos.service_schedule_id', '=', $id)->get();	

		$replacementcost = DB::table('service_schedule_replacement_cost as ssrc')
						->select("ssrc.replacement_month","ssrc.replacement_number","ssrc.cost","ssrc.service_schedule_id","ssrc.id")	
						->where('ssrc.service_schedule_id', '=', $id)->get();
												
		$agencyservice = DB::table('agency_service as ags')
						->select("ags.*")
						->where('ags.agency_id','=',$user_id)
						->get();
		$maid_details = DB::table('maid_personal_details as mpd')
						->leftJoin('countries as c', 'c.id', '=', 'mpd.nationality')
						->select("mpd.maid_reference_code","mpd.name","c.nationality")
						->where('mpd.id', '=', $servicefees->maid_id)
						->get();
		$placement_fee_schedule = DB::table('service_schedule_placement_cost as sspc')
						->select("sspc.post_dated_cheque_number","sspc.post_dated_cheque_cost","sspc.id","sspc.service_schedule_id")
						->where('sspc.service_schedule_id', '=', $id)
						->get();									
		return view('sentinel.servicefees.edit')->with('servicefees',$servicefees)->with('agencymaidservice',$agencymaidservice)->with('agencyotherservice',$agencyotherservice)->with('replacementcost',$replacementcost)->with('agencyservice',$agencyservice)->with('maid_details',$maid_details)->with('placement_fee_schedule',$placement_fee_schedule);
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
    		'float_integer' => 'Please enter valid income.',
    		'maid_id.required' => 'Please enter valid reference code.',
    		'service_id.required' => 'Please select service.',
		);
		$validator = Validator::make($request->all(), [
				'maid_reference_code' => 'required',
				'service_id' => 'required',
        	],$messages);
		$validator->sometimes('maid_id', 'required', function($input) {
    		return $input->maid_reference_code != '';
		});

        if ($validator->fails()) {
            return redirect("servicefees/".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
        }
        /// validation complete
        //echo '<pre>'; print_r($data); exit;
        $data['agency_id'] = $user_id;
        $data['date']= date('Y-m-d');
        $service = Agencymaidserviceschedule::findOrFail($id);
		$service->update($data);
		// Insert servicefees data
		if(Input::get('service_id'))
			{
				$servicerowcount = count($data['service_id']);
					DB::table('agency_maid_service')->where('service_schedule_id', '=', $id)->delete();
					for ($i=0; $i < $servicerowcount; $i++) {
						if($data['service_id'][$i] !=''){
							DB::insert('insert into agency_maid_service (service_schedule_id, maid_id, service_id, service_cost) values (?, ?, ?, ?)', [$id, $data['maid_id'],$data['service_id'][$i],$data['price'][$data['service_id'][$i]-1]]);
						}
				}	
					
			}
			if(Input::get('other_service_title') )
			{
				$othservicerowcount = count($data['other_service_title']);
					for ($i=0; $i < $othservicerowcount; $i++) {
						if($data['other_service_title'][$i] !=''){
							DB::insert('insert into agency_maid_other_service (service_schedule_id, other_service_title, other_service_price) values (?, ?, ?)', [$id, $data['other_service_title'][$i],$data['other_service_price'][$i]]);
						}
				}	
					
			}
			if(Input::get('replacement_month'))
			{
				$monthrowcount = count($data['replacement_month']);
					for ($i=0; $i < $monthrowcount; $i++) {
						if($data['replacement_month'][$i] !=''){
							DB::insert('insert into service_schedule_replacement_cost (service_schedule_id,maid_id,  replacement_number, replacement_month, cost) values (?, ?, ?, ?, ?)', [$id, $data['maid_id'], $data['replacement_number'][$i], $data['replacement_month'][$i],$data['cost'][$i]]);
						}
				}	
					
			}
			if(Input::get('payment_placement_fee') == 'Upfront Placement Fee')
			{
				if(Input::get('post_dated_cheque_number'))
				{
					$chequerowcount = count($data['post_dated_cheque_number']);
						for ($i=0; $i < $chequerowcount; $i++) {
							if($data['post_dated_cheque_number'][$i] !=''){
								DB::insert('insert into service_schedule_placement_cost (service_schedule_id, post_dated_cheque_number, post_dated_cheque_cost) values (?, ?, ?)', [$id, $data['post_dated_cheque_number'][$i],$data['post_dated_cheque_cost'][$i]]);
							}
					}
				}	
					
			}
		// Insert servicefees data complete
		\Session::flash('success', 'Service profile has been Updated.');
		
		return redirect("servicefees/");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id) {
	 	DB::table('agency_maid_service_schedule as amss')
            ->where('id', $id)
            ->update(['amss.deleted' => 'Y']);
        DB::table('agency_maid_service')->where('service_schedule_id', '=', $id)->delete();
        DB::table('agency_maid_other_service')->where('service_schedule_id', '=', $id)->delete();    
       	DB::table('service_schedule_replacement_cost')->where('service_schedule_id', '=', $id)->delete();
       // $del = Fdw::find($id);
        //$del->delete();
		\Session::flash('success', 'Service has been deleted.');
		return redirect('servicefees');
	}
	/**
	 * Remove the agency contact detail 
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function serviceprice() {
		$service_id = Input::get('service_id');
		$service_price =  DB::table('agency_service as ags')
						->select("ags.price")
						->where('ags.id', '=', $service_id)->get();
		return $service_price;				
	}

	/**
	 * Remove the replacement cost details
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function replacementcostdelete($service_schedule_id,$replacementcostid) {
		DB::table('service_schedule_replacement_cost')->where('service_schedule_id', '=', $service_schedule_id)->where('id', '=', $replacementcostid)->delete();

		\Session::flash('success', 'Replacement cost deleted successfully.');
		return redirect("servicefees/".$service_schedule_id."/edit");
	}

	/**
	 * Remove the other service details
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function otherservicedelete($service_schedule_id,$otherserviceid) {
		DB::table('agency_maid_other_service')->where('service_schedule_id', '=', $service_schedule_id)->where('id', '=', $otherserviceid)->delete();

		\Session::flash('success', 'Other service deleted successfully.');
		return redirect("servicefees/".$service_schedule_id."/edit");
	}

	/**
	 * Remove the placement details
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function placementdelete($service_schedule_id,$placementid) {
		DB::table('service_schedule_placement_cost')->where('service_schedule_id', '=', $service_schedule_id)->where('id', '=', $placementid)->delete();

		\Session::flash('success', 'Placement fee schedule deleted successfully.');
		return redirect("servicefees/".$service_schedule_id."/edit");
	}
}