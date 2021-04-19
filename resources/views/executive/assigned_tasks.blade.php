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
    <title>Assigned Task | Executive Panel</title>
    <link rel="stylesheet" href="/css/executive/styles.css" />
  </head>
  <body>
    <div class="topline">
      <h1 class="main-title">Assigned Task</h1>
      @include('executive.stats')
    </div>
        <div class="task-box">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <th>TICKET ID</th>
              <th>Name</th>
              <th>Message</th>
              <th>Date</th>
              <th>Time</th>
              <th>Respond</th>
            </thead>
            <tbody>
              <tr>
                <td>#425334</td>
                <td>Rahul Sah</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ipsam reiciendis suscipit voluptas n...</td>
                <td>20 Jan 2020</td>
                <td>12:20 AM</td>
                <td><a href="#"><button class="btn btn-success">REPLY</button></a></td>
              </tr>
              <tr>
                <td>#425334</td>
                <td>Rahul Sah</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ipsam reiciendis suscipit voluptas n...</td>
                <td>20 Jan 2020</td>
                <td>12:20 AM</td>
                <td><button class="btn btn-success" disabled>SOLVED</button></td>
              </tr>
              <tr>
                <td>#425334</td>
                <td>Rahul Sah</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ipsam reiciendis suscipit voluptas n...</td>
                <td>20 Jan 2020</td>
                <td>12:20 AM</td>
                <td><button class="btn btn-danger" disabled>SENT TO SE</button></td>
              </tr>
              <tr>
                <td>#425334</td>
                <td>Rahul Sah</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ipsam reiciendis suscipit voluptas n...</td>
                <td>20 Jan 2020</td>
                <td>12:20 AM</td>
                <td><a href="#"><button class="btn btn-success">REPLY</button></a></td>
              </tr>
              <tr>
                <td>#425334</td>
                <td>Rahul Sah</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ipsam reiciendis suscipit voluptas n...</td>
                <td>20 Jan 2020</td>
                <td>12:20 AM</td>
                <td><a href="#"><button class="btn btn-success">REPLY</button></a></td>
              </tr>
              <tr>
                <td>#425334</td>
                <td>Rahul Sah</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ipsam reiciendis suscipit voluptas n...</td>
                <td>20 Jan 2020</td>
                <td>12:20 AM</td>
                <td><a href="#"><button class="btn btn-success">REPLY</button></a></td>
              </tr>
              <tr>
                <td>#425334</td>
                <td>Rahul Sah</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam ipsam reiciendis suscipit voluptas n...</td>
                <td>20 Jan 2020</td>
                <td>12:20 AM</td>
                <td><button class="btn btn-danger" disabled>SENT TO SE</button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <script src="/js/executive/assigned_task.js"></script>
  </body>
</html>
