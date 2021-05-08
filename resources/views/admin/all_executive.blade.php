@include('admin.adminhead',['title'=>"All Executive"]);
<body>
  @include('admin.navbar')
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
              <th>Last Seen</th>
              <th>Rating</th>
              <th>Query Assigned</th>
              <th>Query Solved</th>
              <th>Query Pending</th>
              <th>Joined</th>
            </thead>
            <tbody>
            @foreach ($exec_data as $eachdata)
                <tr>

                {{-- Showing ID of executive  --}}
                <td>#{{$eachdata->id}}</td>

                {{-- Showing Name of executive  --}}
                <td>{{$eachdata->name}}</td>

                {{-- Showing Email of executive  --}}
                <td>{{$eachdata->email}}</td>

                {{-- Showing Position of executive  --}}
                <td>{{$eachdata->position}}</td>

                {{-- Showing Status of executive  --}}
                @if(Cache::get('user-is-online-' . $eachdata->id))
                <td class="online">{{$eachdata->status}}</td>
                @else
                <td class="offline">{{$eachdata->status}}</td>
                @endif

                <td>{{ \Carbon\Carbon::parse($eachdata->last_seen)->diffForHumans() }}</td>
                
                {{-- Showing Rating  --}}
                <td style="min-width:5rem">@php
                    if($eachdata->rating!="none")
                    {
                      $rating_arr=explode(',', $eachdata->rating);
                      $sum=0;
                      foreach ($rating_arr as $each_rating) {
                        $sum+=$each_rating;
                      }
                      $rating=$sum/count($rating_arr);
                      echo number_format($rating,2);
                    }
                    else
                      echo 0;
                @endphp <i class="fa fa-star star" aria-hidden="true"></i></td>
                
                {{-- Showing Query Assigned  --}}
                <td>
                @php
                    if($eachdata->query_assigned!="none")
                      echo count(explode(',', $eachdata->query_assigned));
                    else
                      echo 0;
                @endphp
                </td>

                {{-- Showing Query Solved  --}}
                <td>
                @php
                    if($eachdata->query_solved!="none")
                      echo count(explode(',', $eachdata->query_solved));
                    else
                      echo 0;
                @endphp
                </td>

                {{-- Showing Query Pending  --}}
                <td>
                @php
                    if($eachdata->query_pending!="none")
                      echo count(explode(',', $eachdata->query_pending));
                    else
                      echo 0;
                @endphp
                </td>

                {{-- Showing Join Date  --}}
                <td>{{date('d-m-Y h:i a', strtotime($eachdata->created_at))}}</td> 
              </tr>
            @endforeach
            </tbody>
          </table>
        @else
        {{-- Showing Error When no executive found  --}}
        <div class="alert alert-danger" role="alert">
          No Executive Found
        </div>
        @endif
        </div>
        <script src="/js/admin/all_executive.js"></script>

@include('admin.adminend')
