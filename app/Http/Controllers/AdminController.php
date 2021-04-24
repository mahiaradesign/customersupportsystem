<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
=======
use App\Models\executive;
use App\Models\User;
>>>>>>> 3e188df09b79185c9a40ad195fe930e9ad6f6f4d

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
            // print_r(Auth::user());

            // $request->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|string|email|max:255|unique:users',
            //     'password' =>'required|string|min:8|confirmed',
            //     'role'=>'required|string|max:20',
            //     'role_id'=>'required|string|max:20',
            // ]);
    
            $que=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role'=>$request->role,
                'role_id'=>$request->role_id,
            ]);

            if($que){
                return back()->with('success', 'Executive created!!!'.$que->name);
            }
            return back()->with('fail', 'Something went Wrong!!!');
    
        }
        else{
            return view('/admin');
        }
    }
    public function all_executive(){
        $exec_data= executive::join('users', 'executive.executive_id', '=', 'users.id')->get();
        // return $exec_data;
        return view('admin/all_executive')->with('exec_data',$exec_data);
    }
}
