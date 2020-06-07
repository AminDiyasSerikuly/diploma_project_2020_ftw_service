@extends('base')
@section('title')
@foreach($tasks as $t)
<title>{{ $t->task }}</title>
@endforeach
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/tasks-post.css?10') }}"/>
<script src="https://api-maps.yandex.ru/2.1/?load=Geolink&lang=ru_RU&apikey=de1573d4-733f-4120-a6ee-bed95f339276
" type="text/javascript"></script>
@endsection
@section('content')
<div class="container --general">
    <div class="row">
        <div class="col m8 s12 --general-t" id="taskdetail">
            <div class="main">
                <div class="row nomargin">
                    <div class="col m12 s12">
                        <!--details-->
                        @foreach($tasks as $t)
                        <div class="white brd4 --general-t-detail">
                            <div class="--title">
                                <h6 class="nomargin">{{ $t->task }}</h6>
                                <span>@if(Agent::isDesktop()) @if($t->status==0) {!! '<strong class="green-text">Актуально</strong>' !!} @else {!! '<strong class="orange-text">Закрыто</strong>' !!} @endif  | @endif {{ $t->created_date }} | номер задания: {{ $t->id }}</span>
                            </div>
                            <div class="--detail">
                                @if($t->address!='')
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Адрес
                                    </div>
                                    <div class="--detail-t">
                                        {!! $t->address !!}
                                    </div>
                                </div>
                                @endif
                                @if($t->start_date_s!='')
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Начать
                                    </div>
                                    <div class="--detail-t">
                                        {{ $t->start_date_s }}
                                    </div>
                                </div>
                                @endif
                                @if($t->end_date!='')
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Завершить
                                    </div>
                                    <div class="--detail-t">
                                        {{ $t->end_date }}
                                    </div>
                                </div>
                                @endif
                                @if($t->bujet!='')
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Бюджет
                                    </div>
                                    <div class="--detail-t">
                                        {{ $t->bujet }}
                                    </div>
                                </div>
                                @endif
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Оплата
                                    </div>
                                    <div class="--detail-t">
                                        Напрямую исполнителю
                                    </div>
                                </div>
                                @if($t->narrative!='')
                                <div class="--detail-b --wht">
                                    <div class="--detail-q">
                                        Нужно
                                    </div>
                                    <div class="--detail-t">
                                        {{ $t->narrative }}
                                    </div>
                                </div>
                                @endif
                                @if($t->files!='')
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Файлы
                                    </div>
                                    <div class="--detail-t">
                                        {!! $t->files !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <!--/details-->
                        <!--ApplyTask-->
                        @if(Auth::check())
                        @if(Auth::user()->id!=$t->user_id)
                        <div class="OrzuApplyTaskActionBlock">
                            <div class="OrzuApplyTaskAction">
                                @if($t->bujet!='Предложите цену')
                                <span class="OrzuNoBudjet">заказчик заплатит до <strong>{{ $t->bujet }}</strong></span>
                                @else
                                <span class="OrzuNoBudjet">заказчик предлагает <strong>указать цену Вам</strong></span>
                                @endif
                            </div>
                            @if(App\Tasks::getTaskRequestUser($t->id, Auth::user()->id)>0)
                            <div class="center-align OrzuApplyTaskButtonDone">
                                <span class="nomargin green-text">Вы уже добавили предложение!</span>
                            </div>
                            @else
                            <div class="row nomargin--b">
                                <div class="col m12">
                                    <a href="#action-modal" class="OrzuApplyTaskButton modal-trigger waves-effect waves-light green">
                                        Добавить предложение <i class="material-icons veralmidd">done_all</i>
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                        @endif
                        <!--/ApplyTask-->
                        <!--offers-->
                        @guest
                        @if(App\Tasks::getTaskRequestCount(Request::segment(3)))
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> Всего откликов: <strong>{{ App\Tasks::getTaskRequestCount(Request::segment(3)) }}</strong>
                            </h6>
                        </div>
                        @else
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы оставить свой отклик!
                            </h6>
                        </div>
                        @endif
                        @else
                        @foreach(App\Tasks::getTaskRequestGet(Request::segment(3)) as $tr)
                        <div class="green lighten-5 brd4 --general-t-offers">
                            <div class="--select-offer">
                                <h6 class="nomargin green-text">Выбранное предложение</h6>
                                <div class="--offer">
                                    <div class="--sum grey lighten-4">{{ $tr->amount }} {{ $tr->current }}</div>
                                    <a href="/profile/{{ $tr->user_id }}" target="_blank">
                                        <img src="/images/noavatar.png" class="circle"/>
                                    </a>
                                    <div class="--name"><a href="/profile/{{ $tr->user_id }}" target="_blank">{{ App\Profile::getUserName($tr->user_id) }}</a></div>
                                    <div class="--badges hide">награды</div>
                                    <div class="--descript">{{ $tr->narrative }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> Всего откликов: <strong>{{ App\Tasks::getTaskRequestCount(Request::segment(3)) }}</strong>
                            </h6>
                        </div>
                        @foreach(App\Tasks::getTaskRequest(Request::segment(3)) as $tr)
                        <div class="white brd4 --general-t-offers">
                            <div class="--offer">
                                <div class="--sum grey lighten-4">{{ $tr->amount }} {{ $tr->current }}</div> 
                                @if(Auth::check())                                       
                                @if(Auth::user()->id==$tr->user_id)
                                <a href="/my" target="_blank">
                                    <img src="/images/noavatar.png" class="circle"/>
                                </a>
                                <div class="--name"><a href="/my" target="_blank">{{ App\Profile::getUserName($tr->user_id) }}</a></div>
                                @else
                                <a href="/profile/{{ $tr->user_id }}" target="_blank">
                                    <img src="/images/noavatar.png" class="circle"/>
                                </a>
                                <div class="--name"><a href="/profile/{{ $tr->user_id }}" target="_blank">{{ App\Profile::getUserName($tr->user_id) }}</a></div>
                                @endif
                                @else
                                <a href="/profile/{{ $tr->user_id }}" target="_blank">
                                    <img src="/images/noavatar.png" class="circle"/>
                                </a>
                                <div class="--name"><a href="/profile/{{ $tr->user_id }}" target="_blank">{{ App\Profile::getUserName($tr->user_id) }}</a></div>
                                @endif
                                <div class="--badges hide">награды</div>
                                <div class="--descript">{{ $tr->narrative }}</div>
                                @if(\Auth::check())
                                @if(\Auth::user()->id==$t->user_id)
                                <div class="--divider">
                                    <div class="--divider-br"></div>
                                </div>
                                <div class="--action center-align">
                                    <button onclick="location.href='{{ route('selreq',$tr->id) }}'" class="btn bdr4 waves-effect waves-light green">Выбрать исполнителя</button>
                                    <button class="btn bdr4 waves-effect waves-light blue _dropdownjs" data-target="__js-offer-options-id1">
                                        <i class="material-icons">more_horiz</i>
                                    </button>
                                    <ul id="__js-offer-options-id1" class="dropdown-content sml">
                                        <li><a href="#" class="blue-text">Посмотреть отзывы</a></li>
                                        <li><a href="#" class="red-text">Пожаловаться</a></li>
                                    </ul>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!--/offers-->
                    </div>
                </div>
            </div>
        </div>

        @if(Agent::isDesktop())
        <!--sidebar-->
        @foreach($tasks as $t)
        <div class="col m4 s12 l4 --general-t --siderbar">
            <div class="--group --author">
                <a href="/profile/{{ $t->user_id }}" target="_blank">
                    <img src="/images/noavatar.png" alt="{{ App\Profile::getUserName($t->user_id) }}" class="circle"/>
                </a>
                @if(Auth::check())
                @if(Auth::user()->id==$t->user_id)
                <span class="--username"><a href="/my" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                @else
                <span class="--username"><a href="/profile/{{ $t->user_id }}" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                @endif
                @else
                <span class="--username"><a href="/profile/{{ $t->user_id }}" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                @endif
                <span>Автор этого задания</span>
                @if(Auth::check())
                @if(Auth::user()->id==$t->user_id)
                <span class="--rev"><a href="/my" target="_blank">Посмотреть отзывы</a></span>
                @else
                <span class="--rev"><a href="/profile/{{ $t->user_id }}" target="_blank">Посмотреть отзывы</a></span>
                @endif
                @else
                <span class="--rev"><a href="/profile/{{ $t->user_id }}" target="_blank">Посмотреть отзывы</a></span>
                @endif
            </div>
            <div class="--group --share-btns">
                <div class="collection brd4 boxsh sml">
                    <a href="#contacts-modal" class="collection-item blue-text modal-trigger">Посмотреть контакты <i class="material-icons">person</i></a>
                    @if(Auth::check())
                    @if(Auth::user()->id==$t->user_id)
                    <a href="#!" class="collection-item orange-text">Редактировать задание <i class="material-icons">edit</i></a>
                    @if($t->status=='0')
                    <a href="/tasks/update/{{ $t->id }}/done" class="collection-item red-text">Остановить задачу</a>
                    @else
                    <a href="/tasks/update/{{ $t->id }}/nodone" class="collection-item green-text">Возобновить задачу</a>
                    @endif
                    @endif
                    @endif
                </div>
                <div class="__share">
                    <span>Поделиться заданием <i class="material-icons">share</i></span>
                    <div class="__socials">
                        <a href="//vk.com/share.php?url={{ url()->current() }}" target="_blank"><i class="__vk"></i></a>
                        <a href="//facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="__fb"></i></a>
                        <a href="//twitter.com/intent/tweet?url={{ url()->current() }}&via=itsmaqsud" target="_blank"><i class="__tw"></i></a>
                        <a href="//linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank"><i class="__in"></i></a>
                        <a href="//connect.ok.ru/offer?url={{ url()->current() }}" target="_blank"><i class="__ok"></i></a>
                        <a href="#" data-socialcopylink="thishref">
                            <i class="__cplink tooltipped" data-position="bottom" data-tooltip="Скопировать ссылку"></i>
                        </a>
                        <input type="text" value="{{ url()->current() }}" id="__jsHrefCopy"/>
                    </div>
                </div>
            </div>
            @if(Auth::check())
            @if(Auth::user()->id=='2' || Auth::user()->id=='190' || Auth::user()->id=='377')
            <div class="--group --share-btns">
                <div class="collection with-header sml brd4 boxsh nomargin">
                    <div class="collection-header"><h6>Опции сотрудника</h6></div>
                    @if($t->status=='0')
                    <a href="/tasks/update/{{ $t->id }}/done" class="collection-item red-text">Остановить задачу</a>
                    @else
                    <a href="/tasks/update/{{ $t->id }}/nodone" class="collection-item green-text">Возобновить задачу</a>
                    @endif
                    @if($t->user_phone!='')
                    <a href="#" class="collection-item blue-text">Номер задачи: <b class="right">{{ $t->user_phone }}</b></a>
                    @endif
                    @if($t->user_email!='')
                    <a href="#" class="collection-item blue-text">Email задачи: <b class="right">{{ $t->user_email }}</b></a>
                    @endif
                    @if($t->city!='')
                    <a href="#" class="collection-item blue-text">Город задачи: <b class="right">{{ $t->city }}</b></a>
                    @endif
                </div>
            </div>
            @endif
            @endif

        </div>
        @endforeach
        <!--/sidebar-->
        @endif

    </div>
</div>

@auth
<!--modal action-->
<div id="action-modal" class="modal">
    <div class="modal-content">
        <h6 class="title">Добавить предложение к заданию</h6>
        <div class="row">
            <form method="POST" action="/tasks/request/add">
                @csrf
                <div class="sect">
                    <a href="#" class="_dropdownjs link2 right" data-target="tpl-dropdown">Использовать шаблон</a>
                    <ul id="tpl-dropdown" class="dropdown-content sml">
                        <li><a href="#!" class="grey-text">Нет готовых шаблонов</a></li>
                        <li class="divider" tabindex="-1"></li>
                        <li><a href="/my/settings?act=tpl" target="_blank" class="green-text"><i class="material-icons">add</i>Создать шаблон</a></li>
                    </ul>
                </div>
                <div class="input-field col m12">
                    <textarea id="desc" name="narrative" class="materialize-textarea" placeholder="Опишите свой опыт, свои плюсы, подход к работе." required></textarea>
                    <input type="hidden" name="task_id" value="{{ Request::segment(3) }}">
                    <label for="desc">Текст предложения</label>
                </div>
                <div class="col m12 s12">
                    <h6 class="nomargin">Стоимость вашей работы</h6>
                    <span class="grey-text">Заказчик указал стоимость — {{ $t->bujet }}</span>
                    <span class="red-text _acthelper hide">Цена задания не может быть ниже 100</span>
                </div>
                <div class="col m3 s12">
                    <div class="OrzuApplyTaskAmount">
                        <input placeholder="Введите цену" id="_act-inputsum" type="text" name="amount" maxlength="5" class="nomargin OrzuApplyTaskAmountInput center-align" value="">
                        <span class="OrzuApplyTaskAmountCurrent">
                            {{ App\Profile::getUserParam('user_current') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Отмена</a>
            <button type="submit" class="modal-close waves-effect waves-light btn-flat green white-text">Предложить</button>
        </form>
    </div>
</div>
<!--/modal action-->
@endif

<!--modal contacts-->
<div id="contacts-modal" class="modal">
    <div class="modal-content">
        <h6>Контакты заказчика</h6>
        <div class="__cnt center-align">
            @forelse(App\Tasks::getTaskRequestGet(Request::segment(3)) as $tr)
            @if(Auth::check())
            @if(Auth::user()->id==$tr->user_id)
            <p class="grey-text">Контакты заказчика видны только Вам.</p>
            @if($t->user_phone!='')
            <p><i class="material-icons veralmidd">phone</i> <span class="veralmidd">{{ $t->user_phone }}</span></p>
            @endif
            @if($t->user_email!='')
            <p><i class="material-icons veralmidd">email</i> <span class="veralmidd">{{ $t->user_email }}</span></p>
            @endif
            <p class="grey-text nomargin--b">так же Вы можете написать <a href="{{ route('chat', $t->id) }}">личное сообщение</a> заказчику.</p>
            @else
            <p class="grey-text">Контакты заказчика Вам недоступны.</p>
            @endif
            @else
            <p class="grey-text">Контакты заказчика Вам недоступны.</p>
            @endif
            @empty
            <p class="grey-text">Контакты заказчика Вам недоступны.</p>
            @endforelse
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Закрыть</a>
    </div>
</div>
<!--/modal contacts-->
@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/tasks-post.js') }}"></script>
@endsection