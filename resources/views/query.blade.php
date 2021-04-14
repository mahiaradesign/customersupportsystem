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
    <title>Mahiara Query</title>
    <link rel="stylesheet" href="/css/styles.css" />
  </head>
  <body>
    <section class="query">
        <div class="imgbox">
            <img src="/images/hero_mail.svg" alt="mail-img">
        </div>
        <div class="formbox">
            <h3>SEND US A MAIL</h3>
            <form action="query.html" method="POST">
                <div class="eachline">
                    <input type="text" class="half_input left" name="first_name" placeholder="First Name">
                    <input type="text" class="half_input right" name="last_name" placeholder="Last Name">
                </div>
                <div class="eachline">
                    <input type="email" class="full_input" name="email" placeholder="Email">
                </div>
                <div class="eachline">
                   <textarea name="message" rows="7" placeholder="Enter your message"></textarea>
                </div>
                <button  type="submit" name="querysubmit" class="primary-btn">SEND MESSAGE</button>
            </form>
        </div>
    </section>
    </body>
</html>

{{-- I have written the htmlhead,navbar,footer,htmlend just include those files in this page --}}
