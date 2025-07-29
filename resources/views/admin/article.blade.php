 @extends('admin.layout.layout')
 @Section('title', 'Admin | Bài viết')
 @Section('content')

     <div class="container-fluid">

         <div class="searchAdmin">
             <form id="filterFormCategory" method="GET">
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Tiêu đề</label>
                             <input class="form-control rounded-0" name="filter_name" placeholder="Tiêu đề bài viết"
                                 type="text" value="{{ request('filter_name') }}">
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Trạng thái</label>
                             <select class="form-select  rounded-0" aria-label="Default select example"
                                 name="filter_status">
                                 <option value="">Tất cả</option>
                                 <option value="1" {{ request('filter_status') == '1' ? 'selected' : '' }}>Kích hoạt
                                 </option>
                                 <option value="0" {{ request('filter_status') == '0' ? 'selected' : '' }}>Vô hiệu hóa
                                 </option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc bài viết</button>
                 </div>
             </form>
         </div>

         <form id="submitFormAdmin" action="{{ route('articleBulkDelete') }}" method="POST">
             @csrf
             <div class="buttonProductForm mt-3">
                 <div class="m-0 p-0">
                     @if (session('error'))
                         <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                     @endif
                     @if (session('success'))
                         <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                     @endif
                 </div>
                 <div class="">
                     <button type="button" class="btn btnF1">
                         <a href="{{ route('articleAdd') }}" class="text-decoration-none text-light">
                             <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo bài viết
                         </a>
                     </button>
                     <!-- Nút xóa bài viết -->
                     <button type="button" onclick="deleteAllArticle('{{ route('articleBulkDelete') }}')"
                         class="btn btnF2">
                         <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa bài viết đã chọn
                     </button>
                 </div>
             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Bài Viết</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class="py-2"></th>
                             <th class="py-2">Hình ảnh</th>

                             <th class="py-2">Danh mục</th>
                             <th class="py-2">Tiêu đề</th>
                             <th class="py-2">Tác giả</th>

                             <th class="py-2">Ngày đăng</th>
                             <th class="py-2">Trạng thái</th>
                             <th class="py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="table-body">
                         @foreach ($atc as $item)
                             <tr>
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                             name="article_ids[]" value="{{ $item->id }}">
                                         <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td>

                                     @if ($item->image)
                                         <img src="{{ asset('img/' . $item->image) }}" alt=""
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                     @else
                                         <img src="{{ asset('img/lf.png') }}"
                                             alt=""style="width: 100px; height: 100px; object-fit: cover;">
                                     @endif
                                 </td>
                                 <td>{{ $item->categoryArticle->title }}</td>
                                 <td class="nameAdmin">
                                     <p>{{ $item->title }}</p>
                                 </td>
                                 <td><span
                                         style="color: {{ $item->administration->administrationGroup->color }};font-weight:600;">{{ $item->administration->fullname }}</span>
                                 </td>
                                 <td>{{ $item->created_at }}</td>
                                 <td>
                                     <div class="form-check form-switch">
                                         <input class="form-check-input" type="checkbox" role="switch"
                                             data-id="{{ $item->id }}" id="switch-{{ $item->id }}"
                                             {{ $item->status == 1 ? 'checked' : '' }}>
                                         <label class="form-check-label"
                                             for="switch-{{ $item->id }}">{{ $item->status == 1 ? 'Bật' : 'Tắt' }}</label>
                                     </div>
                                 </td>
                                 <td>
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button type="button" class="btnActionProductAdmin2">
                                             <a href="{{ route('articleEdit', $item->id) }}"
                                                 class="text-decoration-none text-light">
                                                 <i class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Sửa lại bài
                                                 viết
                                             </a>
                                         </button>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 <nav class="navPhanTrang">
                     {{ $atc->links() }}
                 </nav>
             </div>
         </form>
     </div>

 @endsection
 @section('articleAdminScript')
     <script>
         function deleteAllArticle(url) {
             const selectedArticles = document.querySelectorAll('input[name="article_ids[]"]:checked');
             if (selectedArticles.length === 0) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Cảnh báo!',
                     text: 'Vui lòng chọn ít nhất một bài viết để xóa.',
                     confirmButtonText: 'Đồng ý',
                     width: '400px',
                     confirmButtonColor: "#3085d6"

                 });
                 return;
             }
             Swal.fire({
                 title: "Bạn có chắc chắn muốn xóa bài viết không?",
                 icon: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#3085d6",
                 cancelButtonColor: "#d33",
                 confirmButtonText: "Tôi đồng ý!",
                 cancelButtonText: "không!",
                 customClass: {
                     title: 'custom-title-h1' // Thêm lớp tùy chỉnh cho tiêu đề
                 }
             }).then((result) => {
                 if (result.isConfirmed) {
                     submitForm(url, 'post');
                 }
             });
         }
     </script>
     <script>
         $(document).ready(function() {
             $('.form-check-input').on('click', function() {
                 var article_id = $(this).data('id'); // Lấy ID bài viết
                 var status = $(this).is(':checked') ? 1 : 0; // Xác định trạng thái
                 var label = $(this).siblings('label'); // Lấy label liền kề
                 updateStatusArticle(article_id, status, label);
             });
         });

         function updateStatusArticle(article_id, status, label) {
             $.ajax({
                 url: '{{ route('updateStatusArticle', ':id') }}'.replace(':id', article_id),
                 type: 'PUT',
                 data: {
                     '_token': '{{ csrf_token() }}', // CSRF token
                     'status': status
                 },
                 success: function(response) {
                     if (response.success) {
                         // Cập nhật trạng thái
                         label.text(status == 1 ? 'Bật' : 'Tắt');
                     }
                 },
                 error: function(error) {
                     console.error('Lỗi khi cập nhật trạng thái bài viết: ', error);
                     alert('Có lỗi xảy ra. Vui lòng thử lại!');
                 }
             });
         }
     </script>

 @endsection
