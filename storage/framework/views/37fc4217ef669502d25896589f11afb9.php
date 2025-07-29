<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($category->status == 1): ?>
        <?php $__currentLoopData = $category->categories_children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->status_section == 1): ?>
                <section class="section_product_theme"data-aos="fade-right" data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    <div class="container ">
                        <div class="title_home">
                            <h2><?php echo e($item->name); ?></h2>
                        </div>
                        <div class="owl-carousel owl-theme">
                            <?php if(isset($productByCategory[$item->id])): ?>
                                <?php $__currentLoopData = $productByCategory[$item->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $priceDiscount = 0;
                                        $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                                        $productDiscountPrice = $product->productDiscount
                                            ->where('user_group_id', $userGroupId)
                                            ->first();

                                        $price = $product->price ? $product->price : null;

                                        if ($productDiscountPrice) {
                                            $priceDiscount = $productDiscountPrice
                                                ? $productDiscountPrice->price
                                                : null;
                                        }

                                        $percent = ceil((($product->price - $priceDiscount) / $product->price) * 100);
                                        $productImageCollect = $product->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                                        $isFavourite = false;
                                        if (Auth::check()) {
                                            $isFavourite = $product->favourite
                                                ->where('user_id', Auth::id())
                                                ->contains('product_id', $product->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                                        } else {
                                            $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                                            // Lấy danh sách tất cả các product_id từ mảng $favourite
                                            $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                                            // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                                            $isFavourite =
                                                is_array($productIds) && in_array((string) $product->id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                                        }
                                    ?>

                                    <div class="item">
                                        <div class="product_box">
                                            <div class="product_box_effect">
                                                <?php if(isset($productDiscountPrice)): ?>
                                                    <div class="product_box_tag_sale">
                                                        <?php echo e($percent); ?>%</div>
                                                <?php endif; ?>
                                                <div class="product_box_icon">
                                                    <button onclick="addFavourite('<?php echo e($product->id); ?>')"
                                                        class="outline-0 border-0"
                                                        style="background-color: transparent">
                                                        <i class="fa-solid fa-heart <?php echo e($isFavourite ? 'red' : ''); ?>"
                                                            data-product-id="favourite-<?php echo e($product->id); ?>"></i>
                                                    </button> <button class="outline-0 border-0 "
                                                        style="background-color: transparent"
                                                        onclick="showModalProduct(event,'<?php echo e($product->id); ?>','<?php echo e($product->image); ?>','<?php echo e($product->name); ?>','<?php echo e($product->price); ?>','<?php echo e($priceDiscount); ?>','<?php echo e(json_encode($productImageCollect)); ?>')">
                                                        <i class="fa-regular fa-eye"></i>

                                                    </button>
                                                    
                                                    <button type="button"
                                                        onclick="addToCart('<?php echo e($product->id); ?>', 1)"
                                                        class="outline-0 border-0 "
                                                        style="background-color: transparent">
                                                        <i class="fa-solid fa-bag-shopping"></i>
                                                    </button>
                                                </div>
                                                <div class="product_box_image">
                                                    <img src="<?php echo e(asset('img/' . $product->image)); ?>"
                                                        alt="<?php echo e($product->name); ?>" loading="lazy" />
                                                </div>
                                                <div class="product_box_content_out">
                                                    <div class="product_box_content">
                                                        <h3><a
                                                                href="<?php echo e(route('detail', $product->slug)); ?>"><?php echo e($product->name); ?></a>
                                                        </h3>

                                                    </div>
                                                    <?php if($productDiscountPrice): ?>
                                                        <div class="product_box_price">
                                                            <span><?php echo e(number_format($product->price, 0, ',') . 'đ'); ?></span><?php echo e(number_format($productDiscountPrice->price, 0, ',') . 'đ'); ?>

                                                        </div>
                                                    <?php else: ?>
                                                        <div class="product_box_price">
                                                            <span></span><?php echo e(number_format($product->price, 0, ',') . 'đ'); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/homeCategoryProduct.blade.php ENDPATH**/ ?>