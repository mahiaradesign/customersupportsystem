<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResponseMail;
use Illuminate\Support\Facades\Mail;
use App\Models\tickets;
use App\Models\response;
use App\Models\executive;
use Auth;
use App\Http\Controllers\TicketsController;

class ResponsesController extends Controller
{
    //
    public function reply($id) {
        if(Auth::user()->role=="executive"){
            if(tickets::where('ticket_id', $id)->where('assigned_to',Auth::user()->id)->count()==1)
            {
                $query_data=tickets::where('ticket_id', $id)->where('assigned_to',Auth::user()->id)->first();
                if($query_data->status === 'solved'){
                    return back();
                }
                else{
                    $exec_position=executive::where('executive_id',Auth::user()->id)->pluck('position')->first();
                    return view('executive.reply')->with(['query_data'=>$query_data,'exec_position'=>$exec_position]);
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

        if(Auth::user()->role=="executive"){
            $to_user=tickets::where('ticket_id','=',$ticket_id)->first();

            $data = new response;
            $data->from = Auth::user()->id;
            $data->response = $request->reply_message;
            $data->to = $to_user->email;
            $data->ticket_id =$ticket_id;
            
            $que = $data->save();


            if($que){
                $exec_data=executive::where('executive_id',Auth::user()->id)->first();
                $his_query_solved=$exec_data->query_solved;
                if($his_query_solved=="none")
                    $his_query_solved=$ticket_id;
                else
                    $his_query_solved.=",".$ticket_id;

                $his_query_pending=explode(",",$exec_data->query_pending);//getting his pending queries
                array_splice($his_query_pending,array_search($ticket_id,$his_query_pending,TRUE),1);//removing the solved problem from pending query 
                if(count($his_query_pending)>0)
                    $his_new_pending=implode(",",$his_query_pending);
                else
                    $his_new_pending="none";
                executive::where('executive_id',Auth::user()->id)->update(['query_solved' => $his_query_solved,'query_pending'=>$his_new_pending]);//updating query solved and query pending column of that executive
                tickets::where('ticket_id','=',$ticket_id)->update(['status' => 'solved']);//updating status of query to solved
                TicketsController::assign_waiting_task();
                Mail::to($to_user->email)->send(new ResponseMail($request->reply_message, $ticket_id));
                $tickets= tickets::where('assigned_to','=',Auth::user()->id)->get();

                return redirect('/executive/assigned_tasks')->with(['tickets'=>$tickets, 'success'=>'Your Response is Sent to '.$to_user->first_name.' '.$to_user->last_name ]);
            }
            return back()->with('fail', 'Something went Wrong!!!');
        }
        else{
            return redirect('/login');
        }   
    }
}
