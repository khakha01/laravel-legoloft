 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thêm gói quà')
 @Section('content')

     <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center  my-3">
             <div class=""></div>
             <a id="back-link" class="text-decoration-none text-light bg-31629e py-2 px-2"
                 href="{{ route('assemblyPackages') }}">Quay lại</a>
         </div>
         <form action="{{ route('assemblyPackageAddForm') }}" method="post" class="formAdmin" enctype="multipart/form-data">
             @csrf
             <div class="buttonProductForm">

                 <div class="">
                     <h3 class="title-page ">
                         Thêm gói quà
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd" id="submit-button">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>
             <div class="form-group mt-3">
                 <label for="name" class="form-label">Tên gói quà </label>
                 <input type="text" class="form-control" name="name" placeholder="Nhập tên gói quà">
                 @error('name')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="exampleInputFile" class="form-label">Hình ảnh gói quà</label>
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

             <div class="form-group mt-3">
                 <label for="price_assembly" class="form-label">Giá lắp</label>
                 <input type="text" class="form-control" name="price_assembly" placeholder="Nhập giá lắp">
                 @error('price_assembly')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="fee" class="form-label">Giá hộp quà tặng</label>
                 <input type="text" class="form-control" name="fee" placeholder="Nhập giá hộp quà">
                 @error('fee')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="description" class="form-label">Mô tả </label>
                 <textarea class="form-control ckeditor" id="editor1" name="description" rows="10" col="80"></textarea>
                 @error('description')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="1" disabled selected> Chon Trang thái</option>
                     <option value="1">Bật</option>
                     <option value="0">Tắt</option>
                 </select>
                 @error('status')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
         </form>
     </div>

 @endsection
