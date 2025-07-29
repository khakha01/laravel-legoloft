@extends('admin.layout.layout')

@section('content')
    <h1>Banner Detail</h1>
    <p>Title: {{ $banner->title }}</p>
    <p>Description: {{ $banner->description }}</p>
    <p>Href: {{ $banner->href }}</p>
    <p>Button: {{ $banner->button }}</p>

    <a href="{{ route('banners.edit', $banner) }}">Edit</a>
    <a href="{{ route('banners.index') }}">Back</a>
@endsection
