
<?php $__env->startSection('content_head'); ?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Контент</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item">Настройка контента</li>
            <li class="breadcrumb-item active">Контент</li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Контент</h4>
	            <button data-toggle="modal" data-target=".filtr" class="btn btn-success pull-right">Фильтр</button>            
	            <br />
	            <br />
                <div class="modal fade filtr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Добавить язык</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                            	<form method="" id="filtr">
	                                <div class="form-group">
	                                    <label class="control-label">Найти</label>
	                                    <input type="text" name="find" class="form-control">
	                                </div>
	                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal" onclick="document.getElementById('filtr').submit();">Искать</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
	            <div class="table-responsive">
	                <table class="table color-table inverse-table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Статус</th>
	                            <th>Задач</th>
	                            <th>Заказчик</th>
	                            <th>Номер телефона</th>
	                            <th>Дата создания</th>
	                            <th>Дата изменения</th>
	                            <th>Бюджет</th>
	                            <th>Дата создания</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                        <tr>
	                            <td><?php echo e($t->id); ?></td>
	                            <td><?php echo $t->real_status; ?></td>
	                            <td><a href=""><?php echo e($t->task); ?></a></td>
	                            <td><?php echo e($t->user_name); ?></td>
	                            <td><?php echo e($t->user_phone); ?></td>
	                            <td><?php echo e(date('d.m.Y H:i', strtotime($t->created_at))); ?></td>
	                            <td><?php echo e(date('d.m.Y H:i', strtotime($t->updated_at))); ?></td>
	                            <td><?php echo e($t->bujet); ?></td>
	                            <td><a href="" class="label label-info">Изменить</a> <a href="" class="label label-danger">Удалить</a></td>
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
	                <?php echo e($tasks->links()); ?>

	            </div>
	        </div>
	    </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eziocms.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/eziocms/tasks/alltask.blade.php ENDPATH**/ ?>