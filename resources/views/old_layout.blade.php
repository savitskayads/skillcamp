<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/styles.css') }}" />--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/fonts.css') }}" />--}}
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
<header>
    <div class="wrap">
        <div class="line clear">
            <div id="menu-1" class="content-list menu">
                <div class="item"><a href="#" title=""><span>Главная</span></a></div>
                <div class="item"><a href="#" title=""><span>Участникам</span></a></div>
                <div class="item"><a href="#" title=""><span>О нас</span></a></div>
                <div class="item"><a href="#" title=""><span>Галерея</span></a></div>
                <div class="item"><a href="#" title=""><span>Родителям</span></a></div>
                <div class="item"><a href="#" title=""><span>Агентствам</span></a></div>
                <div class="item"><a href="#" title=""><span>Новости</span></a></div>
                <div class="item"><a href="#" title=""><span>Отзывы</span></a></div>
                <div class="item"><a href="#" title=""><span>Друзья</span></a></div>
                <div class="item"><a href="#" title=""><span>Контакты</span></a></div>
            </div>
        </div>
        <div class="line clear">
            <div class="bar-left clear">
                <div class="social-links">
                    <a href="#" class="vk"><i class="fa fa-fw fa-vk"></i></a>
                    <a href="#" class="in"><i class="fa fa-fw fa-instagram"></i></a>
                    <a href="#" class="fb"><i class="fa fa-fw fa-facebook"></i></a>
                    <a href="#" class="ok"><i class="fa fa-fw fa-odnoklassniki"></i></a>
                </div>
                <div class="feedback"><span>Заказать звонок</span></div>
            </div>
            <div class="bar-right clear">
                <div id="search" class="search">
                    <form>
                        <input type="text" name="query" placeholder="Поиск" class="inputbox">
                        <div class="submit" onclick="$(this).parent('form').submit()"><i class="fa fa-search"></i></div>
                    </form>
                </div>
                <div class="userblock">
                    @if(Auth::check())
                        <div class="login">
                            <a href="{{web_url()}}/user">Личный кабинет</a>
                            <a href="{{web_url()}}/logout">Выйти</a>
                        </div>
                    @else
                        <div class="login">
                            <a href="{{web_url()}}/user/login">Войти на сайт</a>
                            <a href="{{web_url()}}/auth/register">Регистрация</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="bar-center">
                <div class="contacts">
						<span class="fa-stack">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-at fa-stack-1x fa-inverse"></i>
						</span>
                    <span class="text">info@skillcamp.ru</span>
						<span class="fa-stack">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
						</span>
                    <span class="text">+7 (495) 943-79-25</span>
						<span class="fa-stack">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
						</span>
                    <span class="text">+7 (495) 973-14-28</span>
                </div>
            </div>
        </div>
    </div>
</header>

@yield('content')

<footer>
    <div class="wrap">
        <div class="bar-left">
            <div class="logo"><img src="" alt=""></div>
            <div class="copyright">
                <div class="sitename">
                    <span class="desc">Детский лагерь навыка</span>
                    <span class="name">Skill Camp</span>
                </div>
                <div class="copy">&copy; 2004-2015. Все права защищены.</div>
            </div>
        </div>
        <div class="bar-right">
            <div class="social-links">
                <a href="#" class="vk"><i class="fa fa-vk"></i></a>
                <a href="#" class="in"><i class="fa fa-instagram"></i></a>
                <br>
                <a href="#" class="fb"><i class="fa fa-facebook"></i></a>
                <a href="#" class="ok"><i class="fa fa-odnoklassniki"></i></a>
            </div>
            <div class="dev">
                <a href="#" title="Разработка и продвижение сайта - Агентство сирена"><img src="img/sirene.png" alt="Агентство сирена"></a>
            </div>
        </div>
        <div class="bar-center clear">
            <div class="contacts">
                <span>141200, РФ Московская область, Пушкинский р-н гп Лесной ул. Гагарина, дом 6, офис 29, Молодежный центр ФРВИ</span>
            </div>
            <div class="contacts">
                <span>Тел.: </span>
                <span>E-mai:</span>
                <span>ICQ:</span>
            </div>
        </div>
    </div>
</footer>
</body>
</html>