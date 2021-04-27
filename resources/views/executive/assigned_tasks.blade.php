@include('executive.executivehead', ['title' => "All Tasks"])
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
              </thead>
              <tbody>
                {{-- tickets that are asigned to logged in execuitve is shown here  --}}
                @foreach($tickets as $ticket)
                  <tr>
                    <td>#{{$ticket->ticket_id}}</td>
                    <td>{{$ticket->first_name}} {{$ticket->last_name}}</td>
                    <td>{{$ticket->message}}</td>
                    <td>{{$ticket->created_at}}</td>

                    @if( $ticket->status === 'assigned')
                      <td><a href="{{route('executive.reply.ticket_id', ['ticket_id' => $ticket->ticket_id ])}}"><button class="btn btn-primary">REPLY</button></a></td>
                    @else
                      <td><button class="btn btn-success" disabled>SOLVED</button></td>
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
        <script src="/js/executive/assigned_task.js"></script>
  </body>
</html>
