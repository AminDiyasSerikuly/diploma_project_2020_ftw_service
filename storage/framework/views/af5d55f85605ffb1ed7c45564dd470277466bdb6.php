<!DOCTYPE html>
<html>
<head>
    <title><?php echo e(App\Lang::getTrans('entry_cabin', Config::get('app.locale'))); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/materialize.min.css')); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/auth.css?9')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/common.css?782')); ?>"/>
    <?php if(Agent::isMobile()): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/responsive.css?32')); ?>"/>
    <?php endif; ?>
</head>
<body>
    <div class="signup__container OrzuAuthLogin">
		<div class="AuthPageLogo">
			<a href="/home"><img src="/svg/logodark.svg"/></a>
		</div>
        <div class="container__child user-login--forms-container">
            <form id="account-login" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col m12 logo-box--login">
                    <h5 class="center-align" id="output"><?php echo e(App\Lang::getTrans('enter_cabinet', Config::get('app.locale'))); ?></h5>
                </div>
                <div class="row">
                    <div class="input-field col m12 s12">
                        <input id="login" type="tel" autocomplete="off" class="validate __sml" value="<?php echo e(old('phone')); ?>" required/>
                    </div>

                    <div class="input-field col m12 s12">
                        <input id="password" type="password" autocomplete="off" class="validate" name="password" required/>
                        <label for="password"><?php echo e(App\Lang::getTrans('yourpassword', Config::get('app.locale'))); ?></label>
                        <span toggle="#password" class="material-icons --tggl-pass">visibility_off</span>
                    </div>
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <button type="submit" class="waves-effect waves-light btn blue"><?php echo e(App\Lang::getTrans('entry', Config::get('app.locale'))); ?></button>
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <span>Нет аккаунта? <a href="<?php echo e(route('register')); ?>">Создать аккаунт</a></span>
                    <span class="right hide"><a href="<?php echo e(route('register')); ?>">Восстановить аккаунт</a></span>
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
    <script type="text/javascript" src="<?php echo e(asset('js/auth.js?33')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/phoneinpt.js?782')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var loginForm = $("#account-login");
            loginForm.submit(function(e){
                e.preventDefault();
                $('.progress').show();
                var formData = loginForm.serialize();
                $.ajax({
                    url: '/login',
                    type:'POST',
                    dataType: 'json',
                    data:formData,
                    success:function(data){
                        M.toast({html: 'Подождите...'});
                        window.location = data.intended;
                        $('.progress').hide();
                    },
                    error: function (data) {
                        var response = $.parseJSON(data.responseText);
                        if(response.message) {
                            M.toast({html: response.message});
                        }
                        $('.progress').hide();
                    }
                });
            });
        });
    </script>
</body>
</html><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/auth/login.blade.php ENDPATH**/ ?>