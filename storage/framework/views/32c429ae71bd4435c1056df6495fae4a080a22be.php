<?php $__env->startSection('title'); ?>
<title>Подтверждение документов</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?44')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.document.css?3')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container --general --g-document">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						<div class="white boxsh brd2 --general-t-detail">
							<div class="--header">
								Подтверждение документов
								<!--preloader-->
								<div class="--preloader" style="display: none;">
									<div class="progress nomargin">
										<div class="indeterminate"></div>
									</div>
								</div>
								<!--/preloader-->
							</div>
							<div class="col m12">
								<form method="POST" action="<?php echo e(route('uploaddoc')); ?>" enctype="multipart/form-data" id="OrzuDocStatus">
									<?php echo csrf_field(); ?>
									<div class="row nomargin--b">
										<div class="col m12 s12 OrzuDocumentVer nopadding--l">
											<div class="col m9 --text nopadding--l">
												<h6>Обычно, это занимает 5 минут</h6>
												<p class="--textPar">Для того, что бы вы получали больше заказов, мы рекомендуем подтвердить свои данные. Отправьте нам фотографию паспорта и ждите подтверждения ваших данных нашими специалистами.</p>
												<?php if(App\Profile::getUserDoc(Auth::user()->id)<='0'): ?>
												<a href="#" id="upload_link"><i class="material-icons veralmidd">attachment</i> Выбрать документ</a>​
												<input type="file" name="file[]" id="upload" accept="image/*"/>
												<?php elseif(App\Profile::getUserDoc(Auth::user()->id)=='1'): ?>
												<p class="orange-text">Ваш запрос принят, ожидайте подтверждение.</p>
												<?php elseif(App\Profile::getUserDoc(Auth::user()->id)=='2'): ?>
												<p class="red-text">Вы не прошли верификацию, подробности уточните у специалиста: <a href="mailto:docstatus@orzu.me" class="link2">docstatus@orzu.me</a></p>
												<?php else: ?>
												<p class="green-text">Ваши данные подтверждены!</p>
												<?php endif; ?>
											</div>
											<div class="col m3 --svg">
												<img src="/svg/illdoc.svg"/>
											</div>
											<?php if(App\Profile::getUserDoc(Auth::user()->id)<='0'): ?>
											<div class="col m12 nopadding">
												<div class="--divider">
													<div class="--divider-br"></div>
												</div>
											</div>
											<div class="col m12 s12 nomargin--b center-align">
												<input type="submit" class="btn yellow darken-1 OrzuPromoBtn OrzuPromoBtnShadow" value="Отправить на проверку"/>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</form>
							</div>
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
<script type="text/javascript" src="<?php echo e(asset('js/profile.document.js?45')); ?>"></script>
<script>
	$('#OrzuDocStatus').submit(function(event) {
		event.preventDefault();
		var formData = new FormData($(this)[0]);
		$('.--preloader').show();
		$.ajax({
			url: '<?php echo e(route('uploaddoc')); ?>',
			type: 'POST',              
			data: new FormData(this),
			contentType: false,
			processData: false,
			success: function(result)
			{
				$('.--preloader').hide();
				M.toast({html: result});
				if(result == 'Файл добавлен'){
					location.reload();
				}
			}
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/projectapi.pw/resources/views/myprofile/document.blade.php ENDPATH**/ ?>