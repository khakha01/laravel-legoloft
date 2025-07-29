@extends('admin.layout.layout')
@Section('title', 'Admin | Phản hồi liên hệ')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('contactAdmin') }}">Quay lại</a>
        </div>

        <form action="" class="formAdmin" method="post" class="mt-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="buttonProductForm">
                <div class="">
                    <h2 class="title-page ">
                        Chỉnh sửa sản phẩm lắp ráp </h2>
                </div>
                <div class="">

                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group mt-3">
                    <label for="email" class="form-label">Email khách:</label>
                    <input type="email" class="form-control" name="email" value="{{ $findcontact->email }}"
                        placeholder="Nhập email" readonly>
                </div>
                <div class="form-group mt-3">
                    <label for="fullname" class="form-label">Họ tên:</label>
                    <input type="text" class="form-control" name="fullname" value="{{ $findcontact->name }}"
                        placeholder="Nhập họ tên" readonly>
                </div>
                <div class="form-group mt-3">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="tel" class="form-control" name="phone" value="{{ $findcontact->phone }}"
                        placeholder="Nhập số điện thoại" readonly>
                </div>
                <div class="form-group mt-3">
                    <label for="message" class="form-label">Nội dung khách gửi:</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập nội dung..." readonly>{{ $findcontact->message }}</textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="created_at" class="form-label">Ngày gửi:</label>
                    <input class="form-control" name="created_at" value="{{ $findcontact->created_at->format('d-m-Y') }}" ">
                            </div>
                        </div>

                    </form>
                </div>

@endsection
