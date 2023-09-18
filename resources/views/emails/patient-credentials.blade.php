<!DOCTYPE html>
<html>
<head>
    <title>Your Login Credentials for vsahha.com</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>Your login credentials are as follows:</p>
    <p>Email: {{ $user->email }}</p>
    <p>Password: {{ $password }}</p>
    <p>You can use these credentials to log in to your account at vsahha.com.</p>
</body>
</html>