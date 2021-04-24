@include('includes.htmlhead')
    {{-- Modal Notification On Login --}}
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
              <p class="mb-0">Welcome {{auth()->user()->name}}</p>
              <p class="mb-0">You are online.</p>
            </div>
          </div>
        </div>
      </div>
      {{-- Modal Notification On Login Ends--}}

    <div class="redirect_link">
        <h1>Admin Panel</h1>
        <a href="/admin/add_executive">Add Executive</a>
        <a href="/admin/all_executive">All Executive</a>
        <a href="{{route('logout')}}">Logout</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script>
        var myModal = new bootstrap.Modal(document.querySelector('#myModal'))
        document.querySelector("#myModal button").addEventListener("click",function(){myModal.hide()})
        setTimeout(function(){
            myModal.show()
        },1000);
    </script>
@include('includes.htmlend')