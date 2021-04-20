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
    <link
      href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@500&display=swap"
      rel="stylesheet"
    />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Mahiara Executive Login</title>
    <link rel="stylesheet" href="css/executive/styles.css" />
  </head>
  <body class="flex">
    <section class="mainarea">
        <div class="imgbox">
            <img src="/images/hero_login.svg" alt="login-img">
        </div>
        <div class="formbox">
            <h3><i class="fa fa-shield" aria-hidden="true"></i> EXECUTIVE LOGIN</h3>
            
            {{-- styling required here --}}
            @if(session()->has('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>{{ session()->get('error') }}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" name="myForm">
              @csrf
              <div class="eachline">
                <div class="eachinputbox full_input">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Username" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="eachline">
                <div class="eachinputbox full_input">
                  <i class="fa fa-lock" aria-hidden="true"></i>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <label class="container checkbox">Remember Me
                  <input type="checkbox" name="remember_me" value="1">
                  <span class="checkmark"></span>
                </label>
              
                <button type="submit" class="primary-btn">
                  {{ __('SECURE LOGIN') }}
                </button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </section>
  </body>
</html>
