@extends('base')
@section('title')
<title>Портфолио исполнителя</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css?5') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.portfolio.css?8') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/common.css?5') }}"/>
@endsection
@section('content')
<div class="container --general --g-portfolio">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						<div class="white boxsh brd2 --general-t-detail">
							@foreach($profile as $p)
							<div class="left --avatar">
{{--								<img src="https://ui-avatars.com/api/?size=180&font-size=0.33&bold=true&background=2196f3&color=ffffff&name={{ $p->name }}" class="brd4"/>--}}
								<img src="{{$p->avatar}}" alt="logo">
							</div>
							<div class="--title">
								<h6 class="nomargin">{{ $p->name }}</h6>
								<span><strong class="green-text">Сейчас в сети</strong> |  {{ date('Y')-App\Profile::getUserParam('byear') }} года | {{ App\Profile::getUserParam('user_address') }}</span>
{{--								<span class="--badges">тут будут бейджы</span>--}}
							</div>
							@endforeach
{{--							<div class="--divider nomargin--b">--}}
{{--								Примеры работ--}}
{{--								<div class="--divider-br"></div>--}}
{{--							</div>--}}

							<div class="--portfolio nomargin--b">
								<div class="row">
									<div class="col s12">
										<ul class="tabs tabs-fixed-width">
											<li class="tab"><a href="#alb" class="black-text">Альбомы</a></li>
											@if(Auth::check())
											@if(Auth::user()->id==Request::segment(2))
											<li class="tab"><a href="#addition" class="black-text">Добавить новый альбом</a></li>
											@endif
											@endif
										</ul>
									</div>
								</div>
								
								<div id="alb" class="row --group-list nomargin--b">
									@foreach($portfolio as $p)
									<div class="col s6">
										<div class="card">
											<div class="card-image">
												<img src="@if(App\Portfolio::getPortfolioCover($p->id)!='') {{ asset(App\Portfolio::getPortfolioCover($p->id)) }} @else {{ asset('images/noimage.jpg') }} @endif">
												<span class="card-title"><span class="new badge black" data-badge-caption="фото">{{ App\Portfolio::getPortfolioImageCount($p->id) }}</span></span>
											</div>
											<div class="card-action">
												<a href="/portfolio/{{ Request::segment(2) }}/view/{{ $p->id }}">{{ $p->portfolio_name }}</a>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								@if(Auth::check())
								@if(Auth::user()->id==Request::segment(2))
								<div id="addition" class="col s12 --addition">
									<div class="row nomargin--b">
										<form method="post" action="/portfolio/addnewalbum">
										@csrf
										<div class="input-field col s12">
											<input class="__sml" name="album_name" placeholder="Например: «Логотипы», «Ремонт кухни», «Свадебная фотосессия»" id="gallery_name" type="text" required />
											<label for="gallery_name">Название альбома</label>
										</div>
										<div class="input-field col s12">
											<textarea id="gallery_desc" name="album_narrative" class="materialize-textarea __sml" placeholder="Опишите какие работы представлены в этом альбоме, в чем их особенность, когда они были выполнены, в каких целях и т.д."></textarea>
											<label for="gallery_desc">Описание альбома</label>
										</div>
										<div class="col s12 right-align">
											<button class="btn orange">Создать альбом</button>
											<div class="divider cnt"></div>
										</div>
										</form>
									</div>
								</div>
								@endif
								@endif
							</div>
						</div>
						<!--/details-->
					</div>
				</div>
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
<script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/profile.portfolio.js?5') }}"></script>
<script type="text/javascript">
	document.getElementById("file").onchange = function() {
	    document.getElementById("form").submit();
	};
</script>
@endsection