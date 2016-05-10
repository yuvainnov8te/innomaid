<?php
 /***********************************************
	 Developed by :- Harendar singh tomar
	 Module       :- Foreign domestic worker
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Fdw as Fdw;
use App\Employer as Employer;
use App\Medicaldesieses as Medicaldesieses;
use App\Workarea as Workarea;
use App\Maidmedicaldesieses as Maidmedicaldesieses;
use App\Educationlevels as Educationlevels;
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
use Image;

class FdwController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		ob_start();
	}

	 public function show($id,$ispdf = false) {

		$user_data = DB::table('maid_personal_details as md')
					->select('md.*','c.name as country_name','c.nationality as nationality_name','u.company_name','u.username','u.image as agency_logo',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'),'e.title as education_level')
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->leftJoin('users as u', 'u.id', '=', 'md.users_agents_id')
					->leftJoin('education_levels as e', 'e.id', '=', 'md.education_level')
					->where('md.deleted','=','N')
					->where('md.id','=',$id)
					->get();
		$medical_desieses = Medicaldesieses::lists('title','id');
		  
		$user_medical_illness =  DB::table('maid_medical_desieses as mmd')
								->select('mmd.maid_id as maid_id','mmd.medical_desieses_id as medical_desieses_id','mmd.description as other_desieses','md.*')
								->leftJoin('medical_desieses as md', 'md.id', '=', 'mmd.medical_desieses_id')
								->where('mmd.maid_id','=',$id)
								->where('mmd.deleted','=','N')
								->get();
		$maid_skills = DB::table('maid_skill_set as mss')
						->leftJoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
						->select('wa.title as workareatitle', 'wa.otherskill',"mss.*")
						->where('mss.maid_id','=',$id)
						->where('wa.otherskill','=','N')
						->where('mss.deleted','=','N')
						->get();

		$maid_employment_history = DB::table('maid_employment_history as meh')
						->leftjoin('countries', 'countries.id', '=', 'meh.country')
						->leftjoin('maid_employment_history_work_area as mehwa', 'mehwa.employment_history_id', '=', 'meh.id')
						->leftjoin('work_area as wa', 'wa.id', '=', 'mehwa.work_area_id')
						->select('countries.name as countryname', "meh.*",DB::Raw("GROUP_CONCAT(DISTINCT (wa.title) SEPARATOR ',') as workareaname"),DB::Raw("GROUP_CONCAT(DISTINCT (wa.id) SEPARATOR ',') as workareaid"))
						->where('maid_id', '=', $id)->groupby('employment_history_id')->get();
		
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.fdws.fdwpdf',array('user_data' => $user_data,'user_medical_illness'=>$user_medical_illness,'maid_skills'=>$maid_skills,'maid_employment_history'=>$maid_employment_history,'medical_desieses'=>$medical_desieses));
	$pdf->output();
	$dom_pdf = $pdf->getDomPDF();
	$canvas =  $dom_pdf->get_canvas();
	$canvas->page_text(250,800 , "Page {PAGE_NUM} of {PAGE_COUNT}",null, 6, array(0,0,0));
        return $pdf->download($user_data[0]->maid_reference_code.'-'.$user_data[0]->name.'.pdf');
	}else{
	//echo "<pre>";	print_r($maid_employment_history); exit;
		return view('sentinel.fdws.show',compact('user_data','user_medical_illness','maid_skills','maid_employment_history'));
		}
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
			$fdwList = DB::table('maid_personal_details as m')
	            ->leftJoin('users as u', 'u.id', '=', 'm.users_agents_id')
				->leftjoin('education_levels', 'education_levels.id', '=', 'm.education_level')
                ->select('education_levels.title as educationlevel', "m.*","u.company_name as username","u.email")
                ->where("m.deleted",'=','N') 
               	->orderBy("m.updated_at", "DESC")
               	->paginate(10);
		}else{
			$fdwList = DB::table('maid_personal_details as m')
					->leftjoin('education_levels', 'education_levels.id', '=', 'm.education_level')
	                ->select('education_levels.title as educationlevel', "m.*")
	                ->where("m.deleted",'=','N') 
	               ->where('m.users_agents_id','=',$user_id)
	               	->orderBy("m.updated_at", "DESC")->paginate(10);
      }

		$total=$fdwList->total();
  	return view('sentinel.fdws.index')->with('fdwList', $fdwList)->with('search',$search)->with('total',$total);
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
        return redirect("fdw")
                    ->withErrors($validator)
                    ->withInput();
		}
		$search=$data['search_term'];
		//print_r($data);exit;
		if($data['search_term'])
		{	
				if(Auth::user()->hasRole(['admin'])){
				$fdwList = DB::table('maid_personal_details as m')
	            ->leftJoin('users as u', 'u.id', '=', 'm.users_agents_id')
				->leftjoin('education_levels', 'education_levels.id', '=', 'm.education_level')
                ->select('education_levels.title as educationlevel', "m.*","u.username","u.email","u.company_name")
                ->where("m.deleted",'=','N') 
				 ->whereRaw("(name like '%$search%')")
               	->orderBy("m.updated_at", "DESC")
               	->paginate(10);
				} else {
				$agencyuser =  DB::table('users as u')
      					->select(DB::Raw("GROUP_CONCAT(DISTINCT (u.id) SEPARATOR ',') as user_id"))
      					->where('u.agency_id','=',$user_id)
      					->orWhere('u.id','=',$user_id)
      					->get();
				if($agencyuser){
      			$user_id = $agencyuser[0]->user_id;
				}
				$fdwList = DB::table('maid_personal_details as m')
				->leftJoin('users as u', 'u.id', '=', 'm.users_agents_id')
					->leftjoin('education_levels', 'education_levels.id', '=', 'm.education_level')
	                ->select('education_levels.title as educationlevel', "m.*","u.username","u.email","u.company_name")
	                ->where("m.deleted",'=','N') 
					 ->whereRaw("(name like '%$search%')")
	                ->whereRaw("m.users_agents_id in ($user_id)")
	               	->orderBy("m.updated_at", "DESC")->paginate(10);

	       
		}
		}
		else
		{
		if(Auth::user()->hasRole(['admin'])){
			$fdwList = DB::table('maid_personal_details as m')
	            ->leftJoin('users as u', 'u.id', '=', 'm.users_agents_id')
				->leftjoin('education_levels', 'education_levels.id', '=', 'm.education_level')
                ->select('education_levels.title as educationlevel', "m.*","u.username","u.email","u.company_name")
                ->where("m.deleted",'=','N') 
               	->orderBy("m.updated_at", "DESC")
               	->paginate(10);
		} else {
			$agencyuser =  DB::table('users as u')
      					->select(DB::Raw("GROUP_CONCAT(DISTINCT (u.id) SEPARATOR ',') as user_id"))
      					->where('u.agency_id','=',$user_id)
      					->orWhere('u.id','=',$user_id)
      					->get();
      		if($agencyuser){
      			$user_id = $agencyuser[0]->user_id;
      		}
			$fdwList = DB::table('maid_personal_details as m')
			->leftJoin('users as u', 'u.id', '=', 'm.users_agents_id')
					->leftjoin('education_levels', 'education_levels.id', '=', 'm.education_level')
	                ->select('education_levels.title as educationlevel', "m.*","u.username","u.email","u.company_name")
	                ->where("m.deleted",'=','N') 
	                ->whereRaw("m.users_agents_id in ($user_id)")
	               	->orderBy("m.updated_at", "DESC")->paginate(10);

	       
	               	//		->where('u.agency_id','=',$user_id);   	
	               		//	
      }
	} 	$total=$fdwList->total();
  	return view('sentinel.fdws.index')->with('fdwList', $fdwList)->with('search',$search)->with('total',$total);
	}

	/**
	 * Function is used for image upload
	 * @return image name
	 */
	public function upload(){
		$image = (Input::file('image'));
		// checking file is valid.
		if (Input::hasFile('image')) {
			    	
		 	$destinationPath = 'uploads/maid_image'; // upload path
			$extension = Input::file('image')->getClientOriginalExtension();// getting image extension
			$fileName = rand(11111,99999).'.'.$extension; // renameing image
		 	$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/maid_image/' . $fileName;
			if( Image::make($image->getRealPath())->resize(300, 500, function($constraint)
			{
			$constraint->aspectRatio();
			})->resizeCanvas(300, 500 ,'center', false)->save($path ,80))
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
     	 		$destinationPath = 'uploads/maid_document';
		        $extension = $file->getClientOriginalName();
		        $filename = rand(11111,99999).'.'.$extension; // renameing image
		        $upload_success = $file->move($destinationPath, $filename);
		        $fileName[]= $filename;
	       
	    }
	    return $fileName;
    }
    
  } 

public function uploadthumbnail(){
		$image =Input::file('profile_image');
		$canvas = Image::canvas(100, 100);
		if (Input::hasFile('profile_image')) {
			    	
			$destinationPath = 'uploads/maid_image'; // upload path
			$extension = Input::file('profile_image')->getClientOriginalExtension();// getting image extension
			$fileName = rand(11111,99999).'.'.$extension; // renameing image
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/maid_image/' . $fileName;
			$path200 = $_SERVER['DOCUMENT_ROOT'].'/uploads/maid_image_size_200/' . $fileName;
			$path300 = $_SERVER['DOCUMENT_ROOT'].'/uploads/maid_image_size_300/' . $fileName;
			if( Image::make($image->getRealPath())->resize(100,100, function($constraint)
			{
			$constraint->aspectRatio();
			})->resizeCanvas(100, 100 ,'center', false)->save($path ,80))
			{ 
				if( Image::make($image->getRealPath())->resize(200,200, function($constraint)
				{
				$constraint->aspectRatio();
				})->resizeCanvas(200, 200 ,'center', false)->save($path200 ,80))
				{
					if( Image::make($image->getRealPath())->resize(300,300, function($constraint)
					{
					$constraint->aspectRatio();
					})->resizeCanvas(300, 300 ,'center', false)->save($path300 ,80))
					{
						// uploading file to given path
						return $fileName;
					}
				}
			}
			else {
				// sending back with error message.
				\Session::flash('error', 'uploaded file is not valid');
				//return Redirect::to('sentinel.fdws.create');
			}
			$path = Input::file('profile_image')->getRealPath();
			 // sending back with message
		}
	}
	
	public function uploadprofiledocument(){
		$profile_document =Input::file('profile_document');
		//$canvas = Image::canvas(100, 100);
		if (Input::hasFile('profile_document')) {
			    	
			$destinationPath = 'uploads/maid_profile'; // upload path
			$extension = Input::file('profile_document')->getClientOriginalExtension();// getting image extension
			$fileName = rand(11111,99999).'.'.$extension; 
			$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/maid_profile/'; 
			$profile_document->move($path, $fileName);
			return $fileName;
			 // sending back with message
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
		$agencies = user::leftjoin('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id','=',2)->lists('company_name','id');
		$countries = Countries::lists('name','id');
		$nationality = Countries::where('display_in_fdw','=','Y')->lists('nationality','id');
		$education_levels = Educationlevels::lists('title','id');
		$medical_desieses = Medicaldesieses::lists('title','id');
		return view('sentinel.fdws.create')->with('countries',$countries)->with('nationality',$nationality)->with('education_levels',$education_levels)->with('medical_desieses',$medical_desieses)->with('agencies',$agencies)->with('isapp',$isapp);
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
			    return preg_match("/^[\pL\s_.']+$/u", $value);
			});
		Validator::extend('special_alpha_num', function($attribute, $value)
			{
			    return preg_match('/^[a-z0-9 \/-]+$/i', $value);
			});
		Validator::extend('float_integer', function($attribute, $value)
			{
			    return preg_match('/^(\d+(.\d+)?$)/', $value);
			});
		if(!(array_key_exists('food_handling_prefrences', $data)))
		{
			$data['food_handling_prefrences']='';
		}else{
			$data['food_handling_prefrences'] = implode(',',$data['food_handling_prefrences']);
		}
		if(!(array_key_exists('children_age', $data)))
		{
			$data['children_age']='';
		}else{
			$data['children_age'] = implode(',', $data['children_age']);
		}
		// form validation
		$data['name'] = trim($data['name']); 
		//echo $request->name = trim($request->name);
		//echo "<pre>"; print_r($request->all()); exit;
		 $messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'profile_image.max' => 'The thumbnail image may not be greater than 2mb in size.',
    		'float_integer' => 'Please enter valid salary.',
    		'float_integer.max' => 'Please enter less than 20 digits.',
    		'other_education.required_if' => 'Please enter education level',
    		'users_agents_id.required' => 'Please select an agency.',
    		'maid_reference_code.special_alpha_num' => 'Please insert a vaild refrence number.'
		);
		 if(Auth::user()->hasRole(['admin'])){
		$validator = Validator::make($data, [
				'users_agents_id' => 'required',
            	'name' => 'required|min:3|max:255|alpha_spaces', 
				'day' => 'required', 
				'month' => 'required', 
				'year' => 'required', 
				'height' => 'numeric|digits_between:1,3',
				'weight' => 'numeric|digits_between:1,3',
				'place_of_birth' => 'required|alpha_spaces|min:3|max:255',
				'nationality' => 'required',
				'address' => 'required|min:3|max:255',
				'port_name' => 'required|min:3|max:255',
				'contact_number' => 'required|digits_between:8,15|numeric',
				'passport_number' => 'max:10',
				'maid_reference_code' => 'required|special_alpha_num|min:3|max:30|unique:maid_personal_details,maid_reference_code,NULL,id,deleted,N',
				'religion' => 'required',
				'education_level' => 'required',
				'other_education' => 'required_if:education_level,5',
				'expected_salary' => 'float_integer|max:20',
				'type' => 'required',
				'marital_status' => 'required',
				'profile_image' => 'mimes:jpeg,bmp,png|max:2048',
				'profile_document' => 'mimes:pdf,docx,doc|max:2048',
				'image' => 'mimes:jpeg,bmp,png',
				'allergy_description' => 'min:3|Max:255',
				'description' => 'Min:3|Max:255',
				'physical_disability_description' => 'min:3|max:255',
				'dietary_restrictions_description' => 'min:3|max:255',
				'food_handling_preference_other' => 'min:3|max:255',
				'medication_remarks' => 'min:3|max:255',
				'no_of_siblings'=>'numeric',
				'no_of_children'=>'numeric',
        ],$messages);
	}else{
		$validator = Validator::make($data, [
            	'name' => 'required|min:3|max:255|alpha_spaces', 
				'day' => 'required', 
				'month' => 'required', 
				'year' => 'required', 
				'height' => 'numeric|digits_between:1,3',
				'weight' => 'numeric|digits_between:1,3',
				'place_of_birth' => 'required|alpha_spaces|min:3|max:255',
				'nationality' => 'required',
				'address' => 'required|min:3|max:255',
				'port_name' => 'required|min:3|max:255',
				'contact_number' => 'required|digits_between:8,15|numeric',
				'passport_number' => 'max:10',
				'maid_reference_code' => 'required|alpha_num|min:3|max:30|unique:maid_personal_details,maid_reference_code,NULL,id,deleted,N',
				'religion' => 'required',
				'education_level' => 'required',
				'other_education' => 'required_if:education_level,5',
				'expected_salary' => 'float_integer|max:20',
				'type' => 'required',
				'marital_status' => 'required',
				'profile_image' => 'mimes:jpeg,bmp,png|max:2048',
				'profile_document' => 'mimes:pdf,docx,doc|max:2048',
				'image' => 'mimes:jpeg,bmp,png',
				'allergy_description' => 'min:3|Max:255',
				'description' => 'Min:3|Max:255',
				'physical_disability_description' => 'min:3|max:255',
				'dietary_restrictions_description' => 'min:3|max:255',
				'food_handling_preference_other' => 'min:3|max:255',
				'medication_remarks' => 'min:3|max:255',
				'no_of_siblings'=>'numeric',
				'no_of_children'=>'numeric',
        ],$messages);
	}
       if($data['isapp']!=" "){
	if ($validator->fails()) {
            return redirect("fdws/create/app")
                        ->withErrors($validator)
                        ->withInput();}
	}
	else{
        if ($validator->fails()) {
            return redirect("fdws/create")
                        ->withErrors($validator)
                        ->withInput();
        }}
		$data['date_of_birth'] = $data['year']."-".$data['month']."-".$data['day'];
		/// form validation complete
		// Image Upload
		$profile_image_name = FdwController::uploadthumbnail();
		$data['profile_image']=$profile_image_name;	

		$image_name = FdwController::upload();
		$data['image']=$image_name;	
		/// image upload complete
		$profile_document = FdwController::uploadprofiledocument();
		$data['profile_document']=$profile_document;	
		/// image upload complete

		//For admin selected agency assign to fdw
		if(Auth::user()->hasRole(['admin'])){
			$data['users_agents_id'] = $data['users_agents_id'];
		}else{// login user agency assign to fdw
			$data['users_agents_id'] = $user_id;
		}

		$maid = Fdw::create($data);
		$insertedId = $maid->id;


		// Insert maid medical disease
		if(array_key_exists('medical_desieses_id', $data))
		{
			foreach ($data['medical_desieses_id'] as $key => $diseaseid) {
				if($diseaseid === 'Others'){
					DB::insert('insert into maid_medical_desieses (maid_id, medical_desieses_id,description) values (?, ?, ?)', [$insertedId, $diseaseid,$data['description']]);
				}
				else{ 
					DB::insert('insert into maid_medical_desieses (maid_id, medical_desieses_id,description) values (?, ?, ?)', [$insertedId, $diseaseid,'']);
				}
		 
			}
		}
		// Insert maid medical disease complete
		//\Session::flash('success', 'FDW profile is saved.');
		if($data['isapp']!=" "){ return redirect("application/create")->with('maid_id_app',[$maid->id])->with('maid_name',[$maid->name]); }else{
		return redirect("fdws/".$insertedId."/edit?tab=tab1");}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$agencies = user::leftjoin('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id','=',2)->lists('company_name','id');
		$countries = Countries::lists('name','id');
		$nationality = Countries::where('display_in_fdw','=','Y')->lists('nationality','id');
		$education_levels = Educationlevels::lists('title','id');
		$medical_desieses = Medicaldesieses::lists('title','id');
		$workarea = DB::table('work_area as wa')->orderBy('wa.order_by', 'asc')->where('wa.deleted', '=', 'N')->get();
		$maid_document =  DB::table('maid_documents as md')->where('maid_id','=',$id)->get();
		$fdw = Fdw::findOrFail($id);
		$date_of_birth = explode('-', $fdw['date_of_birth']);
		$fdw['year'] =$date_of_birth[0];
		$fdw['month'] =$date_of_birth[1];
		$fdw['day'] =$date_of_birth[2]; 
			//	$maid_disease = Maidmedicaldesieses::findOrFail($id);
		$maid_disease =  DB::table('maid_medical_desieses')->where('maid_id', '=', $id)->where('deleted', '=', 'N')->get(); 
		//echo "<pre>"; print_r($maid_disease); exit;
		$skillset =  DB::table('maid_skill_set')
						->leftjoin('work_area', 'work_area.id', '=', 'maid_skill_set.work_area_id')
						->select('work_area.title as workareatitle', "maid_skill_set.*")
						->where('maid_id', '=', $id)->where('otherskill', '=', 'N')->where('maid_skill_set.deleted', '=', 'N')->get();

		$otherskillset =  DB::table('maid_skill_set')
						->leftjoin('work_area', 'work_area.id', '=', 'maid_skill_set.work_area_id')
						->select('work_area.title as workareatitle','work_area.otherskill as otherskill', "maid_skill_set.*")
						->where('maid_id', '=', $id)->where('otherskill', '=', 'Y')->where('maid_skill_set.deleted', '=', 'N')->get();
			//echo '<pre>'; print_r($otherskillset); exit;					
		$employmenthistory =  DB::table('maid_employment_history as meh')
						->leftjoin('countries', 'countries.id', '=', 'meh.country')
						->leftjoin('maid_employment_history_work_area as mehwa', 'mehwa.employment_history_id', '=', 'meh.id')
						->leftjoin('work_area as wa', 'wa.id', '=', 'mehwa.work_area_id')
						->select('countries.name as countryname', "meh.*",DB::Raw("GROUP_CONCAT(DISTINCT (wa.title) SEPARATOR ';') as workareaname"),DB::Raw("GROUP_CONCAT(DISTINCT (wa.id) SEPARATOR ';') as workareaid"))
						->where('maid_id', '=', $id)->groupby('employment_history_id')->get();
		/*$employmenthistoryworkarea =  DB::table(' as ')
						->leftjoin('work_area as wa', 'wa.id', '=', 'mehwa.work_area_id')
						->select("mehwa.employment_history_id",DB::Raw("GROUP_CONCAT(DISTINCT (wa.title) SEPARATOR ';') as workareaname"))
						->where('employment_history_id', '=', $$employmenthistory->id)->where('wa.deleted', '=', 'N')->groupby('employment_history_id')->get();		*/					
		return view('sentinel.fdws.edit',  compact('fdw'))->with('countries',$countries)->with('nationality',$nationality)->with('education_levels',$education_levels)->with('medical_desieses',$medical_desieses)->with('maid_disease',$maid_disease)->with('workarea',$workarea)->with('skillset',$skillset)->with('otherskillset',$otherskillset)->with('employmenthistory',$employmenthistory)->with('maid_document',$maid_document)->with('agencies',$agencies);
	}

	/**
	 * Update the tab0.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$data = $request->all();
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match("/^[\pL\s_.']+$/u", $value);
			});
		Validator::extend('special_alpha_num', function($attribute, $value)
			{
			    return preg_match('/^[a-z0-9 \/-]+$/i', $value);
			});
		Validator::extend('float_integer', function($attribute, $value)
			{
			    return preg_match('/^(\d+(.\d+)?$)/', $value);
			});
		if(!(array_key_exists('allergies', $data)))
		{
			$data['allergies']='No';
		}
		
		if(!(array_key_exists('physical_disablity', $data)))
		{
			$data['physical_disablity']='No';
		}
		if(!(array_key_exists('dietary_restrictions', $data)))
		{
			$data['dietary_restrictions']='No';
		}
		if(!(array_key_exists('food_handling_prefrences', $data)))
		{
			$data['food_handling_prefrences']='';
		}else{
			$data['food_handling_prefrences'] = implode(',',$data['food_handling_prefrences']);
		}
		if(!(array_key_exists('children_age', $data)))
		{
			$data['children_age']='';
		}else{
			$data['children_age'] = implode(',', $data['children_age']);
		}
		
		if(!(array_key_exists('can_be_interviewed_via', $data)))
		{
			$data['can_be_interviewed_via']='';
		}else{
			$data['can_be_interviewed_via'] = implode(';',$data['can_be_interviewed_via']);
		}
		$data['name'] = trim($data['name']); 
		//echo $request->name = trim($request->name);
		//echo "<pre>"; print_r($request->all()); exit;
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'profile_image.max' => 'The thumbnail image may not be greater than 2mb in size.',
    		'float_integer' => 'Please enter valid salary.',
    		'float_integer.max' => 'Please enter less than 20 digits.',
    		'other_education.required_if' => 'Please enter education level',
    		'users_agents_id.required' => 'Please select an agency.',
    		'maid_reference_code.special_alpha_num' => 'Please insert a vaild refrence number.'
		);
		if(Auth::user()->hasRole(['admin'])){
		 $validator = Validator::make($data, [
		 		'users_agents_id' => 'required',
            	'name' => 'required|Min:3|Max:255|alpha_spaces', 
				'day' => 'required', 
				'month' => 'required', 
				'year' => 'required', 
				'height' => 'numeric|digits_between:1,3',
				'weight' => 'numeric|digits_between:1,3',
				'place_of_birth' => 'required|alpha_spaces|Min:3|Max:255',
				'nationality' => 'required',
				'address' => 'required|Min:3|Max:255',
				'port_name' => 'required|Min:3|Max:255',
				'contact_number' => 'required|digits_between:8,15|numeric',
				'passport_number' => 'max:10',
				'maid_reference_code' => 'required|special_alpha_num|min:3|max:30|unique:maid_personal_details,maid_reference_code,'.$id.',id,deleted,N',
				'religion' => 'required',
				'education_level' => 'required',
				'other_education' => 'required_if:education_level,5',
				'type' => 'required',
				'expected_salary' => 'float_integer|max:20',
				'marital_status' => 'required',
				'profile_image' => 'mimes:jpeg,bmp,png|max:2048',
				'image' => 'mimes:jpeg,bmp,png',
				'allergy_description' => 'Min:3|Max:255',
				'description' => 'Min:3|Max:255',
				'physical_disability_description' => 'Min:3|Max:255',
				'dietary_restrictions_description' => 'Min:3|Max:255',
				'food_handling_preference_other' => 'Min:3|Max:255',
				'medication_remarks' => 'Min:3|Max:255',
				'no_of_siblings'=>'numeric',
				'no_of_children'=>'numeric',
        ],$messages);
		}
		else{
			 $validator = Validator::make($data, [
            	'name' => 'required|Min:3|Max:255|alpha_spaces', 
				'day' => 'required', 
				'month' => 'required', 
				'year' => 'required', 
				'height' => 'numeric|digits_between:1,3',
				'weight' => 'numeric|digits_between:1,3',
				'place_of_birth' => 'required|alpha_spaces|Min:3|Max:255',
				'nationality' => 'required',
				'address' => 'required|Min:3|Max:255',
				'port_name' => 'required|Min:3|Max:255',
				'contact_number' => 'required|digits_between:8,15|numeric',
				'passport_number' => 'max:10',
				'maid_reference_code' => 'required|alpha_num|min:3|max:30|unique:maid_personal_details,maid_reference_code,'.$id.',id,deleted,N',
				'religion' => 'required',
				'education_level' => 'required',
				'other_education' => 'required_if:education_level,5',
				'type' => 'required',
				'expected_salary' => 'float_integer|max:20',
				'marital_status' => 'required',
				'profile_image' => 'mimes:jpeg,bmp,png|max:2048',
				'image' => 'mimes:jpeg,bmp,png',
				'allergy_description' => 'Min:3|Max:255',
				'description' => 'Min:3|Max:255',
				'physical_disability_description' => 'Min:3|Max:255',
				'dietary_restrictions_description' => 'Min:3|Max:255',
				'food_handling_preference_other' => 'Min:3|Max:255',
				'medication_remarks' => 'Min:3|Max:255',
				'no_of_siblings'=>'numeric',
				'no_of_children'=>'numeric',
        ],$messages);
		}
        if ($validator->fails()) {
            return redirect("fdws/".$id."/edit?tab=tab0")
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['date_of_birth'] = $data['year']."-".$data['month']."-".$data['day'];
		// Image Upload
			
				$profile_image_name = FdwController::uploadthumbnail();
				if($profile_image_name){
					$data['profile_image']=$profile_image_name;	
				}	

			$image_name = FdwController::upload();
			    if($image_name){
			    $data['image']=$image_name;
			}
			
			$profile_document = FdwController::uploadprofiledocument();
			    if($profile_document){
			    $data['profile_document']=$profile_document;
			}
		/// image upload complete
		//$data['overall_remarks'] = 'tesstt';
		
		//For admin selected agency assign to fdw
		if(Auth::user()->hasRole(['admin'])){
			$data['users_agents_id'] = $data['users_agents_id'];
		}
		
		// Updating fdw data start
			$Fdw = Fdw::findOrFail($id);
			$Fdw->update($data);
		// Updating data complete
	// delete maid medical disease before insert
				DB::table('maid_medical_desieses as m')
	            ->where('maid_id', $id)
	            ->update(['m.deleted' => 'Y']);
				// delete complete
		// Insert maid medical disease
			if(array_key_exists('medical_desieses_id', $data))
			{
				foreach ($data['medical_desieses_id'] as $key => $diseaseid) {
					if($diseaseid === 'Others'){
						DB::insert('insert into maid_medical_desieses (maid_id, medical_desieses_id,description) values (?, ?, ?)', [$id, $diseaseid,$data['description']]);
					}
					else{ 
						DB::insert('insert into maid_medical_desieses (maid_id, medical_desieses_id,description) values (?, ?, ?)', [$id, $diseaseid,'']);
					}
			 
				}
			}
		// Insert maid medical disease complete

		//Insert skills of fdw start
			
		//Insert skills of fdw complete

		//Insert Education History of fdw start
			if(array_key_exists('date_from', $data))
			{
				$eduhistoryrowcount = count($data['date_from']);
						if($data['date_from'] !=''){
							DB::insert('insert into maid_employment_history(maid_id, from_month, to_month,date_from, date_to, country, employer,employment_remarks,employer_feedback,other_country,other_workarea) values (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)', [$id,$data['from_month'],$data['to_month'], $data['date_from'],$data['date_to'],$data['country'],$data['employer'],$data['employment_remarks'],$data['employer_feedback'],$data['other_country'],$data['other_workarea']]);
							$empolymenthistoryid =  DB::getPdo()->lastInsertId();
							//Insert Education history work area of fdw start
							if(array_key_exists('work_area_history_id', $data))
							{
								$historyworkarearowcount = count($data['work_area_history_id']);
								for ($i=0; $i < $historyworkarearowcount; $i++) {
									if($data['work_area_history_id'][$i] !=''){
										DB::insert('insert into maid_employment_history_work_area (work_area_id, employment_history_id) values (?, ?)', [$data['work_area_history_id'][$i],$empolymenthistoryid]);
									}
								}
							}
						}
						//Insert Education history work area of fdw complete	
					
			} 
		//Insert Education History of fdw complete
		\Session::flash('success', 'FDW profile has been Updated.');
		if (isset($data['submit_list'])) {
			return redirect("fdws");
		}
		else{
			return redirect("fdws/".$id."/edit?tab=tab1");
		}
	}



	/**
	 * Update the tab1 skill.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateskill($id, Request $request) {
		$data = $request->all();
		
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		 Validator::extend('alpha_special', function($attribute, $value)
      		{
         	 return preg_match('/^[ A-Za-z0-9_.-]*$/', $value);
      		});
		if(!(array_key_exists('interviewed_by', $data)))
		{
			$data['interviewed_by']='';
		}else{
			$data['interviewed_by'] = implode(';',$data['interviewed_by']);
		}
		
		if(!(array_key_exists('interview_method', $data)))
		{
			$data['interview_method']='';
		}else{
			$data['interview_method'] = implode(';',$data['interview_method']);
		}
		if(!(array_key_exists('training_center', $data)))
		{
			$data['training_center']='';
		}
		if(!(array_key_exists('audited_by_EA', $data)))
		{
			$data['audited_by_EA']='';
		}
		$messages = array(
		 'alpha_special' => 'Please enter letters, numbers and underscore  values.',
		);
		 $validator = Validator::make($request->all(), [
           	'interviewed_by'=>'required',
           	'interview_method' => 'required_if:interviewed_by,Singapore EA|required_if:interviewed_by,Overseas Training Centre',	'training_center'=>'alpha_special|min:3|max:100',
		'audited_by_EA'=>'alpha_special|min:3|max:100',
        	]);

        if ($validator->fails()) {
            return redirect("fdws/".$id."/edit?tab=tab1")
                        ->withErrors($validator)
                        ->withInput();
        }
		// Image Upload
			$image_name = FdwController::upload();
			    if($image_name){
			    $data['image']=$image_name;
			}
		
		// Updating fdw data start
			$Fdw = Fdw::findOrFail($id);
			$Fdw->update($data);
		// Updating data complete

		//Insert skills of fdw start
			if(array_key_exists('work_area_id', $data))
			{DB::table('maid_skill_set')->where('maid_id', '=', $id)->where('deleted', '=', 'N')->delete();
				$skilrowcount = count($data['work_area_id']);
				for ($i=0; $i < $skilrowcount; $i++) {
					if($data['work_area_id'][$i] !=''){
						if(array_key_exists($i, $data['experience']))
						{	
						}
						else{
							$data['experience'][$i] = 'No';
						}
						if(array_key_exists($i, $data['rating']))
						{
						}
						else{
							$data['rating'][$i] = '1';
						}
						if(array_key_exists($i, $data['feedback_comment']))
						{
						}
						else{
							$data['feedback_comment'][$i] = '';
						}
						if($data['work_area_id'][$i] !='6'){
							
							DB::insert('insert into maid_skill_set (maid_id, work_area_id, willingness, experience, rating, feedback_comment,interview_type) values (?, ?, ?, ?, ?, ?,?)', [$id, $data['work_area_id'][$i],$data['willingness'][$i],$data['experience'][$i],$data['rating'][$i],$data['feedback_comment'][$i],$data['interview_type'][$i]]);
						}
						
						else{
							//print($data['feedback_comment'][$i]);exit;
						DB::insert('insert into maid_skill_set (maid_id, work_area_id,  feedback_comment,interview_type) values (?, ?,?,?)', [$id, $data['work_area_id'][$i],$data['feedback_comment'][$i],$data['interview_type'][$i]]);
					}
					}
				}
			}	
		//Insert skills of fdw complete
		\Session::flash('success', 'FDW profile has been Updated.');
		if (isset($data['submit_list'])) {
			return redirect("fdws");
		}
		else{
			return redirect("fdws/".$id."/edit?tab=tab2");
		}
		
	}


	/**
	 * Update the tab1 Employment history.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateemploymenthistory($id, Request $request) {
		$data = $request->all();
		if(isset($data['submit_next']) == "next")
		{
		return redirect("fdws/".$id."/edit?tab=tab3");
		}
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		
		
		if(!(array_key_exists('interview_method', $data)))
		{
			$data['interview_method']='';
		}else{
			$data['interview_method'] = implode(';',$data['interview_method']);
		}
		//echo "<pre>"; print_r($data); exit;

		$validator = Validator::make($request->all(), [
            	'date_from' => 'required',
				'date_to' => 'required',
				'employer' =>'required',
				'country' => 'required',
				'other_country' => 'required_if:country,Others',
        ]);

        if ($validator->fails()) {
            return redirect("fdws/".$id."/edit?tab=tab2")
                        ->withErrors($validator)
                        ->withInput();
        }

		//Insert Education History of fdw start
			if(array_key_exists('date_from', $data))
			{
				$eduhistoryrowcount = count($data['date_from']);
						if($data['date_from'] !=''){
							DB::insert('insert into maid_employment_history (maid_id, from_month, to_month, date_from, date_to, country, employer,employment_remarks,employer_feedback,other_country,other_workarea) values (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)', [$id,$data['from_month'],$data['to_month'], $data['date_from'],$data['date_to'],$data['country'],$data['employer'],$data['employment_remarks'],$data['employer_feedback'],$data["other_country"],$data["other_workarea"]]);
							$empolymenthistoryid =  DB::getPdo()->lastInsertId();
							//Insert Education history work area of fdw start
							if(array_key_exists('work_area_history_id', $data))
							{
								$historyworkarearowcount = count($data['work_area_history_id']);
								for ($i=0; $i < $historyworkarearowcount; $i++) {
									if($data['work_area_history_id'][$i] !=''){
										DB::insert('insert into maid_employment_history_work_area (work_area_id, employment_history_id) values (?, ?)', [$data['work_area_history_id'][$i],$empolymenthistoryid]);
									}
								}
							}
						}
						//Insert Education history work area of fdw complete	
					
			}
		//Insert Education History of fdw complete
		\Session::flash('success', 'FDW profile has been Updated.');
		if (isset($data['submit_list'])) {
			return redirect("fdws");
		}
		elseif (isset($data['submit'])) {
			return redirect("fdws/".$id."/edit?tab=tab2");
		}
		else{
			return redirect("fdws/".$id."/edit?tab=tab3");
		}
		
	}
	public function updateemploymenthistoryupdate($id, Request $request) {
		$data = $request->all();
//echo '<pre>';		//print_r($data);echo '</pre>';exit;
		if(isset($data['submit_next']) == "next")
		{
		return redirect("fdws/".$id."/edit?tab=tab3");
		}
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		
		
		if(!(array_key_exists('interview_method', $data)))
		{
			$data['interview_method']='';
		}else{
			$data['interview_method'] = implode(';',$data['interview_method']);
		}
		//echo "<pre>"; print_r($data); exit;

		$validator = Validator::make($request->all(), [
            	'date_from' => 'required',
				'date_to' => 'required',
				'employer' =>'required',
				'country' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect("fdws/".$id."/edit?tab=tab2")
                        ->withErrors($validator)
                        ->withInput();
        }

		//Insert Education History of fdw start
			if(array_key_exists('date_from', $data))
			{
				$eduhistoryrowcount = count($data['date_from']);
						if($data['date_from'] !=''){
							DB::table('maid_employment_history')
            				->where('id',$data['id'])
							->update(array('from_month'=>$data['from_month'],'to_month'=>$data['to_month'],'date_from'=>$data['date_from'], 'date_to'=>$data['date_to'], 'country'=>$data['country'], 'employer'=>$data['employer'],'employment_remarks'=>$data['employment_remarks'],'employer_feedback'=>$data['employer_feedback']));
							/*DB::update('update maid_employment_history set (date_from, date_to, country, employer,employment_remarks,employer_feedback) values (?, ?, ?, ?, ?, ?) where id=?', [$data['date_from'],$data['date_to'],$data['country'],$data['employer'],$data['employment_remarks'],$data['employer_feedback'],$data['id']]);*/
							$empolymenthistoryid =  $data['id'];
							//Insert Education history work area of fdw start
						DB::table('maid_employment_history_work_area')->where('employment_history_id', '=', $empolymenthistoryid)->delete();
						if($data['work_area_history_id']){$data['work_area_history_id']=
							explode(',',$data['work_area_history_id']);}
							if(array_key_exists('work_area_history_id', $data))
							{
								$historyworkarearowcount = count($data['work_area_history_id']);
								for ($i=0; $i < $historyworkarearowcount; $i++) {
									if($data['work_area_history_id'][$i] !=''){
									
										DB::insert('insert into maid_employment_history_work_area (work_area_id, employment_history_id) values (?, ?)', [$data['work_area_history_id'][$i],$empolymenthistoryid]);
									}
								}
							}
						}
						//Insert Education history work area of fdw complete	
					
			}
		//Insert Education History of fdw complete
		return '1';
		
		
	}


	/**
	 * Update the tab2 Other
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateother($id, Request $request) {
		$data = $request->all();
		
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		
		
		
		if(!(array_key_exists('can_be_interviewed_via', $data)))
		{
			$data['can_be_interviewed_via']='';
		}else{
			$data['can_be_interviewed_via'] = implode(';',$data['can_be_interviewed_via']);
		}

		$validator = Validator::make($request->all(), [
            'can_be_interviewed_via' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect("fdws/".$id."/edit?tab=tab3")
                        ->withErrors($validator)
                        ->withInput();
        }
		// Updating fdw data start
			$Fdw = Fdw::findOrFail($id);
			$Fdw->update($data);
		// Updating data complete
		\Session::flash('success', 'FDW profile has been Updated.');
		if (isset($data['submit_list'])) {
			return redirect("fdws");
		}else{
			return redirect("fdws/".$id."/edit?tab=tab4");
		}
		
	}

		public function updatedocument($id, Request $request) {
		$data = $request->all();
		$documents = Input::file('document');
		if (Input::hasFile('document')) {
	    $uploadcount = 0; 
	    foreach($documents as $document) {
	    	$rules = array('document' => 'Max:2000|mimes:jpeg,bmp,png,jpg,pdf,docx,doc,txt'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
      		$validator = Validator::make(array('document'=> $document), $rules);
      		if ($validator->fails()) {
           		return redirect("fdws/".$id."/edit?tab=tab4")
                        ->withErrors($validator)
                        ->withInput();
        		}
	   		}
		}
        $document_upload = FdwController::multiple_upload($id);
		if ($document_upload) {
				foreach ($document_upload as $key => $fileName) {
					DB::insert('insert into maid_documents (maid_id, title) values (?, ?)', [$id, $fileName]);
				}
	        } 
	    if ($document_upload) {    
	    	\Session::flash('success', 'Files have been uploaded successfully.');    
		}   
	    return redirect("fdws/".$id."/edit?tab=tab4");
	}
	
	public function updateintro($id, Request $request) {
		$data = $request->all();
		
		$messages = array(
		);
		$validator = Validator::make($request->all(), [
				'intro' => 'required',
        	],$messages);

        if ($validator->fails()) {
            return redirect("fdws/".$id."/edit?tab=tab5")
                        ->withErrors($validator)
                        ->withInput();
        }
		$Fdw = Fdw::findOrFail($id);
			$Fdw->update($data);//print_r($data); exit;
			   \Session::flash('success', 'Files have been uploaded successfully.');    
	   	if (isset($data['submit_list'])) {
			return redirect("fdws");
		}
		else{
	    return redirect("fdws/".$id."/edit?tab=tab5");
		}
	}
public function updatenotes($id, Request $request) {
		$data = $request->all();
		
		$messages = array(
		);
		$validator = Validator::make($request->all(), [
				'note_for_maid' => 'required',
        	],$messages);

        if ($validator->fails()) {
            return redirect("fdws/".$id."/edit?tab=tab6")
                        ->withErrors($validator)
                        ->withInput();
        }
		$Fdw = Fdw::findOrFail($id);
			$Fdw->update($data);//print_r($data); exit;
			   \Session::flash('success', 'Files have been uploaded successfully.');    
	   	if (isset($data['submit_list'])) {
			return redirect("fdws");
		}
		else{
	    return redirect("fdws/".$id."/edit?tab=tab6");
		}
	}
	/**
	 * Remove the document of fdw
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function documentdelete($maid_id,$id) {
		$document = DB::table('maid_documents as md')
						->select( "md.title")
						->where('maid_id', '=', $maid_id)->where('id', '=', $id)->get();
		unlink('uploads/maid_document/'.$document[0]->title);				
		DB::table('maid_documents')->where('maid_id', '=', $maid_id)->where('id', '=', $id)->delete();
		\Session::flash('success', 'Document deleted successfully.');
		return redirect("fdws/".$maid_id."/edit?tab=tab4");
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
        $file = 'uploads/maid_document/'.$docname;

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
		DB::table('maid_personal_details as m')
            ->where('id', $id)
            ->update(['m.deleted' => 'Y']);
       // $del = Fdw::find($id);
        //$del->delete();
		\Session::flash('success', 'FDW profile has been deleted.');
		return redirect('fdws');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

		Fdw::find($id)->delete();
		
		\Session::flash('success', 'FDW profile has been deleted.');
		return Redirect::route('fdws');
	}

	/**
	 * Remove the skill detail of fdw
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function maidskilldelete($maid_id,$work_area_id) {
		DB::table('maid_skill_set')->where('maid_id', '=', $maid_id)->where('work_area_id', '=', $work_area_id)->where('deleted', '=', 'N')->delete();
		$tab = array('tab'=>'tab1');
		\Session::flash('success', 'Work area deleted successfully.');
		return redirect("fdws/".$maid_id."/edit?tab=tab1");
	}*/

	/**
	 * Remove the education history detail of fdw
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function maidemploymentdelete($maid_id,$employmentid) {
		DB::table('maid_employment_history_work_area')->where('employment_history_id', '=', $employmentid)->delete();
			DB::table('maid_employment_history')->where('maid_id', '=', $maid_id)->where('id', '=', $employmentid)->delete();

		\Session::flash('success', 'Employment history deleted successfully.');
		return redirect("fdws/".$maid_id."/edit?tab=tab2");
	}

	/**
	 * Ajax call from service fees module to get some information of fdw
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function fdwinfo() { 
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		$refer_code   = Input::get('refer_code');
		$maid_id   = Input::get('maid_id');
		if($maid_id){
			$maidinfo =  DB::table('maid_personal_details as mpd')
						->leftJoin('countries as c', 'c.id', '=', 'mpd.nationality')
						->select("mpd.name","c.nationality","mpd.id",'mpd.maid_reference_code','mpd.date_of_birth','mpd.contact_number','mpd.marital_status','mpd.address')
						->where('mpd.id', '=', $maid_id)
						->where('mpd.users_agents_id','=',$user_id)
						->where('mpd.deleted', '=', 'N')->get();
		}else{
			$maidinfo =  DB::table('maid_personal_details as mpd')
						->leftJoin('countries as c', 'c.id', '=', 'mpd.nationality')
						->select("mpd.name","c.nationality","mpd.id",'mpd.maid_reference_code','mpd.date_of_birth','mpd.contact_number','mpd.marital_status','mpd.address')
						->where('mpd.maid_reference_code', '=', $refer_code)
						->where('mpd.users_agents_id','=',$user_id)
						->where('mpd.deleted', '=', 'N')->get();
		}
		
		$app_data= DB::table('maid_application as mp')
			->select("mp.carry_forward_loan")
            ->where('maid_id', $maid_id)
		->where('mp.status','=',"free")
		->orderBy("created_at", "DESC")
			->first();		//print_r($app_data); 
		return array ($maidinfo ,$app_data);
	}
	/**
	 * Ajax call from service fees module to get some information of fdw
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function download_document() { 
    $file_names = array('robots.txt','Steps for Put Question and Answer.docx');
	$archive_file_name= 'DEMOphp.zip';
 
		//Download Files path
		$file_path=$_SERVER['DOCUMENT_ROOT'].'/public/';
    # create new zip opbject
    	$zip = new ZipArchive();
	//create the file and throw the error if unsuccessful
	if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
    	exit("cannot open");
	}
	//add each files of $file_name array to archive
	foreach($file_names as $files)
	{
  		$zip->addFile($file_path.$file_names,$file_names);
		//echo $file_path.$files,$files."";
	}
	$zip->close();
	//then send the headers to foce download the zip file
	header("Content-type: application/zip"); 
	header("Content-Disposition: attachment; filename=$archive_file_name"); 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	readfile("$archive_file_name");
	exit;
    }
	public function tumbnailimagedelete($fdw_id,$image_name) { 
    	unlink('uploads/maid_image/'.$image_name);				
		$Fdw = Fdw::findOrFail($fdw_id);
		$data['profile_image']='';
		$Fdw->update($data);
		return redirect("fdws/".$fdw_id."/edit?tab=tab0");

    }
    public function profileimagedelete($fdw_id,$image_name) { 
    	unlink('uploads/maid_image/'.$image_name);				
		$Fdw = Fdw::findOrFail($fdw_id);
		$data['image']='';
		$Fdw->update($data);
		return redirect("fdws/".$fdw_id."/edit?tab=tab0");

    }
}
