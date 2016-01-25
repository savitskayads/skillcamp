<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    Спасибо за регистрацию на skillcamp.ru!
    Пожалуйста, передите по ссылке для подтверждения Вашего e-mail
    {{ URL::to( 'register/verify/' . $confirmation_code) }}.<br/>

</div>

</body>
</html>