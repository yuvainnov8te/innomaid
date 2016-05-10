<?php
 /***********************************************
	 Developed by :- Harendar singh tomar
	 Module       :- Employer
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Employer as Employer;
use App\Fdw as Fdw;
use App\Housetype as Housetype;
use App\Countries as Countries;
use App\User as user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;
use Response;
use File;


class EmployerController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	 public function show($id,$ispdf = false) {
	 	$employer_data = DB::table('employer_personal_details as ed')
					->select('ed.*')
					->where('ed.deleted','=','N')
					->where('ed.id','=',$id)
					->get();
		$employer_house_type = DB::table('employer_house_type as eht')
						->leftJoin('house_type as ht', 'ht.id', '=', 'eht.house_type_id')
						->select('ht.title as housetypetitle', "eht.*")
						->where('eht.employer_id','=',$id)
						->where('eht.deleted','=','N')
						->get();			
		$employer_family_details = DB::table('employer_family_member_details as efmd')
						->select( "efmd.*")
						->where('employer_id', '=', $id)->get();
		$user_data = DB::table('users as u')
					->select('u.image as agency_logo')
					->where('u.id','=',$employer_data[0]->users_agents_id)
					->get();								
					$pdf = PDF::loadView('sentinel.employer.pdf',array('employer_data' => $employer_data,'employer_house_type' => $employer_house_type,'employer_family_details'=>$employer_family_details,'user_data'=>$user_data));
					return $pdf->download($employer_data[0]->employer_name.'_'.date('Y_m_d').'.pdf');
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
		if(Auth::user()->hasRole(['admin'])){
			$employerList = DB::table('employer_personal_details as e')
	                ->select("e.*","u.company_name as username","u.email")
	                ->leftJoin('users as u', 'u.id', '=', 'e.users_agents_id')
	                ->where("e.deleted",'=','N') 
	               	->orderBy("e.updated_at", "DESC")->paginate(10);
        }
        else{
        	$employerList = DB::table('employer_personal_details as e')
	                ->select("e.*")
	                ->where("e.deleted",'=','N') 
	                ->where("e.users_agents_id",'=',$user_id)
	               	->orderBy("e.updated_at", "DESC")->paginate(10);
        }
		 $total=$employerList->total();
		return view('sentinel.employer.index')->with('employerList',$employerList)->with('search',$search)->with('total',$total);
	}
	/**
	 * Function is used Search 
	 * @return Response
	*/
	public function search(Request $request){
	$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
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
        return redirect("employer")
                    ->withErrors($validator)
                    ->withInput();
		}
		$search=$data['search_term'];
		//print_r($data);exit;
		if($data['search_term'])
		{	if(Auth::user()->hasRole(['admin'])){
			$employerList = DB::table('employer_personal_details as e')
	                ->select("e.*","u.company_name as username","u.email")
	                ->leftJoin('users as u', 'u.id', '=', 'e.users_agents_id')
	                ->where("e.deleted",'=','N') 
					  ->whereRaw("(employer_name like '%$search%' or employer_nric_no  like '%$search%')")
	               	->orderBy("e.updated_at", "DESC")->paginate(10);
        }
        else{
        	$agencyuser =  DB::table('users as u')
      					->select(DB::Raw("GROUP_CONCAT(DISTINCT (u.id) SEPARATOR ',') as user_id"))
      					->where('u.agency_id','=',$user_id)
      					->orWhere('u.id','=',$user_id)
      					->get();
      		if($agencyuser){
      			$user_id = $agencyuser[0]->user_id;
      		}
        	$employerList = DB::table('employer_personal_details as e')
	                ->select("e.*","u.company_name as username","u.email")
	                ->leftJoin('users as u', 'u.id', '=', 'e.users_agents_id')
	                ->where("e.deleted",'=','N') 
					 ->whereRaw("(employer_name like '%$search%' or employer_nric_no  like '%$search%')")
	                ->whereRaw("e.users_agents_id in ($user_id)")
	               	->orderBy("e.updated_at", "DESC")->paginate(10);
        }
		} else{
		if(Auth::user()->hasRole(['admin'])){
			$employerList = DB::table('employer_personal_details as e')
	                ->select("e.*","u.company_name as username","u.email")
	                ->leftJoin('users as u', 'u.id', '=', 'e.users_agents_id')
	                ->where("e.deleted",'=','N') 
	               	->orderBy("e.updated_at", "DESC")->paginate(10);
        }
        else{
        	$agencyuser =  DB::table('users as u')
      					->select(DB::Raw("GROUP_CONCAT(DISTINCT (u.id) SEPARATOR ',') as user_id"))
      					->where('u.agency_id','=',$user_id)
      					->orWhere('u.id','=',$user_id)
      					->get();
      		if($agencyuser){
      			$user_id = $agencyuser[0]->user_id;
      		}
        	$employerList = DB::table('employer_personal_details as e')
	                ->select("e.*","u.company_name as username","u.email")
	                ->leftJoin('users as u', 'u.id', '=', 'e.users_agents_id')
	                ->where("e.deleted",'=','N') 
	                ->whereRaw("e.users_agents_id in ($user_id)")
	               	->orderBy("e.updated_at", "DESC")->paginate(10);
			}
		}
		//print_r($employerList); exit;
		 $total=$employerList->total();
		return view('sentinel.employer.index')->with('employerList',$employerList)->with('search',$search)->with('total',$total);
	}

	/**
	 * Function is used for multiple document upload
	 * @return document name
	*/
	public function multiple_upload($id) {

		    // getting all of the post data
		    $files = Input::file('document');
		    // Making counting of uploaded images
		   $file_count = count($files);
		    // start count how many uploaded
		    if (Input::hasFile('document')) {
			    $uploadcount = 0; 
			    foreach($files as $file) {
		     	 		$destinationPath = 'uploads/employer_document';
				        $extension = $file->getClientOriginalName();
				        $filename = rand(11111,99999).'.'.$extension; // renameing image
				        $upload_success = $file->move($destinationPath, $filename);
				        $fileName[]= $filename;
			       
			    }
			    return $fileName;
		    }
    
 	 } 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($isapp = false) {
		if(isset($_REQUEST['employer_id'])&&$_REQUEST['employer_id']!=''){
		$employer = Employer::findOrFail( $_REQUEST['employer_id']);
		 $_REQUEST['employer_name'] = $employer->employer_name; 
		}
		if(isset($_REQUEST['maid_id'])&&$_REQUEST['maid_id']!=''){
		$maid = Fdw::findOrFail( $_REQUEST['maid_id']);
		 $_REQUEST['maid_name'] = $maid->name; 
		}
	 	 \Session::put('trmp_frm', $_REQUEST);

		$value = \Session::get('trmp_frm');
		$agencies = user::leftjoin('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id','=',2)->lists('company_name','id');
		$house_type = Housetype::lists('title','id');
		return view('sentinel.employer.create')->with('house_type',$house_type)->with('agencies',$agencies)->with('isapp',$isapp);
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
			    return preg_match('/^[a-z \/-]+$/i', $value);
			});
		Validator::extend('float_integer', function($attribute, $value)
			{
			    return preg_match('/^(\d+(.\d+)?$)/', $value);
			});
		if(Input::get('employer_residential_status'))
		{
			$data['employer_residential_status'] = implode(';',$data['employer_residential_status']);
		}else{
			$data['employer_residential_status'] = "";
		}
		if(Input::get('spouse_residential_status'))
		{
			$data['spouse_residential_status'] = implode(';',$data['spouse_residential_status']);
		}else{
			$data['spouse_residential_status'] = "";
		}
		if(Input::get('purpose_to_hire'))
		{
			$data['purpose_to_hire'] = implode(';',$data['purpose_to_hire']);
		}else{
			$data['purpose_to_hire'] = "";
		}

		if(!(Input::get('is_income_tax_libal')))
		{
			$data['is_income_tax_libal']='No';
		}
		if(!(Input::get('is_house_hold_income')))
		{
			$data['is_house_hold_income']='No';
		}
		if(!(Input::get('is_iras_notice')))
		{
			$data['is_iras_notice']='No';
		}
		if(!(Input::get('is_employer_permanent_resident')))
		{
			$data['is_employer_permanent_resident']='No';
		}
		if(!(Input::get('is_house_hold_income')))
		{
			$data['annual_house_hold_income']='';
		}
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'float_integer' => 'Please enter valid income.',
    		'users_agents_id.required' => 'Please select an agency.',
		);
		//echo "<pre>"; print_r($data); exit;
		// form validation
		if(Auth::user()->hasRole(['admin'])){
		$validator = Validator::make($request->all(), [
				'users_agents_id' => 'required',
				'marital_status' => 'required',
           		'employer_name' => 'required|alpha_spaces|min:3|max:100',
				'spouse_name' => 'required_if:marital_status,Married|alpha_spaces|min:3|max:100',
				'employer_date_of_birth_day' => 'required', 
				'employer_date_of_birth_month' => 'required', 
				'employer_date_of_birth_year' => 'required', 
				'spouse_date_of_birth_day' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_month' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_year' => 'required_if:marital_status,Married', 
				'employer_nric_no' => 'required|alpha_num|max:10',
				'spouse_nric_no' => 'required_if:marital_status,Married|alpha_num|max:10',
				'employer_passport' => 'alpha_num|max:15',
				'spouse_passport' => 'alpha_num|max:15',
				'employer_residential_status' => 'required_if:marital_status,Married',
				'spouse_residential_status' => 'required_if:marital_status,Married',
				'employer_profession' => 'min:3|max:255',
				'spouse_profession' => 'min:3|max:255',
				'employer_company' => 'min:3|max:255',
				'spouse_company' => 'min:3|max:255',
				'employer_office_phone' => 'numeric|digits_between:8,15',
				'spouse_office_phone' => 'numeric|digits_between:8,15',
				'employer_mobile_phone' => 'required|numeric|digits_between:8,15',
				'spouse_mobile_phone' => 'required_if:marital_status,Married|numeric|digits_between:8,15',
				'address' => 'required|min:3|max:255',
				'home_phone' => 'numeric|digits_between:8,15',
				'purpose_to_hire' => 'required',
				'job_title' => 'alpha_spaces|min:3|max:100',
				'monthly_income' => 'float_integer|min:3|max:20',
				'annual_house_hold_income' => 'float_integer|min:3|max:20',
        	],$messages);
		}else{
			$validator = Validator::make($request->all(), [
				'marital_status' => 'required',
           		'employer_name' => 'required|alpha_spaces|min:3|max:100',
				'spouse_name' => 'required_if:marital_status,Married|alpha_spaces|min:3|max:100',
				'employer_date_of_birth_day' => 'required', 
				'employer_date_of_birth_month' => 'required', 
				'employer_date_of_birth_year' => 'required', 
				'spouse_date_of_birth_day' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_month' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_year' => 'required_if:marital_status,Married', 
				'employer_nric_no' => 'required|alpha_num|max:10',
				'spouse_nric_no' => 'required_if:marital_status,Married|alpha_num|max:10',
				'employer_passport' => 'alpha_num|max:15',
				'spouse_passport' => 'alpha_num|max:15',
				'employer_residential_status' => 'required_if:marital_status,Married',
				'spouse_residential_status' => 'required_if:marital_status,Married',
				'employer_profession' => 'min:3|max:255',
				'spouse_profession' => 'min:3|max:255',
				'employer_company' => 'min:3|max:255',
				'spouse_company' => 'min:3|max:255',
				'employer_office_phone' => 'numeric|digits_between:8,15',
				'spouse_office_phone' => 'numeric|digits_between:8,15',
				'employer_mobile_phone' => 'required|numeric|digits_between:8,15',
				'spouse_mobile_phone' => 'required_if:marital_status,Married|numeric|digits_between:8,15',
				'address' => 'required|min:3|max:255',
				'home_phone' => 'numeric|digits_between:8,15',
				'purpose_to_hire' => 'required',
				'job_title' => 'alpha_spaces|min:3|max:100',
				'monthly_income' => 'float_integer|min:3|max:20',
				'annual_house_hold_income' => 'float_integer|min:3|max:20',
        	],$messages);
		}if($data['isapp']!=" "){
		 if ($validator->fails()) { 

		$value = \Session::get('trmp_frm');
		
            return redirect("employer/create/app")
                        ->withErrors($validator)
                        ->withInput();}
	}else
	{
        if ($validator->fails()) {
		
            return redirect("employer/create")
                        ->withErrors($validator)
                        ->withInput();
        }}
		$data['employer_date_of_birth'] = $data['employer_date_of_birth_year']."-".$data['employer_date_of_birth_month']."-".$data['employer_date_of_birth_day'];
		if(Input::get('spouse_date_of_birth_year')){
			$data['spouse_date_of_birth'] = $data['spouse_date_of_birth_year']."-".$data['spouse_date_of_birth_month']."-".$data['spouse_date_of_birth_day'];
		}
		else{
			$data['spouse_date_of_birth'] = '';
		}
		//echo "<pre>"; print_r($data); exit;
		
		//For admin selected agency assign to employer
		if(Auth::user()->hasRole(['admin'])){
			$data['users_agents_id'] = $data['users_agents_id'];
		}else{// login user agency assign to employer
			$data['users_agents_id'] = $user_id;
		}

		$employer = Employer::create($data);
		$insertedId = $employer->id;

		// Insert Employer house type
		if(Input::get('house_type_id'))
		{
			foreach ($data['house_type_id'] as $key => $housetypeid) {
				if($housetypeid === '8'){
					DB::insert('insert into employer_house_type (employer_id, house_type_id,house_type_other) values (?, ?, ?)', [$insertedId, $housetypeid,$data['house_type_other']]);
				}
				else{ 
					DB::insert('insert into employer_house_type (employer_id, house_type_id,house_type_other) values (?, ?, ?)', [$insertedId, $housetypeid,'']);
				}
		 
			}
		}
		// Insert Employer house type complete
		// Insert Employer family member details
		if(Input::get('family_member_name'))
			{ 
				$familymemberrowcount = count($data['family_member_name']);
					for ($i=0; $i < $familymemberrowcount; $i++) {
						$data['member_date_of_birth'][$i] = $data['family_dob_year'][$i]."-".$data['family_dob_month'][$i]."-".$data['family_dob_day'][$i];
						if($data['family_member_name'][$i] !=''){
							DB::insert('insert into employer_family_member_details (employer_id, family_member_name, relationship, bc_nric_dd_pp_no, member_date_of_birth) values (?, ?, ?, ?, ?)', [$insertedId, $data['family_member_name'][$i],$data['relationship'][$i],$data['bc_nric_dd_pp_no'][$i],$data['member_date_of_birth'][$i]]);
						}
				}	
					
			}
		// Insert Employer family member details complete
		\Session::flash('success', 'Employer profile is saved.');
		if($data['isapp']!=" "){ return redirect("application/create")->with('employer_id_app',[$employer->id])->with('employer_name',[$employer->employer_name]); }else{
		return redirect("employer/");}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$agencies = user::leftjoin('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id','=',2)->lists('company_name','id');
		$employer = Employer::findOrFail($id);
		$employer_date_of_birth = explode('-', $employer['employer_date_of_birth']);
		$employer['employer_year'] =$employer_date_of_birth[0];
		$employer['employer_month'] =$employer_date_of_birth[1];
		$employer['employer_day'] =$employer_date_of_birth[2]; 
		if($employer['employer_office_phone'] == 0){
			$employer['employer_office_phone'] = '';
		}
		if($employer['home_phone'] == 0){
			$employer['home_phone'] = '';
		}
		$employer_document =  DB::table('employer_documents as md')->where('employer_id','=',$id)->get();
		if($employer['spouse_date_of_birth']){
			$spouse_date_of_birth = explode('-', $employer['spouse_date_of_birth']);
			$employer['spouse_year'] =$spouse_date_of_birth[0];
			$employer['spouse_month'] =$spouse_date_of_birth[1];
			$employer['spouse_day'] =$spouse_date_of_birth[2]; 
		}
		$house_type = Housetype::lists('title','id');
		$employer_house_type =  DB::table('employer_house_type')
						->leftjoin('house_type', 'house_type.id', '=', 'employer_house_type.house_type_id')
						->select('house_type.title as house_type_title', "employer_house_type.*")
						->where('employer_id', '=', $id)->where('employer_house_type.deleted', '=', 'N')
						->lists('employer_house_type.house_type_id','house_type_title');
		$other_house_type =  DB::table('employer_house_type')
						->select("employer_house_type.*")
						->where('employer_id', '=', $id)->where('employer_house_type.deleted', '=', 'N')
						->where('house_type_id','=','8')
						->get();
		$employer_family =  DB::table('employer_family_member_details')
						->select("employer_family_member_details.*")
						->where('employer_id', '=', $id)->get();	
		//echo"<pre>";	print_r($other_house_type);exit;		
		return view('sentinel.employer.edit')->with('employer',$employer)->with('house_type',$house_type)->with('employer_house_type',$employer_house_type)->with('employer_family',$employer_family)->with('employer_document',$employer_document)->with('agencies',$agencies)->with('other_house_type',$other_house_type);
	}

	/**
	 * Update the tab0.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$data = $request->all();
		// validation rules
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[a-z \/-]+$/i', $value);
			});
		Validator::extend('float_integer', function($attribute, $value)
			{
			    return preg_match('/^(\d+(.\d+)?$)/', $value);
			});
		if(Input::get('employer_residential_status'))
		{
			$data['employer_residential_status'] = implode(';',$data['employer_residential_status']);
		}else{
			$data['employer_residential_status'] = "";
		}
		if(Input::get('spouse_residential_status'))
		{
			$data['spouse_residential_status'] = implode(';',$data['spouse_residential_status']);
		}else{
			$data['spouse_residential_status'] = "";
		}
		if(Input::get('purpose_to_hire'))
		{
			$data['purpose_to_hire'] = implode(';',$data['purpose_to_hire']);
		}else{
			$data['purpose_to_hire'] = "";
		}
		if(!(Input::get('is_income_tax_libal')))
		{
			$data['is_income_tax_libal']='No';
		}
		if(!(Input::get('is_house_hold_income')))
		{
			$data['is_house_hold_income']='No';
		}
		if(!(Input::get('is_iras_notice')))
		{
			$data['is_iras_notice']='No';
		}
		if(!(Input::get('is_employer_permanent_resident')))
		{
			$data['is_employer_permanent_resident']='No';
		}
		if(!(Input::get('is_house_hold_income')))
		{
			$data['annual_house_hold_income']='';
		}
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'float_integer' => 'Please enter valid income.',
    		'users_agents_id.required' => 'Please select an agency.',
		);
		//$data = Input::merge(array_map('trim', Input::all()));
		//echo "<pre>"; print_r($data); exit;
		// form validation
		if(Auth::user()->hasRole(['admin'])){
		$validator = Validator::make($request->all(), [
				'users_agents_id' => 'required',
				'marital_status' => 'required',
           		'employer_name' => 'required|alpha_spaces|min:3|max:100',
				'spouse_name' => 'required_if:marital_status,Married|alpha_spaces|min:3|max:100',
				'employer_date_of_birth_day' => 'required', 
				'employer_date_of_birth_month' => 'required', 
				'employer_date_of_birth_year' => 'required', 
				'spouse_date_of_birth_day' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_month' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_year' => 'required_if:marital_status,Married', 
				'employer_nric_no' => 'required|alpha_num|max:10',
				'spouse_nric_no' => 'required_if:marital_status,Married|alpha_num|max:10',
				'employer_passport' => 'alpha_num|max:15',
				'spouse_passport' => 'alpha_num|max:15',
				'employer_residential_status' => 'required',
				'spouse_residential_status' => 'required_if:marital_status,Married',
				'employer_profession' => 'min:3|max:255',
				'spouse_profession' => 'min:3|max:255',
				'employer_company' => 'min:3|max:255',
				'spouse_company' => 'min:3|max:255',
				'employer_office_phone' => 'numeric|digits_between:8,15',
				'spouse_office_phone' => 'numeric|digits_between:8,15',
				'employer_mobile_phone' => 'required|numeric|digits_between:8,15',
				'spouse_mobile_phone' => 'required_if:marital_status,Married|numeric|digits_between:8,15',
				'address' => 'required|min:3|max:255',
				'home_phone' => 'numeric|digits_between:8,15',
				'purpose_to_hire' => 'required',
				'job_title' => 'alpha_spaces|min:3|max:100',
				'monthly_income' => 'float_integer|min:3|max:20',
				'annual_house_hold_income' => 'float_integer|min:3|max:20',
        	],$messages);
		}else{
			$validator = Validator::make($request->all(), [
				'marital_status' => 'required',
           		'employer_name' => 'required|alpha_spaces|min:3|max:100',
				'spouse_name' => 'required_if:marital_status,Married|alpha_spaces|min:3|max:100',
				'employer_date_of_birth_day' => 'required', 
				'employer_date_of_birth_month' => 'required', 
				'employer_date_of_birth_year' => 'required', 
				'spouse_date_of_birth_day' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_month' => 'required_if:marital_status,Married', 
				'spouse_date_of_birth_year' => 'required_if:marital_status,Married', 
				'employer_nric_no' => 'required|alpha_num|max:10',
				'spouse_nric_no' => 'required_if:marital_status,Married|alpha_num|max:10',
				'employer_passport' => 'alpha_num|max:15',
				'spouse_passport' => 'alpha_num|max:15',
				'employer_residential_status' => 'required',
				'spouse_residential_status' => 'required_if:marital_status,Married',
				'employer_profession' => 'min:3|max:255',
				'spouse_profession' => 'min:3|max:255',
				'employer_company' => 'min:3|max:255',
				'spouse_company' => 'min:3|max:255',
				'employer_office_phone' => 'numeric|digits_between:8,15',
				'spouse_office_phone' => 'numeric|digits_between:8,15',
				'employer_mobile_phone' => 'required|numeric|digits_between:8,15',
				'spouse_mobile_phone' => 'required_if:marital_status,Married|numeric|digits_between:8,15',
				'address' => 'required|min:3|max:255',
				'home_phone' => 'numeric|digits_between:8,15',
				'purpose_to_hire' => 'required',
				'job_title' => 'alpha_spaces|min:3|max:100',
				'monthly_income' => 'float_integer|min:3|max:20',
				'annual_house_hold_income' => 'float_integer|min:3|max:20',
        	],$messages);
		}
        if ($validator->fails()) {
            return redirect("employer/".$id."/edit?tab=tab0")
                        ->withErrors($validator)
                        ->withInput();
        }
		$data['employer_date_of_birth'] = $data['employer_date_of_birth_year']."-".$data['employer_date_of_birth_month']."-".$data['employer_date_of_birth_day'];
		if(Input::get('spouse_date_of_birth_year')){
			$data['spouse_date_of_birth'] = $data['spouse_date_of_birth_year']."-".$data['spouse_date_of_birth_month']."-".$data['spouse_date_of_birth_day'];
		}
		else{
			$data['spouse_date_of_birth'] = '';
		}
		//echo "<pre>"; print_r($data); exit;
		
		//For admin selected agency assign to employer
		if(Auth::user()->hasRole(['admin'])){
			$data['users_agents_id'] = $data['users_agents_id'];
		}
		
		// Updating fdw data start
			$employer = Employer::findOrFail($id);
			$employer->update($data);
		// Updating data complete

		// Insert Employer house type
		if(Input::get('house_type_id'))
		{
			// delete maid medical disease before insert
				DB::table('employer_house_type as eht')
	            ->where('employer_id', $id)
	            ->update(['eht.deleted' => 'Y']);
			// delete complete
			foreach ($data['house_type_id'] as $key => $housetypeid) {
				if($housetypeid === '8'){
					DB::insert('insert into employer_house_type (employer_id, house_type_id,house_type_other) values (?, ?, ?)', [$id, $housetypeid,$data['house_type_other']]);
				}
				else{ 
					DB::insert('insert into employer_house_type (employer_id, house_type_id,house_type_other) values (?, ?, ?)', [$id, $housetypeid,'']);
				}
		 
			}
		}
		// Insert Employer house type complete
		// Insert Employer family member details
		if(Input::get('family_member_name'))
			{DB::table('employer_family_member_details')->where('employer_id', '=', $id)->delete();
				$familymemberrowcount = count($data['family_member_name']);
					for ($i=0; $i < $familymemberrowcount; $i++) {
						$data['member_date_of_birth'][$i] = $data['family_dob_year'][$i]."-".$data['family_dob_month'][$i]."-".$data['family_dob_day'][$i];
						if($data['family_member_name'][$i] !=''){
							DB::insert('insert into employer_family_member_details (employer_id, family_member_name, relationship, bc_nric_dd_pp_no, member_date_of_birth) values (?, ?, ?, ?, ?)', [$id, $data['family_member_name'][$i],$data['relationship'][$i],$data['bc_nric_dd_pp_no'][$i],$data['member_date_of_birth'][$i]]);
						}
				}	
					
			}
		// Insert Employer family member details complete
		\Session::flash('success', 'Employer profile has been Updated.');
		
		return redirect("employer/");
		
	}
	public function updatedocument($id, Request $request) {
		$data = $request->all();
		$documents = Input::file('document');
	    $uploadcount = 0; 
	    foreach($documents as $document) {
	    	$rules = array('document' => 'Max:2000|mimes:jpeg,bmp,png,jpg,pdf,docx,doc,txt'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
      		$validator = Validator::make(array('document'=> $document), $rules);
      		if ($validator->fails()) {
           		return redirect("employer/".$id."/edit?tab=tab1")
                        ->withErrors($validator)
                        ->withInput();
        		}
	   	}
        $document_upload = EmployerController::multiple_upload($id);
		if ($document_upload) {
				foreach ($document_upload as $key => $fileName) {
					DB::insert('insert into employer_documents (employer_id, title) values (?, ?)', [$id, $fileName]);
				}
	        } 
	    \Session::flash('success', 'Files have been uploaded successfully.');    
	    return redirect("employer/".$id."/edit?tab=tab1");
	}
	/**
	 * Remove the document of fdw
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function documentdelete($employer_id,$id) {
		$document = DB::table('employer_documents as ed')
						->select( "ed.title")
						->where('employer_id', '=', $employer_id)->where('id', '=', $id)->get();
		unlink('uploads/employer_document/'.$document[0]->title);				
		DB::table('employer_documents')->where('employer_id', '=', $employer_id)->where('id', '=', $id)->delete();
		\Session::flash('success', 'Document deleted successfully.');
		return redirect("employer/".$employer_id."/edit?tab=tab1");
	}

	/**
	 * View the document of fdw
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function documentview($docname)
    {
  		$extension = explode('.', $docname);
        $file = 'uploads/employer_document/'.$docname;

        if (File::isFile($file))
             $file = File::get($file);
            $response = Response::make($file, 200);
            $content_types = [
                'application/octet-stream', // txt etc
                'application/msword', // doc
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                'application/vnd.ms-excel', // xls
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
                'application/pdf', // pdf
            ];
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            if ($extension[2] =='pdf' || $extension[2] =='PDF') {
            	$response->header('Content-Type', 'application/pdf');
            }
            elseif ($extension[2] =='docx' || $extension[2] =='DOCX') {
            	$response->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

            }
            elseif ($extension[2] =='txt') {
            	$response->header('Content-Type', 'application/octet-stream');

            }
            else{
            	$response->header('Content-Type', 'application/msword');
            }
            
            return $response;
        }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function delete($id) {
	 	DB::table('employer_personal_details as e')
            ->where('id', $id)
            ->update(['e.deleted' => 'Y']);
       // $del = Fdw::find($id);
        //$del->delete();
		\Session::flash('success', 'Employer profile has been deleted.');
		return redirect('employer');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

	}
	/**
	 * Remove the agency contact detail 
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function familydetaildelete($employer_id,$employer_family_member_id) {
			DB::table('employer_family_member_details')->where('employer_id', '=', $employer_id)->where('id', '=', $employer_family_member_id)->delete();

		\Session::flash('success', 'Employer family member details deleted successfully.');
		return redirect("employer/".$employer_id."/edit?tab=tab0");
	}
	public function employerinfo(){
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		$employer_id   = Input::get('employer_id');
		$employerinfo =  DB::table('employer_personal_details as epd')
						->select('epd.*','mp.status')
						->leftJoin('maid_application as mp','mp.employer_id','=','epd.id' )
						->where('epd.users_agents_id','=',$user_id)
						->where('epd.id','=',$employer_id)
						->where('epd.deleted', '=', 'N')
						->orderBy('mp.created_at','DESC')->distinct()->get();
						//print_r($maidinfo); exit;
		return $employerinfo;
	}
	
}
