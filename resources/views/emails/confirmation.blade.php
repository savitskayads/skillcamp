@extends('layout')
@section('content')
<body class="auth">
<div id="auth" class="login-block">
    <div>
        <div class="login-form">
            Спасибо за регистрацию! Вам на электронную почту поступило письмо с ссылкой для подтвержения.<br>
            Через 5 секунд Вы будете перенаправлены на главную страницу.</br>
            Если этого не произошло   <a href="{{web_url()}}/" class="btn btn-primary">нажмите сюда :)</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function(){
        location="{{web_url()}}/";
    }, 5000);
</script>
@stop