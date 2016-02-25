<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fonts.css') }}" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/jquery.cover.js')}}"></script>


</head>
<body>

<header>
    <div class="content wrap">
        <div class="logo"><img src="{{web_url()}}/img/logo.svg" alt="Логотип Skillcamp - Детский лагерь навыка"></div>
        <div class="social-links">
            <div class="content-list">
                <div class="item vk"><a href=""><span><i class="fa fa-fw fa-vk"></i></span></a></div>
                <div class="item in"><a href=""><span><i class="fa fa-fw fa-instagram"></i></span></a></div>
                <div class="item fb"><a href=""><span><i class="fa fa-fw fa-facebook"></i></span></a></div>
                <div class="item ok"><a href=""><span><i class="fa fa-fw fa-odnoklassniki"></i></span></a></div>
            </div>
        </div>
        <div class="search">
            <form>
                <input type="text" name="query" placeholder="Поиск" class="inputbox">
                <div class="submit" onclick="$(this).parent('form').submit()"><i class="fa fa-search"></i></div>
            </form>
        </div>
        <div class="profile">
            @if(Auth::check())
                <div class="link"><a href="{{web_url()}}/user"><span>личный кабинет</span></a></div>
                <div class="link"><a href="{{web_url()}}/logout"><span>выход</span></a></div>
            @else
                <div class="link"><a href="{{web_url()}}/auth/register"><span>регистрация</span></a></div>
                <div class="link"><a href="{{web_url()}}/user/login"><span>вход</span></a></div>
            @endif
        </div>
    </div>
</header>
<div class="block seasons">
    <div class="content wrap">
        <div class="content-list clear">

                <div class="item winter active">
                    <div class="content clear">
                        <span><a href="{{web_url()}}/programs/winter">Зима</a></span>
                    </div>
                </div>

            <div class="item spring">
                <div class="content clear">
                    <span><a href="{{web_url()}}/programs/spring">Весна</a></span>
                </div>
            </div>
            <div class="item summer">
                <div class="content clear">
                    <span><a href="{{web_url()}}/programs/summer">Лето</a></span>
                </div>
            </div>
            <div class="item autumn">
                <div class="content clear">
                    <span><a href="{{web_url()}}/programs/autumn">Осень</a></span>
                </div>
            </div>
            <div class="item weekend">
                <div class="content clear">
                    <span><a href="{{web_url()}}/programs/weekend">Выходной день</a></span>
                </div>
            </div>
            <div class="item festival">
                <div class="content clear">
                    <span><a href="{{web_url()}}/programs/festival">Фестиваль</a></span>
                </div>
            </div>
            <div class="item all">
                <div class="content clear">
                    <span><a href="{{web_url()}}/programs/all">Все сезоны</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block menu">
    <div class="content wrap">
        <div class="content-list">
            <div class="item"><a href="{{web_url()}}/"><span>Главная</span></a></div>
            <div class="item"><a href=""><span>Участникам</span></a></div>
            <div class="item"><a href=""><span>О нас</span></a></div>
            <div class="item"><a href=""><span>Галерея</span></a></div>
            <div class="item"><a href=""><span>Родителям</span></a></div>
            <div class="item"><a href=""><span>Агенствам</span></a></div>
            <div class="item"><a href="{{web_url()}}/news/1"><span>Новости</span></a></div>
            <div class="item"><a href=""><span>Отзывы</span></a></div>
            <div class="item"><a href=""><span>Друзья</span></a></div>
            <div class="item"><a href=""><span>Контакты</span></a></div>
        </div>
    </div>
</div>
<div id="slider" class="slider clear">
    <div class="content-list clear">
        <div class="item">
            <div class="image"></div>
            <div class="content">
                <div class="wrap">
                    <div class="text">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="stock">
    <div class="bg"></div>
    <div class="content wrap">

    </div>
</div>
@yield('content')
<div class="news block">
    <div class="head wrap"><span>Новости</span></div>
    <div class="content wrap">
        <div class="content-list clear">
            @foreach($all_news as $news)
                <div class="item">
                    <div class="content">
                        <div class="image">
                            @if($news->image == '')
                                <div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" alt="" width="340" height="127"></div>
                            @else
                                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $news->image }}" alt="" width="340" height="127"></div>
                            @endif
                        </div>
                        <div class="head"><a href="{{web_url()}}/news/{{$news->id}}"><span>{{ $news->title }}</span></a></div>
                        <div class="text">
                            <span>{{ $news->description }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<footer>
    <div class="content wrap clear">
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
                <div class="content-list">
                    <div class="item vk"><a href=""><span><i class="fa fa-fw fa-vk"></i></span></a></div>
                    <div class="item in"><a href=""><span><i class="fa fa-fw fa-instagram"></i></span></a></div>
                    <div class="item fb"><a href=""><span><i class="fa fa-fw fa-facebook"></i></span></a></div>
                    <div class="item ok"><a href=""><span><i class="fa fa-fw fa-odnoklassniki"></i></span></a></div>
                </div>
            </div>
            <div class="dev">
                <a href="#" title="Разработка и продвижение сайта - Агентство сирена"><img src="{{web_url()}}/img/sirene.png" alt="Агентство сирена"></a>
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