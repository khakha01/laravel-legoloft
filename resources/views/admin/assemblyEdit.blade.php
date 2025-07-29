@extends('admin.layout.layout')
@Section('title', 'Admin | Chỉnh sửa đơn hàng lắp ráp')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class="">
                @if (session('error'))
                    <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                @endif
            </div>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('assembly') }}">Quay lại</a>
        </div>

        <form action="{{ route('editAssembly', $assembly->id) }}" class="formAdmin" method="post" class="mt-5"
            enctype="multipart/form-data" id="assemblyForm" data-ignore-warning>
            @csrf
            @method('PUT')
            <div class="buttonProductForm">
                <div class="">
                    <h2 class="title-page ">
                        Chỉnh sửa sản phẩm lắp ráp </h2>
                </div>
                <div class="">
                    <button type="submit" class="btnFormAdd">
                        <p class="text m-0 p-0">Lưu</p>
                    </button>

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 ">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Phí (lắp ráp + gói quà)</th>
                                <th>Gói lắp ráp</th>
                                <th>Người đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="trProduct">
                                <td class="d-flex justify-content-center ">
                                    <img src="{{ asset('img/' . $assembly->product->image) }}" alt=""
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>{{ $assembly->product->name }}</td>
                                <td>
                                    <span class="">{{ $assembly->quantity }}</span>
                                </td>
                                <td>
                                    {{ number_format($assembly->assemblyPackage->price_assembly, 0, ',', '.') . 'đ' }} +
                                    {{ number_format($assembly->assemblyPackage->fee, 0, ',', '.') . 'đ' }}
                                </td>
                                <td>
                                    {{ $assembly->assemblyPackage->name }} <br>
                                    <img src="{{ asset('img/' . $assembly->assemblyPackage->image) }}" alt=""
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="nameAdmin">
                                    @if ($assembly->user != null)
                                        <p>{{ $assembly->user->fullname }}</p>
                                    @else
                                        <p>{{ $assembly->order->name }}</p>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>


                    <input type="hidden" name="admin_id" value="{{ $assembly->admin_id }}">
                    @if ($admin->administrationGroup->access_full == 1)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="title" class="form-label">Nhân viên lắp ráp</label>
                                    <select class="form-select" aria-label="Default select example" name="admin_id"
                                        id="" selected>
                                        @foreach ($administrationAssembly as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $assembly->admin_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    @endif

                    <label for="title" class="form-label mt-5">Bảng lịch sử cập nhật trạng thái đơn hàng lắp ráp</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Người cập nhật</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Ngày cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderHistoryAssembly as $item)
                                <tr>
                                    <td>{{ $assembly->order->order_code }}</td>
                                    <td>{{ $item->administration->fullname }}</td>
                                    <td>
                                        @switch($item->status_name)
                                            @case(1)
                                                <span class="assemblyNew">{{ $statusAssembly[$item->status_name] }}</span>
                                            @break

                                            @case(2)
                                                <span class="assemblyDo">{{ $statusAssembly[$item->status_name] }}</span>
                                            @break

                                            @case(3)
                                                <span class="assemblySuccess">{{ $statusAssembly[$item->status_name] }}</span>
                                            @break

                                            @case(4)
                                                <span class="assemblyShip">{{ $statusAssembly[$item->status_name] }}</span>
                                            @break

                                            @case(5)
                                                <span class="assemblyComplete">{{ $statusAssembly[$item->status_name] }}</span>
                                            @break

                                            @case(6)
                                                <span class="assemblyCancel">{{ $statusAssembly[$item->status_name] }}</span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>{{ $item->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <input type="hidden" name="assembly_id" value="{{ $assembly->id }}">
                        <input type="hidden" name="admin_history_id" value="{{ Auth::guard('admin')->user()->id }}">

                    </table>

                    @if ($admin->administrationGroup->access_full == 1)
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="title" class="form-label">Trạng thái đơn hàng lắp ráp </label>
                                    <select class="form-select" name="status" id="statusSelect" selected>
                                        @foreach ($statusAssembly as $key => $item)
                                            <option value="{{ $key }}"
                                                {{ $assembly->status == $key ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    @endif
                    @if ($admin->administrationGroup->access_full == 0)
                        <label for="title" class="form-label mt-3">Nhân viên tiếp nhận tại đây </label> <br>
                        @if ($assembly->status == 1)
                            <input class="radioStaff" type="radio" name="status_tiepnhan" value="2"
                                id="statusStaffRadio1" {{ $assembly->status == 2 ? 'checked' : '' }}><label
                                for="statusStaffRadio1"> Tiếp nhận lắp
                                ráp</label>
                        @elseif ($assembly->status == 2)
                            <input class="radioStaff" type="radio" name="status_tiepnhan" value="3"
                                id="statusStaffRadio2" {{ $assembly->status == 3 ? 'checked' : '' }}><label
                                for="statusStaffRadio2">Hoàn thành lắp
                                ráp</label>
                        @else
                            <h6 style="color: #11b92a"><i class="fa-solid fa-check"
                                    style="color: #11b92a;font-size:18px;"></i> Bạn đã hoàn
                                thành lắp ráp sản phẩm</h6>
                        @endif
                    @endif
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Xác nhận thay đổi trạng thái
                            <span style="color: #0d4ec8;font-weight:500;"> {{ $assembly->order->order_code }}</span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn thay đổi trạng thái thành "<span id="statusName"
                            style="color: #ff0000;font-weight:500;"></span>"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Không</button>
                        <button type="button" class="btn btn-secondary" id="confirmChangeStatus">Có</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.getElementById('statusSelect').addEventListener('change', function() {
            // Hiển thị modal xác nhận khi người dùng thay đổi trạng thái
            var modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();

            // Khi người dùng nhấn "Có" trong modal
            document.getElementById('confirmChangeStatus').addEventListener('click', function() {
                // Submit form sau khi xác nhận
                document.getElementById('assemblyForm').submit();
            });

            // Khi người dùng nhấn "Không" hoặc đóng modal
            document.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', function() {
                // Reset lại select status về giá trị cũ nếu người dùng từ chối
                var prevValue = '{{ $assembly->status }}';
                document.getElementById('statusSelect').value = prevValue;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lắng nghe sự thay đổi trong select
            document.getElementById('statusSelect').addEventListener('change', function() {
                var selectedStatus = this.value; // Lấy giá trị đã chọn từ select
                var statusAssembly =
                    @json($statusAssembly); // Chuyển mảng $statusAssembly sang JavaScript

                // Lấy tên trạng thái từ mảng statusAssembly
                var statusName = statusAssembly[selectedStatus];

                // Cập nhật tên trạng thái vào modal
                document.getElementById('statusName').textContent = statusName;
            });
        });
    </script>
@endsection
