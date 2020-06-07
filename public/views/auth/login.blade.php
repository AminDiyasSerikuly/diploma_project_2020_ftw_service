<!-- <!DOCTYPE html>
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
                    <button type="submit" class="waves-effect waves-light btn blue">
                    {{ App\Lang::getTrans('entry', Config::get('app.locale')) }}
                    войти
                </button>
                </div>
                <div class="captcha"></div>
                <div class="input-field col m12 s12 link--info-reg nomargin">
                    <span>Нет аккаунта? <a href="{{ route('register') }}">Создать аккаунт</a></span>
                    <span class="right hide"><a href="{{ route('register') }}">Восстановить аккаунт</a></span>
                </div>
            </form>
            <div class="progress account--ajax-loader">
                <div class="indeterminate"></div>
            </div> 
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/auth.js?33') }}"></script>
    <script type="text/javascript" src="{{ asset('js/phoneinpt.js?782') }}"></script>
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






<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>
<script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-auth.js"> </script>
<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyD6rFFjuX6JkhsXlTK1ZD4Xch4JMVxsrIc",
    authDomain: "ein-geiles-project.firebaseapp.com",
    databaseURL: "https://ein-geiles-project.firebaseio.com",
    projectId: "ein-geiles-project",
    storageBucket: "ein-geiles-project.appspot.com",
    messagingSenderId: "206857302052",
    appId: "1:206857302052:web:93ad571cf9eafd167128b1",
    measurementId: "G-7SJXBL8LCT"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  const auth = firebase.auth();
  firebase.analytics();
</script>

<script>
    firebase.auth().languageCode = 'ru';
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier($('.captcha')[0], {
        // $('.link--info-reg').eq(0).children('button')[0]
  'size': 'normal',
  'callback': function(response) {
    // reCAPTCHA solved, allow signInWithPhoneNumber.
    // console.log(onSignInSubmit);
    // onSignInSubmit();
    console.log(response);
  }
});
    var phoneNumber = $('#login').val();
    var appVerifier = window.recaptchaVerifier;
    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        .then(function (confirmationResult) {
            
            alert('works');
      // SMS sent. Prompt user to type the code from the message, then sign the
      // user in with confirmationResult.confirm(code).
        window.confirmationResult = confirmationResult;
        console.log(confirmationResult);
        }).catch(function (error) {
            // alert('shit');
            console.error(error);
      // Error; SMS not sent
      // ...
        });

    




    $('.link--info-reg').eq(0).children('button').on('click',function(e){
    e.preventDefault();
    });





</script>

</body>
</html> -->




<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>
<!-- <script src="https://www.gstatic.com/firebasejs/7.5.0/init.js"></script> -->
<script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-auth.js"> </script>
<script src = "https://www.gstatic.com/firebasejs/6.5.0/firebase-firestore.js"> </script>
    <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css" />


        
</head>
<body>

    <!-- The surrounding HTML is left untouched by FirebaseUI.
     Your app may use that space for branding, controls and other customizations.-->
@csrf
<div id="firebaseui-auth-container"></div>
<div id="loader"></div>


<script>
            // window.onload=function(){
        var firebaseConfig = {
            apiKey: "AIzaSyD6rFFjuX6JkhsXlTK1ZD4Xch4JMVxsrIc",
            authDomain: "ein-geiles-project.firebaseapp.com",
            databaseURL: "https://ein-geiles-project.firebaseio.com",
            projectId: "ein-geiles-project",
            storageBucket: "ein-geiles-project.appspot.com",
            messagingSenderId: "206857302052",
            appId: "1:206857302052:web:93ad571cf9eafd167128b1",
            measurementId: "G-7SJXBL8LCT"
        };
    // Initialize the FirebaseUI Widget using Firebase.
      firebase.initializeApp(firebaseConfig);
  const auth = firebase.auth();
  const db = firebase.firestore();
  // db.settings({ timestampsInSnapshots: true });
  firebase.analytics();
    var ui = new firebaseui.auth.AuthUI(firebase.auth());




    var uiConfig = {
  callbacks: {
    signInSuccessWithAuthResult: function(authResult, redirectUrl) {
      // User successfully signed in.
      // Return type determines whether we continue the redirect automatically
      // or whether we leave that to developer to handle.
      return true;
    },
    uiShown: function() {
      // The widget is rendered.
      // Hide the loader.
      document.getElementById('loader').style.display = 'none';
    }
  },
  // Will use popup for IDP Providers sign-in flow instead of the default, redirect.
  signInFlow: 'popup',
  signInSuccessUrl: '?',
  // signInSuccessUrl: window.location.href + '_2dMoFUXFLROcUxf6zpuN2aE4yOdOqquA7f9ICt6e',
  signInOptions: [
    // Leave the lines as is for the providers you want to offer your users.
    // firebase.auth.GoogleAuthProvider.PROVIDER_ID,
    // firebase.auth.FacebookAuthProvider.PROVIDER_ID,
    // firebase.auth.TwitterAuthProvider.PROVIDER_ID,
    // firebase.auth.GithubAuthProvider.PROVIDER_ID,
    // firebase.auth.EmailAuthProvider.PROVIDER_ID,
    firebase.auth.PhoneAuthProvider.PROVIDER_ID
  ],
  // Terms of service url.
  tosUrl: '<your-tos-url>',
  // Privacy policy url.
  privacyPolicyUrl: '<your-privacy-policy-url>'
};




    ui.start('#firebaseui-auth-container', {
  signInOptions : [
        {
            provider:firebase.auth.PhoneAuthProvider.PROVIDER_ID,
            defaultCountry : 'KZ',
            defaultNationalNumber: '7772798347',
            loginHint: '+77772798347'
        },
    firebase.auth.GoogleAuthProvider.PROVIDER_ID,
    firebase.auth.EmailAuthProvider.PROVIDER_ID,

  ],
    // {
        // defaultCountry : 'RU',
    // },
  // Other config options...
    });
    // Initialize the FirebaseUI Widget using Firebase.
    // var ui = new firebaseui.auth.AuthUI(firebase.auth());
    ui.start('#firebaseui-auth-container', uiConfig);
    // }
    </script>

</body>
</html>