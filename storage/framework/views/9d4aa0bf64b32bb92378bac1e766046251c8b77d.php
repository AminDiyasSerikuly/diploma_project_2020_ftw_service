<!DOCTYPE html>
<html>
<head>
    <title>Подтвердите номер телефона</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/materialize.min.css')); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/auth.css?4')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/common.css?3')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/responsive.css?32')); ?>"/>
</head>
<body class="green lighten-5">
    <div class="signup__container">
        <div class="container__child user-login--forms-container">
            <form id="account-login" method="POST" action="<?php echo e(route('access_to_user')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col m12 s12 logo-box--login">
                    <a href="#" class="link--back-home"><i class="material-icons">arrow_back</i><?php echo e(App\Lang::getTrans('home', Config::get('app.locale'))); ?></a>                    
                    <h5 class="center-align"><?php echo e(App\Lang::getTrans('send_sms', Config::get('app.locale'))); ?></h5>
                </div>
                <div class="row">
                    <div class="input-field col m12 s12">
                        <input id="password" type="text" autocomplete="off" class="validate center-align" placeholder="123456" maxlength="6" name="check_phone" required>
                        <label for="password"><?php echo e(App\Lang::getTrans('sms_code', Config::get('app.locale'))); ?></label>
                        <span class="helper-text">Не получили SMS? <a href="<?php echo e(route('check_phone')); ?>">отправить код повторно</a></span>
                    </div>
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <button type="submit" class="waves-effect waves-light btn blue right">Подтвердить и начать</button>                    
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <span>Указали неверный номер? <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout').submit();">отменить и начать заново</a></span>
                </div>
            </form>
            <form id="logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>  
            <div class="progress account--ajax-loader">
                <div class="indeterminate"></div>
            </div> 
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/materialize.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/common.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/auth.js')); ?>"></script>

</body>
</html><?php /**PATH /var/www/u0668441/data/www/projectapi.pw/resources/views/auth/check_phone.blade.php ENDPATH**/ ?>