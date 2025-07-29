@extends('admin.layout.layout')
@Section('title', 'Admin | Cập nhật đơn hàng')
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
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('admin.order') }}">Quay lại</a>
        </div>


        <div class=" formAdmin">
            <div class="">
                <h2 class="title-page ">
                    Chỉnh sửa đơn hàng
                </h2>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="row orderAdminTable">
                        <h4>Thông tin khách hàng</h4>
                        <div class="col-md-6 ">
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" name="name" value="{{ $order->name }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $order->email }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{ $order->phone }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="province" class="form-label">Tỉnh/Thành phố</label>
                                <input type="text" class="form-control" name="province" value="{{ $order->province }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="district" class="form-label">Quận/Huyện</label>
                                <input type="text" class="form-control" name="district" value="{{ $order->district }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="ward" class="form-label">Phường/Xã</label>
                                <input type="text" class="form-control" name="ward" value="{{ $order->ward }}"
                                    readonly>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 orderAdminTable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderProducts as $index => $product)
                                <tr class="trProduct">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="d-flex justify-content-center border-0">
                                        <img src="{{ asset('img/' . $product->product->image) }}" alt=""
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td class="unit-price">{{ number_format($product->price, 0, ',') }} đ</td>
                                    <td>
                                        <input type="number" class="form-control quantity"
                                            name="productByOrderEdit[{{ $index }}][newQuantity]"
                                            value="{{ $product->quantity }}" min="1" readonly>
                                    </td>
                                    <td class="thanh-tien">
                                        {{ number_format($product->price * $product->quantity, 0, ',') }} đ</td>
                                    <td class="total-orderProduct">
                                        {{ number_format($product->price * $product->quantity, 0, ',') }} đ</td>
                                    <input type="hidden"
                                        name="productByOrderEdit[{{ $index }}][newTotalOrderProduct]"
                                        value="{{ $product->price * $product->quantity }}">
                                </tr>
                            @endforeach

                            <tr class="trOrder">
                                <td colspan="4">
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Phương thức thanh toán</label>
                                        <input type="text" class="form-control" name="payment"
                                            value="{{ $order->definePayment()[$order->payment] }}" readonly>
                                    </div>


                                </td>
                                <td colspan="1"></td>
                                <td colspan="2" class="m-0 p-0">
                                    <div class="total-order">
                                        @if (isset($order->assembly->assemblyPackage->price_assembly) ?: null)
                                            <div class="form-group mt-3">
                                                <label for="title" class="form-label">Phí lắp ráp - gói hộp: </label>
                                                <p id="displayedTotalOrder">
                                                    {{ number_format($order->assembly->assemblyPackage->price_assembly, 0, ',') . 'đ' }}
                                                    -
                                                    {{ number_format($order->assembly->assemblyPackage->fee, 0, ',') . 'đ' }}

                                                </p>
                                            </div>
                                        @else
                                        @endif


                                        <div class="form-group mt-3 ">
                                            <label for="title" class="form-label">Tổng tiền: </label>
                                            <p id="displayedTotalOrder">{{ number_format($order->total, 0, ',') }} đ
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <form action="{{ route('admin.orderUpdate', $order->id) }}" method="post" class="mt-5"
                    enctype="multipart/form-data" id="orderForm">

                    @csrf
                    <label for="title" class="form-label">Bảng lịch sử thay đổi trạng thái đơn hàng</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Người thay đổi</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Ngày thay đổi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderHistory as $item)
                                <tr>
                                    <td>{{ $item->order_code }}</td>
                                    <td>{{ $item->administration->fullname }}</td>
                                    <td>
                                        @switch($item->status_name)
                                            @case(1)
                                                <span class="assemblyNew">{{ $orderStatus[$item->status_name] }}</span>
                                            @break

                                            @case(2)
                                                <span class="assemblyDo">{{ $orderStatus[$item->status_name] }}</span>
                                            @break

                                            @case(3)
                                                <span class="assemblyShip">{{ $orderStatus[$item->status_name] }}</span>
                                            @break

                                            @case(4)
                                                <span class="assemblyComplete">{{ $orderStatus[$item->status_name] }}</span>
                                            @break

                                            @case(5)
                                                <span class="assemblyCancel">{{ $orderStatus[$item->status_name] }}</span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>{{ $item->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Trạng thái đơn hàng</label>
                                <select class="form-select" aria-label="Default select example" name="status"
                                    id="statusSelect" selected>
                                    @foreach ($orderStatus as $key => $item)
                                        <option value="{{ $key }}"
                                            {{ $order->status == $key ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>

                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="order_code" value="{{ $order->order_code }}">
                    <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}">

                </form>

                <!-- Modal -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Xác nhận thay đổi trạng thái
                                    <span style="color: #0d4ec8;font-weight:500;"> {{ $order->order_code }}</span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
                document.getElementById('orderForm').submit();
            });

            // Khi người dùng nhấn "Không" hoặc đóng modal
            document.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', function() {
                // Reset lại select status về giá trị cũ nếu người dùng từ chối
                var prevValue = '{{ $order->status }}';
                document.getElementById('statusSelect').value = prevValue;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lắng nghe sự thay đổi trong select
            document.getElementById('statusSelect').addEventListener('change', function() {
                var selectedStatus = this.value; // Lấy giá trị đã chọn từ select
                var orderStatus = @json($orderStatus); // Chuyển mảng $orderStatus sang JavaScript

                // Lấy tên trạng thái từ mảng orderStatus
                var statusName = orderStatus[selectedStatus];

                // Cập nhật tên trạng thái vào modal
                document.getElementById('statusName').textContent = statusName;
            });
        });
    </script>


@endsection
