<?php $__env->startSection('content'); ?>
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(isset($authgroup) ? "管理専用  " : ""); ?><?php echo e(__('ログイン')); ?></div>

                <div class="card-body">
                    <?php if(isset($authgroup)): ?>
                    <form method="POST" action="<?php echo e(url('login/admin')); ?>">
                        <?php else: ?>
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php endif; ?>
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('メールアドレス')); ?></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('パスワード')); ?></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">
                                            <?php echo e(__('ログイン')); ?>

                                        </button>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col align-self-center">
                                        <?php if(Route::has(isset($authgroup) ? $authgroup.'.password.request' : 'password.request')): ?>
                                        <div class="col">
                                            <a class="btn btn-link" href="<?php echo e(route(isset($authgroup) ? $authgroup.'.password.request' : 'password.request')); ?>">
                                                <?php echo e(__('パスワードをお忘れの方')); ?>

                                            </a>
                                            <?php endif; ?>
                                        </div>
                                        <?php if(isset($authgroup)): ?>
                                        <div class="col">
                                            <a class="btn btn-link" href="<?php echo e(url('register/admin')); ?>">
                                                <?php echo e(__('新規登録')); ?>

                                            </a>
                                        </div>
                                        <div class="col">
                                            <?php else: ?>
                                            <a class="btn btn-link" href="<?php echo e(route('register')); ?>">
                                                <?php echo e(__('新規登録')); ?>

                                            </a>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(isset($authgroup)): ?>
                                        <?php else: ?>
                                        <div class="col">
                                            <a class="btn btn-link" href="<?php echo e(url('login/admin')); ?>">
                                                <?php echo e(__('管理ユーザーはこちら')); ?>

                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/login.blade.php ENDPATH**/ ?>