@extends('admin.layout.layout')

@section('content')
    <div class="container-fluid">
        <h1>Edit Banner</h1>
        @include('admin.banners._form', [
            'action' => route('banners.update', $banner),
            'isEdit' => true,
            'banner' => $banner,
            'buttonText' => 'Update',
        ])
    </div>
@endsection
