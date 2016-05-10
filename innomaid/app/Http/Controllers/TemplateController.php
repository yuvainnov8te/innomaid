<?php
 /***********************************************
	 Developed by :- Poonam chandak
	 Module       :- template
*************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\StandardAgreement as Templates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller {

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

			$templateList = DB::table('standard_agreement_forms as t')
                ->select("t.*")
               	->orderBy("t.updated_at", "DESC")
               	->paginate(10);
	//	print_r($templateList); exit;

		return view('sentinel.templates.index')->with('templateList', $templateList);
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
	
		return view('sentinel.templates.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
	//echo "hello"; exit;
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
				'form_type' => 'required|unique:standard_agreement_forms,form_type',
        	],$messages);

        if ($validator->fails()) {
            return redirect("template/create")
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
        $templates = Templates::create($data);
		$insertedId = $templates->id;
	
		\Session::flash('success', 'templete is saved.');
		//print_r($data); exit;
		return redirect("template/");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) { 	
		$templates = Templates::findOrFail($id);	
		return view('sentinel.templates.edit')->with('templates',$templates);
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
		if(!(Input::get('visible')))
		{
			$data['visible']='';
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
				'form_type' => 'required|unique:standard_agreement_forms,form_type,'.$id,
        	],$messages);

        if ($validator->fails()) {
            return redirect("template/".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
	
        $templates = Templates::findOrFail($id); //print_r($data); exit;
		$templates->update($data);

		\Session::flash('success', 'template has been Updated.');
		
		return redirect("template/");
	}
	
	public function preview($id) {
	
	$templates = Templates::findOrFail($id);	
		return view('sentinel.templates.preview')->with('templates',$templates);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function delete($id) {
	// echo $id; exit;
		DB::table('standard_agreement_forms')->where('id', '=', $id)->delete();
		\Session::flash('success', 'Template deleted successfully.');
		return redirect("template/");
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
