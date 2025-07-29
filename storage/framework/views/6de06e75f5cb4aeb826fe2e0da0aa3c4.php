<?php $__env->startSection('title', 'Đăng nhập'); ?>
<?php $__env->startSection('content'); ?>
    <!-- START MAIN -->
    <div class="bg_login">
        <div class="container">
            <div class="login_main">
                <form action="<?php echo e(route('loginForm')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form_admin_alrt">
                        <?php if(session('error')): ?>
                            <div id="alert-message" class="alertDanger"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>

                        <?php if(session('success')): ?>
                            <div id="alert-message" class="alertSuccess"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>
                        <?php if($errors->any()): ?>
                            <div class="errors">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div id="alert-message" class="alertErrors">
                                        <?php echo e($error); ?> </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="login_content">
                        <div class="title">
                            <h2>Đăng nhập</h2>
                        </div>
                        <div class="login_item">
                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="Nhập email" />
                        </div>
                        <div class="login_item">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu" />
                            <label for="" class="login_forgetpw"><a href="<?php echo e(route('forgetPassword')); ?>"
                                    class="">Quên mật
                                    khẩu</a></label>
                        </div>
                        <div>
                            <button class="btn_login">Đăng nhập</button>
                        </div>
                        <div class="border-container-login">
                            <hr class="border-left" />
                            <span>Hoặc</span>
                            <hr class="border-right" />
                        </div>
                        <div class="login_regis">
                            <span>Bạn chưa có tài khoản?</span>
                            <a href="<?php echo e(route('register')); ?>">
                                <span>Đăng ký thành viên<i class="fa-solid fa-arrow-right ps-1"></i></span></a>
                        </div>
                        <a href="<?php echo e(route('login.google')); ?>" class="btn btn-google">
                            <i class="fab fa-google"></i> Đăng nhập bằng Google
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MAIN -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/login.blade.php ENDPATH**/ ?>