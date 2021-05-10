<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\executive;
use App\Models\tickets;

class AdminController extends Controller
{

    use RegistersUsers;

    //
    public function index(){
        if(Auth::user()->role == 'admin'){
            return view('admin-panel');
        }
        else{
            return redirect()->back();
        }
    }

    public function registerExec(){
        if(Auth::user()->role == 'admin'){
            return view('admin.add_executive');
        }
        else{
            return redirect()->back();
        }
    }

    public function storeExec(Request $request){
        // return $request->position;
        if(Auth::user()->role == 'admin'){
            $que=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role'=>"executive",
                'role_id'=>"2",
            ]);
            if($que)
            {
                $exec_data=executive::create([
                    'executive_id'=> $que->id,
                    'position' => $request->position,
                ]);
            }
            if($que&&$exec_data){
                return back()->with('success', 'Executive created!!! '.$que->name);
            }
            return back()->with('fail', 'Something went Wrong!!!');
    
        }
        else{
            return view('/admin');
        }
    }
    public function allExec(){
        if(Auth::user()->role == 'admin'){
            $exec_data= executive::join('users', 'executive.executive_id', '=', 'users.id')->get();
            return view('admin/all_executive')->with('exec_data',$exec_data);
        }
        return back();
    }

    public function tickets(){
        if(Auth::user()->role == 'admin'){
            $tickets = tickets::all();
            return view('admin.all_tickets')->with('tickets', $tickets);
        }
        return back();
    }
    public function make_active_change($exec_id){
        $exec=executive::where('executive_id','=',$exec_id)->first();
        if ($exec->active == 1){
            executive::where('executive_id','=',$exec_id)->update(['active'=>0]);
        }else{
            executive::where('executive_id','=',$exec_id)->update(['active'=>1]);
        }
        return redirect()->back();
    }
}
