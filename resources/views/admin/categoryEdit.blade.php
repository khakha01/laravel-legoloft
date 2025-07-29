 @extends('admin.layout.layout')
 @Section('title', 'Admin | Chỉnh sửa danh mục')
 @Section('content')

     <div class="container-fluid">

         <div class="d-flex justify-content-end align-items-center  my-3">

             <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('category') }}">Quay
                 lại</a>
         </div>

         <form action="{{ route('categoryUpdate', $category->id) }}" method="post" class="formAdmin"
             enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa danh mục
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tên danh mục</label>
                 <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name"
                     value="{{ $category->name }}">
                 @error('name')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <div class="d-flex">
                     <label for="slug" class="form-label pe-2">Slug</label>
                     <label class="containerSlug">
                         <input type="checkbox"id="off_slug" onclick="toggleSlug()">Tắt tự động
                         <div class="checkmarkSlug"></div>
                     </label>
                 </div>
                 <input type="text" class="form-control" id="convert_slug" name="slug" value="{{ $category->slug }}">
                 @error('slug')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="description" class="form-label">Mô tả </label>
                 <textarea class="form-control " id="" name="description" rows="6" col="50">{{ $category->description }}</textarea>
                 @error('description')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="exampleInputFile" class="form-label">Hình ảnh danh mục</label>
                 <div class="custom-file imageAdd p-3 ">
                     <div class="imageFile">
                         @if ($category->image)
                             <img src="{{ asset('img/' . $category->image) }}" alt="Ảnh xem trước" width="300"
                                 height="300" />
                         @else
                             <div id="preview"><img src="{{ asset('img/lf.png') }}" alt="">
                             </div>
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
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group-image">
                             <div class="imageFile">
                                 @if ($category->image_2)
                                     <img src="{{ asset($category->image_2) }}" alt="Desktop Image" class="preview-img">
                                 @else
                                     <img id="image_2_preview" src="">
                                 @endif
                             </div>
                             <div class="input-group">
                                 <input id="image_2" class="form-control mb-2" type="text" name="image_2"
                                     placeholder="Image Desktop URL"
                                     value="{{ old('image_2', $category->image_2 ?? '') }}">
                                 <span class="input-group-btn">
                                     <button type="button" data-input="image_2" data-preview="image_2_preview"
                                         class="btn btn-primary lfm">
                                         <i class="fa fa-picture-o"></i> Choose
                                     </button>
                                 </span>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group-image">
                             <div class="imageFile">
                                 @if ($category->image_3)
                                     <img src="{{ asset($category->image_3) }}" alt="Desktop Image" class="preview-img">
                                 @else
                                     <img id="image_3_preview" src="">
                                 @endif
                             </div>
                             <div class="input-group">
                                 <input id="image_3" class="form-control mb-2" type="text" name="image_3"
                                     placeholder="Image Desktop URL"
                                     value="{{ old('image_3', $category->image_3 ?? '') }}">
                                 <span class="input-group-btn">
                                     <button type="button" data-input="image_3" data-preview="image_3_preview"
                                         class="btn btn-primary lfm">
                                         <i class="fa fa-picture-o"></i> Choose
                                     </button>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="form-group mt-3">
                 <label for="description" class="form-label">Lựa chọn danh mục cha</label>
                 <select class="form-select " name="parent_id">
                     @foreach ($categoryNull as $item)
                         <option value="{{ $item->id }}" {{ $category->parent_id == $item->id ? 'selected' : 0 }}>
                             {{ $item->name }}
                         </option>
                     @endforeach
                 </select>
                 @error('parent_id')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Thứ tự xuất hiện</label>
                 <input type="text" class="form-control" name="sort_order" value="{{ $category->sort_order }}">
                 @error('sort_order')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Danh mục được chọn</label>
                 <select class="form-select" aria-label="Default select example" name="choose">
                     <option value="0"{{ $category->choose == 0 ? 'selected' : '' }}>Tắt danh mục được lựa chọn
                     </option>
                     <option value="1"{{ $category->choose == 1 ? 'selected' : '' }}>Bật danh mục được lựa chọn
                     </option>
                 </select>
                 @error('choose')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select" aria-label="Default select example" name="status">
                     <option value="0"{{ $category->status == 0 ? 'selected' : '' }}>Tắt</option>
                     <option value="1"{{ $category->status == 1 ? 'selected' : '' }}>Bật</option>
                 </select>
                 @error('status')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái section</label>
                 <select class="form-select" aria-label="Default select example" name="status_section">
                     <option value="0"{{ $category->status_section == 0 ? 'selected' : '' }}>Tắt</option>
                     <option value="1"{{ $category->status_section == 1 ? 'selected' : '' }}>Bật</option>
                 </select>
                 @error('status_section')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
         </form>
     </div>

 @endsection
