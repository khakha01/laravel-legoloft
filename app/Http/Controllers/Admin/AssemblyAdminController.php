<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Assembly;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\AssemblyPackages;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\OrderHistoryAssembly;
use Illuminate\Support\Facades\Auth;

class AssemblyAdminController extends Controller
{
    private $assemblyModel;
    private $administrationModel;
    private $orderHistoryAssemblyModel;
    private $assemblyPackagesModel;


    public function __construct()
    {
        $this->assemblyPackagesModel = new AssemblyPackages();
        $this->assemblyModel = new Assembly();
        $this->administrationModel = new Administration();
        $this->orderHistoryAssemblyModel = new OrderHistoryAssembly();
    }

    public function assemblySearch(Request $request)
    {
        //Log::info($request->all());
        $filter_name = $request->input('filter_name');
        $filter_packages = $request->input('filter_packages');

        $filter_status = $request->input('filter_status');

        $assemblys = $this->assemblyModel->searchAssembly($filter_name, $filter_packages, $filter_status);
        $assemblyPackages = $this->assemblyPackagesModel->assemblyPackageAll();
        $administrationAssembly = $this->administrationModel->administrationAssembly(); // Lấy danh sách nhân viên
        $statuses = $this->getOrderAssemblyStatuses();
        $orderCounts = $this->getOrderAssemblyCounts();
        $admin = auth()->guard('admin')->user();

        return view('admin.assembly', compact('assemblys', 'assemblyPackages', 'statuses', 'orderCounts', 'administrationAssembly', 'filter_name', 'filter_packages', 'admin'));
    }

    public function assembly(Request $request)
    {

        // Khởi tạo query từ model
        $query = $this->assemblyModel->newQuery();

        // Lấy tham số lọc từ request
        $filter_status = $request->input('filter_status');
        $filter_name = $request->input('filter_name');
        $filter_packages = $request->input('filter_packages');

        // Lấy danh sách trạng thái
        $statuses = $this->getOrderAssemblyStatuses();

        // Lọc theo trạng thái nếu có
        if ($filter_status && $filter_status !== 'all') {
            // Tìm key của trạng thái trong danh sách
            $status_key = array_search($filter_status, array_keys($statuses), true);

            // Nếu tìm thấy trạng thái, lọc theo trạng thái tương ứng
            if ($status_key !== false) {
                $query->where('status', $status_key);
            }
        }
        // Lấy danh sách lắp ráp đã lọc
        $admin = auth()->guard('admin')->user();
        $assemblys = [];
        if ($admin->administrationGroup->access_full == 1) {
            $assemblys = $this->assemblyModel->assemblyByAdmin();
        } else {
            $assemblys = $this->assemblyModel->assemblyByAdmin($admin->id);
        }
        // Các dữ liệu bổ sung
        // $statuses = $this->getOrderAssemblyStatuses();
        $orderCounts = $this->getOrderAssemblyCounts();
        $administrationAssembly = $this->administrationModel->administrationAssembly(); // Lấy danh sách nhân viên
        $assemblyPackages = $this->assemblyPackagesModel->assemblyPackageAll();
        $admin = auth()->guard('admin')->user();

        // Trả về view với dữ liệu đã lọc
        return view('admin.assembly', compact('assemblys', 'assemblyPackages', 'statuses', 'orderCounts', 'administrationAssembly', 'admin', 'filter_status', 'filter_name', 'filter_packages'));
    }



    public function assemblyEdit($id)
    {
        $response = $this->adminstrationGroupCrud('assemblyEdit');
        if ($response) {
            return $response;
        }
        $assembly = $this->assemblyModel->findOrFail($id);
        $statusAssembly = $this->assemblyModel->statusAssembly();
        $administrationAssembly = $this->administrationModel->administrationAssembly();
        $orderHistoryAssembly = $this->orderHistoryAssemblyModel->orderHistoryAssembly($assembly->id);
        $admin = auth()->guard('admin')->user();
        return view('admin.assemblyEdit', compact('assembly', 'statusAssembly', 'administrationAssembly', 'admin', 'orderHistoryAssembly'));
    }

    private function getOrderAssemblyStatuses()
    {
        return [
            'all' => ['label' => 'Tất cả', 'color' => '#F38773'],
            1 => ['label' => 'Đơn lắp mới', 'color' => '#FFB356'],
            2 => ['label' => 'Đang trong quá trình lắp ráp', 'color' => '#d4004e'],
            3 => ['label' => 'Hoàn thành lắp ráp', 'color' => '#00bcd4'],
            4 => ['label' => 'Đang giao hàng', 'color' => '#188DD1'],
            5 => ['label' => 'Giao hàng thành công', 'color' => '#2bc500'],
            6 => ['label' => 'Hủy đơn lắp ráp', 'color' => '#FF0000'],

        ];
    }

    private function getOrderAssemblyCounts()
    {
        return [
            'all' => Assembly::count(),
            1 => Assembly::where('status', 1)->count(),
            2 => Assembly::where('status', 2)->count(),
            3 => Assembly::where('status', 3)->count(),
            4 => Assembly::where('status', 4)->count(),
            5 => Assembly::where('status', 5)->count(),
            6 => Assembly::where('status', 6)->count(),

        ];
    }

    public function assemblyUpdateStatusStaff(Request $request, $id) {}

    public function assemblyUpdate(Request $request, $id)
    {

        $assembly = Assembly::findOrFail($id); // Tìm người dùng theo ID
        $order = Order::find($assembly->order_id);
        if ($request->has('status_tiepnhan')) {
            $assembly->status = (int) $request->status_tiepnhan;
            $assembly->save();
            $this->saveOrderHistoryAssemblyStaff($assembly->id, $assembly->status, Auth::guard('admin')->user()->id);
            if ($assembly->status == 2) {
                $order->status = 2; // Đã xác nhận
                $order->save();
                $this->saveOrderHistory($order->id, 2, Auth::guard('admin')->user()->id, $order->order_code);
            }


            return back()->with('success', 'Người dùng đã được cập nhật thành công.');
        }
        if ($request->has('admin_id')) {
            $assembly->admin_id = $request->admin_id ?? null;
            $assembly->save();
        }

        $statues = (int) $request->status;


        // Nếu trạng thái không thay đổi thì bỏ qua phần kiểm tra trạng thái
        if ($assembly->status == $statues) {
            return redirect()->route('assembly');
        }
        // Kiểm tra trạng thái hợp lệ
        if (!in_array($statues, [1, 2, 3, 4, 5, 6])) {
            return redirect()->route('assembly');
        }

        // Kiểm tra điều kiện chuyển trạng thái
        switch ($statues) {

            case 1: // Đơn lắp mới
                if ($assembly->status != 1) {
                    return back()->with('error', 'Không thể chuyển về trạng thái "Đơn lắp mới"!');
                }
                break;
            case 2: // Đang trong quá trình lắp ráp
                if ($assembly->status != 1) {
                    return back()->with('error', 'Không thể chuyển về trạng thái "Đang trong quá trình lắp ráp"!');
                }

                // Nếu trạng thái của assembly là "Đang trong quá trình lắp ráp" (2), tự động cập nhật trạng thái của order thành "Đã xác nhận" (2)
                $order = Order::find($assembly->order_id); // Lấy đơn hàng liên kết với assembly qua order_id

                if ($order) {
                    $order->status = 2; // Đã xác nhận
                    $order->save();  // Lưu lại thay đổi cho order

                    // Lưu lịch sử thay đổi trạng thái của đơn hàng
                    $this->saveOrderHistory($order->id, 2, Auth::guard('admin')->user()->id, $order->order_code);
                }
                break;
            case 3: // Hoàn thành lắp ráp
                if ($assembly->status != 2) {
                    return back()->with('error', 'Không thể chuyển về trạng thái "Hoàn thành lắp ráp"!');
                }
                break;
            case 4: // Đang giao hàng
                if ($assembly->status != 3) {
                    return back()->with('error', 'Không thể chuyển về trạng thái "Đang giao hàng"!');
                }
                // Nếu trạng thái của assembly là "Đang giao hàng" (4), tự động cập nhật trạng thái của order thành "Đang vận chuyển" (3)
                $order = Order::find($assembly->order_id); // Lấy đơn hàng liên kết với assembly qua order_id

                if ($order) {
                    $order->status = 3; // Đang vận chuyển
                    $order->save();  // Lưu lại thay đổi cho order

                    // Lưu lịch sử thay đổi trạng thái của đơn hàng
                    $this->saveOrderHistory($order->id, 3, Auth::guard('admin')->user()->id, $order->order_code);
                }
                break;
            case 5: // Giao hàng thành công
                if ($assembly->status != 4) {
                    return back()->with('error', 'Không thể chuyển về trạng thái "Giao hàng thành công"!');
                }

                // Nếu trạng thái của assembly là "Giao hàng thành công" (5), tự động cập nhật trạng thái của order thành "Giao hàng thành công" (4)
                $order = Order::find($assembly->order_id); // Lấy đơn hàng liên kết với assembly qua order_id

                if ($order) {
                    $order->status = 4; // Giao hàng thành công
                    $order->save();  // Lưu lại thay đổi cho order

                    // Lưu lịch sử thay đổi trạng thái của đơn hàng
                    $this->saveOrderHistory($order->id, 4, Auth::guard('admin')->user()->id, $order->order_code);
                }
                break;
            case 6: // Hủy đơn lắp ráp
                // Chỉ cho phép hủy khi trạng thái của assembly là "Đơn lắp mới" (status = 1)
                if ($assembly->status != 1) {
                    return back()->with('error', 'Không thể chuyển sang trạng thái "Đã hủy"!');
                }
                // Nếu trạng thái của assembly là " Hủy đơn lắp ráp" (6), tự động cập nhật trạng thái của order thành " Hủy đơn lắp ráp" (5)
                $order = Order::find($assembly->order_id); // Lấy đơn hàng liên kết với assembly qua order_id

                if ($order) {
                    $order->status = 5; // Hủy đơn lắp ráp
                    $order->save();  // Lưu lại thay đổi cho order

                    // Lưu lịch sử thay đổi trạng thái của đơn hàng
                    $this->saveOrderHistory($order->id, 5, Auth::guard('admin')->user()->id, $order->order_code);
                }
                break;
            default:
                return back()->with('error', 'Trạng thái không hợp lệ!');
        }

        // Cập nhật trạng thái và lưu vào DB
        $assembly->status = $statues;
        $assembly->save();

        //---------------------------------------------------
        $this->saveOrderHistoryAssembly($request);
        //---------------------------------------------------

        return back()->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    // Hàm lưu lịch sử
    private function saveOrderHistory($order_id, $status_name, $admin_id, $order_code)
    {
        $orderHistory = new OrderHistory();
        $orderHistory->order_id = $order_id;
        $orderHistory->status_name = $status_name;
        $orderHistory->admin_id = $admin_id;
        $orderHistory->order_code = $order_code;
        $orderHistory->save();
    }

    private function saveOrderHistoryAssemblyStaff($assembly_id, $status_name, $admin_id)
    {
        $orderHistoryAssembly = new OrderHistoryAssembly();
        $orderHistoryAssembly->assembly_id = $assembly_id;
        $orderHistoryAssembly->status_name = $status_name;
        $orderHistoryAssembly->admin_id = $admin_id;
        $orderHistoryAssembly->save();
    }

    private function saveOrderHistoryAssembly($request)
    {
        $orderHistoryAssembly = new OrderHistoryAssembly();
        $orderHistoryAssembly->assembly_id = $request->assembly_id;
        $orderHistoryAssembly->status_name = $request->status;
        $orderHistoryAssembly->admin_id = $request->admin_history_id;
        $orderHistoryAssembly->save();
    }
    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'assemblyEdit' => 'Bạn không có quyền chỉnh sửa đơn hàng lắp ráp.',
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
