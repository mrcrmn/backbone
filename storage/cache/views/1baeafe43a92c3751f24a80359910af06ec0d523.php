<?php $__env->startSection('page_title', $error); ?>
<?php $__env->startSection('page_description', $msg); ?>

<?php $__env->startSection('content'); ?>
    <h1>
        Error: <?php echo e($error); ?> <br>
        <?php echo e($msg); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>