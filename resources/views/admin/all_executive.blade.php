@include('admin.adminhead',['title'=>"All Executive"]);
  <body>
    <div class="topline">
      <h1 class="main-title">All Executives</h1>
    </div>
        <div class="task-box">
        @if (count($exec_data))
            <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Position</th>
              <th>Status</th>
              <th>Rating</th>
              <th>Query Assigned</th>
              <th>Query Solved</th>
              <th>Query Pending</th>
              <th>Joined</th>
            </thead>
            <tbody>
            @foreach ($exec_data as $eachdata)
                <tr>
                <td>#{{$eachdata->id}}</td>
                <td>{{$eachdata->name}}</td>
                <td>{{$eachdata->email}}</td>
                <td>{{$eachdata->position}}</td>
                @if($eachdata->status=="online")
                    <td class="online">{{$eachdata->status}}</td>
                @else
                  <td class="offline">{{$eachdata->status}}</td>
                @endif
                <td>{{$eachdata->rating}} <i class="fa fa-star star" aria-hidden="true"></i></td>
                <td>{{count(explode(',', $eachdata->query_assigned))}}</td>
                <td>{{count(explode(',', $eachdata->query_solved))}}</td>
                <td>{{count(explode(',', $eachdata->query_pending))}}</td>
                <td>{{date('d-m-Y h:i a', strtotime($eachdata->created_at))}}</td> 
              </tr>
              
            @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-danger" role="alert">
          No Executive Found
        </div>
        @endif
        </div>
        <script src="/js/admin/all_executive.js"></script>

@include('admin.adminend')
