 <!-- START BUILT -->
 <section class="home_built" data-aos="fade-up">
     <div class="container">
         <div class="title_home_built">
             <h2>Được xây dựng bởi bạn</h2>
         </div>
         <div class="row">
             <?php $__currentLoopData = $commentBuildImageById; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="col-md-3 col-sm-4 col-12 py-3">
                     <div class="built_box">
                         <div class="built_box_effect">
                             <div class="built_box_image">
                                 <img src="<?php echo e(asset('img/' . $item->images)); ?>" alt="<?php echo e($item->images); ?>"
                                     loading="lazy" />

                             </div>
                             <div class="built_buyNow"> <a
                                     href="<?php echo e(route('detail', $item->comment->product->slug)); ?>">Mua
                                     ngay</a></div>

                         </div>
                     </div>
                 </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

         <div class="row">
             <div class="col-md-12">
                 <div class="div_btn_built">
                     <a href="<?php echo e(route('inspiration')); ?>" class="built_home_text_btn">Khám phá <i
                             class="fa-solid fa-chevron-right"></i></a>
                 </div>
             </div>
         </div>

     </div>
 </section>
 <!-- END BUILT -->
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/homeBuilt.blade.php ENDPATH**/ ?>