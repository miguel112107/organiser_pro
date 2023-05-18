<!DOCTYPE html>
<html>
<head>
    <title>EventOrganizerPro.com</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>Please visit https://www.EventOrganizerPro.com/login/{{['url_handle']}} and sign in with your email and the password provided below</p>
    <p>{{ $mailData['body'] }}</p>
     
    <p>Thank you</p>
</body>
</html>