<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{ env('APP_URL') }}</h2>
<br/>
<strong>Hi {{$user['name']}}.</strong>
Your registered email-id is {{$user['email']}}
</body>

</html>