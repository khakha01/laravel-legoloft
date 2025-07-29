 
 <?php $__env->startSection('title', 'Admin | Chỉnh sửa danh mục'); ?>
 <?php $__env->startSection('content'); ?>

     <div class="container-fluid">

         <div class="d-flex justify-content-end align-items-center  my-3">

             <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="<?php echo e(route('category')); ?>">Quay
                 lại</a>
         </div>

         <form action="<?php echo e(route('categoryUpdate', $category->id)); ?>" method="post" class="formAdmin"
             enctype="multipart/form-data">
             <?php echo csrf_field(); ?>
             <?php echo method_field('PUT'); ?>
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa danh mục
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tên danh mục</label>
                 <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name"
                     value="<?php echo e($category->name); ?>">
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
                 <input type="text" class="form-control" id="convert_slug" name="slug" value="<?php echo e($category->slug); ?>">
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
                 <label for="description" class="form-label">Mô tả </label>
                 <textarea class="form-control " id="" name="description" rows="6" col="50"><?php echo e($category->description); ?></textarea>
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
                 <label for="exampleInputFile" class="form-label">Hình ảnh danh mục</label>
                 <div class="custom-file imageAdd p-3 ">
                     <div class="imageFile">
                         <?php if($category->image): ?>
                             <img src="<?php echo e(asset('img/' . $category->image)); ?>" alt="Ảnh xem trước" width="300"
                                 height="300" />
                         <?php else: ?>
                             <div id="preview"><img src="<?php echo e(asset('img/lf.png')); ?>" alt="">
                             </div>
                         <?php endif; ?>
                     </div>
                     <div class="">
                         <input type="file" name="image" id="HinhAnh" class="inputFile">
                     </div>
                 </div>
                 <?php $__errorArgs = ['image'];
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
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group-image">
                             <div class="imageFile">
                                 <?php if($category->image_2): ?>
                                     <img src="<?php echo e(asset($category->image_2)); ?>" alt="Desktop Image" class="preview-img">
                                 <?php else: ?>
                                     <img id="image_2_preview" src="">
                                 <?php endif; ?>
                             </div>
                             <div class="input-group">
                                 <input id="image_2" class="form-control mb-2" type="text" name="image_2"
                                     placeholder="Image Desktop URL"
                                     value="<?php echo e(old('image_2', $category->image_2 ?? '')); ?>">
                                 <span class="input-group-btn">
                                     <button type="button" data-input="image_2" data-preview="image_2_preview"
                                         class="btn btn-primary lfm">
                                         <i class="fa fa-picture-o"></i> Choose
                                     </button>
                                 </span>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group-image">
                             <div class="imageFile">
                                 <?php if($category->image_3): ?>
                                     <img src="<?php echo e(asset($category->image_3)); ?>" alt="Desktop Image" class="preview-img">
                                 <?php else: ?>
                                     <img id="image_3_preview" src="">
                                 <?php endif; ?>
                             </div>
                             <div class="input-group">
                                 <input id="image_3" class="form-control mb-2" type="text" name="image_3"
                                     placeholder="Image Desktop URL"
                                     value="<?php echo e(old('image_3', $category->image_3 ?? '')); ?>">
                                 <span class="input-group-btn">
                                     <button type="button" data-input="image_3" data-preview="image_3_preview"
                                         class="btn btn-primary lfm">
                                         <i class="fa fa-picture-o"></i> Choose
                                     </button>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="form-group mt-3">
                 <label for="description" class="form-label">Lựa chọn danh mục cha</label>
                 <select class="form-select " name="parent_id">
                     <?php $__currentLoopData = $categoryNull; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($item->id); ?>" <?php echo e($category->parent_id == $item->id ? 'selected' : 0); ?>>
                             <?php echo e($item->name); ?>

                         </option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                 <?php $__errorArgs = ['parent_id'];
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
                 <label for="title" class="form-label">Thứ tự xuất hiện</label>
                 <input type="text" class="form-control" name="sort_order" value="<?php echo e($category->sort_order); ?>">
                 <?php $__errorArgs = ['sort_order'];
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
                 <label for="title" class="form-label">Danh mục được chọn</label>
                 <select class="form-select" aria-label="Default select example" name="choose">
                     <option value="0"<?php echo e($category->choose == 0 ? 'selected' : ''); ?>>Tắt danh mục được lựa chọn
                     </option>
                     <option value="1"<?php echo e($category->choose == 1 ? 'selected' : ''); ?>>Bật danh mục được lựa chọn
                     </option>
                 </select>
                 <?php $__errorArgs = ['choose'];
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
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="0"<?php echo e($category->status == 0 ? 'selected' : ''); ?>>Tắt</option>
                     <option value="1"<?php echo e($category->status == 1 ? 'selected' : ''); ?>>Bật</option>
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
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái section</label>
                 <select class="form-select" aria-label="Default select example" name="status_section">
                     <option value="0"<?php echo e($category->status_section == 0 ? 'selected' : ''); ?>>Tắt</option>
                     <option value="1"<?php echo e($category->status_section == 1 ? 'selected' : ''); ?>>Bật</option>
                 </select>
                 <?php $__errorArgs = ['status_section'];
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
         </form>
     </div>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/categoryEdit.blade.php ENDPATH**/ ?>