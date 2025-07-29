<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Product;
use App\Models\UserGroup;
use App\Models\Categories;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\CommentImages;
use App\Models\ProductDiscount;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CheckoutController;
use App\Models\SubBanner;

class HomeController extends Controller
{
    private $productModel;
    private $productDiscountModel;
    private $categoryModel;
    private $articleModel;
    private $bannerModel;
    private $commentImageModel;
    private $commentModel;
    private $subBannerModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->productDiscountModel = new ProductDiscount();
        $this->categoryModel = new Categories();
        $this->articleModel = new Article();
        $this->bannerModel = new Banner();
        $this->commentImageModel = new CommentImages();
        $this->commentModel = new Comment();
        $this->subBannerModel = new SubBanner();
        $this->bannerModel = new Banner();
    }

    public function index()
    {
        $banners_4 = $this->bannerModel->getList(4);
        $sub_banners_5 = $this->subBannerModel->getList(5);
        $productOutStanding = $this->productModel->productOutStanding();
        $productBestseller = $this->productModel->productBestseller();
        $productSoldOut =  $this->productModel->productSoldOut();
        $categories = Categories::with(['categories_children', 'categories_children.product'])->whereNull('parent_id')->where('status', 1)->get();
        $productByCategory = []; //tạo mảng để lưu trữ sản phẩm theo danh mục con
        foreach ($categories as $category) { //Duyệt qua từng danh mục cha
            foreach ($category->categories_children as $child) { // Duyệt qua từng danh mục con của danh mục cha hiện tại //$child đại diện cho một danh mục con của danh mục cha hiện tại.
                // Lưu trữ sản phẩm cho từng danh mục con
                $productByCategory[$child->id] = $child->product;
            }
        }
        //
        $user = auth()->user();
        $productDiscountSection = $this->productDiscountModel->productDiscountSection($user ? $user->user_group_id : 1);
        $categoryAll = $this->categoryModel->categoryTotal();
        $categoryChoose = $this->categoryModel->categoryChoose();

        $articles = $this->articleModel->articleAll();

        $comments = $this->commentModel->commentBuildImage();
        $commentBuildImageById = [];
        foreach ($comments as $comment) {
            if ($comment->commentImages->count() > 0) {
                $randomImage = $comment->commentImages->random();
                $commentBuildImageById[] = $randomImage;
            }
        }
        CheckoutController::clearSessions();

        return view('home', compact(
            'productOutStanding',
            'comments',
            'commentBuildImageById',
            'productDiscountSection',
            'categories',
            'productBestseller',
            'productByCategory',
            'user',
            'productSoldOut',
            'categoryAll',
            'categoryChoose',
            'articles',
            'banners_4',
            'sub_banners_5'
        ));
    }

    public function search(Request $request)
    {
        CheckoutController::clearSessions();

        $name = $request->input('name');
        $searchProduct = $this->productModel->searchProductHome($name);

        return view('search', compact('searchProduct', 'name'));
    }
}
