<html>
<head></head>
<body style="background: black; color: white">
<h1>Hi {{ $name }}</h1>
<p>Kindly note that you have a book that is just about overdue. In case you have forgotten, kindly log into the system to confirm which one it is.</p>
<br>
<p>Remember that you may only borrow a maximum of 3 books at a time for 2 weeks.</p> 
<p>Failure to adhere to return the book within 3 days of your due date will lead to suspension from the library services for 3 months.</p>
<br>
<p>Kind regards,</p>
<p>{{ config('app.name') }} Bot</p>
</body>
</html>