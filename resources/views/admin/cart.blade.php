 @extends('admin.layout.layout')
 @Section('title', 'Admin | Danh sách sản phẩm giỏ hàng')
 @Section('content')

     <div class="container-fluid">

         <div class="searchAdmin">

             <form id="filterFormCart" action="{{ route('searchCartAdmin') }}" method="POST">
                 @csrf
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-md-12">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc giỏ hàng</label>
                             <select class="form-select  rounded-0" aria-label="Default select example" name="filter_name">
                                 <option value="">Tất cả</option>
                                 @foreach ($cartAll as $item)
                                     <option value="{{ $item->product_id }}"
                                         {{ $item->product_id == $filter_name ? 'selected' : '' }}>
                                         {{ $item->product->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc giỏ hàng</button>
                 </div>
             </form>
         </div>


         <div class="buttonProductForm mt-3">
             <div class=""></div>

             <div class=""> </div>

         </div>

         <div class="border p-2 mt-3">
             <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách sản phẩm yêu thích</h4>
             <table class="table table-bordered  pt-3">
                 <thead class="table-header">
                     <tr class="">
                         <th class=" py-2"></th>
                         <th class=" py-2">Người thêm</th>
                         <th class=" py-2">Hình ảnh</th>
                         <th class=" py-2">Sản phẩm</th>
                     </tr>
                 </thead>

                 <tbody class="table-body">
                     @foreach ($cartAll as $item)
                         <tr class="">
                             <td>
                                 <div class="d-flex justify-content-center align-items-center">
                                     <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                         name="category_id[]" value="{{ $item->id }}">
                                     <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                 </div>
                             </td>
                             <td class="">{{ $item->user->fullname }}</td>
                             <td><img src="{{ asset('img/' . $item->product->image) }}" alt=""
                                     style="width:80px;height:80px;object-fit:contain;"></td>
                             <td class="nameAdmin">
                                 <p>{{ $item->product->name }}</p>
                             </td>

                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
         <nav class="navPhanTrang">
             {{ $cartAll->links() }}
         </nav>
     </div>


 @endsection

 @section('cartAdminScript')
     <script>
         $(document).ready(function() {
             $('#filterFormCart').on('submit', function() {
                 var formData = $(this).serialize();

                 $.ajax({
                     url: '{{ route('searchCartAdmin') }}',
                     type: 'POST',
                     data: formData,
                     success: function(response) {
                         console.log(response);
                         $('.table-body').html(response.html);
                     },
                     error: function(error) {
                         console.error('Lỗi khi lọc' + error);
                     }
                 })
             })
         })
     </script>
 @endsection
