<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Подтверждение электронной почты</title>
</head>
<body>
    <h1>Здравствуйте, {{$user->name}}!</h1>
    <p>Для подтверждения электронной почты, пожалуйста перейдите по следующей ссылке:</p>
    <br>
    <a href="{{url('/api/user/email/verify?token='.$user->verification_code)}}">Подтвердить почту</a>
    <br><br>
    <p>Время действия ссылки: 15 минут</p>
    <p>Если вы не запрашивали это письмо, просто проигнорируйте его.</p>
</body>
</html>
