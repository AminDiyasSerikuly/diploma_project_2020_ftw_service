@extends('base')
@section('title')
<title>Создайте задание</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/creat.css?99') }}"/>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=0e4ed3dd-4213-4ea2-98ce-23257fe20028" type="text/javascript"></script>
@endsection
@section('content')
<div class="OrzuRibbon OrzuRibbonGradient"></div>
<div class="container __dbjs OrzuRibbonContainer">
	<div class="row">
		<div class="col m12 s12 _c-header">
			<h5 class="white-text">Новый заказ</h5>
			@if(Agent::isDesktop())
			<div class="white-text fnt13 mrg1b">
				Опишите задачу, сравните предложения и выберите исполнителя.
			</div>
			@endif
		</div>
		<div class="col m8 s12">
			<div class="_c-container white brd2">
				<div class="row nomargin--b">
					<form method="post" action="{{ route('newadd') }}" class="col m12 _c-form" enctype="multipart/form-data">
						@csrf
						@if(Agent::isMobile())
						<input type="hidden" name="mtoken" value="{{ request()->token }}">
						@endif
						<div class="row nomargin--b">
							<div class="input-field col m12 s12 nomargin--t">
								<span class="_LabelInput">Что нужно сделать</span>
								<input name="task" autocomplete="off" placeholder="Напишите коротко, чем вам помочь" id="whtd" type="text" value="@if(app('request')->input('task')!=''){{app('request')->input('task')}}@else{{old('task')}}@endif" required>
							</div>
						</div>
						<div class="row nomargin--b">
							<div class="input-field col m6 s12">
								<span class="_LabelInput">Категория</span>
								<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value + '?task=' + document.getElementById('whtd').value + '&narrative=' + document.getElementById('whtdt').value+'@if(Agent::isMobile()) {!! '&token='.request()->token!!}@endif');">
									@foreach($categories as $category)
									@if(substr($category->param_c,0,strpos($category->param_c,'/'))==Request::segment(3))                                    
									<option value="{{ route('hometask').'/'.$category->param_c }}" selected="selected">{{ $category->name }}</option>
									@else
									<option value="{{ route('hometask').'/'.$category->param_c }}">{{ $category->name }}</option>
									@endif                                                            
									@endforeach
								</select>
							</div>
							<div class="input-field col m6 s12">
								<span class="_LabelInput">Специальность</span>
								<select name="cat_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value + '?task=' + document.getElementById('whtd').value + '&narrative=' + document.getElementById('whtdt').value+'@if(Agent::isMobile()){!!'&token='.request()->token!!}@endif');">
									@foreach(App\Category::getSubCatParam(Request::segment(3)) as $subcat)
									@if($subcat->param==Request::segment(3).'/'.Request::segment(4))                                    
									<option value="{{ route('hometask').'/'.$subcat->param }}" selected="selected">{{ $subcat->name }}</option>
									@else
									<option value="{{ route('hometask').'/'.$subcat->param }}">{{ $subcat->name }}</option>
									@endif                                                            
									@endforeach
								</select>
							</div>                              
						</div>
						<div class="row nomargin--b">
							<div class="input-field col m12 s12 nomargin--b">
								<span class="_LabelInput">Описание и пожелания</span>
								<textarea name="narrative" id="whtdt" class="materialize-textarea" placeholder="Расскажите подробнее о задаче" required="required">@if(app('request')->input('narrative')!=''){{app('request')->input('narrative')}}@else{{old('narrative')}}@endif</textarea>
							</div>
						</div>
						<div class="row">
							<div class="col m12 s12">
								<a href="" id="upload_link"><i class="material-icons veralmidd">attachment</i> Добавить изображения</a>​
								<input type="file" name="files[]" id="upload" accept="image/*" multiple/>
							</div>
						</div>

						<div class="row nomargin--b">
							<div class="col m12 s12">
								<div class="_c-form-title">Сроки</div>
								<div class="radio-group _mar1">
									<div class="selection">
										<input id="dateDt_radio" name="date_radio" type="radio" value="7">
										<label for="dateDt_radio">Точная дата</label>
									</div>
									<div class="selection">
										<input id="dateSp_radio" name="date_radio" type="radio" value="6">
										<label for="dateSp_radio">Указать период</label>
									</div>
									<div class="selection">
										<input id="dateMs_radio" name="date_radio" type="radio" value="5">
										<label for="dateMs_radio">Договорюсь с исполнителем</label>
									</div>
								</div>
							</div>
							<div class="input-field col m12 s12 nomargin--t radio_group0" id="radio_group5">
								Дату выполнения задачи обсудите с выбранным исполнителем.
							</div>
							<div class="radio_group0" id="radio_group6">
								<div class="input-field col m3 s12">
									<input name="cdate" type="text" id="wdate2" autocomplete="off" class="_c-form-date" placeholder="С" value="{{ old('cdate') }}"/>
									<label for="wdate2">Когда начать?</label>
								</div>
								<div class="input-field col m3 s12">
									<input name="edate" type="text" id="wdate3" autocomplete="off" class="_c-form-date" placeholder="ПО" value="{{ old('edate') }}"/>
									<label for="wdate3">Когда закончить?</label>
								</div>
							</div>
							<div class="radio_group0" id="radio_group7">
								<div class="input-field col m4 s12">
									<input name="cdate_l" type="text" id="wdate" autocomplete="off" class="_c-form-date" placeholder="Когда вам нужно?" value="{{ old('cdate_l') }}"/>
									<label for="wdate">Выберите дату</label>
									<div class="_c-form-wdate-helper">
										<span><a href="#" class="_c-form-wdate-helper-link" data-wdate="{{ date('d.m.Y') }}">сегодня</a></span>, 
										<span><a href="#" class="_c-form-wdate-helper-link" data-wdate="{{ date('d.m.Y', strtotime('+1 days')) }}">завтра</a></span>, 
										<span><a href="#" class="_c-form-wdate-helper-link" data-wdate="{{ date('d.m.Y', strtotime('+2 days')) }}">послезавтра</a></span>
									</div>
								</div>
								<div class="input-field col m4 s12">
									<select name="level_l">
										<option value="1" selected="selected">{{ App\Lang::getTrans('every_time', Config::get('app.locale')) }}</option>
										<option value="2">{{ App\Lang::getTrans('to_12', Config::get('app.locale')) }}</option>
										<option value="3">{{ App\Lang::getTrans('from_12_to_17', Config::get('app.locale')) }}</option>
										<option value="4">{{ App\Lang::getTrans('from_17_to_22', Config::get('app.locale')) }}</option>
										<option value="5">{{ App\Lang::getTrans('after_22', Config::get('app.locale')) }}</option>
									</select>
									<label>В какое время?</label>
								</div>

							</div>
						</div>

						<div class="row nomargin--b">
							<div class="col m12 s12">
								<div class="_c-form-title">Место</div>
								<div class="radio-group _mar1">
									<div class="selection">
										<input id="location_radio" name="location" type="radio" value="1" autocomplete="off">
										<label for="location_radio">Указать место</label>
									</div>
									<div class="selection">
										<input id="remoteloc_radio" name="location" type="radio" value="2">
										<label for="remoteloc_radio">Удаленно</label>
									</div>
								</div>
							</div>
							<div class="input-field col m12 s12 radio_group1" id="radio_group1">
								<span class="_LabelInput">Город, район или точный адрес</span>
								<input type="text" value="{{old('address')}}" name="address" id="location" autocomplete="off" placeholder="Адрес">
							</div>
							<div class="input-field col m12 s12 nomargin--t radio_group1" id="radio_group2">
								Встреча не нужна, исполнитель выполнит заказ там, где ему  удобнее. Для исполнителей из любых городов.
							</div>
						</div>

						<div class="row">
							<div class="col m12 s12">
								<div class="_c-form-title">Стоимость</div>
								<div class="radio-group _mar1">
									<div class="selection">
										<input id="mysum_radio" name="current_radio" type="radio" value="3">
										<label for="mysum_radio">Указать цену самому</label>
									</div>
									<div class="selection">
										<input id="lncsumm_radio" name="current_radio" type="radio" value="4">
										<label for="lncsumm_radio">Исполнитель предложит цену</label>
									</div>
								</div>
							</div>
							<div class="col m12 s8 radio_group2" id="radio_group3">
								<div class="input-field col m3 nopadding _c-form-ammount">
									<span class="--2sum">до</span>
									<span class="--inp"><input type="text" name="val" id="amountCorrect" style="text-align: right; padding-right: 5px; width: calc(100% - 5px);" maxlength="10" autocomplete="off"/></span>
									<span class="--curr">
										@auth
											@if(App\Profile::getUserParam('user_current')!='')
												{{ App\Profile::getUserParam('user_current') }}
											@else
												Валюта не задана
											@endif
										@else
											тенге
										@endif
									</span>
								</div>
							</div>
							<div class="input-field col m12 s12 nomargin--t radio_group2" id="radio_group4">
								Исполнитель предложит цену сам.
							</div>
						</div>

						<div class="row hide">
							<div class="col m6 s12 margin-t1b1">
								<label class="_c-form-checkbox-email">
									<label>
										<input type="checkbox" class="filled-in" name="email" value="yes" checked/>
										<span>E-mail уведомления <i class="material-icons tooltipped" data-position="right" data-tooltip="Уведомлять об откликах по электронной почте">help</i></span>
									</label>
								</label>
							</div>
						</div>
						@guest
						<div class="row">
							<div class="input-field col m6 s12">
								<input name="name" placeholder="Напишите ваше имя" id="whtd" type="text" value="{{ old('name') }}" required>
								<label for="whtd">Имя</label>
							</div>
							<div class="input-field col m6 s12">
								<input id="phone" name="phone" value="{{ old('phone') }}" type="tel" required>
							</div>
						</div>
						@endif
						<div class="divider --theend"></div>
						<div class="row nomargin--b">
							<div class="col m12 s12 OrzuAdditionBlock">
								<button class="btn yellow darken-1 OrzuPromoBtn OrzuPromoBtnShadow waves-effect waves-light" type="submit">Опубликовать задание</button>
								<span class="OrzuBlockGridInlineSystems">Опубликовая, вы соглашаетесь <a href="#" class="link2">с условиями сервиса</a>.</span>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
		@if(Agent::isDesktop())
		<div class="col m4">
			<div class="collection sml brd4 boxsh nomargin">
				<a  href="javascript:Intercom('show');" target="_blank" class="collection-item blue-text">
					Написать в поддержку <i class="material-icons">link</i>
				</a>
				<!--links-->
				<a href="#m32" class="collection-item orange-text modal-trigger" target="_blank">
					Как это работает? <i class="material-icons">help</i>
				</a>
				<!--/links-->
			</div>
		</div>
		@endif
	</div>
</div>

<div id="m32" class="modal">
	<div class="modal-content">
		<h5 class="nomargin--t">Как это работает</h5>
		<p>1. Опишите, какую задачу вам нужно выполнить, и опубликуйте заказ. Чем подробнее описание, тем легче будет найти подходящих исполнителей.</p>
		<p>2. Исполнители могут соглашаться с вашими условиями или предложить свои.</p>
		<p>3. Если вы выбрали кого-то и договорились об услуге, нажмите кнопку «Завершить заказ».</p>
		<p>4. Ваш город - город выбираете в настройках вашего кабинета.</p>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Понятно</a>
	</div>
</div>

@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/phoneinpt.js?33') }}"></script>
<script type="text/javascript" src="{{ asset('js/creat.js?55') }}"></script>
<script>
	//Tasks suggestion
	var input = document.getElementById('whtd');

	$("#whtd").on("keyup", function(){
		$.ajax({
			url: '{{ url("/tasks/taskajaxupload?find=") }}' + this.value,
			type: 'GET',
			dataType: 'json'
		}).success(function(data) {
			var list = [];
			$.each(data, function(key, value) {
				list.push(value);
			});
			awesomplete.list = list;
		});
	});
	ymaps.ready(init);
	function init() {
		var suggestView1 = new ymaps.SuggestView('location');
	}

</script>
@endsection