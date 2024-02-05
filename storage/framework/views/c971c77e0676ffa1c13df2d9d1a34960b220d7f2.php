
<?php $__env->startSection('content'); ?>
<main>
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
    <form action="/creatures/<?php echo e($id); ?>" method="post" enctype='multipart/form-data'>
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <div class="card-header">画像選択</div>
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label class="sr-only">カテゴリ名</label>
            <select name='type_id' class="form-control">
                <option value="" hidden>カテゴリ選択</option>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($type['id']==$result['type_id']): ?>
                <option value="<?php echo e($type['id']); ?>" selected><?php echo e($type['name']); ?></option>
                <?php else: ?>
                <option value="<?php echo e($type['id']); ?>"><?php echo e($type['name']); ?></option>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label class="sr-only">モルフ名</label>
            <input name="name" type="text" class="form-control" id="lg_email" placeholder="モルフ名" value="<?php if(null!==(old('name'))): ?><?php echo e(old('name')); ?><?php else: ?><?php echo e($result['name']); ?><?php endif; ?>">
        </div>

        <div class="form-group">
            <label class="sr-only">性別</label>
            <select name='sex_id' class="form-control">
                <option value="" hidden>性別選択</option>
                <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($sex['id']==$result['sex_id']): ?>
                <option value="<?php echo e($sex['id']); ?>" selected><?php echo e($sex['name']); ?></option>
                <?php else: ?>
                <option value="<?php echo e($sex['id']); ?>"><?php echo e($sex['name']); ?></option>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class='row justify-content-center'>
            <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
        </div>

    </form>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/creature/edit.blade.php ENDPATH**/ ?>