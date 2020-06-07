<div class="window-size-wrap" style="display:none;">
    <div class="referral-wrap container row">
        <div class="close"></div>
        <div class="block col xl12 l12 m12 s12">
            <a href="#" class="download"></a>
        </div>
    </div>
</div>
    <header>
        <nav style="background-color: white;">
            <div class="nav-wrapper home__header" style="background:transparent;background-color:unset">
                <a href="#" data-target="mobile-web" class="sidenav-trigger"><i class="material-icons grey-text">menu</i></a>
                <a href="/" class="brand-logo">
                    <img src="{{ asset('images/logoNew.png') }}"/>
                </a>
                <ul class="leftNavLinks">
                    @if(Agent::isDesktop())
                    <li>
                        <a href="{{ route('contenttasks') }}">Найти задачу</a>
                    </li>
                    @endif
                </ul>
                <ul class="right hide-on-med-and-down">
                    @guest
                    <li><a href="/login">Войти</a></li>
                    <li><a href="/register">Регистрация</a></li>

                    <li style="margin-right:1rem;"><a href="{{ route('login') }}" class="tooltipped tooltipped2" data-position="bottom" data-tooltip="Вход или регистрация">Личный кабинет</a></li>

                    @else
                    <li>
                        <a href="/my" class="_dropdownjs-ctf" data-target="_nav--profile">
                            <div class="_nav--avatar">
                                <img class="user-min-profile-photo" src="{{App\Profile::getUserAvatar(Auth::user()->id)}}"/>
                            </div>
                            {{App\Profile::getUserName(Auth::user()->id)}}
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
                    <li>
                        <a href="/my/pusher" class="_dropdownjs-ctf" data-target="_nav--pusher">
                           <i class="material-icons">notifications</i>
                       </a>
                   </li>
                   <div id="_nav--pusher" class="dropdown-content sml OrzuPusher">
                    <div class="--header">
                        <div class="left">
                            <span class="--title">Уведомления</span>
                        </div>
                        <div class="right">
                            <span class="hide">
                                <a href="/my/pusher">Все</a>
                                <span class="--splitted veralmidd">•</span>
                            </span>
                            <a href="/my/settings#notifications"><i class="material-icons veralmidd">settings</i></a>
                        </div>
                    </div>
                    <div class="--content">
                        {{App\OrzuPusher\PushNotification::UserNotifiesList(Auth::user()->id)}}
                    </div>
                </div>
                <li>
                    <a href="/my/balance" class="tooltipped" data-position="bottom" data-tooltip="Мой кошелек">
                       <i class="material-icons">account_balance_wallet</i>
                   </a>
               </li>

               @endif
{{--                    Changed 25.12--}}
{{--               <li class="hidden--home">--}}
{{--                <a href="{{ route('newtask',['cat'=>'techrepair','subcat'=>'techrepairother']) }}" class="_creat-button-navbar green-text tooltipped" data-position="bottom" data-tooltip="Добавить задание">--}}
{{--                    <i class="material-icons">add_circle</i>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--                        to--}}

                        <li style="margin-right:1rem;" class="hidden--home">
                            <a href="{{ route('newtask',['cat'=>'techrepair','subcat'=>'techrepairother']) }}
                                    " class="tooltipped tooltipped2 customized-task-addition" data-position="bottom" data-tooltip="Добавить задание">Создать заявку
                            </a>
                        </li>

                        {{--                        end--}}
            <li style="margin-left:1rem;">
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
        <div class="user-view" style="display: flex;
    justify-content: space-around;">
            <div class="background orange lighten-2"></div>
            <a href="/my"><img class="circle" src="{{ Auth::User()->avatar }}"></a>
            <div>
                <a href="/my"><span class="black-text name">{{ \Auth::User()->name }}</span></a>
                <a href="/my"><span class="black-text email">{{ \Auth::User()->phone }}</span></a>
            </div>
        </div>
    </li>
    <li><a href="/tasks/new" class="orange-text"><i class="material-icons orange-text">add</i>Добавить задание</a></li>
    <li><a href="/tasks"><i class="material-icons">done</i>Найти задания</a></li>
    <li class="divider nomargin--t"></li>
    <li><a href="/my"><i class="material-icons">person</i>Моя страница</a></li>
    <li><a href="/my/tasks"><i class="material-icons">cloud</i>Мои задания</a></li>
{{--     <li><a href="/message"><i class="material-icons">chat</i>Мои сообщения</a></li> --}}
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
  window.intercomSettings = {pp_id: "p479kps8",@auth name: "{{ Auth::User()->name }}",email: "{{ Auth::User()->email }}",user_id: "{{ Auth::User()->id }}"@endauth};
  (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/p479kps8';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
