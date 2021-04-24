<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <title>Mahiara Add Executive | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin/styles.css" />
  </head>
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
                    <select name="executive">
                      <option value="executive" selected>Junior</option>
                      <option value="senior">Senior</option>
                    </select>
                </div>
              </div>
              <div class="eachline">
                <div class="eachinputbox full_input">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="role" placeholder="Role">
                </div>
              </div>
              <div class="eachline">
                <div class="eachinputbox full_input">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="role_id" placeholder="Role Id">
                </div>
              </div>
              <button  type="submit" name="add_submit_submit" class="primary-btn">Add Executive</button>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>