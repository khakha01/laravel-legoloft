 @extends('admin.layout.layout')
 @Section('title', 'Admin | Chỉnh sửa danh mục')
 @Section('content')

     <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center  my-3">
             <div class=""></div>
             <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('coupon') }}">Quay lại</a>
         </div>

         <form action="{{ route('editCoupon', $coupon->id) }}" method="post" class="formAdmin">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa phiếu giảm giá
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
                 <input type="text" class="form-control" name="name_coupon" value="{{ $coupon->name_coupon }}">
                 @error('name_coupon')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Mã(code)</label>
                 <input type="number" class="form-control" name="code" value="{{ $coupon->code }}">
                 @error('code')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Loại(type)</label>
                 <select class="form-select mt-3" aria-label="Default select example" name="type">
                     <option value="0"{{ $coupon->type == 0 ? 'selected' : '' }}>Giảm theo %</option>
                     <option value="1"{{ $coupon->type == 1 ? 'selected' : '' }}>Số tiền cố định</option>
                 </select>
                 @error('type')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="discount" class="form-label">Giảm giá</label>
                 <input type="text" class="form-control priceFormat" id="price" name="discount"
                     oninput="formatCurrency(this)" value="{{ number_format($coupon->discount, 0, ',', '.') }}">
                 @error('discount')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="total" class="form-label">Tổng cộng</label>
                 <input type="text" class="form-control priceFormat" id="total" name="total"
                     oninput="formatCurrency(this)" value="{{ number_format($coupon->total, 0, ',', '.') }}">
                 @error('total')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Ngày bắt đầu</label>
                 <input type="date" class="form-control" name="date_start" value="{{ $coupon->date_start }}">
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Ngày kết thúc</label>
                 <input type="date" class="form-control" name="date_end" value="{{ $coupon->date_end }}">
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="0"{{ $coupon->status == 0 ? 'selected' : '' }}>Tắt</option>
                     <option value="1"{{ $coupon->status == 1 ? 'selected' : '' }}>Bật</option>
                 </select>
                 @error('status')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
         </form>
     </div>
     <script>
         function formatCurrency(input) {
             // Xóa tất cả ký tự không phải số
             let value = input.value.replace(/[^0-9]/g, '');

             // Định dạng số thành VND
             if (value) {
                 value = Number(value).toLocaleString('vi-VN');
             }

             // Cập nhật giá trị của input
             input.value = value;
         }

         // Hàm để lấy giá trị khi gửi form
         function getRawValue() {
             const inputs = document.querySelectorAll('.priceFormat'); // Lấy tất cả các input có class priceFormat

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
 @endsection
