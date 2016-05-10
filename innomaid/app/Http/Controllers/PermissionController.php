<?php 
 /*****************Developed by :- Akshay Yadav
                   Module       :- Permission
***********************************************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Permission;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use Illuminate\Support\Facades\Validator;
class PermissionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // parent::__construct();
         $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$permissions = $this->permissionRepository->permissionList(static::PER_PAGE_NUM);
        //$count = Permission::count();
        $permissions = DB::table('permissions as p')->get();
        $count = Permission::count();
        return view('sentinel.permission.index', compact('permissions','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       return view('sentinel.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $createRequest)
    {   
        $user_id = Auth::user()->id;
        $user_email =  Auth::user()->email;
        $data = $createRequest->all();
         $messages = array(
                'name.required' => 'Permission name must',
            'name.max' => 'Permission name up to 100 characters',
            'name.unique' => 'The permission name already exists',
            'display_name.max' => 'Permission to display the name of up to 100 characters',
            'description' => 'Permission Description Up to 100 characters'
        );
        $validator = Validator::make($data, [
            'name' => 'required|max:100|unique:permissions,name',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ],$messages);

        if ($validator->fails()) {
            return redirect("permission/create")
                        ->withErrors($validator)
                        ->withInput();
        }
       $model = new Permission;
        $model->name = $data['name'];
        $model->display_name = $data['display_name'];
        $model->description = $data['description'];
        $model->agency_id = $user_id;
        
        $model->save();
        \Session::flash('success', 'Permission is saved.');
        return redirect("permission/");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $permission =  DB::table('permissions as p')->where('id','=',$id)->get();
        return view('sentinel.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $updateRequest)
    {
        $user_id = Auth::user()->id;
        $user_email =  Auth::user()->email;
        $data = $updateRequest->all();
         $messages = array(
            'name.required' => 'Permission name must',
            'name.max' => 'Permission name up to 100 characters',
            'name.unique' => 'The permission name already exists',
            'display_name.max' => 'Permission to display the name of up to 100 characters',
            'description' => 'Permission Description Up to 100 characters'
        );
        $validator = Validator::make($data, [
            'name' => 'required|max:100|unique:permissions,name,'.$id,
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ],$messages);

        if ($validator->fails()) {
            return redirect("permission/".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
        }
       $model = new Permission;

        $updatedata = [];
        $updatedata['name'] = $data['name'];
        $updatedata['display_name'] = $data['display_name'];
        $updatedata['description'] = $data['description'];

        $result = $model->where('id', $id)->update($updatedata);

        \Session::flash('success', 'Permission is Updated.');
        return redirect("permission/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function delete($id) {
        DB::table('permissions')->where('id', '=', $id)->delete();
        \Session::flash('success', 'Permission deleted successfully.');
        return redirect("permission/");
    }

}
