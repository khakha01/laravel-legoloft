 
 <?php $__env->startSection('title', 'Admin | Mã giảm giá'); ?>
 <?php $__env->startSection('content'); ?>

     <div class="container-fluid">

         <div class="searchAdmin">
             <form id="filterFormCoupon" action="<?php echo e(route('searchCoupon')); ?>" method="post">
                 <?php echo csrf_field(); ?>
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Tên mã giảm giá</label>
                             <input class="form-control rounded-0" name="filter_name" placeholder="Tên mã giảm giá"
                                 type="text" value="<?php echo e($filter_name ?? ''); ?>">
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc theo mã code</label>
                             <input class="form-control rounded-0" name="filter_code" placeholder="Mã code" type="number"
                                 value="<?php echo e($filter_code ?? ''); ?>">
                         </div>
                     </div>
                     <div class="col-sm-3">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc loại giảm giá</label>
                             <select class="form-select  rounded-0" aria-label="Default select example" name="filter_type">
                                 <option value="">Tất cả</option>
                                 <option value="0" <?php echo e($filter_type == 0 ? 'selected' : ''); ?>>Giảm theo %
                                 </option>
                                 <option value="1"<?php echo e($filter_type == 1 ? 'selected' : ''); ?>>Giảm theo số tiền
                                 </option>
                             </select>
                         </div>
                     </div>
                     <div class="col-sm-3">
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
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc mã giảm giá</button>
                 </div>
             </form>
         </div>
         <form id="submitFormAdmin" onsubmit="event.preventDefault();">
             <?php echo csrf_field(); ?>
             <div class="buttonProductForm mt-3">
                 <div class="">
                     <?php if(session('error')): ?>
                         <div id="alert-message" class="alertDanger"><?php echo e(session('error')); ?></div>
                     <?php endif; ?>
                     <?php if(session('success')): ?>
                         <div id="alert-message" class="alertSuccess"><?php echo e(session('success')); ?></div>
                     <?php endif; ?>
                 </div>
                 <div class="">
                     <button class="btn btnF1">
                         <a href="<?php echo e(route('couponAdd')); ?>" class="text-decoration-none text-light"><i
                                 class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo mới mã giảm</a>
                     </button>
                     <button class="btn btnF2" type="button"
                         onclick="deleteAllCoupon('<?php echo e(route('deleteCouponAdmin')); ?>')"><i class="pe-2 fa-solid fa-trash"
                             style="color: #ffffff;"></i>Xóa
                         mã giảm</button>
                 </div>

             </div>
             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Mã Giảm Giá</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class="header__item py-2">Tên phiếu giảm giá</th>
                             <th class="header__item py-2">Mã</th>
                             <th class="header__item py-2">Loại giảm giá</th>
                             <th class="header__item py-2">Tổng giảm</th>
                             <th class="header__item py-2">Thời hạn</th>
                             <th class="header__item py-2">Trạng thái</th>
                             <th class="header__item py-2">Hành động</th>
                         </tr>

                     </thead>
                     <tbody class="table-body">
                         <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php
                                 $currentNow = now();
                             ?>
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_<?php echo e($item->id); ?>" class="hidden-xs-up"
                                             name="coupon_id[]" value="<?php echo e($item->id); ?>">
                                         <label for="cbx_<?php echo e($item->id); ?>" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td class="nameAdmin">
                                     <p><?php echo e($item->name_coupon); ?></p>
                                 </td>
                                 <td class=""><?php echo e($item->code); ?></td>
                                 <td><?php echo e($item->type == 0 ? 'Phần trăm' : 'Tiền mặt'); ?></td>
                                 <td class="">
                                     <?php echo e(number_format($item->total, 0, ',') . 'đ'); ?>

                                 </td>
                                 <td>
                                     <?php if($currentNow->lt($item->date_start) || $currentNow->gt($item->date_end)): ?>
                                         <span class="ExpireCoupon">Hết hiệu lực</span>
                                     <?php else: ?>
                                         <span class="stillValidCoupon">Còn hiệu lực</span>
                                     <?php endif; ?>
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
                                         <button class="btnActionProductAdmin2"><a
                                                 href="<?php echo e(route('editCoupon', $item->id)); ?>"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Sửa lại
                                                 mã giảm</a></button>
                                     </div>
                                 </td>
                             </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                 </table>
                 <nav class="navPhanTrang">
                     <?php echo e($coupons->links()); ?>

                 </nav>
             </div>
         </form>


     </div>

 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('couponAdminScript'); ?>
     <script>
         function deleteAllCoupon(url) {
             const selectedCoupons = document.querySelectorAll('input[name="coupon_id[]"]:checked');
             if (selectedCoupons.length === 0) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Cảnh báo!',
                     text: 'Vui lòng chọn ít nhất một phiếu giảm giá để xóa.',
                     confirmButtonText: 'Đồng ý',
                     width: '400px',
                     confirmButtonColor: "#3085d6"

                 });
                 return;
             }
             Swal.fire({
                 title: "Bạn có chắc chắn muốn xóa phiếu giảm giá không?",
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
                 var coupon_id = $(this).data(
                     'id'); //lấy ra id danh mục thông qua data-id="item->id"
                 var status = $(this).is(':checked') ? 1 : 0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateCouponStatus(coupon_id, status, label);
             });

         })

         function updateCouponStatus(coupon_id, status, label) {
             $.ajax({
                 url: '<?php echo e(route('couponUpdateStatus', ':id')); ?>'.replace(':id', coupon_id),
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
             $('#filterFormCoupon').on('submit', function() {
                 var formData = $(this).serialize();

                 $.ajax({
                     url: '<?php echo e(route('searchCoupon')); ?>',
                     type: 'POST',
                     data: formData,
                     success: function(response) {
                         $('.table-body').html(response.html);
                     },
                     error: function(error) {
                         console.error('Lỗi khi lọc: ' + error);
                     }
                 });

             })
         })
     </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/coupon.blade.php ENDPATH**/ ?>