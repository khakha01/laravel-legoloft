@extends('admin.layout.layout')
@section('title', 'Admin | Thêm nhóm khách hàng')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a id="back-link" class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('userGroup') }}">Quay
                lại</a>
        </div>
        <div class="formAdminAlert">
            @if (session('success'))
                <div class="alert alert-success py-2">
                    {{ session('success') }}
                </div>
            @endif

        </div>

        <form action="{{ route('createUserGroup') }}" method="post" class="formAdmin">
            @csrf
            <div class="buttonProductForm">

                <div class="">
                    <h3 class="title-page">
                        Thêm nhóm khách hàng
                    </h3>
                </div>

                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="name" class="form-label">Tên nhóm khách hàng</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên nhóm khách hàng">
                @error('name')
                    <div class="text-danger" id="alert-message">Vui lòng nhập tên nhóm</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputFile" class="form-label">Hình ảnh nhóm khách hàng</label>
                <div class="custom-file imageAdd p-3 ">
                    <div class="imageFile">
                        <div id="preview"><img src="{{ asset('img/lf.png') }}" alt=""></div>
                    </div>
                    <div class="">
                        <input type="file" name="image" id="HinhAnh" class="inputFile">
                    </div>
                </div>
                @error('image')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </div>

@endsection
