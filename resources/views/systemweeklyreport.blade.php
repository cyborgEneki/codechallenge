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
        <h2>Hi Admin!</h1>
            <div>
                Total number of suspended users for this week is: {{ $suspendedUsers }}
            </div>
            <div>
                Total number of borrowed books for this week is: {{ $booksBorrowed }}
            </div>
            <div>
                Total number of returned books for this week is: {{ $booksReturned }}
            </div>
    </div>
</body>

</html>