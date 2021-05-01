@include('includes.htmlhead')
    <div class="container">
        <h1>You are successfully logged in!{{auth()->user()->name}} </h1>
        <h4>All The Executive Staff Inside here</h4>
   </div>
    <div class="redirect_link">
        <a href="{{route('executive.assigned_tasks')}}">Assigned Tasks</a>
        <a href="{{route('logout')}}">Logout</a>
    </div>
@include('includes.htmlend')