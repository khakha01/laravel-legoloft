<?php

namespace App\Http\Controllers\admin;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Assembly;
use App\Models\Favourite;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserAdminRequest;
use App\Http\Requests\admin\UserEditAdminRequest;
use Illuminate\Support\Facades\Http;


class UserAdminController extends Controller
{

    private $userModel;
    private $userGroupModel;
    private $cartModel;
    private $favouriteModel;
    private $orderModel;
    private $assemblyModel;
    private $commentModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->userGroupModel = new UserGroup();
        $this->cartModel = new Cart();
        $this->favouriteModel = new Favourite();
        $this->orderModel = new Order();
        $this->assemblyModel = new Assembly();
        $this->commentModel = new Comment();
    }

    /*--------------------------------------Khách hàng----------------------------------------*/

    public function searchUser(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_email = $request->input('filter_email');
        $filter_status = $request->input('filter_status');

        $users = $this->userModel->searchUser($filter_email, $filter_status);

        return view('admin.user', compact('users', 'filter_email'));
    }


    public function userUpdateStatus(Request $request, $id)
    {
        $user = $this->userModel->findOrFail($id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => true]);
    }

    public function userAdmin()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.user', compact('users'));
    }


    public function userAdd()
    {
        $response = $this->adminstrationGroupCrud('userAdd');
        if ($response) {
            return $response;
        }
        $userGroups = $this->userGroupModel->userGroupAll();

        return view(
            'admin.userAdd',
            compact('userGroups')
        ); // Chuyển đến view thêm người dùng

    }

    public function userStore(UserAdminRequest $request)
    {
        // Fetch data from API
        $response
            = Http::get('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');
        $dataFetch = $response->json();
        $provinceName = '';
        $districtName = '';
        $wardName = '';

        //Lặp qua dữ liệu để lấy tên tỉnh
        foreach ($dataFetch as $data) {

            if ($data['Id'] == $request->province) {

                $provinceName = $data['Name'];

                // Lặp qua các huyện trong tỉnh để lấy tên huyện
                foreach ($data['Districts'] as $district) {

                    if ($district['Id'] == $request->district) {
                        $districtName = $district['Name'];

                        // Đi qua các phường của quận để lấy tên phường
                        foreach ($district['Wards'] as $ward) {

                            if ($ward['Id'] == $request->ward) {
                                $wardName = $ward['Name'];
                                break;
                            }
                        }
                        break;
                    }
                }
                break;
            }
        }

        // Tạo người dùng mới
        $user = new User();
        $user->fullname = $request->fullname;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->province = $provinceName
            ?: $request->province; // toán tử elvis kiểm tra xem  (không rỗng, không phải null, không phải false)
        $user->district = $districtName ?: $request->district;
        $user->ward = $wardName ?: $request->ward;
        $user->status = $request->status;
        $user->user_group_id = $request->user_group_id;
        // Xử lý upload hình ảnh

        if ($request->hasFile('image')) {
            // Lấy tên gốc của tệp
            $image = $request->file('image');

            $imageName = "{$user->id}.{$image->getClientOriginalExtension()}";

            $image->move(public_path('img/'), $imageName);

            $user->image = $imageName;

            $user->save();
        }

        $user->save();

        return redirect()->route('userAdmin')
            ->with('success', 'Người dùng đã được thêm thành công.');
    }

    public function userEdit($id)
    {
        $response = $this->adminstrationGroupCrud('userEdit');
        if ($response) {
            return $response;
        }
        $user = User::findOrFail($id);
        $userGroups = UserGroup::all();
        return view('admin.userEdit', compact('user', 'userGroups'));
    }

    public function userUpdate(UserEditAdminRequest $request, $id)
    {
        // Fetch data from API
        $response
            = Http::get('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');
        $dataFetch = $response->json();
        $provinceName = '';
        $districtName = '';
        $wardName = '';

        //Lặp qua dữ liệu để lấy tên tỉnh
        foreach ($dataFetch as $data) {

            if ($data['Id'] == $request->province) {

                $provinceName = $data['Name'];

                // Lặp qua các huyện trong tỉnh để lấy tên huyện
                foreach ($data['Districts'] as $district) {

                    if ($district['Id'] == $request->district) {
                        $districtName = $district['Name'];

                        // Đi qua các phường của quận để lấy tên phường
                        foreach ($district['Wards'] as $ward) {

                            if ($ward['Id'] == $request->ward) {
                                $wardName = $ward['Name'];
                                break;
                            }
                        }
                        break;
                    }
                }
                break;
            }
        }


        $user = User::findOrFail($id); // Tìm người dùng theo ID
        $user->fullname = $request->fullname;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_group_id = $request->user_group_id;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->phone = $request->phone;

        if ($request->hasFile('image')) {
            // Lấy tên gốc của tệp
            $image = $request->file('image');

            $imageName = "{$user->id}.{$image->getClientOriginalExtension()}";

            $image->move(public_path('img/'), $imageName);

            $user->image = $imageName;

            $user->save();
        }

        $user->province = $provinceName
            ?: $request->province; // toán tử elvis kiểm tra xem  (không rỗng, không phải null, không phải false)
        $user->district = $districtName ?: $request->district;
        $user->ward = $wardName ?: $request->ward;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('userAdmin')
            ->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    public function userDeleteCheckbox(Request $request)
    {
        $response = $this->adminstrationGroupCrud('userCheckboxDelete');
        if ($response) {
            return $response;
        }
        $user_id = $request->input('user_id');

        if ($user_id) {
            foreach ($user_id as $userId) {

                $user = $this->userModel->findOrFail($userId);
                $countCart = $this->cartModel->countCart($userId);
                $countFavourite
                    = $this->favouriteModel->countFavourite($userId);
                $countOrder = $this->orderModel->countOrder($userId);
                $countAssembly = $this->assemblyModel->countAssemblyUser($userId);
                $countComment = $this->commentModel->countCommentUser($userId);
                if ($countCart > 0) {
                    return redirect()->route('userAdmin')->with(
                        'error',
                        ' Cảnh báo: Khách hàng này không thể bị xóa vì nó hiện được chỉ định cho '
                            . $countCart . ' giỏ hàng!'
                    );
                } elseif ($countFavourite > 0) {
                    return redirect()->route('userAdmin')->with(
                        'error',
                        ' Cảnh báo: Khách hàng này không thể bị xóa vì nó hiện được chỉ định cho '
                            . $countFavourite . ' yêu thích!'
                    );
                } elseif ($countOrder > 0) {
                    return redirect()->route('userAdmin')->with(
                        'error',
                        ' Cảnh báo: Khách hàng này không thể bị xóa vì nó hiện được chỉ định cho '
                            . $countOrder . ' đơn hàng!'
                    );
                } elseif ($countAssembly > 0) {
                    return redirect()->route('userAdmin')->with(
                        'error',
                        ' Cảnh báo: Khách hàng này không thể bị xóa vì nó hiện được chỉ định cho '
                            . $countAssembly . ' đơn hàng lắp ráp!'
                    );
                } elseif ($countComment > 0) {
                    return redirect()->route('userAdmin')->with(
                        'error',
                        ' Cảnh báo: Khách hàng này không thể bị xóa vì nó hiện được chỉ định cho '
                            . $countComment . ' bình luận!'
                    );
                } else {
                    $user->delete();
                }
            }
            return redirect()->route('userAdmin');
        }
    }

    // Còn mấy function tự nhìn thêm dô nhen Nghị đặt tên cho nó chuẩn xíu nhen giống thg adminstration

    /*-------------------------------------- nhóm Khách hàng----------------------------------------*/


    public function userGroup()
    {
        $userGroups
            = UserGroup::userGroupAll(); // Gọi hàm userGroupAll trực tiếp từ Model với phương thức tĩnh
        return view('admin.userGroup', compact('userGroups'));
    }


    public function userGroupAdd()
    { // hien thi form them U_Gr

        return view('admin.userGroupAdd');
    }

    public function createUserGroup(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable',
        ]);

        // Tìm nhóm người dùng
        $userGroup = new UserGroup();

        // Cập nhật tên nhóm người dùng
        $userGroup->name = $request->input('name');
        $userGroup->save();

        // Kiểm tra xem có file ảnh hay không
        if ($request->hasFile('image')) {
            // Lấy tên gốc của tệp
            $image = $request->file('image');

            $imageName = "{$userGroup->id}.{$image->getClientOriginalExtension()}";

            $image->move(public_path('img/'), $imageName);

            $userGroup->image = $imageName;

            $userGroup->save();
        }

        // Chuyển hướng về trang danh sách nhóm khách hàng với thông báo thành công
        return redirect()->route('userGroup')
            ->with('success', 'Thêm nhóm khách hàng thành công!');
    }

    public function userGroupEdit($id) // hien thi form chinh sua
    {
        $userGroup = UserGroup::findOrFail($id);

        return view('admin.userGroupEdit', compact('userGroup'));
    }


    public function updateUserGroup(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable',
        ]);

        // Tìm nhóm người dùng
        $userGroup = UserGroup::findOrFail($id);

        // Cập nhật tên nhóm người dùng
        $userGroup->name = $request->input('name');
        $userGroup->save();

        // Kiểm tra xem có file ảnh hay không
        if ($request->hasFile('image')) {
            // Lấy tên gốc của tệp
            $image = $request->file('image');

            $imageName = "{$userGroup->id}.{$image->getClientOriginalExtension()}";

            $image->move(public_path('img/'), $imageName);

            $userGroup->image = $imageName;

            $userGroup->save();
        }

        // Chuyển hướng về trang danh sách nhóm người dùng
        return redirect()->route('userGroup')->with('success', 'Cập nhật nhóm khách hàng thành công.');
    }


    public function userGroupCheckboxDelete(Request $request)
    {
        $userGroup_id = $request->input('userGroup_id');
        if ($userGroup_id) {
            foreach ($userGroup_id as $itemID) {
                $userGroup = $this->userGroupModel->findOrFail($itemID);
                $countUserGroup = $this->userModel->countUserGroup($itemID);
                if ($countUserGroup > 0) {
                    return redirect()->route('userGroup')->with('error', ' Cảnh báo: Nhóm khách hàng này không thể bị xóa vì nó hiện được chỉ định cho ' . $countUserGroup . ' khách hàng!');
                }
                $userGroup->delete();
            }
        }

        return redirect()->route('userGroup')->with('success', 'Xóa nhóm khách hàng thành công!');
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'userAdd' => 'Bạn không có quyền thêm khách hàng.',
            'userEdit' => 'Bạn không có quyền chỉnh sửa khách hàng.',
            'userCheckboxDelete' => 'Bạn không có quyền xóa khách hàng.',
            'userGroupAdd' => 'Bạn không có quyền thêm nhóm khách hàng.',
            'userGroupEdit' => 'Bạn không có quyền chỉnh sửa nhóm khách hàng.',
            'userGroupCheckboxDelete' => 'Bạn không có quyền xóa nhóm khách hàng.',
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
