<style>
	.black-text{
		transition:color .3s;
	}
	.black-text:hover{
		color:#ff9800 !important;
	}
</style>
<div class="col m4 s12 l4 --general-t --siderbar">
			<div class="--group --share-btns">
				<div class="collection sml brd4 boxsh nomargin">
					@if(Auth::check())
						@if(App\Tasks::getUserLikeCount(Request::segment(2))>0)
						<a href="#" class="collection-item black-text tooltipped" data-position="left" data-tooltip="Вы уже благодарили пользователя"> <!-- Лайкнул -->
							Спасибо <span class="badge black-text">{{ App\Tasks::getUserLikeCount(Request::segment(2)) }}</span><i class="material-icons">favorite_border</i>
						</a>
						@else
						<a href="/profile/add_like/{{ Request::segment(2) }}" class="collection-item black-text tooltipped" data-position="left" data-tooltip="Сказать спасибо">
							Спасибо <span class="badge black-text">{{ App\Tasks::getUserLikeCount(Request::segment(2)) }}</span><i class="material-icons">favorite_border</i>
						</a>
						@endif
					@else
					<a href="#" class="collection-item black-text tooltipped" data-position="left" data-tooltip="Повысить рейтинг исполнителя">
						Спасибо <span class="badge black-text">{{ App\Tasks::getUserLikeCount(Request::segment(2)) }}</span><i class="material-icons">favorite_border</i>
					</a>
					@endif
					<a href="#" class="collection-item grey-text tooltipped" data-position="left" data-tooltip="Недоступно для вас, подтвердите документы">
						Пожаловаться <i class="material-icons">report</i>
					</a>
				</div>
			</div>
			@if(Auth::check())
			<div class="--group --share-btns">
				<div class="collection with-header sml brd4 boxsh nomargin">
					<div class="collection-header"><h6>Подтвержденные данные</h6></div>
					@if(App\Profile::getUserDoc($p->id)=='3')
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Документ подтвержден">
					@else
					<div href="#" class="collection-item red-text tooltipped" data-position="left" data-tooltip="Документ пока не подтвержден">
					@endif
						Документы <i class="material-icons">assignment_ind</i>
					</div>
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Номер телефона подтвержден">
						Телефон <i class="material-icons">phone</i>
					</div>
					@if(App\Profile::getUserEmail(Auth::user()->id)!='')
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Email подтвержден">
						Электронная почта <i class="material-icons">alternate_email</i>
					</div>
					@endif
					<a href="/portfolio/{{ Request::segment(2) }}" class="collection-item black-text">
						Примеры работ <i class="material-icons">perm_media</i>
					</a>
					<!--links-->
					<div class="divider"></div>
					@if(App\Tasks::getUserParamWithId(Request::segment(2),'user_fb')!='')
					<a href="//{!! App\Tasks::getUserParamWithId(Request::segment(2),'user_fb') !!}" class="collection-item black-text" target="_blank">
						Facebook <i class="material-icons">link</i>
					</a>
					@endif
					@if(App\Tasks::getUserParamWithId(Request::segment(2),'user_vk')!='')  
					<a href="//{!! App\Tasks::getUserParamWithId(Request::segment(2),'user_vk') !!}" class="collection-item black-text" target="_blank">
						Вконтакте <i class="material-icons">link</i>
					</a>
					@endif
					@if(App\Tasks::getUserParamWithId(Request::segment(2),'user_instagram')!='')  
					<a href="//{!! App\Tasks::getUserParamWithId(Request::segment(2),'user_instagram') !!}" class="collection-item black-text" target="_blank">
						Instagram <i class="material-icons">link</i>
					</a>
					@endif
					@if(App\Tasks::getUserParamWithId(Request::segment(2),'user_web')!='')  
					<a href="//{!! App\Tasks::getUserParamWithId(Request::segment(2),'user_web') !!}" class="collection-item black-text" target="_blank">
						Веб-сайт <i class="material-icons">link</i>
					</a>
					@endif
					<!--/links-->
				</div>
			</div>
			@endif
		</div>