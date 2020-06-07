@extends('base')
@section('title')
<title>Orzu Услуги - Как стать исполнителем и зарабатывать?</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/animate.css') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/hellotaskers.css?3') }}"/>
@endsection
@section('header')

@if(Agent::isDesktop())
<section class="section white _h-heading-text">
	<div class="container">
		<div class="row">
			<div class="col m12">
				<h1 class="left-align">Зарабатывайте деньги любым способом 
					<span class="__desc">Наша платформа помогает зарабатывать и находить клиентов для любых видов услуг и специализаций.</span>
				</h1>
			</div>
		</div>
	</div>
</section>
@endif

@endsection


@section('content')
@if(!Agent::isMobile())
<div class="section white OrzuHTWBlock">
	<div class="row container">
		<div class="center-align _h-heading">
			<h4 class="wow fadeIn">Как стать исполнителем</h4>
		</div>

		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/uploads/register.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">1. Создайте кабинет</div>
			<div class="OrzuHTWBlockDescript">Если у вас еще нет аккаунта на нашем сайте, создайте его по <a href="/resigter?backUrl=hellotaskers">ссылке</a>.</div>
		</div>
		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/uploads/substrtasks.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">2. Подпишитесь на задания</div>
			<div class="OrzuHTWBlockDescript">После регистрации на сайте, вам будет предложено подписаться на задания, подпишитесь. Либо сделайте это в <a href="/my/settings#substr">настройках</a>.</div>
		</div>
		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/uploads/notify23.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">3. Предлагайте свои услуги</div>
			<div class="OrzuHTWBlockDescript">После подписки на задания, вы будете получать Push-уведомления на ваш смартфон.</div>
		</div>
	</div>
</div>


<div class="section white OrzuHTWBlock">
	<div class="row container">
		<div class="left-align _h-heading">
			<h4 class="wow fadeIn">Какие преимущества</h4>
		</div>

		<div class="col m3 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/uploads/register.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">Свободный график</div>
		</div>
		<div class="col m3 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/uploads/substrtasks.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">Хороший доход</div>
		</div>
		<div class="col m3 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/uploads/notify23.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">Заказы рядом</div>
		</div>
		<div class="col m3 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/uploads/notify23.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">Безопасные сделки</div>
		</div>
	</div>
</div>


<div class="section grey lighten-5 _h-apps">
	<div class="row container valign-wrapper nomargin--b">
		<div class="col m6 center-align">
			<img src="/images/uslugiapp.png" class="wow bounceInUp _phoneImg" data-wow-delay="0.2s"/>
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
					<div class="input-field col m9 nomargin nopadding--l">
						<span class="_prefix">+992</span>
						<input type="tel" name="phone" id="_smsinput" class="nomargin __sml" autocomplete="off" placeholder="Окей, напишите номер телефона">
					</div>
					<div class="_formgetsms-btn col m2">
						<button type="submit" class="btn blue waves-effect waves-light"><i class="material-icons">send</i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/animate.css.js') }}"></script>
<script>
	new WOW().init();
</script>
<script type="text/javascript" src="{{ asset('js/mask.js?13') }}"></script>
<script type="text/javascript" src="{{ asset('js/hellotaskers.js?9238') }}"></script>
@endsection