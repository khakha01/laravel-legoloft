@extends('myaccount.layout.layout')
@section('title', 'Đơn hàng lắp ráp đã giao thành công')
@section('content_myaccount')
    <div class="container pt_mobile">
        <div class="layout_member">
            <div class="layout_member_left">
                @include('myaccount.menuLeftAccount')
            </div>
            <div class="layout_member_right">
                <form action="">
                    <div class="container-account-right-item">
                        <div class="row">
                            <h4 class="m-0 ps-3">Đơn hàng lắp ráp đã giao thành công</h4>
                        </div>
                        <div class=""> {{-- @switch($item->status)
                            @case($item->status == 1)
                            @break

                            @case($item->status == 2)
                            @break

                            @case($item->status == 3)
                            @break

                            @case($item->status == 4)
                            @break

                            @case($item->status == 5)
                                <p class="account_purchase_header_right_5">
                                    Giao hàng thành công
                                </p>
                            @break

                            @default
                        @endswitch --}}
                            @foreach ($orderAssemblyUser as $item)
                                <div class="account_purchase">
                                    <div class="account_purchase_header">
                                        <div class="account_purchase_header_left">
                                            <h5>Mã đơn hàng: #{{ $item->order->order_code }}</h5>
                                        </div>
                                        <div class="account_purchase_header_right">
                                            <p class="account_purchase_header_right_5">
                                                Giao hàng thành công
                                            </p>

                                            <a href="{{ route('inforPurchaseAssembly', $item->id) }}"
                                                class="text-decoration-none">
                                                <p class="account_purchase_header_right_2">Chi tiết</p>
                                            </a>
                                        </div>
                                        <div class="account_purchase_mobile">
                                            <div class="account_purchase_mobile_main">
                                                <p class="account_purchase_mobile_5">
                                                    Giao hàng thành công
                                                </p>

                                                <a href="{{ route('inforPurchaseAssembly', $item->id) }}"
                                                    class="text-decoration-none purchase_detail">
                                                    Chi tiết
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($orderProductUser[$item->order_id] as $orderProduct)
                                        <div class="row checkout_row_right">
                                            <div class="col-md-3 col-sm-3 col-4">
                                                <div class="img_checkout_product">
                                                    <img src="{{ asset('img/' . $orderProduct['product']['image']) }}"
                                                        alt="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-9 col-8">
                                                <h5>{{ $orderProduct['product']['name'] }}</h5>
                                                <p class="">Số lượng: {{ $orderProduct['quantity'] }}</p>
                                                <p class="pricecheckout_mobile">
                                                    <span></span>{{ number_format($orderProduct['price'], 0, ',', '.') . 'đ' }}
                                                </p>
                                                <div class="feecheckout_mobile">
                                                    <span>{{ number_format($item->assemblyPackage->price_assembly, 0, ',', '.') . 'đ' }}
                                                    </span>(Phí
                                                    lắp ráp)
                                                </div>
                                                @if ($item->assemblyPackage->fee > 0)
                                                    <div class="feecheckout_mobile pb-3">
                                                        <span>
                                                            {{ number_format($item->assemblyPackage->fee, 0, ',', '.') . 'đ' }}</span>
                                                        ({{ $item->assemblyPackage->name }})
                                                    </div>
                                                @else
                                                    <div class="feecheckout_mobile  pb-3">
                                                        <span>
                                                            {{ number_format($item->assemblyPackage->fee, 0, ',', '.') . 'đ' }}</span>
                                                        ( {{ $item->assemblyPackage->name }})
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-12 checkout_right_price">
                                                <div class="product_box_price_account">
                                                    <span></span>{{ number_format($orderProduct['price'], 0, ',', '.') . 'đ' }}
                                                </div>
                                                <div class="product_box_fee_account">
                                                    <span>{{ number_format($item->assemblyPackage->price_assembly, 0, ',', '.') . 'đ' }}
                                                    </span>(Phí
                                                    lắp ráp)
                                                </div>
                                                @if ($item->assemblyPackage->fee > 0)
                                                    <div class="product_box_fee_account">
                                                        <span>
                                                            {{ number_format($item->assemblyPackage->fee, 0, ',', '.') . 'đ' }}</span>
                                                        ({{ $item->assemblyPackage->name }})
                                                    </div>
                                                @else
                                                    <div class="product_box_fee_account">
                                                        <span>
                                                            {{ number_format($item->assemblyPackage->fee, 0, ',', '.') . 'đ' }}</span>
                                                        ( {{ $item->assemblyPackage->name }})
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr />

                                    <div class="row account_purchase_thanhtien">
                                        <div class="col-md-12">
                                            <p class="px-1">Thành tiền:</p>
                                            <h4>{{ number_format($item->order->total, 0, ',', '.') . 'đ' }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.show-more').forEach(button => {
            button.addEventListener('click', function() {
                // truy cập vào thẻ div.moreProducts nơi chứa các sản phẩm muốn hiển thị or ẩn đi
                const moreProducts = this.parentElement
                    .previousElementSibling; // this:đại diện cho phần tử mà sự kiện xảy ra, trong trường hợp này là <p class="show-more">. // this.parentElement sẽ trả về phần tử cha của <p class="show-more">, tức là <div class="seeMore">. // this.parentElement.previousElementSibling sẽ trả về phần tử trước phần tử cha, tức là <div class="more-products">.

                moreProducts.style.display = moreProducts.style.display === 'none' || moreProducts.style
                    .display === '' ? 'block' : 'none';

                this.textContent = moreProducts.style.display === 'none' ? 'Xem thêm ' : 'Thu lại ';
            });
        });
    </script>
@endsection
