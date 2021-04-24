<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\executive;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin-panel');
    }
    public function all_executive(){
        $exec_data= executive::join('users', 'executive.executive_id', '=', 'users.id')->get();
        // return $exec_data;
        return view('admin/all_executive')->with('exec_data',$exec_data);
    }
}
