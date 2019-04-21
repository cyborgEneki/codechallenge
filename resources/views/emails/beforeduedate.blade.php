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
        <h2>Hi {{ $name }}</h2>
        <p>Kindly note that you have a book that is just about due. In case you have forgotten, kindly log into the system to
            confirm which one it is.</p>
        <br>
        <p>Remember that you may only borrow a maximum of 3 books at a time for 2 weeks.</p>
        <p>Failure to adhere to the borrowing timelines will lead to suspension from the library services for 3 months.</p>
        <br>
        <div>
            <p>Kind regards,</p>
            <p>{{ config('app.name') }} Bot</p>
        </div>
    </div>
</body>

</html>