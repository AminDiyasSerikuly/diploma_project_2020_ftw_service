
<?php $__env->startSection('content_head'); ?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Пользователи</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item active">Пользователи</li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Пользователи</h4>
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
	                            <th>Ф.И.О</th>
	                            <th>Номер телефон</th>
	                            <th>Email</th>
	                            <th>Роль</th>
	                            <th>Дата регистрации</th>
	                            <th>Дата последный авторизации</th>
	                            <th>Номер подтверждён</th>
	                            <th>Количество созданных задач</th>
	                            <th>Количество выполненых из созданных задач</th>
	                            <th>Счёт</th>
	                            <th>Сумма активных заказов</th>
	                            <th>Сумма всех заказов</th>
	                            <th>Остаток на счёте</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                        <tr>
	                            <td><?php echo e($u->id); ?></td>
	                            <td><a href="<?php echo e(route('eziocmsprofile', $u->id)); ?>"><?php echo e($u->fio); ?></a></td>
	                            <td><?php echo e($u->phone); ?></td>
	                            <td><?php echo e($u->uemail); ?></td>
	                            <td><?php echo e($u->role); ?></td>
	                            <td><?php echo e($u->cdate); ?></td>
	                            <td><?php echo e($u->udate); ?></td>
	                            <td><?php echo e($u->phone_access); ?></td>
	                            <td><?php echo e($u->task_count); ?></td>
	                            <td><?php echo e($u->done_task_count); ?></td>
	                            <td><?php echo e($u->user_account); ?></td>
	                            <td><?php echo e(number_format($u->active_task__amount,2,',',' ')); ?></td>
	                            <td><?php echo e(number_format($u->all_task__amount,2,',',' ')); ?></td>
	                            <td><?php echo e(number_format($u->user_account_money,2,',',' ')); ?></td>
	                            <td><a href="" class="badge badge-warning">Заблакировать</a></td>
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
	                <?php echo e($users->links()); ?>

	            </div>
	        </div>
	    </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eziocms.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/eziocms/users/users.blade.php ENDPATH**/ ?>