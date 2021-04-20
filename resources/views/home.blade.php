@include('includes.htmlhead')
@include('includes.navbar')
    @if($email = Session::get('email'))
    <?php 
    echo "<script>alert('Welcome, $email ')</script>";
    ?>
    @endif
    <div class="container">
        <h1>You are successfully logged in! </h1>
   </div>
   
    <div class="redirect_link">
        <a href="{{route('executive.assigned_tasks.id', ['id' => Session::get('id') ])}}">Assigned Tasks</a>

        <a href="{{route('logout')}}">Logout</a>
    </div>

@include('includes.footer')
@include('includes.htmlend')