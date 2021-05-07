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
                <th>Resolved In</th>
              </thead>
              <tbody>
                {{-- tickets that are asigned to logged in execuitve is shown here  --}}
                @foreach($tickets as $ticket)
                    @php $dt = "#".$ticket->ticket_id; @endphp

                    <tr>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" name="{{$ticket->ticket_id}}" data-target="{{$dt}}">
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
                                <td>Not Resolved</td>
                            @endif
                        @elseif($ticket->status === 'solved')
                            <td><button class="btn btn-success" disabled>SOLVED</button></td>
                            @if($exe->name)
                                <td>{{$exe->name}}</td>
                                <td>
                                    @php
                                        $response = DB::table('responses')->where('ticket_id',$ticket->ticket_id)->first();
                                        $start = Carbon\Carbon::parse($ticket->created_at);
                                        $end = Carbon\Carbon::parse($response->created_at);
                                        $hours = $end->diffForHumans($start);
                                        echo trim(trim($hours,'after'), 'before');
                                    @endphp
                                </td>
                            @endif
                        @else
                            <td><button class="btn btn-danger" disabled>WAITING</button></td>
                            <td>Not Yet Assigned</td>
                            <td>Not Resolved</td>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="{{$ticket->ticket_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ticket ID : #{{$ticket->ticket_id}}</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="ticket-modal">
                                        <h3>Live Status</h3>
                                        <div class="statusbox">
                                            <div class="eachstatus <?php if($ticket->status == 'waiting' || $ticket->status == 'assigned' || $ticket->status == 'solved' ) echo "active"; ?> ">
                                                <?php if($ticket->status == 'waiting' || $ticket->status == 'assigned' || $ticket->status == 'solved' ) echo "<i class='fa fa-check-circle' aria-hidden='true'></i>"; ?>
                                                <p>Submitted</p>
                                            </div>
                                            <span class="bg <?php if($ticket->status == 'assigned' || $ticket->status == 'solved') echo "active"; ?>"></span>
                                            <div class="eachstatus <?php if($ticket->status == 'assigned' || $ticket->status == 'solved') echo "active"; ?>">
                                                <?php if($ticket->status == 'solved' || $ticket->status == 'assigned'  ) echo "<i class='fa fa-check-circle' aria-hidden='true'></i>"; ?>
                                                <p>Assigned</p>
                                            </div>
                                            <span class="bg <?php if($ticket->status == 'solved') echo "active"; ?>"></span>
                                            <div class="eachstatus <?php if($ticket->status == 'solved') echo "active"; ?>">
                                                <?php if($ticket->status == 'solved'  ) echo "<i class='fa fa-check-circle' aria-hidden='true'></i>"; ?>
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
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>

                    </tr>
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
@include('admin.adminend')