 @extends('admin.layout.layout')
 @Section('title', 'Admin| Thêm khách hàng mới')
 @Section('content')

     <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center  my-3">
             <div class=""></div>
             <a id="back-link" class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('userAdmin') }}">Quay
                 lại</a>
         </div>
         <form class="formAdmin" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Thêm khách hàng mới
                     </h3>


                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>
             <div class="form-group mt-3">
                 <label for="fullname" class="form-label">Họ tên khách hàng</label>
                 <input type="text" class="form-control" id="fullname" name="fullname">
                 @error('fullname')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="name" class="form-label">Tên đăng nhập</label>
                 <input type="text" class="form-control" id="name" name="name">
                 @error('name')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="email" class="form-label">Email</label>
                 <input type="email" class="form-control" id="email" name="email">
                 @error('email')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="phone" class="form-label">Số điện thoại</label>
                 <input type="text" class="form-control" id="phone" name="phone" maxlength="15">
                 @error('phone')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="password" class="form-label">Mật khẩu </label>
                 <input type="password" class="form-control" id="password" name="password">
                 @error('password')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="" class="form-label">Xác nhận lại mật khẩu </label>
                 <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                 @error('password')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tỉnh thành</label>
                 <select class="form-select selectForm " name="province" id="province">
                     <option selected disabled>Tỉnh/Thành phố</option>
                 </select>
                 @error('province')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Quận huyện</label>
                 <select class="form-select selectForm " name="district" id="district">
                     <option selected disabled>Quận/Huyện</option>
                 </select>
                 @error('district')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Phường xã</label>
                 <select class="form-select selectForm " name="ward" id="ward">
                     <option selected disabled>Phường/Xã</option>
                 </select>
                 @error('ward')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="address" class="form-label">Địa chỉ:</label>
                 <input type="text" class="form-control" id="address" name="address">
                 @error('address')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="exampleInputFile" class="form-label">Hình ảnh đại diện khách hàng</label>
                 <div class="custom-file imageAdd p-3 ">
                     <div class="imageFile">
                         <div id="preview"><img src="{{ asset('img/user1.jpg') }}" alt=""></div>
                     </div>
                     <div class="">
                         <input type="file" name="image" id="HinhAnh" class="inputFile">
                     </div>
                 </div>

             </div>
             <div class="form-group mt-3">
                 <label for="description" class="form-label">Chọn nhóm khách hàng</label>
                 <select class="form-select " name="user_group_id">
                     <option selected disabled>--nhóm khách hàng--</option>
                     @foreach ($userGroups as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                     @endforeach
                 </select>
                 @error('user_group_id')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="" class="form-label">Trạng thái</label>
                 <select class="form-select " name="status">
                     <option selected disabled selected>Trạng thái</option>
                     <option value="1">Kích hoạt</option>
                     <option value="0">Vô hiệu hóa</option>
                 </select>
                 @error('status')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
         </form>
     </div>

 @endsection
