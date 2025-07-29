        <!-- START LỰA CHỌN -->
        <section class="product">
            <div class="container" data-aos="fade-up">
                <div class="title_home">
                    <h2>Những lựa chọn hàng đầu trong tuần này</h2>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $categoryChoose; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="card_box">
                                <div class="card_box_img">
                                    <img src="<?php echo e(asset('img/' . $item->image)); ?>" alt="<?php echo e($item->name); ?>"
                                        loading="lazy" />
                                </div>
                                <div class="card_box_content">
                                    <h3><?php echo e($item->name); ?></h3>
                                </div>
                                <div class="card_box_btn">
                                    <a href="<?php echo e(route('categoryProduct', $item->id)); ?>">Xem ngay</a>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- END LỰA CHỌN -->
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/homeCategoryChoose.blade.php ENDPATH**/ ?>