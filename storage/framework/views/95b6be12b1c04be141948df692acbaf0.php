<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1>Edit Banner</h1>
        <?php echo $__env->make('admin.banners._form', [
            'action' => route('banners.update', $banner),
            'isEdit' => true,
            'banner' => $banner,
            'buttonText' => 'Update',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/banners/edit.blade.php ENDPATH**/ ?>