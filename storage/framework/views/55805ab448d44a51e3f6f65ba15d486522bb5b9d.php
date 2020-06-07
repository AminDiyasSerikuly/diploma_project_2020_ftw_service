<?php $__env->startSection('title'); ?>
<title>Редактирование профиля</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?44')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.edit.css?44')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container --general --g-edit">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<!--details-->
				<div class="white boxsh brd2 --general-t-detail">
					<div class="--header">
						Редактирование профиля
					</div>
					<?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<form class="col s12" method="post" action="/my/edit/update">
						<?php echo csrf_field(); ?>
						<div class="row">
							<div class="input-field col s6 nomargin--t">
								<input id="first_name" type="text" name="name" value="<?php echo e($p->name); ?>">
								<label for="first_name">Имя</label>
							</div>
							<div class="input-field col s6 nomargin--t">
								<input id="last_name" type="text" name="fname" value="<?php echo e($p->fname); ?>">
								<label for="last_name">Фамилия</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s8">
								<select class="cities" id="cities" name="cities">
									<?php if(App\Profile::getUserParam('user_address')!=''): ?> <?php echo '<option value="'.App\Profile::getUserParam('user_address').'">'.App\Profile::getUserParam('user_address').'</option>'; ?> <?php endif; ?>
								</select>
								<label for="cities">Выберите город</label>
							</div>
							<div class="input-field col s4">
								<input type="text" disabled="disabled" value="<?php if(App\Profile::getUserParam('user_current')!=''): ?><?php echo e(App\Profile::getUserParam('user_current')); ?><?php else: ?>Валюта не задана <?php endif; ?>" id="currently"/>
								<label for="cities">Ваша валюта</label>
							</div>
						</div>
						<div class="row nomargin--b">
							<div class="input-field col s12">
								<textarea id="description_profile" name="about" class="materialize-textarea nomargin--b" data-length="500"><?php echo e(App\Profile::getUserParam('user_about')); ?></textarea>
								<label for="description_profile">О себе</label>
							</div>
						</div>
						<div class="row nomargin--b">
							<div class="col s12 --title">
								<div class="--g-title">Дата рождения</div>
							</div>
							<div class="input-field col s4">
								<select id="__jsDays" class="birthdate" name="bday"><?php if(App\Profile::getUserParam('bday')!=''): ?> <?php echo '<option value="'.App\Profile::getUserParam('bday').'">'.App\Profile::getUserParam('bday').'</option>'; ?> <?php endif; ?></select>
								<label>День</label>
							</div>
							<div class="input-field col s4">
								<select id="__jsMonths" class="birthdate" name="bmonth"><?php if(App\Profile::getUserParam('bmonth')!=''): ?> <?php echo '<option value="'.App\Profile::getUserParam('bmonth').'">'.App\Profile::getUserParam('bmonth').'</option>'; ?> <?php endif; ?></select>
								<label>Месяц</label>
							</div>
							<div class="input-field col s4">
								<select id="__jsYears" class="birthdate" name="byear"><?php if(App\Profile::getUserParam('byear')!=''): ?> <?php echo '<option value="'.App\Profile::getUserParam('byear').'">'.App\Profile::getUserParam('byear').'</option>'; ?> <?php endif; ?></select>
								<label>Год</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<div class="--g-title">Ваш пол</div>
								<div class="section-grid">
									<label>
										<input name="gender" value="male" class="with-gap" type="radio" <?php if(App\Profile::getUserParam('user_sex')=='male'): ?> <?php echo e('checked'); ?> <?php endif; ?>/>
										<span class="checkpoint-gender">Мужчина</span>
									</label>
								</div>
								<div class="section-grid">
									<label>
										<input name="gender" value="female" class="with-gap" type="radio" <?php if(App\Profile::getUserParam('user_sex')=='female'): ?> <?php echo e('checked'); ?> <?php endif; ?> />
										<span class="checkpoint-gender">Женщина</span>
									</label>
								</div>
							</div>
						</div>

						<div class="divider"></div>

						<div class="row nomargin--b --actbtn">
							<!--preloader-->
							<div class="--preloader hide">
								<div class="progress">
									<div class="indeterminate"></div>
								</div>
							</div>
							<!--/preloader-->
							<div class="col s12">
								<button class="right waves-effect waves-light orange btn-small">Сохранить</button>
							</div>
						</div>
					</form>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
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
<script type="text/javascript" src="<?php echo e(asset('js/profile.edit.js?55')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/myprofile/edit.blade.php ENDPATH**/ ?>