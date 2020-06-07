<?php $__env->startSection('title'); ?>
<title>Мои задания</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?33')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
								<?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col m12 s12 nopadding">
									<div class="card white boxsh">
										<div class="card-content">
											<a href="<?php echo e(route('taskview', $t->id)); ?>" class="card-title truncate black-text"><?php echo e($t->task); ?></a>
										</div>
										<div class="card-action">
											<div class="left">
												<span class="--category grey-text text-darken-1 veralmidd">
													<?php echo e($t->cat_name); ?>

												</span>
											</div>

											<div class="right">
												<span class="--time grey-text text-darken-1 veralmidd">
													<strong><?php if($t->status==0): ?> <?php echo '<strong class="orange-text">Актуально</strong>'; ?> <?php else: ?> <?php echo '<strong class="black-text">Закрыто</strong>'; ?> <?php endif; ?></strong>: <?php echo e($t->start_date); ?>

												</span>
												<?php if($t->bujet!=''): ?>
												<span class="--sum veralmidd" style="padding: 10px;
    color: #ff9800;"><?php echo e($t->bujet); ?> <?php echo e(App\Lang::getTrans('valuta', Config::get('app.locale'))); ?></span>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							<!--/mytasks-->
						</div>
						<!--/details-->
					</div>
				</div>
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
<script type="text/javascript" src="<?php echo e(asset('js/profile.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/myprofile/mytasks.blade.php ENDPATH**/ ?>