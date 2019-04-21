<html>

<head>
    <style>
        .mail-top-bar {
            background-color: #F5F8FA;
            font-size: larger;
            font-family: sans-serif;
            padding-top: 30px;
            text-align: center;
            padding-bottom: 30px;
        }

        .mail-body {
            font-family: sans-serif;
            padding: 30px;
            font-size: 14px;
        }

        .email-body {
            padding-left: 100px;
            padding-right: 100px;
            padding-top: 20px;
        }
    </style>
</head>

<body class="mail-body">
    <h1 class="mail-top-bar">Cybrary</h1>
    <div class="email-body">
        <h2>Hi {{ $reservorName }}!</h2>
        <br>
        <p>Your patience has been rewarded! {{ $book->title }} has just been returned. You are now the registered borrower.</p>
        <p>Remember that you may only borrow a maximum of 3 books at a time for 2 weeks. Your two weeks start today. Kindly pick up the book from HR.</p>
        <br>
        <div>
            <p>Kind regards,</p>
            <p>{{ config('app.name') }} Bot</p>
        </div>
    </div>
</body>
</html>