 
 <?php $__env->startSection('title', 'Admin | Danh mục'); ?>
 <?php $__env->startSection('content'); ?>

     <div class="container-fluid">

         <div class="searchAdmin">
             <form id="filterFormCategory" action="<?php echo e(route('searchCategory')); ?>" method="POST">
                 <?php echo csrf_field(); ?>
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Tên danh mục</label>
                             <input class="form-control rounded-0" name="filter_name" placeholder="Tên danh mục"
                                 type="text" value="<?php echo e($filter_name ?? ''); ?>">
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Danh mục cha</label>
                             <select class="form-select  rounded-0" aria-label="Default select example"
                                 name="filter_category_id">
                                 <option value="">Tất cả</option>
                                 <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($item->id); ?>"
                                         <?php echo e($item->id == $filter_category_id ? 'selected' : ''); ?>><?php echo e($item->name); ?>

                                     </option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                         </div>
                     </div>


                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc danh
                         mục</button>
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
                 <div class="m-0 p-0">

                     <button type="button" class="btn btnF1">
                         <a href="<?php echo e(route('categoryAdd')); ?>" class="text-decoration-none text-light"><i
                                 class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo danh mục</a>
                     </button>
                     <button type="button" class="btn btnF2" onclick="deleteAllCategory('<?php echo e(route('deleteCategory')); ?>')">
                         <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa danh mục
                     </button>
                 </div>
             </div>
             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Danh Mục</h4>

                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Hình ảnh</th>
                             <th class=" py-2">Tên danh mục</th>
                             <th class=" py-2">Thứ tự</th>
                             <th class=" py-2">Trạng thái</th>
                             <th class=" py-2">Trạng thái section</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="table-body">

                         <?php $__currentLoopData = $categoriAdmin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_<?php echo e($category->id); ?>" class="hidden-xs-up"
                                             name="category_id[]" value="<?php echo e($category->id); ?>">
                                         <label for="cbx_<?php echo e($category->id); ?>" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td class="">
                                     <img src="<?php echo e(asset('img/lf.png')); ?>" alt=""
                                         style="width: 80px; height: 80px; object-fit: contain;">
                                 </td>
                                 <td class="nameAdmin">
                                     <p><?php echo e($category->name); ?> (danh mục cha)</p>
                                 </td>
                                 <td class=""></td>
                                 <td class=""></td>
                                 <td></td>
                                 <td class="">
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button class="btnActionProductAdmin2"><a
                                                 href="<?php echo e(route('editCategory', $category->id)); ?>"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Sửa lại danh mục</a></button>
                                     </div>
                                 </td>
                             </tr>

                             <!-- Lặp qua các danh mục con -->
                             <?php $__currentLoopData = $category->categories_children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr class="">
                                     <td>
                                         <div class="d-flex justify-content-center align-items-center">
                                             <input type="checkbox" id="cbx_<?php echo e($childCategory->id); ?>" class="hidden-xs-up"
                                                 name="category_id[]" value="<?php echo e($childCategory->id); ?>">
                                             <label for="cbx_<?php echo e($childCategory->id); ?>" class="cbx"></label>
                                         </div>
                                     </td>
                                     <td class="">
                                         <img src="<?php echo e(asset('img/' . $childCategory->image)); ?>" alt=""
                                             style="width: 80px; height: 80px; object-fit: contain;">
                                     </td>
                                     <td class="nameAdmin">
                                         <p><?php echo e($category->name); ?> > <?php echo e($childCategory->name); ?></p>
                                         <!-- Hiển thị danh mục cha > danh mục con -->
                                     </td>
                                     <td class=""></td>
                                     <td class="">
                                         <div class="form-check form-switch">
                                             <input class="form-check-input" type="checkbox" role="switch"
                                                 data-id="<?php echo e($childCategory->id); ?>" id="flexSwitchCheckChecked"
                                                 <?php echo e($childCategory->status == 1 ? 'checked' : 0); ?>>
                                             <label class="form-check-label"
                                                 for="flexSwitchCheckChecked"><?php echo e($childCategory->status == 1 ? 'Bật' : 'Tắt'); ?></label>
                                         </div>
                                     </td>
                                     <td class="">
                                         <div class="form-check">
                                             <label class="switch_status_section pe-3">
                                                 <input type="checkbox" class="form-check-input-status-section"
                                                     data-id="<?php echo e($childCategory->id); ?>"
                                                     <?php echo e($childCategory->status_section == 1 ? 'checked' : 0); ?>>
                                                 <span class="slider_status_section"></span>
                                             </label>
                                             <?php echo e($childCategory->status_section == 1 ? 'Bật' : 'Tắt'); ?>

                                         </div>
                                     </td>
                                     <td class="">
                                         <div class="actionAdminProduct m-0 py-3">
                                             <button class="btnActionProductAdmin2"><a
                                                     href="<?php echo e(route('editCategory', $childCategory->id)); ?>"
                                                     class="text-decoration-none text-light"><i
                                                         class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Sửa lại
                                                     danh mục</a></button>
                                         </div>
                                     </td>
                                 </tr>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                     </tbody>
                 </table>
             </div>
         </form>

         <div class="div_nav_pagination">
             <nav class="nav_pagination">
                 <?php echo e($categoriAdmin->links()); ?>

             </nav>
         </div>

     </div>

 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('categoryAdminScript'); ?>
     <script>
         function deleteAllCategory(url) {
             const selectedCategories = document.querySelectorAll('input[name="category_id[]"]:checked');
             if (selectedCategories.length === 0) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Cảnh báo!',
                     text: 'Vui lòng chọn ít nhất một danh mục để xóa.',
                     confirmButtonText: 'Đồng ý',
                     width: '400px',
                     confirmButtonColor: "#3085d6",
                 });
                 return;
             }
             Swal.fire({
                 title: "Bạn có chắc chắn muốn xóa danh mục không?",
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
                 var category_id = $(this).data('id'); //lấy ra id danh mục thông qua data-id="item->id"
                 var status = $(this).is(':checked') ? 1 : 0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateEmployeeStatus(category_id, status, label);
             })
         })

         function updateEmployeeStatus(category_id, status, label) {
             $.ajax({
                 url: '<?php echo e(route('categoryUpdateStatus', ':id')); ?>'.replace(':id', category_id),
                 type: 'PUT',
                 data: {
                     '_token': '<?php echo e(csrf_token()); ?>', //Việc gửi mã token này cùng với mỗi request giúp xác thực rằng request đó được gửi từ ứng dụng của bạn, chứ không phải từ một nguồn khác.
                     'status': status
                 },
                 success: function(response) {
                     if (response.success) {
                         label.text(status == 1 ? 'Bật' : 'Tắt');
                     }
                 },
                 error: function(error) {
                     console.error('Lỗi khi cập nhật trạng thái danh mục: ' + error);
                 }
             })
         }
     </script>
     <script>
         $(document).ready(function() {
             $('.form-check-input-status-section').on('click', function() {
                 // (this) tham chiếu đến phần tử html đó
                 var category_id = $(this).data('id'); //lấy ra id danh mục thông qua data-id="item->id"
                 var status_section = $(this).is(':checked') ? 1 :
                     0; //is() trả về true nếu phần tử khớp với bộ chọn
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateEmployeeStatusSection(category_id, status_section, label);
             })
         })

         function updateEmployeeStatusSection(category_id, status_section, label) {
             $.ajax({
                 url: '<?php echo e(route('updateStatusSectionCategory', ':id')); ?>'.replace(':id', category_id),
                 type: 'PUT',
                 data: {
                     '_token': '<?php echo e(csrf_token()); ?>', //Việc gửi mã token này cùng với mỗi request giúp xác thực rằng request đó được gửi từ ứng dụng của bạn, chứ không phải từ một nguồn khác.
                     'status_section': status_section
                 },
                 success: function(response) {
                     if (response.success) {
                         label.text(status_section == 1 ? 'Bật' : 'Tắt');
                     }
                 },
                 error: function(error) {
                     console.error('Lỗi khi cập nhật trạng thái : ' + error);
                 }
             })
         }
     </script>
     <script>
         $(document).ready(function() {
             $('#filterFormCategory').on('submit', function() {
                 var formData = $(this).serialize();
                 //serialize: duyệt qua tất cả các phần tử đầu vào, chọn các phần tử input, select, và textarea trong biểu mẫu (form), và thu thập các giá trị của chúng.

                 $.ajax({
                     url: '<?php echo e(route('searchCategory')); ?>',
                     type: 'POST',
                     data: formData,
                     success: function(response) {
                         // Cập nhật bảng danh mục với kết quả lọc
                         $('.table-body').html(response.html);
                     },
                     error: function(error) {
                         console.error('Lỗi khi lọc danh mục' + error);
                     }
                 })
             })
         })
     </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/category.blade.php ENDPATH**/ ?>