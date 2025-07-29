 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thêm bài viết')
 @Section('content')

     <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center  my-3">
             <div class=""></div>
             <a id="back-link" class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('article') }}">Quay
                 lại</a>
         </div>

         <form action="{{ route('articleAddForm') }}" method="post" class="formAdmin" enctype="multipart/form-data">
             @csrf
             <div class="buttonProductForm">

                 <div class="">
                     <h3 class="title-page ">
                         Thêm bài viết
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>
             <input type="hidden" name="admin_id" value="{{ Session::get('admin')->id }}">
             <div class="form-group mt-3">
                 <label for="exampleInputFile" class="form-label">Ảnh danh mục
                     <div class="custom-file imageAdd p-3 ">
                         <div class="imageFile">
                             <div id="preview"><img src="{{ asset('img/lf.png') }}" alt=""></div>
                         </div>
                         <div class="">
                             <input type="file" name="image" id="HinhAnh" class="inputFile">
                         </div>
                     </div>
                 </label>
                 @error('image')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tiêu đề</label>
                 <input type="text" class="form-control" name="title" placeholder="Nhập danh mục bài viết">
                 @error('title')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="categoryArticle_id" class="form-label">Danh mục</label>
                 <select name="categoryArticle_id" id="categoryArticle_id" class="form-select mt-3">
                     <option value="">Chọn danh mục</option>
                     @foreach ($categoryArticle as $category)
                         <option value="{{ $category->id }}">{{ $category->title }}</option> <!-- Đảm bảo hiển thị title -->
                     @endforeach
                 </select>
                 @error('categoryArticle_id')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             {{-- vậy là trung tên đó hả: nó trùng chỗ này nè --}}

             <div class="form-group mt-3 ">
                 <label for="title" class="form-label">Mô tả ngắn</label>
                 <textarea class="form-control ckeditor" name="description_short" id="" cols="30" rows="10"></textarea>

             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Mô tả</label>
                 <textarea class="form-control ckeditor" name="description" id="" cols="30" rows="15"></textarea>
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select " aria-label="Default select example" name="status">
                     <option selected>Trang thái</option>
                     <option value="1">Bật</option>
                     <option value="0">Tắt</option>
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
                        window.location.href = "{{ route('article') }}";
                    }
                });
            } else {
                // Nếu không có thay đổi, điều hướng luôn
                window.location.href = "{{ route('article') }}";
            }
        });
    </script> --}}
 @endsection
