@extends('base')
@section('title')
<title>Редактирование профиля</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css?44') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.edit.css?44') }}"/>
@endsection
@section('content')
<div class="container --general --g-edit">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<!--details-->
				<div class="white boxsh brd2 --general-t-detail">
					<div class="--header">
						Редактирование профиля
					</div>
					@foreach($profile as $p)
					<form class="col s12" method="post" action="/my/edit/update">
						@csrf
						<div class="row">
							<div class="input-field col s6 nomargin--t">
								<input id="first_name" type="text" name="name" value="{{ $p->name }}">
								<label for="first_name">Имя</label>
							</div>
							<div class="input-field col s6 nomargin--t">
								<input id="last_name" type="text" name="fname" value="{{ $p->fname }}">
								<label for="last_name">Фамилия</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s8">
								<select class="cities" id="cities" name="cities">
									@if(App\Profile::getUserParam('user_address')!='') {!! '<option value="'.App\Profile::getUserParam('user_address').'">'.App\Profile::getUserParam('user_address').'</option>' !!} @endif
								</select>
								<label for="cities">Выберите город</label>
							</div>
							<div class="input-field col s4">
								<input type="text" disabled="disabled" value="@if(App\Profile::getUserParam('user_current')!=''){{ App\Profile::getUserParam('user_current') }}@elseВалюта не задана @endif" id="currently"/>
								<label for="cities">Ваша валюта</label>
							</div>
						</div>
						<div class="row nomargin--b">
							<div class="input-field col s12">
								<textarea id="description_profile" name="about" class="materialize-textarea nomargin--b" data-length="500">{{ App\Profile::getUserParam('user_about') }}</textarea>
								<label for="description_profile">О себе</label>
							</div>
						</div>
						<div class="row nomargin--b">
							<div class="col s12 --title">
								<div class="--g-title">Дата рождения</div>
							</div>
							<div class="input-field col s4">
								<select id="__jsDays" class="birthdate" name="bday">@if(App\Profile::getUserParam('bday')!='') {!! '<option value="'.App\Profile::getUserParam('bday').'">'.App\Profile::getUserParam('bday').'</option>' !!} @endif</select>
								<label>День</label>
							</div>
							<div class="input-field col s4">
								<select id="__jsMonths" class="birthdate" name="bmonth">@if(App\Profile::getUserParam('bmonth')!='') {!! '<option value="'.App\Profile::getUserParam('bmonth').'">'.App\Profile::getUserParam('bmonth').'</option>' !!} @endif</select>
								<label>Месяц</label>
							</div>
							<div class="input-field col s4">
								<select id="__jsYears" class="birthdate" name="byear">@if(App\Profile::getUserParam('byear')!='') {!! '<option value="'.App\Profile::getUserParam('byear').'">'.App\Profile::getUserParam('byear').'</option>' !!} @endif</select>
								<label>Год</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<div class="--g-title">Ваш пол</div>
								<div class="section-grid">
									<label>
										<input name="gender" value="male" class="with-gap" type="radio" @if(App\Profile::getUserParam('user_sex')=='male') {{ 'checked' }} @endif/>
										<span class="checkpoint-gender">Мужчина</span>
									</label>
								</div>
								<div class="section-grid">
									<label>
										<input name="gender" value="female" class="with-gap" type="radio" @if(App\Profile::getUserParam('user_sex')=='female') {{ 'checked' }} @endif />
										<span class="checkpoint-gender">Женщина</span>
									</label>
								</div>
							</div>
						</div>

						<div class="divider"></div>

						<div class="row nomargin--b --actbtn">
							<!--preloader-->
							<div class="--preloader hide">
								<div class="progress">
									<div class="indeterminate"></div>
								</div>
							</div>
							<!--/preloader-->
							<div class="col s12">
								<button class="right waves-effect waves-light orange btn-small">Сохранить</button>
							</div>
						</div>
					</form>
					@endforeach
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
<script type="text/javascript" src="{{ asset('js/profile.edit.js?55') }}"></script>
@endsection