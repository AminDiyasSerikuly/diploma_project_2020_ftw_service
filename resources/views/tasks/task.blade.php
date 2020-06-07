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
<link type="text/css" rel="stylesheet" href="{{ asset('css/header-normalize.css') }}"  media="screen,projection"/>
@endsection
@section('content')
    <div class="container --general">
        <div class="row">
            <div class="col m8 s12 --general-t" id="taskdetail">
                <div class="main">
                    <div class="row nomargin">
                        <div class="col m12 s12">
                            <!--details-->
                            {{--                        {!! $tasks !!}--}}
                            @foreach($tasks as $t)
                                <div class="  --general-t-detail">
                                    {{-- white brd4--}}
                                    <div class="--title">
                                        <h6 class="nomargin padding-15" style="font-weight: 600;">{{ $t->task }}</h6>

                                        @if($t->bujet!='')
                                            <div class="--detail-q tasks-price white padding-15" style="width: 100%;font-weight: 500;">
                                                {{-- <div class="--detail-q"> --}}
                                                   <h5> {{ $t->bujet }} </h5>
                                                {{-- </div> --}}
                                            </div>
                                        @endif


                                        <span>@if(Agent::isDesktop()) @if($t->status==0) {!! '<strong class="orange-text">Открыто</strong>' !!} @else {!! '<strong class="orange-text">Закрыто</strong>' !!} @endif &nbsp; &bull; &nbsp; @endif {{ $t->created_date }} &nbsp; &bull; &nbsp; номер задания: {{ $t->id }}</span>
                                    </div>
                                    <div class="--detail">

                                        @if($t->narrative!='')
                                            <div class="--detail-b --wht">
                                                <div class="--detail-q">
                                                    Описание
                                                </div>
                                                <div class="--detail-t">
                                                    {{ $t->narrative }}
                                                </div>
                                            </div>
                                        @endif


                                        

{{-- {{ $t->cat_parent_name }} --}}

                                        @if($t->cat_parent_name!='')
                                            <div class="--detail-b">
                                                <div class="--detail-q">
                                                    Категория
                                                </div>
                                                <div class="--detail-t">
                                                    {{ $t->cat_parent_name }}
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

                                        {{-- {{ $t }} --}}
                                        {{-- @if($t->bujet!='')
                                            <div class="--detail-b">
                                                <div class="--detail-q">
                                                    Бюджет
                                                </div>
                                                <div class="--detail-t">
                                                    {{ $t->bujet }}
                                                </div>
                                            </div>
                                        @endif --}}
                                        {{-- @if($t->) --}}
{{-- 
                                        {{ $t }}
                                        <div class="--detail-b">
                                            <div class="--detail-q">
                                                Оплата
                                            </div>
                                            <div class="--detail-t">
                                                Напрямую исполнителю
                                            </div>
                                        </div> --}}
                                        @if($t->address!='')
                                            <div class="--detail-b">
                                                <div class="--detail-q">
                                                    Адрес
                                                </div>
                                                <div class="--detail-t">
                                                    {!! $t->city !!}
                                                </div>
                                            </div>
                                        @endif



                                        
                                        @if($t->files!='')
                                            <div class="--detail-b" style="overflow:hidden;">
{{--                                                 <div class="--detail-q">
                                                    Файлы
                                                </div> --}}
                                                <div class="--detail-t slider" style="overflow:auto; display:flex;">
                                                    {!! $t->files !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>








                                @if(Agent::isMobile())

                                    @foreach($tasks as $t)


                                        <div class="col m4 s12 l4 --general-t --siderbar" style="padding-top:0;">
                                            <div class="--group --author" style="display: flex;flex-wrap: wrap;justify-content: center;">
                                                @if(App\User::where('id',$t->user_id)->first() != '') {{-- На случай если пользователь удален из базы --}}
                                                <div class="--avatar">
                                                    <img src="{{ App\Profile::getUserAvatar($t->user_id) }}" alt="{{ App\Profile::getUserName($t->user_id) }}"/>
                                                </div>
                                                @endif

                                                @if(Auth::check())
                                                    @if(Auth::user()->id==$t->user_id)
                                                        <span class="--username" style="display:flex;align-items:center;"><a href="/my" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                                                    @else
                                                        <span class="--username" style="display:flex;align-items:center;"><a href="/profile/{{ $t->user_id }}" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                                                    @endif
                                                @else
                                                    <span class="--username" style="display:flex;align-items:center;"><a href="/profile/{{ $t->user_id }}" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                                                @endif
                                                <div class="--rating" style="width:100%;display: flex;justify-content: center;">
                                                    <div class="--sad --ratesml red lighten-5">
                                                        <i style="width: 40px;height: 40px;"></i>
                                                        <span style="top: 12px !important;font-size: 1.5em !important;">{{App\Profile::getUserSadCount($t->user_id)}}</span>
                                                    </div>
                                                    <div class="--neutral --ratesml orange lighten-5">
                                                        <i style="width: 40px;height: 40px;"></i>
                                                        <span style="top: 12px !important;font-size: 1.5em !important;">{{App\Profile::getUserNeutralCount($t->user_id)}}</span>
                                                    </div>
                                                    <div class="--happy --ratesml green lighten-5">
                                                        <i style="width: 40px;height: 40px;"></i>
                                                        <span style="top: 12px !important;font-size: 1.5em !important;">{{App\Profile::getUserHappyCount($t->user_id)}}</span>
                                                    </div>
                                                </div>
                                                @if(Auth::check())
                                                    @if(Auth::user()->id==$t->user_id)
                                                        <span class="--rev" style="margin-top:1em;"><a href="/my" target="_blank">Посмотреть отзывы</a></span>
                                                    @else
                                                        <span class="--rev" style="margin-top:1em;"><a href="/profile/{{ $t->user_id }}" target="_blank">Посмотреть отзывы</a></span>
                                                    @endif
                                                @else
                                                    <span class="--rev" style="margin-top:1em;"><a href="/profile/{{ $t->user_id }}" target="_blank">Посмотреть отзывы</a></span>
                                                @endif
                                            </div>
                                            <div class="--group --share-btns">
                                                <div class="collection brd4 boxsh sml">
                                                    <a href="#contacts-modal" class="collection-item orange-text modal-trigger">Посмотреть контакты <i class="material-icons">person</i></a>
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
                                                        <a href="//connect.ok.ru/offer?url={{ url()->current() }}" target="_blank"><i class="__ok"></i></a>
                                                        <a href="//twitter.com/intent/tweet?url={{ url()->current() }}&via=itsmaqsud" target="_blank"><i class="__tw"></i></a>
                                                        <a href="//linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank"><i class="__in"></i></a>
                                                        <a href="#" data-socialcopylink="thishref">
                                                            <i class="__cplink tooltipped" data-position="bottom" data-tooltip="Скопировать ссылку"></i>
                                                        </a>
                                                        <input type="text" value="{{ url()->current() }}" id="__jsHrefCopy"/>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(Auth::check())
                                                @if(Auth::user()->id=='748' || Auth::user()->id=='735')
                                                    <div class="--group --share-btns">
                                                        <div class="collection with-header sml brd4 boxsh nomargin">
                                                            <div class="collection-header"><h6>Опции сотрудника</h6></div>
                                                            @if($t->status=='0')
                                                                <a href="/tasks/update/{{ $t->id }}/done" class="collection-item red-text">Остановить задачу</a>
                                                            @else
                                                                <a href="/tasks/update/{{ $t->id }}/nodone" class="collection-item green-text">Возобновить задачу</a>
                                                            @endif
                                                            @if($t->user_id!='')
                                                                <a href="#" class="collection-item orange-text">Номер заказа: <b class="right">{{ $t->user_id }}</b></a>
                                                            @endif
                                                            @if($t->user_phone!='')
                                                                <a href="#" class="collection-item orange-text">Номер заказчика: <b class="right">{{ $t->user_phone }}</b></a>
                                                            @endif
                                                            @if($t->user_email!='')
                                                                <a href="#" class="collection-item orange-text">Email задачи: <b class="right">{{ $t->user_email }}</b></a>
                                                            @endif
                                                            @if($t->city!='')
                                                                <a href="#" class="collection-item orange-text">Город задачи: <b class="right">{{ $t->city }}</b></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                        </div>
                                    @endforeach

                                    <div id="contacts-modal" class="modal">
                                        <div class="modal-content">
                                            <h6>Контакты заказчика</h6>
                                            <div class="__cnt center-align">
                                                {{-- {{ Request::segment(3) }} --}}
                                                @auth
                @forelse(App\Tasks::checkCurrentUser($t->id,Auth::user()->id) as $tr)
                        @if(Auth::check())
                            @if(Auth::user()->id != $tr->user_id)
                       {{--    {{ $tr->user_id }}
    {{ Auth::user()->id }} --}}
                                {{-- <p><i class="material-icons veralmidd">phone</i> <a href="tel:{{ $t->user_phone }}" class="veralmidd">{{ $t->user_phone }}</a></p> --}}
                                {{-- <p class="grey-text">Откликнитесь на это задание, Вас обязательно выберут &#128521</p> --}}
                            @elseif(Auth::user()->id == $tr->user_id)
                          {{--   {{ $tr->user_id }}
    {{ Auth::user()->id }} --}}
                                {{-- <p class="grey-text">Это же Вы</p> --}}
                                <p class="grey-text">Вас выбрали</p>
                                <p><i class="material-icons veralmidd">phone</i> <a href="tel:{{ $t->user_phone }}" class="veralmidd">{{ $t->user_phone }}</a></p>
                            @endif
                        @endif
                    
                @empty
                    @auth
                        @if(Auth::user()->id != $t->user_id)
                            <p class="grey-text">Откликнитесь на это задание, Вас обязательно выберут &#128521</p>
                        @else
                          
                            <p class="grey-text">Это же Вы</p>
                            <p class="grey-text">А это Ваш номер телефона:</p>
                            <p><i class="material-icons veralmidd">phone</i> <a href="tel:{{ $t->user_phone }}" class="veralmidd">{{ $t->user_phone }}</a></p>
                        @endif
                    
                    @endauth
                @endforelse
                @endauth

                @guest
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы просмотреть контакты заказчика!
                            </h6>
                        </div>

                @endguest






                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Закрыть</a>
                                        </div>
                                    </div>
                                @endif



                            @endforeach
                        <!--/details-->
                            <!--ApplyTask-->
                            @if(Auth::check())
                                @if(Auth::user()->id!=$t->user_id)
                                    <div class="OrzuApplyTaskActionBlock" style="background:none;">
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
                                    <div class=" --general-t-offers">
                                        {{-- white brd4 --}}
                                        <h6 class="nomargin">
                                           {{--  <i class="material-icons blue-text">people</i> Всего откликов: <strong>{{ App\Tasks::getTaskRequestCount(Request::segment(3)) }}</strong> --}}
                                            <strong>Отклики &nbsp;</strong> ({{ App\Tasks::getTaskRequestCount(Request::segment(3)) }})

                                        </h6>
                                    </div>
                                @else
                                    <div class=" --general-t-offers">
                                        {{-- white brd4 --}}
                                        <h6 class="nomargin">
                                            <i class="material-icons orange-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы оставить свой отклик!
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
                                                    <img src="{{ App\Profile::getUserAvatar($tr->user_id) }}" class="circle"/>
                                                </a>
                                                <div class="--name"><a href="/profile/{{ $tr->user_id }}" target="_blank">{{ App\Profile::getUserName($tr->user_id) }}</a></div>
                                                <div class="--badges hide">награды</div>
                                                <div class="--descript">{{ $tr->narrative }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="brd4 --general-t-offers responses">
{{-- white --}}
                                    <h6 class="nomargin">
                                        {{-- <i class="material-icons blue-text">people</i> Всего откликов: <strong>{{ App\Tasks::getTaskRequestCount(Request::segment(3)) }}</strong> --}}
                                                  <strong>Отклики&nbsp;</strong>({{ App\Tasks::getTaskRequestCount(Request::segment(3)) }})
                                    </h6>
                                </div>
                                @foreach(App\Tasks::getTaskRequest(Request::segment(3)) as $tr)
                                    <div class="white brd4 --general-t-offers" style="border-radius: 10px;">
                                        <div class="--offer">
                                            <div class="--sum grey lighten-4" style="background-color: transparent !important;font-size: 1.5em;font-weight: bold;">{{ $tr->amount }} {{ $tr->current }}</div>
                                            @if(Auth::check())
                                                @if(Auth::user()->id==$tr->user_id)









{{-- <div style="display:flex;flex-wrap:wrap; margin-left:16px;">
                                                    <a href="/my" target="_blank" style="width:100%">alex</a>
                                                                                                                                        <div class="--badges hide">награды</div>
                                            <div style="width: 100%;" class="">Масян</div>
    </div>

 --}}








                                                    {{-- <a href="/my" target="_blank">
                                                        <img src="{{ App\Profile::getUserAvatar($tr->user_id) }}" class="circle"/>
                                                    </a>
                                                    <div class="--name"><a href="/my" target="_blank">{{ App\Profile::getUserName($tr->user_id) }}</a></div> --}}



                                                    <a href="/my" target="_blank">
                                                        <img src="{{ App\Profile::getUserAvatar($tr->user_id) }}" class="circle"/>
                                                    </a>
{{--                                              class="--name" --}}
                                                    <div style="display:flex;flex-wrap:wrap; margin-left:30px;width: 80%;">
                                                        <a href="/my" target="_blank" style="width:100%;font-size: 1.4em;font-weight: bold;color: black;">{{ App\Profile::getUserName($tr->user_id) }}</a>
                                                        <div style="width: 100%;color: gray;padding-top: 1em;" class="">{{ $tr->narrative }}</div>
                                                    </div>
                                                @else









                                                    <a href="/profile/{{ $tr->user_id }}" target="_blank">
                                                        <img src="{{ App\Profile::getUserAvatar($tr->user_id) }}" class="circle"/>
                                                    </a>
{{--                                              class="--name" --}}
                                                    <div style="display:flex;flex-wrap:wrap; margin-left:30px;width: 80%;">
                                                        <a href="/profile/{{ $tr->user_id }}" target="_blank" style="width:100%;font-size: 1.4em;font-weight: bold;color: black;">{{ App\Profile::getUserName($tr->user_id) }}</a>
                                                        <div style="width: 100%;color: gray;padding-top: 1em;" class="">{{ $tr->narrative }}</div>
                                                    </div>






                                                @endif
                                            @else
                                                <a href="/profile/{{ $tr->user_id }}" target="_blank">
                                                    <img src="{{ App\Profile::getUserAvatar($tr->user_id) }}" class="circle"/>
                                                </a>
                                                <div class="--name"><a href="/profile/{{ $tr->user_id }}" target="_blank">{{ App\Profile::getUserName($tr->user_id) }}</a></div>
                                            @endif
                                            <div class="--badges hide">награды</div>
{{--                                             <div class="--descript">{{ $tr->narrative }}</div> --}}
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
                                                            <li><a href="#" class="orange-text">Посмотреть отзывы</a></li>
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
{{--                        {{ Auth::user()->id }}--}}
{{--                        {{ App\Tasks::getAuthorTask($t->id) }}--}}
                        <div class="--group --author">
                            <div class="--avatar">
                                <img src="{{ App\Profile::getUserAvatar($t->user_id) }}" alt="{{ App\Profile::getUserName($t->user_id) }}"/>
                            </div>
                            @if(Auth::check())
                                @if(Auth::user()->id==$t->user_id)
                                    <span class="--username"><a href="/my" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                                @else
                                    <span class="--username"><a href="/profile/{{ $t->user_id }}" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                                @endif
                            @else
                                <span class="--username"><a href="/profile/{{ $t->user_id }}" target="_blank">{{ App\Profile::getUserName($t->user_id) }}</a></span>
                            @endif
                            <div class="--rating">
                                <div class="--sad --ratesml red lighten-5">
                                    <i></i>
                                    <span>{{App\Profile::getUserSadCount($t->user_id)}}</span>
                                </div>
                                <div class="--neutral --ratesml orange lighten-5">
                                    <i></i>
                                    <span>{{App\Profile::getUserNeutralCount($t->user_id)}}</span>
                                </div>
                                <div class="--happy --ratesml green lighten-5">
                                    <i></i>
                                    <span>{{App\Profile::getUserHappyCount($t->user_id)}}</span>
                                </div>
                            </div>
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
                                <a href="#contacts-modal" class="collection-item orange-text modal-trigger">Посмотреть контакты <i class="material-icons">person</i></a>
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
                                    <a href="//connect.ok.ru/offer?url={{ url()->current() }}" target="_blank"><i class="__ok"></i></a>
                                    <a href="//twitter.com/intent/tweet?url={{ url()->current() }}&via=itsmaqsud" target="_blank"><i class="__tw"></i></a>
                                    <a href="//linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank"><i class="__in"></i></a>
                                    <a href="#" data-socialcopylink="thishref">
                                        <i class="__cplink tooltipped" data-position="bottom" data-tooltip="Скопировать ссылку"></i>
                                    </a>
                                    <input type="text" value="{{ url()->current() }}" id="__jsHrefCopy"/>
                                </div>
                            </div>
                        </div>
                        @if(Auth::check())
                            @if(Auth::user()->id=='1' || Auth::user()->id=='497')
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

                {{-- @forelse(App\Tasks::getTaskRequestGet(Request::segment(3)) as $tr) --}}
                @auth
                @forelse(App\Tasks::checkCurrentUser($t->id,Auth::user()->id) as $tr)
                        @if(Auth::check())
                            @if(Auth::user()->id != $tr->user_id)
                       {{--    {{ $tr->user_id }}
    {{ Auth::user()->id }} --}}
                                {{-- <p><i class="material-icons veralmidd">phone</i> <a href="tel:{{ $t->user_phone }}" class="veralmidd">{{ $t->user_phone }}</a></p> --}}
                                {{-- <p class="grey-text">Откликнитесь на это задание, Вас обязательно выберут &#128521</p> --}}
                            @elseif(Auth::user()->id == $tr->user_id)
                          {{--   {{ $tr->user_id }}
    {{ Auth::user()->id }} --}}
                                {{-- <p class="grey-text">Это же Вы</p> --}}
                                <p class="grey-text">Вас выбрали</p>
                                <p><i class="material-icons veralmidd">phone</i> <a href="tel:{{ $t->user_phone }}" class="veralmidd">{{ $t->user_phone }}</a></p>
                            @endif
                        @endif
                    
                @empty
                    @auth
                        @if(Auth::user()->id != $t->user_id)
                            <p class="grey-text">Откликнитесь на это задание, Вас обязательно выберут &#128521</p>
                        @else
                          
                            <p class="grey-text">Это же Вы</p>
                            <p class="grey-text">А это Ваш номер телефона:</p>
                            <p><i class="material-icons veralmidd">phone</i> <a href="tel:{{ $t->user_phone }}" class="veralmidd">{{ $t->user_phone }}</a></p>
                        @endif
                    
                    @endauth
                @endforelse
                @endauth

                @guest
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы просмотреть контакты заказчика!
                            </h6>
                        </div>

                @endguest









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
    <script>
        
 
        
    window.onload=function(){

        let slider = $('.slider');
        let currentImage = 0;
        let sliderElWidth = [];
        let sliderTotalWidth=0;
        let totalScroll = 0;
        let parentEl=slider.children();
        slider.eq(0).scrollLeft(0);
        let lastScrollPoint=0;
        let lastScrollImage=0;
        sliderElWidth[0] = 0;
        let scrollIt;
        let item = document.querySelector('.slider');

        function scrollFunc(){ 
        scrollIt = setTimeout(function(){
            if(lastScrollImage!=currentImage || lastScrollPoint != totalScroll){
                currentImage = lastScrollImage;
                totalScroll = lastScrollPoint;
            }
            parentEl.css({
              transform:'scale(.7)'
            })
                parentEl.eq(currentImage).css({
                    transform:'scale(1)'
                });    

              totalScroll += sliderElWidth[currentImage];
            currentImage++;
            slider.eq(0).animate({
              scrollLeft:totalScroll
            },700);

            if(totalScroll >=  sliderTotalWidth -(( sliderElWidth[0] + sliderElWidth[sliderElWidth.length-1] + sliderElWidth[sliderElWidth.length-2])/2)){
              currentImage=0;
              totalScroll=0;
            } 
            lastScrollPoint = totalScroll;
            lastScrollImage =currentImage;
            scrollFunc()
    },4000)
}


        let getScrollbarWidth = function() {
          const outer = document.createElement('div');// Creating invisible container
          outer.style.visibility = 'hidden';
          outer.style.overflow = 'scroll'; // forcing scrollbar to appear
          outer.style.msOverflowStyle = 'scrollbar'; // needed for WinJS apps
          document.body.appendChild(outer);
          const inner = document.createElement('div');// Creating inner element and placing it in the container
          outer.appendChild(inner);
          const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);// Calculating difference between container's full width and the child width
          outer.parentNode.removeChild(outer);// Removing temporary elements from the DOM
          return scrollbarWidth;
        }

        for(let i=0;i<parentEl.length;i++){
          sliderTotalWidth += parentEl.eq(i).width();
          sliderElWidth.push(parentEl.eq(i).width());
          if(i==parentEl.length-1 && sliderTotalWidth > slider.parent().width()){
            scrollFunc();
        slider.on('mouseenter',function(){
            parentEl.css({transform:'scale(.7)'});
            $('body').css({'overflow':'hidden','margin-right':getScrollbarWidth()+'px'})
            clearTimeout(scrollIt);
            item.addEventListener('wheel',horizontalScroll );
        });

        slider.on('mouseleave',function(){
            $('body').css({'overflow':'auto','margin-right':'0px'});
            scrollFunc();
            item.removeEventListener('wheel',horizontalScroll);
        });
          } else if(i==parentEl.length-1 && sliderTotalWidth <= slider.parent().width()){
            clearTimeout(scrollIt);
            parentEl.css({transform:'scale(1)'});
            slider.css({'justify-content':'center'});
          }
        }

function horizontalScroll(e){
                let scrollStep = 150;
                if (e.deltaY > 0) {
                    if(sliderTotalWidth-slider.parent().width()-200>=totalScroll){
                        totalScroll+=scrollStep                        
                    } else {
                        totalScroll = sliderTotalWidth-slider.parent().width()+200
                    }
                    slider.eq(0).animate({
                        scrollLeft:totalScroll
                    },100);
                }else{
                    if(totalScroll<0 || totalScroll== NaN){
                        totalScroll=0;
                        currentImage=0;
                    }else{
                        totalScroll-=scrollStep;
                    }
                    slider.eq(0).animate({
                        scrollLeft:totalScroll
                    },100);

                }
            }

    }
    
    </script>
@endsection