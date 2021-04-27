<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tickets;
use App\Mail\QueryMail;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    //
    public function index(){
        // Generating Random Ticket id which is not in DB 
        
        $ticket_id=mt_rand(10000000,99999999);
        while(tickets::where('ticket_id',$ticket_id)->count() == 1)
        {
            $ticket_id=mt_rand(10000000,99999999);
        }
        return view('query')->with('ticket_id',$ticket_id);
    }

    public function save(Request $request){
        $data = new tickets;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->message = $request->message;
        $data->ticket_id = $request->ticket_id;
        $data->status="waiting";
        $que = $data->save();

        if($que){

            Mail::to($data->email)->send(new QueryMail($data));
            return back()->with('success', 'Thanks For Contacting us!!!');
        }
        return back()->with('fail', 'Something went Wrong!!!');
    
    }
}
