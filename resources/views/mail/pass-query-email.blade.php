<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Passing Query Mail</title>
</head>
<body>
    {{-- enter the message body by fetching itfrom the backend --}}
    <h4>Hello, {{$exe_name}} (Senior Executive)</h4>
    <h4>You have received this mail bacause the Junior Executive has transfered the below Query (Ticket #{{$ticket_id}}) to you!!!  </h4>
    <p>
        Author Name - {{$first_name}} {{$last_name}} <br>
        <u>Email - {{$email}}</u>
        <div class="container"><i>{{ $mess }}</i></div>
    </p>
    <p>This is system generated mail. Do not Reply</p>
</body>
</html>