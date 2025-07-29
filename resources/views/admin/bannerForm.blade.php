@extends('admin.layout.layout')

@section('title', isset($bannerImage) ? 'Chỉnh sửa banner' : 'Thêm banner mới')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center my-3">
            <a class="btn btn-secondary" href="{{ route('banner') }}">Quay lại</a>
        </div>

        <form action="{{ route('banner.handle', isset($bannerImage) ? $bannerImage->id : '') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @if (isset($bannerImage))
                @method('put')
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>{{ isset($bannerImage) ? 'Chỉnh sửa banner' : 'Thêm banner mới' }}</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Vị trí banner</label>
                        <select name="banner_id" class="form-control" required>
                            @foreach ($bannerName as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($bannerImage) && $bannerImage->banner_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hình ảnh Desktop</label>
                                <input type="file" name="image_desktop" class="form-control"
                                    {{ !isset($bannerImage) ? 'required' : '' }}>
                                @if (isset($bannerImage) && $bannerImage->image_desktop)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/banners/' . $bannerImage->image_desktop) }}"
                                            alt="Desktop Banner" style="max-height: 150px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hình ảnh Mobile</label>
                                <input type="file" name="image_mobile" class="form-control"
                                    {{ !isset($bannerImage) ? 'required' : '' }}>
                                @if (isset($bannerImage) && $bannerImage->image_mobile)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/banners/' . $bannerImage->image_mobile) }}"
                                            alt="Mobile Banner" style="max-height: 150px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Tiêu đề</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ $bannerImage->title ?? old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Liên kết</label>
                        <input type="url" name="link_tab" class="form-control"
                            value="{{ $bannerImage->link_tab ?? old('link_tab') }}">
                    </div>

                    <div class="form-group">
                        <label>Nội dung button</label>
                        <input type="text" name="content_button" class="form-control"
                            value="{{ $bannerImage->content_button ?? old('content_button') }}">
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control" rows="3">{{ $bannerImage->description ?? old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thứ tự hiển thị</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ $bannerImage->sort_order ?? old('sort_order', 0) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control" required>
                                    <option value="1"
                                        {{ isset($bannerImage) && $bannerImage->status ? 'selected' : '' }}>Kích hoạt
                                    </option>
                                    <option value="0"
                                        {{ isset($bannerImage) && !$bannerImage->status ? 'selected' : '' }}>Vô hiệu hóa
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($bannerImage) ? 'Cập nhật' : 'Thêm mới' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
