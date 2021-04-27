@include('includes.htmlhead')
    @if($email = Session::get('email'))
    <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-success"><i class="fa fa-globe" aria-hidden="true"></i> Login Success</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="mb-0">Welcome {{$email}}</p>
              <p class="mb-0">You are online.</p>
            </div>
          </div>
        </div>
      </div>
    @endif
    <div class="container">
        <h1>You are successfully logged in!{{auth()->user()->name}} </h1>

        <h4>All The Executive Staff Inside here</h4>
   </div>
   
    <div class="redirect_link">
        <a href="{{route('executive.assigned_tasks')}}">Assigned Tasks</a>
        <a href="{{route('logout')}}">Logout</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script>
        var myModal = new bootstrap.Modal(document.querySelector('#myModal'))
        document.querySelector("#myModal button").addEventListener("click",function(){myModal.hide()})
        setTimeout(function(){
            myModal.show()
        },1000)
    </script>
@include('includes.htmlend')