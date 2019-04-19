<html>
<head></head>
<body style="background: black; color: white">
<h1>Hi {{ $name }}</h1>
<p>Kindly note that that your book is overdue by more than 3 days. Thus, you have been suspended from borrowing for 3 months.</p>
<p>Kindly return the book as soon as possible.</p> 
<br>
<p>Kind regards,</p>
<p>{{ config('app.name') }} Bot</p>
</body>
</html>