<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResponseMail;
use Illuminate\Support\Facades\Mail;
use App\Models\tickets;
use App\Models\response;
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

            $data = new response;
            $data->from = $request->from;
            $data->response = $request->reply_message;
            $data->to = $to_user->email;
            $que = $data->save();

            

            if($que){

                Mail::to($to_user->email)->send(new ResponseMail($request->reply_message, $ticket_id));
                // $to->user->assigned_to= 'solved'; //yet to create this attribute in the tickets_table
                return back()->with('success', 'Your Response is Sent to '.$to_user->email);
            }
            return back()->with('fail', 'Something went Wrong!!!');
        }
        else{
            return redirect('/login');
        }   
    }
}
