<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title><?php echo $__env->yieldContent('page_title'); ?></title>
        <meta name="description" content="<?php echo $__env->yieldContent('page_description'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    </head>
    <body>

        <?php echo $__env->yieldContent('content'); ?>

        <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html>
