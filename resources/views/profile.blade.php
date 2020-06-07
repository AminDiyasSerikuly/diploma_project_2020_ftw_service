@extends('base')
@section('title')
<title>Страница пользователя</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css?88') }}"/>
@endsection
@section('content')
<div class="container --general">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						@foreach($profile as $p)
						<div class="white boxsh brd2 --general-t-detail">
							<div class="left --avatar">
								<img src="{{ $p->avatar }}"/>
							</div>
							<div class="--title row">
								<h6 class="nomargin">{{ $p->name }}</h6>
								<span>
									@if(App\User::isOnline($p->id))<strong class="green-text">Сейчас в сети</strong>@else<strong class="orange-text">Не в сети</strong>@endif • {{App\Profile::getUserAge(date('Y')-App\Tasks::getUserParamWithId($p->id,'byear'))}} •
									@if(App\Profile::getUserParamCheck($p->id, 'user_address')<0){{ App\Tasks::getUserParamWithId($p->id,'user_address') }}@elseгород не указан@endif
								</span>
								<span class="--badges hide">
									<i class="__verify tooltipped" data-position="bottom" data-tooltip="Подтвержденный исполнитель"></i>
									<i class="__serf tooltipped" data-position="bottom" data-tooltip="Сертифицированный исполнитель"></i>
									<i class="__recomm tooltipped" data-position="bottom" data-tooltip="Рекомендация администрации"></i>
								</span>
							</div>

							<div class="--about row nomargin">
								<h6 class="nomargin">Обо мне</h6>
								<span>@if(App\Tasks::getUserParamWithId($p->id,'user_about')!='') {{ App\Tasks::getUserParamWithId($p->id,'user_about') }} @else {!! 'Пользователь пока ничего не рассказал о себе :(' !!} @endif</span>
							</div>

							<!--service-->
							@if(App\Tasks::getUserCatChecked($p->id)>0)
							<div class="--divider">
								Виды выполняемых работ
								<div class="--divider-br"></div>
							</div>
							<div class="--service">
								@foreach($user_cat as $uc)
								<?php
									$cat = explode(';',$uc->meta_value);
								?>
								<a href="#">{{ App\Tasks::getCatName($cat[1]) }}</a>
								@endforeach
							</div>
							@endif
							<!--/service-->

							<!--reviews-->
							<div class="--divider">
								Отзывы о пользователе
								<div class="--divider-br"></div>
							</div>


							<div class="white brd2 --general-t-reviews">
								@if(Auth::check())
									@if(App\Tasks::getUserLike(Request::segment(2), Auth::user()->id)<=0)
									<div class="--form row">
										<form class="col m12" method="post" action="/profile/add_rate">
											@csrf
											<div class="row">
												<div class="input-field col m12">
													<textarea id="891284" name="narrative" class="materialize-textarea" required></textarea>
													<label for="891284">Написать отзыв</label>
													<input type="hidden" name="like_user_id" value="{{ Request::segment(2) }}" />
													<div class="--ratebtn right-align">
														<div class="--rate-smile">
															<input type="radio" name="smiley" value="sad" class="--sad tooltipped" data-position="bottom" data-tooltip="Плохо"/>
															<input type="radio" name="smiley" value="neutral" class="--neutral tooltipped" data-position="bottom" data-tooltip="Удовлетворительно"/>
															<input type="radio" name="smiley" value="happy" class="--happy tooltipped" data-position="bottom" data-tooltip="Отлично" checked="checked"/>
														</div>

														<div class="switch hide">
															<label>
																<i class="material-icons veralmidd --like active">thumb_up_alt</i>
																<input type="checkbox" name="like" value="1" class="--rateSwitch" checked="checked" />
																<span class="lever"></span>
																<i class="material-icons veralmidd --dislike">thumb_down_alt</i>
															</label>
														</div>
														<button class="waves-effect waves-light btn" id="_revSubmit">Отправить</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									@endif
								@endif
								<div class="--rating right-align">
									<div class="--sad --ratesml red lighten-5">
										<i></i>
										<span>{{ App\Profile::getUserSadCount(Request::segment(2)) }}</span>
									</div>
									<div class="--neutral --ratesml orange lighten-5">
										<i></i>
										<span>{{ App\Profile::getUserNeutralCount(Request::segment(2)) }}</span>
									</div>
									<div class="--happy --ratesml green lighten-5">
										<i></i>
										<span>{{ App\Profile::getUserHappyCount(Request::segment(2)) }}</span>
									</div>
								</div>

								@foreach(App\Profile::getUserLikes(Request::segment(2)) as $likes)
								<div class="--rev @if($likes->like==0) {!! '--sad' !!} @elseif($likes->like==1) {!! '--neutral' !!} @else {!! '--happy' !!} @endif">
									<div class="--smile white-text">
										<i></i>
									</div>
									@if(Auth::check())
										@if(Auth::user()->id==$likes->user_id)
										<a href="/profile/{{ $likes->user_id }}" target="_blank">
											<img src="{{ App\Profile::getUserAvatar($likes->user_id) }}" class="circle"/>
										</a>										
										<div class="--name"><a href="/my" target="_blank">{{ App\Profile::getUserName($likes->user_id) }}</a></div>
										@else
										<a href="/profile/{{ $likes->user_id }}" target="_blank">
											<img src="{{ App\Profile::getUserAvatar($likes->user_id) }}" class="circle"/>
										</a>									
										<div class="--name">
											<a href="/profile/{{ $likes->user_id }}" target="_blank">
												{{ App\Profile::getUserName($likes->user_id) }}
											</a>
										</div>
										@endif
									@else									
									<a href="/profile/{{ $likes->user_id }}" target="_blank">
										<img src="{{ App\Profile::getUserAvatar($likes->user_id) }}" class="circle"/>
									</a>									
									<div class="--name">
										<a href="/profile/{{ $likes->user_id }}" target="_blank">
											{{ App\Profile::getUserName($likes->user_id) }}
										</a>
									</div>
									@endif
									<div class="--descript">{{ $likes->narrative }}</div>
								</div>
								@endforeach
							</div>	
							<!--/reviews-->

						</div>
						@endforeach
						<!--/details-->
					</div>
				</div>
			</div>
		</div>

		<!--sidebar-->
		@include('parts.profbar')
		<!--/sidebar-->

	</div>
</div>
@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/profile.js?4') }}"></script>
@endsection