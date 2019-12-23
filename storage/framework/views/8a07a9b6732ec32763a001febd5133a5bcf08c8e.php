
<?php $__env->startSection('content_head'); ?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Категория: ключи</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item">Настройка контента</li>
            <li class="breadcrumb-item active">Категория: ключи</li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Категория: ключи</h4>
	            <button data-toggle="modal" data-target=".filtr" class="btn btn-success pull-right">Фильтр</button>
	            <button data-toggle="modal" data-target=".add" class="btn btn-info pull-right" style="margin-right: 5px;">Добавить</button>	            
	            <br />
	            <br />
	            <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Добавить язык</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                            	<form method="post" id="add" action="<?php echo e(route('eziocmscategorykeyadd')); ?>">
                            		<?php echo csrf_field(); ?>
	                                <div class="form-group">
	                                    <label class="control-label">Ключ</label>
	                                    <input type="text" name="key" class="form-control">
	                                </div>
	                                <div class="form-group">
	                                    <label class="control-label">Язык</label>
	                                    <select name="cat_id" class="form-control">
	                                    	<?php $__empty_1 = true; $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                                    	<option value="<?php echo e($l->id); ?>"><?php echo e($l->name); ?></option>
	                                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	                                    	<option value="">Язык не добавлен</option>	                                    	
	                                    	<?php endif; ?>
	                                    </select>
	                                </div>
	                                <div class="form-group">
	                                    <label class="control-label">Язык</label>
	                                    <select name="lang" class="form-control">
	                                    	<?php $__empty_1 = true; $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                                    	<option value="<?php echo e($l->param); ?>"><?php echo e($l->lang); ?></option>
	                                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	                                    	<option value="">Язык не добавлен</option>	                                    	
	                                    	<?php endif; ?>
	                                    </select>
	                                </div>
	                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal" onclick="document.getElementById('add').submit();">Добавить</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
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
	                            <th>Ключ</th>	
	                            <th>Категория</th>
	                            <th>Язык</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                        <tr>
	                            <td><?php echo e($cat->id); ?></td>
	                            <td><?php echo e($cat->key); ?></td>
	                            <td><?php echo e($cat->cat_name); ?></td>
	                            <td><?php echo e($cat->lang); ?></td>
	                            <td><a href="<?php echo e(route('eziocmscategorykeyupdate', $cat->id)); ?>" class="label label-info">Изменить</a> <a href="<?php echo e(route('eziocmscategorykeyadelete',$cat->id)); ?>" class="label label-danger">Удалить</a></td>
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
	                <?php echo e($categories->links()); ?>

	            </div>
	        </div>
	    </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eziocms.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/eziocms/content/category_key.blade.php ENDPATH**/ ?>