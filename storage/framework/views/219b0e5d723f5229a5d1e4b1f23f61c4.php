 <div>
     <div class="form-container">
         <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>
             <?php if($isEdit): ?>
                 <?php echo method_field('PUT'); ?>
             <?php endif; ?>
             <div class="mt-3">
                 <button type="submit" class="btn-save btn-submit"><?php echo e($buttonText); ?></button>
             </div>
             <div class="row my-3">
                 <div class="col-md-6">
                     <div class="mb-3">
                         <label for="title" class="form-label">Title</label>
                         <input type="text" class="form-control" id="title" name="title"
                             value="<?php echo e(old('title', $banner->title ?? '')); ?>">
                     </div>
                     <div class="mb-3">
                         <label for="href" class="form-label">Href</label>
                         <input type="text" class="form-control" id="href" name="href"
                             value="<?php echo e(old('href', $banner->href ?? '')); ?>">
                     </div>

                     <div class="mb-3">
                         <label for="button" class="form-label">Button</label>
                         <input type="text" class="form-control" id="button" name="button"
                             value="<?php echo e(old('button', $banner->button ?? '')); ?>">
                     </div>

                     <div class="row">
                         <div class="col-md-6 col-6">
                             <div class="mb-3" style="display: flex;align-items: center;">
                                 <div id="holder_desktop" style="margin-top:15px;max-height:100px;">
                                     <label for="image_desktop" class="form-label">Image Desktop</label>
                                     <?php if($isEdit && $banner->image_desktop): ?>
                                         <img src="<?php echo e(asset($banner->image_desktop)); ?>" alt="Desktop Image"
                                             class="preview_img"
                                             style="height: 100px; object-fit: contain; width: 100px;border-radius: 10px;">
                                     <?php else: ?>
                                         <img id="preview_desktop" src=""
                                             style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                                     <?php endif; ?>
                                 </div>
                                 <div class="input-group" style="justify-content: flex-start;row-gap: 5px;">
                                     <input id="image_desktop" class="form-control" type="hidden" name="image_desktop"
                                         value="<?php echo e(old('image_desktop', $banner->image_desktop ?? '')); ?>">
                                     <span class="input-group-btn">
                                         <button class="btn btn-primary lfm" type="button" data-input="image_desktop"
                                             data-preview="preview_desktop">
                                             <i class="fa fa-picture-o"></i> Chọn ảnh
                                         </button>
                                     </span>
                                     <span class="input-group-btn">
                                         <button class="btn btn-danger btn-clear-image" type="button"
                                             data-input="image_desktop" data-preview="preview_desktop">
                                             <i class="fa fa-times"></i> Xóa
                                         </button>
                                     </span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6 col-6">
                             <div class="mb-3" style="display: flex;align-items: center;">
                                 <div id="holder_mobile" style="margin-top:15px;max-height:100px;">
                                     <label for="image_mobile" class="form-label">Image Mobile</label>
                                     <?php if($isEdit && $banner->image_mobile): ?>
                                         <img src="<?php echo e(asset($banner->image_mobile)); ?>" alt="Mobile Image"
                                             class="preview_img"
                                             style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                                     <?php else: ?>
                                         <img id="preview_mobile" src=""
                                             style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                                     <?php endif; ?>
                                 </div>
                                 <div class="input-group" style="justify-content: flex-start;row-gap: 5px;">
                                     <input id="image_mobile" class="form-control" type="hidden" name="image_mobile"
                                         value="<?php echo e(old('image_mobile', $banner->image_mobile ?? '')); ?>">
                                     <span class="input-group-btn">
                                         <button class="btn btn-primary lfm" type="button" data-input="image_mobile"
                                             data-preview="preview_mobile">
                                             <i class="fa fa-picture-o"></i> Chọn ảnh
                                         </button>
                                     </span>
                                     <span class="input-group-btn">
                                         <button class="btn btn-danger btn-clear-image" type="button"
                                             data-input="image_mobile" data-preview="preview_mobile">
                                             <i class="fa fa-times"></i> Xóa
                                         </button>
                                     </span>
                                 </div>

                             </div>
                         </div>
                     </div>

                 </div>

                 <div class="col-md-6">
                     <div class="mb-3 description-item">
                         <label for="description" class="form-label">Description</label>
                         <textarea class="form-control " id="description" name="description" rows="4"><?php echo e(old('description', $banner->description ?? '')); ?></textarea>
                     </div>

                     <div class="mb-3 description-item">
                         <label for="description2" class="form-label">Description 2</label>
                         <textarea class="form-control " id="description2" name="description2" rows="4"><?php echo e(old('description2', $banner->description2 ?? '')); ?></textarea>
                     </div>

                     <div class="mb-3 description-item">
                         <label for="description3" class="form-label">Description 3</label>
                         <textarea class="form-control " id="description3" name="description3" rows="4"><?php echo e(old('description3', $banner->description3 ?? '')); ?></textarea>
                     </div>
                     <div class="mb-3 description-item">
                         <label for="description4" class="form-label">Description 4</label>
                         <textarea class="form-control " id="description4" name="description4" rows="4"><?php echo e(old('description4', $banner->description4 ?? '')); ?></textarea>
                     </div>

                     <div class="mb-3 description-item">
                         <label for="description5" class="form-label">Description 5</label>
                         <textarea class="form-control " id="description5" name="description5" rows="4"><?php echo e(old('description5', $banner->description5 ?? '')); ?></textarea>
                     </div>

                     <!-- Nút Show More -->
                     <div class="mb-3">
                         <button type="button" id="toggleDescriptions" class="btn-edit">Show more
                             description...</button>
                     </div>

                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12">
                     <h4>Sub Banners</h4>
                     <div id="subbanners-container">
                         <?php if($isEdit && $banner->subBanners): ?>
                             <?php $__currentLoopData = $banner->subBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <div class="card mb-2 p-3">
                                     <div class="row">
                                         <div class="col-md-6">

                                             <input type="text" name="sub_banners[<?php echo e($i); ?>][title]"
                                                 class="form-control mb-2" placeholder="SubBanner Title"
                                                 value="<?php echo e(old('sub_banners.' . $i . '.title', $sub->title)); ?>">
                                             <input type="text"
                                                 name="sub_banners[<?php echo e($i); ?>][description]"
                                                 class="form-control mb-2" placeholder="Description"
                                                 value="<?php echo e(old('sub_banners.' . $i . '.description', $sub->description)); ?>">
                                             <input type="text" name="sub_banners[<?php echo e($i); ?>][href]"
                                                 class="form-control mb-2" placeholder="Href"
                                                 value="<?php echo e(old('sub_banners.' . $i . '.href', $sub->href)); ?>">
                                             <input type="text" name="sub_banners[<?php echo e($i); ?>][button]"
                                                 class="form-control mb-2" placeholder="Button"
                                                 value="<?php echo e(old('sub_banners.' . $i . '.button', $sub->button)); ?>">
                                         </div>

                                         <div class="col-md-2">
                                             <div style="display: flex;flex-direction: column;row-gap: 8px;">
                                                 <?php if($sub->image_desktop): ?>
                                                     <img src="<?php echo e(asset($sub->image_desktop)); ?>" alt="Desktop Image"
                                                         class="preview_img" class="preview-img"
                                                         style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                                                 <?php else: ?>
                                                     <img id="sub_preview_desktop_<?php echo e($i); ?>" src=""
                                                         style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                                                 <?php endif; ?>

                                                 <div class="input-group"
                                                     style="justify-content: flex-start;row-gap: 5px;">
                                                     <input id="sub_image_desktop_<?php echo e($i); ?>"
                                                         class="form-control mb-2" type="hidden"
                                                         name="sub_banners[<?php echo e($i); ?>][image_desktop]"
                                                         placeholder="Image Desktop URL"
                                                         value="<?php echo e(old('sub_banners.' . $i . '.image_desktop', $sub->image_desktop)); ?>">
                                                     <span class="input-group-btn">
                                                         <button type="button"
                                                             data-input="sub_image_desktop_<?php echo e($i); ?>"
                                                             data-preview="sub_preview_desktop_<?php echo e($i); ?>"
                                                             class="btn btn-primary lfm">
                                                             <i class="fa fa-picture-o"></i> Choose
                                                         </button>
                                                     </span>
                                                     <span class="input-group-btn ms-2">
                                                         <button class="btn btn-danger btn-clear-image" type="button"
                                                             data-input="sub_image_desktop_<?php echo e($i); ?>"
                                                             data-preview="sub_preview_desktop_<?php echo e($i); ?>">
                                                             <i class="fa fa-times"></i> Xóa
                                                         </button>
                                                     </span>

                                                 </div>
                                             </div>
                                         </div>

                                         <div class="col-md-2">
                                             <div style="display: flex;flex-direction: column;row-gap: 8px;">

                                                 <?php if($sub->image_mobile): ?>
                                                     <img src="<?php echo e(asset($sub->image_mobile)); ?>" alt="mobile Image"
                                                         class="preview_img" class="preview-img"
                                                         style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                                                 <?php else: ?>
                                                     <img id="sub_preview_mobile_<?php echo e($i); ?>" src=""
                                                         style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                                                 <?php endif; ?>
                                                 <div class="input-group"
                                                     style="justify-content: flex-start;row-gap: 5px;">
                                                     <input id="sub_image_mobile_<?php echo e($i); ?>"
                                                         class="form-control mb-2" type="hidden"
                                                         name="sub_banners[<?php echo e($i); ?>][image_mobile]"
                                                         placeholder="Image Mobile URL"
                                                         value="<?php echo e(old('sub_banners.' . $i . '.image_mobile', $sub->image_mobile)); ?>">
                                                     <span class="input-group-btn">
                                                         <button type="button"
                                                             data-input="sub_image_mobile_<?php echo e($i); ?>"
                                                             data-preview="sub_preview_mobile_<?php echo e($i); ?>"
                                                             class="btn btn-primary lfm">
                                                             <i class="fa fa-picture-o"></i> Choose
                                                         </button>
                                                     </span>
                                                     <span class="input-group-btn ms-2">
                                                         <button class="btn btn-danger btn-clear-image" type="button"
                                                             data-input="sub_image_mobile_<?php echo e($i); ?>"
                                                             data-preview="sub_preview_mobile_<?php echo e($i); ?>">
                                                             <i class="fa fa-times"></i> Xóa
                                                         </button>
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-1">
                                             <button type="button" class="btn btn-danger"
                                                 onclick="this.closest('.card').remove()">X</button>
                                         </div>
                                     </div>
                                 </div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                     </div>
                 </div>
             </div>
         </form>
         <button type="button" class="btn-add mb-3" onclick="addSubBanner()">Add SubBanner</button>
     </div>
     <script>
         function addSubBanner() {
             let index = Date.now(); // unique index
             let html = `
    <div class="card mb-2 p-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="sub_banners[${index}][title]" class="form-control mb-2" placeholder="SubBanner Title">

                <input type="text" name="sub_banners[${index}][description]" class="form-control mb-2" placeholder="Description">

                <input type="text" name="sub_banners[${index}][href]" class="form-control mb-2" placeholder="Href">

                <input type="text" name="sub_banners[${index}][button]" class="form-control mb-2" placeholder="Button">
            </div>

            <div class="col-md-2">
                <div style="display: flex;flex-direction: column;row-gap: 8px;">
                    <img id="sub_preview_desktop_${index}" src="" style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                    <div class="input-group" style="justify-content: flex-start;row-gap: 5px;">
                        <input id="sub_image_desktop_${index}" class="form-control mb-2" type="hidden"
                            name="sub_banners[${index}][image_desktop]" placeholder="Image Desktop URL">
                        <span class="input-group-btn">
                            <button type="button" data-input="sub_image_desktop_${index}" data-preview="sub_preview_desktop_${index}" class="btn btn-primary lfm">
                                <i class="fa fa-picture-o"></i> Choose
                            </button>
                        </span>
                        <span class="input-group-btn ms-2">
                            <button type="button" data-input="sub_image_desktop_${index}" data-preview="sub_preview_desktop_${index}" class="btn btn-danger btn-clear-image">
                                <i class="fa fa-times"></i> Xóa
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div style="display: flex;flex-direction: column;row-gap: 8px;">
                    <img id="sub_preview_mobile_${index}" src="" style="height: 100px;object-fit: contain; width: 100px;border-radius: 10px;">
                    <div class="input-group" style="justify-content: flex-start;row-gap: 5px;">
                        <input id="sub_image_mobile_${index}" class="form-control mb-2" type="hidden"
                            name="sub_banners[${index}][image_mobile]" placeholder="Image Mobile URL">
                        <span class="input-group-btn">
                            <button type="button" data-input="sub_image_mobile_${index}" data-preview="sub_preview_mobile_${index}" class="btn btn-primary lfm">
                                <i class="fa fa-picture-o"></i> Choose
                            </button>
                        </span>
                        <span class="input-group-btn ms-2">
                            <button type="button" data-input="sub_image_mobile_${index}" data-preview="sub_preview_mobile_${index}" class="btn btn-danger btn-clear-image">
                                <i class="fa fa-times"></i> Xóa
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="this.closest('.card').remove()">X</button>
            </div>
        </div>
    </div>`;

             $('#subbanners-container').append(html);

             initFileManager('.lfm'); // Khởi tạo cho các button mới thêm vào DOM
         }
     </script>
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             const editors = ['#description', '#description2', '#description3', '#description4', '#description5'];

             editors.forEach(selector => {
                 const element = document.querySelector(selector);
                 if (element) {
                     ClassicEditor
                         .create(element)
                         .catch(error => {
                             console.error(error);
                         });
                 }
             });
         });
     </script>
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             const descriptions = document.querySelectorAll('.description-item');
             const toggleBtn = document.getElementById('toggleDescriptions');

             // Hiển thị 2 description đầu tiên
             descriptions.forEach((desc, index) => {
                 if (index < 1) {
                     desc.classList.add('visible');
                 }
             });

             let expanded = false;

             toggleBtn.addEventListener('click', function() {
                 expanded = !expanded;

                 descriptions.forEach((desc, index) => {
                     if (index >= 1) {
                         if (expanded) {
                             desc.classList.add('visible');
                         } else {
                             desc.classList.remove('visible');
                         }
                     }
                 });

                 toggleBtn.textContent = expanded ? 'Thu gọn' : 'Show more description...';
             });
         });
     </script>


 </div>
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/banners/_form.blade.php ENDPATH**/ ?>