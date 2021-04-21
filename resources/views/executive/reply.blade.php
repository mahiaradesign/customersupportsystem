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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Solve Issues | Executive Panel</title>
    <link rel="stylesheet" href="/css/executive/styles.css" />
  </head>
  <body>
    <div class="topline">
      <div class="title-button-box">
        <button class="back"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
        <h1 class="main-title">Solve Issues</h1>
        <a href="#"><button class="main-btn">Pass to Senior Executive <i class="fa fa-angle-double-right" aria-hidden="true"></i></button></a>
      </div>

      {{-- Added the stats of executive --}}
      @include('executive.stats')
    </div>
        <div class="task-box reply-main-box">
          <div class="query-box">
            <h3>Customer's Message</h3>
            <div class="mess-eachline">
              <p class="name">Name</p>
              <p class="value">Rahul Sah</p>
            </div>
            <div class="mess-eachline">
              <p class="name">Email</p>
              <p class="value">abc@def.com</p>
            </div>
            <div class="mess-eachline">
              <p class="name">Message with Ticket_Id #{{ $id }}</p>
              <div class="query-mess-box">
                <p>Lorem ipsum dolor sit 
                  amet consectetur adipisicing elit. Illo quos maxime 
                  quo laborum nulla itaque! Excepturi mollitia repudiandae tenetur
                  totam nihil eius quidem laborum? Blanditiis eum veniam deleniti 
                  harum hic!Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Illo quos maxime quo laborum nulla itaque! Excepturi mollitia 
                  repudiandae tenetur totam nihil eius quidem laborum? Blanditiis 
                  eum veniam deleniti harum hic!Lorem ipsum dolor sit amet consectetur
                  adipisicing elit. Illo quos maxime quo laborum nulla itaque!
                  Excepturi mollitia repudiandae tenetur totam nihil eius quidem
                  laborum? Blanditiis eum veniam deleniti harum hic!Lorem ipsum
                  dolor sit amet consectetur adipisicing elit. Illo quos maxime 
                  quo laborum nulla itaque! Excepturi mollitia repudiandae tenetur 
                  totam nihil eius quidem laborum? Blanditiis eum veniam deleniti harum hic!</p>
              </div>
            </div>
          </div>
          <div class="reply-box">
            @if($message=Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($message=Session::get('fail'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3>Your Message</h3>
            <form method="POST" action="{{ route('executive.sendEmail.ticket_id', ['ticket_id' => $id ])}}">
            @csrf
            <div class="mess-eachline">
              <p class="name">Exective Email</p>
              <input class="value" name="from" value="{{Auth::user()->email}}" placeholder="{{Auth::user()->email}}"/> 
            </div>
            <div class="mess-eachline">
              <p class="name">Reply</p>
              <textarea name="reply_message" class="query-mess-box" spellcheck="false" autofocus></textarea>
            </div>
            <button type="submit" class="main-btn">SEND MESSAGE</button>
          </form>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
