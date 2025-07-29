 <!-- START BANNER -->
 <div class="">
     <div class="banner_home">
         <div class="swiper swiper-slide-home">
             <div class="swiper-wrapper">
                 <?php $__currentLoopData = $sub_banners_5; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="swiper-slide">
                         <div class="banner_home_image">
                             <img src="<?php echo e(asset($item->image_desktop)); ?>" alt="<?php echo e($item->title); ?>" loading="lazy" />
                         </div>
                         <?php if(!empty($item->title)): ?>
                             <div class="banner_home_text">
                                 <h2 class="banner_home_text_h2"><?php echo e($item->title); ?></h2>
                                 <span class="banner_home_text_span"><?php echo e($item->description); ?></span>
                                 <a href="<?php echo e($item->href); ?>" class="banner_home_text_btn">
                                     <?php echo e($item->button); ?>

                                     <i class="fa-solid fa-chevron-right"></i>
                                 </a>
                             </div>
                         <?php endif; ?>
                     </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>
             <div class="swiper-pagination"></div>
         </div>
     </div>
     <div class="banner_home_mobile">
         <?php $__currentLoopData = $sub_banners_5; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="banner_home_mobile_image">
                 <img src="<?php echo e(asset($item->image_mobile)); ?>" alt="<?php echo e($item->title); ?>" loading="lazy" />
             </div>
             <div class="banner_home_mobile_text">
                 <h2 class="banner_home_mobile_text_h2"><?php echo e($item->title); ?></h2>
                 <span class="banner_home_mobile_text_span"><?php echo e($item->description); ?></span>
                 <a href="<?php echo e($item->href); ?>" class="banner_home_mobile_text_btn"><?php echo e($item->button); ?> <i
                         class="fa-solid fa-chevron-right"></i>
                 </a>
             </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </div>
 </div>
 <!-- END BANNER -->

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         var swiper = new Swiper(".swiper-slide-home", {
             spaceBetween: 30,
             centeredSlides: true,
             autoplay: {
                 delay: 2500,
                 disableOnInteraction: false,
             },
             pagination: {
                 el: ".swiper-pagination",
                 clickable: true,
             },
             navigation: {
                 nextEl: ".swiper-button-next",
                 prevEl: ".swiper-button-prev",
             },
             loop: true // Add this if you want infinite loop
         });
     });
 </script>
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/homeBanner.blade.php ENDPATH**/ ?>