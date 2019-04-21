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

        .rules-and-guidelines {
            padding-left: 50px;
            padding-right: 80px;
            text-align: justify;
        }

        .number-color {
            color: #01B2B2;
        }
    </style>
</head>

<body class="mail-body">
    <h1 class="mail-top-bar">Cybrary</h1>
    <div class="email-body">
        <h2>Hi Admin!</h1>
            <p>Below are the statistics for the past week ({{ $properTo }} - {{ $properDt }}):</p>
            <div class="rules-and-guidelines">
                <ol>
                    <li>
                        Total number of users who were suspended this week is <span class="number-color">{{ $suspendedUsers }}</span>
                    </li>
                    <br>
                    <li>
                        Total number of books that were borrowed this week is <span class="number-color">{{ $booksBorrowed }}</span>
                    </li>
                    <br>
                    <li>
                        Total number of books that were returned this week is: <span class="number-color">{{ $booksReturned }}</span>
                    </li>
                    </ul>
            </div>
    </div>
</body>

</html>