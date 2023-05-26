<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Recover your account</title>
    </head>
    <body>
        <p>Hello, {{ $userName }}!</p>
        <p>We have received a request to recover your password. If this was you, please click the following link to complete the process.</p>
        <a href="{{ $resetLink }}">Click here to recover your account.</a>
        <p>If this was not you, please log in quickly and change your password or contact us.</p>
        <p>Thank you,<br>The {{ config('app.name') }} Team.</p>
    </body>
</html>