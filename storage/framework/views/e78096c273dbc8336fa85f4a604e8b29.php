<?php $__env->startSection('title', 'LegoLoft | website lego'); ?>
<?php $__env->startSection('content'); ?>
    <!-- START BANNER -->
    <?php echo $__env->make('homeBanner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <!-- END BANNER -->

    <div class="background_home">
        <!-- START CATEGORY -->
        <?php echo $__env->make('homeCategory', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
        <!-- END CATEGORY -->

        <!-- START LỰA CHỌN -->
        <?php echo $__env->make('homeCategoryChoose', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END LỰA CHỌN -->

        <!-- START PRODUCT NỔI BẬT -->
        <?php echo $__env->make('homeOutstanding', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END PRODUCT NỔI BẬT -->

        <!-- START PRODUCT GIẢM GIÁ -->
        <?php echo $__env->make('homeSale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END PRODUCT GIẢM GIÁ  -->

        <?php echo $__env->make('homeCategoryProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- START PRODUCT BÁN CHẠY -->
        <?php echo $__env->make('homeSoldOut', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END PRODUCT BÁN CHÁY-->

        <!-- START BUILT -->
        <?php echo $__env->make('homeBuilt', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END BUILT -->

        <!-- START PRODUCT HẾT HÀNG -->
        <?php echo $__env->make('homeOutStock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END PRODUCT HẾT HÀNG -->

        <!-- START BÀI VIẾT -->
        <?php echo $__env->make('homeBlog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END BÀI VIẾT -->
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\laravel-legoloft\resources\views/home.blade.php ENDPATH**/ ?>