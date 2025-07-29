 <!-- START PRODUCT HẾT HÀNG -->
 <?php if($productSoldOut && count($productSoldOut) > 0): ?>
     <section class="product">
         <div class="container" data-aos="fade-up">
             <div class="title_home">
                 <h2>Sản phẩm hết hàng</h2>
             </div>
             <div class="owl-carousel owl-theme">
                 <?php $__currentLoopData = $productSoldOut; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="item">
                         <div class="product_box">
                             <div class="product_box_effect">
                                 <div class="product_box_tag_soldout">Hết hàng</div>
                                 <div class="product_box_image_black">
                                     <img src="<?php echo e(asset('img/' . $item->image)); ?>"
                                         alt="<?php echo e($item->name); ?>"loading="lazy" />
                                 </div>
                                 <div class="product_box_content_out">
                                     <div class="product_box_content">
                                         <h3><a href="<?php echo e(route('detail', $item->slug)); ?>"><?php echo e($item->name); ?></a>
                                         </h3>
                                     </div>
                                     <div class="">
                                         <span
                                             class="text-black"><?php echo e(number_format($item->price, 0, ',', '.') . 'đ'); ?></span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
         </div>
     </section>
 <?php endif; ?>
 <!-- END PRODUCT HẾT HÀNG -->
<?php /**PATH D:\laragon\www\LARAVEL\laravel-legoloft\resources\views/homeOutStock.blade.php ENDPATH**/ ?>