<?php $__env->startSection('title'); ?>
<title>Создайте задание</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link href="https://fonts.googleapis.com/css?family=Exo+2:500&display=swap&subset=cyrillic" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/creat.css?100')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/header-normalize.css')); ?>"  media="screen,projection"/>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=0e4ed3dd-4213-4ea2-98ce-23257fe20028" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<script id="hider">
		document.querySelector('body').style.display='none';
		document.querySelector('body').style.opacity=0;
		document.querySelector('body').style.transition="opacity .5s";
	</script>

<div class="container __dbjs OrzuRibbonContainer">
	<div class="row">
		<div class="col m12 s12 _c-header">
			<h5 class="black-text mrg1b">Новый заказ</h5>
			<?php if(Agent::isDesktop()): ?>
			<div class="white-text fnt13 mrg1b hide">
				Опишите задачу, сравните предложения и выберите исполнителя.
			</div>
			<?php endif; ?>
		</div>
		<div class="col m8 s12">
			<div class="_c-container white brd2">
				<div class="row nomargin--b">
					<form method="post" action="<?php echo e(route('newadd')); ?>" class="col m12 _c-form" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						<?php if(Agent::isMobile()): ?>
						<input type="hidden" name="mtoken" value="<?php echo e(request()->token); ?>">
						<?php endif; ?>
						<div class="row nomargin--b">
							<div class="input-field col m12 s12 nomargin--t">
								<span class="_LabelInput">Что нужно сделать</span>
								<input name="task" autocomplete="off" placeholder="Напишите коротко, чем вам помочь" id="whtd" type="text" value="<?php if(app('request')->input('task')!=''): ?><?php echo e(app('request')->input('task')); ?><?php else: ?><?php echo e(old('task')); ?><?php endif; ?>" required>
							</div>
						</div>
						<div class="row nomargin--b">
							<div class="input-field col m6 s12">
								<span class="_LabelInput">Категория</span>
								<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value + '?task=' + document.getElementById('whtd').value + '&narrative=' + document.getElementById('whtdt').value+'<?php if(Agent::isMobile()): ?> <?php echo '&token='.request()->token; ?><?php endif; ?>');">
									<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(substr($category->param_c,0,strpos($category->param_c,'/'))==Request::segment(3)): ?>                                    
									<option value="<?php echo e(route('hometask').'/'.$category->param_c); ?>" selected="selected"><?php echo e($category->name); ?></option>
									<?php else: ?>
									<option value="<?php echo e(route('hometask').'/'.$category->param_c); ?>"><?php echo e($category->name); ?></option>
									<?php endif; ?>                                                            
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
							<div class="input-field col m6 s12">
								<span class="_LabelInput">Специальность</span>
								<select name="cat_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value + '?task=' + document.getElementById('whtd').value + '&narrative=' + document.getElementById('whtdt').value+'<?php if(Agent::isMobile()): ?><?php echo '&token='.request()->token; ?><?php endif; ?>');">
									<?php $__currentLoopData = App\Category::getSubCatParam(Request::segment(3)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($subcat->param==Request::segment(3).'/'.Request::segment(4)): ?>                                    
									<option value="<?php echo e(route('hometask').'/'.$subcat->param); ?>" selected="selected"><?php echo e($subcat->name); ?></option>
									<?php else: ?>
									<option value="<?php echo e(route('hometask').'/'.$subcat->param); ?>"><?php echo e($subcat->name); ?></option>
									<?php endif; ?>                                                            
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>                              
						</div>
						<div class="row nomargin--b">
							<div class="input-field col m12 s12 nomargin--b">
								<span class="_LabelInput">Описание и пожелания</span>
								<textarea name="narrative" id="whtdt" class="materialize-textarea" placeholder="Расскажите подробнее о задаче" required="required"><?php if(app('request')->input('narrative')!=''): ?><?php echo e(app('request')->input('narrative')); ?><?php else: ?><?php echo e(old('narrative')); ?><?php endif; ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col m12 s12 files-upload">
								<span class="_LabelInput">Добавить фото</span>
								<a href="" id="upload_link">
									


									<div class="plus-wrap">
										<div class="ver"></div>
										<div class="hor"></div>
									</div>


								</a>​
								<input type="file" name="files[]" id="upload" accept="image/*" multiple/>
							</div>
						</div>

						<div class="row nomargin--b">
							<div class="col m12 s12">
								<div class="_c-form-title">Сроки</div>
								<div class="radio-group _mar1">
									<div class="selection">
										<input id="dateDt_radio" name="date_radio" type="radio" value="7">
										<label for="dateDt_radio">Точная дата</label>
									</div>
									<div class="selection">
										<input id="dateSp_radio" name="date_radio" type="radio" value="6">
										<label for="dateSp_radio">Указать период</label>
									</div>
									<div class="selection">
										<input id="dateMs_radio" name="date_radio" type="radio" value="5">
										<label for="dateMs_radio">Договорюсь с исполнителем</label>
									</div>
								</div>
							</div>
							<div class="input-field col m12 s12 nomargin--t radio_group0" id="radio_group5">
								Дату выполнения задачи обсудите с выбранным исполнителем.
							</div>
							<div class="radio_group0" id="radio_group6">
								<div class="input-field col m3 s12">
									<input name="cdate" type="text" id="wdate2" autocomplete="off" class="_c-form-date" placeholder="С" value="<?php echo e(old('cdate')); ?>"/>
									<label for="wdate2">Когда начать?</label>
								</div>
								<div class="input-field col m3 s12">
									<input name="edate" type="text" id="wdate3" autocomplete="off" class="_c-form-date" placeholder="ПО" value="<?php echo e(old('edate')); ?>"/>
									<label for="wdate3">Когда закончить?</label>
								</div>
							</div>
							<div class="radio_group0" id="radio_group7">
								<div class="input-field col m4 s12">
									<input name="cdate_l" type="text" id="wdate" autocomplete="off" class="_c-form-date" placeholder="Когда вам нужно?" value="<?php echo e(old('cdate_l')); ?>"/>
									<label for="wdate">Выберите дату</label>
									<div class="_c-form-wdate-helper">
										<span><a href="#" class="_c-form-wdate-helper-link" data-wdate="<?php echo e(date('d.m.Y')); ?>">сегодня</a></span>, 
										<span><a href="#" class="_c-form-wdate-helper-link" data-wdate="<?php echo e(date('d.m.Y', strtotime('+1 days'))); ?>">завтра</a></span>, 
										<span><a href="#" class="_c-form-wdate-helper-link" data-wdate="<?php echo e(date('d.m.Y', strtotime('+2 days'))); ?>">послезавтра</a></span>
									</div>
								</div>
								<div class="input-field col m4 s12">
									<select name="level_l">
										<option value="1" selected="selected"><?php echo e(App\Lang::getTrans('every_time', Config::get('app.locale'))); ?></option>
										<option value="2"><?php echo e(App\Lang::getTrans('to_12', Config::get('app.locale'))); ?></option>
										<option value="3"><?php echo e(App\Lang::getTrans('from_12_to_17', Config::get('app.locale'))); ?></option>
										<option value="4"><?php echo e(App\Lang::getTrans('from_17_to_22', Config::get('app.locale'))); ?></option>
										<option value="5"><?php echo e(App\Lang::getTrans('after_22', Config::get('app.locale'))); ?></option>
									</select>
									<label>В какое время?</label>
								</div>

							</div>
						</div>

						<div class="row nomargin--b">
							<div class="col m12 s12">
								<div class="_c-form-title">Место</div>
								<div class="radio-group _mar1">
									<div class="selection">
										<input id="location_radio" name="location" type="radio" value="1" autocomplete="off">
										<label for="location_radio">Указать место</label>
									</div>
									<div class="selection">
										<input id="remoteloc_radio" name="location" type="radio" value="2">
										<label for="remoteloc_radio">Удаленно</label>
									</div>
								</div>
							</div>
							<div class="input-field col m12 s12 radio_group1" id="radio_group1">
								<span class="_LabelInput">Город, район или точный адрес</span>

								<input type="text" value="<?php echo e(old('address')); ?>" name="address" id="location" autocomplete="off" placeholder="Адрес">

							</div>
							<div class="input-field col m12 s12 nomargin--t radio_group1" id="radio_group2">
								Встреча не нужна, исполнитель выполнит заказ там, где ему  удобнее. Для исполнителей из любых городов.
							</div>
						</div>

						<div class="row">
							<div class="col m12 s12">
								<div class="_c-form-title">Стоимость</div>
								<div class="radio-group _mar1">
									<div class="selection">
										<input id="mysum_radio" name="current_radio" type="radio" value="3">
										<label for="mysum_radio">Указать цену самому</label>
									</div>
									<div class="selection">
										<input id="lncsumm_radio" name="current_radio" type="radio" value="4">
										<label for="lncsumm_radio">Исполнитель предложит цену</label>
									</div>
								</div>
							</div>
							<div class="col m12 s8 radio_group2" id="radio_group3">
								<div class="input-field col m3 nopadding _c-form-ammount">
									<span class="--2sum">до</span>
									<span class="--inp"><input type="text" name="val" id="amountCorrect" style="text-align: right; padding-right: 5px; width: calc(100% - 5px);" maxlength="10" autocomplete="off"/></span>
									<span class="--curr">
										<?php if(auth()->guard()->check()): ?>
											<?php if(App\Profile::getUserParam('user_current')!=''): ?>
												<?php echo e(App\Profile::getUserParam('user_current')); ?>

											<?php else: ?>
												Валюта не задана
											<?php endif; ?>
										<?php else: ?>
											тенге
										<?php endif; ?>
									</span>
								</div>
							</div>
							<div class="input-field col m12 s12 nomargin--t radio_group2" id="radio_group4">
								Исполнитель предложит цену сам.
							</div>
						</div>

						<div class="row hide">
							<div class="col m6 s12 margin-t1b1">
								<label class="_c-form-checkbox-email">
									<label>
										<input type="checkbox" class="filled-in" name="email" value="yes" checked/>
										<span>E-mail уведомления <i class="material-icons tooltipped" data-position="right" data-tooltip="Уведомлять об откликах по электронной почте">help</i></span>
									</label>
								</label>
							</div>
						</div>
						<?php if(auth()->guard()->guest()): ?>

								<script>
									window.location='/login';
								</script>









						<?php endif; ?>
						<div class="divider --theend"></div>
						<div class="row nomargin--b">
							<div class="col m12 s12 OrzuAdditionBlock">
								
								<button class="home__btn-category" type="submit">Опубликовать задание</button>
								<span class="OrzuBlockGridInlineSystems">Опубликовывая, вы соглашаетесь <a href="#" class="link2">с условиями сервиса</a>.</span>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
		<?php if(Agent::isDesktop()): ?>
		<div class="col m4">
			<div class="collection sml brd4 boxsh nomargin">
				<a  href="javascript:Intercom('show');" target="_blank" class="collection-item blue-text">
					Написать в поддержку <i class="material-icons">link</i>
				</a>
				<!--links-->
				<a href="#m32" class="collection-item orange-text modal-trigger" target="_blank">
					Как это работает? <i class="material-icons">help</i>
				</a>
				<!--/links-->
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<div id="m32" class="modal">
	<div class="modal-content">
		<h5 class="nomargin--t">Как это работает</h5>
		<p>1. Опишите, какую задачу вам нужно выполнить, и опубликуйте заказ. Чем подробнее описание, тем легче будет найти подходящих исполнителей.</p>
		<p>2. Исполнители могут соглашаться с вашими условиями или предложить свои.</p>
		<p>3. Если вы выбрали кого-то и договорились об услуге, нажмите кнопку «Завершить заказ».</p>
		<p>4. Ваш город - город выбираете в настройках вашего кабинета.</p>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Понятно</a>
	</div>
</div>

<?php echo $__env->make('parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footlink'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/phoneinpt.js?33')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/creat.js?55')); ?>"></script>
<script id="lastRemove">
	document.querySelector('#hider').remove();
	document.querySelector('body').style.display='block';
	document.querySelector('body').style.opacity=1;
	document.querySelector('#lastRemove').remove();
</script>
<script>
	//Tasks suggestion

	var input = document.getElementById('whtd');
	var awesomplete = new Awesomplete(input, {
		minChars: 1
	});
	$("#whtd").on("keyup", function(){
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
	ymaps.ready(init);
	function init() {
		var suggestView1 = new ymaps.SuggestView('location');
	}

	window.onload=function(){
	function attributes(el) {
		$(el).attr('value',$(el).val());
	}

	$('#location').on('keyup',function(){
		attributes('#location');
	})

	$('ymaps').on('click',function(){
		attributes('#location');
	})
	}







	let filesUpload = $('.files-upload');
$('#upload').on('change',function(e){
	$('.added-file').remove();
  /* console.log($(this)[0].files) */
  let currentChangedEl = $(this)[0];
  let toAddFilesNames='';
  for(let i=0;i<currentChangedEl.files.length;i++){
		if(currentChangedEl.files[i].name != undefined){
    	console.log(currentChangedEl.files[i].name + ' name' + toAddFilesNames.length)
      if(toAddFilesNames.length<=0){
      	toAddFilesNames += currentChangedEl.files[i].name;
      } else {
  			toAddFilesNames += ', ' + currentChangedEl.files[i].name;
      }
    }
  }
  filesUpload.after(`<span class="added-file"> ${ toAddFilesNames } </span>`);
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/tasks/tasks.blade.php ENDPATH**/ ?>