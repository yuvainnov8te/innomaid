<?php
 /***********************************************
	 Developed by :- Poonam Chandak
	 Module       :- Agreement Form
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\StandardAgreement as Template;
use App\AgencyAgreementForms as Agency_agreement_form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;

class AgreementformController extends Controller {

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
			$agreementformList=DB::table('agency_agreement_forms as A')
				->select("A.*")
				->where('agency_id' , '=', $user_id)
               	->orderBy("A.updated_at", "DESC")
               	->paginate(10);
			
			$standardformList= DB::table('standard_agreement_forms as sa')
            ->leftJoin('agency_agreement_forms as A' , function($join) use($user_id) {
					$join->on('A.form_id', '=', 'sa.id');
					$join->on('A.agency_id', '=',DB::raw("'".$user_id."'"));
				})
				->where('A.form_id','=',NULL)
				->where('sa.visible','=','1')
				->select("sa.*")
               	->orderBy("sa.updated_at", "DESC")
				->distinct('sa.id')
               	->paginate(10);
				
		//echo "<pre>";	print_r($standardformList); exit;
		return view('sentinel.agreementforms.index')->with('agreementformList', $agreementformList)->with('standardformList', $standardformList);//echo "hello"; exit;
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
		return view('sentinel.agreementform.create');
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
           		'title' => 'required|min:3|max:100',
				'content' => 'required',
        	],$messages);

        if ($validator->fails()) {
            return redirect("template/create")
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
        $agreementform = Agency_agreement_form::create($data);
		$insertedId = $agreementform->id;

		\Session::flash('success', 'templete is saved.');
		//print_r($data); exit;
		return redirect("agreementform/");
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
		$agreementform = Agency_agreement_form::where('form_id' , '=', $id)->where('agency_id' , '=', $user_id)->first(); 
		if($agreementform)
		{//echo "hello" ; exit;
		return view('sentinel.agreementforms.edit')->with('agreementform',$agreementform);
		}
		else{
		
		$agreementform = Template::findOrFail($id);//print_r($agreementform); exit;
		return view('sentinel.agreementforms.edit')->with('agreementform',$agreementform);
		}
		
	}

	/**
	 * Update the tab0.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
	//print_r($id); exit;
		$data = $request->all();
		$user_id = Auth::user()->id;
		$user_email	=  Auth::user()->email;

		if(!(Input::get('is_published')))
		{
			$data['is_published']='';
		}
		// validation rules
		Validator::extend('alpha_spaces', function($attribute, $value)
			{
			    return preg_match('/^[\pL\s]+$/u', $value);
			});
		$messages = array(
    		'alpha_spaces' => 'Please enter aplphabatic values.',
		);
		$validator = Validator::make($request->all(), [
           		'title' => 'required|min:3|max:100',
				'content' => 'required',
        	],$messages);
//echo $id; exit;
        
        // validation rule complete
        
	//print_r($id); exit;
		$agreement = Agency_agreement_form::where('agency_id' , '=', $user_id)->get(); 

	  if($agreement){
			$agreementrecord = Agency_agreement_form::where('id' , '=', $id)->where('agency_id' , '=', $user_id)->first(); 
			
			if($agreementrecord)
			{
			if ($validator->fails()) {
            return redirect("agreementform/".$agreementrecord->form_id."/edit")
                        ->withErrors($validator)
                        ->withInput();
			}
			//print_r($agreement1); exit;
			$agreementrecord->update($data);
			$agreementid = $agreementrecord->form_id;
			}
			else{ 
			//echo "hello";
			if ($validator->fails()) {
            return redirect("agreementform".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
			}
			 $data["form_id"]= $id;
			$data["agency_id"]=$user_id;
			$agree = Agency_agreement_form::create($data);
			$agreementid = $agree->form_id;
			
			}
			
        }else{
			if ($validator->fails()) {
            return redirect("agreementform".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
			}
		 $data["form_id"]= $id;
		 $data["agency_id"]=$user_id;
		 $agree = Agency_agreement_form::create($data);
          $agreementid = $agree->form_id;
        }
		\Session::flash('success', 'template has been Updated.');
		
		return redirect("agreementform/");
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
