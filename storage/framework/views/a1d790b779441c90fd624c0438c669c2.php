 
 <?php $__env->startSection('title', 'Admin | Hình ảnh banner'); ?>
 <?php $__env->startSection('content'); ?>

     <div class="container-fluid">
         <div class="searchAdmin">
             <form id="filterFormBanner" action="<?php echo e(route('searchBanner')); ?>" method="POST">
                 <?php echo csrf_field(); ?>
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Vị trí banner</label>
                             <select class="form-select  rounded-0" aria-label="Default select example" name="filter_name">
                                 <option value="">Tất cả</option>
                                 <?php $__currentLoopData = $bannerName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($item->id); ?>" <?php echo e($filter_name == $item->id ? 'selected' : ''); ?>>
                                         <?php echo e($item->name); ?>

                                     </option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Trạng thái</label>
                             <select class="form-select  rounded-0" aria-label="Default select example"
                                 name="filter_status">
                                 <option value="">Tất cả</option>
                                 <option value="1">Kích hoạt
                                 </option>
                                 <option value="0">Vô hiệu hóa
                                 </option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc banner hình ảnh
                     </button>
                 </div>
             </form>
         </div>

         <form id="submitFormAdmin">
             <?php echo csrf_field(); ?>
             <div class="buttonProductForm mt-3">
                 <div class="m-0 p-0">
                     <?php if(session('error')): ?>
                         <div id="alert-message" class="alertDanger"><?php echo e(session('error')); ?></div>
                     <?php endif; ?>
                     <?php if(session('success')): ?>
                         <div id="alert-message" class="alertSuccess"><?php echo e(session('success')); ?></div>
                     <?php endif; ?>
                 </div>
                 <div class="">
                     <button type="button" class="btn btnF1">
                         <a href="<?php echo e(route('bannerAdd')); ?>" class="text-decoration-none text-light"><i
                                 class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Thêm hình ảnh</a>
                     </button>
                     <button class="btn btnF2" type="button"
                         onclick="deleteAllBanner('<?php echo e(route('deleteBannerAdmin')); ?>')"><i class="pe-2 fa-solid fa-trash"
                             style="color: #ffffff;"></i>Xóa
                         hình ảnh</button>

                 </div>
             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách hình ảnh</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Tên banner</th>
                             <th class=" py-2">Ảnh desktop</th>
                             <th class=" py-2">Ảnh mobile</th>
                             <th class=" py-2">Trạng thái</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="table-body">
                         <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php if($item->bannerImages->isNotEmpty()): ?>
                                 <tr class="">

                                     <td>
                                         <div class="d-flex justify-content-center align-items-center">
                                             <input type="checkbox" id="cbx_<?php echo e($item->id); ?>" class="hidden-xs-up"
                                                 name="banner_id[]" value="<?php echo e($item->id); ?>">
                                             <label for="cbx_<?php echo e($item->id); ?>" class="cbx"></label>
                                         </div>
                                     </td>
                                     <td>
                                         <p><?php echo e($item->name); ?></p>
                                     </td>

                                     <td style="width:20%;">
                                         <?php $__currentLoopData = $item->bannerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if(!empty($banner->image_desktop)): ?>
                                                 <img src="<?php echo e(asset('img/' . $banner->image_desktop)); ?>" alt=""
                                                     style="width:45%;height:45%; object-fit: cover;">
                                             <?php else: ?>
                                                 <img src="<?php echo e(asset('img/lf.png')); ?>" alt=""
                                                     style="width:45%;height:45%; object-fit: cover;">
                                             <?php endif; ?>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     </td>
                                     <td style="width:20%;">
                                         <?php $__currentLoopData = $item->bannerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if(!empty($banner->image_mobile)): ?>
                                                 <img src="<?php echo e(asset('img/' . $banner->image_mobile)); ?>" alt=""
                                                     style="width:45%;height:45%; object-fit: cover;">
                                             <?php else: ?>
                                                 <img src="<?php echo e(asset('img/lf.png')); ?>" alt=""
                                                     style="width:45%;height:45%; object-fit: cover;">
                                             <?php endif; ?>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     </td>

                                     <td class="">
                                         <div class="form-check form-switch">
                                             <input class="form-check-input" type="checkbox" role="switch"
                                                 data-id="<?php echo e($item->id); ?>" id="flexSwitchCheckChecked"
                                                 <?php echo e($item->status == 1 ? 'checked' : 0); ?>>
                                             <label class="form-check-label"
                                                 for="flexSwitchCheckChecked"><?php echo e($item->status == 1 ? 'Kích hoạt' : 'Vô hiệu hóa'); ?></label>
                                         </div>
                                     </td>
                                     <td class="m-0 p-0">
                                         <div class="actionAdminProduct m-0 py-3">
                                             <a class="btnActionProductAdmin2" href="<?php echo e(route('editBanner', $item->id)); ?>"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Sửa
                                                 banner hình ảnh</a>
                                         </div>
                                     </td>

                                 </tr>
                             <?php endif; ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                 </table>
             </div>
         </form>

         <nav class="navPhanTrang">
             <ul class="pagination">
                 <li></li>
             </ul>
         </nav>
     </div>


 <?php $__env->stopSection(); ?>

 <?php $__env->startSection('bannerAdminScript'); ?>
     <script>
         function deleteAllBanner(url) {
             const selectedBanners = document.querySelectorAll('input[name="banner_id[]"]:checked');
             if (selectedBanners.length === 0) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Cảnh báo!',
                     text: 'Vui lòng chọn ít nhất một hình ảnh để xóa.',
                     confirmButtonText: 'Đồng ý',
                     width: '400px',
                     confirmButtonColor: "#3085d6",
                 });
                 return;
             }
             Swal.fire({
                 title: "Bạn có chắc chắn muốn xóa hình ảnh không?",
                 icon: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#3085d6",
                 cancelButtonColor: "#d33",
                 confirmButtonText: "Tôi đồng ý!",
                 cancelButtonText: "không!",
                 customClass: {
                     title: 'custom-title-h1' // Thêm lớp tùy chỉnh cho tiêu đề
                 }
             }).then((result) => {
                 if (result.isConfirmed) {
                     submitForm(url, 'post');
                 }
             });
         }
     </script>
     <script>
         $(document).ready(function() {
             $('.form-check-input').on('click', function() {
                 // (this) tham chiếu đến phần tử html đó
                 var banner_id = $(this).data(
                     'id'); //lấy ra id danh mục thông qua data-id=" item->id "
                 var status = $(this).is(':checked') ? 1 : 0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateBannerStatus(banner_id, status, label);
             });
         })

         function updateBannerStatus(banner_id, status, label) {
             $.ajax({
                 url: '<?php echo e(route('bannerUpdateStatus', ':id')); ?>'.replace(':id', banner_id),
                 type: 'PUT',
                 data: {
                     '_token': '<?php echo e(csrf_token()); ?>', //Việc gửi mã token này cùng với mỗi request giúp xác thực rằng request đó được gửi từ ứng dụng của bạn, chứ không phải từ một nguồn khác.
                     'status': status
                 },
                 success: function(response) {
                     console.log('Cập nhật trạng thái thành công');

                     if (status == 1) {
                         label.text('Kích hoạt');
                     } else {
                         label.text('Vô hiệu hóa');
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Lỗi khi cập nhật trạng thái sản phẩm: ' + error);
                 }
             })
         }
     </script>
     <script>
         $(document).ready(function() {
             $('#filterFormBanner').on('submit', function() {
                 var formData = $(this).serialize();

                 $.ajax({
                     url: '<?php echo e(route('searchBanner')); ?>',
                     type: 'GET',
                     data: formData,
                     success: function(response) {
                         $('.table-body').html(response.html);
                     },
                     error: function(error) {
                         console.error('Lỗi khi lọc' + error);
                     }
                 })
             })
         })
     </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/banner.blade.php ENDPATH**/ ?>