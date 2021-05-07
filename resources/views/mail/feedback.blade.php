<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback for Mahiara</title>
</head>
<body>
    {{-- enter the message body by fetching itfrom the backend --}}
    <h3> Your Feedback is Valuable to us </h3>
    <h4>Tap on the button below or click on the link and share your feedback with us.</h4>
    <a href="{{route('feedback.ticket_id', ['ticket_id' => $ticket_id ])}}"><button>Click Here To Give Feedback</button></a>
    <a href="{{route('feedback.ticket_id', ['ticket_id' => $ticket_id ])}}"></a>
    <h4>We are feedback only for the purpose of enhancing our customer experience.</h4>
    <p>This is system generated mail. Do not Reply</p>
</body>
</html>