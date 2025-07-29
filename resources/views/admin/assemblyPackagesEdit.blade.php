 @extends('admin.layout.layout')
 @Section('title', 'Admin | Chỉnh sửa gói quà')
 @Section('content')

     <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center  my-3">
             <div class=""></div>
             <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('assemblyPackages') }}">Quay
                 lại</a>
         </div>
         <h3 class="title-page ">
             Chỉnh sửa gói quà
         </h3>

         <form action="{{ route('editAssemblyPackages', $assemblyPackage->id) }}" method="post" class="formAdmin"
             enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class=""></div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="name" class="form-label">Tên gói quà</label>
                 <input type="text" class="form-control" value="{{ old('name', $assemblyPackage->name) }}" name="name"
                     placeholder="Nhập gói quà">
                 @error('name')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="exampleInputFile" class="form-label">Ảnh gói quà</label>
                 <div class="custom-file imageAdd p-3 ">
                     <div class="imageFile">
                         @if (isset($assemblyPackage->image))
                             <img src="{{ asset('img/' . $assemblyPackage->image) }}" alt="">
                         @else
                             <div id="preview"><img src="{{ asset('img/lf.png') }}" alt=""></div>
                         @endif
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
                 <input type="text" class="form-control"
                     value="{{ old('price_assembly', $assemblyPackage->price_assembly) }}" name="price_assembly"
                     placeholder="Nhập giá lắp">
                 @error('price_assembly')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="fee" class="form-label">Giá hộp quà tặng</label>
                 <input type="text" class="form-control" value="{{ old('fee', $assemblyPackage->fee) }}" name="fee"
                     placeholder="Nhập giá hộp quà">
                 @error('fee')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="description" class="form-label">Mô tả</label>
                 <textarea class="form-control ckeditor" id="" name="description" rows="15">{{ old('description', $assemblyPackage->description) }}</textarea>
                 @error('description')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="status" class="form-label">Trạng thái</label>
                 <select class="form-select" name="status">
                     <option value="1" {{ old('status', $assemblyPackage->status) == 1 ? 'selected' : '' }}>Bật
                     </option>
                     <option value="0" {{ old('status', $assemblyPackage->status) == 0 ? 'selected' : '' }}>Tắt
                     </option>
                 </select>
                 @error('status')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
         </form>

     </div>

 @endsection
