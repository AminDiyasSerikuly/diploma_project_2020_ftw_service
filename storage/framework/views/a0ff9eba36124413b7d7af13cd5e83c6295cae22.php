<?php $__env->startSection('title'); ?>
<title>Страница пользователя</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?88')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container --general">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						<?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="white boxsh brd2 --general-t-detail">
							<div class="left --avatar">
								<img src="<?php echo e($p->avatar); ?>"/>
							</div>
							<div class="--title row">
								<h6 class="nomargin"><?php echo e($p->name); ?></h6>
								<span>
									<?php if(App\User::isOnline($p->id)): ?><strong class="green-text">Сейчас в сети</strong><?php else: ?><strong class="orange-text">Не в сети</strong><?php endif; ?> • <?php echo e(App\Profile::getUserAge(date('Y')-App\Tasks::getUserParamWithId($p->id,'byear'))); ?> •
									<?php if(App\Profile::getUserParamCheck($p->id, 'user_address')<0): ?><?php echo e(App\Tasks::getUserParamWithId($p->id,'user_address')); ?><?php else: ?>город не указан<?php endif; ?>
								</span>
								<span class="--badges hide">
									<i class="__verify tooltipped" data-position="bottom" data-tooltip="Подтвержденный исполнитель"></i>
									<i class="__serf tooltipped" data-position="bottom" data-tooltip="Сертифицированный исполнитель"></i>
									<i class="__recomm tooltipped" data-position="bottom" data-tooltip="Рекомендация администрации"></i>
								</span>
							</div>

							<div class="--about row nomargin">
								<h6 class="nomargin">Обо мне</h6>
								<span><?php if(App\Tasks::getUserParamWithId($p->id,'user_about')!=''): ?> <?php echo e(App\Tasks::getUserParamWithId($p->id,'user_about')); ?> <?php else: ?> <?php echo 'Пользователь пока ничего не рассказал о себе :('; ?> <?php endif; ?></span>
							</div>

							<!--service-->
							<?php if(App\Tasks::getUserCatChecked($p->id)>0): ?>
							<div class="--divider">
								Виды выполняемых работ
								<div class="--divider-br"></div>
							</div>
							<div class="--service">
								<?php $__currentLoopData = $user_cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php
									$cat = explode(';',$uc->meta_value);
								?>
								<a href="#"><?php echo e(App\Tasks::getCatName($cat[1])); ?></a>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							<?php endif; ?>
							<!--/service-->

							<!--reviews-->
							<div class="--divider">
								Отзывы о пользователе
								<div class="--divider-br"></div>
							</div>


							<div class="white brd2 --general-t-reviews">
								<?php if(Auth::check()): ?>
									<?php if(App\Tasks::getUserLike(Request::segment(2), Auth::user()->id)<=0): ?>
									<div class="--form row">
										<form class="col m12" method="post" action="/profile/add_rate">
											<?php echo csrf_field(); ?>
											<div class="row">
												<div class="input-field col m12">
													<textarea id="891284" name="narrative" class="materialize-textarea" required></textarea>
													<label for="891284">Написать отзыв</label>
													<input type="hidden" name="like_user_id" value="<?php echo e(Request::segment(2)); ?>" />
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
									<?php endif; ?>
								<?php endif; ?>
								<div class="--rating right-align">
									<div class="--sad --ratesml red lighten-5">
										<i></i>
										<span><?php echo e(App\Profile::getUserSadCount(Request::segment(2))); ?></span>
									</div>
									<div class="--neutral --ratesml orange lighten-5">
										<i></i>
										<span><?php echo e(App\Profile::getUserNeutralCount(Request::segment(2))); ?></span>
									</div>
									<div class="--happy --ratesml green lighten-5">
										<i></i>
										<span><?php echo e(App\Profile::getUserHappyCount(Request::segment(2))); ?></span>
									</div>
								</div>

								<?php $__currentLoopData = App\Profile::getUserLikes(Request::segment(2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $likes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="--rev <?php if($likes->like==0): ?> <?php echo '--sad'; ?> <?php elseif($likes->like==1): ?> <?php echo '--neutral'; ?> <?php else: ?> <?php echo '--happy'; ?> <?php endif; ?>">
									<div class="--smile white-text">
										<i></i>
									</div>
									<?php if(Auth::check()): ?>
										<?php if(Auth::user()->id==$likes->user_id): ?>
										<a href="/profile/<?php echo e($likes->user_id); ?>" target="_blank">
											<img src="<?php echo e(App\Profile::getUserAvatar($likes->user_id)); ?>" class="circle"/>
										</a>										
										<div class="--name"><a href="/my" target="_blank"><?php echo e(App\Profile::getUserName($likes->user_id)); ?></a></div>
										<?php else: ?>
										<a href="/profile/<?php echo e($likes->user_id); ?>" target="_blank">
											<img src="<?php echo e(App\Profile::getUserAvatar($likes->user_id)); ?>" class="circle"/>
										</a>									
										<div class="--name">
											<a href="/profile/<?php echo e($likes->user_id); ?>" target="_blank">
												<?php echo e(App\Profile::getUserName($likes->user_id)); ?>

											</a>
										</div>
										<?php endif; ?>
									<?php else: ?>									
									<a href="/profile/<?php echo e($likes->user_id); ?>" target="_blank">
										<img src="<?php echo e(App\Profile::getUserAvatar($likes->user_id)); ?>" class="circle"/>
									</a>									
									<div class="--name">
										<a href="/profile/<?php echo e($likes->user_id); ?>" target="_blank">
											<?php echo e(App\Profile::getUserName($likes->user_id)); ?>

										</a>
									</div>
									<?php endif; ?>
									<div class="--descript"><?php echo e($likes->narrative); ?></div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>	
							<!--/reviews-->

						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<!--/details-->
					</div>
				</div>
			</div>
		</div>

		<!--sidebar-->
		<?php echo $__env->make('parts.profbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!--/sidebar-->

	</div>
</div>
<?php echo $__env->make('parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footlink'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/profile.js?4')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/projectapi.pw/resources/views/profile.blade.php ENDPATH**/ ?>