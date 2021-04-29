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
                    'query_assigned' => "none",
                    'query_solved' => "none",
                    'query_pending' => "none",
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
        $exec_data= executive::join('users', 'executive.executive_id', '=', 'users.id')->get();
        return view('admin/all_executive')->with('exec_data',$exec_data);
    }
}
