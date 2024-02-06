
<?php $__env->startSection('content'); ?>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <h1>管理者ページ</h1>
            </div>
            <br>
            <br>
            <div class="container">
                <table class=" table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                                <h3>ユーザーリスト</h3>
                            </th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">名前</th>
                            <th scope="col">メールアドレス</th>
                            <th scope="col">削除</th>
                        </tr>
                    </thead>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td scope="col"><?php echo e($user->id); ?></td>
                        <td scope="col"><?php echo e($user->name); ?></td>
                        <td scope="col"><?php echo e($user->email); ?></td>
                        <td>
                            <form action="/admin/<?php echo e($user->id); ?>" method="post">
                                <?php echo method_field('delete'); ?>
                                <?php echo csrf_field(); ?>
                                <button class='btn btn-danger' onclick="return confirm('<?php echo e($user->name); ?>を削除してよろしいですか?')">削除</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout',['authgroup'=>'admin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/admin.blade.php ENDPATH**/ ?>