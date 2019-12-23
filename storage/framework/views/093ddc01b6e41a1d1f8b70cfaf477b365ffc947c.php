<!DOCTYPE html>
<html>
<head>
    <title>Создание аккаунта</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/materialize.min.css')); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/auth.css?5')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/common.css?782')); ?>"/>
    <?php if(Agent::isMobile()): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/responsive.css?32')); ?>"/>
    <?php endif; ?>
</head>
<body>
    <div class="signup__container">
        <div class="AuthPageLogo">
            <a href="/home"><img src="/svg/logodark.svg"/></a>
        </div>
        <div class="container__child user-login--forms-container">
            <form id="account-creat" method="POST" action="<?php echo e(route('register')); ?>" >
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col m12 s12 logo-box--login">
                        <h5 class="center-align"><?php echo e(App\Lang::getTrans('createaccount', Config::get('app.locale'))); ?></h5>
                    </div>

                    <div class="input-field col m12 s12">
                        <input id="name" type="text"  name="name" value="<?php echo e(old('name')); ?>" autocomplete="off" placeholder="<?php echo e(App\Lang::getTrans('examle_name', Config::get('app.locale'))); ?>" class="validate __sml" required/>
                        <label for="name"><?php echo e(App\Lang::getTrans('yourname', Config::get('app.locale'))); ?></label>
                    </div>
                    <div class="input-field col m12 s12">
                        <input id="login" type="tel" autocomplete="off" value="<?php echo e(old('phone')); ?>" class="validate __sml" required/>
                        <?php if ($errors->has('phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('phone'); ?>                    
                        <span class="helper-text" data-error="wrong" data-success="right"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>

                    <div class="input-field col m12 s12 OrzuInputHelperField">
                        <input id="password" type="password" autocomplete="off" name="password" data-password-validation="true" required/>
                        <label for="password"><?php echo e(App\Lang::getTrans('create_password', Config::get('app.locale'))); ?></label>
                        <span toggle="#password" class="material-icons --tggl-pass">visibility_off</span>
                        <div class="OrzuInputHelper" style="display: none;">
                            <div class="progress password-progress" role="progressbar" data-validation-progress>
                                <div class="progress-meter success" style="width:0%"></div>
                            </div>
                            Пароль должен содержать 8 символов
                        </div>
                    </div>
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <button type="submit" class="waves-effect waves-light btn blue OrzuAuthBtn">
                        <?php echo e(App\Lang::getTrans('letsgo', Config::get('app.locale'))); ?>

                    </button>
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <span>Уже есть аккаунт? <a href="<?php echo e(route('login')); ?>"><?php echo e(App\Lang::getTrans('enterinaccount', Config::get('app.locale'))); ?></a></span>
                </div>
            </form>
            <div class="progress account--ajax-loader">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/materialize.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/common.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/auth.js?5')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/phoneinpt.js?782')); ?>"></script>

</body>
</html><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/auth/register.blade.php ENDPATH**/ ?>