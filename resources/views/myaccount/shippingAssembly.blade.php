@extends('myaccount.layout.layout')
@section('title', 'Đơn hàng lắp ráp đang vận chuyển')
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
                            <h4 class="m-0 ps-3">Đơn hàng lắp ráp đang vận chuyển</h4>
                        </div>
                        <div class="">
                            @foreach ($orderAssemblyUser as $item)
                                <div class="account_purchase">
                                    <div class="account_purchase_header">
                                        <div class="account_purchase_header_left">
                                            <h5>Mã đơn hàng: #{{ $item->order_code }}</h5>
                                        </div>
                                        <div class="account_purchase_header_right">
                                            <p class="account_purchase_header_right_1">
                                                <button class="account_purchase_header_right_shipping"><a
                                                        href="javascript:void(0);" onclick="noticeShipping();"
                                                        class="">Đang vận chuyển</a></button>
                                            </p>
                                            <a href="{{ route('inforPurchase', $item->id) }}" class="text-decoration-none">
                                                <p class="account_purchase_header_right_2">Chi tiết</p>
                                            </a>
                                        </div>
                                        <div class="account_purchase_mobile">
                                            <div class="account_purchase_mobile_main">
                                                <button class="account_purchase_mobile_shipping"><a
                                                        href="javascript:void(0);" onclick="noticeShipping();"
                                                        class="">Đang vận chuyển</a></button>
                                                <a href="{{ route('inforPurchase', $item->id) }}"
                                                    class="text-decoration-none purchase_mobile_right_detail">
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
    <script>
        function noticeShipping() {
            Swal.fire({
                imageUrl: "{{ asset('img/shipping.png') }}",
                imageHeight: 200,
                imageWidth: 200,
                imageAlt: "A tall image",
                title: "Đơn hàng lắp ráp đang được vận chuyển",
                showConfirmButton: false, // Ẩn nút OK
                timer: 2000, // Tự động tắt sau 2 giây
                width: '380px',
                customClass: {
                    title: 'custom-title' // Thêm lớp tùy chỉnh cho tiêu đề
                }
            });
        }
    </script>
@endsection
