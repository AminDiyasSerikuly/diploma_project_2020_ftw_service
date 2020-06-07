<?php $__env->startSection('title'); ?>
    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <title><?php echo e($t->task); ?></title>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/tasks-post.css?10')); ?>"/>
    <script src="https://api-maps.yandex.ru/2.1/?load=Geolink&lang=ru_RU&apikey=de1573d4-733f-4120-a6ee-bed95f339276
" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/header-normalize.css')); ?>"  media="screen,projection"/>
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
                                <div class="  --general-t-detail">
                                    
                                    <div class="--title">
                                        <h6 class="nomargin padding-15" style="font-weight: 600;"><?php echo e($t->task); ?></h6>

                                        <?php if($t->bujet!=''): ?>
                                            <div class="--detail-q tasks-price white padding-15" style="width: 100%;font-weight: 500;">
                                                
                                                   <h5> <?php echo e($t->bujet); ?> </h5>
                                                
                                            </div>
                                        <?php endif; ?>


                                        <span><?php if(Agent::isDesktop()): ?> <?php if($t->status==0): ?> <?php echo '<strong class="orange-text">Открыто</strong>'; ?> <?php else: ?> <?php echo '<strong class="orange-text">Закрыто</strong>'; ?> <?php endif; ?> &nbsp; &bull; &nbsp; <?php endif; ?> <?php echo e($t->created_date); ?> &nbsp; &bull; &nbsp; номер задания: <?php echo e($t->id); ?></span>
                                    </div>
                                    <div class="--detail">

                                        <?php if($t->narrative!=''): ?>
                                            <div class="--detail-b --wht">
                                                <div class="--detail-q">
                                                    Описание
                                                </div>
                                                <div class="--detail-t">
                                                    <?php echo e($t->narrative); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>


                                        



                                        <?php if($t->cat_parent_name!=''): ?>
                                            <div class="--detail-b">
                                                <div class="--detail-q">
                                                    Категория
                                                </div>
                                                <div class="--detail-t">
                                                    <?php echo e($t->cat_parent_name); ?>

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

                                        
                                        
                                        

                                        <?php if($t->address!=''): ?>
                                            <div class="--detail-b">
                                                <div class="--detail-q">
                                                    Адрес
                                                </div>
                                                <div class="--detail-t">
                                                    <?php echo $t->city; ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>



                                        
                                        <?php if($t->files!=''): ?>
                                            <div class="--detail-b" style="overflow:hidden;">

                                                <div class="--detail-t slider" style="overflow:auto; display:flex;">
                                                    <?php echo $t->files; ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>








                                <?php if(Agent::isMobile()): ?>

                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                        <div class="col m4 s12 l4 --general-t --siderbar" style="padding-top:0;">
                                            <div class="--group --author" style="display: flex;flex-wrap: wrap;justify-content: center;">
                                                <?php if(App\User::where('id',$t->user_id)->first() != ''): ?> 
                                                <div class="--avatar">
                                                    <img src="<?php echo e(App\Profile::getUserAvatar($t->user_id)); ?>" alt="<?php echo e(App\Profile::getUserName($t->user_id)); ?>"/>
                                                </div>
                                                <?php endif; ?>

                                                <?php if(Auth::check()): ?>
                                                    <?php if(Auth::user()->id==$t->user_id): ?>
                                                        <span class="--username" style="display:flex;align-items:center;"><a href="/my" target="_blank"><?php echo e(App\Profile::getUserName($t->user_id)); ?></a></span>
                                                    <?php else: ?>
                                                        <span class="--username" style="display:flex;align-items:center;"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($t->user_id)); ?></a></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="--username" style="display:flex;align-items:center;"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($t->user_id)); ?></a></span>
                                                <?php endif; ?>
                                                <div class="--rating" style="width:100%;display: flex;justify-content: center;">
                                                    <div class="--sad --ratesml red lighten-5">
                                                        <i style="width: 40px;height: 40px;"></i>
                                                        <span style="top: 12px !important;font-size: 1.5em !important;"><?php echo e(App\Profile::getUserSadCount($t->user_id)); ?></span>
                                                    </div>
                                                    <div class="--neutral --ratesml orange lighten-5">
                                                        <i style="width: 40px;height: 40px;"></i>
                                                        <span style="top: 12px !important;font-size: 1.5em !important;"><?php echo e(App\Profile::getUserNeutralCount($t->user_id)); ?></span>
                                                    </div>
                                                    <div class="--happy --ratesml green lighten-5">
                                                        <i style="width: 40px;height: 40px;"></i>
                                                        <span style="top: 12px !important;font-size: 1.5em !important;"><?php echo e(App\Profile::getUserHappyCount($t->user_id)); ?></span>
                                                    </div>
                                                </div>
                                                <?php if(Auth::check()): ?>
                                                    <?php if(Auth::user()->id==$t->user_id): ?>
                                                        <span class="--rev" style="margin-top:1em;"><a href="/my" target="_blank">Посмотреть отзывы</a></span>
                                                    <?php else: ?>
                                                        <span class="--rev" style="margin-top:1em;"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank">Посмотреть отзывы</a></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="--rev" style="margin-top:1em;"><a href="/profile/<?php echo e($t->user_id); ?>" target="_blank">Посмотреть отзывы</a></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="--group --share-btns">
                                                <div class="collection brd4 boxsh sml">
                                                    <a href="#contacts-modal" class="collection-item orange-text modal-trigger">Посмотреть контакты <i class="material-icons">person</i></a>
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
                                                <?php if(Auth::user()->id=='748' || Auth::user()->id=='735'): ?>
                                                    <div class="--group --share-btns">
                                                        <div class="collection with-header sml brd4 boxsh nomargin">
                                                            <div class="collection-header"><h6>Опции сотрудника</h6></div>
                                                            <?php if($t->status=='0'): ?>
                                                                <a href="/tasks/update/<?php echo e($t->id); ?>/done" class="collection-item red-text">Остановить задачу</a>
                                                            <?php else: ?>
                                                                <a href="/tasks/update/<?php echo e($t->id); ?>/nodone" class="collection-item green-text">Возобновить задачу</a>
                                                            <?php endif; ?>
                                                            <?php if($t->user_id!=''): ?>
                                                                <a href="#" class="collection-item orange-text">Номер заказа: <b class="right"><?php echo e($t->user_id); ?></b></a>
                                                            <?php endif; ?>
                                                            <?php if($t->user_phone!=''): ?>
                                                                <a href="#" class="collection-item orange-text">Номер заказчика: <b class="right"><?php echo e($t->user_phone); ?></b></a>
                                                            <?php endif; ?>
                                                            <?php if($t->user_email!=''): ?>
                                                                <a href="#" class="collection-item orange-text">Email задачи: <b class="right"><?php echo e($t->user_email); ?></b></a>
                                                            <?php endif; ?>
                                                            <?php if($t->city!=''): ?>
                                                                <a href="#" class="collection-item orange-text">Город задачи: <b class="right"><?php echo e($t->city); ?></b></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div id="contacts-modal" class="modal">
                                        <div class="modal-content">
                                            <h6>Контакты заказчика</h6>
                                            <div class="__cnt center-align">
                                                
                                                <?php if(auth()->guard()->check()): ?>
                <?php $__empty_1 = true; $__currentLoopData = App\Tasks::checkCurrentUser($t->id,Auth::user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if(Auth::check()): ?>
                            <?php if(Auth::user()->id != $tr->user_id): ?>
                       
                                
                                
                            <?php elseif(Auth::user()->id == $tr->user_id): ?>
                          
                                
                                <p class="grey-text">Вас выбрали</p>
                                <p><i class="material-icons veralmidd">phone</i> <a href="tel:<?php echo e($t->user_phone); ?>" class="veralmidd"><?php echo e($t->user_phone); ?></a></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->id != $t->user_id): ?>
                            <p class="grey-text">Откликнитесь на это задание, Вас обязательно выберут &#128521</p>
                        <?php else: ?>
                          
                            <p class="grey-text">Это же Вы</p>
                            <p class="grey-text">А это Ваш номер телефона:</p>
                            <p><i class="material-icons veralmidd">phone</i> <a href="tel:<?php echo e($t->user_phone); ?>" class="veralmidd"><?php echo e($t->user_phone); ?></a></p>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(auth()->guard()->guest()): ?>
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы просмотреть контакты заказчика!
                            </h6>
                        </div>

                <?php endif; ?>






                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Закрыть</a>
                                        </div>
                                    </div>
                                <?php endif; ?>



                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--/details-->
                            <!--ApplyTask-->
                            <?php if(Auth::check()): ?>
                                <?php if(Auth::user()->id!=$t->user_id): ?>
                                    <div class="OrzuApplyTaskActionBlock" style="background:none;">
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
                                    <div class=" --general-t-offers">
                                        
                                        <h6 class="nomargin">
                                           
                                            <strong>Отклики &nbsp;</strong> (<?php echo e(App\Tasks::getTaskRequestCount(Request::segment(3))); ?>)

                                        </h6>
                                    </div>
                                <?php else: ?>
                                    <div class=" --general-t-offers">
                                        
                                        <h6 class="nomargin">
                                            <i class="material-icons orange-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы оставить свой отклик!
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
                                <div class="brd4 --general-t-offers responses">

                                    <h6 class="nomargin">
                                        
                                                  <strong>Отклики&nbsp;</strong>(<?php echo e(App\Tasks::getTaskRequestCount(Request::segment(3))); ?>)
                                    </h6>
                                </div>
                                <?php $__currentLoopData = App\Tasks::getTaskRequest(Request::segment(3)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="white brd4 --general-t-offers" style="border-radius: 10px;">
                                        <div class="--offer">
                                            <div class="--sum grey lighten-4" style="background-color: transparent !important;font-size: 1.5em;font-weight: bold;"><?php echo e($tr->amount); ?> <?php echo e($tr->current); ?></div>
                                            <?php if(Auth::check()): ?>
                                                <?php if(Auth::user()->id==$tr->user_id): ?>


















                                                    



                                                    <a href="/my" target="_blank">
                                                        <img src="<?php echo e(App\Profile::getUserAvatar($tr->user_id)); ?>" class="circle"/>
                                                    </a>

                                                    <div style="display:flex;flex-wrap:wrap; margin-left:30px;width: 80%;">
                                                        <a href="/my" target="_blank" style="width:100%;font-size: 1.4em;font-weight: bold;color: black;"><?php echo e(App\Profile::getUserName($tr->user_id)); ?></a>
                                                        <div style="width: 100%;color: gray;padding-top: 1em;" class=""><?php echo e($tr->narrative); ?></div>
                                                    </div>
                                                <?php else: ?>









                                                    <a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank">
                                                        <img src="<?php echo e(App\Profile::getUserAvatar($tr->user_id)); ?>" class="circle"/>
                                                    </a>

                                                    <div style="display:flex;flex-wrap:wrap; margin-left:30px;width: 80%;">
                                                        <a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank" style="width:100%;font-size: 1.4em;font-weight: bold;color: black;"><?php echo e(App\Profile::getUserName($tr->user_id)); ?></a>
                                                        <div style="width: 100%;color: gray;padding-top: 1em;" class=""><?php echo e($tr->narrative); ?></div>
                                                    </div>






                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank">
                                                    <img src="<?php echo e(App\Profile::getUserAvatar($tr->user_id)); ?>" class="circle"/>
                                                </a>
                                                <div class="--name"><a href="/profile/<?php echo e($tr->user_id); ?>" target="_blank"><?php echo e(App\Profile::getUserName($tr->user_id)); ?></a></div>
                                            <?php endif; ?>
                                            <div class="--badges hide">награды</div>

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
                                                            <li><a href="#" class="orange-text">Посмотреть отзывы</a></li>
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
                                <a href="#contacts-modal" class="collection-item orange-text modal-trigger">Посмотреть контакты <i class="material-icons">person</i></a>
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

                
                <?php if(auth()->guard()->check()): ?>
                <?php $__empty_1 = true; $__currentLoopData = App\Tasks::checkCurrentUser($t->id,Auth::user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if(Auth::check()): ?>
                            <?php if(Auth::user()->id != $tr->user_id): ?>
                       
                                
                                
                            <?php elseif(Auth::user()->id == $tr->user_id): ?>
                          
                                
                                <p class="grey-text">Вас выбрали</p>
                                <p><i class="material-icons veralmidd">phone</i> <a href="tel:<?php echo e($t->user_phone); ?>" class="veralmidd"><?php echo e($t->user_phone); ?></a></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->id != $t->user_id): ?>
                            <p class="grey-text">Откликнитесь на это задание, Вас обязательно выберут &#128521</p>
                        <?php else: ?>
                          
                            <p class="grey-text">Это же Вы</p>
                            <p class="grey-text">А это Ваш номер телефона:</p>
                            <p><i class="material-icons veralmidd">phone</i> <a href="tel:<?php echo e($t->user_phone); ?>" class="veralmidd"><?php echo e($t->user_phone); ?></a></p>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(auth()->guard()->guest()): ?>
                        <div class="white brd4 --general-t-offers">
                            <h6 class="nomargin">
                                <i class="material-icons blue-text">people</i> <a href="/login" class="link3">Войдите или зарегистрируйтесь</a>, что бы просмотреть контакты заказчика!
                            </h6>
                        </div>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/tasks/task.blade.php ENDPATH**/ ?>