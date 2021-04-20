<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResponseMail;
use Illuminate\Support\Facades\Mail;
use App\Models\tickets;
use Auth;

class ResponsesController extends Controller
{
    //
    public function reply($id) {
        if(Auth::check()){
            return view('executive.reply')->with(['id'=>$id]); 
        }
        else{
            return redirect('/login');
        }
        
    }
        

    public function sendEmail(Request $request, $ticket_id){

        if(Auth::check()){
            $to_user=tickets::where('ticket_id',$ticket_id)->first();

            Mail::to($to_user->email)->send(new ResponseMail($request->reply_message, $ticket_id));
            return "Email Sent to ".$to_user->email;  
        }
        else{
            return redirect('/login');
        }   
    }
}
