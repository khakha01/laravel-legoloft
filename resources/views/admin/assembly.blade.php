@extends('admin.layout.layout')
@Section('title', 'Admin | Đơn hàng lắp ráp')
@Section('content')
    <div class="container-fluid">

        <div class="buttonProductForm mt-3">
            <div class="">
                @if (session('error'))
                    <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                @endif
            </div>
            <div class=""></div>
        </div>
        @if ($admin->administrationGroup->access_full == 1)
            <div class="searchAdmin">
                <form id="filterFormAssembly" action="{{ route('searchAssemblyAdmin') }}" method="POST">
                    @csrf
                    <div class="row d-flex flex-row justify-content-between align-items-center">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="filter_name">Tên Nhân Viên Lắp Ráp</label>
                                <select class="form-select rounded-0" name="filter_name" id="filter_name">
                                    <option value="">-- Chọn nhân viên --</option>
                                    @foreach ($administrationAssembly as $item)
                                        <option value="{{ $item->id }}"
                                            {{ !empty($filter_name) ? ($item->id == $filter_name ? 'selected' : '') : '' }}>
                                            {{ $item->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Gói Lắp Ráp -->
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="filter_packages">Gói Lắp Ráp</label>
                                <select class="form-select" name="filter_packages" id="filter_packages">
                                    <option value="">Tất cả</option>
                                    @foreach ($assemblyPackages as $item)
                                        <option value="{{ $item->id }}"
                                            {{ !empty($filter_packages) ? ($item->id == $filter_packages ? 'selected' : '') : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tên Nhân Viên (Lọc theo nhóm admin_group_id) -->
                        <!-- Trạng thái -->
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="filter_status">Trạng thái</label>
                                <select class="form-select" name="filter_status" id="filter_status">
                                    <option value="all">Tất cả</option>
                                    <option value="1">Đơn Lắp Mới</option>
                                    <option value="2">Đơn Hàng Trong Quá Trình Lắp Ráp</option>
                                    <option value="3">Hoàn Thành Lắp Ráp</option>
                                    <option value="4">Đang Giao Hàng</option>
                                    <option value="5">Giao Hàng Thành Công</option>
                                    <option value="6">Hủy Đơn Lắp Ráp</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-end">
                        <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 "
                            style="background: #4099FF"><i class="fa-solid fa-filter pe-2" data-ignore-warning
                                style="color: #ffffff;"></i>Lọc
                        </button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-sm-12 btnOrderAdmin">
                    @foreach ($statuses as $status_id => $status)
                        <a href="{{ route('assembly', ['filter_status' => $status_id]) }}"
                            class="btn btn-success rounded-0 border-0" style="background-color: {{ $status['color'] }}">
                            {{ $status['label'] }} ({{ $orderCounts[$status_id] ?? 0 }})
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <form id="submitFormAdmin">
            <div class="border p-2 mt-3">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách sản phẩm lắp ráp</h4>
                <table class="table table-bordered  pt-3">
                    <thead class="table-header">
                        <tr class="">
                            <th class=" py-2"></th>
                            <th class=" py-2" style="width:130px">Nhân viên lắp ráp</th>
                            <th class=" py-2">Hình ảnh</th>
                            <th class=" py-2" style="width:180px">Sản phẩm</th>
                            <th class=" py-2">Phí (lắp ráp + gói quà)</th>
                            <th class=" py-2">Gói lắp ráp</th>
                            <th class=" py-2">Trạng thái</th>
                            <th class=" py-2">Hành động</th>
                        </tr>
                    </thead>

                    <tbody class="table-body">
                        @foreach ($assemblys as $item)
                            <tr class="">
                                <td>
                                    <input class="" type="checkbox" name="assembly_id[]" value="">
                                    <p class=""></p>
                                </td>
                                <td class="nameAdmin">
                                    @if ($item->administration != null)
                                        <span class="employyeeName">{{ $item->administration->fullname }}</span>
                                    @else
                                        <span class="employyeeNameRed">Chưa chọn nhân viên lắp ráp</span>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($item->product->image) ?: null)
                                        <img src="{{ asset('img/' . $item->product->image) }}" alt=""
                                            style="width:80px;height:80px;object-fit:cover;">
                                    @endif
                                </td>
                                <td class="nameAdmin">
                                    <p>{{ $item->product->name }}</p>
                                </td>
                                <td class="">
                                    {{ number_format($item->assemblyPackage->price_assembly, 0, ',', '.') . 'đ' }} +
                                    {{ number_format($item->assemblyPackage->fee, 0, ',', '.') . 'đ' }}</td>
                                <td class="">
                                    {{ $item->assemblyPackage->name }} <br>
                                    <img src="{{ asset('img/' . $item->assemblyPackage->image) }}" alt=""
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>

                                <td>
                                    @switch($item->status)
                                        @case(1)
                                            <span class="assemblyNew">Đơn lắp mới</span>
                                        @break

                                        @case(2)
                                            <span class="assemblyDo">Đang trong quá trình lắp ráp</span>
                                        @break

                                        @case(3)
                                            <span class="assemblySuccess">Hoàn thành lắp ráp</span>
                                        @break

                                        @case(4)
                                            <span class="assemblyShip">Đang giao hàng</span>
                                        @break

                                        @case(5)
                                            <span class="assemblyComplete">Giao hàng thành công</span>
                                        @break

                                        @case(6)
                                            <span class="assemblyCancel">Đã hủy</span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="m-0
                                                p-0">
                                    <div class="actionAdminProduct">
                                        <div class="buttonProductForm m-0 py-3">
                                            <button type="button" class="btnActionProductAdmin2"><a
                                                    href="{{ route('editAssembly', $item->id) }}"
                                                    class="text-decoration-none text-light"><i
                                                        class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Chỉnh
                                                    sửa</a></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <nav class="navPhanTrang">
                    {{ $assemblys->links() }}
                </nav>
            </div>
        </form>
    </div>




@endsection
@section('assemblyAdminScript')

    <script>
        $(document).ready(function() {
            $('#filterFormAssembly').on('submit', function() {
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('searchAssemblyAdmin') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('.table-body').html(response.html);
                    },
                    error: function(error) {
                        console.error('Lỗi khi lọc: ' + error);
                    }
                });

            })
        })
    </script>
@endsection
