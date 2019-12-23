<?php $__env->startSection('title'); ?>
<title>Настройки аккаунта</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?53')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/messages.css?233')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
									<?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
										<?php if(Auth::user()->id==$m->user_id): ?>
										<div class="col s12 __msgsection">
											<div class="__msgtext right blue">
												<?php echo e($m->message); ?>

											</div>
										</div>
										<?php else: ?>										
										<div class="col s12 __msgsection">
											<div class="__msgtext left">
												<?php echo e($m->message); ?>

											</div>
										</div>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
										<span>Нет сообщения</span>
									<?php endif; ?>
								</div>
							</div>
							<div class="__msgform">
								<div class="input-field col s12 nomargin">
									<form method="post" id="msg" action="<?php echo e(route('messageadd')); ?>">
										<?php echo csrf_field(); ?>
										<input type="text" name="msg" placeholder="Напишите сообщение..." class="__sml nomargin" required="required">
										<input type="hidden" name="chat_id" value="<?php echo e($chat_id); ?>">
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
					<?php $__empty_1 = true; $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<a href="<?php echo e(route('chat',$c->task_id)); ?>" class="collection-item blue-text truncate">
						<?php echo e($c->task_name); ?>

						<span class="grey-text __msgdesc"><?php echo e(Str::limit($c->last_chat_message)); ?></span> <i class="material-icons">lens</i>
					</a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<span class="grey-text __msgdesc">Нет сообщений</span> <i class="material-icons">lens</i>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!--/sidebar-->

	</div>
</div>
<?php echo $__env->make('parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footlink'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/messages.js?33')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/myprofile/messages.blade.php ENDPATH**/ ?>