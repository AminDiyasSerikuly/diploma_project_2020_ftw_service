<?php $__env->startSection('title'); ?>
<title>Пополнение баланса</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headlink'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.css?44')); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/profile.balance.css?2')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container --general --g-payments">
	<div class="row">
		<div class="col m8 --general-t">
			<div class="main">
				<div class="row">
					<div class="col m12">
						<!--details-->
						<div class="white boxsh brd2 --general-t-detail">
							<div class="--header">
								Пополнение баланса
								<!--preloader-->
								<div class="--preloader hide">
									<div class="progress">
										<div class="indeterminate"></div>
									</div>
								</div>
								<!--/preloader-->
							</div>
							<div class="--tabs">
								<ul class="tabs tabs-fixed-width">
									<li class="tab"><a class="active" href="#payments">Онлайн пополнение</a></li>
									<li class="tab"><a href="#terminals">Терминалы оплаты</a></li>
									<li class="tab"><a class="orange-text" href="#history">История баланса</a></li>
								</ul>
							</div>

							<div class="--payments" id="payments">
								<ul class="collapsible">
									<li>
										<div class="collapsible-header">
											<i class="__card __sc"></i>
											VISA, MasterCard, МИР <span> — без комиссии (0%)</span>
										</div>
										<div class="collapsible-body">
											Для пополнения перейдите <a href="#" class="link3">по данной ссылке</a>
										</div>
									</li>

									<li>
										<div class="collapsible-header">
											<i class="__qiwi"></i>
											QIWI кошелек <span> — без комиссии (0%)</span>
										</div>
										<div class="collapsible-body">
											Для пополнения перейдите <a href="#" class="link3">по данной ссылке</a>
										</div>
									</li>

									<li>
										<div class="collapsible-header">
											<i class="__yandex"></i>
											Яндекс.Деньги <span> — без комиссии (0%)</span>
										</div>
										<div class="collapsible-body">
											Для пополнения перейдите <a href="#" class="link3">по данной ссылке</a>
										</div>
									</li>

									<li>
										<div class="collapsible-header">
											<i class="__webmoney"></i>
											Webmoney <span> — доступно только WMZ</span>
										</div>
										<div class="collapsible-body">
											Для пополнения перейдите <a href="#" class="link3">по данной ссылке</a>
										</div>
									</li>

									<li>
										<div class="collapsible-header">
											<i class="__robokassa __sc"></i>
											Robokassa <span> — все услуги Robokassa</span>
										</div>
										<div class="collapsible-body">
											Для пополнения перейдите <a href="#" class="link3">по данной ссылке</a>
										</div>
									</li>

									<li>
										<div class="collapsible-header">
											<i class="__samsungpay __sc"></i>
											Samsung Pay <span> — без комиссии (0%)</span>
										</div>
										<div class="collapsible-body">
											Для пополнения через Samsung Pay скачайте мобильное <a href="#" class="link3">приложение для Android</a>
										</div>
									</li>

									<li>
										<div class="collapsible-header">
											<i class="__applepay __sc"></i>
											Apple Pay <span> — без комиссии (0%)</span>
										</div>
										<div class="collapsible-body">
											Для пополнения через Apple Pay скачайте мобильное <a href="#" class="link3">приложение для iOS</a>
										</div>
									</li>

									<li>
										<div class="collapsible-header">
											<i class="__paypal"></i>
											Paypal <span> — без комиссии (0%)</span>
										</div>
										<div class="collapsible-body">
											Для пополнения перейдите <a href="#" class="link3">по данной ссылке</a>
										</div>
									</li>
								</ul>
							</div>

							<div class="--payments" id="terminals">
								В данный момент оплата в платежных терминалах недоступна в Вашем регионе.
							</div>

							<div class="--history" id="history">
								<?php if(App\Profile::getAccountCheckTransactions(Auth::user()->id)>0): ?>
								<table>
									<tr>
										<td>#</td>
										<td>Дата</td>
										<td>Сумма</td>
										<td>Адрес</td>
									</tr>
								<?php 
									$i=1;
								?>
								<?php $__currentLoopData = App\Profile::getAccountTrasactions(Auth::user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($i++); ?></td>
									<td><?php echo e(date('d.m.Y H:i', strtotime($t->datain))); ?> </td>
									<td><?php echo e($t->amount); ?> сом.</td>
									<td><?php echo e($t->narrative); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</table>
								<?php else: ?>
								У вас нет истории платежей.
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
<script type="text/javascript" src="<?php echo e(asset('js/profile.balance.js?45')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/myprofile/balance.blade.php ENDPATH**/ ?>