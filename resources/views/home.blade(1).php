@extends('base')
@section('title')
<title>Orzu Услуги - решение любых задач</title>
@endsection
@section('headlink')
<link href="https://fonts.googleapis.com/css?family=Exo+2:500&display=swap&subset=cyrillic" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{ asset('css/animate.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('css/main.css?9') }}" />


<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('header')

@endsection


@section('content')
	<section class="section  _h-heading-text home__transitionY">
		
		<div class="container">
			<div class="row">
				<div class="col m12">
					<div class="section OrzuHTWBlock home__inquiry-input  center-align">
						<h1 class="left-align">Решение любой задачи

						</h1>
						<p class="left-align">Не будем далеко ходить, опубликуем задание прямо сейчас</p>
					</div>
				</div>
				<div class="col m10 push-m1 s12">
					<form method="get" action="{{ route('hometask') }}">
						<div class="OrzuTheNewForm OrzuTheNewFormFirst">
							<div class="--TextInput col m7 s10 push-s1 nopadding--l">
								<input type="text" name="task" id="h-form-input" class="autocomplete nomargin"
									   placeholder="Что нужно сделать?" autocomplete="off" />
							</div>
							<div class="--Button col m5 s8 push-s2">
								<button type="submit" class="waves-effect waves-light btn" id="btn-search">Создать
									заявку</button>
							</div>
						</div>
						<div class="OrzuTheNewFormHelpers col m12 nopadding wow fadeIn" data-wow-delay="0.6s">
							<!-- или взгляните на <a class="OrzuModalTrigger --Categories" data-orzumodal="#modal1">список
                                категорий</a> -->
							<p>Например: <a href="#" id="example-anchor-home">Сделать уборку</a></p>
						</div>
						<div class="OrzuModalContainer">
							<div id="modal1" class="OrzuModal">
								<div class="OrzuModalHeader psrel">
									<h5>Выберите категории услуг <span class="OrzuModalHeaderNavigation hide"
																	   id="OrzuModalHeaderNavigation">Loading...</span></h5>
									<div class="loader" style="display: none;">
										<div class="preloader-wrapper small active">
											<div class="spinner-layer spinner-green-only">
												<div class="circle-clipper left">
													<div class="circle"></div>
												</div>
												<div class="gap-patch">
													<div class="circle"></div>
												</div>
												<div class="circle-clipper right">
													<div class="circle"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="OrzuModalContent">
									<ul class="nomargin--t col m5 ThisIsCatsList nopadding--l" id="ThisIsCatsList">
										@foreach($categories as $cat)
											<li data-id="{{ $cat->id }}" class="ThisIsItemCatsList">
												<?php
												$c = 'no';
												$cats = explode(',',request('cat'));
												for($i=0; $i<=count($cats)-1; $i++){
													if($cat->id==$cats[$i]){
														$c = 'yes';
													}
												}
												?>
												{{ $cat->name }}
											</li>
										@endforeach
									</ul>
									<div class="col m7 ThisIsSubCatsList">
										<ul class="nomargin" id="ThisIsSubCatsList">
											— Выберите категорию
										</ul>
									</div>
								</div>
								<div class="OrzuModalFooter">
									<a class="btn-flat waves-effect waves-light OrzuModalClose"
									   href="javascript:;">отмена</a>
									<a class="btn yellow darken-1 OrzuPromoBtn OrzuPromoBtnShadow waves-effect hide"
									   href="javascript:;">Создать задачу</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	
<div class="section white OrzuHTWBlock cats">
	<div class="row container-fluid">
		<a href="/tasks?cat=126">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Курьерские услуги</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=1">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Установка и ремонт техники</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=20">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Ремонт и строительство</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=39">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Репетиторы и образование</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=141">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Красота и здоровье</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=73">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Уборка и помощь по хозяйству</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=120">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Разработка</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=94">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Компьютерные услуги</p>
			</div>
		</div>
		</a>
		<a href="/tasks?cat=110">
		<div class="col l4 m4 s12 center-align">
			<div class="OrzuHTWBlockIcon cats-each">
				<p>Дизайн</p>
			</div>
		</div>
		</a>




		<div class="row categories-block-hidden">
		<a href="/tasks?cat=63">
			<div class="col l4 m4 s12 center-align">
				<div class="OrzuHTWBlockIcon cats-each">
					<p>Грузовые перевозки</p>
				</div>
			</div>
		</a>
		<a href="/tasks?cat=86">
			<div class="col l4 m4 s12 center-align">
				<div class="OrzuHTWBlockIcon cats-each">
					<p>Виртуальный помощник</p>
				</div>
			</div>
		</a>
		<a href="/tasks?cat=103">
			<div class="col l4 m4 s12 center-align">
				<div class="OrzuHTWBlockIcon cats-each">
					<p>Мероприятия и промо-акции</p>
				</div>
			</div>
		</a>
		<a href="/tasks?cat=134">
			<div class="col l4 m4 s12 center-align">
				<div class="OrzuHTWBlockIcon cats-each">
					<p>Фото- и видео-услуги</p>
				</div>
			</div>
		</a>
		<a href="/tasks?cat=148">
			<div class="col l4 m4 s12 center-align">
				<div class="OrzuHTWBlockIcon cats-each">
					<p>Ремонт цифровой техники</p>
				</div>
			</div>
		</a>
		<a href="/tasks?cat=157">
			<div class="col l4 m4 s12 center-align">
				<div class="OrzuHTWBlockIcon cats-each">
					<p>Юридическая помощь</p>
				</div>
			</div>
		</a>
		<a href="/tasks?cat=163">
			<div class="col l4 m4 s12 center-align">
				<div class="OrzuHTWBlockIcon cats-each">
					<p>Ремонт транспорта</p>
				</div>
			</div>
		</a>
	</div>
	</div>

</div>

<div class="section OrzuHTWBlock">
	<div class="row container-fluid">
		<div class="home__btn-category" id="show-more">
			<p>Все категории</p>
		</div>

	</div>
</div>
<div class="section OrzuHTWBlock">
	<div class="row container-fluid">

		<div class="col l4 m6 s12 center-align">
			<div class="OrzuHTWBlockIcon home__strong-points plusesOfUs">
				<img src="/images/badge-strong-points1.png" alt="" srcset="">
				<h5>Безопасная сделка</h5>
				<p>У аловите свое руки мощные вдохновениевкладывает в ваши творческие </p>
			</div>
		</div>
		<div class="col l4 m6 s12 center-align">
			<div class="OrzuHTWBlockIcon home__strong-points plusesOfUs">
				<img src="/images/badge-strong-points2.png" alt="" srcset="">
				<h5>Проверенные специалисты</h5>
				<p>У аловите свое руки мощные вдохновениевкладывает в ваши творческие </p>
			</div>
		</div>
		<div class="col l4 m12 s12 center-align ">
			<div class="OrzuHTWBlockIcon home__strong-points plusesOfUs">
				<img src="/images/badge-strong-points3.png" alt="" srcset="">
				<h5>Достоверные отзывы</h5>
				<p>У аловите свое руки мощные вдохновениевкладывает в ваши творческие </p>
			</div>
		</div>

	</div>
</div>

<!-- <div class="section  lighten-5 _h-apps">
	<div class="row container valign-wrapper nomargin--b">
		<div class="col m6 center-align">
			<img src="/images/uslugiapp.png" class="wow bounceInUp _phoneImg" data-wow-delay="0.2s" />
		</div>
		<div class="col m6 _desc wow fadeIn" data-wow-delay="0.2s">
			<h4>Доступно для смартфонов</h4>
			<span>Скачайте наши мобильные приложения и заказывайте услуги еще быстрее!</span>
			<div class="_download">
				<a href="#" class="_btn _appstore">AppStore</a>
				<a href="#" class="_btn _googleplay">Google PLay</a>
				<div class="_getsms">
					Получите ссылку на приложение <a href="#" id="_getSMS">по SMS</a>
				</div>
				<div class="_formgetsms animated">
					Недоступно для вашей страны.
				</div>
			</div>
		</div>
	</div>
</div> -->
<div class="section OrzuHTWBlock">
	<div class="row container-fluid">
		<div class="  home__banner--slider">
			<div class="  home__slider">
				<div class="col m5 s0"></div>
				<div class="col m7 s12">
					<div class="home-slider-trigger how-is-it-works-for-users">
						<div>
							<h5>Как это работает для пользователей</h5>
							 <span>1</span> <p>Создайте задачу</p>

							<p>Расскажите нам , что нужно для вас сделать. Укажите время, место и описания</p>
						</div>
						<div>
								<h5>Как это работает для пользователей</h5>
								<span>2</span> <p>Создайте задачу</p>
	
								<p>Расскажите нам , что нужно для вас сделать. Укажите время, место и описания</p>
						</div>
						<div>
								<h5>Как это работает для пользователей</h5>
								<span>3</span> <p>Создайте задачу</p>
	
								<p>Расскажите нам , что нужно для вас сделать. Укажите время, место и описания</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>
</div>
<div class="section OrzuHTWBlock">
	<div class="row container-fluid">
		<div class="home__btn-category2">
			<p>Разместите задание прямо сейчас</p>

		</div>
		<span class="home__btn-category2-span">и найдите исполнителя быстро</span>
	</div>
</div>


<div class="section OrzuHTWBlock">
	<div class="row container-fluid">
		<div class="col s12">
			<h1 class="center-align title-catalog">Наш блог</h1>

		</div>

		<div class="col l4 m8 push-m2 s12 center-align home__banner--text">

			<div class="OrzuHTWBlockIcon home__strong-points home__banner home_banner--bg1">

			</div>
			<p>Как сделать отцифровку и сколько это стоит</p>
			<span>June 6, 2014</span>
		</div>
		<div class="col l4 m8 push-m2 s12 center-align home__banner--text">
			<div class="OrzuHTWBlockIcon home__strong-points home__banner home_banner--bg2">


			</div>
			<p>Парковаться между столбиками и лексусом с бентли - не одно и то же</p>
			<span>June 6, 2014</span>
		</div>
		<div class="col l4 m8 push-m2 s12 center-align home__banner--text ">
			<div class="OrzuHTWBlockIcon home__strong-points  home_banner--bg3">


			</div>
			<p>Помогите дверь закрылась</p>
			<span>June 6, 2014</span>
		</div>

	</div>
</div>
<div class="section OrzuHTWBlock">
	<div class="row container-fluid">
		<div class="col m12 s12 center-align home__banner--text">
			<div class=" home__strong-points home__mob-app ">
				<p>Всё легко и просто в нашем мобильном приложении</p>
				<div class="_download">
					<a href="#" class="_btn _appstore">AppStore</a>
					<a href="#" class="_btn _googleplay">Google PLay</a>
					<!-- <div class="_getsms">
					Получите ссылку на приложение <a href="#" id="_getSMS">по SMS</a>
				</div>
				<div class="_formgetsms animated">
					Недоступно для вашей страны.
				</div> -->
				</div>
			</div>
		</div>

	</div>
</div>


{{--added--}}
{{--</div>--}}



@include('parts.footer')
@endsection
@section('footlink')

@Auth
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>
	Pusher.logToConsole = false;
	var pusher = new Pusher('585acb6bbd7f6860658a', {
		cluster: 'mt1',
		forceTLS: true
	});
	var channel = pusher.subscribe("user.{{ Auth::User()->id }}");
	channel.bind('OrzuPusherEvents', function (data) {
		alert(JSON.stringify(data));
	});
</script>
@endauth
{{--<p>Alex</p>--}}
{{--</div>--}}
<script type="text/javascript" src="{{ asset('js/animate.css.js') }}"></script>
<script>
	new WOW().init();
	//Tasks suggestion
	var input = document.getElementById('h-form-input');
	var awesomplete = new Awesomplete(input, {
		minChars: 1
	});
	$("#h-form-input").on("keyup", function () {
		$.ajax({
			url: '{{ url("/tasks/taskajaxupload?find=") }}' + this.value,
			type: 'GET',
			dataType: 'json'
		}).success(function (data) {
			var list = [];
			$.each(data, function (key, value) {
				list.push(value);
			});
			awesomplete.list = list;
		});
	});



	$('.ThisIsItemCatsList').click(function () {
		var getDataId = $(this).attr("data-id");
		$('.ThisIsItemCatsList').removeClass('actived');
		$(this).addClass('actived');
		$('.loader').show();
		$('#ThisIsSubCatsList').load("/load/subcat", { id: getDataId, _token: "{{ csrf_token() }}" }, function () {
			$('.loader').hide();
		});
	});

	$(document).ready(function () {
		$('.home-slider-trigger').slick({
			dots: true,
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear',
			arrows: false
		});
	});

</script>
{{--<script>--}}
{{--	//Normalize Safari--}}
{{--	if(window.navigator.vendor == "Apple Computer, Inc."){--}}
{{--		let white = $('.white');--}}
{{--		let section = $('.home__transitionY');--}}
{{--		white.css('margin-top',section.height()+(section.height()/2)+'px');--}}
{{--	}--}}
{{--</script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript" src="{{ asset('js/main.js?7') }}"></script>
<script src="{{ asset('js/home_page.js') }}"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>

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
  firebase.analytics();
</script>

<script>
	$('.brand-logo').css({filter:'invert(0)'});
</script>
{{--</div>--}}
@endsection
