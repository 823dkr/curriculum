
<?php $__env->startSection('content'); ?>
<div class='panel-body'>
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($message); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
</div>
<div class="text-center" style="padding:50px 0">
    <div class="logo">カテゴリ追加</div>
    <form action='/types' method=post id="login-form" class="text-left">
        <?php echo csrf_field(); ?>
        <div class="login-form-main-message"></div>
        <div class="main-login-form">
            <div class="login-group">
                <div class="form-group">
                    <label for="lg_type" class="sr-only">カテゴリ名</label>
                    <input type="text" class="form-control" id="lg_type" name="name" placeholder="カテゴリ名">
                </div>
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/type/create_type.blade.php ENDPATH**/ ?>