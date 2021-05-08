@php
  use App\Models\executive;
  $exec_id=Auth::user()->id;
  $exec_data= executive::where('executive_id',$exec_id)->first();

  // Calculating the number of queries Sent to seniour 
  if($exec_data->query_transferred!="none")
    $query_transferred=count(explode(',', $exec_data->query_transferred));
  else
    $query_transferred=0;

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
  if($exec_data->rating!="none")
  {
    $rating_arr=explode(',', $exec_data->rating);
    $sum=0;
    foreach ($rating_arr as $each_rating) {
      $sum+=$each_rating;
    }
    $rating=$sum/count($rating_arr);
  }
  else
    $rating=0;

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
      <p class="value">{{$query_transferred}}</p>
    </div>
    <div class="eachline">
      <p class="name">Rating:</p>
      <p class="value">{{number_format($rating,1)}} <i class="fa fa-star" aria-hidden="true"></i></p>
    </div>
  </div>