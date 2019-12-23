<?php $__env->startSection('title'); ?>
<title>Страница пользователя</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?88')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container --general">
	<div class="row">
		<div class="col m8 s12 --general-t">
			<div class="main">
				<!--details-->
				<?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="white boxsh brd2 --general-t-detail">
					<div class="left --avatar">
						<img src="<?php echo e($p->avatar); ?>"/>
						<a href="#" class="--link" id="upload_link">Изменить</a>
						<form method="POST" action="<?php echo e(route('uploadavatar')); ?>" enctype="multipart/form-data" id="AvatarUpload">
							<?php echo csrf_field(); ?>
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
						<h6 class="nomargin"><?php echo e($p->name); ?></h6>
						<span><?php if(App\User::isOnline(Auth::user()->id)): ?><strong class="green-text">Сейчас в сети</strong><?php else: ?><strong class="orange-text">Не в сети</strong><?php endif; ?> • <?php echo e(App\Profile::getUserAge(date('Y')-App\Tasks::getUserParamWithId($p->id,'byear'))); ?> • <?php echo e(App\Tasks::getUserParamWithId($p->id,'user_address')); ?></span>
						<span class="--badges hide">
							<i class="__verify tooltipped" data-position="bottom" data-tooltip="Подтвержденный исполнитель"></i>
							<i class="__serf tooltipped" data-position="bottom" data-tooltip="Сертифицированный исполнитель"></i>
							<i class="__recomm tooltipped" data-position="bottom" data-tooltip="Рекомендация администрации"></i>
						</span>
					</div>

					<div class="--about row nomargin">
						<h6 class="nomargin">Обо мне</h6>
						<span><?php if(App\Profile::getUserParam('user_about')!=''): ?> <?php echo e(App\Profile::getUserParam('user_about')); ?> <?php else: ?> <?php echo 'Пользователь пока ничего не рассказал о себе :('; ?> <?php endif; ?></span>
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
						Отзывы обо мне
						<div class="--divider-br"></div>
					</div>


					<div class="white brd2 --general-t-reviews">
						<div class="--rating right-align">
							<div class="--sad --ratesml red lighten-5">
								<i></i>
								<span><?php echo e(App\Profile::getUserSadCount(Auth::user()->id)); ?></span>
							</div>
							<div class="--neutral --ratesml orange lighten-5">
								<i></i>
								<span><?php echo e(App\Profile::getUserNeutralCount(Auth::user()->id)); ?></span>
							</div>
							<div class="--happy --ratesml green lighten-5">
								<i></i>
								<span><?php echo e(App\Profile::getUserHappyCount(Auth::user()->id)); ?></span>
							</div>
						</div>

						<?php $__currentLoopData = App\Profile::getUserLikes(Auth::user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $likes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="--rev <?php if($likes->like==0): ?> <?php echo '--sad'; ?> <?php elseif($likes->like==1): ?> <?php echo '--neutral'; ?> <?php else: ?> <?php echo '--happy'; ?> <?php endif; ?>">
							<div class="--smile white-text">
								<i></i>
							</div>
							<?php if(Auth::user()->id==$likes->user_id): ?>
							<a href="/my" target="_blank">
								<img src="<?php echo e(App\Profile::getUserAvatar($likes->user_id)); ?>" class="circle"/>
							</a>
							<?php else: ?>
							<a href="/profile/<?php echo e($likes->user_id); ?>" target="_blank">
								<img src="<?php echo e(App\Profile::getUserAvatar($likes->user_id)); ?>" class="circle"/>
							</a>
							<?php endif; ?>
							<div class="--name">
								<a href="/profile/<?php echo e($likes->user_id); ?>" target="_blank">
									<?php echo e(App\Profile::getUserName($likes->user_id)); ?>

								</a>
							</div>
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

		<!--sidebar-->
		<?php echo $__env->make('parts.mybar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!--/sidebar-->

	</div>
</div>
<?php echo $__env->make('parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footlink'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/profile.js?33')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/profile.avatar-upload.js?33')); ?>"></script>
<script>
	$('#AvatarUpload').change(function(event) {
		event.preventDefault();
		var formData = new FormData($(this)[0]);
		$('.--preloader').show();
		$.ajax({
			url: '<?php echo e(route('uploadavatar')); ?>',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/myprofile/myprofile.blade.php ENDPATH**/ ?>