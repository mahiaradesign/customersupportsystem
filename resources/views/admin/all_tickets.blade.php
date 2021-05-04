@include('admin.adminhead', ['title' => "All Tickets",'autorefresh'=>90])
  <body>
    @include('admin.navbar')
    <div class="topline">
      <h1 class="main-title">All Tickets</h1>
    </div>
        <div class="task-box">
          @if(count($tickets))
            <table class="table table-bordered table-striped">
              <thead class="table-dark">
                <th>TICKET ID</th>
                <th>Name</th>
                <th>Message</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Executive</th>
              </thead>
              <tbody>
                {{-- tickets that are asigned to logged in execuitve is shown here  --}}
                @foreach($tickets as $ticket)
                    @php $dt = "#".$ticket->ticket_id; @endphp
                  <tr>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target={{$dt}}>
                        #{{$ticket->ticket_id}}
                      </button></td>
                    <td>{{$ticket->first_name}} {{$ticket->last_name}}</td>
                    <td>
                    @if(strlen($ticket->message)>80)
                      {{substr($ticket->message,0,80)."..."}}
                    @else
                      {{$ticket->message}}
                    @endif
                    </td>
                    <td>{{date('d/m/y h:i a', strtotime($ticket->created_at))}}</td>
                    @php $exe=DB::table('users')->where('id','=',$ticket->assigned_to)->first(); @endphp
                    @if( $ticket->status === 'assigned')
                        <td><button class="btn btn-warning" disabled>ASSIGNED</button></td>
                        @if($exe->name)
                            <td>{{$exe->name}}</td>
                        @endif
                    @elseif($ticket->status === 'solved')
                        <td><button class="btn btn-success" disabled>SOLVED</button></td>
                        @if($exe->name)
                            <td>{{$exe->name}}</td>
                        @endif
                    @else
                        <td><button class="btn btn-danger" disabled>WAITING</button></td>
                        <td>Not Yet Assigned</td>
                    @endif
                  </tr>
                  <!-- Modal -->
                    <div class="modal fade" id={{$ticket->ticket_id}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="formbox resultbox">
                                    <h3>Live Status</h3>
                                    <div class="statusbox">
                                        <div class="eachstatus">
                                            <p>Submitted</p>
                                        </div>
                                        <span class="bg"></span>
                                        <div class="eachstatus">
                                            <p>Assigned</p>
                                        </div>
                                        <span class="bg"></span>
                                        <div class="eachstatus">
                                            <p>Solved</p>
                                        </div>
                                    </div>
                                    @php
                                        $exec= DB::table('users')->where('id',$ticket->assigned_to)->first();
                                    @endphp
                                    <div class="details">
                                        <div class="eachline">
                                            <p class="name">Ticket ID :</p>
                                            <p class="value main">#{{$ticket->ticket_id}}</p>
                                        </div>
                                        <div class="eachline">
                                            <p class="name">Messsage :</p>
                                            <p class="value message">{{$ticket->message}}</p>
                                        </div>
                                        @if($ticket->status =="waiting")
                                            <div class="eachline">
                                                <p class="name">Status :</p>
                                                <p class="value">No Executive Assigned</p>
                                            </div>
                                        @else
                                            <div class="eachline">
                                                <p class="name">Status :</p>
                                                <p class="value">{{$ticket->status}}</p>
                                            </div>
                                            <div class="eachline">
                                                <p class="name">Assigned To :</p>
                                                <p class="value">{{$exec->name}}</p>
                                            </div>

                                            @php $response = DB::table('responses')->where('ticket_id',$ticket->ticket_id)->first(); @endphp
                                            <div class="eachline">
                                                <p class="name">Response :</p>
                                                @if($response)
                                                    <p class="value message">{{$response->response}}</p>
                                                @else
                                                    <p class="value message">No Response Yet</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <script>
                                        const status="{{$ticket->status}}";
                                        const status_arr=["waiting","assigned","solved"]
                                        const status_box=document.querySelectorAll(".eachstatus")
                                        const status_line=document.querySelectorAll(".bg")
                                        for(var i=0;i<=status_arr.indexOf(status);i++)
                                        {
                                            status_box[i].classList.add("active")
                                            status_box[i].innerHTML='<i class="fa fa-check-circle" aria-hidden="true"></i>'+status_box[i].innerHTML;
                                            if(i>0)
                                                status_line[i-1].classList.add("active")
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>

                @endforeach
              </tbody>
            </table>
          @else
            {{-- Showing Error When no tickets assigned  --}}
            <div class="alert alert-danger" role="alert">
              No Tickets Sent by the Customers (Be Happy!!!)
            </div>
          @endif
        </div>
    <script src="/js/admin/all_executive.js"></script>
</body>
</html>