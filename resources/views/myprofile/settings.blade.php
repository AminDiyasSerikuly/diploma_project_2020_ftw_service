@extends('base')
@section('title')
<title>Настройки аккаунта</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css?53') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.settings.css?658') }}"/>
@endsection
@section('content')
<div class="container --general --g-settings">
	<div class="row">
		<div class="col m8 s12 --general-t">
			<div class="main">

						<!--details-->
						<div class="white boxsh brd2 --general-t-detail">
							<div class="--header">
								Настройки
								<!--preloader-->
								<div class="--preloader hide">
									<div class="progress">
										<div class="indeterminate"></div>
									</div>
								</div>
								<!--/preloader-->
							</div>
							<div class="--tabs">
								<ul class="tabs">
									<li class="tab col s3"><a class="active" href="#generals">Основные</a></li>
									<li class="tab col s3"><a href="#notifications">Уведомления</a></li>
									<li class="tab col s4"><a href="#substr">Подписка на задания</a></li>
									<li class="tab col s2"><a href="#links">Ссылки</a></li>
								</ul>
							</div>

							<!--General settings-->
							<div id="generals" class="col s12">
								<form class="row" method="post" action="/my/settings/request_embile_update">
									@csrf
									<div class="--g-title __g nopadding--t">Контактные данные</div>
									<div class="input-field col m6 s12">
										<input id="phone" type="tel" autocomplete="off" class="__sml" value="{{ Auth::user()->phone }}"/>
									</div>
									<div class="input-field col m6 s12">
										<input id="email" name="email" type="text" autocomplete="off" value="{{ Auth::user()->email }}">
										<label for="email">Email адрес</label>
									</div>

									<div class="col s12 --actbtn">
										<button type="submit" class="right waves-effect waves-light orange btn-small">Сохранить</button>
									</div>
								</form>
								<div class="divider"></div>
								<form class="row" method="post" action="/my/settings/pass_update">
									@csrf
									<div class="--g-title __g">Изменить пароль</div>
									<div class="input-field col s12 nomargin--t">
										<input id="password" name="password" type="password" autocomplete="off">
										<label for="password">Ваш пароль</label>
										<span toggle="#password" class="material-icons --tggl-pass">visibility</span>
									</div>
									<div class="input-field col s12">
										<input id="newpassword" name="newpassword" type="password" autocomplete="off">
										<label for="newpassword">Новый пароль</label>
										<span toggle="#newpassword" class="material-icons --tggl-pass">visibility</span>
									</div>
									<div class="input-field col s12">
										<input id="vernewpassword" name="vernewpassword" type="password" autocomplete="off">
										<label for="vernewpassword">Подтвердите новый пароль</label>
										<span toggle="#vernewpassword" class="material-icons --tggl-pass">visibility</span>
									</div>

									<div class="col s12 --actbtn">
										<button class="right waves-effect waves-light orange btn-small">Сохранить</button>
									</div>
								</form>								
							</div>
							<!--/General settings-->

							<!--Notifications settings-->
							<div id="notifications">
								<form class="col s12" id="email_param">
									@csrf
									<div class="row">
										<div class="input-field col s12 nomargin--t">
											<div class="--g-title">Уведомления по почте</div>
											<div class="section-grid--b">
												<label>
													<input class="filled-in" name="new_req" onclick="update_email_param()" @if(App\Profile::getUserParam('new_req')=='yes') checked="checked" @endif type="checkbox" value="true" />
													<span>Уведомлять о новых отзывах</span>
												</label>
											</div>
											<div class="section-grid--b">
												<label>
													<input class="filled-in" name="new_msg" onclick="update_email_param()" @if(App\Profile::getUserParam('new_msg')=='yes') checked="checked" @endif type="checkbox" value="true" />
													<span>Уведомлять о новых личных сообщениях</span>
												</label>
											</div>
											<div class="section-grid--b">
												<label>
													<input class="filled-in" name="sys_msg" onclick="update_email_param()" @if(App\Profile::getUserParam('sys_msg')=='yes') checked="checked" @endif type="checkbox" value="true" />
													<span>Получать системные уведомления</span>
												</label>
											</div>
											<div class="section-grid--b">
												<label>
													<input class="filled-in" name="site_news" onclick="update_email_param()" @if(App\Profile::getUserParam('site_news')=='yes') checked="checked" @endif type="checkbox" value="true" />
													<span>Получать новости сайта</span>
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 nomargin--t">
											<div class="--g-title">Push-уведомления</div>
											<div class="section-grid--b">
												<label>
													<input class="filled-in" name="new_myreq" onclick="update_email_param()" @if(App\Profile::getUserParam('new_myreq')=='yes') checked="checked" @endif type="checkbox" />
													<span>Новый отзыв на Вашей странице</span>
												</label>
											</div>
											<div class="section-grid--b">
												<label>
													<input class="filled-in" name="new_mymsg" onclick="update_email_param()" @if(App\Profile::getUserParam('new_mymsg')=='yes') checked="checked" @endif type="checkbox" />
													<span>Новое личное сообщение</span>
												</label>
											</div>
											<div class="section-grid--b">
												<label>
													<input class="filled-in" name="sys_mymsg" onclick="update_email_param()" @if(App\Profile::getUserParam('sys_mymsg')=='yes') checked="checked" @endif type="checkbox" />
													<span>Получать системные уведомления</span>
												</label>
											</div>
										</div>
									</div>
								</form>
							</div>
							<!--/Notifications settings-->

							<!--Subscription settings-->
							<div id="substr" class="col s12">
								<form id="cat">
									@csrf
									<ul class="collapsible expandable">
										@foreach($categories as $cat)
										<li @if(App\Tasks::getParentCatChecked($cat->id)=='1') class="active" @endif>
											<div class="collapsible-header">{{ $cat->name }}</div>
											<div class="collapsible-body">
												@foreach(App\Tasks::getSubCatName($cat->id) as $subcat)
												<label>
													<input name="cat[]" onclick="update_cat()" class="filled-in" type="checkbox" value="{{ $cat->id.';'.$subcat->id }}" @if(App\Tasks::getCatChecked($subcat->id)=='1') {{ 'checked' }} @endif/>
													<span>{{ $subcat->name }}</span>
												</label>
												@endforeach
											</div>
										</li>
										@endforeach
									</ul>
								</form>
								<form id="email_req">
									@csrf
									<div class="--g-title">Уведомления</div>
									<div class="section-grid--b">
										<label>
											<input class="filled-in" name="email" onclick="update_email_r()" type="checkbox" @if(App\Profile::getUserParam('user_req_email')=='yes') {{ 'checked' }} @endif/>
											<span>Уведомлять по почте</span>
										</label>
									</div>
								</form>
								<form id="push_req">
									@csrf
									<div class="section-grid--b">
										<label>
											<input class="filled-in" name="push" onclick="update_push()" type="checkbox" @if(App\Profile::getUserParam('user_req_push')=='yes') {{ 'checked' }} @endif />
											<span>Push-уведомления в мобильных приложениях</span>
										</label>
									</div>
								</form>
							</div>
							<!--/Subscription settings-->

							<!--Links settings-->
							<div id="links" class="col s12">
								<form class="row" method="post" action="/my/settings/links_update">
									@csrf
									<div class="--g-title __g nopadding--t nomargin">Добавьте ссылки</div>
									<div class="--g-description">Повысьте доверие пользователей к себе – добавьте ваши аккаунты социальных сетей или веб-сайт к своему профилю.</div>
									<div class="input-field col s12">										
										<input id="fb" name="fb" type="text" autocomplete="off" class="__sml" @if(App\Profile::getUserParam('user_fb')!='') {!! 'value="'.App\Profile::getUserParam('user_fb').'"' !!} @endif/>
										<label for="fb">Facebook</label>
									</div>
									<div class="input-field col s12">
										<input id="vk" name="vk" type="text" autocomplete="off" @if(App\Profile::getUserParam('user_vk')!='') {!! 'value="'.App\Profile::getUserParam('user_vk').'"' !!} @endif/>
										<label for="vk">ВКонтакте</label>
									</div>
									<div class="input-field col s12">
										<input id="inst" name="inst" type="text" autocomplete="off" @if(App\Profile::getUserParam('user_instagram')!='') {!! 'value="'.App\Profile::getUserParam('user_instagram').'"' !!} @endif/>
										<label for="inst">Instagram</label>
									</div>
									<div class="input-field col s12">
										<input id="web" name="web" type="text" autocomplete="off" @if(App\Profile::getUserParam('user_web')!='') {!! 'value="'.App\Profile::getUserParam('user_web').'"' !!} @endif/>
										<label for="web">Веб-сайт</label>
									</div>

									<div class="col s12 --actbtn">
										<button type="submit" class="right waves-effect waves-light orange btn-small">Сохранить</button>
									</div>
								</form>							
							</div>
							<!--/Links settings-->
						</div>
						<!--/details-->

			</div>
		</div>

		<!--sidebar-->
		@include('parts.mybar')
		<!--/sidebar-->

	</div>
</div>
@include('parts.footer')
@endsection
@section('footlink')

<script type="text/javascript" src="{{ asset('js/profile.settings.js?33') }}"></script>
<script type="text/javascript" src="{{ asset('js/phoneinpt.js') }}"></script>
<script>
	$("#phone").intlTelInput({
		initialCountry: "kz",
		hiddenInput: "phone",
		onlyCountries: ["kz", "tj", "kg", "uz", "ae", "tr", "cz"],
		utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.1/js/utils.js"
	});

	function update_cat(){
		var form = document.frmSearch;
		var dataString = $('#cat').serialize();
		$.ajax({type: "POST",
			url: "/my/settings/cat_update",
			data: dataString
		});	
	}
	function update_email_r(){
		var form = document.frmSearch;
		var dataString = $('#email_req').serialize();
		$.ajax({type: "POST",
			url: "/my/settings/request_email_update",
			data: dataString
		});	
	}
	function update_push(){
		var form = document.frmSearch;
		var dataString = $('#push_req').serialize();
		$.ajax({type: "POST",
			url: "/my/settings/request_push_update",
			data: dataString
		});	
	}
	function update_email_param(){
		var form = document.frmSearch;
		var dataString = $('#email_param').serialize();
		$.ajax({type: "POST",
			url: "/my/settings/request_email_param_update",
			data: dataString
		});	
	}
</script>
@endsection