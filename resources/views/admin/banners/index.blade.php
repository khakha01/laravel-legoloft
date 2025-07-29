@extends('admin.layout.layout')
@Section('title', 'Admin | Hình ảnh banner')

@section('content')
    <div class="container-fluid py-4">
        <div style="display: flex;justify-content: space-between;padding: 55px 0 0 0;">
            <h1 class="mb-4">Banner List</h1>
            <div style="display: flex;justify-content: flex-end;align-items: center;column-gap: 5px;">
                <a href="{{ route('banners.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create New Banner
                </a>
                <button type="button" class="btn btn-danger" onclick="deleteSelectedBanners()">
                    <i class="fa fa-trash"></i> Delete All
                </button>
            </div>
        </div>

        <form>
            @csrf
            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>List Banners</h4>
                <table class="table table-bordered pt-3">
                    <thead>
                        <tr>

                            <th scope="col">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Image Sub</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $banner->id }}" class="select-item">
                                </td>
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->title ?? 'N/A' }}</td>
                                <td>
                                    @if ($banner->image_desktop)
                                        <img src="{{ asset($banner->image_desktop) }}" alt="Desktop Image"
                                            class="img-fluid rounded" style="max-height: 80px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif

                                    @if ($banner->image_mobile)
                                        <img src="{{ asset($banner->image_mobile) }}" alt="Mobile Image"
                                            class="img-fluid rounded" style="max-height: 80px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="banner_td_list_sub">
                                        @foreach ($banner->subBanners as $subBanner)
                                            @if ($subBanner->image_desktop)
                                                <img src="{{ asset($subBanner->image_desktop) }}" alt="Desktop Image"
                                                    class="img-fluid rounded"
                                                    style="height: 100px; object-fit: contain; width: 100px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        @endforeach

                                        @foreach ($banner->subBanners as $subBanner)
                                            @if ($subBanner->image_mobile)
                                                <img src="{{ asset($subBanner->image_mobile) }}" alt="Desktop Image"
                                                    class="img-fluid rounded"
                                                    style="height: 100px; object-fit: contain; width: 100px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('banners.edit', $banner) }}"
                                            class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger"
                                            onclick="deleteBanner({{ $banner->id }})">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No banners found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>

    </form>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.select-item');

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
            });
        });
    </script>
    <script>
        function deleteBanner(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: '/admin/banners/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        // Reload trang hoặc xóa row khỏi table
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to delete');
                        console.log(error);
                    }
                });
            }
        }
    </script>

    <script>
        function deleteSelectedBanners() {
            if (confirm('Are you sure you want to delete selected banners?')) {
                // Lấy danh sách id đã check
                var ids = [];
                $('input[name="ids[]"]:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    alert('No banners selected');
                    return;
                }

                $.ajax({
                    url: '{{ route('banners.destroySelected') }}',
                    type: 'POST',
                    data: {
                        ids: ids
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Reload hoặc xóa từng row đã xóa khỏi table
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Failed to delete selected banners');
                        console.log(xhr.responseText);
                    }
                });
            }
        }
    </script>
    <style>

    </style>
@endsection
