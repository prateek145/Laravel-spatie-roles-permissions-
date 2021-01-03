<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \App\Models\User;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = auth()->id();
        $user = User::where(['id'=>$id])->first();

        if ($user->hasRole('admin')){
            return $next($request);
        }
        else{
            return redirect('article');
        }
        
    }
}
