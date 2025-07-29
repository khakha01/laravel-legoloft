 
 <?php $__env->startSection('content'); ?>
     <div class="container-file-manager" style="height: 90vh">
         <iframe src="/file-manager" style="width:100%; height:100%; border:none;"></iframe>
     </div>
     <style>
         .container-file-manager {
             background: red;
             z-index: 10000;
             position: relative;
             top: 0;
             left: 0px;
             width: 100%;
             height: 90vh;
             border: 1px solid #000;
             margin: 0 auto;
         }
     </style>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/media-manager.blade.php ENDPATH**/ ?>