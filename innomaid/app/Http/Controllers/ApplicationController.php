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
use App\Maid_application as maid_application;
use App\Maid_app_job_scope as maid_app_job_scope;
use App\Maid_app_rest_day as maid_app_rest_day;
use App\Maid_app_handling_takeover as maid_app_handling_takeover;
use App\Maid_app_security_bond as maid_app_security_bond;
use App\Maid_app_authorisation_workpass as maid_app_authorisation_workpass;
use App\Maid_app_employer_tax_declaration as maid_app_employer_tax_declaration;
use App\Maid_app_safety_agreement as maid_app_safety_agreement;
use App\Maid_app_fdw_work_permit as maid_app_fdw_work_permit;
use App\Maid_app_giro_form as maid_app_giro_form;
use App\Maid_app_workpermit_renewal as maid_app_workpermit_renewal;
use App\Maid_app_insurance_form as maid_app_insurance_form;
use App\Maid_app_fdw_declaration_form as maid_app_fdw_declaration_form;
use App\SalaryPaymentAndLoan as salarypaymentandloan;
use App\Loanmanualpayment as Loanmanualpayment;
use App\Agencyservice as Agencyservice;
use App\Agencyservicepackage as Agencyservicepackage;
use App\Service_placement_fee_package as Service_placement_fee_package;
use App\Fdw as Fdw;
use App\Employer as Employer;
use App\Employerinvoice as Employer_invoice;
use App\Fdwinvoice as Fdw_invoice;
use App\Employerrecordpayment as Employer_record_payment;
use App\Agencymaidserviceschedule as Agencymaidserviceschedule;
use Carbon\Carbon;
use App\Countries as Countries;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;
class ApplicationController extends Controller {

  public function __construct()
  {
    $this->middleware('auth');
  }

  
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index() {

    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	$search="";
	   if(Auth::user()->hasRole(['admin'])){
      $applicationlist = DB::table('maid_application as maem')
                ->select("maem.*",'u.company_name as username')
                ->leftJoin('users as u', 'u.id', '=', 'maem.user_agents_id')
                ->orderBy("maem.updated_at", "DESC")
                ->paginate(10);
     }
     else{
      /*$agencyuser =  DB::table('users as u')
                ->select(DB::Raw("GROUP_CONCAT(DISTINCT (u.id) SEPARATOR ',') as user_id"))
                ->where('u.agency_id','=',$user_id)
                ->orWhere('u.id','=',$user_id)
                ->get();
      if($agencyuser){
        $user_id = $agencyuser[0]->user_id;
      }*/
      $applicationlist = DB::table('maid_application as maem')
                ->select("maem.*",'u.company_name as username')
                ->leftJoin('users as u', 'u.id', '=', 'maem.user_agents_id')
                ->orderBy("maem.updated_at", "DESC")
                ->where("maem.user_agents_id",'=',  $user_id)
                ->paginate(10);
      }//echo $user_id; echo "<pre>"; print_r($applicationlist);
   $total=$applicationlist->total();
    return view('sentinel.application.index')->with('applicationlist', $applicationlist)->with('search',$search)->with('total',$total);
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
	$messages = array(
			'search_term' => 'Please enter valid value.',
	  );
	   $validator = Validator::make($request->all(), [
			  'search_term' => 'alpha_num',
		  ],$messages);

	if ($validator->fails()) {
		return redirect("application")
					->withErrors($validator)
					->withInput();
	}
		$employer_name='"employer_name": "'.$data['search_term'].'"';
		$maid_name='"name": "'.$data['search_term'].'"';
		if($data['search_term'])
		{
				 if(Auth::user()->hasRole(['admin'])){
			  $applicationlist = DB::table('maid_application as maem')
						->select("maem.*",'u.company_name as username')
						->leftJoin('users as u', 'u.id', '=', 'maem.user_agents_id')
						->whereRaw("( maem.id like '%$search%' or employer_json_data  like '%$employer_name%' or maid_json_data  like '%$maid_name%' )")
						->orderBy("maem.updated_at", "DESC")
						->paginate(10);
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
			  $applicationlist = DB::table('maid_application as maem')
						->select("maem.*",'u.company_name as username')
						->leftJoin('users as u', 'u.id', '=', 'maem.user_agents_id')
						->orderBy("maem.updated_at", "DESC")
						 ->whereRaw("(maem.id like '%$search%' or employer_json_data  like '%$employer_name%' or maid_json_data  like '%$maid_name%' )")
						->whereRaw("maem.user_agents_id in ($user_id)")
						->paginate(10);
		// print_r($applicationlist);exit;	  
		}
		} else {
				 if(Auth::user()->hasRole(['admin'])){
			  $applicationlist = DB::table('maid_application as maem')
						->select("maem.*",'u.company_name as username')
						->leftJoin('users as u', 'u.id', '=', 'maem.user_agents_id')
						->orderBy("maem.updated_at", "DESC")
						->paginate(10);
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
			  $applicationlist = DB::table('maid_application as maem')
						->select("maem.*",'u.company_name as username')
						->leftJoin('users as u', 'u.id', '=', 'maem.user_agents_id')
						->orderBy("maem.updated_at", "DESC")
						->whereRaw("maem.user_agents_id in ($user_id)")
						->paginate(10);
			  }
			  } $total=$applicationlist->total();
    return view('sentinel.application.index')->with('applicationlist', $applicationlist)->with('search',$search)->with('total',$total);
			
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
    $user_email =  Auth::user()->email;
    $agencyuser =  DB::table('users as u')
                ->select(DB::Raw("GROUP_CONCAT(DISTINCT (u.id) SEPARATOR ',') as user_id"))
                ->where('u.agency_id','=',$user_id)
                ->orWhere('u.id','=',$user_id)
                ->get();
          if($agencyuser){
            $user_id = $agencyuser[0]->user_id;
          }

    $employer = DB::table('employer_personal_details')->whereRaw("users_agents_id in ($user_id)")->where('deleted','=','N')->orderBy('updated_at', 'asc')->lists('employer_name','id');      
    $fdw = DB::table('maid_personal_details as mdp')->leftJoin('maid_application as mp',function ($join){   $join->on('mdp.id', '=', 'mp.maid_id');  $join->on('mp.replaced_at','=',DB::raw("'0000-00-00'")); })->where('mp.maid_id' ,'=',NULL)->whereRaw("users_agents_id in ($user_id)")->where('mdp.deleted','=','N')->orderBy('mdp.updated_at', 'asc')->select('mdp.*')->lists('mdp.name','mdp.id');// print_r($fdw);
	return view('sentinel.application.create')->with('employer',$employer)->with('fdw',$fdw);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request) {
    $data = $request->all();
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    $data['user_agents_id'] = $user_id;
    // validation rules
    Validator::extend('alpha_special', function($attribute, $value)
      {
          return preg_match('/^[ A-Za-z0-9_.-]*$/', $value);
      });
    $messages = array(
        'alpha_special' => 'Please enter letters, numbers and underscore values.',
        'employer_id.required' => 'Please select employer.',
        'maid_id.required' => 'Please select maid.',
     
    );
    $validator = Validator::make($request->all(), [
              'employer_id' => 'required',
              'type' => 'required',
              'maid_id' => 'required',
              'maid_app_reference_number' => 'required|alpha_special|min:3|max:30|unique:maid_application'
          ],$messages);

    if ($validator->fails()) {
        return redirect("application/create")
                    ->withErrors($validator)
                    ->withInput();
    }
	
        // validation rule complete
    $maid_app_maid_details = Fdw::findOrFail($data['maid_id']);
    $maid_json_data = json_encode($maid_app_maid_details, 128);
    $employer_app_maid_details = Employer::findOrFail($data['employer_id']);
    $employer_json_data = json_encode($employer_app_maid_details, 128);
	if($data['type']=="A Replacement"){
	$maid_employer=DB::table('maid_application as mp')
            ->where('employer_id', $employer_app_maid_details->id)
            ->where('status','!=','free')
			->get();
			 $employer_details = json_decode($maid_employer[0]->employer_json_data); 
             $maid_details = json_decode($maid_employer[0]->maid_json_data);
             $leftloanamount=0;
	$salarypayment = salarypaymentandloan::where('employer_maid_id' , '=',$maid_employer[0]->id )->first();

	if($salarypayment){
		 $restday = maid_app_rest_day::where('employer_maid_id' , '=', $maid_employer[0]->id)->first();
		 $loanpayment = Loanmanualpayment::where('employer_maid_id' , '=', $maid_employer[0]->id)->get();
	$date=new \DateTime($salarypayment->date_of_commencement);
	$diff =date_diff( new \DateTime(),$date);
	print_r($diff->m); $period= $diff->m; $halfless=0; $compensation=0;
	
					 $amount=$salarypayment->loan_amount;
					$loan= $loanammont = $amount; 
					$probation=$salarypayment->probation_period;
					
				if($salarypayment->payment_arrangement=='Pro-rated till month end'){
					$count=0;
					if($count < $period){
					 $lastdate="";
					$lastdate=explode('-', $salarypayment->date_of_commencement); 
					$loandate=explode('-', date("Y-m-t",strtotime($salarypayment->loan_repayment_start_date))); 
					 $date=explode('-',$salarypayment->date_of_commencement); $loan_after=0; 
					   $day= $lastdate[2]-$date[2]; 
						if($restday->rest_days=='Rest according month') {
							//$compensation=$restday->no_of_restday*$restday->compensation;
							$TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);
								$Counter = 0;
								for ($i = ($TotalDays-$day); $i <= $TotalDays; $i++) {
									if ($restday->rest_of_month == date('l', mktime(0, 0, 0, $date[1], $i, $date[0]))){
									//add 1 to the counter
									$Counter++;
									}
									}
							if($salarypayment->leave_on_offday=="No")
							{
							  
								if($Counter>(4-$restday->no_of_restday)) $Counter=4-$restday->no_of_restday;
								$halfcompensation=$Counter*$restday->compensation; $Counter=0;
							}
							else{
							if($Counter>(4-$restday->no_of_restday)){$Counter=4-$restday->no_of_restday;}
							$halfcompensation= 0;} }
							else {
								$TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);
								$Counter = 0;
								for ($i = ($TotalDays-$day); $i <= $TotalDays; $i++) {
									if ($restday->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0]))){
									//add 1 to the counter
									$Counter++;
									}
									} 
								  $halfcompensation= 0;//$Counter*$restday->compensation; 
					}  if($day>26){ $day=26;  }
					$time=date("Y-m-t",strtotime(implode($date,'-')));if($date[1]<$loandate[1]||$date[0]<$loandate[0]) { $loan_after++;}
						$halfsalary= round(($maid_details->expected_salary)/(26)*($day+1)-$halfcompensation,2); 
			
					 if($salarypayment->deduction_arrangement=='Deduct Salary + Compensation'){ $halfless= $halfcompensation+$halfsalary;
					if($count>=$loan_after)
						if($loan>=$halfless){if($halfless==0) {}else { $loan=$loan-$halfless;}
						}
						else{ $loan=0;} 
					else{}
					}
					
					if($salarypayment->deduction_arrangement=='Deduct Salary only'){
					$halfless=$halfsalary;
					if($count>=$loan_after)
						 if($loan>=$halfless){ if($halfless==0) {} else { $loan=$loan-$halfless; }}
						else{ $loan='0';
						}
					else{}}
					 if($salarypayment->deduction_arrangement=='Manual Allocation of Amount'){  $halfless= $halfcompensation+$halfsalary; 
					if($count>=$loan_after)
						if($loan>=$halfless){ if($halfless==0){} else { $loan=$loan-$halfless;}}
						else{ $loan=0; }
					else {}}
					 $count++; }
					while($count!= $period){
if($date[1]=='12'){$date[1]=1; $date[0]=$date[0]+1;} else{$date[1]=$date[1]+1; $date[2]=1; /*echo $date[1]; exit;*/} /*print_r( $date); exit;*/ $time=date("Y-m-t",strtotime(implode($date,'-'))); /*echo $time;*/ if($date[1]<$loandate[1]||$date[0]<$loandate[0]) { $loan_after++;}
					if($restday->rest_days=='Rest according month'){
					if($probation>$count){ echo "0"; $compensation=(4-$restday->no_of_restday)*$restday->compensation; }else {
					echo $compensation=(4-$restday->no_of_restday)*$restday->compensation;
					}}
					else  {
					 $TotalDays = cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);

					$Counter = 0;
					for ($i = 1; $i <= $TotalDays; $i++) {
					if ($restday->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0])))
					//add 1 to the counter
					$Counter++;
					}
					echo $compensation=0;  //$Counter*$restday->compensation; 
					}
					if($salarypayment->deduction_arrangement=='Deduct Salary + Compensation')
					{
					$less=$maid_details->expected_salary+ $compensation; $halfless= $halfcompensation+$halfsalary;
					  if($probation>$count){
						if($loanammont){
						if($loan>= $less){
					if($less==0){} else{ $loan=$loan-$less;}}
					else {$loan=0;}}
					else{}}
					else{ }
					
					}
					
					if($salarypayment->deduction_arrangement=='Deduct Salary only')
					{
					 $less=$maid_details->expected_salary;
	
						if($probation>$count)
						if($loanammont)
						if($loan>= $less){
						if($less==0){}  else {$loan=$loan-$less; }}
						else {$loan=0;}
						else {}
						else {}
					}
					if($salarypayment->deduction_arrangement=='Manual Allocation of Amount')
					{ if($probation==0)
					   {
					 if(($loanpayment->count())){
					$loan=$loan-$loanpayment[$count]->loan_amount;
					}
					else{ if($loanammont)
					{}else
					{}}
					}else{
					 $less=$maid_details->expected_salary+ $compensation; $halfless= $halfcompensation+$halfsalary;
					  if($probation>=$count){
						if($loanammont){
						if($loan>= $less){
					if($less==0){}else{ $loan=$loan-$less;}}
					else { $loan=0;}}
					else{}}
					else {}}}
					$count++;} }
			else {
					
					$count=0; $date=explode('-',$salarypayment->date_of_commencement); $loandate=explode('-', date("Y-m-t",strtotime($salarypayment->loan_repayment_start_date)));  $loan_after=0;
					 $initaldate=$date[2];
					while($count!= $period){
					if($date[1]=='12'){$date[1]=1; $date[0]=$date[0]+1;} else{ $date[1]=$date[1]+1;$d=cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]); if($date[2]<$initaldate){$date[2]=$initaldate;}if($d<$initaldate){$date[2]=$d;} }$time=date(implode($date,'-')); $dates=$time;  
					$TotalDays = (date("t",strtotime($time))-$date[2])+$date[2];
					$Counter = 0;
					for ($i = 1; $i <= $TotalDays; $i++) {
					if ($restday->rest_of_week == date('l', mktime(0, 0, 0, $date[1], $i, $date[0])))
					//add 1 to the counter
					$Counter++;
					} if($date[1]<$loandate[1] ||$date[0]<$loandate[0]) {$loan_after++;} 
					if($restday->rest_days=='Rest according month'){
					if($probation>$count){ $compensation=(4-$restday->no_of_restday)*$restday->compensation; }  else
					$compensation=(4-$restday->no_of_restday)*$restday->compensation; }
					else
					$compensation=0;
					if($salarypayment->deduction_arrangement=='Deduct Salary + Compensation')
					{
					 $less=$maid_details->expected_salary+ $compensation;
					if($probation>$count){
					if($loanammont){
					if($loan>= $less){
						if($less==0){}else{ $loan=$loan-$less; }}
					else {$loan=0;}}
					else{}}
					else{}
					}
					
					if($salarypayment->deduction_arrangement=='Deduct Salary only')
					{
					 $less=$maid_details->expected_salary;
					if($probation>$count){
					if($loanammont){
					 if($loan>= $less){
						if($less==0){}else {  $loan=$loan-$less;}}
					else { $loan=0;}}
					else {}}
					else{}
					}
					if($salarypayment->deduction_arrangement=='Manual Allocation of Amount')
					{ 
					    if($probation==0)
					   {  //	print_r($loanpayment->count());exit;
					 if(($loanpayment->count())){ //$count=0;
					 //$less=$maid_details->expected_salary+$compensation;
					$loan=$loan-$loanpayment[$count]->loan_amount;
					}
					else{ if($loanammont)
					{}else
					{}}
					}else{
					 $less=$maid_details->expected_salary+ $compensation;
					if($probation>$count){
					if($loanammont){
					if($loan>= $less){
						if($less==0){}else { $loan=$loan-$less;}}
					else {$loan=0; }}
					else{}}
					else {}
					}} $count++;} //echo $loan_after; exit
				} $leftloanamount=$amount-($loanammont-$loan); 
	
	} //echo " ".$leftloanamount;   exit;
		$data1['replaced_at']= new \DateTime();
		 $data1['status'] = 'free';
		 $data1['carry_forward_loan']=$leftloanamount;  //print_r( $data1); exit;
		 DB::table('maid_application as mp')
            ->where('employer_id', $employer_app_maid_details->id)
	    ->where('status','!=','free')
			->update($data1);
	} 
    $data['maid_json_data'] = $maid_json_data;
    $data['employer_json_data'] = $employer_json_data;
    $application = maid_application::create($data);
    $insertedId = $application->id;

    \Session::flash('success', 'Maid application is saved.');
    return redirect("application/".$insertedId."/edit?tab=tab1");
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id) {
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    //****** employer and maid *//////////
  /*  $agencyuser =  DB::table('users as u')
                ->select(DB::Raw("GROUP_CONCAT(DISTINCT (u.id) SEPARATOR ',') as user_id"))
                ->where('u.agency_id','=',$user_id)
                ->orWhere('u.id','=',$user_id)
                ->get();
          if($agencyuser){
            $user_id = $agencyuser[0]->user_id;
          }*/
    $maid_employer = maid_application::findOrFail($id);
    $employer = DB::table('employer_personal_details')->where("users_agents_id",'=' ,$user_id)->where('deleted','=','N')->orderBy('updated_at', 'asc')->lists('employer_name','id');
   $fdw = DB::table('maid_personal_details as mdp')->leftJoin('maid_application as mp',function ($join){   $join->on('mdp.id', '=', 'mp.maid_id');  $join->on('mp.status','!=',DB::raw("'free'")); })->where('mp.maid_id' ,'=',NULL)->where("users_agents_id",'=', $user_id)->where('mdp.deleted','=','N')->orderBy('mdp.updated_at', 'asc')->select('mdp.*')->lists('mdp.name','mdp.id');
   //*********** for service & fee**********//

    $servicefees = Agencymaidserviceschedule::where('employer_maid_id' , '=', $id)->first();
    if($maid_employer->type == 'A New FDW'){
      $maid_employer->form_type = 'New Transfer';
      $mode = 'newtransfer';
    }
    if($maid_employer->type == 'A Replacement'){
      $maid_employer->form_type = 'Replacement';
       $mode = 'replacement';
    }
    if($maid_employer->type == 'An Additional FDW'){
      $maid_employer->form_type = 'Additional';
       $mode = 'newtransfer';
    }
	$packageList = DB::table('agency_service_package as p')
				->leftJoin("service_placement_fee_package as sp" , "sp.id",'=','p.package_id')
				->select("p.*","sp.package_name")
				->where("service_id",'=',25)
               	->orderBy("p.updated_at", "DESC")
               	->paginate(10);
	
    $agencyservice = DB::table('agency_service as ags') ->select("ags.*")
				/*->leftJoin('agency_service_package as asp' , 'asp.service_id', '=','ags.id')
				->leftJoin('service_placement_fee_package as sp' ,'asp.package_id', '=','sp.id')
                 */
				  ->where('ags.mode', '=',$mode)
				  ->where("ags.agency_id",'=' ,$user_id)
				  ->get(); 
	  $jobscope = maid_app_job_scope::where('employer_maid_id' , '=', $id)->first();
	  $restday = maid_app_rest_day::where('employer_maid_id' , '=', $id)->first();
	  $handlingtakeover = maid_app_handling_takeover::where('employer_maid_id' , '=', $id)->first();
	  $salarypayment = SalaryPaymentAndLoan::where('employer_maid_id' , '=', $id)->first();
	  $loanpayment = Loanmanualpayment::where('employer_maid_id' , '=', $id)->get();
	if($servicefees){
              $agencymaidservice = DB::table('agency_maid_service as ams')
                      ->select("ams.service_id","ams.service_cost","ams.package_name") 
                      ->where('ams.service_schedule_id', '=', $servicefees->id)->get();

              $agencyotherservice = DB::table('agency_maid_other_service as amos')
                      ->select("amos.other_service_title","amos.other_service_price","amos.service_schedule_id","amos.id")  
                      ->where('amos.service_schedule_id', '=', $servicefees->id)->get(); 

              $replacementcost = DB::table('service_schedule_replacement_cost as ssrc')
                      ->select("ssrc.replacement_month","ssrc.replacement_number","ssrc.cost","ssrc.service_schedule_id","ssrc.id") 
                      ->where('ssrc.service_schedule_id', '=', $servicefees->id)->get();
                                  
              
              
              $placement_fee_schedule = DB::table('service_schedule_placement_cost as sspc')
                      ->select("sspc.post_dated_cheque_number","sspc.post_dated_cheque_cost","sspc.id","sspc.service_schedule_id")
                      ->where('sspc.service_schedule_id', '=', $servicefees->id)
                      ->get();
			  
                    
              
        }else{
          $agencymaidservice= array();
           $agencyotherservice  = array();
           $replacementcost= array();
           $placement_fee_schedule= array();
		   
        }
       //print_r($loanpayment); exit;
        return view('sentinel.application.edit')->with('maid_employer',$maid_employer)->with('employer',$employer)->with('fdw',$fdw)->with('servicefees',$servicefees)->with('agencymaidservice',$agencymaidservice)->with('agencyotherservice',$agencyotherservice)->with('replacementcost',$replacementcost)->with('agencyservice',$agencyservice)->with('placement_fee_schedule',$placement_fee_schedule)->with('jobscope',$jobscope)->with('restday',$restday)->with('handlingtakeover',$handlingtakeover)->with('salarypayment',$salarypayment)->with('loanpayment',$loanpayment)->with('user_id',$user_id);
    //***************** End **********************//   


    
  }

  /**
   * Update the tab1. Service and Fees 
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request) {
    $data = $request->all();
    \Session::flash('success', 'Maid application has been Updated.');
    if (isset($data['submit_list'])) {
      return redirect("application/");
    }
    else{
      return redirect("application/".$id."/edit?tab=tab1");
    }
    
  }


  /**
   * Update the tab1. Service and Fees 
   *
   * @param  int  $id = employer_maid_id
   * @return Response
   */
  public function servicefeesupdate($employer_maid_id, Request $request) {
    $data = $request->all();
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
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
      );
      $validator = Validator::make($request->all(), [
            'placement_fee_service_charge' => 'required',
            'placement_fee_personal_loan' => 'required',
            ],$messages);
      if ($validator->fails()) {
          return redirect("application/".$employer_maid_id."/edit?tab=tab1")
                      ->withErrors($validator)
                      ->withInput();
      } //echo '<pre>';  print_r($data); exit;
        /// validation complete
        $data['agency_id'] = $user_id;
        $data['employer_maid_id'] = $employer_maid_id;
       // $data['date']= date('Y-m-d');
        $servicefees = Agencymaidserviceschedule::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($servicefees){
          $servicefees->update($data);
          $servicefeesid = $servicefees->id;
        }else{
          $service = Agencymaidserviceschedule::create($data);
          $servicefeesid = $service->id;
        }
      //echo '<pre>';  print_r($data); exit;
        // Insert servicefees data
          if(Input::get('service_id'))
          {
            $servicerowcount = count($data['service_id']);
            DB::table('agency_maid_service')->where('service_schedule_id', '=', $servicefeesid)->delete();
            foreach($data['service_id'] as $id =>$value){
			if(isset($data['package_name'][$id])){ 
              DB::insert('insert into agency_maid_service (service_schedule_id, maid_id, service_id, service_cost, package_name ) values (?, ?, ?, ?,?)', [$servicefeesid, $data['maid_id'],$data['service_id'][$id],$data['price'][$id],$data['package_name'][$id]]);
            }   
			else {
			DB::insert('insert into agency_maid_service (service_schedule_id, maid_id, service_id, service_cost) values (?, ?, ?, ?)', [$servicefeesid, $data['maid_id'],$data['service_id'][$id],$data['price'][$id]]);
			}
			}
          }else{
            DB::table('agency_maid_service')->where('service_schedule_id', '=', $servicefeesid)->delete();
          }
          if(Input::get('other_service_title') )
          {
            $othservicerowcount = count($data['other_service_title']);
              for ($i=0; $i < $othservicerowcount; $i++) {
                if($data['other_service_title'][$i] !=''){
                  DB::insert('insert into agency_maid_other_service (service_schedule_id, other_service_title, other_service_price) values (?, ?, ?)', [$servicefeesid, $data['other_service_title'][$i],$data['other_service_price'][$i]]);
                }
            } 
              
          }
          if(Input::get('replacement_month'))
          {
            $monthrowcount = count($data['replacement_month']);
              for ($i=0; $i < $monthrowcount; $i++) {
                if($data['replacement_month'][$i] !=''){
                  DB::insert('insert into service_schedule_replacement_cost (service_schedule_id,maid_id,  replacement_number, replacement_month, cost) values (?, ?, ?, ?, ?)', [$servicefeesid, $data['maid_id'], $data['replacement_number'][$i], $data['replacement_month'][$i],$data['cost'][$i]]);
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
                    DB::insert('insert into service_schedule_placement_cost (service_schedule_id, post_dated_cheque_number, post_dated_cheque_cost) values (?, ?, ?)', [$servicefeesid, $data['post_dated_cheque_number'][$i],$data['post_dated_cheque_cost'][$i]]);
                  }
              }
            } 
              
          }
          DB::table('maid_application as mp')
            ->where('id', $employer_maid_id)
            ->update(['mp.case_id' => $data['case_id']]);
        // Insert servicefees data complete
    \Session::flash('success', 'Maid Application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/edit?tab=tab1");
  }
  /**
   * Remove the replacement cost details
   *
   * @param  int  $id
   * @return Response
   */
  public function replacementcostdelete($service_schedule_id,$replacementcostid,$maid_application) {
    DB::table('service_schedule_replacement_cost')->where('service_schedule_id', '=', $service_schedule_id)->where('id', '=', $replacementcostid)->delete();

    \Session::flash('success', 'Replacement cost deleted successfully.');
    return redirect("application/".$maid_application."/edit?tab=tab1");
  }

  /**
   * Remove the other service details
   *
   * @param  int  $id
   * @return Response
   */
  public function otherservicedelete($service_schedule_id,$otherserviceid,$maid_application) {
    DB::table('agency_maid_other_service')->where('service_schedule_id', '=', $service_schedule_id)->where('id', '=', $otherserviceid)->delete();

    \Session::flash('success', 'Other service deleted successfully.');
    return redirect("application/".$maid_application."/edit?tab=tab1");
  }

  /**
   * Remove the placement details
   *
   * @param  int  $id
   * @return Response
   */
  public function placementdelete($service_schedule_id,$placementid,$maid_application) {
    DB::table('service_schedule_placement_cost')->where('service_schedule_id', '=', $service_schedule_id)->where('id', '=', $placementid)->delete();

    \Session::flash('success', 'Placement fee schedule deleted successfully.');
    return redirect("application/".$maid_application."/edit?tab=tab1");
  }
  /**
   * Agency Employer Agreement form
   *
   * @param  int  $id = application id
   * @param  int  $formid = formid
   * @return Response
   */
  public function agencyemployeragreement($maid_application = false,$ispdf = false) {
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    if($maid_application ==''){
    $maid_application =  Input::get('id');
    }
    $formtype =  Input::get('formtype');
    if($formtype = 'Service_Employer_and_Agency'){
      $formtype = 'Service Employer and Agency';
    }
    $maid_employer = maid_application::findOrFail($maid_application);
    $agency = DB::table('users as u')
                ->select("u.*")
                ->where('u.id','=',$maid_employer->user_agents_id)
                ->get();  
    //// service employer and agency form tab
    $agencyemployeragreementform = DB::table('agency_agreement_forms as aaf')
                ->select("aaf.*")
                ->where('aaf.form_type','=',$formtype)
                ->where('aaf.agency_id','=',$user_id)
                ->get();  
    if(!empty($agencyemployeragreementform))   {        
    $agencyemployeragreementjsondata = DB::table('agency_agreement_data as aad')
            ->select("aad.json")
            ->where('aad.agency_agreement_form_id','=',$agencyemployeragreementform[0]->id)
            ->where('aad.application_id','=',$maid_application)->get();
    }else{
        $agencyemployeragreementjsondata = array();
    }    
 // 
// Generating html form //
    $dom = new \DOMDocument();
    if(!empty($agencyemployeragreementform)){//echo '<pre>';  print_r($agencyemployeragreementjsondata) ; exit;
        $data=array();
        @$dom->loadHTML(mb_convert_encoding( $agencyemployeragreementform[0]->content, 'HTML-ENTITIES', 'UTF-8')); 
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query('//input[@name="test"]');
        $node = $nodes->item(0);
        //print_r($node); exit;
        if(!empty($agencyemployeragreementjsondata)){
          $json = json_decode($agencyemployeragreementjsondata[0]->json);
        }else{
          $json= array();
        }
          if($ispdf == 'yes'){
            foreach ($dom->getElementsByTagName('input') as $link) 
            {
              $inputnamearray[]= $link->getAttribute('name');
            }
            $textfield = $dom->getElementsByTagName('input');
            $inputcount = $textfield->length;
            while($inputcount) {
              $fieldname = $textfield->item(0); 
              if(in_array($fieldname->getAttribute('name'),$inputnamearray)){ 
                  foreach($json as $name => $value){
                    if ($fieldname->getAttribute('name') == $name) { //echo $fieldname->getAttribute('name').'ok</br>'; 
                      if($value==''){
                        $fieldname->parentNode->replaceChild($dom->createTextNode('_____'), $fieldname);
                      }else{
                        $fieldname->parentNode->replaceChild($dom->createTextNode($value), $fieldname);
                      }
                    } 
                  }
                }else{
                  $fieldname->parentNode->replaceChild($dom->createTextNode('_____'), $fieldname);
                }
                $inputcount--;
            }
           // print_r($xpath->query('//select')); exit;
            foreach ($dom->getElementsByTagName('select') as $select) 
            {
              $selectnamearray[]= $select->getAttribute('name');
            }
            $selectfield = $dom->getElementsByTagName('select');
            $selectcount = $selectfield->length;
            while($selectcount) {
              $selectfieldname = $selectfield->item(0);
                if(in_array($selectfieldname->getAttribute('name'),$selectnamearray)){ 
                  foreach($json as $name => $value){
                    if ($selectfieldname->getAttribute('name') == $name) {
                        $selectfieldname->parentNode->replaceChild($dom->createTextNode($value), $selectfieldname);
                    } 
                  }
                }
              $selectcount--;
            }
			$root_path = $_SERVER['DOCUMENT_ROOT'];

            $employer_details = json_decode($maid_employer->employer_json_data); 
			$date = date("d-m-Y");
           //$maid_details = json_decode($maid_employer->maid_json_data);
            if($agency[0]->image)
			{
			$html='<div class="container-fluid">
				
				<div style="width:100px; height:100px;">
								<img style = "height:100px; width:100px;"src= '.$root_path."/uploads/agency_logo/".$agency[0]->image.' />
				</div>';
			}
			else
             $html='<div class="container-fluid">';
			
			$html.= ' <h3 align="center" style="padding-top:0px !important; font-size:16px;margin-left:5px;"> SERVICE AGREEMENT<br/>
                    <span style="font-size:16px;"align="center">BETWEEN FOREIGN DOMESTIC WORKER EMPLOYER AND EMPLOYMENT AGENCY</span></h3>
                    
                  <p style="font-size:16px;font-weight:bold;">Employment Agency Ref No. :<span style="margin-left:15px;">'.$maid_employer->id.'</span></p>
                  <p>Parties to this agreement are to retain a signed copy of this agreement.</p>
                  <hr/>
                  
                  <table class="table" style="line-height:1.5;margin-top:0px !important; margin-bottom:10px !important;font-size: 16px;">
                    <tbody>
                      <tr>
                        <td style="width:350px"><span>(A)</span> <span style="padding-left:12px;">Full Name of Employment Agency<span style="font-weight:bold;">("Agency") </span></span></td><td style="font-weight:500; padding-left:5px;">: '.ucfirst($agency[0]->company_name).'</td>
                      </tr>
                      <tr>
                        <td><span style="padding-left:35px;">Employment Agency License Number</span> 
                        </td>
                          <td style="font-weight:500; padding-left:5px;">: '.$agency[0]->license_no.'
                      </td>
                      </tr>
                      <tr>
                        <td ><span style="padding-left:35px;">
                          Registered Business Address</span> 
                        </td>
                        <td style="font-weight:500; padding-left:5px;">
                          : '.$agency[0]->address.'
                        </td>
                       </tr>
                       
                </tbody>
                </table>
                     <table class="table" style="line-height:1.5;font-size: 16px;">
                     <tbody>
                     <tr>
                        
                        <td style="width:350px">      
                        <span>(B)</span><span style="padding-left:16px;">Full Name of Employment <span style="font-weight:bold;">("Employer")</span></span></td><td style="font-weight:500; padding-left:5px;">: '.ucfirst($employer_details->employer_name).'</td>
                      </tr>
                      <tr>
                        <td><span style="padding-left:35px;">NRIC/Passport Number</span></td> 
                  
                          <td style="font-weight:500; padding-left:5px;">: '.$employer_details->employer_nric_no.'
                      </td>
                      </tr>
                      <tr>
                        <td><span style="padding-left:35px;">
                          Address</span></td>
                        <td style="font-weight:500; padding-left:5px;">: '.$employer_details->address.'
                        </td>
                       </tr>
                </tbody>
                </table>
                </div>
                ';
            $html.=$dom->saveHTML();
            $html.='<table style="width:100%;">
                        <tr>
                          <td style="text-align:left;font-weight:bold;">
                          __________________________ <br />
                          Signature by Employer/Client
                          </td>
                          <td style="text-align:left;font-weight:bold;">
                          ______________________________ <br />
                          Signed for and on behalf of
                           Agency
                          </td>
                        </tr>
                          <tr>
                          <td style="text-align:left;font-weight:bold;">
                          Name: '.ucfirst($employer_details->employer_name).'
                          </td>
                          <td style="text-align:left;font-weight:bold;">'.ucfirst($agency[0]->company_name).'
                          </td>
                        </tr>
                          </tr>
                          <tr>
                          <td style="text-align:left;font-weight:bold;">
                          NRIC or Passport No: '.$employer_details->employer_nric_no.'
                          </td>
                          <td style="text-align:left;font-weight:bold;">Date:'.$date.'
                          </td>
                        </tr>
                          </tr>
                          <tr>
                          <td style="text-align:left;font-weight:bold;">
                          Date:'.$date.'
                          </td>
                        </tr>
                      </table>';
          }else{
            foreach ($dom->getElementsByTagName('input') as $link) 
            {
              foreach($json as $name => $value){
                if ($link->getAttribute('name') == $name) {        
                    $link->setAttribute('value',$value);
                } 
              }
            }
           // print_r($xpath->query('//select')); exit;
            foreach ($dom->getElementsByTagName('select') as $select) 
            {
              foreach($json as $name => $value){ 
                if ($select->getAttribute('name') == $name) {
                    $data[$select->getAttribute('name')]=$value;
                } 
              }
            }
            if(!empty($agencyemployeragreementjsondata)){     
                foreach ($xpath->query('//select') as $select) {
                  if(array_key_exists($select->getAttribute('name'), $data)){//echo 'ok'; exit;
                    foreach($xpath->query('./option', $select) as $option) {
                        if ($option->getAttribute('value') == $data[$select->getAttribute('name')]) {
                            $option->setAttribute('selected', 'selected');
                        }
                    }
                  }
                } 
            }
            $html='<div class="small-1 columns text-right" style="width: 100%;">
               <a class="fa fa-download" title="Pdf" href="'.url("application/".$maid_employer->id."/agencyemployeragreement/yes").'"></a>
            </div>';

            $html.=$dom->saveHTML();
            $html.='<input type="hidden" name="agency_agreement_form_id" value="'.$agencyemployeragreementform[0]->id.'">
                   <div style="margin-top:20px;"class="row">
                        <div class="small-10 margin-left columns">      
                              <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
                               <button onclick="window.location=\''.url("application").'\'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                        </div>
                    </div>';
          }
      
    }else{
      $html="Form not available.";
    } 
    $servicefees = Agencymaidserviceschedule::where('employer_maid_id' , '=', $maid_application)->first();
    if($maid_employer->type == 'A New FDW'){
      $maid_employer->form_type = 'New Transfer';
      $mode = 'newtransfer';
    }
    if($maid_employer->type == 'A Replacement'){
      $maid_employer->form_type = 'Replacement';
       $mode = 'replacement';
    }
    if($maid_employer->type == 'An Additional FDW'){
      $maid_employer->form_type = 'Replacement';
       $mode = 'replacement';
    }
    $agencyservice = DB::table('agency_service as ags')
                      ->select("ags.*")
                      ->where('ags.mode', '=',$mode)
                      ->where('ags.agency_id','=',$user_id)
                      ->get();
   $totalservicecost=0; 
   $totalplacementcost= 0;
   $service_fee_charged = 0;
   $personal_loan = 0;
   $deposit =0;
   $balance =0;
    if($servicefees){
            $agencymaidservice = DB::table('agency_maid_service as ams')
                    ->select("ams.service_id","ams.service_cost") 
                    ->where('ams.service_schedule_id', '=', $servicefees->id)->get();
       
            
              foreach($agencyservice as $agencyservice_id => $agencyservice_value){
              if($agencyservice_value->type == 'S'){
                foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value){
                  if($agencyservice_value->id == $agencymaidservice_value->service_id){
                     $totalservicecost=$totalservicecost+ $agencymaidservice_value->service_cost; 
                  } 
                }
              }
            } 

            foreach($agencyservice as $agencyservice_id => $agencyservice_value){
              if($agencyservice_value->type == 'P'){
                foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value){
                  if($agencyservice_value->id == $agencymaidservice_value->service_id){
                         $totalplacementcost=$totalplacementcost+ $agencymaidservice_value->service_cost; 
                  }
                }
              }
            }
            // adding pacement fee required services
            $totalplacementcost = $servicefees->placement_fee_service_charge + $servicefees->placement_fee_personal_loan + $totalplacementcost;
            $service_fee_charged = $servicefees->placement_fee_service_charge;
            $personal_loan = $servicefees->placement_fee_personal_loan;
            $deposit =$servicefees->deposite;
            $balance =$servicefees->final_payment;
    }
    $search = array('TOTAL_SERVICE_FEE', 'TOTAL_PLACEMENT_FEE','PLACEMENT_SERVICE_FEE_CHARGED','PLACEMENT_PERSONAL_LOAN','SERVICE_FEE_DEPOSIT','SERVICE_FEE_BALANCE');
    $replace = array('<b>S$ '.$totalservicecost.'</b>', '<b>S$ '.$totalplacementcost.'</b>', '<b>S$ '.$service_fee_charged.'</b>', '<b>S$ '.$personal_loan.'</b>', '<b>S$ '.$deposit.'</b>', '<b>S$ '.$balance.'</b>'); 
    $html = str_replace($search, $replace, $html);

  /// complete ///
    if($ispdf =='yes'){
    // echo $html;exit;
    $pdf = PDF::loadHTML($html);
    return $pdf->download('Agreement_between_Agency_and_employer_'.$maid_employer->id.'.pdf');
    }
    else{
    return $html = str_replace($search, $replace, $html);
    }
  }
  /**
   * Agency Employer Agreement Data Save
   *
   * @param  int  $id = employer_maid_id
   * @return Response
   */
  public function agencyagreementdata($maid_application, Request $request) { 
      $data = $request->all();  
      //print_r($data); exit;
      $json = json_encode($data);
      DB::table('agency_agreement_data')->where('application_id','=', $maid_application)->where('agency_agreement_form_id','=', $data['agency_agreement_form_id'])->delete();
      $help = DB::insert('insert into agency_agreement_data (agency_agreement_form_id,application_id,json) values (?,?,?)', [$data['agency_agreement_form_id'],$maid_application,$json]);
      $count = count($help);          
      \Session::flash('success', 'Service employer and agency agreement has been updated.');
      return redirect("application/".$maid_application."/edit?tab=tab4");
    }
    /**
   * Agency FDW Agreement form
   *
   * @param  int  $id = application id
   * @param  int  $formid = formid
   * @return Response
   */
  public function agencyfdwagreement($maid_application = false,$ispdf = false) {
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    if($maid_application ==''){
    $maid_application =  Input::get('id');
    }
    $formtype =  Input::get('formtype');
    if($formtype = 'Service_Employer_and_Fdw'){
      $formtype = 'Service Employer and Fdw';
    }
    $maid_employer = maid_application::findOrFail($maid_application);
    $agency = DB::table('users as u')
                ->select("u.*")
                ->where('u.id','=',$maid_employer->user_agents_id)
                ->get();  
    //// service employer and agency form tab
    $agencyfdwagreementform = DB::table('agency_agreement_forms as aaf')
                ->select("aaf.*")
                ->where('aaf.form_type','=',$formtype)
                ->where('aaf.agency_id','=',$user_id)
                ->get();  
    if(!empty($agencyfdwagreementform))   {         
    $agencyfdwagreementjsondata = DB::table('agency_agreement_data as aad')
            ->select("aad.json")
            ->where('aad.agency_agreement_form_id','=',$agencyfdwagreementform[0]->id)
            ->where('aad.application_id','=',$maid_application)->get();
    }else{
        $agencyfdwagreementjsondata = array();
    }  
    /// domdocumnrt form generation
      $dom = new \DOMDocument();
        if(!empty($agencyfdwagreementform)){
            $data=array();
            @$dom->loadHTML(mb_convert_encoding( $agencyfdwagreementform[0]->content,  'HTML-ENTITIES', 'UTF-8')); 
            $xpath = new \DOMXPath($dom);
            $nodes = $xpath->query('//input[@name="test"]');
            $node = $nodes->item(0);
            //print_r($node); exit;
            if(!empty($agencyfdwagreementjsondata)){
              $json = json_decode($agencyfdwagreementjsondata[0]->json);
            }else{
              $json= array();
            }
            if($ispdf == 'yes'){
            foreach ($dom->getElementsByTagName('input') as $link) 
            {
              $inputnamearray[]= $link->getAttribute('name');
            }
            $textfield = $dom->getElementsByTagName('input');
            $inputcount = $textfield->length;
            while($inputcount) {
              $fieldname = $textfield->item(0); 
              if(in_array($fieldname->getAttribute('name'),$inputnamearray)){ 
                  foreach($json as $name => $value){
                    if ($fieldname->getAttribute('name') == $name) { //echo $fieldname->getAttribute('name').'ok</br>'; 
                      if($value==''){
                        $fieldname->parentNode->replaceChild($dom->createTextNode('_____'), $fieldname);
                      }else{
                        $fieldname->parentNode->replaceChild($dom->createTextNode($value), $fieldname);
                      }
                    } 
                  }
                }else{
                  $fieldname->parentNode->replaceChild($dom->createTextNode('_____'), $fieldname);
                }
                $inputcount--;
            }
           // print_r($xpath->query('//select')); exit;
            foreach ($dom->getElementsByTagName('select') as $select) 
            {
              $selectnamearray[]= $select->getAttribute('name');
            }
            $selectfield = $dom->getElementsByTagName('select');
            $selectcount = $selectfield->length;
            while($selectcount) {
              $selectfieldname = $selectfield->item(0);
                if(in_array($selectfieldname->getAttribute('name'),$selectnamearray)){ 
                  foreach($json as $name => $value){
                    if ($selectfieldname->getAttribute('name') == $name) {
                        $selectfieldname->parentNode->replaceChild($dom->createTextNode($value), $selectfieldname);
                    } 
                  }
                }
              $selectcount--;
            }
			$root_path = $_SERVER['DOCUMENT_ROOT'];
            $maid_details = json_decode($maid_employer->maid_json_data);
            $employer_details = json_decode($maid_employer->employer_json_data); 
			$date = date("d-m-Y");
			if($agency[0]->image)
			{
			$html='<div class="container-fluid">
				
				<div style="width:100px; height:100px;">
								<img style = "height:100px; width:100px;"src= '.$root_path."/uploads/agency_logo/".$agency[0]->image.' />
				</div>';
			}
			else
             $html='<div class="container-fluid">';
				
	$html.='<h3 align="center" style="padding-top:0px !important;margin-left:5px;"> STANDARD EMPLOYMENT CONTRACT <br/><span>BETWEEN FOREIGN DOMESTIC WORKER AND EMPLOYER</span> </h3>
   
    
  
  <table class="table" style="line-height:1;margin-top:0px !important; margin-bottom:15px !important;">
    <tbody>
      <tr>
        <td><span style="font-weight:bold;">Employment Agency Name</span></td><td style="font-weight:500; padding-left:5px;">: '.$agency[0]->company_name.'</td>
      </tr>
      <tr>
        <td><span style="font-weight:bold;">License No.</span> 
        </td>
          <td style="font-weight:500; padding-left:5px;">: '.$agency[0]->license_no.'
      </td>
      </tr>
      <tr>
        <td><span style="font-weight:bold;">
          Reference No. </span> 
        </td>
        <td>: 
        </td>
       </tr>
       
</tbody>
</table>
  <p style="margin-top:30px;">This employment contract is made between (a) The Employer and (b) The Foreign Domestic Worker (FDW) in Section A, based on the terms contained in Section B.</p>
  <p>A copy of the <span style="border-bottom:1px solid #000;">Contract (with all blanks filled in and options selected)</span> and <span style="border-bottom:1px solid #000;">Job ScopeSheet (Annex A) </span>translated into the FDW’s language should be given to the FDW in her home country before she signs the contract</p>
  <p ><span style="border-bottom:1px solid #000;">The Schedules of Salary Payment and Loan (including loan for placement fee)Repayment (Annex B)</span>shall be filled up at the same time the contract is signed. </p>
    <h3 style="padding-top:0px !important;margin-left:5px;margin-top:15px;"> Section A: Particulars of Parties in Contract </h3>
  <hr/>
     <p style="margin-left:15px;">(a) The Employer </p>
     <table class="table" style="line-height:1;margin-left:30px;margin-bottom:15px;width:100%;">
     <tbody>
     <tr>
        
        <td style="width:200px;">      
        <span >Full Name</span></td><td >: '.$employer_details->employer_name.'</td>
      </tr>
      <tr>
        <td><span>NRIC/Passport No.</span></td> 
  
          <td>: '.$employer_details->employer_nric_no.'
      </td>
      </tr>
      <tr>
        <td><span>
          Address</span></td>
        <td style="font-weight:500; ">: '.$employer_details->address.'
        </td>
       </tr>
</tbody>
</table>
<p style="margin-left:15px;">(b)  The Foreign Domestic Worker (FDW) </p>  
<table class="table" style="line-height:1;margin-left:30px;">
     <tbody>
     <tr>
        
        <td>      
        <span>Full Name</span></td><td style="font-weight:500; ">: '.$maid_details->name.'</td>
      </tr>
      <tr>
        <td style="width:200px;"><span>Work Permit No.</span></td> 
  
          <td style="font-weight:500;">: 
      </td>
      </tr>
      <tr>
        <td><span >
          Passport No.</span></td><td style="font-weight:500;">: '.$maid_details->passport_number.'</td>
       </tr>
</tbody>
</table>

</div>';
            $html.=$dom->saveHTML();
            $html.='<table style="width:100%;">
                        <tr>
                          <td style="text-align:left;font-weight:bold;">
                          __________________________ <br />
                          Signature by Employer/Client
                          </td>
                          <td style="text-align:left;font-weight:bold;">
                          ______________________________ <br />
                          Signature by FDW
                          </td>
                        </tr>
                          <tr>
                          <td style="text-align:left;font-weight:bold;">
                          Name: '.ucfirst($employer_details->employer_name).'
                          </td>
                          <td style="text-align:left;font-weight:bold;">'.ucfirst($maid_details->name).'
                          </td>
                        </tr>
                          </tr>
                          <tr>
                          <td style="text-align:left;font-weight:bold;">
                          NRIC or Passport No: '.$employer_details->employer_nric_no.'
                          </td>
                          <td style="text-align:left;font-weight:bold;">Date:'.$date.'
                        </tr>
                          </tr>
                          <tr>
                          <td style="text-align:left;font-weight:bold;">
                          Date:'.$date.'
                          </td>
                        </tr>
                      </table>';
          }else{
            foreach ($dom->getElementsByTagName('input') as $link) 
            {
              foreach($json as $name => $value){
                if ($link->getAttribute('name') == $name) {
                   $link->setAttribute('value',$value);
               
                } 
              }
            }
           // print_r($xpath->query('//select')); exit;
            foreach ($dom->getElementsByTagName('select') as $select) 
            {
              foreach($json as $name => $value){ 
                if ($select->getAttribute('name') == $name) {
                    $data[$select->getAttribute('name')]=$value;
                } 
              }
            }
            if(!empty($agencyfdwagreementjsondata)){     
                foreach ($xpath->query('//select') as $select) {
                  if(array_key_exists($select->getAttribute('name'), $data)){
                    foreach($xpath->query('./option', $select) as $option) {
                        if ($option->getAttribute('value') == $data[$select->getAttribute('name')]) {
                            $option->setAttribute('selected', 'selected');
                        }
                    }
                  }
                } 
            }
            $html='<div class="small-1 columns text-right" style="width: 100%;">
               <a class="fa fa-download" title="Pdf" href="'.url("application/".$maid_employer->id."/agencyfdwagreement/yes").'"></a>
            </div>';

            $html.=$dom->saveHTML();
            $html.='<input type="hidden" name="agency_agreement_form_id" value="'.$agencyfdwagreementform[0]->id.'">
                   <div style="margin-top:20px;"class="row">
                        <div class="small-10 margin-left columns">      
                              <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
                               <button onclick="window.location=\''.url("application").'\'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                        </div>
                    </div>';
          }
        }else{
          $html="Form not available.";
        }
      $date_of_com= date('d');
$one_day_compensation="0";
$rest_day='0';
$total_compensation='0';
$rest_day_not_taken='0';
$total_wages="0";
	$salarypayment = salarypaymentandloan::where('employer_maid_id' , '=', $maid_application)->first();
if($salarypayment){ $restday = DB::table('maid_app_rest_day as mrd')
						->select("mrd.*")
						->where('mrd.employer_maid_id', '=', $maid_employer->id)
						->get();
	
	$date_of_com=date("d",strtotime($salarypayment->date_of_commencement));
	if($restday){
	$one_day_compensation=$restday[0]->compensation;
	if($restday[0]->rest_days=='Rest according month') {
	$rest_day=$restday[0]->no_of_restday;
	$total_compensation=(4-$restday[0]->no_of_restday)*$one_day_compensation;
	$rest_day_not_taken=4-$restday[0]->no_of_restday;
	}
        else{$rest_day='4';
	$total_compensation='0';
	$rest_day_not_taken='0';
	}}

	
}

$maid_details = json_decode($maid_employer->maid_json_data);$total_wages=$total_compensation+$maid_details->expected_salary;
    $search = array('MAID_TOTAL_WAGES' ,'ONE_DAY_COMPENSATION','REST_DAY_TAKEN' ,'TOTAL_COMPENSATION','REST_DAY_NOT_TAKEN','TOTAL_WAGES','COMMENCEMENT_DATE');
    $replace = array('<b>S$ '.$maid_details->expected_salary.'</b>','<b>S$ '.$one_day_compensation.'</b>',
'<b> '.$rest_day.'</b>','<b>S$ '.$total_compensation.'</b>','<b> '.$rest_day_not_taken.'</b>','<b>S$ '.$total_wages.'</b>','<b> '.$date_of_com.'</b>',); 
    $html = str_replace($search, $replace, $html);
    // completed   
    //echo '<pre>'; print_r($agencyfdwagreementform ); exit;
    if($ispdf =='yes'){
    //  echo $html; exit;
      $pdf = PDF::loadHTML($html);
      return $pdf->download('Agreement_between_fdw_and_employer_'.$maid_employer->id.'.pdf');
    }
    else{
    return   $html = str_replace($search, $replace, $html);
  }
    
  }
  /**
   * Agency Fdw Agreement Data Save
   *
   * @param  int  $id = employer_maid_id
   * @return Response
   */
  public function agencyfdwagreementdata($maid_application, Request $request) { 
      $data = $request->all();  
      //print_r($data); exit;
      $json = json_encode($data);
      DB::table('agency_agreement_data')->where('application_id','=', $maid_application)->where('agency_agreement_form_id','=', $data['agency_agreement_form_id'])->delete();
      $help = DB::insert('insert into agency_agreement_data (agency_agreement_form_id,application_id,json) values (?,?,?)', [$data['agency_agreement_form_id'],$maid_application,$json]);
      $count = count($help);          
      \Session::flash('success', 'Service employer and agency agreement has been updated.');
      return redirect("application/".$maid_application."/edit?tab=tab5");
    }
   /**
   * Update the tab6 Job Scope 
   *
   * @param  int  $id = employer_maid_id
   * @return Response
   */
	 public function jobscopeupdate($employer_maid_id, Request $request) {
	   $data = $request->all();
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	  Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });
	   if(!(array_key_exists('domestic_duties', $data)))
		{
			$data['domestic_duties']='';
		}else{
			$data['domestic_duties'] = implode(';',$data['domestic_duties']);
		}
		if(!(array_key_exists('place_of_work', $data)))
		{
			$data['place_of_work']='';
		}else{
			$data['place_of_work'] = implode(';',$data['place_of_work']);
		}
     $messages = array(
			'alpha_spaces' => 'Please enter aplphabatic values.',
          'place_of_work.required' => 'Please select any place of work.',
          'domestic_duties.required' => 'Please select domestic duties.',
      );
		$validator = Validator::make($request->all(), [
          'place_of_work' => 'required',
          'domestic_duties' => 'required',
          'other_duty' => 'max:255',
          'other_work_place' => 'max:255',
            ],$messages);
    if ($validator->fails()) {
          return redirect("application/".$employer_maid_id."/edit?tab=tab7")
                      ->withErrors($validator)
                      ->withInput();
      } 
     $jobscope = Maid_app_job_scope::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($jobscope){
          $jobscope->update($data);
          $jobscopeid = $jobscope->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $job = Maid_app_job_scope::create($data);
          $jobscopeid = $job->id;
        }

    \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/edit?tab=tab7");
			
		
	 }
public function agencyfdwcontract($maid_application = false,$ispdf = false) {	 
	  $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    if($maid_application ==''){
    $maid_application =  Input::get('id');
    }
    $formtype =  Input::get('formtype');
    if($formtype = 'Contract_Fdw_and_Agency'){
      $formtype = 'Contract Fdw and Agency';
    } 
    $maid_employer = maid_application::findOrFail($maid_application);
    $agency = DB::table('users as u')
                ->select("u.*")
                ->where('u.id','=',$maid_employer->user_agents_id)
                ->get();  
    //// service employer and agency form tab
    $agencyfdwagreementform = DB::table('agency_agreement_forms as aaf')
                ->select("aaf.*")
                ->where('aaf.form_type','=',$formtype)
                ->where('aaf.agency_id','=',$user_id)
                ->get(); 
		//print_r($agencyfdwagreementform);
    if(!empty($agencyfdwagreementform))   {         
    $agencyfdwagreementjsondata = DB::table('agency_agreement_data as aad')
            ->select("aad.json")
            ->where('aad.agency_agreement_form_id','=',$agencyfdwagreementform[0]->id)
            ->where('aad.application_id','=',$maid_application)->get();
    }else{
        $agencyfdwagreementjsondata = array();
    }  
	 /// domdocumnrt form generation
      $dom = new \DOMDocument();
        if(!empty($agencyfdwagreementform)){
            $data=array();
            @$dom->loadHTML(mb_convert_encoding( $agencyfdwagreementform[0]->content,  'HTML-ENTITIES', 'UTF-8')); 
            $xpath = new \DOMXPath($dom);
            $nodes = $xpath->query('//input[@name="test"]');
            $node = $nodes->item(0);
            //print_r($node); exit;
            if(!empty($agencyfdwagreementjsondata)){
              $json = json_decode($agencyfdwagreementjsondata[0]->json);
            }else{
              $json= array();
            }
            if($ispdf == 'yes'){
            foreach ($dom->getElementsByTagName('input') as $link) 
            {
              $inputnamearray[]= $link->getAttribute('name');
            }
            $textfield = $dom->getElementsByTagName('input');
            $inputcount = $textfield->length;
            while($inputcount) {
              $fieldname = $textfield->item(0); 
              if(in_array($fieldname->getAttribute('name'),$inputnamearray)){ 
                  foreach($json as $name => $value){
                    if ($fieldname->getAttribute('name') == $name) { //echo $fieldname->getAttribute('name').'ok</br>'; 
                      if($value==''){
                        $fieldname->parentNode->replaceChild($dom->createTextNode('_____'), $fieldname);
                      }else{
                        $fieldname->parentNode->replaceChild($dom->createTextNode($value), $fieldname);
                      }
                    } 
                  }
                }else{
                  $fieldname->parentNode->replaceChild($dom->createTextNode('_____'), $fieldname);
                }
                $inputcount--;
            }
           // print_r($xpath->query('//select')); exit;
            foreach ($dom->getElementsByTagName('select') as $select) 
            {
              $selectnamearray[]= $select->getAttribute('name');
            }
            $selectfield = $dom->getElementsByTagName('select');
            $selectcount = $selectfield->length;
            while($selectcount) {
              $selectfieldname = $selectfield->item(0);
                if(in_array($selectfieldname->getAttribute('name'),$selectnamearray)){ 
                  foreach($json as $name => $value){
                    if ($selectfieldname->getAttribute('name') == $name) {
                        $selectfieldname->parentNode->replaceChild($dom->createTextNode($value), $selectfieldname);
                    } 
                  }
                }
              $selectcount--;
            }
			$root_path = $_SERVER['DOCUMENT_ROOT'];
            $maid_details = json_decode($maid_employer->maid_json_data);
            $employer_details = json_decode($maid_employer->employer_json_data); 
			if($agency[0]->image)
			{
			$html='<div class="container-fluid" >
				
				<div style="width:100px; height:100px;">
								<img style = "height:100px; width:100px;"src= '.$root_path."/uploads/agency_logo/".$agency[0]->image.' />
				</div>';
			}
			else
            $html='<div  style="font-size: 12px; font-family: Arial;">';	
	$html.='<h3 align="center" style="padding-top:0px !important; margin-top:0px !important; margin-bottom:2px !important;margin-left:5px; font-size: 12px; font-family: Arial;"> STANDARD EMPLOYMENT CONTRACT <br/><span>BETWEEN FOREIGN DOMESTIC WORKER AND EMPLOYMENT AGENCY</span> </h3>
   <table class="table" style="line-height:1;margin-top:0px !important; margin-bottom:2px !important; font-size: 12px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;">
    <tbody>
      <tr>
        <td><span style="">Employment Agency Name</span></td><td style="padding-left:5px; text-transform: uppercase !important;">: '.$agency[0]->company_name.'</td>
      </tr>
      <tr>
        <td><span style="">License No.</span></td><td style="padding-left:5px;">: '.$agency[0]->license_no.'</td>
      </tr>
      <tr><td><span>Reference No. </span></td>
        <td>:</td>
       </tr>
       
</tbody>
</table>
  <p style="margin-top:5px!important; margin-bottom:2px !important;; font-size: 12px; font-family: Arial;">This employment contract is made between (a)'.$agency[0]->company_name. '(b) The Foreign Domestic Worker (FDW) in Section A, based on the terms contained in Section B.</p>
  <p style="font-size: 12px; font-family: Arial;">A copy of the <span style="border-bottom:1px solid #000;">Contract (with all blanks filled in and options selected)</span> translated into the FDW’s language should be given to the FDW in her home country before she signs the contract</p>
    <h3 style="padding-top:0px !important;margin-left:5px;margin-top:2px;font-size: 12px; font-family: Arial;"> Section A: Particulars of Parties in Contract </h3>
  <hr/>
     <p style="margin:0px,0px,0px,15px; font-size: 12px; font-family: Arial;">(a) The Employer </p>
     <table class="table" style="line-height:1;margin-left:30px;margin-top:0px !important; margin-bottom:2px !important;width:100%; font-size: 12px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;">
     <tbody>
     <tr>
        
        <td style="width:200px;"><span >Full Name</span></td><td style=" text-transform: capitalize; " >: <b>'.$employer_details->employer_name.'</b></td>
      </tr>
      <tr>
        <td style="width:200px;"><span >EA No.</span></td> <td>: <b>'.$agency[0]->license_no.'</b></td>
      </tr>
      <tr>
        <td><span>Address</span></td>
        <td style=" text-transform: capitalize; ">: <b>'.$agency[0]->address.'</b></td>
       </tr>
</tbody>
</table>
<p style="margin:0px,0px,0px,15px; font-size: 12px; font-family: Arial;">(b)  The Foreign Domestic Worker (FDW) </p>  
<table class="table" style="line-height:1;margin-left:30px; margin-top:0px !important; margin-bottom:2px !important; font-size: 12px; font-family: Arial;">
     <tbody>
     <tr>
        
        <td>      
        <span>Full Name</span></td><td style="font-weight:500; text-transform: capitalize;">:<b> '.$maid_details->name.'</b></td>
      </tr>
      <tr>
        <td style="width:200px;"><span>Work Permit No.</span></td> 
  
          <td style="">: 
      </td>
      </tr>
      <tr>
        <td><span >
          Passport No.</span></td><td style="">:<b> '.$maid_details->passport_number.'</b></td>
       </tr>
</tbody>
</table>
 <h3 style="padding-top:0px !important;margin-left:5px;margin-top:5px;  font-size: 12px; font-family: Arial"> Section B: Terms of Contract </h3>
  <hr/>
</div>';
            $html.=$dom->saveHTML();
            
          }else{
            foreach ($dom->getElementsByTagName('input') as $link) 
            {
              foreach($json as $name => $value){
                if ($link->getAttribute('name') == $name) {
                   $link->setAttribute('value',$value);
               
                } 
              }
            }
           // print_r($xpath->query('//select')); exit;
            foreach ($dom->getElementsByTagName('select') as $select) 
            {
              foreach($json as $name => $value){ 
                if ($select->getAttribute('name') == $name) {
                    $data[$select->getAttribute('name')]=$value;
                } 
              }
            }
            if(!empty($agencyfdwagreementjsondata)){     
                foreach ($xpath->query('//select') as $select) {
                  if(array_key_exists($select->getAttribute('name'), $data)){
                    foreach($xpath->query('./option', $select) as $option) {
                        if ($option->getAttribute('value') == $data[$select->getAttribute('name')]) {
                            $option->setAttribute('selected', 'selected');
                        }
                    }
                  }
                } 
            }
            $html='<div class="small-1 columns text-right" style="width: 100%;">
               <a class="fa fa-download" title="Pdf" href="'.url("application/".$maid_employer->id."/agencyfdwcontract/yes").'"></a>
            </div>';

            $html.=$dom->saveHTML();
            $html.='<input type="hidden" name="agency_agreement_form_id" value="'.$agencyfdwagreementform[0]->id.'">
                   <div style="margin-top:20px;"class="row">
                        <div class="small-10 margin-left columns">      
                              <button  class="button small" type="submit" id="cancel" name="submit_next" value="next">Save & Next</button>
                               <button onclick="window.location=\''.url("application").'\'" class="button small" type="button" id="cancel" name="cancel">Go To List</button>
                        </div>
                    </div>';
          }
        }else{
          $html="Form not available.";
        }
        $servicefees = Agencymaidserviceschedule::where('employer_maid_id' , '=', $maid_application)->first();
    if($maid_employer->type == 'A New FDW'){
      $maid_employer->form_type = 'New Transfer';
      $mode = 'newtransfer';
    }
    if($maid_employer->type == 'A Replacement'){
      $maid_employer->form_type = 'Replacement';
       $mode = 'replacement';
    }
    if($maid_employer->type == 'An Additional FDW'){
      $maid_employer->form_type = 'Replacement';
       $mode = 'replacement';
    }
    $agencyservice = DB::table('agency_service as ags')
                      ->select("ags.*")
                      ->where('ags.mode', '=',$mode)
                      ->where('ags.agency_id','=',$user_id)
                      ->get();
   $totalservicecost=0; 
   $totalplacementcost= 0;
   $service_fee_charged = 0;
   $personal_loan = 0;
   $deposit =0;
   $balance =0;
    if($servicefees){
            $agencymaidservice = DB::table('agency_maid_service as ams')
                    ->select("ams.service_id","ams.service_cost") 
                    ->where('ams.service_schedule_id', '=', $servicefees->id)->get();
       
            
              foreach($agencyservice as $agencyservice_id => $agencyservice_value){
              if($agencyservice_value->type == 'S'){
                foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value){
                  if($agencyservice_value->id == $agencymaidservice_value->service_id){
                     $totalservicecost=$totalservicecost+ $agencymaidservice_value->service_cost; 
                  } 
                }
              }
            } 

            foreach($agencyservice as $agencyservice_id => $agencyservice_value){
              if($agencyservice_value->type == 'P'){
                foreach($agencymaidservice as $agencymaidservice_id => $agencymaidservice_value){
                  if($agencyservice_value->id == $agencymaidservice_value->service_id){
                         $totalplacementcost=$totalplacementcost+ $agencymaidservice_value->service_cost; 
                  }
                }
              }
            }
            $totalplacementcost = $servicefees->placement_fee_service_charge + $servicefees->placement_fee_personal_loan + $totalplacementcost;
            $service_fee_charged = $servicefees->placement_fee_service_charge;
            $personal_loan = $servicefees->placement_fee_personal_loan;
            $deposit =$servicefees->deposite;
            $balance =$servicefees->final_payment;
    }
    $search = array('TOTAL_SERVICE_FEE', 'TOTAL_PLACEMENT_FEE','PLACEMENT_SERVICE_FEE_CHARGED','PLACEMENT_PERSONAL_LOAN','SERVICE_FEE_DEPOSIT','SERVICE_FEE_BALANCE');
    $replace = array('<b>S$ '.$totalservicecost.'</b>', '<b>S$ '.$totalplacementcost.'</b>', '<b>S$ '.$service_fee_charged.'</b>', '<b>S$ '.$personal_loan.'</b>', '<b>S$ '.$deposit.'</b>', '<b>S$ '.$balance.'</b>'); 
    $html = str_replace($search, $replace, $html);
    // completed   
    //echo '<pre>'; print_r($agencyfdwagreementform ); exit;
    if($ispdf =='yes'){
    //  echo $html; exit;
      $pdf = PDF::loadHTML($html);
      return $pdf->download('Contract_between_fdw_and_employmentAgnecy_'.$maid_employer->id.'.pdf');
    }
    else{
    return   $html = str_replace($search, $replace, $html);
  }
    
	}
	/**
   * Agency Fdw Contract Data Save
   *
   * @param  int  $id = employer_maid_id
   * @return Response
   */
  public function agencyfdwcontractdata($maid_application, Request $request) { 
      $data = $request->all();  
      //print_r($data); exit;
      $json = json_encode($data);
      DB::table('agency_agreement_data')->where('application_id','=', $maid_application)->where('agency_agreement_form_id','=', $data['agency_agreement_form_id'])->delete();
      $help = DB::insert('insert into agency_agreement_data (agency_agreement_form_id,application_id,json) values (?,?,?)', [$data['agency_agreement_form_id'],$maid_application,$json]);
      $count = count($help);          
      \Session::flash('success', 'Service employer and agency agreement has been updated.');
      return redirect("application/".$maid_application."/edit?tab=tab16");
    }
 public function dayofrest($employer_maid_id, Request $request) {
 	   $data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		Validator::extend('float_integer', function($attribute, $value)
			{
			    return preg_match('/^(\d+(.\d+)?$)/', $value);
			});
			$messages = array(
			'float_integer' => 'Please enter valid number.',
          'place_of_work.required' => 'Please select any place of work.',
          'domestic_duties.required' => 'Please select domestic duties.',
      );
	 // print_r($data); exit;
	  $restday = Maid_app_rest_day::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($restday){
          $restday->update($data);
          $restdayid = $restday->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $rest = Maid_app_rest_day::create($data);
          $restdayid = $rest->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/edit?tab=tab2");
			
 }
 public function handlingtakeover($employer_maid_id, Request $request) {
 
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		//print_r($data); exit;
		 $handlingtakeover = Maid_app_handling_takeover::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($handlingtakeover){
          $handlingtakeover->update($data);
          $handlingtakeoverid = $handlingtakeover->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $handling = Maid_app_handling_takeover::create($data);
          $handlingtakeoverid = $handling->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/edit?tab=tab6");
 }
 
   public function loanPayment($employer_maid_id, Request $request) 
   {
	 $data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		 $messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
    		'float_integer' => 'Please enter valid salary.',
    		'float_integer.max' => 'Please enter less than 20 digits.'
		);
		$validator = Validator::make($data, [
		'date_of_commencement' => 'required',
		'payment_arrangement' => 'required',
		'deduction_arrangement' => 'required',
		'contract_period' => 'required',
		],$messages);
		 if ($validator->fails()) {
            return redirect("application/".$employer_maid_id."/edit?tab=tab3")
                        ->withErrors($validator)
                        ->withInput();
        }
		
		 $salarypayment = salarypaymentandloan::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($salarypayment){
          $salarypayment->update($data);//print_r($data); exit;
          $salarypaymentid = $salarypayment->id;
        }
		else
		{
		 $data["employer_maid_id"]= $employer_maid_id;
          $salary = salarypaymentandloan::create($data);
          $salaryid = $salary->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/edit?tab=tab3");
   
   
          
   }
    public function paymentinvoice($employer_maid_id, Request $request) 
	{
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		$amount=$data['loan_amount'];
		$count =count($amount);	//print_r( $data); exit;
		$loanpayment = Loanmanualpayment::where('employer_maid_id' , '=', $employer_maid_id)->first();
		if($loanpayment){ 
		 DB::table('maid_app_loan_manual_payment')
            ->where('employer_maid_id','=', $employer_maid_id)->delete(); 
		
		}
		$total=array_sum($data['loan_amount']);
		//echo $total; exit;
		for($i=0;$i<$count;$i++)
		{//echo $count ;exit;
		$datas['employer_maid_id']=$employer_maid_id;
		$datas['dates']=$data['dates'][$i];
		//print_r( $datas['dates']); 
		$datas['loan_amount']=$data['loan_amount'][$i];
		$datas['payment']=$data['payment'][$i];
		$salary = Loanmanualpayment::create($datas);
		}
	
	 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/edit?tab=tab3");
	}
	/**
   * Edit the tab9. security bond
   * @return view
   */
	public function securitybond($maid_application) 
	{  $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
  
    //$maid_application =  Input::get('id');
    $securitybond = Maid_app_security_bond::where('employer_maid_id' , '=', $maid_application)->first();
	
		$maid_employer = maid_application::findOrFail($maid_application);
		 return view('sentinel.application.securitybond')->with('maid_employer',$maid_employer)->with('securitybond',$securitybond);
	} 
	 /**
   * Update the tab9. security bond
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function securitybondupdate($employer_maid_id, Request $request) 
	{ 
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		 $securitybond = Maid_app_security_bond::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($securitybond){
          $securitybond->update($data);
          $securitybondid = $securitybond->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $security = Maid_app_security_bond::create($data);
          $securitybondid = $security->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/securitybond");
	}
	/**
   * Edit the tab18. authorisation workpass
   * @return view
   */
	public function authorisationworkpass($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$authorisationworkpass = Maid_app_authorisation_workpass::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.authorisationworkpass')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('authorisationworkpass', $authorisationworkpass);
	}
	 /**
   * Update the tab8. authorisation workpass
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function authorisationworkpassupdate($employer_maid_id, Request $request) 
	{  
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		if(!(array_key_exists('is_agency_authorise_workpass', $data)))
		{
			$data['is_agency_authorise_workpass']='';
		}else{
			$data['is_agency_authorise_workpass'] = $data['is_agency_authorise_workpass'];
		}
		if(!(array_key_exists('is_emplyer_authoise_form_submit', $data)))
		{
			$data['is_emplyer_authoise_form_submit']='';
		}else{
			$data['is_emplyer_authoise_form_submit'] = $data['is_emplyer_authoise_form_submit'];
		}
		if(!(array_key_exists('declaration_by_ea', $data)))
		{
			$data['declaration_by_ea']='';
		}else{
			$data['declaration_by_ea'] = implode(';',$data['declaration_by_ea']);
		}
		//print_r($data); exit;
		$authorisationworkpass = Maid_app_authorisation_workpass::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($authorisationworkpass){
          $authorisationworkpass->update($data);
          $authorisationworkpassid = $authorisationworkpass->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $authorisation = Maid_app_authorisation_workpass::create($data);
          $authorisationworkpassid = $authorisation->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/authorisationworkpass");
	}
	/**
   * Edit the tab10. safety agreement
   * @return view
   */
	public function safetyagreement($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$safetyagreement = Maid_app_safety_agreement::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.safetyagreement')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('safetyagreement', $safetyagreement);
	}
	 /**
   * Update the tab10. safety agreement
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function safetyagreementupdate($employer_maid_id, Request $request) 
	{ 
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		if(!(array_key_exists('location_of_window', $data)))
		{
			$data['location_of_window']='';
		}else{
			$data['location_of_window'] = implode(';',$data['location_of_window']);
		}
		if(!(array_key_exists('dwelling_type', $data)))
		{
			$data['dwelling_type']='';
		}else{
			$data['dwelling_type'] = implode(';',$data['dwelling_type']);
		}
		if(!(array_key_exists('follow_advisory_checklist', $data)))
		{
			$data['follow_advisory_checklist']='No';
		}
		if(!(array_key_exists("follow_employer_condition", $data)))
		{
			$data["follow_employer_condition"]='No';
		}
		
		//print_r($data); exit;
		$safetyagreement =Maid_app_safety_agreement::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($safetyagreement){
          $safetyagreement->update($data);
          $safetyagreementid = $safetyagreement->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $safety =Maid_app_safety_agreement::create($data);
          $safetyagreementid = $safety->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/safetyagreement");
	}
	/**
   * Edit the tab13. income tax declaration
   * @return view
   */
	public function incometaxdeclaration($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$incometaxdeclaration = Maid_app_employer_tax_declaration::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.incometaxdeclaration')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('incometaxdeclaration', $incometaxdeclaration);
	}
 /**
   * Update the tab13. income tax declaration
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function incometaxdeclarationupdate($employer_maid_id, Request $request) 
	{ 
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		 $messages = array(
    	'employer_assessment_no.max:10' => "Employer assessment number can't be more than 10 digit.",
		'spouse_assessment_no.max:10' => "Employer's spouse assessment number can't be more than 10 digit.",
		);
		$validator = Validator::make($data, [
		'combined_income' => 'required',
		'employer_assessment_no' => 'max:10',
		'spouse_assessment_no' => 'max:10',
		],$messages);
		 if ($validator->fails()) {
            return redirect("application/".$employer_maid_id."/incometaxdeclaration")
                        ->withErrors($validator)
                        ->withInput();
        }
		//print_r($data); exit;
		$incometaxdeclaration =Maid_app_employer_tax_declaration::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($incometaxdeclaration){
          $incometaxdeclaration->update($data);
          $incometaxdeclarationid = $incometaxdeclaration->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $taxdeclaration =Maid_app_employer_tax_declaration::create($data);
          $incometaxdeclarationid = $taxdeclaration->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/incometaxdeclaration");
	}
	
	/**
   * Edit the tab11. work permit
   * @return view
   */
	public function workpermit($maid_application) 
	{//echo 'o0k'; exit;
	$user_id = Auth::user()->id; 
    $user_email =  Auth::user()->email;
//	$maid_application =  Input::get('id');
  $errors =  Input::get('errors');
	$maid_employer = maid_application::findOrFail($maid_application);
	$nationality = Countries::where('display_in_fdw','=','Y')->lists('nationality','id');
	$workpermit =Maid_app_fdw_work_permit::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
					
	return view('sentinel.application.workpermit')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('workpermit', $workpermit)->with('nationality', $nationality);
	}
	/**
   * Update the tab11. work permit
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function workpermitupdate($employer_maid_id, Request $request) 
	{  
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email; 
		 Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
			
		 $messages = array(
		'sponsor_name_1.alpha_spaces' => "Sponsor name must be in character.  ",
			'sponsor_name_2.alpha_spaces' => "Sponsor name must be in character  ",
    		);
		$validator = Validator::make($request->all(), [
		'sponsor_name_1' => 'required|min:3|max:255|alpha_spaces',
		'gender_1' => 'required',
		'dob_1' => 'required',
		'nationality_1' => 'required',
		'marital_status_1' => 'required',
		'relation_with_1' => 'required|min:3|max:255|alpha_spaces',
		'residential_status_1' => 'required',
		'passport_number_1' => 'required|max:10',
		'sponsor_spouse_name_1' => 'required_if:marital_status_1,Married|alpha_spaces|min:3|max:100',
		'passport_spouse_number_1' => 'required_if:marital_status_1,Married|alpha_num|max:10',
		'company_name_1' => 'Min:3|Max:255',
		'sponsor_name_2' => 'min:3|max:255|alpha_spaces',
		//'gender_2' => 'required_if:sponsor_name_2',
		//'dob_2' => 'required',
		//'nationality_2' => 'required',
		//'marital_status_2' => 'required',
		'relation_with_2' => 'min:3|max:255|alpha_spaces',
		//'residential_status_2' => 'required',
		'passport_number_2' => 'max:10',
		'sponsor_spouse_name_2' => 'required_if:marital_status_2,Married|alpha_spaces|min:3|max:100',
		'passport_spouse_number_2' => 'required_if:marital_status_2,Married|alpha_num|max:10',
		'company_name_2' => 'Min:3|Max:255',
		'email_address_1' =>'email',
		'email_address_2' =>'email',
		'contact_number_1'=> 'numeric|digits_between:8,15',
		'contact_number_2'=> 'numeric|digits_between:8,15',
		],$messages);
		 if ($validator->fails()) {
            return redirect("application/".$employer_maid_id."/workpermit")
                        ->withErrors($validator)
                        ->withInput();
        }
		//print_r($data); exit;
		$workpermit =Maid_app_fdw_work_permit::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($workpermit){
          $workpermit->update($data);
          $workpermitid = $workpermit->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $work =Maid_app_fdw_work_permit::create($data);
          $workpermitid = $work->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/workpermit");
	}
	
	/**
   * Edit the tab12. income tax declaration
   * @return view
   */
	public function giro($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$giroform = Maid_app_giro_form::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.giro')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('giroform', $giroform);
	}
	
	 /**
   * Update the tab12. safety agreement
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function giroupdate($employer_maid_id, Request $request) 
	{ 
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		if(!(array_key_exists('rejected_by', $data)))
		{
			$data['rejected_by']='';
		}else{
			$data['rejected_by'] = implode(';',$data['rejected_by']);
		}
		 $messages = array(
    	
		'bank_name.required' => 'Please enter name of bank.',
		'name_in_bank_acc.required' => 'Please enter name(as in Bank Account).',
		'account_no.required' => "Please enter account number.",		
		);
		
		$validator = Validator::make($data, [
		'bank_name' => 'required|Max:255',
		'name_in_bank_acc' => 'required|Max:255',
		'account_no' => 'required|Max:15',
		],$messages);
		 if ($validator->fails()) {
            return redirect("application/".$employer_maid_id."/giro")
                        ->withErrors($validator)
                        ->withInput();
        }
		//print_r($data); exit;
		$giroform =Maid_app_giro_form::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($giroform){
          $giroform->update($data);
          $giroformid = $giroform->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $giro =Maid_app_giro_form::create($data);
          $giroformid = $giro->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/giro");
	}
		/**
   * Edit the tab14. insurance
   * @return view
   */
	public function insurance($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;//print_r($user_id);exit;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $maid_application)->first();

	 if(Auth::user()->hasRole(['admin'])){
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$user_id)
					->get(); 
	$insurance_company = explode(',', $user_data[0]->insurance_company); 
	 }else{
	$agency = DB::table('users as u')
					->select('u.agency_id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$agency[0]->agency_id)
					->get(); 
	$insurance_company = explode(',', $user_data[0]->insurance_company); }
	
	foreach($insurance_company as $key=>$value){
    	$insurance_dropdown[$value] = $value;
	}
	return view('sentinel.application.insurance')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('insuranceform', $insuranceform)->with('insurance_dropdown', $insurance_dropdown);
	}
	 /**
   * Update the tab12. safety agreement
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function insuranceupdate($employer_maid_id, Request $request) 
	{ 
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		 $messages = array(
		);
		
		$validator = Validator::make($data, [
		'SB_transmission_number' => 'Max:15',
		'insurance_company_name'=>'required',
		],$messages);
		 if ($validator->fails()) {
            return redirect("application/".$employer_maid_id."/insurance")
                        ->withErrors($validator)
                        ->withInput();
        }
		$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $employer_maid_id)->first();
		if($insuranceform){ 
		 DB::table('maid_app_insurance_form')
            ->where('employer_maid_id','=', $employer_maid_id)->delete(); 
		}
		$data["employer_maid_id"]= $employer_maid_id;
          $insurance = Maid_app_insurance_form::create($data);
          $insuranceformid = $insurance->id;
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/insurance");
	}
		/**
   * Edit the tab16. Work Pass renewal
   * @return view
   */
	public function wp_renewal($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$workpermit = Maid_app_workpermit_renewal::where('employer_maid_id' , '=', $maid_application)->first();
	return view('sentinel.application.wp_renewal')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('workpermit', $workpermit);
	}
	
	 /**
   * Update the  Workpermit Renewal
   *
   * @param  int  $employer_maid_id
   * @return Response
   */
	public function wp_renewalupdate($employer_maid_id, Request $request) 
	{  
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		 $messages = array(
		);
		
		$validator = Validator::make($data, [
		'policy_number' => 'required',
		'expiry_date'=>'required',
		],$messages);
		 if ($validator->fails()) {
            return redirect("application/".$employer_maid_id."/wp_renewal")
                        ->withErrors($validator)
                        ->withInput();
        }
		//print_r($data); exit;
		$authorisationworkpass = Maid_app_workpermit_renewal::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($authorisationworkpass){
          $authorisationworkpass->update($data);
          $authorisationworkpassid = $authorisationworkpass->id;
        }else{
		 $data["employer_maid_id"]= $employer_maid_id;
          $authorisation = Maid_app_workpermit_renewal::create($data);
          $authorisationworkpassid = $authorisation->id;
        }
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/wp_renewal");
	}
	/**
   * Edit the tab18. Declaration for FDW
   * @return view
   */
public function fdwdeclaration($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$fdwdeclarationitem = DB::table('maid_app_fdw_declaration_form')->where('employer_maid_id' , '=', $maid_application)->get();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.fdwdeclaration')->with('maid_employer',$maid_employer)->with('user_data', $user_data)->with('fdwdeclarationitem', $fdwdeclarationitem);
	}
public function fdwdeclarationupdate($employer_maid_id, Request $request) 
	{ 
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email =  Auth::user()->email;
		if(isset($data['item_name'])!=""){
		$count =count($data['item_name']);
		 $fdwdeclaration = Maid_app_fdw_declaration_form::where('employer_maid_id' , '=', $employer_maid_id)->first();
       if($fdwdeclaration){ 
		 DB::table('maid_app_loan_manual_payment')
            ->where('employer_maid_id','=', $employer_maid_id)->delete(); 
		
		}
		for($i=0;$i<$count;$i++)
		{//echo $count ;exit;
		$datas['employer_maid_id']=$employer_maid_id;
		$datas['item_name']=$data['item_name'][$i];
		//print_r( $datas['dates']); 
		$datas['description']=$data['description'][$i];
		$datas['amount']=$data['amount'][$i];
		echo "<pre>";
		if($datas['item_name']!="")
		$declaration = Maid_app_fdw_declaration_form::create($datas);
		}
		}
		 \Session::flash('success', 'Maid application has been Updated.');
    
    return redirect("application/".$employer_maid_id."/fdwdeclaration");
	}
	public function fdwdeclarationitemdelete($maid_application,$id) {
    DB::table('maid_app_fdw_declaration_form')->where('employer_maid_id', '=', $maid_application)->where('id', '=', $id)->delete();

    \Session::flash('success', 'Declaration Item deleted successfully.');
    return redirect("application/".$maid_application."/fdwdeclaration");
  }
  /**
   * Edit the tab19. Declaration for Change of Employer
   * @return view
   */
 public function employerchangedeclaration($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.employerchangedeclaration')->with('maid_employer',$maid_employer)->with('user_data', $user_data);
	}
  public function employmentcontract($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.employmentcontract')->with('maid_employer',$maid_employer)->with('user_data', $user_data);
	}
public function passportrenewal($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.passportrenewal')->with('maid_employer',$maid_employer)->with('user_data', $user_data);
	}
public function fdwvacation($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.fdwvacation')->with('maid_employer',$maid_employer)->with('user_data', $user_data);
	}
public function  dischargedform($maid_application) 
	{  
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	//$maid_application =  Input::get('id');
	$maid_employer = maid_application::findOrFail($maid_application);
	$insuranceform = Maid_app_insurance_form::where('employer_maid_id' , '=', $maid_application)->first();
	$user_data = DB::table('users as u')
					->select('u.*')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	return view('sentinel.application.dischargedform')->with('maid_employer',$maid_employer)->with('user_data', $user_data);
	}
public function show_job_scope($id,$ispdf = false) {

	$user_data = DB::table('maid_application as maid_app')
					->select('maid_app.*','u.company_name','u.license_no','u.image as agency_logo')
					->leftJoin('users as u', 'u.id', '=', 'maid_app.user_agents_id')
					->where('maid_app.id','=',$id)
					->get();
	
	$maid_job_data = DB::table('maid_app_job_scope as maid_job')
					->select('maid_job.*')
					->where('maid_job.employer_maid_id','=',$id)
					->get();
					
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.app_pdf',array('user_data' => $user_data,'maid_job_data' => $maid_job_data));
        return $pdf->download('Jobscope_'.$maid_job_data[0]->employer_maid_id.'.pdf');
	}

  }
  
  public function show_servicefees($id,$ispdf = false) {
	 
	 $maid_employer = maid_application::findOrFail($id);
	if($maid_employer->type == 'A New FDW'){
      $maid_employer->form_type = 'New Transfer';
      $mode = 'newtransfer';
    }
    if($maid_employer->type == 'A Replacement'){
      $maid_employer->form_type = 'Replacement';
       $mode = 'replacement';
    }
    if($maid_employer->type == 'An Additional FDW'){
      $maid_employer->form_type = 'Replacement';
       $mode = 'replacement';
    }
	$user_id = Auth::user()->id;
		 $agencyservice = DB::table('agency_service as ags')
                      ->select("ags.*")
                      ->where('ags.mode', '=',$mode)
                      ->where('ags.agency_id','=',$user_id)
                      ->get();
		
		$servicefees = DB::table('agency_maid_service_schedule as amss')
						->select("amss.*")	
						->where('amss.employer_maid_id', '=', $id)
						->get();

		 $agencymaidservice = DB::table('agency_maid_service as ams')
                      ->select("ams.*","amss.id","ags.type","ags.title")
					  ->leftJoin('agency_maid_service_schedule as amss', 'amss.id', '=', 'ams.service_schedule_id')
					  ->leftJoin('agency_service as ags', 'ags.id', '=', 'ams.service_id')
                      ->where('ams.service_schedule_id', '=', $servicefees[0]->id)
					  ->get();


		$agencyotherservice = DB::table('agency_maid_other_service as amos')
						->select("amos.other_service_title","amos.other_service_price","amos.service_schedule_id","amos.id")	
						->leftJoin('agency_maid_service_schedule as amss', 'amss.id', '=', 'amos.service_schedule_id')
						->where('amos.service_schedule_id', '=', $servicefees[0]->id)->get();	

		$replacementcost = DB::table('service_schedule_replacement_cost as ssrc')
						->select("ssrc.replacement_month","ssrc.replacement_number","ssrc.cost","ssrc.service_schedule_id","ssrc.id")
						->leftJoin('agency_maid_service_schedule as amss', 'amss.id', '=', 'ssrc.service_schedule_id')
						->where('ssrc.service_schedule_id', '=', $servicefees[0]->id)
						->get();

		$maid_details = DB::table('maid_personal_details as mpd')
						->select("mpd.maid_reference_code","mpd.name","c.nationality","mpd.expected_salary","mpd.passport_number")
						->leftJoin('countries as c', 'c.id', '=', 'mpd.nationality')
						->leftJoin('maid_application as maid_app', 'maid_app.maid_id', '=', 'mpd.id')
						->where('maid_app.id', '=', $id)
						->get();
		
		$placement_fee_schedule = DB::table('service_schedule_placement_cost as sspc')
						->select("sspc.post_dated_cheque_number","sspc.post_dated_cheque_cost","sspc.id","sspc.service_schedule_id")
						->leftJoin('agency_maid_service_schedule as amss', 'amss.id', '=', 'sspc.service_schedule_id')
						->where('sspc.service_schedule_id', '=', $servicefees[0]->id)
						->get();
		
		$agency_detail = DB::table('agencies as agency')
										->select('agency.*')
										->leftjoin('users as u','u.agency_id', '=','agency.id')
										->where('u.id', '=', $servicefees[0]->agency_id)
										->get();	

		
		$replaced_maid_details = DB::table('maid_application as mpd')
						->select("mpd.*")
						->where('mpd.id', '=', $maid_employer->case_id)
						->get();

		
if($ispdf == 'yes')					
{$pdf = PDF::loadView('sentinel.application.servicefees_pdf',array('servicefees' => $servicefees,'agencymaidservice' => $agencymaidservice,'agencyotherservice'=>$agencyotherservice,'replacementcost'=>$replacementcost,'maid_details'=>$maid_details,'placement_fee_schedule'=>$placement_fee_schedule,'agency_detail'=>$agency_detail,'maid_employer' => $maid_employer,'agencyservice' =>$agencyservice,'replaced_maid_details'=>$replaced_maid_details,'user_id'=>$user_id));
		return $pdf->download('Servicefee_'. $maid_employer->id.'.pdf');
}
else{
	echo "<pre>";	
		return view('sentinel.application.servicefees_pdf');
		}
  }
 public function show_restday_agreement($id,$ispdf = false) {
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	 $maid_employer = maid_application::findOrFail($id);
	$maid_rest_day = DB::table('maid_app_rest_day as mrd')
						->select("mrd.*")
						->where('mrd.employer_maid_id', '=', $maid_employer->id)
						->get();

	if(Auth::user()->hasRole(['admin'])){
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$user_id)
					->get(); 
	 }else{
	$agency = DB::table('users as u')
					->select('u.agency_id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$agency[0]->agency_id)
					->get(); 
	}

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.restday_agreement',array('maid_rest_day' => $maid_rest_day,'maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('Restday_'.$maid_rest_day[0]->employer_maid_id.'.pdf');
	}
	}
 public function show_security_bond($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	$maid_rest_day = DB::table('maid_app_security_bond as msb')
						->select("msb.*")
						->where('msb.employer_maid_id', '=', $maid_employer->id)
						->get();

	$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_security_bond',array('maid_rest_day' => $maid_rest_day,'maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('SecurityBond_'.$maid_rest_day[0]->employer_maid_id.'.pdf');
	}
  }
  public function show_authorisationworkpass($id,$ispdf = false) {

	 $maid_employer = maid_application::findOrFail($id);
	$maid_authorisation = DB::table('maid_app_authorisation_workpass as mw')
						->select("mw.*")
						->where('mw.employer_maid_id', '=', $maid_employer->id)
						->get();
$agency_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
$user_data = DB::table('users as u')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();


	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_authorisationworkpass',array('maid_authorisation' => $maid_authorisation,'maid_employer' => $maid_employer,'user_data'=>$user_data,'agency_data'=>$agency_data));
        return $pdf->download('AuthorisationWorkPass'.$maid_authorisation[0]->employer_maid_id.'.pdf');
	}

  }
  public function show_giro_form($id,$ispdf = false) {

	 $maid_employer = maid_application::findOrFail($id);
	$maid_giro_form = DB::table('maid_app_giro_form as mw')
						->select("mw.*")
						->where('mw.employer_maid_id', '=', $maid_employer->id)
						->get();

$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_giro_form',array('maid_giro_form' => $maid_giro_form,'maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('GIRO'.$maid_giro_form[0]->employer_maid_id.'.pdf');
	}

  }
  public function show_Insurancedata($id,$ispdf = false) {
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	 $maid_employer = maid_application::findOrFail($id);
	 if(Auth::user()->hasRole(['admin'])){
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$user_id)
					->get(); 
	
	 }else{
	$agency = DB::table('users as u')
					->select('u.agency_id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$agency[0]->agency_id)
					->get(); 
	}
	$insurance_data = DB::table('maid_app_insurance_form')
					->select('maid_app_insurance_form.*')
					->where('maid_app_insurance_form.employer_maid_id','=',$maid_employer->id)
					->get();
	$nationality = DB::table('maid_personal_details as md')
					->select('c.name as country_name','c.nationality as nationality_name')
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->where('md.id','=',$maid_employer->maid_id)
					->get();
	
	if($insurance_data[0]->insurance_company_name == 'Liberty Insurance Pte Ltd')
	{
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_LibertyInsurance',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Allied World Assurance Company Ltd')
	{
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_Alliedworld',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Tenet Sompo Insurance Pte Ltd')
	{ 
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_MAIDEASE',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'InsureAsia Agency Pte Ltd')
	{
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_InsureAsia',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'AXA Insurance Singapore Pte Ltd')
	{
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_SmartHelper',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Tokio Marine Insurance Singapore Ltd')
	{
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_TokioMarine',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Wah Hong Ensure Pte Ltd')
	{
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_eTiQaInsurance',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Vintage Insurance Agency')
	{
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_GreatEastern',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Ecics Limited')
	{
		if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_Ecics',array('insurance_data' => $insurance_data,'maid_employer' => $maid_employer,'user_data'=>$user_data,'nationality'=>$nationality));
        return $pdf->download($insurance_data[0]->employer_maid_id.'_'.$user_data[0]->insurance_company.'.pdf');
	}
	} 
}
  public function show_incometaxdeclaration($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	$maid_tax_declaration = DB::table('maid_app_employer_tax_declaration as mtd')
						->select("mtd.*")
						->where('mtd.employer_maid_id', '=', $maid_employer->id)
						->get();
$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_incometaxdeclaration',array('maid_tax_declaration' => $maid_tax_declaration,'maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('Incometaxdeclaration_'.$maid_tax_declaration[0]->employer_maid_id.'.pdf');
	}
  }
   public function show_workpermit($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	$maid_work_permit = DB::table('maid_app_fdw_work_permit as mwp')
						->select("mwp.*")
						->where('mwp.employer_maid_id', '=', $maid_employer->id)
						->get();

	$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
				

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_workpermit',array('maid_work_permit' => $maid_work_permit,'maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('Workpermit_'.$maid_work_permit[0]->employer_maid_id.'.pdf');
	}
  }
     public function show_safetyagreement($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	$maid_safety_agreement = DB::table('maid_app_safety_agreement as msa')
						->select("msa.*")
						->where('msa.employer_maid_id', '=', $maid_employer->id)
						->get();
					$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();	

		/*$user_data = DB::table('users as u')
					->select('agency.*')
					->leftjoin('agencies as agency', 'agency.id', '=', 'u.agency_id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();*/
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_safetyagreement',array('maid_safety_agreement' => $maid_safety_agreement,'maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('Safetyagreement'.$maid_safety_agreement[0]->employer_maid_id.'.pdf');
	}
  }
   public function show_handlingtakeover($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	$maid_handling_takeover = DB::table('maid_app_handling_takeover as mht')
						->select('mht.*')
						->where('mht.employer_maid_id', '=', $maid_employer->id)
						->get();
	/*$user_data = DB::table('users as u')
					->select('u.company_name','u.license_no','u.image as agency_logo')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();*/
					$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	if($ispdf == 'yes')
	{
		$pdf = PDF::loadView('sentinel.application.handling_takeover',array('maid_handling_takeover' => $maid_handling_takeover,'maid_employer' => $maid_employer,'user_data' => $user_data));
        return $pdf->download('Handlingtakeover_'.$maid_employer->employer_maid_id.'.pdf');
	}

  }
     public function show_LibertyInsurancedata($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	
$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$insurance_data=DB::table('maid _app_insurance_form')
						->select('maid _app_insurance_form.*')
						->where('maid _app_insurance_form.employer_maid_id','=',$maid_employer->id)
						->get();

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_LibertyInsurance',array('maid_employer' => $maid_employer,'user_data'=>$user_data,'insurance_data'=>$insurance_data));
        return $pdf->download($insurance_data[0]->insurance_company_name.$insurance_data[0]->employer_maid_id.'.pdf');
	}	
  }
 
   public function loan_payment($id,$ispdf = false) {  //echo "hello"; exit;
		 $maid_employer = maid_application::findOrFail($id);
	
	$restday = DB::table('maid_app_rest_day as mrd')
						->select("mrd.*")
						->where('mrd.employer_maid_id', '=', $maid_employer->id)
						->get();
		//print_r($maid_employer);
		$salarypayment=DB::table('maid_app_payment_and_loan as mpl')
						->select("mpl.*")
						->where('mpl.employer_maid_id', '=', $maid_employer->id)
						->get();
		$user_data =DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
		$servicefees = DB::table('agency_maid_service_schedule as amss')
						->select("amss.*")	
						->where('amss.employer_maid_id', '=',$maid_employer->id)
						->get();
	 $loanpayment = Loanmanualpayment::where('employer_maid_id' , '=', $maid_employer->id)->get();
		//print_r($maid_rest_day);exit;
	if($ispdf == 'yes')
	{	
		$pdf = PDF::loadView('sentinel.application.loan_payment',array('restday' => $restday,'maid_employer' => $maid_employer,'user_data'=>$user_data,'servicefees'=>$servicefees,'loanpayment' => $loanpayment,"salarypayment"=> $salarypayment));//print_r( $pdf);
       return $pdf->download('LoanPayment_'.$restday[0]->employer_maid_id.'.pdf'); 
	}

  }
 
      public function show_wp_renewal($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	
$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$workpermit = Maid_app_workpermit_renewal::where('employer_maid_id' , '=', $maid_employer->id)->first();

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_wp_renewal',array('maid_employer' => $maid_employer,'user_data'=>$user_data,'workpermit'=>$workpermit));
        return $pdf->download('WorkpermitRenewal_'.$maid_employer->id.'.pdf');
	}	
  }
  
  
     public function show_fdw_declaration($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
		$fdwdeclarationitem = DB::table('maid_app_fdw_declaration_form as mafd')
					->select('mafd.*')
					->where('mafd.employer_maid_id','=',$maid_employer->id)
					->get();
		$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_fdw_declaration',array('maid_employer' => $maid_employer,'user_data'=>$user_data,'fdwdeclarationitem'=>$fdwdeclarationitem));
        return $pdf->download('fdw_declaration'.$fdwdeclarationitem[0]->employer_maid_id.'.pdf');
	}	
  }
    public function show_employer_change($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	
		$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_employer_change',array('maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('DeclarationForChangeEmployer'.$maid_employer->id.'.pdf');
	}	
  }
public function show_employment_contract($id,$ispdf = false) {
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	 $maid_employer = maid_application::findOrFail($id);
	 if(Auth::user()->hasRole(['admin'])){
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$user_id)
					->get(); 
	
	 }else{
	$agency = DB::table('users as u')
					->select('u.agency_id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$agency[0]->agency_id)
					->get(); 
	}
	$insurance_data = DB::table('maid_app_insurance_form')
					->select('maid_app_insurance_form.*')
					->where('maid_app_insurance_form.employer_maid_id','=',$maid_employer->id)
					->get();
	$nationality = DB::table('maid_personal_details as md')
					->select('c.name as country_name','c.nationality as nationality_name')
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->where('md.id','=',$maid_employer->maid_id)
					->get();
//print_r($insurance_data );exit;
	$srcDoc  = new \DOMDocument;
	$contract=new \DOMDocument;
	 $standardform = view('sentinel.application.show_employment_contract')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	 $undertakingform = view('sentinel.application.undertaking_of_employer')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	@$srcDoc->loadHtml($standardform);
	@$contract->loadHtml( $undertakingform ); 
//print_r($contract);exit;
foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
} $html = $srcDoc->saveHTML();
	if($insurance_data){
	if($insurance_data[0]->insurance_company_name == 'Liberty Insurance Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_LibertyInsurance')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Allied World Assurance Company Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_Alliedworld')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Tenet Sompo Insurance Pte Ltd')
	{ 
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_MAIDEASE')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'InsureAsia Agency Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_InsureAsia')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'AXA Insurance Singapore Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_SmartHelper')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Tokio Marine Insurance Singapore Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_TokioMarine')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Wah Hong Ensure Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_eTiQaInsurance')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Vintage Insurance Agency')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_GreatEastern')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Ecics Limited')
	{
		if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_Ecics')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}


@$contract->loadHtml($doc1); 
//print_r($contract);exit;
foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
$html = $srcDoc->saveHTML();
}
	//print_r($srcNode); exit;	
	if($ispdf == 'yes'){
		$pdf= PDF::loadHtml($html);
		//$pdf = PDF::loadView('sentinel.application.show_employment_contract',array('maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('StandardEmploymentContract'.$maid_employer->id.'.pdf');
	}
  }
 public function show_pprenewal($id,$ispdf = false) {
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	 $maid_employer = maid_application::findOrFail($id);
	 if(Auth::user()->hasRole(['admin'])){
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$user_id)
					->get(); 
	
	 }else{
	$agency = DB::table('users as u')
					->select('u.agency_id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$agency[0]->agency_id)
					->get(); 
	}
	$insurance_data = DB::table('maid_app_insurance_form')
					->select('maid_app_insurance_form.*')
					->where('maid_app_insurance_form.employer_maid_id','=',$maid_employer->id)
					->get();
	$nationality = DB::table('maid_personal_details as md')
					->select('c.name as country_name','c.nationality as nationality_name')
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->where('md.id','=',$maid_employer->maid_id)
					->get();
//print_r($insurance_data );exit;
	$srcDoc  = new \DOMDocument;
	$contract=new \DOMDocument;
	 $standardform = view('sentinel.application.show_employment_contract')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	 
	  $passportform = view('sentinel.application.passport_application')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	 $welfareform = view('sentinel.application.workerwelfare')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	$manpower_profile = view('sentinel.application.manpower_profile_form')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	@$srcDoc->loadHtml(  $standardform );
// adding E-passwort application 	
@$contract->loadHtml($passportform); 

foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
// adding FDW welfare administration form
@$contract->loadHtml($welfareform); 

foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
// adding technical education and skill development manpower profile form
@$contract->loadHtml($manpower_profile); 

foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
$html = $srcDoc->saveHTML();

	//print_r($srcNode); exit;	
	if($ispdf == 'yes'){
		$pdf= PDF::loadHtml($html);
		//$pdf = PDF::loadView('sentinel.application.show_employment_contract',array('maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('PassportRenewal'.$maid_employer->id.'.pdf');
	}
  }
 public function show_fdw_vacation($id,$ispdf = false) {
	$user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
	 $maid_employer = maid_application::findOrFail($id);
	 if(Auth::user()->hasRole(['admin'])){
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$user_id)
					->get(); 
	
	 }else{
	$agency = DB::table('users as u')
					->select('u.agency_id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
	$user_data = DB::table('agencies as a')
					->select('a.*')
					->where('a.id','=',$agency[0]->agency_id)
					->get(); 
	}
	$insurance_data = DB::table('maid_app_insurance_form')
					->select('maid_app_insurance_form.*')
					->where('maid_app_insurance_form.employer_maid_id','=',$maid_employer->id)
					->get();
	$nationality = DB::table('maid_personal_details as md')
					->select('c.name as country_name','c.nationality as nationality_name')
					->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
					->where('md.id','=',$maid_employer->maid_id)
					->get();
//print_r($insurance_data );exit;
	$srcDoc  = new \DOMDocument;
	$contract=new \DOMDocument;
	 $standardform = view('sentinel.application.show_employment_contract')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	 
	  $employment_administration = view('sentinel.application.employment_administration')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	 $welfareform = view('sentinel.application.workerwelfare')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	$manpower_profile = view('sentinel.application.manpower_profile_form')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	$undertaking_of_employer = view('sentinel.application.undertaking_of_employer')->with('maid_employer',$maid_employer)->with('user_data',$user_data);
	@$srcDoc->loadHtml(  $standardform );
// adding Overseas employment administration form
@$contract->loadHtml($employment_administration); 

foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
// adding FDW welfare administration form
@$contract->loadHtml($welfareform); 

foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
// adding technical education and skill development manpower profile form
@$contract->loadHtml($manpower_profile); 

foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}

// adding technical education and skill development manpower profile form
@$contract->loadHtml($undertaking_of_employer); 

foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
$html = $srcDoc->saveHTML();

	if($insurance_data){
	if($insurance_data[0]->insurance_company_name == 'Liberty Insurance Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_LibertyInsurance')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Allied World Assurance Company Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_Alliedworld')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Tenet Sompo Insurance Pte Ltd')
	{ 
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_MAIDEASE')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'InsureAsia Agency Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_InsureAsia')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'AXA Insurance Singapore Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_SmartHelper')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Tokio Marine Insurance Singapore Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_TokioMarine')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Wah Hong Ensure Pte Ltd')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_eTiQaInsurance')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Vintage Insurance Agency')
	{
	if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_GreatEastern')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}
	else if($insurance_data[0]->insurance_company_name == 'Ecics Limited')
	{
		if($ispdf == 'yes'){
		$doc1 = view('sentinel.application.show_Ecics')->with('insurance_data', $insurance_data)->with('maid_employer',$maid_employer)->with('user_data',$user_data)->with('nationality',$nationality);
	}
	}


@$contract->loadHtml($doc1); 
//print_r($contract);exit;
foreach ($contract->documentElement->childNodes as $child) {
    $import = $srcDoc->importNode($child, true);
    if ($import) {
       $srcDoc->documentElement->appendChild($import);
    }
}
$html = $srcDoc->saveHTML();
}
	//print_r($srcNode); exit;	
	if($ispdf == 'yes'){
		$pdf= PDF::loadHtml($html);
		//$pdf = PDF::loadView('sentinel.application.show_employment_contract',array('maid_employer' => $maid_employer,'user_data'=>$user_data));
        return $pdf->download('FdwVacation'.$maid_employer->id.'.pdf');
	}
  }
  public function show_discharge_form($id,$ispdf = false) {
	 $maid_employer = maid_application::findOrFail($id);
	
		$user_data = DB::table('agencies as agency')
					->select('agency.*')
					->leftjoin('users as u','u.agency_id', '=','agency.id')
					->where('u.id','=',$maid_employer->user_agents_id)
					->get();
		$salarypayment=DB::table('maid_app_payment_and_loan as mpl')
						->select("mpl.*")
						->where('mpl.employer_maid_id', '=', $maid_employer->id)
						->get();

	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.application.show_discharge_form',array('maid_employer' => $maid_employer,'user_data'=>$user_data,'salarypayment'=>$salarypayment));
        return $pdf->download('DischargedForm'.$maid_employer->id.'.pdf');
	}	
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
   public function delete($id) {
    $maid_service_id = DB::table('agency_maid_service_schedule as amss')
                      ->select("amss.id as id") 
                      ->where('amss.employer_maid_id', '=', $id)->get();
    if($maid_service_id){                  
      DB::table('agency_maid_service')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();
      DB::table('agency_maid_other_service')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();    
      DB::table('service_schedule_replacement_cost')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();       
      DB::table('service_schedule_placement_cost')->where('service_schedule_id', '=', $maid_service_id[0]->id)->delete();    
    }
		DB::table('agency_maid_service_schedule')
				->where('employer_maid_id','=', $id)->delete(); 
		DB::table('maid_app_job_scope')
				->where('employer_maid_id','=',  $id)->delete(); 
		 DB::table('maid_app_rest_day')
				->where('employer_maid_id','=',  $id)->delete();
		DB::table('maid_app_handling_takeover')
				->where('employer_maid_id','=',  $id)->delete(); 	
		DB::table('maid_app_payment_and_loan')
				->where('employer_maid_id','=',  $id)->delete(); 
		 DB::table('maid_app_loan_manual_payment')
				->where('employer_maid_id','=',  $id)->delete(); 
		DB::table('maid_app_safety_agreement')
				->where('employer_maid_id','=',  $id)->delete();
		DB::table('maid_app_fdw_work_permit')
				->where('employer_maid_id','=',  $id)->delete();
		DB::table('maid_app_employer_tax_declaration')
				->where('employer_maid_id','=',  $id)->delete();	
		DB::table('maid_app_authorisation_workpass')
				->where('employer_maid_id','=',  $id)->delete();							
		DB::table('maid_app_security_bond')
				->where('employer_maid_id','=',  $id)->delete(); 
		DB::table('agency_agreement_data')
				->where('application_id','=',  $id)->delete();		
		DB::table('maid_application')
				->where('id','=',  $id)->delete();
	
    \Session::flash('success', 'Application has been deleted.');
    return redirect('application');
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id) {

  }

  public function serviceemployeragency(){
    
  }
  public function applicationinfo() { 
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    $maid_application_id   = Input::get('maid_application_id');
	 $employer_id = Input::get('employer_id');
      $maidinfo =  DB::table('maid_application as ma')
            ->leftJoin('maid_personal_details as mpd', 'mpd.id', '=', 'ma.maid_id')
            ->select("mpd.name","mpd.id",'mpd.maid_reference_code','mpd.date_of_birth','mpd.contact_number','mpd.marital_status','mpd.address','mpd.passport_number')
            ->where('ma.id', '=', $maid_application_id)
	    ->where("ma.employer_id",'=',$employer_id)
	   ->where("ma.status",'=','free')
            ->where('mpd.users_agents_id','=',$user_id)
            ->where('mpd.deleted', '=', 'N')->get();
    
            //print_r($maidinfo); exit;
    return $maidinfo;
  }
  /*********
  Function : empinvoice
  It is used to show the employer invoice data
  *********/
    public function empinvoice($employer_maid_id,$ispdf = false) { 
      $user_id = Auth::user()->id;
      $user_email =  Auth::user()->email;
      $autogeninvoicenum = DB::table('maid_app_service_emp_invoice as mpsei')
                      ->select("mpsei.invoice_number as invoice_number")
                      ->orderBy('mpsei.id','DSC')
                      ->get();
      $invoice = Employer_invoice::where('employer_maid_id' , '=', $employer_maid_id)->first();
      if($invoice){
        $recordpayment = DB::table('emp_invoice_record_payment as eirp')
                        ->select(DB::Raw("sum(eirp.amount_received) as amount_received"))
                        ->where('eirp.invoice_id','=',$invoice->id)
                        ->get();
      }else{
        $recordpayment = array();
      }
      $maid_employer = maid_application::findOrFail($employer_maid_id);
       $servicefees = Agencymaidserviceschedule::where('employer_maid_id' , '=', $employer_maid_id)->first();
          if($maid_employer->type == 'A New FDW'){
            $maid_employer->form_type = 'New Transfer';
            $mode = 'newtransfer';
          }
          if($maid_employer->type == 'A Replacement'){
            $maid_employer->form_type = 'Replacement';
             $mode = 'replacement';
          }
          if($maid_employer->type == 'An Additional FDW'){
            $maid_employer->form_type = 'Replacement';
             $mode = 'replacement';
          }
        $agencyservice = DB::table('agency_service as ags') ->select("ags.*")
          ->where('ags.mode', '=',$mode)
          ->whereRaw("ags.agency_id in ($user_id)")
          ->get(); 
          if($servicefees){
                      $agencymaidservice = DB::table('agency_maid_service as ams')
                              ->select("ams.service_id","ams.service_cost") 
                              ->where('ams.service_schedule_id', '=', $servicefees->id)->get();

          }
  if($ispdf == 'yes'){
    $pdf = PDF::loadView('sentinel.application.empinvoicepdf',array('recordpayment' => $recordpayment,'autogeninvoicenum'=>$autogeninvoicenum,'invoice'=>$invoice,'maid_employer'=>$maid_employer,'servicefees'=>$servicefees,'agencymaidservice'=>$agencymaidservice,'agencyservice'=>$agencyservice));
        return $pdf->download($invoice->invoice_number.'.pdf');
  }else{
  //echo "<pre>"; print_r($maid_employment_history); exit;
    return view('sentinel.application.empinvoice')->with('recordpayment',$recordpayment)->with('autogeninvoicenum',$autogeninvoicenum)->with('invoice',$invoice)->with('maid_employer',$maid_employer)->with('servicefees',$servicefees)->with('agencymaidservice',$agencymaidservice)->with('agencyservice',$agencyservice);
    }      
    
  }
    /*********
  Function : empinvoiceupdate
  It is used to update the employer invoice data
  *********/

  public function empinvoiceupdate($employer_maid_id, Request $request) 
  { 
    $data = $request->all();
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    $messages = array(
          'alpha_spaces' => 'Please enter aplphabatic values.',
          'float_integer' => 'Please enter valid income.',
          'maid_id.required' => 'Please enter valid reference code.',
      );
    $validator = Validator::make($request->all(), [
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            ],$messages);
    if ($validator->fails()) {
          return redirect("application/".$employer_maid_id."/empinvoice")
                      ->withErrors($validator)
                      ->withInput();
    }
     $empinvoice = Employer_invoice::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($empinvoice){
          $empinvoice->update($data);
          $empinvoiceid = $empinvoice->id;
        }else{
          $data["employer_maid_id"]= $employer_maid_id;
          $invoice = Employer_invoice::create($data);
          $empinvoiceid = $invoice->id;
        }
    \Session::flash('success', 'Employer invoice has been Updated.');
    return redirect("application/".$employer_maid_id."/empinvoice"); 
      
  }
  /*********
  Function : recordpaymentadd
  It is used to add the record payment for employer invoice
  *********/
  public function recordpaymentadd($invoice_id, Request $request) 
  { 
    $data = $request->all();
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
        Validator::extend('float_integer', function($attribute, $value)
      {
          return preg_match('/^(\d+(.\d+)?$)/', $value);
      });
    $messages = array(
          'alpha_spaces' => 'Please enter aplphabatic values.',
          'amount_received.float_integer' => 'Please enter valid amount.',
      );
    $validator = Validator::make($request->all(), [
            'amount_received' => 'required|float_integer',
            'payment_date' => 'required',
            ],$messages);
    if ($validator->fails()) {
          return redirect("application/".$data["employer_maid_id"]."/empinvoice?record=yes")
                      ->withErrors($validator)
                      ->withInput();
    }
    $data["invoice_id"]= $invoice_id;
    $record_payment = Employer_record_payment::create($data);
    $empinvoiceid = $record_payment->id;

    \Session::flash('success', 'Record payment is saved.');
    return redirect("application/".$data["employer_maid_id"]."/empinvoice"); 
      
  }

  /*********
  Function : fdwinvoice
  It is used to show the FDW invoice data
  *********/
    public function fdwinvoice($employer_maid_id,$ispdf = false) { 
      $user_id = Auth::user()->id;
      $user_email =  Auth::user()->email;
      $autogeninvoicenum = DB::table('maid_app_service_fdw_invoice as mpsfi')
                      ->select("mpsfi.invoice_number as invoice_number")
                      ->orderBy('mpsfi.id','DSC')
                      ->get();
      $invoice = Fdw_invoice::where('employer_maid_id' , '=', $employer_maid_id)->first();
      $maid_employer = maid_application::findOrFail($employer_maid_id);
      $loan_amount = DB::table('maid_app_loan_manual_payment as malmp') 
                        ->select(DB::Raw("sum(malmp.loan_amount) as loan_amount"))
                        ->where('malmp.employer_maid_id', '=',$employer_maid_id)
                        ->get(); 
       $servicefees = Agencymaidserviceschedule::where('employer_maid_id' , '=', $employer_maid_id)->first();
          if($maid_employer->type == 'A New FDW'){
            $maid_employer->form_type = 'New Transfer';
            $mode = 'newtransfer';
          }
          if($maid_employer->type == 'A Replacement'){
            $maid_employer->form_type = 'Replacement';
             $mode = 'replacement';
          }
          if($maid_employer->type == 'An Additional FDW'){
            $maid_employer->form_type = 'Replacement';
             $mode = 'replacement';
          }
        $agencyservice = DB::table('agency_service as ags') ->select("ags.*")
          ->where('ags.mode', '=',$mode)
          ->whereRaw("ags.agency_id in ($user_id)")
          ->get(); 
          if($servicefees){
                       $agencymaidservice = DB::table('agency_maid_service as ams')
                              ->select("ams.service_id","ams.service_cost") 
                              ->where('ams.service_schedule_id', '=', $servicefees->id)->get();
          }
    if($ispdf == 'yes'){
    $pdf = PDF::loadView('sentinel.application.fdwinvoicepdf',array('autogeninvoicenum' => $autogeninvoicenum,'loan_amount'=>$loan_amount,'invoice'=>$invoice,'maid_employer'=>$maid_employer,'servicefees'=>$servicefees,'agencymaidservice'=>$agencymaidservice,'agencyservice'=>$agencyservice));
        return $pdf->download($invoice->invoice_number.'.pdf');
    }else{      
      return view('sentinel.application.fdwinvoice')->with('autogeninvoicenum',$autogeninvoicenum)->with('loan_amount',$loan_amount)->with('invoice',$invoice)->with('maid_employer',$maid_employer)->with('servicefees',$servicefees)->with('agencyservice',$agencyservice)->with('agencymaidservice',$agencymaidservice);
    }
  }
    /*********
  Function : fdwinvoiceupdate
  It is used to update the Fdw invoice data
  *********/

  public function fdwinvoiceupdate($employer_maid_id, Request $request) 
  { 
    $data = $request->all();
    $user_id = Auth::user()->id;
    $user_email =  Auth::user()->email;
    $messages = array(
          'alpha_spaces' => 'Please enter aplphabatic values.',
          'float_integer' => 'Please enter valid income.',
          'maid_id.required' => 'Please enter valid reference code.',
      );
    $validator = Validator::make($request->all(), [
            'invoice_number' => 'required'
            ],$messages);
    if ($validator->fails()) {
          return redirect("application/".$employer_maid_id."/fdwinvoice")
                      ->withErrors($validator)
                      ->withInput();
    }
     $fdwinvoice = Fdw_invoice::where('employer_maid_id' , '=', $employer_maid_id)->first();
        if($fdwinvoice){
          $fdwinvoice->update($data);
          $fdwinvoiceid = $fdwinvoice->id;
        }else{
          $data["employer_maid_id"]= $employer_maid_id;
          $fdwinvoice = Fdw_invoice::create($data);
          $fdwinvoiceid = $fdwinvoice->id;
        }
    \Session::flash('success', 'Fdw invoice has been Updated.');
    return redirect("application/".$employer_maid_id."/fdwinvoice"); 
      
  }
public function autocompleteemployer()
{
$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		$word   = Input::get('word');
		 $employer = DB::table('employer_personal_details')
		->select('employer_personal_details.employer_name','employer_personal_details.id')
		->whereRaw("users_agents_id in ($user_id)")
		->where('deleted','=','N')
		->orderBy('updated_at', 'asc')
		->whereRaw("(employer_personal_details.employer_name like '%$word%' )")->get();
		//->lists('employer_name','id');  
		$data['result']=$employer;
		$json=json_encode($employer);
		return $data;
}

 public function autocompletemaid()
{
$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;
		$word   = Input::get('word');
		$fdw = DB::table('maid_personal_details as mdp')
		->leftJoin('maid_application as mp',function ($join){  
			 $join->on('mdp.id', '=', 'mp.maid_id');  
			$join->on('mp.replaced_at','=',DB::raw("'0000-00-00'")); 
		})
		->where('mp.maid_id' ,'=',NULL)
		->whereRaw("users_agents_id in ($user_id)")
		->where('mdp.deleted','=','N')
		->orderBy('mdp.updated_at', 'asc')
		->whereRaw("(mdp.name like '%$word%' )")
		->select('mdp.*')->get();
		$data['result']=$fdw ;
		$json=json_encode($fdw );
		return $data;
} 
  
}
