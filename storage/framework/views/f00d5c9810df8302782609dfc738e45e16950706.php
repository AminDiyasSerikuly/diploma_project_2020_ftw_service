<?php $__env->startSection('title'); ?>
<title>Orzu Услуги - Все задания в городе <?php echo e(Config::get('app.city')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<script>
	if(window.performance){
		if(performance.navigation.type == 1){
			window.location.search = "";
		}
	}
</script>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/tasks.css?22')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/header-normalize.css')); ?>"  media="screen,projection"/>
<script src="<?php echo e(asset('js/placeholder.js')); ?>"></script>
<script src="<?php echo e(asset('js/getAddress.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="demo-ribbon"></div>
<div class="container --general">
	<div class="row">
		<div class="col m8 s12 l8 --general-t">
			<?php if(Agent::isMobile()): ?>
			<div class="col s6"></div>
				<div class="col s6 pull-s3" style="margin-bottom: 1em;">
				<a class="waves-effect waves-light btn blue modal-trigger right" href="#modal1" style="background-color: #ff9800!important;border-radius: 10px;">Категории</a>
			</div>
			<?php endif; ?>
			<div class="main col l11">
				<?php if(Agent::isDesktop()): ?>
				<div class="row nomargin--b">
					<div class="col m12 s12 l12">
						<div class="card white boxsh2 OrzuPromoAddition">
							<h6 class="nomargin--t">Опишите задачу, сроки и желаемую стоимость, и подходящие исполнители сами напишут вам.</h6>
							<a href="/tasks/new/techrepair/techrepairother?utm_campaign=OrzuPromoAddition" class="btn yellow darken-1 waves-effect waves-light">Разместить заказ</a>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="row" id="load-data">
										
					<?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					



						<?php if(App\User::where('id',$t->user_id)->first() != ''): ?> 

					<div class="col m12 s12 infinite-scroll" id="rm">

						<div class="card white boxsh2">


								<div class="card-content">
									<a href="<?php echo e(route('taskview',$t->id)); ?>" class="card-title truncate"><?php echo e($t->task); ?></a>
									<?php if($t->bujet!=''): ?>
									<div class="--sum veralmidd"><span><?php echo e($t->bujet); ?></span></div>
									<?php endif; ?>
								</div>

							<div class="card-action">
								<div class="left">
									<span class="--category grey-text text-darken-1 veralmidd">
										<?php echo e($t->cat_parent_name); ?>

									</span>
								</div>

								<div class="right">
									<?php if($t->start_date!=''): ?>
									<span class="--time grey-text text-darken-1 veralmidd">
										<?php echo e($t->start_date); ?>

									</span>
									<?php endif; ?>
									<span class="--splitted veralmidd">•</span>
									<span class="--city grey-text text-darken-1 veralmidd">
										<?php echo e($t->city); ?>

									</span>
								</div>
							</div>
						</div>

					</div>

					<?php endif; ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div class="col m12 s12" id="remove-row">
						<button id="btn-more" data-id="<?php if(isset($t->id)): ?> <?php echo e($t->id); ?> <?php else: ?> <?php echo e('1'); ?> <?php endif; ?>" class="btn-flat waves-effect brd2 center-align __js-tasks-more" >показать еще</button>
					</div>
				</div>
			</div>
		</div>
		<?php if(Agent::isDesktop()): ?>
		<div class="col m4 s12 l4 --general-t">
			<div class="sidebar">
				<?php if(auth()->guard()->guest()): ?>
				<div class="--group OrzuPromoHead">
					<h6 class="nomargin--t"><a href="/login?utm_campaign=OrzuPromoHead attention">Зарегистрируйтесь или войдите</a>, чтобы выполнять заказы</h6>
				</div>
				<?php endif; ?>
				<div class="--group --srch">
					<div class="row nomargin">
						<div class="TaskFilterSearch">
							<input placeholder="Что вы хотите найти?" id="__js-filter-search" type="text" name="find" class="nomargin TaskFilterSearchInput" value="<?php echo e(request("find")); ?>">

							<button type="submit" class="TaskFilterSearchButton material-icons" id="btn-search">search</button>
						</div>
					</div>
					<div class="row nomargin --srchCH">
						<div class="--group">
							<label>
								<input type="checkbox" name="offers" value="yes" class="filled-in check" id="__js-filter-offers" <?php if(request('offers')!=''): ?> <?php echo e('checked'); ?> <?php endif; ?>/>
								<span>Без предложений</span>
							</label>
						</div>
						<div class="--group">
							<label>
								<input type="checkbox" name="bs" value="yes" class="filled-in check" id="__js-filter-bs" <?php if(request('bs')!=''): ?> <?php echo e('checked'); ?> <?php endif; ?>/>
								<span>Безопасная сделка</span>
							</label>
						</div>
						<div class="--group">
							<label>
								<input type="checkbox" name="beside" value="yes" class="filled-in check" id="__js-filter-beside" <?php if(request('beside')!=''): ?> <?php echo e('checked'); ?> <?php endif; ?>/>
								<span>Рядом (<?php echo e(Config::get('app.city')); ?>)</span>
							</label>
						</div>
					</div>
				</div>

				<div class="divider"></div>

				<div class="--group __js-filter-category">
					<div class="__js-filter-category-title">
						<h6 class="nomargin--t"><a href="#" class="link2" id="ShowCat">Категории</a></h6>
					</div>
					<ul class="nomargin--t" id="ThisIsCatsList">
						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="__js-filter-category-item">
							<div class="__js-filter-category-item--h">
								<div class="__js-filter-category-subarrow">
									<i class="material-icons">expand_more</i>
								</div>
								<?php 
								$c = 'no';
								$cats = explode(',',request('cat'));
								for($i=0; $i<=count($cats)-1; $i++){
									if($cat->id==$cats[$i]){
										$c = 'yes';
									}
								}
								?>
								<label class="__js-filter-category-label checkbox"><input type="checkbox" class="filled-in check" name="cat" data-id="itm<?php echo e($cat->id); ?>" data-name="item" <?php if($c=='yes'): ?> <?php echo e('checked'); ?> <?php endif; ?> value="<?php echo e($cat->id); ?>"/> <span><?php echo e($cat->name); ?></span></label>
							</div>
							<ul>
								<?php $__currentLoopData = $cat->sub_cat_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php 
								$sc = 'no';
								for($i=0; $i<=count($cats)-1; $i++){
									if($subcat->id==$cats[$i]){
										$sc = 'yes';
									}
								}
								?>
								<li>
									<div class="__js-filter-category-item--h">
										<label class="checkbox"><input type="checkbox" class="filled-in check" name="cat" data-id="itm<?php echo e($subcat->id); ?>" value="<?php echo e($subcat->id); ?>"  <?php if($sc=='yes'): ?> <?php echo e('checked'); ?> <?php endif; ?> data-name="<?php echo e($subcat->name); ?>" /> <span><?php echo e($subcat->name); ?></span></label>
									</div>
								</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php if(Agent::isMobile()): ?>
<div id="modal1" class="modal bottom-sheet">
	<div class="modal-content">
		<h6>Выберите категории услуг</h6>
			<ul class="nomargin--t">
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li class="__js-filter-category-item">
					<div class="__js-filter-category-item--h">
						<div class="__js-filter-category-subarrow">
							<i class="material-icons">expand_more</i>
						</div>
						<?php 
						$c = 'no';
						$cats = explode(',',request('cat'));
						for($i=0; $i<=count($cats)-1; $i++){
							if($cat->id==$cats[$i]){
								$c = 'yes';
							}
						}
						?>
						<label><input type="checkbox" class="filled-in check" name="cat" data-id="itm<?php echo e($cat->id); ?>" data-name="item" <?php if($c=='yes'): ?> <?php echo e('checked'); ?> <?php endif; ?> value="<?php echo e($cat->id); ?>"/> <span><?php echo e($cat->name); ?></span></label>
					</div>
					<ul>
						<?php $__currentLoopData = $cat->sub_cat_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
						$sc = 'no';
						for($i=0; $i<=count($cats)-1; $i++){
							if($subcat->id==$cats[$i]){
								$sc = 'yes';
							}
						}
						?>
						<li>
							<div class="__js-filter-category-item--h">
								<label><input type="checkbox" class="filled-in check" name="cat" data-id="itm<?php echo e($subcat->id); ?>" value="<?php echo e($subcat->id); ?>"  <?php if($sc=='yes'): ?> <?php echo e('checked'); ?> <?php endif; ?> data-name="<?php echo e($subcat->name); ?>" /> <span><?php echo e($subcat->name); ?></span></label>
							</div>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Показать</a>
	</div>
</div>
<?php endif; ?>

<?php echo $__env->make('parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footlink'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/ch.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/tasks.js?47')); ?>"></script>
<script>
	$(document).ready(function(){



		$('.modal').modal();
		$(document).on('click','#btn-more',function(){
			var id = $(this).data('id');
			var find = '<?php echo e(request("find")); ?>';
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$.ajax({
				url : '<?php echo e(route('taskajax')); ?>',
				method : "POST",
				data : {id:id, find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"<?php echo e(csrf_token()); ?>"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		}); 
		$(document).on('change','#btn-status',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '<?php echo e(route('taskajaxfilter')); ?>',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"<?php echo e(csrf_token()); ?>"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('click','#btn-search',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '<?php echo e(route('taskajaxfilter')); ?>',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"<?php echo e(csrf_token()); ?>"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('click','.__js-filter-sortby-time',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '<?php echo e(route('taskajaxfilter')); ?>',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"<?php echo e(csrf_token()); ?>"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('click','.__js-filter-sortby-date',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '<?php echo e(route('taskajaxfilter')); ?>',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"<?php echo e(csrf_token()); ?>"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
		$(document).on('change','.check',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
				offers.push($(this).val());
			});
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
				bs.push($(this).val());
			});
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
				beside.push($(this).val());
			});
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
				cat.push($(this).val());
			});
			$("#btn-more").html("Загрузка....");
			$('div.infinite-scroll').remove();
			$.ajax({
				url : '<?php echo e(route('taskajaxfilter')); ?>',
				method : "POST",
				data : {find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"<?php echo e(csrf_token()); ?>"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").html("Больше нет заданий");
					}
				}
			});
		});
	});
	//Tasks suggestion
	var input = document.getElementById('__js-filter-search');
	var awesomplete = new Awesomplete(input, {
		minChars: 1
	});
	$("#__js-filter-search").on("keyup", function(){
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
window.onload = function() {
																// autoload Created 03.12.19
if(window.location.href.match(/\d+$/gm)){
	// $('input[name="cat"]').eq(window.location.href.match(/\d+$/gm)-1).removeAttr('checked').click()
	$('input[data-id="itm'+ window.location.href.match(/\d+$/gm)-1 +'"]').removeAttr('checked').click();
}
															//End of autoload	

const placeholders = [
    'Давайте поищем',
    'Просто начните печатать',
    'У Вас все получится'
]


let addToPlaceholder = new Placeholder(placeholders,'#__js-filter-search');
addToPlaceholder.adding();

let clickableBlock = new GetAddress('#load-data','card','card-title', 'stop');
clickableBlock.listen();

}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/tasks/alltasks.blade.php ENDPATH**/ ?>