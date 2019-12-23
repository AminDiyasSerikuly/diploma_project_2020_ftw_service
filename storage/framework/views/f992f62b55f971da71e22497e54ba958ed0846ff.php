<?php $__env->startSection('title'); ?>
<?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<title><?php echo e($t->task); ?></title>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/tasks-post.css?10')); ?>"/>
<script src="https://api-maps.yandex.ru/2.1/?load=Geolink&lang=ru_RU&apikey=de1573d4-733f-4120-a6ee-bed95f339276
" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container --general">
    <div class="row">
        <div class="col m8 s12 --general-t" id="taskdetail">
            <div class="main">
                <div class="row nomargin">
                    <div class="col m12 s12">
                        <!--details-->
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="white brd4 --general-t-detail">
                            <div class="--title">
                                <h6 class="nomargin"><?php echo e($t->task); ?></h6>
                                <span><?php if(Agent::isDesktop()): ?> <?php if($t->status==0): ?> <?php echo '<strong class="green-text">Актуально</strong>'; ?> <?php else: ?> <?php echo '<strong class="orange-text">Закрыто</strong>'; ?> <?php endif; ?>  | <?php endif; ?> <?php echo e($t->created_date); ?> | номер задания: <?php echo e($t->id); ?></span>
                            </div>
                            <div class="--detail">
                                <?php if($t->address!=''): ?>
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Адрес
                                    </div>
                                    <div class="--detail-t">
                                        <?php echo $t->address; ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($t->start_date_s!=''): ?>
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Начать
                                    </div>
                                    <div class="--detail-t">
                                        <?php echo e($t->start_date_s); ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($t->end_date!=''): ?>
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Завершить
                                    </div>
                                    <div class="--detail-t">
                                        <?php echo e($t->end_date); ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($t->bujet!=''): ?>
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Бюджет
                                    </div>
                                    <div class="--detail-t">
                                        <?php echo e($t->bujet); ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Оплата
                                    </div>
                                    <div class="--detail-t">
                                        Напрямую исполнителю
                                    </div>
                                </div>
                                <?php if($t->narrative!=''): ?>
                                <div class="--detail-b --wht">
                                    <div class="--detail-q">
                                        Нужно
                                    </div>
                                    <div class="--detail-t">
                                        <?php echo e($t->narrative); ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($t->files!=''): ?>
                                <div class="--detail-b">
                                    <div class="--detail-q">
                                        Файлы
                                    </div>
                                    <div class="--detail-t">
                                        <?php echo $t->files; ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--/details-->
                        <!--ApplyTask-->
                        <?php if(Auth::check()): ?>
                        <?php if(Auth::user()->id!=$t->user_id): ?>
                        <div class="OrzuApplyTaskActionBlock">
                            <div class="OrzuApplyTaskAction">
                                <?php if($t->bujet!='Предложите цену'): ?>
                                <span class="OrzuNoBudjet">заказчик заплатит до <strong><?php echo e($t->bujet); ?></strong></span>
                                <?php else: ?>
                                <span class="OrzuNoBudjet">заказчик предлагает <strong>указать цену Вам</strong></span>
                                <?php endif; ?>
                            </div>
                            <?php if(App\Tasks::getTaskRequestUser($t->id, Auth::user()->id)>0): ?>
                            <div class="center-align OrzuApplyTaskButtonDone">
                                <span class="nomargin green-text">Вы уже добавили предложение!</span>
                            </div>
                            <?php else: ?>
                            <div class="row nomargin--b">
                                <div class="col m12">
                                    <a href="#action-modal" class="OrzuApplyTaskButton modal-trigger waves-effect waves-light green">
                                        Добавить предложение <i class="material-icons veralmidd">done_all</i>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <!--/ApplyTask-->
                        <!--offers-->
                        <?php if(auth()->guard()->guest()): ?>
                        <?php if(App\Tasks::getTaskRequestCount(Request::segment(3))): ?>
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> Всего откликов: <strong><?php echo e(App\Tasks::getTaskRequestCount(Request::segment(3))); ?></strong>
                            </h6>
                        </div>
                        <?php else: ?>
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы оставить свой отклик!
                            </h6>
                        </div>
                        <?php endif; ?>
                        <?php else: ?>
                        <?php $__currentLoopData = App\Tasks::getTaskRequestGet(Request::segment(3)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="green lighten-5 brd4 --general-t-offers">
                            <div class="--select-offer">
                                <h6 class="nomargin green-text">Выбранное предложение</h6>
                                <div class="--offer">
                                    <div class="--sum grey lighten-4"><?php echo e($tr->amount); ?> <?php echo e($tr->current); ?></div>
                                    <a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank">
                                        <img src="<?php echo e(App\Profile::getUserAvatar($tr->user_id)); ?>" class="circle"/>
                                    </a>
                                    <div class="--name"><a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($tr->user_id)); ?></a></div>
                                    <div class="--badges hide">награды</div>
                                    <div class="--descript"><?php echo e($tr->narrative); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> Всего откликов: <strong><?php echo e(App\Tasks::getTaskRequestCount(Request::segment(3))); ?></strong>
                            </h6>
                        </div>
                        <?php $__currentLoopData = App\Tasks::getTaskRequest(Request::segment(3)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="white brd4 --general-t-offers">
                            <div class="--offer">
                                <div class="--sum grey lighten-4"><?php echo e($tr->amount); ?> <?php echo e($tr->current); ?></div> 
                                <?php if(Auth::check()): ?>                                       
                                <?php if(Auth::user()->id==$tr->user_id): ?>
                                <a href="/my" target="_blank">
                                    <img src="<?php echo e(App\Profile::getUserAvatar($tr->user_id)); ?>" class="circle"/>
                                </a>
                                <div class="--name"><a href="/my" target="_blank"><?php echo e(App\Profile::getUserName($tr->user_id)); ?></a></div>
                                <?php else: ?>
                                <a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank">
                                    <img src="<?php echo e(App\Profile::getUserAvatar($tr->user_id)); ?>" class="circle"/>
                                </a>
                                <div class="--name"><a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($tr->user_id)); ?></a></div>
                                <?php endif; ?>
                                <?php else: ?>
                                <a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank">
                                    <img src="<?php echo e(App\Profile::getUserAvatar($tr->user_id)); ?>" class="circle"/>
                                </a>
                                <div class="--name"><a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($tr->user_id)); ?></a></div>
                                <?php endif; ?>
                                <div class="--badges hide">награды</div>
                                <div class="--descript"><?php echo e($tr->narrative); ?></div>
                                <?php if(\Auth::check()): ?>
                                <?php if(\Auth::user()->id==$t->user_id): ?>
                                <div class="--divider">
                                    <div class="--divider-br"></div>
                                </div>
                                <div class="--action center-align">
                                    <button onclick="location.href='<?php echo e(route('selreq',$tr->id)); ?>'" class="btn bdr4 waves-effect waves-light green">Выбрать исполнителя</button>
                                    <button class="btn bdr4 waves-effect waves-light blue _dropdownjs" data-target="__js-offer-options-id1">
                                        <i class="material-icons">more_horiz</i>
                                    </button>
                                    <ul id="__js-offer-options-id1" class="dropdown-content sml">
                                        <li><a href="#" class="blue-text">Посмотреть отзывы</a></li>
                                        <li><a href="#" class="red-text">Пожаловаться</a></li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <!--/offers-->
                    </div>
                </div>
            </div>
        </div>

        <?php if(Agent::isDesktop()): ?>
        <!--sidebar-->
        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col m4 s12 l4 --general-t --siderbar">
            <div class="--group --author">
                <div class="--avatar">
                    <img src="<?php echo e(App\Profile::getUserAvatar($t->user_id)); ?>" alt="<?php echo e(App\Profile::getUserName($t->user_id)); ?>"/>
                </div>
                <?php if(Auth::check()): ?>
                <?php if(Auth::user()->id==$t->user_id): ?>
                <span class="--username"><a href="/my" target="_blank"><?php echo e(App\Profile::getUserName($t->user_id)); ?></a></span>
                <?php else: ?>
                <span class="--username"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($t->user_id)); ?></a></span>
                <?php endif; ?>
                <?php else: ?>
                <span class="--username"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($t->user_id)); ?></a></span>
                <?php endif; ?>
                <div class="--rating">
                    <div class="--sad --ratesml red lighten-5">
                        <i></i>
                        <span><?php echo e(App\Profile::getUserSadCount($t->user_id)); ?></span>
                    </div>
                    <div class="--neutral --ratesml orange lighten-5">
                        <i></i>
                        <span><?php echo e(App\Profile::getUserNeutralCount($t->user_id)); ?></span>
                    </div>
                    <div class="--happy --ratesml green lighten-5">
                        <i></i>
                        <span><?php echo e(App\Profile::getUserHappyCount($t->user_id)); ?></span>
                    </div>
                </div>
                <?php if(Auth::check()): ?>
                <?php if(Auth::user()->id==$t->user_id): ?>
                <span class="--rev"><a href="/my" target="_blank">Посмотреть отзывы</a></span>
                <?php else: ?>
                <span class="--rev"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank">Посмотреть отзывы</a></span>
                <?php endif; ?>
                <?php else: ?>
                <span class="--rev"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank">Посмотреть отзывы</a></span>
                <?php endif; ?>
            </div>
            <div class="--group --share-btns">
                <div class="collection brd4 boxsh sml">
                    <a href="#contacts-modal" class="collection-item blue-text modal-trigger">Посмотреть контакты <i class="material-icons">person</i></a>
                    <?php if(Auth::check()): ?>
                    <?php if(Auth::user()->id==$t->user_id): ?>
                    <a href="#!" class="collection-item orange-text">Редактировать задание <i class="material-icons">edit</i></a>
                    <?php if($t->status=='0'): ?>
                    <a href="/tasks/update/<?php echo e($t->id); ?>/done" class="collection-item red-text">Остановить задачу</a>
                    <?php else: ?>
                    <a href="/tasks/update/<?php echo e($t->id); ?>/nodone" class="collection-item green-text">Возобновить задачу</a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="__share">
                    <span>Поделиться заданием <i class="material-icons">share</i></span>
                    <div class="__socials">
                        <a href="//vk.com/share.php?url=<?php echo e(url()->current()); ?>" target="_blank"><i class="__vk"></i></a>
                        <a href="//facebook.com/sharer/sharer.php?u=<?php echo e(url()->current()); ?>" target="_blank"><i class="__fb"></i></a>
                        <a href="//connect.ok.ru/offer?url=<?php echo e(url()->current()); ?>" target="_blank"><i class="__ok"></i></a>
                        <a href="//twitter.com/intent/tweet?url=<?php echo e(url()->current()); ?>&via=itsmaqsud" target="_blank"><i class="__tw"></i></a>
                        <a href="//linkedin.com/shareArticle?mini=true&url=<?php echo e(url()->current()); ?>" target="_blank"><i class="__in"></i></a>
                        <a href="#" data-socialcopylink="thishref">
                            <i class="__cplink tooltipped" data-position="bottom" data-tooltip="Скопировать ссылку"></i>
                        </a>
                        <input type="text" value="<?php echo e(url()->current()); ?>" id="__jsHrefCopy"/>
                    </div>
                </div>
            </div>
            <?php if(Auth::check()): ?>
            <?php if(Auth::user()->id=='1' || Auth::user()->id=='497'): ?>
            <div class="--group --share-btns">
                <div class="collection with-header sml brd4 boxsh nomargin">
                    <div class="collection-header"><h6>Опции сотрудника</h6></div>
                    <?php if($t->status=='0'): ?>
                    <a href="/tasks/update/<?php echo e($t->id); ?>/done" class="collection-item red-text">Остановить задачу</a>
                    <?php else: ?>
                    <a href="/tasks/update/<?php echo e($t->id); ?>/nodone" class="collection-item green-text">Возобновить задачу</a>
                    <?php endif; ?>
                    <?php if($t->user_phone!=''): ?>
                    <a href="#" class="collection-item blue-text">Номер задачи: <b class="right"><?php echo e($t->user_phone); ?></b></a>
                    <?php endif; ?>
                    <?php if($t->user_email!=''): ?>
                    <a href="#" class="collection-item blue-text">Email задачи: <b class="right"><?php echo e($t->user_email); ?></b></a>
                    <?php endif; ?>
                    <?php if($t->city!=''): ?>
                    <a href="#" class="collection-item blue-text">Город задачи: <b class="right"><?php echo e($t->city); ?></b></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!--/sidebar-->
        <?php endif; ?>

    </div>
</div>

<?php if(auth()->guard()->check()): ?>
<!--modal action-->
<div id="action-modal" class="modal">
    <div class="modal-content">
        <h6 class="title">Добавить предложение к заданию</h6>
        <div class="row">
            <form method="POST" action="/tasks/request/add">
                <?php echo csrf_field(); ?>
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
                    <input type="hidden" name="task_id" value="<?php echo e(Request::segment(3)); ?>">
                    <label for="desc">Текст предложения</label>
                </div>
                <div class="col m12 s12">
                    <h6 class="nomargin">Стоимость вашей работы</h6>
                    <span class="grey-text">Заказчик указал стоимость — <?php echo e($t->bujet); ?></span>
                    <span class="red-text _acthelper hide">Цена задания не может быть ниже 100</span>
                </div>
                <div class="col m3 s12">
                    <div class="OrzuApplyTaskAmount">
                        <input placeholder="Введите цену" id="_act-inputsum" type="text" name="amount" maxlength="5" class="nomargin OrzuApplyTaskAmountInput center-align" value="">
                        <span class="OrzuApplyTaskAmountCurrent">
                            <?php echo e(App\Profile::getUserParam('user_current')); ?>

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
<?php endif; ?>

<!--modal contacts-->
<div id="contacts-modal" class="modal">
    <div class="modal-content">
        <h6>Контакты заказчика</h6>
        <div class="__cnt center-align">
            <?php $__empty_1 = true; $__currentLoopData = App\Tasks::getTaskRequestGet(Request::segment(3)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if(Auth::check()): ?>
            <?php if(Auth::user()->id==$tr->user_id): ?>
            <p class="grey-text">Контакты заказчика видны только Вам.</p>
            <?php if($t->user_phone!=''): ?>
            <p><i class="material-icons veralmidd">phone</i> <span class="veralmidd"><?php echo e($t->user_phone); ?></span></p>
            <?php endif; ?>
            <?php if($t->user_email!=''): ?>
            <p><i class="material-icons veralmidd">email</i> <span class="veralmidd"><?php echo e($t->user_email); ?></span></p>
            <?php endif; ?>
            <p class="grey-text nomargin--b">так же Вы можете написать <a href="<?php echo e(route('chat', $t->id)); ?>">личное сообщение</a> заказчику.</p>
            <?php else: ?>
            <p class="grey-text">Контакты заказчика Вам недоступны.</p>
            <?php endif; ?>
            <?php else: ?>
            <p class="grey-text">Контакты заказчика Вам недоступны.</p>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="grey-text">Контакты заказчика Вам недоступны.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Закрыть</a>
    </div>
</div>
<!--/modal contacts-->
<?php echo $__env->make('parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footlink'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/tasks-post.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/tasks/task.blade.php ENDPATH**/ ?>