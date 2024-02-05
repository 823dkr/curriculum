
<?php $__env->startSection('content'); ?>
<main>
    <br>
    <br>
    <div class="text-center">
        <a class="btn btn-outline-success  btn-lg" href="/creatures/create" role="button">生体新規登録</a>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class='text-center'>生体検索</div>
                </div>
                <div class="card-body">
                    <form action='/searches' method="get">
                        <?php echo csrf_field(); ?>
                        <select name='type_id' class="form-control">
                            <option value="" hidden>カテゴリ選択</option>
                            <?php $__currentLoopData = $all_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($all_type['id']); ?>"><?php echo e($all_type['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select name='sex_id' class="form-control">
                            <option value="" hidden>性別選択</option>
                            <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sex['id']); ?>"><?php echo e($sex['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="container">
        <table class=" table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?php echo e($type['name']); ?></th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th scope="col">生体画像</th>
                    <th scope="col">モルフ名</th>
                    <th scope="col">性別</th>
                    <th scope="col">編集</th>
                    <th scope="col">削除</th>
                    <th scope="col">給餌</th>
                </tr>
            </thead>

            <?php $__currentLoopData = $creatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tbody>
                <?php if($type['id'] == $creature['type_id']): ?>
                <tr>
                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(($creature['id']==$image['creature_id'])): ?>
                    <td> <img src="<?php echo e($image->path); ?>" class="img-thumbnail"></td>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($creature['name']); ?></td>

                    <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($creature['sex_id']==$sex['id']): ?>
                    <td><?php echo e($sex['name']); ?></td>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <td>
                        <form action="/creatures/<?php echo e($creature->id); ?>/edit" method="get">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-info">編集</button>
                        </form>
                    </td>
                    <td>
                        <form action=" /creatures/<?php echo e($creature->id); ?>" method="post">
                            <?php echo method_field('delete'); ?>
                            <?php echo csrf_field(); ?>
                            <button class='btn btn-outline-danger' onclick="return confirm('<?php echo e($creature->name); ?>を削除してよろしいですか?')">削除</button>
                        </form>
                    </td>
                    <td><!------------------給餌管理ボタン----------------------->
                        <?php if(!$creature->isFeedBy(Auth::user())): ?>

                        <span class="feeds">
                            <i class="fa-solid fa-utensils feed-toggle" id="icon" data-creature-id="<?php echo e($creature->id); ?>"> </i>
                        </span>
                        <?php else: ?>
                        <span class="feeds">
                            <i class="fa-solid fa-utensils feed-toggle feeded" id="icon" data-creature-id="<?php echo e($creature->id); ?>"> </i>
                        </span>
                        <?php endif; ?>​
                    </td>
                </tr>
                <?php else: ?>
                <?php endif; ?>
            </tbody>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
    <br><br><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/creature/index.blade.php ENDPATH**/ ?>