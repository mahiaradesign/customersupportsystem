<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Response mail</title>
</head>
<body>
    {{-- enter the message body by fetching itfrom the backend --}}
    <h3> Response From Mahiara </h3>
    <h4>Hello, {{$first_name}} {{$last_name}}</h4>
    <h4>Your Query (Ticket #{{$ticket_id}})</h4>
    <div class="container">{{ $mess }}</div>
    <h4> has been received and our customer execuitive will contact you soon. </h4>
    <p>This is system generated mail. Do not Reply</p>
</body>
</html>