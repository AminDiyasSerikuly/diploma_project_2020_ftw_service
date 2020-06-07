@extends('base')
@section('title')
<title>Orzu Услуги - решение любых задач</title>
@endsection
@section('headlink')

<link type="text/css" rel="stylesheet" href="{{ asset('css/main.css?5') }}"/>
@endsection
@section('header')
@if(Agent::isDesktop())
<section class="section white _h-heading-text">
	<div class="container">
		<div class="row">
			<div class="col m12">
				<h1 class="left-align">sdfdsfgsdgdfghfdhfg
					<span class="__desc">gdfgdsggdfgdf</span>
				</h1>
			</div>
			<div class="col m12">
				<form method="get" action="{{ route('hometask') }}">
					<div class="__form--bgn">
						<div class="TaskAddition">
							<input type="text" name="task" id="h-form-input" placeholder="Напишите, чем вам помочь" class="nomargin TaskAdditionInput autocomplete" autocomplete="off"/>
							<button type="submit" class="TaskAdditionButton waves-effect waves-light" id="btn-search">Создать задачу</button>
						</div>
						<div class="_h-form-helper-text wow hide fadeIn" data-wow-delay="0.5s">
							<span class="_h-form-helper-text-js">
								или выберите из <a class="OrzuModalTrigger link2 white-text __bold" data-orzumodal="#modal1">списка категорий</a>
							</span>
						</div>
					</div>

					<div class="OrzuModalContainer">
						<div id="modal1" class="OrzuModal">
							<div class="OrzuModalHeader">
								<h5>Выберите категории услуг <span class="OrzuModalHeaderNavigation" id="OrzuModalHeaderNavigation">Loading...</span></h5>
							</div>
							<div class="OrzuModalContent">
								Categories loading.....
							</div>
							<div class="OrzuModalFooter">
								<a class="OrzuModalClose btn blue" href="javascript:;">отмена</a>
								<a class="btn orange" href="javascript:;">Создать задачу</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@else
<section class="section white _h-heading-text">
	<div class="row">
		<div class="col s12">
			<h1 class="center-align">Решение любой задачи</h1>
		</div>
		<div class="col s12">
			<form method="get" action="{{ route('hometask') }}">
				<div class="HomeCreatTask">
					<input type="text" name="task" id="h-form-input" autocomplete="off" class="HomeCreatTaskInput" placeholder="Что нужно сделать?" />
					<button type="submit" class="HomeCreatTaskButton">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</section>

<section class="section white OrzuCategoriesMobile">
	<div class="collection">
		<a href="/tasks/new/house/houseother" class="collection-item">Уборка и помощь <i class="material-icons blue-text left">location_city</i></a>
		<a href="/tasks/new/auto/carother" class="collection-item">Ремонт и транспорт <i class="material-icons blue-text left">build</i></a>
		<a href="/tasks/new/electronicrepair/electronicrepairother" class="collection-item">Ремонт цифровой техники <i class="material-icons blue-text left">camera_alt</i></a>
		<a href="/tasks/new/trucking/truckingother" class="collection-item">Грузоперевозки <i class="material-icons blue-text left">local_shipping</i></a>
		<a href="/tasks/new/courier/courierother" class="collection-item">Курьерские услуги <i class="material-icons blue-text left">directions_run</i></a>
		<a href="/tasks/new/healthandbeauty/healthandbeautyother" class="collection-item">Красота и здоровье <i class="material-icons blue-text left">favorite</i></a>
		<a href="/tasks/new/design/designother" class="collection-item">Дизайн <i class="material-icons blue-text left">brush</i></a>
		<a href="/tasks/new/webdevelopment/webdevelopmentother" class="collection-item">Web-разработка <i class="material-icons blue-text left">code</i></a>
		<a href="/tasks/new/photoshop/photoshopother" class="collection-item">Фото и видео услуги <i class="material-icons blue-text left">camera</i></a>
	</div>
</section>
@endif

@endsection


@section('content')
@if(!Agent::isMobile())
<div class="section grey lighten-5 OrzuHTWBlock">
	<div class="row container">
		<div class="center-align _h-heading">
			<h4 class="wow fadeIn">Довольно таки просто</h4>
		</div>

		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/images/step1-01.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">1. Создайте задачу</div>
			<div class="OrzuHTWBlockDescript">Расскажите нам, что нужно для вас сделать. Укажите время, место и описание.</div>
		</div>
		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/images/step2-01.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">2. Выберите исполнителя</div>
			<div class="OrzuHTWBlockDescript">Предлоежение от доверенных исполнителей. Выберите подходящего человека по отзывам и цене для работы.</div>
		</div>
		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="/images/step3-01.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">3. Задача выполнена</div>
			<div class="OrzuHTWBlockDescript">Ваш исполнитель прибывает и выполняет свою работу. Оплачивайте через безопасную сделку.</div>
		</div>
	</div>
</div>

<!--<div class="section white _h-apps">-->
<!--	<div class="row container valign-wrapper nomargin--b">-->
<!--		<div class="col m6 center-align">-->
<!--			<img src="/images/uslugiapp.png" class="wow bounceInUp _phoneImg" data-wow-delay="0.2s"/>-->
<!--		</div>-->
<!--		<div class="col m6 _desc wow fadeIn" data-wow-delay="0.2s">-->
<!--			<h4>Доступно для смартфонов</h4>-->
<!--			<span>Скачайте наши мобильные приложения и заказывайте услуги еще быстрее!</span>-->
<!--			<div class="_download">-->
<!--				<a href="#" class="_btn _appstore">AppStore</a>-->
<!--				<a href="#" class="_btn _googleplay">Google PLay</a>-->
<!--				<div class="_getsms">-->
<!--					Получите ссылку на приложение <a href="#" id="_getSMS">по SMS</a>-->
<!--				</div>-->
<!--				<div class="_formgetsms animated">-->
<!--					Недоступно для вашей страны.-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
@endif
@include('parts.footer')
@endsection
