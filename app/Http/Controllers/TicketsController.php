<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tickets;
use App\Models\executive;
use App\Models\User;
use App\Mail\QueryMail;
use App\Mail\PassQueryMail;
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
                if($count<$lowest_count && $count<$max_task_at_a_time)
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
        $senior_exec= executive::where('position','=','Senior')->get();
        if(count($senior_exec)>0)
        {
            $ticket_to_transfer= tickets::where('ticket_id','=',$ticket_id)->first(); //fetching the ticket details to be passed
            $prev_alloted_exec_id = $ticket_to_transfer->assigned_to; //fetchin the executve id to whom it is currently alloted
            $prev_alloted_exec = executive::where('executive_id','=',$prev_alloted_exec_id)->first(); //and then collecting info of the executive

            $query_pending_arr = explode(',',$prev_alloted_exec->query_pending);
            $query_transferred =$prev_alloted_exec->query_transferred;
            array_splice($query_pending_arr,array_search($ticket_id,$query_pending_arr,TRUE),1);
            if(count($query_pending_arr)==0)
                $put_query_pending="none";
            else
                $put_query_pending=implode(",",$query_pending_arr);
            if($query_transferred=="none")
                $put_query_transferred=$ticket_id;
            else
                $put_query_transferred=$query_transferred.",".$ticket_id;
            $select_se= executive::where('position','=','Senior')->orderByRaw('CHAR_LENGTH(query_pending)')->first();
            $selected_se_q_assigned=$select_se->query_assigned;
            $selected_se_q_pending=$select_se->query_pending;
            if($selected_se_q_assigned=="none")
                $selected_se_q_assigned=$ticket_id;
            else
                $selected_se_q_assigned.=",".$ticket_id;
            if($selected_se_q_pending=="none")
                $selected_se_q_pending=$ticket_id;
            else
                $selected_se_q_pending.=",".$ticket_id;
            executive::where('executive_id','=',$prev_alloted_exec_id)->update(['query_pending'=>$put_query_pending, 'query_transferred'=>$put_query_transferred]);
            executive::where('executive_id','=',$select_se->executive_id)->update(['query_pending'=>$selected_se_q_pending, 'query_assigned'=>$selected_se_q_assigned]);
            tickets::where('ticket_id',$ticket_id)->update(['assigned_to'=>$select_se->executive_id,'status'=>'assigned','query_transfer'=>'True']);
            $ticket=tickets::where('ticket_id',$ticket_id)->first();
            $se=User::where('id',$select_se->executive_id)->first();
            Mail::to($se->email)->send(new PassQueryMail($ticket,$se));
            TicketsController::assign_waiting_task();
            $tickets= tickets::where('assigned_to','=',Auth::user()->id)->get();
            return redirect('/executive/assigned_tasks')->with(['tickets'=>$tickets,'success'=>'Issue is transferred Successfully']);
        }
        else
        {
            $tickets= tickets::where('assigned_to','=',Auth::user()->id)->get();
            return redirect('/executive/assigned_tasks')->with(['tickets'=>$tickets, 'fail'=>'No Seniour Executive Found']);
        }    
    }

    public function checkStatus(Request $request){
        $ticket_id = $request->ticket_id;
        $ticket = tickets::where('ticket_id','=',$ticket_id)->first();
        if($ticket){
            return back()->with('success',$ticket);
        }else
            return back()->with('msg','No such Ticket Found. Please recheck the Ticket #'); 
        
    }
}
