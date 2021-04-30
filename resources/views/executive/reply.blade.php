@include('executive.executivehead', ['title' => "Solve Issue"])
  <body>
    @include('executive.navbar')
    <div class="topline">
      <div class="title-button-box">
        <a href="/executive/assigned_tasks/"><button class="back"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button></a>
        <h1 class="main-title">Solve Issues</h1>
        <a href="{{route('executive.pass_query.ticket_id', ['ticket_id' => $query_data->ticket_id ])}}"><button class="main-btn">Pass to Senior Executive <i class="fa fa-angle-double-right" aria-hidden="true"></i></button></a>
      </div>

      {{-- Added the stats of executive --}}
      @include('executive.stats')
    </div>
        <div class="task-box reply-main-box">
          <div class="query-box">
            <h3>Customer's Message</h3>
            <div class="mess-eachline">
              <p class="name">Name</p>
              <p class="value">{{$query_data->first_name." ".$query_data->last_name}}</p>
            </div>
            <div class="mess-eachline">
              <p class="name">Email</p>
              <p class="value">{{$query_data->email}}</p>
            </div>
            <div class="mess-eachline">
              <p class="name">Ticket ID</p>
              <p class="value">#{{$query_data->ticket_id}}</p>
            </div>
            <div class="mess-eachline">
              <p class="name">Message</p>
              <div class="query-mess-box">
                <p>{{$query_data->message}}</p>
              </div>
            </div>
          </div>
          <div class="reply-box">
            @if($message=Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($message=Session::get('fail'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3>Your Message</h3>
            <form method="POST" action="{{ route('executive.sendEmail.ticket_id', ['ticket_id' => $query_data->ticket_id ])}}">
            @csrf
            <div class="mess-eachline">
              <p class="name">Your Name</p>
              <p class="value">{{Auth::user()->name}}</p>
            </div>
            <div class="mess-eachline">
              <p class="name">Reply</p>
              <textarea name="reply_message" class="query-mess-box" spellcheck="false" autofocus></textarea>
            </div>
            <button type="submit" class="main-btn">SEND MESSAGE</button>
          </form>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
