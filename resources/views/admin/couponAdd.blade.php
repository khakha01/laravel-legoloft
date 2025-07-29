@extends('admin.layout.layout')
@Section('title', 'Admin | Thêm mã giảm giá')
@Section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a id="back-link" class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('coupon') }}">Quay lại</a>
        </div>

        <form action="{{ route('couponAddForm') }}" method="post" class="formAdmin" enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm">
                <div class="">
                    <h3 class="title-page ">
                        Thêm mã giảm giá
                    </h3>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên phiếu giảm giá</label>
                <input type="text" class="form-control" name="name_coupon" placeholder="Nhập tên phiếu giảm giá">
                @error('name_coupon')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Mã(code)</label>
                <input type="text" class="form-control" name="code" placeholder="Nhập code">
                @error('code')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Loại(type)</label>
                <select class="form-select mt-3" aria-label="Default select example" name="type">
                    <option value="0">Giảm Giá theo %</option>
                    <option value="1">Số tiền cố định</option>
                </select>
                @error('type')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Giảm giá</label>
                <input type="text" class="form-control" id="priceFormat" oninput="formatCurrency(this)" name="discount"
                    placeholder="Nhập giá giảm">
                @error('discount')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Tổng cộng</label>
                <input type="text" class="form-control" id="priceFormat" oninput="formatCurrency(this)" name="total"
                    placeholder="Tổng cộng">
                @error('total')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" name="date_start" placeholder="Ngày bắt đầu">

            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" name="date_end" placeholder="Ngày kết thúc">

            </div>
            <select class="form-select mt-3" aria-label="Default select example" name="status">
                <option value="1">Kích hoạt</option>
                <option value="0">Vô hiệu hóa</option>
            </select>
            @error('status')
                <div class="text-danger" id="alert-message">{{ $message }}</div>
            @enderror
        </form>
    </div>

    <script>
        function formatCurrency(input) {
            // Xóa tất cả ký tự không phải số
            let value = input.value.replace(/[^0-9]/g, '');

            // Định dạng số thành VND
            if (value) {
                value = Number(value).toLocaleString('en'); 
                // VI-vn
            }

            // Cập nhật giá trị của input
            input.value = value;
        }

        // Hàm để lấy giá trị khi gửi form
        function getRawValue() {
            const inputs = document.querySelectorAll('#priceFormat'); // Lấy tất cả các input có cùng id

            // Lấy giá trị thô từ tất cả các trường
            const rawValues = Array.from(inputs).map(input => input.value.replace(/[^0-9]/g, ''));

            return rawValues;
        }

        // Gửi form
        document.querySelector('form').onsubmit = function() {
            const [discountRawValue, totalRawValue] = getRawValue();

            // Gán giá trị thô vào trường discount và total trước khi gửi
            document.querySelector('input[name="discount"]').value = discountRawValue;
            document.querySelector('input[name="total"]').value = totalRawValue;
        };
    </script>
        {{-- <script>
            let isFormDirty = false;
    
            // Đánh dấu khi người dùng thay đổi dữ liệu trong form
            document.querySelector('form').addEventListener('input', () => {
                isFormDirty = true;
            });
    
            // Thêm trạng thái vào lịch sử khi tải trang
            window.history.pushState(null, "", window.location.href);
    
            // Lắng nghe sự kiện "popstate" khi người dùng nhấn nút "Back"
            window.addEventListener('popstate', function (event) {
                if (isFormDirty) {
                    event.preventDefault(); // Ngăn hành động mặc định
                    Swal.fire({
                        title: "Bạn có chắc chắn?",
                        text: "Dữ liệu chưa được lưu sẽ bị mất nếu rời khỏi trang.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Rời đi",
                        cancelButtonText: "Ở lại",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Nếu người dùng chọn "Rời đi", quay lại trạng thái lịch sử trước đó
                            window.history.back();
                        } else {
                            // Nếu chọn "Ở lại", đẩy lại trạng thái hiện tại vào lịch sử
                            window.history.pushState(null, "", window.location.href);
                        }
                    });
                } else {
                    // Nếu form không thay đổi, cho phép quay lại
                    window.history.back();
                }
            });
    
            // Xử lý rời khỏi trang qua liên kết "Quay lại"
            document.getElementById('back-link').addEventListener('click', function (event) {
                if (isFormDirty) {
                    event.preventDefault(); // Ngăn hành động mặc định
                    Swal.fire({
                        title: "Bạn có chắc chắn?",
                        text: "Dữ liệu chưa được lưu sẽ bị mất nếu rời khỏi trang.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Rời đi",
                        cancelButtonText: "Ở lại",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Điều hướng đến liên kết khi người dùng xác nhận
                            window.location.href = "{{ route('coupon') }}";
                        }
                    });
                } else {
                    // Nếu không có thay đổi, điều hướng luôn
                    window.location.href = "{{ route('coupon') }}";
                }
            });
        </script> --}}
@endsection
