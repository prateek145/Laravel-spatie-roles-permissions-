<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Page;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){   
        return view('home.home');
    }

    public function dashshow(){   
       return view('layouts.admin');
    }

    public function about(){
        return view('home.about');
    }

    public function specials(){
        return view('home.special');
    }

    public function missionvission(){
        return view('home.missionvission');
    }

    public function contactus(){
        return view('home.contact');
    }

    public function blog(){
        $data = Page::paginate(10);

        return view ('home.blog', ['data'=>$data]);
    }

    public function content($id){
        $data = Page::find($id);
        return view('home.content', ['data'=>$data]);

    }
    

}