@extends('admin.layout.layout')
@Section('title', 'Admin | Chỉnh sửa hình ảnh banner')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('banner') }}">Quay lại</a>
        </div>

        <form action="{{ route('editBanner', $bannner->id) }}" method="post" class="formAdmin" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="buttonProductForm">
                <div class="">
                    <h3 class="title-page ">
                        Chỉnh sửa hình ảnh
                    </h3>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="position" class="form-label">Vị trí banner xuất hiện trên trang web</label>
                <select class="form-select" name="banner_id">
                    @foreach ($bannerName as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $bannner->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row mt-5">
                <h4 class="title-page ">
                    Thông tin chi tiết banner </h4>
            </div>

            <div class="row bannnerImagesEdit bannerImagePUT">
                @foreach ($bannerImages as $image)
                    <div class="row banner_row p-3">
                        <div class="col-md-5 pe-3">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <label for="image_desktop" class="form-label">Hình ảnh Desktop</label>
                                    <div class="imageAdd image-preview-wrapper p-3">
                                        <div class="input-group">
                                            <input id="image_desktop" class="form-control" type="text"
                                                name="image_desktop"
                                                value="{{ old('image_desktop', $image->image_desktop ?? '') }}">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary lfm" type="button"
                                                    data-input="image_desktop" data-preview="preview_desktop">
                                                    <i class="fa fa-picture-o"></i> Chọn ảnh
                                                </button>
                                            </span>
                                        </div>

                                        <div class="mt-2">
                                            <img id="preview_desktop" style="max-height: 150px;"
                                                src="{{ !empty($image->image_desktop) ? asset($image->image_desktop) : asset('img/lf.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12 pt-2">
                                    <label for="example" class="form-label">Hình ảnh mobile</label>
                                    <div class="imageAdd image-preview-wrapper p-3 ">
                                        <div class="previewImages">
                                            @if (!empty($image->image_mobile))
                                                <img class="preview-image" src="{{ asset('img/' . $image->image_mobile) }}"
                                                    alt="legoloft">
                                            @else
                                                <img class="preview-image" src="{{ asset('img/lf.png') }}" alt="legoloft">
                                            @endif
                                        </div>
                                        <div class="m-0 p-0 ps-3">
                                            <label class="custom-file-upload">
                                                Thay đổi hình ảnh
                                            </label>
                                            <input type="file" name="image_mobile[]" class="image-input"
                                                style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 pe-2 ">
                                    <label for="title" class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control" name="title[]" aria-describedby="title"
                                        value="{{ $image->title }}">
                                </div>

                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6 col-sm-12 col-12 pe-2 ">
                                    <label for="link_tab" class="form-label">Liên kết tab</label>
                                    <input type="text" class="form-control" name="link_tab[]"
                                        value="{{ $image->link_tab }}">
                                </div>
                                <div class="col-md-6 col-sm-12 col-12 pe-2">
                                    <label for="title" class="form-label">Nội dung button</label>
                                    <input type="text" class="form-control" name="content_button[]" id=""
                                        value="{{ $image->content_button }}">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6 col-sm-12 col-12 pe-2">
                                    <label for="title" class="form-label">Thứ tự xuất hiện</label>
                                    <input type="number" class="form-control" name="sort_order[]" id=""
                                        aria-describedby="" value="{{ $image->sort_order }}">
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <label for="title" class="form-label">Trạng thái</label>
                                    <select class="form-select" aria-label="Default select example" name="status[]">
                                        <option value="0" {{ $image->status == 0 ? 'selected' : '' }}>Vô hiệu hóa
                                        </option>
                                        <option value="1" {{ $image->status == 1 ? 'selected' : '' }}>Kích hoạt
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <label for="title" class="form-label">Mô tả</label>
                                    <textarea name="description[]" class="form-control"cols="20" rows="10">{{ $image->description }}</textarea>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-1">
                            <div class="row">
                                <a href="{{ route('deleteBannerAdminItem', $image->id) }}" class="btn-delete"><i
                                        class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row pt-3">
                <div class="col-md-6">
                    <button type="button" class="btn-add add-bannerImage">Thêm hình ảnh</button>
                </div>
            </div>

        </form>
    </div>


@endsection


@section('addBannerAdminScript')
    <script>
        $(document).ready(function() {
            let imageBannerTemplate = `
                <div class="row banner_row p-3">
                    <div class="col-md-5 pe-3">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <label for="image_desktop" class="form-label">Hình ảnh </label>
                                <div class="imageAdd image-preview-wrapper p-3 ">
                                    <div class="previewImages">
                                        <img class="preview-image" src="{{ asset('img/lf.png') }}" alt="legoloft">
                                    </div>
                                    <div class="m-0 p-0 ps-3">
                                        <label class="custom-file-upload">
                                            Thay đổi hình ảnh
                                        </label>
                                        <input type="file" name="image_desktop[]" class="image-input "
                                            style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12 pt-2">
                                <label for="example" class="form-label">Hình ảnh mobile</label>
                                <div class="imageAdd image-preview-wrapper p-3 ">
                                   <div class="previewImages">
                                            <img class="preview-image" src="{{ asset('img/lf.png') }}" alt="legoloft">
                                    </div>
                                    <div class="m-0 p-0 ps-3">
                                        <label class="custom-file-upload">
                                            Thay đổi hình ảnh
                                        </label>
                                        <input type="file" name="image_mobile[]" class="image-input "
                                            style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 pe-2 ">
                                <label for="title" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" name="title[]" aria-describedby="title"
                                    placeholder="Nhập tiêu đề hình ảnh ">
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-6 col-sm-12 col-12 pe-2 ">
                                <label for="link_tab" class="form-label">Liên kết tab</label>
                                <input type="text" class="form-control" name="link_tab[]" aria-describedby="link_tab"
                                    placeholder="Nhập liên kết">
                            </div>
                            <div class="col-md-6 col-sm-12 col-12 pe-2">
                                <label for="content_button" class="form-label">Nội dung button</label>
                                <input type="text" class="form-control" name="content_button[]" id=""
                                    aria-describedby="" placeholder="Nhập nội dung button">
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-6 col-sm-12 col-12 pe-2">
                                <label for="sort_order" class="form-label">Thứ tự xuất hiện</label>
                                <input type="number" class="form-control" name="sort_order[]" id="" aria-describedby=""
                                    placeholder="Nhập thứ tự">
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-select" aria-label="Default select example" name="status[]">
                                    <option value="0">Vô hiệu hóa</option>
                                    <option value="1">Kích hoạt</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12 col-sm-12 col-12">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea name="description[]" class="form-control"cols="20" rows="10"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-1">
                        <button class="remove_bannerImages_add" href="">Xóa</button>
                    </div>
                </div>
            `;

            $('.add-bannerImage').click(function() {
                $('.bannerImagePUT').append(imageBannerTemplate.trim());
                initImagePreview();
            });

            $(document).on('click', '.remove_bannerImages_add', function() {
                $(this).closest('.banner_row').remove();
            })

            $(document).on('click', '.custom-file-upload', function() {
                $(this).next('.inputFile').click();
            })
        });
    </script>
    <script></script>
@endsection
