@extends('base')
@section('title')
<title>Orzu Услуги - Все задания в городе {{ Config::get('app.city') }}</title>
@endsection
@section('headlink')
<script>
	if(window.performance){
		if(performance.navigation.type == 1){
			window.location.search = "";
		}
	}
</script>
<link type="text/css" rel="stylesheet" href="{{ asset('css/tasks.css?22') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/header-normalize.css') }}"  media="screen,projection"/>
<script src="{{ asset('js/placeholder.js') }}"></script>
<script src="{{ asset('js/getAddress.js') }}"></script>
@endsection
@section('content')
<div class="demo-ribbon"></div>
<div class="container --general">
	<div class="row">
		<div class="col m8 s12 l8 --general-t">
			@if(Agent::isMobile())
			<div class="col s6"></div>
				<div class="col s6 pull-s3" style="margin-bottom: 1em;">
				<a class="waves-effect waves-light btn blue modal-trigger right" href="#modal1" style="background-color: #ff9800!important;border-radius: 10px;">Категории</a>
			</div>
			@endif
			<div class="main col l11">
				@if(Agent::isDesktop())
				<div class="row nomargin--b">
					<div class="col m12 s12 l12">
						<div class="card white boxsh2 OrzuPromoAddition">
							<h6 class="nomargin--t">Опишите задачу, сроки и желаемую стоимость, и подходящие исполнители сами напишут вам.</h6>
							<a href="/tasks/new/techrepair/techrepairother?utm_campaign=OrzuPromoAddition" class="btn yellow darken-1 waves-effect waves-light">Разместить заказ</a>
						</div>
					</div>
				</div>
				@endif
				<div class="row" id="load-data">
										{{-- {{ $tasks }} --}}
					@foreach($tasks as $t)
					{{-- {{ App\Tasks::getUserTaskCount($t->user_id) }} --}}
{{-- {{ $t->id }}
{{ $t->user_id }}
{{ App\User::where('id',$t->user_id)->first() }}
<br> --}}
{{-- {{ App\User::where('id',$t->user_id)->first() }} --}}
{{--						Check--}}
						@if(App\User::where('id',$t->user_id)->first() != '') {{-- На случай если пользователь удален из базы --}}
{{--					EndOfIfStatement--}}
					<div class="col m12 s12 infinite-scroll" id="rm">

						<div class="card white boxsh2">
{{--							<a href="{{ route('taskview',$t->id) }}">--}}
{{--							{{ $t }}--}}
								<div class="card-content">
									<a href="{{ route('taskview',$t->id) }}" class="card-title truncate">{{ $t->task }}</a>
									@if($t->bujet!='')
									<div class="--sum veralmidd"><span>{{ $t->bujet }}</span></div>
									@endif
								</div>
{{--							</a>--}}
							<div class="card-action">
								<div class="left">
									<span class="--category grey-text text-darken-1 veralmidd">
										{{ $t->cat_parent_name }}
									</span>
								</div>

								<div class="right">
									@if($t->start_date!='')
									<span class="--time grey-text text-darken-1 veralmidd">
										{{ $t->start_date }}
									</span>
									@endif
									<span class="--splitted veralmidd">•</span>
									<span class="--city grey-text text-darken-1 veralmidd">
										{{ $t->city }}
									</span>
								</div>
							</div>
						</div>

					</div>
{{--							check--}}
					@endif
{{--						endOfCheck--}}
					@endforeach
					<div class="col m12 s12" id="remove-row">
						<button id="btn-more" data-id="@if(isset($t->id)) {{ $t->id }} @else {{ '1' }} @endif" class="btn-flat waves-effect brd2 center-align __js-tasks-more" >показать еще</button>
					</div>
				</div>
			</div>
		</div>
		@if(Agent::isDesktop())
		<div class="col m4 s12 l4 --general-t">
			<div class="sidebar">
				@guest
				<div class="--group OrzuPromoHead">
					<h6 class="nomargin--t"><a href="/login?utm_campaign=OrzuPromoHead attention">Зарегистрируйтесь или войдите</a>, чтобы выполнять заказы</h6>
				</div>
				@endif
				<div class="--group --srch">
					<div class="row nomargin">
						<div class="TaskFilterSearch">
							<input placeholder="Что вы хотите найти?" id="__js-filter-search" type="text" name="find" class="nomargin TaskFilterSearchInput" value="{{ request("find") }}">
{{--							<button type="submit" class="TaskFilterSearchButton" id="btn-search">Найти</button>--}}
							<button type="submit" class="TaskFilterSearchButton material-icons" id="btn-search">search</button>
						</div>
					</div>
					<div class="row nomargin --srchCH">
						<div class="--group">
							<label>
								<input type="checkbox" name="offers" value="yes" class="filled-in check" id="__js-filter-offers" @if(request('offers')!='') {{ 'checked' }} @endif/>
								<span>Без предложений</span>
							</label>
						</div>
						<div class="--group">
							<label>
								<input type="checkbox" name="bs" value="yes" class="filled-in check" id="__js-filter-bs" @if(request('bs')!='') {{ 'checked' }} @endif/>
								<span>Безопасная сделка</span>
							</label>
						</div>
						<div class="--group">
							<label>
								<input type="checkbox" name="beside" value="yes" class="filled-in check" id="__js-filter-beside" @if(request('beside')!='') {{ 'checked' }} @endif/>
								<span>Рядом ({{ Config::get('app.city') }})</span>
							</label>
						</div>
					</div>
				</div>

				<div class="divider"></div>

				<div class="--group __js-filter-category">
					<div class="__js-filter-category-title">
						<h6 class="nomargin--t"><a href="#" class="link2" id="ShowCat">Категории</a></h6>
					</div>
					<ul class="nomargin--t" id="ThisIsCatsList">
						@foreach($categories as $cat)
						<li class="__js-filter-category-item">
							<div class="__js-filter-category-item--h">
								<div class="__js-filter-category-subarrow">
									<i class="material-icons">expand_more</i>
								</div>
								<?php 
								$c = 'no';
								$cats = explode(',',request('cat'));
								for($i=0; $i<=count($cats)-1; $i++){
									if($cat->id==$cats[$i]){
										$c = 'yes';
									}
								}
								?>
								<label class="__js-filter-category-label checkbox"><input type="checkbox" class="filled-in check" name="cat" data-id="itm{{ $cat->id }}" data-name="item" @if($c=='yes') {{ 'checked' }} @endif value="{{ $cat->id }}"/> <span>{{ $cat->name }}</span></label>
							</div>
							<ul>
								@foreach($cat->sub_cat_name as $subcat)
								<?php 
								$sc = 'no';
								for($i=0; $i<=count($cats)-1; $i++){
									if($subcat->id==$cats[$i]){
										$sc = 'yes';
									}
								}
								?>
								<li>
									<div class="__js-filter-category-item--h">
										<label class="checkbox"><input type="checkbox" class="filled-in check" name="cat" data-id="itm{{ $subcat->id }}" value="{{ $subcat->id }}"  @if($sc=='yes') {{ 'checked' }} @endif data-name="{{ $subcat->name }}" /> <span>{{ $subcat->name }}</span></label>
									</div>
								</li>
								@endforeach
							</ul>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

@if(Agent::isMobile())
<div id="modal1" class="modal bottom-sheet">
	<div class="modal-content">
		<h6>Выберите категории услуг</h6>
			<ul class="nomargin--t">
				@foreach($categories as $cat)
				<li class="__js-filter-category-item">
					<div class="__js-filter-category-item--h">
						<div class="__js-filter-category-subarrow">
							<i class="material-icons">expand_more</i>
						</div>
						<?php 
						$c = 'no';
						$cats = explode(',',request('cat'));
						for($i=0; $i<=count($cats)-1; $i++){
							if($cat->id==$cats[$i]){
								$c = 'yes';
							}
						}
						?>
						<label><input type="checkbox" class="filled-in check" name="cat" data-id="itm{{ $cat->id }}" data-name="item" @if($c=='yes') {{ 'checked' }} @endif value="{{ $cat->id }}"/> <span>{{ $cat->name }}</span></label>
					</div>
					<ul>
						@foreach($cat->sub_cat_name as $subcat)
						<?php 
						$sc = 'no';
						for($i=0; $i<=count($cats)-1; $i++){
							if($subcat->id==$cats[$i]){
								$sc = 'yes';
							}
						}
						?>
						<li>
							<div class="__js-filter-category-item--h">
								<label><input type="checkbox" class="filled-in check" name="cat" data-id="itm{{ $subcat->id }}" value="{{ $subcat->id }}"  @if($sc=='yes') {{ 'checked' }} @endif data-name="{{ $subcat->name }}" /> <span>{{ $subcat->name }}</span></label>
							</div>
						</li>
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Показать</a>
	</div>
</div>
@endif

@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/ch.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tasks.js?47') }}"></script>
<script>
	$(document).ready(function(){



		$('.modal').modal();
		$(document).on('click','#btn-more',function(){
			var id = $(this).data('id');
			var find = '{{ request("find") }}';
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$.ajax({
				url : '{{ route('taskajax') }}',
				method : "POST",
				data : {id:id, find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"{{ csrf_token() }}"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		}); 
		$(document).on('change','#btn-status',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '{{ route('taskajaxfilter') }}',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"{{ csrf_token() }}"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('click','#btn-search',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '{{ route('taskajaxfilter') }}',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"{{ csrf_token() }}"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('click','.__js-filter-sortby-time',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '{{ route('taskajaxfilter') }}',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"{{ csrf_token() }}"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('click','.__js-filter-sortby-date',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '{{ route('taskajaxfilter') }}',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"{{ csrf_token() }}"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('change','.check',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '{{ route('taskajaxfilter') }}',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"{{ csrf_token() }}"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
	});
	//Tasks suggestion
	var input = document.getElementById('__js-filter-search');
	var awesomplete = new Awesomplete(input, {
		minChars: 1
	});
	$("#__js-filter-search").on("keyup", function(){
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
window.onload = function() {
																// autoload Created 03.12.19
if(window.location.href.match(/\d+$/gm)){
	// $('input[name="cat"]').eq(window.location.href.match(/\d+$/gm)-1).removeAttr('checked').click()
	$('input[data-id="itm'+ window.location.href.match(/\d+$/gm)-1 +'"]').removeAttr('checked').click();
}
															//End of autoload	

const placeholders = [
    'Давайте поищем',
    'Просто начните печатать',
    'У Вас все получится'
]


let addToPlaceholder = new Placeholder(placeholders,'#__js-filter-search');
addToPlaceholder.adding();

let clickableBlock = new GetAddress('#load-data','card','card-title', 'stop');
clickableBlock.listen();

}

</script>
@endsection