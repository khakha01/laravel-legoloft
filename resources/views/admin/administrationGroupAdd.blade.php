@extends('admin.layout.layout')
@Section('title', 'Admin | Thêm nhóm quản trị viên')
@Section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a id="back-link" class="text-decoration-none text-light bg-31629e py-2 px-2"
                href="{{ route('adminstrationGroup') }}">Quay lại</a>
        </div>

        <form action="{{ route('addFormAdminstrationGroup') }}" method="post" class="formAdmin">
            @csrf
            <div class="buttonProductForm">

                <div class="">
                    <h3 class="title-page ">
                        Thêm nhóm quản trị
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
                <input type="text" class="form-control" name="name" placeholder="Nhập tên nhóm quản trị">
                @error('name')
                    <div class="text-danger" id="alert-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Trạng thái quyền</label>
                <select class="form-select " aria-label="Default select example" name="access_full">
                    <option selected value="0">--Chọn quyền hạn--</option>
                    <option value="1">Toàn quyền</option>
                    <option value="0">Không toàn quyền</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Màu của nhóm quản trị</label>
                <input type="text" class="form-control" name="color" placeholder="Nhập mã màu">
            </div>



            <div class="row mt-3">
                <label for="title" class="form-label">Thiết lập quền hạn </label>

                <div class="col-md-3 col_rule_admin">
                    <div class="col_rule_admin_item">
                        <div class="d-flex col_rule_height">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input id="banner" type="checkbox" name="permission[]" value="banner">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý hình ảnh(Banner)</p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="bannerAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="bannerEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="bannerCheckboxDelete">
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
                                <input type="checkbox" class="" name="permission[]" value="category" id="category">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý danh mục(Category) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="categoryAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="categoryEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryCheckboxDelete">
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
                                    id="product">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý sản phẩm(Product) </p>
                        </div>

                        <div class="d-flex">
                            <div class="d-flex ">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="productAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="productEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="productCheckboxDelete">
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
                                    id="coupon">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý mã giảm giá(Coupon) </p>
                        </div>
                        <div class="d-flex">

                            <div class="d-flex ">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="couponAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="couponEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="couponCheckboxDelete">
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
                                    id="order">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý đơn hàng(Order) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]"disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>...</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="orderEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" disabled>
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
                                    id="user">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý khách hàng(User) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="userCheckboxDelete">
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
                                    id="userGroup">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý nhóm khách hàng(UserGroup) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userGroupAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userGroupEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="userGroupCheckboxDelete">
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
                                    id="administration">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý quản trị viên(Administration) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="adminstrationAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="adminstrationEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationCheckboxDelete">
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
                                    id="administrationGroup">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý nhóm quản trị(AdministrationGroup) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]"
                                        value="adminstrationGroupAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupCheckboxDelete">
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
                                    id="categoryArticle">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý danh mục bài viết(Category Article) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]"
                                        value="categoryArticleAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryArticleEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryArticleCheckboxDelete">
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
                                    id="article">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý bài viết(Article) </p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="articleAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="articleEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="articleCheckboxDelete">
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
                                    id="assembly">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý đơn hàng lắp ráp (Assembly)</p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <p>...</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="assemblyEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" disabled>
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
                                    id="assemblyPackages">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý gói quà tặng(AssemblyPackage)</p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]"
                                        value="assemblyPackageAdd">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="assemblyPackageEdit">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="assemblyPackageDeleteCheckbox">
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
                                    id="comment">
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
                                    id="favourite">
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
                                    id="cart">
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
                                    id="contact">
                                <span class="checkmark"></span>
                            </label>
                            <p>Quản lý liên hệ(Contact)</p>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="contactResponse">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Gửi phàn hồi</p>
                            </div>

                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="contactDeleteCheckbox">
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


    {{--
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const permissionGroups = {
                'banner': ['bannerAdd', 'bannerEdit', 'bannerCheckboxDelete'],
                'category': ['categoryAdd', 'categoryEdit', 'categoryCheckboxDelete'],
                'product': ['productAdd', 'productEdit', 'productCheckboxDelete'],
                'comment': ,
                'coupon': ['couponAdd', 'couponEdit', 'couponCheckboxDelete'],
                'order': ['orderAdd', 'orderEdit', 'orderCheckboxDelete'],
                'user': ['userAdd', 'userEdit', 'userCheckboxDelete'],
                'userGroup': ['userGroupAdd', 'userGroupEdit', 'userGroupCheckboxDelete'],
                'administration': ['administrationAdd', 'administrationEdit', 'administrationCheckboxDelete'],
                'administrationGroup': ['administrationGroupAdd', 'administrationGroupEdit',
                    'administrationGroupCheckboxDelete'
                ],
                'categoryArticle': ['categoryArticleAdd', 'categoryArticleEdit',
                    'categoryArticleCheckboxDelete'
                ],
                'article': ['articleAdd', 'articleEdit',
                    'articleCheckboxDelete'
                ],
            };

            // Hàm để kích hoạt hoặc vô hiệu hóa các checkbox quyền
            function togglePermisionCheckboxs(mainCheckBoxId) {
                // lấy checkbox đucợ chọn từ người dùng
                const mainCheckBox = document.getElementById(mainCheckBoxId);

                // lấy danh sách các checkbox quyền liên quan dến 1 checkbox chính
                const permissionGroupCheckboxs = permissionGroups[mainCheckBoxId];

                // kiểm tra sự tôn tại
                if (permissionGroupCheckboxs) {
                    //Lặp qua từng giá trị trong mảng
                    permissionGroupCheckboxs.forEach(value => {
                        // lọc tất cả và lấy checkbox có giá trị tương ứng với value trong vòng lặp
                        const checkbox = document.querySelector(
                            `input[name="permission[]"][value="${value}"]`);

                        // nếu tìm thấy value đó
                        if (checkbox) {
                            // thiết lập disabled cho crud dựa trên trạng thái của checbox chính
                            checkbox.disabled = !mainCheckBox
                                .checked; //  nếu vế 2 đucợ chọn và là !true và đảo ngược lên sẽ thành false(được chọn), checkbox.disabled = false => đucợ kích hoạt crud

                            // Nếu mainCheckBox.checked là false (tức là checkbox chính không được chọn), thì !mainCheckBox.checked sẽ trở thành true, và điều kiện trong khối if sẽ được thực thi.
                            if (!mainCheckBox.checked) {
                                checkbox.checked = false; //
                                //Điều này có nghĩa là nếu checkbox chính không được chọn, các checkbox quyền đã đucợ chọn trước đó  sẽ tự động bị bỏ chọn.
                            }
                        }
                    });
                }
            }

            //Kích hoạt hoặc vô hiệu hóa các checkbox con:
            // Object.keys Lấy tất cả các khóa (tên nhóm quyền) từ đối tượng permissionGroups. Mỗi khóa tương ứng với một checkbox chính.
            Object.keys(permissionGroups).forEach(group => { //Duyệt qua từng khóa (tên nhóm quyền) trong mảng.
                const mainCheckbox = document.getElementById(group);
                if (mainCheckbox) {
                    mainCheckbox.addEventListener('change', function() {
                        togglePermisionCheckboxs(group);
                    });
                }
            });
        });
    </script>
  --}}
@endsection
