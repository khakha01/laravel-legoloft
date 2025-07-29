<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryArticleEditRequest;
use App\Http\Requests\admin\CategoryArticleRequest;
use App\Models\CategoryArticle;
use App\Models\Article;
use Illuminate\Http\Request;

class CategoryArticleAdminController extends Controller
{
    private $categoryArticleModel;

    public function __construct()
    {
        $this->categoryArticleModel = new CategoryArticle();
    }


    public function categoryArticle(Request $request)
    {
        $query = CategoryArticle::query(); // Khởi tạo query

        // Lọc theo tiêu đề
        if ($request->filled('filter_name')) {
            $query->where('title', 'like', '%' . $request->filter_name . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        $CA = $query->orderBy('id', 'desc')->paginate(8);

        return view('admin.categoryArticle', compact('CA'));
    }


    public function categoryArticleAdd(CategoryArticleRequest $request)
    {
        $response = $this->adminstrationGroupCrud('categoryArticleAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('post')) {

            // Thêm mới bài viết
            $categoryArticle = new CategoryArticle();
            $categoryArticle->title = $request->title;
            $categoryArticle->description_short = $request->description_short;
            $categoryArticle->description = $request->description;
            $categoryArticle->status = $request->status;

            // Kiểm tra xem có file ảnh hay không
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$categoryArticle->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $categoryArticle->image = $imageName;

                $categoryArticle->save();
            }

            // Lưu bài viết
            $categoryArticle->save();

            return redirect()->route('categoryArticle')->with('success', 'Bài viết đã được thêm thành công!');
        }

        // Hiển thị form khi là GET request
        return view('admin.categoryArticleAdd');
    }


    public function categoryArticleEdit(CategoryArticleEditRequest $request, $id)
    {
        $response = $this->adminstrationGroupCrud('categoryArticleEdit');
        if ($response) {
            return $response;
        }
        // Tìm danh mục theo ID
        $categoryArticle = CategoryArticle::findOrFail($id);

        if ($request->isMethod('put')) {
            $categoryArticle->title = $request->title;
            $categoryArticle->description_short = $request->description_short;
            $categoryArticle->description = $request->description;
            $categoryArticle->status = $request->status;

            // Xử lý hình ảnh nếu có
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$categoryArticle->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $categoryArticle->image = $imageName;

                $categoryArticle->save();
            }
            // Cập nhật danh mục
            $categoryArticle->save();

            return redirect()->route('categoryArticle')->with('success', 'Cập nhật thành công!');
        }

        // Trả về view với biến đã được định nghĩa
        return view('admin.categoryArticleEdit', ['categoryArticle' => $categoryArticle]);
    }

    public function bulkDelete(Request $request)
    {
        $response = $this->adminstrationGroupCrud('categoryArticleCheckboxDelete');
        if ($response) {
            return $response;
        }
        $category_ids = $request->input('category_ids');
        if ($category_ids) {
            // Kiểm tra từng danh mục trong mảng category_ids
            foreach ($category_ids as $id) {
                $categoryArticle =  CategoryArticle::findOrFail($id);
                $articleCount = Article::where('categoryArticle_id', $id)->count();
                if ($articleCount > 0) {
                    return redirect()->route('categoryArticle')->with('error', 'Cảnh báo: Danh mục bài viết đang được chỉ định cho ' . $articleCount . ' bài viết!');
                }
                $categoryArticle->delete();
            }
            return redirect()->route('categoryArticle')->with('success', 'Danh mục đã được xóa thành công!');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $category = CategoryArticle::findOrFail($id);
        $category->status = $request->status;
        $category->save();

        return response()->json(['success' => true]);
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'categoryArticleAdd' => 'Bạn không có quyền thêm danh mục bài viết.',
            'categoryArticleEdit' => 'Bạn không có quyền chỉnh sửa danh mục bài viết.',
            'categoryArticleCheckboxDelete' => 'Bạn không có quyền xóa danh mục bài viết.',
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
