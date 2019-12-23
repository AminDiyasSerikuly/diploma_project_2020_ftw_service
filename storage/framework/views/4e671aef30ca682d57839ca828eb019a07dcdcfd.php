<?php $__env->startSection('title'); ?>
<title>Портфолио исполнителя</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/fancybox.min.css')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?5')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.portfolio.css?12')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/common.css?5')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container --general --g-portfolio">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						<div class="white boxsh brd2 --general-t-detail">
							<?php $__currentLoopData = $profile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="left --avatar">
								<img src="https://ui-avatars.com/api/?size=180&font-size=0.33&bold=true&background=2196f3&color=ffffff&name=<?php echo e($p->name); ?>" class="brd4"/>
							</div>
							<div class="--title">
								<h6 class="nomargin"><?php echo e($p->name); ?></h6>
								<span><strong class="green-text">Сейчас в сети</strong> | }</span>
								<span class="--badges">тут будут бейджы</span>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<div class="--divider nomargin--b">
								Примеры работ
								<div class="--divider-br"></div>
							</div>

							<div class="--portfolio nomargin--b">
								<div class="row">
									<div class="col s12">
										<ul class="tabs tabs-fixed-width">
											<li class="tab"><a href="#collections"><?php echo e(App\Portfolio::getPortfolioName(Request::segment(4))); ?></a></li>
											<?php if(Auth::check()): ?>
											<?php if(Auth::user()->id==Request::segment(2)): ?>
											<li class="tab"><a href="#addition">Добавить новые фотографии</a></li>
											<?php endif; ?>
											<?php endif; ?>
										</ul>
									</div>
								</div>
								
								<div class="row --group-list nomargin--b">
									<div id="collections" class="col s12 --collections">
										<p class="--description __g">
											<?php echo e(App\Portfolio::getPortfolioNarrative(Request::segment(4))); ?>

										</p>
										<div id="__jsGallery"></div>
									</div>
									<div id="addition" class="col s12 --addition">
										<div class="row nomargin--b">
											<!--
											<div class="input-field col s12">
												<input class="__sml" placeholder="Например: «Логотипы», «Ремонт кухни», «Свадебная фотосессия»" id="gallery_name" value="Название альбома" type="text"/>
												<label for="gallery_name">Название альбома</label>
											</div>
											<div class="input-field col s12">
												<textarea id="gallery_desc" class="materialize-textarea __sml" placeholder="Опишите какие работы представлены в этом альбоме, в чем их особенность, когда они были выполнены, в каких целях и т.д.">Текст описания</textarea>
												<label for="gallery_desc">Описание альбома</label>
											</div>
											<div class="col s12 right-align">
												<button class="btn blue">Сохранить</button>
												<div class="divider cnt"></div>
											</div>
											-->
											<?php if(Auth::check()): ?>
											<?php if(Auth::user()->id==Request::segment(2)): ?>
											<form method="post" id="form" action="/portfolio/addnewimages" enctype="multipart/form-data">
											<?php echo csrf_field(); ?>
											<div class="file-field input-field col s12 nomargin--t">
												<div class="btn">
													<span>Загрузить фотографии</span>
													<input id="file" type="file" name="image" multiple/>
													<input type="hidden" name="portfolio_id" value="<?php echo e(Request::segment(4)); ?>">
												</div>
												<p class="--description __g">Допустимые форматы: .jpeg, .jpg, .png, .gif. Максимальный объем 1 файла: 3мб.</p>
											</div>
											<div class="col s12">
												<p class="--description __f">Загружено: 3 файла</p>
												<div class="chip">
													file.jpg
													<i class="close material-icons">close</i>
												</div>
												<div class="chip">
													file.gif
													<i class="close material-icons">close</i>
												</div>
												<div class="chip">
													file.png
													<i class="close material-icons">close</i>
												</div>
											</div>
											</form>
											<?php endif; ?>
											<?php endif; ?>
										</div>
									</div>
								</div>
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
<script type="text/javascript" src="<?php echo e(asset('js/fancybox.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/common.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/profile.portfolio.js?10')); ?>"></script>
<script>
	var __jsImglist = [
		<?php $__currentLoopData = App\Portfolio::getPortfolioImages(Request::segment(4)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo '"'.asset($image->img_path).'",'; ?>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	];
	var gallery = document.getElementById("__jsGallery");
	for (var i = 0; i < __jsImglist.length; i++) {
		var thumbnailWrapper = document.createElement("div");
		thumbnailWrapper.className = "thumbnail-wrapper";

		var thumbnail = document.createElement("a");
		thumbnail.className = "thumbnail";
		thumbnail.setAttribute('style', 'background-image:url(\"' + __jsImglist[i] + '\");');
		thumbnail.setAttribute('href', __jsImglist[i]);
		thumbnail.setAttribute('data-fancybox', 'images');

		thumbnailWrapper.appendChild(thumbnail);
		gallery.appendChild(thumbnailWrapper);
	}
	$('[data-fancybox="images"]').fancybox({
		buttons : ["zoom","thumbs","close"],
		animationEffect: "slide",
	 	transitionEffect: "slide"
	});
	document.getElementById("file").onchange = function() {
	    document.getElementById("form").submit();
	};
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/portfolio/portfolioview.blade.php ENDPATH**/ ?>