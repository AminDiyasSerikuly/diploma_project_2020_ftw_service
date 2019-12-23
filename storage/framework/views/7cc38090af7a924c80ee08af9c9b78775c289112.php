
<?php $__env->startSection('content_head'); ?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Логы: API</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item">Логы</li>
            <li class="breadcrumb-item active">Логы: API</li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Логы: API</h4>
	            <a href="<?php echo e(route('eziocmsclearapilog')); ?>" class="brn brn-warning">Отчистить логи</a>	            
	            <div class="table-responsive">
	                <table class="table color-table inverse-table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Лог</th>	
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $__empty_1 = true; $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                        <tr>
	                            <td><?php echo e($l->id); ?></td>
	                            <td><?php echo e($l->log); ?></td>
	                        </tr>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	                        <tr>
	                            <td></td>
	                            <td>Нет данных!</td>
	                            <td></td>
	                        </tr>
	                        <?php endif; ?>
	                    </tbody>
	                </table>
	                <?php echo e($log->links()); ?>

	            </div>
	        </div>
	    </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eziocms.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/eziocms/logs/apilog.blade.php ENDPATH**/ ?>