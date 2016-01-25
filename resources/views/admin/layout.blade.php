<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Панель управления</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/datetimepicker.css') }}" />
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript"  src="{{ asset('admin_assets/js/jquery.datetimepicker.js') }}" ></script>
    <script type="text/javascript"  src="{{ asset('admin_assets/js/script.js') }}"></script>

</head>
<body>
<header>
    <div class="clear">
        <div id="logo"><a href="{{web_url()}}/admin" title="На главную"><span><b>MSGroup</b> Technology</span></a></div>
        <div class="profile">
            <div class="name">
                <span><i class="fa pull-left fa-user"></i>{!! Auth::user()->name  !!}</span>
                <div class="controls">
                    <div>
                        <ul>
                            <li><a href="{{web_url()}}/admin/changepass">Изменить пароль</a></li>
                            <li><a href="?do=history">История</a></li>
                            <li><a href="logout">Выйти</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="wrapper" class="wrapper clear">
    <div id="menu" class="menu-panel">
        <ul>
            <li @if(Request::segment(2)=='programs') class="active" @endif><a href="{{web_url()}}/admin/programs"><i class="fa pull-left fa-graduation-cap"></i>Программы лагеря</a></li>
            <li @if(Request::segment(2)=='news') class="active" @endif><a href="{{web_url()}}/admin/news"><i class="fa pull-left fa-bullhorn"></i>Новости</a></li>
            <li><a href="?do=events"><i class="fa pull-left fa-users"></i>Пользователи</a></li>
        </ul>
    </div>
@yield('content')
</div>
</body>
</html>