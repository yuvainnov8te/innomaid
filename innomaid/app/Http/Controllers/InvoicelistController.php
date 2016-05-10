<?php
 /***********************************************
	 Developed by :- Rahul Gahlot
	 Module       :- Invoice List
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Invoicelist as Invoicelist;
use App\User as user;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use Illuminate\Support\Facades\Validator;
use Response;
use PDF;

class InvoicelistController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
/*SELECT md.name,inv.invoice_number from maid_personal_details md left join maid_app_service_fdw_invoice inv on inv.employer_maid_id=md.id*/
	 public function show($type) {
	 	$user_id = Auth::user()->id;
	 	$user=DB::table('users as u')->where('u.id','=',$user_id)->get();
	 	$agency_id = '';
	 	$agency_id = $user[0]->agency_id;
	 	if($type=='employer')
	 	{

	 		$invoice_list = DB::table('maid_application as ma')
					->select("ma.id as id","ed.employer_name as name", "inv.invoice_number as invoicenumber",'inv.id as invoice_id')
						->leftJoin('maid_app_service_emp_invoice as inv', 'ma.id', '=', 'inv.employer_maid_id')
						->leftJoin('employer_personal_details as ed', 'ed.id', '=', 'ma.employer_id')
						->where ('ma.user_agents_id','=',$user_id)	
						->groupby('inv.id')
					->get();
				
				
	 	}
	 	else
	 	{
	 		$invoice_list = DB::table('maid_application as ma')
					->select("ma.id as id","md.name as name", "inv.invoice_number as invoicenumber",'inv.id as invoice_id')
						->leftJoin('maid_app_service_emp_invoice as inv', 'ma.id', '=', 'inv.employer_maid_id')
						->leftJoin('maid_personal_details as md', 'md.id', '=', 'ma.maid_id')
						->where ('ma.user_agents_id','=',$user_id)	
						->groupby('inv.id')
					->get();
				
				

	 	}
	return view('sentinel.Invoicelist.index')->with('Invoicelist',$invoice_list); 	
	}


/* Show the Details of invoice payment 
  @param  int $id 
  Added by Poonam Chandak
*/ 
 public function paymentdetail()
	{ 
	$id=Input::get('id');
	$paymentList = DB::table('emp_invoice_record_payment as ip')
					->leftJoin("maid_app_service_emp_invoice as ei" , "ei.id",'=','ip.invoice_id')
					->select("ip.*","ei.invoice_number")
					->where("invoice_id",'=',$id)
		       	->orderBy("ip.updated_at", "DESC")
		       	->paginate(10);
	return view('sentinel.Invoicelist.payment_detail')->with('paymentList',$paymentList);
	}

public function show_paymentrecord($id,$ispdf = false)
{		$user_id = Auth::user()->id;
      $user_email =  Auth::user()->email;
			$payment = DB::table('emp_invoice_record_payment as ip')
					->leftJoin("maid_app_service_emp_invoice as ei" , "ei.id",'=','ip.invoice_id')
					->select("ip.*","ei.invoice_number","ei.employer_maid_id")
					->where("ip.id",'=',$id)
		       	 		->first();
	 $maid_employer =  DB::table('maid_application')->where('id' , '=', $payment->employer_maid_id)->first();
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
	$servicefees = DB::table('agency_maid_service_schedule as ams')->where('employer_maid_id' , '=', $payment->employer_maid_id)->first();
	 $recordpayment = DB::table('emp_invoice_record_payment as eirp')
                        ->select(DB::Raw("sum(eirp.amount_received) as amount_received"))
                        ->where('eirp.invoice_id','=',$payment->invoice_id)
			->where('eirp.payment_date','<=',$payment->payment_date)
                        ->get();
	 
          if($servicefees){
                      $agencymaidservice = DB::table('agency_maid_service as ams')
                              ->select("ams.service_id","ams.service_cost") 
                              ->where('ams.service_schedule_id', '=', $servicefees->id)->get();

          }
	if($ispdf == 'yes'){
		$pdf = PDF::loadView('sentinel.Invoicelist.paymentrecordpdf',array('payment' =>$payment,'recordpayment' =>$recordpayment,'servicefees' =>$servicefees,'agencymaidservice' =>$agencymaidservice,'agencyservice' =>$agencyservice,'maid_employer' =>$maid_employer));
        return $pdf->download($payment->invoice_number.'payment'.$payment->payment_date.'.pdf');
	}	
}
	
}
