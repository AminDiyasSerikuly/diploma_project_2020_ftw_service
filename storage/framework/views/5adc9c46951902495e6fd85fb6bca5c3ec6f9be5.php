
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
<!-- Column -->
<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="<?php echo e(asset('assets/images/users/5.jpg')); ?>" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10"><?php echo e($u->fname.' '.$u->name.' '.$u->sname); ?></h4>
                    <h6 class="card-subtitle"><?php echo e($u->role); ?></h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-chart"></i> <font class="font-medium"><?php echo e($u->task_count); ?></font></a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-chart"></i> <font class="font-medium"><?php echo e($u->task_count); ?></font></a></div>
                    </div>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> 
                <?php if($u->role!='1'): ?> <a href="" class="btn btn-sm btn-info">Сделать администратором</a> <?php else: ?> <a href="" class="btn btn-sm btn-info">Снять с администратора</a> <?php endif; ?>
                <a href="" class="btn btn-sm btn-warning">Заблокировать</a>
                <a href="" class="btn btn-sm btn-danger">Удалить</a><br /><br />
                <small class="text-muted">Счёт </small>
                <h6><?php echo e($u->user_account); ?></h6> 
                <small class="text-muted">Email address </small>
                <h6><?php echo e($u->uemail); ?></h6> 
                <small class="text-muted p-t-30 db">Phone</small>
                <h6><?php echo e($u->phone); ?></h6> 
                <small class="text-muted p-t-30 db">Address</small>
                <h6><?php echo e($u->address); ?></h6>
                 <small class="text-muted p-t-30 db">Social Profile</small>
                <br/>
                <?php if(App\Profile::getUserParam('user_fb')!=''): ?><a href="<?php echo e(App\Profile::getUserParam('user_fb')); ?>" class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></a><?php endif; ?>
                <?php if(App\Profile::getUserParam('user_vk')!=''): ?><a href="<?php echo e(App\Profile::getUserParam('user_vk')); ?>" class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></a><?php endif; ?>
                <?php if(App\Profile::getUserParam('user_instagram')!=''): ?><a href="<?php echo e(App\Profile::getUserParam('user_instagram')); ?>" class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></a><?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Задачи</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#dop" role="tab">Доп. инфо</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#transactions" role="tab">Транзакции</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-table inverse-table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Названия</th>
                                        <th>Статус</th>
                                        <th>Исполнитель</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(++$i); ?></td>
                                        <td><?php echo e($t->task); ?></td>
                                        <td><?php if($t->status=='0'): ?> <label class="badge badge-success">Открытый</label> <?php else: ?> <label class="badge badge-danger">Закрытый</label> <?php endif; ?></td>
                                        <td><?php echo e($t->status); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Нет данных!</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php echo e($tasks->links()); ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="dop" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-table inverse-table table-striped">
                                <thead>
                                    <tr>
                                        <th>Параметр</th>
                                        <th>Значения</th>
                                    </tr>
                                </thead >
                                <tbody>
                                    <?php $i=0; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $userparam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($u->meta_param); ?></td>
                                        <td><?php echo e($u->meta_value); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="2" class="text-center">Нет данных!</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php echo e($tasks->links()); ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="transactions" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-table inverse-table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Дата</th>
                                        <th>Сумма</th>
                                        <th>Назначения</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(++   $i); ?></td>
                                        <td><?php echo e($t->task); ?></td>
                                        <td><?php if($t->status=='0'): ?> <label class="badge badge-success">Открытый</label> <?php else: ?> <label class="badge badge-danger">Закрытый</label> <?php endif; ?></td>
                                        <td><?php echo e($t->status); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Нет данных!</td>
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
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eziocms.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/eziocms/users/userprofile.blade.php ENDPATH**/ ?>