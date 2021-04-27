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
            if(tickets::where('ticket_id', $id)->where('assigned_to',Auth::user()->id)->count()==1)
            {
                $query_data=tickets::where('ticket_id', $id)->where('assigned_to',Auth::user()->id)->first();
                if($query_data->status === 'solved'){
                    return back();
                }
                else{
                    return view('executive.reply')->with('query_data',$query_data);
                }
            }
            else
                return redirect('/home');
        }
        else{
            return redirect('/login');
        }
        
    }
        

    public function sendEmail(Request $request, $ticket_id){

        if(Auth::check()){
            $to_user=tickets::where('ticket_id','=',$ticket_id)->first();

            $data = new response;
            $data->from = Auth::user()->email;
            $data->response = $request->reply_message;
            $data->to = $to_user->email;
            
            $que = $data->save();

            

            if($que){
                $status ='solved';
                $affectedRows = tickets::where('ticket_id','=',$ticket_id)->update(['status' => $status]);
                Mail::to($to_user->email)->send(new ResponseMail($request->reply_message, $ticket_id));
                //changes to be made here
                return view('home')->with('success', 'Your Response is Sent to '.$to_user->email);
            }
            return back()->with('fail', 'Something went Wrong!!!');
        }
        else{
            return redirect('/login');
        }   
    }
}
