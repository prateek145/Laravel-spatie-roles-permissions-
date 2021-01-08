<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\RetryMiddleware;
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
        if(auth()->user()->can('list role')){

            try{
                $data = Role::all();
                if(count($data) == 0){
                    throw new Exception('Please Create role');
                }
                
                
                return view('rolesandpermission.index', ['data'=>$data]);
            }catch(Exception $e){
                return view('errors.role', ['error'=>$e->getMessage()]);
                
            }
        
        }else{
            return view('errors.unauthenticate');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        if(auth()->user()->can('create role')){

            $permission = Permission::all();
            return view('rolesandpermission.create', ['permission'=>$permission]);
        
        }else{
            return view('errors.unauthenticate');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->can('create role')){

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
                return redirect()->back()->with('success', 'Successfully Created');
        
        }else{
            return view('errors.unauthenticate');
           
        }
    }
            
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->can('edit role')){

            $role = Role::find($id);
            $permission = Permission::all();
            $role_have_permissions = $role->getPermissionNames([$permission]);
            
            return view('rolesandpermission.update', ['id'=>$id, 'role'=>$role, 'permission'=>$permission, 'role_have_permissions'=>$role_have_permissions]);
        
        }else{
            return view('errors.unauthenticate');
        }
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
        if(auth()->user()->can('edit role')){

            try{
                $role = Role::find($request->hidden);
                $permisson = $request->permissions;
                $i = 0;
                $permissions = Permission::all();

                if($request->name != null){
                    Role::where(['id'=>$request->hidden])->update(['name'=>$request->name]);
                }    
                
                foreach($permissions as $permission){
                    $role->revokePermissionTo($permission);
                }
                
                
                
                while($i<(count($permisson))){
                    
                    $permisson[$i];
                    $permission = Permission::where(['id'=>$permisson[$i]])->first();          
                    $role->givePermissionTo($permission);
                    $i++;
                    
                }
                return redirect()->back()->with('success', 'Successfully Updated');
                
            }catch(Exception $e){
                return view('errors.role', ['error'=>$e->getMessage()]);
                
            }   
        
        }else{
            return view('errors.unauthenticate');
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
        if(auth()->user()->can('delete role')){

            Role::destroy($id);
            return redirect('role');
        
        }else{
            return view('errors.unauthenticate');

        }
    }
}
