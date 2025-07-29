 @extends('admin.layout.layout')
 @Section('title', 'Admin | Nhóm quản trị viên')
 @Section('content')

     <div class="container-fluid">
         <form id="submitFormAdmin" onsubmit="event.preventDefault();">
             @csrf
             <div class="buttonProductForm">
                 <div class="m-0 p-0">
                     @if (session('error'))
                         <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                     @endif
                     @if (session('success'))
                         <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                     @endif
                 </div>
                 <div class="m-0 p-0">
                     <button type="button" class="btn btnF1"
                         onclick="window.location.href='{{ route('addAdminstrationGroup') }}'">
                         <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo Nhóm quản trị
                     </button>
                     <button class="btn btnF2" type="button"
                         onclick="deleteAllAdministrationGroup('{{ route('deleteAdminstrationGroup') }}')">
                         <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                     </button>
                 </div>
             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh sách nhóm quản trị</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Tên nhóm quản trị</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="">
                         @foreach ($administrationGroup as $item)
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                             name="administrationGroup_id[]" value="{{ $item->id }}">
                                         <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td class="nameAdmin">
                                     <p>{{ $item->name }}</p>
                                 </td>
                                 <td class="m-0 p-0">
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button type="button" class="btnActionProductAdmin2">
                                             <a href="{{ route('editAdminstrationGroup', $item->id) }}"
                                                 class="text-decoration-none text-light">
                                                 <i class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Sửa
                                                 nhóm quản trị</a>
                                         </button>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach

                     </tbody>
                 </table>
                 <nav class="navPhanTrang">
                     {{ $administrationGroup->links() }}
                 </nav>
             </div>
         </form>

         <nav class="navPhanTrang">
             <ul class="pagination">
             </ul>
         </nav>
     </div>

     <script>
         function deleteAllAdministrationGroup(url) {
             const selectedAdministrationGroup = document.querySelectorAll('input[name="administrationGroup_id[]"]:checked');
             if (selectedAdministrationGroup.length === 0) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Cảnh báo!',
                     text: 'Vui lòng chọn ít nhất một quản trị viên để xóa.',
                     confirmButtonText: 'Đồng ý',
                     width: '450px',
                     confirmButtonColor: "#3085d6"

                 });
                 return;
             }
             Swal.fire({
                 title: "Bạn có chắc chắn muốn xóa nhóm quản trị không?",
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
         document.addEventListener("DOMContentLoaded", function() {
             const alertBox = document.getElementById("alertAction");
             const progressBar = document.getElementById("progress-bar");

             // Bắt đầu thanh chạy
             progressBar.style.width = "100%"; // Di chuyển thanh từ 0% đến 100%

             // Sau 5 giây, ẩn alert
             setTimeout(() => {
                 alertBox.style.opacity = "0"; // Từ từ giảm độ mờ
                 setTimeout(() => {
                     alertBox.style.display = "none"; // Ẩn hoàn toàn
                 }, 500); // Thời gian giảm độ mờ
             }, 5000); // Thời gian thanh chạy
         });
     </script>
 @endsection
