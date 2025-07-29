<?php $__env->startSection('title', 'Thống kê Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php if(session('error')): ?>
            <div class="pb-1">
                <div id="alert-message" class="alertDanger"><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>
        <h3 class="title-page cssTitle">
            Bảng điều khiển
        </h3>
        <div class="row dash_row my-3 pb-3">
            <div class="col-md-3 ">
                <div class="dash_product">
                    <div class="dash_product_header">
                        <span>Sản phẩm</span>
                    </div>
                    <div class="dash_product_main">
                        <div class="dash_product_content">
                            <span>Danh mục</span>
                            <p><?php echo e($countCategory); ?></p>
                            <a href="<?php echo e(route('category')); ?>">Chi tiết</a>
                        </div>
                        <div class="dash_product_content">
                            <span>Sản phẩm</span>
                            <p><?php echo e($countProduct); ?></p>
                            <a href="<?php echo e(route('product')); ?>">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="dash_article">
                    <div class="dash_article_header">
                        <span>Bài viết</span>
                    </div>
                    <div class="dash_article_main">
                        <div class="dash_article_content">
                            <span>Danh mục</span>
                            <p><?php echo e($countCategoryArticle); ?></p>
                            <a href="<?php echo e(route('categoryArticle')); ?>">Chi tiết</a>
                        </div>
                        <div class="dash_article_content">
                            <span>Bài viết</span>
                            <p><?php echo e($countArticle); ?></p>
                            <a href="<?php echo e(route('article')); ?>">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="dash_user">
                    <div class="dash_user_header">
                        <span>Khách hàng</span>
                    </div>
                    <div class="dash_user_main">
                        <div class="dash_user_content">
                            <span>Nhóm khách</span>
                            <p><?php echo e($countUserGroup); ?></p>
                            <a href="<?php echo e(route('userGroup')); ?>">Chi tiết</a>
                        </div>
                        <div class="dash_user_content">
                            <span>Khách hàng</span>
                            <p><?php echo e($countUser); ?></p>
                            <a href="<?php echo e(route('userAdmin')); ?>">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="dash_admin">
                    <div class="dash_admin_header">
                        <span>Người dùng</span>
                    </div>
                    <div class="dash_admin_main">
                        <div class="dash_admin_content">
                            <span>Nhóm người dùng</span>
                            <p><?php echo e($countAdministrationGroup); ?></p>
                            <a href="<?php echo e(route('adminstrationGroup')); ?>">Chi tiết</a>
                        </div>
                        <div class="dash_admin_content">
                            <span>Người dùng</span>
                            <p><?php echo e($countAdministration); ?></p>
                            <a href="<?php echo e(route('adminstration')); ?>">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <h4>Tổng doanh thu</h4>

                <div class="row mb-3 cardTwoDashboard">
                    <div class="col-md-3">
                        <div class="cardTwoDashboardItem" style="background: #fff">
                            <h6 class="">
                                Tổng đơn hàng
                            </h6>
                            <h3><?php echo e($countOrderDash); ?> đơn hàng</h3>
                            <div class="iconCardDash">
                                <span><i class="fa-solid fa-cart-plus" style="color: #ffffff;"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cardTwoDashboardItem" style="background:#fff">
                            <h6 class="">
                                Tổng doanh thu
                            </h6>
                            <h3><?php echo e(number_format($salesTotal, 0, ',') . 'đ'); ?></h3>
                            <div class="iconCardDash">
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cardTwoDashboardItem" style="background: #fff">
                            <h6 class="">
                                Doanh thu theo tháng
                            </h6>
                            <h3> <?php echo e(number_format($salesTotalByMonth, 0, ',') . 'đ'); ?></h3>
                            <div class="iconCardDash">
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cardTwoDashboardItem" style="background: #fff">
                            <h6 class="">
                                Doanh thu hôm nay
                            </h6>
                            <h3> <?php echo e(number_format($salesTotalByDay, 0, ',') . 'đ'); ?></h3>
                            <div class="iconCardDash">
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row bg_row_dash">
            <div class="col-md-12">
                <div id="revenueChart"></div>
            </div>
        </div>


        <div class="row bg_row_dash mt-4">
            <div class="col-md-6">
                <canvas id="ordersByStatusChart"></canvas>

            </div>
            <div class="col-md-6">
                <canvas id="ordersByPaymentChart"></canvas>
            </div>
        </div>


        <div class="row mt-5 bg_row_dash">
            <div class="col-md-6 " style="text-align: center;">
                <span class="mb-3" style="font-weight:600; font-size:12px;">Thống kê sản phẩm bán chạy</span>
                <div id="countProductSoldoutChart"></div>
            </div>
            <div class="col-md-6">
                <div class="dashFavorite10_main">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $countProductSoldoutOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo e(route('detail', $item->product->slug)); ?>">
                                        <div class="dashFavorite10">
                                            <div class="dashFavorite10_img">
                                                <img src="<?php echo e(asset('img/' . $item->product->image)); ?>" alt="">
                                            </div>
                                            <div class="dashFavorite10_content">
                                                <span><?php echo e($item->product->name); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-5 bg_row_dash ">
            <div class="col-md-6">
                <canvas id="cartChart" width="400" height="290"></canvas>
            </div>
            <div class="col-md-6 ">
                <div class="dashFavorite10_main">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $cartStatistical; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo e(route('detail', $item->product->slug)); ?>">
                                        <div class="dashFavorite10">
                                            <div class="dashFavorite10_img">
                                                <img src="<?php echo e(asset('img/' . $item->product->image)); ?>" alt="">
                                            </div>
                                            <div class="dashFavorite10_content">
                                                <span><?php echo e($item->product->name); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-5 bg_row_dash">

            <div class="col-md-6 ">
                <div id="favouriteChart"></div>

                
            </div>
            <div class="col-md-6">
                <div class="dashFavorite10_main">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $favouriteStatistical; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo e(route('detail', $item->product->slug)); ?>">
                                        <div class="dashFavorite10">
                                            <div class="dashFavorite10_img">
                                                <img src="<?php echo e(asset('img/' . $item->product->image)); ?>" alt="">
                                            </div>
                                            <div class="dashFavorite10_content">
                                                <span><?php echo e($item->product->name); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 bg_row_dash">
            <div class="col-md-6">
                <canvas id="countUserChart" width="350" height="220"></canvas>
            </div>
            <div class="col-md-6">
                <div class="dashFavorite10_main">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $countUserPotential; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <a href="">
                                        <div class="dashFavorite10">
                                            <div class="dashFavorite10_img">
                                                <img src="<?php echo e(asset('img/' . $item->user->image)); ?>" alt="">
                                            </div>
                                            <div class="dashFavorite10_content">
                                                <span><?php echo e($item->user->fullname); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('dashboardAdminScript'); ?>
    <script>
        function formatCurrency(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + 'đ';
        }

        // Khởi tạo biểu đồ Doanh thu
        const initRevenueChart = () => {
            // Dữ liệu doanh thu từ server (giả sử đã được chuyển đổi sang JSON)
            const revenueData = <?php echo json_encode($revenue); ?>; // Dữ liệu doanh thu từ server

            // Hàm định dạng giá trị doanh thu
            function formatCurrency(value) {
                return value.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });
            }

            // Cấu hình biểu đồ ApexCharts
            var options = {
                series: [{
                    name: 'Doanh thu',
                    type: 'line',
                    data: revenueData // Sử dụng dữ liệu từ Chart.js
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false,
                },
                stroke: {
                    width: [5],
                    curve: 'smooth'
                },
                xaxis: {
                    categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                        'September', 'October', 'November', 'December'
                    ]
                },
                yaxis: {
                    title: {
                        text: 'Doanh thu',
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return formatCurrency(value); // Định dạng giá trị doanh thu
                        }
                    }
                }
            };

            // Khởi tạo và hiển thị biểu đồ
            var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
            chart.render();
        };

        // Khởi tạo các biểu đồ Yêu thích
        const initFavouriteCharts = () => {

            const productLabels = <?php echo json_encode($favouriteStatistical->pluck('product_name')); ?>;
            const favouriteCounts = <?php echo json_encode($favouriteStatistical->pluck('favourite_count')); ?>;

            // Cấu hình biểu đồ ApexCharts
            var options = {
                series: [{
                    name: 'Tổng yêu thích',
                    data: favouriteCounts // Sử dụng dữ liệu từ Chart.js
                }],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    curve: 'stepline',
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: productLabels, // Sử dụng nhãn từ Chart.js
                },
                yaxis: {
                    title: {
                        text: 'Số lượng yêu thích',
                    },
                    labels: {
                        formatter: function(value) {
                            return Math.round(value); // Làm tròn số
                        }
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(value) {
                            return value + " yêu thích";
                        }
                    }
                }
            };

            // Khởi tạo và hiển thị biểu đồ ApexCharts
            var chart = new ApexCharts(document.querySelector("#favouriteChart"), options);
            chart.render();

        };

        // Khởi tạo các biểu đồ Gio hàng
        const initCartCharts = () => {
            const cartChart = document.getElementById('cartChart').getContext('2d');
            const cartChartFunction = new Chart(cartChart, {
                type: 'radar',
                data: {

                    labels: <?php echo json_encode($cartStatistical->pluck('product_name')); ?>,
                    datasets: [{
                        label: 'Tổng sản phẩm trong giỏ hàng',
                        data: <?php echo json_encode($cartStatistical->pluck('cart_count')); ?>,
                        backgroundColor: 'rgba(0, 0, 0, 0.2)', // Màu nền
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(153, 102, 255, 1)',

                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Báo cáo top 8 sản phẩm được thêm vào giỏ hàng nhiều nhất"
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        },
                        gridLines: {
                            color: '#e0e0e0' // Màu lưới
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                const productName = data.labels[tooltipItem.index]; // Tên sản phẩm
                                const count = tooltipItem.yLabel; // Số lượng sản phẩm
                                return productName + ': ' + count; // Hiển thị tên và số lượng
                            }
                        }
                    }
                }
            });
        };


        // Khởi tạo các biểu đồ thanh toán
        const initPaymentCharts = () => {
            const ordersByPaymentCtx = document.getElementById('ordersByPaymentChart').getContext('2d');
            const ordersByPaymentChart = new Chart(ordersByPaymentCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($namePayment); ?>,
                    datasets: [{
                        label: 'Số lượng đơn hàng',
                        data: <?php echo json_encode($dataPayment); ?>,
                        backgroundColor: ['#ffc506', '#D82D8B', '#007ACC'],
                    }]
                },
                options: {

                    legend: {
                        display: false // Hiển thị legend
                    },
                    title: {
                        display: true,
                        text: "Báo cáo tổng quát về thanh toán người dùng"
                    },

                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            }
                        }]
                    }
                }
            });
        }


        // Khởi tạo các biểu đồ trạng thái
        const initStatusCharts = () => {
            const ordersByStatusCtx = document.getElementById('ordersByStatusChart').getContext('2d');
            const ordersByStatusChart = new Chart(ordersByStatusCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($nameStatus); ?>, // Các nhãn cho trục x
                    datasets: [{
                        data: <?php echo json_encode($dataStatus); ?>, // Số liệu tương ứng với từng trạng thái
                        backgroundColor: ['#2bc500', '#00bcd4', '#007ACC', '#fbc000', '#ff0000'],
                    }]
                },
                options: {

                    legend: {
                        display: false // Hiển thị legend
                    },
                    title: {
                        display: true,
                        text: "Báo cáo tổng quát về trạng thái đơn hàng trong hệ thống"
                    },
                }
            });
        }


        // Khởi tạo các biểu đồ bán chạy
        const initSoldoutCharts = () => {
            // Lấy dữ liệu từ PHP
            const productLabels = <?php echo json_encode($countProductSoldoutOrder->pluck('product_name')); ?>; // Nhãn sản phẩm
            const productQuantities = <?php echo json_encode($countProductSoldoutOrder->pluck('total_quantity')); ?>; // Số lượng sản phẩm

            var options = {
                series: productQuantities,
                chart: {
                    type: 'polarArea',
                },
                stroke: {
                    colors: ['#fff']
                },
                fill: {
                    opacity: 0.8
                },
                labels: productLabels,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            // Khởi tạo và hiển thị biểu đồ ApexCharts
            var chart = new ApexCharts(document.querySelector("#countProductSoldoutChart"), options);
            chart.render();
        };



        const initUserCharts = () => {
            const countUserChartCtx = document.getElementById('countUserChart').getContext('2d');
            const countUserChart = new Chart(countUserChartCtx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($countUserPotential->pluck('name_user')); ?>, // Các nhãn cho trục x
                    datasets: [{
                        data: <?php echo json_encode($countUserPotential->pluck('count_user')); ?>, // Số liệu tương ứng với từng trạng thái
                        backgroundColor: [
                            ' rgba(255, 99, 132, 1)',
                            ' rgba(54, 162, 235, 1)',
                            ' rgba(255, 159, 64, 1)',
                            ' rgba(75, 192, 192, 1)',
                            ' rgba(153, 102, 255, 1)',
                            ' rgba(255, 205, 86, 1)',
                            ' rgba(231, 233, 237, 1)',
                            ' rgba(255, 99, 71, 1)'
                        ],
                    }]
                },
                options: {

                    legend: {
                        display: true // Hiển thị legend
                    },
                    title: {
                        display: true,
                        text: "Thống kê về khách hàng mua nhiều"
                    },

                }
            });
        }


        window.onload = function() {
            initRevenueChart();
            initFavouriteCharts();
            initCartCharts();
            initPaymentCharts();
            initStatusCharts();
            initSoldoutCharts();
            initUserCharts();
        };
    </script>
    
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            nav: true,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\LARAVEL\DATN-LEGOLOFT-2024\legoloft\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>