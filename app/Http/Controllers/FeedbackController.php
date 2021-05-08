<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tickets;
use App\Models\executive;
use Auth;
use DB;
use App\Mail\feedback;
use App\Models\feedbacks;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    //
    public function index($ticket_id){
        $ticket = tickets::where('ticket_id','=', $ticket_id)->first();
        $fdbk = feedbacks::where('ticket_id','=', $ticket_id)->first();

        if(!$fdbk){ 
            if($ticket->status == "solved")
                return view('feedback_temp')-> with('ticket', $ticket);
            else
                return redirect('')->with('already_fdbk', 'Wait for ticket to be solved!!!' );
        }
        else
            return redirect('')->with('already_fdbk', 'Feedback is already available for this Ticket.' );
    }

    public function send($ticket_id){
        $ticket = tickets::where('ticket_id','=', $ticket_id)->first();
        Mail::to($ticket->email)->send(new feedback($ticket));
        return redirect()->back(); 
    }

    public function store(Request $request){
        $data = new feedbacks;
        $data->ticket_id = $request->ticket_id;
        $data->fdbk_msg = $request->feedback;
        $data->rating =$request->rating

        $rating = $request->rating;

        $ticket = tickets::where('ticket_id','=', $request->ticket_id)->first();
        $exec = executive::where('executive_id','=',$ticket->assigned_to)->first();
        $rating_exec = $exec->rating;

        $que = $data->save();
        
        if($que && $rating!=0 && $rating<=5){
            if($rating_exec == 'none')
                $rating_exec = $rating;
            else
                $rating_exec.=",".$rating;
            $exec = executive::where('executive_id','=',$ticket->assigned_to)->update(['rating' => $rating_exec]);
            return redirect('')->with('fdbk_success', 'Thanks For giving the feedback!!!');
        }
        return redirect('')->with('fdbk_fail', 'Something went Wrong!!!');
    }
}
