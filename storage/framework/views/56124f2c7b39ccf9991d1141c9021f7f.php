<?php $__env->startSection('title', 'Admin | Hình ảnh banner'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div style="display: flex;justify-content: space-between;padding: 55px 0 0 0;">
            <h1 class="mb-4">Banner List</h1>
            <div style="display: flex;justify-content: flex-end;align-items: center;column-gap: 5px;">
                <a href="<?php echo e(route('banners.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create New Banner
                </a>
                <button type="button" class="btn btn-danger" onclick="deleteSelectedBanners()">
                    <i class="fa fa-trash"></i> Delete All
                </button>
            </div>
        </div>

        <form>
            <?php echo csrf_field(); ?>
            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>List Banners</h4>
                <table class="table table-bordered pt-3">
                    <thead>
                        <tr>

                            <th scope="col">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Image Sub</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="<?php echo e($banner->id); ?>" class="select-item">
                                </td>
                                <td><?php echo e($banner->id); ?></td>
                                <td><?php echo e($banner->title ?? 'N/A'); ?></td>
                                <td>
                                    <?php if($banner->image_desktop): ?>
                                        <img src="<?php echo e(asset($banner->image_desktop)); ?>" alt="Desktop Image"
                                            class="img-fluid rounded" style="max-height: 80px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="text-muted">No Image</span>
                                    <?php endif; ?>

                                    <?php if($banner->image_mobile): ?>
                                        <img src="<?php echo e(asset($banner->image_mobile)); ?>" alt="Mobile Image"
                                            class="img-fluid rounded" style="max-height: 80px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="text-muted">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="banner_td_list_sub">
                                        <?php $__currentLoopData = $banner->subBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subBanner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($subBanner->image_desktop): ?>
                                                <img src="<?php echo e(asset($subBanner->image_desktop)); ?>" alt="Desktop Image"
                                                    class="img-fluid rounded"
                                                    style="height: 100px; object-fit: contain; width: 100px;">
                                            <?php else: ?>
                                                <span class="text-muted">No Image</span>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php $__currentLoopData = $banner->subBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subBanner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($subBanner->image_mobile): ?>
                                                <img src="<?php echo e(asset($subBanner->image_mobile)); ?>" alt="Desktop Image"
                                                    class="img-fluid rounded"
                                                    style="height: 100px; object-fit: contain; width: 100px;">
                                            <?php else: ?>
                                                <span class="text-muted">No Image</span>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?php echo e(route('banners.edit', $banner)); ?>"
                                            class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger"
                                            onclick="deleteBanner(<?php echo e($banner->id); ?>)">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No banners found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
    </div>

    </form>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.select-item');

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
            });
        });
    </script>
    <script>
        function deleteBanner(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: '/admin/banners/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(result) {
                        // Reload trang hoặc xóa row khỏi table
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to delete');
                        console.log(error);
                    }
                });
            }
        }
    </script>

    <script>
        function deleteSelectedBanners() {
            if (confirm('Are you sure you want to delete selected banners?')) {
                // Lấy danh sách id đã check
                var ids = [];
                $('input[name="ids[]"]:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    alert('No banners selected');
                    return;
                }

                $.ajax({
                    url: '<?php echo e(route('banners.destroySelected')); ?>',
                    type: 'POST',
                    data: {
                        ids: ids
                    },
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        // Reload hoặc xóa từng row đã xóa khỏi table
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Failed to delete selected banners');
                        console.log(xhr.responseText);
                    }
                });
            }
        }
    </script>
    <style>

    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/banners/index.blade.php ENDPATH**/ ?>