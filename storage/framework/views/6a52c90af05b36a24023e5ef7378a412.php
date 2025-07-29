<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập quản trị Legoloft</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('uploads/HK.png')); ?>" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">

</head>

<body>
    <div class="bg_admin_login">
        <div class="container">
            <form action="<?php echo e(route('adminLoginForm')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form_admin">
                    <div class="form_admin_alrt">
                        <?php if(session('success')): ?>
                            <div id="alert-message" class="alertSuccess"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div id="alert-message" class="alertDanger"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form_admin_content">
                        <div class="img_login_admin"><img src="<?php echo e(asset('img/lockk.png')); ?>" alt=""></div>
                        <div class="title">
                            <h2>Đăng nhập quản trị</h2>
                        </div>
                        <div class="form_admin_item">
                            <label for="">Tên đăng nhập</label>
                            <input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập"
                                value="<?php echo e(old('username')); ?>" />
                            <?php $__errorArgs = ['username'];
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
                        <div class="form_admin_item">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" />
                            <label for="" class="login_forgetpw"><a href="<?php echo e(route('forgetPasswordAdmin')); ?>"
                                    class="">Quên mật
                                    khẩu</a></label>
                            <?php $__errorArgs = ['password'];
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
                        <button type="submit" id="submitLogin" class="btn_admin_login" disabled>Đăng nhập</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
    <script>
        $(document).ready(() => {
            const $username = $('#username');
            const $password = $('#password');
            const $submitLogin = $('#submitLogin');

            function toggleSubmitBtn() {
                if ($username.val().trim() !== '' && $password.val().trim() !== '') {
                    $submitLogin.prop('disabled', false);
                } else {
                    $submitLogin.prop('disabled', true);

                }
            }
            $username.on('input', toggleSubmitBtn);
            $password.on('input', toggleSubmitBtn);
        })
    </script>
</body>

</html>
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/login.blade.php ENDPATH**/ ?>