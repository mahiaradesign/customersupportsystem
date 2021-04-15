<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tickets;
class TicketsController extends Controller
{
    //
    function save(Request $request){
        // print_r($request->all());
        $data = new tickets;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->message = $request->message;
        $data->save();
        echo "<script>alert('Thanks For contacting us!!!')</script>";
        return redirect('/');

    }
}
