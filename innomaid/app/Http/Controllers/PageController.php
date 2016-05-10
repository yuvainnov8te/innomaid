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
use App\Pages as Pages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use PDF;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller {

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

			$pageList = DB::table('pages as p')
                ->select("p.*")
               	->orderBy("p.updated_at", "DESC")
               	->paginate(10);
		

		return view('sentinel.pages.index')->with('pageList', $pageList);
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
		return view('sentinel.pages.create');
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
            return redirect("page/create")
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
        $pages = Pages::create($data);
		$insertedId = $pages->id;

		\Session::flash('success', 'Page is saved.');
		
		return redirect("page/");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$pages = Pages::findOrFail($id);		
		return view('sentinel.pages.edit')->with('pages',$pages);
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

        if ($validator->fails()) {
            return redirect("page/".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
        }
        // validation rule complete
        $pages = Pages::findOrFail($id);
		$pages->update($data);

		\Session::flash('success', 'Page has been Updated.');
		
		return redirect("page/");
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
