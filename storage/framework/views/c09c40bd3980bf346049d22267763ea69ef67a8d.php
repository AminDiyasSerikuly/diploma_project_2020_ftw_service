<?php $__env->startSection('title'); ?>
<title>Портфолио исполнителя</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?5')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.portfolio.css?8')); ?>"/>
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
								<span><strong class="green-text">Сейчас в сети</strong> |  <?php echo e(date('Y')-App\Profile::getUserParam('byear')); ?> года | <?php echo e(App\Profile::getUserParam('user_address')); ?></span>
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
											<li class="tab"><a href="#alb">Альбомы</a></li>
											<?php if(Auth::check()): ?>
											<?php if(Auth::user()->id==Request::segment(2)): ?>
											<li class="tab"><a href="#addition">Добавить новый альбом</a></li>
											<?php endif; ?>
											<?php endif; ?>
										</ul>
									</div>
								</div>
								
								<div id="alb" class="row --group-list nomargin--b">
									<?php $__currentLoopData = $portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col s6">
										<div class="card">
											<div class="card-image">
												<img src="<?php if(App\Portfolio::getPortfolioCover($p->id)!=''): ?> <?php echo e(asset(App\Portfolio::getPortfolioCover($p->id))); ?> <?php else: ?> <?php echo e(asset('images/noimage.jpg')); ?> <?php endif; ?>">
												<span class="card-title"><span class="new badge black" data-badge-caption="фото"><?php echo e(App\Portfolio::getPortfolioImageCount($p->id)); ?></span></span>
											</div>
											<div class="card-action">
												<a href="/portfolio/<?php echo e(Request::segment(2)); ?>/view/<?php echo e($p->id); ?>"><?php echo e($p->portfolio_name); ?></a>
											</div>
										</div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<?php if(Auth::check()): ?>
								<?php if(Auth::user()->id==Request::segment(2)): ?>
								<div id="addition" class="col s12 --addition">
									<div class="row nomargin--b">
										<form method="post" action="/portfolio/addnewalbum">
										<?php echo csrf_field(); ?>
										<div class="input-field col s12">
											<input class="__sml" name="album_name" placeholder="Например: «Логотипы», «Ремонт кухни», «Свадебная фотосессия»" id="gallery_name" type="text" required />
											<label for="gallery_name">Название альбома</label>
										</div>
										<div class="input-field col s12">
											<textarea id="gallery_desc" name="album_narrative" class="materialize-textarea __sml" placeholder="Опишите какие работы представлены в этом альбоме, в чем их особенность, когда они были выполнены, в каких целях и т.д."></textarea>
											<label for="gallery_desc">Описание альбома</label>
										</div>
										<div class="col s12 right-align">
											<button class="btn blue">Создать альбом</button>
											<div class="divider cnt"></div>
										</div>
										</form>
									</div>
								</div>
								<?php endif; ?>
								<?php endif; ?>
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
<script type="text/javascript" src="<?php echo e(asset('js/common.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/profile.portfolio.js?5')); ?>"></script>
<script type="text/javascript">
	document.getElementById("file").onchange = function() {
	    document.getElementById("form").submit();
	};
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/projectapi.pw/resources/views/portfolio/portfolio.blade.php ENDPATH**/ ?>