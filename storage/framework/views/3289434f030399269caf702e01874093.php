 <!-- START PRODUCT GIẢM GIÁ -->
 <section class="product">
     <div class="container" data-aos="fade-up">
         <div class="title_home">
             <h2>Sản phẩm giảm giá</h2>
         </div>
         <div class="owl-carousel owl-theme">
             <?php $__currentLoopData = $productDiscountSection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php
                     $percent = ceil((($item->products->price - $item->price) / $item->products->price) * 100);
                     $productImageCollect = $item->products->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                     $isFavourite = false;
                     if (Auth::check()) {
                         $isFavourite = $item->products->favourite
                             ->where('user_id', Auth::id())
                             ->contains('product_id', $item->product_id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                     } else {
                         $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                         // Lấy danh sách tất cả các product_id từ mảng $favourite
                         $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                         // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                         $isFavourite = is_array($productIds) && in_array((string) $item->product_id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                     }
                 ?>
                 <?php if($item->products->status == 1): ?>
                     <div class="item">
                         <div class="product_box">
                             <div class="product_box_effect">
                                 <div class="product_box_tag_sale"><?php echo e($percent); ?>%</div>
                                 <div class="product_box_icon">
                                     <button onclick="addFavourite('<?php echo e($item->product_id); ?>')"
                                         class="outline-0 border-0" style="background-color: transparent">
                                         <i class="fa-solid fa-heart <?php echo e($isFavourite ? 'red' : ''); ?>"
                                             data-product-id="favourite-<?php echo e($item->product_id); ?>"></i>
                                     </button>
                                     <button class="outline-0 border-0 " style="background-color: transparent"
                                         onclick="showModalProduct(event,'<?php echo e($item->product_id); ?>','<?php echo e($item->products->image); ?>','<?php echo e($item->products->name); ?>','<?php echo e($item->products->price); ?>','<?php echo e($item->price); ?>','<?php echo e(json_encode($productImageCollect)); ?>')">
                                         <i class="fa-regular fa-eye"></i>
                                     </button>
                                     
                                     <button type="button" onclick="addToCart('<?php echo e($item->product_id); ?>', 1)"
                                         class="outline-0 border-0" style="background-color: transparent">
                                         <i class="fa-solid fa-bag-shopping"></i>
                                     </button>
                                 </div>

                                 <div class="product_box_image">
                                     <img src="<?php echo e(asset('img/' . $item->products->image)); ?>"
                                         alt="<?php echo e($item->products->slug); ?>" loading="lazy" />
                                 </div>
                                 <div class="product_box_content_out">
                                     <div class="product_box_content">
                                         <h3> <a
                                                 href="<?php echo e(route('detail', $item->products->slug)); ?>"><?php echo e($item->products->name); ?></a>
                                         </h3>

                                     </div>
                                     <?php if(Auth::check()): ?>
                                         <div class="product_box_price">
                                             <span><?php echo e(number_format($item->products->price, 0, ',') . 'đ'); ?></span><?php echo e(number_format($item->price, 0, ',') . 'đ'); ?>

                                         </div>
                                     <?php else: ?>
                                         <div class="product_box_price">
                                             <span><?php echo e(number_format($item->products->price, 0, ',') . 'đ'); ?></span><?php echo e(number_format($item->price, 0, ',') . 'đ'); ?>

                                         </div>
                                     <?php endif; ?>

                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php endif; ?>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
     </div>
 </section>
 <!-- END PRODUCT GIẢM GIÁ  -->
<?php /**PATH D:\laragon\www\LARAVEL\laravel-legoloft\resources\views/homeSale.blade.php ENDPATH**/ ?>