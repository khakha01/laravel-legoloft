<?php $__env->startSection('content'); ?>
    <h1>Banner Detail</h1>
    <p>Title: <?php echo e($banner->title); ?></p>
    <p>Description: <?php echo e($banner->description); ?></p>
    <p>Href: <?php echo e($banner->href); ?></p>
    <p>Button: <?php echo e($banner->button); ?></p>

    <a href="<?php echo e(route('banners.edit', $banner)); ?>">Edit</a>
    <a href="<?php echo e(route('banners.index')); ?>">Back</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/banners/show.blade.php ENDPATH**/ ?>