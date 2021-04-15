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
            <form action="/executive_login" method="POST" name="myForm">
              <div class="eachline">
                <div class="eachinputbox full_input">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="username" placeholder="Username">
                    <span class="error" name="user_error"></span>
                </div>
              </div>
              <div class="eachline">
                <div class="eachinputbox full_input">
                  <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" name="password" placeholder="Password">
                    <span class="error" name="pass_error"></span>
                </div>
                <label class="container checkbox">Remember Me
                  <input type="checkbox" checked>
                  <span class="checkmark"></span>
                </label>
              </div>
                <button  type="submit" name="executive_login_submit" class="primary-btn">SECURE LOGIN</button>
            </form>
        </div>
        <script src="/js/executive/executive_login.js"></script>
    </section>
  </body>
</html>
