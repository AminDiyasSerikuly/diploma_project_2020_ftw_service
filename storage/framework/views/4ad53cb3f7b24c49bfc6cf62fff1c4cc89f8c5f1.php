
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
	            <div class="table-responsive">
	            	<?php $__currentLoopData = $catkey; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ck): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <form method="post" action="<?php echo e(route('eziocmscategorykeyupdated')); ?>">
                		<?php echo csrf_field(); ?>		
                        <div class="form-group">
                            <label class="control-label">Ключ</label>
                            <input type="text" name="key" class="form-control" value="<?php echo e($ck->key); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Язык</label>
                            <select name="cat_id" class="form-control">
                            	<?php $__empty_1 = true; $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            	<?php if($l->id==$ck->cat_id): ?>
                            	<option value="<?php echo e($l->id); ?>" selected="selected"><?php echo e($l->name); ?></option>
                            	<?php else: ?>
                            	<option value="<?php echo e($l->id); ?>" selected="selected"><?php echo e($l->name); ?></option>
                            	<?php endif; ?>
                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            	<option value="">Язык не добавлен</option>	                                    	
                            	<?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Язык</label>
                            <select name="lang" class="form-control">
                            	<?php $__empty_1 = true; $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            	<?php if($l->lang==$ck->lang): ?>
                            	<option value="<?php echo e($l->param); ?>" selected="selected"><?php echo e($l->lang); ?></option>
                            	<?php else: ?>
                            	<option value="<?php echo e($l->param); ?>"><?php echo e($l->lang); ?></option>
                            	<?php endif; ?>
                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            	<option value="">Язык не добавлен</option>	                                    	
                            	<?php endif; ?>
                            </select>
                        </div>
                    </form>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eziocms.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/u0668441/data/www/orzu.org/resources/views/eziocms/content/category_key_update.blade.php ENDPATH**/ ?>