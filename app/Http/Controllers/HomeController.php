<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\tickets;

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
        if(Auth::user()->role=="executive"){
            return view('home');
        }
        else{
            return redirect()->back();        }
    }
    

    // public function index(){
    //     if(Auth::check()){
    //         return view('home');   
    //     }
    //     else{
    //         return redirect('/login');
    //     }
        
    // }
    public function tasks(){
        if(Auth::user()->role=="executive"){

            $tickets = tickets::where('assigned_to','=',Auth::user()->id)
                                ->where('status','assigned')
                                ->where(function ($query){
                                    $query->where('assigned_to','=',Auth::user()->id)
                                          ->whereBetween('updated_at', [Carbon::now()->subDay(), Carbon::now()]);
                                })
                                ->get();

            return view('/executive/assigned_tasks')->with('tickets',$tickets);
        }
        else{
            return redirect('/login');
        }
        
    }
}
