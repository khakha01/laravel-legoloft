@extends('admin.layout.layout')
@Section('title', 'Admin | Chỉnh sửa nhóm khách hàng')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <h3 class="title-page ">
                Chỉnh sửa nhóm khách hàng
            </h3>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('userGroup') }}">Quay lại</a>
        </div>

        <form action="{{ route('updateUserGroup', $userGroup->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm">
                <div class=""></div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm khách hàng</label>
                <input type="text" class="form-control" name="name" value="{{ $userGroup->name }}">
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputFile" class="form-label">Hình ảnh nhóm khách hàng</label>
                <div class="custom-file imageAdd p-3 ">
                    <div class="imageFile">
                        <img src="{{ asset('img/' . $userGroup->image) }}" alt="">
                    </div>
                    <div class="">
                        <input type="file" name="image" id="HinhAnh" class="inputFile">
                    </div>
                </div>

            </div>

        </form>
    </div>
@endsection
