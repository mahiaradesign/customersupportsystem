@include('admin.adminhead', ['title' => "Add Executive"])
  <body class="flex">
    <section class="mainarea">
        <div class="imgbox">
            <img src="/images/add_executive.png" alt="login-img">
        </div>
        <div class="formbox">
            <h3><i class="fa fa-user-plus" aria-hidden="true"></i> ADD EXECUTIVE</h3>

            <!-- In case of any error -->

            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($message = Session::get('fail'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Error ends -->


            <form action="{{route('add_exe')}}" method="post">
              @csrf
              <div class="eachline">
                <div class="eachinputbox full_input">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="name" placeholder="Name">
                </div>
              </div>
              <div class="eachline">
                <div class="eachinputbox full_input">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" name="email" placeholder="Email">
                </div>
              </div>

              <div class="eachline">
                <div class="eachinputbox full_input">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>
              </div>
              
              <div class="eachline">
                <div class="eachinputbox full_input">
                <i class="fa fa-users" aria-hidden="true"></i>
                    <select name="position">
                      <option value="executive" selected>Junior</option>
                      <option value="senior">Senior</option>
                    </select>
                </div>
              </div>
              <button  type="submit" name="add_submit_submit" class="primary-btn">Add Executive</button>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@include('admin.adminend')