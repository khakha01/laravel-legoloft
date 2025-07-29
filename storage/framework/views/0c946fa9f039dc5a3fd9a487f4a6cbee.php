 <!-- START CATEGORY -->
 <div class="container">
     <div class="image_category" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
         <h3 class="text-center pt-3">Mua sắm theo chủ đề</h3>
         <ul class="image_category_ul">
             <?php $__currentLoopData = $categoryAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <li class="">
                     <a href="<?php echo e(route('categoryProduct', $item->id)); ?>" class="text-decoration-none">
                         <img src="<?php echo e(asset('img/' . $item->image)); ?>" alt="<?php echo e($item->name); ?>" loading="lazy" />
                         <div class="image_category_span">
                             <span><?php echo e($item->name); ?></span>
                         </div>
                     </a>
                 </li>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </ul>
     </div>
 </div>
 <!-- END CATEGORY -->
<?php /**PATH D:\laragon\www\LARAVEL\laravel-legoloft\resources\views/homeCategory.blade.php ENDPATH**/ ?>