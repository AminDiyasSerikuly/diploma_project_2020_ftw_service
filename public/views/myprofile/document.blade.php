@extends('base')
@section('title')
<title>Подтверждение документов</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css?44') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.document.css?3') }}"/>
@endsection
@section('content')
<div class="container --general --g-document">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						<div class="white boxsh brd2 --general-t-detail">
							<div class="--header">
								Подтверждение документов
								<!--preloader-->
								<div class="--preloader" style="display: none;">
									<div class="progress nomargin">
										<div class="indeterminate"></div>
									</div>
								</div>
								<!--/preloader-->
							</div>
							<div class="col m12">
								<form method="POST" action="{{ route('uploaddoc') }}" enctype="multipart/form-data" id="OrzuDocStatus">
									@csrf
									<div class="row nomargin--b">
										<div class="col m12 s12 OrzuDocumentVer nopadding--l">
											<div class="col m9 --text nopadding--l">
												<h6>Обычно, это занимает 5 минут</h6>
												<p class="--textPar">Для того, что бы вы получали больше заказов, мы рекомендуем подтвердить свои данные. Отправьте нам фотографию паспорта и ждите подтверждения ваших данных нашими специалистами.</p>
												@if(App\Profile::getUserDoc(Auth::user()->id)<='0')
												<a href="#" id="upload_link"><i class="material-icons veralmidd">attachment</i> Выбрать документ</a>​
												<input type="file" name="file[]" id="upload" accept="image/*"/>
												@elseif(App\Profile::getUserDoc(Auth::user()->id)=='1')
												<p class="orange-text">Ваш запрос принят, ожидайте подтверждение.</p>
												@elseif(App\Profile::getUserDoc(Auth::user()->id)=='2')
												<p class="red-text">Вы не прошли верификацию, подробности уточните у специалиста: <a href="mailto:docstatus@orzu.me" class="link2">docstatus@orzu.me</a></p>
												@else
												<p class="green-text">Ваши данные подтверждены!</p>
												@endif
											</div>
											<div class="col m3 --svg">
												<img src="/svg/illdoc.svg"/>
											</div>
											@if(App\Profile::getUserDoc(Auth::user()->id)<='0')
											<div class="col m12 nopadding">
												<div class="--divider">
													<div class="--divider-br"></div>
												</div>
											</div>
											<div class="col m12 s12 nomargin--b center-align">
												<input type="submit" class="btn yellow darken-1 OrzuPromoBtn OrzuPromoBtnShadow" value="Отправить на проверку"/>
											</div>
											@endif
										</div>
									</div>
								</form>
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
<script type="text/javascript" src="{{ asset('js/profile.document.js?45') }}"></script>
<script>
	$('#OrzuDocStatus').submit(function(event) {
		event.preventDefault();
		var formData = new FormData($(this)[0]);
		$('.--preloader').show();
		$.ajax({
			url: '{{ route('uploaddoc') }}',
			type: 'POST',              
			data: new FormData(this),
			contentType: false,
			processData: false,
			success: function(result)
			{
				$('.--preloader').hide();
				M.toast({html: result});
				if(result == 'Файл добавлен'){
					location.reload();
				}
			}
		});
	});
</script>
@endsection