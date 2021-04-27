@php
  use App\Models\executive;
  $exec_id=Auth::user()->id;
  $exec_data= executive::where('executive_id',$exec_id)->first();

  // Calculating the number of queries Assigned 
  if($exec_data->query_assigned!="none")
    $query_assigned=count(explode(',', $exec_data->query_assigned));
  else
    $query_assigned=0;

  // Calculating the number of queries pending 
  if($exec_data->query_pending!="none")
    $query_pending=count(explode(',', $exec_data->query_pending));
  else
    $query_pending=0;

  // Calculating the number of queries solved 
  if($exec_data->query_solved!="none")
    $query_solved=count(explode(',', $exec_data->query_solved));
  else
    $query_solved=0;
  
  // Calculating the number of queries sent to seniour 
  $query_sent=$query_assigned-($query_solved+$query_pending);
  
@endphp

<div class="stats-box">
    <h4>YOUR STATS</h4>
    <div class="eachline">
      <p class="name">Name:</p>
      <p class="value">{{Auth::user()->name}}</p>
    </div>
    <div class="eachline">
      <p class="name">Issues Pending:</p>
      <p class="value">{{$query_pending}}</p>
    </div>
    <div class="eachline">
      <p class="name">Issues Solved:</p>
      <p class="value">{{$query_solved}}</p>
    </div>
    <div class="eachline">
      <p class="name">Issues Sent to SE:</p>
      <p class="value">{{$query_sent}}</p>
    </div>
    <div class="eachline">
      <p class="name">Rating:</p>
      <p class="value">{{number_format($exec_data->rating,1)}} <i class="fa fa-star" aria-hidden="true"></i></p>
    </div>
  </div>