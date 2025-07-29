 @extends('admin.layout.layout')
 @Section('title', 'Admin | Chỉnh sửa nhóm quản trị viên')
 @Section('content')

     <div class="container-fluid">

         <div class="d-flex justify-content-between my-3">
             <div class=""></div>
             <div>
                 <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('adminstrationGroup') }}">Quay
                     lại</a>
             </div>

         </div>

         <form action="{{ route('editAdminstrationGroup', $administrationGroup->id) }}" method="post" class="formAdmin"
             enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class="">
                     <h3 class="title-page ">
                         Chỉnh sửa nhóm quản trị
                     </h3>
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>

             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tên nhóm quản trị</label>
                 <input type="text" class="form-control" name="name" value="{{ $administrationGroup->name }}">
                 @error('name')
                     <div class="text-danger" id="alert-message">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái quyền</label>
                 <select class="form-select " aria-label="Default select example" name="access_full">
                     <option value="1"{{ $administrationGroup->access_full == 1 ? 'selected' : '' }}>Toàn quyền
                     </option>
                     <option value="0" {{ $administrationGroup->access_full == 0 ? 'selected' : '' }}>Không toàn quyền
                     </option>
                 </select>
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Màu của nhóm quản trị</label>
                 <input type="text" class="form-control" name="color" value="{{ $administrationGroup->color }}">
             </div>




             <div class="row mt-3">
                 <label for="title" class="form-label">Thiết lập quền hạn </label>

                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input id="banner" type="checkbox" name="permission[]" value="banner"
                                     {{ in_array('banner', $permissionGroupGet) ? 'checked' : '' }}><!-- Kiểm tra xem giá trị "banner" có trong mảng $permissionGroupGet hay không-->

                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý hình ảnh(Banner)</p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="bannerAdd"
                                         {{ in_array('bannerAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="bannerEdit"
                                         {{ in_array('bannerEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="bannerCheckboxDelete"
                                         {{ in_array('bannerCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="category" id="category"
                                     {{ in_array('category', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý danh mục(Category) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="categoryAdd"
                                         {{ in_array('categoryAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="categoryEdit"
                                         {{ in_array('categoryEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="categoryCheckboxDelete"
                                         {{ in_array('categoryCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="product"
                                     id="product" {{ in_array('product', $permissionGroupGet) ? 'checked' : '' }}>

                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý sản phẩm(Product) </p>
                         </div>

                         <div class="d-flex">
                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="productAdd"
                                         {{ in_array('productAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="productEdit"
                                         {{ in_array('productEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="productCheckboxDelete"
                                         {{ in_array('productCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="coupon"
                                     id="coupon" {{ in_array('coupon', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý mã giảm giá(Coupon) </p>
                         </div>
                         <div class="d-flex">

                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="couponAdd"
                                         {{ in_array('couponAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="couponEdit"
                                         {{ in_array('couponEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="couponCheckboxDelete"
                                         {{ in_array('couponCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row pt-3">
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex  col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="order"
                                     id="order"{{ in_array('order', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý đơn hàng(Order) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>...</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="orderEdit"{{ in_array('orderEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="user"
                                     id="user" {{ in_array('user', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý khách hàng(User) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="userAdd"
                                         {{ in_array('userAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="userEdit"
                                         {{ in_array('userEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="userCheckboxDelete"{{ in_array('userCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex  col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="userGroup"
                                     id="userGroup"{{ in_array('userGroup', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý nhóm khách hàng(UserGroup) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="userGroupAdd"
                                         {{ in_array('userGroupAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="userGroupEdit"{{ in_array('userGroupEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="userGroupCheckboxDelete"
                                         {{ in_array('userGroupCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="administration"
                                     id="administration"{{ in_array('administration', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý quản trị viên(Administration) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="adminstrationAdd"
                                         {{ in_array('adminstrationAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="adminstrationEdit"
                                         {{ in_array('adminstrationEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="adminstrationCheckboxDelete"
                                         {{ in_array('adminstrationCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row pt-3">
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                                     id="administrationGroup"{{ in_array('administrationGroup', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý nhóm quản trị(AdministrationGroup) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]"
                                         value="adminstrationGroupAdd"
                                         {{ in_array('adminstrationGroupAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="adminstrationGroupEdit"
                                         {{ in_array('adminstrationGroupEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="adminstrationGroupCheckboxDelete"{{ in_array('adminstrationGroupCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="categoryArticle"
                                     id="categoryArticle"
                                     {{ in_array('categoryArticle', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý danh mục bài viết(Category Article) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]"
                                         value="categoryArticleAdd"
                                         {{ in_array('categoryArticleAdd', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="categoryArticleEdit"
                                         {{ in_array('categoryArticleEdit', $permissionGroupGet) ? 'checked' : '' }}>

                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="categoryArticleCheckboxDelete"
                                         {{ in_array('categoryArticleCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>

                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="article"
                                     id="article"{{ in_array('article', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý bài viết(Article) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="articleAdd"
                                         {{ in_array('articleAdd', $permissionGroupGet) ? 'checked' : '' }}>

                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="articleEdit"
                                         {{ in_array('articleEdit', $permissionGroupGet) ? 'checked' : '' }}>

                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="articleCheckboxDelete"
                                         {{ in_array('articleCheckboxDelete', $permissionGroupGet) ? 'checked' : '' }}>

                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="assembly"
                                     id="assembly"{{ in_array('assembly', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý đơn hàng lắp ráp (Assembly)</p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>...</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="assemblyEdit"{{ in_array('assemblyEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>

             <div class="row pt-3">

                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="assemblyPackages"
                                     id="assemblyPackages"
                                     {{ in_array('assemblyPackages', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý gói quà tặng(AssemblyPackage)</p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]"
                                         value="assemblyPackageAdd"
                                         {{ in_array('assemblyPackageAdd', $permissionGroupGet) ? 'checked' : '' }}>

                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Thêm</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="assemblyPackageEdit"
                                         {{ in_array('assemblyPackageEdit', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Sửa </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="assemblyPackageDeleteCheckbox"
                                         {{ in_array('assemblyPackageDeleteCheckbox', $permissionGroupGet) ? 'checked' : '' }}>

                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">

                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="comment"
                                     id="comment"{{ in_array('comment', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý bình luận(Comment) </p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>...</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="favourite"
                                     id="favourite"{{ in_array('favourite', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý sản phẩm yêu thích (Favourite)</p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>...</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">
                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="cart"
                                     id="cart"{{ in_array('cart', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý giỏ hàng(Cart)</p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>...</p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]" value="" disabled>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>... </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="row pt-3">

                 <div class="col-md-3 col_rule_admin">
                     <div class="col_rule_admin_item">

                         <div class="d-flex col_rule_height">
                             <label class="checkbox-btnGroup">
                                 <label for="checkbox"></label>
                                 <input type="checkbox" class="" name="permission[]" value="contact"
                                     id="contact"{{ in_array('contact', $permissionGroupGet) ? 'checked' : '' }}>
                                 <span class="checkmark"></span>
                             </label>
                             <p>Quản lý liên hệ(Contact)</p>
                         </div>
                         <div class="d-flex">
                             <div class="d-flex ">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input id="checkbox" type="checkbox" name="permission[]"
                                         value="contactResponse"{{ in_array('contactResponse', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Gửi phàn hồi</p>
                             </div>

                             <div class="d-flex ps-3">
                                 <label class="checkbox-btnGroup">
                                     <label for="checkbox"></label>
                                     <input type="checkbox" class="" name="permission[]"
                                         value="contactDeleteCheckbox"{{ in_array('contactDeleteCheckbox', $permissionGroupGet) ? 'checked' : '' }}>
                                     <span class="checkmark"></span>
                                 </label>
                                 <p>Xóa </p>
                             </div>
                         </div>

                     </div>
                 </div>

             </div>
         </form>
     </div>

 @endsection
