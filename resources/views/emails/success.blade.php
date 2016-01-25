<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Успех!</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/fonts.css') }}" />
</head>
<body class="auth">
<div id="auth" class="login-block">
    <div>
        <div class="body">
            Ваш email подтвержден!
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function(){
        location="{{web_url()}}/";
    }, 5000);
</script>
</body>
</html>