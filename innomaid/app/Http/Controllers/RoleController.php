<?php 
 /*****************Developed by :- Akshay Yadav
                   Module       :- Permission
***********************************************************************************/
namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Role;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Route;
use Session;
use Input;
use Illuminate\Support\Facades\Validator;
class RoleController extends Controller {

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
        $roles = DB::table('roles as r')
                ->leftJoin('role_user as ru', 'ru.role_id', '=', 'r.id')
                ->select("r.*",DB::Raw("count(ru.role_id) as total"))
                ->groupBy("r.id")
                ->get();
        $count = Role::count();
        return view('sentinel.role.index', compact('roles','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       return view('sentinel.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $createRequest)
    {   $data = $createRequest->all();

         $messages = array(
            'name.required' => 'Role name must',
            'name.max' => 'Role name up to 100 characters',
            'name.unique' => 'The role name already exists',
            'display_name.max' => 'Role to display the name of up to 100 characters',
            'description' => 'Role Description Up to 100 characters'
        );
        $validator = Validator::make($data, [
            'name' => 'required|max:100|unique:roles,name',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ],$messages);

        if ($validator->fails()) {
            return redirect("role/create")
                        ->withErrors($validator)
                        ->withInput();
        }
        $model = new Role;
        $model->name = $data['name'];
        $model->display_name = $data['display_name'];
        $model->description = $data['description'];
        $model->agency_id = Auth::user()->id;
        if(input::get('activated')) {
            $model->activated=1;
        }else{
            $model->activated=0;
        }
        if(input::get('display')) {
            $model->display=1;
        }else{
            $model->display=0;
        }
        $model->save();
        
        $model->save();
        \Session::flash('success', 'Role is saved.');
        return redirect("role/");
        
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
        $role =  DB::table('roles as r')->where('id','=',$id)->get();
        return view('sentinel.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $updateRequest)
    {
       $data = $updateRequest->all();
         $messages = array(
            'name.required' => 'Role name must',
            'name.max' => 'Role name up to 100 characters',
            'name.unique' => 'The role name already exists',
            'display_name.max' => 'Role to display the name of up to 100 characters',
            'description' => 'Role Description Up to 100 characters'
        );
        $validator = Validator::make($data, [
            'name' => 'required|max:100|unique:roles,name,'.$id,
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ],$messages);

        if ($validator->fails()) {
            return redirect("role/".$id."/edit")
                        ->withErrors($validator)
                        ->withInput();
        }
       $model = new Role;

        $updatedata = [];
        $updatedata['name'] = $data['name'];
        $updatedata['display_name'] = $data['display_name'];
        $updatedata['description'] = $data['description'];
        if(input::get('activated')) {
            $updatedata['activated']=1;
        }else{
            $updatedata['activated']=0;
        }
        if(input::get('display')) {
            $updatedata['display']=1;
        }else{
            $updatedata['display']=0;
        }
        $result = $model->where('id', $id)->update($updatedata);

        \Session::flash('success', 'Role has been Updated.');
        return redirect("role/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        DB::table('permission_role')->where('role_id', '=', $id)->delete();
        DB::table('roles')->where('id', '=', $id)->delete();
        \Session::flash('success', 'Role deleted successfully.');
        return redirect("role/");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->permissionRepository->destroy($id);
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? 'Permissions have been deleted' : 'Permissions delete failed',
        ];
        return response()->json($alert);
    }
    /**
     * Display a role's perms
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getPerms($id)
    {//echo 'ok'; exit;
        $current_user_id= Auth::user()->id;

        $permissions = DB::table('permissions')
                            ->get();
        $role = DB::table('roles')->where('id','=',$id)
                            ->get();

        $perms = [];
        $permission = DB::table('permission_role as pr')
                            ->leftJoin('permissions as p', 'p.id', '=', 'pr.permission_id')
                            ->where('pr.role_id','=',$id)
                            ->get();
        if($permission){
            foreach ($permission as $item) {
                $perms[$item->id] = $item->name;
            }
        }
        $rolePerms = $perms;

        //print_r($permissions);
       // exit;

        return view('sentinel.role.permissions', compact('role', 'permissions', 'rolePerms'));
    }

    public function postPerms($id, Request $request)
    {
        DB::table('permission_role')->where('role_id', '=', $id)->delete();
        $data = $request->all();
        if(Input::get('permissions'))
        {
            $datacount = count($data['permissions']);
           // print_r($data); exit;
            for ($i=0; $i < $datacount; $i++) {
                    DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [$data['permissions'][$i],$id]);
            }
        }
        \Session::flash('success', 'Permission has been Updated.');
        return redirect("role/");
    }

}
