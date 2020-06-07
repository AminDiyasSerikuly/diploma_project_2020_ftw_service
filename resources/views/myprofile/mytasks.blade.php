@extends('base')
@section('title')
<title>Мои задания</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css?33') }}"/>
@endsection
@section('content')
<div class="container --general --g-mytasks">
	<div class="row">
		<div class="col m8 s12 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12 s12">
						<!--details-->
						<div class="white boxsh brd2 --general-t-detail">
							<div class="col m12 s12">
								<div class="--divider">
									Мои добавленные задания
									<div class="--divider-br"></div>
								</div>
							</div>
							<!--mytasks-->
							<div class="--mytasks">
								@foreach($tasks as $t)
								<div class="col m12 s12 nopadding">
									<div class="card white boxsh">
										<div class="card-content">
											<a href="{{ route('taskview', $t->id) }}" class="card-title truncate black-text">{{ $t->task }}</a>
										</div>
										<div class="card-action">
											<div class="left">
												<span class="--category grey-text text-darken-1 veralmidd">
													{{ $t->cat_name }}
												</span>
											</div>

											<div class="right">
												<span class="--time grey-text text-darken-1 veralmidd">
													<strong>@if($t->status==0) {!! '<strong class="orange-text">Актуально</strong>' !!} @else {!! '<strong class="black-text">Закрыто</strong>' !!} @endif</strong>: {{ $t->start_date }}
												</span>
												@if($t->bujet!='')
												<span class="--sum veralmidd" style="padding: 10px;
    color: #ff9800;">{{ $t->bujet }} {{ App\Lang::getTrans('valuta', Config::get('app.locale'))}}</span>
												@endif
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<!--/mytasks-->
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
<script type="text/javascript" src="{{ asset('js/profile.js') }}"></script>
@endsection