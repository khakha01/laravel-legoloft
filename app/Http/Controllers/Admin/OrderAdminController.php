<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Assembly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderHistory;

class OrderAdminController extends Controller
{
    private $orderModel;
    private $assemblyModel;
    private $orderHistoryModel;


    public function __construct()
    {
        $this->orderModel = new Order();
        $this->assemblyModel = new Assembly();
        $this->orderHistoryModel = new OrderHistory();
    }
    public function order(Request $request)
    {
        $query = Order::with('orderProducts.product');

        if ($request->filled('filter_iddh')) {
            $query->where('id', $request->filter_iddh);
        }

        if ($request->filled('filter_userName')) {
            $query->where('name', 'like', '%' . $request->filter_userName . '%');
        }

        if ($request->filled('filter_status') && $request->filter_status !== 'all') {
            $query->where('status', $request->filter_status);
        }

        $statuses = $this->getOrderStatuses();
        $orderCounts = $this->getOrderCounts();
        // Lấy danh sách đơn hàng đã lọc
        $orders = $query->orderBy('id', 'desc')->paginate(8);

        return view('admin.order', compact('orders', 'statuses', 'orderCounts'));
    }

    // Phương thức để lấy trạng thái đơn hàng
    private function getOrderStatuses()
    {
        return [
            'all' => ['label' => 'Tất cả', 'color' => '#F38773'],
            1 => ['label' => 'Chờ xác nhận', 'color' => '#FFB356'],
            2 => ['label' => 'Đã xác nhận', 'color' => '#00bcd4'],
            3 => ['label' => 'Đang vận chuyển', 'color' => '#188DD1'],
            4 => ['label' => 'Hoàn thành', 'color' => '#2bc500'],
            5 => ['label' => 'Đã hủy', 'color' => '#FF0000'],
        ];
    }

    private function getOrderCounts()
    {
        return [
            'all' => Order::count(),
            1 => Order::where('status', 1)->count(),
            2 => Order::where('status', 2)->count(),
            3 => Order::where('status', 3)->count(),
            4 => Order::where('status', 4)->count(),
            5 => Order::where('status', 5)->count(),
        ];
    }



    public function orderEdit($id)
    {
        $response = $this->adminstrationGroupCrud('orderEdit');
        if ($response) {
            return $response;
        }
        $order = Order::with('orderProducts.product')->findOrFail($id); // Tải thông tin đơn hàng và các sản phẩm liên quan
        $orderHistory = $this->orderHistoryModel->orderHistory($order->id);
        $orderStatus = $this->orderModel->statusOrder();

        return view('admin.orderEdit', compact('order', 'orderStatus', 'orderHistory'));
    }


    public function orderUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|min:1|max:5', // Kiểm tra trạng thái phải nằm trong khoảng 1-5
        ]);


        $order = Order::findOrFail($id);
        $assembly = $this->assemblyModel->assmblyOrderId($order->id);

        if ($assembly) { // nếu trong bảng assembly có id đơn hàng thì thực hiện status case này
            // Gọi hàm với trạng thái mới từ request
            $result = $this->orderUpdateStatusAssembly($order->id, $request->status);

            // Kiểm tra kết quả trả về
            if ($result) {
                return $result; // Nếu có redirect từ hàm, trả về ngay
            }
            //---------------------------------------------------
            $this->saveOrderHistory($request, $order);
            //---------------------------------------------------
            return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
        } else {
            $statuses = $request->status; // status được client gửi lên (chưa được lưu vào db)
            //dd($order->status); //Lấy giá trị trạng thái hiện tại của đơn hàng từ cơ sở dữ liệu

            switch ((int)$statuses) {
                case 1: // Chờ xác nhận
                    if ($order->status != 1) {
                        return back()->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận"!');
                    }
                    break;

                case 2: // Đã xác nhận
                    if ($order->status != 1) { // nếu nó không bằng thì thực thi IF báo lỗi
                        return back()->with('error', 'Không thể chuyển về trạng thái "Đã xác nhận"!');
                    }
                    break;
                    //=> nghĩa là khi nó lấy từ DB lên và ss 1=1 thì là (cho phép chuyển sang trạng thái "Đã xác nhận" nếu đơn hàng hiện tại đang ở trạng thái "Chờ xác nhận"). Nếu không, hiển thị lỗi.
                case 3: // Đã vận chuyển
                    if ($order->status != 2) { // nếu nó không bằng thì thực thi IF báo lỗi
                        return back()->with('error', 'Không thể chuyển về trạng thái "Đã vận chuyển"!');
                    }
                    break;
                    //=> nghĩa là khi nó lấy từ DB lên và ss 2=2 chỉ có thể chuyển sang trạng thái "Đã vận chuyển" nếu nó đang ở trạng thái "Đã xác nhận".
                case 4: // Hoàn thành
                    if ($order->status != 3) { // nếu nó không bằng thì thực thi IF báo lỗi
                        return back()->with('error', 'Không thể chuyển về trạng thái "Hoàn thành"!');
                    }
                    break;

                case 5: // Hủy
                    if ($order->status != 1) {
                        return back()->with('error', 'Không thể chuyển về trạng thái "Hủy"!');
                    }
                    break;

                default:
                    return back()->with('error', 'Trạng thái không hợp lệ!');
                    break;
            }

            // Cập nhật trạng thái khi không có lỗi
            $order->status = $statuses;
            $order->save();
            //---------------------------------------------------
            $this->saveOrderHistory($request, $order);
            //---------------------------------------------------
            return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
        }
    }

    public function orderUpdateStatusAssembly($id, $statusOrder)
    {
        $order = $this->orderModel->findOrFail($id);
        $assembly = $this->assemblyModel->assmblyOrderId($order->id);
        //dd($assembly->status);
        if ($assembly) {
            switch ($assembly->status) {
                case 1: // trạng thái của assembly (đơn mới)
                    if (in_array($statusOrder, [1])) { // kiểm tra xem giá trị của $statusOrder có nằm trong mảng không
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Chờ xử lý", do đang là "đơn mới"!');
                    } elseif (in_array($statusOrder, [2])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã xác nhận", do đang là "đơn mới"!');
                    } elseif (in_array($statusOrder, [3])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đang vận chuyển", do đang là "đơn mới"!');
                    } elseif (in_array($statusOrder, [4])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Hoàn thành", do đang là "đơn mới"!');
                    } elseif (in_array($statusOrder, [5])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã hủy", do đang là "đơn mới"!');
                    }
                    break;
                case 2: // trạng thái của assembly (đang trong quá trình lắp ráp)
                    if (in_array($statusOrder, [1])) { // kiểm tra xem giá trị của $statusOrder có nằm trong mảng không
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận", do đơn đang được lắp!');
                    } elseif (in_array($statusOrder, [3])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đang vận chuyển", do đơn đang được lắp!');
                    } elseif (in_array($statusOrder, [4])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Hoàn thành", do đơn đang được lắp!');
                    } elseif (in_array($statusOrder, [5])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã hủy", do đơn đang được lắp!');
                    }
                    break;
                case 3: // trạng thái của assembly (Hoàn thành lắp ráp)
                    if (in_array($statusOrder, [1])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận", do đơn đã "hoàn thành lắp ráp"!');
                    } elseif (in_array($statusOrder, [2])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã xác nhận", do đơn đã "hoàn thành lắp ráp"!');
                    } elseif (in_array($statusOrder, [4])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Hoàn thành", do đơn chưa được giao!');
                    } elseif (in_array($statusOrder, [5])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã hủy"!');
                    }
                    break;
                case 4: // trạng thái của assembly (Đang giao hàng)
                    if (in_array($statusOrder, [1])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận", do "đang giao hàng"!');
                    } elseif (in_array($statusOrder, [2])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã xác nhận", do "đang giao hàng"!');
                    } elseif (in_array($statusOrder, [4])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Hoàn thành", do "đang giao hàng"!');
                    } elseif (in_array($statusOrder, [5])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã hủy", do "đang giao hàng"!');
                    }

                    // Nếu trạng thái của assembly là "Đang giao hàng" (4), tự động cập nhật trạng thái của order thành "Đang vận chuyển" (3)
                    $order->status = 3;
                    $order->save();  // Lưu lại thay đổi cho order

                    break;
                case 5: // trạng thái của assembly (Giao hàng thành công)
                    if (in_array($statusOrder, [1])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận", vì đã "giao hàng thành công"!');
                    } elseif (in_array($statusOrder, [2])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Đã xác nhận", vì đã "giao hàng thành công"!');
                    } elseif (in_array($statusOrder, [3])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Đang vận chuyển", vì đã "giao hàng thành công"!');
                    } elseif (in_array($statusOrder, [5])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã hủy", vì đã "giao hàng thành công"!');
                    }
                    break;
                case 6: // trạng thái của assembly (huy don lap rap)
                    if (in_array($statusOrder, [1, 2, 3, 4])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái, vì đơn đã bị hủy!');
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
        $order->status = $statusOrder;

        $order->save();
    }

    // Hàm lưu lịch sử
    private function saveOrderHistory($request)
    {
        $orderHistory = new OrderHistory();
        $orderHistory->order_id = $request->order_id;
        $orderHistory->status_name = $request->status;
        $orderHistory->admin_id = $request->admin_id;
        $orderHistory->order_code = $request->order_code;
        $orderHistory->save();
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'orderEdit' => 'Bạn không có quyền chỉnh sửa đơn hàng.',
        ];
        if ($action === null) {
            foreach ($permissionArray as $permiss => $errorMessage) {
                if (!in_array($permiss, $permissionGet)) {
                    return redirect()->back()->with('error', $errorMessage);
                }
            }
        } else {
            if (array_key_exists($action, $permissionArray)) {
                if (!in_array($action, $permissionGet)) {
                    return redirect()->back()->with('error', $permissionArray[$action]);
                }
            }
        }
    }
}
