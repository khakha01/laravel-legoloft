<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ArticleEditRequest;
use App\Http\Requests\admin\ArticleRequest;
use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;

class ArticleAdminController extends Controller
{
    private $articleModel;

    public function __construct()
    {
        $this->articleModel = new Article();
    }

    public function article(Request $request)
    {
        $query = Article::query(); // Bắt đầu một query mới

        // Lọc theo tiêu đề
        if ($request->filled('filter_name')) {
            $query->where('title', 'like', '%' . $request->filter_name . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }
        $admin = auth()->guard('admin')->user();
        $atc = [];
        if ($admin->administrationGroup->access_full == 1) {
            $atc = $this->articleModel->articalByAdmin();
        } else {
            $atc = $this->articleModel->articalByAdmin($admin->id);
        }
        // dd($article);
        return view('admin.article', compact('atc'));
    }

    public function articleAdd(ArticleRequest $request)
    {
        $response = $this->adminstrationGroupCrud('articleAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('post')) {

            // Thêm mới bài viết
            $Article = new Article();
            $Article->title = $request->title;
            $Article->description_short = $request->description_short;
            $Article->description = $request->description;
            $Article->status = $request->status ?? 1;
            $Article->categoryArticle_id = $request->categoryArticle_id; // Lưu danh mục
            $Article->admin_id = $request->admin_id;

            $Article->save();
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$Article->id}.{$image->getClientOriginalExtension()}";
                $image->move(public_path('img/'), $imageName);

                $Article->image = $imageName;

                $Article->save();
            }

            return redirect()->route('article')->with('success', 'Bài viết đã được thêm thành công!'); // Chuyển hướng sau khi thêm
        }
        $atc = Article::orderBy('id', 'desc')->get();

        $categoryArticle = CategoryArticle::all(); // Lấy tất cả danh mục

        // Hiển thị form khi là GET request
        return view('admin.articleAdd', compact('categoryArticle', 'atc'));
    }


    public function articleEdit(ArticleEditRequest $request, $id)
    {
        $response = $this->adminstrationGroupCrud('articleEdit');
        if ($response) {
            return $response;
        }
        $Article = Article::findOrFail($id); // Tìm bài viết theo ID

        $categoryArticle = CategoryArticle::all(); // Lấy tất cả danh mục

        if ($request->isMethod('put')) {
            $Article = Article::findOrFail($id); // Tìm bài viết theo ID
            $Article->title = $request->title;
            $Article->description_short = $request->description_short;
            $Article->description = $request->description;
            $Article->status = $request->status ?? 1;
            $Article->categoryArticle_id = $request->categoryArticle_id; // Lưu danh mục
            $Article->admin_id = $request->admin_id;

            $Article->save();
            // Xử lý hình ảnh nếu có
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$Article->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('img/'), $imageName);

                $Article->image = $imageName;

                $Article->save();
            }

            return redirect()->route('article')->with('success', 'Bài viết đã được cập nhật thành công!');
        }

        return view('admin.articleEdit')->with(compact('Article', 'categoryArticle')); // Redirect về danh sách bài viết
    }

    public function articleBulkDelete(Request $request)
    {
        $response = $this->adminstrationGroupCrud('articleCheckboxDelete');
        if ($response) {
            return $response;
        }
        // Xác thực dữ liệu
        $request->validate([
            'article_ids' => 'required|array',
            'article_ids.*' => 'exists:articles,id',
        ]);

        // Xóa các bài viết theo ID
        Article::destroy($request->article_ids);

        // Chuyển hướng về danh sách bài viết với thông báo thành công
        return redirect()->route('article')->with('success', 'Đã xóa bài viết thành công!');
    }

    public function updateStatusArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->status = $request->status;
        $article->save();

        return response()->json(['success' => true]);
    }


    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'articleAdd' => 'Bạn không có quyền thêm bài viết.',
            'articleEdit' => 'Bạn không có quyền chỉnh sửa bài viết.',
            'articleCheckboxDelete' => 'Bạn không có quyền xóa bài viết.',
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
