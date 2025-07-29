<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thông tin đơn hàng</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f7f7f7;">
    <div
        style="max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h3 style="text-align: left;">Mã đơn hàng: #{{ $order->order_code }}</h3>
        <p>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</p>

        <h4>Thông tin đặt hàng</h4>
        <p>Người đặt: {{ $order->name }}</p>
        <p>SĐT: {{ $order->phone }}</p>
        <p>Địa chỉ: {{ $order->province . ', ' . $order->district . ', ' . $order->ward . ', ' . $order->address }}</p>
        <p>Phương thức thanh toán: {{ $order->definePayment()[$order->payment] }}</p>
        <p>Tổng tiền: <strong>{{ number_format($order->total, 0, ',', '.') . 'đ' }}</strong></p>

        <h4>Sản phẩm đã đặt</h4>
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                @foreach ($order->orderProducts as $item)
                    <tr>
                        <td style="border: 1px solid #e8e8e8; padding: 10px;">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 10px;">
                                    <img src="{{ asset('img/' . $item->product->image) }}"
                                        style="width: 100%; height: auto; object-fit: cover;" alt="" />
                                </div>
                                <p style="margin-left: 10px;">{{ $item->name }}</p>
                            </div>
                        </td>
                        <td style="border: 1px solid #e8e8e8; padding: 10px; text-align: right;">
                            <div>{{ number_format($item->price, 0, ',', '.') }}đ</div>
                            <p>số lượng: {{ $item->quantity }}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
