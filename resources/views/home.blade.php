@extends('layout.layout')
@section('title', 'LegoLoft | website lego')
@section('content')
    <!-- START BANNER -->
    @include('homeBanner');
    <!-- END BANNER -->

    <div class="background_home">
        <!-- START CATEGORY -->
        @include('homeCategory');
        <!-- END CATEGORY -->

        <!-- START LỰA CHỌN -->
        @include('homeCategoryChoose')
        <!-- END LỰA CHỌN -->

        <!-- START PRODUCT NỔI BẬT -->
        @include('homeOutstanding')
        <!-- END PRODUCT NỔI BẬT -->

        <!-- START PRODUCT GIẢM GIÁ -->
        @include('homeSale')
        <!-- END PRODUCT GIẢM GIÁ  -->

        @include('homeCategoryProduct')

        <!-- START PRODUCT BÁN CHẠY -->
        @include('homeSoldOut')
        <!-- END PRODUCT BÁN CHÁY-->

        <!-- START BUILT -->
        @include('homeBuilt')
        <!-- END BUILT -->

        <!-- START PRODUCT HẾT HÀNG -->
        @include('homeOutStock')
        <!-- END PRODUCT HẾT HÀNG -->

        <!-- START BÀI VIẾT -->
        @include('homeBlog')
        <!-- END BÀI VIẾT -->
    </div>



@endsection
