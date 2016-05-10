<?php namespace App\Http\Controllers;

use DB;
use Redirect;
use Cart;
use App\Fdw as Fdw;
use App\Requestmaid as Requestmaid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Input;
use Mail;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*public function __construct()
	{
		$this->middleware('guest');
	}*/

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{ 
		//echo $_GET['Ajaxcall'];
		$countries_data =DB::table('countries')->where('display_in_fdw','=','Y')->orderBy('order_by', 'asc')->lists('nationality','id');

		$workarea_data =DB::table('work_area')->where('otherskill', '=', 'N')->whereRaw('id NOT IN (6,17,18)')->orderBy('order_by', 'asc')->lists('title','id');

		$user_data = DB::table('maid_personal_details as md')
						->select('md.*','c.name as country_name','u.company_name',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'))
						->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
						->leftJoin('users as ur', 'ur.id', '=', 'md.users_agents_id')
						->leftJoin('agencies as u', 'u.id', '=', 'ur.agency_id')
						->where('md.deleted','=','N')
						->where('u.activated','=',1)
						->where('md.availability','!=','Unpublished for display')
						->where('display_biodata','=','Yes')
						->whereRaw('md.nationality in (11,6,12,14,18)');
		//$agency=DB::table('agencies')->select('company_name')->where('activated','=',1)->get(); print_r($agency);
		$data=$user_data->orderByRaw("RAND()")->get();
	
		
    	$count = count($data);
		
		return view('index',compact('count','countries_data','data','workarea_data'));
	}
	public function maidprofilelist()
	{ 
		//echo $_GET['Ajaxcall'];
		$countries_data =DB::table('countries')->orderBy('nationality', 'asc')->lists('nationality','id');

		$workarea_data =DB::table('work_area')->orderBy('order_by', 'asc')->lists('title','id');

		
		return view('maidprofilelisting',compact('countries_data','workarea_data'));
	}
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function maidlisting()
	{ 
		$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 10;
	$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;

		$countries_data =DB::table('countries')->orderBy('nationality', 'asc')->lists('nationality','id');

		$workarea_data =DB::table('work_area')->orderBy('order_by', 'asc')->lists('title','id');

		$user_data = DB::table('maid_personal_details as md')->take($limit)->skip($offset)
						->select('md.*','c.name as country_name','u.company_name',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'))
						->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
						->leftJoin('users as ur', 'ur.id', '=', 'md.users_agents_id')
						->leftJoin('agencies as u', 'u.id', '=', 'ur.agency_id')
						->where('md.deleted','=','N')
						->where('md.availability','!=','Unpublished for display')
						->where('display_biodata','=','Yes');

		 $data=$user_data->get();
echo json_encode( $data);
		
    	$count = count($data);
		
		//return view('index',compact('count','countries_data','data','workarea_data'));
	}
	/**
	 * Show the application details screen to the user.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$user_data = DB::table('maid_personal_details as md')
					->select('md.*','c.name as country_name','c.nationality as nationality_name','e.title as education_level','u.company_name','u.email',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'))
					->leftJoin('education_levels as e', 'e.id', '=', 'md.education_level')
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->leftJoin('users as ur', 'ur.id', '=', 'md.users_agents_id')
					->leftJoin('agencies as u', 'u.id', '=', 'ur.agency_id')
					->where('md.deleted','=','N')
					->where('md.id','=',$id)
					->get();

		$user_medical_illness =  DB::table('maid_medical_desieses as mmd')
								->select('mmd.maid_id as maid_id','mmd.medical_desieses_id as medical_desieses_id','mmd.description as other_desieses','md.*')
								->leftJoin('medical_desieses as md', 'md.id', '=', 'mmd.medical_desieses_id')
								->where('mmd.maid_id','=',$id)
								->where('mmd.deleted','=','N')
								->get();
		$maid_skills = DB::table('maid_skill_set as mss')
						->leftJoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
						->where('mss.maid_id','=',$id)
						->where('mss.deleted','=','N')
						->where('mss.interview_type','=','Singapore EA')
						->where('wa.title','!=','Care for Special Needs')
						->where('wa.title','!=','Other skills, if any')
						->get();

		$maid_employment_history = DB::table('maid_employment_history as meh')
						->leftjoin('countries', 'countries.id', '=', 'meh.country')
						->leftjoin('maid_employment_history_work_area as mehwa', 'mehwa.employment_history_id', '=', 'meh.id')
						->leftjoin('work_area as wa', 'wa.id', '=', 'mehwa.work_area_id')
						->select('countries.name as countryname', "meh.*",DB::Raw("GROUP_CONCAT(DISTINCT (wa.title) SEPARATOR ',') as workareaname"))
						->where('maid_id', '=', $id)->groupby('employment_history_id')->get();
			
		return view('maid_details',compact('user_data','user_medical_illness','maid_skills','maid_employment_history'));
	}

	public function search(Request $request) 
    {	
    	$keyword = \Request::segment(2); 
    	if($keyword == 'Philippines'){
    		$nationality = 11;
    	}
    	else if($keyword == 'Indonesian'){
    		$nationality = 12;
    	}
    	else if($keyword == 'Myanmarese'){
    		$nationality = 18;
    	}
    	else if($keyword == 'Indian'){
    		$nationality = 6;
    	}
    	else if($keyword == 'Bangladeshi'){
    		$nationality = 15;
    	}
    	else if($keyword == 'Sri-Lankan'){
    		$nationality = 14;
    	}
    	else if(\Request::input('country_id')){
    		$nationality = \Request::input('country_id');
    	}else{
    		$nationality = '';
    	}
    	if(\Request::input('age')){
    		$age = explode('-', \Request::input('age'));
    		$minAge = $age[0];
    		$maxAge = $age[1];
    	}else{
    		$minAge = '';
    		$maxAge = '';
    	}
    	if(\Request::input('expected_salary')){
    		$salary = explode('-', \Request::input('expected_salary'));
    		$minSalary = $salary[0];
    		$maxSalary = $salary[1];
    	}else{
    		$minSalary = '';
    		$maxSalary = '';
    	}
    	if(\Request::input('skill_id')){
    		$skill_id= \Request::input('skill_id');
    	}else{
    		$skill_id= ''; 
    	}
    	if(\Request::input('maid_name')){
    		$maid_name= \Request::input('maid_name');
    	}else{
    		$maid_name= ''; 
    	}
    	if($keyword == 'Transfer'){
			$type= 'Transfer';
		}
    	else if(\Request::input('type')){
    		$type=  \Request::input('type'); 
    	}else{
    		$type=  ''; 
    	}
    	if($keyword == 'Experienced'){
			$experienced= 'yes';
		}
    	else if(\Request::input('experienced')){
    		$experienced=  \Request::input('experienced'); 
    	}else{
    		$experienced=  ''; 
    	}
       //	$nationality = \Request::input('country_id'); 
       //$minAge = \Request::input('age_from');
       //	$maxAge = \Request::input('age_to');
       //	$skill_id= \Request::input('skill_id');
       //	$type=  \Request::input('type'); 
       $countries_data =DB::table('countries')->orderBy('nationality', 'asc')->lists('nationality','id');
       $workarea_data =DB::table('work_area')->orderBy('order_by', 'asc')->lists('title','id');

              if($nationality|| $maid_name  || $minAge || $maxAge ||$skill_id || $type || $experienced || $minSalary || $maxSalary ){ 
        $user_data = DB::table('maid_personal_details as md')
					->select('md.*','c.name as country_name','mss.deleted as maid_skill_deleted','wa.deleted as work_area_deleted','c.nationality as nationality_name','u.company_name',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'))
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->leftJoin('users as ur', 'ur.id', '=', 'md.users_agents_id')
					->leftJoin('agencies as u', 'u.id', '=', 'ur.agency_id')
					->leftJoin('maid_skill_set as mss', function($join)
        				{
            					$join->on('mss.maid_id', '=', 'md.id');
						$join->on('mss.interview_type','=',DB::Raw("'Singapore EA'"));
					})
					->leftjoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
					->where('u.activated','=',1)
					->where('md.deleted','=','N')
					->where('md.availability','!=','Unpublished for display')
					->where('display_biodata','=','Yes');
					
					if($skill_id){
						$user_data->where('wa.id', $skill_id);
					}
					if($nationality){
						$user_data->where('md.nationality', $nationality);
					}
					if($minAge !==''){
						$user_data->whereRaw( 'timestampdiff(year, md.date_of_birth, curdate()) >= ?', [$minAge] );
					}
					if($maxAge !==''){
						$user_data->whereRaw( 'timestampdiff(year, md.date_of_birth, curdate()) <= ?', [$maxAge] );
					}
					if($minAge !== '' && $maxAge !==''){
						$user_data->whereBetween(DB::raw('timestampdiff(year, md.date_of_birth, curdate())'), [$minAge, $maxAge] );
					}
					if($minSalary !==''){
						$user_data->whereRaw( 'md.expected_salary >= ?', [$minSalary] );
					}
					if($maxSalary !==''){
						$user_data->whereRaw( 'md.expected_salary <= ?', [$maxSalary] );
					}
					if($minSalary !== '' && $maxSalary !==''){
						$user_data->whereBetween(DB::raw('md.expected_salary'), [$minSalary, $maxSalary] );
					}
					if($maid_name){
								$user_data->where('md.name','like',"%$maid_name%");
					}
					if($type !== ''){
						$user_data->where('md.type','LIKE', "%{$type}%");
					}
					if($experienced !== ''){
						$user_data->where('md.type','LIKE', "%Transfer%");
						$user_data->orWhere('md.type','LIKE', "%Replacement%");
					}
                    $data=$user_data->orderBy('md.id', 'desc')->groupBy('md.id')->paginate($request->get('per_page', 15)); 
                    //dd($data); exit;
            $count = count($data);// print_r($data[0]->nationality);


    }else{
    	$data = DB::table('maid_personal_details as md')
					->select('md.*','c.name as country_name','c.nationality as nationality_name','u.company_name',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'))
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->leftJoin('users as ur', 'ur.id', '=', 'md.users_agents_id')
					->leftJoin('agencies as u', 'u.id', '=', 'ur.agency_id')
					->where('u.activated','=',1)
					->where('md.deleted','=','N')
					->where('md.availability','!=','Unpublished for display')
					->where('display_biodata','=','Yes')
					->orderBy('md.id', 'desc')->paginate($request->get('per_page', 15));
    }
      $count = count($data);
        return view('maidprofilelisting',compact('count','data','countries_data','workarea_data'));
    }


    public function maidagency(){

    	$maidagencylist = DB::table('agencies as a')
    						->where('a.activated','=',1)
    						->where('a.company_name','!=','admin')
    						->get();

    	return view('maid_agency_list',compact('maidagencylist'));
    }

    public function maidagencydetail(){
		$id=Input::get('id');


    	$maidagencydetail = DB::table('agencies as a')
    						->select("a.*",DB::Raw("GROUP_CONCAT(CONCAT(UCASE(LEFT(ac.contact_name, 1)), 
                             SUBSTRING(ac.contact_name, 2),' - ',ac.contact_no) SEPARATOR ' / ') as contact_name"))
    						->leftJoin('agency_contacts as ac', 'ac.agency_id', '=', 'a.id')
    						->where('a.activated','=',1)
    						->where('a.id','=',$id);
    	$data = $maidagencydetail->get();

    	$agency_opertaing_info =  DB::table('agency_operating_information as aoi')
                        ->select("aoi.*")
                        ->where('agency_id', '=', $id)->get();

    	return view('maid_agency_detail',compact('data','agency_opertaing_info'));

    }
    public function addshortlist() { 
	        $maid_id = Input::get('maid_id');

		    $user_data = DB::table('maid_personal_details as md')
							->select('md.*','c.name as country_name','u.company_name',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'))
							->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
							->leftJoin('users as ur', 'ur.id', '=', 'md.users_agents_id')
						   	->leftJoin('agencies as u', 'u.id', '=', 'ur.agency_id')
							->where('md.deleted','=','N')
							->where('md.id','=',$maid_id);

			$fdw=$user_data->get();
			$count = count($fdw);
			//Ssunecho '<pre>'; print_r($fdw); exit;
		    Cart::add(array('id' => $maid_id, 'name' => $fdw[0]->name, 'qty' => 1, 'price' => 20,'options' => array('size'=>'large','image' => $fdw[0]->image,'profile_image' => $fdw[0]->profile_image,'age' => $fdw[0]->age,'marital_status' => $fdw[0]->marital_status,'type' => $fdw[0]->type,'rest_days_preference' => $fdw[0]->rest_days_preference,'company_name' => $fdw[0]->company_name,'maid_reference_code' => $fdw[0]->maid_reference_code,'country_name' => $fdw[0]->country_name,'count' => $count)));

	    $cart = Cart::content(); 
	    return count($cart);
	}

	/*
		Name : myshortlist
		description : myshortlist function is used to add profile into my shortlist 
	*/
	public function myshortlist() {
	    $cart = Cart::content();
	    return view('myshortlist', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
	}

	/*
		Name : deleteshortlist
		description : deleteshortlist function is used to delete profile from my shortlist 
	*/
	public function deleteshortlist($maid_id) {
	    $rowId = Cart::search(array('id' => $maid_id));
	  // echo "<pre>"; print_r($rowId); exit;
		Cart::remove($rowId[0]);
	    $cart = Cart::content();
	    return view('myshortlist', array('cart' => $cart, 'title' => 'Welcome', 'description' => 'Profile removed from shotlist sucessfully.', 'page' => 'home'));
	}

	/*
		Name : clearshortlist
		description : clearshortlist function is used to clear list from my shortlist 
	*/
	public function clearshortlist() {
	    Cart::destroy();
	    $cart = Cart::content();
	    return view('myshortlist', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
	}

	/*
		Name : usefullinks
		description : usefullinks function is used to show links 
	*/
	public function usefullinks() {
		$usefullinks = DB::table('pages as p')
    						->select("p.*")
    						->where('p.is_published','=',1)
    						->where('p.id','=',1)->get();
    	$count = count($usefullinks);					
	    return view('usefullinks', array('usefullinks' => $usefullinks, 'count'=>$count));
	}

	/*
		Name : FAQ
		description : FAQ function is used to show the F&Q
	*/
	public function FAQ() {
		$help = DB::table('pages as p')
    						->select("p.*")
    						->where('p.is_published','=',1)
    						->where('p.id','=',2)->get();
    	$count = count($help);					
	    return view('help', array('help' => $help, 'count'=>$count));
	}
	/*
		Name : requestmaid
		description : requestmaid function is used to request the maid for admin
	*/
	public function requestmaid() {
	    return view('requestmaid');
	}

	/*
		Name : requestmaid
		description : requestmaid function is used to request the maid for admin
	*/
	public function storerequestmaid(Request $request) {
		$data = $request->all();
		// validation rules
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'float_integer' => 'Please enter valid income.',
		);
		//echo "<pre>"; print_r($data); exit;
		// form validation
		$validator = Validator::make($request->all(), [
				'name' => 'required|Min:3|Max:255|alpha_spaces',
           		'email' => 'required|email',
           		'telephone' => 'numeric|digits_between:8,15',
				'request_detail' => 'required',
        	],$messages);
		if(Input::get('maiddetail')){
			if ($validator->fails()) {
            	return redirect("Maid-Details/".$data['maid_id']."/show")
                        ->withErrors($validator)
                        ->withInput();
       	 	}
		}
		else{
	        if ($validator->fails()) {
	            return redirect("/requestmaid")
	                        ->withErrors($validator)
	                        ->withInput();
	        }
    	}
        //echo "<pre>"; print_r($data); exit;
		$requestmaid = Requestmaid::create($data);
		$insertedId = $requestmaid->id;
		if($insertedId){
		//$subject = 'Welcome!';
		//Mail::send('requestmaidmail', ['key' => 'value'], function($message) use ($subject) {
		  // note: if you don't set this, it will use the defaults from config/mail.php
		//  $message->from('harendar.singh@sunarctechnologies.com', 'Sender Name');
		//  $message->to('harendar.singh@sunarctechnologies.com', 'John Smith')
		//  ->subject($subject);
		//});
		if(Input::get('maiddetail')){
			$to = Input::get('agency_mail');
		}
		else{
			$to = "uren.chen@innov8te.com.sg";
		}
		$subject = "Innomid Request Maid";
		$message = "	<table width='90%' align='center' >
							 <tr >
								 <td style='padding-bottom:10px'>
								 Dear Admin,
								 </td>
							 </tr>
							 <tr >
								 <td style='padding-bottom:10px'>
								 There is an enquiry from website. Below are the details -
								 </td>
							 </tr>
							 <tr >
								 <td >
									<b>From :</b> ".$data['name']."
				
								</td>
							</tr>
							 <tr >
								 <td >
									<b>Email :</b> ".$data['email']."
				
								</td>
							</tr>
							<tr >
								 <td >
									<b>Telephone :</b> ".$data['telephone']."
								</td>
							</tr>
							 <tr >
								 <td >
									<b>Message :</b> ".$data['request_detail']."
								</td>
							</tr>

							<tr >
							<td style='padding-top:10px'>
								Thanks,
							</td>
							</tr>
							</table>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: uren.chen@innov8te.com.sg" . "\r\n";

		mail($to,$subject,$message,$headers);
		}
		\Session::flash('success', 'Request for maid is sent to admin.');
		if(Input::get('maiddetail')){
			return redirect("Maid-Details/".$data['maid_id']."/show");
		}else{
			return redirect("/requestmaid");
		}
	}

	/*
		Name : Join Innomaid
		description : Agency request join innomaid form
	*/
	public function joininnomaid() {
	    return view('joininnomaid');
	}

	/*
		Name : Join innomaid
		description : agency request to admin to join innomaid via mail
	*/
	public function addjoininnomaid(Request $request) {
		$data = $request->all();
		// validation rules
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'float_integer' => 'Please enter valid income.',
		);
		//echo "<pre>"; print_r($data); exit;
		// form validation
		$validator = Validator::make($request->all(), [
				'name' => 'required|Min:3|Max:255|alpha_spaces',
           		'company_name' => 'required|Min:3|Max:255',
           		'email' =>'required|email',
           		'telephone' => 'numeric|digits_between:8,15',
        	],$messages);

	        if ($validator->fails()) {
	            return redirect("/joininnomaid")
	                        ->withErrors($validator)
	                        ->withInput();
	        }
        //echo "<pre>"; print_r($data); exit;

		$to = "uren.chen@innov8te.com.sg";
	       // $to = "harendar.singh@sunarctechnologies.com";
		$subject = "Join Innomaid Request";
		$message = "	<table width='90%' align='center' >
							 <tr >
								 <td style='padding-bottom:10px'>
								 Dear Admin,
								 </td>
							 </tr>
							 <tr >
								 <td style='padding-bottom:10px'>
								 Request for join innomaid. Below are the details -
								 </td>
							 </tr>
							 <tr >
								 <td >
									<b>From :</b> ".$data['name']."
				
								</td>
							</tr>
							<tr >
								 <td >
									<b>Message :</b> ".$data['company_name']."
								</td>
							</tr>
							 <tr >
								 <td >
									<b>Email :</b> ".$data['email']."
				
								</td>
							</tr>
							<tr >
								 <td >
									<b>Telephone :</b> ".$data['telephone']."
								</td>
							</tr>

							<tr >
							<td style='padding-top:10px'>
								Thanks,
							</td>
							</tr>
							</table>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: uren.chen@innov8te.com.sg" . "\r\n";

		mail($to,$subject,$message,$headers);

		\Session::flash('success', 'Request for join innomaid is sent to admin.');
			return redirect("/joininnomaid");
	}

	/*
		Name : About Us
		description : aboutus function is used to show the aboutus page
	*/
	public function aboutus() {
		$aboutus = DB::table('pages as p')
    						->select("p.*")
    						->where('p.is_published','=',1)
    						->where('p.id','=',3)->get();
    	$count = count($aboutus);					
	    return view('aboutus', array('aboutus' => $aboutus, 'count'=>$count));
	}
}
