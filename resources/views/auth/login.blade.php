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
    <title>Mahiara Executive Login</title>
    <link rel="stylesheet" href="css/executive/styles.css" />
  </head>
  <body>
    <section class="mainarea">
        <div class="imgbox">
            <img src="/images/hero_login.svg" alt="login-img">
        </div>
        <div class="formbox">
            <h3><i class="fa fa-shield" aria-hidden="true"></i> EXECUTIVE LOGIN</h3>
            @if(session()->has('error'))
              <div class="alert alert-danger">
                  {{ session()->get('error') }}
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
                  <input type="checkbox" checked>
                  <span class="checkmark"></span>
                </label>
              <button type="submit" class="primary-btn">
                {{ __('SECURE LOGIN') }}
              </button>
            </form>
        </div>
        <script src="/js/executive/executive_login.js"></script>
    </section>
  </body>
</html>
