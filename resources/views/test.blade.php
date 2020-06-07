<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" src="{{'js/jquery.min.js'}}"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{ asset('js/qrcode.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Exo+2:500&display=swap&subset=cyrillic" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/main.css?9') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
    <script src="{{ asset('js/home_page.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <script src="qrcode.js"></script>--}}
    <style>
        .block {
            display: flex;
            margin: 0 auto;
            justify-content: space-around;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }

        .iphone,
        .android {
            object-fit: contain;
            transition: transform .5s;
            margin-top: 2em;
        }

        .iphone:hover,
        .android:hover {
            transform: scale(0.95);
        }

        .windows {
            margin: 0;
        }

        .OS-each {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .referral-wrap {
            background-color: #ffc804;
            height: 50vh;
            width: 90%;
            position: fixed;
            top: 0;
            bottom: 0;
            right: 50%;
            left: 50%;
            transform: translate(-50%, 50%);
            display: flex;
            justify-content: center;
            align-items: center;
            transition: height 1s;
        }

        .close {
            position: absolute;
            right: -5%;
            top: -15%;
            width: 32px !important;
            height: 32px;
            opacity: 0.3;
            transition: opacity .3s, transform .3s;
        }

        .close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }

        .close:before,
        .close:after {
            position: absolute;
            left: 15px;
            content: ' ';
            height: 33px;
            width: 2px;
            background-color: #333;
        }

        .close:before {
            transform: rotate(45deg);
        }

        .close:after {
            transform: rotate(-45deg);
        }




        .referral-wrap>div {
            width: 100%;
            align-items: center;
        }

        .homePage {
            /*display: flex;
            align-items: center;*/
            height: 3em;
        }
    </style>
</head>

<body>
<!--     <div class="qr-wrap">
    <div id="qrcode" style="margin-top:15px;"></div>
</div> -->
<div class="referral-wrap container row" style="display: none;">
    <div class="close"></div>
    <div class="block col xl12 l12 m12 s12">
        <a href="#" class="download">
        </a>
    </div>
</div>
<script>

    window.onload = function() {

        let device = window.navigator;
        let block = document.querySelector('.block');
        let link = document.querySelector('.download');
        let href = window.location.href;
        let hrefMatch = href.match(/id/gmi);

        // let idCurrent = window.location.pathname.match(/id=\K[0-9|\w]+/gm);
        // let referrerCurrent = window.location.search.match(/referrer=\K\d|\w+/gm);
        let referrerCurrent = window.location.search.split('&');
        let googlePlay = `https://play.google.com/store/apps/details`; //Change this variable to change whole Google Play code,but do not add parameters,they will be added automaticaly
        let appStore = `https://www.apple.com/ios/app-store/`; //Change this variable to change whole Apple code,but do not add parameters,they will be added automaticaly

        let width = 300;
        let height = 300;

        if(window.innerWidth >= 930){
            width = 300;
            height = 300;
        }else if(window.innerWidth >= 500 && window.innerWidth < 930){
            width = 200;
            height = 200;
        }

        //Made for cases if there are more arguments than only one
        let referrerToLink = '';
        for (var i = 0; i < referrerCurrent.length; i++) { //Scary part of code
            if(i!=0){
                referrerToLink += '&' + referrerCurrent[i];
            }else{
                referrerToLink += referrerCurrent[i];
            }
        }


        if (device.platform == 'iPhone' || device.platform == 'iPad' || device.platform == 'iPod' ) {
            block.classList.add('iphone')
            if (referrerCurrent == null) {
                link.setAttribute('href', appStore); //add link to Store
            } else {
                link.setAttribute('href', appStore + referrerToLink);
                appStore += referrerToLink;
            }
            link.innerHTML = `<img class="block iphone" style="width:${width}px;" src="images/appStore.png">`
        } else if (device.platform.match(/Linux armv\dl/g) != null || device.platform == 'Android') {
            block.classList.add('android')
            if (!referrerCurrent) {
                link.setAttribute('href', googlePlay);
            } else {
                link.setAttribute('href', googlePlay + referrerToLink);
                googlePlay += referrerToLink;
            }
            link.innerHTML = `<img class="block android" style="width:${width}px;" src="images/play.png">`;
        } else {

            block.classList.add('windows')
            if (!referrerCurrent) {
                block.innerHTML = `
			<div class="OS-each" style="width:${width}px">
				<div class=android-QR style="width:${width}px;height:${height}px;"></div>
				<a href="https://play.google.com/store/apps/details?id=orzu.org" class="download">
					<img class="block android" style="width:${width}px;" src="images/play.png">
				</a>
			</div>
	
			<a href="/" class="homePage">
				<img src="images/logo.png" alt="" class="anchor-logo">
			</a>
	
			<div class="OS-each" style="width:${width}px">
				<div class=iOS-QR style="width:${width}px;height:${height}px;"></div>
				<a href="AppStore" class="download">
					<img class="block iphone" style="width:${width}px;" src="images/appStore.png">
				</a>
			</div>
		`;
            } else {									//if referral is available
                block.innerHTML = `
		<div class="OS-each" style="width:${width}px">
			<div class=android-QR style="width:${width}px;height:${height}px;"></div>
			<a href="${googlePlay}${referrerToLink}" class="download">
				<img class="block android" style="width:${width}px;" src="images/play.png">
			</a>
		</div>


		<a href="/" class="homePage">
			<img src="images/logo.png" alt="" class="anchor-logo">
		</a>


		<div class="OS-each" style="width:${width}px">
			<div class=iOS-QR style="width:${width}px;height:${height}px;"></div>
			<a href="${appStore}${referrerToLink}" class="download">
				<img class="block iphone" style="width:${width}px;" src="images/appStore.png">
			</a>
		</div>
		`;
                googlePlay += referrerToLink;
                appStore += referrerToLink;
            }

            //QR generation block start
            let qrSets = {
                width: width,
                height: height,
                // Additions
                correctLevel: QRCode.CorrectLevel.H,
                iconSrc: "images/favicon.png",
                iconRadius: 10,
                iconBorderWidth: 0,
                iconBorderColor: "transparent",
                colorDark: "black",
                colorLight: "white",
            }
            let android = document.querySelector('.android-QR');
            let iOS = document.querySelector('.iOS-QR');
            var qrcodeAndroid = new QRCode(android, qrSets);
            var qrcodeiOS = new QRCode(iOS, qrSets);

            function makeCode() {
                qrcodeAndroid.makeCode(googlePlay); //Creating an new QR-code to Play store;
                qrcodeiOS.makeCode(appStore); //TODO: need to append an AppStore link;
            }
            makeCode();
            //QR generation block end
        }

        if(referrerCurrent){
        let objectToSend = {};

        const referrerToSend = ()=>{
            for(var i=0;i<referrerCurrent.length;i++){
                var match = referrerCurrent[i].match(/\b[^=]+/gm);
                var lengthOfObject = Object.keys(objectToSend).length;
                objectToSend[match[0]] = match[1];
            }

        }

        referrerToSend();
        objectToSend.find = 'мастер на час'
        objectToSend.token = "ic1dPmPZnx6O3h1M7HfnxQxH5v3pGxiWg1F3gIIi";
        // console.log(objectToSend);


// referrer
//         const pushToDB = (arg)=>{
//             return fetch('http://www.projectapi.pw/ajaxuploadfilter',{
//                 body:objectToSend,
//                 // headers:"text",
//                 headers:{
//                     'Content-Type':'text/plain'
//                 },
//                 mode:"no-cors",
//                 method:"POST"
//             }).then(ans=>{
//                 console.log(ans.text());
//             }).catch(err=>{
//                 console.error(err);
//             })
//         }
//
//         pushToDB();


            //      $.ajax({
            // 	url : 'http://projectapi.pw/tasks/ajaxupload',                  //change address
            // 	method : "POST",
            // 	data : objectToSend,
            // 	dataType : "text",
            // 	success : function (data) {
            // 		// if(data != '') {
            // 		// 	$('#remove-row').remove();
            // 		// 	$('#load-data').append(data);
            // 		// } else {
            // 		// 	$("#btn-more").html("Больше нет заданий");
            // 		// }
            //         console.log(data);
            // 	}
            // });

        }

        //close listener block start
        function listener(){
            document.querySelector('.referral-wrap').style.display="none";
            removeListener();
        }
        let close = document.querySelector('.close');
        close.addEventListener('click',listener,false);
        function removeListener(){
            close.removeEventListener('click',listener,false);
        }
        //close listener block end


    }
</script>
</body>
</html>