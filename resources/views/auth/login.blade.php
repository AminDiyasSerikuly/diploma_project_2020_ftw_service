<!DOCTYPE html>
<html>
<head>
    <title>{{ App\Lang::getTrans('entry_cabin', Config::get('app.locale')) }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/auth.css?9') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/common.css?782') }}"/>
    @if(Agent::isMobile())
        <link type="text/css" rel="stylesheet" href="{{ asset('css/responsive.css?32') }}"/>
    @endif
</head>
<body>
<div class="signup__container OrzuAuthLogin">
    <div class="AuthPageLogo">
        <a href="/home"><img src="/svg/logodark.svg"/></a>
    </div>
    <div class="container__child user-login--forms-container">
        <form id="account-login" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="col m12 logo-box--login">
                <h5 class="center-align" id="output">{{ App\Lang::getTrans('enter_cabinet', Config::get('app.locale')) }}</h5>
            </div>
            <div class="row">
                <div class="input-field col m12 s12">
                    <input id="login" type="tel" autocomplete="off" class="validate __sml" value="{{ old('phone') }}" required/>
                </div>

                <div class="input-field col m12 s12">
                    <input id="password" type="password" autocomplete="off" class="validate" name="password" required/>
                    <label for="password">{{ App\Lang::getTrans('yourpassword', Config::get('app.locale')) }}</label>
                    <span toggle="#password" class="material-icons --tggl-pass">visibility_off</span>
                </div>
            </div>
            <div class="input-field col m12 s12 link--info-reg nomargin">
                <button type="submit" class="waves-effect waves-light btn orange">
                    {{ App\Lang::getTrans('entry', Config::get('app.locale')) }}
                    {{--                    войти--}}
                </button>
            </div>
            <div class="captcha"></div>
            <div class="input-field col m12 s12 link--info-reg nomargin">
                <span>Нет аккаунта? <a href="{{ route('register') }}" class="orange-text">Создать аккаунт</a></span>
                {{-- <span class="right"><a href="{{ route('password.update') }}">Восстановить аккаунт</a></span> --}}
                <span class="right"><a class="forgot-button orange-text" href="#">Восстановить аккаунт</a></span>
                {{-- {{ route('password.update') }} --}}
            </div>
        </form>
        <div class="progress account--ajax-loader">
            <div class="indeterminate"></div>
        </div>
    </div>




















    <div class="container__child user-login--forms-container" style="display: none;">
    <!-- {{ route('forgot') }} -->
        <form id="account-forgot" method="POST" action="{{ route('forgot') }}">
            @csrf
            <div class="col m12 logo-box--login">
                <h5 class="center-align" id="output">Восстановление пароля</h5>
            </div>
            <div class="row">
                <div class="input-field col l8 m8 s8">
                    <input id="login-phone" type="text" autocomplete="on" class="validate __sml" value="{{ old('phone') }}" required placeholder="Телефон" name="phone"/>
                </div>

                <div class="input-field col m4 s4 link--info-reg nomargin verify">
                    <button class="waves-effect waves-light btn blue OrzuAuthBtn OrzuCheckPhone remembered-phone">
                        {{--                            {{ App\Lang::getTrans('letsgo', Config::get('app.locale')) }}--}}
                        Проверить
                    </button>
                </div>



                {{--                    verification textfield--}}
                <div class="input-field col l8 m12 s12">
                    <input id="verification" type="text"  autocomplete="off" placeholder="Код из SMS" class="validate __sml" required style="opacity:0;"/>
                    <button class="waves-effect waves-light btn orange OrzuAuthBtn OrzuCheckCode forgotten-code" style="opacity:0;">
                        {{--                            {{ App\Lang::getTrans('letsgo', Config::get('app.locale')) }}--}}
                        Проверить
                    </button>
                </div>


                <div class="input-field col m12 s12">
                    <input id="password-restore" type="password" autocomplete="off" class="validate" name="password" placeholder="Новый пароль" required/>
                    {{-- <label for="password">{{ App\Lang::getTrans('yourpassword', Config::get('app.locale')) }}</label> --}}
                    <span toggle="#password-restore" class="material-icons --tggl-pass">visibility_off</span>
                </div>
            </div>
            <div class="input-field col m12 s12 link--info-reg nomargin">
                <button type="submit" class="waves-effect waves-light btn orange">
                    {{-- App\Lang::getTrans('entry', Config::get('app.locale')) --}}
                    Восстановить
                    {{--                    войти--}}
                </button>
            </div>
            <div class="captcha"></div>
            <div class="input-field col m12 s12 link--info-reg nomargin">
                <span>Нет аккаунта? <a href="{{ route('register') }}" class="orange-text">Создать аккаунт</a></span>

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
<script type="text/javascript" src="{{ asset('js/auth.js?33') }}"></script>
<script type="text/javascript" src="{{ asset('js/Verify.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/phoneinpt.js?782') }}"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>


<script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-firestore.js"> </script>
<script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
<script type="text/javascript" src="{{ asset('js/firebase-auth.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function(){
        //блок проверки поля номера телефона
        let phone = document.querySelector('#login');
        const login = new Verify(phone);
        login.keyup();

        let restorePhone = document.querySelector('#login-phone');
        const phoneVerificationOnRestore = new Verify(restorePhone);
        phoneVerificationOnRestore.keyup();
        //конец блока проверки номера телефона

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






{{--<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>--}}
{{--<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>--}}
{{--<script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-auth.js"> </script>--}}
{{--<script>--}}
{{--  // Your web app's Firebase configuration--}}
{{--  var firebaseConfig = {--}}
{{--    apiKey: "AIzaSyD6rFFjuX6JkhsXlTK1ZD4Xch4JMVxsrIc",--}}
{{--    authDomain: "ein-geiles-project.firebaseapp.com",--}}
{{--    databaseURL: "https://ein-geiles-project.firebaseio.com",--}}
{{--    projectId: "ein-geiles-project",--}}
{{--    storageBucket: "ein-geiles-project.appspot.com",--}}
{{--    messagingSenderId: "206857302052",--}}
{{--    appId: "1:206857302052:web:93ad571cf9eafd167128b1",--}}
{{--    measurementId: "G-7SJXBL8LCT"--}}
{{--  };--}}
{{--  // Initialize Firebase--}}
{{--  firebase.initializeApp(firebaseConfig);--}}
{{--  const auth = firebase.auth();--}}
{{--  firebase.analytics();--}}
{{--</script>--}}

{{--<script>--}}
{{--    firebase.auth().languageCode = 'ru';--}}
{{--    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier($('.captcha')[0], {--}}
{{--        // $('.link--info-reg').eq(0).children('button')[0]--}}
{{--  'size': 'normal',--}}
{{--  'callback': function(response) {--}}
{{--    // reCAPTCHA solved, allow signInWithPhoneNumber.--}}
{{--    // console.log(onSignInSubmit);--}}
{{--    // onSignInSubmit();--}}
{{--    console.log(response);--}}
{{--  }--}}
{{--});--}}
{{--    var phoneNumber = $('#login').val();--}}
{{--    var appVerifier = window.recaptchaVerifier;--}}
{{--    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)--}}
{{--        .then(function (confirmationResult) {--}}

{{--            alert('works');--}}
{{--      // SMS sent. Prompt user to type the code from the message, then sign the--}}
{{--      // user in with confirmationResult.confirm(code).--}}
{{--        window.confirmationResult = confirmationResult;--}}
{{--        console.log(confirmationResult);--}}
{{--        }).catch(function (error) {--}}
{{--            // alert('shit');--}}
{{--            console.error(error);--}}
{{--      // Error; SMS not sent--}}
{{--      // ...--}}
{{--        });--}}






{{--    // $('.link--info-reg').eq(0).children('button').on('click',function(e){--}}
{{--    // e.preventDefault();--}}
{{--    // });--}}





{{--</script>--}}

</body>
</html>




{{--<!DOCTYPE html>--}}
{{--<html lang="ru">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Document</title>--}}

{{--    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>--}}


{{--    <script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>--}}
{{--<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>--}}
{{--<script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-auth.js"> </script>--}}
{{--<script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-firestore.js"> </script>--}}
{{--    <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>--}}
{{--    <script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>--}}
{{--    <script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>--}}
{{--    <!-- <script src="https://www.gstatic.com/firebasejs/7.5.0/init.js"></script> -->--}}
{{--    <script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-auth.js"> </script>--}}
{{--    <script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-firestore.js"> </script>--}}
{{--    <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>--}}
{{--    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}
{{--    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css" />--}}



{{--</head>--}}
{{--<body>--}}

{{--    <!-- The surrounding HTML is left untouched by FirebaseUI.--}}
{{--     Your app may use that space for branding, controls and other customizations.-->--}}
{{--@csrf--}}
{{--<div id="firebaseui-auth-container"></div>--}}
{{--<div id="loader"></div>--}}

{{--    <div id="capt"></div>--}}
{{--    <!-- Add two inputs for "phoneNumber" and "code" -->--}}
{{--    <input type="tel" id="phoneNumber" />--}}
{{--    <input type="text" id="code" />--}}

{{--    <!-- Add two buttons to submit the inputs -->--}}
{{--    <!-- Add two inputs for "phoneNumber" and "code" -->--}}
{{--    <input type="tel" id="phoneNumber" value="+77772798347" />--}}
{{--    <input type="text" id="code" value="123456"/>--}}

{{--    <!-- Add two buttons to submit the inputs -->--}}
{{--    <button id="sign-in-button" onclick="submitPhoneNumberAuth()">--}}
{{--        SIGN IN WITH PHONE--}}
{{--    </button>--}}
{{--    <button id="confirm-code" onclick="submitPhoneNumberAuthCode()">--}}
{{--        ENTER CODE--}}
{{--    </button>--}}

{{--    <!-- Add a container for reCaptcha -->--}}
{{--    <div id="recaptcha-container"></div>--}}

{{--    <!-- Add the latest firebase dependecies from CDN -->--}}
{{--    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>--}}
{{--    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>--}}

{{--    <script>--}}
{{--        // Paste the config your copied earlier--}}
{{--        var firebaseConfig = {--}}
{{--            apiKey: "AIzaSyD6rFFjuX6JkhsXlTK1ZD4Xch4JMVxsrIc",--}}
{{--            authDomain: "ein-geiles-project.firebaseapp.com",--}}
{{--            databaseURL: "https://ein-geiles-project.firebaseio.com",--}}
{{--            projectId: "ein-geiles-project",--}}
{{--            storageBucket: "ein-geiles-project.appspot.com",--}}
{{--            messagingSenderId: "206857302052",--}}
{{--            appId: "1:206857302052:web:93ad571cf9eafd167128b1",--}}

{{--            // apiKey: "AIzaSyB8Kxq0YvdYQwsW1v9tDYDOw67flbMxdEU",--}}
{{--            // authDomain: "medium-d924f.firebaseapp.com",--}}
{{--            // databaseURL: "https://medium-d924f.firebaseio.com",--}}
{{--            // projectId: "medium-d924f",--}}
{{--            // storageBucket: "",--}}
{{--            // messagingSenderId: "488630368524",--}}
{{--            // appId: "1:488630368524:web:dad0e9e3dc65b2ff"--}}
{{--        };--}}
{{--        firebase.initializeApp(firebaseConfig);--}}

{{--        let verify;--}}
{{--        let phone;--}}
{{--        // Create a Recaptcha verifier instance globally--}}
{{--        // Calls submitPhoneNumberAuth() when the captcha is verified--}}
{{--        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(--}}
{{--            "recaptcha-container",--}}
{{--            {--}}
{{--                size: "invisible",--}}
{{--                callback: function(response) {--}}
{{--                    submitPhoneNumberAuth();--}}
{{--                }--}}
{{--            }--}}
{{--        );--}}
{{--        // This function runs when the 'sign-in-button' is clicked--}}
{{--        // Takes the value from the 'phoneNumber' input and sends SMS to that phone number--}}
{{--        function submitPhoneNumberAuth() {--}}
{{--            var phoneNumber = document.getElementById("phoneNumber").value;--}}
{{--            var appVerifier = window.recaptchaVerifier;--}}
{{--            // console.log(appVerifier);--}}
{{--            firebase--}}
{{--                .auth()--}}
{{--                .signInWithPhoneNumber(phoneNumber, appVerifier)--}}
{{--                .then(function(confirmationResult) {--}}
{{--                    verify = appVerifier;--}}
{{--                    phone = phoneNumber;--}}
{{--                    console.log(verify);--}}
{{--                    window.confirmationResult = confirmationResult;--}}
{{--                    // test();--}}
{{--                })--}}
{{--                .catch(function(error) {--}}
{{--                    console.log(error);--}}
{{--                });--}}
{{--        }--}}
{{--        // This function runs when the 'confirm-code' button is clicked--}}
{{--        // Takes the value from the 'code' input and submits the code to verify the phone number--}}
{{--        // Return a user object if the authentication was successful, and auth is complete--}}
{{--        function submitPhoneNumberAuthCode() {--}}
{{--            var code = document.getElementById("code").value;--}}
{{--            confirmationResult--}}
{{--                .confirm(code)--}}
{{--                .then(function(result) {--}}
{{--                    // async function signin() {--}}
{{--                    //     // console.log(firebase.auth.RecaptchaVerifier);--}}
{{--                    //     console.log('signing in')--}}
{{--                    //     // signInWithEmailAndPassword--}}
{{--                    //     let creds = await firebase.auth().signInWithPhoneNumber('+77772798347', verify)--}}
{{--                    //     // let creds = await firebase.auth().signInWithEmailAndPassword('bayernummer1@gmail.com', 'tester');--}}
{{--                    //     console.log({ creds } +' creds')--}}
{{--                    //     // let token = await creds.user.getIdToken()--}}
{{--                    //     // console.log({ token } + ' token')--}}
{{--                    //     // let headers = { Authorization: 'Bearer ' + token }--}}
{{--                    //     // let me = await axios.get('/api/me', { headers })--}}
{{--                    //     // console.log({ me } + ' me')--}}
{{--                    // }--}}
{{--                    // signin();--}}

{{--                        var user = result.user;--}}
{{--                        console.log(user.l);--}}
{{--                        test(user.l);--}}

{{--                })--}}
{{--                .catch(function(error) {--}}
{{--                    console.log(error);--}}
{{--                });--}}
{{--        }--}}
{{--        //This function runs everytime the auth state changes. Use to verify if the user is logged in--}}
{{--        firebase.auth().onAuthStateChanged(function(user) {--}}
{{--            if (user) {--}}
{{--                console.log("USER LOGGED IN");--}}
{{--            } else {--}}
{{--                // No user is signed in.--}}
{{--                console.log("USER NOT LOGGED IN");--}}
{{--            }--}}
{{--        });--}}
{{--        async function test(arg) {--}}

{{--                return fetch('/api/me',{--}}
{{--                    method:'GET',--}}
{{--                    headers: {--}}
{{--                        // Authorization: 'Bearer' + verify,--}}
{{--                        Authorization: 'Bearer '+arg,--}}
{{--                    }--}}
{{--                })--}}
{{--                    .then(ans=>{--}}
{{--                        // console.log(ans.text());--}}
{{--                        return ans.text();--}}
{{--                    })--}}
{{--                    .then(res=>{--}}
{{--                    console.log(res);--}}
{{--                    })--}}
{{--                    .catch(err=>{--}}
{{--                        console.error(err)--}}
{{--                    })--}}
{{--            }--}}
{{--            // let creds = await firebase.auth().signInWithPhoneNumber(document.querySelector('#tel').value, verify)--}}
{{--            // // let creds = await firebase.auth().signInWithEmailAndPassword('bayernummer1@gmail.com', 'tester');--}}
{{--            // console.log(creds)--}}
{{--            // // console.log(creds.user);--}}
{{--            // // let token = await creds.user.getIdToken()--}}
{{--            // // console.log({ token } + ' token')--}}
{{--            // let headers = { Authorization: 'Bearer ' + verify }--}}
{{--            // let me = await axios.get('/api/me', { headers })--}}
{{--            // console.log({ me } + ' me')--}}



{{--            // let headers = {Authorization: 'Bearer' + verify};--}}
{{--            // let me = await axios.get('api/me', {headers});--}}
{{--            // console.log(me);--}}
{{--        // }--}}
{{--    </script>--}}




{{--    <script>--}}








{{--    //     var config = {--}}
{{--    //         apiKey: "AIzaSyD6rFFjuX6JkhsXlTK1ZD4Xch4JMVxsrIc",--}}
{{--    //         authDomain: "ein-geiles-project.firebaseapp.com",--}}
{{--    //         databaseURL: "https://ein-geiles-project.firebaseio.com",--}}
{{--    //         projectId: "ein-geiles-project",--}}
{{--    //         storageBucket: "ein-geiles-project.appspot.com",--}}
{{--    // };--}}
{{--    // firebase.initializeApp(config);--}}
{{--    // // const auth = firebase.auth();--}}
{{--    //--}}
{{--    // // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('firebaseui-auth-container');--}}
{{--    //--}}
{{--    // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(document.querySelector('#capt'), {--}}
{{--    //     'size': 'normal',--}}
{{--    //     'callback': function(response) {--}}
{{--    //         // reCAPTCHA solved, allow signInWithPhoneNumber.--}}
{{--    //         onSignInSubmit();--}}
{{--    //     }--}}
{{--    // });--}}
{{--    //--}}
{{--    // async function signin() {--}}
{{--    //     // console.log(firebase.auth.RecaptchaVerifier);--}}
{{--    //     console.log('signing in')--}}
{{--    //     // signInWithEmailAndPassword--}}
{{--    //     let creds = await firebase.auth().signInWithPhoneNumber('+77772798347', verify)--}}
{{--    //     // let creds = await firebase.auth().signInWithEmailAndPassword('bayernummer1@gmail.com', 'tester');--}}
{{--    //     console.log({ creds } +' creds')--}}
{{--    //     let token = await creds.user.getIdToken()--}}
{{--    //     console.log({ token } + ' token')--}}
{{--    //     let headers = { Authorization: 'Bearer ' + token }--}}
{{--    //     let me = await axios.get('/api/me', { headers })--}}
{{--    //     console.log({ me } + ' me')--}}
{{--    // }--}}
{{--    // // signin();--}}

























{{--//     var firebaseConfig = {--}}
{{--//         apiKey: "AIzaSyD6rFFjuX6JkhsXlTK1ZD4Xch4JMVxsrIc",--}}
{{--//         authDomain: "ein-geiles-project.firebaseapp.com",--}}
{{--//         databaseURL: "https://ein-geiles-project.firebaseio.com",--}}
{{--//         projectId: "ein-geiles-project",--}}
{{--//         storageBucket: "ein-geiles-project.appspot.com",--}}
{{--//         messagingSenderId: "206857302052",--}}
{{--//         appId: "1:206857302052:web:93ad571cf9eafd167128b1",--}}
{{--//         measurementId: "G-7SJXBL8LCT"--}}
{{--//     };--}}
{{--//     // Initialize the FirebaseUI Widget using Firebase.--}}
{{--//       firebase.initializeApp(firebaseConfig);--}}
{{--//     const auth = firebase.auth();--}}
{{--//   const db = firebase.firestore();--}}
{{--//   // db.settings({ timestampsInSnapshots: true });--}}
{{--//   firebase.analytics();--}}
{{--//     var ui = new firebaseui.auth.AuthUI(firebase.auth());--}}
{{--//     var url;--}}
{{--//--}}
{{--//--}}
{{--//--}}
{{--//     var uiConfig = {--}}
{{--//   callbacks: {--}}
{{--//     signInSuccessWithAuthResult: function(authResult, redirectUrl) {--}}
{{--//       // User successfully signed in.--}}
{{--//       // Return type determines whether we continue the redirect automatically--}}
{{--//       // or whether we leave that to developer to handle.--}}
{{--//         console.log(firebase.auth)--}}
{{--//         // console.log(authResult)--}}
{{--//         // if(authResult.additionalUserInfo.isNewUser){--}}
{{--//             // return fetch(window.location.origin+'register',{--}}
{{--//             //     method:'POST',--}}
{{--//             //     body:[authResult.user.phoneNumber]--}}
{{--//             // }).then(ans=>{--}}
{{--//             //     console.log(ans);--}}
{{--//             // }).catch(err=>{--}}
{{--//             //     console.error(err);--}}
{{--//             // })--}}
{{--//             // redirectUrl=window.location.origin+'/register?email='+authResult.user.phoneNumber+'&password=def';--}}
{{--//             // console.log(uiConfig.signInSuccesUrl);--}}
{{--//             // console.log(firebase.auth.PhoneAuthProvider);--}}
{{--//         // }--}}
{{--//         setTimeout( ()=>{--}}
{{--//             return true;--}}
{{--//         },10000000000);--}}
{{--//--}}
{{--//     },--}}
{{--//     uiShown: function() {--}}
{{--//       // The widget is rendered.--}}
{{--//       // Hide the loader.--}}
{{--//       document.getElementById('loader').style.display = 'none';--}}
{{--//     }--}}
{{--//   },--}}
{{--//   // Will use popup for IDP Providers sign-in flow instead of the default, redirect.--}}
{{--//   signInFlow: 'popup',--}}
{{--//   // signInSuccessUrl: window.location.origin+'/login',--}}
{{--//     signInSuccessUrl: '?',--}}
{{--//   // signInSuccessUrl: window.location.href + '_2dMoFUXFLROcUxf6zpuN2aE4yOdOqquA7f9ICt6e',--}}
{{--//   signInOptions: [--}}
{{--//     // Leave the lines as is for the providers you want to offer your users.--}}
{{--//     // firebase.auth.GoogleAuthProvider.PROVIDER_ID,--}}
{{--//     // firebase.auth.FacebookAuthProvider.PROVIDER_ID,--}}
{{--//     // firebase.auth.TwitterAuthProvider.PROVIDER_ID,--}}
{{--//     // firebase.auth.GithubAuthProvider.PROVIDER_ID,--}}
{{--//     // firebase.auth.EmailAuthProvider.PROVIDER_ID,--}}
{{--//     // firebase.auth.PhoneAuthProvider.PROVIDER_ID--}}
{{--//       {--}}
{{--//           provider:firebase.auth.PhoneAuthProvider.PROVIDER_ID,--}}
{{--//           defaultCountry : 'KZ',--}}
{{--//           defaultNationalNumber: '7772798347',--}}
{{--//           loginHint: '+77772798347'--}}
{{--//       }--}}
{{--//   ],--}}
{{--//   // Terms of service url.--}}
{{--//   tosUrl: '<your-tos-url>',--}}
{{--//   // Privacy policy url.--}}
{{--//   privacyPolicyUrl: '<your-privacy-policy-url>'--}}
{{--// };--}}
{{--//--}}
{{--//--}}
{{--//--}}
{{--//--}}
{{--//     ui.start('#firebaseui-auth-container', {--}}
{{--//   signInOptions : [--}}
{{--//         {--}}
{{--//             provider:firebase.auth.PhoneAuthProvider.PROVIDER_ID,--}}
{{--//             defaultCountry : 'KZ',--}}
{{--//             // defaultNationalNumber: '7772798347',--}}
{{--//             // loginHint: '+77772798347'--}}
{{--//         },--}}
{{--//     // firebase.auth.GoogleAuthProvider.PROVIDER_ID,--}}
{{--//     // firebase.auth.EmailAuthProvider.PROVIDER_ID,--}}
{{--//--}}
{{--//   ],--}}
{{--//     // {--}}
{{--//         // defaultCountry : 'RU',--}}
{{--//     // },--}}
{{--//   // Other config options...--}}
{{--//     });--}}
{{--//     // Initialize the FirebaseUI Widget using Firebase.--}}
{{--//     // var ui = new firebaseui.auth.AuthUI(firebase.auth());--}}
{{--//     ui.start('#firebaseui-auth-container', uiConfig);--}}

{{--    </script>--}}

{{--</body>--}}
{{--</html>--}}