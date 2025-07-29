 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thêm vị trí hình ảnh')
 @Section('content')

     <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a id="back-link" class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('bannerManage') }}">Quay lại</a>
        </div>
         <form action="{{ route('bannerManageAddForm') }}" method="post" class="formAdmin">
             @csrf
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Thêm vị trí hình ảnh
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tên vị trí hình ảnh</label>
                 <input type="text" class="form-control" name="name" aria-describedby="title"
                     placeholder="Nhập tên vị trí">
                 @error('name')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Vị trí hình ảnh</label>
                 <input type="number" class="form-control" name="position" placeholder="Nhập vị trí">
                 @error('position')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="0">Vô hiệu hóa</option>
                     <option value="1">Kích hoạt</option>
                 </select>
                 @error('status')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
         </form>
     </div>
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
                        window.location.href = "{{ route('bannerManage') }}";
                    }
                });
            } else {
                // Nếu không có thay đổi, điều hướng luôn
                window.location.href = "{{ route('bannerManage') }}";
            }
        });
    </script> --}}
 @endsection
