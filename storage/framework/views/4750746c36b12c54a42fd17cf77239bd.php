<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('css/minified/admin.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/adminstyle.min.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


</head>

<body>
    <div>
        <?php echo $__env->make('admin.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('admin.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

    <script>
        document.getElementById('drop2').addEventListener('click', function(e) {
            var dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let isFormDirty = false; // Cờ để kiểm tra dữ liệu có thay đổi

            // Đánh dấu form khi có thay đổi
            document.querySelectorAll("input, textarea").forEach((element) => {
                element.addEventListener("input", () => {
                    isFormDirty = true; // Đánh dấu dữ liệu đã thay đổi
                });
            });

            // Ngăn rời khỏi trang bằng nút quay lại
            window.history.pushState(null, "", window.location.href);
            window.addEventListener("popstate", function(event) {
                if (isFormDirty) {
                    event.preventDefault();
                    showWarning(() => window.history.back());
                }
            });
            // Xử lý sự kiện khi người dùng nhấn nút "Quay lại"
            document.querySelector("#back-link").addEventListener("click", function(event) {
                if (isFormDirty) {
                    event.preventDefault(); // Ngăn chuyển hướng mặc định
                    showWarning(() => {
                        window.location.href = this.href; // Chuyển hướng sau khi xác nhận
                    });
                }
            });

            // Ngăn reload với beforeunload
            // window.addEventListener("beforeunload", function (event) {
            //     if (isFormDirty) {
            //         event.preventDefault();
            //         event.returnValue = ""; // Hiển thị cảnh báo mặc định của trình duyệt
            //     }
            // });

            // Hàm hiển thị cảnh báo với SweetAlert
            function showWarning(confirmCallback) {
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Dữ liệu chưa được lưu sẽ bị mất nếu bạn rời khỏi trang.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Rời đi",
                    cancelButtonText: "Ở lại",
                }).then((result) => {
                    if (result.isConfirmed) {
                        confirmCallback();
                    }
                });
            }
        });
    </script>


    

    <script>
        var jq = jQuery.noConflict();
        jq(document).ready(function() {
            jq(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 3,
                    },
                    1000: {
                        items: 4,
                    },
                },
            });
        });
    </script>
    <script src="<?php echo e(asset('chartJS/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sidebarmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/simplebar/dist/simplebar.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
    <script src="<?php echo e(asset('js/api63.js')); ?> "></script>
    <script src="<?php echo e(asset('ckeditor/ckeditor.js')); ?>"></script>


    <script>
        function submitForm(action, method) {
            var form = document.getElementById('submitFormAdmin');
            form.action = action;
            form.method = method;
            form.submit();
        }
    </script>



    <?php echo $__env->yieldContent('administrationScript'); ?>
    <?php echo $__env->yieldContent('productAdminScript'); ?>
    <?php echo $__env->yieldContent('productAddAdminScript'); ?>
    <?php echo $__env->yieldContent('productEditAdminScript'); ?>
    <?php echo $__env->yieldContent('categoryArticleAdminScript'); ?>
    <?php echo $__env->yieldContent('articleAdminScript'); ?>
    <?php echo $__env->yieldContent('userAdminScript'); ?>
    <?php echo $__env->yieldContent('employeeAdminScript'); ?>
    <?php echo $__env->yieldContent('categoryAdminScript'); ?>
    <?php echo $__env->yieldContent('favouriteAdminScript'); ?>
    <?php echo $__env->yieldContent('commentAdminScript'); ?>
    <?php echo $__env->yieldContent('couponAdminScript'); ?>
    <?php echo $__env->yieldContent('contactAdminScript'); ?>
    <?php echo $__env->yieldContent('dashboardAdminScript'); ?>
    <?php echo $__env->yieldContent('bannerManageAdminScript'); ?>
    <?php echo $__env->yieldContent('bannerAdminScript'); ?>
    <?php echo $__env->yieldContent('addBannerAdminScript'); ?>
    <?php echo $__env->yieldContent('AssemblyPackagesAdminScript'); ?>
    <?php echo $__env->yieldContent('cartAdminScript'); ?>
    <?php echo $__env->yieldContent('assemblyAdminScript'); ?>


    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


    <script>
        function initFileManager(selector, type = 'image') {
            $(selector).on('click', function(e) {
                e.preventDefault();
                var route_prefix = '/file-manager';
                var target_input = $('#' + $(this).data('input'));
                var target_preview = $('#' + $(this).data('preview'));

                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');

                window.SetUrl = function(items) {
                    var file_path = items.map(function(item) {
                        return item.url;
                    }).join(',');

                    // cập nhật vào input
                    target_input.val(file_path).trigger('change');

                    // cập nhật ảnh preview (chỉ lấy ảnh đầu tiên nếu chọn nhiều)
                    if (items[0].thumb_url) {
                        target_preview.attr('src', items[0].thumb_url);
                    }
                };
            });
        }

        $(document).ready(function() {
            initFileManager('.lfm', 'image');
            $(document).on('click', '.btn-clear-image', function() {
                var input = $(this).data('input');
                var preview = $(this).data('preview');

                $('#' + input).val('');
                $('#' + preview).attr('src', '').attr('hidden', true);

                $(this).closest('.input-group').parent().find('.preview_img').hide();
            })
        });
    </script>


</body>

</html>
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/layout/layout.blade.php ENDPATH**/ ?>