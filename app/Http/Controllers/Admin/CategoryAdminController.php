<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryEditRequest;
use App\Http\Requests\admin\CategoryRequest;

class CategoryAdminController extends Controller
{
    private $categoryModel;
    private $productModel;

    public function __construct()
    {
        $this->categoryModel = new Categories();
        $this->productModel = new Product();
    }

    public function category()
    {
        $categoriAdmin = Categories::with(['categories_children', 'categories_children.product'])
            ->whereNull('parent_id')
            ->paginate(8);
        // Khởi tạo các biến để tránh lỗi Undefined variable
        $filter_name = '';
        $filter_category_id = '';
        return view('admin.category', compact('categoriAdmin', 'filter_name', 'filter_category_id'));
    }

    public function categoryEdit($id)
    {
        $response = $this->adminstrationGroupCrud('categoryEdit');
        if ($response) {
            return $response;
        }
        $category = $this->categoryModel->findOrFail($id);
        $categoryNull = Categories::with(['categories_children', 'categories_children.product'])->whereNull('parent_id')->get();
        return view('admin.categoryEdit', compact('category', 'categoryNull'));
    }


    public function categoryUpdate(CategoryEditRequest $request, $id)
    {
        if ($request->isMethod('PUT')) {

            $category = $this->categoryModel->findOrFail($id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->sort_order = $request->sort_order;
            $category->status = $request->status;
            $category->status_section = $request->status_section;
            $category->parent_id = $request->parent_id;
            $category->description = $request->description;
            $category->choose = $request->choose;
            $category->image_2 = $request->image_2;
            $category->image_3 = $request->image_3;
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$category->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $category->image = $imageName;

                $category->save();
            }

            $category->save();

            return redirect()->route('category')->with('success', 'Cập nhật danh mục thành công.');
        }
        return view('admin.categoryEdit');
    }

    public function categoryAdd(CategoryRequest $request)
    {
        $response = $this->adminstrationGroupCrud('categoryAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('POST')) {
            $category = new Categories();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->sort_order = $request->sort_order;
            $category->status = $request->status;
            $category->status_section = $request->status_section;
            $category->parent_id = $request->parent_id;
            $category->description = $request->description;
            $category->choose = $request->choose ?: 0;
            $category->image_2 = $request->image_2;
            $category->image_3 = $request->image_3;
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$category->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $category->image = $imageName;

                $category->save();
            }

            $category->save();

            return redirect()->route('category')->with('success', 'Thêm danh mục thành công.');
        }
        $categoryNull = Categories::with(['categories_children', 'categories_children.product'])->whereNull('parent_id')->get();
        return view('admin.categoryAdd', compact('categoryNull'));
    }

    public function categoryUpdateStatus(Request $request, $id)
    {
        $category = $this->categoryModel->findOrFail($id);
        $category->status = $request->status;
        $category->save();
        return response()->json(['success' => true]);
    }

    public function updateStatusSectionCategory(Request $request, $id)
    {
        $category = $this->categoryModel->findOrFail($id);
        $category->status_section = $request->status_section;
        $category->save();
        return response()->json(['success' => true]);
    }

    public function categoryDeleteCheckbox(Request $request)
    {
        $response = $this->adminstrationGroupCrud('categoryCheckboxDelete');
        if ($response) {
            return $response;
        }
        $category_id = $request->input('category_id');
        if ($category_id) {
            foreach ($category_id as $itemID) {
                $category = $this->categoryModel->findOrFail($itemID);
                $categoryDad = $this->categoryModel->categoryDad($itemID);
                $countProduct = $this->productModel->countProduct($itemID);

                if ($categoryDad > 0) {
                    return redirect()->route('category')->with('error', ' Cảnh báo: Danh mục cha không thể xóa vì nó hiện được chỉ định cho ' . $categoryDad . ' danh mục con!');
                }
                if ($countProduct > 0) {
                    return redirect()->route('category')->with('error', ' Cảnh báo: Danh mục này không thể xóa vì nó hiện được chỉ định cho ' . $countProduct . ' sản phẩm!');
                }      // Nếu không có danh mục con và sản phẩm, tiến hành xóa
                $category->delete();
            }
            return redirect()->route('category')->with('success', 'Xóa danh mục thành công.');
        }
    }

    public function categorySearch(Request $request)
    {

        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_category_id = $request->input('filter_category_id');


        $categoriAdmin = $this->categoryModel->searchCategory($filter_name, $filter_category_id);

        return view('admin.category', compact('categoriAdmin', 'filter_name', 'filter_category_id'));
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'categoryAdd' => 'Bạn không có quyền thêm danh mục.',
            'categoryEdit' => 'Bạn không có quyền chỉnh sửa danh mục.',
            'categoryCheckboxDelete' => 'Bạn không có quyền xóa danh mục.',
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
