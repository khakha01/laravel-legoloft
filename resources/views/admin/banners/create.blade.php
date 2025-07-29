@extends('admin.layout.layout')
@Section('title', 'Admin | Thêm hình ảnh banner')

@section('content')
    <div class="container-fluid">
        <h1>Create Banner</h1>
        @include('admin.banners._form', [
            'action' => route('banners.store'),
            'isEdit' => false,
            'banner' => null,
            'buttonText' => 'Create',
        ])
    </div>
@endsection
