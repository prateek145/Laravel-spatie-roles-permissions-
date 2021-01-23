<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('list user')){
            try{
                $data = User::paginate(10);
                if(count($data) == 0){
                    throw new Exception('No user found');
                }
                return view('user.index', ['data'=>$data]);
               
    
            }catch(Exception $e){
                return view('errors.user', ['error'=>$e->getMessage()]);
    
            }

        }
        else{
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
        if(auth()->user()->can('create user')){

            $role = Role::all();
            $permissions = Permission::all();
            
            return view('user.create', ['role'=>$role, 'permissions'=>$permissions]);
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
        if(auth()->user()->can('create user')){

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password'=>'required|min:8',
                're_password' => 'required|min:8'
                ]);
                
                try{
                    if($request->password == $request->re_password){
                        $user = new User();
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->password = Hash::make($request->password);
                        
                        if($request->roles != null){
                            $user->assignRole([$request->roles]);
                        }
                        
                        if($request->permissions != null){
                            $user->givePermissionTo([$request->permissions]);
                        }
                        
                        $user_create = $user->save();
                        
                        if($user_create){
                            return redirect('user')->with('success', 'Successfully Created');
                        }
                        else{
                            return redirect()->back()->with('error', 'Does not create');
                        }
                        
                        
                    }else{
                        return redirect()->back()->with('error', 'password does not match');
                    }
                    
                }catch(Exception $e){
                    return view('errors.forget',['error'=>$e->getMessage()]);
                    
                }
            }else{
                return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
        if(auth()->user()->can('view user')){

            try{
                $user = User::find($id);
                    $data = User::find($id);
                    // dd($data->getAllPermissions(), $data->hasAllRoles(Role::all())); 
                    if(!$data){
                        throw new Exception('User does not exists');
                    }
                    $roles = Role::all();
                    $permissions = Permission::all();
                    
                    $user_have_permission = DB::table('model_has_permissions')->select('permission_id')->where('model_id',$id)->get()->pluck('permission_id');
                    
                    return view('user.update', ['data'=>$data, 'roles'=>$roles, 'permissions'=>$permissions, 'id'=>$id,'user_have_permission'=>$user_have_permission->toArray() ]);
                }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        if(auth()->user()->can('edit user')){

            try{
                $user = User::find($id);
                if ($user->hasRole(Role::all()) || $user->can('edit article')){
                    $user = User::find($id);       
                    $roles = Role::all();
                    $permissions = Permission::all();
                    
                    return view('user.edit', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions]);
                }else{
                    throw new Exception("You don't have permission to perform this action");
                }
            }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
        // dd($request->permission);
        
        if(auth()->user()->can('edit user')){

            try{
                $request->validate([
                    'name'=> 'required',
                    'email'=> 'required'
                    ]);
                    
                    
                    $user = User::find($id);
                    if ($user->hasRole(Role::all()) || $user->can('edit article')){
                        // dd("============");
                        $user->syncPermissions($request->permission);
                        $user->syncRoles($request->role);
                        $user->name = isset($request->name) ? $request->name : null;
                        $user->email = isset($request->email) ? $request->email : null;
                        $user->save();
                        return redirect()->back()->with('success', 'Success');
                    }else{
                        throw new Exception('Please select Role or Permission');
                    }
                    /*            $user = User::where(['id'=>$request->hidden])->first();
                    
                    $roles = $request->role;
                    
                    $permissions = $request->permission;
                    $rolein = Role::all();
                    $permissionin = Permission::all();
                    $i = 0;
                    $y = 0;
                    
                    if(!empty($rolein)){
                        $x = 0;
                        while($x<count($rolein)){
                            if($user->hasRole($rolein[$x])){
                                $user->removeRole($rolein[$x]);
                            }
                            $x++;
                        }
                        
                    }
                    
                    if(!empty($roles)){
                        
                        while($i<count($roles)){
                            $role = Role::where(['id'=> $roles[$i]])->first();
                            $usergive_r = $user->assignRole($role);
                            $i++;
                        }
                    }
                    
                    if(!empty($permissionin)){
                        $z = 0;
                        while($z<count($permissionin)){
                            if($user->hasPermissionTo($permissionin[$z])){
                                $user->revokePermissionTo($permissionin[$z]);
                                
                            }
                            $z++;
                        }
                        
                    }
                    
                    if(!empty($permissions)){
                        
                        
                        while($y<count($permissions)){
                            $permission = Permission::where(['id'=>$permissions[$y]])->first();
                            $usergive_p = $user->givePermissionTo($permission);
                            $y++;
                        }
                    }
                    
                    
                    if($usergive_p){
                        return redirect()->route('user.index')->with('success', 'Success');
                    }
                    elseif($usergive_r){
                        return redirect()->route('user.index')->with('success', 'Success');
                    }
                    else{
                        throw new Exception('Plese select the value');
                    }
                    */
                }catch(Exception $e){
                    // return view('errors.user', ['error'=>$e->getMessage()]);
                    return redirect()->back()->with('error', $e->getMessage());
                    
                }

            }else{
                return redirect()->back()->with('error', 'You are not authorize contact to admin.');
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
        if(auth()->user()->can('delete user')){

            User::destroy($id);
            return redirect()->back()->with('success', 'Successfully deleted');
        
        }else{
            return redirect()->back()->with('error', 'You are not authorize contact to admin.');
        }
        
    }
}
