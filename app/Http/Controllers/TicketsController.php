<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tickets;
use App\Models\executive;
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

        // Assigning Task Case 01 when any user is online and have pending task less than 5
        if(executive::where('status',"online")->count()>0)
        {
            $exec_online_data=executive::where('status',"online")->get();
            $max_task_at_a_time=5;
            $lowest_count=99;
            $lowestfound=false;
            $exec_id=0;
            // Searching for least pending query executive 
            foreach ($exec_online_data as $each_exec) 
            {
                $pending_tasks=$each_exec->query_pending;
                if($pending_tasks=="none")
                    $count=0;
                else
                    $count=count(explode(',', $each_exec->query_pending));
                if($count<$lowest_count && $count<=$max_task_at_a_time)
                {
                    $lowestfound=true;
                    $lowest_count=$count;
                    $exec_id=$each_exec->executive_id;
                }
            }
            if($lowestfound==true)
            {
                // If we got the executive with minimum pending query 
                $data->status="assigned";
                $data->assigned_to=$exec_id;

                // Updating to executive table with new query assigned and query pending 
                // we are updating his query assigend and query pending 
                $new_assign_exec=executive::where('executive_id',$exec_id)->first();
                if($new_assign_exec->query_assigned=="none")
                    executive::where('executive_id',$exec_id)->update(['query_assigned'=>$request->ticket_id]);
                else
                    executive::where('executive_id',$exec_id)->update(['query_assigned'=>$new_assign_exec->query_assigned.",".$request->ticket_id]);
                
                if($new_assign_exec->query_pending=="none")
                    executive::where('executive_id',$exec_id)->update(['query_pending'=>$request->ticket_id]);
                else
                    executive::where('executive_id',$exec_id)->update(['query_pending'=>$new_assign_exec->query_pending.",".$request->ticket_id]);
            }
            else
            {
                // If we get no such executive less than 5 pending queries 
                $data->status="waiting";
            }
        }
        else
        {
            // If we get no executive online 
            $data->status="waiting";
        }

        $que = $data->save();

        if($que){

            Mail::to($data->email)->send(new QueryMail($data));
            return back()->with('success', 'Thanks For Contacting us!!!');
        }
        return back()->with('fail', 'Something went Wrong!!!');
    
    }
}
