<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Thêm vào giỏ hàng
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // Nếu sản phẩm đã có -> tăng số lượng
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Nếu chưa có -> thêm mới
            $cart[$id] = [
                "id"       => $id,  // 🔥 thêm ID để tránh lỗi undefined 'id'
                "name"     => $product->name,
                "price"    => $product->price,
                "quantity" => 1,
                "image"    => $product->image ?? null
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        if($request->quantity <= 0) return redirect()->route('cart.index');

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    // Xóa sản phẩm
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }
    public function checkout()
{
    $cart = session()->get('cart', []);
    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return view('cart.checkout', compact('cart','total'));
}

}
