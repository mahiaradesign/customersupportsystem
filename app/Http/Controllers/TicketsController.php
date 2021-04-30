<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tickets;
use App\Models\executive;
use App\Mail\QueryMail;
use Auth;
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
    public static function assign_waiting_task()
    {
        // Checking for waiting status 
        if(tickets::where('status',"waiting")->count()>0)
        {
            $max_task_at_a_time=5;
            $logged_exec=executive::where('executive_id',Auth::user()->id)->first();//getting logged in user datails to get his qhery pending
            $pending_tasks=$logged_exec->query_pending;
            if($pending_tasks=="none")
                $count=0;
            else
                $count=count(explode(',', $pending_tasks));

            $unassigned_task_data=tickets::where('status',"waiting")->orderBy('created_at')->take($max_task_at_a_time-$count)->get();//getting some unassigned queries
            $exec_new_assigned_task=$logged_exec->query_assigned;
            $exec_new_pending_task=$logged_exec->query_pending;
            foreach ($unassigned_task_data as $each_task) 
            {
                if($exec_new_assigned_task=="none")
                    $exec_new_assigned_task=$each_task->ticket_id;
                else
                    $exec_new_assigned_task.=",".$each_task->ticket_id;
                if($exec_new_pending_task=="none")
                    $exec_new_pending_task=$each_task->ticket_id;
                else
                    $exec_new_pending_task.=",".$each_task->ticket_id;
                    
                tickets::where('id',$each_task->id)->update(['assigned_to'=>$logged_exec->executive_id,'status'=>'assigned']);//updating query status to assigned
            }
            executive::where('id',$logged_exec->id)->update(['query_assigned'=>$exec_new_assigned_task,'query_pending'=>$exec_new_pending_task]);//adding those queries to executive query assiged and query pending colums
        }
    }
    public function pass_query($ticket_id)
    {
        // write algo here...
        // Make a extra column in executive for saving transferred queries name=query_transfer
        // transfer it to senior and remove the ticket id from previous assigned executive  query_pending to query_transfer column
        $ticket_to_transfer= tickets::where('ticket_id','=',$ticket_id)->first(); //fetching the ticket details to be passed
        $prev_alloted_exec_id = $ticket_to_transfer->assigned_to; //fetchin the executve id to whom it is currently alloted
        $prev_alloted_exec = executive::where('executive_id','=',$prev_alloted_exec_id)->first(); //and then collecting info of the executive

        // then getting the list of the query_assigned and $query_pending
        $get_query_pending = $prev_alloted_exec->query_pending;
        $get_query_assigned = $prev_alloted_exec->query_assigned;

        //if the executive has only one query assigned then making if none 
        // else g0ing through entire string and search the ticketid and remove it.  
        if(count(explode(',',$get_query_assigned))==1){
            $put_query_assigned="none";
        }else{
            $put_query_assigned="none";
            foreach(explode(',',$get_query_assigned) as $assigned){
                if ($assigned != $ticket_id){
                    if($put_query_assigned=="none")
                        $put_query_assigned=$assigned;
                    else
                        $put_query_assigned.=",".$assigned;
                }
            }
        }

        if(count(explode(',',$get_query_pending))==1){
            $put_query_pending="none";
        }else{
            $put_query_pending="none";
            foreach(explode(',',$get_query_pending) as $pending){
                if ($pending != $ticket_id){
                    if($put_query_pending=="none")
                        $put_query_pending=$pending;
                    else
                        $put_query_pending.=",".$pending;
                }
            }
        }

        executive::where('executive_id','=',$prev_alloted_exec_id)->update(['query_assigned'=>$put_query_assigned, 'query_pending'=>$put_query_pending]);

        $senior_exec= executive::where('position','=','Senior')->get();
        $select_se= executive::where('position','=','Senior')->first();
        $lowest_count=count(explode(',',$select_se->query_pending));
        foreach($senior_exec as $se){
            if(count(explode(',',$se->query_pending))<$lowest_count){
                $lowest_count= count(explode(',',$se->query_pending));
                $select_se=$se;
            }
        }

        $exec_new_assigned_task=$select_se->query_assigned;
        $exec_new_pending_task=$select_se->query_pending;

        if($exec_new_assigned_task=="none")
            $exec_new_assigned_task=$ticket_id;
        else
            $exec_new_assigned_task.=",".$ticket_id;
        if($exec_new_pending_task=="none")
            $exec_new_pending_task=$ticket_id;
        else
            $exec_new_pending_task.=",".$ticket_id;
            
        tickets::where('ticket_id',$ticket_id)->update(['assigned_to'=>$select_se->executive_id,'status'=>'assigned','query_transfer'=>'True']);
        $select_se->update(['query_assigned'=>$exec_new_assigned_task,'query_pending'=>$exec_new_pending_task]);

        $tickets= tickets::where('assigned_to','=',Auth::user()->id)->get();
        return redirect('/executive/assigned_tasks')->with(['tickets'=>$tickets, 'success'=>'Issue is transferred Successfully']);
    }
}
