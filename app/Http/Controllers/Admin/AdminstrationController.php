<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Assembly;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\AdministrationGroup;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AdministrationRequest;
use App\Http\Requests\admin\AdministrationEditRequest;
use App\Http\Requests\admin\AdministrationGroupRequest;
use App\Http\Requests\admin\AdministrationGroupEditRequest;

class AdminstrationController extends Controller
{
    private $administrationModel;
    private $administrationGroupModel;
    private $assemblyModel;
    private $articleModel;

    public function __construct()
    {
        $this->administrationModel = new Administration();
        $this->administrationGroupModel = new AdministrationGroup();
        $this->assemblyModel = new Assembly();
        $this->articleModel = new Article();
    }

    public function administrationSearch(Request $request)
    {
        $fillter_name = $request->input('filter_name');
        $filter_adminGroup = $request->input('filter_adminGroup');
        $administration = $this->administrationModel->searchAdministration($fillter_name, $filter_adminGroup);
        $administrationGroup = $this->administrationGroupModel->administrationGroupAll(); //lấy ra tên nhóm người dùng để lọc
        return view('admin.administration', compact('administration', 'administrationGroup'));
    }

    public function adminstration()
    {
        $administration = $this->administrationModel->administrationAll();
        $administrationGroup = $this->administrationGroupModel->administrationGroupAll(); //lấy ra tên nhóm người dùng để lọc

        return view('admin.administration', compact('administration', 'administrationGroup'));
    }
    public function adminstrationAdd(AdministrationRequest $request)
    {
        $response = $this->adminstrationGroupCrud('adminstrationAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('post')) {

            $administration = $this->administrationModel;
            $administration->fullname = $request->fullname;
            $administration->username = $request->username;
            $administration->admin_group_id = $request->admin_group_id;
            $administration->email = $request->email;
            $administration->password = bcrypt($request->password);
            $administration->status = $request->status;
            $administration->save();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = "{$administration->id}.{$image->getClientOriginalExtension()}";
                $image->move(public_path('img/'), $imageName);
                $administration->image = $imageName;
                $administration->save();
            }
            return redirect()->route('adminstration')->with('success', 'Thêm người dùng thành công');
        }

        $administrationGroup = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationAdd', compact('administrationGroup'));
    }
    public function adminstrationEdit($id)
    {
        $response = $this->adminstrationGroupCrud('adminstrationEdit');
        if ($response) {
            return $response;
        }
        $administration = $this->administrationModel->findOrFail($id);
        $administrationGroup = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationEdit', compact('administration', 'administrationGroup'));
    }

    public function adminstrationUpdate(AdministrationEditRequest $request, $id)
    {

        $administration = $this->administrationModel->findOrFail($id);
        $administration->fullname = $request->fullname;
        $administration->username = $request->username;
        if ($administration->administrationGroup->access_full == 1) {
            //bỏ qua ko can update admin_group_id
        } else {
            $administration->admin_group_id = $request->admin_group_id;
        }
        $administration->email = $request->email;
        $administration->status = $request->status;
        if ($request->filled('password')) {        // Chỉ cập nhật mật khẩu nếu người dùng đã nhập mật khẩu mới
            $administration->password = bcrypt($request->password);
        }
        $administration->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "{$administration->id}.{$image->getClientOriginalExtension()}";
            $image->move(public_path('img/'), $imageName);
            $administration->image = $imageName;
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $administration->image = $administration->image;
        }

        $administration->save();

        return redirect()->route('adminstration')->with('success', 'Thêm người dùng thành công');
    }

    public function adminstrationUpdateStatus(Request $request, $id)
    {
        $administration = $this->administrationModel->findOrFail($id);
        $administration->status = $request->status;
        $administration->save();
        return response()->json(['success' => true]);
    }

    public function adminstrationDeleteCheckbox(Request $request)
    {
        $response = $this->adminstrationGroupCrud('adminstrationCheckboxDelete');
        if ($response) {
            return $response;
        }
        $administration_id = $request->input('administration_id');
        if ($administration_id) {
            foreach ($administration_id as $itemID) {
                $administration = $this->administrationModel->findOrFail($itemID);
                $countAssembly = $this->assemblyModel->countAssemblyAdmin($itemID);
                $countArticle = $this->articleModel->countArticleAdmin($itemID);

                if ($countAssembly > 0) {
                    return redirect()->route('adminstration')->with(
                        'error',
                        ' Cảnh báo: Quản trị viên này không thể xóa vì hiện đang chỉ định cho '
                            . $countAssembly . ' đơn hàng lắp ráp!'
                    );
                } elseif ($countArticle > 0) {
                    return redirect()->route('adminstration')->with(
                        'error',
                        ' Cảnh báo: Quản trị viên này không thể xóa vì hiện đang chỉ định cho '
                            . $countArticle . ' bài viết!'
                    );
                } elseif ($administration->administrationGroup->access_full == 1) {
                    return redirect()->route('adminstration')->with(
                        'error',
                        ' Cảnh báo: Không thể xóa quản trị cấp cao! '
                    );
                }

                $administration->delete();
            }
        }
        return redirect()->route('adminstration')->with('success', 'Xóa người dùng thành công.');
    }

    /* -----------------------------Quản trị nhóm người dùng-----------------------------------------------------------------*/
    public function adminstrationGroup()
    {
        $administrationGroup = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationGroup', compact('administrationGroup'));
    }

    public function adminstrationGroupAdd(AdministrationGroupRequest $request)
    {
        $response = $this->adminstrationGroupCrud('adminstrationGroupAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('post')) {
            $adminstrationGroup = $this->administrationGroupModel;
            $adminstrationGroup->name  = $request->name;
            $adminstrationGroup->access_full  = $request->access_full;
            $adminstrationGroup->color  = $request->color;
            $adminstrationGroup->permission  = json_encode($request->permission); // chuyển array thành string
            $adminstrationGroup->save();
            return redirect()->route('adminstrationGroup')->with('success', 'Thêm nhóm người dùng thành công.');
        }
        return view('admin.administrationGroupAdd');
    }

    public function adminstrationGroupEdit($id)
    {
        $response = $this->adminstrationGroupCrud('adminstrationGroupEdit');
        if ($response) {
            return $response;
        }
        $administrationGroup = $this->administrationGroupModel->findOrFail($id);
        $permissionGroupGet = json_decode($administrationGroup->permission, true) ?? [];
        return view('admin.administrationGroupEdit', compact('administrationGroup', 'permissionGroupGet')); // Giai mã một chuôi JSON thành 1 mảng liên kết or đối tượng PHP

    }

    public function adminstrationGroupUpdate(AdministrationGroupEditRequest $request, $id)
    {
        $administrationGroup = $this->administrationGroupModel->findOrFail($id);
        $administrationGroup->name = $request->name;
        $administrationGroup->color  = $request->color;
        $administrationGroup->access_full  = $request->access_full;
        $administrationGroup->permission = json_encode($request->permission);
        $administrationGroup->save();
        return redirect()->route('adminstrationGroup');
    }

    public function adminstrationGroupDeleteCheckbox(Request $request)
    {
        $response = $this->adminstrationGroupCrud('adminstrationGroupCheckboxDelete');
        if ($response) {
            return $response;
        }
        $administrationGroup_id = $request->input('administrationGroup_id');
        if ($administrationGroup_id) {
            foreach ($administrationGroup_id as $itemID) {
                $administrationGroup = $this->administrationGroupModel->findOrFail($itemID);
                $countAdministrationGroup = $this->administrationModel->countAdministrationGroup($itemID);
                if ($countAdministrationGroup > 0) {
                    return redirect()->route('adminstrationGroup')->with('error', ' Cảnh báo: Nhóm người dùng này không thể bị xóa vì nó hiện được chỉ định cho ' . $countAdministrationGroup . ' người dùng!');
                } else {
                    $administrationGroup->delete();
                    return redirect()->route('adminstrationGroup')->with('success', ' Thành công: Nhóm người dùng này đã được xóa');
                }
            }
        }
        return redirect()->route('adminstrationGroup')->with('success', 'Xóa nhóm người dùng thành công.');
    }

    /* ----------------------------- Kiểm tra Quản trị nhóm người dùng-----------------------------------------------------------------*/

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'adminstrationAdd' => 'Bạn không có quyền thêm quản trị viên.',
            'adminstrationEdit' => 'Bạn không có quyền chỉnh sửa quản trị viên.',
            'adminstrationCheckboxDelete' => 'Bạn không có quyền xóa quản trị viên.',
            'adminstrationGroupAdd' => 'Bạn không có quyền thêm nhóm quản trị.',
            'adminstrationGroupEdit' => 'Bạn không có quyền chỉnh sửa nhóm quản trị.',
            'adminstrationGroupCheckboxDelete' => 'Bạn không có quyền xóa nhóm quản trị.',
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
