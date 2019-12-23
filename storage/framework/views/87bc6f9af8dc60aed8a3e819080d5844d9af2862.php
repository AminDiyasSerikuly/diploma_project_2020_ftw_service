		<?php if(Agent::isDesktop()): ?>
		<div class="col m4 s12 l4 --general-t --siderbar">
			<div class="--group --share-btns">
				<div class="collection sml brd4 boxsh nomargin">
					<div href="#" class="collection-item">
						<a href="/my/balance" class="link3 orange-text">Пополнить баланс</a>
						<div class="right">
							<span class="material-icons veralmidd orange-text">account_balance_wallet</span>
							<span class="veralmidd __bold orange-text"><?php echo e(App\Tasks::getAccountAmount(Auth::user()->id)); ?> <?php if(App\Profile::getUserParam('user_current')!=''): ?><?php echo e(App\Profile::getUserParam('user_current')); ?><?php else: ?>Валюта не задана <?php endif; ?></span>
						</div>
					</div>
					<div class="divider"></div>
					<a href="/my" class="collection-item blue-text <?php if(Request::segment(1)=='my' && Request::segment(2)==''): ?> <?php echo e('active'); ?> <?php endif; ?>">
						Моя страница <i class="material-icons">person</i>
					</a>
					<a href="/my/tasks" class="collection-item blue-text <?php if(Request::segment(2)=='tasks'): ?> <?php echo e('active'); ?> <?php endif; ?>">
						Мои задачи <i class="material-icons">fiber_manual_record</i>
					</a>
					<a href="/my/edit" class="collection-item blue-text <?php if(Request::segment(2)=='edit'): ?> <?php echo e('active'); ?> <?php endif; ?>">
						Редактировать <i class="material-icons">edit</i>
					</a>
					<a href="/my/settings" class="collection-item blue-text <?php if(Request::segment(2)=='settings'): ?> <?php echo e('active'); ?> <?php endif; ?>">
						Настройки <i class="material-icons">settings</i>
					</a>
				</div>
			</div>
			<div class="--group --share-btns">
				<div class="collection with-header sml brd4 boxsh nomargin">
					<div class="collection-header"><h6>Мои данные</h6></div>
					<?php if(App\Profile::getUserDoc(Auth::user()->id)=='3'): ?>
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Документ подтвержден">
					<?php else: ?>
					<div href="#" class="collection-item red-text tooltipped" data-position="left" data-tooltip="Документ пока не подтвержден">
					<?php endif; ?>
						Документы
						<?php if(App\Profile::getUserDoc(Auth::user()->id)<='0'): ?>
						<a href="<?php echo e(route('document')); ?>" class="link2 right">подтвердить</a>
						<?php elseif(App\Profile::getUserDoc(Auth::user()->id)=='1'): ?>
						<a href="<?php echo e(route('document')); ?>" class="orange-text link2 right">ожидание</a>
						<?php elseif(App\Profile::getUserDoc(Auth::user()->id)=='2'): ?>
						<a href="<?php echo e(route('document')); ?>" class="red-text link2 right">отказано</a>
						<?php elseif(App\Profile::getUserDoc(Auth::user()->id)=='3'): ?>
						<i class="material-icons">done</i>
						<?php endif; ?>
					</div>
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Номер телефона подтвержден">
						Телефон <i class="material-icons">phone</i>
					</div>
					<?php if(App\Profile::getUserEmail(Auth::user()->id)!=''): ?>
					<div href="#" class="collection-item green-text tooltipped" data-position="left" data-tooltip="Email подтвержден">
						Электронная почта <i class="material-icons">alternate_email</i>
					</div>
					<?php endif; ?>
					<a href="/portfolio/<?php echo e(Auth::user()->id); ?>" class="collection-item blue-text">
						Примеры работ <i class="material-icons">perm_media</i>
					</a>
					<!--links-->
					<div class="divider"></div>
					<?php if(App\Profile::getUserParam('user_fb')!=''): ?>
					<a href="<?php echo e(App\Profile::getUserParam('user_fb')); ?>" class="collection-item blue-text" target="_blank">
						Facebook <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<?php if(App\Profile::getUserParam('user_vk')!=''): ?>
					<a href="<?php echo e(App\Profile::getUserParam('user_vk')); ?>" class="collection-item blue-text" target="_blank">
						VK <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<?php if(App\Profile::getUserParam('user_instagram')!=''): ?>
					<a href="<?php echo e(App\Profile::getUserParam('user_instagram')); ?>" class="collection-item blue-text" target="_blank">
						Instagram <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<?php if(App\Profile::getUserParam('user_web')!=''): ?>
					<a href="<?php echo e(App\Profile::getUserParam('user_web')); ?>" class="collection-item blue-text" target="_blank">
						Веб-сайт <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<?php if(App\Profile::getUserParam('user_fb')=='' && App\Profile::getUserParam('user_vk')=='' && App\Profile::getUserParam('user_instagram')=='' && App\Profile::getUserParam('user_web')==''): ?>
					<a href="/my/settings#links" class="collection-item blue-text">
						Добавьте ссылки <i class="material-icons">link</i>
					</a>
					<?php endif; ?>
					<!--/links-->
				</div>
			</div>
		</div>
		<?php endif; ?><?php /**PATH /var/www/u0668441/data/www/projectapi.pw/resources/views/parts/mybar.blade.php ENDPATH**/ ?>