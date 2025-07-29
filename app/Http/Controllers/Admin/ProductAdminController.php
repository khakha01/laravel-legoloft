<?php

namespace App\Http\Controllers\admin;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Favourite;
use App\Models\UserGroup;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\ProductDiscount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\admin\ProductEditRequest;
use App\Http\Requests\admin\ProductAdminRequest;

class ProductAdminController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $productImageModel;
    private $productDiscountModel;
    private $userGroupModel;
    private $cartModel;
    private $favouriteModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Categories();
        $this->productImageModel = new ProductImages();
        $this->productDiscountModel = new ProductDiscount();
        $this->userGroupModel = new UserGroup();
        $this->cartModel = new Cart();
        $this->favouriteModel = new Favourite();
    }

    public function productSearch(Request $request)
    {
        $filter_iddm = $request->input('filter_iddm');
        $filter_name = $request->input('filter_name');
        $filter_status = $request->input('filter_status');

        $products = $this->productModel->searchProduct($filter_iddm, $filter_name,  $filter_status);
        $productDiscount = $this->productDiscountModel;

        return view('admin.product', compact('products', 'productDiscount', 'filter_iddm', 'filter_name',  'filter_status'));
    }

    public function product()
    {
        $products = $this->productModel->productAll();
        $productDiscount = $this->productDiscountModel;
        return view('admin.product', compact('products', 'productDiscount'));
    }

    public function productAdd(ProductAdminRequest $request)
    {

        $response = $this->adminstrationGroupCrud('productAdd');
        if ($response) {
            return $response;
        }
        if ($request->isMethod('post')) {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->view = $request->view;
            $product->outstanding = $request->outstanding;
            $product->save();

            if ($request->file('image')) {
                // lấy ảnh gửi lên
                $image = $request->file('image');
                // Đặt tên cho file bằng id của sản phẩm
                $imageName = "{$product->id}" . uniqid() . "{$image->getClientOriginalExtension()}";

                // Di chuyển ảnh vào thư mục IMG
                $image->move(public_path('img/'), $imageName);
                // gán biến cho thuộc tính $product để lưu vào DB
                $product->image = $imageName;
            }

            // Thêm nhiều ảnh con của sản phẩm
            if ($request->file('images')) {
                $images = $request->file('images');
                foreach ($images as $index => $image) {
                    $productImages = new ProductImages();
                    $imageName = "{$productImages->id}" . uniqid() . "{$image->getClientOriginalExtension()}";
                    $image->move(public_path('img/'), $imageName);
                    $productImages->images = $imageName;
                    $productImages->product_id = $product->id;
                    $productImages->save();
                }
            }
            $product->save();

            // Thêm và chỉnh sửa giá giảm của sản phẩm
            $this->productDiscount($request, $product);

            return redirect()->route('product')->with('success', 'Thêm sản phẩm thành công');
        }

        $categories = $this->categoryModel->categoryAll();
        $userGroups = $this->userGroupModel->userGroupAll();
        return view('admin.productAdd', compact('categories', 'userGroups'));
    }

    public function productEdit($id)
    {
        $response = $this->adminstrationGroupCrud('productEdit');
        if ($response) {
            return $response;
        }
        $product = $this->productModel->findOrFail($id);
        $productImages = $this->productImageModel->productImages($id);
        $productDiscount = $this->productDiscountModel->productDiscountById($id);
        $userGroups = $this->userGroupModel->userGroupAll();
        return view('admin.productEdit', compact('product', 'productImages', 'userGroups', 'productDiscount'));
    }

    public function productUpdate(ProductEditRequest $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->view = $request->view;
        $product->outstanding = $request->outstanding;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "{$product->id}.{$image->getClientOriginalExtension()}";
            $image->move(public_path('img/'), $imageName);
            $product->image = $imageName;
        }

        // Thêm và chỉnh sửa nhiều ảnh con của sản phẩm
        if ($request->file('images')) {
            $images = $request->file('images');
            foreach ($images as $index => $image) {
                $productImages = new ProductImages();
                $imageName = "{$productImages->id}" . uniqid() . "{$image->getClientOriginalExtension()}";
                $image->move(public_path('img/'), $imageName);
                $productImages->images = $imageName;
                $productImages->product_id = $product->id;
                $productImages->save();
            }
        }
        // Thêm và chỉnh sửa giá giảm của sản phẩm
        $this->productDiscount($request, $product);

        $product->save();
        return redirect()->route('product')->with('success', 'Câp nhật sản phẩm thành công');
    }

    public function productDiscount($request, $product)
    {
        //  $product->productDiscount()->delete();
        if ($request->has('user_group_id')) {

            $userGroup = $request->user_group_id;
            $prices =  $request->priceUserGroup;
            foreach ($userGroup as $key => $userGroupId) {
                // Kiểm tra xem giảm giá cho nhóm người dùng đã tồn tại chưa
                $productDiscounts = $this->productDiscountModel->productDiscount($product->id, $userGroupId);
                if ($productDiscounts) {
                    // Nếu đã tồn tại, cập nhật giá
                    $productDiscounts->price = $prices[$key];
                    $productDiscounts->save();
                } else {
                    // Kiểm tra xem nhóm người dùng đã tồn tại trong cơ sở dữ liệu chưa
                    $existsUserGroup = $this->productDiscountModel->where('product_id', $product->id)->where('user_group_id', $userGroupId)->first();
                    if ($existsUserGroup) {
                        // Nếu đã tồn tại, thông báo lỗi và không tạo mới
                        return redirect()->back()->with('error', 'Đã tồn tại nhóm khách hạng này.');
                    } else {
                        // Tạo mới giảm giá cho nhóm người dùng
                        $productDiscount = new ProductDiscount();
                        $productDiscount->user_group_id = $userGroupId;
                        $productDiscount->product_id = $product->id;
                        $productDiscount->price = $prices[$key];
                        $productDiscount->save();
                    }
                }
            }
        }
    }


    public function productUpdateOutstanding(Request $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->outstanding = $request->outstanding;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function productUpdateStatus(Request $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function productDeleteCheckbox(Request $request)
    {
        // Kiểm tra quyền truy cập hoặc hành động chung
        $response = $this->adminstrationGroupCrud('productCheckboxDelete');
        if ($response) {
            return $response;
        }

        // Lấy danh sách ID sản phẩm từ request
        $product_id = $request->input('product_id');

        // Kiểm tra nếu không có sản phẩm nào được chọn
        if (empty($product_id)) {
            return redirect()->route('product')->with('error', 'Vui lòng chọn sản phẩm cần xóa.');
        }

        // Mảng chứa các thông báo lỗi
        $errorMessages = [];
        $favourite = json_decode(request()->cookie('favourite'), true) ?? [];
        $cart = json_decode(request()->cookie('cart'), true) ?? [];

        // Lặp qua từng sản phẩm
        foreach ($product_id as $itemID) {
            $product = $this->productModel->findOrFail($itemID);

            // Kiểm tra số lượng sản phẩm trong giỏ hàng
            $countCart = $this->cartModel->countCartProduct($itemID);
            if ($countCart > 0) {
                $errorMessages[] = 'Cảnh báo: Sản phẩm này không thể xóa vì nó hiện được chỉ định cho ' . $countCart . ' giỏ hàng!';
                continue; // Tiếp tục với sản phẩm khác
            }

            // Kiểm tra số lượng sản phẩm trong danh sách yêu thích
            $countFavourite = $this->favouriteModel->countFavouriteProduct($itemID);
            if ($countFavourite > 0) {
                $errorMessages[] = 'Cảnh báo: Sản phẩm này không thể xóa vì nó hiện được chỉ định cho ' . $countFavourite . ' yêu thích!';
                continue; // Tiếp tục với sản phẩm khác
            }

            // Xóa các thông tin liên quan đến sản phẩm (chiết khấu, hình ảnh)
            $this->productDiscountModel->where('product_id', $itemID)->delete();
            $this->productImageModel->where('product_id', $itemID)->delete();

            // Xóa sản phẩm
            $product->delete();

            // Xóa sản phẩm khỏi cookie nếu có
            unset($favourite[$itemID]);
            unset($cart[$itemID]);
        }

        // Kiểm tra nếu có lỗi và trả về thông báo
        if (!empty($errorMessages)) {
            return redirect()->route('product')->with('error', implode('<br>', $errorMessages));
        }

        // Nếu không có lỗi, trả về thông báo thành công
        return redirect()->route('product')->with('success', 'Xóa sản phẩm thành công')->withCookie(cookie()->forever('favourite', json_encode($favourite)))
            ->withCookie(cookie()->forever('cart', json_encode($cart)));
    }


    public function productDeleteImages($id)
    {
        $productImages = $this->productImageModel->findOrFail($id);
        $productImages->delete();
        return redirect()->back()->with('success', 'Xóa ảnh thành công');
    }

    public function productDeleteDiscount($id)
    {
        $productDiscount = $this->productDiscountModel->findOrFail($id);
        $productDiscount->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function productCopyCheckkbox(Request $request)
    {
        $product_id = $request->input('product_id');

        if ($product_id) {
            foreach ($product_id as $item) {
                $product = $this->productModel->findOrFail($item);
                $newProduct = $product->replicate();
                $newProduct->status = 0;
                $newProduct->created_at = now();
                $newProduct->updated_at = now();
                $newProduct->save();

                if ($product->image) {
                    $newImage = $product->image;
                    Storage::copy('public/uploads/' . $product->image, 'public/img/' . $newImage);
                    $newProduct->image = $newImage;
                    $newProduct->save();
                }
            }
        }
        return redirect()->route('product')->with('success', 'Copy sản phẩm thành công.');
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'productAdd' => 'Bạn không có quyền thêm sản phẩm.',
            'productEdit' => 'Bạn không có quyền chỉnh sửa sản phẩm.',
            'productCheckboxDelete' => 'Bạn không có quyền xóa sản phẩm.',
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
