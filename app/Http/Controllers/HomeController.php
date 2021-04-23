<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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

    public function index()
    {
        return view('home');
    }
    

    // public function index(){
    //     if(Auth::check()){
    //         return view('home');   
    //     }
    //     else{
    //         return redirect('/login');
    //     }
        
    // }
    // public function tasks(){
    //     if(Auth::check()){
    //         return view('/executive/assigned_tasks');
    //     }
    //     else{
    //         return redirect('/login');
    //     }
        
    // }
}
