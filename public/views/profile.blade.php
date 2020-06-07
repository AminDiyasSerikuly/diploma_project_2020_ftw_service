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
		<div class="col l12 m12 s12 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						@foreach($profile as $p)
						<div class="--general-t-detail" style="padding:0px;">
							<div class="white" style="padding:24px;position:relative;">





							<div class="left --avatar">
								<img src="{{ $p->avatar }}"/>
							</div>
							<div class="--title row">
								<h6 class="nomargin">{{ $p->name }}</h6>
								<span>
									@if(App\User::isOnline($p->id))<strong class="green-text">Сейчас в сети</strong>@else<strong class="orange-text">Не в сети</strong>@endif • {{App\Profile::getUserAge(date('Y')-App\Tasks::getUserParamWithId($p->id,'byear'))}} •
									@if(App\Profile::getUserParamCheck($p->id, 'user_address')<0){{ App\Tasks::getUserParamWithId($p->id,'user_address') }}@else город не указан@endif
								</span>
								<span class="--badges hide">
									<i class="__verify tooltipped" data-position="bottom" data-tooltip="Подтвержденный исполнитель"></i>
									<i class="__serf tooltipped" data-position="bottom" data-tooltip="Сертифицированный исполнитель"></i>
									<i class="__recomm tooltipped" data-position="bottom" data-tooltip="Рекомендация администрации"></i>
								</span>
							</div>



					<div class="--general-t-reviews" style="position: absolute;right: 15px;top: 15px;">
							
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

								
							</div>	

<!--service-->
							@if(App\Tasks::getUserCatChecked($p->id)>0)
							{{-- <div class="--divider">
								Виды выполняемых работ
								<div class="--divider-br"></div>
							</div> --}}
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
</div>
<div class="col m8 s12 l8 info-wrap">
							<div class="--about row nomargin profile-category" style="padding:24px;">
								<h6 class="nomargin">О пользователе</h6>
								
							</div>
							<!--reviews-->
							<div class="--about row nomargin profile-category" style="padding:24px;">
								<h6 class="nomargin">Отзывы о пользователе</h6>
								{{-- <div class="--divider-br"></div> --}}
							</div>
							<!--/reviews-->

<script>
window.onload=function(){
	let curIndex=0;
	// let started = false;
	let contentToShow = $('.contentToShow');
	let arr =  [
  `<h6 style="width:100%;">О пользователе</h6>
<span>@if(App\Tasks::getUserParamWithId($p->id,'user_about')!='') {{ App\Tasks::getUserParamWithId($p->id,'user_about') }} @else {!! 'Пользователь пока ничего не рассказал о себе :(' !!} @endif</span>
  `,
  `
					<div class="brd2 --general-t-reviews" style="width:100%;">
						@foreach(App\Profile::getUserLikes(Request::segment(2)) as $likes)
						@if(App\Profile::getUserName($likes->user_id) != '')
								<div class="--rev @if($likes->like==0) {!! '--sad' !!} @elseif($likes->like==1) {!! '--neutral' !!} @else {!! '--happy' !!} @endif">
									
									@if(Auth::check())
										@if(Auth::user()->id==$likes->user_id)
										<a href="/profile/{{ $likes->user_id }}" target="_blank">
											<img src="{{ App\Profile::getUserAvatar($likes->user_id) }}" class="circle"/>
										</a>				
										<div class="reviews-wrap">						
										<div class="--name"><a href="/my" target="_blank">{{ App\Profile::getUserName($likes->user_id) }}</a></div>
										
										@else
										<a href="/profile/{{ $likes->user_id }}" target="_blank">
											<img src="{{ App\Profile::getUserAvatar($likes->user_id) }}" class="circle"/>
										</a>
										<div class="reviews-wrap">
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
									<div class="reviews-wrap">
									<div class="--name">
										<a href="/profile/{{ $likes->user_id }}" target="_blank">
											{{ App\Profile::getUserName($likes->user_id) }}
										</a>
									
									</div>
									@endif
									
									<div class="--descript">{{ $likes->narrative }}</div>
									</div>
									<div class="--smile white-text">
										<i></i>
									</div>
								</div>
								@endif
								@endforeach
					</div>	
  `
  	]

	$('.info-wrap').on('click',function(e){
		console.log(e.target.parentNode == $('.profile-category'));
		console.error(e.target.parentNode , $('.profile-category'))
 if(curIndex != $('.profile-category').index($(e.target.parentNode)) && e.target == $('.profile-category').find(e.target)[0]){
   // if(!started){
   //   started = true;
   // }
  $('.profile-category').eq(curIndex).children('h6').removeClass('choosenContent');
  curIndex = $('.profile-category').index($(e.target.parentNode));

  showContent();

 }

})

  function showContent(el){
  	console.log($('.profile-category h6').eq(curIndex))
    // index?$(el).eq(index).addClass('active'):$(el).addClass('active');
    $('.profile-category').eq(curIndex).children('h6').addClass('choosenContent')
  // $('.active').css({color:'#ff9800'});
     contentToShow.fadeOut(200,function(){
     contentToShow.children().remove();
     contentToShow.append(arr[curIndex]); 
     contentToShow.fadeIn(200);
     if(curIndex == 1){
  		$('.contentToShow').animate({scrollTop:200}, {duration:500,queue:true,complete:function(){
  			$('.contentToShow').animate({scrollTop:0}, 500);
  		}});
  	 }
   })
  }

showContent()

}
</script>
  <div class="contentToShow" ></div>
  @if(Auth::check())
  {{-- {{ Request::segment(2) }}
  {{ App\Tasks::getUserLike(Request::segment(2), Auth::user()->id) }} --}}
									@if(App\Tasks::getUserLike(Request::segment(2), Auth::user()->id)<=0)
									<div class="--form row" style="width:100%;margin-top:15px;">
										<form class="col l12 m12 s12" method="post" action="/profile/add_rate">
											@csrf
											<div class="row">
												<div class="input-field col l12 m12 s12">
													<textarea id="891284" name="narrative" class="materialize-textarea" style="border-radius:10px;"required></textarea>
													<label for="891284" style="padding:0 10px;">Написать отзыв</label>
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
</div>





							



							




							<!--sidebar-->
								@include('parts.profbar')
							<!--/sidebar-->

						</div>
						@endforeach
						<!--/details-->
					</div>
				</div>
			</div>
		</div>

		

	</div>
</div>
@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/profile.js?4') }}"></script>
@endsection