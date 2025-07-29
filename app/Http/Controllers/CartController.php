<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $productModel;
    private $cartModel;
    private $productDiscountModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->cartModel = new Cart();
        $this->productDiscountModel = new ProductDiscount();
    }

    public function getCart()
    {
        $products = $this->productModel;
        if (Auth::check()) {
            // Lưu vào DATABASE - CẦN LOGIN
            $user = Auth::check() ? Auth::user()->id : 0;
            $cart = $this->cartModel->getallcart($user);
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
        } // Kiểm tra và loại bỏ sản phẩm không tồn tại
        foreach ($cart as $key => $item) {
            $product = $products->find($item['product_id']);
            if (!$product) {
                unset($cart[$key]); // Xóa sản phẩm không tồn tại
            }
        }
        Session::forget('assemblyPackage');
        Session::forget('buyNow');

        // Cập nhật cookie
        return response()->view('cart', compact('cart', 'products'))
            ->withCookie(cookie()->forever('cart', json_encode($cart)));
    }

    public function cartAdd(Request $request)
    {
        session()->forget('buyNow');

        $user = Auth::check() ? Auth::user()->id : 0;
        // Lấy thông tin sản phẩm từ request
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        if ($user > 0) {
            // Khi người dùng đã đăng nhập, lưu vào DB
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $cartItem = $this->cartModel->where('user_id', $user)
                ->where('product_id', $product_id)
                ->first();
            if ($cartItem) {
                // Nếu đã có, tăng số lượng
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // Nếu chưa có, thêm mới
                $this->cartModel->create([
                    'user_id' => $user,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                ]);
            }

            return response()->json(['message' => 'Thêm giỏ hàng thành công']);
            // return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng'); // Thông báo thành công
        } else {
            // lưu vào cookie
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            $product_id = $request->product_id;
            if (isset($cart[$product_id])) {
                $cart[$product_id]['quantity'] += $request->quantity;
            } else {
                $cart[$product_id] = [
                    'product_id' => $product_id,
                    'quantity' => $request->quantity,
                ];
            }

            return response()->json(['success' => true, 'message' => 'Thêm giỏ hàng thành công'])->withCookie(cookie()->forever('cart', json_encode($cart))); //withCookie :  cho phép bạn thêm một cookie vào phản hồi, Cookie này sẽ được gửi về trình duyệt của người dùng cùng với phản hồi, và trình duyệt sẽ lưu cookie này
            // return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart)))->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
        }
    }

    public function caculateCart($cart)
    {
        $total = 0;
        foreach ($cart as $item) {

            $product_id = is_array($item) ? $item['product_id'] : $item->product_id;
            $quantity = is_array($item) ? $item['quantity'] : $item->quantity;
            $user_group_id = Auth::check() ? Auth::user()->user_group_id : 1;

            $product = $this->productModel->find($product_id);

            $productDiscountPrice = $product->productDiscount
                ->where('user_group_id', $user_group_id)
                ->first();

            $amount = $product ? $product->price : 0;

            if ($productDiscountPrice) {
                $amount = $productDiscountPrice ? $productDiscountPrice->price : 0;
            }

            $total += $amount * $quantity;
        }
        return $total;
    }
    public function increaseQuantity($id)
    {
        if (Auth::check()) {
            $cartItem = Cart::firstWhere([['user_id', Auth::id()], ['product_id', $id]]);

            if ($cartItem) {
                $cartItem->quantity++;
                $cartItem->save();
            }

            $cart = $this->cartModel->where('user_id', Auth::id())->get();
            $total = $this->caculateCart($cart);

            return response()->json([
                'success' => true,
                'message' => 'Tăng số lượng thành công',
                'total' => number_format($total, 0, ',') . 'đ',
            ]);
        } else {

            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            }

            $total = $this->caculateCart($cart);


            return response()->json([
                'success' => true,
                'message' => 'Tăng số lượng thành công',
                'total' => number_format($total, 0, ',') . 'đ',

            ])->withCookie(cookie()->forever('cart', json_encode($cart)));
            //return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart))); // withCookie :  cho phép bạn thêm một cookie vào phản hồi, Cookie này sẽ được gửi về trình duyệt của người dùng cùng với phản hồi, và trình duyệt sẽ lưu cookie này // cookie:  là một phương thức để tạo cookie,
        }
    }

    public function decreaseQuantity($id)
    {
        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();
            if ($cartItem) {

                if ($cartItem->quantity > 1) {
                    $cartItem->quantity--;
                    $cartItem->save();

                    $cart = $this->cartModel->where('user_id', Auth::id())->get();
                    $total = $this->caculateCart($cart);

                    return response()->json([
                        'success' => true,
                        'message' => 'Giảm số lượng thành công',
                        'total' => number_format($total, 0, ',') . 'đ',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'error' => 'Số lượng ít nhất một sản phẩm!',
                    ]);
                }
            }
        } else {
            $cart  = json_decode(request()->cookie('cart'), true) ?? [];

            if (isset($cart[$id])) {
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;

                    $total = $this->caculateCart($cart);

                    return response()->json([
                        'success' => true,
                        'message' => 'Giảm số lượng thành công',
                        'total' => number_format($total, 0, ',') . 'đ',

                    ])->withCookie(cookie()->forever('cart', json_encode($cart)));
                    //return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart))); // withCookie :  cho phép bạn thêm một cookie vào phản hồi, Cookie này sẽ được gửi về trình duyệt của người dùng cùng với phản hồi, và trình duyệt sẽ lưu cookie này // cookie:  là một phương thức để tạo cookie,
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Giảm số lượng thành công',
                        'error' => 'Số lượng ít nhất một sản phẩm!',
                    ]);
                }
            }
        }
    }

    public function deleteItemCart($id)
    {
        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

            if ($cartItem) {
                $cartItem->delete();
            }

            return redirect()->back();
        } else {
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            if (isset($cart[$id])) {
                unset($cart[$id]);
            }
            return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart)));
        }
    }

    public function deleteAllCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->back();
        } else {
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            if (is_array($cart)) {
                return redirect()->back()->withCookie(cookie()->forget('cart', json_encode($cart)));
            }
        }
    }
}
