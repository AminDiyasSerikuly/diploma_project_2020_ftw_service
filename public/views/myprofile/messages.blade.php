@extends('base')
@section('title')
<title>Настройки аккаунта</title>
@endsection
@section('headlink')
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css?53') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/messages.css?233') }}"/>
@endsection
@section('content')
<div class="container --general --g-settings">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						<div class="white boxsh brd2 --general-t-detail psrel nopadding--b">
							<div class="--header">
								Мои сообщения
								<!--preloader-->
								<div class="--preloader hide">
									<div class="progress">
										<div class="indeterminate"></div>
									</div>
								</div>
								<!--/preloader-->
							</div>

							<!--Message box-->
							<div class="col m12 nopadding __msgbody">
								<div class="__msgbox">
									@forelse($messages as $m)
										@if(Auth::user()->id==$m->user_id)
										<div class="col s12 __msgsection">
											<div class="__msgtext right blue">
												{{ $m->message }}
											</div>
										</div>
										@else										
										<div class="col s12 __msgsection">
											<div class="__msgtext left">
												{{ $m->message }}
											</div>
										</div>
										@endif
									@empty
										<span>Нет сообщения</span>
									@endforelse
								</div>
							</div>
							<div class="__msgform">
								<div class="input-field col s12 nomargin">
									<form method="post" id="msg" action="{{ route('messageadd') }}">
										@csrf
										<input type="text" name="msg" placeholder="Напишите сообщение..." class="__sml nomargin" required="required">
										<input type="hidden" name="chat_id" value="{{ $chat_id }}">
										<div class="__msgformbtns">
											<a href="javascript://"><i class="material-icons grey-text">insert_emoticon</i></a>
											<a href="javascript://"><i class="material-icons grey-text">attach_file</i></a>
											<a href="javascript://" onclick="document.getElementById('msg').submit()"><i class="material-icons">send</i></a>
										</div>
									</form>
								</div>
							</div>
							<!--/Message box-->
						</div>
						<!--/details-->
					</div>
				</div>
			</div>
		</div>

		<!--sidebar-->
		<div class="col m4 s6 l4 --general-t --siderbar">
			<div class="--group --share-btns">
				<div class="collection sml brd4 boxsh nomargin">
					<div href="#" class="collection-item">
						<a href="/my" class="link3 black-text">Вернуться в кабинет</a>
					</div>
					<div class="divider"></div>
					@forelse($chats as $c)
					<a href="{{ route('chat',$c->task_id) }}" class="collection-item blue-text truncate">
						{{ $c->task_name }}
						<span class="grey-text __msgdesc">{{ Str::limit($c->last_chat_message) }}</span> <i class="material-icons">lens</i>
					</a>
					@empty
					<span class="grey-text __msgdesc">Нет сообщений</span> <i class="material-icons">lens</i>
					@endforelse
				</div>
			</div>
		</div>
		<!--/sidebar-->

	</div>
</div>
@include('parts.footer')
@endsection
@section('footlink')
<script type="text/javascript" src="{{ asset('js/messages.js?33') }}"></script>
@endsection