<!DOCTYPE html>
<html>
<head>
    <title>Создание аккаунта</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/auth.css?5') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/common.css?782') }}"/>
    @if(Agent::isMobile())
    <link type="text/css" rel="stylesheet" href="{{ asset('css/responsive.css?32') }}"/>
    @endif
</head>
<body>
    <div class="signup__container">
        <div class="AuthPageLogo">
            <a href="/home"><img src="/svg/logodark.svg"/></a>
        </div>
        <div class="container__child user-login--forms-container">
            <form id="account-creat" method="POST" action="{{ route('register') }}" >
                @csrf
                <div class="row">
                    <div class="col m12 s12 logo-box--login">
                        <h5 class="center-align">{{ App\Lang::getTrans('createaccount', Config::get('app.locale')) }}</h5>
                    </div>

                    <div class="input-field col m12 s12">
                        <input id="name" type="text"  name="name" value="{{ old('name') }}" autocomplete="off" placeholder="{{ App\Lang::getTrans('examle_name', Config::get('app.locale')) }}" class="validate __sml" required/>
                        <label for="name">{{ App\Lang::getTrans('yourname', Config::get('app.locale')) }}</label>
                    </div>
                    <div class="input-field col m8 s8">
                        <input id="login" type="tel" autocomplete="off" value="{{ old('phone') }}" class="validate __sml" required/>
                        @error('phone')
                        <span class="helper-text" data-error="wrong" data-success="right">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-field col m4 s4 link--info-reg nomargin verify">
                        <button class="waves-effect waves-light btn orange OrzuAuthBtn OrzuCheckPhone">
{{--                            {{ App\Lang::getTrans('letsgo', Config::get('app.locale')) }}--}}
                            Проверить
                        </button>
                    </div>



{{--                    verification textfield--}}
                    <div class="input-field col m12 s12">
                        <input id="verification" type="text"  autocomplete="off" placeholder="Код из SMS" class="validate __sml"/>
                        <button class="waves-effect waves-light btn orange OrzuAuthBtn OrzuCheckCode">
                            {{--                            {{ App\Lang::getTrans('letsgo', Config::get('app.locale')) }}--}}
                            Проверить
                        </button>
                    </div>


                    <div class="input-field col m12 s12 OrzuInputHelperField">
                        <input id="password" type="password" autocomplete="off" name="password" data-password-validation="true" required />
                        <label for="password">{{ App\Lang::getTrans('create_password', Config::get('app.locale')) }}</label>
                        <span toggle="#password" class="material-icons --tggl-pass">visibility_off</span>
                        <div class="OrzuInputHelper" style="display: none;">
                            <div class="progress password-progress" role="progressbar" data-validation-progress>
                                <div class="progress-meter success" style="width:0%"></div>
                            </div>
                            Пароль должен содержать 8 символов
                        </div>
			 <div class="g-recaptcha" data-sitekey="{!! env('RECAPTCHA_SITE_KEY') !!}"></div> 
                    </div>
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <button type="submit" class="waves-effect waves-light btn orange OrzuAuthBtn">
                        {{ App\Lang::getTrans('letsgo', Config::get('app.locale')) }}
                    </button>
                </div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <span>Уже есть аккаунт? <a href="{{ route('login') }}" class="orange-text">{{ App\Lang::getTrans('enterinaccount', Config::get('app.locale')) }}</a></span>
                </div>
            </form>
            <div class="progress account--ajax-loader">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
    <div id="recaptcha-container"></div>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/auth.js?5') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Verify.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/phoneinpt.js?782') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>
    <script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-firestore.js"> </script>
    <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
    <script type="text/javascript" src="{{ asset('js/firebase-auth.js') }}"></script>
    

</body>
</html>
