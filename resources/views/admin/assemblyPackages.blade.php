@extends('admin.layout.layout')
@Section('title', 'Admin | Danh sách gói quà')
@Section('content')

    <div class="container-fluid">


        <form id="submitFormAdmin">
            @csrf
            <div class="buttonProductForm mt-3">
                <div class="m-0 p-0">
                    @if (session('error'))
                        <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="">
                    <a href="{{ route('assemblyPackageAdd') }}" class="btn btnF1 text-decoration-none text-light">
                        <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo gói quà
                    </a>
                    <button class="btn btnF2" type="button"
                        onclick="deleteAllAssemblyPackages('{{ route('deleteAssemblyPackages') }}')">
                        <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa gói quà đã chọn
                    </button>

                </div>
            </div>

            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Gói Quà</h4>

                <table class="table table-bordered pt-3">
                    <thead class="table-header">
                        <tr>
                            <th class="py-2"></th>
                            <th class="py-2">Hình ảnh</th>
                            <th class="py-2">Tên gói</th>
                            <th class="py-2">Giá lắp</th>
                            <th class="py-2">Tiền hộp quà</th>
                            <th class="py-2">Trạng thái</th>
                            <th class="py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($assemblyPackages as $item)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <input type="checkbox" id="cbx_{{ $item->id }}" class="hidden-xs-up"
                                            name="assembyPackage_id[]" value="{{ $item->id }}">
                                        <label for="cbx_{{ $item->id }}" class="cbx"></label>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('img/' . $item->image) }}" alt=""
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('img/lf.png') }}"
                                            alt=""style="width: 80px; height: 80px; object-fit: cover;">
                                    @endif

                                </td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {{ number_format($item->price_assembly, 0, ',', '.') . 'đ' }}
                                </td>
                                <td>
                                    {{ number_format($item->fee, 0, ',', '.') . 'đ' }}
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            data-id="{{ $item->id }}" id="switch-{{ $item->id }}"
                                            {{ $item->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="switch-{{ $item->id }}">{{ $item->status == 1 ? 'Bật' : 'Tắt' }}</label>
                                    </div>
                                </td>

                                <td class="m-0 p-0">
                                    <div class="actionAdminProduct">
                                        <div class="buttonProductForm m-0 py-3">
                                            <button type="button" class="btnActionProductAdmin2"><a
                                                    href="{{ route('editAssemblyPackages', $item->id) }}"
                                                    class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                        style="color: #ffffff;"></i>Chỉnh
                                                    sửa</a></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        </table>
        <nav class="navPhanTrang">
            {{ $assemblyPackages->links() }}
        </nav>

    </div>

@endsection

@section('AssemblyPackagesAdminScript')
    <script>
        $(document).ready(function() {
            $('.form-check-input').on('click', function() {
                var assembyPackage_id = $(this).data('id'); // Lấy ID gói quà
                var status = $(this).is(':checked') ? 1 : 0; // Xác định trạng thái
                var label = $(this).siblings('label'); // Lấy label liền kề
                updateStatusAssemblyPackages(assembyPackage_id, status, label);
            });
        });

        function updateStatusAssemblyPackages(assembyPackage_id, status, label) {
            $.ajax({
                url: '{{ route('assemblyPackageUpdateStatus', ':id') }}'.replace(':id', assembyPackage_id),
                type: 'PUT',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status
                },
                success: function(response) {
                    console.log('Cập nhật trạng thái gói quà thành công');
                    label.text(status == 1 ? 'Bật' : 'Tắt'); // Cập nhật label
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi cập nhật trạng thái gói quà: ' + error);
                    alert('Có lỗi xảy ra. Vui lòng thử lại!');
                }
            });
        }
    </script>

    <script>
        function deleteAllAssemblyPackages(url) {
            const selectedAssemblyPackages = document.querySelectorAll('input[name="assembyPackage_id[]"]:checked');
            if (selectedAssemblyPackages.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cảnh báo!',
                    text: 'Vui lòng chọn ít nhất một gói quà để xóa.',
                    confirmButtonText: 'Đồng ý',
                });
                return;
            }
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa gói quà không?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tôi đồng ý!",
                cancelButtonText: "không!",
                customClass: {
                    title: 'custom-title-h1' // Thêm lớp tùy chỉnh cho tiêu đề
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm(url, 'post');
                }
            });
        }
    </script>
@endsection
