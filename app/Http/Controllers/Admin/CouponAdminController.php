<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponAdminController extends Controller
{
    private $couponModel;

    public function __construct()
    {
        $this->couponModel = new Coupon();
    }

    public function coupon()
    {
        $coupons = $this->couponModel->couponAll();
        $filter_name = '';
        $filter_code = '';
        $filter_type = '';
        return view('admin.coupon', compact('coupons', 'filter_name', 'filter_code', 'filter_type'));
    }

    public function couponEdit($id)
    {
        $response = $this->adminstrationGroupCrud('couponEdit');
        if ($response) {
            return $response;
        }
        $coupon = $this->couponModel->findOrFail($id);
        return view('admin.couponEdit', compact('coupon'));
    }

    public function couponUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name_coupon' => 'required',
            'code' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'status' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        $coupon = $this->couponModel->findOrFail($id);; // Tìm người dùng theo ID
        $coupon->name_coupon = $request->name_coupon;
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->discount = $request->discount;
        $coupon->total = $request->total;
        $coupon->date_start = $request->date_start;
        $coupon->date_end = $request->date_end;
        $coupon->status = $request->status;
        $coupon->save();
        return redirect()->route('coupon')->with('success', 'Mã giảm giá đã được cập nhật thành công.');
    }

    public function couponAdd(CouponRequest $request)
    {
        $response = $this->adminstrationGroupCrud('couponAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('POST')) {

            $coupon = new Coupon(); // Tìm người dùng theo ID
            $coupon->name_coupon = $request->name_coupon;
            $coupon->code = $request->code;
            $coupon->type = $request->type;
            $coupon->discount = $request->discount;
            $coupon->total = $request->total;
            $coupon->date_start = $request->date_start;
            $coupon->date_end = $request->date_end;
            $coupon->status = $request->status;
            $coupon->save();
            return redirect()->route('coupon')->with('success', 'Mã giảm giá đã được thêm thành công.');
        }

        return view('admin.couponAdd');
    }

    public function couponUpdateStatus(Request $request, $id)
    {
        $coupon = $this->couponModel->findOrFail($id);
        $coupon->status = $request->status;
        $coupon->save();
        return response()->json(['success' => true]);
    }

    public function couponDeleteCheckbox(Request $request)
    {
        $response = $this->adminstrationGroupCrud('couponCheckboxDelete');
        if ($response) {
            return $response;
        }
        $coupon_id = $request->input('coupon_id');
        if ($coupon_id) {
            foreach ($coupon_id as $itemID) {
                $coupon = $this->couponModel->findOrFail($itemID);
                if ($coupon->status == 1) {
                    return redirect()->route('coupon')->with('error', ' Cảnh báo: Mã giảm giá này đang hoạt động, không thể xóa');
                }
                // Kiểm tra thời gian hết hiệu lực của mã giảm giá
                $currentDate = now(); // Lấy ngày giờ hiện tại
                if ($currentDate < $coupon->date_end) {
                    return redirect()->route('coupon')->with('error', 'Cảnh báo: Mã giảm giá này chưa hết hiệu lực, không thể xóa');
                }
                $coupon->delete();
            }
            return redirect()->route('coupon')->with('success', 'Xóa mã giảm giá thành công.');
        }
    }

    public function couponSearch(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_code = $request->input('filter_code');
        $filter_type = $request->input('filter_type');
        $filter_status = $request->input('filter_status');

        $coupons = $this->couponModel->searchCoupon($filter_name, $filter_code, $filter_type, $filter_status);

        return view('admin.coupon', compact('coupons', 'filter_name', 'filter_code', 'filter_type'));
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'couponAdd' => 'Bạn không có quyền thêm phiếu giảm giá.',
            'couponEdit' => 'Bạn không có quyền chỉnh sửa phiếu giảm giá.',
            'couponCheckboxDelete' => 'Bạn không có quyền xóa phiếu giảm giá.',
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
