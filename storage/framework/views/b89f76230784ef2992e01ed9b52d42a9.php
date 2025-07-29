<?php $__env->startSection('title', 'Admin | Thêm hình ảnh banner'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1>Create Banner</h1>
        <?php echo $__env->make('admin.banners._form', [
            'action' => route('banners.store'),
            'isEdit' => false,
            'banner' => null,
            'buttonText' => 'Create',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/banners/create.blade.php ENDPATH**/ ?>