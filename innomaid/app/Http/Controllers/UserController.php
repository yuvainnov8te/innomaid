<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User as User;
use App\Agencies as Agencies;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session;
use Redirect;
use Input;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function show($id) {
		$fdw = Fdw::find($id);
		return view('sentinel.users.show', compact('fdw'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		$search="";
     if(Auth::user()->hasRole('admin')){
       	$users = DB::table('agencies as a')
                ->select("a.*","r.display_name as role_name","u.id as userid",DB::Raw("count(distinct mpd.id) as totalmaid"),DB::Raw("count(distinct epd.id) as totalemployer"),DB::Raw("count(distinct ma.id) as totalmaid_application"))
                ->leftjoin('users as u','u.agency_id','=','a.id')
                ->leftjoin('maid_personal_details as mpd', function ($join){   $join->on('users_agents_id','=','u.id');  $join->on('deleted','=',DB::raw("'N'")); } )
                ->leftjoin('role_user as ru','ru.user_id','=','u.id')
                ->leftjoin('roles as r','r.id','=','ru.role_id')
                ->leftjoin('employer_personal_details as epd','epd.users_agents_id','=','u.id'  )
                ->leftjoin('maid_application as ma','ma.user_agents_id','=','u.id')
               	->orderBy("u.updated_at", "DESC")
               	->groupBy("a.id")
               	->paginate(10);
	}
	else{
			$user=DB::table('users as u')->where('u.id','=',$user_id)->get();
		 	$users = DB::table('users as u')
                ->select("u.*","r.display_name as role_name",DB::Raw("count(distinct mpd.id) as totalmaid"),DB::Raw("count(distinct epd.id) as totalemployer"),DB::Raw("count(distinct ma.id) as totalmaid_application"))
                ->leftjoin('maid_personal_details as mpd', function ($join){   $join->on('users_agents_id','=','u.id');  $join->on('deleted','=',DB::raw("'N'")); } )
                ->leftjoin('employer_personal_details as epd','epd.users_agents_id','=','u.id'  )
                ->leftjoin('users as au','au.agency_id','=','u.id')
                ->leftjoin('role_user as ru','ru.user_id','=','u.id')
                ->leftjoin('roles as r','r.id','=','ru.role_id')
                ->leftjoin('maid_application as ma','ma.user_agents_id','=','u.id')
		->leftJoin('agencies as ag','ag.id','=','u.agency_id')
                ->where('u.agency_id','=',$user[0]->agency_id)
               	->orderBy("u.updated_at", "DESC")
               	->groupBy("u.id")
               	->paginate(10);
				
		
	}
		
				
		$total=$users->total();		
				
 //echo '<pre>'; print_r($users); exit;
		return view('sentinel.users.index')->with('users', $users)->with('search',$search)->with('total',$total);
	}
 /**
   * Searching in resource.
   *
   * @return Response
   */
	public function search(Request $request){
	$data = $request->all();
	$user_id = Auth::user()->id;
	$user_email	=  Auth::user()->email;
	$search=$data['search_term'];
		Validator::extend('alpha_spaces_num', function($attribute, $value)
      {
          return preg_match('/^[-\w\s]+$/', $value);
      });
	$messages = array(
			 'alpha_spaces_num' => 'Please enter  valid values .',
	  );
	   $validator = Validator::make($request->all(), [
			  'search_term' => 'alpha_spaces_num',
		  ],$messages);

	if ($validator->fails()) {
		return redirect("users")
					->withErrors($validator)
					->withInput();
	}
	if($data['search_term'])
	{
	if(Auth::user()->hasRole('admin')){
       	$users = DB::table('agencies as a')
                ->select("a.*","r.display_name as role_name","u.id as userid",DB::Raw("count(distinct mpd.id) as totalmaid"),DB::Raw("count(distinct epd.id) as totalemployer"),DB::Raw("count(distinct ma.id) as totalmaid_application"))
                ->leftjoin('users as u','u.agency_id','=','a.id')
                ->leftjoin('maid_personal_details as mpd', function ($join){   $join->on('users_agents_id','=','u.id');  $join->on('deleted','=',DB::raw("'N'")); } )
		->leftjoin('role_user as ru','ru.user_id','=','u.id')
                ->leftjoin('roles as r','r.id','=','ru.role_id')
                ->leftjoin('employer_personal_details as epd','epd.users_agents_id','=','u.id'  )
                ->leftjoin('maid_application as ma','ma.user_agents_id','=','u.id')
               	->orderBy("u.updated_at", "DESC")
		 ->whereRaw("(a.company_name like '%$search%' or a.email like '%$search%' or a.id like '%$search%' )")
               	->groupBy("a.id")
               	->paginate(10);
				
	}
	else{
		 	$users = DB::table('users as u')
                ->select("u.*","r.display_name as role_name",DB::Raw("count(distinct mpd.id) as totalmaid"),DB::Raw("count(distinct epd.id) as totalemployer"),DB::Raw("count(distinct ma.id) as totalmaid_application"))
                ->leftjoin('maid_personal_details as mpd', function ($join){   $join->on('users_agents_id','=','u.id');  $join->on('deleted','=',DB::raw("'N'")); } )
                ->leftjoin('employer_personal_details as epd','epd.users_agents_id','=','u.id'  )
                ->leftjoin('users as au','au.agency_id','=','u.id')
		->leftjoin('role_user as ru','ru.user_id','=','u.id')
                ->leftjoin('roles as r','r.id','=','ru.role_id')
                ->leftjoin('maid_application as ma','ma.user_agents_id','=','u.id')
                ->where('u.agency_id','=',$user_id)
		 ->whereRaw("(u.company_name like '%$search%' or u.email like '%$search%' or u.id like '%$search%' )")
               	->orderBy("u.updated_at", "DESC")
               	->groupBy("u.id")
               	->paginate(10);
				
		
	}
	}
	else
	{
	if(Auth::user()->hasRole('admin')){
       	$users = DB::table('agencies as a')
                ->select("a.*","r.display_name as role_name","u.id as userid",DB::Raw("count(distinct mpd.id) as totalmaid"),DB::Raw("count(distinct epd.id) as totalemployer"),DB::Raw("count(distinct ma.id) as totalmaid_application"))
                ->leftjoin('users as u','u.agency_id','=','a.id')
                ->leftjoin('maid_personal_details as mpd', function ($join){   $join->on('users_agents_id','=','u.id');  $join->on('deleted','=',DB::raw("'N'")); } )
                ->leftjoin('role_user as ru','ru.user_id','=','u.id')
                ->leftjoin('roles as r','r.id','=','ru.role_id')
                ->leftjoin('employer_personal_details as epd','epd.users_agents_id','=','u.id'  )
                ->leftjoin('maid_application as ma','ma.user_agents_id','=','u.id')
               	->orderBy("u.updated_at", "DESC")
               	->groupBy("a.id")
               	->paginate(10);
	}
	else{
		 	$users = DB::table('users as u')
                ->select("u.*","r.display_name as role_name",DB::Raw("count(distinct mpd.id) as totalmaid"),DB::Raw("count(distinct epd.id) as totalemployer"),DB::Raw("count(distinct ma.id) as totalmaid_application"))
                ->leftjoin('maid_personal_details as mpd', function ($join){   $join->on('users_agents_id','=','u.id');  $join->on('deleted','=',DB::raw("'N'")); } )
                ->leftjoin('employer_personal_details as epd','epd.users_agents_id','=','u.id'  )
                ->leftjoin('users as au','au.agency_id','=','u.id')
                ->leftjoin('role_user as ru','ru.user_id','=','u.id')
                ->leftjoin('roles as r','r.id','=','ru.role_id')
                ->leftjoin('maid_application as ma','ma.user_agents_id','=','u.id')
                ->where('u.agency_id','=',$user_id)
               	->orderBy("u.updated_at", "DESC")
               	->groupBy("u.id")
               	->paginate(10);
				
		
	}
	} $total=$users->total();		
		//echo '<pre>'; print_r($users); exit;
		return view('sentinel.users.index')->with('users', $users)->with('search',$search)->with('total',$total);
	}
	public function upload(){ 
		$file = array('image' => Input::file('image'));
		// checking file is valid.
		if (Input::hasFile('image')) {
			 
			$destinationPath = 'uploads/agency_logo'; // upload path
			$extension = Input::file('image')->getClientOriginalExtension();// getting image extension
			$fileName = rand(11111,99999).'.'.$extension; // renameing image
			 
			if(Input::file('image')->move($destinationPath, $fileName))
			{ // uploading file to given path
				return $fileName;
			}
			else {
				// sending back with error message.
				\Session::flash('error', 'uploaded file is not valid');
				//return Redirect::to('sentinel.fdws.create');
			}
			$path = Input::file('image')->getRealPath();
			 // sending back with message
		}
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$roles = Role::where('display','=','1')->lists('display_name','id');
		return view('sentinel.users.create')->with('roles',$roles);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$user_id = Auth::user()->id;
		$user_email=  Auth::user()->email;
		$data = $request->all();
		$user_data=array();
		
		$user['company_name']=$data['company_name'];
		$user['email']=$data['email'];
		$user['password']=bcrypt($data['password']);
		$user['telephone']=$data['telephone'];
		if(Input::get('area')){
			$user['area']=$data['area'];
		}
		if(Input::get('other_information')){
			$user['other_information']=$data['other_information'];
		}
		
		if(Input::get('website')){
			$user['website']=$data['website'];
		}
		if(Input::get('insurance_company')){
			$user['insurance_company']=$data['insurance_company'];
		}
		
		if(Input::get('fax')){
			$user['fax']=$data['fax'];
		}

		if(Input::get('license_no')){
			$user['license_no']=$data['license_no'];
		}
		if(Input::get('registration_number')){
			$user['registration_number']=$data['registration_number'];
		}
		
		$user['address']=$data['address'];
		if(input::get('activated')) {
			$user['activated']=1;
		}else{
			$user['activated']=0;
		}	
		$agency = DB::table('users')->select('agency_id')->where('id','=',$user_id)->get();
		$user['agency_id']=$agency[0]->agency_id;//print_r($data); exit;
		// form validation
		Validator::extend('alpha_spaces', function($attribute, $value)
		{
			return preg_match('/^[ \w ]+$/', $value);
		});
		 Validator::extend('alpha_special', function($attribute, $value)
      		{
         	 return preg_match('/^[ A-Za-z0-9_.-]*$/', $value);
      		});
		if(Auth::user()->hasRole('admin')){
		$data['operating_hrs_from'] = array_values(array_filter($data['operating_hrs_from']));
		$data['operating_hrs_to'] = array_values(array_filter($data['operating_hrs_to']));
		}
		// Image Upload
			$image_name = UserController::upload();
			$user['image']=$image_name;	
			
		/// image upload complete
		
		$messages = array(
		'alpha_special' => 'Please enter letters, numbers and underscore  values.',
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'license_no.alpha_num' => 'The license number may only contain letters and numbers.',
		);
		if(Auth::user()->hasRole('admin')){
			$this->validate($request,
					[
					'company_name' => 'required|alpha_spaces|min:3|max:255|unique:users', 
					'email' => 'required|email|unique:users', 
					'password' => 'required|min:8|confirmed',
					'telephone' => 'required|numeric|digits_between:8,15',
					'website' => 'url',
					'operating_day' =>'required',
					'fax' => 'numeric|digits_between:0,15',
					'license_no' => 'required|alpha_num|min:6|max:15|unique:users',
					'registration_number' => 'required|alpha_special|min:6|max:15|unique:users',
					'address' => 'required|Min:3|Max:255',
					'area' => 'required',
					],$messages);
		}else{
			$this->validate($request,
					[
					'role' => 'required',
					'company_name' => 'required|alpha_spaces|min:3|max:255|unique:users,company_name,null,id,agency_id,'.$user_id, 
					'email' => 'required|email|unique:users', 
					'password' => 'required|min:8|confirmed',
					'telephone' => 'required|numeric|digits_between:8,15',
					'registration_number' => 'required|alpha_special|min:6|max:15|unique:users',
					'address' => 'required|Min:3|Max:255',
					],$messages);
		}
		/// form validation complete
		if(Auth::user()->hasRole('admin')){
			$agency = Agencies::create($user);
			$agencyinsertedId = $agency->id;
			$user['agency_id']=$agencyinsertedId;
		}
		$user = User::create($user);
		$insertedId = $user->id;
		if($insertedId != ''){
			if(Auth::user()->hasRole('admin')){
				DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [$insertedId, 2]);
				$daycount = count($data['operating_day']);
				for ($i=0; $i < $daycount; $i++) {
					if($data['operating_day'][$i] !=''){
						DB::insert('insert into agency_operating_information (agency_id, operating_day, operating_hrs_from, operating_hrs_to) values (?, ?, ?, ?)', [$agencyinsertedId, $data['operating_day'][$i],$data['operating_hrs_from'][$i],$data['operating_hrs_to'][$i]]);
					}
				}
			}
			else{
				DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [$insertedId, $data['role']]);
			}
		}
		if(Auth::user()->hasRole('admin')){
			\Session::flash('success', 'Agency is saved.');
			return redirect("users/".$agencyinsertedId."/edit?userid=".$insertedId."&tab=tab1");
		}else{
			\Session::flash('success', 'User is saved.');
			return redirect("users/");
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) { 
		$user_id = Auth::user()->id;
		$roles = Role::where('activated','=','1')->lists('display_name','id');
		//print_r($roles); exit;

		if(Auth::user()->hasRole('admin')||(Auth::user()->hasRole('user')&&$id==Auth::user()->id)){
			if(Auth::user()->hasRole('admin')){
			$user = Agencies::findOrFail($id); } else{$user = User::findOrFail($id);}
			$user['insurance_company'] = explode(',', $user['insurance_company']);
		}else{
			$user = User::findOrFail($id);
		}
		$user['operating_days'] = explode(',', $user['operating_days']);
		$agency_opertaing_info =  DB::table('agency_operating_information as aoi')
                        ->select("aoi.*")
                        ->where('agency_id', '=', $id)->get(); 
		$user_role =  DB::table('role_user as ru')
                        ->select("ru.role_id")
                        ->where('user_id', '=', $id)->get();                                
		$agencycontacts =  DB::table('agency_contacts as ac')
                        ->select("ac.*")
                        ->where('agency_id', '=', $id)->get();                          
		return view('sentinel.users.edit',  compact('user'))->with('agencycontacts',$agencycontacts)->with('roles',$roles)->with('user_role',$user_role)->with('agency_opertaing_info',$agency_opertaing_info)->with('user_id',$user_id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) { 
		$agency_id = Auth::user()->agency_id;
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		// Update functionality done in vendor/rydurham/sentinel/src/controller/usercontroller 
		$data = $request->all();
		$userdata['company_name']=$data['company_name'];
		$userdata['email']=$data['email'];
		$userdata['telephone']=$data['telephone'];
		if(Input::get('area')){
			$userdata['area']=$data['area'];
		}
		if(Input::get('other_information')){
			$userdata['other_information']=$data['other_information'];
		}
		if(Input::get('website')){
			$userdata['website']=$data['website'];
		}
		
		if(Input::get('fax')){
			$userdata['fax']=$data['fax'];
		}

		if(Input::get('license_no')){
			$userdata['license_no']=$data['license_no'];
		}
		if(Input::get('registration_number')){
			$userdata['registration_number']=$data['registration_number'];
		}

		$userdata['address']=$data['address'];
        if(input::get('activated')) {
            $userdata['activated']=1;
        }else{
            $userdata['activated']=0;
        }
		// Image Upload
			$image_name = UserController::upload();
			if($image_name){
			$userdata['image']=$image_name;	
			}
		/// image upload complete
        // form validation
	 Validator::extend('alpha_special', function($attribute, $value)
      		{
         	 return preg_match('/^[ A-Za-z0-9_.-]*$/', $value);
      		});
      Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[ \w ]+$/', $value);
        }); //print($id);exit;  

      	if(Auth::user()->hasRole('admin')||(Auth::user()->hasRole('user')&&$id==Auth::user()->id)){
      	$data['operating_hrs_from'] = array_values(array_filter($data['operating_hrs_from']));
		$data['operating_hrs_to'] = array_values(array_filter($data['operating_hrs_to']));
		}
      	$messages = array(
		'alpha_special' => 'Please enter letters, numbers and underscore  values.',
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'license_no.alpha_num' => 'The license number may only contain letters and numbers.',
		);
		if(Auth::user()->hasRole('admin')){
			if(!isset($data['userid'])){
				$data['userid']=1;
			}
       		$validator = Validator::make($request->all(),
	                [
	                'company_name' => 'required|alpha_spaces|min:3|max:255|unique:agencies,company_name,'.$id.',id', 
	                'email' => 'required|email|unique:agencies,email,'.$id.',id', 
					'telephone' => 'required|numeric|digits_between:8,15',
					'website' => 'url',
					'fax' => 'numeric|digits_between:0,15',
					'operating_day' => 'required',
					'license_no' => 'required|alpha_num|min:6|max:15|unique:agencies,license_no,'.$id.',id',
					//'registration_number' => 'required|alpha_special|min:6|max:15',
					'address' => 'required|Min:3|Max:255',
					'area' => 'required',
	                ],$messages);
       		if ($validator->fails()) {
				return redirect("users/".$data['id']."/edit?userid=".$data['userid']."&tab=tab0")
                        ->withErrors($validator)
                        ->withInput();
			}
       	} 
       	else{
       		$validator = Validator::make($request->all(),
	                [
	                'company_name' => 'required|alpha_spaces|min:3|max:255|unique:users,company_name,'.$id.',id,agency_id,'.$user_id, 
	                'email' => 'required|email|unique:users,email,'.$id.',id', 
					'telephone' => 'required|numeric|digits_between:8,15',
					'address' => 'required|Min:3|Max:255',
			'registration_number' => 'required|alpha_special|min:6|max:15',
	                ],$messages);
       		if ($validator->fails()) {
				return redirect("users/".$data['id']."/edit?tab=tab0")
                        ->withErrors($validator)
                        ->withInput();
			}
       	}
      // print_r($data['operating_hrs_to']);exit;
        if(Auth::user()->hasRole('admin')){ echo "<pre>";
			$agency = Agencies::findOrFail($id);
			
		$user= DB::table('users as u')->leftJoin('role_user as r','r.user_id',"=",'u.id')
			->where('r.role_id','=','2')
			->where('u.agency_id','=',$id)
			->update($userdata);
			 unset($userdata['registration_number']);
		 $agency->update($userdata);
		
		}else{	
        $user = User::findOrFail($id);
	$role=DB::table('users as u')->select('r.role_id','u.id')->leftJoin('role_user as r','r.user_id',"=",'u.id')
	->where('u.id','=',$id)->get();$user->update($userdata);
	if($role[0]->role_id=='2')
	{ unset($userdata['registration_number']); 
	 $agency=DB::table('agencies as a')->select('a.*')->leftJoin('users as u','u.agency_id','=','a.id')
	->where('u.id','=',$id)->get();
	DB::table('agencies as a')->where('a.id','=',$agency[0]->id)->update($userdata);
	}
	
        }
        if(Auth::user()->hasRole('admin')||(Auth::user()->hasRole('user')&&$id==Auth::user()->id)){
        	DB::table('agency_operating_information')->where('agency_id', '=', $id)->delete();
        	$daycount = count($data['operating_day']);
				for ($i=0; $i < $daycount; $i++) {
					if($data['operating_day'][$i] !=''){
						if($data['operating_hrs_from'][$i] ==''){
							$data['operating_hrs_from'][$i] ='';
						}
						if($data['operating_hrs_to'][$i] ==''){
							$data['operating_hrs_to'][$i] ='';
						}
						DB::insert('insert into agency_operating_information (agency_id, operating_day, operating_hrs_from, operating_hrs_to) values (?, ?, ?, ?)', [$id, $data['operating_day'][$i],$data['operating_hrs_from'][$i],$data['operating_hrs_to'][$i]]);
					}
				}
	        \Session::flash('success', 'Agency has been Updated.');
		if(Auth::user()->hasRole('admin')){
	        return redirect("users/".$id."/edit?userid=".$data['userid']."&tab=tab0");
		}else{return redirect("users/".$id."/edit");}	
    	}else{
    		\Session::flash('success', 'User has been Updated.');
	        return redirect("users/".$id."/edit");
    	}
	}
	public function updateothersetting($id, Request $request){
		$agency_id = Auth::user()->agency_id;
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		// Update functionality done in vendor/rydurham/sentinel/src/controller/usercontroller 
		$data = $request->all();
		
		
		if(!isset($data['userid'])){
				$data['userid']=1;
			}
		 $messages = array(
    	
		);
		$validator = Validator::make($data, [
		'insurance_company' => 'required',
		],$messages);
		 if ($validator->fails()) {
            return redirect("users/".$id."/edit?userid=".$data['userid']."&tab=tab3")
                        ->withErrors($validator)
                        ->withInput();
        }
		if(Input::get('insurance_company')){
			$userdata['insurance_company']=implode(',', $data['insurance_company']);
		}
		if($agency_id){
		$agency = Agencies::findOrFail($agency_id);}else{$agency = Agencies::findOrFail($id);}
		unset($userdata['registration_number']);
		$agency->update($userdata);
		\Session::flash('success', 'Agency has been Updated.');
	    return redirect("users/".$id."/edit?userid=".$data['userid']."&tab=tab3");
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id) {
		if(Auth::user()->hasRole('admin')){		
			$userdata=DB::table('users')->where('agency_id', '=', $id)->get();
		}else{
			$userdata=DB::table('users')->where('id', '=', $id)->get();
		}
		//Find all user for agency
		
		if($userdata){
			foreach($userdata as $userdatakey => $userdatavalue)
			{
				foreach($userdatavalue as $userdatakey1 => $userid)
				{ 
					if ($userdatakey1=='id')
					{
						// Maid Application Delete
						$data_maid_app=DB::table('maid_application')->where('user_agents_id', '=', $userid)->get();
						//echo "<pre>";
						foreach($data_maid_app as $key => $value)
						{
							foreach($value as $key1 => $value1)
							{ 
								if ($key1=='id')
								{
								$maid_service_id = DB::table('agency_maid_service_schedule as amss')
											  ->select("amss.id as id") 
											  ->where('amss.employer_maid_id', '=', $value1)->get();
								if($maid_service_id){             
								$data1=  DB::table('agency_maid_service')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();
								$data2=  DB::table('agency_maid_other_service')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();    
								 $data3= DB::table('service_schedule_replacement_cost')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();       
								  $data4=DB::table('service_schedule_placement_cost')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();    
								}
								DB::table('agency_maid_service_schedule')
										->where('employer_maid_id','=', $value1)->delete(); 
								DB::table('maid_app_job_scope')
										->where('employer_maid_id','=', $value1)->delete(); 
								 DB::table('maid_app_rest_day')
										->where('employer_maid_id','=', $value1)->delete();
								DB::table('maid_app_handling_takeover')
										->where('employer_maid_id','=', $value1)->delete(); 	
								DB::table('maid_app_payment_and_loan')
										->where('employer_maid_id','=', $value1)->delete(); 
								 DB::table('maid_app_loan_manual_payment')
										->where('employer_maid_id','=', $value1)->delete(); 
								DB::table('maid_app_safety_agreement')
										->where('employer_maid_id','=', $value1)->delete();
								DB::table('maid_app_fdw_work_permit')
										->where('employer_maid_id','=', $value1)->delete();
								DB::table('maid_app_employer_tax_declaration')
										->where('employer_maid_id','=', $value1)->delete();	
								DB::table('maid_app_authorisation_workpass')
										->where('employer_maid_id','=', $value1)->delete();							
								DB::table('maid_app_security_bond')
										->where('employer_maid_id','=', $value1)->delete(); 
								DB::table('agency_agreement_data')
										->where('application_id','=', $value1)->delete();		
								DB::table('maid_application')
										->where('id','=', $value1)->delete();
								}
										
							}
						}// exit;
						// FDW Delete
						$data_maid=DB::table('maid_personal_details')->where('users_agents_id', '=', $userid)->get();
						$result = '';
						foreach($data_maid as $key => $value)
						{
							foreach($value as $key1 => $value1)
							{ 
								if ($key1=='id')
								{
								$document=DB::table('maid_documents')->where('maid_id', '=', $value1)->delete();
								$skill=DB::table('maid_skill_set')->where('maid_id', '=', $value1)->delete();
								$medical=DB::table('maid_medical_desieses')->where('maid_id', '=', $value1)->delete();
								$history=DB::table('maid_employment_history')->where('maid_id', '=', $value1)->get();
								if($history){
										foreach($history as $innerkey => $innervalue)
										{	foreach($innervalue as $innerk => $val)
											 if($innerk=="id"){
											 $d1=DB::table('maid_employment_history_work_area')->where('employment_history_id', '=', $val)->get();
											 print_r($d1);
											}
										}
									DB::table('maid_employment_history')->where('maid_id', '=', $value1)->delete();		
								}	
								$data=	DB::table('maid_personal_details')
								->where('id', $value1)
								->delete();
								}
								
							}
						}
							//PRINT_R($datas);
						// Employer Delete
						$data_employer=DB::table('employer_personal_details')->where('users_agents_id', '=', $userid)->get();
						
						foreach($data_employer as $key => $value)
						{
							foreach($value as $key1 => $value1)
							{ 
								if ($key1=='id')
								{
								DB::table('employer_documents')->where('employer_id', '=', $value1)->delete();
								DB::table('employer_family_member_details')->where('employer_id', '=', $value1)->delete();
								DB::table('employer_house_type')->where('employer_id', '=', $value1)->delete();
								DB::table('employer_personal_details')->where('id', $value1)->delete();
								}
							}
						}
						DB::table('role_user')->where('user_id', '=', $userid)->delete();
						DB::table('agency_operating_information')->where('agency_id', '=', $userid)->delete();
						DB::table('agency_agreement_forms')->where('agency_id', '=', $userid)->delete();
						DB::table('agency_contacts')->where('agency_id', '=', $userid)->delete();
					}
				}
			}
		}	
		if(Auth::user()->hasRole('admin')){
			
			DB::table('users')->where('agency_id', '=', $id)->delete();
			DB::table('agencies')->where('id', '=', $id)->delete();
		}else{
			DB::table('users')->where('id', '=', $id)->delete();
		}
		
		\Session::flash('success', 'Agency deleted successfully.');
		return redirect("users/");
	}

	/**
	 * Update the Contact information related to agencies.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateagencycontact($id, Request $request) { 
		$data = $request->all();
        // form validation
      	/*Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });*/
        $this->validate($request,
                [
               	//'contact_name' => 'required|min:3|', 
               // 'contact_number' => 'required|digits_between:8,15|numeric',
                ]);
		if(Input::get('contact_name')){
	        $contactrowcount = count($data['contact_name']);
			for ($i=0; $i < $contactrowcount; $i++) {
				if($data['contact_name'][$i] !=''){
					DB::insert('insert into agency_contacts (agency_id, contact_name, contact_no) values (?, ?, ?)', [$id, $data['contact_name'][$i],$data['contact_no'][$i]]);
				\Session::flash('success', 'Agency Contact(s) is saved.');
				}
			}
		}
        
        return redirect("users/".$id."/edit?userid=".$data['userid']."&tab=tab1");
	}


	public function changePassword(Request $request, $id)
    {
    	$data       = Input::all();
    	$data['id'] = $id;
    	//print_r($data); exit;
    	$validator = Validator::make($request->all(), [
           // 'oldPassword'              => 'min:8',
            'newPassword'              => 'required|min:8|confirmed',
            'newPassword_confirmation' => 'required'
            ]);
        if ($validator->fails()) {
        	if(Auth::user()->hasRole('admin')){
				return redirect("users/".$data['agencyid']."/edit?userid=".$id."&tab=tab2")
                        ->withErrors($validator)
                        ->withInput();
			}else{
				return redirect("users/".$data['agencyid']."/edit?userid=".$id."&tab=tab2")
                        ->withErrors($validator)
                        ->withInput();
			}
            
        }
//print_r($data); exit;

			$user = User::find($data['id']);
			$user->password = bcrypt($data['newPassword']);;
			$user->save();
			if(Auth::user()->hasRole('admin')){
				\Session::flash('success', 'Agency password change successfully.');
			}else{
				\Session::flash('success', 'User password change successfully.');
			}
			return redirect("users/");
    }

    
	/**
	 * Remove the agency contact detail 
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function agencycontactsdelete($agency_id,$agency_contact_id) {
			DB::table('agency_contacts')->where('agency_id', '=', $agency_id)->where('id', '=', $agency_contact_id)->delete();

		\Session::flash('success', 'Agency contact deleted successfully.');
		return redirect("users/".$agency_id."/edit?userid=".$_GET['userid']."&tab=tab1");
	}
}
