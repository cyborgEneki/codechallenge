<html>
<head></head>
<body style="background: black; color: white">
<h1>Hi {{ $user->first_name }}</h1>
<br>
<p>Welcome to the magical world of books. Before you access the system to indulge, keep your account safe by changing your password.</p>
<p>Your default password is {{ $user->password}}. To change this, Visit eproject.club/login and click "Forgot/Change password" button then follow the instructions.</p>
<h3>Rules and Guidelines:</h3>
<ul>
    <li>The maximum number of books you are allowed to borrow is 3</li>
    <li>The maximum duration that you are allowed to hold a book is 2 weeks</li>
    <li>If a book you desire is borrowed, you may reserve it on the system. This will allow the system to send you an email as soon as it is returned. However, kindly note that it will be made available to other users as soon as this email is sent. You are advised to borrow it in the system as soon you receive the email and collect it from HR within 3 days.</li>
</ul>
<br>
<p>Happy reading!</p>
<br>
<p>Kind regards,</p>
<p>{{ config('app.name') }} Bot</p>
</body>
</html>