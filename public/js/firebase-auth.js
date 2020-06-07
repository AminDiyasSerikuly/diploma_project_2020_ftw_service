$(document).ready(function() {
    let allowed = false;

    if (window.location.pathname == '/register') {
        // verificator('verification','.OrzuCheckPhone','.OrzuCheckCode',"login",'password','#account');      //register
        verificator('verification', '.OrzuCheckPhone', '.OrzuCheckCode', "login", 'password', '#account-creat'); //register
    } else if (window.location.pathname == '/login') {
        allowed = true;
        verificator('verification', '.remembered-phone', '.forgotten-code', "login-phone", 'password-restore', '#account-forgot'); //forgotten pass
    }

    function verificator(id, phoneCheck, code, phoneFieldId, pass, formId) {

        // 'verification','.OrzuCheckPhone','.OrzuCheckCode',"login",'password'

        // Paste the config you've copied earlier
        let tryCount = 0;
        let verification = document.getElementById(id);
        let orzuCheckPhone = document.querySelector(phoneCheck);
        let orzuCheckCode = document.querySelector(code);
        if (allowed) {
            orzuCheckCode.style.display = 'none';
        }
        let usedForm = $(formId);

        var firebaseConfig = {
            // apiKey: 'AIzaSyCu7s0a2oT5KPps7vykrUeLLk0LvhOgE0o',
            // authDomain: "orzu-pusher.firebaseapp.com",
            // databaseURL: "https://orzu-pusher.firebaseio.com",
            // projectId: "orzu-pusher",
            // storageBucket: "orzu-pusher.appspot.com",


            // apiKey: "AIzaSyD6rFFjuX6JkhsXlTK1ZD4Xch4JMVxsrIc",
            // authDomain: "ein-geiles-project.firebaseapp.com",
            // databaseURL: "https://ein-geiles-project.firebaseio.com",
            // projectId: "ein-geiles-project",
            // storageBucket: "ein-geiles-project.appspot.com",
            // messagingSenderId: "206857302052",
            // appId: "1:206857302052:web:93ad571cf9eafd167128b1",
            // measurementId: "G-7SJXBL8LCT"


            apiKey: "AIzaSyCu7s0a2oT5KPps7vykrUeLLk0LvhOgE0o",
            authDomain: "orzu-pusher.firebaseapp.com",
            databaseURL: "https://orzu-pusher.firebaseio.com",
            projectId: "orzu-pusher",
            storageBucket: "orzu-pusher.appspot.com",
            messagingSenderId: "566295266578",
            appId: "1:566295266578:web:79cf582f651b63a9469fcb",
            measurementId: "G-R89DDHS6BX"


            // messagingSenderId: "206857302052",
            // appId: "1:206857302052:web:93ad571cf9eafd167128b1",
        };
        firebase.initializeApp(firebaseConfig);
        // Create a Recaptcha verifier instance globally
        // Calls submitPhoneNumberAuth() when the captcha is verified




        // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        //     "recaptcha-container", {
        //         size: "normal",
        //         callback: function(response) {
        //             // orzuCheckCode.style.opacity=1;
        //             console.log(response.data);
        //             submitPhoneNumberAuth();
        //         }
        //     }
        // );

        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': function(response) {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                // ...
                console.log(response.data);
                submitPhoneNumberAuth();
            },
            'expired-callback': function() {
                // Response expired. Ask user to solve reCAPTCHA again.
                // ...
		grecaptcha.reset(window.recaptchaWidgetId);
                console.log("Captcha not okey");
            }
        });


        // This function runs when the 'sign-in-button' is clicked
        // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
        function submitPhoneNumberAuth() {
            var phoneNumber = document.getElementById(phoneFieldId).value;
            var appVerifier = window.recaptchaVerifier;
            firebase
                .auth()
                .signInWithPhoneNumber(phoneNumber, appVerifier)
                .then(function(confirmationResult) {
                    window.confirmationResult = confirmationResult;

                })
                .catch(function(error) {
                    console.log(error);
                    // setTimeout(function() {

                    // }, 2000);
                    grecaptcha.reset(window.recaptchaWidgetId);

                    // if(tryCount<10){
                    //     tryCount++;
                    //     submitPhoneNumberAuth();
                    // }

                });


            // var provider = new firebase.auth.PhoneAuthProvider();
            // provider.verifyPhoneNumber(phoneNumber, appVerifier)
            //     .then(function(verificationId) {
            //         var verificationCode = window.prompt('Please enter the verification ' +
            //             'code that was sent to your mobile device.');
            //         document.getElementById('verification').value = verificationCode;
            //         return firebase.auth.PhoneAuthProvider.credential(verificationId,
            //             verificationCode);
            //     })
            //     .then(function(phoneCredential) {
            //         return firebase.auth().signInWithCredential(phoneCredential);
            //     });

        }
        // This function runs when the 'confirm-code' button is clicked
        // Takes the value from the 'code' input and submits the code to verify the phone number
        // Return a user object if the authentication was successful, and auth is complete
        function submitPhoneNumberAuthCode() {
            var code = document.getElementById('verification').value;
            confirmationResult
                .confirm(code)
                .then(function(result) {
                    var user = result.user;
                    // test(user.l);
                    console.log(user);
                    verification.style.borderColor = '#26A69A';

                })
                .catch(function(error) {
                    verification.style.borderColor = '#F44336';
                    console.log(error);
                });
        }
        //This function runs everytime the auth state changes. Use to verify if the user is logged in
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                // console.log(user.uid);
                //document.getElementById(pass).disabled = false;
                //usedForm.append('<input name="uid" value="' + user.uid + '" type="hidden"/>');
                // $('#recaptcha-container').children().remove();
                if (allowed) {

                    //                     let pathToSend = '';
                    //                     if(allowed){
                    //                         pathToSend = '/forgot?';
                    //                     } else {
                    //                         pathToSend = '/register';
                    //                     }

                    // console.log(usedForm.serialize());
                    usedForm.on('submit', function(e) {
                        $(usedForm).off();
                        e.preventDefault();
                    });
                    $.ajax({
                        url: '/forgot?',
                        type: 'POST',
                        dataType: 'json',
                        data: usedForm.serialize(),
                        success: function(data) {
                            $('input[name="uid"]').val('');
                            $('.validate').val('');
                            changeBlock('t');
                            console.log(data);
                        },
                        error: function(err) {
                            console.error(err);
                        }
                    })

                } else {
                    usedForm.on('submit', function(e) {
                        e.preventDefault();

                    });
                    $.ajax({
                        url: '/register',
                        type: 'POST',
                        dataType: 'json',
                        data: usedForm.serialize(),
                        success: function(data) {
                            console.log(data);
                            // window.location.href='/home';
                        },
                        error: function(err) {
                            console.error(err);
                            if (err.status == 200) {
                                window.location.href = '/home';
                            }

                        }
                    })
                }
                //                     let pathToSend = '';
                //                     if(allowed){
                //                         pathToSend = '/forgot?';
                //                     } else {
                //                         pathToSend = '/register';
                //                     }
                //
                //                     // console.log(usedForm.serialize());
                //                     usedForm.on('submit',function(e){
                //                         e.preventDefault();
                //                         $.ajax({
                //                             url: pathToSend,
                //                             type: 'POST',
                //                             dataType: 'json',
                //                             data: usedForm.serialize(),
                //                             success: function(data) {
                //                                 if(allowed){
                //                                     usedForm.children('input[class="validate __sml"]').val('');
                //                                     usedForm.children('input[name="uid"]').remove();
                //                                     usedForm.children('input[name="password"]').val('');
                //                                     usedForm.children('input[name="phone"]').val('');
                //                                     changeBlock('t');
                //                                 } else {
                //                                     window.location.href='/home';
                //                                 }
                // console.log(data);
                //                             },
                //                             error: function(err) {
                //                                 console.error(err);
                //                             }
                //                         })
                //                     });



                console.log("USER LOGGED IN");
            } else {
                // No user is signed in.
                console.log("USER NOT LOGGED IN");
            }
        });



        orzuCheckPhone.addEventListener('click', function(e) {
            e.preventDefault();
            verification.style.opacity = 1;
            // orzuCheckCode.style.opacity=1;
            submitPhoneNumberAuth();
        });
        $(usedForm).on('submit', function(e) {
            e.preventDefault();
            submitPhoneNumberAuthCode();
        });
    }






    $('.forgot-button').on('click', function(e) {
        e.preventDefault();
        changeBlock();
    })

    let checker = false;
    let element = $('.container__child');

    function changeBlock(removeBlock) {
        if (removeBlock != 't') {
            if (!checker) {
                element.eq(0).fadeOut('slow', 'linear', function() {
                    element.eq(1).fadeIn('slow', 'linear');
                });

                checker = !checker;
            } else {
                element.eq(1).fadeOut('slow', 'linear', function() {
                    element.eq(0).fadeIn('slow', 'linear');
                });

                checker = !checker;
            }
        } else {
            // element.eq(1).hide('slow');
            // element.eq(0).show('slow');
            element.eq(1).fadeOut('slow', 'linear', function() {
                element.eq(0).fadeIn('slow', 'linear');
            });
            checker = !checker;
            // element.eq(1).remove();
        }
    }










});
