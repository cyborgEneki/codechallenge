<html>

<head></head>

<body style="background: black; color: white">

    <h1>Hi {{ $book->reservor()->get()->pluck("first_name")->first() }} !</h1>
    <br>
    <p>Your patience has been rewarded! {{ $book->title }} has just been returned. You may now borrow it.</p>
    <p>Remember that you may only borrow a maximum of 3 books at a time for 2 weeks.</p>
    <br>
    <p>Kind regards,</p>
    <p>{{ config('app.name') }} Bot</p>
</body>

</html>