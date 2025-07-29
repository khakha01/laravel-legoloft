<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assembly;
use Illuminate\Http\Request;
use App\Models\AssemblyPackages;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AssemblyPackageAdminRequestAdd;
use App\Http\Requests\admin\AssemblyPackageAdminRequestEdit;

class AssemblyPackagesAdminController extends Controller
{
    private $assemblyPackagesModel;
    private $assemblyModel;

    public function __construct()
    {
        $this->assemblyPackagesModel = new AssemblyPackages();
        $this->assemblyModel = new Assembly();
    }

    public function assemblyPackages()
    {

        $assemblyPackages = $this->assemblyPackagesModel->assemblyPackageAdmin();
        return view('admin.assemblyPackages', compact('assemblyPackages'));
    }

    public function assemblyPackageAdd(AssemblyPackageAdminRequestAdd $request)
    {
        $response = $this->adminstrationGroupCrud('assemblyPackageAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('POST')) {
            $assemblyPackage = new AssemblyPackages();
            $assemblyPackage->name = $request->name;
            $assemblyPackage->description = $request->description;
            $assemblyPackage->fee = $request->fee;
            $assemblyPackage->price_assembly = $request->price_assembly;
            $assemblyPackage->status = $request->status;
            $assemblyPackage->save();

            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$assemblyPackage->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $assemblyPackage->image = $imageName;

                $assemblyPackage->save();
            }

            return redirect()->route('assemblyPackages')->with('success', 'Thêm gói quà lắp ráp thành công.');
        }
        return view('admin.assemblyPackagesAdd');
    }

    public function assemblyPackageEdit($id, Request $request)
    {
        $response = $this->adminstrationGroupCrud('assemblyPackageEdit');
        if ($response) {
            return $response;
        }
        $assemblyPackage = $this->assemblyPackagesModel->findOrFail($id);
        return view('admin.assemblyPackagesEdit', compact('assemblyPackage'));
    }

    public function assemblyPackageUpdate(AssemblyPackageAdminRequestEdit $request, $id)
    {

        if ($request->isMethod('PUT')) {
            $assemblyPackage = $this->assemblyPackagesModel->findOrFail($id);
            $assemblyPackage->name = $request->name;
            $assemblyPackage->description = $request->description;
            $assemblyPackage->fee = $request->fee;
            $assemblyPackage->price_assembly = $request->price_assembly;
            $assemblyPackage->status = $request->status;
            $assemblyPackage->save();

            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$assemblyPackage->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $assemblyPackage->image = $imageName;

                $assemblyPackage->save();
            }

            return redirect()->route('assemblyPackages')->with('success', 'Cập nhật gói quà lắp ráp thành công.');
        }
        return view('admin.assemblyPackagesAdd', compact('assemblyPackages'));
    }

    public function assemblyPackageUpdateStatus(Request $request, $id)
    {
        $assemblyPackage = $this->assemblyPackagesModel->findOrFail($id);
        $assemblyPackage->status = $request->status;
        $assemblyPackage->save();
        return response()->json(['success' => true]);
    }

    public function assemblyPackageDeleteCheckbox(Request $request)
    {
        $response = $this->adminstrationGroupCrud('assemblyPackageDeleteCheckbox');
        if ($response) {
            return $response;
        }
        $assembyPackage_id = $request->input('assembyPackage_id');
        if ($assembyPackage_id) {
            foreach ($assembyPackage_id as $itemID) {
                $assemblyPackage = $this->assemblyPackagesModel->findOrFail($itemID);
                $countAssembly = $this->assemblyModel->countAssemblyPack($itemID);
                if ($countAssembly > 0) {
                    return redirect()->route('assemblyPackages')->with('error', ' Cảnh báo: Gói quà này không thể xóa vì nó hiện được chỉ định cho ' . $countAssembly . ' đơn hàng lắp ráp!');
                }
                $assemblyPackage->delete();
            }
            return redirect()->route('assemblyPackages')->with('success', 'Xóa gói quà lắp ráp thành công.');
        }
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'assemblyPackageAdd' => 'Bạn không có quyền thêm gói quà tặng.',
            'assemblyPackageEdit' => 'Bạn không có quyền chỉnh sửa gói quà tặng.',
            'assemblyPackageDeleteCheckbox' => 'Bạn không có quyền xóa gói quà tặng.',
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
