<?php

namespace App\Http\Controllers\Forget;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\throwException;

class ForgetPasswordcontroller extends Controller
{
    function forget(){
        return view('forgetpassword.forget');
    }

    //get email
    function forgetpassword(Request $request){

        $request->validate([
            'email'=>'required|max:100',
        ]);
        try{
            $user = User::where(['email'=>$request->email])->first();
            if(!$user){
                throw new Exception('User does not exists');

            }
            if($user){
                $data = $user->id;
                return redirect('ChangePassword')->with('id', $data);
            }

        }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //change password

    function ChangePassword(){
        
        return view('forgetpassword.changepassword');
    }
    function changepasswordsave(Request $request){

        $request->validate([
            'password'=>'required',
            'password1' => 'required'
        ]);

        try{
            if($request->password == $request->password1){
                User::where(['id'=>$request->hidden])->update(['password'=>Hash::make($request->password)]);
                return redirect('forget')->with('success', 'Succesfully Password Change');
             
            }else{
                return redirect()->back()->with('error', 'password does not match');
            }

        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());

        }

    }

}
