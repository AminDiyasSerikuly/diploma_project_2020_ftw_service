		<div class="col m4 s6 l4 --general-t --siderbar">
			<div class="--group --share-btns">
				<div class="collection sml brd4 boxsh nomargin">
					<?php if(Auth::check()): ?>
						<?php if(App\Tasks::getUserLikeCount(Request::segment(2))>0): ?>
						<a href="#" class="collection-item blue-text tooltipped" data-position="left" data-tooltip="Вы уже благодарили пользователя"> <!-- Лайкнул -->
							Спасибо <span class="badge blue-text"><?php echo e(App\Tasks::getUserLikeCount(Request::segment(2))); ?></span><i class="material-icons">favorite_border</i>
						</a>
						<?php else: ?>
						<a href="/profile/add_like/<?php echo e(Request::segment(2)); ?>" class="collection-item blue-text tooltipped" data-position="left" data-tooltip="Сказать спасибо">
							Спасибо <span class="badge blue-text"><?php echo e(App\Tasks::getUserLikeCount(Request::segment(2))); ?></span><i class="material-icons">favorite_border</i>
						</a>
						<?php endif; ?>
					<?php else: ?>
					<a href="#" class="collection-item blue-text tooltipped" data-position="left" data-tooltip="Повысить рейтинг исполнителя">
						Спасибо <span class="badge blue-text"><?php echo e(App\Tasks::getUserLikeCount(Request::segment(2))); ?></span><i class="material-icons">favorite_border</i>
					</a>
					<?php endif; ?>
					<a href="#" class="collection-item grey-text tooltipped" data-position="left" data-tooltip="Недоступно для вас, подтвердите документы">
						Пожаловаться <i class="material-icons">report</i>
					</a>
				</div>
			</div>
			<?php if(Auth::check()): ?>
			<div class="--group --share-btns">
				<div class="collection with-header sml brd4 boxsh nomargin">
					<div class="collection-header"><h6>Подтвержденные данные</h6></div>
					<?php if(App\Profile::getUserDoc($p->id)=='3'): ?>
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Документ подтвержден">
					<?php else: ?>
					<div href="#" class="collection-item red-text tooltipped" data-position="left" data-tooltip="Документ пока не подтвержден">
					<?php endif; ?>
						Документы <i class="material-icons">assignment_ind</i>
					</div>
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Номер телефона подтвержден">
						Телефон <i class="material-icons">phone</i>
					</div>
					<?php if(App\Profile::getUserEmail(Auth::user()->id)!=''): ?>
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Email подтвержден">
						Электронная почта <i class="material-icons">alternate_email</i>
					</div>
					<?php endif; ?>
					<a href="/portfolio/<?php echo e(Request::segment(2)); ?>" class="collection-item blue-text">
						Примеры работ <i class="material-icons">perm_media</i>
					</a>
					<!--links-->
					<div class="divider"></div>
					<?php if(App\Tasks::getUserParamWithId(Request::segment(2),'user_fb')!=''): ?>
					<a href="//<?php echo App\Tasks::getUserParamWithId(Request::segment(2),'user_fb'); ?>" class="collection-item blue-text" target="_blank">
						Facebook <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<?php if(App\Tasks::getUserParamWithId(Request::segment(2),'user_vk')!=''): ?>  
					<a href="//<?php echo App\Tasks::getUserParamWithId(Request::segment(2),'user_vk'); ?>" class="collection-item blue-text" target="_blank">
						Вконтакте <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<?php if(App\Tasks::getUserParamWithId(Request::segment(2),'user_instagram')!=''): ?>  
					<a href="//<?php echo App\Tasks::getUserParamWithId(Request::segment(2),'user_instagram'); ?>" class="collection-item blue-text" target="_blank">
						Instagram <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<?php if(App\Tasks::getUserParamWithId(Request::segment(2),'user_web')!=''): ?>  
					<a href="//<?php echo App\Tasks::getUserParamWithId(Request::segment(2),'user_web'); ?>" class="collection-item blue-text" target="_blank">
						Веб-сайт <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<!--/links-->
				</div>
			</div>
			<?php endif; ?>
		</div><?php /**PATH /var/www/u0668441/data/www/projectapi.pw/resources/views/parts/profbar.blade.php ENDPATH**/ ?>