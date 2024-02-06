<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('認証メールを送信しました。')); ?></div>

                <div class="card-body">
                    <?php if(session('resent')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                    </div>
                    <?php endif; ?>

                    <?php echo e(__('送信メール内のリンクから認証を行ってください。')); ?>

                    <?php echo e(__('もしもメールが届いていない場合は')); ?>

                    <form class="d-inline" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><?php echo e(__('こちらをクリック')); ?></button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/verify.blade.php ENDPATH**/ ?>