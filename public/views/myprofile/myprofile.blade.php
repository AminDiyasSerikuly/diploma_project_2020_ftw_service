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
				<!--details-->
				@foreach($profile as $p)
				<div class=" --general-t-detail" style="padding:0px;">

					<div class="white" style="padding:24px;position:relative;">
					<div class="left --avatar">
						<img src="{{$p->avatar}}"/>
						<a href="#" class="--link" id="upload_link">Изменить</a>
						<form method="POST" action="{{ route('uploadavatar') }}" enctype="multipart/form-data" id="AvatarUpload">
							@csrf
							<input type="file" name="file[]" id="upload" class="hide" accept="image/*"/>
						</form>
						<div class="--preloader">
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
					<div class="--title row">
						<h6 class="nomargin">{{ $p->name }}</h6>
						<span>@if(App\User::isOnline(Auth::user()->id))<strong class="orange-text">Сейчас в сети</strong>@else<strong class="black-text">Не в сети</strong>@endif • {{App\Profile::getUserAge(date('Y')-App\Tasks::getUserParamWithId($p->id,'byear'))}} • {{ App\Tasks::getUserParamWithId($p->id,'user_address') }}</span>
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
								<span>{{ App\Profile::getUserSadCount(Auth::user()->id) }}</span>
							</div>
							<div class="--neutral --ratesml orange lighten-5">
								<i></i>
								<span>{{ App\Profile::getUserNeutralCount(Auth::user()->id) }}</span>
							</div>
							<div class="--happy --ratesml green lighten-5">
								<i></i>
								<span>{{ App\Profile::getUserHappyCount(Auth::user()->id) }}</span>
							</div>
						</div>
					</div>

					@if(App\Tasks::getUserCatChecked($p->id)>0)
{{-- 					<div class="--divider">
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



				</div>

<div class="col m8 s12 l8 info-wrap">

					<div class="--about row nomargin profile-category" style="padding:24px;">
						<h6 class="nomargin">Обо мне</h6>
						
					</div>
					<div class="--about row nomargin profile-category" style="padding:24px;">
						<h6 class="nomargin">Отзывы</h6>
						
					</div>


					<!--service-->

					<!--/service-->




<script>
window.onload=function(){
	let curIndex=0;
	// let started = false;
	let contentToShow = $('.contentToShow');
	let arr =  [
  `<h6 style="width:100%;">Обо мне</h6>
<span>@if(App\Profile::getUserParam('user_about')!='') {{ App\Profile::getUserParam('user_about') }} @else {!! 'Пользователь пока ничего не рассказал о себе :(' !!} @endif</span>
  `,
  `
					<div class="brd2 --general-t-reviews">
						@foreach(App\Profile::getUserLikes(Auth::user()->id) as $likes)

						<div class="--rev @if($likes->like==0) {!! '--sad' !!} @elseif($likes->like==1) {!! '--neutral' !!} @else {!! '--happy' !!} @endif">
							
							@if(Auth::user()->id==$likes->user_id)
							<a href="/my" target="_blank">
								<img src="{{ App\Profile::getUserAvatar($likes->user_id) }}" class="circle"/>
							</a>
							@else
							<a href="/profile/{{ $likes->user_id }}" target="_blank">
								<img src="{{ App\Profile::getUserAvatar($likes->user_id) }}" class="circle"/>
							</a>
							@endif
							<div class="reviews-wrap">
								<div class="--name">
									<a href="/profile/{{ $likes->user_id }}" target="_blank">
										{{ App\Profile::getUserName($likes->user_id) }}
									</a>
								</div>
								<div class="--descript">{{ $likes->narrative }}</div>
							

								</div>
								<div class="--smile white-text">
									<i></i>
								</div>
							</div>

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
</div>

					<!--reviews-->
					{{-- <div class="--divider">
						Отзывы обо мне
						<div class="--divider-br"></div>
					</div> --}}


					
					<!--/reviews-->
		<!--sidebar-->
		@include('parts.mybar')
		<!--/sidebar-->
				</div>
				@endforeach
				<!--/details-->
			</div>
		</div>

		

	</div>
</div>
@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/profile.js?33') }}"></script>
<script type="text/javascript" src="{{ asset('js/profile.avatar-upload.js?33') }}"></script>
<script>
	$('#AvatarUpload').change(function(event) {
		event.preventDefault();
		var formData = new FormData($(this)[0]);
		$('.--preloader').show();
		$.ajax({
			url: '{{ route('uploadavatar') }}',
			type: 'POST',              
			data: new FormData(this),
			contentType: false,
			processData: false,
			success: function(result)
			{
				$('.--preloader').hide();
				M.toast({html: result});
				if(result == 'Фотография добавлена'){
					location.reload();
				}
			}
		});
	});
</script>
@endsection