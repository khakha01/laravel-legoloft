 
 <?php $__env->startSection('title', 'Admin | Chỉnh sửa sản phẩm'); ?>
 <?php $__env->startSection('content'); ?>

     <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center  my-3">
             <div class=""></div>
             <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="<?php echo e(route('product')); ?>">Quay lại</a>
         </div>


         <form action="<?php echo e(route('editProduct', $product->id)); ?>" method="post" class="formAdmin" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>
             <?php echo method_field('PUT'); ?>
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa sản phẩm
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>


             <ul class="nav nav-tabs" id="myTab" role="tablist">
                 <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                         type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Chung</button>
                 </li>
                 <li class="nav-item" role="presentation">
                     <button class="nav-link" id="discount-tab" data-bs-toggle="tab" data-bs-target="#discount-tab-pane"
                         type="button" role="tab" aria-controls="discount-tab-pane" aria-selected="false">Giảm
                         giá</button>
                 </li>
                 <li class="nav-item" role="presentation">
                     <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                         type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Hình
                         ảnh</button>
                 </li>
             </ul>

             <div class="tab-content" id="myTabContent">
                 <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                     tabindex="0">
                     <div class="form-group mt-3">
                         <label for="name" class="form-label">Tên sản phẩm</label>
                         <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name"
                             value="<?php echo e($product->name); ?>">
                         <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>
                     <div class="form-group mt-3">
                         <div class="d-flex">
                             <label for="slug" class="form-label pe-2">Slug</label>
                             <label class="containerSlug">
                                 <input type="checkbox"id="off_slug" onclick="toggleSlug()">Tắt tự động
                                 <div class="checkmarkSlug"></div>
                             </label>
                         </div>
                         <input type="text" class="form-control" id="convert_slug" name="slug"
                             value="<?php echo e($product->slug); ?>">
                         <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>
                     <div class="form-group mt-3">
                         <label for="description" class="form-label">Nội dung chi tiết sản phẩm</label>
                         <textarea class="form-control" id="editor1" name="description" rows="3"><?php echo e($product->description); ?>

                    </textarea>
                         <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>

                     <div class="form-group mt-3">
                         <label for="description" class="form-label">Chọn danh mục của sản phẩm</label>
                         <select class="form-select " name="category_id">
                             <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php $__currentLoopData = $category->categories_children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($item->id); ?>" <?php echo e($product->id == $item->id ? 'selected' : 0); ?>>
                                         <?php echo e($item->name); ?>

                                     </option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         </select>
                         <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>
                     <div class="form-group mt-3">
                         <label for="price" class="form-label">Giá sản phẩm</label>
                         <input type="text" class="form-control" id="price" name="price"
                             oninput="formatCurrency(this)" value="<?php echo e(number_format($product->price, 0, ',')); ?>">

                         <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>

                     <div class="form-group mt-3">
                         <label for="price" class="form-label">Lượt xem</label>
                         <input type="number" class="form-control" id="view" name="view"
                             value="<?php echo e($product->view); ?>">
                         <?php $__errorArgs = ['view'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>
                     <div class="form-group mt-3">
                         <label for="">Nổi bật</label>
                         <select class="form-select mt-3" aria-label="Default select example" name="outstanding">
                             <option value="0" <?php echo e($product->outstanding == 0 ? 'selected' : ''); ?>>Tắt</option>
                             <option value="1" <?php echo e($product->outstanding == 1 ? 'selected' : ''); ?>>Bật</option>
                         </select>
                         <?php $__errorArgs = ['outstanding'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>

                     <div class="form-group mt-3">
                         <label for="">Trạng thái</label>
                         <select class="form-select mt-3" aria-label="Default select example" name="status">
                             <option value="0"<?php echo e($product->status == 0 ? 'selected' : ''); ?>>Tắt</option>
                             <option value="1" <?php echo e($product->status == 1 ? 'selected' : ''); ?>>Bật</option>
                         </select>
                         <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <div class="text-danger" id="alert-message"><?php echo e($message); ?></div>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                     </div>
                 </div>
                 <div class="tab-pane fade" id="discount-tab-pane" role="tabpanel" aria-labelledby="discount-tab"
                     tabindex="0">
                     <table class="table table-bordered mt-3 pt-3">
                         <thead>
                             <tr>
                                 <th>Nhóm khách hàng</th>
                                 <th>Giá giảm sản phẩm</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody class="discount-product">
                             <?php $__currentLoopData = $productDiscount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                     <td>
                                         <select class="form-select" aria-label="Default select example"
                                             name="user_group_id[]">
                                             <?php $__currentLoopData = $userGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <option value="<?php echo e($userGroup->id); ?>"
                                                     <?php echo e($userGroup->id == $item->user_group_id ? 'selected' : ''); ?>>
                                                     <?php echo e($userGroup->name); ?></option>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         </select>
                                     </td>
                                     <td> <input type="text" class="form-control" id="priceUserGroup[]"
                                             name="priceUserGroup[]" placeholder="Nhập giá giảm"
                                             oninput="formatCurrency(this)"
                                             value="<?php echo e(number_format($item->price, 0, ',')); ?>">


                                     </td>
                                     <td>
                                         
                                         <button type="button" class="remove_bannerImages_add "
                                             onclick="window.location.href='<?php echo e(route('productDeleteDiscount', $item->id)); ?>'">Xóa</button>
                                     </td>
                                 </tr>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         </tbody>
                     </table>
                     <div class="row mb-3">
                         <div class="col-md-12">
                             <button type="button" class="btn btn-primary add-discount-btn">Thêm mức giảm
                                 giá</button>
                         </div>
                     </div>
                 </div>
                 <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                     tabindex="0">
                     <div class="form-group  mt-3">
                         <h4 class="label_admin">Ảnh sản phẩm</h4>
                         <div class="custom-file imageAdd p-3 ">
                             <div class="imageFile">
                                 <img src="<?php echo e(asset('img/' . $product->image)); ?>" alt="">
                             </div>
                             <div class="">
                                 <input type="file" name="image" id="HinhAnh" class="inputFile">
                             </div>
                         </div>
                     </div>
                     <div class="form-group mt-3">
                         <h4>Hình ảnh bổ sung</h4>
                         <?php if(count($productImages)): ?>
                             <div class="row bannnerImagesEdit">
                                 <div class="col-md-12 productImagePut">
                                     <?php $__currentLoopData = $productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <div class="row_product my-3">
                                             <div class="custom-file imageAdd p-3">
                                                 <div class="imageFile">
                                                     <img src="<?php echo e(asset('img/' . $item->images)); ?>" alt="">
                                                 </div>
                                                 <div class="d-flex flex-column">
                                                     <div class="">
                                                         <input type="file" name="images[<?php echo e($key); ?>]"
                                                             id="HinhAnh" class="inputFile">
                                                     </div>
                                                     <div class="mt-3">
                                                         <button class="remove_bannerImages_add remove_productImages"
                                                             onclick="window.location.href='<?php echo e(route('productDeleteImages', $item->id)); ?>'">Xóa</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </div>
                             </div>
                             <div class="row mt-3  p-0">
                                 <div class="col-md-3 col-12 px-2">
                                     <button type="button" class="btn-ProductImagesAdd">Thêm
                                         hình
                                         ảnh</button>
                                 </div>
                                 <div class="col-md-9  col-12"></div>
                             </div>
                         <?php else: ?>
                             <div class="row bannnerImagesEdit">
                                 <div class="col-md-12 productImagePut">
                                     <div class="row_product my-3">
                                         <div class="custom-file imageAdd p-3">
                                             <div class="imageFile">
                                                 <div class="previewImages"><img src="<?php echo e(asset('img/lf.png')); ?>"
                                                         alt="">
                                                 </div>
                                             </div>
                                             <div class="d-flex flex-column">
                                                 <div class="">
                                                     <input type="file" name="images[]"
                                                         class="inputFile imageInputJS">
                                                 </div>
                                                 <div class="mt-3">
                                                     <button
                                                         class="remove_bannerImages_add remove_productImages">Xóa</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                             <div class="row mt-3  p-0">
                                 <div class="col-md-3 col-12">
                                     <button type="button" class="btn-ProductImagesAdd">Thêm
                                         hình
                                         ảnh</button>
                                 </div>
                                 <div class="col-md-9  col-12"></div>
                             </div>
                         <?php endif; ?>

                     </div>
                 </div>
             </div>

         </form>
     </div>
 <?php $__env->stopSection(); ?>

 <?php $__env->startSection('productEditAdminScript'); ?>

     <script>
         $(document).ready(function() {
             let productImages = `
         <div class="col-md-12 productImagePut">
           <div class="row_product my-3">
                <div class="custom-file imageAdd p-3">
                    <div class="imageFile">
                        <div class="previewImages"><img src="<?php echo e(asset('img/lf.png')); ?>" alt=""></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="">
                            <input type="file" name="images[]"
                                class="inputFile imageInputJS">
                        </div>
                        <div class="mt-3">
                            <button
                                class="remove_bannerImages_add remove_productImages">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
             $('.btn-ProductImagesAdd').click(function() {
                 $('.productImagePut').append(productImages.trim());
             });
             //append  sử dụng để thêm nội dung vào cuối của một phần tử đã chọn // trim dùng để loại bỏ khoảng trắng ở đầu và cuối chuỗi // closest tìm phần tử cha gần nhất (ancestor) khớp với bộ chọn được cung cấp
             $(document).on('click', '.remove_productImages', function() {
                 $(this).closest('.row_product').remove();
             })
         })
     </script>
     <script>
         $(document).ready(function() {
             let discountRowTemplate = `
                <tr class="discount-row">
                    <td>
                        <select class="form-select" aria-label="Default select example" name="user_group_id[]">
                            <?php $__currentLoopData = $userGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($userGroup->id); ?>"><?php echo e($userGroup->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td>
                        <input class="form-control " type="text" name="priceUserGroup[]" oninput="formatCurrency(this)"  >
                    </td>
                    <td>
                        <button type="button" class="remove_bannerImages_add remove-discount-btn">Xóa</button>
                    </td>
                </tr>
            `;

             $('.add-discount-btn').click(function() {
                 $('.discount-product').append(discountRowTemplate.trim());
             });

             $(document).on('click', '.remove-discount-btn', function() {
                 $(this).closest('.discount-row').remove();
             });
         });
     </script>
     <script>
         // Hàm định dạng số với dấu phẩy
         function formatCurrency(input) {
             let value = input.value.replace(/[^0-9]/g, ''); // Loại bỏ ký tự không phải số
             value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Thêm dấu phẩy
             input.value = value;
         }

         // Loại bỏ dấu phẩy trước khi gửi form
         document.querySelector('form').addEventListener('submit', function(event) {
             const priceInputs = document.querySelectorAll('input[name="price"], input[name="priceUserGroup[]"]');

             priceInputs.forEach(function(input) {
                 // Loại bỏ dấu phẩy trước khi gửi
                 input.value = input.value.replace(/,/g, '');
             });
         });
     </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/productEdit.blade.php ENDPATH**/ ?>