@include('executive.executivehead', ['title' => "All Tasks",'autorefresh'=>90])
  <body>
    @include('executive.navbar')
    <div class="topline">
      <h1 class="main-title">Assigned Task</h1>
      @include('executive.stats')
    </div>

        <div class="task-box">
          @if(count($tickets))
            <table class="table table-bordered table-striped">
              <thead class="table-dark">
                <th>TICKET ID</th>
                <th>Name</th>
                <th>Message</th>
                <th>Date & Time</th>
                <th>Respond</th>
                <th>Feedback</th>
              </thead>
              <tbody>
                {{-- tickets that are asigned to logged in execuitve is shown here  --}}
                @foreach($tickets as $ticket)
                  <tr>
                    <td>#{{$ticket->ticket_id}}</td>
                    <td>{{$ticket->first_name}} {{$ticket->last_name}}</td>
                    <td>
                    @if(strlen($ticket->message)>80)
                      {{substr($ticket->message,0,80).".....(more)"}}
                    @else
                      {{$ticket->message}}
                    @endif
                    </td>
                    <td>{{date('d/m/y h:i a', strtotime($ticket->created_at))}}</td>

                    @if( $ticket->status === 'assigned')
                      <td><a href="{{route('executive.reply.ticket_id', ['ticket_id' => $ticket->ticket_id ])}}"><button class="btn btn-primary">REPLY</button></a></td>
                      <td>NOT YET SOLVED</td>
                    @else
                      <td><button class="btn btn-success" disabled>SOLVED</button></td>
                      @php $fdbk = DB::table('feedback')->where('ticket_id', $ticket->ticket_id)->first(); @endphp
                      @if (! $fdbk)
                        <td><a href="{{route('sendFeedbackLink.ticket_id', ['ticket_id' => $ticket->ticket_id ])}}" class="btn btn-primary">ASK</a></td>
                      @else
                        <td><button class="btn btn-success" disabled>RECORDED</button></td>
                      @endif
                      
                    @endif

                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            {{-- Showing Error When no tickets assigned  --}}
            <div class="alert alert-danger" role="alert">
              No Tickets Assigned Yet
            </div>
          @endif
        </div>

        {{-- If got success --}}
        @if($message=Session::get('success'))
         <div class="popup success">
          <i class="fa fa-check-circle main-icon" aria-hidden="true"></i>
          <p>{{$message}}</p>
          <i class="fa fa-times close" aria-hidden="true"></i>
        </div>
      @endif

      {{-- If got Failure --}}
      @if($message=Session::get('fail'))
       <div class="popup danger">
          <i class="fa fa-exclamation-circle main-icon" aria-hidden="true"></i>
          <p>{{$message}}</p>
          <i class="fa fa-times close" aria-hidden="true"></i>
        </div>
      @endif
      
        <script src="/js/executive/assigned_task.js"></script>
  </body>
</html>
