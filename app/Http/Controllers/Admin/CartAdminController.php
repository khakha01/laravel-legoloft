<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartAdminController extends Controller
{
    private $productModel;
    private $cartModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->cartModel = new Cart();
    }
    public function cart()
    {
        $cartAll =  $this->cartModel->cartAll();
        $filter_name = '';
        return view('admin.cart', compact('cartAll', 'filter_name'));
    }
    public function cartSearch(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');

        // Tìm kiếm giỏ hàng dựa trên từ khóa
        $cartAll = $this->cartModel->searchCart($filter_name);


        // Trả về view với dữ liệu
        return view('admin.cart', compact('cartAll', 'filter_name'));
    }
}
