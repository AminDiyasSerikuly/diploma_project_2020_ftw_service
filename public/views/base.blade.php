<!DOCTYPE html>
<html>
<head>
    @section('title')
    @show
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @section('metatags')
    @show
    <link rel="icon" sizes="192x192" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/appleicon.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css?1') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/common.css?34') }}"  media="screen,projection"/>
    @if(Agent::isMobile())
    <link type="text/css" rel="stylesheet" href="{{ asset('css/responsive.css?99') }}"/>
    @endif
    @section('headlink')
    @show
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142852768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-142852768-1');
    </script>-->
</head>
<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#" data-target="mobile-web" class="sidenav-trigger"><i class="material-icons grey-text">menu</i></a>
                <a href="/" class="brand-logo">
                    <img src="{{ asset('svg/logoname.svg') }}"/>
                </a>
                <ul class="leftNavLinks" style="color:#FFFFFF;">
                    @if(Agent::isDesktop())
                    <li>
                        <a href="{{ route('contenttasks') }}">Найти задания</a>
                    </li>
                    @endif
                </ul>
                <ul class="right hide-on-med-and-down">
                    @guest
                    <li>
                        <a href="{{ route('login') }}" class="tooltipped" data-position="bottom" data-tooltip="Вход или регистрация">
                            <i class="material-icons left">account_circle</i> Личный кабинет
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="/my" class="_dropdownjs-ctf" data-target="_nav--profile">
                            <div class="_nav--avatar">
                                <img class="user-min-profile-photo" src="/images/noavatar.png"/>
                            </div>
                        </a>
                    </li>
                 <ul id="_nav--profile" class="dropdown-content sml">
                    <li><a href="/my">Моя страница</a></li>
                    <li><a href="/my/tasks">Мои задания</a></li>
                    <li><a href="@if(App\Profile::getUserMessageId(Auth::user()->id)!='') {{ route('chat', App\Profile::getUserMessageId(Auth::user()->id)) }} @else {{ route('chat',0) }} @endif">Мои сообщения</a></li>
                    <li class="divider"></li>
                    <li><a href="/my/settings#substr">Подписка на задания</a></li>
                    <li class="divider"></li>
                    <li><a href="/my/edit">Редактировать</a></li>
                    <li><a href="/my/settings">Настройки</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout" class="grey-text" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
                @endif
                <li class="hidden--home">
                    <a href="{{ route('newtask',['cat'=>'techrepair','subcat'=>'techrepairother']) }}" class="green _creat-button-navbar white-text">
                        <i class="material-icons left">add_circle_outline</i> Создать задание
                    </a>
                </li>
                <li>
                    <a href="#" class="_dropdownjs-ctf tooltipped" data-target="h-dropdown-more" data-covertrigger="false" data-position="bottom" data-tooltip="Еще"><i class="material-icons">more_vert</i></a>
                </li>
                <ul id="h-dropdown-more" class="dropdown-content sml">
                    <li class="hide"><a href="/about">О сервисе</a></li>
                    <li><a href="https://help.orzu.org/help-center">Поддержка</a></li>
                    <li><a href="/privacy">Защита данных</a></li>
                    <li class="divider hide"></li>
                    <li class="hide"><a href="@if(Config::get('app.locale')!='ru') {{ route('lang','ru') }} @else {{ route('lang','en') }} @endif">Язык: Русский</a></li>
                </ul>
            </ul>
        </div>
    </nav>
    @if(Agent::isMobile())
    <ul class="sidenav" id="mobile-web">
        @guest
        <li><a href="/login"><i class="material-icons">person</i>Войти в кабинет</a></li>
        <li class="divider nomargin--t"></li>
        <li><a href="/home" class="green-text"><i class="material-icons">add</i>Добавить задание</a></li>
        <li><a href="/tasks"><i class="material-icons">done</i>Найти задания</a></li>
        @else
        <li>
            <div class="user-view">
                <div class="background blue lighten-2"></div>
                <a href="/my"><img class="circle" src="/images/noavatar.png"></a>
                <a href="/my"><span class="white-text name">{{ \Auth::User()->name }}</span></a>
                <a href="/my"><span class="white-text email">{{ \Auth::User()->phone }}</span></a>
            </div>
        </li>
        <li><a href="/home" class="green-text"><i class="material-icons green-text">add</i>Добавить задание</a></li>
        <li><a href="/tasks"><i class="material-icons">done</i>Найти задания</a></li>
        <li class="divider nomargin--t"></li>
        <li><a href="/my"><i class="material-icons">person</i>Моя страница</a></li>
        <li><a href="/my/tasks"><i class="material-icons">cloud</i>Мои задания</a></li>
        <li><a href="/message"><i class="material-icons">chat</i>Мои сообщения</a></li>
        <li class="divider nomargin--t"></li>
        <li><a href="/my/settings#substr">Подписка на задания</a></li>
        <li class="divider nomargin--t"></li>
        <li><a href="/my/edit"><i class="material-icons">edit</i>Редактировать</a></li>
        <li><a href="/my/settings"><i class="material-icons">settings</i>Настройки</a></li>
        <li class="divider nomargin--t"></li>
        <li><a href="/logout" class="grey-text" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endif
        <li class="divider nomargin--t"></li>
        <li><a href="https://help.orzu.org/help-center/categories/1/orzu">Как пользоваться?</a></li>
        <li><a href="https://help.orzu.org/help-center">Поддержка</a></li>
    </ul>
    @endif

    @section('header')
    @show
</header>
@section('content')
@show
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/common.js?791') }}"></script>
@section('footlink')
@show
<script>
  window.intercomSettings = {
    app_id: "p479kps8",
    @auth
    name: "{{ Auth::User()->name }}",
    email: "{{ Auth::User()->email }}",
    user_id: "{{ Auth::User()->id }}"
    @endauth
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/p479kps8';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
</body>
</html>