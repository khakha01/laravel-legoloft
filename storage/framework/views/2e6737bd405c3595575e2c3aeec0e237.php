<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar ">
        <!-- Sidebar scroll-->
        <div>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer d-flex justify-content-end"
                id="sidebarCollapse">
                <img width="40" height="40" src="https://img.icons8.com/ios/50/FFFFFF/close-window--v1.png"
                    alt="close-window--v1" />
            </div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="<?php echo e(route('dashboard')); ?>" class="text-nowrap logo-img mt-4">
                    
                </a>

            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo e(route('dashboard')); ?>" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-gauge-high ico-side" style="color: #FFFFFF;"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <?php if(in_array('banner', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-image ico-side"
                                            style="color: #FFFFFF;font-size:20px;"></i> </span>
                                    <span class="hide-menu  ps-2">Quản lý hình ảnh</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo e(route('banners.index')); ?>" aria-expanded="false">
                                        <span style="width:20px"> <i class="fa-solid fa-angles-right"
                                                style="color: #ffffff;"></i>

                                        </span>
                                        <span class="hide-menu">Banner-Hình</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('category', $permission) || in_array('product', $permission) || in_array('comment', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-tag" style="color: #ffffff; font-size:20px;"></i>
                                    </span>
                                    <span class="hide-menu ps-2">Quản lý sản phẩm
                                    </span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                <?php if(in_array('category', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('category')); ?>" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Danh mục</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('product', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('product')); ?>" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Sản phẩm</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('cart', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('cartAdmin')); ?>" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Giỏ hàng</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('favourite', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('favourite')); ?>" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Sản phẩm yêu thích</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('comment', $permission)): ?>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="<?php echo e(route('comment')); ?>" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Bình luận</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('coupon', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('coupon')); ?>" aria-expanded="false">
                                <span style="width:20px">
                                    <i class="fa-solid fa-ticket" style="color: #ffffff;font-size:20px;"></i>
                                </span>
                                <span class="hide-menu">Mã giảm giá</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('order', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?php echo e(route('admin.order')); ?>" aria-expanded="false">
                                <span style="width:20px">
                                    <img width="20" height="20"
                                        src="https://img.icons8.com/ios/20/FFFFFF/purchase-order.png"
                                        alt="purchase-order" />
                                </span>
                                <span class="hide-menu">Đơn hàng</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(in_array('assembly', $permission) || in_array('assemblyPackages', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link" aria-expanded="false">
                                <span style="width:20px">
                                    <i class="fa-solid fa-arrows-to-dot" style="color: #ffffff;font-size:20px;"></i>
                                </span>
                                <span class="hide-menu">Dịch vụ Lego</span>
                            </a>
                            <ul class="submenu">
                                <?php if(in_array('assembly', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('assembly')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Đơn hàng lắp ráp</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if(in_array('assemblyPackages', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('assemblyPackages')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Gói quà lắp ráp</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('user', $permission) || in_array('userGroup', $permission) || in_array('contact', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="ti fa-solid fa-user ico-side"
                                            style="color: #ffffff; font-size:20px;"></i>
                                    </span>
                                    <span class="hide-menu  ps-2">Khách hàng</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                <?php if(in_array('contact', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('contactAdmin')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-regular fa-address-book" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Liên hệ</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('user', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('userAdmin')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Khách hàng</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('userGroup', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('userGroup')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Nhóm khách hàng</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('administration', $permission) || in_array('administrationGroup', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-users" style="color: #ffffff;"></i>
                                    </span>
                                    <span class="hide-menu  ps-2">Quản trị</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                <?php if(in_array('administration', $permission)): ?>
                                    
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('adminstration')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Quản trị viên</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('administrationGroup', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('adminstrationGroup')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Nhóm quản trị</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(in_array('article', $permission) || in_array('categoryArticle', $permission)): ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link  d-flex justify-content-between" aria-expanded="false">
                                <div class="d-flex">
                                    <span style="width:20px">
                                        <i class="fa-solid fa-newspaper" style="color: #ffffff; font-size:20px;"></i>
                                    </span>
                                    <span class="hide-menu  ps-2">Bài viết - blog</span>
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-chevron-down " style="color: #ffffff;"></i>
                                </div>
                            </a>
                            <ul class="submenu">
                                <?php if(in_array('categoryArticle', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('categoryArticle')); ?>"
                                            aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Danh mục bài viết</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(in_array('article', $permission)): ?>
                                    <li class="">
                                        <a class="sidebar-link" href="<?php echo e(route('article')); ?>" aria-expanded="false">
                                            <span style="width:20px">
                                                <i class="fa-solid fa-angles-right" style="color: #ffffff;"></i>
                                            </span>
                                            <span class="hide-menu">Bài viết</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="sidebar-item" style="border-top: 1px solid #7e7b7b">
                        <a class="sidebar-link" href="<?php echo e(route('adminLogout')); ?>" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-right-from-bracket ico-side" style="color: #ffffff;"></i>
                            </span>
                            <span class="hide-menu">Đăng xuất</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                            <img width="50" height="50"
                                src="https://img.icons8.com/ios/50/FFFFFF/menu-squared-2.png" alt="menu-squared-2" />
                        </a>
                    </li>

                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">

                                <?php if(Auth::guard('admin')->check()): ?>
                                    <img src="<?php echo e(asset('img/' . Session::get('admin')->image)); ?>" alt=""
                                        width="35" height="35" class="rounded-circle">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('img/user1.jpg')); ?>" alt="" width="35"
                                        height="35" class="rounded-circle">
                                <?php endif; ?>


                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3" style="font-weight:600;">
                                            <?php echo e(Session::get('admin')->fullname); ?></p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-mail fs-6"></i>
                                        <p class="mb-0 fs-3"
                                            style="background-color: <?php echo e(Session::get('admin')->administrationGroup->color); ?>; padding:10px 10px;color:#fff;border-radius:6px;">
                                            <?php echo e(Session::get('admin')->administrationGroup->name); ?>

                                        </p>
                                    </a>
                                    <a href="<?php echo e(route('adminLogout')); ?>"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng xuất</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/layout/header.blade.php ENDPATH**/ ?>