<?php $__env->startSection('title'); ?>
<title>Orzu Услуги - решение любых задач</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link href="https://fonts.googleapis.com/css?family=Exo+2:500&display=swap&subset=cyrillic" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/animate.css')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/main.css?9')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<?php if(Agent::isDesktop()): ?>
<section class="section white _h-heading-text">
	<div class="OverlayOn"></div>
	<div class="container">
		<div class="row">
			<div class="col m12">
				<h1 class="left-align">Решение любых задач
					<span class="__desc hide">Не будем далеко ходить, опубликуем задание прямо сейчас</span>
				</h1>
			</div>
			<div class="col m12">
				<form method="get" action="<?php echo e(route('hometask')); ?>">
					<div class="OrzuTheNewForm">
						<div class="--TextInput col m9 nopadding--l">
							<input type="text" name="task" id="h-form-input" class="autocomplete nomargin" placeholder="Чем вам помочь?" autocomplete="off"/>
						</div>
						<div class="--Button col m3">
							<button type="submit" class="waves-effect waves-light blue btn" id="btn-search">Создать задачу</button>
						</div>
					</div>
					<div class="OrzuTheNewFormHelpers col m12 nopadding wow fadeIn" data-wow-delay="0.6s">
						или взгляните на <a class="OrzuModalTrigger --Categories" data-orzumodal="#modal1">список категорий</a>
					</div>
					<div class="OrzuModalContainer">
						<div id="modal1" class="OrzuModal">
							<div class="OrzuModalHeader psrel">
								<h5>Выберите категории услуг <span class="OrzuModalHeaderNavigation hide" id="OrzuModalHeaderNavigation">Loading...</span></h5>
								<div class="loader" style="display: none;">
									<div class="preloader-wrapper small active">
										<div class="spinner-layer spinner-green-only">
											<div class="circle-clipper left">
												<div class="circle"></div>
											</div><div class="gap-patch">
												<div class="circle"></div>
											</div><div class="circle-clipper right">
												<div class="circle"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="OrzuModalContent">
								<ul class="nomargin--t col m5 ThisIsCatsList nopadding--l" id="ThisIsCatsList">
									<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li data-id="<?php echo e($cat->id); ?>" class="ThisIsItemCatsList">
										<?php 
										$c = 'no';
										$cats = explode(',',request('cat'));
										for($i=0; $i<=count($cats)-1; $i++){
											if($cat->id==$cats[$i]){
												$c = 'yes';
											}
										}
										?>
										<?php echo e($cat->name); ?>

									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<div class="col m7 ThisIsSubCatsList">
									<ul class="nomargin" id="ThisIsSubCatsList">
										— Выберите категорию
									</ul>
								</div>
							</div>
							<div class="OrzuModalFooter">
								<a class="btn-flat waves-effect waves-light OrzuModalClose" href="javascript:;">отмена</a>
								<a class="btn yellow darken-1 OrzuPromoBtn OrzuPromoBtnShadow waves-effect hide" href="javascript:;">Создать задачу</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php else: ?>
<section class="section white _h-heading-text">
	<div class="row">
		<div class="col s12">
			<h1 class="center-align">Решение любой задачи</h1>
		</div>
		<div class="col s12">
			<form method="get" action="<?php echo e(route('hometask')); ?>">
				<div class="HomeCreatTask">
					<input type="text" name="task" id="h-form-input" autocomplete="off" class="HomeCreatTaskInput" placeholder="Что нужно сделать?" />
					<button type="submit" class="HomeCreatTaskButton">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</section>

<section class="section white OrzuCategoriesMobile">
	<div class="collection">
		<a href="/tasks/new/house/houseother" class="collection-item">Уборка и помощь <i class="material-icons blue-text left">location_city</i></a>
		<a href="/tasks/new/auto/carother" class="collection-item">Ремонт и транспорт <i class="material-icons blue-text left">build</i></a>
		<a href="/tasks/new/electronicrepair/electronicrepairother" class="collection-item">Ремонт цифровой техники <i class="material-icons blue-text left">camera_alt</i></a>
		<a href="/tasks/new/trucking/truckingother" class="collection-item">Грузоперевозки <i class="material-icons blue-text left">local_shipping</i></a>
		<a href="/tasks/new/courier/courierother" class="collection-item">Курьерские услуги <i class="material-icons blue-text left">directions_run</i></a>
		<a href="/tasks/new/healthandbeauty/healthandbeautyother" class="collection-item">Красота и здоровье <i class="material-icons blue-text left">favorite</i></a>
		<a href="/tasks/new/design/designother" class="collection-item">Дизайн <i class="material-icons blue-text left">brush</i></a>
		<a href="/tasks/new/webdevelopment/webdevelopmentother" class="collection-item">Web-разработка <i class="material-icons blue-text left">code</i></a>
		<a href="/tasks/new/photoshop/photoshopother" class="collection-item">Фото и видео услуги <i class="material-icons blue-text left">camera</i></a>
	</div>
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php if(!Agent::isMobile()): ?>
<div class="section white OrzuHTWBlock">
	<div class="row container">
		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="https://yastatic.net/s3/frontend/ydo/_/ded4f62d62990b2d358e834af070c90b.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">Создайте задачу</div>
			<div class="OrzuHTWBlockDescript">Опишите задачу. Если нужно, укажите сроки и бюджет</div>
		</div>
		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="https://yastatic.net/s3/frontend/ydo/_/95325c55e93da03019572683d8027e71.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">Получите предложения</div>
			<div class="OrzuHTWBlockDescript">Исполнители сами откликнутся на ваш заказ. Обсудите детали заказа в чате или по телефону</div>
		</div>
		<div class="col m4 s12 center-align">
			<div class="OrzuHTWBlockIcon">
				<img src="https://yastatic.net/s3/frontend/ydo/_/77b2543313800f7f0f89fb4b3bf5147b.svg"/>
			</div>
			<div class="OrzuHTWBlockHeader">Выберите исполнителя</div>
			<div class="OrzuHTWBlockDescript">Выберите подходящего вам исполнителя по рейтингу, отзывам и цене</div>
		</div>
	</div>
</div>

<div class="section grey lighten-5 _h-apps">
	<div class="row container valign-wrapper nomargin--b">
		<div class="col m6 center-align">
			<img src="/images/uslugiapp.png" class="wow bounceInUp _phoneImg" data-wow-delay="0.2s"/>
		</div>
		<div class="col m6 _desc wow fadeIn" data-wow-delay="0.2s">
			<h4>Доступно для смартфонов</h4>
			<span>Скачайте наши мобильные приложения и заказывайте услуги еще быстрее!</span>
			<div class="_download">
				<a href="#" class="_btn _appstore">AppStore</a>
				<a href="#" class="_btn _googleplay">Google PLay</a>
				<div class="_getsms">
					Получите ссылку на приложение <a href="#" id="_getSMS">по SMS</a>
				</div>
				<div class="_formgetsms animated">
					Недоступно для вашей страны.
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php echo $__env->make('parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footlink'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/animate.css.js')); ?>"></script>
<script>
	new WOW().init();
		//Tasks suggestion
		var input = document.getElementById('h-form-input');
		var awesomplete = new Awesomplete(input, {
			minChars: 1
		});
		$("#h-form-input").on("keyup", function(){
			$.ajax({
				url: '<?php echo e(url("/tasks/taskajaxupload?find=")); ?>' + this.value,
				type: 'GET',
				dataType: 'json'
			}).success(function(data) {
				var list = [];
				$.each(data, function(key, value) {
					list.push(value);
				});
				awesomplete.list = list;
			});
		});
		
		$('.ThisIsItemCatsList').click(function() {
			var getDataId = $(this).attr("data-id");
			$('.ThisIsItemCatsList').removeClass('actived');
			$(this).addClass('actived');
			$('.loader').show();
			$('#ThisIsSubCatsList').load("/load/subcat", { id: getDataId, _token: "<?php echo e(csrf_token()); ?>"}, function() {
				$('.loader').hide();
			});
		});
	</script>
	<script type="text/javascript" src="<?php echo e(asset('js/main.js?7')); ?>"></script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/home.blade.php ENDPATH**/ ?>