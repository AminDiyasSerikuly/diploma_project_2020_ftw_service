<!DOCTYPE html>
<html>
<head>
    <?php $__env->startSection('title'); ?>
    <?php echo $__env->yieldSection(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php $__env->startSection('metatags'); ?>
    <?php echo $__env->yieldSection(); ?>
    <link rel="icon" sizes="192x192" href="<?php echo e(asset('images/favicon.ico')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/appleicon.png')); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/materialize.min.css?1')); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/common.css?112')); ?>"  media="screen,projection"/>
    <?php if(Agent::isMobile()): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/responsive.css?99')); ?>"/>
    <?php endif; ?>
    <?php $__env->startSection('headlink'); ?>
    <?php echo $__env->yieldSection(); ?>
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
                    <img src="<?php echo e(asset('svg/logoname.svg')); ?>"/>
                </a>
                <ul class="leftNavLinks">
                    <?php if(Agent::isDesktop()): ?>
                    <li>
                        <a href="<?php echo e(route('contenttasks')); ?>">Найти задания</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <?php if(auth()->guard()->guest()): ?>
                    <li>
                        <a href="<?php echo e(route('login')); ?>" class="tooltipped" data-position="bottom" data-tooltip="Вход или регистрация">
                            <i class="material-icons left">account_circle</i> Личный кабинет
                        </a>
                    </li>
                    <?php else: ?>
                    <li>
                        <a href="/my" class="_dropdownjs-ctf" data-target="_nav--profile">
                            <div class="_nav--avatar">
                                <img class="user-min-profile-photo" src="<?php echo e(App\Profile::getUserAvatar(Auth::user()->id)); ?>"/>
                            </div>
                            <?php echo e(App\Profile::getUserName(Auth::user()->id)); ?>

                        </a>
                    </li>
                    <ul id="_nav--profile" class="dropdown-content sml">
                        <li><a href="/my">Моя страница</a></li>
                        <li><a href="/my/tasks">Мои задания</a></li>
                        <li><a href="<?php if(App\Profile::getUserMessageId(Auth::user()->id)!=''): ?> <?php echo e(route('chat', App\Profile::getUserMessageId(Auth::user()->id))); ?> <?php else: ?> <?php echo e(route('chat',0)); ?> <?php endif; ?>">Мои сообщения</a></li>
                        <li class="divider"></li>
                        <li><a href="/my/settings#substr">Подписка на задания</a></li>
                        <li class="divider"></li>
                        <li><a href="/my/edit">Редактировать</a></li>
                        <li><a href="/my/settings">Настройки</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout" class="grey-text" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></li>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
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
                        <div class="--noPush">Нет уведомлений</div>
                        <div class="--list hide">
                            <div class="--item">
                                <i class="material-icons">fiber_manual_record</i>
                                <a href="#">Вы создали задачу</a>
                                <span>Новая задача</span>
                            </div>
                        </div>
                    </div>
                </div>
                <li>
                    <a href="/my/balance" class="tooltipped" data-position="bottom" data-tooltip="Мой кошелек">
                       <i class="material-icons">account_balance_wallet</i>
                   </a>
               </li>

               <?php endif; ?>
               <li class="hidden--home">
                <a href="<?php echo e(route('newtask',['cat'=>'techrepair','subcat'=>'techrepairother'])); ?>" class="_creat-button-navbar green-text tooltipped" data-position="bottom" data-tooltip="Добавить задание">
                    <i class="material-icons">add_circle</i>
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
                <li class="hide"><a href="<?php if(Config::get('app.locale')!='ru'): ?> <?php echo e(route('lang','ru')); ?> <?php else: ?> <?php echo e(route('lang','en')); ?> <?php endif; ?>">Язык: Русский</a></li>
            </ul>
        </ul>
    </div>
</nav>
<?php if(Agent::isMobile()): ?>
<ul class="sidenav" id="mobile-web">
    <?php if(auth()->guard()->guest()): ?>
    <li><a href="/login"><i class="material-icons">person</i>Войти в кабинет</a></li>
    <li class="divider nomargin--t"></li>
    <li><a href="/home" class="green-text"><i class="material-icons">add</i>Добавить задание</a></li>
    <li><a href="/tasks"><i class="material-icons">done</i>Найти задания</a></li>
    <?php else: ?>
    <li>
        <div class="user-view">
            <div class="background blue lighten-2"></div>
            <a href="/my"><img class="circle" src="/images/noavatar.png"></a>
            <a href="/my"><span class="white-text name"><?php echo e(\Auth::User()->name); ?></span></a>
            <a href="/my"><span class="white-text email"><?php echo e(\Auth::User()->phone); ?></span></a>
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
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
    <?php endif; ?>
    <li class="divider nomargin--t"></li>
    <li><a href="https://help.orzu.org/help-center/categories/1/orzu">Как пользоваться?</a></li>
    <li><a href="https://help.orzu.org/help-center">Поддержка</a></li>
</ul>
<?php endif; ?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->yieldSection(); ?>
</header>
<?php $__env->startSection('content'); ?>
<?php echo $__env->yieldSection(); ?>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/materialize.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/common.js?791')); ?>"></script>
<?php $__env->startSection('footlink'); ?>
<?php echo $__env->yieldSection(); ?>
<script>
  window.intercomSettings = {
    app_id: "p479kps8",
    <?php if(auth()->guard()->check()): ?>
    name: "<?php echo e(Auth::User()->name); ?>",
    email: "<?php echo e(Auth::User()->email); ?>",
    user_id: "<?php echo e(Auth::User()->id); ?>"
    <?php endif; ?>
};
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/p479kps8';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
</body>
</html><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/base.blade.php ENDPATH**/ ?>