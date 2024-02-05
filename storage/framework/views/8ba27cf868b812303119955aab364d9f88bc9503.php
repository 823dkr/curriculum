<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <!-- 文字コード・画面表示の設定 -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <script src="https://kit.fontawesome.com/d360594945.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/_ajaxfeed.js')); ?>" defer></script>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
</head>

<body>
    <!-- ナビゲーションメニュー -->
    <nav class="navbar navbar-expand-lg navbar-light text-dark bg-dark" id="home">
        <a class="navbar-brand text-white" href="/creatures">ReptileNote</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if(Auth::check() || (isset($authgroup) && Auth::guard($authgroup)->check())): ?>
            <?php if(isset($authgroup)): ?>
            <span class="my-navbar-item text-white"><?php echo e(Auth::guard($authgroup)->user()->name); ?></span>
            <?php else: ?>
            <span class="my-navbar-item text-white"><?php echo e(Auth::user()->name); ?></span>
            <?php endif; ?>
            /
            <a href="#" id="logout" class="my-navbar-item text-right">ログアウト</a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
            <script>
                document.getElementById('logout').addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                });
            </script>
            <?php else: ?>
            <a class="btn btn-link" href="<?php echo e(route('login')); ?>">
                <?php echo e(__('ログイン')); ?>

            </a>
            <?php endif; ?>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>
    <!-- jQuery,Popper.js,Bootstrap JSの順番で読み込む-->
    <!-- jQueryの読み込み -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Popper.jsの読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!-- Bootstrapのjsの読み込み -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/d360594945.js" crossorigin="anonymous"></script>
</body>

</html><?php /**PATH /var/www/html/resources/views/layout.blade.php ENDPATH**/ ?>