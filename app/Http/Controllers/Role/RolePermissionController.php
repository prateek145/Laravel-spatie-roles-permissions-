<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Role::all();
            if(count($data) == 0){
                throw new Exception('Please Create role');
            }


            return view('rolesandpermission.index', ['role'=>$data]);
        }catch(Exception $e){
            return view('errors.role', ['error'=>$e->getMessage()]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $permission = Permission::all();
        return view('rolesandpermission.create', ['permission'=>$permission]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:14'
        ]);
        $role = Role::create(['name'=>$request->name]);
        $permisson = $request->first;
        $i = 0;
        
        
        while($i<(count($permisson))){
            
            $permisson[$i];
            $permission = Permission::where(['id'=>$permisson[$i]])->first();
            $role->givePermissionTo($permission);
            $i++;

        }
        return redirect('role')->with('success', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::all();
        $role_have_permissions = DB::table('role_has_permissions')->where(['role_id'=> $id])->get();

        return view('rolesandpermission.update', ['id'=>$id, 'permission'=>$permission, $role_have_permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $role = Role::find($request->hidden);
            $permisson = $request->permissions;
            $i = 0;
            $permissions = Permission::all();

            foreach($permissions as $permission){
                $role->revokePermissionTo($permission);
            }

        
        
        while($i<(count($permisson))){
            
            $permisson[$i];
            $permission = Permission::where(['id'=>$permisson[$i]])->first();          
            $role->givePermissionTo($permission);
            $i++;

        }
        return redirect('role')->with('success', 'Successfully Updated');

        }catch(Exception $e){
            return view('errors.role', ['error'=>$e->getMessage()]);
            
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect('role');
    }
}
