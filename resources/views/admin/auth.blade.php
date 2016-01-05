<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Вход в панель управления</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/styles.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/fonts.css') }}" />
</head>
<body class="auth">
	<div id="auth" class="login-block">
		<div>
			<div class="logo"><span><b>Панель</b>Управления</span></div>
			<div class="body">
				<form  method="POST" action="login">
					<div class="inline-block">
						<div class="field login">
							<input type="text" name="email" placeholder="E-Mail">
							<i class="fa fa-at"></i>
						</div>
						<div class="field password">
							<input type="password" name="password" placeholder="Пароль">
							<input type="hidden" name="_token" value="{!! csrf_token() !!}">
							<i class="fa fa-lock"></i>
						</div>
					</div>
					<div class="inline-block">
						<input class="auth-submit" type="submit" name="login" value="Войти">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>